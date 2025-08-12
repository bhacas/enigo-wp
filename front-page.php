<?php
/**
 * Szablon strony głównej.
 */

get_header();

// Pętla, która wczytuje i wyświetla treść
// dodaną w edytorze blokowym dla strony głównej.
while ( have_posts() ) :
    the_post();
    the_content();
endwhile;

get_footer();