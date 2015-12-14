<?php

/**
 * This is the model class for table "p_whitelabel".
 *
 * The followings are the available columns in table 'p_whitelabel':
 * @property integer $wlabel_id
 * @property string $name
 * @property string $domain
 * @property integer $status
 * @property string $site_area
 * @property string $site_title
 * @property string $site_keywords
 * @property string $site_desc
 * @property integer $show_listing_from_all
 * @property integer $moderate_members
 * @property integer $moderate_mediabrokers
 * @property integer $premiumad_priority
 * @property string $site_terms
 * @property string $site_testimonial
 * @property string $site_welcome
 * @property string $site_dailydeals
 * @property string $site_mostpopular
 * @property string $contact_email
 * @property integer $payment_type
 * @property string $paypal_email
 * @property string $auth_api_id
 * @property string $auth_trans_key
 * @property string $news_price
 * @property string $banner_price
 * @property integer $premiumad_display_type
 *
 * The followings are the available model relations:
 * @property PAdvertisers[] $pAdvertisers
 * @property PAutoresponders[] $pAutoresponders
 * @property PCategories[] $pCategories
 * @property PCoupons[] $pCoupons
 * @property PListings[] $pListings
 * @property PLocations[] $pLocations
 * @property PPlans[] $pPlans
 * @property PPremiumads[] $pPremiumads
 * @property PPurchasedPlans[] $pPurchasedPlans
 * @property PUsers[] $pUsers
 */
