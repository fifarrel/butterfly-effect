<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        (function () {
            var stored = localStorage.getItem( 'be-theme' );
            if ( stored === 'dark' || stored === 'light' ) {
                document.documentElement.setAttribute( 'data-theme', stored );
            }
        })();
    </script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-left">
                <span class="top-bar-location">Rathfarnham Village, Dublin 14</span>
                <button type="button" class="theme-toggle" id="theme-toggle" aria-label="Toggle dark mode">
                    <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                    <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="4"></circle>
                        <line x1="12" y1="2" x2="12" y2="4"></line>
                        <line x1="12" y1="20" x2="12" y2="22"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="2" y1="12" x2="4" y2="12"></line>
                        <line x1="20" y1="12" x2="22" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                </button>
            </div>
            <div class="top-bar-right">
                <a href="tel:0894751746">089 475 1746</a>
                <a href="mailto:info@butterflyeffect.ie">info@butterflyeffect.ie</a>
                <div class="top-bar-social">
                    <a href="https://www.instagram.com/butterflyeffectbeautysalon/" target="_blank" rel="noopener noreferrer" aria-label="Butterfly Effect on Instagram">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/ButterflyEffectBeautySalon" target="_blank" rel="noopener noreferrer" aria-label="Butterfly Effect on Facebook">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container site-header-row">
        <div class="site-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/be-logo.png" alt="Butterfly Effect">
            </a>
        </div>
        <div class="site-header-nav-row">
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
                    <li><a href="<?php echo esc_url( home_url( '/smart-skin-survey/' ) ); ?>">Smart Skin Survey</a></li>
                </ul>
            </nav>
            <a href="https://butterflyeffect.versum.com/" class="btn header-cta" target="_blank" rel="noopener">Book Now</a>
        </div>
    </div>
</header>

<script>
    (function () {
        var toggle = document.getElementById( 'theme-toggle' );
        if ( ! toggle ) { return; }
        toggle.addEventListener( 'click', function () {
            var isDark = document.documentElement.getAttribute( 'data-theme' ) === 'dark'
                || ( ! document.documentElement.hasAttribute( 'data-theme' ) && window.matchMedia( '(prefers-color-scheme: dark)' ).matches );
            var next = isDark ? 'light' : 'dark';
            document.documentElement.setAttribute( 'data-theme', next );
            localStorage.setItem( 'be-theme', next );
        } );
    })();
</script>