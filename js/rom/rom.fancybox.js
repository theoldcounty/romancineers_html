/*
* Romanineers
* rom.fancybox.js
* Author: Rob Shan Lone
* Copyright (c) 2012 The Old County Limited.
*
* All rights reserved.
*/

var fancybox = {
	getOptions: function(){
		var options = {
			width	: "70%",
			minWidth : 400,
			maxWidth	: "70%",
			fitToView	: false,
			padding: 0,
			helpers: {
				overlay: {
					locked: false
				}
			}
		};
		
		return options;
	},
	invoke: function(el){
		var options = this.getOptions();
		
		if(el.hasClass("fancybox.ajax")){
			if(el.data("width") != undefined){
				options["width"] = el.data("width");
				options["maxWidth"] = el.data("width");
			}
			options["beforeShow"] = function(){
				$('.fancybox-type-ajax.fancybox-wrap').css("visibility", "hidden");			
				appController.invoke(".fancybox-wrap");
			};
					
			options["afterShow"] = function(){
				setTimeout(function(){
					var wrapper = $('.fancybox-type-ajax.fancybox-wrap');
					wrapper.css("width", options["maxWidth"]);
				
					wrapper.css("opacity", 0);
					wrapper.css("visibility", "visible");
					$.fancybox.reposition();

					wrapper.animate({
						opacity: 1,
					}, 300, function() {
						// Animation complete.
					});
				},10);
			}
		}
		
		el.fancybox(options);
		
	},
	ajaxBased: function(url, callback){
		console.log("get fancy");
		
		var options = this.getOptions();
		
		options["type"] = "ajax";
		options["href"] = url;
		options["title"] = "Lorem lipsum";
		
		options["beforeShow"] = function(){
			//$('.fancybox-type-ajax.fancybox-wrap').css("visibility", "hidden");
			callback();
		};
		
		$.fancybox(options);	
	}
};
