<?php
/**
 * Mono Archive - Main Template
 *
 * The homepage/main template for the Mono Archive WordPress theme.
 * Displays editorial header, asymmetric bento grid of posts, and newsletter signup.
 *
 * @package MonoArchive
 */

get_header();
?>

<main id="primary" class="site-main">
	<!-- Editorial Header Section -->
	<section class="mono-editorial-header py-16 md:py-24 px-4 md:px-8">
		<div class="grid grid-cols-12 gap-8 md:gap-12">
			<!-- Left Column: Massive Title -->
			<div class="col-span-12 md:col-span-5">
				<h1 class="mono-title-massive text-7xl md:text-8xl font-black tracking-tighter uppercase leading-[0.85]">
					<?php echo esc_html( apply_filters( 'mono_archive_main_title', 'The Digital Archive' ) ); ?>
				</h1>
			</div>

			<!-- Right Column: Established Label & Description -->
			<div class="col-span-12 md:col-start-7 md:col-span-5">
				<div class="mono-header-content">
					<p class="mono-established-label text-sm font-semibold tracking-widest uppercase mb-6 opacity-60">
						<?php echo esc_html( apply_filters( 'mono_archive_established_label', 'Established MMXXIV' ) ); ?>
					</p>
					<p class="mono-header-description text-base md:text-lg leading-relaxed">
						<?php echo wp_kses_post( apply_filters( 'mono_archive_header_description', 'A curatorial collection of visual moments and editorial explorations. Meticulously archived and thoughtfully presented.' ) ); ?>
					</p>
				</div>
			</div>
		</div>
	</section>

	<!-- Asymmetric Bento Grid Section -->
	<section class="mono-bento-grid-section px-4 md:px-8 py-12 md:py-20">
		<div class="grid grid-cols-12 gap-1 md:gap-4">
			<?php
			$post_counter = 0;

			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					$post_counter++;

					// Determine grid position based on counter
					$grid_class = '';
					$aspect_ratio = '';
					$post_type = 'image'; // Default type
					$image_type = get_post_meta( get_the_ID(), '_mono_image_type', true ); // 'bw' or 'color'

					switch ( $post_counter ) {
						case 1:
							// Hero post: 8 columns, 16:9 aspect
							$grid_class = 'col-span-12 md:col-span-8';
							$aspect_ratio = 'aspect-video';
							$post_type = 'image';
							break;
						case 2:
							// Vertical post: 4 columns, 4:5 aspect
							$grid_class = 'col-span-12 md:col-span-4';
							$aspect_ratio = 'aspect-4/5';
							$post_type = 'image';
							break;
						case 3:
							// Text-only curated rhythm card
							$grid_class = 'col-span-12 md:col-span-4';
							$aspect_ratio = '';
							$post_type = 'text';
							break;
						case 4:
							// Small grid: 4 columns, square
							$grid_class = 'col-span-12 sm:col-span-6 md:col-span-4';
							$aspect_ratio = 'aspect-square';
							$post_type = 'image';
							break;
						case 5:
							// Small grid: 4 columns, square
							$grid_class = 'col-span-12 sm:col-span-6 md:col-span-4';
							$aspect_ratio = 'aspect-square';
							$post_type = 'image';
							break;
						case 6:
							// Extra tall: 3 columns, 3:4 aspect
							$grid_class = 'col-span-12 sm:col-span-6 md:col-span-3';
							$aspect_ratio = 'aspect-3/4';
							$post_type = 'image';
							break;
						case 7:
							// Ultra wide: 9 columns, 21:9 aspect
							$grid_class = 'col-span-12 md:col-span-9';
							$aspect_ratio = 'aspect-21/9';
							$post_type = 'image';
							break;
						default:
							// Default fallback
							$grid_class = 'col-span-12 md:col-span-4';
							$aspect_ratio = 'aspect-square';
							$post_type = 'image';
							break;
					}

					// Render the bento item
					if ( 'text' === $post_type ) {
						// Text-only card (Post 3: Curated Rhythm)
						?>
						<article class="mono-bento-item mono-bento-text <?php echo esc_attr( $grid_class ); ?> p-6 md:p-8 bg-white border border-gray-200 flex flex-col justify-between">
							<div>
								<h3 class="mono-section-title text-lg md:text-xl font-black uppercase tracking-tighter mb-4">
									<?php echo esc_html( apply_filters( 'mono_archive_curated_rhythm_title', 'Curated Rhythm' ) ); ?>
								</h3>
								<p class="mono-description text-sm md:text-base leading-relaxed opacity-70 mb-6">
									<?php the_excerpt(); ?>
								</p>
							</div>
							<a href="<?php the_permalink(); ?>" class="mono-link inline-block text-sm font-semibold uppercase tracking-widest border-b-2 border-black hover:opacity-60 transition-opacity">
								<?php echo esc_html( apply_filters( 'mono_archive_view_collection', 'View Collection' ) ); ?>
							</a>
						</article>
						<?php
					} else {
						// Image posts
						$has_thumbnail = has_post_thumbnail();
						$grayscale_class = ( 'bw' === $image_type ) ? 'grayscale' : '';

						?>
						<article class="mono-bento-item mono-bento-image <?php echo esc_attr( $grid_class ); ?> <?php echo esc_attr( $aspect_ratio ); ?> relative overflow-hidden bg-gray-100 group">
							<?php if ( $has_thumbnail ) : ?>
								<!-- Featured Image -->
								<div class="mono-image-wrapper absolute inset-0 <?php echo esc_attr( $grayscale_class ); ?>">
									<?php
									the_post_thumbnail(
										'mono-archive-featured',
										array(
											'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-700',
											'alt'   => get_the_title(),
										)
									);
									?>
								</div>

								<!-- Image Type Tag -->
								<div class="mono-image-tag absolute top-4 left-4 z-10">
									<?php mono_archive_image_tag( $image_type ); ?>
								</div>

								<!-- Gradient Overlay (for hero and other images) -->
								<div class="mono-overlay-gradient absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/40 z-5"></div>

								<!-- Bottom Overlay Content -->
								<div class="mono-overlay-content absolute bottom-0 left-0 right-0 p-4 md:p-6 z-20 text-white">
									<h2 class="mono-post-title text-lg md:text-2xl font-black uppercase leading-tight tracking-tighter mb-2">
										<?php the_title(); ?>
									</h2>

									<?php
									// Display series/category meta
									$categories = get_the_category();
									if ( ! empty( $categories ) ) {
										echo '<p class="mono-post-series text-xs md:text-sm font-semibold uppercase tracking-widest opacity-80">';
										echo esc_html( $categories[0]->name );
										echo '</p>';
									}
									?>
								</div>
							<?php endif; ?>

							<!-- Special overlay for "The Void" (Post 7) -->
							<?php if ( 7 === $post_counter ) : ?>
								<div class="mono-void-overlay absolute inset-0 flex items-center justify-center z-15">
									<p class="text-white text-4xl md:text-6xl font-black uppercase tracking-tighter opacity-20">
										<?php echo esc_html( apply_filters( 'mono_archive_void_text', 'The Void' ) ); ?>
									</p>
								</div>
							<?php endif; ?>
						</article>
						<?php
					}

					// Stop after 7 items (or modify based on your needs)
					if ( 7 === $post_counter ) {
						break;
					}

				endwhile;
			endif;

			wp_reset_postdata();
			?>
		</div>
	</section>

	<!-- Newsletter Signup Section -->
	<?php if ( is_front_page() ) : ?>
		<section class="mono-newsletter-section py-16 md:py-24 px-4 md:px-8 border-t border-gray-300">
			<div class="max-w-3xl mx-auto">
				<!-- Newsletter Heading -->
				<h2 class="mono-newsletter-title text-5xl md:text-6xl font-black uppercase tracking-tighter leading-tight text-center mb-4">
					<?php echo esc_html( apply_filters( 'mono_archive_newsletter_title', 'Stay Curated' ) ); ?>
				</h2>

				<!-- Newsletter Subtitle -->
				<p class="mono-newsletter-subtitle text-center text-base md:text-lg opacity-70 mb-12">
					<?php echo wp_kses_post( apply_filters( 'mono_archive_newsletter_subtitle', 'Bi-weekly editorial drops delivered to your inbox.' ) ); ?>
				</p>

				<!-- Newsletter Form -->
				<form class="mono-newsletter-form flex flex-col sm:flex-row gap-0 justify-center items-center" action="#" method="post">
					<input
						type="email"
						name="mono_newsletter_email"
						class="mono-newsletter-input flex-1 sm:flex-none w-full sm:w-auto bg-transparent border-0 border-b-2 border-black px-4 py-3 text-center sm:text-left uppercase placeholder:uppercase text-sm md:text-base focus:outline-none focus:border-gray-600 transition-colors"
						placeholder="<?php echo esc_attr( apply_filters( 'mono_archive_newsletter_placeholder', 'Enter your email' ) ); ?>"
						required
					/>
					<button
						type="submit"
						class="mono-newsletter-button mt-4 sm:mt-0 sm:ml-6 bg-black text-white font-semibold uppercase tracking-[0.3em] px-8 py-3 hover:bg-gray-800 transition-colors text-sm md:text-base"
					>
						<?php echo esc_html( apply_filters( 'mono_archive_newsletter_button', 'Subscribe' ) ); ?>
					</button>
				</form>
			</div>
		</section>
	<?php endif; ?>

</main>

<?php
get_footer();
