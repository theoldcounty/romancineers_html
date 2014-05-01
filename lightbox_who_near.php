
<?php 
	//include "includes/header.php";
?>

	<style type="text/css">
				.whoisnear-container{
					height: 500px;
					width: 1200px;
					background: red;
					overflow:hidden;
				}
				
				.allowoverflow{
					overflow:hidden!important;
				}
				
			#nearmemap {
				height: 100%;
				width: 100%;
				margin: 0;
				padding: 0;
				background: blue;
			}

			.stations, .stations svg {
			  position: absolute;
			}

			.stations svg {
			  width: 60px;
			  height: 20px;
			  padding-right: 100px;
			  font: 10px sans-serif;
			}

			.stations circle {
			  fill: brown;
			  stroke: black;
			  stroke-width: 1.5px;
			}

				</style>
		<div class="whoisnear-container">
			




			<style type="text/css">.gm-style .gm-style-mtc label,.gm-style .gm-style-mtc div{font-weight:400}</style><style type="text/css">.gm-style .gm-style-cc span,.gm-style .gm-style-cc a,.gm-style .gm-style-mtc div{font-size:10px}</style><link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700"><style type="text/css">@media print {  .gm-style .gmnoprint, .gmnoprint {    display:none  }}@media screen {  .gm-style .gmnoscreen, .gmnoscreen {    display:none  }}</style><style type="text/css">.gm-style{font-family:Roboto,Arial,sans-serif;font-size:11px;font-weight:400;text-decoration:none}</style>
				
						 
			 
				<div data-d3="googlenearme" id="nearmemap"></div>
				
				<script type="text/javascript">

			var googleThrobbingMarkers = {
				invoke: function(el, data){
					
					console.log("data", data);
					
					el.parent().parent().addClass("allowoverflow");
				

					// Create the Google Map
					var map = new google.maps.Map(el[0], {
						zoom: 11,
						center: new google.maps.LatLng(data[0].usercoordinates[0], data[0].usercoordinates[1]),
						mapTypeId: google.maps.MapTypeId.TERRAIN
					});

					var image = 'images/googlemaps/usermarker.png';
					var myLatLng = new google.maps.LatLng(data[0].usercoordinates[0], data[0].usercoordinates[1]);

					var beachMarker = new google.maps.Marker({
						position: myLatLng,
						map: map,
						icon: image
					});



					var overlay = new google.maps.OverlayView();

					// Add the container when the overlay is added to the map.
					overlay.onAdd = function() {
					var layer = d3.select(this.getPanes().overlayMouseTarget).append("div")
						.attr("class", "stations");

					// Draw each marker as a separate SVG element.
					// We could use a single SVG, but what size would it have?
					overlay.draw = function() {
					  var projection = this.getProjection(),
						  padding = 10;

					  var marker = layer.selectAll("svg")
						  .data(d3.entries(data[0].nearbyusers))
						  .each(transform) // update existing markers
						.enter().append("svg:svg")
						  .each(transform)
						  .attr("class", "marker");

						var iw = 200;
						var ih = 200;	


					 //_place holder for rings								
					 var speedLineGroup = marker.append("g")
						 .attr("class", "speedlines");
						 
					  // Add a circle.
					  marker.append("circle")
						  .attr("r", 15)
						  .attr("cx", iw/2)
						  .attr("cy", ih/2)
						  .attr("width", iw)
						  .attr("height", ih)
						.on("click", function(){
							d3.select(this)
							.style("fill","lightcoral")
							.style("stroke","red");
						})
						.on("mouseover", function () {
							d3.select(this)
							.style("fill","blue")
							.style("stroke","red");
						})
						.on("mouseout", function () {
							d3.select(this)
							.style("fill","black")
							.style("stroke","red");
						})	  
						  


						function getDurationPerDot(circleData){
							var totalTime = 1700;//3 seconds max
							var time = totalTime-(circleData.value.alarmLevel*15)
							return time;
						}

						function getOuterRadiusPerDot(circleData){
							var radius = circleData.value.alarmLevel*.9;
							return radius;
						}                        
													 

						//invoke rings
						makeRings()
						
						function myTransition(circleData){
							var radius = getOuterRadiusPerDot(circleData);
							var transition = d3.select(this).transition();
							
								speedLineGroup.append("circle")
									.attr({
										"class": "ring",
										"fill":"#f25c19",
										"stroke":"#f25c19",
										"stroke-width": 1.5,
										"cx": iw/2,
										"cy": ih/2,
										"r":1,
										"opacity": 0.45,
										"fill-opacity":0.45
									})
									.transition()
									.duration(6000)
									.attr("r", getOuterRadiusPerDot(circleData) )
									.attr("opacity", 0)
									.remove();
									
									callcircle(circleData, getDurationPerDot(circleData));
						}
						
						function callcircle(circleData, duration){
							
							var t = setInterval(function(){
								clearInterval(t);
								console.log("go");
								
								if(el.is(":visible")){
									myTransition(circleData);
								}
							},duration);						
						}
						
						function makeRings() {
							var datapoints = marker.selectAll("circle");
							
							var radius = 1;
							datapoints.each(myTransition);
						}


						  function transform(d) {
							var iw = 200;
							var ih = 200;
							
							
							d = new google.maps.LatLng(d.value.coordinates[0], d.value.coordinates[1]);
							d = projection.fromLatLngToDivPixel(d);
							return d3.select(this)
								.style("left", (d.x - iw/2) + "px")
								.style("top", (d.y - ih/2) + "px")
								.style("width", iw)
								.style("height", iw);
							
						  }
						};
					};

					overlay.setMap(map);	
				
				}
			}




			var data = [
				{
					"usercoordinates": [37.76487, -122.41948],
					"nearbyusers": [
						{
							"coordinates": [37.73487, -122.131948],
							"alarmLevel": 100
						},
						{
							"coordinates": [37.77487, -122.44948],		
							"alarmLevel": 1
						}
					]
				}
			];


			$(document).ready(function() {
				$(document).find('[data-d3="googlenearme"]').each(function(){
					googleThrobbingMarkers.invoke($(this), data);
				});
			});
			
			</script>

		</div>
		