<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 */
?>

<footer id="colophon" class="site-footer" role="contentinfo">

    <?php if ( is_active_sidebar( 'footer_1' ) ||  is_active_sidebar( 'footer_2'  )  ||  is_active_sidebar( 'footer_3'  ) ) : ?>
        <div class="footer-widgets widgets">

            <?php if ( is_active_sidebar( 'footer_1'  ) ) { ?>
                <div class="column">
                    <?php dynamic_sidebar('footer_1'); ?>
                </div><!-- .column -->
            <?php } ?>

            <?php if ( is_active_sidebar( 'footer_2'  ) ) { ?>
                <div class="column">
                    <?php dynamic_sidebar('footer_2'); ?>
                </div><!-- .column -->
            <?php } ?>

            <?php if ( is_active_sidebar( 'footer_3'  ) ) { ?>
                <div class="column">
                    <?php dynamic_sidebar('footer_3'); ?>
                </div><!-- .column -->
            <?php } ?>

         </div><!-- .footer-widgets -->

        <hr class="site-footer-separator">
    <?php endif; ?>

    <div class="site-info">
        <p class="copyright">
            <?php _e( 'Copyright', 'wpzoom' ); ?> &copy; <?php echo date( 'Y' ); ?> &mdash; <?php bloginfo('name'); ?>. <?php _e( 'Todos los derechos reservados', 'wpzoom' ); ?>
        </p>
        <p class="designed-by">
            <?php printf( __( 'Developed by %s', 'Magnesium.coop' ), '<a href="http://magnesium.coop/" target="_blank" rel="designer">Magnesium</a>' ); ?>
            - Designed by <a href="mailto:hola@flobrizuela.com" target="_blank" rel="designer">Flor Brizuela</a>
        </p>
    </div><!-- .site-info -->
</footer><!-- #colophon -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>