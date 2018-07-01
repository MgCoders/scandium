<?php get_header(); ?>

<?php
$slides = get_post_meta( get_the_ID(), 'wpzoom_slider', true );
$hasSlider = is_array( $slides ) && count( $slides ) > 0;
$slide_counter = 0;
?>

<main id="main" class="site-main" role="main">

<?php // outputs a list of languages names ?>
    <?php 
      /*
        pll_the_languages(array('show_flags'=>1,'show_names'=>0));
        print_r(pll_the_languages(array('raw'=>1))); 

        $locale_str = get_bloginfo("language");
        echo ">";
        print_r($locale_str);
        echo "<".$locale_str;
        $value = get_field( 'cf_fp_sow_es');
        echo "<br><br>!!>";
        echo $value;
        print_r($value);
        echo "<!!".$locale_str;


?>
    <h3>La posta</h3>
    <p>
    <?php 
        $fields = get_field_objects();
        if( $fields ): ?>
            <ul>
                <?php foreach( $fields as $name => $value ): ?>
                    <li>
                        <b><?php echo $name; ?></b>
                        <?php print_r($value); ?>
                    </li>
                <?php endforeach; ?>
            </ul> ?>
        <?php endif; ?>
    </p>



    <h3>Alcance de trabajo</h3>
    <p>
        <?php the_field('cf_fp_sow_es'); ?>
        <?php the_field('cf_fp_sow_en'); ?>        
    </p>

 */ 
     ?>

    <?php while ( have_posts() ) : the_post();

            $locale_str = get_bloginfo("language");
            $current_lang = substr($locale_str, 0, 2);
            $ext = "";

            if($current_lang != 'es'){
                $ext = "_".$current_lang;
            }

     ?>






<?php 
//Pongo la barra arriba!
?>




            






