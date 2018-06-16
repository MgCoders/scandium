<?php
/**
 * Created by IntelliJ IDEA.
 * User: goja288
 * Date: 13/03/18
 * Time: 05:39 PM
 */
/*
function scandium_remove_menu_pages() {
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu','scandium_remove_menu_pages');


function scandium_remove_widget_areas() {
    unregister_sidebar('sidebar');
    unregister_sidebar('sidebar-shop');

}
add_action ('widgets_init', 'scandium_remove_widget_areas');
*/

function register_header_menu() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_header_menu' );



function my_theme_enqueue_styles() {

    $parent_style = 'inspiro-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    //wp_enqueue_style( 'bootstrap_css', get_stylesheet_directory_uri() . '/css/bootstrap.css' );
    wp_enqueue_style( 'bootstrap-grid_css', get_stylesheet_directory_uri() . '/css/bootstrap-grid.css' );
    //wp_enqueue_style( 'bootstrap-reboot_css', get_stylesheet_directory_uri() . '/css/bootstrap-reboot.css' );
    wp_enqueue_style( 'scandium-inspiro-child',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );

    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/css/slick.css' );
    wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/css/slick-theme.css' );


}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );



//agrego
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Estudio1',
    'before_widget' => '<div class = "widgetizedAreaStudio1">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Estudio2',
    'before_widget' => '<div class = "widgetizedAreaStudio2">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);

if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Estudio3',
    'before_widget' => '<div class = "widgetizedAreaStudio3">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);


if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Carrousel_clientes_1',
    'before_widget' => '<div class = "widgetizedAreaClientes">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Carrousel_clientes_2',
    'before_widget' => '<div class = "widgetizedAreaClientes">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Carrousel_clientes_3',
    'before_widget' => '<div class = "widgetizedAreaClientes">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Carrousel_clientes_4',
    'before_widget' => '<div class = "widgetizedAreaClientes">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )

);




function theme_js() {

    //global $wp_scripts;

    wp_enqueue_script( 'bootstrap_js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js' );
    //wp_enqueue_script( 'my_custom_js', get_template_directory_uri() . '/js/scripts.js');

}

add_action( 'wp_enqueue_scripts', 'theme_js');




//// Register and load the widget
//Queremos hacer las categorías con foto!
function wpb_load_widget() {
    register_widget( 'wpb_widget' );
    register_widget( 'wpb_widget2' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
 
// Creating the widget 
class wpb_widget extends WP_Widget {
 
function __construct() {
    parent::__construct(
     
    // Base ID of your widget
    'wpb_widget', 
     
    // Widget name will appear in UI
    __('Category_img', 'wpb_widget_domain'), 
     
    // Widget description
    array( 'description' => __( 'Imágenes destacadas para las categorías de proyectos', 'wpb_widget_domain' ), ) 
    );
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
     
    // before and after widget arguments are defined by themes
    echo $args['before_widget'];
    if ( ! empty( $title ) )
    echo $args['before_title'] . $title . $args['after_title'];
     
    // This is where you run the code and display the output
    //echo __( 'Hello, World!', 'wpb_widget_domain' );
    ?>


    <div class="row categories-wedget">        
        <!--li class="cat-item cat-item-all current-cat">
            <a href="<?php //echo get_page_link( option::get( 'portfolio_url' ) ); ?>">
                <?php //_e( 'All', 'wpzoom' ); ?>
            </a>
        </li-->

        <?php 
            $categ = get_categories( array( 'title_li' => '', 
                                         'hierarchical' => true,  
                                         'taxonomy' => 'portfolio', 
                                         'depth' => 1 ) ); 
              
            foreach( $categ as $category ) {
            ?>
                <a class="col-12 col-md-3 cat-img-fi_a" href="<?php echo esc_url(get_category_link( $category->term_id ) ); ?>">
                    <div class="cat-img-fi"
                         style="
                                background-image: url('<?php echo get_field('image_portfolio', $category); ?>');">
                        <p>
                        <?php
                            echo strtoupper(esc_html( $category->name ));
                        ?>
                        </p>
                    </div>
                </a>
            <?php    
            } 
            ?>            
    </div>
    <?php
    echo $args['after_widget'];
}
         
// Widget Backend 
public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) ) {
        $title = $instance[ 'title' ];
    }
    else {
        $title = __( 'Categorías', 'wpb_widget_domain' );
    }
    // Widget admin form
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
<?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    return $instance;
    }
} // Class wpb_widget ends here





