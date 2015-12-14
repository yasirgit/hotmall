<?php

class CategoryController extends Controller
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			
			if($model->parent_category_id == 0) {
				$model->parent_category_id = null;
			}
			
			$logoFile = CUploadedFile::getInstance($model,'icon');
			if($logoFile != null) {
				$newFileName = uniqid(rand()).'.'.Utils::getFileExtension($logoFile->name);
				$model->icon = $newFileName;
			}

			if($model->save()) {
				if($logoFile != null) {
					$logoFile->saveAs(Yii::app()->user->getFullPathToImages(Yii::app()->params['categoryIcon']).$newFileName);
				}
				
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
		$model=new Category;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			
			if(!Yii::app()->user->isSuperadmin()) {
				$model->wlabel_id = Yii::app()->user->getWhiteLabelId();
			}

			// set correct sort order
			if($model->sort_order == '') {
				$model->sort_order = $model->getNextSortOrder($model->parent_category_id, $model->wlabel_id);
			}
			
			$logoFile = CUploadedFile::getInstance($model,'icon');
			if($logoFile != null) {
				$newFileName = uniqid(rand()).'.'.Utils::getFileExtension($logoFile->name);
				$model->icon = $newFileName;
			}

			if($model->parent_category_id == 0) {
				$model->parent_category_id = null;
			}

			if($model->save()) {
				if($logoFile != null) {
					$logoFile->saveAs(Yii::app()->user->getFullPathToImages(Yii::app()->params['categoryIcon']).$newFileName);
				}

				$this->redirect(array('index'));
			}
		}
		
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

		$openCategoryId = '';
		if(isset($_GET['open_cat_id'])) {
			$openCategoryId = $_GET['open_cat_id'];
		}

		if(isset($_GET['move']) && $_GET['move'] != '' && isset($_GET['cat_id'])) {
			// move category up or down
			if($model->moveCategory($_GET['cat_id'], $_GET['move'])) {
				$this->redirect(array('index', 'open_cat_id'=>$openCategoryId));
			}
		}
		
		$this->render('index',array(
			'model'=>$model, 
			'openCategoryId' => $openCategoryId,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
