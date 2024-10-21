<?php

// Enregistrement des menus (principal et footer)
function recettes_gourmandes_menus() {
    register_nav_menus(
        array(
            'menu-1' => esc_html__( 'Primary', 'recettes-gourmandes' ),
            'footer-menu' => esc_html__( 'Footer Menu', 'recettes-gourmandes' ),
        )
    );
}
add_action( 'init', 'recettes_gourmandes_menus' );

// Ajout du support pour le logo personnalisé
function recettes_gourmandes_custom_logo_setup() {
    add_theme_support( 'custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ) );
}
add_action( 'after_setup_theme', 'recettes_gourmandes_custom_logo_setup' );

// Enregistrement des zones de widgets pour le footer
function recettes_gourmandes_widgets_init() {
    $footer_widget_areas = array('Footer 1', 'Footer 2', 'Footer 3');
    
    foreach ($footer_widget_areas as $index => $name) {
        register_sidebar( array(
            'name'          => esc_html__( $name, 'recettes-gourmandes' ),
            'id'            => 'footer-' . ($index + 1),
            'description'   => esc_html__( 'Add widgets here.', 'recettes-gourmandes' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
}
add_action( 'widgets_init', 'recettes_gourmandes_widgets_init' );

// Enregistrement du type de contenu personnalisé "recette"
function recettes_gourmandes_register_post_type() {
    $args = array(
        'public'    => true,
        'label'     => 'Recettes',
        'menu_icon' => 'dashicons-food',
        'supports'  => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'has_archive' => true,
        'rewrite'   => array( 'slug' => 'recettes' ),
    );
    register_post_type( 'recette', $args );
}
add_action( 'init', 'recettes_gourmandes_register_post_type' );

// Enregistrement de la taxonomie "catégorie de recette"
function recettes_gourmandes_register_taxonomy() {
    $args = array(
        'hierarchical' => true,
        'label'        => 'Catégories de recettes',
        'rewrite'      => array( 'slug' => 'categorie-recette' ),
    );
    register_taxonomy( 'recipe_category', 'recette', $args );
}
add_action( 'init', 'recettes_gourmandes_register_taxonomy' );

// Ajout de la prise en charge des images mises en avant
function recettes_gourmandes_theme_support() {
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'recettes_gourmandes_theme_support' );

// Enregistrement des scripts et des styles
function recettes_gourmandes_scripts() {
    wp_enqueue_style( 'recettes-gourmandes-style', get_stylesheet_uri() );
    wp_enqueue_script( 'recettes-gourmandes-script', get_template_directory_uri() . '/js/script.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'recettes_gourmandes_scripts' );

// Fonction pour afficher les étoiles de notation
function recettes_gourmandes_display_rating( $rating ) {
    $output = '<div class="recipe-rating">';
    for ( $i = 1; $i <= 5; $i++ ) {
        if ( $i <= $rating ) {
            $output .= '<span class="star filled">&#9733;</span>';
        } else {
            $output .= '<span class="star">&#9734;</span>';
        }
    }
    $output .= '</div>';
    return $output;
}

// Shortcode pour le formulaire de soumission de recette
function recettes_gourmandes_submit_recipe_form() {
    if ( ! is_user_logged_in() ) {
        return 'Vous devez être connecté pour soumettre une recette.';
    }

    // Le code du formulaire sera ajouté ici
    return 'Formulaire de soumission de recette à implémenter';
}
add_shortcode( 'submit_recipe_form', 'recettes_gourmandes_submit_recipe_form' );


function create_recipe_post_type() {
    register_post_type('recette',
        array(
            'labels' => array(
                'name' => __('Recettes'),
                'singular_name' => __('Recette')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-food',
        )
    );

    register_taxonomy('recipe_category', 'recette',
        array(
            'label' => __('Catégories de recettes'),
            'hierarchical' => true,
            'public' => true,
        )
    );
}
add_action('init', 'create_recipe_post_type');


function add_featured_recipe_meta_box() {
    add_meta_box(
        'featured_recipe_meta_box',
        'Recette vedette',
        'display_featured_recipe_meta_box',
        'recette',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'add_featured_recipe_meta_box');

function display_featured_recipe_meta_box($post) {
    $featured = get_post_meta($post->ID, 'featured_recipe', true);
    ?>
    <label for="featured_recipe">
        <input type="checkbox" name="featured_recipe" id="featured_recipe" value="yes" <?php checked($featured, 'yes'); ?> />
        Marquer comme recette vedette
    </label>
    <?php
}

function save_featured_recipe_meta($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $featured = isset($_POST['featured_recipe']) ? 'yes' : 'no';
    update_post_meta($post_id, 'featured_recipe', $featured);
}
add_action('save_post_recette', 'save_featured_recipe_meta');


function recettes_gourmandes_custom_search( $query ) {
    if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
        $query->set( 'post_type', array( 'recette' ) );
    }
}
add_action( 'pre_get_posts', 'recettes_gourmandes_custom_search' );


function register_my_menus() {
    register_nav_menus(
      array(
        'footer-menu' => __( 'Footer Menu' ),
        // autres emplacements de menu...
      )
    );
  }
  add_action( 'init', 'register_my_menus' );