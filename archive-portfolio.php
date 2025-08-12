<?php

/**
 * Szablon do wyświetlania archiwum projektów portfolio.
 * Plik: archive-portfolio.php
 */

get_header(); // Wczytuje nagłówek (header.php)
?>

<main id="primary" class="site-main">

    <div class="w-full bg-gray-50 py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">
                <?php post_type_archive_title(); // Wyświetla nazwę "Portfolio" ?>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Oto niektóre z naszych ostatnich realizacji.
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12 md:py-16">
        <?php if ( have_posts() ) : ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <?php
                // Pętla WordPressa, która przechodzi przez wszystkie projekty
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <a class="block h-full" href="<?php the_permalink(); ?>">
                        <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 group h-full flex flex-col">
                            <div class="h-48 overflow-hidden">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <img src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <?php else : ?>
                                    <div class="w-full h-full bg-gray-100"></div>
                                <?php endif; ?>
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="text-xl font-semibold mt-1 mb-3 text-gray-900"><?php the_title(); ?></h3>
                                <div class="text-gray-600 line-clamp-3">
                                    <?php the_excerpt(); // Wyświetla zajawkę projektu ?>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>

            <?php
            // Wyświetlanie paginacji, jeśli jest więcej projektów niż mieści się na jednej stronie
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( '« Poprzednia', 'textdomain' ),
                'next_text' => __( 'Następna »', 'textdomain' ),
            ) );
            ?>

        <?php else : ?>
            <p class="text-center">Nie znaleziono żadnych projektów.</p>
        <?php endif; ?>
    </div>

</main>

<?php
get_footer(); // Wczytuje stopkę (footer.php)
?>
