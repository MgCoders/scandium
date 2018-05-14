<?php
/**
 * Created by IntelliJ IDEA.
 * User: goja288
 * Date: 28/03/18
 * Time: 04:47 PM
 */

class My_Widget extends WP_Widget {

    public function __construct() {
        // actual widget processes
    }

    public function widget( $args, $instance ) {
        // outputs the content of the widget
    }

    public function form( $instance ) {
        // outputs the options form in the admin
    }

    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
    }

}