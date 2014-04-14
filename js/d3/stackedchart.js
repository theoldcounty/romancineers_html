$(document).ready(function() {
					

			(function( $ ){
				var methods = {
					el: "",
					init: function(options){
					
                     
                        //_ chart parameters                         
                        var w = options["width"];
                        var h = options["height"];
                        var yLabel = "Test";
                        var el = this;
                        
                        //_ get initial data
                        var data = options["data"];
                        
                        //_ sort data alphabetically
                        methods.sortData(data);            
                        
                        //_set chart dimensions
                        var margin = methods.getMargin(h);						
                            methods.setDimensions(w, h, margin);                
                            methods.setX();
                            methods.setY();
                        
                        var colorArray = ["#538ed5", "#953735", "#e46d0a", "#75923c", "#b2a1c7", "#dc143c", "#87cefa", "#90ee90", "#add8e6", "#d3d3d3", "#cf1256", "#12cf5e"];	
                        
                        methods.color = d3.scale.ordinal()
                            .range(colorArray);
                        
                        var selector = el["selector"];
                        
                        //_ create svg chart
                        var svg = d3.select(selector)
                            .append("svg")
                                .attr("class", "stackedchart")
                                .attr("width", parseInt(methods.width + margin.left + margin.right,10))
                                .attr("height", parseInt(methods.height + margin.top + margin.bottom + 100,10))
                                .attr('viewBox', "0 0 "+parseInt(methods.width + margin.left + margin.right,10)+" "+parseInt(methods.height + margin.top + margin.bottom,10))
                                .attr('perserveAspectRatio', "xMinYMid")
                                .append("g")
                                .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
                            
                        //_ create x axis    
                        svg.append("g")
                            .attr("class", "x axis")
                            .attr("transform", "translate(0," + methods.height + ")")
                            .call(methods.xAxis);
                        
                        //_ rotate xlabels
                        methods.xlabels = svg.selectAll(".x.axis text")  
                            .attr("transform", "rotate(-60) translate(-10,-10)")
                        
                         //_ create y axis  
                        svg.append("g")
                            .attr("class", "y axis")
                            .call(methods.yAxis)
                            .append("text")
                            .attr("transform", "rotate(-90)")
                            .attr("y", 6)
                            .attr("dy", "-3.5em")
                            .style("text-anchor", "end")
                            .text(yLabel);    
                        
                        //_ create bar holding area
                        svg.append("g")
                            .attr("class", "barholder")
                        
						svg.append("g")
                            .attr("class", "legendholder")
							.attr("transform", "translate(" + (methods.width - 100) + "," + (methods.height + 100) + ")")
                        
						
						
                        //_ update bars
                        methods.animateBars(selector, data);
						
						
                                    
					},
					resizeChart: function(){
						var svg = $('.stackedchart');
						
						var aspect = svg.width() / svg.height();
						var targetWidth = svg.parent().parent().width();
						
						if(targetWidth!=null){
							svg.attr("width", targetWidth);
							svg.attr("height", Math.round(targetWidth / aspect));
						}
					},
					color:"",
					animateBars: function(selector, data){
						var svg = d3.select(selector + " .stackedchart");
                        
						methods.width = $(selector).data("width");
						methods.height = $(selector).data("height");

						var margin = methods.getMargin(methods.height);						
						methods.setDimensions(methods.width, methods.height, margin);
						
						methods.setX();
						methods.setY();
                        
						
                        //__morph labels
						var data = methods.setDBlocks(data);
                        
						methods.setDomain(data);
                        
                        svg.select("g.x")
                            .transition()
							.duration(500)
                            .call(methods.xAxis);

                        methods.xlabels = svg.selectAll(".x.axis text")  
								.attr("transform", "rotate(-60) translate(-10,-10)");
                          
                         svg.select("g.y")
                          .transition()
							.duration(500)
							  .call(methods.yAxis);
                        //__morph labels 
                      
                        
						var initialHeight = 0;
						
                        var barholder = d3.select(selector + " .barholder");

                        //_morph stacks  
						var stacks = barholder.selectAll(".stack")
						  .data(data);
							
                            // Enter
                            stacks.enter()
								.append("g")
								.attr("class", "stack")
								.attr("x", function(d) { return methods.x(d.Label);})
								.attr("transform", function(d) { 
									return "translate(" + methods.x(d.Label) + ",0)";
								});
                       
                            // Update
						    stacks
                                .attr("x", function(d) { return methods.x(d.Label);})
                                .transition()
                                .duration(500)
                                .attr("x", function(d) { return methods.x(d.Label); })
                                .attr("transform", function(d) { 
                                        return "translate(" + methods.x(d.Label) + ",0)";
                                });
                           
                            // Exit
                            stacks.exit()
                                .transition()
                                .duration(250)
                                .attr("x", function(d) { return methods.x(d.Label);})
                                .remove();
                        //_morph stacks  
                        
                            
                        //_morph bars       
                        
                        
						var bar = stacks.selectAll("rect")
							.data(function(d) {
								return d.blocks; 
							});
						 
						// Enter
                        bar.enter()
							.append("rect")
							.attr("class", "bar")
							.attr("y", function(d) { return methods.y(d.y1); })
                            .attr("width", methods.x.rangeBand())
                            .style("fill", function(d) { return methods.color(d.name); });
                        
                        // Update
						bar
                            .attr("y", methods.height)
							.attr("height", initialHeight)
                            .attr("width", methods.x.rangeBand())
							.transition()
							.duration(500)
							.attr("x", function(d) { return methods.x(d.Label); })
							.attr("width", methods.x.rangeBand())
							.attr("y", function(d) { return methods.y(d.y1); })
							.attr("height", function(d) { return methods.y(d.y0) - methods.y(d.y1); })
                        
                        // Exit
						bar.exit()
							.transition()
							.duration(250)
							.attr("y", function(d) { return methods.y(d.y1); })
							.attr("height", function(d) { methods.y(d.y0) - methods.y(d.y1); })
							.remove();
                        
                        
                        //__morph bars
						
						this.buildLegend();
                       	
					},
                    sortData: function(data){
                        //_ sort data
                        data.sort(function(a, b) { 
                            var textA = a.Label.toUpperCase();
                            var textB = b.Label.toUpperCase();
                            return (textB < textA) ? -1 : (textB > textA) ? 1 : 0;
                        });
                    },
                    setDimensions: function(w, h, margin){                        
                        methods.width = w - margin.left - margin.right;
                        methods.height = h - margin.top - margin.bottom;                   
                    },
					setX: function(){
						methods.x = d3.scale.ordinal()
							.rangeRoundBands([0, methods.width], .1);
												
						methods.xAxis = d3.svg.axis()
							.scale(methods.x)
							.orient("bottom");				
					},
					setY: function(){
						methods.y = d3.scale.linear()
							.range([methods.height, 0]);

						methods.yAxis = d3.svg.axis()
							.scale(methods.y)
							.orient("left");				
					},
                    getMargin: function(h){
                        var margin = {top: 10, right: 45, bottom: (h * 0.45), left: 65};
                        return margin;
                    },
					setDBlocks: function(incomingdata){
						var data = incomingdata.slice(0);
						
						methods.color.domain(d3.keys(data[0]).filter(function(key) { return key !== "Label"; }));

						data.forEach(function(d) {
							
							var y0 = 0;
							
                            d.blocks = methods.color.domain().map(function(name) {
                                var val = d[name];
                                
                                if(isNaN(val)){
                                    val = 0;
                                }
                                
                                return {name: name, values: val, y0: y0, y1: y0 += +val};
                            });
                            
							d.total = d.blocks[d.blocks.length - 1].y1;
						});
                        
                        console.log(data);
                        
                        return data;
					},
					setDomain: function(data){
							var minLimit = 0;
							var maxLimit = d3.max(data, function(d) { return d.total;} );
							
							methods.x.domain(data.map(function(d) { return d.Label; }));
							methods.y.domain([minLimit, maxLimit]);
					},
					update: function(data){
						methods.el = this;
                        var selector = methods.el["selector"];
                        
                        data.forEach(function(d) {
                              delete d.blocks;
                            delete d.total;
                        });
                        
						methods.animateBars(selector, data);						 
					},
					buildLegend: function(){
						var that = this;
					
						$(methods.el["selector"] + ' .legendholder').empty();
						
						var legendholder = d3.select(methods.el["selector"] + ' .legendholder')
							.append("svg")
								.attr("width", "180")
								.attr("height", "300")
								.attr("class", "legendholderstacked");					  
							  
						var legends = legendholder.append("g")
							.attr("class", "legends")
							.attr("transform", "translate(100,0)");									

						  var legend = legends.selectAll(".legend")
							  .data(that.color.domain().slice().reverse())
							.enter().append("g")
							  .attr("class", "legend")
							  .attr("transform", function(d, i) { return "translate(0," + i * 20 + ")"; });

						  legend.append("rect")
							  .attr("x", 0)
							  .attr("width", 18)
							  .attr("height", 18)
							  .style("fill", that.color);

						  legend.append("text")
							  .attr("x", -14)
							  .attr("y", 9)
							  .attr("dy", ".35em")
							  .style("text-anchor", "end")
							  .text(function(d) { return d; });					
					},
					oldData: ""
				};

				$.fn.stacked = function(methodOrOptions) {
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
							"Bagel" : 4,
							"Burger" : 3,
							"Jam" : 0.001,
							"Label" : "Hyderabad, India"
						},		
						{
							"Bagel" : 0.001,
							"Burger" : 23,
							"Jam" :0.001,
							"Label" : "Houston, United States"
						},
						{
							"Bagel" : 34,
							"Burger" : 24,
							"Jam" : 12,
							"Label" : "Jersey, United States"
						}
					]
				},
				{
					"data": [
						{
							"Kippers" : 0.001,
							"Kebab" : 3,
							"Label" : "Paris, France"
						},		
						{
							"Kippers" : 0.001,
							"Kebab" : 23,
							"Label" : "London, United Kingdom"
						}
					]
				},
				{
					"data": [
						{
							"Burger" : 3,
							"Peanuts" : 0.02,
							"Label" : "Bombay, India"
						},		
						{
							"Burger" : 23,
							"Peanuts" :0.02,
							"Label" : "Dallas, United States"
						},
						{
							"Burger" : 24,
							"Peanuts" : 12,
							"Label" : "Detroit, United States"
						}
					]
				},
				{
					"data": [
						{
							"Pizza" : 3,
							"Pancakes" : 0.001,
							"Label" : "Bombay, India"
						},		
						{
							"Pizza" : 32,
							"Pancakes" : 20,
							"Label" : "Dallas, United States"
						},
						{
							"Pizza" : 33,
							"Pancakes" : 330,
							"Label" : "Detroit, United States"
						}
					]
				}           
			];
			
			

				//__invoke concentric
				$('[data-role="stacked"]').each(function(index) {
					var selector = "stacked"+index;
					
					$(this).attr("id", selector);
                    var clone = jQuery.extend(true, {}, dataCharts);
					
					var options = {
						data: clone[0].data,
						width: $(this).data("width"),
						height: $(this).data("height")
					}
					
					$("#"+selector).stacked(options);
				});
			
			
			$(".testers a").on( "click", function(e) {
				e.preventDefault();

				var clone2 = jQuery.extend(true, {}, dataCharts);

				var min = 0;
				var max = 3;
					
				//__invoke concentric
				$('[data-role="stacked"]').each(function(index) {
					pos = Math.floor(Math.random() * (max - min + 1)) + min;
					console.log("id", $(this).attr("id"));
					$("#"+$(this).attr("id")).stacked('update', clone2[pos].data);
				});

			});	

});


