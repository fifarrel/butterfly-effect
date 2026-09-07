<?php
get_header();
get_template_part( 'template-parts/treatment', null, array(
    'title'       => 'Body Scrub',
    'eyebrow'     => 'Body Treatments',
    'description' => array( 'Exfoliating body scrubs & masks for smoother, healthier skin.' ),
    'price'       => 'XXX',
    'book_url'    => 'https://butterflyeffect.versum.com/?trade=255049',
) );
get_footer();
