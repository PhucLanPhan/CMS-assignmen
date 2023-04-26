<?php
/**
 * Template part for displaying front page header banner slider content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */
if ( ! Real_Home_Helper::crucial_real_state_plugin() ) {
	return;
}

$slides_limit = get_theme_mod(
	'real_home_front_page_banner_slider_limit',
	array( 'desktop' => 5 )
);
// Arguments
$args = array(
	'post_type'           => 'property',
	'posts_per_page'      => absint( $slides_limit['desktop'] ),
	'meta_query'          => array(
		array(
			'key'   => 'cre_add_in_slider',
			'value' => 'yes',
		),
	),
	'no_found_rows'       => true,
	'ignore_sticky_posts' => true,
);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) : ?>

	<section class="featured-slider">
		<div class="banner-slider">
			<?php
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				?>
				<div class="slider-item">

					<?php
					if ( $slider_image = get_post_meta( get_the_ID(), 'cre_slider_image', true ) ) :
						$img_url = wp_get_attachment_image_src( $slider_image, 'full' );
						$img_url = $img_url[0];
						?>
						<figure class="featured-image" data-ratio="16x9">
							<img src="<?php echo esc_url( $img_url ); ?>">
						</figure>
					<?php else : ?>
						<?php real_home_post_thumbnail( 'full', '16x9' ); ?>
					<?php endif; ?>

					<div class="slider-text justify-content-left">
						<div class="post">
							<div class="post-detail-wrap">
								<?php
								$status_terms = wp_get_post_terms( get_the_ID(), 'property-status', array( 'orderby' => 'term_order' ) );
								$type_terms   = wp_get_post_terms( get_the_ID(), 'property-type', array( 'orderby' => 'term_order' ) );
								if ( $status_terms || $type_terms ) :
									?>
									<div class="post-tags-wrap">

										<?php if ( $type_terms ) : ?>
											<?php foreach ( $type_terms as $type_term ) : ?>
												<a href="<?php echo esc_url( get_term_link( $type_term->slug, 'property-type' ) ); ?>" class="post-tags property-type-<?php echo esc_attr( $type_term->term_id ); ?>"><?php echo esc_html( $type_term->name ); ?></a>
											<?php endforeach; ?>
										<?php endif; ?>

										<?php if ( $status_terms ) : ?>
											<?php foreach ( $status_terms as $status_term ) : ?>
												<a href="<?php echo esc_url( get_term_link( $status_term->slug, 'property-status' ) ); ?>" class="post-tags property-status-<?php echo esc_attr( $status_term->term_id ); ?>"><?php echo esc_html( $status_term->name ); ?></a>
											<?php endforeach; ?>
										<?php endif; ?>
									</div><!-- .post-tags-wrap -->
								<?php endif; ?>
								<header class="entry-header">
									<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
								</header><!-- .entry-header -->

								<div class="entry-content">
									<?php Real_Home_Helper::post_excerpt(); ?>
								</div><!-- .entry-content -->

								<div class="property-meta entry-meta">
									<?php
									if ( CRE()->version > '1.0.2' ) {
										$options = map_deep( wp_unslash( get_option( 'cre_property_basic_builder' ) ), 'sanitize_text_field' );
										$options = ( $options ) ? $options : cre_property_basic_default_fields();
										unset ($options[count($options)-1]);
										foreach ( $options as $key => $value) {
											$field_id = 'cre_property_basic_builder_' . intval( $key );
											$basic_fields = get_post_meta( get_the_ID(), $field_id );
											if ( $basic_fields && !empty($basic_fields) ) { ?>
												<div class="meta-wrapper">
													<span class="meta-icon">
														<?php if( isset( $value['image'] ) && $value['image'] != '' ) {
															$image_src = absint( $value['image'] ) ? wp_get_attachment_url( $value['image'] ) : $value['image'];
															?>
															<img src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_attr($value['name']); ?>" width="20" height="20">
														<?php } else { ?>
															<i class="fas <?php echo esc_attr( $value['icon'] ); ?>"></i>
														<?php }?>
													</span>
													<?php if ( isset( $basic_fields[0]) ) : ?>
														<span class="meta-value"><?php echo esc_html( $basic_fields[0] ); ?></span>
													<?php endif; ?>
													<?php if ( isset( $basic_fields[1]) ) : ?>
														<span class="meta-unit"><?php echo esc_html( $basic_fields[1] ); ?></span>
													<?php endif; ?>
												</div>

											<?php 
											}
										} 
									} ?>
								</div>
								<div class="property-meta-info">
									<div class="properties-price">
										<?php cre_property_price(); ?>
									</div>
									<div class="share-section">
										<a href="javascript:void(0);" target="_self">
											<i class="fa fa-share-alt"></i>
										</a>
										<div class="block-social-icons social-links">
											<?php cre_social_share(); ?>
										</div>
									</div>
								</div>
							</div>
						</div><!-- .post -->
					</div><!-- .slider-text -->
				</div><!-- .slider-item -->
				<?php wp_reset_postdata(); ?>
			<?php endwhile; ?>
		</div><!-- .banner-slider -->
	</section><!-- .featured-slider -->

	<?php
endif;
