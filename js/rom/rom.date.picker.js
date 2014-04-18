

var datePicker = {
	invoke: function(el){
		var options = {};
		
		options["showAnim"] = $(el).data("showanim");
		
		$(el).datepicker(options);
	}
}