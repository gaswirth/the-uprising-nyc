<?php
/**
 * RHD Base
 *
 * ROUNDHOUSE DESIGNS
 *
 * @package WordPress
 * @subpackage rhd
 **/


/* ==========================================================================
   Initialization
   ========================================================================== */

function rhd_init() {
	// Setup
	$uploads = wp_upload_dir();

	// Constants
	define( "RHD_THEME_DIR", get_template_directory_uri() );
	define( "RHD_IMG_DIR", get_template_directory_uri() . '/img' );
	define( "RHD_UPLOADS_DIR", $uploads['baseurl'] );
}
add_action( 'after_setup_theme', 'rhd_init' );

/* Disable Editor */
define( 'DISALLOW_FILE_EDIT', true );


/* ==========================================================================
   Scripts + Styles
   ========================================================================== */

function rhd_enqueue_styles(){
	wp_register_style( 'rhd-main', RHD_THEME_DIR . '/css/main.css', array( 'slidebars' ), '1', 'all' );
	wp_register_style( 'normalize', RHD_THEME_DIR . '/css/normalize.css', array( 'slidebars-js-css' ), null, 'all' );
	wp_register_style( 'rhd-enhanced', RHD_THEME_DIR . '/css/enhanced.css', array(), '1', 'screen' );
	wp_register_style( 'slidebars', RHD_THEME_DIR . '/js/vendor/slidebars/distribution/0.10.2/slidebars.min.css', array(), '0.10.2', 'screen' );

	wp_register_style( 'google-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,700' );

	wp_enqueue_style( 'rhd-main' );
	wp_enqueue_style( 'normalize' );
	wp_enqueue_style( 'google-fonts' );

	if ( !rhd_is_mobile() ) {
		wp_enqueue_style( 'rhd-enhanced' );
	}
}
add_action( 'wp_enqueue_scripts', 'rhd_enqueue_styles' );

function rhd_enqueue_scripts() {
	wp_register_script( 'modernizr', RHD_THEME_DIR . '/js/vendor/modernizr/modernizr-custom.js', null, '2.8.3', true );
	wp_register_script( 'rhd-plugins', RHD_THEME_DIR . '/js/plugins.js', array( 'jquery' ), null, true );
	wp_register_script( 'bloomerang-web-visits', '//api.bloomerang.co/v1/WebsiteVisit?ApiKey=pub_58cf2eb8-7027-11e4-b8ac-0a8b51b42b90', null, null, false );
	wp_register_script( 'slidebars', RHD_THEME_DIR . '/js/vendor/slidebars/distribution/0.10.2/slidebars.min.js', array( 'jquery' ), '0.10.2', true );
	wp_register_script( 'packery', RHD_THEME_DIR . '/js/vendor/packery/dist/packery.pkgd.min.js', array( 'jquery' ), null, true );
	wp_register_script( 'imagesloaded', RHD_THEME_DIR . '/js/vendor/imagesloaded/imagesloaded.pkgd.min.js', array (), null, true );

	$main_deps = array( 'rhd-plugins', 'jquery', 'jquery-effects-core', 'slidebars', 'imagesloaded' );

	if ( !rhd_is_mobile() )
		$main_deps[] = 'packery';

	wp_register_script( 'rhd-main', RHD_THEME_DIR . '/js/main.js', $main_deps, null, true );

	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'rhd-plugins' );
	wp_enqueue_script( 'rhd-main' );
	wp_enqueue_script( 'bloomerang-web-visits' );

	if ( is_singular() )
		wp_enqueue_script( 'comment-reply' );



	// Localize data for client-side use
	$data = array(
		'home_url' => home_url(),
		'theme_dir' => RHD_THEME_DIR,
		'img_dir' => RHD_IMG_DIR
	);
	wp_localize_script( 'rhd-plugins', 'wp_data', $data);

}
add_action('wp_enqueue_scripts', 'rhd_enqueue_scripts');


/**
 * register_jquery function.
 *
 * @access public
 * @return void
 */
function rhd_register_jquery() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', RHD_THEME_DIR . '/js/vendor/jquery/dist/jquery.min.js' );
	wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueuescripts', 'rhd_register_jquery' );

