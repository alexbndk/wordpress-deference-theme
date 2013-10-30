<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php if ($thumb = deference_get_post_cover()): ?>
    <div class="post-cover"<?php echo deference_theme_mod_data_attr('post_cover_height'); ?>>
      <img src="<?php echo $thumb ?>" alt="" width="100%">
    </div>
  <?php endif; ?>

  <div class="page-section">

    <header class="post-header">
      <h1 class="post-title"><?php the_title(); ?></h1>
      <p class="post-meta">
        <?php printf(__('Written by %s', 'deference'), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.get_the_author_meta('display_name').'</a>'); ?>
        &nbsp;·&nbsp;
        <?php the_time(get_option('date_format')) ?>
      </p>
    </header>

    <div class="post-content">
      <?php the_content(); ?>
    </div>

  </div>

  <?php get_sidebar(); ?>

  <footer class="post-footer page-section">
    <?php if (get_the_author_meta('description') && is_multi_author()): ?>
      <?php get_template_part('author-bio'); ?>
    <?php endif; ?>

    <div class="post-share"></div>

    <?php comments_template(); ?>
  </footer>

</article>