<?php
//Termino con la barra de arriba
?>






        <article id="post-<?php the_ID(); ?>" <?php post_class( ( has_post_thumbnail() || $hasSlider ) ? ' has-post-cover' : '' ); ?>>
            <div class="container-fluid no-padding max-size-screen">
                <div class="row no-gutters">
                    <div class="col-12 col-md-4 info-panel order-2 order-md-1">


                        <div class="container">
                            <div class="row slider-portfolio slider-sup">
                                <div class="col-1 ar-left">
                                    

                                    <?php
                                    //La url se setea con Js, y el procedimeinto está en el footer
                                    ?>
                                    <a id="arrow_sup_left" href="">
                                        <i class="arrow left">
                                            
                                        </i>
                                    </a>
                                    
                                </div>
                                
                                <div class="col-1 ar-right">
                                    
                                    <a id="arrow_sup_right" href="">
                                        <i class="arrow right">
                                            
                                        </i>
                                    </a>
                                    
                                </div>
                            </div>
                        </div> 

                        <div class="card-info">
                            <div class="card-title">
                                <span class="proyect-title hyphenate">
                                    <?php 
                                        $titleOfPost = get_the_title();
                                        $idOfPost = $post->ID;
                                        echo strtoupper($titleOfPost); 
                                    ?>
                                </span>
                            </div>


                            <div class="card-table">



                                <?php /*$table = get_field( 'cf_fp_summary' );

                                    if ( $table ) {
                                        echo '<table class="summary-table">';
                                            if ( $table['header'] ) {
                                                echo '<thead>';
                                                    echo '<tr>';
                                                        foreach ( $table['header'] as $th ) {
                                                            echo '<th>';
                                                                echo $th['c'];
                                                            echo '</th>';
                                                        }
                                                    echo '</tr>';
                                                echo '</thead>';
                                            }

                                            echo '<tbody>';
                                                foreach ( $table['body'] as $tr ) {
                                                    echo '<tr>';
                                                        foreach ( $tr as $td ) {
                                                            echo '<td>';
                                                                echo $td['c'];
                                                            echo '</td>';
                                                        }
                                                    echo '</tr>';
                                                }
                                            echo '</tbody>';
                                        echo '</table>';
                                    }*/
                                ?>

                                <?php 

                                $objects_to_show = array(
                                                    'cf_fp_project', 'cf_fp_work', 'cf_fp_area'
                                                    );
                                $objects_to_show_en = array(
                                                             'cf_fp_location'
                                                            );
                                    
                                        
                                ?>
                                <table class="summary-table">
                                    <thead>
                                        <tr>
                                            <?php 
                                            foreach ($objects_to_show as $key => $param) {
                                                $sw = get_field_object( $param );
                                                if ( $sw ) {
                                                    $content = get_field($param);
                                                    if ( $content ) {
                                                        echo "<th>".$sw['label']."</th>";
                                                    }
                                                }
                                            }
                                            foreach ($objects_to_show_en as $key => $param) {
                                                $sw = get_field_object( $param.$ext );
                                                if ( $sw ) {
                                                    $content = get_field($param.$ext );
                                                    if ( $content ) {
                                                        echo "<th>".$sw['label']."</th>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php 
                                            foreach ($objects_to_show as $key => $param) {
                                                $sw = get_field_object( $param );
                                                if ( $sw ) {
                                                    $content = get_field($param);
                                                    if ( $content ) {
                                                        echo "<td>";
                                                        echo $content;
                                                        echo "</td>";
                                                    }
                                                }
                                            }
                                            foreach ($objects_to_show_en as $key => $param) {
                                                $sw = get_field_object( $param.$ext );
                                                if ( $sw ) {
                                                    $content = get_field($param.$ext);
                                                    if ( $content ) {
                                                        echo "<td>";
                                                        echo $content;
                                                        echo "</td>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-main-content">
                                <?php
                                    //Contenido principal 
                                    the_content(); 
                                ?>
                            </div>
                            <div class="card-content">
                                <span class="card">

                                
                                    <?php


                                        //El scope of work es distinto dependiendo del lenguaje
                                        $cats = get_field('cf_fp_sow'.$ext);
                                        $choi = get_field_object('cf_fp_sow'.$ext)['choices'];
                                        //echo 'cf_fp_sow'.$ext;
                                        //echo '<pre>'.print_r($cats).'</pre>';

                                        $sow = "";

                                        if ($cats) {                                        
                                            foreach ($cats as $key => $val){
                                                //echo "key: ".$key.", val:".$val;
                                                $sow .= $choi[$val].'<br>';
                                            }

                                            if ($sow) {
                                                $sw = get_field_object( 'cf_fp_sow'.$ext );
                                                echo "<b>".$sw['label']."</b> <br>";
                                                echo $sow."<br>";
                                            }
                                        }
                                          
                                    ?>





                                    <?php 

                                        //

                                        /*$objects_to_show = array(
                                                            
                                                            );


                                        foreach ($objects_to_show as $key => $param) {
                                            //echo $param.$ext;
                                            $sw = get_field_object( $param );
                                            if ( $sw ) {
                                                $content = get_field($param);
                                                if ( $content ) {
                                                    echo "<b>".$sw['label']."</b> <br>";
                                                    echo $content;
                                                    echo "<br> <br>";
                                                }
                                            }
                                        }*/

                                        //

                                        $objects_to_show = array(
                                                            'cf_fp_da', 'cf_fp_cli', 'cf_fp_ow','cf_fp_com'
                                                            );


                                        foreach ($objects_to_show as $key => $param) {
                                            //echo $param.$ext;
                                            $sw = get_field_object( $param.$ext );
                                            if ( $sw ) {
                                                $content = get_field($param.$ext);
                                                if ( $content ) {
                                                    echo "<b>".$sw['label']."</b> <br>";
                                                    echo $content;
                                                    echo "<br> <br>";
                                                }
                                            }
                                        }
                                    ?>
                                    
                                </span>
                            </div>  
                        </div>    
                    </div>

                    <div class="col-12 col-md-8 order-1 order-md-2">
                        <div class="entry-cover">
                            <?php //$entryCoverBackground = get_the_image( array( 'size' => 'entry-cover', 'format' => 'array' ) ); 
                                $entryCoverBackground = get_field('cf_fp_main_img');
                                //echo "as: ".print_r(get_field('cf_fp_main_img'))." :asd";
                            ?>

                            <?php 

                            //desactivo el slider
                            /*
                            if ( $hasSlider ) :  ?>

                                <div id="slider">
                                    <ul class="slides">

                                        <?php foreach ( $slides as $slide ) : ?>

                                            <?php if ( $slide['slideType'] == 'image' ) :
                                                $slide_counter++;
                                                $img = inspiro_get_slide_image( $slide );
                                                $style = ' data-smallimg="' . $img['small_image_url'] . '" data-bigimg="' . $img['large_image_url'] . '"';

                                                if ($slide_counter === 1) {
                                                    $style .= ' style="background-image:url(\'' . $img['large_image_url'] . '\')"';
                                                }
                                                ?>

                                                <li<?php echo $style; ?>>
                                                    <div class="slide-background-overlay"></div>
                                                    <div class="li-wrap">

                                                        <?php if (! empty( $img['caption'] ) ) { ?>
                                                            <h3><?php echo esc_html( $img['caption'] ); ?></h3>
                                                        <?php } ?>

                                                        <?php if (! empty( $img['description'] )) { ?>
                                                            <div class="excerpt"><?php echo esc_html( $img['description'] ); ?></div>
                                                        <?php } ?>

                                                    </div>
                                                </li>

                                            <?php endif; ?>

                                        <?php endforeach; ?>

                                    </ul>

                                    <div id="scroll-to-content" title="<?php esc_attr_e( 'Scroll to Content', 'wpzoom' ); ?>">
                                        <?php _e( 'Scroll to Content', 'wpzoom' ); ?>
                                    </div>

                                </div>

                            <?php */ 
                                if( isset( $entryCoverBackground['url']  ) ) :  //para la featured Img era SRC ?>

                                <div class="entry-cover-image" style="
                                        background-image: url('<?php echo $entryCoverBackground['url'] ?>');">
                                        
                                </div>

                            <?php else: ?>
                                <div class="entry-cover-image" style="
                                                                    /*height: 600px;
                                                                    background-color: #aaa;
                                                                    font-weight: 900;*/
                                                                ">
                                    Este proyecto no tiene imagen destacada
                                </div>
                            <?php endif; ?>

                            <?php /*
                            <header class="entry-header">
                                <div class="entry-info">

                                    <div class="entry-meta">

                                        <?php if ( option::is_on( 'portfolio_category' ) ) : ?>

                                            <?php if ( is_array( $tax_menu_items = get_the_terms( get_the_ID(), 'portfolio' ) ) ) : ?>
                                                <?php foreach ( $tax_menu_items as $tax_menu_item ) : ?>
                                                    <a href="<?php echo get_term_link( $tax_menu_item, $tax_menu_item->taxonomy ); ?>"><?php echo $tax_menu_item->name; ?></a>
                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                        <?php endif; ?>

                                    </div>


                                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                                    <div class="entry-meta">
                                        <?php if ( option::is_on( 'portfolio_date' ) ) printf( '<p class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></p>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?>
                                    </div>
                                </div>
                            </header><!-- .entry-header -->
                            */
                            ?>
                        </div><!-- .entry-cover -->
                    </div>
                </div>
            </div>
            <div class="entry-content">
                

                <?php

                

                    $sli = get_field( 'cf_fp_sli'.$ext ); 
                    $ili = get_field( 'cf_fp_ili'.$ext ); 
                    $ri = get_field( 'cf_fp_ri'.$ext ); 

/*
                    $size = 'full';

                    print_r(get_field_object( 'cf_fp_sli' ));
*/
                    $NOIMAGE = "http://localhost/wp-content/uploads/2018/05/noFoto.png";

                    if ( !$sli ) {
                        $sli = $NOIMAGE;
                    }

                    if ( !$ili ) {
                        $ili = $NOIMAGE;
                    }


                    if ( !$ri ) {
                        $ri = $NOIMAGE;
                    } 

                ?>


                <!--div class="row">
                    <div class="col-12 col-md-4 separation">
                        <div class="col-12 cover_fp_ii_div separation">
                            <div class="cover_fp_ii" style="background-image: url('<?php //echo $sli; ?>');"></div>
                        </div>
                        <div class="col-12 cover_fp_ii_div">
                            <div class="cover_fp_ii" style="background-image: url('<?php //echo $ili; ?>');"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="col-12 cover_fp_id_div">
                            <div class="cover_fp_id" style="background-image: url('<?php //echo $ri; ?>');"></div>
                        </div>
                    </div>
                </div-->         

                <div class="row tiles-photo-details">
                    <div class="col-12">
                        <?php


                            //ponerlo en wl wp.config!!
                            ini_set('display_errors','Off');
                            ini_set('error_reporting', E_ALL );
                            define('WP_DEBUG', false);
                            define('WP_DEBUG_DISPLAY', false);

                            $gallery = get_field( 'cf_fp_gallery'); 
                            if($gallery){
                                echo do_shortcode($gallery, true);
                            } else {
                                echo "No se ha asignado galería de imágenes a este proyecto";
                            }
                        ?>
                    </div>
                </div>     

                <?php

                    //Imprimo los tipos de porfolio
                    //$terms = get_terms( 'portfolio');
                    //print_r($terms);
                    //echo "<br> <br>";

                    //imprimo el porfolo del post actual
                    //print_r(get_the_terms($post->ID, 'portfolio'));
                    $prot_term = get_the_terms($post->ID, 'portfolio');
                    $taxonomy_obj_port = $prot_term['0'];
                    //print_r($taxonomy_obj_port);
                    $order_str = $taxonomy_obj_port->slug;
                    if($taxonomy_obj_port->slug == "residential") {
                        $order_str = "residencial";
                    } else if($taxonomy_obj_port->slug == "offices-and-hotels") {
                        $order_str = "oficinas-y-hoteles";
                    } else if($taxonomy_obj_port->slug == "infrastructure") {
                        $order_str = "infraestructura";
                    } else if($taxonomy_obj_port->slug == "cultural-es" or $taxonomy_obj_port->slug == "cultural-en") {
                        $order_str = "cultural";
                    }

                    
                    $related = new WP_Query(
                                            array(
                                                //'category__in'   => wp_get_post_categories( $post->ID ),
                                                'posts_per_page' => 500,
                                                //'terms' => get_the_terms($post->ID, 'portfolio')['0']->term_id,
                                                //'post__not_in'   => array( $post->ID )
                                                'post_type' => 'portfolio_item',
                                                'meta_key' => 'order_value_num_'.$order_str,
                                                'orderby' => 'meta_value_num',
                                                'order' => 'ASC',
                                                //'paged'=> $paged,
                                                'tax_query' => array(
                                                                    array(
                                                                        'taxonomy' => 'portfolio',
                                                                        'field' => 'term_id',
                                                                        'terms' => get_the_terms($post->ID, 'portfolio')['0']->term_id
                                                                         )
                                                                    )
                                            )
                                        );
                    //wp_get_post_terms( $post->ID, 'my_taxonomy', array("fields" => "all" )
echo "<br> <br>";
//print("<pre>".print_r($related,true)."</pre>");


//echo $related->have_posts();

/*
foreach ($related as $key => $value) {
    # code...
    
    echo $key.": ";
    foreach ($value as $key2 => $value2) {
        # code...
        
        echo ">".$key2.": ";
        print_r($value2);
        echo "<br>";
    }
    echo "<br>";
    echo "<br>";
}*/

if( $related->have_posts() ) { 
    //echo "string";
    $last_url = "";
    $next_url = "";
    $finded = false;
    $cant_posts = 0;
    $categorías_posts = get_terms('portfolio');

    $first="";


    while( $related->have_posts() and $next_url == "") { 
        


        /*echo "last_url: ".$last_url."<br>";
        echo "next_url: ".$next_url."<br>";
        echo "finded: ".$finded."<br>";
        echo "cant_posts: ".$cant_posts."<br>";
        echo "first: ".$first."<br> <br>";
        echo "categorías_posts: ".$categorías_posts."<br> <br>"; */



        //Seteo el post para trabajar con el
        echo $related->the_post(); 

        //Me guardo el primero para la circular
        if($first==""){
            $first= get_permalink();
        }

        //$categorías_posts =

        //print("<pre>".print_r(get_terms('portfolio'),true)."</pre>");
        $cant_posts++;

        //si ya encontré, asigno el que sigue y salgo.
        if ($finded) {
             $next_url = get_permalink();
        }

        //me voy guardando el actual para el siguiente
        if (!$finded && $idOfPost != get_the_ID()) {
            $last_url = get_permalink();
        }

        //cuando me encuentro, preparo para salir
        if (!$finded && $idOfPost == get_the_ID()) {
            $finded = true;
        }

        //the_title();
        /*whatever you want to output*/
        
    }

    if($next_url == ""){
        $next_url = $first;
    }

    if($last_url == ""){
       while( $related->have_posts() ) { 
        
            //Seteo el post para trabajar con el
            echo $related->the_post(); 
            //Recorro hasta el último
            $last_url= get_permalink();
       
        }
    }

    wp_reset_postdata();
}

if ($cant_posts > 1){

   ?> 

    <div class="row slider-portfolio">
        <div class="col-1">
            <?php
            if ($last_url != ""){
            ?>
            <a id="arrow_inf_left" href="<?php
                        echo "".$last_url;
                    ?>">
                <i class="arrow left">
                    
                </i>
            </a>
            <?php
            }   
            ?>
        </div>
        <div class="col-10">
            <span class="portfolio-term">

                <nav class="portfolio-archive-taxonomies">
                    <ul class="portfolio-taxonomies">
                        <?php

                        $idioma = "";

                        if ($ext == "_en") {
                            $idioma = "/en";
                        }


                        foreach ($categorías_posts as $key => $categ) {
                            //print("<pre>".print_r($categ,true)."</pre>");
                            if ($categ->term_id == get_the_terms($post->ID, 'portfolio')['0']->term_id ) { 
                            ?>
                            <li class="cat-item current-cat">
                                <a href="<?php echo $idioma ; ?>/portfolio/<?php echo $categ->slug ; ?>/">
                                    <?php echo $categ->name ; ?>                                        
                                </a>
                            </li>
                            <?php
                            } else {
                            ?>
                            <li class="cat-item">
                                <a href="<?php echo $idioma ; ?>/portfolio/<?php echo $categ->slug ; ?>/">
                                    <?php echo $categ->name ; ?>                                        
                                </a>
                            </li>
                            <?php
                            }
                        }
                        ?>
                        
                    </ul>
                </nav>

                <?php
                //print("<pre>".print_r($categorías_posts,true)."</pre>");

                

                //echo strtoupper(get_the_terms($post->ID, 'portfolio')['0']->name);
                ?>
            </span>
        </div>
        <div class="col-1">
            <?php
            if ($next_url != ""){
            ?>
            <a id="arrow_inf_right" href="<?php
                        echo "".$next_url;
                    ?>">
                <i class="arrow right">
                    
                </i>
            </a>
            <?php
            }   
            ?>
        </div>
        <?php
}
?>

       

<?php
    $select_category_arr = array();



    $taxonomy = 'cultural-es'; // Go to WPadmin -> Portfolio categories. Check url for correct taxonomy name.
    $terms = get_terms($taxonomy); // Get all terms of a taxonomy
    if ( $terms && !is_wp_error( $terms ) ) {
        foreach( $terms as $term ) {
            $select_category_arr[$term->slug] = $term->name;    
        }
    }
 ?>
            </div><!-- .entry-content -->








            <footer class="entry-footer">

                <?php if ( option::is_on( 'portfolio_share' ) ) : ?>

                    <div class="share">

                        <h4 class="section-title"><?php _e( 'Share', 'wpzoom' ); ?></h4>

                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo urlencode( get_the_title() ); ?>" target="_blank" title="<?php esc_attr_e( 'Tweet this on Twitter', 'wpzoom' ); ?>" class="twitter"><?php echo esc_html( option::get( 'portfolio_share_label_twitter' ) ); ?></a>

                        <a href="https://facebook.com/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>&t=<?php echo urlencode( get_the_title() ); ?>" target="_blank" title="<?php esc_attr_e( 'Share this on Facebook', 'wpzoom' ); ?>" class="facebook"><?php echo esc_html( option::get( 'portfolio_share_label_facebook' ) ); ?></a>

                        <a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink() ); ?>" target="_blank" title="<?php esc_attr_e( 'Post this to Google+', 'wpzoom' ); ?>" class="gplus"><?php echo esc_html( option::get( 'portfolio_share_label_gplus' ) ); ?></a>

                    </div>

                <?php endif; ?>

                <?php if ( option::is_on( 'portfolio_author' ) ) : ?>

                    <div class="post_author">

                        <?php echo get_avatar( get_the_author_meta( 'ID' ) , 65 ); ?>

                        <span><?php _e( 'Written by', 'wpzoom' ); ?></span>

                        <?php the_author_posts_link(); ?>

                    </div>

                <?php endif; ?>


                <?php edit_post_link( __( 'Edit', 'wpzoom' ), '<span class="edit-link">', '</span>' ); ?>
            </footer><!-- .entry-footer -->
        </article><!-- #post-## -->

        <?php if ( option::is_on( 'portfolio_comments' ) ) : ?>

            <?php comments_template(); ?>

        <?php endif; ?>

    <?php endwhile; // end of the loop. ?>

</main><!-- #main -->

<?php get_footer(); ?>

<script type="text/javascript">
    
    var asl = document.getElementById('arrow_sup_left');
    var asr = document.getElementById('arrow_sup_right');
    var ail = document.getElementById('arrow_inf_left');
    var air = document.getElementById('arrow_inf_right');

    asl.href = ail.getAttribute("href");
    asr.href = air.getAttribute("href");
</script>