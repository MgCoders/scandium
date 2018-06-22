<?php
$sliderLoop = new WP_Query( array(
	'post_type' 	 => 'slider',
	'posts_per_page' => option::get( 'featured_posts_posts' )
) );

$slide_counter = 0;
?>




            <div id="slider">

                <?php if ( $sliderLoop->have_posts() ) : ?>

                    <ul class="slides">

                        <?php while ( $sliderLoop->have_posts() ) : $sliderLoop->the_post(); ?>

                            <?php
                            //echo '<pre>'; print_r(get_post_meta( get_the_ID())['text']['0']); echo '</pre>';


                            $locale_str = get_bloginfo("language");
                            $current_lang = substr($locale_str, 0, 2);
                            $ext = "";

                            if($current_lang != 'es'){
                                $ext = "_".$current_lang;
                            }

                            $txt_img = get_post_meta( get_the_ID())['txt_img'.$ext]['0'];    
                            $lugar_img = get_post_meta( get_the_ID())['lugar_img'.$ext]['0'];    
                            $slide_url = trim( get_post_meta( get_the_ID(), 'wpzoom_slide_url', true ) );
                            $btn_title = trim( get_post_meta( get_the_ID(), 'wpzoom_slide_button_title', true ) );
                            $btn_url = trim( get_post_meta( get_the_ID(), 'wpzoom_slide_button_url', true ) );
                            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured');
                            $small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured-small');
                            $video_background_mp4 = get_post_meta( get_the_ID(), 'wpzoom_home_slider_video_bg_url_mp4', true );
                            $video_background_webm = get_post_meta( get_the_ID(), 'wpzoom_home_slider_video_bg_url_webm', true );

                            $is_video_slide = $video_background_mp4 || $video_background_webm;

                            $slide_counter++;

                            $style = '';

                            if ( ! $is_video_slide || option::is_on( 'slideshow_video_fallback' ) ) {
                                $style = ' data-smallimg="' . $small_image_url[0] . '" data-bigimg="' . $large_image_url[0] . '"';

                                if ($slide_counter === 1) {
                                    $style .= ' style="background-image:url(\'' . $large_image_url[0] . '\')"';
                                }
                            }
                            ?>

                            <li<?php echo $style; ?>>

                                <?php if ( option::is_on( 'slideshow_overlay' ) ) : ?>

                                    <div class="slide-background-overlay"></div>

                                <?php endif; ?>

                                <?php if ( $is_video_slide ): ?>

                                    <div class="video-background" data-mp4="<?php echo esc_attr( $video_background_mp4 ) ?>" data-webm="<?php echo esc_attr( $video_background_webm ); ?>">

                                    </div><!-- /.cover -->

                                <?php endif; ?>

                                <div class="li-wrap">

                                    <?php if ( empty( $slide_url ) ) : ?>

                                        <?php //the_title( '<h3 class="missing-url">', '</h3>' ); ?>

                                    <?php else: ?>

                                        <?php the_content(); ?>

                                    <?php endif; ?>

                                    <div class="excerpt">
                                        <b>
                                            <?php echo  $txt_img; ?>
                                        </b> 
                                        |
                                        <?php echo  $lugar_img; ?>
                                        
                                    </div>

                                    <?php if ( !empty( $btn_title ) && !empty( $btn_url ) ) {
                                        ?><div class="slide_button">
                                            <a href="<?php echo esc_url( $btn_url ); ?>"><?php echo esc_html( $btn_title ); ?></a>
                                        </div><?php
                                    } ?>
                                </div>
                            </li>
                        <?php endwhile; ?>

                    </ul>

                    <div id="scroll-to-content" title="<?php esc_attr_e( 'Scroll to Content', 'wpzoom' ); ?>">
                        <?php _e( 'Scroll to Content', 'wpzoom' ); ?>
                    </div>

                <?php else: ?>

                    <div class="empty-slider">
                        <p><strong><?php _e( 'You are now ready to set-up your Slideshow content.', 'wpzoom' ); ?></strong></p>

                        <p>
                            <?php
                            printf(
                                __( 'For more information about adding posts to the slider, please <strong><a href="%1$s">read the documentation</a></strong> or <a href="%2$s">add a new post</a>.', 'wpzoom' ),
                                'http://www.wpzoom.com/documentation/inspiro/',
                                admin_url( 'post-new.php?post_type=slider' )
                            );
                            ?>
                        </p>
                    </div>

                <?php endif; ?>

            </div>
