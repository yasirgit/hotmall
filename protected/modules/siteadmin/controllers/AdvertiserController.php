<?php

class AdvertiserController extends Controller
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
						'roles'=>array(UserType::TYPE_SUPERADMIN, UserType::TYPE_WHITELABELADMIN),
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
		$advertiser=$this->loadModel($id);
		$user = $advertiser->p_users;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	    if(isset($_POST['User']))
	    {
	        // populate input data to $a and $b
	    	$user->attributes=$_POST['User'];
	 
			$advertiser->wlabel_id = Yii::app()->user->getWhiteLabelId();
			$user->wlabel_id = Yii::app()->user->getWhiteLabelId();
			$user->type = UserType::TYPE_ADVERTISER;
			$user->date_created = date("Y-m-d h:i:s");
			
	        // validate BOTH $a and $b
	        $valid=$user->validate();
	 
	        if($valid)
	        {
	        	$user->save(false);
	        	
	        	$this->redirect(array('index'));
	        }
	    }

		$this->render('update',array(
				'user'=>$user,
				'advertiser'=>$advertiser,
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
			$model = $this->loadModel($id);

			if($model->verifyDelete()) {
				$model->delete();
			}

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
		$advertiser=new Advertiser;
		$user=new User;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

	    if(isset($_POST['User']))
	    {
	        // populate input data to $a and $b
	    	$user->attributes=$_POST['User'];
	 
			$advertiser->wlabel_id = Yii::app()->user->getWhiteLabelId();
			$user->wlabel_id = Yii::app()->user->getWhiteLabelId();
			$user->type = UserType::TYPE_ADVERTISER;
			$user->date_created = date("Y-m-d h:i:s");
			
	        // validate BOTH $a and $b
	        $valid=$advertiser->validate();
	        $valid=$user->validate() && $valid;
	 
	        if($valid)
	        {
	        	$user->save(false);
	        	$advertiser->user_id = $user->user_id;
	        	
	        	$advertiser->save(false);
	        	
	        	$this->redirect(array('index'));
	        }
	    }
	    
		if(isset($_GET['Advertiser']))
			$user->attributes=$_GET['Advertiser'];	    
	    
		$this->render('index',array(
			'user'=>$user,
			'advertiser'=>$advertiser,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Advertiser::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='advertiser-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
