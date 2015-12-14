<?php

/**
 * This is the model class for table "p_payments_log".
 *
 * The followings are the available columns in table 'p_payments_log':
 * @property integer $paymentlog_id
 * @property string $date_created
 * @property string $log
 */
class PaymentLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PaymentLog the static model class
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
		return 'p_payments_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_created, log', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('paymentlog_id, date_created, log', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'paymentlog_id' => 'Paymentlog',
			'date_created' => 'Date Created',
			'log' => 'Log',
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

		$criteria->compare('paymentlog_id',$this->paymentlog_id);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('log',$this->log,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}