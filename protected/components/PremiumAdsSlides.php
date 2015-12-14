<?php

class PremiumAdsSlides extends CWidget
{
    public $position;
    
    public function init()
    {
    }
 
    public function run()
    {
    	$premiumAds = PremiumAd::model()->loadPremiumAds($this->position, Yii::app()->user->getCategoryId(), Yii::app()->user->getLocationId(), Yii::app()->user->getListingId());
    	
    	if($this->position == PremiumAdPosition::POS_TOP || $this->position == PremiumAdPosition::POS_BOTTOM) {
    		$this->render('premium_ad_slide_top', array('premiumAds'=>$premiumAds));
    	} else {
    		$this->render('premium_ad_slide_sidebar', array('premiumAds'=>$premiumAds));
    	}
    }
}

?>