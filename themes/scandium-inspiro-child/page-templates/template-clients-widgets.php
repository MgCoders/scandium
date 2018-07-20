<?php
/**
 * Template Name: Clients (Widgetized)
 */

get_header(); ?>
<main id="main" class="site-main" role="main">

    <!--h2 class="section-title"><?php //the_title(); ?></h2-->
<?php /*
    $logo_data = get_post_meta( 5946, '_logo', true );
    echo '<pre>'; print_r($logo_data) ; echo '</pre>';

    echo get_field($post_id, 'lc_type');
    print_r(get_field($post_id, 'lc_type'));
*/
?>
	<div class="widgetized-section-clients">
	    <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Clientes-page' ) ) : ?>

	    <?php endif; ?>
	</div>



</main>
<?php
get_footer();
