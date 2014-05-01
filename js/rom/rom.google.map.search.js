

var googleMapApp = {
    newShape: "",
    markers: [],
    map: "",
	isInRegion: function(){
				

			if (!google.maps.Polygon.prototype.getBounds) {
			  google.maps.Polygon.prototype.getBounds = function(latLng) {
				var bounds = new google.maps.LatLngBounds();
				var paths = this.getPaths();
				var path;
				
				for (var p = 0; p < paths.getLength(); p++) {
				  path = paths.getAt(p);
				  for (var i = 0; i < path.getLength(); i++) {
					bounds.extend(path.getAt(i));
				  }
				}

				return bounds;
			  }
			}

			// Polygon containsLatLng - method to determine if a latLng is within a polygon
			google.maps.Polygon.prototype.containsLatLng = function(latLng) {
			  // Exclude points outside of bounds as there is no way they are in the poly
			 
			  var lat, lng;

			  //arguments are a pair of lat, lng variables
			  if(arguments.length == 2) {
				if(typeof arguments[0]=="number" && typeof arguments[1]=="number") {
				  lat = arguments[0];
				  lng = arguments[1];
				}
			  } else if (arguments.length == 1) {
				var bounds = this.getBounds();

				if(bounds != null && !bounds.contains(latLng)) {
				  return false;
				}
				lat = latLng.lat();
				lng = latLng.lng();
			  } else {
				console.log("Wrong number of inputs in google.maps.Polygon.prototype.contains.LatLng");
			  }

			  // Raycast point in polygon method
			  var inPoly = false;

			  var numPaths = this.getPaths().getLength();
			  for(var p = 0; p < numPaths; p++) {
				var path = this.getPaths().getAt(p);
				var numPoints = path.getLength();
				var j = numPoints-1;

				for(var i=0; i < numPoints; i++) {
				  var vertex1 = path.getAt(i);
				  var vertex2 = path.getAt(j);

				  if (vertex1.lng() < lng && vertex2.lng() >= lng || vertex2.lng() < lng && vertex1.lng() >= lng) {
					if (vertex1.lat() + (lng - vertex1.lng()) / (vertex2.lng() - vertex1.lng()) * (vertex2.lat() - vertex1.lat()) < lat) {
					  inPoly = !inPoly;
					}
				  }

				  j = i;
				}
			  }

			  return inPoly;
			}
	
	
	},
    setAllMap: function(map) {
        for (var i = 0; i < this.markers.length; i++) {
            this.markers[i].setMap(map);
        }
    },
    clearMarkers: function() {
        this.setAllMap(null);
    },
    showMarkers: function() {
        this.setAllMap(this.map);
    },
    setMarkers: function(map, locations) {
        var that = this;
        
        var image = {
            url: 'http://www.dirtbikerider.com/tmx/images/markers/marker0.png',
            size: new google.maps.Size(20, 32),// 20 pixels wide by 32 pixels tall.
            origin: new google.maps.Point(0,0),// The origin for this image is 0,0.
            anchor: new google.maps.Point(0, 32)// The anchor -  base of the flagpole at 0,32.
        };
        
        var shape = {
            coord: [1, 1, 1, 20, 18, 20, 18 , 1],
            type: 'poly'
        };
        
        for (var i = 0; i < locations.length; i++) {
            var beach = locations[i];
            var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: image,
                shape: shape,
                title: beach[0],
                zIndex: beach[3]
            });
            that.markers.push(marker);
        }
    },
    revealInsidePolygon: function(shape){
        var that = this;
        
        that.clearMarkers();
        $.each(that.markers, function( index, value ) {            
            var lat = value.getPosition().A;
            var lng = value.getPosition().k;
            
            if(isInPolygon(shape, lat, lng)){
                console.log("is in poly");
                
                that.markers[index].setMap(that.map);
                
            }else{
                console.log("not in");
            }
        });                
        
        function isInPolygon(shape, lat, lng){
            var coordinate = new google.maps.LatLng(lng, lat);
            var isWithinPolygon = shape.containsLatLng(coordinate);  
            
            console.log("isWithinPolygon", isWithinPolygon);
            return isWithinPolygon;
        }
    },
	generateMap: function(){
		var that = this;
		
		
		this.resolveSectionHeight();
		
        this.map = null;
        var mapDefaults = {
            zoom: 3,
            center: null,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
		
		var mapPosition = new google.maps.LatLng(13.890542, 91.274856);
		mapDefaults.center = mapPosition;
		that.map = new google.maps.Map(document.getElementById("map_canvas"), mapDefaults);
		
		var points = [
			['Bondi Beach', 23.890542, 30.274856, 7],
			['Bondi Beach', 33.890542, 31.274856, 6],
			['Bondi Beach', -33.890542, 151.274856, 4],
			['Coogee Beach', -33.923036, 151.259052, 5],
			['Cronulla Beach', -34.028249, 151.157507, 3],
			['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
			['Maroubra Beach', -33.950198, 151.259302, 1]
		];
		
		that.setMarkers(that.map, points);	
	},
	resolveSectionHeight: function(){

		var windowHeight = $(window).height();
		console.log("windowHeight", windowHeight);
		
		var headerHeight = $('header').height();
		var footerHeight = $('footer').height();
		
		var remainingMapArea = windowHeight - headerHeight - footerHeight;
		
		$('.googlemaps').css("height", remainingMapArea);	
	},
    invoke: function(){
        var that = this;
		
		this.generateMap();
		this.isInRegion();
		
		$(".editing").click(function(e) {
            e.preventDefault();
            
            if($(this).data("editing")){
                $(this).data("editing", false);
                that.newShape.setEditable(false);
            }else{
                $(this).data("editing", true);
                that.newShape.setEditable(true);
                
                google.maps.event.addListener(that.newShape.getPath(), 'set_at', function(msg){
                    console.log("set_at msg", msg);
                    that.revealInsidePolygon(that.newShape);
                });
                
                
                google.maps.event.addListener(that.newShape.getPath(), 'insert_at', function(msg){
                    console.log("insert_at msg", msg);
                    that.revealInsidePolygon(that.newShape);
                });
                
                
                google.maps.event.addListener(that.newShape.getPath(), 'remove_at',function(msg){
                    console.log("remove_at msg", msg);
                    that.revealInsidePolygon(that.newShape);
                });                
                
                
            }
        });
        
        $(".clearing").click(function(e) {
            e.preventDefault();
            console.log("clear");
            that.newShape.setMap(null);
            that.showMarkers();
        });
        
        $(".clearmarkers").click(function(e) {
            e.preventDefault();
            console.log("clearmarkers");
            that.clearMarkers();
        });
        
        $(".showmarkers").click(function(e) {
            e.preventDefault();
            console.log("showmarkers");
            that.showMarkers();
        });
        
        
        $(".drawfreehand").click(function(e) {
            e.preventDefault();
            console.log("drawfreehand");
            
            function drawFreeHand(){
                
                
                var polygonOptions = {
                    map: that.map,
                    fillColor: '#0099FF',
                    fillOpacity: 0.7,
                    strokeColor: '#AA2143',
                    strokeWeight: 2,
                    clickable: false,
                    zIndex: 1,
                    editable: false
                }
                
                //the polygon
                that.newShape= new google.maps.Polyline(polygonOptions);
                
                //move-listener
                var move = google.maps.event.addListener(that.map,'mousemove',function(e){
                    that.newShape.getPath().push(e.latLng);
                });
                
                //mouseup-listener
                google.maps.event.addListenerOnce(that.map,'mouseup',function(e){
                    
                    
                    google.maps.event.removeListener(move);
                    
                    var path= that.newShape.getPath();
                    console.log("path", path);
                    
                    that.newShape.setMap(null);
                    
                    var theArrayofLatLng = path.j;
                    var ArrayforPolygontoUse= GDouglasPeucker(theArrayofLatLng,300); 
                    console.log("ArrayforPolygontoUse", ArrayforPolygontoUse);
                    
                    var polygonOptions = {
                        map: that.map,
                        fillColor: '#0099FF',
                        fillOpacity: 0.7,
                        strokeColor: '#AA2143',
                        strokeWeight: 2,
                        clickable: false,
                        zIndex: 1,
                        path:ArrayforPolygontoUse,
                        editable: false
                    }
                    
                    that.newShape=new google.maps.Polygon(polygonOptions);
                    
                    
                    google.maps.event.clearListeners(that.map.getDiv(), 'mousedown');
                    
                    enable()
                    
                    that.newShape.setEditable(false);
                    that.revealInsidePolygon(that.newShape);
                    
                });
            }
            
            function disable(){
                that.map.setOptions({
                    draggable: false, 
                    zoomControl: false, 
                    scrollwheel: false, 
                    disableDoubleClickZoom: false
                });
            }
            
            function enable(){
                that.map.setOptions({
                    draggable: true, 
                    zoomControl: true, 
                    scrollwheel: true, 
                    disableDoubleClickZoom: true
                });
            }
            
            disable()
            
            google.maps.event.addDomListener(that.map.getDiv(),'mousedown',function(e){
                drawFreeHand()
            });
            
            
        });
        
        $(".drawing").click(function(e) {
            e.preventDefault();
            console.log("draw");
            
            var drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: false,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_RIGHT,
                    drawingModes: [google.maps.drawing.OverlayType.POLYGON]
                },
                
                polygonOptions: {
                    fillColor: '#0099FF',
                    fillOpacity: 0.7,
                    strokeColor: '#AA2143',
                    strokeWeight: 2,
                    clickable: true,
                    zIndex: 1,
                    editable: true
                }
            });
            
            drawingManager.setMap(that.map);
            
            google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
                if(e.type != google.maps.drawing.OverlayType.MARKER) {
                    drawingManager.setDrawingMode(null);
                }
                
                // Add an event listener that selects the newly-drawn shape when the user
                // mouses down on it.
                that.newShape = e.overlay;
                that.newShape.type = e.type;
                
                google.maps.event.addListener(that.newShape, 'click', function() {
                    //setSelection(this);
                });
                
                that.newShape.setEditable(false);
                
                
                that.revealInsidePolygon(that.newShape);
                //loop over the markers and check to see if they are inside the polygon shape
                
//that.markers
                
            });            
        });
      
    }
}

