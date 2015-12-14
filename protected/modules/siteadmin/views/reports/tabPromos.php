<?php

$model = new Coupon;

$columns = array();
if(Yii::app()->user->isSuperadmin()) { 	
	$columns[] = array(
			'name'=>'wlabel_id',
			'header'=> 'White Label',
			'filter'=>CHtml::listData(WhiteLabel::model()->findAll(), 'wlabel_id','name'),
			'value'=>'$data->p_whitelabel->name',
			);
}

$columns[] = array(
		'name' => 'coupon_id',
		'header'=> 'ID',
		);		
$columns[] = array(
		'name' => 'headline',
		'header'=> 'Headline',
		);		
$columns[] = array(
		'name' => 'redeemed',
		'header'=> 'Redeemed',
		);		
$columns[] = array(
		'name' => 'redemption_rate',
		'header'=> 'Redemption Rate',
		);		

?>
<div id="tabs-2" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'user-grid',
		'dataProvider'=>$model->search($qsForm->dateFrom, $qsForm->dateTo),
		'filter'=>null,
		'columns'=>$columns,
	)); ?>
	
	<img src="http://chart.apis.google.com/chart?chs=460x240&cht=p3&chco=BBCCED|76A4FB|3399CC|3366CC|224499|008000&chd=s:fUPPb8&chdl=Akif+Quddus|Trey+Brister|Sally+Carson|Joe+Garcia|Phuong+Nguyen|All+Others&chl=50|32|25|24|45|98&chma=|5&chtt=Redemption+Rate+By+Employee&chts=FF0000,18" width="460" height="240" alt="Redemption Rate By Employee" />

	<img src="http://chart.apis.google.com/chart?chxs=0,008000,11.5&chxt=x&chs=480x240&cht=p3&chco=BBCCED,76A4FB,3399CC,3072F3,3366CC,008000&chd=s:bNVil4&chdl=Akif+Quddus|Benny+Elder|Vincent+Trisapta|Jon+Hall|Mike+Summer|All+Others&chl=45|21|35|56|61|92&chma=0,0,5&chtt=Promotions+Redeemed+By+Employee&chts=FF0000,18" width="480" height="240" alt="Promotions Redeemed By Employee" />
	
<div class="clearfix"></div>
	
	<!-- Each Tab Ends -->
</div>