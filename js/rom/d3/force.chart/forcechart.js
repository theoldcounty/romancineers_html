/**
    * do the force vizualization
    * @param {string} divName name of the div to hold the tree
    * @param {object} inData the source data
    */
   function doTheTreeViz(divName, inData) {
       
			// tweak the options
			var options = $.extend({
				stackHeight : 12,
				radius : 5,
				fontSize : 12,
				labelFontSize : 8,
				nodeLabel : null,
				markerWidth : 0,
				markerHeight : 0,
				gap : 1.5,
				nodeResize : "",
				linkDistance : 80,
				charge : -520,
				styleColumn : null,
				styles : null,
				linkName : null,
				width : $(divName).outerWidth(),
				height : $(divName).outerHeight()
			}, inData.d3.options);
		
			// set up the parameters
			options.gap = options.gap * options.radius;
			var width = options.width;
			var height = options.height;
			var data = inData.d3.data;
			var nodes = data.nodes;
			var links = data.links;
			//var color = d3.scale.category20();
			var color = d3.scale.ordinal().range(["#1398ff", "#bdbdbd", "#ffc332", "#daa520", "#00bfff", "#dc143c", "#87cefa", "#90ee90", "#add8e6", "#d3d3d3", "#cf1256", "#12cf5e"]);

			var colorStatus = d3.scale.ordinal().range(["#00ff00", "#fff000", "#f40336"]);
			
			var force = d3.layout.force().nodes(nodes).links(links).size([width, height]).linkDistance(options.linkDistance).charge(options.charge).on("tick", tick).start();

			var svg = d3.select(divName).append("svg:svg").attr("width", width).attr("height", height);

			// get list of unique values in stylecolumn
			linkStyles = [];
		
			if (options.styleColumn) {
				var x;
				for (var i = 0; i < links.length; i++) {
					if (linkStyles.indexOf( x = links[i][options.styleColumn].toLowerCase()) == -1){
						linkStyles.push(x);
					}
				}
			} else{
				linkStyles[0] = "defaultMarker";
			}
			// do we need a marker?

			if (options.markerWidth) {
				svg.append("svg:defs").selectAll("marker").data(linkStyles).enter().append("svg:marker").attr("id", String).attr("viewBox", "0 -5 10 10").attr("refX", 15).attr("refY", -1.5).attr("markerWidth", options.markerWidth).attr("markerHeight", options.markerHeight).attr("orient", "auto").append("svg:path").attr("d", "M0,-5L10,0L0,5");
			}

			var path = svg.append("svg:g").selectAll("path").data(force.links()).enter().append("svg:path").attr("class", function(d) {
				return "link " + (options.styleColumn ? d[options.styleColumn].toLowerCase() : linkStyles[0]);
			}).attr("marker-end", function(d) {
				return "url(#" + (options.styleColumn ? d[options.styleColumn].toLowerCase() : linkStyles[0] ) + ")";
			});

       
           
			var circle = svg.append("svg:g").selectAll("circle")
            .data(force.nodes());
       
           //enter
           circle 
            .enter()
            .append("svg:circle")
			.attr("id", function(d){
			   return d.name;
			})
            .attr("r", function(d) {
				return getRadius(d);
			})
            .style("fill", function(d) {
                if(d.group == "User"){
                    return "url(#"+"--"+ d.name.substr(1)+")"; 
                }else{
                    return color(d.group);
                }
			}).call(force.drag);
       
           if (options.nodeLabel) {
				circle.append("title")
                    .text(function(d) {
					    return d[options.nodeLabel];
				    })
                    .attr("id", function(d){
                       return "label"+d.name;
                   })
			}

			if (options.linkName) {
				path.append("title").text(function(d) {
					return d[options.linkName];
				})
                .attr("id", function(d){
                    return "linkname"+d.name;
                })
			}
              
       
			
			var text = svg.append("svg:g").selectAll("g")
                .data(force.nodes())
            
            text
                .enter().append("svg:g");

			// A copy of the text with a thick white stroke for legibility.
			text.append("svg:text")
                .attr("x", options.labelFontSize)
                .attr("y", ".31em")
                .attr("class", "shadow")
                .text(function(d) {
				    return d[options.nodeLabel];
			    })
                .attr("id", function(d){
                    return "shadow"+d.name;
                });

			text.append("svg:text")
                .attr("x", options.labelFontSize)
                .attr("y", ".31em")
                .text(function(d) {
				    return d[options.nodeLabel];
			    })
                .attr("id", function(d){
                    return "text"+d.name;
                });
       

			removeDuplicates();

			function removeDuplicates(){
				//remove items
				// Warning Duplicate IDs
				$('[id]').each(function(){
					  var ids = $('[id="'+this.id+'"]');
					
					if(ids.length>1 && ids[0]==this){
						$(ids).each(function(i){
							if(i != 0){
							   $(ids[i]).remove();
							}
						 });  
					}
				});
			}

				
			function getRadius(d) {
				return options.radius * (options.nodeResize ? Math.sqrt(d[options.nodeResize]) / Math.PI : 1);
			}

			// Use elliptical arc path segments to doubly-encode directionality.
			function tick() {
				path.attr("d", function(d) {
					var dx = d.target.x - d.source.x, dy = d.target.y - d.source.y, dr = Math.sqrt(dx * dx + dy * dy);
					return "M" + d.source.x + "," + d.source.y + "A" + dr + "," + dr + " 0 0,1 " + d.target.x + "," + d.target.y;
				});

				circle.attr("transform", function(d) {
					return "translate(" + d.x + "," + d.y + ")";
				});

				text.attr("transform", function(d) {
					return "translate(" + d.x + "," + d.y + ")";
				});
			}
       
                   
             //var myVar=setInterval(function(){changeGravity()},1500);
            
            function changeGravity()
            {
                    var min = 1;
                    var max = 1000;
                    // and the formula is:
                    var random = Math.floor(Math.random() * (max - min + 1)) + min;
                //        force.gravity = random;
                force.start();
            }
                   
             
		
   }





	var forceChart = {
		buildDataStream: function(userData){
			var data = new Array();
				
			$.each(userData, function( index, value ) {
			
				var interestArray = new Array();
				 $.each(value.interests, function( x, v ) {
					
					 var localInterestObj = {
						 "label": Object.keys(v)[0],
						 "name": "--"+Object.keys(v)[0].toLowerCase(),
						 "size": v[Object.keys(v)[0]],
						 "group": "Application",
						 "children": []
					 };
					 interestArray.push(localInterestObj);
			   
				 });
				
				
				var childrenArray = [
						{
							"label": "Interests",
							"name": "-interests"+"-"+index,
							"group": "Application",
							"children": interestArray
						}        
				]
				
				var userObj = {
					"label": value.userName,
					"name": "+"+index+"-"+value.userName.toLowerCase(),
					"group": "User",
					"userID": index,
					"children": childrenArray
				}
		  
						
				data.push(userObj);
			});
			
			return data;
		},
		addUserPatterns: function(patternsSvg, userData){
			$.each(userData, function(index, value) {
				var defs = patternsSvg.append('svg:defs');
					defs.append('svg:pattern')
						.attr('id', "--"+index+"-"+value.userName.toLowerCase())
						.attr('width', 50)
						.attr('height',50)
						.append('svg:image')
						.attr('xlink:href', value.userImage)
						.attr('x', 0)
						.attr('y', 0)
						.attr('width', 100)
						.attr('height', 100);
			});
		},
		invoke: function(holder, userData){
			var data = this.buildDataStream(userData);

			var patternsSvg = d3.select(holder)
								.append('svg')
								.attr('class', 'patterns')
								.attr('width', 0)
								.attr('height', 0);
			
			this.addUserPatterns(patternsSvg, userData);
			
			return data;
		}
	};

		 




	var nodeMaker = {
		recursiveNode: function(value, nodes, level){
			var that = this;
			
			var children = new Array();
			if(value.children.length > 0){
				for(var c=0;c<value.children.length;c++){
					children.push(value.children[c].name);
				}
			}
			
			var orbSizesArray = [125, 55, 5, 1];
			
			var count = orbSizesArray[level];
					
			var localNode = {
						"name": value.name,					
						"group": value.group,
						"label": value.label,
						"level": level,
						"count": count,
						"linkCount": value.children.length,
						"children": children
					};
			nodes.push(localNode);		

			if(value.children.length > 0){
				level++;
				for(var c=0;c<value.children.length;c++){
					that.recursiveNode(value.children[c], nodes, level);
				}
			}
		},
		createNode: function(data){
			var that = this;
			var nodes = new Array();

			$.each(data, function(index, value) {	
				var level = 0;		
				that.recursiveNode(value, nodes, level);
			});

			return that.discoverChildren(nodes);
		},
		findPosition: function(nodes, c){		
			var pos = 0;
			$.each(nodes, function(i, x) {
				if(x.name == c){
					pos = i;
					return false;
				}
			});	
			
			return pos;
		},
		discoverChildren: function(nodes){
			var that = this;
			
			$.each(nodes, function( index, value ) {
				var childrenPositionArray = new Array();
				$.each(value.children, function(i, c) {
					childrenPositionArray.push(that.findPosition(nodes, c)); //positionOfChild
				});

				nodes[index]["childrenPositions"] = childrenPositionArray;
				nodes[index]["nodePosition"] = index;
			});

			return nodes;
		},
		createLinks: function(nodes){

			var links = new Array();

			$.each(nodes, function(i, val) {
				var source = val.nodePosition;
					
				if(val.childrenPositions.length > 0){
				
					for(var c=0;c<val.childrenPositions.length;c++){
						var target = val.childrenPositions[c];
						
						localLink = {
							"source": source,
							"target": target,
							"depth": 1,
							"count": 1		
						};
						
						links.push(localLink);
					}
				}			
			});
					
			return links;
		}
	};
		
		
		





		var userData = [
			{
				"userName": "Rihanna",
				"userImage": "http://1.bp.blogspot.com/-Wk0AVFkQKGo/UQmzbP-GVrI/AAAAAAAAAtA/_Quew4zdLTs/s640/rihanna.jpg",
				"interests": [
						{
							"Gardening": 10
						},
						{
							"Feng Shui": 10
						},
						{
							"Bowling": 15
						},
						{
							"Sculpting": 35
						},
						{
							"Trekking": 15
						}
				]
			},
			{
				"userName": "Brody",
				"userImage": "http://i.dailymail.co.uk/i/pix/2010/06/17/article-1287046-09F10D58000005DC-75_634x576.jpg",
				"interests": [
						 {
							"Painting": 30
						},
						{
							"Comics": 10
						},
						{
							"Bodybuilding": 15
						},
						{
							"Sculpting": 35
						},
						{
							"Trekking": 15
						}
				]
			}
		];
		
		


$( document ).ready(function() {
	
	var holder = "#chart2";
	var nodes = nodeMaker.createNode(forceChart.invoke(holder, userData));

	window['mcpherTreeData'] = {
		"d3": {
			"options": {
				"radius": "10",
				"fontSize": "12",
				"labelFontSize": "25",
				"nodeResize": "count",
				"nodeLabel": "label",
				"outerRadius": "480"
			},
			"data": {
				"nodes": nodes,
				"links": nodeMaker.createLinks(nodes)
			}
		}
	};

	doTheTreeViz(holder, mcpherTreeData);
});
            