<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search, as well as home page.
 *
 * @package WordPress
 * @subpackage rhd
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && !is_search() ) : ?>
			<a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title(); ?>"><?php the_post_thumbnail( 'grid-featured' ); ?></a>
		<?php endif; ?>

		<?php if ( get_post_type() == 'post' ) : ?>
			<p class="entry-details"><span class="invisible">By <?php the_author(); ?> <span class="sep">&star;</span></span><?php the_time( 'n/j/y' ); ?></p>
			<hr class="entry-details-sep" />
		<?php endif; ?>

		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'rhd' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
	</header>

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'rhd' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
</article>