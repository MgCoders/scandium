<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php get_sidebar(); ?>

<div class="site">

<header class="site-header">
    <div class="container-fluid">
        <div class="row row-language ">
            
            <div class="col-12">
                <?php
                    //pll_the_languages(array('show_flags'=>1,'show_names'=>0));
                    //print_r(pll_the_languages(array('raw'=>1))); 

                    $arr_lenguajes = pll_the_languages(array('raw'=>1));
                    foreach( $arr_lenguajes as $id_leng => $leng ): ?>
                        <div style="float: right;" class="idioma <?php echo ($leng['current_lang']) ? 'selected': ''; ?> ">
                            <a href="<?php echo $leng['url']; ?>">
                                <?php echo $leng['slug']; ?>
                            </a>
                        </div>
                    <?php endforeach;


                /*
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
                        </ul>
                    <?php endif; ?>
                </p>*/
                ?>
            </div>
        </div>
        <div class="row">
            <nav class="navbar <?php if (inspiro_maybeWithCover()) echo 'page-with-cover'; ?> " role="navigation">
                <div class="wrap">
                     <div class="navbar-header">

                        <div class="navbar-brand">
                            <?php if ( ! option::get( 'misc_logo_path' ) ) echo '<h1>'; ?>

                            <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'description' ); ?>">
                                <?php if ( ! option::get( 'misc_logo_path' ) ) { bloginfo( 'name' ); } else { ?>
                                    <img src="<?php echo ui::logo(); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                                <?php } ?>
                            </a>

                            <?php if ( ! option::get( 'misc_logo_path' ) ) echo '</h1>'; ?>
                        </div><!-- .navbar-brand -->
                    </div>

                    <?php if ( has_nav_menu( 'primary' ) || is_active_sidebar( 'sidebar' ) ) : ?>

                        <button type="button" class="navbar-toggle">
                            <span class="sr-only"><?php _e( 'Toggle sidebar &amp; navigation', 'wpzoom' ); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <div class="navbar-collapse collapse">

                            <?php
                            wp_nav_menu( array(
                                'menu_class'     => 'nav navbar-nav dropdown sf-menu',
                                'theme_location' => 'primary',
                                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s' . diamond_wc_menu_cartitem() . '</ul>',
                                'container'      => false
                            ) );
                            ?>


                        </div><!-- .navbar-collapse -->

                    <?php endif; ?>

                </div>
            </nav><!-- .navbar -->
        </div>
        </div>
    </header><!-- .site-header -->

