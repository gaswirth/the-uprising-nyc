<?php
/**
 * The default template for displaying static page content.
 *
 * @package WordPress
 * @subpackage rhd
 */
?>

	<?php $hide_title = ( ! in_array( get_the_id(), array( 111, 115, 486, 167, 751, 753, 169 ) ) ) ? true : false; ?>

	<article id="post-<?php the_ID(); ?>">
		<header class="entry-header">
			<h1 class="page-title <?php echo ( $hide_title ) ? 'invisible' : ''; ?>"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'rhd' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'rhd' ), 'after' => '</div>' ) ); ?>

		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'rhd' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
