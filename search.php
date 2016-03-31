<?php
/**
 * The search results template file.
 *
 * @package WordPress
 * @subpackage rhd
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'rhd' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content' ); ?>
				<?php endwhile; ?>

				<?php if ( is_single() && comments_open() ) comments_template(); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'rhd' ); ?></h1>
					</header>

					<div class="entry-content">
						<p><?php printf( __( 'Apologies, but no results were found for &quot;%s&quot;. Perhaps searching will help find a related post.', 'rhd' ), get_search_query() ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; // end have_posts() check ?>

		</div><!-- #content -->

		<?php rhd_archive_pagination(); ?>

	</section><!-- #primary -->

<?php get_footer(); ?>