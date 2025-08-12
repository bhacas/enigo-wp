<?php
/**
 * Plik nagłówka (header.php)
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'textdomain' ); ?></a>

    <header class="sticky top-0 z-50 w-full bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <a href="<?php echo esc_url( home_url( '/' ) ) ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo.png' ); ?>" alt="enigo logo" class="h-10"></a>
            </div>

            <!-- Dynamiczne menu dla desktopu -->
            <nav class="hidden md:flex space-x-8">
                <?php
                if ( has_nav_menu( 'primary-menu' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary-menu',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'depth'          => 1,
                        'walker'         => new Tailwind_Nav_Walker()
                    ) );
                }
                ?>
            </nav>

            <!-- Przycisk menu mobilnego -->
            <button data-js="mobile-menu-button" class="md:hidden text-gray-800">
                <svg data-js="menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu"><line x1="4" x2="20" y1="12" y2="12"></line><line x1="4" x2="20" y1="6" y2="6"></line><line x1="4" x2="20" y1="18" y2="18"></line></svg>
                <svg data-js="close-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x hidden"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
            </button>
        </div>

        <!-- Kontener na menu mobilne (rozwijane) -->
        <div data-js="mobile-menu" class="hidden md:hidden bg-white py-4 px-4 shadow-md">
            <nav class="flex flex-col space-y-4">
                <?php
                if ( has_nav_menu( 'primary-menu' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary-menu',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'depth'          => 1,
                        'walker'         => new Tailwind_Nav_Walker_Mobile()
                    ) );
                }
                ?>
            </nav>
        </div>
    </header>

    <main id="content" class="site-content">
        <!-- Tutaj zaczyna się treść Twojej strony -->
