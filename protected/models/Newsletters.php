<?php

/**
 * This is the model class for table "p_newsletters".
 *
 * The followings are the available columns in table 'p_newsletters':
 * @property integer $newsletter_id
 * @property string $recipients
 * @property string $subject
 * @property string $message
 * @property string $scheduled_date
 * @property string $attachment
 */
class Newsletters extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Newsletter the static model class
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
		return 'p_newsletters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, recipients , message', 'required'),
			array('subject', 'length', 'max'=>100),
			array('scheduled_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('newsletter_id, subject, scheduled_date, message', 'safe', 'on'=>'search'),
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
			'newsletter_id' 	=> 'ID',
			'subject' 			=> 'Subject',
			'recipients' 		=> 'Recipient',
			'message' 			=> 'Message',
			'scheduled_date'=> 'Schedule Delivery',
			'attachment'		=>	'Attach File'
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

		$criteria->compare('newsletterid',$this->newsletter_id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}