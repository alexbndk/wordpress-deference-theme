<?php get_header(); ?>

<?php if (have_posts()): ?>

  <header class="page-header">
    <?php if (is_year()): ?>
      <ul class="page-header-index alt-font">
        <?php wp_get_archives('type=yearly&order=ASC'); ?>
      </ul>
      <!-- echo get_the_date(_x('Y', 'yearly archives date format', 'deference')); -->
    <?php elseif (is_month()): ?>
      <ul class="page-header-index alt-font">
        <?php wp_get_archives('type=monthly&order=ASC'); ?>
      </ul>
      <!-- echo get_the_date(_x( 'F Y', 'monthly archives date format', 'deference')); -->
    <?php elseif (is_day()): ?>
      <h1 class="page-title"><?php echo get_the_date(); ?></h1>
    <?php else: ?>
      <h1 class="page-title"><?php _e('Archives', 'deference'); ?></h1>
    <?php endif; ?>
  </header><!-- .archive-header -->

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
