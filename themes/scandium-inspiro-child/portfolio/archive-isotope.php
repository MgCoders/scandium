<?php
/*
Template Name: Portfolio (Sorting Effect)
*/

get_header(); ?>

<main id="main" class="site-main" role="main">

    <section class="portfolio-archive">

        <h2 class="section-title"><?php the_title(); ?></h2>

        <nav class="portfolio-archive-taxonomies">
            <ul class="portfolio-taxonomies portfolio-taxonomies-filter-by">
                <li class="cat-item cat-item-all current-cat"><a href="<?php echo get_page_link( option::get( 'portfolio_url' ) ); ?>"><?php _e( 'All', 'wpzoom' ); ?></a></li>

                <?php wp_list_categories( array( 'title_li' => '', 'hierarchical' => true,  'taxonomy' => 'portfolio', 'depth' => 1 ) ); ?>
            </ul>
        </nav>

        <?php
        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

        $args = array(
            'post_type'      => 'portfolio_item',
            'posts_per_page' => -1,
        );

        $wp_query = new WP_Query( $args );
        ?>

        <?php if ( $wp_query->have_posts() ) : ?>

            <div class="row"> <?php /*row portfolio-grid*/?>

                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                    <?php get_template_part( 'portfolio/content' ); ?>

                <?php endwhile; ?>

            </div>

            <?php get_template_part( 'pagination' ); ?>

        <?php else: ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

    </section><!-- .portfolio-archive -->

</main><!-- .site-main -->

<?php
get_footer();
