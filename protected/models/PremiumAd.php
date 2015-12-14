<?php

/**
 * This is the model class for table "p_premiumads".
 *
 * The followings are the available columns in table 'p_premiumads':
 * @property integer $premiumad_id
 * @property integer $wlabel_id
 * @property string $headline
 * @property string $description
 * @property string $image
 * @property string $link_text
 * @property string $link_url
 * @property integer $position
 * @property integer $display_type
 * @property integer $show_on_static
 */
class PremiumAd extends CActiveRecord
{
	public $_oldImage = '';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return PremiumAd the static model class
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
		return 'p_premiumads';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('headline, description, link_text, link_url, position, display_type', 'required'),
			array('wlabel_id, advertiser_id, position, display_type, show_on_static', 'numerical', 'integerOnly'=>true),
			array('headline', 'length', 'max'=>200),
			array('image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true),
			array('link_text, link_url', 'length', 'max'=>250),
			array('link_url', 'url'),			
			array('p_categories', 'dummyCheck'),
			array('p_locations', 'dummyCheck'),
			array('p_listings', 'dummyCheck'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('premiumad_id, wlabel_id, headline, description, image, link_text, link_url, position, display_type, show_on_static', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * this check is there only because if thep_categories, p_locations & p_listings aren't in rules, they won't be loaded from POST parameter
	 */
	public function dummyCheck($attribute,$params) {
		return true;
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        return array(
                'p_whitelabel' => array(self::BELONGS_TO, 'WhiteLabel', 'wlabel_id'),
                'p_advertiser' => array(self::BELONGS_TO, 'Advertiser', 'advertiser_id'),
                'p_categories' => array(self::HAS_MANY, 'Category', 'premiumad_id'),
                'p_locations' => array(self::HAS_MANY, 'Location', 'premiumad_id'),
                'p_listings' => array(self::HAS_MANY, 'Listing', 'premiumad_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'premiumad_id' => 'Premiumad',
			'advertiser_id' => 'Advertiser',
			'wlabel_id' => 'Wlabel',
			'headline' => 'Headline',
			'description' => 'Description',
			'image' => 'Image',
			'link_text' => 'Link Text',
			'link_url' => 'Link Url',
			'position' => 'Position',
			'display_type' => 'Display Type',
			'show_on_static' => 'Show On Static Page',
			'p_locations' => 'Locations',
			'p_categories' => 'Categories',
			'p_listings' => 'Listings',
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
	
	function afterFind()
	{
		$this->_oldImage = $this->image;
		return parent::afterFind();
	}

	function beforeSave()
	{
		if (!$this->image) {
			$this->image = $this->_oldImage;
		}

		if($this->isNewRecord) {
			if(!PlanRestriction::allowsNew(PlanResourceType::RTYPE_PREMIUMAD_PER_ADVERTISER, $this->advertiser_id)) {
				throw new CHttpException(1234, "Cannot add new Premium Ad. You need to buy a plan that will allows you to add new Premium Ad!");
			}
		}
		
		return parent::beforeSave();
	}
	
	function beforeDelete() {
		$criteria=new CDbCriteria;
		$criteria->condition='premiumad_id=:premiumad_id';
		$criteria->params=array(':premiumad_id'=>$this->premiumad_id);
		
		PremiumAdCategory::model()->deleteAll($criteria);

		PremiumAdLocation::model()->deleteAll($criteria);					

		PremiumAdListing::model()->deleteAll($criteria);
		
		// delete image file
		if($this->image != '') {
			$imageFile = Yii::app()->user->getFullPathToImages(Yii::app()->params['premiumAdImage']).$this->image;
			@unlink($imageFile);
		}
		
		return parent::beforeDelete();
	}
	
	public function loadPremiumAds($premiumAdPosition, $categoryId, $locationId, $listingId) {
		$sql = '';
		
		if($listingId != 0) {
			$sql = "SELECT * FROM p_premiumads". 
					" WHERE wlabel_id =".Yii::app()->user->getWhiteLabelId().
					" AND position=".$premiumAdPosition.
					" AND premiumad_id IN (SELECT premiumad_id FROM p_premiumads_listings WHERE listing_id =".$listingId.")".
					" UNION ";
		}
		
		// find premium ads for category and location
		$sql .= "SELECT * FROM p_premiumads". 
				" WHERE wlabel_id =".Yii::app()->user->getWhiteLabelId().
				" AND position=".$premiumAdPosition;

		if($categoryId != 0) {
			$sql .= " AND premiumad_id IN (SELECT premiumad_id FROM p_premiumads_categories WHERE category_id =".$categoryId.")";
		}

		if($locationId != 0) {
			$sql .= " AND premiumad_id IN (SELECT premiumad_id FROM p_premiumads_locations WHERE location_id =".$locationId.")";
		}

		$sql .= " AND premiumad_id NOT IN (SELECT premiumad_id FROM p_premiumads_listings)";
		
		if($categoryId == 0 && $listingId == 0) {
			$sql .= " AND show_on_static=1";
		}
		
		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();

		return $results;			
		
	}
	
	private function findPremiumAdsThatBelongToListing($premiumAdPosition, $listingId){
		$sql = "SELECT * FROM p_premiumads". 
				" WHERE wlabel_id =".Yii::app()->user->getWhiteLabelId().
				" AND position=".$premiumAdPosition.
				" AND premiumad_id IN (SELECT premiumad_id FROM p_premiumads_listings WHERE listing_id =".$listingId.")";
		
		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();

		return $results;			
	}
	
	public function validate()
	{
		$valid=parent::validate();
		
		// now validate related tables
		if(!isset($_POST['PremiumAd']['p_categories'])) {
			$this->addError('p_categories', 'You have to choose some category!');
			$valid = false;
		}

		if(!isset($_POST['PremiumAd']['p_locations'])) {
			$this->addError('p_locations', 'You have to choose some location!');
			$valid = false;
		}
		
		if (!$this->image && !$this->_oldImage) {
			$this->addError('image', 'Image is required!');
			$valid = false;
		}
		
		return $valid;
	}
	
	public function delete() {
		if($this->wlabel_id != Yii::app()->user->getWhiteLabelId()) {
			return false;
		}
		
		return parent::delete();
	}	
}