/*
*	Google Maper
*
*	Author: Rob Shan Lone
*	Copyright (c) 2013 The Old County Limited.
*
*	All rights reserved.
*/

var googleMaper = {
	zoom:4,
	map: null,
	latInterest: 0,
	longInterest: 0,
	latUser: 0,
	longUser: 0,
	setup: function(latInterest, longInterest){
		this.latInterest = latInterest;
		this.longInterest = longInterest;

		var mapOptions = {
			zoom: this.zoom,
			center: new google.maps.LatLng(latInterest, longInterest),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

        var theMap = $('#canvasMap')[0];
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
