<?php


/* Registering metaboxes
============================================*/

add_action( 'admin_menu', 'wpzoom_options_box' );

function wpzoom_options_box() {

    add_meta_box( 'wpzoom_top_button', 'Slideshow Options', 'wpzoom_top_button_options', 'slider', 'side', 'high' );

    add_meta_box( 'wpzoom_video_background', 'Video Background', 'wpzoom_home_slider_video_background', 'slider', 'side', 'high' );

}


function wpz_newpost_head() {
    ?><style type="text/css">
        fieldset.fieldset-show { padding: 0.3em 0.8em 1em; border: 1px solid rgba(0, 0, 0, 0.2); -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; }
        fieldset.fieldset-show p { margin: 0 0 1em; }
        fieldset.fieldset-show p:last-child { margin-bottom: 0; }

         .wpz_list { font-size: 11px; }
         .wpz_border { border-bottom: 1px solid #EEEEEE; padding: 0 0 10px; }

    </style><?php
}
add_action('admin_head-post-new.php', 'wpz_newpost_head', 100);
add_action('admin_head-post.php', 'wpz_newpost_head', 100);

/* Slideshow Options
============================================*/
function wpzoom_top_button_options() {
    global $post;

    ?>

    <p>
        <strong><label for="wpzoom_slide_url"><?php _e( 'Slide URL', 'wpzoom' ); ?></label></strong> (<?php _e('optional', 'wpzoom'); ?>)<br/>
        <input type="text" name="wpzoom_slide_url" id="wpzoom_slide_url" class="widefat"
               value="<?php echo esc_url( get_post_meta( $post->ID, 'wpzoom_slide_url', true ) ); ?>"/>
    </p>


    <fieldset class="fieldset-show">
        <legend><strong><?php _e( 'Slide Button', 'wpzoom' ); ?></strong></legend>

        <p>
            <label>
                <strong><?php _e( 'Title', 'wpzoom' ); ?></strong> <?php _e( '(optional)', 'wpzoom' ); ?>
                <input type="text" name="wpzoom_slide_button_title" id="wpzoom_slide_button_title" class="widefat" value="<?php echo esc_attr( get_post_meta( $post->ID, 'wpzoom_slide_button_title', true ) ); ?>" />
            </label>
        </p>

        <p>
            <label>
                <strong><?php _e( 'URL', 'wpzoom' ); ?></strong> <?php _e( '(optional)', 'wpzoom' ); ?>
                <input type="text" name="wpzoom_slide_button_url" id="wpzoom_slide_button_url" class="widefat" value="<?php echo esc_url( get_post_meta( $post->ID, 'wpzoom_slide_button_url', true ) ); ?>" />
            </label>
        </p>
   </fieldset>




<?php
}


function wpzoom_home_slider_video_background() {
    global $post;
    ?>
    <br />
    <div class="wp-media-buttons" data-button="Set Video" data-title="Set Video" data-target="#wpzoom_home_slider_video_bg_url">
        <a href="#" id="wpzoom-home-slider-video-bg-insert-media-button" class="button add_media" title="Add Video">
            <span class="wp-media-buttons-icon"></span>
            <?php _e('Add Video', 'wpzoom'); ?>
        </a>
    </div>

    <div class="clear"></div>

    <p>
        <label>
            <strong><?php _e( 'MP4 (h.264) video URL', 'wpzoom' ); ?></strong>
            <input type="text" name="wpzoom_home_slider_video_bg_url_mp4" id="wpzoom_home_slider_video_bg_url_mp4" class="widefat" value="<?php echo esc_attr( get_post_meta( $post->ID, 'wpzoom_home_slider_video_bg_url_mp4', true ) ); ?>" />

            <p class="description"><?php _e('This format is supported by most of the browsers and mobile devices.', 'wpzoom'); ?>
        </label>
    </p>

    <div class="wpz_border"></div>

    <p>
        <label>
            <strong><?php _e( 'WebM video URL', 'wpzoom' ); ?></strong>
            <input type="text" name="wpzoom_home_slider_video_bg_url_webm" id="wpzoom_home_slider_video_bg_url_webm" class="widefat" value="<?php echo esc_attr( get_post_meta( $post->ID, 'wpzoom_home_slider_video_bg_url_webm', true ) ); ?>" />

            <p class="description"><?php _e('This format is needed for <strong>Firefox</strong>.', 'wpzoom'); ?>
        </label>
    </p>
    <div class="wpz_border"></div>
    <p>
        <em><strong>Tips:</strong></em><br/>
        <ol class="wpz_list">
            <li>If your server can't play MP4 videos, check this <a href="http://www.wpzoom.com/docs/enable-mp4-video-support-linuxapache-server/" target="_blank">tutorial</a> for a fix.</li>
            <li>Your <strong>MP4</strong> videos must have the <em>H.264</em> enconding. You can convert your videos with <a href="http://handbrake.fr/downloads.php" target="_blank">HandBrake</a> video converter.</li>
            <li>Check out <a href="http://mazwai.com/" target="_blank">Mazwai</a> for a collection of free stock videos.</li>

        </ol>
    </p>

    <?php
}

add_action('admin_enqueue_scripts', 'wpzoom_home_slider_video_background_scripts' );

function wpzoom_home_slider_video_background_scripts( $hook_suffix ) {
    if ( ( $hook_suffix == 'post.php' && isset( $_GET['post'] ) ) || $hook_suffix == 'post-new.php' ) {
        wp_enqueue_script( 'wpzoom-home-slider-video-background', get_stylesheet_directory_uri() . '/js/admin-video-background.js', array( 'jquery' ), WPZOOM::$themeVersion );
    }
}

add_filter( 'upload_mimes','inspiro_add_custom_mime_types' );
function inspiro_add_custom_mime_types( $mimes ) {
    return array_merge( $mimes, array(
        'webm' => 'video/webm',
    ) );
}


add_action( 'save_post', 'custom_add_save' );

function custom_add_save( $postID ) {

    // called after a post or page is saved
    if ( $parent_id = wp_is_post_revision( $postID ) ) {
        $postID = $parent_id;
    }


    if ( isset( $_POST['save'] ) || isset( $_POST['publish'] ) ) {

        if ( isset( $_POST['wpzoom_slide_url'] ) )
            update_custom_meta( $postID, esc_url_raw( $_POST['wpzoom_slide_url'] ), 'wpzoom_slide_url' );

        if ( isset( $_POST['wpzoom_slide_button_title'] ) )
            update_custom_meta( $postID, $_POST['wpzoom_slide_button_title'] , 'wpzoom_slide_button_title' );

        if ( isset( $_POST['wpzoom_slide_button_url'] ) )
            update_custom_meta( $postID, esc_url_raw( $_POST['wpzoom_slide_button_url'] ), 'wpzoom_slide_button_url' );

        if ( isset( $_POST['wpzoom_home_slider_video_bg_url_mp4'] ) )
            update_custom_meta( $postID, esc_url_raw( $_POST['wpzoom_home_slider_video_bg_url_mp4'] ), 'wpzoom_home_slider_video_bg_url_mp4' );

        if ( isset( $_POST['wpzoom_home_slider_video_bg_url_webm'] ) )
            update_custom_meta( $postID, esc_url_raw( $_POST['wpzoom_home_slider_video_bg_url_webm'] ), 'wpzoom_home_slider_video_bg_url_webm' );

    }
}


function update_custom_meta( $postID, $value, $field ) {
    // To create new meta
    if ( ! get_post_meta( $postID, $field ) ) {
        add_post_meta( $postID, $field, $value );
    } else {
        // or to update existing meta
        update_post_meta( $postID, $field, $value );
    }
}
