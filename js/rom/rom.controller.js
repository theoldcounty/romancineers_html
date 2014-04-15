/*
* Romanineers
* rom.controller.js
* Author: Rob Shan Lone
* Copyright (c) 2012 The Old County Limited.
*
* All rights reserved.
*/


$(document).ready(function() {

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
	
	
	viewedapp.invoke();

	
	personBuilder.init();
	
	progressChart.init();
	
	fancybox.invoke($('[data-role="fancybox"]'));
	
	mcustomscroller.init();
	
	$('[data-role="slider-controls-nav"]').each(function() {
		new sliderControls({el: $(this)});
	});
	
	
	$('[data-role="googlemap"]').each(function(){
		googleMaper.invoke($(this));
	});
	
	
	
});