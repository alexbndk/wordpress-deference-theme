<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php if ($thumb = deference_get_post_cover()): ?>
    <div class="post-cover"<?php echo deference_theme_mod_data_attr('post_cover_height'); ?>>
      <img src="<?php echo $thumb ?>" alt="" width="100%">
    </div>
  <?php endif; ?>

  <div class="page-section">

    <header class="post-header">
      <h1 class="post-title"><?php the_title(); ?></h1>
    </header>

    <div class="post-content">
      <?php the_content(); ?>
    </div>

  </div>

  <?php get_sidebar(); ?>

  <footer class="post-footer page-section">
    <?php comments_template(); ?>
  </footer>

</article>