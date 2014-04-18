

var VenueOverlay = Backbone.View.extend({

	map: null,
	marker: null,
	infoBox: null,
	venueInfoVO: null,
	symbolUrl: 'images/googlemaps/maps-symbol.png',
	mobileInfoLayer: null,

	initialize: function(attributes) {
		//console.log("attributes", attributes);

		this.venueInfoVO = new VenueInfoVO({venueInfo: attributes});
		this.createMarker();
		this.bindEvents();
	},

	createMarker: function() {
		this.marker = new google.maps.Marker({
			position: this.getLatLng(),
			icon: this.getMarkerIcon()
		});
	},

	bindEvents: function() {
		google.maps.event.addListener(this.marker, 'click', _.bind(this.onMarkerClick, this));
	},

	onMarkerClick: function() {
		this.enableMarker(false);
		this.createInfoBox();
		// trigger event to close other possibly opened infoBoxes in googlemaps.js
		this.trigger(VenueOverlay.ClickOnMarkerEvent, this);
	},

	enableMarker: function(value) {
		var options = {
			visible: value,
			clickable: value
		};
		this.marker.setOptions(options);
	},

	createInfoBox: function() {
		if(!this.infoBox) {
			this.infoBox = new InfoBox({latlng: this.getLatLng(), map: this.map, infoLayer: $(this.getInfoLayer())});
			$(this.infoBox).bind(InfoBox.ClickCloseButton, _.bind(this.onCloseButtonInfoBox, this));

			//console.log("created info box");
			$(this.infoBox).bind(InfoBox.ClickMoreInfoButton, _.bind(this.onClickMoreInfoButton, this));
		}
	},

	onCloseButtonInfoBox: function() {
		this.closeInfoBox();
	},

	closeInfoBox: function() {
		if(this.infoBox) {
			this.enableMarker(true);
			this.infoBox.closeInfoWindow();
			this.infoBox = null;
		}
	},

	onClickMoreInfoButton: function(event) {
		event.preventDefault();

		var venueId = this.venueInfoVO.venueInfo.id;
		var senderUid = $("#userData").data("user-id");
		var recepientUid = $("#candidateData").data("user-id");
		
		//console.log("venueId2 ", venueId);
		
		//date
		var url = $('#googleMapData').data("dating-page");
			url += '?venueId='+venueId+'&senderUid='+senderUid+'&recepientUid='+recepientUid;

		fancybox.ajaxBased(url, function(){
			date.init();
			appController.invoke();
		});
	},
	
	clearVenueOverLayer: function() {
		this.venueInfoVO.clear();
		this.closeInfoBox();
		this.marker.setMap(null);
		if(this.mobileInfoLayer != null) {
			this.mobileInfoLayer = null;
		}
	},

	getInfoLayer: function() {
		return '<div>' +
					'<div class="info-window">' +
						'<span class="tooltip-arrow"></span>' +
						'<div class="header-container">' +
							this.venueInfoVO.getHeaderInfo() +
							'<a class="close-button" href="#">close button</a>' +
						'</div>' +
						'<div class="button-container">' +
							'<a class="link-button arrow-right" href="#"><span class="text">Schedule a date at this venue</span></a>' +
						'</div>' +
					'</div>' +
				'</div>';
	},

	// set map and map to marker
	setMap: function(map) {
		this.map = map;
		this.marker.setMap(this.map);
	},



	getMarkerIcon: function() {

		//var customIcon = this.symbolUrl;
		var customIcon = "images/googlemaps/maps-symbol.png";
		if(this.venueInfoVO.venueInfo.categories[0]){
			//customIcon = this.venueInfoVO.venueInfo.categories[0].icon;

			//customType = "http://icons.iconarchive.com/icons/icons-land/vista-map-markers/256/Map-Marker-Push-Pin-1-Right-Azure-icon.png";

			//customType = (this.venueInfoVO.venueInfo.categories[0].name).toLowerCase();
			////console.log("customType", customType);

			//theater
			//indie theater
			//college theater

			
			//café


			//restaurant
			//italian restaurant
			//eastern european restaurant
			//asian restaurant
			//japanese restaurant
			//cajun / creole restaurant
			//turkish restaurant
			//korean restaurant
			//indian restaurant
			//chinese restaurant
			//african restaurant
			//vegetarian / vegan restaurant


			//ice cream shop
			//food truck
			//dessert shop
			//cocktail bar


			//comedy club
			//general entertainment
			//bar
			//art gallery


			//pub
			//gastropub
			//beer garden
			//brewery

			//performing arts venue
			//nightclub
			//breakfast spot
			//hotel
			//casino
			//rock club

			//gay bar


			//theme park


			//history museum

			//zoo
			//playground


			//plaza
			//snack place
			//bbq joint
			//snack place

			//library
			//science museum

			//aquarium

		}


		//////console.log("this.venueInfoVO.categories", this.venueInfoVO.venueInfo.categories[0].icon);
		return customIcon; //this.symbolUrl;//this.venueInfoVO.venueInfo.categories[0];
		//this.symbolUrl; //new google.maps.LatLng(this.venueInfoVO.getLatitude(), this.venueInfoVO.getLongitude());
	},



	getLatLng: function() {
		return new google.maps.LatLng(this.venueInfoVO.getLatitude(), this.venueInfoVO.getLongitude());
	}

});

