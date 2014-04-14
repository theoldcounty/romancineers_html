var progressChart = {
    init: function(){
    
        var minLimit = 0;
        var maxLimit = 100;
		
		var el = '#progress';
		$(el).append('<div class="progresschart"/><div class="progresslabels"/>')

		var startColor = $(el).data("start-color");
		var endColor = $(el).data("end-color");

        this.width = $(el).data("width");
        this.height = $(el).data("height");
        
		var orbWidth = $(el).data("width")*.3;
		var orbHeight = $(el).data("width")*.3;
		
		$('.progresschart').css("width", orbWidth);
		$('.progresschart').css("height", orbHeight);
		
        this.completeWidth = orbWidth;
        this.completeHeight = orbHeight;
		
		
		var vals = $(el).data("value");	
			
		var data = [
            {
                "label": $(el).data("label"),
                "y": 10,
                "x": this.width-50,
                "cx": orbWidth-10,
				"cy": orbHeight - (orbHeight * (vals/100)),
                "value" : vals
            }
        ];
		

        // setup scales
        
        this.x = d3.scale.ordinal()
            .rangeRoundBands([0, this.completeWidth], .1);
        
        this.y = d3.scale.linear()
            .range([this.completeHeight, 0]);
        
        this.xAxis = d3.svg.axis()
            .scale(this.x)
            .orient("bottom");
        
        this.yAxis = d3.svg.axis()
            .scale(this.y)
            .orient("left"); 
        // setup scales
        
        // chart container
        var progresschart = d3.select(".progresschart").append("svg")
            .attr("width", this.completeWidth)
            .attr("height", this.completeHeight)
        .append("g")
                .attr("transform", "translate(0,5)");
        
         this.chart = progresschart.append("g")
            .attr("class", "chart")
            .attr("transform", "translate(-15,0)");
        // chart container
         
         //_label containers
         var progresslabels = d3.select(".progresslabels").append("svg")
             .attr("width", this.width)
             .attr("height", this.height)
             .append("g")
                .attr("transform", "translate(0,6)");
        
        this.labels = progresslabels.append("g")
            .attr("class", "labels")        
        
        this.pointers = progresslabels.append("g")
            .attr("class", "pointers")
        //_label containers
                
        this.y.domain([minLimit, maxLimit]);
        
        this.chartBuild(data, startColor, endColor); 
        this.addLabels(data);
    },
    chartBuild: function(data, startColor, endColor){
        var that = this;
    
        var selector = ".progresschart";
        
        var svg = d3.select(selector);
            
        var barrects = d3.select(selector + " .chart"); 
		
		var bar = barrects.selectAll("rect")
			.data(data);
			
		// Enter
		bar.enter()
		.append("rect")
		.attr("class", "bar")
		.attr("y", that.completeHeight);
		
		// Update
		bar
		.attr("y", that.completeHeight)
		.attr("height", 0)
		.style("fill", startColor)
		.transition()
		.duration(2500)
		.style("fill", endColor)
		.attr("width", that.x.rangeBand())
		.attr("y", function(d) { return that.y(d.value); })
		.attr("height", function(d) { return that.completeHeight - that.y(d.value); })
		
		// Exit
		bar.exit()
		.transition()
		.duration(250)
		.attr("y", 0)
		.attr("height", 0)
		.remove();           
    
    },
    addLabels: function(data){
        var that = this;
            
            
            //__labels  
        
            //__ enter
            var labels = that.labels.selectAll("text")
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
                    
    }
}




