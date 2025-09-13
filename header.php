<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="logo">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="Campus Cœur de Bourgogne">
    </div>
    <nav class="main-nav">
        <?php
            wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'container' => false,
                'menu_class' => 'menu',
            ));
        ?>
    </nav>
</header>
