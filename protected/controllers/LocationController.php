<?php

class LocationController extends Controller
{
	public function actionIndex($lid = '')
	{
		$this->actionOther($lid);
	}

	public function actionOther($lid = '')
	{
		$locations = Location::model()->getFrontendLocations($this->checkLocationId($lid));
		
		$this->render('index', array('locations'=>$locations)
				);
	}
	
	private function checkLocationId($webLocationId) {
		if($webLocationId == '') {
			return 0;
		}
		return $webLocationId;
	}
}