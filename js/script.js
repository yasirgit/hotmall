$(document).ready(function() { 

	//Sidebar only sortable boxes
	$(".side-col").sortable({
		axis: 'y',
		connectWith: '.side-col'
	});

	$(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
		.find(".portlet-header")
			.addClass("ui-widget-header")
			.prepend('<span class="ui-icon ui-icon-circle-arrow-s"></span>')
			.end()
		.find(".portlet-content");

	$(".portlet-header .ui-icon").click(function() {
		$(this).toggleClass("ui-icon-circle-arrow-n");
		$(this).parents(".portlet:first").find(".portlet-content").slideToggle();
	});

	//$(".column").disableSelection();
	
	// Code for Form.php Starts

	// Code For Hide & Show Boxes
	$(".section-left .tool").click(function(){
		var myid = this.id;
		var mypop = myid + '-data';
		$("#"+mypop).show(300);
	});
		
	$(".content-form .each-tool .close-icon").click(function(){
		var myid = this.id;
		var mypop = myid + '-data';
		$("#"+mypop).hide(300);
	});
	
	// Code For Hide & Show Sub Menus		
	$(".each-tool .tool-options ul li").toggle(function () {
		var li_id = this.id;
		var complete_id = '#' + li_id;
		$(".each-tool .tool-options ul li .sub-menu").hide();
		$(complete_id +" .sub-menu").show();
	},
	function () {
		var li_id = this.id;
		var complete_id = '#' + li_id;
		$(complete_id +" .sub-menu").hide();
	});
	
	// Code for Form.php Ends
	


	// Code for Domain Field
	$(".portlet-content .domain-add-link").toggle(function() {
		$(".portlet-content .domain-add").css("display","block");
	},
	function(){
		$(".portlet-content .domain-add").css("display","none");
	});
	
	// Code for page-add.php Fields Box
	$(".column .portlet .portlet-content .page-add-link").toggle(function() {
		$(".portlet-content .page-add-box").css("display","block");
	},
	function(){
		$(".portlet-content .page-add-box").css("display","none");
	});
	
	// Code for Content Editor 
	$("textarea").markItUp(mySettings);

	// Code for Time Picker
	$('.date-start').datetimepicker({
		onSelect: function (selectedDateTime){
			var start = $(this).datetimepicker('getDate');
			$('.date-end').datetimepicker('option', 'minDate', new Date(start.getTime()) );
		}
	});

	$('.date-end').datetimepicker({
		onSelect: function (selectedDateTime){
			var end = $(this).datetimepicker('getDate');
			$('.date-start').datetimepicker('option', 'maxDate', new Date(end.getTime()) );
		}
	});
	// Show form and link url fields onclick
	$(".premium-url").hide();
	$(".premium-form").hide();
	$(".premium-url-link").click(function() {
		$(".premium-url").show();
		$(".premium-form").hide();
	});
	$(".premium-form-link").click(function() {
		$(".premium-form").show();
		$(".premium-url").hide();
	});
	
	// Export tables within the tabs as CSV.
	$(".export-csv-link").click(function(e) {
		$('.export-csv-table').table2CSV();
		e.preventDefault();
	});		
	$(".export-csv-1").click(function(e) {
		$('#tabs-1 .sorttable').table2CSV();
		e.preventDefault();
	});	
	$(".export-csv-2").click(function(e) {
		$('#tabs-2 .sorttable').table2CSV();
		e.preventDefault();
	});	
	$(".export-csv-3").click(function(e) {
		$('#tabs-3 .sorttable').table2CSV();
		e.preventDefault();
	});	
	$(".export-csv-4").click(function(e) {
		$('#tabs-4 .sorttable').table2CSV();
		e.preventDefault();
	});	
	$(".export-csv-5").click(function(e) {
		$('#tabs-5 .sorttable').table2CSV();
		e.preventDefault();
	});	
	$(".export-csv-6").click(function(e) {
		$('#tabs-6 .sorttable').table2CSV();
		e.preventDefault();
	});	
	$(".export-csv-7").click(function(e) {
		$('#tabs-7 .sorttable').table2CSV();
	});
});
    
