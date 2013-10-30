<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <label>
    <span class="screen-reader-text"><?php _e( 'Search for:' ); ?></span>
    <input type="text" class="search-field" placeholder="<?php _e( 'Search' ); ?>…" value="" name="s" title="<?php _e( 'Search for:' ); ?>" />
  </label>
  <input type="submit" class="search-submit" value="<?php _e( 'Search' ); ?>" />
  <span class="genericon genericon-search"></span>
</form>