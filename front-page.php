<?php
/**
 * The front page template file.
 *
 * @package WordPress
 * @subpackage rhd
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" class="content-front-page" role="main">

			<?php get_template_part( 'content', 'front-page' ); ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_footer(); ?>