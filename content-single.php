<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search, as well as home page.
 *
 * @package WordPress
 * @subpackage rhd
 */
?>

<?php
	$thumb_id = get_post_thumbnail_id();
	$thumb = wp_get_attachment_image_src( $thumb_id, 'full', false );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header" style="background-image: url(<?php echo $thumb[0]; ?>);">
		<div class="entry-header-content">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<p class="entry-details">By <?php the_author(); ?> <span class="sep">&star;</span> <?php the_time( 'n/j/y' ); ?></p>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'rhd' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'rhd' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<p class="entry-tags"><?php the_tags( 'Tags: ', ' ,', null ); ?></p>
		<p class="entry-categories">Categories: <?php the_category( ' ,', null, null ); ?>

		<div class="entry-author">
			<div class="entry-author-content">
				<h4 class="name"><?php echo get_the_author_meta( 'first_name' ) . ' ' . get_the_author_meta( 'last_name' ); ?></h4>
				<p class="bio"><?php the_author_meta( 'description' ); ?>
				</p>
		</div>

		<?php edit_post_link( __( 'Edit Post', 'rhd' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->