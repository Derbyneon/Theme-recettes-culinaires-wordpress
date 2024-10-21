<?php
/*
Template Name: Soumettre une recette
*/
get_header();
?>

<main id="primary" class="site-main">
    <h1><?php the_title(); ?></h1>

    <?php
    if (is_user_logged_in()) {
        echo do_shortcode('[contact-form-7 id="VOTRE_ID_DE_FORMULAIRE" title="Soumettre une recette"]');
    } else {
        echo '<p>Vous devez être connecté pour soumettre une recette. <a href="' . wp_login_url(get_permalink()) . '">Se connecter</a></p>';
    }
    ?>
</main>

<?php get_footer(); ?>