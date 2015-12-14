<?php

/**
 * This is the model class for table "p_coupons_redemptions".
 *
 * The followings are the available columns in table 'p_coupons_redemptions':
 * @property integer $credemption_id
 * @property integer $coupon_id
 * @property integer $employee_id
 * @property integer $customer_id
 * @property string $phone
 * @property string $date_created
 *
 * The followings are the available model relations:
 * @property PCustomers $customer
 * @property PCoupons $coupon
 * @property PEmployees $employee
 */
class CouponRedemption extends CActiveRecord
{
	public $clerk_id;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return CouponRedemption the static model class
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
		return 'p_coupons_redemptions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('coupon_id, phone, date_created, clerk_id', 'required'),
			array('coupon_id, employee_id, customer_id', 'numerical', 'integerOnly'=>true),
			array('phone', 'length', 'max'=>40),
			array('clerk_id', 'verifyClerk'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('credemption_id, coupon_id, employee_id, customer_id, phone, date_created', 'safe', 'on'=>'search'),
		);
	}

	public function verifyClerk($attribute,$params) {
		if(!isset($this->clerk_id) || $this->clerk_id == '') {
			return false;
		}
		
		$employeeId = $this->getEmployeeIdFromClerkId($this->clerk_id, false);
		if($employeeId == null) {
			$this->addError($attribute, 'Cannot find clerk by this ID!');
			return false;
		}

		return true;
	}
	
	public function beforeSave() {
		$this->employee_id = $this->getEmployeeIdFromClerkId($this->clerk_id);
		$this->customer_id = Yii::app()->user->getId();
		
		return parent::beforeSave();
	}
	
	public function getEmployeeIdFromClerkId($clerkId, $throwException = true) {
		$e = Employee::model()->findByAttributes( array('id'=>$clerkId, 'wlabel_id'=>Yii::app()->user->getWhitelabelId()) );
		if($e == null) {
			if($throwException) {
				throw new CHttpException(400,'Invalid request. No clerk found!');
			} else {
				return null;
			}
		}
		
		return $e->employee_id;
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'customer' => array(self::BELONGS_TO, 'PCustomers', 'customer_id'),
			'coupon' => array(self::BELONGS_TO, 'PCoupons', 'coupon_id'),
			'employee' => array(self::BELONGS_TO, 'PEmployees', 'employee_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'credemption_id' => 'Credemption',
			'coupon_id' => 'Coupon',
			'employee_id' => 'Employee',
			'customer_id' => 'Customer',
			'clerk_id' => 'Clerk ID:',
			'phone' => 'Phone Number:',
			'date_created' => 'Date Created',
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

		$criteria->compare('credemption_id',$this->credemption_id);
		$criteria->compare('coupon_id',$this->coupon_id);
		$criteria->compare('employee_id',$this->employee_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}