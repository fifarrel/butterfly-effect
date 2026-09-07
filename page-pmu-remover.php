<?php
get_header();
get_template_part( 'template-parts/treatment', null, array(
    'title'       => 'PMU Remover',
    'eyebrow'     => 'PMU & Tattoo Removal',
    'description' => array(
            'PMU tattoo removal is a specialized laser treatment designed to safely lighten or remove unwanted permanent makeup, including eyebrow, lip, and eyeliner tattoos. The laser targets pigment particles within the skin, breaking them down so they can be naturally cleared by the body over time.',
            'Multiple sessions may be required depending on pigment type, depth, and desired results. Treatments are spaced several weeks apart to allow safe healing and gradual fading.',
            'Suitable for clients seeking correction, lightening for reshaping, or full removal of previous permanent makeup.',
            '(One treatment may not be enough — several appointments may be needed.)',
        ),
    'price'       => 'XXX',
    'book_url'    => 'https://butterflyeffect.versum.com/',
) );
get_footer();
