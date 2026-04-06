<?php
/**
 * Template Name: About & Contact
 * Description: About and Contact page template for Mono Archive theme
 */

get_header(); ?>

<main class="min-h-screen bg-surface-container">
	<div class="max-w-7xl mx-auto px-4 md:px-8">

		<!-- Hero Section -->
		<section class="grid grid-cols-12 gap-16 items-start mb-32 pt-12 md:pt-20">

			<!-- Left Content -->
			<div class="col-span-12 md:col-span-5">
				<div class="mb-8">
					<div class="flex items-center gap-2 mb-6">
						<span class="w-2 h-2 bg-red-500 rounded-full"></span>
						<span class="text-xs uppercase tracking-widest font-medium text-outline-variant">Identity & Curation</span>
					</div>
				</div>

				<h1 class="text-6xl md:text-8xl font-black tracking-tighter leading-[0.9] mb-12 text-surface-inverse">
					THE VOICE BEHIND THE ARCHIVE.
				</h1>

				<div class="space-y-6 text-lg leading-relaxed text-outline-variant max-w-lg">
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							the_content();
						}
					}
					?>
				</div>
			</div>

			<!-- Right Featured Image -->
			<div class="col-span-12 md:col-span-7">
				<div class="aspect-[4/5] bg-surface-container-low overflow-hidden relative">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'full', array(
							'class' => 'w-full h-full object-cover grayscale contrast-125 brightness-90 hover:brightness-100 transition-all duration-500',
							'alt'   => get_the_title(),
						) );
					} else {
						echo '<div class="w-full h-full bg-outline-variant/10"></div>';
					}
					?>

					<!-- Collection Tag -->
					<div class="absolute top-6 right-6 flex items-center gap-2 bg-surface-container/95 backdrop-blur-sm px-4 py-3 text-xs uppercase tracking-widest font-bold">
						<span class="w-2 h-2 bg-red-500 rounded-full"></span>
						<span>COLLECTION 01</span>
					</div>
				</div>
			</div>

		</section>

		<!-- Contact Section -->
		<section class="grid grid-cols-12 gap-16 border-t border-outline-variant/20 pt-24 pb-32">

			<!-- Direct Access -->
			<div class="col-span-12 md:col-span-4">
				<h2 class="text-3xl md:text-4xl font-black tracking-tighter mb-12 text-surface-inverse">
					DIRECT ACCESS
				</h2>

				<div class="space-y-8">
					<!-- Email -->
					<div>
						<p class="text-xs uppercase tracking-widest font-medium text-outline-variant mb-2">Email</p>
						<a href="mailto:studio@curator.digital" class="text-lg md:text-xl font-medium text-surface-inverse hover:text-primary transition-colors duration-300">
							studio@curator.digital
						</a>
					</div>

					<!-- Social Links -->
					<div>
						<p class="text-xs uppercase tracking-widest font-medium text-outline-variant mb-4">Social</p>
						<div class="space-y-3">
							<a href="#" class="flex items-center gap-2 text-surface-inverse hover:translate-x-1 transition-transform duration-300">
								<span class="w-1 h-1 bg-red-500 rounded-full"></span>
								<span>Instagram</span>
							</a>
							<a href="#" class="flex items-center gap-2 text-surface-inverse hover:translate-x-1 transition-transform duration-300">
								<span class="w-1 h-1 bg-red-500 rounded-full"></span>
								<span>Behance</span>
							</a>
							<a href="#" class="flex items-center gap-2 text-surface-inverse hover:translate-x-1 transition-transform duration-300">
								<span class="w-1 h-1 bg-red-500 rounded-full"></span>
								<span>LinkedIn</span>
							</a>
						</div>
					</div>

					<!-- Location -->
					<div>
						<p class="text-xs uppercase tracking-widest font-medium text-outline-variant mb-2">Location</p>
						<p class="text-surface-inverse">Berlin, Germany</p>
					</div>
				</div>
			</div>

			<!-- Initiate Contact Form -->
			<div class="col-span-12 md:col-span-8">
				<h2 class="text-3xl md:text-4xl font-black tracking-tighter mb-12 text-surface-inverse">
					INITIATE CONTACT
				</h2>

				<form class="space-y-8" method="POST" action="#">
					<!-- Full Identity -->
					<div>
						<label for="contact-name" class="block text-xs uppercase tracking-widest font-medium text-outline-variant mb-3">Full Identity</label>
						<input
							type="text"
							id="contact-name"
							name="name"
							required
							class="w-full bg-transparent border-0 border-b border-outline-variant/30 outline-none px-0 py-3 text-lg text-surface-inverse placeholder-outline-variant/40 focus:border-primary focus:outline-variant/30 transition-colors duration-300"
							placeholder="Your name"
						>
					</div>

					<!-- Return Path (Email) -->
					<div>
						<label for="contact-email" class="block text-xs uppercase tracking-widest font-medium text-outline-variant mb-3">Return Path</label>
						<input
							type="email"
							id="contact-email"
							name="email"
							required
							class="w-full bg-transparent border-0 border-b border-outline-variant/30 outline-none px-0 py-3 text-lg text-surface-inverse placeholder-outline-variant/40 focus:border-primary focus:outline-variant/30 transition-colors duration-300"
							placeholder="your@email.com"
						>
					</div>

					<!-- Objective (Message) -->
					<div>
						<label for="contact-message" class="block text-xs uppercase tracking-widest font-medium text-outline-variant mb-3">Objective</label>
						<textarea
							id="contact-message"
							name="message"
							required
							rows="6"
							class="w-full bg-transparent border-0 border-b border-outline-variant/30 outline-none px-0 py-3 text-lg text-surface-inverse placeholder-outline-variant/40 focus:border-primary focus:outline-variant/30 transition-colors duration-300 resize-none"
							placeholder="What brings you here?"
						></textarea>
					</div>

					<!-- Submit Button -->
					<div class="pt-4">
						<button
							type="submit"
							class="inline-flex items-center gap-3 bg-primary text-white uppercase tracking-widest font-bold text-sm px-8 py-4 hover:bg-primary/90 transition-colors duration-300"
						>
							SEND
							<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
							</svg>
						</button>
					</div>
				</form>
			</div>

		</section>

	</div>
</main>

<?php get_footer(); ?>
