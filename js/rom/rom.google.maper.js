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
		this.setup($(el)[0], $(el).data("lat"), $(el).data("lng"));
	},
	setup: function(theMap, latInterest, longInterest){
		this.latInterest = latInterest;
		this.longInterest = longInterest;

		var mapOptions = {
			zoom: this.zoom,
			center: new google.maps.LatLng(latInterest, longInterest),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

        
        this.map = new google.maps.Map(theMap, mapOptions);
		
		this.setUserMarker(latInterest, longInterest);

	},
	setUserMarker: function(latUser, longUser){

		this.latUser = latUser;
		this.longUser = longUser;

        var image = 'images/googlemaps/usermarker.png';
        var myLatLng = new google.maps.LatLng(latUser, longUser);

        var beachMarker = new google.maps.Marker({
            position: myLatLng,
            map: this.map,
            icon: image
        });
	}
};
