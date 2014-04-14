	var arcGenerator = {
		radius: 190,
		oldData: "",
		init: function(data){
			var clone = jQuery.extend(true, {}, data);
			
			var preparedData = this.setData(clone);			
			this.oldData = preparedData;
			this.setup(preparedData);			
		},
		update: function(data){
			var clone = jQuery.extend(true, {}, data);
			
			var preparedData = this.setData(clone);
		
			this.animate(preparedData);			
			this.oldData = preparedData;
		},
		animate: function(data){
			var that = this;
			
			var chart = d3.select(".arcchart");
            
            var pointers = d3.select(".pointers");
            var labels = d3.select(".labels");
            
             this.addLabels(labels, pointers, data);
			that.generateArcs(chart, data);
		},	
		setData: function(data){

			var diameter = 2 * Math.PI * this.radius;
			
			var localData = new Array();
			
            var oldEndAngle = 0;			
			
			var segmentValueSum = 0;
			$.each(data[0].segments, function( ri, va) {
				segmentValueSum+= va.value;
			});
			
				
			$.each(data[0].segments, function(ri, value) {						
           	
				var startAngle = oldEndAngle;
                var endAngle = startAngle + (value.value/segmentValueSum)*2*Math.PI;                
	           		
				data[0].segments[ri]["startAngle"] = startAngle;
				data[0].segments[ri]["endAngle"] = endAngle;
				data[0].segments[ri]["index"] = ri;
				
                oldEndAngle = endAngle;
			});
				
			localData.push(data[0].segments);
						
			return localData[0];		
		},
		generateArcs: function(chart, data){
			
			var that = this;
			
			//append previous value to it.			
			$.each(data, function(index, value) {
				if(that.oldData[index] != undefined){
					data[index]["previousEndAngle"] = that.oldData[index].endAngle;
				}
				else{
					data[index]["previousEndAngle"] = 0;
				}
			});		
	
			var arcpaths = chart.selectAll("path")
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
					.attrTween("d", arcTween);				 
				
				arcpaths.transition()
					.ease("elastic")
					.style("fill", function(d, i){
						return d.color;
					})
					.duration(750)
					.attrTween("d",arcTween);
				 
				arcpaths.exit().transition()
					.ease("bounce")
					.duration(750)
					.attrTween("d", arcTween)
					.remove();

			function arcTween(b) {
			
				var prev = JSON.parse(JSON.stringify(b));
				prev.endAngle = b.previousEndAngle;
				var i = d3.interpolate(prev, b);

				return function(t) {
					return that.getArc()(i(t));
				};
			}			
		},
		setup: function(data){		
			
			var w = 260;
			var h = 260;
			
			this.radius = (w/2) - 70;
		
			var chart = d3.select("#threshold").append("svg:svg")
				.attr("class", "chart")
				.attr("width", w)
				.attr("height", h)
	
			var segments = chart.append("g")
				.attr("class", "arcchart")
				.attr("transform", "translate("+w/2+","+h/2+")");

			var labels = chart.append("g")
				.attr("class", "labels")
				.attr("transform", "translate("+w/2+","+h/2+")");

			var pointers = chart.append("g")
				.attr("class", "pointers")
				.attr("transform", "translate("+w/2+","+h/2+")");
	
            this.addLabels(labels, pointers, data);
            
			this.generateArcs(segments, data);		
		},
        addLabels: function(labels, pointers, data){

            var ir = this.radius- 15;
            var r = this.radius+ 30;

						
						//__labels	
						var labels = labels.selectAll("text")
							.data(data);
							
						labels.enter()
							.append("text")
							.attr("text-anchor", "middle")
							
								
						labels
							.attr("x", function(d) {
								var a = d.startAngle + (d.endAngle - d.startAngle)/2 - Math.PI/2;
								d.cx = Math.cos(a) * (ir+((r-ir)/2));
								return d.x = Math.cos(a) * (r + 20);
							})
							.attr("y", function(d) {
								var a = d.startAngle + (d.endAngle - d.startAngle)/2 - Math.PI/2;
								d.cy = Math.sin(a) * (ir+((r-ir)/2));
								return d.y = Math.sin(a) * (r + 20);
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
							
						labels.exit().remove();
						//__labels
		
								
						//__pointers
						pointers.append("defs").append("marker")
							.attr("id", "circ")
							.attr("markerWidth", 6)
							.attr("markerHeight", 6)
							.attr("refX", 3)
							.attr("refY", 3)
							.append("circle")
							.attr("cx", 3)
							.attr("cy", 3)
							.attr("r", 3);
						
						var pointers = pointers.selectAll("path.pointer")
							.data(data);
							
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
            
        },
		getArc: function(){
			var that = this;
            
            var lowThreshold = 5;
            var highThreshold = 15
		
			var arc = d3.svg.arc()
					.innerRadius(function(d){
						if(d.index%2){
							return that.radius-highThreshold;
						}else{
							return that.radius-lowThreshold;
						}
					})
					.outerRadius(function(d){
						if(d.index%2){
							return that.radius+lowThreshold;
						}else{
							return that.radius+highThreshold;
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
	}
    
    
    
	$(document).ready(function() {

		var dataCharts = [
				{
					"data": [
						{
							"segments": [
								{
									value: 50,
                                    label: "happy",
									color: "#2c2c2e"
								},
								{
									value: 10,
									label: "sad",
                                    color: "#2c2c2e"							
								},
								{
									value: 120,
									label: "horny",
                                    color: "#2c2c2e"							
								},
								{
									value: 40,
                                    label: "angry",
									color: "#2c2c2e"							
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
									value: 50,
                                    label: "happy",
									color: "red"
								},
								{
									value: 100,
                                    label: "happy",
									color: "yellow"							
								},
								{
									value: 10,
                                    label: "happy",
									color: "green"							
								}						
							]
						}
					]
				}				
			];
			
			var clone = jQuery.extend(true, {}, dataCharts);
			
			arcGenerator.init(clone[0].data);
			
			$(".testers a").on( "click", function(e) {
				e.preventDefault();

				var clone = jQuery.extend(true, {}, dataCharts);

				var pos = $(this).parent("li").index();
				arcGenerator.update(clone[pos].data);			
			});
			
	});

