<?php
/**
 * Template Name: Donation Pages
 *
 * @package WordPress
 * @subpackage rhd
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">
			<div class="page-inner">
				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'page-with-title' ); ?>

					<?php endwhile; ?>

				<?php endif; ?>
			</div>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_footer(); ?>