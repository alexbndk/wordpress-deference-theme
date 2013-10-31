<?php get_header(); ?>

<?php if (have_posts()): ?>

  <header class="page-header">
    <h1 class="page-title"><?php
      if ( is_day() ) :
        printf( __( 'Daily Archives: %s', 'deference' ), get_the_date() );
      elseif ( is_month() ) :
        printf( __( 'Monthly Archives: %s', 'deference' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'deference' ) ) );
      elseif ( is_year() ) :
        printf( __( 'Yearly Archives: %s', 'deference' ), get_the_date( _x( 'Y', 'yearly archives date format', 'deference' ) ) );
      else :
        _e( 'Archives', 'deference' );
      endif;
    ?></h1>
  </header><!-- .archive-header -->

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
