<?php
/**
 * Single Post Template - Mono Archive Theme
 *
 * Displays a single photo detail page with editorial layout,
 * metadata, related archive section, and navigation.
 */

get_header();
?>

<main>
	<?php while ( have_posts() ) : the_post(); ?>

		<!-- Main Editorial Section -->
		<section class="editorial-grid gap-8 max-w-1440px mx-auto px-8 md:px-12 pt-12 pb-24">
			<div class="grid grid-cols-12">

				<!-- Left Column: Metadata & Info -->
				<div class="col-span-4 flex flex-col justify-end pb-12 order-2 md:order-1">

					<!-- Series/Plate Label -->
					<?php
					$series = mono_archive_get_meta( 'series' );
					$plate = mono_archive_get_meta( 'plate' );
					if ( $series || $plate ) :
					?>
						<p class="text-xs tracking-[0.15em] uppercase font-bold text-outline">
							<?php
							if ( $series && $plate ) {
								echo esc_html( $series ) . ' / Plate ' . esc_html( $plate );
							} elseif ( $series ) {
								echo esc_html( $series );
							} elseif ( $plate ) {
								echo 'Plate ' . esc_html( $plate );
							}
							?>
						</p>
					<?php endif; ?>

					<!-- Title -->
					<h1 class="text-5xl md:text-7xl font-black tracking-tighter uppercase leading-none mt-4">
						<?php the_title(); ?>
					</h1>

					<!-- Metadata Rows -->
					<div class="space-y-0 pt-8">

						<!-- Capture Date -->
						<?php
						$capture_date = mono_archive_get_meta( '_mono_capture_date' );
						if ( $capture_date ) :
						?>
							<div class="flex justify-between py-4 border-b border-outline-variant/10">
								<span class="text-xs tracking-[0.1em] uppercase font-semibold text-outline-variant">Capture Date</span>
								<span class="text-sm tracking-[0.05em] uppercase font-medium"><?php echo esc_html( $capture_date ); ?></span>
							</div>
						<?php endif; ?>

						<!-- Equipment -->
						<?php
						$equipment = mono_archive_get_meta( '_mono_equipment' );
						if ( $equipment ) :
						?>
							<div class="flex justify-between py-4 border-b border-outline-variant/10">
								<span class="text-xs tracking-[0.1em] uppercase font-semibold text-outline-variant">Equipment</span>
								<span class="text-sm tracking-[0.05em] uppercase font-medium"><?php echo esc_html( $equipment ); ?></span>
							</div>
						<?php endif; ?>

						<!-- Settings -->
						<?php
						$settings = mono_archive_get_meta( '_mono_settings' );
						if ( $settings ) :
						?>
							<div class="flex justify-between py-4 border-b border-outline-variant/10">
								<span class="text-xs tracking-[0.1em] uppercase font-semibold text-outline-variant">Settings</span>
								<span class="text-sm tracking-[0.05em] uppercase font-medium"><?php echo esc_html( $settings ); ?></span>
							</div>
						<?php endif; ?>

						<!-- Location -->
						<?php
						$location = mono_archive_get_meta( '_mono_location' );
						if ( $location ) :
						?>
							<div class="flex justify-between py-4 border-b border-outline-variant/10">
								<span class="text-xs tracking-[0.1em] uppercase font-semibold text-outline-variant">Location</span>
								<span class="text-sm tracking-[0.05em] uppercase font-medium"><?php echo esc_html( $location ); ?></span>
							</div>
						<?php endif; ?>

					</div>

					<!-- Request Print Archive Button -->
					<button class="w-full mt-12 bg-primary text-on-primary py-5 text-xs tracking-[0.2em] uppercase font-bold hover:opacity-90 transition-opacity">
						Request Print Archive
					</button>

				</div>

				<!-- Right Column: Hero Image & Actions -->
				<div class="col-span-8 relative order-1 md:order-2">

					<!-- Color/B&W Tag -->
					<?php
					$is_color = mono_archive_get_meta( '_mono_is_color' );
					$tag_text = $is_color ? 'Color' : 'B&W';
					?>
					<div class="absolute top-8 right-8 z-10 glass-container bg-white/80 backdrop-blur border border-outline-variant/10 px-4 py-2 rounded-sm">
						<span class="text-xs tracking-[0.1em] uppercase font-bold text-outline"><?php echo esc_html( $tag_text ); ?></span>
					</div>

					<!-- Hero Image -->
					<figure class="<?php echo $is_color ? 'md:contrast-110' : ''; ?>">
						<?php
						$aspect_class = wp_is_mobile() ? 'aspect-[4/5]' : 'aspect-[3/4]';
						?>
						<div class="<?php echo esc_attr( $aspect_class ); ?> overflow-hidden">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover' ) );
							} else {
								echo '<div class="w-full h-full bg-surface-container-low"></div>';
							}
							?>
						</div>
					</figure>

					<!-- Image Actions & Metadata -->
					<div class="flex justify-between items-center mt-8">

						<!-- Collect & Share Buttons -->
						<div class="flex gap-6">
							<button class="flex items-center gap-2 text-xs tracking-[0.1em] uppercase font-bold text-outline hover:text-primary transition-colors">
								<span class="w-5 h-5 bg-outline rounded-full"></span>
								Collect
							</button>
							<button class="flex items-center gap-2 text-xs tracking-[0.1em] uppercase font-bold text-outline hover:text-primary transition-colors">
								<span class="w-5 h-5 bg-outline rounded-full"></span>
								Share
							</button>
						</div>

						<!-- Exposure EV -->
						<?php
						$exposure_ev = mono_archive_get_meta( '_mono_exposure_ev' );
						if ( $exposure_ev ) :
						?>
							<span class="text-xs tracking-[0.05em] uppercase font-medium text-outline-variant">
								EV <?php echo esc_html( $exposure_ev ); ?>
							</span>
						<?php endif; ?>

					</div>

				</div>

			</div>
		</section>

		<!-- Post Content (if present) -->
		<?php
		$content = get_the_content();
		if ( trim( $content ) ) :
		?>
			<section class="max-w-1440px mx-auto px-8 md:px-12 py-12 prose prose-invert max-w-none">
				<?php the_content(); ?>
			</section>
		<?php endif; ?>

		<!-- Related Archive Section -->
		<?php
		$related_posts = get_posts( array(
			'posts_per_page' => 3,
			'post__not_in'   => array( get_the_ID() ),
			'category__in'   => wp_get_post_categories( get_the_ID() ),
			'orderby'        => 'date',
			'order'          => 'DESC',
		) );

		if ( ! empty( $related_posts ) ) :
		?>
			<section class="bg-surface-container-low py-24 px-8 md:px-12">
				<div class="max-w-1440px mx-auto">

					<!-- Section Label -->
					<h2 class="text-xs tracking-[0.3em] uppercase font-bold text-outline mb-12">
						Related Archive
					</h2>

					<!-- Related Grid -->
					<div class="grid grid-cols-1 md:grid-cols-3 gap-12">
						<?php foreach ( $related_posts as $related_post ) : setup_postdata( $related_post ); ?>

							<article class="group cursor-pointer">
								<!-- Thumbnail -->
								<div class="aspect-square overflow-hidden grayscale hover:grayscale-0 transition-all duration-300">
									<?php
									if ( has_post_thumbnail( $related_post->ID ) ) {
										echo get_the_post_thumbnail( $related_post->ID, 'medium_large', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300' ) );
									} else {
										echo '<div class="w-full h-full bg-surface-container"></div>';
									}
									?>
								</div>

								<!-- Title -->
								<h3 class="text-xs tracking-[0.1em] uppercase font-bold mt-6 group-hover:text-primary transition-colors duration-300">
									<a href="<?php echo esc_url( get_permalink( $related_post->ID ) ); ?>">
										<?php echo esc_html( get_the_title( $related_post->ID ) ); ?>
									</a>
								</h3>
							</article>

						<?php endforeach; wp_reset_postdata(); ?>
					</div>

				</div>
			</section>
		<?php endif; ?>

		<!-- Post Navigation -->
		<nav class="max-w-1440px mx-auto px-8 md:px-12 py-12 flex justify-between items-center border-t border-outline-variant/10">
			<div class="flex-1">
				<?php
				$prev_post = get_previous_post();
				if ( $prev_post ) :
				?>
					<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="text-xs tracking-[0.1em] uppercase font-bold text-outline-variant hover:text-primary transition-colors">
						← Previous
					</a>
				<?php endif; ?>
			</div>

			<div class="flex-1 text-center">
				<a href="<?php echo esc_url( home_url( '/archive' ) ); ?>" class="text-xs tracking-[0.1em] uppercase font-bold text-outline-variant hover:text-primary transition-colors">
					Back to Archive
				</a>
			</div>

			<div class="flex-1 text-right">
				<?php
				$next_post = get_next_post();
				if ( $next_post ) :
				?>
					<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="text-xs tracking-[0.1em] uppercase font-bold text-outline-variant hover:text-primary transition-colors">
						Next →
					</a>
				<?php endif; ?>
			</div>
		</nav>

	<?php endwhile; ?>
</main>

<?php get_footer(); ?>
