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

if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Clientes-page',
    'before_widget' => '<div class = "widgetizedClients">',
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
    register_widget( 'ClientesDesc' );
    register_widget( 'ClientesDescMin' );

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


















// ESTE ES EL WIDGET DE LOS TESTIMONIOS
 
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

?>
            <div class= "div_clients-exp">
                <div class="container">
                    <div class="row">
                            
                        <div id="div_slick_testimonial" class= "col-12 col-md-8 offset-md-2">
                            

            <?php
        //echo '<pre>'; print_r($related); echo '</pre>';
        while ( $related->have_posts() )  {
            echo $related->the_post(); 
            //echo "asd".the_post().print_r(the_post())."asd";
            $testimonial = get_post( get_the_ID());
            //echo "asd>".get_the_ID()."<-asd";

            $testimonial_data = get_post_meta(get_the_ID(), '_testimonial', true);
            //echo '<pre>1'; print_r($testimonial); echo '</pre>';
            //echo '<pre>2'; print_r($testimonial_data); echo '</pre>';



       /* $fields = get_field_objects();
        if( $fields ): ?>
            <ul>
                <?php foreach( $fields as $name => $value ): ?>
                    
                    <li>
                        <b><?php echo $name; ?></b>
                        <?php print_r($value); ?>
                    </li>
                <?php endforeach; ?>
            </ul> ?>
        <?php endif; */


            //echo '<pre>'; print_r($testimonial_data); echo '</pre>';

            //$testimonio_ck = get_post_custom_keys(get_the_ID());
            //echo '<pre>'; print_r($testimonio_ck); echo '</pre>';


            $client_name = ( empty( $testimonial_data['client_name'] ) ) ? '' : $testimonial_data['client_name'];
            $source = ( empty( $testimonial_data['source'] ) ) ? '' : $testimonial_data['source'];
            //$link = ( empty( $testimonial_data['link'] ) ) ? '' : $testimonial_data['link'];
            //$cite = ( $link ) ? '<a href="' . esc_url( $link ) . '" target="_blank">' . $client_name . $source . '</a>' : $client_name . $source;
            ?>                



                            <div class= "row" style="display:flex;">
                                <div class= "col-4">
                                    <div class="client-pic"
                                        style="background-image: url('<?php  echo get_field('profile-image')['url']; ?>')"
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
            <?php 
            }
            ?>                       
                                
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
        <!--p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p-->
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









//PIRE MIO
/*** PEGO DESDE INTERNET **///

add_action( 'init', 'logoClientes_post_type' );
function logoClientes_post_type() {
    $labels = array(
        'name' => 'logoClientes',
        'singular_name' => 'logoCliente',
        'add_new' => 'Ingresar nuevo',
        'add_new_item' => 'Agregar nuevo logoCliente',
        'edit_item' => 'Editar logoCliente',
        'new_item' => 'Nuevo logoCliente',
        'view_item' => 'Ver logoCliente',
        'search_items' => 'Buscar logoClientes',
        'not_found' =>  'No hay logoClientes',
        'not_found_in_trash' => 'No hay logoClientes en la papelera',
        'parent_item_colon' => '',
    );
 
    register_post_type( 'logoClientes', array(
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
        'register_meta_box_cb' => 'logoClientes_meta_boxes', // Callback function for custom metaboxes
    ) );
}



function logoClientes_meta_boxes() {
    add_meta_box( 'logoClientes_form', 'logoCliente Details', 'logoClientes_form', 'logoClientes', 'normal', 'high' );
}
 
function logoClientes_form() {
    $post_id = get_the_ID();
    $logoCliente_data = get_post_meta( $post_id, '_logoCliente', true );
    $client_name = ( empty( $logoCliente_data['client_name'] ) ) ? '' : $logoCliente_data['client_name'];
    $source = ( empty( $logoCliente_data['source'] ) ) ? '' : $logoCliente_data['source'];
    $link = ( empty( $logoCliente_data['link'] ) ) ? '' : $logoCliente_data['link'];
 
    wp_nonce_field( 'logoClientes', 'logoClientes' );
    ?>
    <p>
        <label>Nombre del Cliente (OBLIGATORIO)</label><br />
        <input type="text" value="<?php echo $client_name; ?>" name="logoCliente[client_name]" size="40" />
    </p>
    <!--p>
        <label>Emrpesa / Cargo (optional)</label><br />
        <input type="text" value="<?php echo $source; ?>" name="logoCliente[source]" size="40" />
    </p>
    <p>
        <label>Link (optional)</label><br />
        <input type="text" value="<?php echo $link; ?>" name="logoCliente[link]" size="40" />
    </p-->
    <?php
}


