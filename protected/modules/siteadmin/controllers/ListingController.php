<?php

class ListingController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('index','view', 'create','update', 'delete'),
						'roles'=>array(UserType::TYPE_SUPERADMIN, UserType::TYPE_WHITELABELADMIN, UserType::TYPE_ADVERTISER),
					),
				array('deny',  // deny all users
						'users'=>array('*'),
					),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$coupons= CouponManager::load($model); //Coupon::model()->getAllCouponsForListing($id));
		
		if(Yii::app()->user->isAdvertiser() && $model->advertiser_id != Yii::app()->user->getAdvertiserId()) {
			$this->redirect(array('user/norights'));
		}
		
		if(isset($_POST['Listing']))
		{
			$model->attributes=$_POST['Listing'];
			if(isset($_POST['Coupon'])) {
				$coupons->manage($_POST['Coupon']);
			}
			
			if(!Yii::app()->user->isSuperadmin()) {
				$model->wlabel_id = Yii::app()->user->getWhiteLabelId();
			}
			
			if(Yii::app()->user->isAdvertiser()) {
				$model->advertiser_id = Yii::app()->user->getAdvertiserId();
			}
			
			$transaction = Yii::app()->db->beginTransaction();
			
			$saveError = false;
			
			$logoFile = CUploadedFile::getInstance($model,'logo');
			if($logoFile != null) {
				$newFileName = uniqid(rand()).'.'.Utils::getFileExtension($logoFile->name);
				$model->logo = $newFileName;
			}
			
            $valid=$model->validate();
            
            if(isset($_POST['Coupon'])) {
            	$valid=$coupons->validate($model) && $valid;
            }
 
            if($valid)
            {				
            	if($model->save()) {
            		$criteria=new CDbCriteria;
            		$criteria->condition='listing_id=:listing_id';
            		$criteria->params=array(':listing_id'=>$model->listing_id);

            		ListingCategory::model()->deleteAll($criteria);
            		if(!$this->saveCategoriesToListing($model)) {
            			$saveError = true;
            		}		


            		ListingLocation::model()->deleteAll($criteria);
            		if(!$this->saveLocationsToListing($model)) {
            			$saveError = true;
            		}				 

            		if($logoFile != null) {
            			$logoFile->saveAs(Yii::app()->user->getFullPathToImages(Yii::app()->params['listingLogo']).$newFileName);
            		}				

            		if(isset($_POST['Coupon'])) {
            			if(!$coupons->save($model)) {
            				$saveError = true;
            			}
            		}
            	} else {
            		$saveError = true;
            	}

            	if($saveError) {
            		$transaction->rollBack();
            	} else {
            		$transaction->commit();
            		$this->redirect(array('index'));
            	}
            }
		}

		$this->render('update',array(
			'model'=>$model,
			'coupons'=>$coupons,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Listing;
		$coupons=new CouponManager();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Listing']))
		{
			$model->attributes=$_POST['Listing'];
			
			if(isset($_POST['Coupon'])) {
				$coupons->manage($_POST['Coupon']);
			}
			
			if(!Yii::app()->user->isSuperadmin()) {
				$model->wlabel_id = Yii::app()->user->getWhiteLabelId();
			}
			
			if(Yii::app()->user->isAdvertiser()) {
				$model->advertiser_id = Yii::app()->user->getAdvertiserId();
			}
			
			$model->date_created = date("Y-m-d h:i:s");
			
			$transaction = Yii::app()->db->beginTransaction();
			$saveError = false;

			$logoFile = CUploadedFile::getInstance($model,'logo');
			if($logoFile != null) {
				$newFileName = uniqid(rand()).'.'.Utils::getFileExtension($logoFile->name);
				$model->logo = $newFileName;
			}
			
            $valid=$model->validate();
            
            if(isset($_POST['Coupon'])) {
            	$valid=$coupons->validate($model) && $valid;
            }
 
            if($valid)
            {			
            	if($model->save()) {
            		if(!$this->saveCategoriesToListing($model)) {
            			$saveError = true;
            		}

            		if(!$this->saveLocationsToListing($model)) {
            			$saveError = true;
            		}

            		if($logoFile != null) {
            			$logoFile->saveAs(Yii::app()->user->getFullPathToImages(Yii::app()->params['listingLogo']).$newFileName);
            		}

            		if(isset($_POST['Coupon'])) {
            			if(!$coupons->save($model)) {
            				$saveError = true;
            			}
            		}
            		
            	} else {
            		$saveError = true;
            	}

            	if($saveError) {
            		$transaction->rollBack();
            	} else {
            		$transaction->commit();
            		$this->redirect(array('index'));
            	}
            }
		}
		
		if(isset($_GET['Listing']))
			$model->attributes=$_GET['Listing'];
		
		$this->render('index',array(
			'model'=>$model,
			'coupons'=>$coupons,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Listing::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		// load categories
		$criteria=new CDbCriteria;
		$criteria->condition='listing_id=:listing_id';
		$criteria->select = 'category_id';
		$criteria->params=array(':listing_id'=>$id);
		$listingCategories = ListingCategory::model()->findAll($criteria);
		
		$categories = array();
		foreach ($listingCategories as $category) {
		    $categories[] = $category->category_id;
		}

		$model->p_categories = $categories;
		
		// load locations
		$criteria=new CDbCriteria;
		$criteria->condition='listing_id=:listing_id';
		$criteria->select = 'location_id';
		$criteria->params=array(':listing_id'=>$id);
		$listingLocations = ListingLocation::model()->findAll($criteria);
		
		$locations = array();
		foreach ($listingLocations as $location) {
			$locations[] = $location->location_id;
		}

		$model->p_locations = $locations;

		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='listing-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	protected function saveCategoriesToListing($model) {
		foreach ($_POST['Listing']['p_categories'] as $categoryId) {
			$listingCategory = new ListingCategory;
			$listingCategory->listing_id = $model->listing_id;
			$listingCategory->category_id = $categoryId;
			if (!$listingCategory->save()) {
				return false;
			}
		}
		
		return true;
	}
	
	protected function saveLocationsToListing($model) {
		foreach ($_POST['Listing']['p_locations'] as $locationId) {
			$listingLocation = new ListingLocation;
			$listingLocation->listing_id = $model->listing_id;
			$listingLocation->location_id = $locationId;
			if (!$listingLocation->save()) {
				return false;
			}
		}
		
		return true;
	}

}
