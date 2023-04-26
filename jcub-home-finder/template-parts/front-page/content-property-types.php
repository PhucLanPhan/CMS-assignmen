<?php
/**
 * Template part for displaying front page buy rent section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */

if ( ! Real_Home_Helper::crucial_real_state_plugin() )
	return;

$property_types = get_theme_mod(
	'real_home_front_page_property_types',
	''
);

if ( $property_types ) :

	$col_per_row = [
		'desktop'           => '3',
		'tablet'            => '2',
		'mobile'            => '1'
	];
	$post_limits = get_theme_mod('real_home_front_page_property_type_limits',['desktop' => 6]);
	?>
	<section class="buy-rent-section">
		<div class="container">
			<div class="custom-tabs">
				<ul class="tab-links">
					<?php foreach ( $property_types as $property_key => $property_type ) : ?>
						<?php if ( ! empty( $property_type['cat_slug'] ) ) : $property_term_type = get_term_by('slug', $property_type['cat_slug'], 'property-type'); ?>
							<?php if ( $property_term_type ) : ?>
								<li <?php if ( $property_key == 0 ) { ?>class="active"<?php } ?>>
									<a href="#<?php echo esc_attr( $property_term_type->slug); ?>"><?php echo esc_html( $property_term_type->name ); ?></a>
								</li>
							<?php endif; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
				<div class="tab-content">
					<?php foreach ( $property_types as $property_key => $property_type ) : ?>
						<?php if ( ! empty( $property_type['cat_slug'] ) ) : $property_term_type = get_term_by('slug', $property_type['cat_slug'], 'property-type'); ?>
							<?php if ( $property_term_type ) : ?>
								<div id="<?php echo esc_attr( $property_term_type->slug); ?>" class="tab<?php if ( $property_key == 0 ) { ?> active<?php } ?>">

									<?php
									// Arguments
									$args = [
										'post_type'             => 'property',
										'tax_query'             => array(
											array(
												'taxonomy'          => 'property-type',   // taxonomy name
												'field'             => 'term_id',         // term_id, slug or name
												'terms'             => $property_term_type->term_id,    // term id, term slug or term name
											)
										),
										'posts_per_page'        => absint($post_limits['desktop']),
										'no_found_rows'         => true,
										'ignore_sticky_posts'   => true
									];
									$the_query = new WP_Query( $args );
									?>
									<?php if ( $the_query->have_posts() ) : ?>
										<div class="row columns"<?php Real_Home_Helper::get_data_columns( $col_per_row );?>>
											<?php while ( $the_query->have_posts() ) : $the_query->the_post();
												$meta_data = get_post_meta( get_the_ID() );
												?>
												<div class="column">
													<div class="post">
														<div class="featured-image-wrapper">
															<?php cre_post_thumbnail( 'medium_large', '4x3' ); ?>
															<?php cre_display_property_label(); ?>
														</div><!-- .featured-image-wrapper -->
														<div class="post-detail-wrap">

															<?php
															$status_terms   = wp_get_post_terms( get_the_ID(), 'property-status', [ 'orderby' => 'term_order' ] );
															$type_terms     = wp_get_post_terms( get_the_ID(), 'property-type', [ 'orderby' => 'term_order' ] );
															if ( $status_terms || $type_terms ) : ?>
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
													</div>
												</div>

												<?php wp_reset_postdata(); ?>
											<?php endwhile; ?>
										</div>
									<?php endif; ?>
									<?php
									$enable_view_all 	= get_theme_mod('real_home_front_page_property_type_view_all_btn', '');
									if ( $enable_view_all && array_key_exists( 'desktop', $enable_view_all ) ) : ?>
										<div class="d-flex justify-content-center btn-wrap">
											<span class="box-button view-all-btn"><a href="<?php echo esc_url( get_category_link( $property_term_type->term_id ) ); ?>"><?php esc_html_e( 'View All', 'real-home' ); ?></a></span>
										</div>
									<?php
									endif;
									?>
								</div>

							<?php endif; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
				<!-- .tab-content -->
			</div>
			<!-- custom-tabs -->
		</div>
	</section>
<?php endif;
