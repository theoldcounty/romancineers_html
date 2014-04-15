var personBuilder = {
    init: function(){
    
        var h = 150;
        var w = 250;
        
        var padding = 20;
        
        
        var x = d3.scale.ordinal()
            .domain(d3.superformulaTypes)
            .rangePoints([0, 360], 1);
        
        var svg = d3.select("#person").append("svg")
            .attr("width", w)
            .attr("height", h+20)
            .attr("class", "motives") 
        .append("g")
            .attr("transform", "translate("+padding+","+padding+")");
        
        
         this.peoples = svg.append("g")
            .attr("class", "peoples") 
        
         this.labels = svg.append("g")
            .attr("class", "labels")
         
         this.pointers = svg.append("g")
            .attr("class", "pointers")
         
        
         var data = [
             {
                 "label": "Imagination",
                 "y": h*.06,
                 "x": w*.089,
                 "cx": w*.11,
                 "cy": h*.29
             },
             {
                 "label": "Love",
                 "y": h*.9,
                 "x": w*.31,
                 "cx": w*.45,
                 "cy": h*.47
             },
             {
                 "label": "Career",
                 "y": h*.06,
                 "x": w*.735,
                 "cx": w*.86,
                 "cy": h*.57
             }
         ]
  
         //maleSkinny
         //maleStandard
         //maleMuscular
         //femaleStandard
         
         var biometrics = {
             "gender": "male",
             "bodytype": "skinny",
             "race": "asian"
         }
        
        function capitaliseFirstLetter(string)
        {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
                
         //tweak avatar on race
         var biocolor = "grey";
         switch(biometrics.race)
         {
             case "caucasian":
                 biocolor = "#ffe4e4";
                 break;
             case "asian":
                 biocolor = "#fff5bf";
                 break;
             case "black":
                 biocolor = "#71330e";
                 break;
         }       
        
         
         var augmentUser = {
                 NodeType: biometrics.gender+""+capitaliseFirstLetter(biometrics.bodytype),
                 color: biocolor,
                 height:h*.34, 
                 width: w*.14
            };//build a skinny man
   
            $.each(data, function(index, value) {     
                var coordinatesForUser = {
                    "hx": (index * w*.32) +w*.1,
                    "hy": h*.5 //position the avatars half way on canvas
                };
                
                jQuery.extend(augmentUser, coordinatesForUser);                
                jQuery.extend(value, augmentUser);
            });
        
        this.buildPeople(data);            
        this.addLabels(data);
    },
    buildPeople: function(data){
        var that = this;
        
        var flow_shapes = this.getFlowShapes();
        
        var peoples = that.peoples.selectAll("path")
            .data(data)
        
        peoples.enter()
            .append("svg:path")            
        
        peoples
            .attr("d", function(d) { 
                return flow_shapes[d.NodeType](d.height, d.width);
            })
            .attr("stroke", "black")
            .attr("fill", function(d){
                return d.color;
            })
            .attr("transform", function(d) {
                return "translate(" + d.hx + "," + d.hy + ") rotate(180)";
            });
        
    },
    addLabels: function(data){
        var that = this;
        
        //__labels  
        var labels = that.labels.selectAll("text")
             .data(data);
        
        labels.enter()
            .append("text")
            .attr("text-anchor", "middle");
        
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
            .duration(300);
        
        labels
            .transition()
            .duration(300);  
        
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
            .attr("d", function(d) {
                if(d.cx > d.ox) {
                    return "M" + d.sx + "," + d.sy + "L" + d.ox + "," + d.oy + " " + d.cx + "," + d.cy;
                } else {
                    return "M" + d.ox + "," + d.oy + "L" + d.sx + "," + d.sy + " " + d.cx + "," + d.cy;
                }
            })
            .transition()
            .duration(300);
        
        pointers
            .transition()
            .duration(300);
        
        pointers.exit().remove();
        //__pointers    
                    
    },
    getFlowShapes: function(){
        var flow_shapes = {
            femaleSkinny: function(h, w) {
        
                 var points = [
                    [w*.32, h*.33], [w, -h*.22], [w*.98, -h*.33], [w*.33, h*.13], // left arm
                  [w*.23, h*.13], [w*.21, -h*.22], // left waist
                  [w*.54, -h*.54], [w*.35, -h*.54], [w*.25, -h*.54], [w*.45, -h*.94], [w*.24, -h], [w*.11, -h*.55], //left leg
                    [0, -h*.55], //groin
                  [-w*.11, -h*.55], [-w*.24, -h], [-w*.45, -h*.94], [-w*.25, -h*.54], [-w*.35, -h*.54], [-w*.54, -h*.54] ,//right leg
                   [-w*.21, -h*.22], [-w*.23, h*.13], // right waist
                    [-w*.33, h*.13], [-w*.98, -h*.33], [-w, -h*.22], [-w*.32, h*.33], // right arm
                   [-w*.09, h*.56], [-w*.11, h*.78], [w*.11, h*.78], [w*.09, h*.56], // head
                ]
                points.push(points[0]); //complete shape - closes off the shape by joining the last and first points
                    
                return d3.svg.line()(points);
            },
            femaleStandard: function(h, w) {
        
                 var points = [
                    [w*.32, h*.33], [w, -h*.22], [w*.98, -h*.33], [w*.33, h*.13], // left arm
                  [w*.23, h*.13], [w*.21, -h*.22], // left waist
                  [w*.54, -h*.54], [w*.35, -h*.54], [w*.25, -h*.54], [w*.45, -h*.94], [w*.24, -h], [w*.11, -h*.55], //left leg
                    [0, -h*.55], //groin
                  [-w*.11, -h*.55], [-w*.24, -h], [-w*.45, -h*.94], [-w*.25, -h*.54], [-w*.35, -h*.54], [-w*.54, -h*.54] ,//right leg
                   [-w*.21, -h*.22], [-w*.23, h*.13], // right waist
                    [-w*.33, h*.13], [-w*.98, -h*.33], [-w, -h*.22], [-w*.32, h*.33], // right arm
                   [-w*.09, h*.56], [-w*.11, h*.78], [w*.11, h*.78], [w*.09, h*.56], // head
                ]
                points.push(points[0]); //complete shape - closes off the shape by joining the last and first points
                    
                return d3.svg.line()(points);
            },
            femaleMuscular: function(h, w) {
        
                 var points = [
                    [w*.32, h*.33], [w, -h*.22], [w*.98, -h*.33], [w*.33, h*.13], // left arm
                  [w*.23, h*.13], [w*.21, -h*.22], // left waist
                  [w*.54, -h*.54], [w*.35, -h*.54], [w*.25, -h*.54], [w*.45, -h*.94], [w*.24, -h], [w*.11, -h*.55], //left leg
                    [0, -h*.55], //groin
                  [-w*.11, -h*.55], [-w*.24, -h], [-w*.45, -h*.94], [-w*.25, -h*.54], [-w*.35, -h*.54], [-w*.54, -h*.54] ,//right leg
                   [-w*.21, -h*.22], [-w*.23, h*.13], // right waist
                    [-w*.33, h*.13], [-w*.98, -h*.33], [-w, -h*.22], [-w*.32, h*.33], // right arm
                   [-w*.09, h*.56], [-w*.11, h*.78], [w*.11, h*.78], [w*.09, h*.56], // head
                ]
                points.push(points[0]); //complete shape - closes off the shape by joining the last and first points
                    
                return d3.svg.line()(points);
            },
            maleSkinny: function(h, w) {
        
                 var points = [
                    [w*.32, h*.37], [w, -h*.29], [w*.98, -h*.38], [w*.38, h*.19], // left arm
                  [w*.23, h*.13], [w*.21, -h*.22], // left waist
                  [w*.45, -h*.94], [w*.28, -h], [w*.11, -h*.35], //left leg
                    [0, -h*.25], //groin
                  [-w*.11, -h*.35], [-w*.28, -h], [-w*.45, -h*.94], //right leg
                   [-w*.21, -h*.22], [-w*.23, h*.13], // right waist
                    [-w*.38, h*.19], [-w*.98, -h*.38], [-w, -h*.29], [-w*.32, h*.37], // right arm
                   [-w*.09, h*.56], [-w*.11, h*.78], [w*.11, h*.78], [w*.09, h*.56], // head
                ]
                points.push(points[0]); //complete shape - closes off the shape by joining the last and first points
                    
                return d3.svg.line()(points);
            },
            maleStandard: function(h, w) {
        
                 var points = [
                    [w*.32, h*.37], [w, -h*.29], [w*.98, -h*.34], [w*.45, h*.1], // left arm
                  [w*.26, h*.13], [w*.25, -h*.22], // left waist
                  [w*.52, -h*.97], [w*.28, -h], [w*.11, -h*.35], //left leg
                    [0, -h*.25], //groin
                  [-w*.11, -h*.35], [-w*.28, -h], [-w*.52, -h*.97], //right leg
                   [-w*.25, -h*.22], [-w*.26, h*.13], // right waist
                    [-w*.45, h*.1], [-w*.98, -h*.34], [-w, -h*.29], [-w*.32, h*.37], // right arm
                   [-w*.09, h*.56], [-w*.11, h*.81], [w*.11, h*.81], [w*.09, h*.56], // head
                ]
                points.push(points[0]); //complete shape - closes off the shape by joining the last and first points
                    
                return d3.svg.line()(points);
            },
            maleMuscular: function(h, w) {
            
                 var points = [
                    [w*.32, h*.41], [w, -h*.27], [w*.95, -h*.37], [w*.45, h*.1], // left arm
                  [w*.32, h*.13], [w*.25, -h*.22], // left waist
                  [w*.52, -h*.97], [w*.28, -h], [w*.15, -h*.35], //left leg
                    [0, -h*.19], //groin
                  [-w*.15, -h*.35], [-w*.28, -h], [-w*.52, -h*.97], //right leg
                   [-w*.25, -h*.22], [-w*.32, h*.13], // right waist
                    [-w*.45, h*.1], [-w*.95, -h*.37], [-w, -h*.27], [-w*.32, h*.41], // right arm
                   [-w*.09, h*.59], [-w*.11, h*.87], [w*.11, h*.87], [w*.09, h*.59], // head
                ]
                points.push(points[0]); //complete shape - closes off the shape by joining the last and first points
                    
                return d3.svg.line()(points);
            }   
        }    
        return flow_shapes;
    }
}




