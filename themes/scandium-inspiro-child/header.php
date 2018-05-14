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


    <div class="container-fluid text-center">

        <div class="row align-items-center">
            <div class="col">
                <?php if ( ! option::get( 'misc_logo_path' ) ) echo '<h1>'; ?>

                <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'description' ); ?>">
                    <?php if ( ! option::get( 'misc_logo_path' ) ) { bloginfo( 'name' ); } else { ?>
                        <img src="<?php echo ui::logo(); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                    <?php } ?>
                </a>
                <!--div>
                    <ul id="lang-icons">
                        <li>
                            <a href="#" data-text="es">es</a>
                        </li>
                        <li>
                            <a href="#" data-text="en">en</a>
                        </li>
                    </ul>
                </div-->

                <?php if ( ! option::get( 'misc_logo_path' ) ) echo '</h1>'; ?>
            </div>
            <div class="col">
                One of three columns
            </div>
            <div class="col">
                <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'nav navbar-nav' ) ); ?>

            </div>
        </div>

    </div>

</header><!-- .site-header -->
