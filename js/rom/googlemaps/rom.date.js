

//rom.date.js

var date ={
	init: function(){
		this.invokeVenue();
		this.invokeCandidate();
	},
	invokeVenue: function(){

		var venueId = $("#date").data("venue-id");

		console.log("venueId time to go for it", venueId);
		foursquareApi.exploreVenue(venueId, function(data){

				function setDateWindow(theVenue){
					console.log("theVenue", theVenue);
					
					
					//set image map
					var marker = "";//"http://tinyurl.com/2ftvtt6";
					var latitude = theVenue.location.lat;
					var longitude = theVenue.location.lng;
					var googleMap = '<img src="http://maps.google.com/maps/api/staticmap?center='+latitude+','+longitude+'&zoom=16&markers=icon:'+marker+'|'+latitude+','+longitude+'&size=768x768&sensor=true">';
					$('#date .venue-map').html(googleMap);
					
					//set details
					$('#date .venue-name').html(theVenue.name);
					
					var location = "";
					if(theVenue.location.address != undefined){
						location+= theVenue.location.address+"<br>";
					}
					if(theVenue.location.city != undefined){
						location+= theVenue.location.city+"<br>";
					}
					if(theVenue.location.country != undefined){
						location+= theVenue.location.country+"<br>";
					}
					if(theVenue.location.postalCode != undefined){
						location+= theVenue.location.postalCode+"<br>";
					}

					$('#date .venue-location').html(location);
					
					
					
					//set rating
					$('#date .venue-rating .knob').data("value", theVenue.rating).empty();
					$('[data-role="doughnut-knob"]').each(function() {
						doughnutKnobHandler.invoke($(this));
					});
					
					//set photos
					var venueAlbums = theVenue.photos.groups;
					var album = "";
					var size = "200x200";
					$.each(venueAlbums, function(index, value) {
						$.each(value.items, function(i, v) {
							album += '<li><img src="'+v.prefix+size+v.suffix+'"></li>';
						});
					});
					$('#date .venue-image').empty().html(album);
					
					

					var venueTips = theVenue.tips.groups;
					var tips = "";
					$.each(venueTips, function(index, value) {

						//console.log("value",value);

						//loop over items
						$.each(value.items, function(index, v) {
							tips += '<li>'+v.text+'</li>';
						});
					});
					$('#date .venue-feedback').empty().html(tips);
					

					//set events
					foursquareApi.viewEvents(theVenue.id, function(d){
						var venueEvents = d.response.events.items;
						var eventList = "";
						
						$.each(venueEvents, function(index, value) {
							
							var name = value.name;
							var date = foursquareApi.convertTimeStamp(value.date, false);

							var times = "";

							if(value.allDay){
								times = "All Day "+ date;
							}else{
								times = foursquareApi.convertTimeStamp(value.startAt, true)+" to "+foursquareApi.convertTimeStamp(value.endAt, true);
							}

							eventList += '<li><input type="radio" name="event" value="'+name+'"><b>'+name+'</b> ('+times+')</li>';
						});
						
						$('#date .venue-event-list').empty().html(eventList);
						
						if(venueEvents.length < 1){
							$('#date .venue-event').remove();//no events remove section
						}
						
						$('#date .venue-event-list li').eq(0).find('[type="radio"]').click();//select first element.
						
						//event change
						var evenRadio = 'input[name="event"]';
						$('#date .event-name').text($(evenRadio+':checked').val());
						$(evenRadio).on("click",function(e){								
							$('#date .event-name').text($(evenRadio+':checked').val());
						});
						
						mcustomscroller.init($('.venue-event-list'));
						
						setTimeout(function(){
							$('#dating .dating-holder').animate({
								opacity: 1,
							}, 500, function() {
								// Animation complete.
							});
						},500);						
						
					});
				}

				var theVenue = data.response.venue;

				$('[data-custom-scroller="true"]').each(function(index) {
					mcustomscroller.destroy($(this));
				});

				setDateWindow(theVenue);
				
				
				$('[data-custom-scroller="true"]').each(function(index) {
					mcustomscroller.init($(this));
				});


		});
		
		$('button[name="scheduledate"]').click(function(e) {
			e.preventDefault();
			
			console.log("ready for next step");
			
			tabs.enableTab($("#dating"), 1);
			tabs.activeTab($("#dating"), 1);
			tabs.disableTab($("#dating"), 0);
		});

		$('input[name="submitdate"]').click(function(e) {
			e.preventDefault();
			
			console.log("ready to make it real");
			
			tabs.enableTab($("#dating"), 2);
			tabs.activeTab($("#dating"), 2);
			tabs.disableTab($("#dating"), 1);
		});		

	},
	invokeCandidate: function(){
		var candidateId = $("#date").data("recepientuid");
		console.log("candidateId", candidateId);
	}
}
