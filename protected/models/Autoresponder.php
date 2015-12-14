<?php

/**
 * This is the model class for table "p_autoresponders".
 *
 * The followings are the available columns in table 'p_autoresponders':
 * @property integer $autoresponder_id
 * @property string $subject
 * @property string $message
 * @property integer $type
 * @property integer $wlabel_id
 */
class Autoresponder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Autoresponder the static model class
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
		return 'p_autoresponders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type', 'required'),
			array('type, wlabel_id', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('autoresponder_id, subject, message, type, wlabel_id', 'safe', 'on'=>'search'),
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
			'autoresponder_id' => 'Autoresponder',
			'subject' => 'Subject',
			'message' => 'Message',
			'type' => 'Type',
			'wlabel_id' => 'Wlabel',
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

		$criteria->compare('autoresponder_id',$this->autoresponder_id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('wlabel_id',$this->wlabel_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}