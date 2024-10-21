<footer id="colophon" class="site-footer">
    <div class="footer-content">
        <div class="footer-row">
            <div class="footer-column">
                <h3>À propos</h3>
                <p>Recettes Gourmandes est votre destination culinaire pour découvrir et partager des recettes délicieuses.</p>
            </div>
            <div class="footer-column" style="list-style: none;">
                <h3>Liens rapides</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'menu_id'        => 'footer-menu',
                    'depth'          => 1,
                    'container'      => false,
                    'menu_class'     => 'footer-menu-list',
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ));
                ?>
            </div>
            <div class="footer-column">
                <h3>Catégories populaires</h3>
                <?php
                $categories = get_terms(array(
                    'taxonomy' => 'recipe_category',
                    'number' => 5,
                    'orderby' => 'count',
                    'order' => 'DESC'
                ));
                if (!empty($categories) && !is_wp_error($categories)) :
                    echo '<ul class="footer-category-list">';
                    foreach ($categories as $category) {
                        echo '<li><a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a></li>';
                    }
                    echo '</ul>';
                endif;
                ?>
            </div>
        </div>
        <div class="footer-row">
            <div class="footer-column">
                <h3>Suivez-nous</h3>
                <div class="social-links" style="list-style: none;">
                    <a href="#" class="social-link facebook" style="list-style: none;">Facebook</a>
                    <a href="#" class="social-link instagram">Instagram</a>
                    <a href="#" class="social-link pinterest">Pinterest</a>
                    <a href="#" class="social-link youtube">YouTube</a>
                </div>
            </div>
            <div style="width: 33%;"></div>
            <div class="footer-column">
                <h3>Newsletter</h3>
                <form action="#" method="post" class="newsletter-form">
                    <input type="email" name="email" placeholder="Votre adresse email" required>
                    <button type="submit">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="site-info">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Tous droits réservés.</p>
            <p>
                <a href="<?php echo esc_url(home_url('/mentions-legales')); ?>">Mentions légales</a> |
                <a href="<?php echo esc_url(home_url('/politique-de-confidentialite')); ?>">Politique de confidentialité</a>
            </p>
        </div>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>