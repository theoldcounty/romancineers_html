		
var googleMapFormLock = {
	el: "",
	init: function(el){
		this.el = el;
		
		this.bindGoogleMapEvents();
	},
	setLatLng: function(countryName){
		var that = this;
		//search for it on google map and obtain its lat and long
		//set the lat and long in the reg map

		//
		// initialize geocoder
		//
		var geocoder = new google.maps.Geocoder();

		geocoder.geocode(
			{
				address: countryName
			}, 
			function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var result = results[0];

					var newLat = result.geometry.location.lat();
					var newLong = result.geometry.location.lng();

					that.el.find('input[name="latitude"]').val(newLat);
					that.el.find('input[name="longitude"]').val(newLong);
					
					googleMaper.clearMarkers();
					googleMaper.setCenter(newLat, newLong)
					googleMaper.setUserMarker(newLat, newLong, true);
					
					google.maps.event.addListener(googleMaper.getMarker(), 'dragend', function(evt){
						console.log("dragend2");
						that.el.find('input[name="latitude"]').val(evt.latLng.lat().toFixed(6));
						that.el.find('input[name="longitude"]').val(evt.latLng.lng().toFixed(6));
					});					
					
					
				} else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
					alert("Sorry, the geocoder failed to locate the specified address.");
				} else {
					alert("Sorry, the geocoder failed with an internal error.");
				}
			}
		);
	},
	bindGoogleMapEvents: function(){
		var that = this;

		//listen to current selected country
		var selectboxCountry = that.el.find('select[name="country"]');

		that.setLatLng(selectboxCountry.find(":selected").text());

		selectboxCountry.change(function() {
			that.setLatLng($(this).find(":selected").text());
		});
	}
}

