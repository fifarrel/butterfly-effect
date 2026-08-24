<?php
function yourtheme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array(
        'primary' => __( 'Primary Menu' ),
    ) );
}
add_action( 'after_setup_theme', 'yourtheme_setup' );

function yourtheme_enqueue_assets() {
    wp_enqueue_style( 'butterfly-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&family=Inter:wght@400;500;600;700&family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap', array(), null );
    wp_enqueue_style( 'yourtheme-style', get_stylesheet_uri(), array( 'butterfly-fonts' ) );
    wp_enqueue_script( 'yourtheme-testimonials', get_template_directory_uri() . '/assets/js/testimonials.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'yourtheme_enqueue_assets' );

function yourtheme_font_preconnect( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'yourtheme_font_preconnect', 10, 2 );

/**
 * SEO: per-page title & meta description map.
 * No SEO plugin is installed, so this is the single source of truth for
 * <title> and meta description across the site. Keyed by page slug;
 * 'front' covers the static front page.
 */
function butterfly_seo_page_data() {
    $brand = 'Butterfly Effect';
    $pages = array(
        'front' => array(
            'title'       => "Permanent Makeup & Beauty Salon Rathfarnham, Dublin 14 | {$brand}",
            'description' => "Butterfly Effect is Rathfarnham's trusted permanent makeup & beauty salon. Microblading, PMU eyebrows, lips & eyeliner, facials, waxing, nails, massage & more. Book online today.",
        ),
        'about-us' => array(
            'title'       => "About Us | Permanent Makeup & Beauty Salon Rathfarnham | {$brand}",
            'description' => "Meet the team behind Butterfly Effect \xe2\x80\x94 Rathfarnham's permanent makeup & beauty salon. Highly qualified in microblading, PMU, skincare & advanced beauty treatments.",
        ),
        'contact-us' => array(
            'title'       => "Contact Us | {$brand} Beauty Salon, Rathfarnham Village, Dublin 14",
            'description' => "Visit Butterfly Effect at 1 Blackburn Square, Rathfarnham Village, Dublin 14. Call 089 475 1746 or book online. Open Monday\xe2\x80\x93Saturday, cheap parking 2 minutes away.",
        ),
        'treatments' => array(
            'title'       => "Treatments Menu | Permanent Makeup, Skin & Beauty Treatments | {$brand} Rathfarnham",
            'description' => "Browse our full treatment menu: permanent makeup, microblading, skin therapies, hair removal, PMU & tattoo removal, nails, massage & more. Book your Rathfarnham salon treatment today.",
        ),
        'training' => array(
            'title'       => "Permanent Makeup Training Courses Dublin | BE Academy | {$brand}",
            'description' => "Become a certified permanent makeup artist with BE Academy Dublin. Microblading & PMU training for eyebrows, lips & eyeliner, Hanami Pigments certified.",
        ),
        'pmu' => array(
            'title'       => "PMU Training Course Dublin | Machine Permanent Makeup | BE Academy",
            'description' => "Learn machine PMU permanent makeup for eyebrows, lips & eyeliner at BE Academy Dublin. 2\xe2\x80\x933 day intensive courses, Hanami Pigments certified, from \xe2\x82\xac1,000.",
        ),
        'microblading' => array(
            'title'       => "Microblading Training Course Dublin | Eyebrow Microblading | BE Academy",
            'description' => "Master hand-stroke microblading for natural-looking eyebrows. 2\xe2\x80\x933 day intensive training at BE Academy Dublin, Hanami Pigments certified, starter kits available.",
        ),
        'microblading-pmu' => array(
            'title'       => "Microblading + PMU Combined Training Dublin | BE Academy",
            'description' => "Train in both microblading and PMU in one 3-day intensive course at BE Academy Dublin \xe2\x80\x94 eyebrows, lips & eyeliner permanent makeup techniques.",
        ),
        'microdermabrasion' => array(
            'title'       => "Microdermabrasion Training Course Dublin | BE Academy",
            'description' => "Learn professional microdermabrasion treatment for ageing skin, fine lines & acne scarring. 1-day training course at BE Academy Dublin, \xe2\x82\xac350.",
        ),
        'microneedling-mesotherapy' => array(
            'title'       => "Microneedling Mesotherapy Training Dublin | BE Academy",
            'description' => "Train in microneedling mesotherapy to boost collagen production & active ingredient absorption. 1-day course at BE Academy Dublin, \xe2\x82\xac400.",
        ),
        'smart-skin-survey' => array(
            'title'       => "Smart Skin Survey | Free Skin Assessment | {$brand} Rathfarnham",
            'description' => "Take our free 2-minute skin survey and get personalised treatment recommendations from Butterfly Effect, Rathfarnham's permanent makeup & beauty salon.",
        ),
        'cancellation-policy' => array(
            'title'       => "Cancellation Policy | {$brand} Beauty Salon",
            'description' => "Booking & cancellation policy for treatments and training courses at Butterfly Effect, Rathfarnham.",
        ),
        'cookies-policy' => array(
            'title'       => "Cookies Policy | {$brand} Beauty Salon",
            'description' => "How Butterfly Effect uses cookies on this website.",
        ),
        'privacy-policy' => array(
            'title'       => "Privacy Policy | {$brand} Beauty Salon",
            'description' => "How Butterfly Effect collects, uses & protects your personal data.",
        ),
        'terms-and-conditions' => array(
            'title'       => "Terms & Conditions | {$brand} Beauty Salon",
            'description' => "Terms & conditions for treatments, training courses & purchases at Butterfly Effect, Rathfarnham.",
        ),
        'terms-of-use' => array(
            'title'       => "Terms of Use | {$brand} Beauty Salon",
            'description' => "Terms of use for the Butterfly Effect website.",
        ),
    );

    if ( is_front_page() ) {
        return $pages['front'];
    }

    $slug = get_post_field( 'post_name', get_queried_object_id() );
    return isset( $pages[ $slug ] ) ? $pages[ $slug ] : null;
}

/**
 * Full control over <title>: bypasses core's title-tag building entirely
 * for mapped pages, so no plugin-free "Page Title - Site Name" default.
 */
function butterfly_seo_document_title( $title ) {
    $data = butterfly_seo_page_data();
    return $data ? $data['title'] : $title;
}
add_filter( 'pre_get_document_title', 'butterfly_seo_document_title' );

/**
 * Meta description + Open Graph / Twitter Card tags for mapped pages.
 * Also used for og:title/og:description so social shares match search intent.
 */
function butterfly_seo_meta_tags() {
    $data = butterfly_seo_page_data();
    if ( ! $data ) {
        return;
    }

    $url = is_front_page() ? home_url( '/' ) : get_permalink();

    printf( '<meta name="description" content="%s">' . "\n", esc_attr( $data['description'] ) );
    printf( '<meta property="og:type" content="website">' . "\n" );
    printf( '<meta property="og:site_name" content="Butterfly Effect">' . "\n" );
    printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $data['title'] ) );
    printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $data['description'] ) );
    printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
    printf( '<meta property="og:image" content="%s">' . "\n", esc_url( get_template_directory_uri() . '/assets/be-logo.png' ) );
    printf( '<meta name="twitter:card" content="summary">' . "\n" );
    printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $data['title'] ) );
    printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $data['description'] ) );
}
add_action( 'wp_head', 'butterfly_seo_meta_tags', 1 );

