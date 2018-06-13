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
 
// This is where you run the code and display the output


?>

    <div class= "row div_clients-exp">
        <div class= "col-0 col-md-3">
        
        </div>
        <div class= "col-12 col-md-6">
            <div class= "row">
                <div class= "col-4">
                    <div class="client-pic"
                        style="background-image: url('http://localhost/wp-content/uploads/2018/06/Screenshot-from-2018-06-13-15-13-27.png')"
                    >
                    </div>
                </div>
                <div class= "col-6">
                    <div class="client-name">
                        <h3>
                            Nombre Apellido
                        </h3>
                    </div>
                    <div class="client-text">
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis
                        </p>
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



?>