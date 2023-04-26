<?php
/**
 * Template part for displaying front page why us section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */

$service_page = get_theme_mod( 'real_home_front_page_services_page', '' );
if ( $service_page && $service_page !== '' ) :
	$args = [
		'post_type' 			=> 'page',
		'p'						=> absint($service_page)
	];
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
		$section_heading = get_theme_mod(
			'real_home_front_page_services_section_heading',
			esc_html__( 'why people choose us', 'real-home' )
		);
		?>
		<section class="why-choose-us-section block-base-page-section">
			<div class="container">
				<?php if ( $section_heading ) : ?>
					<header class="entry-header heading">
						<h2 class="entry-title"><?php echo esc_html( $section_heading ); ?></h2>
					</header>
				<?php endif; ?>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="post block-content">
						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->
					</div>
					<?php wp_reset_postdata(); ?>
				<?php endwhile; ?>
			</div>
		</section><!-- .why-choose-us-section -->
	<?php endif;
endif; ?>
