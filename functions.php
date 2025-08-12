<?php

/**
 * Dołącza skrypty i style do motywu.
 */
function enigo_enqueue_assets() {
    $dev_css_path = get_template_directory() . '/dist/output.css';
    $dev_css_uri = get_template_directory_uri() . '/dist/output.css';
    $prod_css_uri = get_template_directory_uri() . '/assets/css/tailwind.css';

    if ( file_exists( $dev_css_path ) ) {
        wp_enqueue_style( 'tailwind-dev-css', $dev_css_uri );
    } else {
        wp_enqueue_style( 'tailwind-prod-css', $prod_css_uri );
    }

    wp_enqueue_script(
        'enigo-main-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'enigo_enqueue_assets' );


function enigo_theme_setup() {
    add_theme_support( 'post-thumbnails' );

    register_nav_menus( array(
        'primary-menu' => esc_html__( 'Primary Menu', 'enigo' ),
        'footer-menu'  => esc_html__( 'Footer Menu', 'enigo' ),
        'secondary-footer-menu'  => esc_html__( 'Secondary footer Menu', 'enigo' ),
    ) );

    add_theme_support( 'custom-logo', array(
        'height'      => 40,
        'width'       => 'auto',
        'flex-height' => true,
        'flex-width'  => true,
    ) );
}
add_action( 'after_setup_theme', 'enigo_theme_setup' );


function create_portfolio_post_type() {
    $labels = array(
        'name'                  => _x( 'Projekty', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Projekt', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Project', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Project', 'textdomain' ),
        'new_item'              => __( 'New Project', 'textdomain' ),
        'edit_item'             => __( 'Edit Project', 'textdomain' ),
        'view_item'             => __( 'View Project', 'textdomain' ),
        'all_items'             => __( 'All Projects', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'project' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
        'menu_icon'          => 'dashicons-portfolio',
    );

    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'create_portfolio_post_type' );

function render_portfolio_section_block( $attributes ) {
    $args = array(
        'post_type'      => 'portfolio',
        'posts_per_page' => $attributes['numberOfPosts'],
        'post_status'    => 'publish',
    );

    $query = new WP_Query( $args );

    ob_start();
    ?>
    <section id="portfolio" class="py-20 bg-white w-full">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900"><?php echo esc_html( $attributes['title'] ); ?></h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto"><?php echo esc_html( $attributes['description'] ); ?></p>
            </div>

            <?php if ( $query->have_posts() ) : ?>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                        <a class="block h-full" href="<?php the_permalink(); ?>">
                            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 group h-full flex flex-col">
                                <div class="h-48 overflow-hidden">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <img src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <?php endif; ?>
                                </div>
                                <div class="p-6 flex flex-col flex-grow">
                                    <h3 class="text-xl font-semibold mt-1 mb-3 text-gray-900"><?php the_title(); ?></h3>
                                    <div class="text-gray-600 line-clamp-3">
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p class="text-center">No portfolio projects found.</p>
            <?php endif; ?>

            <?php if ( ! empty( $attributes['buttonText'] ) && ! empty( $attributes['buttonUrl'] ) ) : ?>
                <div class="text-center">
                    <a href="<?php echo esc_url( $attributes['buttonUrl'] ); ?>">
                        <button class="px-6 py-3 rounded-lg font-medium transition-all duration-200 text-sm md:text-base bg-blue-600 text-white hover:bg-blue-700 "><?php echo esc_html( $attributes['buttonText'] ); ?></button>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function moj_motyw_rejestruj_bloki() {
    register_block_type( __DIR__ . '/blocks/hero-section' );
    register_block_type( __DIR__ . '/blocks/features-section' );
    register_block_type( __DIR__ . '/blocks/services-section' );
    register_block_type( __DIR__ . '/blocks/about-section' );
    register_block_type( __DIR__ . '/blocks/contact-section' );
    register_block_type( __DIR__ . '/blocks/portfolio-section', array(
        'render_callback' => 'render_portfolio_section_block',
    ) );
}
add_action( 'init', 'moj_motyw_rejestruj_bloki' );

class Tailwind_Nav_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $atts = [
            'title'  => ! empty( $item->attr_title ) ? $item->attr_title : '',
            'target' => ! empty( $item->target )     ? $item->target     : '',
            'rel'    => ! empty( $item->xfn )        ? $item->xfn        : '',
            'href'   => ! empty( $item->url )        ? $item->url        : '',
            'class'  => 'text-gray-800 hover:text-blue-600 font-medium'
        ];
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $output .= "<a{$attributes}>" . esc_html($item->title) . '</a>';
    }

    function end_el( &$output, $item, $depth = 0, $args = null ) {
        // Do not output a closing tag
    }
}

class Tailwind_Nav_Walker_Mobile extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $atts = [
            'title'  => ! empty( $item->attr_title ) ? $item->attr_title : '',
            'target' => ! empty( $item->target )     ? $item->target     : '',
            'rel'    => ! empty( $item->xfn )        ? $item->xfn        : '',
            'href'   => ! empty( $item->url )        ? $item->url        : '',
            'class'  => 'block py-2 text-gray-800 hover:text-blue-600 font-medium' // Classes for mobile links
        ];
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $output .= "<a{$attributes}>" . esc_html($item->title) . '</a>';
    }

    function end_el( &$output, $item, $depth = 0, $args = null ) {
    }
}

class Tailwind_Footer_Nav_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $atts = [
            'title'  => ! empty( $item->attr_title ) ? $item->attr_title : '',
            'target' => ! empty( $item->target )     ? $item->target     : '',
            'rel'    => ! empty( $item->xfn )        ? $item->xfn        : '',
            'href'   => ! empty( $item->url )        ? $item->url        : '',
            'class'  => 'text-gray-400 hover:text-white transition-colors'
        ];
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $output .= "<a{$attributes}>" . esc_html($item->title) . '</a>';
    }

    function end_el( &$output, $item, $depth = 0, $args = null ) {
    }
}

class Tailwind_Secondary_Footer_Nav_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $atts = [
            'title'  => ! empty( $item->attr_title ) ? $item->attr_title : '',
            'target' => ! empty( $item->target )     ? $item->target     : '',
            'rel'    => ! empty( $item->xfn )        ? $item->xfn        : '',
            'href'   => ! empty( $item->url )        ? $item->url        : '',
            'class'  => 'text-gray-400 hover:text-white text-sm transition-colors' // Twoje klasy
        ];
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $output .= "<a{$attributes}>" . esc_html($item->title) . '</a>';
    }

    function end_el( &$output, $item, $depth = 0, $args = null ) {
    }
}
