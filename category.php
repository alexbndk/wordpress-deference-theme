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

<?php get_footer(); ?>