add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-post-ancestor', $classes) || in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes) ){
        $classes[] = 'active-menu ';
    }
    return $classes;
}


function my_theme_scripts() {
    wp_enqueue_script( 'my-script', get_stylesheet_directory_uri().'/js/my-script.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'slick', get_stylesheet_directory_uri().'/js/slick.min.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'my_theme_scripts' );




















add_action( 'widgets_init', 'wpb_load_widget' );
 
// Creating the widget 
class wpb_widget2 extends WP_Widget {
 
    function __construct() {
        parent::__construct(
         
        // Base ID of your widget
        'wpb_widget2', 
         
        // Widget name will appear in UI
        __('Carrousel_exp', 'wpb_widget2_domain'), 
         
        // Widget description
        array( 'description' => __( 'Client experience, with photo', 'wpb_widget2_domain' ), ) 
        );
    }
     
    // Creating widget front-end
     
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
         
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
         
        
        $related = new WP_Query(
                            array(
                                //'category__in'   => wp_get_post_categories( $post->ID ),
                                'posts_per_page' => 5,
                                //'terms' => get_the_terms($post->ID, 'portfolio')['0']->term_id,
                                //'post__not_in'   => array( $post->ID )
                                'post_type' => 'Testimonials',
                                //'paged'=> $paged,
                                
                            )
                        );

        //echo '<pre>'; print_r($related); echo '</pre>';
        while ( $related->have_posts() )  {
            echo $related->the_post(); 
            //echo "asd".the_post().print_r(the_post())."asd";
            $testimonial = get_post( get_the_ID());
            echo "asd>".get_the_ID()."<-asd";

            $testimonial_data = get_post_meta(get_the_ID(), '_testimonial', true);
            //echo '<pre>'; print_r($testimonio_meta); echo '</pre>';

            //echo '<pre>'; print_r($testimonial_data); echo '</pre>';

            //$testimonio_ck = get_post_custom_keys(get_the_ID());
            //echo '<pre>'; print_r($testimonio_ck); echo '</pre>';


            $client_name = ( empty( $testimonial_data['client_name'] ) ) ? '' : $testimonial_data['client_name'];
            $source = ( empty( $testimonial_data['source'] ) ) ? '' : $testimonial_data['source'];
            //$link = ( empty( $testimonial_data['link'] ) ) ? '' : $testimonial_data['link'];
            //$cite = ( $link ) ? '<a href="' . esc_url( $link ) . '" target="_blank">' . $client_name . $source . '</a>' : $client_name . $source;
            ?>                

        <?php 
        }
        ?>


        <div class= "div_clients-exp">
            <div class="container">
                <div class="row">
                        
                    <div class= "col-12 col-md-8 offset-md-2">
                        <div class= "row">
                            <div class= "col-4">
                                <div class="client-pic"
                                    style="background-image: url('http://localhost/wp-content/uploads/2018/06/Screenshot-from-2018-06-13-15-13-27.png')"
                                >
                                </div>
                            </div>
                            <div class= "col-6">
                                <article id="testimonial-<?php the_ID(); ?>" >
                                    <div class="client-name">
                                        <h3>
                                            <?php echo $client_name; ?>
                                        </h3>
                                        <?php echo $source; ?>
                                    </div>
                                    <div class="client-text">
                                        <p>
                                            <?php echo get_the_content(); ?>
                                        </p>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php

    echo $args['after_widget'];
    }
             
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Clientes con foto', 'wpb_widget2_domain' );
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
    <?php 
    }
         
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class wpb_widget2 ends here


















// *** PEGO DESDE INTERNET **  ///

add_action( 'init', 'testimonials_post_type' );
function testimonials_post_type() {
    $labels = array(
        'name' => 'Testimonials',
        'singular_name' => 'Testimonial',
        'add_new' => 'Ingresar nuevo',
        'add_new_item' => 'Agregar nuevo Testimonial',
        'edit_item' => 'Editar Testimonial',
        'new_item' => 'Nuevo Testimonial',
        'view_item' => 'Ver Testimonial',
        'search_items' => 'Buscar Testimonials',
        'not_found' =>  'No hay Testimonials',
        'not_found_in_trash' => 'No hay Testimonials en la papelera',
        'parent_item_colon' => '',
    );
 
    register_post_type( 'testimonials', array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 10,
        'supports' => array( 'editor' ),
        'register_meta_box_cb' => 'testimonials_meta_boxes', // Callback function for custom metaboxes
    ) );
}



function testimonials_meta_boxes() {
    add_meta_box( 'testimonials_form', 'Testimonial Details', 'testimonials_form', 'testimonials', 'normal', 'high' );
}
 
