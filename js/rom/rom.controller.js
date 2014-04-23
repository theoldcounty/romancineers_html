/*
* Romanineers
* rom.controller.js
* Author: Rob Shan Lone
* Copyright (c) 2012 The Old County Limited.
*
* All rights reserved.
*/

var appController = {
	invoke: function(container){
		console.log("app invoke");

		
		$(container).find('[data-role="tabs"]').each(function(){
			tabs.invoke($(this));
		});		
		
		$(container).find('[data-role="isotope-user"]').each(function(){
			isotopeHandler.invoke($(this));		
		});

		$(container).find('[data-role="isotope-tiles"]').each(function(){
			tileHandler.invoke($(this));		
		});
		
		$(container).find('[data-matchmaker=true]').each(function(){
			matchMaker.invoke($(this));		
		});
		
		$(container).find('[data-role="swiper"]').each(function(){
			swiper.invoke($(this));
		});
		
		$(container).find('[data-role="autocomplete"]').each(function(){
			autocomplete.invoke($(this));
		});		
		
		$(container).find('[data-role="date-picker"]').each(function(){
			datePicker.invoke($(this));
		});	

		$(container).find('[data-role="image-fix"]').each(function(){
			galleryFix.invoke($(this));
		});	
		
		$(container).find('[data-role="doughnut-knob"]').each(function() {
			doughnutKnobHandler.invoke($(this));
		});
		
		$(container).find('[data-role="progress-chart"]').each(function() {
			progressChart.init(this);
		});
		
		$(container).find('[data-custom-scroller="true"]').each(function() {
			mcustomscroller.init($(this));
		});
		
		$(container).find('[data-role="slider-controls-nav"]').each(function() {
			new sliderControls({el: $(this)});
		});
		
		$(container).find('[data-role="googlemap"]').each(function(){
			googleMaper.invoke($(this));
		});
		
		$(container).find('[data-role="searchgooglemap"]').each(function(){
			googleMapApp.invoke();
		});	
		
		$(container).find('[data-role="scheduledate"]').each(function(){
			new GoogleMaps({el: $(document)});
		});

		$(container).find('[data-role="private-message"]').each(function(){
			privatemessageHandler.invoke(this);
		});
		
		$(container).find('[data-role="send-message"]').each(function(){
			sendmessageHandler.invoke(this);
		});
		
		$(container).find('[data-role="date"]').each(function(){
			date.init();
		});
		
		$(container).find('[data-validate=true]').each(function(){
			validateForm.invoke($(this));
		});

		viewedapp.invoke();
		personBuilder.init();
		
		var fancyboxCount = $(container).find('[data-role="fancybox"]').length;
		$(container).find('[data-role="fancybox"]').each(function(index){
			if($(this).hasClass("fancybox.ajax")){
				fancybox.invoke($(this));
			}
			
			if(index == fancyboxCount - 1){
				fancybox.invoke($('.fancybox\\.image'));
			}
		});	

		
		
	}
} 
$(document).ready(function() {
	appController.invoke(document);
});