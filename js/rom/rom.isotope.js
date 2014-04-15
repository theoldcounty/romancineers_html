/*
* Romanineers
* rom.isotope.js
* Author: Rob Shan Lone
* Copyright (c) 2012 The Old County Limited.
*
* All rights reserved.
*/


var isotopeHandler = {
	getColWidth : function(){
		var cw = 120;
		if($(window).width() <= 465){
			cw = 80;
			
			if($('.shell').length > 0){
				cw = 60;
			}
		}
		
		return cw;	
	},
	isotope: function(){
		// initialize isotope
		// prevent "First item breaks Masonry layout" issue
		// @see {@link http://isotope.metafizzy.co/docs/help.html#first_item_breaks_masonry_layout}
		
		cw = this.getColWidth();
		
		var $container = this.getContainer();
		$container.isotope({
			masonry: {
				columnWidth: cw
			}
		});	
	},
	setContainer: function(el){
		this.container = el;
	},
	getContainer: function(){
		return this.container;
	},
	container: "",
	invoke: function(el){
		var that = this;
		this.setContainer(el);
		
		var $container = this.getContainer(),
			// @see {@link http://fgnass.github.io/spin.js}
			spinJsConfiguration = {
				lines: 11, // The number of lines to draw
				length: 3, // The length of each line
				width: 2, // The line thickness
				radius: 6, // The radius of the inner circle
				color: '#666' // #rgb or #rrggbb or array of colors
			};
	
		this.isotope();

		// handle click events
		$container.on( 'click', '.user', function( event ) {
			event.preventDefault();
						
			var $this = $(this);

			// if not already open, do so
			if ( !$this.hasClass('open') ){
				var $openItem = $container.find( '.open' );

				// if any, close currently open items
				if ($openItem.length) {
					closeItem( $openItem );
				}
				openItem( $this );
			}
		});
		
		$container.on( 'click', '.user-profile-link', function( event ) {
			event.preventDefault();
			document.location.href = $(this).attr("href");
		});
		
		$container.on( 'click', '.close', function( event ) {
			event.stopPropagation();
			closeItem($(this).closest('.user'));
		});
		
		that.resized();
		window.onresize = function(event) {
			that.resized();
		};		

		function openItem( $item ) {
			var $image = $item.find( '.user-image' );

			$item.addClass('loading').spin( spinJsConfiguration );

			// @todo we should only replace the image once
			$image.attr('src', $image.data('src-large'));

			// at least for the sake of this demo we can use the "imagesLoaded" plugin contained within
			// Isotope to determine if the large version of the product image has loaded
			// @todo Isotope v1 contains an outdated version of the "imagesLoaded" plugin - please use the current one
			// @see {@link https://github.com/desandro/imagesloaded}
			$item.imagesLoaded( function() {
				$item.spin( false ).removeClass('loading').addClass('open');
				$container.addClass('item-open').isotope('reLayout');
				$item.append('<div class="close">&times;</div>');
			});
		}

		function closeItem($item) {
			var $image = $item.find('.user-image');
			$image.attr('src', $image.data('src-standard'));
			
			$item.removeClass('open').find('.close').remove();
			$container.removeClass('item-open').isotope('reLayout');
		}	
	},
	resized: function(){
		if(this.getContainer().length > 0){
			this.isotope();
		}
	}
}