<article>
<!-- Content Area Starts -->

<?php if(count($locations) > 0) { ?>

<h2>Other Locations</h2>

<ul class="content-menu">

<?php foreach($locations as $id => $record) { ?>	

	<li>
		<a href="http://<?php echo $record->domain.'.'.WhiteLabel::model()->getDomain(); ?>"><?php echo $record->name; ?></a>
	</li>

<?php } ?>

</ul>

<?php } ?>

<!-- Content Area Ends -->
</article>