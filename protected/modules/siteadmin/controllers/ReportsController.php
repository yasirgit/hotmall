<?php

class ReportsController extends Controller
{
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
						'actions'=>array('index'),
						'roles'=>array(UserType::TYPE_SUPERADMIN, UserType::TYPE_WHITELABELADMIN, UserType::TYPE_ADVERTISER),
					),
				array('deny',  // deny all users
						'users'=>array('*'),
					),
		);
	}

	public function actionIndex()
	{
		$qsForm = new QuickStatsForm;

		$quickStats = $this->getQuickStats($qsForm);
		$reports = $this->getCustomReports($qsForm);
		$promos = $this->getPromosStats($qsForm);
		

		$customer = new Customer;

		$this->render('index',
				array(
						'quickStats'=>$quickStats,
						'report'=>$reports,
						'promos'=>$promos,
						'qsForm'=>$qsForm,
						));
	}

	private function getQuickStats($qsForm) {
		if(isset($_POST['QuickStatsForm'])) {
			$qsForm->attributes=$_POST['QuickStatsForm'];
			$qsForm->saveDatesToSession();
		} else {
			$qsForm->loadDatesFromSession();
		}
		
		return ViewsStats::getQuickStats($qsForm->dateFrom, $qsForm->dateTo);
	}

	private function getCustomReports($qsForm) {

		if(isset($_POST['QuickStatsForm'])) {
			$qsForm->attributes=$_POST['QuickStatsForm'];
			$qsForm->saveDatesToSession();
		} else {
			$qsForm->loadDatesFromSession();
		}
		
		return ViewsStats::getQuickStats($qsForm->dateFrom, $qsForm->dateTo);
	}
	
	private function getPromosStats($qsForm) {

		if(isset($_POST['QuickStatsForm'])) {
			$qsForm->attributes=$_POST['QuickStatsForm'];
			$qsForm->saveDatesToSession();
		} else {
			$qsForm->loadDatesFromSession();
		}
		
		return ViewsStats::getPromosStats($qsForm->dateFrom, $qsForm->dateTo);
	}

}