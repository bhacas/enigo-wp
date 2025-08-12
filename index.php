<?php get_header();  ?>

    <div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        // To jest Twoja pętla, która już działa poprawnie
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div>
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php

            endwhile;
        else :
            // Co wyświetlić, jeśli nie ma żadnych postów
            echo '<p>Nie znaleziono żadnych wpisów.</p>';
        endif;
        ?>

    </main></div>

<?php get_footer(); ?>
