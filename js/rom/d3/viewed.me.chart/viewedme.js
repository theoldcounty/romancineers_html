
var viewedapp = {
	invoke: function(){
			
			var w = 285;
			var h = 285;
	

			 var dataset = [],
				i = 0;

				for(i=0; i<75; i++){
					dataset.push(Math.round(Math.random()*100));
				}

				var viz = d3.select("#viz")
					.append("svg")
					.attr("width", w)
					.attr("height", h)
				.append("g")
					.attr("transform", "translate("+(w*.1)+",0)")
					
					
				var pattern = viz.append("svg")
								.append("defs")
								.append("pattern")
									.attr("id", "img1")
									.attr("width", (w*.16))
									.attr("height", (h*.16))
									.attr("patternUnits", "userSpaceOnUse")
								.append("image")
									.attr("xlink:href", "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSTzjaQlkAJswpiRZByvgsb3CVrfNNLLwjFHMrkZ_bzdPOWdxDE2Q")
									.attr("x", 0)
									.attr("y", 0)
									.attr("width", (w*.16))
									.attr("height", (h*.16))					
					

				var user = viz.append("g")
					.attr("transform", "translate("+(w*.09)+",0)")
					.append("circle")
						.attr("class", "user")
						.style("stroke", "gray")
						.style("fill", "url(#img1)")
						.attr("r", (w*.06))
						.attr("cx", -(w*.098))
						.attr("cy", (h*.416))  
				
				
				function buildContainer(viz, className, radius, colour, cx, cy){
					var containingCircle = viz.append("g")
						.attr("class", className)
					
					containingCircle
						.append("g")
							.attr("class", "containingholder")
								.append("circle")
								.attr("class", "containing")
								.style("stroke", "gray")
								.style("stroke-dasharray", ("3, 3"))
								.style("fill", colour)
								.attr("r", radius)
								.attr("cx", cx)
								.attr("cy", cy)   
					
					containingCircle
						.append("g")
						.attr("class", "dotholder")

				}


				buildContainer(viz, "followers", (w *.38), "brown", (w *.45), (w *.4));
				buildContainer(viz, "following", (w *.26), "purple", (w *.33), (w *.4));
				buildContainer(viz, "matches", (w *.19), "green", (w *.26), (w *.4));

				window.xps = [];
				window.yps = [];

				function getXCoordinateInCircleSection(i, x, y, r, xa, ya, ra) {
					best = 0;
					for (var c=0; c<i+1; c++) {
						done = false;
						while (!done) {
							xp = getRandomCoordinate(x-r, x+r);
							yp = getRandomCoordinate(y-r, y+r);
							done = true;
							if ((xp-x)*(xp-x)+(yp-y)*(yp-y) > (r-12)*(r-12)) done = false;
						   if ((xp-xa)*(xp-xa)+(yp-ya)*(yp-ya) < (ra+12)*(ra+12)) done = false;
						}
						dist = 1000000;
						for (var j=0; j<i; j++) {
							d = (window.xps[j]-xp)*(window.xps[j]-xp)+(window.yps[j]-yp)*(window.yps[j]-yp);
							if (d<dist) dist = d;
						}
						if (dist>best) {
							xb = xp;
							yb = yp;
							best = dist;
						}
					}
					window.xps[i] = xb;
					window.yps[i] = yb;
					return xb;
				}

				function getYCoordinateInCircleSection(i) {
					return window.yps[i];
				}
				
				function getRandomCoordinate(min, max){
					return Math.floor(Math.random() * (max - min + 1)) + min;
				}

			// add followers markers
			function plotDots(className, dataset, colour, x, y, r, xa, ya, ra){
				
				var holder = d3.select("g."+className+" .dotholder");
					
					holder.selectAll("circle")
						.data(dataset)
							.enter().append("circle")
							.style("stroke", "gray")
							.style("fill", colour)
							.attr("r", 3.5)
							.attr("cx", function(d, i){
								return getXCoordinateInCircleSection(i, x, y, r, xa, ya, ra);
							})
							.attr("cy", function(d, i){
							   return getYCoordinateInCircleSection(i);
							});

			}

			plotDots("followers", dataset, "orange",(w *.45), (h *.4), (w *.38), (w *.3), (h *.4), (w *.26));
			plotDots("following", dataset, "green", (w *.33), (h *.4), (w *.26), (w *.26), (h *.4), (w *.19));
			plotDots("matches", dataset, "blue", (w *.26), (h *.4), (w *.19), 0, 0, 0);
				
	}
}
