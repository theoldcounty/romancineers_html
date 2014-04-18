/*
*	Mcustomscroller
*
*	Author: Rob Shan Lone
*	Copyright (c) 2013 The Old County Limited.
*
*	All rights reserved.
*/

var mcustomscroller = {
	init: function(el){
		console.log("start the mobile scroller");
		
		if(!el.data("horizontalscroll")){				
			el.css("height", parseInt(el.parent().css("height"),10));
			
			console.log("new height", parseInt(el.parent().css("height"),10));
		}
		
		var config= {
			horizontalScroll: el.data("horizontalscroll"),
			theme: el.data("theme"),
			advanced:{
				autoExpandHorizontalScroll:true,
				updateOnContentResize: true,
				updateOnBrowserResize: true
			},
			scrollButtons:{
			  enable:true
			},
			scrollInertia: 600,
		}

		el.mCustomScrollbar(config);
	},
	destroy: function(el){
		el.mCustomScrollbar("destroy");	
	},
	update: function(el){
		console.log("update the elements");
		el.mCustomScrollbar("update");
	}
}

