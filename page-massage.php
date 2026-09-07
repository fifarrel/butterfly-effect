<?php
get_header();
get_template_part( 'template-parts/treatment', null, array(
    'title'       => 'Massage',
    'eyebrow'     => 'Body Treatments',
    'description' => array( 'Swedish & holistic massage therapy to relax and restore.' ),
    'price'       => 'XXX',
    'book_url'    => 'https://butterflyeffect.versum.com/?trade=255050',
) );
get_footer();
