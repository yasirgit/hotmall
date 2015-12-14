

<div class="page-title ui-widget-content ui-corner-all">
                <!-- Page Heading & Description Starts -->
				
					<h1>Login</h1>
					<div class="other">
						<div>Please fill the following form to Login. If you don't have an account yet, please use the following buttons to register.</div>
                        
                    <ul id="dashboard-buttons">
                    <li>
						<a href="<?php echo Yii::app()->createUrl('advertiser/register'); ?>" class="register-now tooltip" title="Register Now">
							Register Now
						</a>
					</li>
                    <li>
						<a href="<?php echo Yii::app()->createUrl('siteadmin/user/forgotpwd'); ?>" class="forgot tooltip" title="Forgot Password">
							Forgot Password
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
						'clientOptions'=>array(
							'validateOnSubmit'=>true,
						),
					)); ?>


					<div class="portlet">
					    <div class="portlet-header">Login</div>
					    	<div class="portlet-content">
					    	<div class="row">
							<?php echo $form->labelEx($model,'username', array('class'=>'login')); ?>
							<?php echo $form->textField($model,'username'); ?>
							<?php echo $form->error($model,'username'); ?>
						</div>

						<div class="row">
							<?php echo $form->labelEx($model,'password'); ?>
							<?php echo $form->passwordField($model,'password'); ?>
							<?php echo $form->error($model,'password'); ?>
						</div>

						<div class="row rememberMe">
							<?php echo $form->checkBox($model,'rememberMe'); ?>
							<?php echo $form->label($model,'rememberMe'); ?>
							<?php echo $form->error($model,'rememberMe'); ?>
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