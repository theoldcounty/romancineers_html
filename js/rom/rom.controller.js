/*
* Romanineers
* rom.controller.js
* Author: Rob Shan Lone
* Copyright (c) 2012 The Old County Limited.
*
* All rights reserved.
*/

var appController = {
	invoke: function(){
		console.log("app invoke");
		
		$('[data-role="isotope-user"]').each(function(){
			isotopeHandler.invoke($(this));		
		});

		$('[data-role="isotope-tiles"]').each(function(){
			tileHandler.invoke($(this));		
		});
		
		$('[data-matchmaker=true]').each(function(){
			matchMaker.invoke($(this));		
		});
		
		$('[data-role="swiper"]').each(function(){
			swiper.invoke($(this));
		});
		
		$('[data-role="tabs"]').each(function(){
			tabs.invoke($(this));
		});
		
		$('[data-role="autocomplete"]').each(function(){
			autocomplete.invoke($(this));
		});		
		
		$('[data-role="date-picker"]').each(function(){
			datePicker.invoke($(this));
		});	
		
		
		$('[data-role="doughnut-knob"]').each(function() {
			doughnutKnobHandler.invoke($(this));
		});
		
		viewedapp.invoke();

		
		personBuilder.init();
		
		progressChart.init();
		
		fancybox.invoke($('[data-role="fancybox"]'));
		
		$('[data-custom-scroller="true"]').each(function(index) {
			mcustomscroller.init($(this));
		});
		
		
		$('[data-role="slider-controls-nav"]').each(function() {
			new sliderControls({el: $(this)});
		});
		
		
		$('[data-role="googlemap"]').each(function(){
			googleMaper.invoke($(this));
		});
		

		$('[data-role="searchgooglemap"]').each(function(){
			googleMapApp.invoke();
		});	
		
		
		$('[data-role="scheduledate"]').each(function(){
			new GoogleMaps({el: $(document)});
		});


		$('[data-role="date"]').each(function(){
			date.init();
		});	
	}
}

$(document).ready(function() {
	appController.invoke();
});