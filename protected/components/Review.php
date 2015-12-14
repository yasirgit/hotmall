<?php

class Review extends CWidget
{
    public $review_id;
    
    public function init()
    {
    }
 
    public function run()
    {
        $this->render('review_view');
    }
}

?>