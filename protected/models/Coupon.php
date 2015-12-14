<?php

/**
 * This is the model class for table "p_coupons".
 *
 * The followings are the available columns in table 'p_coupons':
 * @property integer $coupon_id
 * @property integer $listing_id
 * @property integer $wlabel_id
 * @property string $code
 * @property string $headline
 * @property string $description
 * @property string $url_text
 * @property string $url_link
 * @property string $expiration
 * @property string $disclaimer
 * @property string $date_start
 * @property string $date_end
 * @property string $date_expiration
 */
class Coupon extends CActiveRecord
{
	public $redeemed;
	public $redemption_rate;	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Coupon the static model class
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
		return 'p_coupons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, headline, date_start, date_end', 'required'),
			array('listing_id, wlabel_id', 'numerical', 'integerOnly'=>true),
			array('code, url_text, url_link, expiration, disclaimer', 'length', 'max'=>40),
			array('headline', 'length', 'max'=>100),
			array('url_link', 'url'),
			array('description, date_expiration', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('coupon_id, listing_id, wlabel_id, code, headline, description, url_text, url_link, expiration, disclaimer, date_start, date_end, date_expiration', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
                'p_whitelabel' => array(self::BELONGS_TO, 'WhiteLabel', 'wlabel_id'),
                'p_listings' => array(self::BELONGS_TO, 'Listing', 'listing_id'),                
		);
	}

	function beforeSave() {
		if ($this->wlabel_id == '') {
			$this->wlabel_id = Yii::app()->user->getWhiteLabelId();
		}

		return parent::beforeSave();
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'coupon_id' => 'Coupon',
			'listing_id' => 'Listing',
			'wlabel_id' => 'Wlabel',
			'code' => 'Code',
			'headline' => 'Headline',
			'description' => 'Description',
			'url_text' => 'Url Text',
			'url_link' => 'Url Link',
			'expiration' => 'Expiration',
			'disclaimer' => 'Disclaimer',
			'date_start' => 'Date Start',
			'date_end' => 'Date End',
			'date_expiration' => 'Date Expiration',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($dateFrom, $dateTo)
	{
		$criteria = new CDbCriteria;

		$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		
		$results = $this->findAll($criteria);
		
		$rawData = array();

		$couponIds = array();
		foreach($results as $row) {
			$couponIds[] = $row->coupon_id;
		}

		if(count($couponIds) > 0) {
			$statsData = $this->getStatsData($couponIds, $dateFrom, $dateTo);
		}

		foreach($results as $row) {
			$row->redeemed = $statsData[$row->coupon_id]['redeemed'];
			$row->redemption_rate = $statsData[$row->coupon_id]['redemption_rate'];
			$rawData[] = $row;
			
		}

		$dataProvider=new CArrayDataProvider($rawData, array(
			    'id'=>'coupon',
			    'keys'=>array('coupon_id', 'headline'), 
			));

		return $dataProvider;		
	}
	
	public function getStatsData($couponIds, $dateFrom, $dateTo) {
				
		$couponStats = $this->getSummaryStats( $couponIds, $dateFrom, $dateTo);
		$redemptionStats = $this->getRedemptionStats( $couponIds, $dateFrom, $dateTo);
		
		$results = array();
		foreach($couponIds as $id) {
			$results[$id]['redeemed'] = $redemptionStats[$id];
			$results[$id]['redemption_rate'] = (100*ViewsStats::safeDivide($redemptionStats[$id], $couponStats[$id])).' %';
		}
		return $results;
	}
	
	public function getSummaryStats($couponIds, $dateFrom, $dateTo) {
		$sql = "SELECT coupon_id, sum(views) as views FROM p_view_coupons". 
				" WHERE date_created>='$dateFrom' AND date_created<='$dateTo'";
		
		if(Yii::app()->user->isAdvertiser()) {
			$sql .= " AND advertiser_id=".Yii::app()->user->getAdvertiserId();
		}

		if(count($couponIds)>0) {
			$sql .= " AND coupon_id in (".implode(',', $couponIds).")";
		}

		$sql .= " GROUP BY coupon_id";
		
		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();
		
		$data = array();
		foreach($results as $result) {
			$data[$result['coupon_id']] = $result['views'];
		}
		
		foreach($couponIds as $id) {
			if(!isset($data[$id])) {
				$data[$id] = 0;
			}
		}

		return $data;
	}
	
	public function getRedemptionStats($couponIds, $dateFrom, $dateTo) {
		$sql = "SELECT coupon_id, count(credemption_id) as redemptions FROM p_coupons_redemptions". 
				" WHERE date_created>='$dateFrom' AND date_created<='$dateTo'";

		if(count($couponIds)>0) {
			$sql .= " AND coupon_id in (".implode(',', $couponIds).")";
		}

		$sql .= " GROUP BY coupon_id";

		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();
		
		$data = array();
		foreach($results as $result) {
			$data[$result['coupon_id']] = $result['redemptions'];
		}
		
		foreach($couponIds as $id) {
			if(!isset($data[$id])) {
				$data[$id] = 0;
			}
		}

		return $data;
	}

	public function getAllCouponsForListing($listingId) {
		$criteria = new CDbCriteria;
		$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		$criteria->compare('t.listing_id', $listingId);

		return $this->findAll($criteria);
	}
	
	public function getFrontendCouponsForListing($listingId) {
		return $this->getAllCouponsForListing($listingId);
	}
	
	public function getFrontendCoupon($couponId) {
		if($couponId == '') {
			return null;
		}

		$criteria = new CDbCriteria;
		$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		$criteria->compare('t.coupon_id', $couponId);
		
		return $this->find($criteria);
	}
	
	public function getCouponsByType($couponType) {
		// get coupons by type
		// and by listing - listing must belong to chosen location
		
		$sql = "SELECT c.coupon_id, c.headline, c.description, c.date_start, c.date_end, l.name, l.type".
				" FROM p_coupons c".
				" LEFT JOIN p_listings l ON c.listing_id = l.listing_id".
				" WHERE l.listing_id IN (SELECT listing_id FROM p_listings_locations WHERE location_id=".Yii::app()->user->getLocationId().")".
				" AND c.wlabel_id=".Yii::app()->user->getWhiteLabelId().
				" AND c.date_end>='".date("Y-m-d 00:00:00")."'";
				
		if($couponType == CouponType::TYPE_NEW) {
			$sql .= " ORDER BY date_start DESC";
		} else if($couponType == CouponType::TYPE_ENDING) {
			$sql .= " ORDER BY date_end ASC";
		}
				
		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();

		$featured = array();
		$standard = array();
		
		foreach($results as $result) {
			if($result['type'] == ListingType::TYPE_FEATURED) {
				$featured[] = $result;
			} else {
				$standard[] = $result;
			}
		}
		
		return array('featured'=>$featured, 'standard'=>$standard);			
	}
	
}