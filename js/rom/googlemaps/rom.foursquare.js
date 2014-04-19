
		var foursquareApi = {
			clientId: "KYXSQGDXTGZ4R0MKHKUJEVILXV4IDZGZN0EF5ZVZANTNAGLB",
			clientSecret: "4AGCLBK4N425Y3UY4QQA5SYTP555SBK5TBB3K33A4ABH2WJ4",
			oauth_token:"5BEUWLP13HU3XWQD5VSFPOINAMGK2R5FQS4HMX0OXWHE5H0U",
			code: "HQEV3FJDFEZXOUHWSATSNUNH1ZF5NNUFAHBCY0Y3ZPJ0RRNM",
			redirectUrl : "http://localhost/foursquare/",
			authorize: function(){
				var url = "https://foursquare.com/oauth2/access_token";
					url += "?client_id="+this.clientId;
					url += "&client_secret="+this.clientSecret;
					url += "&grant_type=authorization_code";
					url += "&redirect_uri="+this.redirectUrl;
					url += "&code="+this.code;

					this.getJson(url, function(data){
						//console.log("authorize",data);
					})
			},
			getCode : function(){
				var url = "https://foursquare.com/oauth2/authenticate";
					url += "?client_id="+this.clientId;
					url += "&response_type=code";
					url += "&redirect_uri="+this.redirectUrl;
					this.getJson(url, function(data){
						////console.log("code",data);
					})

			},
			getJson: function(url, callback){
				$.ajaxSetup({ cache: false });
				$.get(url, function(data) {
					callback(data);
				}, 'jsonp');
			},
			getPhoto: function(prefix, url){
				return url.replace("original",prefix);
			},
			bindTrendEvent: function(){
				var that = this;
				$("a.trendlist").on("click", function(event){
					event.preventDefault();
					var venueId = $(this).data("venueid");
					that.exploreVenue(venueId);
				});
			},
			bindSearchEvent: function(){
				var that = this;
				$("a.searchlist").on("click", function(event){
					event.preventDefault();
					var venueId = $(this).data("venueid");
					that.exploreVenue(venueId);
				});
			},
			bindVenueEvent: function(){
				var that = this;
				$("#venue button").on("click", function(event){
					event.preventDefault();
					var venueId = $("#venue").data("venueId");
					that.markToDo(venueId);
				});
			},
			convertTimeStamp: function(unix_timestamp, withTime){
				var d = new Date(unix_timestamp*1000);
				var dateCombination = d.toDateString(); 
				
				if(withTime){
					dateCombination += d.toLocaleTimeString(); 
				}
				
				return dateCombination;
			},
			explore: function(queryObj, callback){

				var query = queryObj.q;
				var location = queryObj.lat+","+queryObj.lng; //london, shaftesbury avenue

				var limit = 50;

				var that = this;

				var url = "https://api.foursquare.com/v2/venues/explore?ll="+location+"&query="+query+"&limit="+limit+"&oauth_token="+this.oauth_token+"&v=20140308";
				console.log(url);
				
				this.getJson(url, function(data){
					//var setOfVenues = "";
					console.log("data.response.venues", data.response.venues);
					
					console.log("data.response", data.response.groups[0].items);
					
					var venueArray = new Array();
					if(data.response.groups[0].items != undefined){
						$.each(data.response.groups[0].items, function( index, value ) {
							venueArray.push(value.venue);
						});
					}
					
					callback(venueArray);
				});
				
			},
			search: function(queryObj, callback){

				var query = queryObj.q;

				//var location = "40.7,-74"; //chicago
				var location = queryObj.lat+","+queryObj.lng; //london, shaftesbury avenue
				//var location = "29.43601,106.503525"; //china
				//var location = "51.165691,10.451526"; //germany

				//console.log("query", query);
				//console.log("location", location);

				//this.viewTrends(location);

				var limit = 50;

				var that = this;

				var url = "https://api.foursquare.com/v2/venues/search?ll="+location+"&query="+query+"&limit="+limit+"&oauth_token="+this.oauth_token+"&v=20140308";
				this.getJson(url, function(data){
					var setOfVenues = "";


					/*
					if(data.response.groups != undefined){
						setOfVenues = data.response.groups[0].items;
					}*/
					
					
					if(data.response.venues != undefined){
						setOfVenues = data.response.venues;
					}
					
					
					
					//console.log("setOfVenues", setOfVenues);
					
					callback(setOfVenues);

					/*
					var template = '<ul id="searchResults"></ul>';
					$('body').append(template);

					googlemaper.clearMarkers();

					$.each(setOfVenues, function(index, value) {

						var icon = "http://www.google.com/earth/outreach/images/icon_map.jpg"; //default icon

						if(value.categories.length > 0){
							$.each(value.categories[0].parents, function(i, v) {
								var catergory = v;
								catergory = catergory.toLowerCase();
								catergory = catergory.replace("&","");
								catergory = catergory.replace(" ","_");
								catergory = catergory.replace(/\s+/g, "");

								//console.log("catergory ",catergory);
							});

							icon = value.categories[0].icon;
						}

						//console.log("value.id", value.id);

						var locations = [
								[value.name, value.location.lat, value.location.lng, 4, icon, value.id]
							];
						googlemaper.setVenueMarkers(googlemaper.map, locations);

						var innterListItem = '<li><a class="searchlist" data-venueid="'+value.id+'" href="#">'+value.name+' - '+value.id+'</a></i>';
						$('#searchResults').append(innterListItem);
					});
					that.bindSearchEvent();*/
				});
			},
			viewTrends: function(location){

				var that = this;

				//var location = "44.3,37.2";
				var limit = 150;
				var radius = 6000 ;

				//&limit="+limit+"&radius="+radius+"

				var url = "https://api.foursquare.com/v2/venues/trending?ll="+location+"&oauth_token="+this.oauth_token+"&v=20140308";
				this.getJson(url, function(data){
					var setOfVenues = data.response.venues;
					var template = '<ul id="trendResults"></ul>';
					$('body').append(template);

					//console.log("getting trends", data);



					$.each(setOfVenues, function(index, value) {
						var innterListItem = '<li><a class="trendlist" data-venueid="'+value.id+'" href="#">'+value.name+' - '+value.id+'</a></i>';
						$('#trendResults').append(innterListItem);
					});
					that.bindTrendEvent();
				});

			},
			viewEvents: function(venueId, callback){

				var url = "https://api.foursquare.com/v2/venues/"+venueId+"/events?oauth_token="+this.oauth_token+"&v=20140308";
				this.getJson(url, function(data){
					////console.log("getting events", data);

					callback(data);
					/*
						var setOfEvents = data.response.events.items;
						//var template = '<ul id="eventResults"></ul>';
						//$('body').append(template);

						$.each(setOfEvents, function(index, value) {
							//var innterListItem = '<li><a class="trendlist" data-venueid="'+value.id+'" href="#">'+value.name+' - '+value.id+'</a></i>';
							//$('#eventResults').append(innterListItem);
						});
						//that.bindTrendEvent();
					*/
				});

			},
			suggestCompletion: function(input, callback){
				//ll=51.529622428012544,-0.1381740757634631&
				//venues/
				var locale = "intent=global";
				var url = "https://api.foursquare.com/v2/venues/suggestCompletion?"+locale+"&query="+input+"&oauth_token="+this.oauth_token+"&v=20140308";
				
				var that = this;
				this.getJson(url, function(data){
					callback(data);
				});
			},
			exploreVenue: function(venueId, callback){
				var url = "https://api.foursquare.com/v2/venues/"+venueId+"?oauth_token="+this.oauth_token+"&v=20140308";

				var that = this;
				this.getJson(url, function(data){
					callback(data);
				});
			},
			markToDo: function(venueId){
				//https://api.foursquare.com/v2/venues/4d825176bede5481abdd0fd1/marktodo
			},
			myFoursquareReplaceSave: function(foursquareObj) {

				var vcartTitle = "hcard-"+foursquareObj.id;
				var vcard = '<div id="'+vcartTitle+'" class="vcard"><span class="fn"><span class="given-name">'+foursquareObj.name+'</span></span><div class="adr"><div class="street-address">'+foursquareObj.streetAddress+'</div><span class="locality">'+foursquareObj.locality+'</span><span class="region">'+foursquareObj.region+'</span><span class="postal-code">'+foursquareObj.postCode+'</span></div></div>';
				var fourSquareButton = '<a href="https://foursquare.com/intent/venue.html" class="fourSq-widget" data-context="'+vcartTitle+'" data-variant="wide">Save to foursquare</a>';

				$('#foursquare').empty().html(vcard+fourSquareButton);
				this.startWidget();
			},
			init: function(){

				var query = "cinema";
				//var query = "clubbing";
				//var query = "pub";
				//var query = "restaurant";
				//var query = "mcdonald";

				this.search(query);
			},
			startWidget: function(){
				window.___fourSq = {};
				var s = document.createElement('script');
				s.type = 'text/javascript';
				s.src = 'http://platform.foursquare.com/js/widgets.js';
				s.async = true;
				var ph = document.getElementsByTagName('script')[0];
				ph.parentNode.insertBefore(s, ph);
			}
		};