/*
function rhd_add_editor_styles() {
	//Google Fonts in admin editor
	$font_url = '//fonts.googleapis.com/css?family=Montserrat:400,700';
	$font_url = str_replace( ',', '%2C', $font_url );
	$font_url = str_replace( ':', '%3A', $font_url );
    add_editor_style( $font_url );


	add_editor_style( RHD_THEME_DIR . '/css/editor.css' );
}
add_action( 'after_setup_theme', 'rhd_add_editor_styles' );
*/


/**
 * Function: rhd_favicons
 *
 * Outputs default favicon linkage, generated by http://realfavicongenerator.net/
 **/
function rhd_favicons() {
	echo '
		<link rel="shortcut icon" href="' . RHD_THEME_DIR . '/favicons/favicon.ico">
		<link rel="apple-touch-icon" sizes="57x57" href="' . RHD_THEME_DIR . '/favicons/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="114x114" href="' . RHD_THEME_DIR . '/favicons/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="72x72" href="' . RHD_THEME_DIR . '/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="144x144" href="' . RHD_THEME_DIR . '/favicons/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="60x60" href="' . RHD_THEME_DIR . '/favicons/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="120x120" href="' . RHD_THEME_DIR . '/favicons/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="' . RHD_THEME_DIR . '/favicons/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="152x152" href="' . RHD_THEME_DIR . '/favicons/apple-touch-icon-152x152.png">
		<link rel="icon" type="image/png" href="' . RHD_THEME_DIR . '/favicons/favicon-196x196.png" sizes="196x196">
		<link rel="icon" type="image/png" href="' . RHD_THEME_DIR . '/favicons/favicon-160x160.png" sizes="160x160">
		<link rel="icon" type="image/png" href="' . RHD_THEME_DIR . '/favicons/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="' . RHD_THEME_DIR . '/favicons/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="' . RHD_THEME_DIR . '/favicons/favicon-32x32.png" sizes="32x32">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="' . RHD_THEME_DIR . '/favicons/mstile-144x144.png">
		<meta name="msapplication-config" content="' . RHD_THEME_DIR . '/favicons/browserconfig.xml">
	';
}
//add_action( 'wp_head', 'rhd_favicons' );


/* ==========================================================================
   Sidebars + Menus
   ========================================================================== */

// Sidebars
function rhd_register_sidebars() {
	register_sidebar(array(
		'name'			=> __( 'Sidebar', 'rhd' ),
		'id'			=> 'sidebar',
		'before_title'	=> '<h2 class="widget-title">',
		'after_title'	=> '</h2>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>'
	));

	register_sidebar(array(
		'name'			=> __( 'Footer Widget Area', 'rhd' ),
		'id'			=> 'footer-widget-area',
		'before_title'	=> '<h2 class="widget-title">',
		'after_title'	=> '</h2>',
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>'
	));
}
add_action( 'widgets_init', 'rhd_register_sidebars' );

// Menus
register_nav_menu( 'primary', 'Main Site Navigation' );

/**
 * RHD_Walker_Nav class.
 * 
 * @extends Walker_Nav_Menu
 */
class RHD_Walker_Nav extends Walker_Nav_Menu {
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}

// Includes and Requires
include_once( 'includes/rhd-admin-panel.php' );


/* ==========================================================================
   Registrations, Theme Support, Thumbnails
   ========================================================================== */

// Theme Support
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
}

// Enable themes auto-update
add_filter( 'allow_minor_auto_core_updates', '__return_true' );

// Content Width
if ( ! isset( $content_width ) ) {
	$content_width = 800;
}

// Adds RSS feed links to for posts and comments.
add_theme_support( 'automatic-feed-links' );

function rhd_image_sizes(){
	add_image_size( 'grid-featured', 482, 240, true );
}
add_action( 'after_setup_theme', 'rhd_image_sizes' );


/* ==========================================================================
   Roundhouse Admin Branding
   ========================================================================== */

// External login link
function rhd_branding_login(){
	return "//roundhouse-designs.com/";
}
add_filter('login_headerurl', 'rhd_branding_login');

// Site Title as "login message" (underneath RHD logo)
function rhd_login_message() { ?>
	<h1 class="rhd-login-site-title"><?php bloginfo('name'); ?></h1>
<?php }
add_action( 'login_message', 'rhd_login_message' );

