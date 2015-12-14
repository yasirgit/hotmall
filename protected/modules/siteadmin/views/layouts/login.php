<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<?php echo $this->renderPartial('/layouts/header_simple', array()); ?>

<div id="page-wrapper">
	<div id="main-wrapper">
		<div id="main-content">
			
			<?php echo $content; ?>
			
		</div>
		<div class="clearfix"></div>
		
		
	</div>

</div>
<div class="clearfix"></div>
<?php echo $this->renderPartial('/layouts/footer', array()); ?>
</body>
</html>