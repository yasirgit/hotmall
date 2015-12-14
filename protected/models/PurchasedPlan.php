<?php

/**
 * This is the model class for table "p_purchased_plans".
 *
 * The followings are the available columns in table 'p_purchased_plans':
 * @property integer $pplan_id
 * @property integer $wlabel_id
 * @property integer $plan_id
 * @property integer $advertiser_id
 * @property integer $type
 * @property string $date_created
 * @property integer $method
 * @property string $price
 *
 * The followings are the available model relations:
 * @property PWhitelabel $wlabel
 * @property PAdvertisers $advertiser
 * @property PPlans $plan
 * @property PPurchasedPlansLimits[] $pPurchasedPlansLimits
 */
class PurchasedPlan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PurchasedPlan the static model class
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
		return 'p_purchased_plans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wlabel_id, plan_id, type, date_created, method, price', 'required'),
			array('wlabel_id, plan_id, advertiser_id, type, method', 'numerical', 'integerOnly'=>true),
			array('price', 'length', 'max'=>10),
			array('subscription_id', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pplan_id, wlabel_id, plan_id, advertiser_id, type, date_created, method, price', 'safe', 'on'=>'search'),
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
			'p_whitelabel' => array(self::BELONGS_TO, 'WhiteLabel', 'wlabel_id'),
			'p_advertisers' => array(self::BELONGS_TO, 'Advertiser', 'advertiser_id'),
			'p_plans' => array(self::BELONGS_TO, 'Plan', 'plan_id'),
			'p_purchased_plans_payments' => array(self::HAS_MANY, 'PurchasedPlanPayment', 'pplan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pplan_id' => 'Pplan',
			'wlabel_id' => 'Wlabel',
			'subscription_id' => 'Wlabel',
			'plan_id' => 'Plan',
			'advertiser_id' => 'Advertiser',
			'type' => 'Type',
			'date_created' => 'Date Purchased',
			'method' => 'Method',
			'price' => 'Price ($)',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($planType)
	{
		$criteria=new CDbCriteria;

		if($planType == PlanType::ADVERTISER_PLAN) {
			$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		}
		
		if(Yii::app()->user->isAdvertiser()) {
			$criteria->compare('t.advertiser_id', Yii::app()->user->getAdvertiserId());
		} else if(Yii::app()->user->isWhiteLabelAdmin()) {
			$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		}

		
		$criteria->compare('t.type', $planType);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}