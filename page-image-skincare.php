<?php
get_header();
get_template_part( 'template-parts/treatment', null, array(
    'title'       => 'Image Skincare',
    'eyebrow'     => 'Skin Therapies',
    'description' => array( 'A clinical results-driven facial designed to give beautifully lifted, firmer, deep cleansing, and glow. The treatment uses a blend of powerful antioxidant protection, nutrition and enzymes, and stem cells all sandwiched together to provide immediate measurable differences for the discerning client.' ),
    'price'       => 'XXX',
    'book_url'    => 'https://butterflyeffect.versum.com/?trade=486069',
) );
get_footer();
