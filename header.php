<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <style>
        /* Styles pour le logo */
        .custom-logo-link img {
            max-width: 200px;
            max-height: 80px;
            width: auto;
            height: auto;
        }

        /* Styles pour la barre de recherche */
        .header-search form {
            display: flex;
            align-items: center;
        }
        .header-search input[type="search"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            width: 250px;
            font-size: 16px;
        }
        .header-search input[type="search"]:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0,123,255,.25);
        }

        /* Styles pour l'icône utilisateur */
        .user-actions .user-profile img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
        }
        .user-actions .login-link svg {
            width: 48px;
            height: 48px;
        }
        .user-actions {
            display: flex;
            align-items: center;
        }
        .user-actions a {
            margin-left: 10px;
            text-decoration: none;
            color: #333;
        }

        /* Styles pour la barre de navigation */
        .main-navigation ul {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .main-navigation li {
            margin-right: 20px;
        }
        .main-navigation a {
            text-decoration: none;
            color: #333;
        }

        /* Styles supplémentaires pour la mise en page */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }
        .header-right {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'recettes-gourmandes' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="header-container">
            <div class="site-branding">
                <?php
                if ( has_custom_logo() ) :
                    the_custom_logo();
                else :
                    ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php endif; ?>
            </div><!-- .site-branding -->

            <div class="header-right">
                <div class="header-search">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <label>
                            <span class="screen-reader-text"><?php _e( 'Search for:', 'recettes-gourmandes' ); ?></span>
                            <input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Trouver LA recette qui vous fait envie', 'recettes-gourmandes' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                        </label>
                    </form>
                </div>

                <div class="user-actions">
                    <?php if ( is_user_logged_in() ) : ?>
                        <a href="<?php echo esc_url( get_edit_profile_url() ); ?>" class="user-profile">
                            <?php
                            $current_user = wp_get_current_user();
                            echo get_avatar( $current_user->ID, 48 );
                            ?>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo esc_url( wp_login_url() ); ?>" class="login-link">
                            <svg viewBox="0 0 24 24" width="48" height="48"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                        </a>
                        <a href="<?php echo esc_url( wp_registration_url() ); ?>" class="register-link">S'inscrire</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <nav id="site-navigation" class="main-navigation">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'nav-menu',
                )
            );
            ?>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->