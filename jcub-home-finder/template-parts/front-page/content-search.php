<?php
/**
 * Template part for displaying front page search section content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */

if ( ! Real_Home_Helper::crucial_real_state_plugin() )
    return;

$search_tabs = get_theme_mod(
    'real_home_front_page_search_tabs',
    ''
);

if ( $search_tabs ) : ?>
<section class="properties-search-section">
    <div class="container">
        <div class="custom-tabs">
            <ul class="tab-links">
                <?php foreach ( $search_tabs as $key => $tab ) : ?>
                    <?php if ( ! empty( $tab['cat_slug'] ) ) : $term = get_term_by('slug', $tab['cat_slug'], 'property-type'); ?>
                        <?php if ( $term ) : ?>
                            <li <?php if ( $key == 0 ) { ?>class="active"<?php } ?>>
                                <a href="#<?php echo esc_attr( $term->slug); ?>"><?php echo esc_html( $term->name ); ?></a>
                            </li>
                        <?php endif; ?>

                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content">
                <?php foreach ( $search_tabs as $key => $tab ) : ?>
                    <?php if ( ! empty( $tab['cat_slug'] ) ) : $term = get_term_by('slug', $tab['cat_slug'], 'property-type'); ?>
                        <?php if ( $term ) : ?>
                            <div id="<?php echo esc_attr( $term->slug); ?>" class="tab<?php if ( $key == 0 ) { ?> active<?php } ?>">
                                <div class="properties-search-wrap">
                                    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="GET">
                                        <div class="d-flex properties-search-fields">
                                            <input type="search" class="search-field" name='s' placeholder="<?php esc_attr_e( 'Search property....', 'real-home' ); ?>"  value="<?php echo esc_attr( get_search_query() ); ?>">
                                            <input type="hidden" name="property-type" value="<?php echo esc_attr( $term->slug ); ?>" />
                                            <input class="search-submit" value="<?php esc_attr_e( 'Search', 'real-home' ); ?>" type="submit">
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <!-- .tab-content -->
        </div>
    </div>
</section>
<?php endif;
