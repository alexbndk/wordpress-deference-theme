<?php
  if (is_home() && get_theme_mod('featured_category')) {
    // Use featured category for the home page
    $category = get_category(get_theme_mod('featured_category'));

    // Get the first post from the category
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $featured_posts = get_posts(array(
      'posts_per_page' => 1,
      'offset' => ($paged-1),
      'category' => $category->term_id,
    ));
    $post = $featured_posts[0];
    setup_postdata($post);
  } else {
    // Otherwise just get the first post
    the_post();
    $category = get_the_category();
    $category = $category[0];
  }

  deference_set_page_background();
?>

  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" class="post-summary-featured translucent">
    <div class="post-summary-featured-cover" style="background-image:url(<?php echo deference_get_post_cover(); ?>)"></div>
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

<?php if (is_home() && get_theme_mod('featured_category')): wp_reset_postdata(); endif; ?>