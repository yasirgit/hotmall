(function($){
	$(document).ready(function(){
		$('.datetimepicker').each(function(i,v){
			$(this).datetimepicker({dateFormat: 'yy-mm-dd'});
		});
		$('.datepicker').each(function(i,v){
			$(this).datepicker({dateFormat: 'yy-mm-dd'});
		});
		$('.timepicker').each(function(i,v){
			$(this).timepicker({});
		});		
			
	});
})(jQuery);