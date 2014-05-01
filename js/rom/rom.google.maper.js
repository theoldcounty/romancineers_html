/*
* Romanineers
* rom.google.maper.js
* Author: Rob Shan Lone
* Copyright (c) 2012 The Old County Limited.
*
* All rights reserved.
*/


var googleMaper = {
	zoom:4,
	map: null,
	latInterest: 0,
	longInterest: 0,
	latUser: 0,
	longUser: 0,
	invoke: function(el){
		
		$(el).css("width", $(el).data("width"));
		$(el).css("height", $(el).data("height"));
	
		this.setup($(el)[0], $(el).data("lat"), $(el).data("lng"), $(el).data("is-draggable"));
	},
	setup: function(theMap, latInterest, longInterest, isDraggable){
		this.latInterest = latInterest;
		this.longInterest = longInterest;

		var mapOptions = {
			zoom: this.zoom,
			center: new google.maps.LatLng(latInterest, longInterest),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

        this.map = new google.maps.Map(theMap, mapOptions);
		this.setUserMarker(latInterest, longInterest, isDraggable);
	},
	clearMarkers: function(){
		this.marker.setMap(null);
	},
	setCenter: function(lat,lon){
		this.map.panTo(new google.maps.LatLng(lat, lon));
	},
	getMarker: function(){
		return this.marker;
	},
	setUserMarker: function(latUser, longUser, isDraggable){
		var that = this;
		
		this.latUser = latUser;
		this.longUser = longUser;
		
        this.marker = new google.maps.Marker({
            position: new google.maps.LatLng(latUser, longUser),
            map: this.map,
            icon: 'images/googlemaps/usermarker.png',
            draggable: isDraggable
        });
		
		// then updates the input with the new coords
		google.maps.event.addListener(this.marker, 'dragend', function(evt){
			that.latUser = evt.latLng.lat().toFixed(6);
			that.longUser = evt.latLng.lng().toFixed(6);
		});
	}
};
