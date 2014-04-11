
	var matchMaker = {
		setContainer: function(el){
			this.container = el;
		},
		getContainer: function(){
			return this.container;
		},
		invoke: function(el){								
			var that = this;
			this.setContainer(el);
				
			// handle click events
			this.getContainer().on( 'click', '.user', function( event ) {
				var $this = $( this );
				//event.preventDefault();
				// if not already open, do so
				if ( !$this.hasClass( 'open' ) ){
					matchMaker.shunt($this.index());
				}
			});							
			
			setTimeout(function(){
				that.getContainer().find('li.user').eq(1).click();
			},500);
			
			this.resized();
			window.onresize = function(event) {
				that.resized();
			};
		},
		shunt: function(i){
			var elWidth = parseInt(this.getContainer().find('li.user').outerWidth(),10);
			
			var shuntpix = elWidth*(i-1);

			this.getContainer().animate({
					left: "-"+shuntpix,
			}, 200, function() {
				// Animation complete.
			});
		},
		resized: function(){
			var elWidth = parseInt(this.getContainer().find('li.user').outerWidth(),10);
			var count = this.getContainer().find('li.user').length;
			var buffer = 1000;

			this.getContainer().css("width", (count * elWidth)+buffer);							
		}
	}	