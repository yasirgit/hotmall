$(document).ready(function(){	
	/* Flexslider */
	$('.flexslider').flexslider();
	/*
	$(".coupon-container .coupon-listings").click(function(){
	  window.location = 'customer-login.php';
	});
	*/
	/* Tabs for reviews */
	$("#main-content #review-add .review-tabs #tab-1").click(function() {
		$(this).addClass("selected");
		$("#main-content #review-add .review-tabs #tab-2").removeClass("selected");
		$("#main-content #review-add .review-container .tab-1").css("display","block");	
		$("#main-content #review-add .review-container .tab-2").css("display","none");	
	});
	$("#main-content #review-add .review-tabs #tab-2").click(function() {
		$(this).addClass("selected");
		$("#main-content #review-add .review-tabs #tab-1").removeClass("selected");
		$("#main-content #review-add .review-container .tab-2").css("display","block");	
		$("#main-content #review-add .review-container .tab-1").css("display","none");	
	});
	/* Leave Comments */
	$("#main-content .coupon-container .text-box .report-links a.comments").toggle(function() {
		$("#main-content .coupon-container .text-box .post-comment").css("display","block");
	},
	function(){
		$("#main-content .text-box .post-comment").css("display","none");}
	);
	
	/* Tooltips */
	// Match all tags with a title attribute and use it as the content (default).
	$('[title]').qtip();
	// Parking Lot Tooltips
    $('.icon-park').qtip( {
		suppress: true,
		overwrite: true,		
		content: {
			text: $('.icon-park img').attr('title'),
			title: {
				text: $('.icon-park img').attr('alt')
			}
		},
		position: {
            at: 'top left', // Position the tooltip below the link
            my: 'bottom right',
            viewport: $(window) // Keep the tooltip on-screen at all times
        },
        show: {
            event: 'hover'
        }	
	})
});

/* Open link in new window */
$('a.external, a[rel~=external]').attr('target', '_blank');
/* Show rating stars and share links when button clicked. */
$('.share, .rate-us').hide();
$('.share-link').click(function() {
	$('.share, .rate-us').toggle('slow', function() {
	});
	return false;
	//Prevent the browser jump to the link anchor	  
});