<footer class="site-footer">
    <div class="container">
        <div class="footer-top">
            <div class="footer-brand">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/be-logo.png" alt="Butterfly Effect" class="footer-logo">
                <p class="footer-tagline">
                    <!-- Add text here -->
                </p>
                <div class="footer-social">
                    <a href="https://www.instagram.com/butterflyeffectbeautysalon/" target="_blank" rel="noopener noreferrer" aria-label="Butterfly Effect on Instagram">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/ButterflyEffectBeautySalon" target="_blank" rel="noopener noreferrer" aria-label="Butterfly Effect on Facebook">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="footer-columns">
                <div class="footer-col">
                    <h4>Explore</h4>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">About Us</a></li>
                         <li><a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>">Contact Us</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Policies</h4>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/cookies-policy/' ) ); ?>">Cookies Policy</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/terms-and-conditions/' ) ); ?>">Terms &amp; Conditions</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/terms-of-use/' ) ); ?>">Terms of Use</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/cancellation-policy/' ) ); ?>">Cancellation Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-award">
            <h4>As Featured In</h4>
            <div class="footer-award-list">
                <div class="footer-award-item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/Irish-Beauty-Industry-Awards.jpg" alt="Irish Beauty Industry Awards" class="footer-award-img">
                    <p>Finalist Irish Beauty Industry Awards 2018</p>
                </div>
                <div class="footer-award-item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/Best-Tanning-Professional.jpg" alt="IMAGE BUSINESS OF BEAUTY AWARDS 2019 NOMINATION" class="footer-award-img">
                    <p>Image Business of Beauty Awards 2019 Nomination</p>
                </div>
                <div class="footer-award-item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/Regional-Winner-Logo.jpg" alt="Regional Winner Irish Makeup Awards 2018" class="footer-award-img">
                    <p>Regional Winner Irish Makeup Awards 2018</p>
                </div>
                <div class="footer-award-item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/Finalist-Logo.jpg" alt="Finalist – IMUA 2019" class="footer-award-img">
                    <p>Finalist – IMUA 2019</p>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date( 'Y' ); ?> Butterfly Effect. All rights reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
