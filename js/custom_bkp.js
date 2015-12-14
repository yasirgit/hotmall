$(document).ready(function() { 

	// Navigation menu

	$('ul#navigation').superfish({ 
		delay:       1000,
		animation:   {opacity:'show',height:'show'},
		speed:       'fast',
		autoArrows:  true,
		dropShadows: false
	});
	
	$('ul#navigation li').hover(function(){
		$(this).addClass('sfHover2');
	},
	function(){
		$(this).removeClass('sfHover2');
	});

	// Accordion
	$("#accordion, #accordion2").accordion({ header: "h3" });

	// Tabs
	$('#tabs, #tabs2, #tabs5').tabs();

	// Dialog			
	$('#dialog').dialog({
		autoOpen: false,
		width: "84%",
		margin: "auto",
		bgiframe: false,
		modal: false,
		buttons: {
			"Ok": function() { 
				$(this).dialog("close"); 
			}, 
			"Cancel": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
	
	// Login Dialog Link
	$('#login_dialog').click(function(){
		$('#login').dialog('open');
		return false;
	});

	// Login Dialog			
	$('#login').dialog({
		autoOpen: false,
		width: 300,
		height: 230,
		bgiframe: true,
		modal: true,
		buttons: {
			"Login": function() { 
				$(this).dialog("close"); 
			}, 
			"Close": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
	
	// Dialog Link
	$('.dialog-delete').click(function(){
		$('#dialog').dialog('open');
		return false;
	});

	// Dialog auto open			
	$('#welcome').dialog({
		autoOpen: false,
		width: "66%",
		height: "auto",
		margin: "auto",
		bgiframe: true,
		modal: true,
		buttons: {
			"Start using the site admin": function() {
				$(this).dialog("close"); 
			}
		}
	});

	// Dialog auto open			
	$('#welcome_login').dialog({
		autoOpen: true,
		width: 370,
		height: 430,
		bgiframe: true,
		modal: true,
		buttons: {
			"Login to Promocast": function() {
				window.location = "index.php";
			}
		}
	});

	// Datepicker
	$('#datepicker').datepicker({
		inline: true
	});
	
	//Hover states on the static widgets
	$('#dialog_link, ul#icons li').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);
	
	//Sortable

	$(".column").sortable('destroy')({
		connectWith: '.column'
	});

	//$("div.add-page").sortable('destroy');
	//$('div#custom-reports').sortable('destroy');

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

	$(".column").disableSelection();


	/* Table Sorter */
	$("#sort-table")
	.tablesorter({
		widgets: ['zebra'],
		headers: { 
		            // assign the secound column (we start counting zero) 
		            0: { 
		                // disable it by setting the property sorter to false 
		                sorter: false 
		            }, 
		            // assign the third column (we start counting zero) 
		            6: { 
		                // disable it by setting the property sorter to false 
		                sorter: false 
		            } 
		        } 
	})
	
	.tablesorterPager({container: $("#pager")}); 

	$(".header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');

	
});


	/* Tooltip */

	$(function() {
		$('.tooltip').tooltip({
			track: true,
			delay: 0,
			showURL: false,
			showBody: " - ",
			fade: 250
			});
		});
		
	/* Theme changer - set cookie */
    $(function() {
       
		$("link[title='style']").attr("href","css/styles/light_blue/ui.css");
        $('a.set_theme').click(function() {
           	var theme_name = $(this).attr("id");
			//$("link[title='style']").attr("href","css/styles/" + theme_name + "/ui.css");
			$.post( 'theme-switch.php', {theme:theme_name},
			function(data){
				if(data) {
					window.location.reload();
				}
			}
			);
			//$.cookie('theme', theme_name );
			$('a.set_theme').css("fontWeight","normal");
			$(this).css("fontWeight","bold");
        });
		
/* 		var theme = $.cookie('theme'); */
	    
/*
		if (theme == 'default') {
	        $("link[title='style']").attr("href","css/styles/default/ui.css");
	    };
	    
		if (theme == 'light_blue') {
	        $("link[title='style']").attr("href","css/styles/light_blue/ui.css");
		};
*/

	/* Layout option - Change layout from fluid to fixed with set cookie */
	
       $("#fluid_layout a").click (function(){
			$("#fluid_layout").hide();
			$("#fixed_layout").show();
			$("#page-wrapper").removeClass('fixed');
			$.cookie('layout', 'fluid' );
       });

       $("#fixed_layout a").click (function(){
			$("#fixed_layout").hide();
			$("#fluid_layout").show();
			$("#page-wrapper").addClass('fixed');
			$.cookie('layout', 'fixed' );
       });

	    var layout = $.cookie('layout');
	    
		if (layout == 'fixed') {
			$("#fixed_layout").hide();
			$("#fluid_layout").show();
	        $("#page-wrapper").addClass('fixed');
	    };

		if (layout == 'fluid') {
			$("#fixed_layout").show();
			$("#fluid_layout").hide();
	        $("#page-wrapper").addClass('fluid');
	    };
	
    });
    
    
 	/* Check all table rows */
	
var checkflag = "false";
function check(field) {
if (checkflag == "false") {
for (i = 0; i < field.length; i++) {
field[i].checked = true;}
checkflag = "true";
return "check_all"; }
else {
for (i = 0; i < field.length; i++) {
field[i].checked = false; }
checkflag = "false";
return "check_none"; }
}