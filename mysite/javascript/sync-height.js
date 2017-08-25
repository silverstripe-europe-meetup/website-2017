(function ($) {
	$('body').entwine({
		syncElementHeight: function () {
			var all = {};
			this.find('.sync-height').each(function () {
				var _this = $(this),
					group = _this.data('sync-height'),
					rowOffset = _this.closest('.sync-height-container').offset().top;
				if (typeof all[group] == 'undefined') {
					all[group] = {};
				}
				if (typeof all[group][rowOffset] == 'undefined') {
					all[group][rowOffset] = {
						elements: [],
						height: 0
					};
				}
				all[group][rowOffset].elements.push({
					element: _this,
					inner: _this.find('.sync-height-inner')
				});
			});
			for (var group in all) {
				for (var rowOffset in all[group]) {
					for (var i in all[group][rowOffset].elements) {
						var inner = all[group][rowOffset].elements[i].inner;
						all[group][rowOffset].height = Math.max(all[group][rowOffset].height, inner.height());
					}
				}
			}
			for (group in all) {
				for (rowOffset in all[group]) {
					for (i in all[group][rowOffset].elements) {
						var element = all[group][rowOffset].elements[i].element;
						element.css('min-height', all[group][rowOffset].height);
					}
				}
			}
			this.trigger('sync-height:after');
		},
		onmatch: function () {
			this._super();
			var _this = this,
				timer = new Timer(function () {
					_this.syncElementHeight();
				}, 500);
			_this.syncElementHeight();
			timer.start();
			$(window).resize(function () {
				timer.reset();
			});
		}
	});
})(jQuery);
