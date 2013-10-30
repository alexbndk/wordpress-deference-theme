<?php
  if (is_home() && get_theme_mod('featured_category')) {
    // Use featured category for the home page
    $category = get_category(get_theme_mod('featured_category'));
  } else {
    // Otherwise just get the first category
    $category = get_the_category();
    $category = $category[0];
  }

  // Get the first post from the category
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
  $args = array(
    'posts_per_page' => 1,
    'offset' => ($paged-1),
    'category' => $category->term_id,
  );
  $featured_posts = get_posts($args);
  foreach($featured_posts as $post):
    setup_postdata($post);
    deference_set_page_background();
    $cover = deference_get_post_cover();
?>

  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" class="post-summary-featured translucent">
    <div class="post-summary-featured-cover" style="background-image:url(<?php echo $cover ?>)"></div>
    <div class="post-summary-featured-info">
      <h6 class="post-summary-featured-category">
        <?php if (is_home() || (is_archive() && !is_category()) || is_search()): ?>
          <?php echo $category->cat_name; ?>
        <?php else: ?>
          <?php the_time('F j, Y') ?>
        <?php endif; ?>
      </h6>
      <h2 class="post-summary-featured-title">
        <?php the_title(); ?>
      </h2>
      <?php the_excerpt(); ?>
    </div>
  </a>

<?php endforeach; wp_reset_postdata(); ?>