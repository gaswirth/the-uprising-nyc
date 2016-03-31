<?php
/**
 * RHD Base
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage rhd
 */
?>

<!DOCTYPE html>
	<!--[if lt IE 7]>   <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
	<!--[if IE 7]>     <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
	<!--[if IE 8]>     <html class="no-js lt-ie9"> <![endif]-->
	<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta http-equiv="X-UA-Compatible" content="IE=9" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title><?php wp_title(); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<?php
			// Basic front page & device detection
			$body_classes[] = ( is_front_page() ) ? 'front-page' : '';
			$body_classes[] = ( rhd_is_mobile() ) ?  'mobile' : '';
			$body_classes[] = ( wp_is_mobile() && !rhd_is_mobile() ) ? 'tablet' : '';
			$body_classes[] = ( is_home() || is_single() || is_archive() || is_search() || is_404() ) ? 'blog-area' : '';
		?>

		<meta name="google-site-verification" content="l7g_KidK3U9y3wrbPcLg4lKwNp6wfz3A2LeDcP1hFSU" />

		<?php rhd_facebook_pixel(); ?>

		<?php wp_head(); ?>

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
  _fbq.push(['addPixelId', '102749693396991']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=102749693396991&amp;ev=PixelInitialized" /></noscript>

</head>

	<body <?php body_class( $body_classes ); ?>>
		<!--[if lt IE 7]>
			<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="//browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<?php
			$nav_args_main = array(
				'theme_location' => 'primary',
				'menu_id' => 'site-navigation',
				'container' => 'nav',
				'container_id' => 'site-navigation-container',
				'walker' => new RHD_Walker_Nav
			);

			$nav_args_sb = array(
				'theme_location' => 'primary',
				'menu_id' => 'site-navigation-sb',
				'container' => 'nav',
				'container_id' => 'site-navigation-sb-container'
			);
		?>

		<div class="sb-slidebar sb-right sb-style-push">
			<a href="<?php echo home_url(); ?>"><img class="sb-logo" src="<?php echo RHD_IMG_DIR; ?>/logo-shield-only.png" alt="The Uprising"></a>
			<?php wp_nav_menu( $nav_args_sb ); ?>
		</div>

		<div id="page" class="hfeed site sb-site-container">
			<header id="masthead" class="site-header" role="banner">
				<h1 id="site-title" class="invisible site-title"><?php echo get_bloginfo( 'name' ); ?></h1>
				<a href="<?php echo home_url(); ?>"><img id="logo" src="<?php echo RHD_IMG_DIR; ?>/nav-logo.jpg" alt="Uprising NYC"></a>
				<?php wp_nav_menu( $nav_args_main ); ?>

				<button class="hamburger sb-toggle-right cmn-toggle-switch cmn-toggle-switch__htra">
					<span>Navigation</span>
				</button>
			</header><!-- #masthead -->

			<?php if ( is_home() || is_archive() || is_search() ) : ?>
				<div id="blog-header" class="green">
					<ul id="blog-meta-content">
						<li>
							<div id="blog-categories" class="rhd-dropdown">
								<div class="rhd-dropdown-title">
									<span class="dd-title-text">Categories</span>
									<a class="drop" href="">
										<span class="dd-link-text">&dtri;</span>
									</a>
								</div>
								<ul>
									<?php wp_list_categories( 'title_li=' ); ?>
								</ul>
							</div>
						</li>
						<li>
							<div id="blog-archives" class="rhd-dropdown">
								<div class="rhd-dropdown-title">
									<span class="dd-title-text">Archives</span>
									<a class="drop" href="">
										<span class="dd-link-text">&dtri;</span>
									</a>
								</div>
								<ul>
									<?php wp_get_archives(); ?>
								</ul>
							</div>
						</li>
						<li>
							<div id="blog-search" class="rhd-dropdown">
								<?php get_search_form(); ?>
							</div>
						</li>
					</ul>
				</div>
			<?php endif; ?>

			<main id="main" class="clearfix">
