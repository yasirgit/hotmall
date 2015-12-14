<?php if(Yii::app()->user->getLocation() == null) { ?>

<article>
Account configuration not complete - no location created!
</article>


<?php } else { ?>

<article>
<!-- Content Area Starts -->

<?php if(count($categories) > 0) { ?>
<!-- Categories -->

<ul class="content-menu index-page">

<?php foreach($categories as $id => $record) { 
	  	if($record->listingsCount > 0) {
?>	  			

	<li>
		<?php if($record->icon) { ?>
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/thumb.php?src=<?php echo Yii::app()->request->baseUrl; ?>/images/<?php echo Yii::app()->params['categoryIcon']; ?>/<?php echo $record->icon; ?>&amp;w=38&amp;h=38&amp;q=30&amp;a=tc" title="<?php echo $record->name; ?>"/>
		<?php } ?>
		<a href="<?php echo Yii::app()->createUrl('site/index', array('id'=>$record->category_id)); ?>"><?php echo ($record->icon == '' ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '').$record->name; ?> (<?php echo $record->listingsCount; ?>)</a>
	</li>

<?php 	}
	  } 
?>

</ul>

<?php } ?>


<?php if(count($listings) > 0) { ?>
<!-- Listings -->

<h2>Listings</h2>

<ul class="content-menu">

<?php foreach($listings as $id => $record) { ?>	

	<li>
		<a href="<?php echo Yii::app()->createUrl('listing', array('id'=>$record['listing_id'])); ?>"><?php echo $record['name']; ?></a>
	</li>

<?php } ?>

</ul>

<?php } ?>

<!-- Content Area Ends -->
</article>

<?php } ?>
