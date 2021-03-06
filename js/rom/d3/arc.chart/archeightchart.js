	var arcHeights = {
		radius: 100,
		oldData: "",
		init: function(data){
			var clone = jQuery.extend(true, {}, data);
			this.oldData = this.setData(clone, false);
			this.setup(this.setData(data, true));			
		},
		update: function(data){
			var clone = jQuery.extend(true, {}, data);			
			this.animate(this.setData(data, true));			
			this.oldData = this.setData(clone, false);
		},
		animate: function(data){
			var that = this;
			
			var chart = d3.select(".arcchart");
			that.generateArcs(chart, data);
		},	
		setData: function(data, isSorted){

			var diameter = 2 * Math.PI * this.radius;
			
			var localData = new Array();
			
			var displacement = 0;
			var oldBatchLength = 0;
						
			$.each(data, function(index, value) {				
				var riseLevels = value.segments;
				var riseLevelCount = riseLevels.length;
								
				if(oldBatchLength !=undefined){				
					displacement+=oldBatchLength;
				}
				
				var arcBatchLength = 2*Math.PI;
				var arcPartition = arcBatchLength/riseLevelCount;
				
					$.each(riseLevels, function( ri, value ) {
						var startAngle = (ri*arcPartition);
						var endAngle = ((ri+1)*arcPartition);
						
						if(index!=0){
							startAngle+=displacement;
							endAngle+=displacement;
						}
				
						riseLevels[ri]["startAngle"] = startAngle;
						riseLevels[ri]["endAngle"] = endAngle;					
					});
								
				oldBatchLength = arcBatchLength;
				
				localData.push(riseLevels);
			});
			
			var finalArray = new Array();
			
			$.each(localData, function(index, value) {
				$.each(localData[index], function(i, v) {
					finalArray.push(v);
				});
			});
			
			return finalArray;
		
		},
		generateArcs: function(chart, data){
			
			var that = this;
				
				//_arc paths
				
				//append previous value to it.			
				$.each(data, function(index, value) {
					if(that.oldData[index] != undefined){
						data[index]["previousEndAngle"] = that.oldData[index].endAngle;
					}
					else{
						data[index]["previousEndAngle"] = 0;
					}
				});		
		
				
				var arcpaths = that.arcpaths.selectAll("path")
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
				//_arc paths
				
 

				var r = that.radius - 50;
				var ir = that.radius + 90;

				//__labels	
				var labels = that.labels.selectAll("text")
					.data(data);
					
				labels.enter()
					.append("text")
					.attr("text-anchor", "middle")
					
						
				labels.text(function(d) {
						return d.color; 
					})
					.each(function(d) {
						var a = d.startAngle + (d.endAngle - d.startAngle)/2 - Math.PI/2;
						d.cx = Math.cos(a) * (ir+((r-ir)/2));
						d.cy = Math.sin(a) * (ir+((r-ir)/2));
						d.x = d.x || Math.cos(a) * (r + 20);
						d.y = d.y || Math.sin(a) * (r + 20);
						var bbox = this.getBBox();
						d.sx = d.x - bbox.width/2 - 2;
						d.ox = d.x + bbox.width/2 + 2;
						d.sy = d.oy = d.y + 5;
					})
					.transition()
						.duration(300)
					.attr("x", function(d) {
						var a = d.startAngle + (d.endAngle - d.startAngle)/2 - Math.PI/2;
						return d.x = Math.cos(a) * (r + 20);
					})
					.attr("y", function(d) {
						var a = d.startAngle + (d.endAngle - d.startAngle)/2 - Math.PI/2;
						return d.y = Math.sin(a) * (r + 20);
					});
					
					
				labels.exit().remove();
				//__labels            



					
				//__pointers
			that.pointers.append("defs").append("marker")
					.attr("id", "circ")
					.attr("markerWidth", 6)
					.attr("markerHeight", 6)
					.attr("refX", 3)
					.attr("refY", 3)
					.append("circle")
					.attr("cx", 3)
					.attr("cy", 3)
					.attr("r", 3);
				
				var pointers = that.pointers.selectAll("path.pointer")
					.data(data);
					
				pointers.enter()
					.append("path")
					.attr("class", "pointer")
					.style("fill", "none")
					.style("stroke", "black")
					.attr("marker-end", "url(#circ)");
					
				pointers
					.transition()
						.duration(300)
					.attr("d", function(d) {
						if(d.cx > d.ox) {
							return "M" + d.sx + "," + d.sy + "L" + d.ox + "," + d.oy + " " + d.cx + "," + d.cy;
						} else {
							return "M" + d.ox + "," + d.oy + "L" + d.sx + "," + d.sy + " " + d.cx + "," + d.cy;
						}
					});		
					
				pointers.exit().remove();
					
				//__pointers

		},
		setup: function(data){		
		
			var w = 270;
			var h = 270;
			
			this.radius = (w/2) - 80;
			
			var chart = d3.select("#threshold2").append("svg:svg")
					.attr("class", "chart")
					.attr("width", w)
					.attr("height", h)
						.append("svg:g")
						.attr("class", "arcchart")
						.attr("transform", "translate("+w/2+","+h/2+")");
            
            this.arcpaths = chart.append("g")
								.attr("class", "arcpaths");
            
            this.labels = chart.append("g")
								.attr("class", "labels");
            
            this.pointers = chart.append("g")
								.attr("class", "pointer");

			this.generateArcs(chart, data);		
		},
		getArc: function(){
			var that = this;
		
			var arc = d3.svg.arc()
					.innerRadius(function(d, i){
						return that.radius;
					})
					.outerRadius(function(d){
						var maxHeight = 100;
						var ratio = (d.height/maxHeight * 75)+that.radius;
						return ratio;
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
									height: 10,
									color: "grey"							
								},
								{
									height: 40,
									color: "darkgrey"							
								},
								{
									height: 33,
									color: "grey"							
								},
								{
									height: 50,
									color: "darkgrey"
								},
								{
									height: 33,
									color: "grey"							
								},
								{
									height: 10,
									color: "darkgrey"							
								},
								{
									height: 50,
									color: "grey"
								},
								{
									height: 45,
									color: "darkgrey"							
								},
								{
									height: 10,
									color: "grey"							
								},
								{
									height: 40,
									color: "darkgrey"							
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
									height: 50,
									color: "red"
								},
								{
									height: 100,
									color: "yellow"							
								},
								{
									height: 10,
									color: "green"							
								}							
							]
						}
					]
				}				
			];
			
			var clone = jQuery.extend(true, {}, dataCharts);
			
			arcHeights.init(clone[1].data);
			
			$(".testers a").on( "click", function(e) {
				e.preventDefault();

				var clone = jQuery.extend(true, {}, dataCharts);

				var pos = $(this).parent("li").index();
				arcHeights.update(clone[pos].data);			
			});
			
	});
