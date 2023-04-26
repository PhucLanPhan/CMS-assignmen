<?php
/**
 * Template part for displaying front page property location content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */

if ( ! Real_Home_Helper::crucial_real_state_plugin() )
	return;

$query_args	= [
	'hide_empty'	=> true
];

$limit = get_theme_mod(
	'real_home_front_page_property_locations_limits',
	['desktop' => 6 ]
);
$property_location 	= 'property-location'; //get the tags
$location_limits   	= ( is_page_template( 'page-templates/location.php' ) ) ? get_option( 'posts_per_page' ) : $limit['desktop']; // number of terms to display per page
$location_paged     = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$offset				= ( $location_paged > 0 ) ?  $location_limits * ( $location_paged - 1 ) : 1;
$max   				= wp_count_terms( $property_location, array( 'hide_empty' => TRUE ) );
$totalpages 		= ceil( $max / $location_limits );

// Setup the arguments
$args = array(
	'offset'       	=> $offset,
	'number'       	=> absint($location_limits),
	'orderby'      	=> 'count',
	'order'        	=> 'DESC',
	'hide_empty'	=> true
);
$term_query = get_terms($property_location, $args);
if ( ! empty( $term_query ) ) :

	$section_heading = get_theme_mod(
		'real_home_front_page_property_locations_section_heading',
		esc_html__( 'Reality Property Location', 'real-home' )
	);
	$col_per_row = [
		'desktop'           => '3',
		'tablet'            => '2',
		'mobile'            => '1'
	];
	$term_data = cre_get_term_data();
	ob_start();
	?>
	<div class="property-location-wrap">
		<div class="row columns"<?php Real_Home_Helper::get_data_columns( $col_per_row );?>>
			<?php foreach ( $term_query as $location_term ) :
				$term_image = ( $term_data && isset( $term_data[$location_term->term_id] ) ) ? $term_data[$location_term->term_id]['cre_property_taxonomy_image'] : null; ?>
				<div class="column">
					<article class="post">
						<figure class="featured-image" data-ratio="auto">
							<?php if ( $term_image ) : ?>
								<img src="<?php echo esc_url( wp_get_attachment_url( $term_image ) ); ?>" alt="<?php echo esc_attr( $location_term->name ); ?>" />
							<?php else: ?>
								<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQImWNgYGBgAAAABQABh6FO1AAAAABJRU5ErkJggg==" alt="<?php echo esc_attr( $location_term->name ); ?>" />
							<?php endif; ?>
						</figure>
						<div class="post-content">
							<header class="entry-header">
								<h4 class="entry-title">
									<a href="<?php echo esc_url( get_category_link( $location_term->term_id ) ); ?>">
										<?php echo esc_html( $location_term->name ); ?>
									</a>
								</h4>
							</header>
							<div class="post-properties">
                                        <span>
                                            <a href="<?php echo esc_url( get_category_link( $location_term->term_id ) ); ?>">
                                                <?php
												printf(
												/* translators: 1: title. */
													esc_html__( '%1$d Properties', 'real-home' ),
													absint( $location_term->count )
												);
												?>
                                            </a>
                                        </span>
							</div>
						</div>
					</article>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
		$enable_view_all 	= get_theme_mod('real_home_front_page_property_location_view_all_btn', '');
		if ( $enable_view_all && array_key_exists( 'desktop', $enable_view_all ) && !is_page_template( 'page-templates/location.php' )) :
			$view_all_link 	= get_theme_mod('real_home_front_page_property_locations_view_all_btn_link', '#' );
			?>
			<div class="d-flex justify-content-center btn-wrap">
				<span class="box-button view-all-btn"><a href="<?php echo esc_url( $view_all_link ); ?>"><?php esc_html_e( 'View All', 'real-home' ); ?></a></span>
			</div>

		<?php
		endif;
		?>
	</div><!-- .property-location-wrap -->
	<?php
	$output = ob_get_clean();

	if ( is_page_template( 'page-templates/location.php' ) ) :
		echo apply_filters( 'real_home_location_wrap', $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		// Show custom page navigation
		cre_page_navigation( $totalpages, $location_paged, 3, 0 );
	else: ?>
		<section class="property-location-section">
			<div class="container">
				<?php if ( $section_heading && !is_page_template( 'page-templates/location.php' ) ) : ?>
					<header class="entry-header heading">
						<h2 class="entry-title"><?php echo esc_html( $section_heading ); ?></h2>
					</header>
				<?php endif; ?>
				<?php echo apply_filters( 'real_home_location_wrap', $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</section>
	<?php endif; ?>
<?php endif; ?>
