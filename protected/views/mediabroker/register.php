<article>
<!-- Content Area Starts -->

	<h1>Media Broker Registration</h1>

	<p>Once You Click Submit, Please Login On The Next Page</p>

	<?php echo $this->renderPartial('_form', array('user'=>$user,)); ?>

	<ul class="content-menu">
	<li>

    	<a href="<?php echo Yii::app()->createUrl('siteadmin/default/login'); ?>" class="dine">Login Now</a>
    </li>
	<li>
    	 <a href="<?php echo Yii::app()->createUrl('siteadmin/user/forgotpwd'); ?>">Forgot Password</a>
    </li>
</ul>

<!-- Content Area Ends -->
</article>
