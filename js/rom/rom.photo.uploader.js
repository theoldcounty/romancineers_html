

var photoHandler = {
	invoke: function(el){
		var that = this;
		
		el.find("input").change(function() {
			if(!el.find("input").hasClass("invalid")){
				that.incrementImage(el);
			}
		});	
	},
	incrementImage: function(el) {

		//that.submithandler();

		//increment number of photos
		var text = $('.uploadfooter span').text();
		var count = parseInt(text.match(new RegExp("[0-9]*", "g"))[0], 10) + 1;//increment it
		text = text.replace(new RegExp("[0-9]+", "g"), count);
		$('.uploadfooter span').text(text);
		
    }
}