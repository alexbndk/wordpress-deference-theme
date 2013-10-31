<?php
  // Show all posts from the categories the post belongs to
  $categories = get_the_category();
  $related_posts = get_posts(array(
    'posts_per_page' => -1,
    'category' => implode(',', array_map(create_function('$o', 'return $o->term_id;'), $categories)),
  ));
?>

<?php if ($related_posts): ?>
  <div class="post-related post-list page-section translucent">
    <?php foreach ($related_posts as $post): setup_postdata($post); ?>
      <?php get_template_part('content', 'summary'); ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>