<?php

/**
 * This is the model class for table "p_locations".
 *
 * The followings are the available columns in table 'p_locations':
 * @property integer $location_id
 * @property integer $parent_location_id
 * @property integer $wlabel_id
 * @property string $name
 * @property string $logo
 * @property string $header_html
 * @property string $footer_html
 * @property integer $status
 */
class Location extends CActiveRecord
{
	public $_oldLogo = '';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Location the static model class
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
		return 'p_locations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, header_html, footer_html, status, domain', 'required'),
			array('parent_location_id, wlabel_id, status', 'numerical', 'integerOnly'=>true),
			array('parent_location_id', 'belongsToSameWhitelabelAccount'),
			array('domain', 'checkDomainIsUniqueAndCorrect'),
			array('wlabel_id', 'in', 'range'=>array_keys(CHtml::listData(WhiteLabel::model()->findAll(), 'wlabel_id', 'name')), 'allowEmpty'=>false),
			array('name', 'length', 'max'=>255),
			array('logo', 'length', 'max'=>200),
			array('logo', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('location_id, parent_location_id, wlabel_id, domain, name, logo, header_html, footer_html, status', 'safe', 'on'=>'search'),
		);
	}

	public function belongsToSameWhitelabelAccount($attribute,$params) {
		if($this->parent_location_id == 0) {
			// we don't need to check it for location without parent
			return;
		}
		
		$parentLocation = $this->findByPk($this->parent_location_id);
		
		if($parentLocation->wlabel_id != $this->wlabel_id) {
			$this->addError($attribute, 'You cannot define parent location from a different whitelabel account!');	
		}
		
		return false;
	}
	
	public function checkDomainIsUniqueAndCorrect($attribute,$params) {
		$code_entities_match = array('\'',' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','='); 
		$code_entities_replace = array('', '-','-','','','','','','','','','','','','','','','','','','','','','','','',''); 
		$domain = str_replace($code_entities_match, $code_entities_replace, $this->domain);
		
		if($domain != $this->domain) {
			$this->addError($attribute, 'Subdomain contains unallowed characters. It cannot contain spaces or special chars!');
			return false;
		}
		
		// check the domain is unique in the account
		$locs = Location::model()->findAllByAttributes(array('wlabel_id'=>Yii::app()->user->getWhiteLabelId(), 'domain'=>$this->domain));
		if($locs != null) {
			if($this->isNewRecord) {
				$this->addError($attribute, 'There already exists location with the same subdomain!');
				return;
			}
			
			foreach($locs as $loc) {
				if($loc->location_id != $this->location_id) {
					// found other locatioon with the same subdomain
					$this->addError($attribute, 'There already exists location with the same subdomain!');
					return;
				}
			}
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
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'location_id' => 'Location',
			'parent_location_id' => 'Parent Location',
			'wlabel_id' => 'Wlabel',
			'domain' => 'Sub-Domain',
			'name' => 'Name',
			'logo' => 'Logo',
			'header_html' => 'Header Html',
			'footer_html' => 'Footer Html',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		//CArrayDataProvider

		$criteria=new CDbCriteria;

		if(!Yii::app()->user->isSuperadmin()) {
			$criteria->compare('t.wlabel_id',Yii::app()->user->getWhiteLabelId());
		}

		$criteria->order = 't.wlabel_id, t.name ASC';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>100)
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
			if(!PlanRestriction::allowsNew(PlanResourceType::RTYPE_LOCATIONS_PER_ACCOUNT, Yii::app()->user->getAdvertiserId())) {
				throw new CHttpException(1234, "Cannot add new Location. You need to buy a plan that will allows you to add new Location!");
			}
		}
		
		return parent::beforeSave();
	}
	
	function afterSave()
	{
		Yii::app()->cache->flush();
		
		return parent::afterSave();
	}

	public function getLocations($addNone = true) {
		$locations = array();
		
		if($addNone) {
			$locations[0] = 'None';
		}
		
		$conditions = 't.wlabel_id='.Yii::app()->user->getWhiteLabelId();
		
		$results = $this->findAll($conditions);

		$locations = $this->addLocationsToArray($locations, $results, 0, 0);
		
		//print_r("Locations: ");
		//print_r($locations);
		//print_r("END");
		
		return $locations;
	}
	
	private function addLocationsToArray($locations, $results, $parentLocationId, $level) {
	
		foreach($results as $row) {
			if($row->parent_location_id != $parentLocationId) {
				continue;
			}
			
			$prefix = '';
			for($i=0; $i<$level; $i++) {
				$prefix .= '--';
			}
			
			$locations[$row->location_id] = $prefix.' '.$row->name;
			
			// add sublocations of this location
			$locations = $this->addLocationsToArray($locations, $results, $row->location_id, $level+1);
		}
		
		return $locations;
		
	}
	
	public function getApprovedTopLocations() {
		$locations = array();
		
		$criteria = new CDbCriteria;
		$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		$criteria->compare('t.status', GeneralStatus::STATUS_ACTIVE);
		$criteria->compare('t.parent_location_id', '');
		
		$results = $this->findAll($criteria);

		foreach($results as $row) {
			$locations[$row->location_id] = $row;
		}
		
		return $locations;
	}	
	
	
	/**
	 * returns location records for a given parent location
	 */
	public function getFrontendLocations($parentLocationId) {

		// get categories
		$criteria = new CDbCriteria;
		$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		
		if($parentLocationId != '') {
			$criteria->compare('t.parent_location_id', $parentLocationId);
		} else {
			$criteria->addCondition('t.parent_location_id IS NULL');
		}
		
		$criteria->order = 't.name';
		
		$results = $this->findAll($criteria);

		$locations = array();

		foreach($results as $record) {
			$locations[$record->location_id] = $record;
		}
		
		return $results;		
	}	
	
	
	/**
	 * returns location record for a given location id
	 */
	public function getFrontendLocation($locationId) {
		if($locationId == '') {
			return null;
		}
		
		$criteria = new CDbCriteria;
		$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		$criteria->compare('t.location_id', $locationId);
		
		$result = $this->find($criteria);

		return $result;		
	}		
	
	public function verifyDelete() {
		$locationId = $this->location_id;
		
		// check if it has some subcategories
		$locs = $this->findByAttributes(array('parent_location_id'=>$locationId));
		if($locs) {
			throw new CHttpException(400,'You cannot delete location that contains some sublocations!');
		}
		
		$listings = ListingLocation::model()->findByAttributes(array('location_id'=>$locationId));
		if($listings) {
			throw new CHttpException(400,'You cannot delete location that contains some listings!');
		}

		$pads = PremiumAdLocation::model()->findByAttributes(array('location_id'=>$locationId));
		if($pads) {
			throw new CHttpException(400,'You cannot delete location that contains some premium ads!');
		}
		
		return true;
	}	
}