add_action( 'save_post', 'logoClientes_save_post' );
function logoClientes_save_post( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
 
    if ( ! empty( $_POST['logoClientes'] ) && ! wp_verify_nonce( $_POST['logoClientes'], 'logoClientes' ) )
        return;
 
    if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return;
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) )
            return;
    }
 
    if ( ! wp_is_post_revision( $post_id ) && 'logoClientes' == get_post_type( $post_id ) ) {
        remove_action( 'save_post', 'logoClientes_save_post' );
 
        wp_update_post( array(
            'ID' => $post_id,
            'post_title' => 'logoCliente 33 - ' . $post_id
        ) );
 
        add_action( 'save_post', 'logoClientes_save_post' );
    }
 
    if ( ! empty( $_POST['logoCliente'] ) ) {
        $logoCliente_data['client_name'] = ( empty( $_POST['logoCliente']['client_name'] ) ) ? '' : sanitize_text_field( $_POST['logoCliente']['client_name'] );
        $logoCliente_data['source'] = ( empty( $_POST['logoCliente']['source'] ) ) ? '' : sanitize_text_field( $_POST['logoCliente']['source'] );
        $logoCliente_data['link'] = ( empty( $_POST['logoCliente']['link'] ) ) ? '' : esc_url( $_POST['logoCliente']['link'] );
 
        update_post_meta( $post_id, '_logoCliente', $logoCliente_data );
    } else {
        delete_post_meta( $post_id, '_logoCliente' );
    }
}


add_filter( 'manage_edit-logoClientes_columns', 'logoClientes_edit_columns' );
function logoClientes_edit_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'logoCliente' => 'logoCliente',
        'logoCliente-client-name' => 'Client\'s Name',
        'logoCliente-source' => 'Business/Site',
        'logoCliente-link' => 'Link',
        'author' => 'Posted by',
        'date' => 'Date'
    );
 
    return $columns;
}
 
add_action( 'manage_posts_custom_column', 'logoClientes_columns', 10, 2 );
function logoClientes_columns( $column, $post_id ) {
    $logoCliente_data = get_post_meta( $post_id, '_logoCliente', true );
    //print_r($logoCliente_data);
    switch ( $column ) {
        case 'logoCliente':
            the_excerpt();
            break;
        case 'logoCliente-client-name':
            if ( ! empty( $logoCliente_data['client_name'] ) )
                echo $logoCliente_data['client_name'];
            break;
        case 'logoCliente-source':
            if ( ! empty( $logoCliente_data['source'] ) )
                echo $logoCliente_data['source'];
            break;
        case 'logoCliente-link':
            if ( ! empty( $logoCliente_data['link'] ) )
                echo $logoCliente_data['link'];
            break;
    }
}




/**
 * Display a logoCliente
 *
 * @param  int $post_per_page  The number of logoClientes you want to display
 * @param  string $orderby  The order by setting  https://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
 * @param  array $logoCliente_id  The ID or IDs of the logoCliente(s), comma separated
 *
 * @return  string  Formatted HTML
 */
