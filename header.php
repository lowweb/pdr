<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fstore
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="yandex-verification" content="dd64ac7cfe41d973" />
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>

    <script type='text/javascript'>
      /* <![CDATA[ */
        var tRoot = "\/wp-content\/themes\/fstore";
      /* ]]> */
    </script>

    <!-- Google Tag Manager disable for mobile version-->
	  
	  <?php if(wp_is_mobile()==false) { ?>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PC87KFH');</script>
	  <?php } ?>
    <!-- End Google Tag Manager -->



  </head>

<body <?php body_class(['preloading']); ?>>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PC87KFH"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <img src="<?php echo FROOT ?>/img/sprites.svg" class="svg" id="sprites"/>

  <!-- modals and fades -->
    <div id="preloader"></div>
  <!-- modals end -->

  <div id="mobile-menu">
    <div id="mobile-menu-heading">
      <?php the_custom_logo(); ?>
      <button type="button" id="mobile-close" class="toggle-menu">&times;</button>
    </div>
    <div id="mobile-menu-body">
      <?php dynamic_sidebar('mobile-area'); ?>
    </div>
  </div>

  <header id="header">
      <div id="header-container">
          <?php the_custom_logo(); ?>
          <a href='tel:+7 (423) 2 499 520' id='mobile-phone'>+7 (423) 2 499 520</a>
          <div id="header-main">
            <?php wp_nav_menu([
              'menu_id'      => 'menu-primary',
              'container_id' => 'menu-primary-container'
            ]); ?>
            <button class="hamburger toggle-menu" id="hamburger" type="button"></button>
            <div id="header-right">
              <?php if ( !function_exists('header-right') || !dynamic_sidebar("header-right") ) : dynamic_sidebar( 'header-right' ) ?>
              <?php endif;?>
            </div>
          </div> <!-- header-main end -->
      </div>
  </header>