/**
 * Sitewide LocalBusiness structured data so Google can surface NAP,
 * hours & socials directly in search / maps results.
 */
function butterfly_seo_local_business_schema() {
    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'BeautySalon',
        'name'        => 'Butterfly Effect Permanent Makeup & Beauty Salon',
        'image'       => get_template_directory_uri() . '/assets/outside.jpg',
        'url'         => home_url( '/' ),
        'telephone'   => '+353894751746',
        'email'       => 'info@butterflyeffect.ie',
        'priceRange'  => '€€',
        'address'     => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => '1 Blackburn Square, Rathfarnham Gate',
            'addressLocality' => 'Rathfarnham Village, Dublin 14',
            'postalCode'      => 'D14 X9P3',
            'addressCountry'  => 'IE',
        ),
        'openingHoursSpecification' => array(
            array( '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday' ), 'opens' => '09:00', 'closes' => '19:00' ),
            array( '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => array( 'Thursday', 'Friday' ), 'opens' => '09:00', 'closes' => '20:00' ),
            array( '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => array( 'Saturday' ), 'opens' => '09:00', 'closes' => '17:00' ),
        ),
        'sameAs' => array(
            'https://www.instagram.com/butterflyeffectbeautysalon/',
            'https://www.facebook.com/ButterflyEffectBeautySalon',
        ),
    );

    echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . "\n";
}
add_action( 'wp_head', 'butterfly_seo_local_business_schema', 2 );