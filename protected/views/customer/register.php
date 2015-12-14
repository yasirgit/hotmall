<section id="main-content">
<!-- Main Content Starts -->

<article>
<!-- Content Area Starts -->

	<h1>Never Miss A Deal</h1>
	<p>Sign Up Today For The Best And Most Current Promotions For FREE!<br/>
	Please Provide Your Mobile Phone Number For Confirmation.</p>

	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

	<ul class="content-menu">
	<li>
    	<a href="<?php echo Yii::app()->createUrl('customer/login'); ?>" class="dine">Customer Login</a>
    </li>
	<li>
    	<a href="<?php echo Yii::app()->createUrl('site'); ?>" class="stay">Skip Registration</a>
    </li>
</ul>


<!-- Content Area Ends -->
</article>