function get_logoCliente( $posts_per_page = 1, $orderby = 'none', $logoCliente_id = null ) {
    $args = array(
        'posts_per_page' => (int) $posts_per_page,
        'post_type' => 'logoClientes',
        'orderby' => $orderby,
        'no_found_rows' => true,
    );
    if ( $logoCliente_id )
        $args['post__in'] = array( $logoCliente_id );
 
    $query = new WP_Query( $args  );
 
    $logoClientes = '';
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) : $query->the_post();
            $post_id = get_the_ID();
            $logoCliente_data = get_post_meta( $post_id, '_logoCliente', true );
            $client_name = ( empty( $logoCliente_data['client_name'] ) ) ? '' : $logoCliente_data['client_name'];
            $source = ( empty( $logoCliente_data['source'] ) ) ? '' : ' - ' . $logoCliente_data['source'];
            $link = ( empty( $logoCliente_data['link'] ) ) ? '' : $logoCliente_data['link'];
            $cite = ( $link ) ? '<a href="' . esc_url( $link ) . '" target="_blank">' . $client_name . $source . '</a>' : $client_name . $source;
 
            $logoClientes .= '<aside class="logoCliente">';
            $logoClientes .= '<span class="quote">&ldquo;</span>';
            $logoClientes .= '<div class="entry-content">';
            $logoClientes .= '<p class="logoCliente-text">' . get_the_content() . '<span></span></p>';
            $logoClientes .= '<p class="logoCliente-client-name"><cite>' . $cite . '</cite>';
            $logoClientes .= '</div>';
            $logoClientes .= '</aside>';
 
        endwhile;
        wp_reset_postdata();
    }
 
    return $logoClientes;
}


add_shortcode( 'logoCliente', 'logoCliente_shortcode' );
/**
 * Shortcode to display logoClientes
 *
 * [logoCliente posts_per_page="1" orderby="none" logoCliente_id=""]
 */
function logoCliente_shortcode( $atts ) {
    extract( shortcode_atts( array(
        'posts_per_page' => '1',
        'orderby' => 'none',
        'logoCliente_id' => '',
    ), $atts ) );
 
    return get_logoCliente( $posts_per_page, $orderby, $logoCliente_id );
}






//WIDGET SOLAMENTE PARA MOSTRAR LOS LOGOS
// ESTE ES EL WIDGET DE LOS ClientesDescMin
 

// Creating the widget 
class ClientesDescMin extends WP_Widget {
 
    function __construct() {
        parent::__construct(
         
        // Base ID of your widget
        'ClientesDescMin', 
         
        // Widget name will appear in UI
        __('ClientesDescMin', 'ClientesDescMin_domain'), 
         
        // Widget description
        array( 'description' => __( 'Client logos with description', 'ClientesDescMin_domain' ), ) 
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
                                'post_type' => 'logos',
                                //'paged'=> $paged,
                                
                            )
                        );


        //echo '<pre>'; print_r($related); echo '</pre>';

        $arr_categ = array( );
        
        while ( $related->have_posts() )  {
            echo $related->the_post(); 
            //echo "asd".the_post().print_r(the_post())."asd";
            $testimonial = get_post( get_the_ID());
            //echo "asd>".get_the_ID()."<-asd";

            $testimonial_data = get_post_meta(get_the_ID(), '_logo', true);
            //echo '<pre>1'; print_r($testimonial); echo '</pre>';
            //echo '<pre>2'; print_r($testimonial_data); echo '</pre>';



       /* $fields = get_field_objects();
        if( $fields ): ?>
            <ul>
                <?php foreach( $fields as $name => $value ): ?>
                    
                    <li>
                        <b><?php echo $name; ?></b>
                        <?php print_r($value); ?>
                    </li>
                <?php endforeach; ?>
            </ul> ?>
        <?php endif; */


            //echo '<pre>'; print_r($testimonial_data); echo '</pre>';

            //$testimonio_ck = get_post_custom_keys(get_the_ID());
            //echo '<pre>'; print_r($testimonio_ck); echo '</pre>';


            $client_name = ( empty( $testimonial_data['client_name'] ) ) ? '' : $testimonial_data['client_name'];
            $source = ( empty( $testimonial_data['source'] ) ) ? '' : $testimonial_data['source'];
            //$link = ( empty( $testimonial_data['link'] ) ) ? '' : $testimonial_data['link'];
            //$cite = ( $link ) ? '<a href="' . esc_url( $link ) . '" target="_blank">' . $client_name . $source . '</a>' : $client_name . $source;

            $arr_cli = array('lc_logo'=> get_field('lc_logo')['url'],
                            'lc_name'=> get_field('lc_name'),
                            'lc_type'=> get_field('lc_type'),
                            'lc_url'=> get_field('lc_url'),
                            'lc_location'=> get_field('lc_location') );

            $arr_categ[get_field('lc_type')][get_field('lc_name')] = $arr_cli;


        }

