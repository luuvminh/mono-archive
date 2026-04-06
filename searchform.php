<?php
/**
 * Custom Search Form
 * Minimal design with bottom-border input and styled submit
 */
?>

<form role="search" method="get" class="w-full" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="flex items-center gap-4">
		<input
			type="search"
			class="flex-1 bg-transparent border-0 border-b border-outline-variant/30 outline-none px-0 py-3 text-lg text-surface-inverse placeholder-outline-variant/40 focus:border-primary transition-colors duration-300"
			placeholder="<?php esc_attr_e( 'SEARCH THE ARCHIVE...', 'mono-archive' ); ?>"
			value="<?php echo esc_attr( get_search_query() ); ?>"
			name="s"
			title="<?php esc_attr_e( 'Search for:', 'mono-archive' ); ?>"
		/>
		<button
			type="submit"
			class="flex-shrink-0 text-outline-variant hover:text-primary transition-colors duration-300 font-bold uppercase tracking-widest text-sm p-2"
			title="<?php esc_attr_e( 'Search', 'mono-archive' ); ?>"
		>
			<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
			</svg>
		</button>
	</div>
</form>
