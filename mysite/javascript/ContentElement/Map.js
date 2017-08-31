(function ($) {
	"use strict";

	$('.ContentElement-Map .map').entwine({
		MapObject: null,
		MapBoundsObject: null,
		MapOpenWindow: null,
		getMapStyleSheet: function () {
			return [
				{
					"featureType": "administrative.province",
					"elementType": "all",
					"stylers": [
						{
							"visibility": "off"
						}
					]
				},
				{
					"featureType": "landscape",
					"elementType": "all",
					"stylers": [
						{
							"saturation": -100
						},
						{
							"lightness": 65
						},
						{
							"visibility": "on"
						}
					]
				},
				{
					"featureType": "poi",
					"elementType": "all",
					"stylers": [
						{
							"saturation": -100
						},
						{
							"lightness": 51
						},
						{
							"visibility": "simplified"
						}
					]
				},
				{
					"featureType": "road.highway",
					"elementType": "all",
					"stylers": [
						{
							"saturation": -100
						},
						{
							"visibility": "simplified"
						}
					]
				},
				{
					"featureType": "road.arterial",
					"elementType": "all",
					"stylers": [
						{
							"saturation": -100
						},
						{
							"lightness": 30
						},
						{
							"visibility": "on"
						}
					]
				},
				{
					"featureType": "road.local",
					"elementType": "all",
					"stylers": [
						{
							"saturation": -100
						},
						{
							"lightness": 40
						},
						{
							"visibility": "on"
						}
					]
				},
				{
					"featureType": "transit",
					"elementType": "all",
					"stylers": [
						{
							"saturation": -100
						},
						{
							"visibility": "simplified"
						}
					]
				},
				{
					"featureType": "water",
					"elementType": "geometry",
					"stylers": [
						{
							"hue": "#ffff00"
						},
						{
							"lightness": -25
						},
						{
							"saturation": -97
						}
					]
				},
				{
					"featureType": "water",
					"elementType": "labels",
					"stylers": [
						{
							"visibility": "on"
						},
						{
							"lightness": -25
						},
						{
							"saturation": -100
						}
					]
				}
			];
		},
		initializeMap: function (lat, lng) {
			if (typeof google !== 'undefined') {
				this.setMapBoundsObject(new google.maps.LatLngBounds());
				var map = new google.maps.Map(this.get(0), {
					zoom: 15,
					center: new google.maps.LatLng(lat, lng),
					//panControl: false,
					//zoomControl: true,
					mapTypeControl: false,
					//scaleControl: false,
					streetViewControl: false,
					//overviewMapControl: false,
					scrollwheel: false,
					//zoomControlOptions: {
					//	style: google.maps.ZoomControlStyle.SMALL,
					//	position: google.maps.ControlPosition.LEFT_BOTTOM
					//},
					styles: this.getMapStyleSheet()
				});
				this.setMapObject(map);
				var dragableCheck = function () {
					map.setOptions({
						draggable: $(window).width() > 500
					});
				};
				dragableCheck();
				$(window).resize(function () {
					dragableCheck();
				});
			}
		},
		addMapMarker: function (lat, lng, title, content, iconURL) {
			if (typeof google !== 'undefined') {
				var pos = new google.maps.LatLng(lat, lng);
				this.getMapBoundsObject().extend(pos);
				var map = this.getMapObject(),
					_this = this;
				var config = {
					position: pos,
					map: map,
					title: ''
				};
				var titleHTML = '';
				if (typeof title !== 'undefined' && title) {
					config.title = title;
					titleHTML = '<h5>' + title + '</h5>';
				}
				if (typeof iconURL !== 'undefined' && iconURL) {
					config.icon = iconURL + '?2017';
				}
				var marker = new google.maps.Marker(config);
				if (typeof content !== 'undefined' && content) {
					google.maps.event.addListener(marker, 'click', function () {
						var infoWindow = new google.maps.InfoWindow({
							content: '<div class="map-markers-popup-content">' + titleHTML  + content + '</div>'
						});
						var openWindow = _this.getMapOpenWindow();
						if (openWindow) {
							openWindow.close();
						}
						infoWindow.open(map, marker);
						_this.setMapOpenWindow(infoWindow);
					});
				}
			}
		},
		fitMapBounds: function () {
			var map = this.getMapObject();
			map.fitBounds(this.getMapBoundsObject(), 100);
			//map.setZoom(map.getZoom() - 2);
			var listener = google.maps.event.addListener(map, "idle", function () {
				map.setZoom(map.getZoom() - 1);
				google.maps.event.removeListener(listener);
			});
		}
	});
	$('.ContentElement-Map').entwine({
		onmatch: function () {
			this._super();
			var map = this.find('.map');
			map.initializeMap(48.305, 14.285);
			this.find('.map-marker').each(function () {
				var marker = $(this);
				map.addMapMarker(
					marker.data('lat'),
					marker.data('lng'),
					marker.data('title'),
					marker.html(),
					marker.data('icon')
				);
			});
			map.fitMapBounds();
		}
	});
})(jQuery);
