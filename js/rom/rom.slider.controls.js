/**
	* @class Romance Slider Controls
	* @description Slider Controls
*/

var sliderControls = Backbone.View.extend({
	initialize : function() {
		var that = this;
		
		var sliders = this.$el.find(" > span");

        // setup graphic EQ
        sliders.each(function() {
            // read initial values from markup and remove that
            var value = parseInt($(this).text(), 10);
			//console.log("value",value);

			var options = {
				value: value,
				orientation: "horizontal",
				range: "min",
				animate: true,
				disabled: $(that.$el).data("disable")
			};
            $(this).empty().slider(options);
			
			$(this).append('<div class="label left">'+$(this).data("label-left")+'</div>');
			$(this).append('<div class="label right">'+$(this).data("label-right")+'</div>');
			
        });
		this.bindEvents();
	},

	bindEvents: function() {
		//console.log("click event");

		$('.ui-slider-handle').on("click", function(event){
			console.log("click detect", this);
			var value = parseInt($(this).css("left"), 10);
			//console.log("new val", value);
		});
	}

});
