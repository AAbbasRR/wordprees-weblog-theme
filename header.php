<!DOCTYPE html>
<html style="overflow-x:hidden;" <?php language_attributes(); ?>" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php bloginfo('name'); ?></title>

    <?php wp_head(); ?>
</head>

<body style="overflow-x:hidden; position:relative;" <?php body_class(); ?>>
    <?php
    wp_body_open();
    ?>
    <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark mb-4" id="navbar">
        <div class="container-fluid container-lg navbar-parent">
            <?php
            $logo = ot_get_option('logoheader', false);
            if ($logo !== false) {
            ?>
                <a href="<?php echo get_home_url(); ?>"><img class="header-logo" src="<?php echo $logo; ?>" alt="Logo" /></a>
            <?php
            }
            ?>
            <div class="row header-navigation">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                wp_nav_menu([
                    'menu'            => 'primary',
                    'theme_location'  => 'header-menu',
                    'container'       => 'div',
                    'container_id'    => 'navbarCollapse',
                    'container_class' => 'collapse navbar-collapse',
                    'menu_id'         => false,
                    'menu_class'      => 'navbar-nav mr-auto',
                    'depth'           => 0,
                    'fallback_cb'     => 'bs4navwalker::fallback',
                ]);
                ?>
            </div>
            <?php
            $search = ot_get_option('search_in_header', false);
            if ($search == "on") {
            ?>
                <div class="align-self-start" style="margin: 1%;">
                    <form class="d-flex bg-dark">
                        <i class="fas fa-search fa-lg" style="color: #8b8b8b;"></i>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>
    </nav>