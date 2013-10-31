<?php get_header(); ?>

  <?php if (have_posts()): ?>

    <?php get_template_part('partials/feature'); ?>

    <div class="post-list page-section">
      <?php while(have_posts()): the_post(); ?>
        <?php get_template_part('content', 'summary'); ?>
      <?php endwhile; ?>

      <?php deference_paging_nav(); ?>
    </div>

  <?php else: ?>

    <?php get_template_part('content', 'none'); ?>

  <?php endif; ?>

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
