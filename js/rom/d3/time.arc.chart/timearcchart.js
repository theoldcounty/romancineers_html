$(document).ready(function() {
					

			(function( $ ){
				var methods = {
					el: "",
					init: function(options){
						var clone = jQuery.extend(true, {}, options["data"]);	
						methods.oldData = methods.setData(clone);
						
						methods.el = this;
						methods.radius = options["width"]/2;
						
						methods.setup(clone, methods.setData(clone), options["width"], options["height"]);
					},					
					radius: 340,
					oldData: "",
					update: function(data){
						var clone = jQuery.extend(true, {}, data);
						
						//this.addLabel(clone);
						var preparedData = this.setData(clone);

						this.animate(preparedData);			
						this.oldData = preparedData;
					},
					animate: function(data){
						var that = this;
						
						var chart = d3.select(".arcchart");
						that.generateArcs(chart, data);
					},	
					setData: function(data){

						var diameter = 2 * Math.PI * this.radius;			
						var localData = new Array();
						
						var oldEndAngle = Math.PI;
						
						function getDateObj(date){                
							var dateParts = date.split("/");
							var timeParts = date.split(":");
							
							var year = dateParts[2].substr(0, 4);
							var month = dateParts[1];
							var day = dateParts[0];
											
							var hour = timeParts[0].substr(timeParts[0].length - 2);
							var minutes = timeParts[1];
							var seconds = timeParts[2];
											
							return new Date(year,month,day,hour,minutes,seconds);                
						}
						
						function getDifference(date1, date2){                
							var date1 = getDateObj(date1);
							var date2 = getDateObj(date2);                
							
							// Convert both dates to milliseconds
							var date1_ms = date1.getTime();
							var date2_ms = date2.getTime();
							
							// Calculate the difference in milliseconds
							return date2_ms - date1_ms;
						}
						
						
						//bridge gap
							//if this is session data - need to add the dips where there is a gap in data

						function bridgeGaps(data){
							var clone = jQuery.extend(true, {}, data);
							var gaps = new Array();
							
							$.each(data[0].segments, function(index, value) {
								var isValid = true;
								
								if(data[0].segments[index+1] == undefined){
									isValid = false;// there is no record after the gap
								}                   
													 
								if(isValid){
									var startTime = data[0].segments[index].endTime;//previous end time
									var endTime = data[0].segments[index+1].startTime;//next start time
									
									var localBridge = {
										color: "#2c2c2e",
										startTime: startTime,
										endTime: endTime							
									}
									
									gaps.push(localBridge);
								}
							})
							
							
							var mergedArray = clone[0].segments.concat(gaps);

							mergedArray.sort(function(a,b){
								// Turn your strings into dates, and then subtract them
								// to get a value that is either negative, positive, or zero.
								return new Date(a.startTime) - new Date(b.startTime);
							});
							
							clone[0]["segments"] = mergedArray;
							
							return clone;
						}    
						
							var bridge = data[0].bridgeGaps;//is it required to bridge the gaps between the data - form the dips automatically
						
							if(bridge == true){
								var data = bridgeGaps(data);              
							}
									
						//bridge gap
						var segmentValueSum = 0;
						$.each(data[0].segments, function( ri, va) {
							segmentValueSum+= getDifference(va.startTime, va.endTime);
						});
							
						$.each(data[0].segments, function(ri, value) {						
							var segVal = getDifference(value.startTime, value.endTime);
							
							var startAngle = oldEndAngle;
							var endAngle = startAngle + (segVal/segmentValueSum)*(2/3)*Math.PI;                
								
							data[0].segments[ri]["startAngle"] = startAngle;
							data[0].segments[ri]["endAngle"] = endAngle;
							data[0].segments[ri]["index"] = ri;
							
							oldEndAngle = endAngle;
						});
							
						localData.push(data[0].segments);
									
						return localData[0];		
					},
					generateArcs: function(selector, data){
						var that = this;
						
						var chart = d3.select(selector);
						
						//append previous value to it.			
						$.each(data, function(index, value) {
							if(that.oldData[index] != undefined){
								data[index]["previousEndAngle"] = that.oldData[index].endAngle;
							}
							else{
								data[index]["previousEndAngle"] = 0;
							}
						});		

						var path_group = d3.select(selector+ ' .timearcchart');
						var r = ($(selector).data("width")/2);
						
						
						var type = $(selector).data("type");
						
						var arcpaths = path_group.selectAll("path")
								.data(data);

							arcpaths.enter().append("svg:path")
								.attr("class", function(d, i){
									return d.machineType;
								})	
								.style("fill", function(d, i){
									return d.color;
								})
								.transition()
								.ease("elastic")
								.duration(750)
								.attrTween("d", function(d){
									return that.arcTween(d, r, type);
								});
	
							arcpaths.transition()
								.ease("elastic")
								.style("fill", function(d, i){
									return d.color;
								})
								.duration(750)
								.attrTween("d", function(d){
									return that.arcTween(d, r, type);
								});
							 
							arcpaths.exit().transition()
								.ease("bounce")
								.duration(750)
								.attrTween("d", function(d){
									return that.arcTween(d, r, type);
								})
								.remove();
 			
					},
					arcTween: function(b, r, type) {
						var that = methods;
						
						var prev = JSON.parse(JSON.stringify(b));
						prev.endAngle = b.previousEndAngle;
						var i = d3.interpolate(prev, b);

						return function(t) {
							return that.getArc(r, type)(i(t));
						};
					},
					addLabel: function(selector, data){
						var that = this;
						
						console.log("add label");
						
						var label_group = d3.select(selector+ " .labels");

						label_group.append("text")
							.attr("class", "word")
							.attr("dy", "30")
							.text(data[0].label);

					},
					setup: function(clone, data, w, h){		
						var selector = methods.el["selector"];
						
						var chart = d3.select(selector)
							.append("svg:svg")
								.attr("class", "chart")					
								.attr("width", w)
								.attr("height", h)
								.attr("transform", "translate("+w*.05+","+h*.05+")");
						
						var timearcchart = chart.append("g")
										.attr("class", "timearcchart")
										.attr("transform", "translate("+((w/2)+15)+","+((h/2)-15)+")");
						
						var labelHolder = chart.append("g")
										.attr("class", "labels")
										.attr("transform", "translate("+((w*.05)+5)+", "+((h*.2)-15)+") rotate(-55)");
										
						this.generateArcs(selector, data);

						this.addLabel(selector, clone);		
					},
					getArc: function(r, type){
						var that = this;
						
						that.radius = r;
						var lowThreshold = 5;
						var highThreshold = 15
						
						var arc = d3.svg.arc()
								.innerRadius(function(d){						
									if(type == "outdent"){
										if(d.index%2){
											return that.radius;
										}else{
											return that.radius;
										}
									}else{
										if(d.index%2){
											return that.radius-lowThreshold;
										}else{
											return that.radius-highThreshold;
										}                       
									}
								})
								.outerRadius(function(d){
									if(type == "outdent"){
									   if(d.index%2){
											return that.radius+lowThreshold;
										}else{
											return that.radius+highThreshold;
										}
									}else{
										if(d.index%2){
											return that.radius;
										}else{
											return that.radius;
										}
									}
								})
								.startAngle(function(d, i){
									return d.startAngle;
								})
								.endAngle(function(d, i){
									return d.endAngle;
								});
											
						return arc;
					}
				};

				$.fn.timearc = function(methodOrOptions) {
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
		
		
		
		
			var dataCharts = [
				{
					"data": [
						{
							"label" : "Duration",
							"bridgeGaps": true,
							"segments": [
								{
									color: "#2c2c2e",
									startTime: "1/1/1900 00:14:00",
									endTime: "1/1/1900 00:15:00"
								},
								{
									color: "#2c2c2e",
									startTime: "1/1/1900 00:29:00",
									endTime: "1/1/1900 00:30:00"
								},
								{
									color: "#2c2c2e",
									startTime: "1/1/1900 00:44:00",
									endTime: "1/1/1900 00:45:00"
								},
								{
									color: "#2c2c2e",
									startTime: "1/1/1900 00:59:00",
									endTime: "1/1/1900 00:60:00"
								}
							]
						}
					]
				} ,
				{
					"data": [
						{
                            "label" : "Chapters",
                            "bridgeGaps": true,
                            "segments": [
								{
									color: "#2c2c2e",
                                    startTime: "1/3/2014 11:00:00",
                                    endTime: "2/3/2014 11:00:00"
								},
								{
									color: "#2c2c2e",
                                    startTime: "6/3/2014 11:00:00",
                                    endTime: "7/3/2014 11:00:00"
								},
                                {
									color: "#2c2c2e",
                                    startTime: "8/3/2014 11:00:00",
                                    endTime: "9/3/2014 11:00:00"
								}
							]
						}
					]
				}           
			];
			
			var clone = jQuery.extend(true, {}, dataCharts);

				//__invoke concentric
				$('[data-role="timearc"]').each(function(index) {
					var selector = "timearc"+index;
					
						
					var min = 0;
					var max = 1;
					pos = Math.floor(Math.random() * (max - min + 1)) + min;
					
					$(this).attr("id", selector);
					
					var options = {
						data: clone[pos].data,
                        width: $(this).data("width"),
                        height: $(this).data("height"),
						type: $(this).data("type")
					}
					
					$("#"+selector).timearc(options);
				});
			
			
			$(".testers a").on( "click", function(e) {
				e.preventDefault();

				var clone = jQuery.extend(true, {}, dataCharts);

				var min = 0;
				var max = 1;
					
				//__invoke concentric
				$('[data-role="timearc"]').each(function(index) {
					pos = Math.floor(Math.random() * (max - min + 1)) + min;
					console.log("id", $(this).attr("id"));
					$("#"+$(this).attr("id")).timearc('update', clone[pos].data);
				});

			});	

});
