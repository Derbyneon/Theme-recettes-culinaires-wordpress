<?php get_header(); ?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="recipe-featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <footer class="entry-footer">
                <?php
                $categories = get_the_term_list(get_the_ID(), 'recipe_category', 'Catégories : ', ', ');
                if ($categories) {
                    echo '<div class="recipe-categories">' . $categories . '</div>';
                }
                ?>
            </footer>
        </article>
    <?php
    endwhile;
    ?>
</main>

<?php get_footer(); ?>