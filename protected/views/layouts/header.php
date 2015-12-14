<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo Yii::app()->user->getWhiteLabel()->name; ?></title>
	<meta name="robots" content="index, follow, all" />
<!-- 	
	<meta http-equiv="Cache-Control" content="no-cache" />
	<meta name="HandheldFriendly" content="true" />
	<meta name="MobileOptimized" content="width" />
-->	
	<meta name="viewport" content="width=device-width, initial-scale=0.45, minimum-scale=0.21, maximum-scale=1.5, user-scalable=no" />
	<meta name="description" content="<?php echo Yii::app()->user->getWhiteLabel()->name; ?>" />
	<meta name="keywords" content="local,bargains" />

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/frontend/style.css" rel="stylesheet" media="all" />
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/frontend/flexslider.css" type="text/css" media="screen" />

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/frontend/p_custom.css" rel="stylesheet" media="all" />
	
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/frontend/ie78.css" type="text/css" media="screen" />
	<![endif]-->
	<!--[if lte IE 7]>
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/frontend/ie7.css" type="text/css" media="screen" />
	<![endif]-->
	<!--[if IE]>
		<script src="http://s3.amazonaws.com/nwapi/nwmatcher/nwmatcher-1.2.4-min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/frontend/selectivizr-min.js"></script>
	<![endif]-->
  	
</head>
<body>

<div id="wrapper">
<!-- Main Wrapper Starts -->

<header>
	<!-- Header start -->
	<h1>
		<!-- Brand name here -->
		<a href="<?php echo Yii::app()->createUrl(''); ?>"><?php echo Yii::app()->user->getWhiteLabel()->site_title; ?></a>
		<a style="display: none" href="park.php"><img style="display: none"  src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/park-icon.png&amp;w=48&amp;h=47&amp;q=30&amp;a=tc" title="Park"/></a>
	</h1>
	
	<section class="search-locations">
		<!-- Search &amp; location link starts -->
		<form action="<?php echo Yii::app()->createUrl('location/other'); ?>" method="get" >
			<!-- Search form starts -->
			<button type="submit">Search</button>
			<input type="text" name="searchtext" placeholder="Search Here" />
			<input type="hidden" name="r" value="site/search">
			<!-- Search form ends -->
		</form>
		<!-- Location link -->
		<a href="<?php echo Yii::app()->createUrl('location/other'); ?>">
			<span>Other Locations</span>
		</a>
		<!-- Search &amp; location link ends -->
	</section>
    
	<!-- Header end -->
</header>

<section class="featured-business">
<!-- Featured business starts -->

	<div class="flexslider">
	    <ul class="slides">
	    	<?php $this->widget('PremiumAdsSlides', array('position'=>PremiumAdPosition::POS_TOP)); ?>
	    </ul>
	</div>
	
<!-- Featured business ends -->
</section>

<nav>
<!-- Nav bar starts -->
	<ul>
		<li class="home-tab">
			<a href="<?php echo Yii::app()->createUrl('site/index'); ?>"></a>
		</li>
		<li> <!--If text is changed in <a>, please see the line 308 of style.css to set width of the <ul>-->
			<a href="<?php echo Yii::app()->createUrl('site/new'); ?>"><div class="before"></div><div class="middle">New Offers</div><div class="after"></div></a>
		</li>
		<li>
			<a href="<?php echo Yii::app()->createUrl('site/ending'); ?>"><div class="before"></div><div class="middle">Ending Soon</div><div class="after"></div></a>
		</li>
		<li>
			<a href="<?php echo Yii::app()->createUrl('site/favs'); ?>"><div class="before"></div><div class="middle">FAV's</div><div class="after"></div></a>
		</li>
	</ul>
<!-- Nav bar ends -->
</nav>

<!-- Above code is included in header.php file -->

<section id="main-content">
<!-- Main Content Starts -->