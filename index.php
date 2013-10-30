<?php get_header(); ?>

  <?php get_template_part('partials/feature'); ?>

  <div class="post-list page-section">
    <?php
      // Remove the featured category from the home page loop
      if (get_theme_mod('featured_category')) {
        global $query_string;
        query_posts($query_string . '&cat=-' . get_theme_mod('featured_category'));
      }

      get_template_part('partials/loop');

      wp_reset_query();
    ?>
  </div>

  <div class="category-index page-section translucent">
    <?php $categories = get_categories(); ?>
    <?php foreach ($categories as $category) : ?>
      <?php if ($description = $category->description): ?>
        <a href="<?php echo get_category_link($category->term_id) ?>" class="category-link">
          <h6><?php echo $category->name; ?></h6>
          <p><?php echo $description ?></p>
        </a>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>

<?php get_footer(); ?>
