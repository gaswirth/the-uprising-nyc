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
		$.slidebars();

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