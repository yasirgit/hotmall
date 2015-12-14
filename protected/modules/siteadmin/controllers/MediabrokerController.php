<?php

class MediabrokerController extends Controller
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
		$mediabroker=$this->loadModel($id);
		$user = $mediabroker->p_users;

	    if(isset($_POST['User']))
	    {
	        // populate input data to $a and $b
	    	$user->attributes=$_POST['User'];
	 
	    	$mediabroker->wlabel_id = Yii::app()->user->getWhiteLabelId();
			$user->wlabel_id = Yii::app()->user->getWhiteLabelId();
			$user->type = UserType::TYPE_MEDIABROKER;
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
				'mediabroker'=>$mediabroker,
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
		$mediabroker=new Mediabroker;
		$user=new User;

	    if(isset($_POST['User']))
	    {
	        // populate input data to $a and $b
	    	$user->attributes=$_POST['User'];
	 
	    	$mediabroker->wlabel_id = Yii::app()->user->getWhiteLabelId();
			$user->wlabel_id = Yii::app()->user->getWhiteLabelId();
			$user->type = UserType::TYPE_MEDIABROKER;
			$user->date_created = date("Y-m-d h:i:s");

			$mediabroker->promocode = $this->generateUniquePromocode($user->first_name, $user->last_name);
			
	        // validate BOTH $a and $b
	        $valid=$mediabroker->validate();
	        $valid=$user->validate() && $valid;

	        if($valid)
	        {
	        	$user->save(false);
	        	$mediabroker->user_id = $user->user_id;
	        	
	        	$mediabroker->save(false);
	        	
	        	$this->redirect(array('index'));
	        }
	    }
    
		$this->render('index',array(
			'user'=>$user,
			'mediabroker'=>$mediabroker,
		));
	}

	private function generateUniquePromocode($firstName, $lastName) {
		$prefix = substr($this->cleanText($firstName), 0, 4).substr($this->cleanText($lastName), 0, 4);
		
		while(true) {
			$promocode = $prefix.substr(md5(uniqid()), 0, 3);
			$existing = Mediabroker::model()->findByAttributes(array('promocode' => $promocode));
			
			if($existing == null) {
				return $promocode;
			}
		}
	}
	
	private function cleanText($text) 
	{ 
		$text=strtolower($text); 
		$code_entities_match = array('\'',' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','='); 
		$code_entities_replace = array('', '-','-','','','','','','','','','','','','','','','','','','','','','','','',''); 
		$text = str_replace($code_entities_match, $code_entities_replace, $text); 
		return $text; 
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Mediabroker::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='media-broker-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
