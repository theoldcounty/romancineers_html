

var tabs = {
	invoke: function(el){
	
		var options = {};
		
		options["active"] = $.map($(el).data("active").split(','), function(value){ console.log("value", value); return parseInt(value, 10); });
		options["disabled"] = $.map($(el).data("disable").split(','), function(value){ return parseInt(value, 10); });
		
		$(el).css("max-height", $(el).data("max-height"));
		
		$(el).tabs(options);
	},
	disableTab: function(el, index){
		$(el).tabs("disable", index);
	},
	enableTab: function(el, index){
		$(el).tabs("enable", index);
	},
	activeTab: function(el, index){
		$(el).tabs({ active: index });
	}
}