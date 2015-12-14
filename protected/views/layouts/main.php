<?php echo $this->renderPartial('//layouts/header', array()); ?>

  <div class="container">
	   <div id="content">
	     <?php echo $content; ?>
	   </div><!-- content -->
  </div>

  
  <?php echo $this->renderPartial('//layouts/sidebar', array()); ?>

  <br class="clear" /><!-- Just to increase height automatically -->

<?php echo $this->renderPartial('//layouts/footer', array()); ?>
