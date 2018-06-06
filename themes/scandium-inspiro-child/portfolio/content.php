<?php
$articleClass = ( ! has_post_thumbnail() ) ? 'no-thumbnail ' : '';

$portfolios = wp_get_post_terms( get_the_ID(), 'portfolio' );
if ( is_array( $portfolios ) ) {
    foreach ( $portfolios as $portfolio ) {
        $articleClass .= 'portfolio_' . $portfolio->term_id . '_item ';
    }
}
?>
<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
<article id="post-<?php the_ID(); ?>" class="my_portfolio_item" <?php //post_class( $articleClass ); ?> >
    <div class="my_entry-thumbnail-popover">
        <?php if(has_post_thumbnail()) {
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

    <?php if ( has_post_thumbnail() )  : ?>

        <?php the_post_thumbnail( 'portfolio_item-thumbnail' ); ?>

    <?php else: ?>

        <img width="600" height="400" src="<?php echo get_template_directory_uri() . '/images/portfolio_item-placeholder.gif'; ?>">

    <?php endif; ?>

</article><!-- #post-## -->
</a>