<!DOCTYPE HTML>
<html dir="ltr" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php bloginfo('name'); ?></title>
<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/images/touch-icon.png" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<!--[if lt IE 9]>
  <meta http-equiv="Imagetoolbar" content="no" />
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrap">
  <section id="description">
    <h1><?php bloginfo('description') ?></h1>
  </section><!-- #description end -->
  <div id="container">
    <header id="header">
      <h1 id="site-id">
        <a href="<?php echo home_url('/'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/header/site_id.png" alt="<?php bloginfo('name'); ?>" /></a>
      </h1><!-- #site-id end -->
      <div id="utility-group">
        <?php
          wp_nav_menu(array(
            'container' => 'nav',
            'container_id' => 'utility-nav',
            'theme_location' => 'place_utility',
          ));
         ?>
        <div id="header-widget-area">
          <aside class="widget_search">
            <form role="search" id="searchform">
              <div>
                <input type="text" id="s" />
                <input type="submit" id="searchsubmit"/>
              </div>
            </form><!-- #searchform end -->
          </aside><!-- .widget_search end -->
        </div><!-- #header-widget-area end -->
      </div><!-- #utility-group end -->
    </header><!-- #header end -->
    <?php
      wp_nav_menu(array(
        'container' => 'nav',
        'container_id' => 'global-nav',
        'theme_location' => 'place_global',
      ));
     ?>
    <?php
      if(is_front_page()) :
     ?>
    <section id="branding">
      <img src="<?php header_image(); ?>"
       width="<?php echo get_custom_header()->width; ?>"
       height="<?php echo get_custom_header()->height; ?>" alt="" />
    </section><!-- #branding end -->
    <?php
      endif;
    ?>
    <section id="contents-body">
