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
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			padding: 0,
			helpers: {
				overlay: {
					locked: false
				}
			},
			beforeShow: function(){

				var section = $(this).attr("href");
				//pageHandler.reBindEvents(section);
				
				//tabs.init();
			}
		};
		
		el.fancybox(options);	
	}
};
