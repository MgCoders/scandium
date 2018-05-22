<?php
/**
 * Template Name: Studio (Widgetized)
 */

get_header(); ?>
<main id="main" class="site-main" role="main">

    <article id="post-<?php the_ID(); ?>" <?php post_class( ( has_post_thumbnail() || $hasSlider ) ? ' has-post-cover' : '' ); ?>>
        <div class="container-fluid no-padding">
            <div class="row no-gutters">

				<div class="col-12">
                    <div class="entry-cover">
                        <?php 
                        	$entryCoverBackground = get_the_image( 
                        								array( 'size' => 'entry-cover', 'format' => 'array' ) 
                        							); 
                    	?>                           

                        <div class="entry-cover-image" 
                    		 style="background-image: url('<?php echo $entryCoverBackground['src'] ?>');">
                    		 	
                		</div>
                    </div>
                </div>
            </div>
        </div>
    </article>

	<div class="container">
		<div class="widgetized-section">
		    <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Estudio' ) ) : ?>

		    <?php endif; ?>
		</div>
	</div>
</main>
<?php
get_footer();
