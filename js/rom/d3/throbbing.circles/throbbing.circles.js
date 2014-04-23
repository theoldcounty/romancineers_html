$(document).ready(function() {
					

			(function( $ ){
				var methods = {
					el: "",
					init : function(options) {
						//var clone = jQuery.extend(true, {}, options["data"]);
						
						methods.el = this;			
						methods.setup(options["data"], options["width"], options["height"]);
					},
					setup: function(data, w, h){
                        
                        var selector = methods.el["selector"];
                        
                        var padding = 20;
                       
						var chart = d3.select(selector).append("svg:svg")
							.attr("class", "chart")
							.attr("width", w)
							.attr("height", h)
						.append("svg:g")
							.attr("class", "throbbingchart")
							.attr("transform", "translate(10,10)")
                        
						console.log("data", data);
							

						//_place holder for markers
						var circleGroup = chart.append("g")
							.attr("class", "circles");
							
							console.log("circleGroup", circleGroup);
							
							circleGroup.selectAll("circle")
							.data(data)
							.enter().append("circle")
							.style("stroke", "gray")
							.style("fill", "#f25c19")
							.attr("r", function(d){
								return d.value*.2;//scale the circles
							})
							.attr("cx", function(d){
								return d.xcoord;
							})
							.attr("cy", function(d){
								return d.ycoord;
							});
							
							
						 //_place holder for rings								
						 var speedLineGroup = chart.append("g")
							 .attr("class", "speedlines");


						function getDurationPerDot(circleData){
							var totalTime = 3000;//3 seconds max
							var time = totalTime-(circleData.alarmLevel*10)
							return time;
						}

						function getOuterRadiusPerDot(circleData){
							var radius = circleData.alarmLevel*.5;
							return radius;
						}                        

						/*
						$.each(data, function( index, value ) {
							$('.throbdata').append("<li>dot:"+index+" , alarm val :"+value.alarmLevel+" , orb size :"+value.value+", Duration: "+getDurationPerDot(value)+"</li>");
						});  */                                             

						//invoke rings
						makeRings()



						//window.setInterval(makeRings, 1000);

						function makeRings() {
							var datapoints = circleGroup.selectAll("circle");
							
							
							
							var radius = 1;
						  
								function myTransition(circleData){
									
									var transition = d3.select(this).transition();
										
										var duration = getDurationPerDot(circleData);
										var outerRadius = getOuterRadiusPerDot(circleData);

										speedLineGroup.append("circle")
											.attr({
												"class": "ring",
												"fill":"#f25c19",
												"stroke":"#f25c19",
												"stroke-width": 1.5,
												"cx": circleData.xcoord,
												"cy": circleData.ycoord,
												"r":radius,
												"opacity": 0.35,
												"fill-opacity":0.35
											})
											.transition()
											.duration(6000)
											.attr("r", radius + outerRadius )
											.attr("opacity", 0)
											.remove();
								 
									var t= setInterval(function(){
										clearInterval(t);
										myTransition(circleData)
									},700);
									 
									//transition.each('end', myTransition);
								}
						  
						  datapoints.each(myTransition);
						}
					}
				};

				$.fn.throbbing = function(methodOrOptions) {
					if ( methods[methodOrOptions] ) {
						return methods[ methodOrOptions ].apply( this, Array.prototype.slice.call( arguments, 1 ));
					} else if ( typeof methodOrOptions === 'object' || ! methodOrOptions ) {
						// Default to "init"
						return methods.init.apply( this, arguments );
					} else {
						$.error( 'Method ' +  methodOrOptions + ' does not exist' );
					}    
				};

			})(jQuery);
		
		
		
		
			
			// make a dummy data set
			w = 120;
			h = 120;
			
			function getRandomInt (min, max) {
				return Math.floor(Math.random() * (max - min + 1)) + min;
			}
			
			var dataset = [],
			i = 0;    
			for(i=0; i<4; i++){
				var locale = {
					"xcoord": getRandomInt (w/8, w/2),
					"ycoord": getRandomInt (h/8, h/2),
					"value": 30,//getRandomInt (10, 100),
					"alarmLevel": getRandomInt (0, 200)
				}
				dataset.push(locale);
			}       
			//__ make dummy data
			
			
			
				//__invoke throbbing
				$('[data-role="throbbing"]').each(function(index) {
					var selector = "throbbing"+index;
					
					$(this).attr("id", selector);
					
					var options = {
						data: dataset,
                        width: $(this).data("width"),
                        height: $(this).data("height")
					}
					
					$("#"+selector).throbbing(options);
				});
			
			

});
