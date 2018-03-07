<?php

/*------------------------------------------*/
/* WPZOOM: Portfolio Scroller               */
/*------------------------------------------*/

class Wpzoom_Portfolio_Scroller extends WP_Widget {

    function __construct() {
        /* Widget settings. */
        $widget_ops = array( 'classname' => 'wpzoom-portfolio-scroller', 'description' => 'Your portfolio posts in an attractive horizontal scroller.' );

        /* Widget control settings. */
        $control_ops = array( 'id_base' => 'wpzoom-portfolio-scroller' );

        /* Create the widget. */
        parent::__construct( 'wpzoom-portfolio-scroller', 'WPZOOM: Portfolio Scroller', $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {

        global $wp_query;

        extract( $args );

        /* User-selected settings. */
        $title = apply_filters( 'widget_title', $instance['title'] );
        $category = absint( $instance['category'] );
        $items_num = absint( $instance['items_num'] );
        $items_height = 0 < ( $height = absint( $instance['items_height'] ) ) ? $height : 560;
        $show_title = $instance['hide_title'] === false;
        $show_excerpt = $instance['hide_excerpt'] === false;
        $direction = $instance['direction'] == 'left' ? 'left' : 'right';
        $auto_scroll = $instance['auto_scroll'] == true;
        $scroll_speed = absint( $instance['scroll_speed'] );
        $hover_pause = $instance['hover_pause'] == true;

        /* Before widget (defined by themes). */
        echo $before_widget;

        /* Title of widget (before and after defined by themes). */
        if ( $title )
            echo $before_title . $title . $after_title;

        ?>

        <div id="loading">
            <div class="spinner">
                <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div>
            </div>
        </div>

        <div class="portfolio-scroller">

            <?php $query_opts = apply_filters('wpzoom_query', array(
                'posts_per_page' => $items_num,
                'post_type' => 'portfolio_item'
            ));
            if ( $category > 0 ) $query_opts['tax_query'] = array(
                array(
                    'taxonomy' => 'portfolio',
                    'terms' => $category
                )
            );
            $query = new WP_Query($query_opts);

            if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

            $articleClass = ( ! has_post_thumbnail() ) ? 'no-thumbnail ' : '';

            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class( $articleClass ); ?>>
                <div class="entry-thumbnail-popover">
                    <div class="entry-thumbnail-popover-content popover-content--animated">

                        <?php
                        if ( $show_title) :
                            the_title( sprintf( '<h2 class="portfolio_item-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                        endif;

                        if ( $show_excerpt) :
                            the_excerpt();
                        endif;
                        ?>

                        <a class="btn" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
                            <?php _e( 'View More', 'wpzoom' ); ?>
                        </a>
                    </div>
                </div>

                <?php get_the_image( array( 'size' => 'portfolio-scroller-widget', 'height' => $items_height ) );  ?>

            </article><!-- #post-## -->

            <?php endwhile; else:

                echo '<p>' . __( 'Nothing to display&hellip;', 'wpzoom' ) . '</p>';

            endif; ?>

        </div>

        <div class="scroller-nav">
            <a class="prev" id="navi-prev-<?php echo $this->get_field_id('id'); ?>" href="#">Previous</a>
            <a class="next" id="navi-next-<?php echo $this->get_field_id('id'); ?>" href="#">Next</a>
        </div>

        <script type="text/javascript">

        jQuery(function($) {

            var $c = $('.widget#<?php echo esc_js( $widget_id ); ?> .portfolio-scroller');

            var _direction = '<?php echo esc_js( $direction ); ?>';

            $c.imagesLoaded( function() {

                $c.parent().find('.portfolio-scroller').show();
                $c.parent().find('#loading').hide();

                $c.carouFredSel({
                    direction: _direction,
                    width: '100%',
                    auto: <?php echo $auto_scroll === true ? 'true' : 'false'; ?>,

                    prev    : {
                        button  : "#navi-prev-<?php echo $this->get_field_id('id'); ?>",
                        key     : "left"
                    },
                    next    : {
                        button  : "#navi-next-<?php echo $this->get_field_id('id'); ?>",
                        key     : "right"
                    },

                    height: <?php echo $items_height; ?>,
                        items: {
                        visible: '+1',
                        width: 'variable',
                        height: <?php echo $items_height; ?>
                    },
                    align: "left",
                    scroll: {
                        items: 1,
                        delay: 1000,
                        duration: <?php echo $scroll_speed; ?>,
                        timeoutDuration: 0,
                        easing: 'linear',
                        pauseOnHover: '<?php echo $hover_pause === true ? 'immediate' : 'false'; ?>'
                    }
                });

            });

        });

        </script><?php

        //Reset query_posts
        wp_reset_postdata();

        /* After widget (defined by themes). */
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        /* Strip tags (if needed) and update the widget settings. */
        $instance['title']        = sanitize_text_field( $new_instance['title'] );
        $instance['category']     = $new_instance['category'];
        $instance['items_num']    = absint( $new_instance['items_num'] );
        $instance['items_height'] = absint( $new_instance['items_height'] );
        $instance['hide_title']   = (bool) $new_instance['hide_title'];
        $instance['hide_excerpt'] = (bool) $new_instance['hide_excerpt'];
        $instance['direction']    = $new_instance['direction'] == 'left' ? 'left' : 'right';
        $instance['auto_scroll']  = $new_instance['auto_scroll'] == 'on';
        $instance['scroll_speed'] = abs( $new_instance['scroll_speed'] );
        $instance['hover_pause']  = $new_instance['hover_pause'] == 'on';

        return $instance;
    }

    function form( $instance ) {

        /* Set up some default widget settings. */
        $defaults = array( 'title' => '', 'category' => 0, 'items_num' => 5, 'items_height' => 560, 'hide_title' => false, 'hide_excerpt' => false, 'direction' => 'left', 'auto_scroll' => true, 'scroll_speed' => 7000, 'hover_pause' => true );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label>
                <?php _e( 'Title:', 'wpzoom' ); ?>
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" type="text" class="widefat" />
            </label>
        </p>

        <p>
            <label>
                <?php _e( 'Category:', 'wpzoom' ); ?>
                <select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" class="widefat">
                    <option value="0" <?php if ( !$instance['category'] ) echo 'selected="selected"'; ?>>All</option>
                    <?php
                    $categories = get_categories( array( 'taxonomy' => 'portfolio' ) );

                    foreach( $categories as $cat ) {
                        echo '<option value="' . $cat->cat_ID . '"';

                        if ( $cat->cat_ID == $instance['category'] ) echo  ' selected="selected"';

                        echo '>' . $cat->cat_name . ' (' . $cat->category_count . ')';

                        echo '</option>';
                    }
                    ?>
                </select>
            </label>
        </p>

        <p>
            <label>
                <?php _e( 'Visible Items:', 'wpzoom' ); ?>
                <input id="<?php echo $this->get_field_id( 'items_num' ); ?>" name="<?php echo $this->get_field_name( 'items_num' ); ?>" value="<?php echo absint( $instance['items_num'] ); ?>" type="number" size="4" />
            </label>
            <span class="howto"><?php _e( 'Number of portfolio items to show at one time', 'wpzoom' ); ?></span>
        </p>

        <p>
            <label>
                <?php _e( 'Item Height:', 'wpzoom' ); ?>
                <input id="<?php echo $this->get_field_id( 'items_height' ); ?>" name="<?php echo $this->get_field_name( 'items_height' ); ?>" value="<?php echo absint( $instance['items_height'] ); ?>" type="number" size="4" />
            </label>
            <span class="howto"><?php _e( 'The height of the items in the scroller', 'wpzoom' ); ?></span>
        </p>

        <p>
            <label>
                <input class="checkbox" type="checkbox" <?php checked( $instance['hide_title'] ); ?> id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" />
                <?php _e( 'Hide Post Title', 'wpzoom' ); ?>
            </label>
        </p>

        <p>
            <label>
                <input class="checkbox" type="checkbox" <?php checked( $instance['hide_excerpt'] ); ?> id="<?php echo $this->get_field_id( 'hide_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'hide_excerpt' ); ?>" />
                <?php _e( 'Hide Excerpt', 'wpzoom' ); ?>
            </label>
        </p>

        <p>
            <?php _e( 'Direction:', 'wpzoom' ); ?>
            <label><input id="<?php echo $this->get_field_id( 'direction' ); ?>" name="<?php echo $this->get_field_name( 'direction' ); ?>" value="left" type="radio" <?php checked( $instance['direction'], 'left' ); ?> /> <?php _e( 'Backward', 'wpzoom' ); ?></label>
            <label><input id="<?php echo $this->get_field_id( 'direction' ); ?>" name="<?php echo $this->get_field_name( 'direction' ); ?>" value="right" type="radio" <?php checked( $instance['direction'], 'right' ); ?> /> <?php _e( 'Forward', 'wpzoom' ); ?></label>
            <span class="howto"><?php _e( 'The direction the scroller will go', 'wpzoom' ); ?></span>
        </p>

        <p>
            <label>
                <input class="checkbox" type="checkbox" <?php checked( $instance['auto_scroll'] ); ?> id="<?php echo $this->get_field_id( 'auto_scroll' ); ?>" name="<?php echo $this->get_field_name( 'auto_scroll' ); ?>" />
                <?php _e( 'Auto-Scroll', 'wpzoom' ); ?>
            </label>
            <span class="howto"><?php _e( 'Automatically scroll through the portfolio items', 'wpzoom' ); ?></span>
        </p>

        <p>
            <label>
                <?php _e( 'Auto-Scroll Speed:', 'wpzoom' ); ?>
                <input id="<?php echo $this->get_field_id( 'scroll_speed' ); ?>" name="<?php echo $this->get_field_name( 'scroll_speed' ); ?>" value="<?php echo absint( $instance['scroll_speed'] ); ?>" type="number" size="4" /> ms
            </label>
            <span class="howto"><?php _e( 'The speed of the scroller in milliseconds', 'wpzoom' ); ?></span>
        </p>

        <p>
            <label>
                <input class="checkbox" type="checkbox" <?php checked( $instance['hover_pause'] ); ?> id="<?php echo $this->get_field_id( 'hover_pause' ); ?>" name="<?php echo $this->get_field_name( 'hover_pause' ); ?>" />
                <?php _e( 'Pause on Hover', 'wpzoom' ); ?>
            </label>
            <span class="howto"><?php _e( 'Pause the scroller when the user hovers their mouse over it', 'wpzoom' ); ?></span>
        </p><?php
    }
}

function wpzoom_register_ps_widget() {
    register_widget('Wpzoom_Portfolio_Scroller');
}
add_action('widgets_init', 'wpzoom_register_ps_widget');