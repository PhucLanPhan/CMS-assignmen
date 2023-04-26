<?php/** * Template part for displaying Multi Buttons * * @link https://developer.wordpress.org/themes/basics/template-hierarchy/ * * @package Real_Home */$multi_button_lists = get_theme_mod(    'real_home_footer_multi_buttons_list',    [        [            'title'     => esc_html__( 'log in / register', 'real-home' ),            'icon'      => 'fa-user-circle-o',            'link'      => '#'        ]    ]);if ( $multi_button_lists ) :    $link_open = get_theme_mod(        'real_home_footer_multi_buttons_link_open',        ''    );    $link_target = ( $link_open && array_key_exists( 'desktop', $link_open ) ) ? '_blank' : '_self';    // Columns per row    $col_per_row = get_theme_mod(        'real_home_footer_multi_buttons_items_per_row',        [            'desktop'           => '1',            'tablet'            => '1',            'mobile'            => '1'        ]    );    ?>    <ul class="footer-buttons-wrap row columns d-flex align-items-center justify-content-between"<?php Real_Home_Helper::get_data_columns( $col_per_row );?>>        <?php foreach ( $multi_button_lists as $list_key => $lists ) : ?>            <li class="column">                <a href="<?php echo esc_url( $lists['link'] ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="d-flex align-items-center flex-column">                    <?php Real_Home_Font_Awesome_Icons::get_icon( 'ui', $lists['icon'] ); ?>                    <h3><?php echo esc_html( $lists['title'] ); ?></h3>                </a>            </li>        <?php endforeach; ?>    </ul><!-- .header-contact-info-wrap --><?php endif; ?>