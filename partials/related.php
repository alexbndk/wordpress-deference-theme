<div class="post-related post-list">
  <div class="page-section translucent">
    <?php
      // Show all posts from the current category
      $category = get_the_category();
      $args = array(
        'posts_per_page' => -1,
        'cat' => $category[0]->term_id,
      );
      query_posts($args);

      get_template_part('partials/loop');

      wp_reset_query();
    ?>
  </div>
</div>