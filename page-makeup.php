<?php
get_header();
get_template_part( 'template-parts/treatment', null, array(
    'title'       => 'Makeup',
    'eyebrow'     => '',
    'description' => array( 'Enhance your natural beauty with a flawless, professionally applied makeup look tailored to your features, skin type, and occasion. Using high-quality products and expert techniques, this treatment delivers a radiant, long-lasting finish — perfect for events, photoshoots, or whenever you want to feel your best.' ),
    'price'       => 'XXX',
    'book_url'    => 'https://butterflyeffect.versum.com/',
) );
get_footer();
