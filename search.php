<?php get_header(); ?>

<main id="primary" class="site-main">

    <header class="page-header">
        <h1 class="page-title">
            <?php
            printf( esc_html__( 'Résultats de recherche pour : %s', 'recettes-gourmandes' ), '<span>' . get_search_query() . '</span>' );
            ?>
        </h1>
    </header><!-- .page-header -->

    <?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $search_term = get_search_query();

    $args = array(
        'post_type' => 'recette',
        's' => $search_term,
        'paged' => $paged
    );

    $search_query = new WP_Query( $args );

    if ( $search_query->have_posts() ) :
    ?>

        <div class="recipe-grid">
            <?php
            while ( $search_query->have_posts() ) :
                $search_query->the_post();
                get_template_part( 'template-parts/content', 'recipe-card' );
            endwhile;
            ?>
        </div>

        <?php
        the_posts_navigation();

    else :
        ?>
        <p><?php esc_html_e( 'Aucune recette trouvée. Essayez une autre recherche ?', 'recettes-gourmandes' ); ?></p>
        <?php
        get_search_form();
    endif;

    // Recherche dans les catégories
    $categories = get_terms( array(
        'taxonomy' => 'recipe_category',
        'name__like' => get_search_query(),
        'hide_empty' => false
    ) );

    if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
        ?>
        <h2><?php esc_html_e( 'Catégories correspondantes', 'recettes-gourmandes' ); ?></h2>
        <ul class="category-list">
            <?php
            foreach ( $categories as $category ) :
                ?>
                <li>
                    <a href="<?php echo esc_url( get_term_link( $category ) ); ?>">
                        <?php echo esc_html( $category->name ); ?>
                    </a>
                </li>
                <?php
            endforeach;
            ?>
        </ul>
        <?php
    endif;

    wp_reset_postdata();
    ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();