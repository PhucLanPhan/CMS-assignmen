<?php
/**
 * Template part for displaying front page featured properties section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */

if ( ! Real_Home_Helper::crucial_real_state_plugin() )
    return;

$section_heading = get_theme_mod(
    'real_home_front_page_featured_properties_section_heading',
    esc_html__( 'Feature Listings', 'real-home' )
);
$posts_limit = get_theme_mod(
    'real_home_front_page_featured_properties_limit',
    ['desktop' => 3 ]
);

$col_per_row = [
	'desktop'           => '3',
	'tablet'            => '2',
	'mobile'            => '1'
];
$args = array(
    'post_type'             => 'property',
    'meta_query'            => [
        [
            'key'           => 'cre_featured',
            'value'         => '1'
        ]
    ],
    'posts_per_page'        => absint($posts_limit['desktop']),
    'no_found_rows'         => true,
    'ignore_sticky_posts'   => true
);


$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) :
?>
<section class="featured-properties-section">
    <!-- featured properties starting from here -->
    <div class="container">

        <?php if ( $section_heading ) : ?>
            <header class="entry-header heading">
                <h2 class="entry-title"><?php echo esc_html( $section_heading ); ?></h2>
            </header>
        <?php endif; ?>

        <div class="row columns"<?php Real_Home_Helper::get_data_columns( $col_per_row );?>>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); $meta_data = get_post_meta( get_the_ID() ); ?>
                <div class="column">
                    <div class="post">

                        <div class="featured-image-wrapper">
                            <?php real_home_post_thumbnail( 'medium_large', '16x9' ); ?>
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
										<?php cre_social_share();?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif;