VenueOverlay.ClickOnMarkerEvent = "MCD-clickOnMarkerEvent";

var VenueInfoVO = Backbone.View.extend({

	venueInfo: null,
	days: ["Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag"],
	times: null,
	services: null,

	initialize: function(attributes) {
		////console.log("attributes", attributes);

		this.venueInfo = attributes.venueInfo.venueInfo;

		this.setDays();
		this.setServices();
	},

	setDays: function() {
		this.times = [];
		/*
		this.times.push(this.venueInfo.monday);
		this.times.push(this.venueInfo.tuesday);
		this.times.push(this.venueInfo.wednesday);
		this.times.push(this.venueInfo.thursday);
		this.times.push(this.venueInfo.friday);
		this.times.push(this.venueInfo.saturday);
		this.times.push(this.venueInfo.sunday);*/
	},

	getDays: function() {
		var markup = "";
		var i = 0;
		for (i; i < this.times.length; i++) {
			if(this.times[i] != "" && this.times[i] != undefined) {
				if(i == (this.times.length - 1)) {
					markup += '<li class="last">' +
							'<p class="day">' + this.days[i] + '</p>' +
							'<p class="time">' + this.times[i] + ' Uhr</p>' +
						'</li>';
				} else {
					markup += '<li>' +
								'<p class="day">' + this.days[i] + '</p>' +
								'<p class="time">' + this.times[i] + ' Uhr</p>' +
							'</li>';
				}
			}
		}
		return markup;
	},

	setServices: function() {
		this.services = [];
	},

	getServices: function() {
		var services = "";
		var i = 0;
		for (i; i < this.services.length; i++) {
			if( i != (this.services.length - 1)) {
				services += this.services[i] + ", ";
			} else {
				services += this.services[i];
			}
		}
		return services;
	},

	getId: function(){

		//console.log("this.venueInfo", this.venueInfo.id);
		var id = 2;
		return id;
	},

	getHeaderInfo: function() {

		var html = "";
		if(this.venueInfo.name != undefined){
			html += '<p class="name">'+this.venueInfo.name+'</p>';
		}
		if(this.venueInfo.location.address != undefined){
			html += '<p class="address">'+this.venueInfo.location.address+'</p>';
		}
		if(this.venueInfo.location.city != undefined){
			html += '<p class="city">'+this.venueInfo.location.city+'</p>';
		}
		if(this.venueInfo.location.state != undefined){
			html += '<p class="state">'+this.venueInfo.location.state+'</p>';
		}
		if(this.venueInfo.location.postalCode != undefined){
			html += '<p class="postalCode">'+this.venueInfo.location.postalCode+'</p>';
		}
		
		html += '<div class="pictureholder"></div>';
		
		return html;
	},

	getLatitude: function() {
		return this.venueInfo.location.lat;
	},

	getLongitude: function() {
		return this.venueInfo.location.lng;
	},

	clear: function() {
		this.venueInfo = null;
		this.times = [];
		this.services = [];
	}
});
