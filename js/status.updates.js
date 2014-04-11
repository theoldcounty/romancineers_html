	

var data = [
    {
        "stream": [
            {
                "userId": "isdskfk324023",
                "userName": "Melanie",
                "userAge":31,
                "userState": "London",
                "userCountry": "UK",
                "userNotificationDate": "22/03/2014 12:18:43",
                "userNotificationPriority": false,
                "userNotification": "Just came online",
                "userImage": "http://www.gossip-gravy.com/wp-content/uploads/2013/08/GwenStefaniNoDoubt4.jpg",
                "userLink": "#"
            },
            {
                "userId": "gi3240924",
                "userName": "Gill",
                "userAge":32,
                "userState": "London",
                "userCountry": "UK",
                "userNotificationDate": "22/03/2014 12:15:43",
                "userNotificationPriority": false,
                "userNotification": "Just came online",
                "userImage": "http://uk.eonline.com/eol_images/Entire_Site/2013719/rs_600x600-130819130517-600.BeyonceBob.mh.081913.jpg",
                "userLink": "#"
            },
            {
                "userId": "pgflgf34534",
                "userName": "Megan",
                "userAge":28,
                "userState": "London",
                "userCountry": "UK",
                "userNotificationDate": "22/03/2014 12:14:43",
                "userNotificationPriority": false,
                "userNotification": "Just came online",
                "userImage": "http://www.guysgab.com/wp-content/uploads/2013/07/Brittany-Mason-5.jpg",
                "userLink": "#"
            },
            {
                "userId": "gm3242323423",
                "userName": "Gemma",
                "userAge":32,
                "userState": "London",
                "userCountry": "UK",
                "userNotificationDate": "22/03/2014 12:12:43",
                "userNotificationPriority": true,
                "userNotification": "Just messaged you",
                "userImage": "http://www.solveisraelsproblems.com/wp-content/uploads/2012/05/Esti-Ginzburg-18.jpg",
                "userLink": "#"
            },
            {
                "userId": "dfjfd23223324",
                "userName": "Jessica",
                "userAge":32,
                "userState": "London",
                "userCountry": "UK",
                "userNotificationDate": "22/03/2014 12:02:43",
                "userNotificationPriority": false,
                "userNotification": "Just viewed your profile",
                "userImage": "http://img2.timeinc.net/people/i/2008/database/ashleytisdale/ashleytisdale300.jpg",
                "userLink": "#"
            }
        ]
    },
    {
        "stream": [
            {
                "userId": "pgflgf34534",
                "userName": "Megan",
                "userAge":28,
                "userState": "London",
                "userCountry": "UK",
                "userNotificationDate": "21/03/2014 11:22:43",
                "userNotificationPriority": true,
                "userNotification": "Just messaged you",
                "userImage": "http://www.guysgab.com/wp-content/uploads/2013/07/Brittany-Mason-5.jpg",
                "userLink": "#"
            },
            {
                "userId": "gm3242323423",
                "userName": "Gemma",
                "userAge":32,
                "userState": "London",
                "userCountry": "UK",
                "userNotificationDate": "22/03/2014 11:12:43",
                "userNotificationPriority": false,
                "userNotification": "Just viewed your profile",
                "userImage": "http://www.solveisraelsproblems.com/wp-content/uploads/2012/05/Esti-Ginzburg-18.jpg",
                "userLink": "#"
            },
            {
                "userId": "dfjfd23223324",
                "userName": "Jessica",
                "userAge":32,
                "userState": "London",
                "userCountry": "UK",
                "userNotificationDate": "22/03/2014 11:02:43",
                "userNotificationPriority": false,
                "userNotification": "Just viewed your profile",
                "userImage": "http://img2.timeinc.net/people/i/2008/database/ashleytisdale/ashleytisdale300.jpg",
                "userLink": "#"
            },
            {
                "userId": "xcvxcvmxcdsf",
                "userName": "Penolope",
                "userAge":32,
                "userState": "Texas",
                "userCountry": "USA",
                "userNotificationDate": "22/03/2014 12:02:43",
                "userNotificationPriority": false,
                "userNotification": "Just joined",
                "userImage": "http://zuqka.nation.co.ke/wp-content/uploads/2013/08/Lady-Gaga.jpg",
                "userLink": "#"
            }
        ]
    },
    {
        "stream": [
            {
                "userId": "kdsfm324",
                "userName": "Mel",
                "userAge":32,
                "userState": "London",
                "userCountry": "UK",
                "userNotificationDate": "26/03/2014 12:02:43",
                "userNotificationPriority": true,
                "userNotification": "Just messaged you",
                "userImage": "http://i.perezhilton.com/wp-content/uploads/2013/07/mel-b-pics-mel-b-14591627-450-680__oPt.jpg",
                "userLink": "#"
            },
            {
                "userId": "345fdfdf345",
                "userName": "Kelly",
                "userAge":32,
                "userState": "London",
                "userCountry": "UK",
                "userNotificationDate": "26/03/2014 12:02:12",
                "userNotificationPriority": false,
                "userNotification": "Just viewed your profile",
                "userImage": "http://how-lovely.org/wp-content/uploads/2013/05/Kelly-Brook-01.jpg",
                "userLink": "#"
            }
        ]
    }
]


