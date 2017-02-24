/* ==========================================================================
	Setup
   ========================================================================== */

var $window = jQuery(window),
	$body = jQuery('body'),
	$mast = jQuery('#masthead'),
	$branding = jQuery('#branding'),
	$nav = jQuery('#site-navigation'),
	$navItem = $nav.find('a'),
	$hamburger = jQuery('#hamburger'),
	$content = jQuery('#content'),
	$main = jQuery('#main');

var isSingle = ( $body.hasClass('single') ) ? true : false,
	isGrid = ( $main.hasClass('grid') === true ) ? true : false,
	isPaged = $body.hasClass('paged');

var isFrontPage = ( $body.hasClass('front-page') === true ) ? true : false;
var isMobile = ( $body.hasClass('mobile') === true ) ? true : false;
var isTablet = ( $body.hasClass('tablet') === true ) ? true : false;


/* ==========================================================================
	Let 'er rip... (DOM Ready)
   ========================================================================== */

(function($){
	rhdInit();

	$(document).ready(function(){
		//custom blog bar dropdowns
		$('.rhd-dropdown-title').click(function(e){
			e.preventDefault();

			var $this = $(this),
				$dd = $this.siblings('ul');

			$dd.slideToggle();
		});

		// Nav actions
		$navItem.click(function(e){
			if ( $(this).attr('href').indexOf( '#' ) > -1 ) {
				e.preventDefault();

				var $a = $( '#' + $(this).attr('href').split('#').pop() );

				$('html, body').animate({
					scrollTop: $a.offset().top - $mast.height() - 30
				}, 1000, 'easeInOutCubic');
			}
		});

		// Nav hover
		$("#site-navigation .menu-item-has-children").hover(function(){
			$(this).children('.sub-menu').stop().fadeToggle('fast');
		});

		$.slidebars();
		
		$("#export").click(function(){
			$("#export-table").tableToCSV();
		});
	});
})(jQuery);


/* ==========================================================================
	Functions
   ========================================================================== */

function rhdInit() {
	//wpadminbarPush();
}


function wpadminbarPush() {
	jQuery("#wpadminbar").css({
		top: '50px',
	});
}

jQuery.fn.tableToCSV = function() {    
	var clean_text = function(text){
		text = text.replace(/"/g, '""');
		return '"'+text+'"';
	};
	
	jQuery(this).each(function(){
			var table = jQuery(this);
			var caption = jQuery(this).find('caption').text();
			var title = [];
			var rows = [];

			jQuery(this).find('tr').each(function(){
				var data = [];
				jQuery(this).find('th').each(function(){
					var text = clean_text(jQuery(this).text());
					title.push(text);
					});
				jQuery(this).find('td').each(function(){
					var text = clean_text(jQuery(this).text());
					data.push(text);
					});
				data = data.join(",");
				rows.push(data);
				});
			title = title.join(",");
			rows = rows.join("\n");

			var csv = title + rows;
			var uri = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
			var download_link = document.createElement('a');
			download_link.href = uri;
			var ts = new Date().getTime();
			if(caption===""){
				download_link.download = ts+".csv";
			} else {
				download_link.download = caption+"-"+ts+".csv";
			}
			document.body.appendChild(download_link);
			download_link.click();
			document.body.removeChild(download_link);
	});  
};