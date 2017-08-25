var _paq = _paq || [];
(function ($) {
	$('html').entwine({
		onmatch: function() {
			this._super();
			var _this = this;
			new Timer(function() { _this.addClass('animate'); }, 300);
		}
	});
	$('.header.has-header-image').entwine({
		onmatch: function () {
			var header = this,
				hasClass = false,
				win = $(window),
				firstChild = $('.layout > .section').first(),
				firstChildHeight = firstChild && firstChild.length ? firstChild.height() / 2 : 300,
				handleScroll = function () {
					if (winWidth >= 700) {
						var scroll = win.scrollTop();
						if (!hasClass) {
							if (scroll > firstChildHeight) {
								header.addClass('scrolled');
								hasClass = true;
							}
						} else {
							if (scroll < firstChildHeight) {
								header.removeClass('scrolled');
								hasClass = false;
							}
						}
					}
				},
				handleResize = function () {
					winWidth = win.width();
					handleScroll();
				};
			handleResize();
			win.resize(handleResize);
			win.scroll(handleScroll);
		}
	});
	$('a.scroll, .typography a').entwine({
		onclick: function () {
			var hash = this.attr('href').split("#")[1];
			var target = $('#' + hash);
			if (target.length) {
				$('html, body').animate({scrollTop: target.offset().top - 70}, 700);
				_paq.push(['trackEvent', 'Scroll', 'Section', this.attr('title')]);
				//window.location.hash = '#' + hash;
				return false;
			}
			else {
				_paq.push(['trackEvent', 'Link', 'External', this.attr('href')]);
			}
		}
	});
	$('.toggle-nav').entwine({
		onclick: function () {
			this.closest('header').find('ul').slideToggle(500);
			return false;
		}
	});
})(jQuery);
