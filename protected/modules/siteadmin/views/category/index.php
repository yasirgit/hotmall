
<div class="portlet">
<div class="portlet-header">Create Category</div>
<div class="portlet-content">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>


<div class="title title-spacing">
<h3>Manage Categories</h3>
</div>

<?php 

$columns = array();
if(Yii::app()->user->isSuperadmin()) { 	
	$columns[] = array(
					'name'=>'wlabel_id',
					'filter'=>CHtml::listData(WhiteLabel::model()->findAll(), 'wlabel_id','name'),
					'value'=>'$data->p_whitelabel->name',
				);
}

$columns[] = array(
				       'name' => 'name',
				       'type' => 'raw',
				       'value' => '$data->name'
				);
$columns[] = 'parent_category_id';
$columns[] = array(
			            'class'=>'CButtonColumn',
			            'template'=>'{open}{up}{down}{update}{delete}',
			        	'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfuly"); }',
			            'htmlOptions'=>array('width'=>80,'style'=>'text-align: right !important'),			            
			            'buttons'=>array(
			            		'open' => array(
			            				'label'=>'Open category',
			            				'imageUrl'=>Yii::app()->request->baseUrl.'/images/siteadmin/icons/open.png',
			            				'url'=>'Yii::app()->createUrl("siteadmin/category/index", array("open_cat_id"=>$data->category_id))',
			            				'visible'=> '$data->parent_category_id == 0',
			            		),
			            		'up' => array(
			            				'label'=>'Move up',
			            				'imageUrl'=>Yii::app()->request->baseUrl.'/images/siteadmin/icons/arrow_up.png',
			            				'url'=>'Yii::app()->createUrl("siteadmin/category/index", array("cat_id"=>$data->category_id,"open_cat_id"=>$data->parent_category_id, "move"=>"up"))',
			            		),
			            		'down' => array(
			            				'label'=>'Move down',
			            				'imageUrl'=>Yii::app()->request->baseUrl.'/images/siteadmin/icons/arrow_down.png',
			            				'url'=>'Yii::app()->createUrl("siteadmin/category/index", array("cat_id"=>$data->category_id,"open_cat_id"=>$data->parent_category_id, "move"=>"down"))',
			            		),
			            ),
		            );

	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-grid',
	'dataProvider'=>$model->search($openCategoryId),
	'filter'=>null,
	'columns'=>$columns,
)); ?>
