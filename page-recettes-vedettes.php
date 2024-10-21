<?php
/*
Template Name: Recettes vedettes
*/
get_header();
?>

<main id="primary" class="site-main">
    <h1><?php the_title(); ?></h1>

    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'recette',
        'posts_per_page' => 12,
        'paged' => $paged,
        'meta_key' => 'featured_recipe',
        'meta_value' => 'yes'
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        echo '<div class="recipe-grid">';
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/content', 'recipe-card');
        endwhile;
        echo '</div>';

        the_posts_pagination(array(
            'prev_text' => __('Précédent'),
            'next_text' => __('Suivant'),
        ));
    else :
        echo '<p>Aucune recette vedette trouvée.</p>';
    endif;

    wp_reset_postdata();
    ?>
</main>

<?php get_footer(); ?>