// Roundhouse Branding CSS
function rhd_login() {
	wp_enqueue_style( 'rhd_login', get_stylesheet_directory_uri() . '/rhd/rhd-login.css' );
}
add_action('login_head', 'rhd_login');
function rhd_admin() {
	wp_enqueue_style( 'rhd_admin', get_stylesheet_directory_uri() . '/rhd/rhd-admin.css' );
}
add_action('admin_head', 'rhd_admin');

// Custom WordPress Footer
function rhd_footer_admin () {
	echo '&copy; ' . date("Y") . ' - Roundhouse <img class="rhd-admin-colophon-logo" src="//assets.roundhouse-designs.com/images/rhd-black-house.png" alt="Roundhouse Designs"> Designs';
}
add_filter('admin_footer_text', 'rhd_footer_admin');

// Remove 'Editor' panel
function rhd_remove_editor_menu() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}
add_action('_admin_menu', 'rhd_remove_editor_menu', 1);


/* ==========================================================================
   Helpers
   ========================================================================== */

/**
 * rhd_is_mobile function.
 *
 * @access public
 * @return void
 */
function rhd_is_mobile() {
	$mobile_browser = 0;

	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
	    $mobile_browser++;
	}

	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
	    $mobile_browser++;
	}

	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = array(
	    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
	    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
	    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
	    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
	    'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
	    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
	    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
	    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
	    'wapr','webc','winw','winw','xda ','xda-');

	if (in_array($mobile_ua,$mobile_agents)) {
	    $mobile_browser++;
	}

	if ( array_key_exists( 'ALL_HTTP', $_SERVER ) ) {
		if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) {
		    $mobile_browser++;
		}
	}

	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
	    $mobile_browser = 0;
	}

	if ( $mobile_browser > 0 ) {
		$mobile_browser = TRUE;
	} else {
		$mobile_browser = FALSE;
	}

	return $mobile_browser;
}


/**
 * get_the_slug function.
 *
 * @access public
 * @return void
 */
function get_the_slug() {
	$post_data = get_post( $post->ID, ARRAY_A );
	$slug = $post_data['post_name'];
	return $slug;
}


/**
 * Function: rhd_strip_thumbnail_dimensions
 *
 * Strip WP inline image dimensions
 *
 * @param $html
 **/
add_filter( 'post_thumbnail_html', 'rhd_strip_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'rhd_strip_thumbnail_dimensions', 10 );

function rhd_strip_thumbnail_dimensions($html) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}


/**
 * rhd_add_async function.
 *
 * @access public
 * @param mixed $url
 * @return void
 */
function rhd_add_async( $url ) {
	if ( strpos( $url, '#async') === false )
		return $url;
	elseif ( is_admin() )
		return str_replace( '#async', '', $url );
	else
		return str_replace( '#async', '', $url ) . "' async";
}
add_filter( 'clean_url', 'rhd_add_async', 11, 1 );


/**
 * rhd_gallery_atts function.
 *
 * @access public
 * @param mixed $out
 * @param mixed $pairs
 * @param mixed $atts
 * @return void
 */
function rhd_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts(
		array(
			'link' => 'file'
		), $atts );

	$out['link'] = $atts['link'];

/*
	Other example defaults:
	$out['columns'] = $atts['columns'];
	$out['size'] = $atts['size'];
*/

	return $out;
}
add_filter( 'shortcode_atts_gallery', 'rhd_gallery_atts', 10, 3 );


/**
 * rhd_custom_excerpt_length function.
 *
 * @access public
 * @param int $length (default: 40)
 * @return void
 */
function rhd_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'rhd_custom_excerpt_length', 999 );


/**
 * rhd_archive_pagination function.
 *
 * @access public
 * @return void
 */
function rhd_archive_pagination() {
	$sep = ( get_previous_posts_link() != '' ) ? '<div class="pag-sep"></div>' : null; ?>

	<div class="pagination">
		<span class="pag-next"><?php next_posts_link( '&larr; Older', null ); ?></span>
		<?php if ( $sep ) : ?>
			<div class="pag-sep"></div>
		<?php endif; ?>
		<span class="pag-prev"><?php previous_posts_link( 'Newer &rarr;', null ); ?></span>
	</div> <?php
}


/**
 * rhd_custom_wpautop function.
 *
 * @access public
 * @param mixed $content
 * @return void
 */
function rhd_custom_wpautop( $content ) {
if ( is_page() )
	return $content;
else
	return wpautop( $content );
}
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'rhd_custom_wpautop' );


