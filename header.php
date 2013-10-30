<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  <?php if (get_theme_mod('webfont_embed_code')): ?>
    <?php echo get_theme_mod('webfont_embed_code'); ?>
  <?php else: ?>
    <?php $style = deference_get_style(); ?>
    <?php if ($style->google_fonts): ?>
      <link href="http://fonts.googleapis.com/css?family=<?php echo urlencode($style['body']); ?>:<?php echo $style['body_variations']; ?>" rel="stylesheet" type="text/css">
      <link href="http://fonts.googleapis.com/css?family=<?php echo urlencode($style['title']); ?>:<?php echo $style['title_variations']; ?>" rel="stylesheet" type="text/css">
    <?php endif; ?>
  <?php endif; ?>

  <!--[if lt IE 9]>
  <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
  <![endif]-->

  <link rel="shortcut icon" href="<?php echo get_theme_mod('favicon', get_stylesheet_directory_uri().'/favicon.ico'); ?>" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div id="site-wrapper"<?php echo deference_theme_mod_data_attr('layout_width'); ?>>
    <header id="site-header">
      <h1 id="site-title">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <?php if (get_theme_mod('site_logo')): ?>
            <img id="site-logo" src="<?php echo get_theme_mod('site_logo'); ?>" alt=""<?php echo deference_theme_mod_data_attr('site_logo'); ?>>
          <?php else: ?>
            <strong id="site-name"><?php bloginfo('name'); ?></strong>
          <?php endif; ?>
        </a>
      </h1>

      <div id="site-search"<?php echo deference_theme_mod_data_attr('hide_search_field'); ?><?php if (get_theme_mod('hide_search_field')): ?> style="display:none"<?php endif; ?>>
        <?php get_search_form(); ?>
      </div>

      <?php echo deference_get_theme_mod('site_header_html'); ?>
    </header>

    <nav id="site-nav" class="alt-font"<?php echo deference_theme_mod_data_attr('nav_font_size'); ?>>
      <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'site-header-nav', 'container' => false)); ?>
    </nav>

    <div id="site-main">
