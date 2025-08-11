</main>
<footer class="bg-gray-900 text-white py-12 w-full">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <div class="mb-6 md:mb-0"><img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo.png'); ?>"
                        alt="enigo logo"
                        class="h-10 brightness-0 invert"></div>
            <nav class="flex flex-wrap justify-center gap-6 mb-6 md:mb-0">
                <?php
                if (has_nav_menu('footer-menu')) {
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'depth' => 1,
                        'walker' => new Tailwind_Footer_Nav_Walker()
                    ));
                }
                ?>
            </nav>
           <div class="flex space-x-4"><a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-facebook">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                    </svg>
                </a><? /*<a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-linkedin">
                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                        <rect width="4" height="12" x="2" y="9"></rect>
                        <circle cx="4" cy="4" r="2"></circle>
                    </svg>
                </a><a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-instagram">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                    </svg>
                </a>*/// ?></div>
        </div>
        <div class="border-t border-gray-800 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center"><p
                        class="text-gray-400 text-sm mb-4 md:mb-0">© 2025 enigo – Websites &amp; Web Applications</p>
                <div class="flex space-x-4">
                    <?php
                    if ( has_nav_menu( 'secondary-footer-menu' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'secondary-footer-menu',
                            'container'      => false,
                            'items_wrap'     => '%3$s',
                            'depth'          => 1,
                            'walker'         => new Tailwind_Secondary_Footer_Nav_Walker()
                        ) );
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>

</div>
</div><?php wp_footer(); ?>

</body>
</html>