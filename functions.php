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
 * Virtual treatment pages.
 *
 * Each of these URLs (e.g. /shr/) is served straight from a
 * page-{slug}.php template in this theme, with NO WordPress Page needed
 * in the database — routing lives entirely in this file so the whole
 * treatments section can be managed from the theme folder alone.
 */
function butterfly_treatment_slugs() {
    return array(
        'korean-skincare',
        'image-skincare',
        'essencial-skincare',
        'aesthetic-medicine',
        'hair-treatments',
        'hydrating-plumping',
        'supportive-restorative-care',
        'rejuvenation-anti-ageing',
        'redness-relief',
        'anti-acne',
        'depigmentation',
        'male-skincare',
        'shr',
        'waxing',
        'laser-pmu-tattoo-removal',
        'pmu-remover',
        'ems-chair',
        'eye-treatments',
        'hands',
        'feet',
        'massage',
        'body-scrub',
        'makeup',
        'laser',
        'mesotherapy',
        'for-your-face',
        'tanning',
        'for-your-smooth-skin',
        'ipl-skin-rejuvenation',
    );
}

function butterfly_treatment_add_rewrite_rules() {
    foreach ( butterfly_treatment_slugs() as $slug ) {
        add_rewrite_rule( '^' . $slug . '/?$', 'index.php?butterfly_treatment=' . $slug, 'top' );
    }
}
add_action( 'init', 'butterfly_treatment_add_rewrite_rules' );

function butterfly_treatment_query_vars( $vars ) {
    $vars[] = 'butterfly_treatment';
    return $vars;
}
add_filter( 'query_vars', 'butterfly_treatment_query_vars' );

/**
 * Rewrite rules registered above only take effect on the frontend once
 * they've been flushed into WordPress's cached rewrite rules. Bump the
 * version string here whenever butterfly_treatment_slugs() changes so
 * this flushes again automatically on the next page load — no manual
 * "visit Permalink settings" step required.
 */
function butterfly_treatment_maybe_flush_rewrite_rules() {
    $version = '1';
    if ( get_option( 'butterfly_treatment_rules_version' ) !== $version ) {
        butterfly_treatment_add_rewrite_rules();
        flush_rewrite_rules();
        update_option( 'butterfly_treatment_rules_version', $version );
    }
}
add_action( 'init', 'butterfly_treatment_maybe_flush_rewrite_rules', 20 );

