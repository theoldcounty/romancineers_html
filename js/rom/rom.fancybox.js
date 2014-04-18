/*
* Romanineers
* rom.fancybox.js
* Author: Rob Shan Lone
* Copyright (c) 2012 The Old County Limited.
*
* All rights reserved.
*/

var fancybox = {
	invoke: function(el){
		var options = {
			minWidth : 400,
			maxWidth	: "70%",
			fitToView	: false,
			padding: 0,
			helpers: {
				overlay: {
					locked: false
				}
			},
			beforeShow: function(){
				var section = $(this).attr("href");
				console.log("fancy before show");
			},
			onComplete:	function() {
				console.log("fancy complete");
				appController.invoke();
			}	
		};
		
		el.fancybox(options);	
	},
	ajaxBased: function(url, callback){
		$.fancybox({
			type: 'ajax',
			minWidth : 400,
			maxWidth	: "70%",			
			fitToView	: false,
			padding: 0,
			href : url,
			title : 'Lorem lipsum',
			beforeShow : function(){
				callback();
			}
		});	
	}
};
