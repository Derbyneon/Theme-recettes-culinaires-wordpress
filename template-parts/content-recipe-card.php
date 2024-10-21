<article id="post-<?php the_ID(); ?>" <?php post_class('recipe-card'); ?> style="display: flex; align-items: flex-start; margin-bottom: 20px;">
    <a href="<?php the_permalink(); ?>" class="recipe-card-link" style="display: flex; text-decoration: none; color: inherit; flex-grow: 1;">
        <div class="recipe-card-inner" style="display: flex; flex-direction: row;">

            <?php if (has_post_thumbnail()) : ?>
                <div class="recipe-thumbnail" style="flex-shrink: 0; margin-right: 15px;">
                    <?php the_post_thumbnail('medium', array('style' => 'border-radius: 10px; object-fit: cover;')); ?>
                </div>
            <?php endif; ?>

            <div class="recipe-content" style="flex-grow: 1;">
                <header class="recipe-header" style="margin-bottom: 10px;">
                    <h3 class="recipe-title" style="font-size: 1.5em; margin: 0;"><?php the_title(); ?></h3>
                </header>
                
                <div class="recipe-meta" style="font-size: 0.9em; color: #777; margin-bottom: 10px;">
                    <span class="recipe-category"><?php echo get_the_term_list(get_the_ID(), 'recipe_category', '', ', '); ?></span>
                    <span class="recipe-date" style="margin-left: 10px;"><?php echo get_the_date(); ?></span>
                </div>
                
                <div class="recipe-excerpt" style="font-size: 1em; color: #333;">
                    <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                </div>
            </div>

        </div>
    </a>
</article>
