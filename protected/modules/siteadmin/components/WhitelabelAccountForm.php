<?php

class WhitelabelAccountForm extends CWidget
{
        
    public function init()
    {
    }
 
    public function run()
    {
        $this->render('wl_account_form', array('default_wlabel_id'=>Yii::app()->user->getWhiteLabelId()));
    }
}

?>