function testimonials_form() {
    $post_id = get_the_ID();
    $testimonial_data = get_post_meta( $post_id, '_testimonial', true );
    $client_name = ( empty( $testimonial_data['client_name'] ) ) ? '' : $testimonial_data['client_name'];
    $source = ( empty( $testimonial_data['source'] ) ) ? '' : $testimonial_data['source'];
    $link = ( empty( $testimonial_data['link'] ) ) ? '' : $testimonial_data['link'];
 
    wp_nonce_field( 'testimonials', 'testimonials' );
    ?>
    <p>
        <label>Nombre del Cliente (optional)</label><br />
        <input type="text" value="<?php echo $client_name; ?>" name="testimonial[client_name]" size="40" />
    </p>
    <p>
        <label>Emrpesa / Cargo (optional)</label><br />
        <input type="text" value="<?php echo $source; ?>" name="testimonial[source]" size="40" />
    </p>
    <!--p>
        <label>Link (optional)</label><br />
        <input type="text" value="<?php echo $link; ?>" name="testimonial[link]" size="40" />
    </p-->
    <?php
}


add_action( 'save_post', 'testimonials_save_post' );
function testimonials_save_post( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
 
    if ( ! empty( $_POST['testimonials'] ) && ! wp_verify_nonce( $_POST['testimonials'], 'testimonials' ) )
        return;
 
    if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return;
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) )
            return;
    }
 
    if ( ! wp_is_post_revision( $post_id ) && 'testimonials' == get_post_type( $post_id ) ) {
        remove_action( 'save_post', 'testimonials_save_post' );
 
        wp_update_post( array(
            'ID' => $post_id,
            'post_title' => 'Testimonial - ' . $post_id
        ) );
 
        add_action( 'save_post', 'testimonials_save_post' );
    }
 
    if ( ! empty( $_POST['testimonial'] ) ) {
        $testimonial_data['client_name'] = ( empty( $_POST['testimonial']['client_name'] ) ) ? '' : sanitize_text_field( $_POST['testimonial']['client_name'] );
        $testimonial_data['source'] = ( empty( $_POST['testimonial']['source'] ) ) ? '' : sanitize_text_field( $_POST['testimonial']['source'] );
        $testimonial_data['link'] = ( empty( $_POST['testimonial']['link'] ) ) ? '' : esc_url( $_POST['testimonial']['link'] );
 
        update_post_meta( $post_id, '_testimonial', $testimonial_data );
    } else {
        delete_post_meta( $post_id, '_testimonial' );
    }
}


add_filter( 'manage_edit-testimonials_columns', 'testimonials_edit_columns' );
function testimonials_edit_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'testimonial' => 'Testimonial',
        'testimonial-client-name' => 'Client\'s Name',
        'testimonial-source' => 'Business/Site',
        'testimonial-link' => 'Link',
        'author' => 'Posted by',
        'date' => 'Date'
    );
 
    return $columns;
}
 
add_action( 'manage_posts_custom_column', 'testimonials_columns', 10, 2 );
function testimonials_columns( $column, $post_id ) {
    $testimonial_data = get_post_meta( $post_id, '_testimonial', true );
    switch ( $column ) {
        case 'testimonial':
            the_excerpt();
            break;
        case 'testimonial-client-name':
            if ( ! empty( $testimonial_data['client_name'] ) )
                echo $testimonial_data['client_name'];
            break;
        case 'testimonial-source':
            if ( ! empty( $testimonial_data['source'] ) )
                echo $testimonial_data['source'];
            break;
        case 'testimonial-link':
            if ( ! empty( $testimonial_data['link'] ) )
                echo $testimonial_data['link'];
            break;
    }
}




/**
 * Display a testimonial
 *
 * @param  int $post_per_page  The number of testimonials you want to display
 * @param  string $orderby  The order by setting  https://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
 * @param  array $testimonial_id  The ID or IDs of the testimonial(s), comma separated
 *
 * @return  string  Formatted HTML
 */
