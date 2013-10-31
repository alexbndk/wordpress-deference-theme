<?php

// Provide automatic updates
require_once('wp-updates-theme.php');
new WPUpdatesThemeUpdater_454('http://wp-updates.com/api/2/theme', basename(get_template_directory()));

// Set content width based on the theme settings
if (!isset( $content_width))
  $content_width = get_theme_mod('layout_width', '980') - 60;

function deference_setup() {
  /*
   * Makes the theme available for translation.
   */
  load_theme_textdomain('deference', get_template_directory() . '/languages');

  /*
   * This theme styles the visual editor to resemble the theme style,
   * specifically font, colors, icons, and column width.
   */
  add_editor_style( array( 'css/editor.css' ) );

  // Adds RSS feed links to <head> for posts and comments.
  add_theme_support( 'automatic-feed-links' );

  // Post thumbnails are kinda the core of this theme, so let's support 'em.
  add_theme_support( 'post-thumbnails' );

  // Switches default core markup for search form, comment form, and comments
  // to output valid HTML5.
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menu( 'primary', __( 'Main Menu', 'deference' ) );
  register_nav_menu( 'secondary', __( 'Footer Menu', 'deference' ) );
}
add_action( 'after_setup_theme', 'deference_setup' );

/**
 * Enqueues scripts and styles for front end.
 */
function deference_scripts_styles() {
  // Adds JavaScript to pages with the comment form to support sites with
  // threaded comments (when in use).
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );

  wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.js', array( 'jquery' ), '3.0.2', true );
  if (!get_theme_mod('disable_parallax'))
    wp_enqueue_script( 'jquery-parallaxify', get_template_directory_uri() . '/js/jquery.parallaxify.js', array( 'jquery' ), '0.0.2', true );
  wp_enqueue_script( 'jquery-sonar', get_template_directory_uri() . '/js/jquery.sonar.js', array( 'jquery' ), '', true );
  wp_enqueue_script( 'stackblur', get_template_directory_uri() . '/js/stackblur.js', array(), '0.5', true );
  wp_enqueue_script( 'deference-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '1.0', true );

  wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09' );
  wp_enqueue_style( 'deference-style', get_stylesheet_uri());
  wp_add_inline_style('deference-style', deference_custom_styles());
}
add_action('wp_enqueue_scripts', 'deference_scripts_styles');

function deference_custom_styles() {
  $background_color = get_theme_mod('background_color', '#eee');
  $background_color = (strpos($background_color, '#') !== false ? $background_color : "#$background_color");
  $body_fonts = get_theme_mod('body_font_stack', 'Georgia, serif');
  $title_fonts = get_theme_mod('title_font_stack', '"Helvetica Neue", Helvetica, Arial, sans-serif');
  $font_size = get_theme_mod('font_size', '100');
  $nav_text_transform = get_theme_mod('nav_text_transform', 'none');
  $nav_letter_spacing = get_theme_mod('nav_letter_spacing', '0');
  $category_text_transform = get_theme_mod('category_text_transform', 'uppercase');
  $category_letter_spacing = get_theme_mod('category_letter_spacing', '0.1em');
  $accent_color = get_theme_mod('accent_color', '#E44B4B');
  $accent_color = (strpos($accent_color, '#') !== false ? $accent_color : "#$accent_color");
  $layout_width = get_theme_mod('layout_width', '980px');
  $nav_font_size = get_theme_mod('nav_font_size', '24px');
  $post_cover_height = get_theme_mod('post_cover_height', '360px');

  return "
    html {
      font-size: $font_size%;
    }

    body {
      background: $background_color;
    }

    body,
    select, input, textarea {
      font-family: $body_fonts;
    }

    .alt-font,
    h1, h2, h3, h4, h5, h6,
    button,
    input[type=button],
    input[type=reset],
    input[type=submit] {
      font-family: $title_fonts;
    }

    h6 {
      text-transform: $category_text_transform;
      letter-spacing: $category_letter_spacing;
    }

    #site-nav,
    .page-pagination,
    .page-header-index li {
      text-transform: $nav_text_transform;
      letter-spacing: $nav_letter_spacing;
    }

    .sharedaddy .sd-button {
      font-family: $title_fonts !important;
    }

    h6,
    h1 strong, h2 strong, h3 strong, h4 strong, h5 strong,
    h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
    a:hover, a:active,
    .site-header-nav span:hover,
    .site-header-nav li:hover > span,
    .site-header-nav .current-menu-item > a,
    .site-header-nav .current-post-ancestor > a,
    .site-header-nav .current-menu-item > span,
    .page-pagination a,
    .post a,
    .comment .comment-author a:hover,
    .comment-form .required,
    .widget a {
      color: $accent_color;
    }

    a:hover h1, a:hover h2, a:hover h3, a:hover h4, a:hover h5, a:hover h6 {
      color: $accent_color !important;
    }

    #site-wrapper {
      width: $layout_width;
    }

    #site-nav {
      font-size: $nav_font_size;
    }

    .post-cover {
      height: $post_cover_height;
    }
  ";
}

