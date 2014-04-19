var GoogleMaps = Backbone.View.extend({
	events: {
		"click [data-id='reset-button']": "onResetButtonClick",
		"click [data-id='search-button']": "onSearchButtonClick"
	},

	actionUrl: '',
	$searchForm: null,
	$searchTextfield: null,
	$queryFoursquarefield: null,
	$searchButton: null,
	map: null,
	autocomplete: null,
	geocoder: null,
	venueOverlays: [],
	currentClickedMarker: null,
	prevClickedMarker: null,
	filters: null,
	$defaultInputFields: {},

	options: {
		zoomLevel: 13,
		defaultCountry: new google.maps.LatLng(51.524846, -0.127459) //london
		//defaultCountry: new google.maps.LatLng(51, 9) //germany
	},

	autocompleteOptions: {
		types: ['geocode'],
		componentRestrictions: {}//country: 'DE'
	},

	googleMapOptions: {
		zoom: 6,
		panControl: false,
		mapTypeControl: false,
		streetViewControl: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.LARGE,
			position: google.maps.ControlPosition.RIGHT_CENTER
		},
		styles: [
			{
				featureType: "poi.attraction",
				stylers: [
					{ visibility: "off" }
				]
			},{
				featureType: "poi.business",
				stylers: [
					{ visibility: "off" }
				]
			},{
				featureType: "poi.government",
				stylers: [
					{ visibility: "off" }
				]
			},{
				featureType: "poi.place_of_worship",
				stylers: [
					{ visibility: "simplified" }
				]
			},{
				featureType: "poi.sports_complex",
				stylers: [
					{ visibility: "simplified" }
				]
			}
		]
	},

	setUsers: function(){
		var that = this;
		//set user
		$("#googleMapData .user-option").each(function( index ) {
			that.setUserMarker($(this).data('user-lat'), $(this).data('user-long'));
		});
	},


	setUserMarker: function(latitute, longitute){
		var image = 'images/googlemaps/usermarker.png';
		var myLatLng = new google.maps.LatLng(latitute, longitute);

		var marker = new google.maps.Marker({
			position: myLatLng,
			map: this.map,
			icon: image
		});
	},
		
	getVenueListTemplate: function(){
		return $('.venue-list li').eq(0).clone();
	},

	initialize: function() {
		var that = this;

		this.temp = this.getVenueListTemplate();
		
		//setup height of googlemap
		
		var windowHeight = $(window).height();
		
		var headerHeight = $('header').height();
		var footerHeight = $('footer').height();
		
		var remainingMapArea = windowHeight - headerHeight - footerHeight;
		
		$('.googlemaps').css("height", remainingMapArea);
		
		$('.venue-list-container').css("height", parseInt($('.venue-list-container').height() - $('.control-container').height(), 10));
		
		this.$searchForm = this.$el.find("#searchForm");
		this.$searchTextfield = this.$searchForm.find(".search-textfield");

		this.$queryFoursquarefield = this.$searchForm.find("#queryFoursquare");
		
		function suggest(val){
			foursquareApi.suggestCompletion(val, function(d){				
				if(d.response.minivenues != undefined){
					var suggestions = new Array();				
					$.each(d.response.minivenues, function( key, value ) {
						suggestions.push(value.name)
					});
					
					var suggestions = suggestions.map(function(value) {
						return value.toLowerCase();
					});
					
					var suggestions = _.uniq(suggestions);
					function toTitleCase(str){
						return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
					}
					
					var suggestions = suggestions.map(function(value) {
						return toTitleCase(value);
					});
					
					autocomplete.newSource(that.$queryFoursquarefield[0], suggestions);
				}
			});		
		}
		
		
		this.$queryFoursquarefield.keyup(function(){
			var val = $(this).val();
			//suggest(val);
		});
		
		this.clearSearchTextfield();
		$searchButton = this.$searchForm.find("input[type='button']");

		//this.actionUrl = this.$searchForm.attr('action');
		//this.actionUrl = "temp/json/searchGoogleMaps.json";

		this.$defaultInputFields = {
			latitude: this.$el.find('[name=latitude]'),
			longitude: this.$el.find('[name=longitude]'),
			searchField: this.$el.find('[name=searchfield]')
		};

		//if browser supports geolocation show location button
		if(Modernizr.geolocation) {
			//this.showLocateButton();
		}

		this.createGoogleMap();
		this.tryGeoLocation();
		this.bindEvents();
		this.setUsers();
	},

	showLocateButton: function() {
		//this.$el.find(".link-locate").css("display", "block");
	},

	createGoogleMap: function() {
		this.map = new google.maps.Map(document.getElementById("map_canvas"), this.googleMapOptions);
		
		this.geocoder = new google.maps.Geocoder();
		//autocompletion drop down
		this.autocomplete = new google.maps.places.Autocomplete(this.$searchTextfield[0], this.autocompleteOptions);
	},

	autoCenterMapFocus: function(latitude, longitude){
		var self = this;

		initialLocation = new google.maps.LatLng(latitude, longitude);
		self.map.setZoom(self.options.zoomLevel);
		self.map.setCenter(initialLocation);

		self.sendSearchRequestToService();
	},

	bindEvents: function() {
		var self = this;

		$("#searchTextField").on("click", function(event){
			//console.log("clicked on search field");
			$(".user-option").removeClass("selected").addClass("unavailable");
			$("#searchTextField").removeClass("disabled");
		});
		

		this.$searchTextfield.bind("keypress", _.bind(this.onEnterInSearchTextfield, this));
		google.maps.event.addListener(this.autocomplete, 'place_changed', _.bind(this.onAutoCompletePlaceChange, this));
		//$(document).bind(VenueFilter.updateFilterEvent, _.bind(this.onFilterUpdate, this));

		$(".user-option").on("click", function(event){
			event.preventDefault();
			
			$(".user-option").removeClass("selected").removeClass("unavailable");
			$(this).addClass("selected");
			
			$("#searchTextField").addClass("disabled");
			
			//get data and switch the attention to this user.
			//set user			
			self.autoCenterMapFocus($(this).data('user-lat'), $(this).data('user-long'));
		});
	},

	onFilterUpdate: function(event, filters) {
		this.filters = filters;
		this.sendSearchRequestToService();
	},

	tryGeoLocation: function() {
		var self = this;
		//test for geolocation if it is available and user agrees then use geolocation otherwise set default value
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				self.map.setZoom(self.options.zoomLevel);
				self.map.setCenter(initialLocation);
				self.setData(position.coords.latitude, position.coords.longitude);
				self.sendSearchRequestToService();
			}, this.handleNoGeolocation(), {enableHighAccuracy: true, maximumAge: 1000});
		} else {
			this.handleNoGeolocation();
		}
	},

	handleNoGeolocation: function() {
		//google map has to be set to center once
		if(this.map.getCenter() == undefined) {
			this.map.setCenter(this.options.defaultCountry);
		}
	},

	onEnterInSearchTextfield: function(event) {
		//listen to key ENTER and trigger click to search for place
		if(event.which == 13 && this.getSearchTextValue() != "") {
			event.preventDefault();
			$searchButton.trigger("click");
		} else if (event.which == 13 && this.getSearchTextValue() == "") {
			event.preventDefault();
		}
	},

	onSearchButtonClick: function(event) {
		event.preventDefault();
		//console.log("clicked on button");
		
		if(this.getSearchTextValue() != "") {
			this.geocoder.geocode({
				'address': this.getSearchTextValue(),
				'region': 'de'
			}, _.bind(this.onGeocodeResponse, this));
		}
	},

	onGeocodeResponse: function(results, status) {
		if(status == google.maps.GeocoderStatus.OK) {
			var formattedAddress = results[0].formatted_address;
			//controls whether search result contains germany
			if(formattedAddress.indexOf("Germany") != -1 || formattedAddress.indexOf("Deutschland") != -1){
				//TODO show layer that user is not in germany
			}
			this.map.setZoom(this.options.zoomLevel);
			this.map.setCenter(results[0].geometry.location);
			this.setData(results[0].geometry.location.lat(), results[0].geometry.location.lng());
			this.sendSearchRequestToService();
		}
	},

	onResetButtonClick: function(event) {
		event.preventDefault();
		if(this.getSearchTextValue() != "") {
			this.clearSearchTextfield();
		}
	},

	clearSearchTextfield: function() {
		this.$searchTextfield.val("");
	},

	onLocateButtonClick: function(event) {
		event.preventDefault();
		this.tryGeoLocation();
	},

	onAutoCompletePlaceChange: function() {
		var place = this.autocomplete.getPlace();
		if(place.geometry != undefined) {
			//viewport = The bounds of the recommended viewport for displaying this GeocodeResult
			//fitBounds = Sets the viewport to contain the given bounds
			if (place.geometry.viewport) {
				this.map.fitBounds(place.geometry.viewport);
			} else {
				this.map.setCenter(place.geometry.location);
				this.map.setZoom(this.options.zoomLevel);
			}
			this.setData(place.geometry.location.lat(), place.geometry.location.lng());
			this.sendSearchRequestToService();
		}
		var address = '';
		if (place.address_components) {
			address = [(place.address_components[0] && 				/* NO JS  subexpression should be wrapped in parens */
				place.address_components[0].short_name || ''),
				(place.address_components[1] &&						/* NO JS  subexpression should be wrapped in parens */
				place.address_components[1].short_name || ''),
				(place.address_components[2] &&						/* NO JS  subexpression should be wrapped in parens */
				place.address_components[2].short_name || '')
				].join(' ');
		}
	},

	populateVenueList: function(venues){
		var that = this;
		
		console.log("pop venue list", venues);
		
		$('[data-custom-scroller="true"]').each(function(index) {
			mcustomscroller.destroy($(this));
		});
		
		function bindVenues(venueArray, temp){
			$.each(venueArray, function(index, value) {
				$('.venue-list').append(that.buildItem(index, value, temp));

				if(index == venueArray.length-1){
					$('[data-custom-scroller="true"]').each(function(index) {
						mcustomscroller.init($(this));
					});	
				}
			});
		}

		$('.venue-list').empty();
		var temp = that.temp;
		
		bindVenues(venues, temp);
		
		$(".venue-list li").on("click",function(e){
			e.preventDefault();
			that.selectItem(this);
		});		
		
		/*
		var venueIdArray = new Array();
		$.each(venues, function(index, value) {
			venueIdArray.push(value.id);
		});
		$.each(venueIdArray, function(index, value) {
			foursquareApi.exploreVenue(value, function(data){
				$('.venue-list').append(that.buildItem(index, data.response.venue, temp));
				
				if(index == venueIdArray.length-1){
					$('[data-custom-scroller="true"]').each(function(index) {
						mcustomscroller.init($(this));
					});	
				}
			});
		});
		*/
	
	},
	
	selectItem: function(el){
		var that = this;
		$(".venue-list li").removeClass("selected");
		$(el).addClass("selected");
		
		var venueId = $(el).find('.venue-title').data("venue-id");
		//.venue-list li
		
		//find relevant marker and highlight it.
		
		for (var i = 0; i < that.venueOverlays.length; i++) {
		
			var markerVenueId = that.venueOverlays[i].options.venueInfo.id;
			
			if(markerVenueId == venueId){
				google.maps.event.trigger(that.venueOverlays[i].marker, 'click');
				break;
			}
		}		
		
	},
	
	buildItem: function(index, data, temp){
        var that = this;   
        
		console.log("data", data);
		
        var template = temp.clone();
        $(template).find('.venue-number').text(index+1+".");
		$(template).find('.venue-title').text(data.name);
		$(template).find('.venue-title').attr("data-venue-id", data.id);
		
		/*
		if(data.rating != undefined){
			$(template).find('.venue-rating').text(data.rating);
		}{
			$(template).find('.venue-rating').text(0);
		}*/
		
		var location = "";		
		if(data.location.address != undefined){
			location += data.location.address;
		}
		
		$(template).find('.venue-address').text(location);
		
		/*
		if(data.photos.groups.length >0){
			var venueimage = data.photos.groups[0].items[0];
			var venueimageurl = venueimage.prefix+"80x80"+venueimage.suffix;
			$(template).find('.venue-image').html('<img src="'+venueimageurl+'">');
		}else{
			$(template).find('.venue-image').empty();
		}*/
		
		/*
		$(template).find('.venue-tips').empty();
		if(data.tips.groups.length > 0){
			$.each(data.tips.groups[0].items, function(i, v) {
				$(template).find('.venue-tips').append('<li>'+v.text+'</li>');

				if(i>2){
					return false;
				}
			});
		}
		*/
		
		$(template).wrapAll("<li/>");
		
        return $(template);
    },

	sendSearchRequestToService: function() {
		this.clearAllMarker();

		var c = this.map.getCenter();
		var query = this.$queryFoursquarefield.val();
		
		//choose first autocomplete string
		if(!query){
			query = this.$queryFoursquarefield.data("availabletags").split(",")[0];
		}
		var query = query.replace(" ","%20");

		var queryObject = {
			q: query,
			lat: c.lat(),
			lng: c.lng()
		};

		var that = this;
		foursquareApi.explore(queryObject, function(venues){
			console.log("venues found", venues);
			
			that.onServiceSuccess(venues);
			that.populateVenueList(venues);
			
			var globalBoolean = false;			
			console.log("this.venueOverlays", that.venueOverlays);
			for (var i = 0; i < that.venueOverlays.length; i++) {
				var pos = that.venueOverlays[i].marker.getPosition();
				var onMap = that.map.getBounds().contains(pos);
				
				globalBoolean = onMap;
				
				if(onMap){
					break;
				}
			}
			
			//no flags can be seen on the map - maybe zoom out.
			if(!globalBoolean){
				that.map.setZoom(that.options.zoomLevel - 4);
			}			
		});
	},

	onJSONPLoad: function(data) {
	},

	clearAllMarker: function() {
		if(this.venueOverlays.length > 0) {
			$(this.venueOverlays).each(function(index, venueOverlay){
				venueOverlay.clearVenueOverLayer();
				venueOverlay = null;
			});
		}
		this.venueOverlays = [];
	},

	//create post parameters
	getFormSerialization: function() {
		var serializationString = "";
		serializationString = this.$searchForm.serialize();
		if(this.filters && !$.isEmptyObject(this.filters)) {
			serializationString = serializationString + "&" + $.param(this.filters);
		}
		return serializationString;
	},

	//create symbols and set them on the map
	onServiceSuccess: function(data) {

		var self = this;
		$.each(data, function(index, venue) {
			//console.log("venue", venue);
			var venueOverlay = new VenueOverlay({venueInfo: venue});
			venueOverlay.setMap(self.map);
			venueOverlay.on(VenueOverlay.ClickOnMarkerEvent, _.bind(self.onMarkerClicked, self));
			self.venueOverlays.push(venueOverlay);
		});

	},

	onServiceError: function(xhr, ajaxOptions, thrownError) {
		//console.log("xhr", xhr);
		//console.log("ajaxOptions", ajaxOptions);
		//console.log("thrownError", thrownError);
	},

	onMarkerClicked: function(marker) {
		var that = this;
		
		var venueId = marker.venueInfoVO.venueInfo.id;
		console.log("venueId", venueId);
		
		function reverseLookup(venueId){
			$(".venue-list li").removeClass("selected");
			$(".venue-list li").find('[data-venue-id="'+venueId+'"]').closest("li").addClass("selected");
			$(".venue-list").mCustomScrollbar("scrollTo",".selected");
		}
		reverseLookup(venueId);
		//console.log("marker", marker);
		
		if(venueId){
			foursquareApi.exploreVenue(venueId, function(data){
			
				var theVenue = data.response.venue;
				setInfoWindow(theVenue);
				
				function setInfoWindow(theVenue){
						//set photo on info window
						if(theVenue.photos.count > 0){
							var firstImage = theVenue.photos.groups[0].items[0];
							var image = '<img src="'+firstImage.prefix+'75x75'+firstImage.suffix+'">';
							$('.info-window .pictureholder').empty().html(image);
						}

						//set events
						foursquareApi.viewEvents(theVenue.id, function(data){
							//console.log("data",data);
							var setOfEvents = data.response.events.items;
							$.each(setOfEvents, function(index, value) {

								//console.log("all day val", value.allDay);
								//console.log("name val", value.name);

								//console.log("startAt val", value.startAt);
								//console.log("endAt val", value.endAt);

								var times = "";

								if(value.allDay){
									times = "All Day";
								}else{
									times = foursquareApi.convertTimeStamp(value.startAt, true)+" to "+foursquareApi.convertTimeStamp(value.endAt, true);
								}
 

								var innterListItem = '<li>'+value.name+' - '+times+'</i>';
								$('#venue #events').append(innterListItem);
							});
						});					
				}				
			});
		}

		if(this.currentClickedMarker) {
			this.prevClickedMarker = this.currentClickedMarker;
		}
		this.currentClickedMarker = marker;

		if(this.prevClickedMarker && this.prevClickedMarker != this.currentClickedMarker) {
			this.prevClickedMarker.closeInfoBox();
		}
	},

	//set values for input fields
	setData: function(lat, lnt) {
		this.$defaultInputFields.latitude.val(lat);
		this.$defaultInputFields.longitude.val(lnt);

		if(this.getSearchTextValue() != "") {
			this.$defaultInputFields.searchField.val(this.getSearchTextValue());
		}
	},

	getSearchTextValue: function() {
		return this.$searchTextfield.val();
	}

});
