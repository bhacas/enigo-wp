<?php
/**
 * Szablon do wyświetlania wszystkich pojedynczych stron.
 * Plik: page.php
 */

get_header(); // Wczytuje nagłówek (header.php)
?>


<?php
// Pętla WordPressa, która wczytuje dane bieżącej strony
while (have_posts()) :
the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <section class="wp-block-create-block-contact-section py-20 bg-gray-50 w-full">
        <div class="container mx-auto px-4">
            <?php
            the_content();
            ?>
        </div>
    </section>

    <?php
    endwhile; // Koniec pętli.
    ?>

    <?php
    get_footer(); // Wczytuje stopkę (footer.php)
    ?>
