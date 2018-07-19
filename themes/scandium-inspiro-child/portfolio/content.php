<?php
$articleClass = ( ! has_post_thumbnail() ) ? 'no-thumbnail ' : '';

$portfolios = wp_get_post_terms( get_the_ID(), 'portfolio' );
if ( is_array( $portfolios ) ) {
    foreach ( $portfolios as $portfolio ) {
        $articleClass .= 'portfolio_' . $portfolio->term_id . '_item ';
    }
}
?>
<a class="col-12 col-sm-6 col-md-4" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
    
        <article style="width: 100%; height: 100%" id="post-<?php the_ID(); ?>" class="my_portfolio_item" <?php //post_class( $articleClass ); ?> >


            <?php $img_principal = get_field('cf_fp_main_img')['url']; ?>


            <div class="my_entry-thumbnail-popover">
                <?php if($img_principal) {
                ?>
                <span> <b><?php echo strtoupper( get_the_title()) ; ?></b> </span>
                <?php
                } else {
                ?>
                <p> <b><?php echo strtoupper( get_the_title()) ; ?></b> </p>
                <?php
                }
                ?>
            </div>



            <?php 

                
            if ( $img_principal )  : ?>

                <?php //the_post_thumbnail( 'portfolio_item-thumbnail' ); ?>
                <div class="div_cat_fi_list"
                     style="background-image: url('<?php echo $img_principal; ?>');>">
                    <img style="opacity: 0" src="<?php echo $img_principal; ?>">
                </div>
            <?php else: ?>

                <img src="<?php echo get_template_directory_uri() . '/images/portfolio_item-placeholder.gif'; ?>">

            <?php endif; ?>
        
        </article><!-- #post-## -->
        
</a>