<?php get_header(); ?>

<?php if (have_posts()): ?>

  <?php get_template_part('partials/feature'); ?>

  <div class="post-list page-section">
    <?php
      // Offset the loop by one (the featured article)
      global $query_string;
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;
      $posts_per_page = (get_query_var('posts_per_page')) ? get_query_var('posts_per_page') : 10;
      query_posts($query_string.'&offset='.((($paged-1) * $posts_per_page) + 1));

      get_template_part('partials/loop');

      wp_reset_query();
    ?>
  </div>

<?php else: ?>

  <?php get_template_part('content', 'none'); ?>

<?php endif; ?>

<?php get_footer(); ?>
