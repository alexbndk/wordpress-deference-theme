<?php get_header(); ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class('image-attachment'); ?>>
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header>

    <div class="page-section">
      <div class="post-content">
        <?php deference_the_attached_image(); ?>

        <?php if (has_excerpt()): ?>
          <div class="post-attachment-caption">
            <?php the_excerpt(); ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($post->post_content)): ?>
          <div class="post-attachment-description">
            <?php the_content(); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <?php get_sidebar(); ?>

    <footer class="post-footer page-section">
      <?php comments_template(); ?>
    </footer>
  </article>

<?php get_footer(); ?>