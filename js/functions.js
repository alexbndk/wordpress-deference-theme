var Deference = {
  hasMainNav: false,
  hasAdminBar: false,
  supportsGyro: false,
  useParallax: true,
  parallaxDampening: 4,

  init: function() {
    this.$body = jQuery('body');
    this.$win = jQuery(window);
    this.scrollPos = this.$win.scrollTop();

    // Parallax can be turned off in the theme configuration
    this.useParallax = !this.$body.hasClass('disable-parallax');
    this.hasAdminBar = this.$body.hasClass('admin-bar');
    this.supportsGyro = window.DeviceOrientationEvent;

    this.$navContainer = jQuery('#site-nav');
    this.hasMainNav = this.$navContainer.length > 0;
    if (this.hasMainNav) {
      this.$nav = jQuery('.site-header-nav');
      this.$navItems = this.$nav.find('.menu-item');
      // Initialize main nav
      this.calculateNavOverflow();
    }

    this.$cover = jQuery('.post-cover');
    this.$coverImg = this.$cover.find('img');
    this.$shareBtns = jQuery('.sharedaddy');

    this.$bgImage = jQuery('#site-bg-src');
    this.$bgImage.imagesLoaded(function() {
      stackBlurImage('site-bg-src', 'site-bg-canvas', 40, false);
    });

    this.processPostContent();
    this.processPostCoverImage();
    this.moveJetpackShareButtons();

    // Load the related articles
    jQuery('.post-related').bind('scrollin', { distance: 200 }, function() {
      jQuery(this)
        .addClass('is-visible')
        .unbind('scrollin');
    });

    // Observe scrolling
    this.$win.on('scroll', this.observeScroll.bind(this));

    // TODO: Clean this up
    var $index = jQuery('.page-header-index');
    if ($index.length > 0) {
      var firstPos = $index.find(':first').position().left;
      var lastPos = $index.find(':last').position().left;

      var $activeIndexNav = $index.find('.current');
      var middlePos = $activeIndexNav.position().left;

      if (lastPos > $index.width()) {
        if (middlePos > (lastPos - ($index.width() / 2)))
          jQuery('.page-header-index').css({
            'left': -((lastPos + jQuery('.page-header-index :last').width()) - $index.width())
          });
        else if (middlePos > ($index.width() / 2))
          jQuery('.page-header-index').css({
            'left': -(middlePos - ($index.width() / 2) + ($activeIndexNav.width() / 2) - 15)
          });
      }
      $index.addClass('is-processed');
    }
  },

  observeScroll: function() {
    this.scrollPos = this.$win.scrollTop();

    // Fixed nav
    if (this.hasMainNav && this.scrollPos >= (this.$navContainer.offset().top - (this.hasAdminBar ? 28 : 0))) {
      this.$navContainer.addClass('fixed');
    } else {
      this.$navContainer.removeClass('fixed');
    }

    // Parallax cover
    if (!this.supportsGyro && !this.disableParallax && this.$cover.length > 0 && this.scrollPos < 600) {
      this.$coverImg.css('-webkit-transform', 'translate3d(0,' + Math.round(this.scrollPos / this.parallaxDampening) + 'px,0)');
    }
  },

  processPostContent: function() {
    // Make embeds full width
    jQuery('.post-content p [class^=embed-]').unwrap();
  },

  processPostCoverImage: function() {
    if (this.$cover.length < 1) return;

    this.$coverImg.imagesLoaded(function() {
      this.$coverImg
        .css({top: '-' + ((this.$coverImg.height() - this.$cover.height()) / 2) + 'px'})
        .attr('data-parallaxify-range-y', this.$coverImg.height() - this.$cover.height())
        .addClass('done');

      if (this.supportsGyro && !this.disableParallax) {
        this.$cover.parallaxify({
          horizontalParallax: false,
          verticalParallax: true,
          parallaxBackgrounds: false,
          parallaxElements: true,
          responsive: true,
          useMouseMove: false,
          useGyroscope: true,
          positionProperty: 'transform',
          motionType: 'natural',
          motionAngleX: 70,
          motionAngleY: 70,
          alphaFilter: 0.65,
          adjustBasePosition: false,
          alphaPosition: 0.025
        });
      }
    }.bind(this));
  },

  moveJetpackShareButtons: function() {
    if (this.$shareBtns.length > 0) {
      this.$shareBtns.appendTo(jQuery('.post-share'));
    } else {
      jQuery('.post-share').remove();
    }
  },

  resetNavOverflow: function() {
    this.$nav.removeClass('is-overflowed').removeClass('is-processed');
    this.$nav.find('.overflow-menu li').appendTo(this.$nav);
    this.$nav.find('.menu-overflow').remove();
  },

  calculateNavOverflow: function() {
    if (this.$navItems.length < 1) {
      this.$nav.addClass('is-processed');
      return;
    }

    // Roll back previous overflowing if necessary
    if (this.$nav.hasClass('is-overflowed')) {
      this.resetNavOverflow();
    }

    var offset = this.$navItems.first().offset().top;
    var overflow = [];
    var active = false;
    if (this.$navItems.last().offset().top !== offset) {
      this.$navItems.each(function() {
        if (jQuery(this).offset().top !== offset) {
          overflow.push(jQuery(this));
          active = active || jQuery(this).hasClass('current-menu-item') || jQuery(this).hasClass('current-post-ancestor');
        }
      });
      if (overflow.length > 0) {
        this.$nav.addClass('is-overflowed');
        var $overflowNav = jQuery('<ul class="overflow-menu"></ul>').append(overflow);
        jQuery('<li class="menu-overflow"><span>&bull;&bull;&bull;</span></li>')
          .addClass(active ? 'current-menu-item' : '')
          .append($overflowNav)
          .appendTo(this.$nav);
      }
    }

    this.$nav.addClass('is-processed');
  }
};

(function($) {
  Deference.init();
})(jQuery);