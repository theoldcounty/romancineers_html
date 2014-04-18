
var autocomplete = {
	invoke: function(el){
	
		var options = {};
		
		options["source"] = $(el).data("availabletags").split(","); 
		options["minlength"] = $(el).data("minlength");
		
		$(el).autocomplete(options);
	},
	newSource: function(el, newData){
		//[ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ]
		$(el).autocomplete("option", "source", newData);
	}
}