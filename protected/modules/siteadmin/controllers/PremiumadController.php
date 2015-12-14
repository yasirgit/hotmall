<?php

class PremiumadController extends Controller
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PremiumAd']))
		{
			$model->attributes=$_POST['PremiumAd'];
			if(!Yii::app()->user->isSuperadmin()) {
				$model->wlabel_id = Yii::app()->user->getWhiteLabelId();
			}

			if(Yii::app()->user->isAdvertiser()) {
				if($model->advertiser_id != Yii::app()->user->getAdvertiserId()) {
					throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
				}
			}
			
			$transaction = Yii::app()->db->beginTransaction();
			$saveError = false;

			$logoFile = CUploadedFile::getInstance($model,'image');
			if($logoFile != null) {
				$newFileName = uniqid(rand()).'.'.Utils::getFileExtension($logoFile->name);
				$model->image = $newFileName;
			}
			
			try {
				if($model->save()) {
            		$criteria=new CDbCriteria;
            		$criteria->condition='premiumad_id=:premiumad_id';
            		$criteria->params=array(':premiumad_id'=>$model->premiumad_id);
            		
            		PremiumAdCategory::model()->deleteAll($criteria);
					if(!$this->saveCategoriesToPremiumAd($model)) {
						$saveError = true;
					}

            		PremiumAdLocation::model()->deleteAll($criteria);					
					if(!$this->saveLocationsToPremiumAd($model)) {
						$saveError = true;
					}

            		PremiumAdListing::model()->deleteAll($criteria);					
					if(!$this->saveListingsToPremiumAd($model)) {
						$saveError = true;
					}

					if($logoFile != null) {
						$logoFile->saveAs(Yii::app()->user->getFullPathToImages(Yii::app()->params['premiumAdImage']).$newFileName);
					}

				} else {
					$saveError = true;
				}
        	} catch (Exception $e) {
        		$saveError = true;
        		$transaction->rollBack();
        		throw new CHttpException(400,'DB Exception: '.$e->getMessage());
        	}

        	if($saveError) {
        		$transaction->rollBack();
        	} else {
        		$transaction->commit();
        		$this->redirect(array('index'));
        	}
		}

		$this->render('update',array(
			'model'=>$model,
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
		$model=new PremiumAd;

		if(isset($_POST['PremiumAd']))
		{
			$model->attributes=$_POST['PremiumAd'];
			
			if(!Yii::app()->user->isSuperadmin()) {
				$model->wlabel_id = Yii::app()->user->getWhiteLabelId();
			}

			if(Yii::app()->user->isAdvertiser()) {
				$model->advertiser_id = Yii::app()->user->getAdvertiserId();
			}
			
			$transaction = Yii::app()->db->beginTransaction();
			$saveError = 0;

			$logoFile = CUploadedFile::getInstance($model,'image');
			if($logoFile != null) {
				$newFileName = uniqid(rand()).'.'.Utils::getFileExtension($logoFile->name);
				$model->image = $newFileName;
			}
			
			try {
				if($model->save()) {
					if(!$this->saveCategoriesToPremiumAd($model)) {
						$saveError = 1;
					}

					if(!$this->saveLocationsToPremiumAd($model)) {
						$saveError = 2;
					}

					if(!$this->saveListingsToPremiumAd($model)) {
						$saveError = 3;
					}

					if($logoFile != null) {
						$logoFile->saveAs(Yii::app()->user->getFullPathToImages(Yii::app()->params['premiumAdImage']).$newFileName);
					}

				} else {
					$saveError = 4;
				}
        	} catch (Exception $e) {
        		$saveError = 5;
        	}
        		
        	if($saveError > 0) {
        		$transaction->rollBack();
        	} else {
        		$transaction->commit();
        		$this->redirect(array('index'));
        	}
		}
		
		if(isset($_GET['PremiumAd']))
			$model->attributes=$_GET['PremiumAd'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=PremiumAd::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		// load categories
		$criteria=new CDbCriteria;
		$criteria->condition='premiumad_id=:premiumad_id';
		$criteria->select = 'category_id';
		$criteria->params=array(':premiumad_id'=>$id);
		$adCategories = PremiumAdCategory::model()->findAll($criteria);
		
		$categories = array();
		foreach ($adCategories as $category) {
		    $categories[] = $category->category_id;
		}

		$model->p_categories = $categories;
		
		// load locations
		$criteria=new CDbCriteria;
		$criteria->condition='premiumad_id=:premiumad_id';
		$criteria->select = 'location_id';
		$criteria->params=array(':premiumad_id'=>$id);
		$adLocations = PremiumAdLocation::model()->findAll($criteria);
		
		$locations = array();
		foreach ($adLocations as $location) {
			$locations[] = $location->location_id;
		}

		$model->p_locations = $locations;

		
		// load listings
		$criteria=new CDbCriteria;
		$criteria->condition='premiumad_id=:premiumad_id';
		$criteria->select = 'listing_id';
		$criteria->params=array(':premiumad_id'=>$id);
		$adListings = PremiumAdListing::model()->findAll($criteria);
		
		$listings = array();
		foreach ($adListings as $listing) {
			$listings[] = $listing->listing_id;
		}

		$model->p_listings = $listings;
		
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='premium-ad-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	protected function saveCategoriesToPremiumAd($model) {
		foreach ($_POST['PremiumAd']['p_categories'] as $categoryId) {
			$adCategory = new PremiumAdCategory;
			$adCategory->premiumad_id = $model->premiumad_id;
			$adCategory->category_id = $categoryId;
			if (!$adCategory->save()) {
				return false;
			}
		}
		
		return true;
	}
	
	protected function saveLocationsToPremiumAd($model) {
		foreach ($_POST['PremiumAd']['p_locations'] as $locationId) {
			$adLocation = new PremiumAdLocation;
			$adLocation->premiumad_id = $model->premiumad_id;
			$adLocation->location_id = $locationId;
			if (!$adLocation->save()) {
				return false;
			}
		}
		
		return true;
	}	

	protected function saveListingsToPremiumAd($model) {
		if(!isset($_POST['PremiumAd']['p_listings'])) {
			return true;
		}
		
		foreach ($_POST['PremiumAd']['p_listings'] as $listingId) {
			$adListing = new PremiumAdListing;
			$adListing->premiumad_id = $model->premiumad_id;
			$adListing->listing_id = $listingId;
			if (!$adListing->save()) {
				return false;
			}
		}
		
		return true;
	}	
}
