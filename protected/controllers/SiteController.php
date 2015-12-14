<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionNew()
	{
		$this->processNewEndingFavs(CouponType::TYPE_NEW);
	}
	
	public function actionEnding()
	{
		$this->processNewEndingFavs(CouponType::TYPE_ENDING);
	}
	
	public function actionFavs()
	{
		$this->processNewEndingFavs(CouponType::TYPE_FAVS);
	}
	
	private function processNewEndingFavs($couponsType) {
		$this->layout = "listing_layout";
		
		$coupons = Coupon::model()->getCouponsByType($couponsType);
		
		$this->render('new_ending', 
						array('coupons'=>$coupons,
						'couponsType'=>$couponsType,
						
					));
	}

	public function actionIndex($id = '')
	{
		$id = $this->checkCategoryId($id);
		
		$categories = Category::model()->getFrontendCategories($id);
		
		if($id == 0) {
			$listings = array();
		} else {
			$listings = Listing::model()->getFrontendListings($id);
		}
		
		Yii::app()->user->setCategoryId($id);
		
		if(Category::model()->isParentCategory($id)) {
			ViewsTrack::addCategoryView($id);
		} else {
			ViewsTrack::addSubCategoryView($id);
		}
		
		$this->render('index', array('categories'=>$categories, 'listings'=>$listings, 'categoryId'=>$id)
						
				);
	}

	public function actionSearch($searchtext = '')
	{
		if($searchtext == '') {
			$this->actionIndex(0);
			return;
		}
		
		$categories = array();
		$listings = Listing::model()->searchFrontendListings($searchtext);
		
		ViewsTrack::addCategoryView(0);
		
		$this->render('index', array('categories'=>$categories, 'listings'=>$listings,)
				);
	}
	
	private function checkCategoryId($webCategoryId) {
		if($webCategoryId == '') {
			return 0;
		}
		return $webCategoryId;
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}