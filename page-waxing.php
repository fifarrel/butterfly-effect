<?php
get_header();
get_template_part( 'template-parts/treatment', null, array(
    'title'       => 'Waxing',
    'eyebrow'     => 'Hair Removal',
    'description' => array( 'Facial, body & intimate waxing for smooth, long-lasting results.' ),
    'price'       => 'XXX',
    'book_url'    => 'https://butterflyeffect.versum.com/',
) );
get_footer();
