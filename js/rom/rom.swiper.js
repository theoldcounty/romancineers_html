/*
* Romanineers
* rom.swiper.js
* Author: Rob Shan Lone
* Copyright (c) 2012 The Old County Limited.
*
* All rights reserved.
*/

var swiper = {
	swiperstorage: new Array(),
	getSwiper: function(id){
		var swiperunit = "";
		$.each(this.swiperstorage, function( index, value ) {
			if(value.id == id){
				swiperunit = value.swiper;
				return false;
			}
		});
		
		return swiperunit;
	},
	nextSwipe: function(s){
		s.reInit();
		s.swipeNext();
	},
	prevSwipe: function(s){
		s.reInit();
		s.swipePrev();
	},
	invoke: function(el){
		var options = {
			mode: el.data("direction"),
			loop: el.data("loop"),
			grabCursor: el.data("grabcursor"),
			speed: el.data("speed"),
			showpagination: el.data("showpagination"),
			arrows: el.data("arrows"),
			paginationClickable: el.data("paginationclickable"),
			noSwiping: el.data("noswiping"),
			initialSlide: el.data("initialslide"),
			preventLinksPropagation: true
		}
		
		if(options["showpagination"]){
			el.append('<div class="pagination"/>');
			options["pagination"] = el.find('.pagination')[0];
		}

		if(options["arrows"]){
			el.prepend('<a class="arrow-left"/>');
			el.prepend('<a class="arrow-right"/>');
		}

		var index = this.swiperstorage.length+1;
		var selector = "swiper"+index;
		el.attr("id", selector);
		
		el.find('.swiper-container').css("height", parseInt(el.parent().css("height"), 10));
	
		var mySwiper = new Swiper(el.find('.swiper-container')[0],options);
		
		var swiperObj = {
			"index": index,
			"id": selector,
			"swiper": mySwiper
		}
		
		this.swiperstorage.push(swiperObj);
		
		el.find('.arrow-left').on('click', function(e){
			e.preventDefault();
			mySwiper.swipePrev();
		})
		
		el.find('.arrow-right').on('click', function(e){
			e.preventDefault();
			mySwiper.swipeNext();
		})	
	}
}