<?php get_header(); ?>

<?php if (have_posts()): ?>

	<header class="page-header">
    <h1 class="page-title"><?php printf(__('Search Results for: %s', 'deference'), get_search_query()); ?></h1>
  </header>

  <div class="page-section post-list">
  	<?php get_template_part('partials/loop'); ?>
  </div>

<?php else: ?>

	<?php get_template_part('content', 'none'); ?>

<?php endif; ?>

<?php get_footer(); ?>