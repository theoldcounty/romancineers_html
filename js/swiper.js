
var swiper = {
	invoke: function(el){
	
		var options = {
			mode: el.data("direction"),
			pagination: el.find('.pagination')[0],
			loop:true,
			grabCursor: true,
			paginationClickable: true
		}
		
		
		el.find('.swiper-container').css("height", parseInt(el.parent().css("height"), 10));
	
		var mySwiper = new Swiper(el.find('.swiper-container')[0],options);
		
		el.find('.arrow-left').on('click', function(e){
			e.preventDefault()
			mySwiper.swipePrev()
		})
		
		el.find('.arrow-right').on('click', function(e){
			e.preventDefault()
			mySwiper.swipeNext()
		})	
	}
}