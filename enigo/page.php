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

        <?php
        the_content(); // Wyświetla treść z edytora blokowego

        // Dodaje paginację dla wielostronicowych wpisów (rzadko używane na stronach)
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'textdomain'),
            'after' => '</div>',
        ));
        ?>

    </article><!-- #post-<?php the_ID(); ?> -->

<?php
endwhile; // Koniec pętli.
?>

<?php
get_footer(); // Wczytuje stopkę (footer.php)
?>
