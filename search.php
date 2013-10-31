<?php get_header(); ?>

<?php if (have_posts()): ?>

	<header class="page-header">
    <h1 class="page-title"><?php printf(__('Search Results for: %s', 'deference'), get_search_query()); ?></h1>
  </header>

  <div class="page-section post-list">
  	<?php while(have_posts()): the_post(); ?>
      <?php get_template_part('content', 'summary'); ?>
    <?php endwhile; ?>

    <?php deference_paging_nav(); ?>
  </div>

<?php else: ?>

	<?php get_template_part('content', 'none'); ?>

<?php endif; ?>

<?php get_footer(); ?>