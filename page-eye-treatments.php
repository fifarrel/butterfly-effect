<?php
get_header();
get_template_part( 'template-parts/treatment', null, array(
    'title'       => 'Eye Treatments',
    'eyebrow'     => '',
    'description' => array( 'Lash lift & tint, brow tint & shape, and eyelash extensions to define and enhance your natural eyes.' ),
    'price'       => 'XXX',
    'book_url'    => 'https://butterflyeffect.versum.com/?trade=255044',
) );
get_footer();