        //echo '<pre>'; print_r($arr_categ); echo '</pre>';

        ?>                

            <div id="div_clients-logos_min">
                <div class="container">
                    <div id="div_slick_logos_min">


                        <?php
                        foreach ($arr_categ as $nomCateg => $categ) {
                        ?>
                            <div class="row clientes_banner" id="">
                              <div class= "col-12">
                                <h3>
                                    <?php
                                        echo $nomCateg;
                                    ?>
                                </h3>
                              </div>  
                            <?php
    //                           echo "<h3>".$nomCateg."</h3>";
                            foreach ($categ as $clieNom => $clien) {
                            ?>
                                <div class= "col-12 col-sm-4 col-md-3">
                                    <div class="client-logo"
                                        style="background-image: url('<?php  echo $clien['lc_logo']; ?>')"
                                    >
                                    </div>
                                    
                                </div> 
                            <?php
                            }
                            echo "</div>";
                        }
                        ?>
                         
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
            $title = __( 'Clientes con foto', 'ClientesDescMin_domain' );
        }
        // Widget admin form
        ?>
        <!--p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p-->
    <?php 
    }
         
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class ClientesDescMin ends here











// ESTE ES EL WIDGET DE LOS ClientesDesc

 

// Creating the widget 
class ClientesDesc extends WP_Widget {
 
    function __construct() {
        parent::__construct(
         
        // Base ID of your widget
        'ClientesDesc', 
         
        // Widget name will appear in UI
        __('ClientesDesc', 'ClientesDesc_domain'), 
         
        // Widget description
        array( 'description' => __( 'Client logos with description', 'ClientesDesc_domain' ), ) 
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
                                'post_type' => 'logos',
                                //'paged'=> $paged,
                                
                            )
                        );


        //echo '<pre>'; print_r($related); echo '</pre>';

        $arr_categ = array( );
        
        while ( $related->have_posts() )  {
            echo $related->the_post(); 
            //echo "asd".the_post().print_r(the_post())."asd";
            $testimonial = get_post( get_the_ID());
            //echo "asd>".get_the_ID()."<-asd";

            $testimonial_data = get_post_meta(get_the_ID(), '_logo', true);
            //echo '<pre>1'; print_r($testimonial); echo '</pre>';
            //echo '<pre>2'; print_r($testimonial_data); echo '</pre>';



       /* $fields = get_field_objects();
        if( $fields ): ?>
            <ul>
                <?php foreach( $fields as $name => $value ): ?>
                    
                    <li>
                        <b><?php echo $name; ?></b>
                        <?php print_r($value); ?>
                    </li>
                <?php endforeach; ?>
            </ul> ?>
        <?php endif; */


            //echo '<pre>'; print_r($testimonial_data); echo '</pre>';

            //$testimonio_ck = get_post_custom_keys(get_the_ID());
            //echo '<pre>'; print_r($testimonio_ck); echo '</pre>';


            $client_name = ( empty( $testimonial_data['client_name'] ) ) ? '' : $testimonial_data['client_name'];
            $source = ( empty( $testimonial_data['source'] ) ) ? '' : $testimonial_data['source'];
            //$link = ( empty( $testimonial_data['link'] ) ) ? '' : $testimonial_data['link'];
            //$cite = ( $link ) ? '<a href="' . esc_url( $link ) . '" target="_blank">' . $client_name . $source . '</a>' : $client_name . $source;

            $arr_cli = array('lc_logo'=> get_field('lc_logo')['url'],
                            'lc_name'=> get_field('lc_name'),
                            'lc_type'=> get_field('lc_type'),
                            'lc_url'=> get_field('lc_url'),
                            'lc_location'=> get_field('lc_location') );

            $arr_categ[get_field('lc_type')][get_field('lc_name')] = $arr_cli;


        }

        //echo '<pre>'; print_r($arr_categ); echo '</pre>';

