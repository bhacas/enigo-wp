<?php
/**
 * Szablon do wyświetlania pojedynczego projektu w portfolio.
 * Plik: single-portfolio.php
 */

get_header(); // Wczytuje nagłówek (header.php)
?>

<main class="flex-grow">
    <?php
    // Pętla WordPressa, która wczytuje dane bieżącego projektu
    while (have_posts()) :
        the_post();

        // Pobieramy dane z Pól Dodatkowych (Custom Fields).
        $client_name = get_post_meta(get_the_ID(), 'client', true);
        $project_year = get_post_meta(get_the_ID(), 'year', true);
        $project_category = get_post_meta(get_the_ID(), 'category', true);
        $challenge = get_post_meta(get_the_ID(), 'challenge', true);
        $solution = get_post_meta(get_the_ID(), 'solution', true);
        $results = get_post_meta(get_the_ID(), 'results', true);
        $technologies = get_post_meta(get_the_ID(), 'technologies', true);
        $project_url = get_post_meta(get_the_ID(), 'project_url', true);
        $gallery_urls_string = get_post_meta(get_the_ID(), 'project_gallery_urls', true);
        ?>

        <div class="w-full bg-gradient-to-r from-blue-50 to-blue-100 py-16">
            <div class="container mx-auto px-4">
                <a class="inline-flex items-center text-blue-600 mb-6 hover:text-blue-800 transition-colors"
                   href="<?php echo esc_url(home_url('/project')); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-arrow-left mr-2">
                        <path d="m12 19-7-7 7-7"></path>
                        <path d="M19 12H5"></path>
                    </svg>
                    Powrót do listy projektów
                </a>
                <?php the_title('<h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">', '</h1>'); ?>

                <div class="flex flex-wrap gap-4 mb-6">
                    <?php if (!empty($project_category)) : ?>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium"><?php echo esc_html($project_category); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($client_name)) : ?>
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">Klient: <?php echo esc_html($client_name); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($project_year)) : ?>
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">Rok: <?php echo esc_html($project_year); ?></span>
                    <?php endif; ?>
                </div>
                <?php
                if (!empty($project_url)) : ?>
                    <a href="<?php echo esc_url($project_url); ?>" target="_blank" rel="noopener noreferrer"
                       class="mt-4 inline-block">
                        <button class="px-6 py-3 rounded-lg font-medium transition-all duration-200 text-sm md:text-base bg-blue-600 text-white hover:bg-blue-700 inline-flex items-center">
                            Odwiedź stronę projektu
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="lucide lucide-external-link ml-2" aria-hidden="true">
                                <path d="M15 3h6v6"></path>
                                <path d="M10 14 21 3"></path>
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            </svg>
                        </button>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="container mx-auto px-4 py-12">
            <div class="grid md:grid-cols-2 gap-12 mb-16">
                <div>
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>"
                             class="w-full h-auto rounded-xl shadow-md">
                    <?php endif; ?>
                </div>
                <div>
                    <h2 class="text-2xl font-bold mb-4 text-gray-900">Project Overview</h2>
                    <div class="text-gray-700 mb-6 prose prose-lg max-w-none">
                        <?php
                        // Główna treść wpisu jest teraz używana jako "Project Overview"
                        the_content();
                        ?>
                    </div>

                    <?php if (!empty($challenge)) : ?>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="lucide lucide-layers mr-2 text-blue-600">
                                <path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"></path>
                                <path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"></path>
                                <path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"></path>
                            </svg>
                            Wyzwanie
                        </h3>
                        <p class="text-gray-700 mb-6"><?php echo wp_kses_post($challenge); // Użyj wp_kses_post, jeśli pole może zawierać HTML ?></p>
                    <?php endif; ?>

                    <?php if (!empty($solution)) : ?>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="lucide lucide-zap mr-2 text-blue-600">
                                <path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"></path>
                            </svg>
                            Nasze rozwiązanie
                        </h3>
                        <p class="text-gray-700 mb-6"><?php echo wp_kses_post($solution); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($results)) : ?>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="lucide lucide-globe mr-2 text-blue-600">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path>
                                <path d="M2 12h20"></path>
                            </svg>
                            Rezultaty
                        </h3>
                        <p class="text-gray-700 mb-6"><?php echo wp_kses_post($results); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($technologies)) : ?>
                        <div class="mt-8">
                            <h3 class="text-lg font-bold mb-3 text-gray-900">Użyte technologie</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php
                                $tech_array = explode(',', $technologies);
                                foreach ($tech_array as $tech) :
                                    ?>
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm"><?php echo esc_html(trim($tech)); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php
            if (!empty($gallery_urls_string)) :
                $gallery_images = array_filter(array_map('trim', explode("\n", $gallery_urls_string)));

                if (!empty($gallery_images)) :
                    ?>
                    <div class="mb-16">
                        <h2 class="text-2xl font-bold mb-6 text-gray-900">Galeria projektu</h2>
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php foreach ($gallery_images as $image_url) : ?>
                                <a href="<?php echo esc_url($image_url); ?>" class="block" target="_blank" rel="noopener noreferrer">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="Project gallery image" class="w-full h-64 object-cover rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php
                endif;
            endif;
            ?>

            <div class="text-center py-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Gotowy rozpocząć swój projekt?</h2>
                <a href="<?php echo esc_url(home_url('/contact')); ?>">
                    <button class="px-6 py-3 rounded-lg font-medium transition-all duration-200 text-sm md:text-base bg-blue-600 text-white hover:bg-blue-700 ">
                        Skontaktuj się z nami
                    </button>
                </a>
            </div>
        </div>

    <?php endwhile; // Koniec pętli. ?>
</main>

<?php
get_footer(); // Wczytuje stopkę (footer.php)
?>
