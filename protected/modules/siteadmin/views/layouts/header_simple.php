<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Cache-Control" content="no-cache" />
 	<meta name="robots" content="index, follow, all" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
 	<meta name="HandheldFriendly" content="true" />
 	<meta name="MobileOptimized" content="width" />
 	<meta name="viewport" content="width=device-width, minimum-scale=0.51, maximum-scale=2.0, user-scalable=no" />
 	
	<title>Site Admin || Localbargains.mobi</title>
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/siteadmin/style.css" rel="stylesheet" media="all" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/markitup/skins/markitup/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/markitup/sets/default/style.css" />	
	<link id="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/siteadmin/styles/grey.css" rel="stylesheet" />
	
	<link href="" rel="stylesheet" title="style" media="all" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/superfish.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tooltip.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tablesorter.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tablesorter-pager.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/cookie.js"></script>

	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/csv.js"></script> 
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/markitup/jquery.markitup.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/markitup/sets/default/set.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/script.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bind.js"></script>

	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/styleswitcher.jquery.js"></script>
	
	<!--[if IE 6]>
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/siteadmin/ie6.css" rel="stylesheet" media="all" />
	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/pngfix.js"></script>
	<script>
	  /* EXAMPLE */
	  DD_belatedPNG.fix('.logo, .other ul#dashboard-buttons li a');

	</script>
	<![endif]-->
	<!--[if IE 7]>
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/siteadmin/css/ie7.css" rel="stylesheet" media="all" />
	<![endif]-->

	<!-- Yii blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<!-- Promocast custom changes -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/siteadmin/p_custom.css" rel="stylesheet" media="all" />
	
	<style>
	.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
	.ui-timepicker-div dl { text-align: left; }
	.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
	.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
	.ui-timepicker-div td { font-size: 90%; }
	.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }
	</style>
	
</head>
<body>
	<div id="header">
		<div id="top-menu">
		</div>
		<div id="sitename">
			<a href="<?php echo Yii::app()->createUrl('siteadmin'); ?>" class="logo float-left" title="<?php echo Yii::app()->user->getWhiteLabel()->name; ?> Admin Panel"><?php echo Yii::app()->user->getWhiteLabel()->name; ?> Admin</a>
		</div>
	</div>