        ?>                

            <div id="div_clients-logos">
                <div class="container">
                    <div id="div_slick_logos">


                        <?php
                        foreach ($arr_categ as $nomCateg => $categ) {
                        ?>
                            <div class="row clientes_banner" id="">
                              <div class= "col-12">
                                <h3>
                                    <?php
                                        echo $nomCateg;
                                    ?>
                                </h3>
                              </div>  
                            <?php
    //                           echo "<h3>".$nomCateg."</h3>";
                            foreach ($categ as $clieNom => $clien) {
                            ?>
                                <div class= "col-12 col-sm-6 col-md-4">
                                    <div class="client-logo"
                                        style="background-image: url('<?php  echo $clien['lc_logo']; ?>')"
                                    >
                                    </div>
                                    <hr>
                                    <div class="client-logo-text">
                                        <p>
                                            <span class="client-logo-name">
                                                <?php echo $clien['lc_name']; ?>
                                                <?php echo $clien['lc_type']; ?>
                                            </span> <br>
                                            <?php echo $clien['lc_url']; ?>   <br>
                                            <?php echo $clien['lc_location']; ?>
                                        </p>
                                    </div>
                                </div> 
                            <?php
                            }
                            echo "</div>";
                        }
                        ?>
                         
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
            $title = __( 'Clientes con foto', 'ClientesDesc_domain' );
        }
        // Widget admin form
        ?>
        <!--p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p-->
    <?php 
    }
         
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class ClientesDesc ends here










// *** PEGO DESDE INTERNET **  ///

add_action( 'init', 'logos_post_type' );
function logos_post_type() {
    $labels = array(
        'name' => 'logos',
        'singular_name' => 'logo',
        'add_new' => 'Ingresar nuevo',
        'add_new_item' => 'Agregar nuevo logo',
        'edit_item' => 'Editar logo',
        'new_item' => 'Nuevo logo',
        'view_item' => 'Ver logo',
        'search_items' => 'Buscar logos',
        'not_found' =>  'No hay logos',
        'not_found_in_trash' => 'No hay logos en la papelera',
        'parent_item_colon' => '',
    );
 
    register_post_type( 'logos', array(
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
        'register_meta_box_cb' => 'logos_meta_boxes', // Callback function for custom metaboxes
    ) );
}



function logos_meta_boxes() {
    add_meta_box( 'logos_form', 'logo Details', 'logos_form', 'logos', 'normal', 'high' );
}
 
function logos_form() {
    $post_id = get_the_ID();
    $logo_data = get_post_meta( $post_id, '_logo', true );
    $client_name = ( empty( $logo_data['client_name'] ) ) ? '' : $logo_data['client_name'];
    $source = ( empty( $logo_data['source'] ) ) ? '' : $logo_data['source'];
    $link = ( empty( $logo_data['link'] ) ) ? '' : $logo_data['link'];
 
    wp_nonce_field( 'logos', 'logos' );
    ?>
    <p>
        <label>Nombre del Cliente (OBLIGATORIO)</label><br />
        <input type="text" value="<?php echo $client_name; ?>" name="logo[client_name]" size="40" />
    </p>
    <p>
        <label>Emrpesa / Cargo (optional)</label><br />
        <input type="text" value="<?php echo $source; ?>" name="logo[source]" size="40" />
    </p>
    <!--p>
        <label>Link (optional)</label><br />
        <input type="text" value="<?php echo $link; ?>" name="logo[link]" size="40" />
    </p-->
    <?php
}


