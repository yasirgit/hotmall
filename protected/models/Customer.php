<?php

/**
 * This is the model class for table "p_customers".
 *
 * The followings are the available columns in table 'p_customers':
 * @property integer $customer_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $mobile
 * @property integer $status
 * @property integer $wlabel_id
 *
 * The followings are the available model relations:
 * @property PWhitelabel $wlabel
 */
class Customer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Customer the static model class
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
		return 'p_customers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, mobile, wlabel_id, date_created, password', 'required'),
			array('status, wlabel_id', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, email, mobile, password', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('customer_id, first_name, last_name, email, mobile, status, wlabel_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'customer_id' => 'Customer',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'mobile' => 'Mobile',
			'status' => 'Status',
			'wlabel_id' => 'Wlabel',
			'date_created' => 'Date Created',
			'password' => 'Password',
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

		$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchLatest()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		$criteria->order = 't.customer_id DESC';
		$criteria->limit = 10;
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}
	
	public function delete() {
		if($this->wlabel_id != Yii::app()->user->getWhiteLabelId()) {
			return false;
		}
		
		return parent::delete();
	}
}