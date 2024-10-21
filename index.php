<?php get_header(); ?>

<main id="primary" class="site-main">

    <section class="hero" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/images/hero-background.jpg'); ?>');">
        <div class="hero-content">
            <h1>Bienvenue sur Recettes Gourmandes</h1>
            <p>Découvrez et partagez des recettes délicieuses pour tous les goûts</p>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('toutes-les-recettes'))); ?>" class="btn btn-primary" style="background-color: #414142;color: #fff;">Explorer nos recettes</a>
        </div>
    </section>

    <section class="featured-recipes">
        <div class="section-header">
            <h2>Recettes vedettes</h2>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('recettes-vedettes'))); ?>" class="btn btn-secondary">Voir toutes les vedettes</a>
        </div>
        <div class="recipe-grid">
            <?php
            $args = array(
                'post_type' => 'recette',
                'posts_per_page' => 3,
                'meta_key' => 'featured_recipe',
                'meta_value' => 'yes'
            );
            $featured_query = new WP_Query($args);
            if ($featured_query->have_posts()) :
                while ($featured_query->have_posts()) : $featured_query->the_post();
                    get_template_part('template-parts/content', 'recipe-card');
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="no-results">Aucune recette vedette pour le moment.</p>';
            endif;
            ?>
        </div>
    </section>

    <section class="recipe-categories">
        <h2>Explorez nos catégories</h2>
        <div class="category-grid">
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'recipe_category',
                'hide_empty' => false,
                'number' => 6
            ));
            if (!empty($categories) && !is_wp_error($categories)) :
                foreach ($categories as $category) {
                    $category_image = get_term_meta($category->term_id, 'category_image', true);
                    if (!$category_image) {
                        $category_image = get_template_directory_uri() . '/images/default-category.jpg';
                    }
                    ?>
                    <a href="<?php echo esc_url(get_term_link($category)); ?>" class="category-card" style="background-image: url('<?php echo esc_url($category_image); ?>');">
                        <h3><?php echo esc_html($category->name); ?></h3>
                    </a>
                    <?php
                }
            endif;
            ?>
        </div>
    </section>

    <section class="latest-recipes">
        <div class="section-header">
            <h2>Dernières recettes</h2>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('toutes-les-recettes'))); ?>" class="btn btn-secondary">Voir toutes les recettes</a>
        </div>
        <div class="recipe-grid">
            <?php
            $args = array(
                'post_type' => 'recette',
                'posts_per_page' => 6
            );
            $latest_query = new WP_Query($args);
            if ($latest_query->have_posts()) :
                while ($latest_query->have_posts()) : $latest_query->the_post();
                    get_template_part('template-parts/content', 'recipe-card');
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="no-results">Aucune recette disponible pour le moment.</p>';
            endif;
            ?>
        </div>
    </section>

    <section class="cta" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/images/cta-background.jpg'); ?>');">
        <div class="cta-content">
            <h2>Vous avez une recette à partager ?</h2>
            <p>Rejoignez notre communauté et partagez vos meilleures créations culinaires !</p>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('soumettre-une-recette'))); ?>" class="btn btn-primary" style="background-color: #414142;color: #fff;">Soumettre une recette</a>
        </div>
    </section>

</main>

<?php get_footer(); ?>