add_action( 'save_post', 'logos_save_post' );
function logos_save_post( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
 
    if ( ! empty( $_POST['logos'] ) && ! wp_verify_nonce( $_POST['logos'], 'logos' ) )
        return;
 
    if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return;
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) )
            return;
    }
 
    if ( ! wp_is_post_revision( $post_id ) && 'logos' == get_post_type( $post_id ) ) {
        remove_action( 'save_post', 'logos_save_post' );
 
        wp_update_post( array(
            'ID' => $post_id,
            'post_title' => 'logo - ' . $post_id
        ) );
 
        add_action( 'save_post', 'logos_save_post' );
    }
 
    if ( ! empty( $_POST['logo'] ) ) {
        $logo_data['client_name'] = ( empty( $_POST['logo']['client_name'] ) ) ? 'SIN INGRESAR' : sanitize_text_field( $_POST['logo']['client_name'] );
        $logo_data['source'] = ( empty( $_POST['logo']['source'] ) ) ? '' : sanitize_text_field( $_POST['logo']['source'] );
        $logo_data['link'] = ( empty( $_POST['logo']['link'] ) ) ? '' : esc_url( $_POST['logo']['link'] );
 
        update_post_meta( $post_id, '_logo', $logo_data );
    } else {
        delete_post_meta( $post_id, '_logo' );
    }
}


add_filter( 'manage_edit-logos_columns', 'logos_edit_columns' );
function logos_edit_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'logo' => '',
        'logo-client-name' => 'Nombre',
        /*'lc_type' => 'Tipo',*/
        'logo-source' => '',
        'logo-link' => '',
        'author' => 'Posted by',
        'date' => 'Date'
    );
 
    return $columns;
}
 
add_action( 'manage_posts_custom_column', 'logos_columns', 10, 2 );
function logos_columns( $column, $post_id ) {
    $logo_data = get_post_meta( $post_id, '_logo', true );
    switch ( $column ) {
        case 'logo':
            the_excerpt();
            break;
        case 'logo-client-name':
            if ( ! empty( $logo_data['client_name'] ) )
                echo $logo_data['client_name'];
            break;
        case 'lc_type':
            if ( ! empty( $logo_data['lc_type'] ) )
                echo get_field($post_id, 'lc_type');
            break;
        case 'logo-source':
            if ( ! empty( $logo_data['source'] ) )
                echo $logo_data['source'];
            break;
        case 'logo-link':
            if ( ! empty( $logo_data['link'] ) )
                echo $logo_data['link'];
            break;
    }
}




/**
 * Display a logo
 *
 * @param  int $post_per_page  The number of logos you want to display
 * @param  string $orderby  The order by setting  https://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
 * @param  array $logo_id  The ID or IDs of the logo(s), comma separated
 *
 * @return  string  Formatted HTML
 */
function get_logo( $posts_per_page = 1, $orderby = 'none', $logo_id = null ) {
    $args = array(
        'posts_per_page' => (int) $posts_per_page,
        'post_type' => 'logos',
        'orderby' => $orderby,
        'no_found_rows' => true,
    );
    if ( $logo_id )
        $args['post__in'] = array( $logo_id );
 
    $query = new WP_Query( $args  );
 
    $logos = '';
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) : $query->the_post();
            $post_id = get_the_ID();
            $logo_data = get_post_meta( $post_id, '_logo', true );
            $client_name = ( empty( $logo_data['client_name'] ) ) ? '' : $logo_data['client_name'];
            $source = ( empty( $logo_data['source'] ) ) ? '' : ' - ' . $logo_data['source'];
            $link = ( empty( $logo_data['link'] ) ) ? '' : $logo_data['link'];
            $cite = ( $link ) ? '<a href="' . esc_url( $link ) . '" target="_blank">' . $client_name . $source . '</a>' : $client_name . $source;
 
            $logos .= '<aside class="logo">';
            $logos .= '<span class="quote">&ldquo;</span>';
            $logos .= '<div class="entry-content">';
            $logos .= '<p class="logo-text">' . get_the_content() . '<span></span></p>';
            $logos .= '<p class="logo-client-name"><cite>' . $cite . '</cite>';
            $logos .= '</div>';
            $logos .= '</aside>';
 
        endwhile;
        wp_reset_postdata();
    }
 
    return $logos;
}


add_shortcode( 'logo', 'logo_shortcode' );
/**
 * Shortcode to display logos
 *
 * [logo posts_per_page="1" orderby="none" logo_id=""]
 */
function logo_shortcode( $atts ) {
    extract( shortcode_atts( array(
        'posts_per_page' => '1',
        'orderby' => 'none',
        'logo_id' => '',
    ), $atts ) );
 
    return get_logo( $posts_per_page, $orderby, $logo_id );
}





?>