/**
 * Registers two widget areas.
 *
 */
function deference_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Site Footer Widget Area', 'deference' ),
    'id'            => 'sidebar-1',
    'description'   => __( 'Appears in the footer section of the site.', 'deference' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5 class="widget-title">',
    'after_title'   => '</h5>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Page Footer Widget Area', 'deference' ),
    'id'            => 'sidebar-2',
    'description'   => __( 'Appears in between content and comments on posts and pages.', 'deference' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5 class="widget-title">',
    'after_title'   => '</h5>',
  ) );
}
add_action('widgets_init', 'deference_widgets_init');

function deference_modify_query($query) {
  if (is_admin() || !$query->is_main_query()) return;

  if ($query->is_home() && get_theme_mod('featured_category')) {
    $query->set('cat', '-'.get_theme_mod('featured_category'));
  } elseif (($query->is_archive() && !is_author()) || ($query->is_home() && !get_theme_mod('featured_category'))) {
    $query->set('posts_per_page', get_option('posts_per_page') + 1);
  }
}
add_action('pre_get_posts', 'deference_modify_query', 1);

function deference_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() )
    return $title;

  // Add the site name.
  $title .= get_bloginfo('name');

  // Add the site description for the home/front page.
  $site_description = get_bloginfo('description', 'display');
  if ($site_description && (is_home() || is_front_page()))
    $title = "$title $sep $site_description";

  return $title;
}
add_filter( 'wp_title', 'deference_wp_title', 10, 2 );

function deference_body_class( $classes ) {
  if (!is_multi_author())
    $classes[] = 'single-author';

  if (get_theme_mod('disable_parallax'))
    $classes[] = 'disable-parallax';

  if (!get_option( 'show_avatars' ))
    $classes[] = 'no-avatars';

  return $classes;
}
add_filter( 'body_class', 'deference_body_class' );

function deference_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'deference_mime_types');

function deference_excerpt_more($more) {
  return '…';
}
add_filter('excerpt_more', 'deference_excerpt_more');

function deference_excerpt_length($length) {
  return 22;
}
add_filter('excerpt_length', 'deference_excerpt_length', 999);

function deference_get_archives_link($link_html) {
  global $wp;
  static $current_url;
  if (empty( $current_url)) {
    $current_url = add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request));
  }
  if (stristr( $current_url, 'page')!== false) {
    $current_url = substr($current_url, 0, strrpos($current_url, 'page'));
  }
  if (stristr($link_html, $current_url) !== false) {
    $link_html = preg_replace('/(<[^\s>]+)/', '\1 class="current"', $link_html, 1);
  }
  return $link_html;
}
add_filter('get_archives_link', 'deference_get_archives_link');

