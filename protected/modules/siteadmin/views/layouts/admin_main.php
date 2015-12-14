<?php echo $this->renderPartial('/layouts/header', array()); ?>

	<div id="page-wrapper">
		<div id="main-wrapper">
			<div id="main-content">
				
				<?php echo $this->renderPartial('/layouts/dashboard_icons', array()); ?>
				
				<?php echo $content; ?>
				
			</div>
			<div class="clearfix"></div>
			
			
		</div>

		<?php echo $this->renderPartial('/layouts/sidebar', array()); ?>

	</div>
	<div class="clearfix"></div>
<?php echo $this->renderPartial('/layouts/footer', array()); ?>
</body>
</html>