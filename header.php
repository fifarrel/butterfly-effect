<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container">
        <div class="site-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/be-logo.png" alt="Butterfly Effect">
            </a>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">About Us</a></li>
                <li>
                    <a href="https://butterflyeffect.versum.com/vouchers/items" target="_blank" rel="noopener">Gift Cards</a>
                    <ul class="sub-menu">
                        <li><a href="https://butterflyeffect.versum.com/vouchers/items" target="_blank" rel="noopener">Digital Gift Card</a></li>
                        <li><a href="https://shop.bepermanentmakeup.ie/39-gift-vouchers" target="_blank" rel="noopener">Paper Voucher</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo esc_url( home_url( '/treatments/' ) ); ?>">Treatments</a></li>
                <li><a href="<?php echo esc_url( home_url( '/training/' ) ); ?>">Training</a></li>
                <li><a href="https://butterflyeffect.versum.com/" target="_blank" rel="noopener">Book Now</a></li>
            </ul>
        </nav>
    </div>
</header>