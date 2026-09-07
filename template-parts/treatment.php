<?php
/**
 * Shared layout for a single treatment page.
 * Called via get_template_part( 'template-parts/treatment', null, $args ).
 *
 * Expected $args keys: title, eyebrow, description (string or array of
 * paragraphs), price, price_note, book_url.
 */
$treatment_title       = $args['title'] ?? 'XXX';
$treatment_eyebrow     = $args['eyebrow'] ?? '';
$treatment_description = $args['description'] ?? 'XXX';
$treatment_price       = $args['price'] ?? 'XXX';
$treatment_price_note  = $args['price_note'] ?? '';
$treatment_book_url    = $args['book_url'] ?? 'https://butterflyeffect.versum.com/';
$treatment_paragraphs  = is_array( $treatment_description ) ? $treatment_description : array( $treatment_description );
?>
<section class="treatments-hero treatment-single-hero">
    <div class="container">
        <a class="course-back-link" href="<?php echo esc_url( home_url( '/treatments/' ) ); ?>">&larr; Back to Treatments</a>
        <?php if ( $treatment_eyebrow ) : ?>
        <span class="eyebrow"><?php echo esc_html( $treatment_eyebrow ); ?></span>
        <?php endif; ?>
        <h1 class="stroke-heading"><?php echo esc_html( $treatment_title ); ?></h1>
    </div>
</section>

<section class="course-content container treatment-single-content">
    <div class="treatment-single-body">
        <?php foreach ( $treatment_paragraphs as $treatment_paragraph ) : ?>
        <p><?php echo wp_kses_post( $treatment_paragraph ); ?></p>
        <?php endforeach; ?>
    </div>

    <div class="pricing-grid pricing-grid-single treatment-single-price">
        <div class="pricing-card">
            <h4><?php echo esc_html( $treatment_title ); ?></h4>
            <p class="price"><?php echo wp_kses_post( $treatment_price ); ?></p>
            <?php if ( $treatment_price_note ) : ?>
            <p class="price-note"><?php echo esc_html( $treatment_price_note ); ?></p>
            <?php endif; ?>
            <a href="<?php echo esc_url( $treatment_book_url ); ?>" class="btn" target="_blank" rel="noopener">Book Now</a>
        </div>
    </div>
</section>
