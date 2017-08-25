<div class="content-container">
	<div class="container">
		<div class="container-inner">
			<div class="content typography">
				<h2>$Title</h2>
				$Content
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<div class="map-container">
	<div class="map"></div>
	<div class="map-markers">
		<% loop $MapMarkers.Value %>
			<div class="map-marker" data-lat="$Latitude" data-lng="$Longitude" data-title="$Title.ATT"
				 data-icon="$getMapMarkerIconURL">
				$Content
			</div>
		<% end_loop %>
	</div>
</div>
