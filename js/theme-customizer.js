/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title and description changes.
 */

(function($) {
  wp.customize('site_logo', function(value) {
    value.bind(function(to) {
      $('[data-theme-mod=site_logo]').attr('src', to);
    });
  });

  wp.customize('favicon', function(value) {
    value.bind(function(to) {
      // Ignore
    });
  });

  wp.customize('disable_parallax', function(value) {
    value.bind(function(to) {
      Deference.useParallax = !to;
    });
  });

  wp.customize('blogname', function(value) {
		value.bind(function(to) {
			$('#site-name').text(to);
		});
	});
	wp.customize('blogdescription', function(value) {
		value.bind(function(to) {
			$('#site-description').text(to);
		});
	});

  wp.customize('accent_color', function(value) {
    value.bind(function(to) {
      $('h6').css('color', to ? to : '');
    });
  });

  wp.customize('layout_width', function(value) {
    value.bind(function(to) {
      $('[data-theme-mod=layout_width]').css('width', to);
      window.reflowNav();
    });
  });

  wp.customize('post_cover_height', function(value) {
    value.bind(function(to) {
      $('[data-theme-mod=post_cover_height]').css('height', to);
    });
  });

  wp.customize('font_size', function(value) {
    value.bind(function(to) {
      $('html').css('font-size', to + '%');
    });
  });

  wp.customize('nav_font_size', function(value) {
    value.bind(function(to) {
      $('[data-theme-mod=nav_font_size]').find('a, span').css('font-size', to);
      Deference.calculateNavOverflow();
    });
  });

  wp.customize('footer_text', function(value) {
    value.bind(function(to) {
      $('[data-theme-mod=footer_text]').html(to);
    });
  });

  wp.customize('site_header_html', function(value) {
    value.bind(function(to) {
      $('[data-theme-mod=site_header_html]').html(to);
    });
  });

  wp.customize('site_main_html', function(value) {
    value.bind(function(to) {
      $('[data-theme-mod=site_main_html]').html(to);
    });
  });

  wp.customize('site_footer_html', function(value) {
    value.bind(function(to) {
      $('[data-theme-mod=site_footer_html]').html(to);
    });
  });

  wp.customize('hide_search_field', function(value) {
    value.bind(function(to) {
      if (to) {
        $('[data-theme-mod=hide_search_field]').hide();
      } else {
        $('[data-theme-mod=hide_search_field]').show();
      }
    });
  });
})(jQuery);