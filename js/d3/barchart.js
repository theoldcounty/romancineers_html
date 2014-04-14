$(document).ready(function() {
					

			(function( $ ){
				var methods = {
					el: "",
					oldData: "",
					init: function(options){
						methods.el = this;
						
						console.log("options", options);
						
						var clone = options["data"].slice(0);
						methods.setup(clone, options["width"], options["height"]);			
					},
					update: function(data){
						methods.el = this;
						
						methods.animateBars(data);
					},
					animateBars: function(data){
						
						var svg = d3.select(methods.el["selector"] + " .barchart");
						var barrects = d3.select(methods.el["selector"] + " .barrects");
						
								
						var initialHeight = 0;		

                        
						
                        methods.x.domain(data.map(function(d) { return d.letter; }));
                        svg.select("g.x")
                            .transition()
							.duration(500)
                            .call(methods.xAxis);


						var bar = barrects.selectAll("rect")
							.data(data);
						 
						// Enter
						bar.enter()
							.append("rect")
							.attr("class", "bar")
							.attr("y", methods.height);
						 
						// Update
						bar
                            .attr("y", methods.height)
							.attr("height", initialHeight)
							.transition()
							.duration(500)
							.attr("x", function(d) { return methods.x(d.letter); })
							.attr("width", methods.x.rangeBand())
							.attr("y", function(d) { return methods.y(d.frequency); })
							.attr("height", function(d) { return methods.height - methods.y(d.frequency); })
						 
						// Exit
						bar.exit()
							.transition()
							.duration(250)
							.attr("y", initialHeight)
							.attr("height", initialHeight)
							.remove();

					
					},
					setup: function(data, w, h){


						var yLabel = "";
						var maxLimit = 100;
						var minLimit = 0;
						
						var margin = {top: 20, right: 20, bottom: 30, left: 40}
						methods.width = w - margin.left - margin.right;
						methods.height = h - margin.top - margin.bottom;

						methods.x = d3.scale.ordinal()
							.rangeRoundBands([0, methods.width], .1);

						methods.y = d3.scale.linear()
							.range([methods.height, 0]);

						methods.xAxis = d3.svg.axis()
							.scale(methods.x)
							.orient("bottom");

						methods.yAxis = d3.svg.axis()
							.scale(methods.y)
							.orient("left");

						var svg = d3.select(methods.el["selector"]).append("svg")
							.attr("class", "barchart")
							.attr("width", methods.width + margin.left + margin.right)
							.attr("height",methods.height + margin.top + margin.bottom)
						  .append("g")
							.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

						  methods.x.domain(data.map(function(d) { return d.letter; }));
						  methods.y.domain([minLimit, maxLimit]);

						  svg.append("g")
							  .attr("class", "x axis")
							  .attr("transform", "translate(0," + methods.height + ")")
							  .call(methods.xAxis);

						  svg.append("g")
							  .attr("class", "y axis")
							  .call(methods.yAxis)
							.append("text")
							  .attr("transform", "rotate(-90)")
							  .attr("y", 6)
							  .attr("dy", ".71em")
							  .style("text-anchor", "end")
							  .text(yLabel);
							  
							
						this.barrects = svg.append("g")
							  .attr("class", "barrects")
							  .attr("transform", "translate(0,0)")
 
							methods.animateBars(data);


						function type(d) {
						  d.frequency = +d.frequency;
						  return d;
						}
					}					
				};

				$.fn.barchart = function(methodOrOptions) {
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
		
			
				

			var w = 100;
			var h = 380;
			
			var dataCharts = [
				{
					"data": [
						{
							"frequency": 23,
							"letter" : "A"	
						},
						{
							"frequency": 80,
							"letter" : "B"	
						},
						{
							"frequency": 67,
							"letter" : "C"	
						}
					]
				},
				{
					"data": [
						{
							"frequency": 90,
							"letter" : "A"	
						},
						{
							"frequency": 20,
							"letter" : "B"	
						}
					]
				}
					
					
			];
			
			var clone = jQuery.extend(true, {}, dataCharts);

				//__invoke barchart
				$('[data-role="barchart"]').each(function(index) {
					var selector = "barchart"+index;
					
					$(this).attr("id", selector);
					
					var options = {
						data: clone[0].data,
						width: $(this).data("width"),
						height: $(this).data("height")
					}
					
					$("#"+selector).barchart(options);
					$("#"+selector).barchart('update', clone[0].data);
				});
			
			
			$(".testers a").on( "click", function(e) {
				e.preventDefault();

				var clone = jQuery.extend(true, {}, dataCharts);

				var min = 0;
				var max = 1;
					
				//__invoke pie chart
				$('[data-role="barchart"]').each(function(index) {
					pos = Math.floor(Math.random() * (max - min + 1)) + min;
					$("#"+$(this).attr("id")).barchart('update', clone[pos].data);
				});

			});	
});
