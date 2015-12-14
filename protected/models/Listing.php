<?php

/**
 * This is the model class for table "p_listings".
 *
 * The followings are the available columns in table 'p_listings':
 * @property integer $listing_id
 * @property integer $wlabel_id
 * @property integer $advertiser_id
 * @property string $url
 * @property string $name
 * @property string $street_address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $phone
 * @property string $description
 * @property string $logo
 * @property integer $type
 * @property string $date_created
 * @property string $mon_open
 * @property string $mon_close
 * @property string $tue_open
 * @property string $tue_close
 * @property string $wed_open
 * @property string $wed_close
 * @property string $thu_open
 * @property string $thu_close
 * @property string $fri_open
 * @property string $fri_close
 * @property string $sat_open
 * @property string $sat_close
 * @property string $sun_open
 * @property string $sun_close
 */
class Listing extends CActiveRecord
{
	public $_oldLogo = '';
	public $addressForMap = '';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Listing the static model class
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
		return 'p_listings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('advertiser_id, url, name, street_address, city, state, zip, phone, date_created', 'required'),
			array('wlabel_id, advertiser_id, type', 'numerical', 'integerOnly'=>true),
			array('wlabel_id', 'in', 'range'=>array_keys(CHtml::listData(WhiteLabel::model()->findAll(), 'wlabel_id', 'name')), 'allowEmpty'=>false),
			array('advertiser_id', 'in', 'range'=>array_keys(CHtml::listData(Advertiser::model()->findAll(), 'advertiser_id', 'user_id')), 'allowEmpty'=>false),
			array('url, name, street_address', 'length', 'max'=>100),
			array('city, state, zip, phone, logo, mon_open, mon_close, tue_open, tue_close, wed_open, wed_close, thu_open, thu_close, fri_open, fri_close, sat_open, sat_close, sun_open, sun_close', 'length', 'max'=>40),
			array('description', 'safe'),
			array('url', 'url'),
			array('logo', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true),
			array('p_categories', 'verifyNumberOfCategories'),
			array('p_locations', 'verifyNumberOfLocations'),
			array('p_coupons', 'verifyNumberOfCoupons'),
			array('type', 'verifyNumberOfFeaturedListings'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('listing_id, wlabel_id, advertiser_id, url, name, street_address, city, state, zip, phone, description, logo, type, date_created, mon_open, mon_close, tue_open, tue_close, wed_open, wed_close, thu_open, thu_close, fri_open, fri_close, sat_open, sat_close, sun_open, sun_close', 'safe', 'on'=>'search'),
		);
	}

	public function verifyNumberOfCategories($attribute,$params) {
		if(isset($_POST['Listing']['p_categories'])) {
			$count = count($_POST['Listing']['p_categories']);
		} else {
			$count = 0;
		}

		$allowedCount = PlanRestriction::getAllowedCount(PlanResourceType::RTYPE_CATEGORIES_PER_LISTING, $this->advertiser_id);
		
		if($allowedCount == 0) {
			$this->addError($attribute, 'This advertiser does not have any plan defined!');
			return false;
		} else if($allowedCount > 0 && $count > $allowedCount) {
			$this->addError($attribute, 'Your plan allows you to put your listing to maximum '.$allowedCount.' categories!');
			return false;
		}
		
		return true;
	}
	
	public function verifyNumberOfLocations($attribute,$params) {
		if(isset($_POST['Listing']['p_locations'])) {
			$count = count($_POST['Listing']['p_locations']);
		} else {
			$count = 0;
		}

		$allowedCount = PlanRestriction::getAllowedCount(PlanResourceType::RTYPE_LOCATIONS_PER_LISTING, $this->advertiser_id);
		
		if($allowedCount == 0) {
			$this->addError($attribute, 'This advertiser does not have any plan defined!');
			return false;
		} else if($allowedCount > 0 && $count > $allowedCount) {
			$this->addError($attribute, 'Your plan allows you to put your listing to maximum '.$allowedCount.' locations!');
			return false;
		}
		
		return true;
	}

	public function verifyNumberOfCoupons($attribute,$params) {
		if(isset($_POST['Coupon'])) {
			$count = count($_POST['Coupon']);
		} else {
			$count = 0;
		}

		$allowedCount = PlanRestriction::getAllowedCount(PlanResourceType::RTYPE_LOCATIONS_PER_LISTING, $this->advertiser_id);
		
		if($allowedCount == 0) {
			$this->addError($attribute, 'This advertiser does not have any plan defined!');
			return false;
		} else if($allowedCount > 0 && $count > $allowedCount) {
			$this->addError($attribute, 'Your plan allows you to put maximum '.$allowedCount.' coupons to your listing!');
			return false;
		}
		
		return true;
	}

	public function verifyNumberOfFeaturedListings($attribute,$params) {
		if($this->type != ListingType::TYPE_FEATURED) {
			return true;
		}
		
		if(!PlanRestriction::allowsNew(PlanResourceType::RTYPE_FEATURED_LISTINGS_PER_ADVERTISER, $this->advertiser_id)) {
			$this->addError($attribute, 'You cannot create new featured listings!');
			return false;
		}
		
		return true;
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        return array(
                'p_whitelabel' => array(self::BELONGS_TO, 'WhiteLabel', 'wlabel_id'),
                'p_advertisers' => array(self::BELONGS_TO, 'Advertiser', 'advertiser_id'),
                'p_categories' => array(self::HAS_MANY, 'Category', 'listing_id'),
                'p_locations' => array(self::HAS_MANY, 'Location', 'listing_id'),
                'p_coupons' => array(self::HAS_MANY, 'Coupon', 'listing_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'listing_id' => 'Listing',
			'wlabel_id' => 'Whitelabel Account',
			'advertiser_id' => 'Advertiser',
			'url' => 'Website Url',
			'name' => 'Name',
			'street_address' => 'Street Address',
			'city' => 'City',
			'state' => 'State',
			'zip' => 'Zip',
			'phone' => 'Phone',
			'description' => 'Description',
			'logo' => 'Logo',
			'type' => 'Listing Type',
			'date_created' => 'Date Created',
			'mon_open' => 'Mon Open',
			'mon_close' => 'Mon Close',
			'tue_open' => 'Tue Open',
			'tue_close' => 'Tue Close',
			'wed_open' => 'Wed Open',
			'wed_close' => 'Wed Close',
			'thu_open' => 'Thu Open',
			'thu_close' => 'Thu Close',
			'fri_open' => 'Fri Open',
			'fri_close' => 'Fri Close',
			'sat_open' => 'Sat Open',
			'sat_close' => 'Sat Close',
			'sun_open' => 'Sun Open',
			'sun_close' => 'Sun Close',
			'p_categories' => 'Categories',
			'p_locations' => 'Locations',
			
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
		$this->_oldLogo = $this->logo;
		return parent::afterFind();
	}

	function beforeSave()
	{
		if (!$this->logo) {
			$this->logo = $this->_oldLogo;
		}

		if($this->isNewRecord) {
			if($this->type == ListingType::TYPE_STANDARD) {
				if(!PlanRestriction::allowsNew(PlanResourceType::RTYPE_LISTINGS_PER_ADVERTISER, $this->advertiser_id)) {
					throw new CHttpException(1234, "Cannot add new listing. You need to buy a plan that will allows you to add new listings!");
				}
			} else if($this->type == ListingType::TYPE_FEATURED) {
				if(!PlanRestriction::allowsNew(PlanResourceType::RTYPE_FEATURED_LISTINGS_PER_ADVERTISER, $this->advertiser_id)) {
					throw new CHttpException(1234, "Cannot add new listing. You need to buy a plan that will allows you to add new listings!");
				}
			}
		}
		
		return parent::beforeSave();
	}

	function beforeDelete() {
		$criteria=new CDbCriteria;
		$criteria->condition='listing_id=:listing_id';
		$criteria->params=array(':listing_id'=>$this->listing_id);

		ListingCategory::model()->deleteAll($criteria);

		ListingLocation::model()->deleteAll($criteria);

		Coupon::model()->deleteAll($criteria);
		
		// delete logo file
		if($this->logo != '') {
			$imageFile = Yii::app()->user->getFullPathToImages(Yii::app()->params['listingLogo']).$this->logo;
			@unlink($imageFile);
		}

		return parent::beforeDelete();
	}	
	
	public function getType($type) {
		return ListingType::getType($type);
	}	
	
	public function getListings() {
		$conditions = 't.wlabel_id='.Yii::app()->user->getWhiteLabelId();
		
		return $this->findAll($conditions);
	}
	
	public function getListingCountForCategoriesAndLocation($categories) {
		$locationId = Yii::app()->user->getLocationId();
		if($locationId == '') {
			return array();
		}
		
		$strCategories = '';
		foreach($categories as $rec) {
			$strCategories .= ($strCategories != '' ? ',' : '').$rec->category_id;
		}
		if($strCategories == '') {
			return array();
		}
		
		$sql = "SELECT category_id, count( listing_id ) as countL FROM p_listings_categories".
				" WHERE listing_id IN (SELECT listing_id FROM p_listings_locations WHERE location_id=$locationId)".
				" AND category_id IN ( ".$strCategories." )".
				" GROUP BY category_id";

		$dbCommand = Yii::app()->db->createCommand($sql);
		$data = $dbCommand->queryAll();
		
		$listingsCount = array();
		foreach($data as $record) {
			$listingsCount[$record['category_id']] = $record['countL'];
		}
		
		return $listingsCount;
	}
	
	public function getFrontendListings($categoryId) {
		
		$sql = "SELECT * FROM p_listings". 
				" WHERE wlabel_id =".Yii::app()->user->getWhiteLabelId().
				" AND listing_id IN (SELECT listing_id FROM p_listings_categories WHERE category_id =".$categoryId.")".
				" AND listing_id IN (SELECT listing_id FROM p_listings_locations WHERE location_id =".Yii::app()->user->getLocationId().")";
		
		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();

		return $results;		
	}
	
	public function getFrontendListing($listingId) {
		if($listingId == '') {
			return null;
		}

		$criteria = new CDbCriteria;
		$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		$criteria->compare('t.listing_id', $listingId);
		
		$result = $this->find($criteria);

		if($result != null) {
			$result->addressForMap = $result->street_address.', '.$result->city.', '.$result->state;
			$result->addressForMap = str_replace(' ','+',$result->addressForMap);
		}
		
		return $result;		
	}	
	
	public function searchFrontendListings($searchText) {
		$criteria = new CDbCriteria;
		$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		$criteria->compare('name', $searchText, true);
		$criteria->compare('street_address', $searchText, true, 'OR');

		$results = $this->findAll($criteria);
		
		if($results != null) {
			foreach($results as $record) {
				$record->addressForMap = $record->street_address.', '.$record->city.', '.$record->state;
				$record->addressForMap = str_replace(' ','+',$record->addressForMap);
			}
		}

		return $results;		
	}
	
	public function validate()
	{
		$valid=parent::validate();
		
		// now validate related tables
		if(!isset($_POST['Listing']['p_categories'])) {
			$this->addError('p_categories', 'You have to choose some category!');
			$valid = false;
		}

		if(!isset($_POST['Listing']['p_locations'])) {
			$this->addError('p_locations', 'You have to choose some location!');
			$valid = false;
		}
		
		if (!$this->logo && !$this->_oldLogo) {
			$this->addError('logo', 'Logo is required!');
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