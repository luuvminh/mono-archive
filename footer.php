<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mono_Archive
 */

?>

	<!-- Newsletter Section (optional) -->
	<?php
	if ( is_front_page() || is_active_sidebar( 'sidebar-newsletter' ) ) :
		?>
		<section class="mono-newsletter" id="newsletter">
			<div class="mono-newsletter__inner">
				<h2 class="mono-newsletter__title">
					<?php esc_html_e( 'Subscribe to our newsletter', 'mono-archive' ); ?>
				</h2>
				<?php
				if ( is_active_sidebar( 'sidebar-newsletter' ) ) {
					dynamic_sidebar( 'sidebar-newsletter' );
				} else {
					// Fallback newsletter form
					?>
					<form class="mono-newsletter__form" method="post" action="#">
						<input
							type="email"
							name="email"
							placeholder="<?php esc_attr_e( 'Enter your email', 'mono-archive' ); ?>"
							required
						>
						<button type="submit" class="mono-newsletter__submit">
							<?php esc_html_e( 'Subscribe', 'mono-archive' ); ?>
						</button>
					</form>
					<?php
				}
				?>
			</div>
		</section>
		<?php
	endif;
	?>

	<!-- Footer -->
	<footer class="mono-footer" role="contentinfo">
		<div class="mono-footer__container">
			<!-- Left: Site Name -->
			<div class="mono-footer__brand">
				<p class="mono-footer__brand-text">
					<?php bloginfo( 'name' ); ?>
				</p>
			</div>

			<!-- Center: Footer Navigation -->
			<div class="mono-footer__nav">
				<?php
				wp_nav_menu( array(
					'theme_location'  => 'footer',
					'container'       => false,
					'items_wrap'      => '%3$s',
					'fallback_cb'     => 'mono_archive_fallback_footer_menu',
					'depth'           => 1,
					'link_before'     => '<span class="mono-footer__link-text">',
					'link_after'      => '</span>',
				) );
				?>
			</div>

			<!-- Right: Copyright -->
			<div class="mono-footer__copyright">
				<p class="mono-footer__copyright-text">
					<?php
					printf(
						/* translators: %d: Current year */
						esc_html__( '© %d %s. All rights reserved.', 'mono-archive' ),
						intval( gmdate( 'Y' ) ),
						esc_html( bloginfo( 'name' ) )
					);
					?>
				</p>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>

</body>
</html>