if (!function_exists('deference_paging_nav')):
function deference_paging_nav() {
  global $wp_query;

  // Don't print empty markup if there's only one page.
  if ($wp_query->max_num_pages < 2)
    return;
  ?>
  <nav class="page-pagination alt-font" role="navigation">
    <?php
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      if ($paged == 1):
        next_posts_link(__('More on the next page &raquo;', 'deference'));
      elseif (get_next_posts_link()):
        previous_posts_link(__('Back', 'deference'));
        echo '<span class="page-pagination-divider">/</span>';
        next_posts_link(__('Next', 'deference'));
      else:
        echo '<a href="'.get_pagenum_link(1).'">'.__("&laquo; Back to beginning", 'deference').'</a>';
      endif;
    ?>
  </nav>
  <?php
}
endif;

if (!function_exists('deference_the_attached_image')):
/**
 * Print the attached image with a link to the next attached image.
 *
 */
function deference_the_attached_image() {
  /**
   * Filter the image attachment size to use.
   *
   */
  $attachment_size     = apply_filters( 'deference_attachment_size', array( 724, 724 ) );
  $next_attachment_url = wp_get_attachment_url();
  $post                = get_post();

  /*
   * Grab the IDs of all the image attachments in a gallery so we can get the URL
   * of the next adjacent image in a gallery, or the first image (if we're
   * looking at the last image in a gallery), or, in a gallery of one, just the
   * link to that image file.
   */
  $attachment_ids = get_posts( array(
    'post_parent'    => $post->post_parent,
    'fields'         => 'ids',
    'numberposts'    => -1,
    'post_status'    => 'inherit',
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'order'          => 'ASC',
    'orderby'        => 'menu_order ID'
  ) );

  // If there is more than 1 attachment in a gallery...
  if ( count( $attachment_ids ) > 1 ) {
    foreach ( $attachment_ids as $attachment_id ) {
      if ( $attachment_id == $post->ID ) {
        $next_id = current( $attachment_ids );
        break;
      }
    }

    // get the URL of the next image attachment...
    if ( $next_id )
      $next_attachment_url = get_attachment_link( $next_id );

    // or get the URL of the first image attachment.
    else
      $next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
  }

  printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
    esc_url( $next_attachment_url ),
    the_title_attribute( array( 'echo' => false ) ),
    wp_get_attachment_image( $post->ID, $attachment_size )
  );
}
endif;

if (!function_exists('deference_get_post_thumbnail_with_fallback')):
function deference_get_post_thumbnail_with_fallback($size = 'large') {
  $image_url = '';
  if (has_post_thumbnail()) {
    $image_id = get_post_thumbnail_id();
  } elseif (is_attachment() && wp_attachment_is_image()) {
    $image_id = get_the_ID();
  } else {
    $args = array(
      'numberposts' => 1,
      'order' => 'ASC',
      'orderby' => 'menu_order ID',
      'post_parent' => get_the_ID(),
      'post_type' => 'attachment',
      'post_mime_type' => 'image',
      'post_status' => null,
    );
    $images = get_children($args);
    if ($images) {
      $image_id = key($images);
    }
  }

  if (!empty($image_id)) {
    $image_url = wp_get_attachment_image_src($image_id, $size);
    $image_url = $image_url[0];
  }

  return $image_url;
}
endif;

if (!function_exists('deference_get_post_thumbnail')):
function deference_get_post_thumbnail() {
  return deference_get_post_thumbnail_with_fallback('thumbnail');
}
endif;

if (!function_exists('deference_get_post_cover')):
function deference_get_post_cover() {
  return deference_get_post_thumbnail_with_fallback('large');
}
endif;

if (!function_exists('deference_get_page_background')):
function deference_get_page_background() {
  global $post_background;
  if (isset($post_background)) {
    $background = $post_background;
  } else {
    rewind_posts(); the_post();
    $background = deference_get_post_thumbnail_with_fallback('large');
  }

  if (empty($background)) {
    $background = get_theme_mod('background_image');
  }

  return $background;
}
endif;

