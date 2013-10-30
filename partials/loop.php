<?php
  while (have_posts()): the_post();
    $thumbnail = deference_get_post_thumbnail();
?>
  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" class="post-summary">
    <div class="post-summary-thumbnail">
      <?php if ($thumbnail): ?>
        <img src="<?php echo $thumbnail ?>" alt="" width="150" height="150">
      <?php endif; ?>
    </div>
    <div class="post-summary-info">
      <h6 class="post-summary-category">
        <?php if (is_home() || (is_archive() && !is_category()) || is_search()): ?>
          <?php
            $category = get_the_category();
            echo $category[0]->cat_name;
          ?>
        <?php else: ?>
          <?php the_time('F j, Y') ?>
        <?php endif; ?>
      </h6>
      <h4 class="post-summary-title">
        <?php the_title(); ?>
      </h4>
      <?php the_excerpt(); ?>
    </div>
  </a>
<?php endwhile; ?>

<?php deference_paging_nav(); ?>