<?php
/**
 * 404 Not Found Page
 * Minimal editorial aesthetic for page not found
 */

get_header(); ?>

<main class="min-h-screen bg-surface-container flex items-center justify-center">
	<div class="max-w-4xl mx-auto px-4 md:px-8 text-center py-20">

		<!-- Large 404 Display -->
		<div class="mb-12">
			<div class="text-9xl md:text-[200px] font-black tracking-tighter leading-none text-outline-variant/20 mb-4">
				404
			</div>
		</div>

		<!-- Heading -->
		<h1 class="text-5xl md:text-7xl font-black tracking-tighter leading-tight text-surface-inverse mb-6">
			PAGE NOT FOUND
		</h1>

		<!-- Message -->
		<p class="text-lg md:text-xl text-outline-variant max-w-2xl mx-auto mb-12 leading-relaxed">
			We couldn't locate the archive you're looking for. The page may have been moved, removed, or the URL might be incorrect.
		</p>

		<!-- Navigation Links -->
		<div class="flex flex-col sm:flex-row items-center justify-center gap-6 mb-16">
			<!-- Back to Home -->
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center gap-3 bg-primary text-white uppercase tracking-widest font-bold text-sm px-8 py-4 hover:bg-primary/90 transition-colors duration-300">
				RETURN HOME
				<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
				</svg>
			</a>

			<!-- Search -->
			<a href="<?php echo esc_url( home_url( '/?s=' ) ); ?>" class="inline-flex items-center gap-3 border-2 border-outline-variant text-surface-inverse uppercase tracking-widest font-bold text-sm px-8 py-3 hover:bg-surface-container-high transition-colors duration-300">
				SEARCH ARCHIVE
				<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
				</svg>
			</a>
		</div>

		<!-- Alternative Links -->
		<div class="border-t border-outline-variant/20 pt-12">
			<p class="text-xs uppercase tracking-widest font-medium text-outline-variant mb-6">Or visit these sections</p>
			<div class="flex flex-wrap items-center justify-center gap-4 md:gap-8">
				<a href="<?php echo esc_url( home_url( '/archive' ) ); ?>" class="text-surface-inverse hover:text-primary transition-colors duration-300 font-medium">Archive</a>
				<span class="text-outline-variant/30">•</span>
				<a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="text-surface-inverse hover:text-primary transition-colors duration-300 font-medium">About</a>
				<span class="text-outline-variant/30">•</span>
				<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="text-surface-inverse hover:text-primary transition-colors duration-300 font-medium">Contact</a>
			</div>
		</div>

	</div>
</main>

<?php get_footer(); ?>
