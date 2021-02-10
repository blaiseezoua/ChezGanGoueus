define([
    "jquery",
    "matchMedia",
    "menu"
], function($, mediaCheck) {
    "use strict";
    $.widget('Zemez.megamenu', $.mage.menu, {
        options: {
            breakpointMobile: 767
        },
        _create: function() {
            var megamenu = $('.tm-megamenu', this.element);
            this._mobileMenu();
            this._super();
            this._toggleClass(megamenu);
            this._setWidthMegamenu(megamenu);
        },
        _init: function() {
            this.delay = this.options.delay;
            var breakpoint = "(max-width: " + this.options.breakpointMobile + "px)";
            if (this.options.expanded === true) {
                this.isExpanded();
            }
            if (this.options.responsive === true) {
                mediaCheck({
                    media: breakpoint,
                    entry: $.proxy(function() {
                        this._toggleDesktopMode();
                    }, this),
                    exit: $.proxy(function() {
                        this._toggleDesktopMode();
                    }, this)
                });
            }
            this._assignControls()._listen();
        },
        _setOption: function(key, value) {
            this._super("_setOption", key, value);
        },
        toggle: function() {
            if ($(this.element).parent('.desktop-only').length) {
                return false;
            }
            this._super();
        },
        _mobileMenu: function() {
            this._subMenuMobile();
            var breakpointMobileMin = this.options.breakpointMobile + 1;
            var breakpoint = "(min-width: " + breakpointMobileMin + "px)";
            var topmenu = $('nav.tm-top-navigation');
            if (topmenu.length) return false;
            var nav = $('nav.mobile-only');
            var navDesktop = $(this.element).parent('.desktop-only');
            mediaCheck({
                media: breakpoint,
                entry: function() {
                    nav.removeClass('active');
                    navDesktop.addClass('active');
                },
                exit: function() {
                    nav.addClass('active');
                    navDesktop.removeClass('active');
                }
            });
        },
        _toggleClass: function(selector) {
            var breakpoint = "(max-width: " + this.options.breakpointMobile + "px)",
                ownClass = 'megamenu-wrapper',
                parentClass = 'megamenu-wrapper-parent';
            mediaCheck({
                media: breakpoint,
                entry: function() {
                    selector.removeClass(ownClass);
                    selector.parent().removeClass(parentClass);
                },
                exit: function() {
                    if (!selector.hasClass(ownClass)) {
                        selector.addClass(ownClass);
                    }
                    selector.parent().addClass(parentClass);
                }
            });
        },
        _setWidthMegamenu: function(selector) {
            if (selector.hasClass('in-sidebar')) {
                $(window).on('resize.menu', function() {
                    var pageWidth = $('.columns').innerWidth();
                    var sidebarWidth = $('.sidebar .navigation').innerWidth();
                    selector.css('min-width', pageWidth - sidebarWidth);
                }).trigger('resize.menu');
            }
        },
        _subMenuMobile: function() {
            var testExp = new RegExp('Android|webOS|iPhone|iPad|' +
                'BlackBerry|Windows Phone|' +
                'Opera Mini|IEMobile|Mobile',
                'i');
            if (testExp.test(navigator.userAgent)) {
                var submenu = $('.tm-top-navigation .submenu');
                setTimeout(function() {
                    $('.tm-top-navigation .level0.parent').on('click', function(e) {
                        if ($(e.currentTarget).children('.submenu').attr('aria-expanded') === 'false') {
                            submenu.attr('aria-expanded', 'false');
                            e.preventDefault();
                        }
                    });
                }, 1000);
            }
        }
    });
    return $.Zemez.megamenu;
});