if (!function_exists('deference_set_page_background')):
function deference_set_page_background() {
  global $post_background;
  $post_background = deference_get_post_thumbnail_with_fallback('large');
}
endif;

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 */
function deference_customize_register($wp_customize) {
  class Magazine_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';

    public function render_content() {
      ?>
      <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
      <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
      </label>
      <?php
    }
  }

  class Category_Dropdown_Customize_Control extends WP_Customize_Control {
    public $type = 'category_dropdown';
    public $args = array();

    var $defaults = array();

    public function render_content(){
      add_action('wp_dropdown_cats', array($this, 'wp_dropdown_cats'));

      // Set some defaults for our control
      $this->defaults = array(
        'show_option_none' => __('None', 'deference'),
        'orderby' => 'name',
        'hide_empty' => 0,
        'id' => $this->id,
        'selected' => $this->value(),
      );

      // Parse defaults against what the user submitted
      $r = wp_parse_args($this->args, $this->defaults);

    ?>
    <label><span class="customize-control-title"><?php echo esc_html($this->label); ?></span></label>
    <?php
      // Generate our select box
      wp_dropdown_categories($r);
    }

    function wp_dropdown_cats($output){
      $output = str_replace('<select', '<select ' . $this->get_link(), $output);
      return $output;
    }
  }

  // Sections
  $wp_customize->add_section('deference_home_page', array(
    'title'    => __('Featured Category', 'deference'),
    'priority' => 0,
    'description' => __('Choose what category to feature on the home page. The latest post from the selected category is shown in the featured block and will not appear in the list of posts below it.', 'deference'),
  ));
  $wp_customize->add_section('deference_appearance', array(
    'title'    => __('Appearance', 'deference'),
    'priority' => 1,
    'description' => __('Customize the look and feel.', 'deference'),
  ));
  $wp_customize->add_section('deference_typography', array(
    'title'    => __('Typography', 'deference'),
    'priority' => 2,
    'description' => __('Customize fonts and font sizes.', 'deference'),
  ));
  $wp_customize->add_section('deference_webfonts', array(
    'title'    => __('Webfonts', 'deference'),
    'priority' => 3,
    'description' => __('Optionally add the embed code from your webfont provider, e.g. Google Fonts or Typekit.', 'deference'),
  ));
  $wp_customize->add_section('deference_display_options', array(
    'title'    => __('Display Options', 'deference'),
    'priority' => 4,
  ));
  $wp_customize->add_section('deference_custom_html', array(
    'title'    => __('Insert HTML', 'deference'),
    'priority' => 5,
  ));


  // Appearance Options
  $wp_customize->add_setting('site_logo', array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
  ));
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'site_logo', array(
    'label'    => __('Site Logo', 'deference'),
    'section'  => 'deference_appearance',
    'settings' => 'site_logo',
  )));

  $wp_customize->add_setting('favicon', array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
  ));
  $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'favicon', array(
    'label'    => __('Favicon', 'deference'),
    'section'  => 'deference_appearance',
    'settings' => 'favicon',
  )));

  $wp_customize->add_setting('background_image', array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
  ));
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'background_image', array(
    'label'    => __('Fallback Background Image', 'deference'),
    'section'  => 'deference_appearance',
    'settings' => 'background_image',
  )));

  $wp_customize->add_setting('background_color', array(
    'default'           => '#eeeeee',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color', array(
    'label'    => __('Background Color', 'deference'),
    'section'  => 'deference_appearance',
    'settings' => 'background_color',
  )));

  $wp_customize->add_setting('accent_color', array(
    'default'           => '#E04D53',
    'sanitize_callback' => 'sanitize_hex_color',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
    'label'    => __('Accent Color', 'deference'),
    'section'  => 'deference_appearance',
    'settings' => 'accent_color',
  )));

  // Appearance Options
  $wp_customize->add_setting('layout_width', array(
    'default'        => '980px',
    'capability'     => 'edit_theme_options',
    'transport'      => 'postMessage',
  ));
  $wp_customize->add_control('layout_width', array(
    'label'   => __('Layout Width', 'deference'),
    'section' => 'deference_appearance',
    'type'    => 'text',
  ));

  $wp_customize->add_setting('post_cover_height', array(
    'default'        => '360px',
    'capability'     => 'edit_theme_options',
    'transport'      => 'postMessage',
  ));
  $wp_customize->add_control('post_cover_height', array(
    'label'   => __('Post Cover Image Height', 'deference'),
    'section' => 'deference_appearance',
    'type'    => 'text',
  ));

  // Font size
  $wp_customize->add_setting('font_size', array(
    'default'        => '100',
    'capability'     => 'edit_theme_options',
    'transport'      => 'postMessage',
  ));
  $wp_customize->add_control('font_size', array(
    'label'   => __('Font Size', 'deference'),
    'section' => 'deference_typography',
    'type'    => 'select',
    'choices'    => array(
      '80' => '80%',
      '85' => '85%',
      '90' => '90%',
      '95' => '95%',
      '100' => '100%',
      '105' => '105%',
      '110' => '110%',
      '115' => '115%',
      '120' => '120%',
    ),
  ));

  $wp_customize->add_setting('nav_font_size', array(
    'default'        => '24px',
    'capability'     => 'edit_theme_options',
    'transport'      => 'postMessage',
  ));
  $wp_customize->add_control('nav_font_size', array(
    'label'   => __('Navigation Font Size', 'deference'),
    'section' => 'deference_typography',
    'type'    => 'text',
  ));

  $wp_customize->add_setting('nav_letter_spacing', array(
    'default'        => '0',
    'capability'     => 'edit_theme_options',
    'transport'      => 'postMessage',
  ));
  $wp_customize->add_control('nav_letter_spacing', array(
    'label'   => __('Navigation Letter Spacing', 'deference'),
    'section' => 'deference_typography',
    'type'    => 'text',
  ));

  $wp_customize->add_setting('nav_text_transform', array(
    'default'    => 'none',
    'capability' => 'edit_theme_options',
  ));
  $wp_customize->add_control('nav_text_transform', array(
    'label'   => __('Navigation Text Transform', 'deference'),
    'section' => 'deference_typography',
    'type'    => 'select',
    'choices'    => array(
      'none'    => 'None',
      'uppercase' => 'Uppercase',
      'lowercase' => 'Lowercase',
      'capitalize'=> 'Capitalize',
    ),
  ));

  $wp_customize->add_setting('category_text_transform', array(
    'default'    => 'uppercase',
    'capability' => 'edit_theme_options',
  ));
  $wp_customize->add_control('category_text_transform', array(
    'label'   => __('Category Text Transform', 'deference'),
    'section' => 'deference_typography',
    'type'    => 'select',
    'choices'    => array(
      'none'    => 'None',
      'uppercase' => 'Uppercase',
      'lowercase' => 'Lowercase',
      'capitalize'=> 'Capitalize',
    ),
  ));

  $wp_customize->add_setting('category_letter_spacing', array(
    'default'        => '.1em',
    'capability'     => 'edit_theme_options',
    'transport'      => 'postMessage',
  ));
  $wp_customize->add_control('category_letter_spacing', array(
    'label'   => __('Category Letter Spacing', 'deference'),
    'section' => 'deference_typography',
    'type'    => 'text',
  ));

  $wp_customize->add_setting('webfont_embed_code', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
  ));
  $wp_customize->add_control(new Magazine_Customize_Textarea_Control($wp_customize, 'webfont_embed_code', array(
    'label'   => __('Embed Code', 'deference'),
    'section' => 'deference_webfonts',
    'settings'   => 'webfont_embed_code',
  )));

  $wp_customize->add_setting('title_font_stack', array(
    'default'        => '"Helvetica Neue", Helvetica, Arial, sans-serif',
    'capability'     => 'edit_theme_options',
  ));
  $wp_customize->add_control('title_font_stack', array(
    'label'   => __('Title Font Stack', 'deference'),
    'section' => 'deference_typography',
    'type'    => 'text',
  ));

  $wp_customize->add_setting('body_font_stack', array(
    'default'        => 'Georgia, serif',
    'capability'     => 'edit_theme_options',
  ));
  $wp_customize->add_control('body_font_stack', array(
    'label'   => __('Body Font Stack', 'deference'),
    'section' => 'deference_typography',
    'type'    => 'text',
  ));

  // Featured category
  $wp_customize->add_setting('featured_category', array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
  ));
  $wp_customize->add_control(new Category_Dropdown_Customize_Control($wp_customize, 'featured_category', array(
    'label'   => __('Featured Category', 'deference'),
    'section' => 'deference_home_page',
    'settings'   => 'featured_category',
  )));

  // Footer text
  $wp_customize->add_setting('footer_text', array(
    'default'           => 'All Rights Reserved',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
  ));
  $wp_customize->add_control(new Magazine_Customize_Textarea_Control($wp_customize, 'footer_text', array(
    'label'   => __('Footer Text', 'deference'),
    'section' => 'deference_display_options',
    'settings'   => 'footer_text',
  )));

  // Hide author info
  $wp_customize->add_setting('hide_author', array(
    'capability' => 'edit_theme_options',
  ));
  $wp_customize->add_control('hide_author', array(
    'label'    => __('Hide Author Information', 'deference'),
    'section'  => 'deference_display_options',
    'type'     => 'checkbox',
  ));

  // Hide search field
  $wp_customize->add_setting('hide_search_field', array(
    'capability' => 'edit_theme_options',
    'transport'  => 'postMessage',
  ));
  $wp_customize->add_control('hide_search_field', array(
    'label'    => __('Hide Search Field', 'deference'),
    'section'  => 'deference_display_options',
    'type'     => 'checkbox',
  ));

  // Disable parallax
  $wp_customize->add_setting('disable_parallax', array(
    'capability' => 'edit_theme_options',
    'transport'  => 'postMessage',
  ));
  $wp_customize->add_control('disable_parallax', array(
    'label'    => __('Disable Parallax Effects', 'deference'),
    'section'  => 'deference_display_options',
    'type'     => 'checkbox',
  ));

  // Header HTML
  $wp_customize->add_setting('site_header_html', array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
  ));
  $wp_customize->add_control(new Magazine_Customize_Textarea_Control($wp_customize, 'site_header_html', array(
    'label'   => __('Custom Header HTML', 'deference'),
    'section' => 'deference_custom_html',
    'settings'   => 'site_header_html',
  )));

  // Main HTML
  $wp_customize->add_setting('site_main_html', array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
  ));
  $wp_customize->add_control(new Magazine_Customize_Textarea_Control($wp_customize, 'site_main_html', array(
    'label'   => __('Custom Main HTML', 'deference'),
    'section' => 'deference_custom_html',
    'settings'   => 'site_main_html',
  )));

  // Footer HTML
  $wp_customize->add_setting('site_footer_html', array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'transport'         => 'postMessage',
  ));
  $wp_customize->add_control(new Magazine_Customize_Textarea_Control($wp_customize, 'site_footer_html', array(
    'label'   => __('Custom Footer HTML', 'deference'),
    'section' => 'deference_custom_html',
    'settings'   => 'site_footer_html',
  )));
}
add_action('customize_register', 'deference_customize_register');

/**
 * Binds JavaScript handlers to make Customizer preview reload changes
 * asynchronously.
 */
function deference_customize_preview_js() {
  wp_enqueue_script('deference-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array('customize-preview'), '20130226', true);
}
add_action( 'customize_preview_init', 'deference_customize_preview_js' );

function deference_is_theme_customizer() {
  global $wp_customize;
  return (!is_admin() && isset($wp_customize));
}

function deference_get_theme_mod($name) {
  if (deference_is_theme_customizer()) {
    return '<span '.deference_theme_mod_data_attr($name).'>'.get_theme_mod($name, $default).'</span>';
  } else {
    return get_theme_mod($name, $default);
  }
}

function deference_theme_mod_data_attr($name) {
  if (deference_is_theme_customizer()) {
    return " data-theme-mod='$name'";
  }
}

?>