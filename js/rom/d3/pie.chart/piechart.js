$(document).ready(function() {
					

			(function( $ ){
				var methods = {
					el: "",
					init : function(options) {
						var clone = jQuery.extend(true, {}, options["data"]);
						
						methods.el = this;			
						methods.setup(clone, options["width"], options["height"], options["r"], options["ir"], options["colors"]);
					},
					getArc: function(radius, innerradius){
						var arc = d3.svg.arc()
							.innerRadius(innerradius)
							.outerRadius(radius);
							
						return arc;
					},
					setup: function(dataset, w, h, r, ir, colors){
						
						var padding = 80;
					
						this.width = w;
						this.height = h;
						this.radius = r
						this.innerradius = ir;
						
						if(colors != undefined){
							//__custom colors
							var colors = colors.split(",");						
							var colorArrayLength = colors.length;						
							this.color = d3.scale.ordinal()
										.domain(d3.range(colorArrayLength))
										.range(colors);
						}else{
							this.color = d3.scale.category20();
						}
						
						this.pie = d3.layout.pie()
							.sort(null)
							.value(function(d) { return d.total; });
							
						this.arc = this.getArc(this.radius, this.innerradius);
						
						this.svg = d3.select(methods.el["selector"]).append("svg")
							.attr("width", this.width + padding)
							.attr("height", this.height + padding)
							.append("g")
								.attr("class", "piechart")
								.attr("transform", "translate(" + ((this.width/2) + (padding/2)) + "," + ((this.height/2) + (padding/2)) + ")");				

                        this.segments = this.svg.append("g")
								.attr("class", "segments");
                        
                        this.labels = this.svg.append("g")
								.attr("class", "labels");
                        
                        this.pointers = this.svg.append("g")
								.attr("class", "pointers");
                        
                        
					},
					oldPieData: "",
					pieTween: function(r, ir, d, i){
						var that = this;
						
						var theOldDataInPie = methods.oldPieData;
						// Interpolate the arcs in data space

						var s0;
						var e0;

						if(theOldDataInPie[i]){
								s0 = theOldDataInPie[i].startAngle;
								e0 = theOldDataInPie[i].endAngle;
						} else if (!(theOldDataInPie[i]) && theOldDataInPie[i-1]) {
								s0 = theOldDataInPie[i-1].endAngle;
								e0 = theOldDataInPie[i-1].endAngle;
						} else if(!(theOldDataInPie[i-1]) && theOldDataInPie.length > 0){
								s0 = theOldDataInPie[theOldDataInPie.length-1].endAngle;
								e0 = theOldDataInPie[theOldDataInPie.length-1].endAngle;
						} else {
								s0 = 0;
								e0 = 0;
						}

						var i = d3.interpolate({startAngle: s0, endAngle: e0}, {startAngle: d.startAngle, endAngle: d.endAngle});
						
						return function(t) {
								var b = i(t);
								return methods.getArc(r, ir)(b);
						};
					},
					removePieTween: function(r, ir, d, i) {				
						var that = this;
						s0 = 2 * Math.PI;
						e0 = 2 * Math.PI;
						var i = d3.interpolate({startAngle: d.startAngle, endAngle: d.endAngle}, {startAngle: s0, endAngle: e0});

						return function(t) {
								var b = i(t);
								return methods.getArc(r, ir)(b);
						};
					},
					update: function(dataSet){
						var that = this;

						methods.el = this;
						var r = $(methods.el["selector"]).data("r");
						var ir = $(methods.el["selector"]).data("ir");
						
						methods.svg = d3.select(methods.el["selector"] + " .piechart");
                        
                        methods.segments = d3.select(methods.el["selector"] + " .segments");
                        methods.labels = d3.select(methods.el["selector"] + " .labels");
                        methods.pointers = d3.select(methods.el["selector"] + " .pointers");
						
						dataSet.forEach(function(d) {
							d.total = +d.value;
						});						
						
						this.piedata = methods.pie(dataSet);
						
						//__slices
						this.path = methods.segments.selectAll("path.pie")
							.data(this.piedata);
							
						this.path.enter().append("path")
							.attr("class", "pie")
							.attr("fill", function(d, i) {
								return methods.color(i); 
							})
							.transition()
								.duration(300)
								.attrTween("d", function(d, i) {
									return methods.pieTween(r, ir, d, i); 
								});
						
						this.path
								.transition()
								.duration(300)
								.attrTween("d", function(d, i) {
									return methods.pieTween(r, ir, d, i); 
								});
						
						this.path.exit()
								.transition()
								.duration(300)
								.attrTween("d", function(d, i) {
									return methods.removePieTween(r, ir, d, i); 
								})
								.remove();    
						//__slices
						
						
						//__labels	
						var labels = methods.labels.selectAll("text")
							.data(this.piedata);
							
						labels.enter()
							.append("text")
							.attr("text-anchor", "middle")
							
								
						labels
							.attr("x", function(d) {
								var a = d.startAngle + (d.endAngle - d.startAngle)/2 - Math.PI/2;
								d.cx = Math.cos(a) * (ir+((r-ir)/2));
								return d.x = Math.cos(a) * (r + 15);
							})
							.attr("y", function(d) {
								var a = d.startAngle + (d.endAngle - d.startAngle)/2 - Math.PI/2;
								d.cy = Math.sin(a) * (ir+((r-ir)/2));
								return d.y = Math.sin(a) * (r + 15);
							})
							.text(function(d) {
								return d.data.label; 
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
							
						labels.exit().remove();
						//__labels
		
								
						//__pointers
						methods.pointers.append("defs").append("marker")
							.attr("id", "circ")
							.attr("markerWidth", 6)
							.attr("markerHeight", 6)
							.attr("refX", 3)
							.attr("refY", 3)
							.append("circle")
							.attr("cx", 3)
							.attr("cy", 3)
							.attr("r", 3);
						
						var pointers = methods.pointers.selectAll("path.pointer")
							.data(this.piedata);
							
						pointers.enter()
							.append("path")
							.attr("class", "pointer")
							.style("fill", "none")
							.style("stroke", "black")
							.attr("marker-end", "url(#circ)");
							
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
							
						pointers.exit().remove();
							
						//__pointers
						
						this.oldPieData = this.piedata;
						
					}
				};

				$.fn.piechart = function(methodOrOptions) {
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
							"segments": [
								{
									"label": "apple",
									"value": 53245
								},
								{
									"label": "cherry",
									"value": 145
								},
								{
									"label": "pear",
									"value": 2245
								},
								{
									"label": "bananana",
									"value": 15325
								}							
							]
						}
					]
				},
				{
					"data": [
						{
							"segments": [
								{
									"label": "milk",
									"value": 532
								},
								{
									"label": "cheese",
									"value": 145
								},
								{
									"label": "grapes",
									"value": 22
								}
							]
						}
					]
				},
				{
					"data": [
						{
							"segments": [
								{
									"label": "pineapple",
									"value": 1532
								},
								{
									"label": "orange",
									"value": 1435
								},
								{
									"label": "grapes",
									"value": 22
								}				
							]
						}
					]
				},
				{
					"data": [
						{
							"segments": [
								{
									"label": "lemons",
									"value": 133
								},
								{
									"label": "mango",
									"value": 435
								},
								{
									"label": "melon",
									"value": 2122
								}				
							]
						}
					]
				}            
			];
			
			var clone = jQuery.extend(true, {}, dataCharts);

				//__invoke pie chart
				$('[data-role="piechart"]').each(function(index) {
					var selector = "piechart"+index;
					
					$(this).attr("id", selector);
					
						
					var min = 0;
					var max = 3;
					pos = Math.floor(Math.random() * (max - min + 1)) + min;
					
					var options = {
						data: clone[pos].data,
						width: $(this).data("width"),
						height: $(this).data("height"),
						r: $(this).data("r"),
						ir: $(this).data("ir"),
						colors: $(this).data("colors")
					}
					
					$("#"+selector).piechart(options);
					$("#"+selector).piechart('update', clone[pos].data[0].segments);
				});
			
			
			$(".testers a").on( "click", function(e) {
				e.preventDefault();

				var clone = jQuery.extend(true, {}, dataCharts);

				var min = 0;
				var max = 3;
					
				//__invoke pie chart
				$('[data-role="piechart"]').each(function(index) {
					pos = Math.floor(Math.random() * (max - min + 1)) + min;
					$("#"+$(this).attr("id")).piechart('update', clone[pos].data[0].segments);
				});

			});	

});