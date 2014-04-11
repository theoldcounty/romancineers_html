var tileHandler = {
	getColWidth : function(){
		var cw = 150;
		
		if($(window).width() <= 465){
			cw = 80;
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
		this.isotope();
		
		that.resized();
		window.onresize = function(event) {
			that.resized();
		};		
	},
	resized: function(){
		if(this.getContainer().length > 0){
			this.isotope();
		}
	}
}