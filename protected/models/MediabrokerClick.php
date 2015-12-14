<?php

/**
 * This is the model class for table "p_mediabrokers_clicks".
 *
 * The followings are the available columns in table 'p_mediabrokers_clicks':
 * @property integer $mbclicks_id
 * @property integer $mbroker_id
 * @property string $date_created
 * @property string $referer
 * @property string $url
 *
 * The followings are the available model relations:
 * @property PMediabrokers $mbroker
 */
class MediabrokerClick extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return MediabrokerClick the static model class
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
		return 'p_mediabrokers_clicks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_created, url', 'required'),
			array('mbroker_id', 'numerical', 'integerOnly'=>true),
			array('referer, url', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mbclicks_id, mbroker_id, date_created, referer, url', 'safe', 'on'=>'search'),
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
			'mbroker' => array(self::BELONGS_TO, 'PMediabrokers', 'mbroker_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mbclicks_id' => 'Mbclicks',
			'mbroker_id' => 'Mbroker',
			'date_created' => 'Date Created',
			'referer' => 'Referer',
			'url' => 'Url',
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

		if(Yii::app()->user->isMediabroker()) {
			$criteria->compare('t.mbroker_id', Yii::app()->user->getMediabrokerId());
		}

		$criteria->order = 't.mbclicks_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}