class WhiteLabel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return WhiteLabel the static model class
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
		return 'p_whitelabel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
				array('name, domain, site_area, site_title, premiumad_priority, contact_email, payment_type, premiumad_display_type, mb_commission, mb_commission_type', 'required'),
				array('status, show_listing_from_all, moderate_members, moderate_mediabrokers, premiumad_priority, payment_type, premiumad_display_type', 'numerical', 'integerOnly'=>true),
				array('name, auth_trans_key', 'length', 'max'=>40),
				array('domain', 'length', 'max'=>150),
				array('domain', 'checkDomainIsUniqueAndCorrect'),
				array('site_area, site_title, contact_email, paypal_email, auth_api_id', 'length', 'max'=>250),
				array('news_price, banner_price', 'length', 'max'=>10),
				array('site_keywords, site_desc, site_terms, site_testimonial, site_welcome, site_dailydeals, site_mostpopular', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('wlabel_id, name, domain, status, site_area, site_title, site_keywords, site_desc, show_listing_from_all, moderate_members, moderate_mediabrokers, premiumad_priority, site_terms, site_testimonial, site_welcome, site_dailydeals, site_mostpopular, contact_email, payment_type, paypal_email, auth_api_id, auth_trans_key, news_price, banner_price, premiumad_display_type', 'safe', 'on'=>'search'),
			);
	}

	public function checkDomainIsUniqueAndCorrect($attribute,$params) {
		$domain = htmlspecialchars($this->domain);
		if($domain != $this->domain) {
			$this->addError($attribute, 'Domain contains unallowed characters. It cannot contain spaces or special chars!');
			return false;
		}
		
		if(strpos($this->domain, "www") !== false) {
			$this->addError($attribute, 'Domain cannot contain the www part. Use it in the for yourdomain.com, not www.yourdomain.com!');
			return false;
		}
		
		if(strpos($this->domain, ".") === 0) {
			$this->addError($attribute, 'Domain cannot begin with a dot. Use it in the for yourdomain.com, not .yourdomain.com!');
			return false;
		}

		// check the domain is unique
		$wls = WhiteLabel::model()->findAllByAttributes(array('domain'=>$this->domain));
		if($wls != null) {
			if($this->isNewRecord) {
				$this->addError($attribute, 'There already exists account with the same domain!');
				return;
			}
			
			foreach($wls as $wl) {
				if($wl->wlabel_id != $this->wlabel_id) {
					// found other locatioon with the same subdomain
					$this->addError($attribute, 'There already exists account with the same domain!');
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
				'p_advertisers' => array(self::HAS_MANY, 'Advertiser', 'wlabel_id'),
				'p_autoresponders' => array(self::HAS_MANY, 'Autoresponder', 'wlabel_id'),
				'p_categories' => array(self::HAS_MANY, 'Category', 'wlabel_id'),
				'p_coupons' => array(self::HAS_MANY, 'Coupon', 'wlabel_id'),
				'p_listings' => array(self::HAS_MANY, 'Listing', 'wlabel_id'),
				'p_locations' => array(self::HAS_MANY, 'Location', 'wlabel_id'),
				'p_plans' => array(self::HAS_MANY, 'Plan', 'wlabel_id'),
				'p_premiumads' => array(self::HAS_MANY, 'Premiumad', 'wlabel_id'),
				'p_purchased_lans' => array(self::HAS_MANY, 'PurchasedPlan', 'wlabel_id'),
				'p_uUsers' => array(self::HAS_MANY, 'User', 'wlabel_id'),
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'wlabel_id' => 'ID',
				'name' => 'Name',
				'domain' => 'Domain',
				'status' => 'Status',
				'site_area' => 'Site Area',
				'site_title' => 'Site Title',
				'site_keywords' => 'Site Keywords',
				'site_desc' => 'Site Desc',
				'show_listing_from_all' => 'Show Listing From All',
				'moderate_members' => 'Moderate Members',
				'moderate_mediabrokers' => 'Moderate Mediabrokers',
				'premiumad_priority' => 'Premiumad Priority',
				'site_terms' => 'Site Terms',
				'site_testimonial' => 'Site Testimonial',
				'site_welcome' => 'Site Welcome',
				'site_dailydeals' => 'Site Dailydeals',
				'site_mostpopular' => 'Site Mostpopular',
				'contact_email' => 'Contact Email',
				'payment_type' => 'Payment Type',
				'paypal_email' => 'Paypal Email',
				'auth_api_id' => 'Auth Api',
				'auth_trans_key' => 'Auth Trans Key',
				'news_price' => 'News Price',
				'banner_price' => 'Banner Price',
				'premiumad_display_type' => 'Premiumad Display Type',
				'mb_commission' => 'Commission Amount',
				'mb_commission_type' => 'Media Broker Commission Type',
				
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

		$criteria->compare('wlabel_id',$this->wlabel_id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function findRealAccounts($condition='') {
		$accounts = array();
		
		$conditions = 't.wlabel_id<>1';
		
		$results = $this->findAll($conditions);

		foreach($results as $row) {
			$accounts[$row->wlabel_id] = $row->name;
		}
		
		//print_r("Locations: ");
		//print_r($locations);
		//print_r("END");
		
		return $accounts;
	}	
	
	public function findRealAccountsAsRecords() {
		$accounts = array();
		
		$conditions = 't.wlabel_id<>1';
		
		return $this->findAll($conditions);
	}	
	
	public function getDomain() {
		$wl = WhiteLabel::model()->findByPk(Yii::app()->user->getWhiteLabelId());
		
		if($wl != null) {
			return $wl->domain;
		}
		return '';
	}
	
	function afterSave()
	{
		if($this->isNewRecord) {
			// insert 3 autoresponder records
			for($i=1; $i<=3; $i++) {

				$ar = new Autoresponder;
				$ar->wlabel_id = $this->wlabel_id;
				$ar->type = $i;
				$ar->subject = ' ';
				$ar->message = ' ';
				
				$ar->save();
			}
		}
		
		Yii::app()->cache->flush();
		
		return parent::afterSave();
	}	
	
	function beforeDelete() {
		$criteria=new CDbCriteria;
		$criteria->condition='wlabel_id=:wlabel_id';
		$criteria->params=array(':wlabel_id'=>$this->wlabel_id);
		
		Autoresponder::model()->deleteAll($criteria);

		return parent::beforeDelete();
	}	
}