/**
 * rhd_social_shortcode function.
 *
 * @access public
 * @param mixed $atts
 * @return void
 */
function rhd_social_shortcode( $atts ) {
	$options = get_option( 'rhd_theme_settings' );

	$output = '<ul class="rhd-social">' .
		'<li class="social">
			<a href="' . $options['rhd_facebook_url'] . '" target="_blank">
				<img src="' . RHD_IMG_DIR . '/facebook.svg" alt="Facebook">
			</a>
		</li>' .
		'<li class="social">
			<a href="' . $options['rhd_twitter_url'] . '" target="_blank">
				<img src="' . RHD_IMG_DIR . '/twitter.svg" alt="Twitter">
			</a>
		</li>' .
		'<li class="social">
			<a href="' . $options['rhd_youtube_url'] . '" target="_blank">
				<img src="' . RHD_IMG_DIR . '/youtube.svg" alt="YouTube">
			</a>
		</li>' .
	'</ul>';

	return $output;
}
add_shortcode( 'rhd_social', 'rhd_social_shortcode' );


function rhd_donor_lists( $atts ) {
	$options = get_option( 'rhd_theme_settings' );
	$donor_lists = array(
		'rhd_leadership_gifts' => 'Leadership Gifts',
		'rhd_recurring_donors' => 'Recurring Donors',
		'rhd_one_time_donors' => 'One Time Donors',
		'rhd_volunteers' => 'Volunteers'
	);

	$i = 0;

	$output = '<div class="donor-lists-container">';

	foreach ( $donor_lists as $list_name => $list_title ) {
		$list = $options[$list_name];

		if ( !empty( $list ) ) {
			++$i;

			$this_list = explode( "\n", $list );

			if ( $this_list ) {
				$list_out = '';

				if ( $list_name != 'rhd_leadership_gifts' ) {
					uasort( $this_list, function($a, $b) {
						$a = substr( strrchr( $a, ' ' ), 1 );
						$b = substr( strrchr( $b, ' ' ), 1 );
						return strcmp( $a, $b );
					});
				}

				$list_out .= "<h3 class=\"donor-list-title\">$list_title</h3>\n";
				$list_out .= "<ul>\n";

				foreach ( $this_list as $donor ) {
					$list_out .= "<li class=\"donor\">$donor</li>\n";
				}

				$list_out .= "</ul>\n";
			}
		}
		$output .= $list_out;
	}

	$output .= '</div><!-- .donor-lists-container -->';

	return $output;
}
add_shortcode( 'rhd_donor_lists', 'rhd_donor_lists' );


/**
 * rhd_facebook_pixel function.
 *
 * @access public
 * @param mixed $page
 * @return void
 */
function rhd_facebook_pixel() {
	global $post;

	if ( $post->ID == 115 ) {
		echo "<!-- Facebook Conversion Code for Volunteer Form -->
			<script>(function() {
				var _fbq = window._fbq || (window._fbq = []);
				if (!_fbq.loaded) {
				var fbds = document.createElement('script');
				fbds.async = true;
				fbds.src = '//connect.facebook.net/en_US/fbds.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(fbds, s);
				_fbq.loaded = true;
				}
				})();
				window._fbq = window._fbq || [];
				window._fbq.push(['track', '6029330577174', {'value':'0.00','currency':'USD'}]);
			</script>
			<noscript><img height='1' width='1' alt='' style='display:none' src='https://www.facebook.com/tr?ev=6029330577174&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1' /></noscript>";
	} elseif ( $post->ID == 111 || $post->ID == 486 ) {
		echo "<!-- Facebook Conversion Code for Donate Form -->
			<script>(function() {
				var _fbq = window._fbq || (window._fbq = []);
				if (!_fbq.loaded) {
				var fbds = document.createElement('script');
				fbds.async = true;
				fbds.src = '//connect.facebook.net/en_US/fbds.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(fbds, s);
				_fbq.loaded = true;
				}
				})();
				window._fbq = window._fbq || [];
				window._fbq.push(['track', '6029331061974', {'value':'0.00','currency':'USD'}]);
			</script>
			<noscript><img height='1' width='1' alt='' style='display:none' src='https://www.facebook.com/tr?ev=6029331061974&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1' /></noscript>";
	} else {
		echo "<!-- no pixel -->";
	}
}