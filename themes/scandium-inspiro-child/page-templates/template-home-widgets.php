<?php
/**
 * Template Name: Homepage (Widgetized)
 */

get_header(); ?>

<?php if ( option::is_on( 'featured_posts_show' ) ) : ?>

    <?php get_template_part( 'wpzoom-slider' ); ?>

<?php endif; ?>

<div class="widgetized-section">
	 asdasd
    <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'home-full' ) ) : ?>

    <?php endif; ?>
</div>

<nav class="portfolio-archive-taxonomies">
            <ul class="portfolio-taxonomies">
                <li class="cat-item cat-item-all current-cat"><a href="<?php echo get_page_link( option::get( 'portfolio_url' ) ); ?>"><?php _e( 'All', 'wpzoom' ); ?></a></li>

                <?php wp_list_categories( array( 'title_li' => '', 'hierarchical' => true,  'taxonomy' => 'portfolio', 'depth' => 1 ) ); ?>
            </ul>
        </nav>

<?php
get_footer();
