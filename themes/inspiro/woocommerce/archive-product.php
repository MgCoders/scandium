<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

<div class="wrap wrap--layout-<?php echo esc_attr( option::get( 'layout_shop' ) ); ?>">

    <h2 class="section-title"><?php woocommerce_page_title(); ?></h2>

    <main id="main" class="site-main" role="main">

        <section class="products-archive">

            <?php do_action( 'woocommerce_archive_description' ); ?>

            <?php

                do_action('woocommerce_output_content_wrapper');
            ?>

            <?php if ( have_posts() ) : ?>

                <?php
                    /**
                     * woocommerce_before_shop_loop hook
                     *
                     * @hooked woocommerce_result_count - 20
                     * @hooked woocommerce_catalog_ordering - 30
                     */
                    do_action( 'woocommerce_before_shop_loop' );
                ?>

                <?php woocommerce_product_loop_start(); ?>

                    <?php woocommerce_product_subcategories(); ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php woocommerce_get_template_part( 'content', 'product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

                <?php
                    /**
                     * woocommerce_after_shop_loop hook
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action( 'woocommerce_after_shop_loop' );
                ?>

            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                <?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

            <?php endif; ?>

        </section><!-- .recent-posts -->

    </main><!-- .site-main -->

    <?php if ( option::get( 'layout_shop' ) !== 'full' && is_active_sidebar( 'sidebar-shop' ) ) : ?>

        <div class="sidebar sidebar--shop">

            <?php dynamic_sidebar( 'sidebar-shop' ); ?>

        </div>

    <?php endif; ?>

</div><!-- .main-wrap -->

<?php
get_footer( 'shop' );
