<?php get_header(); ?>

<?php if (have_posts()): ?>

  <header class="page-header page-section translucent">
    <?php if (get_the_author_meta('description')): ?>
      <?php get_template_part( 'author-bio' ); ?>
    <?php else: ?>
      <?php the_post(); ?>
      <h1 class="page-title"><?php printf( __( 'All posts by %s', 'deference' ), '<span class="vcard">' . get_the_author() . '</span>' ); ?></h1>
      <?php rewind_posts(); ?>
    <?php endif; ?>
  </header>

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