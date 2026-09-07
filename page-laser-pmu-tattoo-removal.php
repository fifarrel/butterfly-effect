<?php
get_header();
get_template_part( 'template-parts/treatment', null, array(
    'title'       => 'Laser PMU & Tattoo Removal',
    'eyebrow'     => 'PMU & Tattoo Removal',
    'description' => array(
            'Laser tattoo removal is a safe and effective treatment designed to fade or fully remove unwanted tattoos. Advanced laser technology delivers targeted energy into the skin, breaking down tattoo ink particles into smaller fragments that are naturally eliminated by the body over time.',
            'This treatment can be used on most tattoo colors and skin types. The number of sessions required depends on factors such as tattoo size, ink color, depth, age of the tattoo, and individual skin response.',
        ),
    'price'       => 'XXX',
    'book_url'    => 'https://butterflyeffect.versum.com/',
) );
get_footer();
