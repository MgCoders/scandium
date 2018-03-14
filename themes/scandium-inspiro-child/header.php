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


    <div class="container">
    <div class="row">
        <div class="col-md-4">.col-md-4</div>
        <div class="col-md-4">.col-md-4</div>
        <div class="col-md-4">.col-md-4</div>
    </div>
    </div>

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
                    <div>
                        <ul id="lang-icons">
                            <li>
                                <a href="#" data-text="es">es</a>
                            </li>
                            <li>
                                <a href="#" data-text="en">en</a>
                            </li>
                        </ul>
                    </div>

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
</header><!-- .site-header -->

    <div class="container-fluid really-full-width">
        <div class="row">
            <div class="col-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="http://localhost/wp-content/uploads/2018/03/01.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="http://localhost/wp-content/uploads/2018/03/02.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="http://localhost/wp-content/uploads/2018/03/03.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            </div>
        </div>
    </div>
