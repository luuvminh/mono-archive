<?php
/**
 * Search Results Page
 * Displays search results with archive-list styling
 */

get_header(); ?>

<main class="min-h-screen bg-surface-container">
	<div class="max-w-7xl mx-auto px-4 md:px-8 py-20">

		<!-- Search Header -->
		<section class="mb-24">
			<h1 class="text-6xl md:text-8xl font-black tracking-tighter leading-[0.9] text-surface-inverse mb-6">
				SEARCH RESULTS
			</h1>
			<p class="text-lg md:text-xl text-outline-variant max-w-2xl">
				<?php
				echo 'Results for: <span class="font-bold text-surface-inverse">' . esc_html( get_search_query() ) . '</span>';
				?>
			</p>
		</section>

		<!-- Results Count -->
		<?php if ( have_posts() ) : ?>
			<div class="mb-12 pb-8 border-b border-outline-variant/20">
				<p class="text-sm uppercase tracking-widest font-medium text-outline-variant">
					<?php
					echo sprintf(
						esc_html( 'Found %d result%s' ),
						intval( $wp_query->found_posts ),
						intval( $wp_query->found_posts ) !== 1 ? 's' : ''
					);
					?>
				</p>
			</div>

			<!-- Search Results Grid -->
			<div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 mb-24">
				<?php
				while ( have_posts() ) {
					the_post();
					?>
					<article class="group cursor-pointer">
						<!-- Featured Image -->
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="aspect-square bg-surface-container-low overflow-hidden mb-6">
								<a href="<?php the_permalink(); ?>" class="block w-full h-full">
									<?php
									the_post_thumbnail( 'full', array(
										'class' => 'w-full h-full object-cover grayscale contrast-125 brightness-90 group-hover:brightness-100 transition-all duration-500 group-hover:scale-105',
										'alt'   => get_the_title(),
									) );
									?>
								</a>
							</div>
						<?php endif; ?>

						<!-- Content -->
						<div class="space-y-4">
							<!-- Category/Type -->
							<div class="flex items-center gap-2">
								<span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
								<span class="text-xs uppercase tracking-widest font-medium text-outline-variant">
									<?php
									$categories = get_the_category();
									if ( ! empty( $categories ) ) {
										echo esc_html( $categories[0]->name );
									} else {
										echo 'Archive';
									}
									?>
								</span>
							</div>

							<!-- Title -->
							<h2 class="text-2xl md:text-3xl font-black tracking-tighter leading-tight text-surface-inverse group-hover:text-primary transition-colors duration-300">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h2>

							<!-- Excerpt -->
							<p class="text-base text-outline-variant leading-relaxed line-clamp-3">
								<?php
								if ( has_excerpt() ) {
									echo wp_kses_post( get_the_excerpt() );
								} else {
									echo wp_kses_post( wp_trim_words( get_the_content(), 20, '...' ) );
								}
								?>
							</p>

							<!-- Meta -->
							<div class="flex items-center gap-4 pt-4 text-xs uppercase tracking-widest font-medium text-outline-variant/60">
								<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
									<?php echo esc_html( get_the_date( 'M d, Y' ) ); ?>
								</time>
								<span>•</span>
								<span><?php echo esc_html( reading_time( get_the_content() ) ); ?> min read</span>
							</div>
						</div>
					</article>
					<?php
				}
				?>
			</div>

			<!-- Pagination -->
			<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<div class="flex items-center justify-center gap-4 py-12 border-t border-outline-variant/20">
					<?php
					echo wp_kses_post(
										paginate_links( array(
											'type'      => 'array',
											'prev_text' => '<span class="flex items-center gap-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>Previous</span>',
											'next_text' => '<span class="flex items-center gap-2">Next<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></span>',
										) )
					);
					?>
				</div>
			<?php endif; ?>

		<?php else : ?>

			<!-- No Results -->
			<div class="py-24 text-center">
				<h2 class="text-4xl md:text-6xl font-black tracking-tighter mb-6 text-surface-inverse">
					NOTHING FOUND
				</h2>
				<p class="text-lg text-outline-variant mb-12 max-w-xl mx-auto">
					Your search for "<span class="font-bold text-surface-inverse"><?php echo esc_html( get_search_query() ); ?></span>" didn't yield any results. Try adjusting your search terms.
				</p>

				<!-- Search Form -->
				<div class="max-w-md mx-auto mb-12">
					<?php get_search_form(); ?>
				</div>

				<!-- Back to Archive Link -->
				<a href="<?php echo esc_url( home_url( '/archive' ) ); ?>" class="inline-flex items-center gap-2 text-primary hover:text-primary/80 transition-colors duration-300 uppercase tracking-widest text-sm font-bold">
					<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
					</svg>
					Back to Archive
				</a>
			</div>

		<?php endif; ?>

	</div>
</main>

<?php get_footer(); ?>
