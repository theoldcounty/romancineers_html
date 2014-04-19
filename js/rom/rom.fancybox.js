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
		options["beforeShow"] = function(){
			console.log("invoke app");
			appController.invoke();
		};
		
		el.fancybox(options);	
	},
	ajaxBased: function(url, callback){
		console.log("get fancy");
		
		var options = this.getOptions();
		
		options["type"] = "ajax";
		options["href"] = url;
		options["title"] = "Lorem lipsum";
		
		options["beforeShow"] = function(){
			callback();
		};
		
		$.fancybox(options);	
	}
};
