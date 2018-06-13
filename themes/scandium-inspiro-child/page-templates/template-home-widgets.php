<?php
/**
 * Template Name: Homepage (Widgetized)
 */

get_header(); ?>

<?php if ( option::is_on( 'featured_posts_show' ) ) : ?>

    <?php get_template_part( 'wpzoom-slider' ); ?>

<?php endif; ?>

<div id="content-homepage" class="widgetized-section">
    <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'home-full' ) ) : ?>

    <?php endif; ?>
</div>

<div id="" class="row">
	<div id="" class="col-0 col-md-2"> </div>
	<div id="div_slick" class="col-12 col-md-8">
		<div class="widgetized-section-c1">
			<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Carrousel_clientes_1' ) ) : ?>

			<?php endif; ?>
		</div>
		<div class="widgetized-section-c2">
			<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Carrousel_clientes_2' ) ) : ?>

			<?php endif; ?>
		</div>
		<div class="widgetized-section-c3">
			<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Carrousel_clientes_3' ) ) : ?>

			<?php endif; ?>
		</div>
		<div class="widgetized-section-c4">
			<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Carrousel_clientes_4' ) ) : ?>

			<?php endif; ?>
		</div>
	</div>
</div>			

<?php
get_footer();
