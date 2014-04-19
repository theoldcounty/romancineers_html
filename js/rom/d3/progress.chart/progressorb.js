$(document).ready(function() {
					

			(function( $ ){
				var methods = {
					el: "",
					init : function(options) {

						methods.el = this;		

						$(this).append('<div class="progresschart"/><div class="progresslabels"/>')
						$(this).wrapInner('<div class="progresscontainer"/>');
						
						var orbWidth = options["radius"] *.3;
						var orbHeight = options["radius"]*.3;

						$(this).find('.progresschart').css("width", orbWidth);
						$(this).find('.progresschart').css("height", orbHeight);

							
						var data = [
						    {
						        "label": options["label"],
						        "y": 10,
						        "x": options["width"]-50,
						        "cx": orbWidth-10,
								"cy": orbHeight - (orbHeight * (options["value"]/100)),
						        "value" : options["value"]
						    }
						];


						// setup scales

						methods.x = d3.scale.ordinal()
						    .rangeRoundBands([0, orbWidth], .1);

						methods.y = d3.scale.linear()
						    .range([orbHeight, 0]);

						methods.xAxis = d3.svg.axis()
						    .scale(methods.x)
						    .orient("bottom");

						methods.yAxis = d3.svg.axis()
						    .scale(methods.y)
						    .orient("left"); 
						// setup scales

						// chart container
						var progresschart = d3.select(methods.el["selector"]+ " .progresschart").append("svg")
						    .attr("width", orbWidth)
						    .attr("height", orbHeight)
								.append("g")
									.attr("transform", "translate(0,5)");

						 methods.chart = progresschart.append("g")
						    .attr("class", "chart")
						    .attr("transform", "translate(-15,0)");
						// chart container
						 
						 //_label containers
						 var progresslabels = d3.select(methods.el["selector"]+ " .progresslabels").append("svg")
						     .attr("width", options["width"])
						     .attr("height", options["height"])
						     .append("g")
						     	.attr("transform", "translate(0,6)");

						var labels = progresslabels.append("g")
						    	.attr("class", "labels")        

						var pointers = progresslabels.append("g")
						    	.attr("class", "pointers")
						//_label containers
						        
						methods.y.domain([options["minlimit"], options["maxlimit"]]);


							
						methods.setup(data, options); 
						methods.drawLabels(data);

					},
					setup: function(data, options){
                        
                        var that = this;

                        var selector = methods.el["selector"]+ " .progresschart";
                        

					        //var svg = d3.select(selector);
					            
					        var barrects = d3.select(selector + " .chart"); 
							
							var bar = barrects.selectAll("rect")
								.data(data);
								
							// Enter
							bar.enter()
								.append("rect")
								.attr("class", "bar")
								.attr("y", options["height"]);
							
							// Update
							bar
								.attr("y", options["height"])
								.attr("height", 0)
								.style("fill", options["startcolor"])
								.transition()
							.duration(2500)
								.style("fill", options["endcolor"])
								.attr("width", that.x.rangeBand())
								.attr("y", function(d) { return that.y(d.value); })
								.attr("height", function(d) { return options["height"] - that.y(d.value); })
							
							// Exit
							bar.exit()
								.transition()
								.duration(250)
								.attr("y", 0)
								.attr("height", 0)
								.remove();   


					},
					update: function(data){
						//var clone = jQuery.extend(true, {}, data);

						//var preparedData = methods.setData(clone);
						
						methods.el = this;
						//methods.animate(preparedData);			
						//methods.oldData = preparedData;
					},
					drawLabels: function(data){
						$(methods.el["selector"]+' .labels').empty();
						
						var that = this;
						
						var labelholder = d3.select(methods.el["selector"]+ ' .labels');
						 

						//__labels  

						//__ enter
						var labels = labelholder.selectAll("text")
							.data(data);

						labels.enter()
							.append("text")
							.attr("text-anchor", "middle")

						//__ update            
						labels
							.attr("x", function(d) {
							    return d.x;
							})
							.attr("y", function(d) {
							    return d.y;
							})
							.text(function(d) {
							    return d.label; 
							})
							.each(function(d) {
							    var bbox = this.getBBox();
							    d.sx = d.x - bbox.width/2 - 2;
							    d.ox = d.x + bbox.width/2 + 2;
							    d.sy = d.oy = d.y + 5;
							})
							.transition()
							.duration(300)

						labels
							.transition()
							.duration(300)      

						//__ exit
						labels.exit().remove();
						//__labels            



						var pointersholder = d3.select(methods.el["selector"]+ " .pointers"); 
						    //__pointers
						pointersholder.append("defs").append("marker")
						        .attr("id", "circ")
						        .attr("markerWidth", 6)
						        .attr("markerHeight", 6)
						        .attr("refX", 3)
						        .attr("refY", 3)
						        .append("circle")
						        .attr("cx", 3)
						        .attr("cy", 3)
						        .attr("r", 3);

						    var pointers = pointersholder.selectAll("path.pointer")
						        .data(data);

						    //__ enter
						    pointers.enter()
						        .append("path")
						        .attr("class", "pointer")
						        .style("fill", "none")
						        .style("stroke", "black")
						        .attr("marker-end", "url(#circ)");

						    //__ update
						    pointers
						        .attr("d", function(d) {
						            if(d.cx > d.ox) {
						                return "M" + d.sx + "," + d.sy + "L" + d.ox + "," + d.oy + " " + d.cx + "," + d.cy;
						            } else {
						                return "M" + d.ox + "," + d.oy + "L" + d.sx + "," + d.sy + " " + d.cx + "," + d.cy;
						            }
						        })
						        .transition()
						            .duration(300)

						    pointers
						        .transition()
						        .duration(300)      
						    
						    //__ exit
						    pointers.exit().remove();
						    //__pointers   

					},
					oldData: ""
				};

				$.fn.progress = function(methodOrOptions) {
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
		
		
		
		
			
				//__invoke progress
				$('[data-role="progress"]').each(function(index) {
					var selector = "progress"+index;
					$(this).attr("id", selector);
					
					var options = {
                        width: $(this).data("width"),
                        height: $(this).data("height"),
						radius: $(this).data("radius"),
                        label: $(this).data("label"),
                        value: $(this).data("value"),
                        startcolor: $(this).data("start-color"),
                        endcolor: $(this).data("end-color"),
                        minlimit: 0,
                        maxlimit: 100
					}
					
					$("#"+selector).progress(options);
				});
			
			
			$(".testers a").on( "click", function(e) {
				e.preventDefault();

				//__invoke progress
				/*
				$('[data-role="progress"]').each(function(index) {
					pos = Math.floor(Math.random() * (max - min + 1)) + min;
					console.log("id", $(this).attr("id"));
					$("#"+$(this).attr("id")).progress('update', clone[pos].data);
				});
				*/

			});	

});
