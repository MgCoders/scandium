<?php
/**
 * The Template for displaying all single products.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

<div class="wrap wrap--layout-<?php echo esc_attr( option::get( 'layout_product' ) ); ?>">

    <main id="main" class="site-main container-fluid" role="main">

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="entry-content">

                <?php do_action('woocommerce_output_content_wrapper'); ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

                <?php endwhile; // end of the loop. ?>

            </div>

            <div class="clearfix"></div>
        </article><!-- #post-## -->

    </main><!-- #main -->


    <?php if ( option::get( 'layout_product' ) !== 'full' && is_active_sidebar( 'sidebar-shop' ) ) : ?>

        <div class="sidebar sidebar--shop sidebar--product">

            <?php dynamic_sidebar( 'sidebar-shop' ); ?>

        </div>

    <?php endif; ?>

</div><!-- .main-wrap -->

<?php get_footer('shop'); ?>