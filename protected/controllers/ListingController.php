<?php

class ListingController extends Controller
{
	public $layout = "listing_layout";

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('index', 'map', 'coupon'),
						'users'=>array('*'),
					),

				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('coupon_activate', 'coupon_activated'),
						'users'=>array('@'),
//						'roles'=>array(UserType::TYPE_CUSTOMER),
					),
				array('deny',  // deny all users
						'users'=>array('*'),
					),
		);
	}
	
	public function actionCoupon_activate($id)
	{
		if($this->userHasRedeemedCoupon($id)) {
			$this->render('coupon_already_redeemed');
			return;
		}
		
		$this->layout = "main";

		$model=new CouponRedemption;
		$customer = Customer::model()->findByPk(Yii::app()->user->getId());
		if($customer == null) {
			throw new CHttpException(400,'Invalid request. No customer found!');
		}
		
		$model->phone = $customer->mobile;
		
		if(isset($_POST['CouponRedemption']))
		{
			$model->attributes=$_POST['CouponRedemption'];
			$model->date_created = date("Y-m-d h:i:s");
			
			if($model->save()) {
				$this->redirect(array('listing/coupon_activated', 'id'=>$model->credemption_id));
			}
		}

		if(isset($_GET['CouponRedemption']))
			$model->attributes=$_GET['CouponRedemption'];

		$model->coupon_id = $id;
		$this->render('coupon_activate',array(
				'model'=>$model,
				));
	}
	
	public function actionCoupon_activated($id)
	{
		$couponRedemption = CouponRedemption::model()->findByAttributes(array('credemption_id'=>$id, 'customer_id'=>Yii::app()->user->getId()));
		if($couponRedemption == null) {
			throw new CHttpException(400,'Invalid request. No redeemed coupon found!');
		}
		
		$coupon = Coupon::model()->getFrontendCoupon($couponRedemption->coupon_id);
	
		Yii::app()->user->setLastCouponId($id);
	
		$listing = Listing::model()->getFrontendListing($coupon->listing_id);
	
		$this->render('coupon_activated', array('coupon'=>$coupon, 'listing' => $listing, 'listingId'=>$listing->listing_id));
	}

	/**
	 * returns true if coupon was already redeemed by this customer
	 */
	private function userHasRedeemedCoupon($couponId) {
		$customerId = Yii::app()->user->getId();
		
		$cr = CouponRedemption::model()->findByAttributes( array('customer_id'=>$customerId, 'coupon_id'=>$couponId) );
		
		return ($cr != null ? true : false);
	}
	
	public function actionIndex($id = '')
	{
		$listing = $this->getListingOrRenderError($id);
		if($listing == null) {
			return;
		}
		
		$coupons = Coupon::model()->getFrontendCouponsForListing($listing->listing_id);
		
		Yii::app()->user->setListingId($listing->listing_id);
		
		ViewsTrack::addListingView($id);
		
		// render normal listing
		$this->render('index', array('listing' => $listing, 'listingId'=>$listing->listing_id, 'coupons'=>$coupons));
	}
	
	public function actionMap($id) {
		$listing = $this->getListingOrRenderError($id);
		if($listing == null) {
			return;
		}
		
		// render normal listing
		$this->render('map', array('listing' => $listing, 'listingId'=>$listing->listing_id));
	}

	public function actionCoupon($id = '') {
		$id = $this->checkCorrectness($id);
		if($id != 0) {
			$coupon = Coupon::model()->getFrontendCoupon($id);
		} else {
			$coupon = null;
		}

		if($coupon == null) {
			$this->render('missing_coupon');
			return null;
		}
		
		Yii::app()->user->setLastCouponId($id);
		
		ViewsTrack::addCouponView($id);
		
		$listing = Listing::model()->getFrontendListing($coupon->listing_id);
		
		// render normal listing
		$this->render('coupon_detail', array('coupon'=>$coupon, 'listing' => $listing, 'listingId'=>$listing->listing_id));
	}

	private function checkCorrectness($id) {
		return $id;
	}

	private function getListingOrRenderError($id) {
		$id = $this->checkCorrectness($id);
		if($id != 0) {
			$listing = Listing::model()->getFrontendListing($id);
		} else {
			$listing = null;
		}

		if($id == 0 || $listing == null) {
			$this->render('missing_listing');
			return null;
		}
		
		return $listing;
	}
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}