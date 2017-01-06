<!doctype html>
<html class="no-js full_content" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Teddy SITBON - Portfolio <?php wp_title(''); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="assets/img/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/normalize.css">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/main.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,300italic,400italic,600italic,700,700italic' rel='stylesheet' type='text/css'>
        <script src="<?php bloginfo('template_url'); ?>/assets/js/vendor/modernizr-2.8.3.min.js"></script>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class("full_content"); ?>  >
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!--
        <a href="#nav" class="nav_trigger" id="menu_logo">
            Menu
            <span class="top"></span>
            <span class="middle"></span>
            <span class="bottom"></span>
        </a>
        -->



        <div id="menu_icon" class="menu_icon nav_visible" style="visibility: hidden">
            <svg width="1000px" height="1000px">
                <path id="pathA" d="M 300 400 L 700 400 C 900 400 900 750 600 850 A 400 400 0 0 1 200 200 L 800 800"></path>
                <path id="pathB" d="M 300 500 L 700 500"></path>
                <path id="pathC" d="M 700 600 L 300 600 C 100 600 100 200 400 150 A 400 380 0 1 1 200 800 L 800 200"></path>
            </svg>
            <button id="button_icon" class="button_icon"></button>
        </div><!-- menu-icon-wrapper -->


        <nav class="nav_container" id="nav">       
            <ul class="nav">
                    <?php
                    $defaults = array(
                        'theme_location'  => 'primary-menu',
                        'menu'            => 'menu_header',
                        'container'       => '',
                        'container_class' => 'menu_items',
                        'container_id'    => '',
                        'menu_class'      => 'menu',
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
                        'items_wrap'      => '%3$s',
                        'depth'           => 0
                    );
                    wp_nav_menu( $defaults );
                    ?>
                </ul>
        </nav>