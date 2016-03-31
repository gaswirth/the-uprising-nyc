<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage rhd
 */
?>

	<section id="contact">
		<h3 style="text-align: center;">CONTACT US</h3>
		<p class="small-margin" style="text-align: center;"><a href="mailto:info@uprisingnyc.org">info@uprisingnyc.org</a><br />
		411 West 39th Street<br />
		New York, NY 10018</p>

		<?php get_sidebar( 'footer' ); ?>

		<?php echo do_shortcode('[rhd_social]'); ?>
	</section><!-- #contact -->

	</main><!-- #main -->

	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<a href="//markfisherfitness.com" target="_blank"><img class="mff-logo" src="<?php echo RHD_IMG_DIR; ?>/mff.png" alt="Mark Fisher Fitness"></a>
			<p>
				Powered by <a href="//markfisherfitness.com" target="_blank">Mark Fisher Fitness</a><br />
				Website by <a href="//roundhouse-designs.com" target="_blank">Roundhouse Designs</a><br />
				<?php echo '&copy;' . date( 'Y' ); ?> The Uprising NYC | All Rights Reserved<br />
				<a href="<?php echo home_url( '/privacy-policy' ); ?>">Privacy Policy</a> | <a href="<?php echo home_url( '/terms-conditions' ); ?>">Terms &amp; Conditions</a>
			</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
