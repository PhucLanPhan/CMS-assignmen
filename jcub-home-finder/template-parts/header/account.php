<?php
/**
 * Template part for displaying Account
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */

// Login
$login_text = get_theme_mod(
    'real_home_header_account_login_text',
    esc_html__( 'My Account', 'real-home' )
);
$login_url = get_theme_mod(
    'real_home_header_account_login_url',
    '#'
);

// Logout
$logout_text = get_theme_mod(
    'real_home_header_account_logout_text',
    esc_html__( 'Log In', 'real-home' )
);
$logout_url = get_theme_mod(
    'real_home_header_account_logout_url',
    wp_login_url()
);

$link_open = get_theme_mod(
    'real_home_header_account_url_target',
    ''
);

$link_target = ( $link_open && array_key_exists( 'desktop', $link_open ) ) ? '_blank' : '_self';

// Login
if ( is_user_logged_in() || is_customize_preview() ) {

    $account_url    = $login_url;
    $account_text   = $login_text;
}
else {
    $account_url    = $logout_url;
    $account_text   = $logout_text;
}
?>

<div class="header-account-wrap d-flex">
    <a href="<?php echo esc_url( $account_url ); ?>" class="d-flex align-items-center" target="<?php echo esc_attr( $link_target ); ?>">
        <?php if ( $account_text !== '' ) : ?>
            <label><?php echo esc_html( $account_text ); ?></label>
        <?php endif; ?>
    </a>
</div><!-- .header-account-wrap -->
