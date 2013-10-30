<?php
/**
 * The template for displaying Author bios.
 *
 */
?>

<div class="author-bio">
  <?php echo get_avatar( get_the_author_meta( 'user_email' ), '100' ); ?>
  <h3 class="author-bio-name">
    <?php the_author_posts_link('namefl'); ?>
  </h3>
  <p class="author-bio-description">
    <?php the_author_description(); ?>
  </p>
</div>