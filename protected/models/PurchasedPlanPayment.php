<?php

/**
 * This is the model class for table "p_purchased_plans_payments".
 *
 * The followings are the available columns in table 'p_purchased_plans_payments':
 * @property integer $pppayment_id
 * @property integer $pplan_id
 * @property string $date_paid
 * @property string $date_expire
 * @property string $transaction_id
 *
 * The followings are the available model relations:
 * @property PPlansLimits $plimit
 * @property PPurchasedPlans $pplan
 */
class PurchasedPlanPayment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PurchasedPlanPayment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'p_purchased_plans_payments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pplan_id, date_paid, date_expire', 'required'),
			array('pplan_id', 'numerical', 'integerOnly'=>true),
			array('transaction_id', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pppayment_id, pplan_id, date_paid, date_expire, transaction_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'p_purchased_plans' => array(self::BELONGS_TO, 'PurchasedPlan', 'pplan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pppayment_id' => 'Pppayment',
			'pplan_id' => 'Pplan',
			'date_paid' => 'Date Paid',
			'date_expire' => 'Date Expire',
			'transaction_id' => 'Transaction',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($purchasedPlanId)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('pplan_id',$purchasedPlanId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	function afterSave()
	{
		if($this->isNewRecord) {

			$purchasedPlan = PurchasedPlan::model()->findByPk($this->pplan_id);
			if($purchasedPlan == null) {
				throw new CHttpException(1234, "No plan found!");
			}

			if($purchasedPlan->type == PlanType::ADVERTISER_PLAN && $purchasedPlan->advertiser_id != '') {
				$advertiser = Advertiser::model()->findByPk($purchasedPlan->advertiser_id);
				if($advertiser == null) {
					throw new CHttpException(1234, "No advertiser found!");
				}

				if($advertiser->mbroker_id != '') {
					// insert commission for this media broker
					$wlAccount = WhiteLabel::model()->findByPk($purchasedPlan->wlabel_id);
					if($wlAccount == null) {
						throw new CHttpException(1234, "No account found!");
					}

					if($wlAccount->mb_commission != '' && $wlAccount->mb_commission != 0 
							&& $wlAccount->mb_commission_type != '' && $wlAccount->mb_commission_type != 0) {


						if($wlAccount->mb_commission_type == CommissionType::TYPE_FIXED) {
							$commissionAmount = $wlAccount->mb_commission;
						} else { // percentage
							$commissionAmount = ($purchasedPlan->price/100)*$wlAccount->mb_commission;
						}

						$mbCommissions = new MediabrokerCommission;
						$mbCommissions->mbroker_id = $advertiser->mbroker_id;
						$mbCommissions->pppayment_id = $this->pppayment_id;
						$mbCommissions->date_created = date("Y-m-d h:i:s");
						$mbCommissions->amount = $commissionAmount;

						$mbCommissions->save();
					}
				}

			}
		}
		
		return parent::afterSave();
	}	
}