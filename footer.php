    <?php echo deference_get_theme_mod('site_main_html'); ?>
    </div><!-- #site-main -->

    <?php get_sidebar( 'main' ); ?>

    <footer id="site-footer">
      <p class="footer-divider">◆◆◆</p>

      <?php if (has_nav_menu('secondary')): ?>
        <nav id="site-footer-nav">
          <?php wp_nav_menu(array('theme_location' => 'secondary', 'menu_class' => 'site-footer-nav alt-font', 'container' => false)); ?>
        </nav>
      <?php endif; ?>

      <p class="footer-copyright">
        &#169; <?php echo date('Y'); ?> <span><?php bloginfo('name'); ?></span>
        <?php echo deference_get_theme_mod('footer_text', '∙ All Rights Reserved'); ?>
      </p>
      <?php echo deference_get_theme_mod('site_footer_html'); ?>
    </footer>

  </div><!-- #site-wrapper -->

  <?php if ($background = deference_get_page_background()): ?>
    <img src="<?php echo $background; ?>" alt="" id="site-bg">
  <?php endif; ?>

  <?php wp_footer(); ?>
</body>
</html>