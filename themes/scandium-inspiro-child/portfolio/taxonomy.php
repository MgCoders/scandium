
        

<?php

$taxonomy_obj = $wp_query->get_queried_object();
$taxonomy_nice_name = $taxonomy_obj->name;


get_header(); ?>


<?php 

        $order_str = $taxonomy_obj->slug;

        if($taxonomy_obj->slug == "residential") {
            $order_str = "residencial";
        } else if($taxonomy_obj->slug == "offices-and-hotels") {
            $order_str = "oficinas-y-hoteles";
        } else if($taxonomy_obj->slug == "infrastructure") {
            $order_str = "infraestructura";
        } else if($taxonomy_obj->slug == "cultural-es" or $taxonomy_obj->slug == "cultural-en") {
            $order_str = "cultural";
        }



        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

        $args = array(
            'post_type'      => 'portfolio_item',
            'paged'          => $paged,
            'posts_per_page' => option::get( 'portfolio_posts' ),
            'portfolio' => $taxonomy_obj->slug,
            'term_id' => $taxonomy_obj->term_id,
            'term_taxonomy_id' => $taxonomy_obj->term_taxonomy_id,
            'meta_key' => 'order_value_num_'.$order_str,
            'orderby' => 'meta_value_num',
            'order' => 'ASC'
        );

        //print("<pre>".print_r($args,true)."</pre>");

        $wp_query = new WP_Query( $args );
        ?>



<main id="main" class="site-main" role="main">

    <section class="portfolio-archive">

        <?php //print("<pre>".print_r($wp_query,true)."</pre>"); ?>

        <!--h2 class="section-title"><?php echo $taxonomy_nice_name; ?></h2-->

        <nav class="bordered_li no_title portfolio-archive-taxonomies">
            <ul>
            
                <?php wp_list_categories( array( 'title_li' => '', 'hierarchical' => true,  'taxonomy' => 'portfolio', 'depth' => 1 ) ); ?>
            </ul>
        </nav>

        <?php if ( $wp_query->have_posts() ) : ?>

             <script type="text/javascript">
                var wpz_currPage = <?php echo $paged; ?>,
                    wpz_maxPages = <?php echo $wp_query->max_num_pages; ?>,
                    wpz_pagingURL = '<?php  echo (isset($_SERVER['HTTPS']) ? "https" : "http") ."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//the_permalink(); ?>page/';
            </script>
            <div class="container-fluid">
                <div class="row"> <?php /*row portfolio-grid*/?>

                    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                        <?php get_template_part( 'portfolio/content' ); ?>

                    <?php endwhile; ?>

                </div>
            </div>

            <?php get_template_part( 'pagination' ); ?>

        <?php else: ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

    </section><!-- .recent-posts -->

</main><!-- .site-main -->

<?php
get_footer();
