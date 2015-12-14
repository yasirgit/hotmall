<?php

/**
 * This is the model class for table "p_premiumads_listings".
 *
 * The followings are the available columns in table 'p_premiumads_listings':
 * @property integer $premiumad_id
 * @property integer $listing_id
 */
class PremiumAdListing extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PremiumAdListing the static model class
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
		return 'p_premiumads_listings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('premiumad_id, listing_id', 'required'),
			array('premiumad_id, listing_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('premiumad_id, listing_id', 'safe', 'on'=>'search'),
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
			'premiumad_id' => 'Premiumad',
			'listing_id' => 'Listing',
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

		$criteria->compare('premiumad_id',$this->premiumad_id);
		$criteria->compare('listing_id',$this->listing_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}