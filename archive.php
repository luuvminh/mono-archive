<?php
/**
 * The template for displaying archive pages
 *
 * @package Mono_Archive
 */

get_header();
?>

<div class="pt-32 pb-24 px-8 md:px-12 max-w-7xl mx-auto">
	<!-- Archive Header -->
	<div class="grid grid-cols-12 gap-8 mb-24">
		<!-- Left Column -->
		<div class="col-span-12 md:col-span-6">
			<h1 class="text-6xl md:text-8xl font-black tracking-tighter uppercase leading-none mb-4">
				Archive
			</h1>
			<p class="text-outline-variant opacity-30 text-2xl font-light tracking-tight uppercase">
				Vol. 01
			</p>
		</div>

		<!-- Right Column -->
		<div class="col-span-12 md:col-span-5 md:col-start-8 md:self-end">
			<p class="text-xs uppercase tracking-widest text-neutral-500 font-bold mb-4">
				Curated selection
			</p>
			<p class="text-neutral-600 leading-relaxed">
				Explore our collection of curated articles, stories, and visual narratives. Each piece has been carefully selected to provide insight, inspiration, and perspective.
			</p>
		</div>
	</div>
</div>

<!-- Archive List -->
<div class="px-8 md:px-12 max-w-7xl mx-auto space-y-0">
	<?php
	if ( have_posts() ) {
		$post_count = 0;
		$total_posts = $wp_query->found_posts;

		while ( have_posts() ) {
			the_post();
			$post_count++;

			// Determine if post is B&W or Color (default to color)
			$is_bw = get_post_meta( get_the_ID(), '_mono_archive_bw', true );
			$tag_label = $is_bw ? 'B&W' : 'Color';
			$tag_class = $is_bw ? 'bg-neutral-900 text-white' : 'bg-neutral-100 text-neutral-900';

			// Get featured image
			$thumbnail_id = get_post_thumbnail_id();
			$thumbnail_url = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'medium_large' ) : '';
			?>

			<article class="group relative py-8 border-b border-outline-variant border-opacity-10 last:border-b-0">
				<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8">
					<!-- Left Side -->
					<div class="flex gap-12 flex-1">
						<!-- Post Number -->
						<div class="text-xs font-bold tracking-widest text-neutral-400 whitespace-nowrap pt-1">
							<?php echo str_pad( $post_count, 2, '0', STR_PAD_LEFT ); ?> / <?php echo str_pad( $total_posts, 2, '0', STR_PAD_LEFT ); ?>
						</div>

						<!-- Content Block -->
						<div class="flex-1 min-w-0">
							<!-- Tag Indicator -->
							<div class="flex items-center gap-2 mb-3">
								<span class="inline-block w-2 h-2 rounded-full <?php echo $tag_class === 'bg-neutral-900 text-white' ? 'bg-neutral-900' : 'bg-neutral-200'; ?>"></span>
								<span class="text-xs uppercase tracking-widest font-bold <?php echo $tag_class; ?> px-2 py-1 rounded">
									<?php echo $tag_label; ?>
								</span>
							</div>

							<!-- Title -->
							<h2 class="text-2xl md:text-4xl font-bold tracking-tight uppercase mb-3 group-hover:italic transition-all duration-300 break-words">
								<a href="<?php the_permalink(); ?>" class="hover:underline">
									<?php the_title(); ?>
								</a>
							</h2>

							<!-- Date -->
							<time class="text-xs uppercase tracking-widest text-neutral-500 font-medium">
								<?php echo get_the_date( 'M d, Y' ); ?>
							</time>
						</div>
					</div>

					<!-- Right Side - Thumbnail -->
					<?php if ( $thumbnail_url ) : ?>
						<div class="w-32 h-32 md:w-48 md:h-32 flex-shrink-0">
							<a href="<?php the_permalink(); ?>" class="block w-full h-full overflow-hidden">
								<img
									src="<?php echo esc_url( $thumbnail_url ); ?>"
									alt="<?php the_title_attribute(); ?>"
									class="w-full h-full object-cover <?php echo $is_bw ? 'grayscale' : ''; ?> group-hover:scale-110 transition-transform duration-700"
									loading="lazy"
								>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</article>

			<?php
		}

		// Pagination
		?>
		<div class="mt-24 pt-8 border-t-2 border-black">
			<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
				<!-- Previous Link -->
				<div>
					<?php
					$prev_link = get_previous_posts_link( '← Previous' );
					if ( $prev_link ) {
						echo '<a href="' . esc_url( get_previous_posts_page_link() ) . '" class="text-xs uppercase tracking-widest font-bold hover:underline inline-block">' . wp_kses_post( $prev_link ) . '</a>';
					}
					?>
				</div>

				<!-- Page Numbers -->
				<div class="flex items-center justify-center gap-2">
					<?php
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					$max_pages = $wp_query->max_num_pages;

					for ( $i = 1; $i <= $max_pages; $i++ ) {
						if ( $i === $paged ) {
							echo '<span class="text-xs font-bold tracking-widest px-2 py-1">' . $i . '</span>';
						} else {
							$page_link = get_pagenum_link( $i );
							echo '<a href="' . esc_url( $page_link ) . '" class="text-xs text-neutral-400 tracking-widest font-bold hover:text-neutral-900 transition px-2 py-1">' . $i . '</a>';
						}
					}
					?>
				</div>

				<!-- Next Link -->
				<div>
					<?php
					$next_link = get_next_posts_link( 'Next →' );
					if ( $next_link ) {
						echo '<a href="' . esc_url( get_next_posts_page_link() ) . '" class="text-xs uppercase tracking-widest font-bold hover:underline inline-block">' . wp_kses_post( $next_link ) . '</a>';
					}
					?>
				</div>
			</div>
		</div>

	<?php
	} else {
		?>
		<div class="py-16 text-center">
			<p class="text-neutral-500 text-lg">No posts found in this archive.</p>
		</div>
		<?php
	}
	?>
</div>

<?php
get_footer();
