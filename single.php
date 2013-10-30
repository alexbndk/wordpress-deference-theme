<?php
  get_header();

  while (have_posts()): the_post();
    get_template_part('content', get_post_format());
  endwhile;

  get_template_part('partials/related');

  get_footer();
?>
