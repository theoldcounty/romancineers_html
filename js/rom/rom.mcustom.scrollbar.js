/*
*	Mcustomscroller
*
*	Author: Rob Shan Lone
*	Copyright (c) 2013 The Old County Limited.
*
*	All rights reserved.
*/

var mcustomscroller = {
	init: function(){
		//$(window).load(function(){
			$('[data-custom-scroller="true"]').each(function(index) {
				
				console.log("start the mobile scroller");
				
				if(!$(this).data("horizontalscroll")){				
					$(this).css("height", parseInt($(this).parent().css("height"),10));
				}
				
				
				var config= {
					horizontalScroll: $(this).data("horizontalscroll"),
					theme: $(this).data("theme"),
					advanced:{
						autoExpandHorizontalScroll:true,
						updateOnContentResize: true,
						updateOnBrowserResize: true
					},
					scrollButtons:{
					  enable:true
					},
					scrollInertia: 600
				}

				$(this).mCustomScrollbar(config);
			});
		//});
	}
}

