<?php

/**
 * This is the model class for table "p_employees".
 *
 * The followings are the available columns in table 'p_employees':
 * @property integer $employee_id
 * @property integer $wlabel_id
 * @property integer $advertiser_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $id
 *
 * The followings are the available model relations:
 * @property PWhitelabel $wlabel
 * @property PAdvertisers $advertiser
 */
class Employee extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Employee the static model class
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
		return 'p_employees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wlabel_id, advertiser_id, name, id', 'required'),
			array('wlabel_id, advertiser_id', 'numerical', 'integerOnly'=>true),
			array('name, email', 'length', 'max'=>100),
			array('phone, id', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('employee_id, wlabel_id, advertiser_id, name, email, phone, id', 'safe', 'on'=>'search'),
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
			'wlabel' => array(self::BELONGS_TO, 'PWhitelabel', 'wlabel_id'),
			'advertiser' => array(self::BELONGS_TO, 'PAdvertisers', 'advertiser_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'employee_id' => 'Employee',
			'wlabel_id' => 'Wlabel',
			'advertiser_id' => 'Advertiser',
			'name' => 'Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'id' => 'ID',
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

		$criteria->compare('wlabel_id',Yii::app()->user->getWhiteLabelId());
		if(Yii::app()->user->isAdvertiser()) {
			$criteria->compare('advertiser_id',Yii::app()->user->getAdvertiserId());
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}