statusHandler = {
    invoke: function(){        
        this.populateIsotope(data[0].stream);
        this.lastData = data[0].stream;
		this.startIsotope();
    },
	getContainer: function(){
		return $('#status #isotope');
	},
	startIsotope: function(){
		var that = this;
		
		var $container = this.getContainer();
		
			// @see {@link http://fgnass.github.io/spin.js}
			spinJsConfiguration = {
				lines: 5, // The number of lines to draw
				length: 3, // The length of each line
				width: 2, // The line thickness
				radius: 6, // The radius of the inner circle
				color: '#666' // #rgb or #rrggbb or array of colors
			};

		// initialize isotope
		$container.isotope({
			masonry: {
				columnWidth: 30
			},
			getSortData: {
				date: function ($elem) {
					var dates = $elem.attr('data-user-notification-date');
					
					dateArray = dates.split('/'),
						year = dateArray[2].substr(0, 4),
							month = dateArray[1],
								day = dateArray[0];
					
					timeArray = dates.split(':'),
						hours = timeArray[0].slice(-2),
							minutes = timeArray[1],
								seconds = timeArray[2];
					
					return new Date(year, month, day, hours, minutes, seconds);                
				}
			}
		});


		that.showPriorityItem();

		window.setInterval(function(){
			console.log("new data time");
			that.getUpdate();
		},20000);	
		

		// handle click events
		$container.on( 'click', '.user', function( event ) {
			var $this = $( this );

			event.preventDefault();

			// if not already open, do so
			if ( !$this.hasClass( 'open' ) ){
				var $openItem = $container.find( '.open' );

				// if any, close currently open items
				if ( $openItem.length ) {
					closeItem( $openItem );
				}

				openItem( $this );
			}
		});

		$container.on( 'click', '.close', function( event ) {
			event.stopPropagation();
			closeItem( $( this ).closest( '.user' ) );
		});

		function openItem( $item ) {
			var $image = $item.find( '.user-image' );

			$item.addClass( 'loading' ).spin( spinJsConfiguration );

			// @todo we should only replace the image once
			$image.attr( 'src', $image.data( 'src-large' ) );

			// at least for the sake of this demo we can use the "imagesLoaded" plugin contained within
			// Isotope to determine if the large version of the user image has loaded
			// @todo Isotope v1 contains an outdated version of the "imagesLoaded" plugin - please use the current one
			// @see {@link https://github.com/desandro/imagesloaded}
			$item.imagesLoaded( function() {
				$item.spin( false ).removeClass( 'loading' ).addClass( 'open' );
				$container.addClass( 'item-open' ).isotope( 'reLayout' );
				$item.append( '<div class="close">&times;</div>' );
			});
		}

		function closeItem( $item ) {
			$item.removeClass( 'open' ).find( '.close' ).remove();
			$container.removeClass( 'item-open' ).isotope( 'reLayout' );
		}	
	},
    lastData: "",
    getTemplate: function(){        
        return this.getContainer().find('li').eq(0).clone();
    },
    buildItem: function(data, temp){
        var that = this;   
        
        var template = temp.clone();
        $(template).attr("data-user-id", data.userId);   
        $(template).attr("data-user-notification-priority", data.userNotificationPriority); 
        $(template).attr("data-user-notification-date", data.userNotificationDate);
        
        $(template).find(".user-link").attr("href", data.userLink);
        $(template).find(".user-image").attr("src", data.userImage);
        $(template).find(".user-image").attr("data-src-large", data.userImage);
        $(template).find(".user-image").attr("data-src-standard", data.userImage);
        $(template).find(".user-title").text(data.userName+", "+data.userAge);
        $(template).find(".user-location").text(data.userState+", "+data.userCountry);
        
        $(template).find(".user-description").text(data.userNotification);
        
        return $(template);
    },
    populateIsotope: function(data){
        var that = this;
        
        var temp = that.getTemplate();
        this.oldTemplate = temp;
        this.getContainer().empty();
        $.each(data, function(index, value) {
            that.getContainer().append(that.buildItem(value, temp));
        });        
    },
	showPriorityItem: function(){
		var that = this;
		var $container = this.getContainer();
		
		setTimeout(function(){
			$container.isotope({ sortBy: 'date' });
			
			var $priorityItems = $('[data-user-notification-priority=true]');
			that.openPriority($priorityItems);
		},500);	
	},
    getUpdate: function(){
			var that = this;
			
			function getRandomInt (min, max) {
				return Math.floor(Math.random() * (max - min + 1)) + min;
			}
			
			var rand = getRandomInt(0, 2);
			
			$container = this.getContainer();
			
			var oldDataStream = this.lastData;
			var newDataStream = data[rand].stream;
			
			//isolate items to remove - no longer in the new data stream
			var redundantItems = this.differenceItems(oldDataStream, newDataStream, "old");
			if(redundantItems.length > 0){
				var selector = "";
				$.each(redundantItems, function(index, value) {
					selector += '[data-user-id="'+value.userId+'"],';
				});
				selector = selector.slice(0,-1);            
				this.removeOldItems($(selector));
			}
			
			//isolate items to insert - now apparent in new data stream
			//__insert new items
			var newItems = this.differenceItems(oldDataStream, newDataStream, "new");
			if(newItems.length > 0){
				var temp = that.oldTemplate;
				
				var newItemHtml = "";
				$.each(newItems, function(index, value) {
					var el = $('<div>').append(that.buildItem(value, temp).clone()).html();
					
					//filter out - do not ADD items that ALREADY exist!
					if(!$('[data-user-id="'+value.userId+'"]').length > 0){
						newItemHtml += el;
					}
				});        
				this.insertNewItems(newItemHtml);
			}
			//__insert new items
			
			
			//modify existing items - changing pictures/notifications etc...
			
						
			that.showPriorityItem();
			
			
			//__replace last data stream to the current
			this.lastData = newDataStream;
			
        },
        pluckById:function(inArr, userId){
            var exists = true;//does the object id exist in the array
            
            for (i = 0; i < inArr.length; i++ ){
                if (inArr[i].userId == userId){
                    return (exists === true) ? true : inArr[i];
                }
            }
        },
        differenceItems: function(PreviousArr, CurrentArr, type){    
            var that = this;
            
            var items = new Array();
            
            //loop through the newDataSteam and look for items in oldDataStream    
            var CurrentArrSize = CurrentArr.length;
            var PreviousArrSize = PreviousArr.length;
            
            if(type == "old"){
                for(var j = 0; j < PreviousArrSize; j++) {
                    var inCurrentArray = that.pluckById(CurrentArr, PreviousArr[j].userId);
                    if(inCurrentArray == undefined){
                        items.push(PreviousArr[j]);//item no longer seen in old array
                    }
                }
            }else{
                for(var j = 0; j < CurrentArrSize; j++) {
                    var inPreviousArray = that.pluckById(PreviousArr, CurrentArr[j].userId);
                    if(inPreviousArray == undefined){
                        items.push(CurrentArr[j]);//items new from old array
                    }
                }
            }
            
            return items;
        },
        insertNewItems: function(newItemHtml){
            var that = this;
			
			var $newItems = $(newItemHtml);
			$container = this.getContainer();
            $container.isotope('insert', $newItems);

			setTimeout(function(){
				that.getContainer().find(".user").css("opacity", "");
			},500);				
			
        },
        removeOldItems: function($oldItems){
            $container = this.getContainer();
			$container.isotope('remove', $oldItems);    
        },
        openPriority: function($priorityItems){
            $priorityItems.click();
        }
} 
    

$(document).ready(function() {
	statusHandler.invoke();
});