function get_testimonial( $posts_per_page = 1, $orderby = 'none', $testimonial_id = null ) {
    $args = array(
        'posts_per_page' => (int) $posts_per_page,
        'post_type' => 'testimonials',
        'orderby' => $orderby,
        'no_found_rows' => true,
    );
    if ( $testimonial_id )
        $args['post__in'] = array( $testimonial_id );
 
    $query = new WP_Query( $args  );
 
    $testimonials = '';
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) : $query->the_post();
            $post_id = get_the_ID();
            $testimonial_data = get_post_meta( $post_id, '_testimonial', true );
            $client_name = ( empty( $testimonial_data['client_name'] ) ) ? '' : $testimonial_data['client_name'];
            $source = ( empty( $testimonial_data['source'] ) ) ? '' : ' - ' . $testimonial_data['source'];
            $link = ( empty( $testimonial_data['link'] ) ) ? '' : $testimonial_data['link'];
            $cite = ( $link ) ? '<a href="' . esc_url( $link ) . '" target="_blank">' . $client_name . $source . '</a>' : $client_name . $source;
 
            $testimonials .= '<aside class="testimonial">';
            $testimonials .= '<span class="quote">&ldquo;</span>';
            $testimonials .= '<div class="entry-content">';
            $testimonials .= '<p class="testimonial-text">' . get_the_content() . '<span></span></p>';
            $testimonials .= '<p class="testimonial-client-name"><cite>' . $cite . '</cite>';
            $testimonials .= '</div>';
            $testimonials .= '</aside>';
 
        endwhile;
        wp_reset_postdata();
    }
 
    return $testimonials;
}


add_shortcode( 'testimonial', 'testimonial_shortcode' );
/**
 * Shortcode to display testimonials
 *
 * [testimonial posts_per_page="1" orderby="none" testimonial_id=""]
 */
function testimonial_shortcode( $atts ) {
    extract( shortcode_atts( array(
        'posts_per_page' => '1',
        'orderby' => 'none',
        'testimonial_id' => '',
    ), $atts ) );
 
    return get_testimonial( $posts_per_page, $orderby, $testimonial_id );
}



/**
 * Testimonials Widget
 */
class Testimonial_Widget extends WP_Widget {
    public function __construct() {
        $widget_ops = array( 'classname' => 'testimonial_widget', 'description' => 'Display testimonial post type' );
        parent::__construct( 'testimonial_widget', 'Testimonials', $widget_ops );
    }
 
    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $posts_per_page = (int) $instance['posts_per_page'];
        $orderby = strip_tags( $instance['orderby'] );
        $testimonial_id = ( null == $instance['testimonial_id'] ) ? '' : strip_tags( $instance['testimonial_id'] );
 
        echo $before_widget;
 
        if ( ! empty( $title ) )
            echo $before_title . $title . $after_title;
 
        echo get_testimonial( $posts_per_page, $orderby, $testimonial_id );
 
        echo $after_widget;
    }
 
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['posts_per_page'] = (int) $new_instance['posts_per_page'];
        $instance['orderby'] = strip_tags( $new_instance['orderby'] );
        $instance['testimonial_id'] = ( null == $new_instance['testimonial_id'] ) ? '' : strip_tags( $new_instance['testimonial_id'] );
 
        return $instance;
    }
 
    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'posts_per_page' => '1', 'orderby' => 'none', 'testimonial_id' => null ) );
        $title = strip_tags( $instance['title'] );
        $posts_per_page = (int) $instance['posts_per_page'];
        $orderby = strip_tags( $instance['orderby'] );
        $testimonial_id = ( null == $instance['testimonial_id'] ) ? '' : strip_tags( $instance['testimonial_id'] );
        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
 
        <p><label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">Number of Testimonials: </label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" type="text" value="<?php echo esc_attr( $posts_per_page ); ?>" />
        </p>
 
        <p><label for="<?php echo $this->get_field_id( 'orderby' ); ?>">Order By</label>
        <select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
            <option value="none" <?php selected( $orderby, 'none' ); ?>>None</option>
            <option value="ID" <?php selected( $orderby, 'ID' ); ?>>ID</option>
            <option value="date" <?php selected( $orderby, 'date' ); ?>>Date</option>
            <option value="modified" <?php selected( $orderby, 'modified' ); ?>>Modified</option>
            <option value="rand" <?php selected( $orderby, 'rand' ); ?>>Random</option>
        </select></p>
 
        <p><label for="<?php echo $this->get_field_id( 'testimonial_id' ); ?>">Testimonial ID</label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'testimonial_id' ); ?>" name="<?php echo $this->get_field_name( 'testimonial_id' ); ?>" type="text" value="<?php echo $testimonial_id; ?>" /></p>
        <?php
    }
}
 
add_action( 'widgets_init', 'register_testimonials_widget' );
/**
 * Register widget
 *
 * This functions is attached to the 'widgets_init' action hook.
 */
function register_testimonials_widget() {
    register_widget( 'Testimonial_Widget' );
}

?>