<?php get_header(); ?>

<section class="hero">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/hero.jpg" alt="">
    <div class="hero-content">
        <h1 class="stroke-heading">Welcome to Butterfly Effect</h1>
        <p>A short line describing what the site/business is about goes here.</p>
        <a href="https://butterflyeffect.versum.com/" class="btn" target="_blank" rel="noopener">Book Now</a>
    </div>
    <div class="hero-dots">
        <span class="active"></span>
        <span></span>
        <span></span>
    </div>
</section>

<section class="category-strip container">
    <div class="category-card">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/category-1.jpg" alt="">
        <h3>Category One</h3>
    </div>
    <div class="category-card">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/category-2.jpg" alt="">
        <h3>Category Two</h3>
    </div>
    <div class="category-card">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/category-3.jpg" alt="">
        <h3>Category Three</h3>
    </div>
</section>

<section class="about-split">
    <div class="container about-split">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/about.jpg" alt="">
        <div>
            <span class="eyebrow">About Us</span>
            <h2>Your about section headline</h2>
            <p>Replace this with real copy describing the business, its story, and what makes it worth visiting.</p>
        </div>
    </div>
</section>

<section class="testimonial container">
    <blockquote>"Replace this with a real client testimonial."</blockquote>
    — Client Name
</section>

<section class="gallery-grid container">
    <?php for ( $i = 1; $i <= 8; $i++ ) : ?>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/gallery-<?php echo $i; ?>.jpg" alt="">
    <?php endfor; ?>
</section>

<?php get_footer(); ?>