function butterfly_treatment_template( $template ) {
    $slug = get_query_var( 'butterfly_treatment' );
    if ( ! $slug || ! in_array( $slug, butterfly_treatment_slugs(), true ) ) {
        return $template;
    }

    $file = get_theme_file_path( 'page-' . $slug . '.php' );
    if ( ! file_exists( $file ) ) {
        return $template;
    }

    global $wp_query;
    $wp_query->is_404 = false;
    status_header( 200 );

    return $file;
}
add_filter( 'template_include', 'butterfly_treatment_template' );

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

        // -------------------------------------------------------------
        // Individual treatment pages (Treatments menu drill-down).
        // XXX descriptions mark treatments with no source copy yet —
        // fill in once real content is supplied.
        // -------------------------------------------------------------
        'korean-skincare' => array(
            'title'       => "Korean Skincare | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'image-skincare' => array(
            'title'       => "Image Skincare | {$brand} Rathfarnham",
            'description' => "Image Skincare facial at {$brand}, Rathfarnham \xe2\x80\x94 a clinical, results-driven treatment for a lifted, firmer, deep-cleansed glow.",
        ),
        'essencial-skincare' => array(
            'title'       => "Essencial Skincare | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'aesthetic-medicine' => array(
            'title'       => "Aesthetic Medicine | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'hair-treatments' => array(
            'title'       => "Hair Treatments | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'hydrating-plumping' => array(
            'title'       => "Hydrating & Plumping | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'supportive-restorative-care' => array(
            'title'       => "Supportive & Restorative Care | {$brand} Rathfarnham",
            'description' => "Specialised care for clients during \xe2\x80\x94 & after \xe2\x80\x94 cancer treatments, including oncology-safe skin treatments, permanent make up & areola reconstruction.",
        ),
        'rejuvenation-anti-ageing' => array(
            'title'       => "Rejuvenation & Anti-Ageing | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'redness-relief' => array(
            'title'       => "Redness Relief | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'anti-acne' => array(
            'title'       => "Anti Acne Treatment | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'depigmentation' => array(
            'title'       => "Depigmentation Treatment | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'male-skincare' => array(
            'title'       => "Male Skincare | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'shr' => array(
            'title'       => "SHR \xe2\x80\x94 Super Hair Removal | {$brand} Rathfarnham",
            'description' => "SHR (Super Hair Removal) at {$brand}, Rathfarnham \xe2\x80\x94 a fast, long-lasting alternative to traditional laser hair reduction, suitable for all skin tones.",
        ),
        'waxing' => array(
            'title'       => "Waxing | {$brand} Rathfarnham",
            'description' => "Facial, body & intimate waxing at {$brand}, Rathfarnham \xe2\x80\x94 smooth, long-lasting results. Book online today.",
        ),
        'laser-pmu-tattoo-removal' => array(
            'title'       => "Laser PMU & Tattoo Removal | {$brand} Rathfarnham",
            'description' => "Laser PMU & tattoo removal at {$brand}, Rathfarnham \xe2\x80\x94 a safe, effective treatment to fade or fully remove unwanted tattoos.",
        ),
        'pmu-remover' => array(
            'title'       => "PMU Remover | {$brand} Rathfarnham",
            'description' => "PMU Remover at {$brand}, Rathfarnham \xe2\x80\x94 a specialised laser treatment to safely lighten or remove unwanted permanent makeup.",
        ),
        'ems-chair' => array(
            'title'       => "EMS Chair | {$brand} Rathfarnham",
            'description' => "EMS Chair at {$brand}, Rathfarnham \xe2\x80\x94 electromagnetic muscle stimulation to tone & strengthen pelvic floor and core muscles.",
        ),
        'eye-treatments' => array(
            'title'       => "Eye Treatments | {$brand} Rathfarnham",
            'description' => "Eye Treatments at {$brand}, Rathfarnham \xe2\x80\x94 lash lift & tint, brow tint & shape, and eyelash extensions.",
        ),
        'hands' => array(
            'title'       => "Manicures & Nails | {$brand} Rathfarnham",
            'description' => "Manicures, gel & nail art at {$brand}, Rathfarnham. Book online today.",
        ),
        'feet' => array(
            'title'       => "Pedicures & Foot Care | {$brand} Rathfarnham",
            'description' => "Pedicures & foot care at {$brand}, Rathfarnham. Book online today.",
        ),
        'massage' => array(
            'title'       => "Massage | {$brand} Rathfarnham",
            'description' => "Swedish & holistic massage therapy at {$brand}, Rathfarnham \xe2\x80\x94 relax and restore. Book online today.",
        ),
        'body-scrub' => array(
            'title'       => "Body Scrub | {$brand} Rathfarnham",
            'description' => "Exfoliating body scrubs & masks at {$brand}, Rathfarnham for smoother, healthier skin.",
        ),
        'makeup' => array(
            'title'       => "Makeup | {$brand} Rathfarnham",
            'description' => "Professional makeup application at {$brand}, Rathfarnham \xe2\x80\x94 a flawless, long-lasting look tailored to your features & occasion.",
        ),
        'laser' => array(
            'title'       => "Laser | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'mesotherapy' => array(
            'title'       => "Mesotherapy | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'for-your-face' => array(
            'title'       => "For Your Face | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'tanning' => array(
            'title'       => "Tanning | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'for-your-smooth-skin' => array(
            'title'       => "For Your Smooth Skin | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
        'ipl-skin-rejuvenation' => array(
            'title'       => "IPL Skin Rejuvenation | {$brand} Rathfarnham",
            'description' => 'XXX',
        ),
    );

    if ( is_front_page() ) {
        return $pages['front'];
    }

    $slug = get_query_var( 'butterfly_treatment' );
    if ( ! $slug ) {
        $slug = get_post_field( 'post_name', get_queried_object_id() );
    }
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

    $treatment_slug = get_query_var( 'butterfly_treatment' );
    if ( is_front_page() ) {
        $url = home_url( '/' );
    } elseif ( $treatment_slug ) {
        $url = home_url( '/' . $treatment_slug . '/' );
    } else {
        $url = get_permalink();
    }

    printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $url ) );
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