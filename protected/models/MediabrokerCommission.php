<?php

/**
 * This is the model class for table "p_mediabrokers_commissions".
 *
 * The followings are the available columns in table 'p_mediabrokers_commissions':
 * @property integer $mbcommission_id
 * @property integer $mbroker_id
 * @property integer $pppayment_id
 * @property string $date_created
 * @property string $amount
 * @property string $date_paid
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property PMediabrokers $mbroker
 * @property PPurchasedPlansPayments $pppayment
 */
class MediabrokerCommission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return MediabrokerCommission the static model class
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
		return 'p_mediabrokers_commissions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mbroker_id, pppayment_id, date_created, amount', 'required'),
			array('mbroker_id, pppayment_id, status', 'numerical', 'integerOnly'=>true),
			array('amount', 'length', 'max'=>10),
			array('date_paid', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mbcommission_id, mbroker_id, pppayment_id, date_created, amount, date_paid, status, paystatus', 'safe', 'on'=>'search'),
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
			'p_mediabrokers' => array(self::BELONGS_TO, 'Mediabroker', 'mbroker_id'),
			'p_purchased_plans_payments' => array(self::BELONGS_TO, 'PurchasedPlanPayment', 'pppayment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mbcommission_id' => 'Mbcommission',
			'mbroker_id' => 'Mbroker',
			'pppayment_id' => 'Commission For',
			'date_created' => 'Date Created',
			'amount' => 'Amount',
			'date_paid' => 'Date Paid',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.mbroker_id', $this->mbroker_id);
		$criteria->compare('t.amount', $this->amount);
		$criteria->compare('t.status', $this->status);
		$criteria->compare('t.paystatus', $this->paystatus);

		if(Yii::app()->user->isMediabroker()) {
			$criteria->compare('t.mbroker_id', Yii::app()->user->getMediabrokerId());
		}

		$criteria->order = 't.mbcommission_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getStatus($status) {
		return CommissionStatus::getStatus($status);
	}		
	
	public function getPayStatus($status) {
		return CommissionPayStatus::getStatus($status);
	}		

}