<?php

/**
 * This is the model class for table "p_categories".
 *
 * The followings are the available columns in table 'p_categories':
 * @property integer $category_id
 * @property integer $parent_category_id
 * @property integer $wlabel_id
 * @property string $name
 * @property string $domain
 * @property integer $sort_order
 */
class Category extends CActiveRecord
{
	public $listingsCount = 0;
	public $_oldIcon = '';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Category the static model class
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
		return 'p_categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wlabel_id, name', 'required'),
			array('wlabel_id', 'in', 'range'=>array_keys(CHtml::listData(WhiteLabel::model()->findAll(), 'wlabel_id', 'name')), 'allowEmpty'=>false),
			array('parent_category_id, wlabel_id, sort_order', 'numerical', 'integerOnly'=>true),
			array('parent_category_id', 'belongsToSameWhitelabelAccount'),
			array('name, domain', 'length', 'max'=>100),
			array('icon', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('category_id, parent_category_id, wlabel_id, name, domain, sort_order', 'safe', 'on'=>'search'),
		);
	}

	public function belongsToSameWhitelabelAccount($attribute,$params) {
		if($this->parent_category_id == '') {
			// we don't need to check it for category without parent
			return;
		}
		
		$parentCategory = $this->findByPk($this->parent_category_id);
		
		if($parentCategory->wlabel_id != $this->wlabel_id) {
			$this->addError($attribute, 'You cannot define parent category from a different whitelabel account!');	
		}
		
		return false;
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
			'category_id' => 'Category',
			'parent_category_id' => 'Parent Category',
			'wlabel_id' => 'Whitelabel Account',
			'name' => 'Name',
			'icon' => 'Icon',
			'domain' => 'Domain Name',
			'sort_order' => 'Sort Order',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($openCategoryId)
	{
		$criteria = new CDbCriteria;
		$criteria->compare('t.parent_category_id', '');
		
		$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());

		$criteria->order = 't.wlabel_id, t.sort_order';
		
		$results = $this->findAll($criteria);
		
		$rawData = array();

		foreach($results as $row) {
			if($row->parent_category_id != '') {
				continue;
			}
			
			$rawData[] = $row;
			
			// now add its subcategories
			foreach($results as $subRow) {
				if($openCategoryId == $row->category_id && $subRow->parent_category_id == $row->category_id) {
					$subRow->name = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$subRow->name;
					$rawData[] = $subRow;
				}
			}
		}

		$dataProvider=new CArrayDataProvider($rawData, array(
			    'id'=>'category',
			    'keys'=>array('cateory_id', 'parent_category_id', 'wlaccount_id','name','icon','sort_order'), 
			    'pagination'=>array(
			        'pageSize'=>500,
			    ),
			));

		return $dataProvider;
	}
	
	function afterFind()
	{
		$this->_oldIcon = $this->icon;
		return parent::afterFind();
	}

	function beforeSave()
	{
		if (!$this->icon) {
			$this->icon = $this->_oldIcon;
		}

		return parent::beforeSave();
	}
	
	public function findTopCategories($condition='') {
		$categories = array();
		$categories[0] = 'None';
		
		$conditions = '(t.parent_category_id is null or t.parent_category_id = 0)';

		if(!Yii::app()->user->isSuperadmin()) {
			$conditions .= ' AND t.wlabel_id='.Yii::app()->user->getWhiteLabelId();
		}
		
		$results = $this->findAll($conditions);

		foreach($results as $row) {
			$categories[$row->category_id] = $row->name;
		}
		
		//print_r("Locations: ");
		//print_r($locations);
		//print_r("END");
		
		return $categories;
	}	
	
	public $maxSortOrder;
	
	public function getNextSortOrder($parentCategoryId, $wlAccountId) {
		$criteria=new CDbCriteria;

		$criteria->select = 'max(sort_order) AS maxSortOrder';
		$criteria->compare('t.wlabel_id',$wlAccountId);
		$criteria->compare('t.parent_category_id',$parentCategoryId);

		$row = $this->find($criteria);

		return $row['maxSortOrder']+1;
	}
	
	public function moveCategory($categoryId, $moveDirection) {
		//print_r("MOVING");
		if($categoryId == '') {
			return false;
		}
		
		if($moveDirection != 'up' && $moveDirection != 'down') {
			return false;
		}
		
		// get actual sort_order of category
		$currentCategory = $this->findByPk($categoryId);
		
		if(!Yii::app()->user->isSuperadmin() && $currentCategory->wlabel_id != Yii::app()->user->getWhiteLabelId()) {
			// someone tried ID from different whitelabel account
			return false;
		}
		
		// depending on direction, get closest higher or lower sort_order number and corresponding category
		$closestCategory = $this->getClosestCategory($currentCategory, $moveDirection);
		if($closestCategory == null) {
			return false;
		}
		//print_r("Current: ".$currentCategory->category_id.", sort: ".$currentCategory->sort_order);
		//print_r("   |   ClosestID: ".$closestCategory->category_id.', sort: '.$closestCategory->sort_order);
		
		// switch these two numbers
		$temp = $closestCategory->sort_order;
		$closestCategory->sort_order = $currentCategory->sort_order;
		$closestCategory->save();
		
		$currentCategory->sort_order = $temp;
		$currentCategory->save();
		
		return true;
	}
	
	private function getClosestCategory($currentCategory, $moveDirection) {
		if($currentCategory == null) {
			return null;
		}
		
		if($currentCategory->sort_order == 1 && $moveDirection == 'up') {
			//return null;
		}
		
		$criteria=new CDbCriteria;

		if($moveDirection == 'up') {
			// up
			$criteria->select = 'max(sort_order) AS maxSortOrder';
			$criteria->compare('t.sort_order', '<'.$currentCategory->sort_order);
		} else { 
			// down
			$criteria->select = 'min(sort_order) AS maxSortOrder';
			$criteria->compare('t.sort_order', '>'.$currentCategory->sort_order);
		}

		$criteria->compare('t.wlabel_id',$currentCategory->wlabel_id);
		
		if($currentCategory->parent_category_id != '') {
			$criteria->compare('t.parent_category_id',$currentCategory->parent_category_id);
		} else {
			$criteria->addCondition('t.parent_category_id IS NULL');
		}

		$closestSortOrder = $this->find($criteria);
		
		if($closestSortOrder == null || $closestSortOrder['maxSortOrder'] == '') {
			return null;
		}
		
		// now find record with this sort order
		$criteria = new CDbCriteria;
		$criteria->compare('t.wlabel_id',$currentCategory->wlabel_id);
		$criteria->compare('t.parent_category_id',$currentCategory->parent_category_id);
		$criteria->compare('t.sort_order', $closestSortOrder['maxSortOrder']);
		
		$result = $this->find($criteria);
		
		return $result;
	}
	
	public function getCategories($addNone = true) {
		$categories = array();

		if($addNone) {
			$categories[0] = 'None';
		}

		$conditions = 't.wlabel_id='.Yii::app()->user->getWhiteLabelId();

		$results = $this->findAll($conditions);

		$categories = $this->addCategoriesToArray($categories, $results, 0, 0);

		//print_r("Locations: ");
		//print_r($categories);
		//print_r("END");

		return $categories;
	}

	private function addCategoriesToArray($categories, $results, $parentCategoryId, $level) {

		foreach($results as $row) {
			if($row->parent_category_id != $parentCategoryId) {
				continue;
			}

			$prefix = '';
			for($i=0; $i<$level; $i++) {
				$prefix .= '--';
			}

			$categories[$row->category_id] = $prefix . ' ' . $row->name;

			// add subcategories of this category
			$categories = $this->addCategoriesToArray($categories, $results, $row->category_id, $level+1);
		}

		return $categories;
	}
	
	/**
	 * returns categories records for a given location
	 */
	public function getFrontendCategories($parentCategoryId) {

		// get all categories
		$criteria = new CDbCriteria;
		$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
//		$criteria->compare('t.parent_category_id', $parentCategoryId);
		$criteria->order = 't.sort_order';
		
		$results = $this->findAll($criteria);

		$categories = array();
		$categoriesArray = array();

		foreach($results as $record) {
			$categories[$record->category_id] = $record;
		}
		
		// get # of listings for the categories
		$listingCounts = Listing::model()->getListingCountForCategoriesAndLocation($categories);
		foreach($listingCounts as $categoryId => $count) {
			$categories[$categoryId]->listingsCount = $count;
		}
	
		// now go through the categories and choose only these thathave the correct parent
		$resultCategories = array();
		
		foreach($results as $record) {
			if($record->parent_category_id == $parentCategoryId) {
				$resultCategories[] = $record;
			}
			
			// update the listing count of parent category
			if($record->parent_category_id != '') {
				$categories[$record->parent_category_id]->listingsCount += $record->listingsCount;
			}
		}
		
		return $resultCategories;		
	}
	
	public function delete() {
		if($this->wlabel_id != Yii::app()->user->getWhiteLabelId()) {
			return false;
		}
		
		return parent::delete();
	}	
	
	public function isParentCategory($categoryId) {
		if($categoryId == '' || $categoryId == 0) {
			return true;
		}
		
		$category = $this->findByPk($categoryId);
		if($category) {
			return ($category->parent_category_id == '' ? true : false);
		}
		
		return true;
	}
	
	public function verifyDelete() {
		$categoryId = $this->category_id;
		
		// check if it has some subcategories
		$categs = $this->findByAttributes(array('parent_category_id'=>$categoryId));
		if($categs) {
			throw new CHttpException(400,'You cannot delete category that contains some subcategories!');
		}
		
		$listings = ListingCategory::model()->findByAttributes(array('category_id'=>$categoryId));
		if($listings) {
			throw new CHttpException(400,'You cannot delete category that contains some listings!');
		}

		$pads = PremiumAdCategory::model()->findByAttributes(array('category_id'=>$categoryId));
		if($pads) {
			throw new CHttpException(400,'You cannot delete category that contains some premium ads!');
		}
		
		return true;
	}
}