<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <main>
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mono_Archive
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-surface selection-primary' ); ?>>
	<?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#content">
		<?php esc_html_e( 'Skip to content', 'mono-archive' ); ?>
	</a>

	<!-- Search Overlay -->
	<div id="search-overlay" class="mono-search-overlay" aria-hidden="true">
		<div class="mono-search-overlay__inner">
			<button class="mono-search-overlay__close" aria-label="<?php esc_attr_e( 'Close search', 'mono-archive' ); ?>">
				<span class="material-symbols-outlined">close</span>
			</button>
			<?php get_search_form(); ?>
		</div>
	</div>

	<!-- Top Navigation Bar -->
	<nav class="mono-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'mono-archive' ); ?>">
		<div class="mono-nav__brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mono-nav__wordmark">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<div class="mono-nav__links">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'walker'         => new Mono_Archive_Nav_Walker(),
				'fallback_cb'    => 'mono_archive_fallback_menu',
				'depth'          => 1,
			) );
			?>
		</div>

		<div class="mono-nav__actions">
			<button class="mono-nav__search-toggle" aria-label="<?php esc_attr_e( 'Toggle search', 'mono-archive' ); ?>">
				<span class="material-symbols-outlined">search</span>
			</button>
		</div>
	</nav>
