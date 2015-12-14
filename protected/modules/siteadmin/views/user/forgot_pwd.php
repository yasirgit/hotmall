

<div class="page-title ui-widget-content ui-corner-all">
                <!-- Page Heading & Description Starts -->
				
					<h1>Password Recovery</h1>
					<div class="other">
						<div>Please Enter Your Username And We Will Send Your Password Reset Information By Email</div>
                        
                    <ul id="dashboard-buttons">
                    <li>
						<a href="<?php echo Yii::app()->createUrl('siteadmin/advertiser/register'); ?>" class="register-now tooltip" title="Register Now">
							Register Now
						</a>
					</li>
                    <li>
						<a href="<?php echo Yii::app()->createUrl('siteadmin/default/login'); ?>" class="login-now tooltip" title="Login Now">
							Login Now
						</a>
					</li>
                    </ul>
                    
                    
				</div><div class="clearfix"></div>
				
                <!-- Page Heading & Description Ends -->
				</div>
                    
				<div class="one-column">
				<!-- Form Fields Container Starts -->
				
					<div class="column">
						
					<div class="form">
					<?php $form=$this->beginWidget('CActiveForm', array(
						'id'=>'login-form',
						'enableClientValidation'=>true,
					)); ?>


					<div class="portlet">
					    <div class="portlet-header">Login</div>
					    	<div class="portlet-content">
					    	<div class="row">
							<?php echo $form->labelEx($model,'username', array('class'=>'login')); ?>
							<?php echo $form->textField($model,'username'); ?>
							<?php echo $form->error($model,'username'); ?>
						</div>

						<div class="row buttons">
							<?php echo CHtml::submitButton('Login'); ?>
						</div>
					    	
							</div>
					     </div>   
					</div>    

					
					</div>
					
					<!-- Form Fields Container Ends -->
					</div>	
					
   

<?php $this->endWidget(); ?>
</div><!-- form -->