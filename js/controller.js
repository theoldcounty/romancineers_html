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

	
	progressChart.init();
	
	
	googleMaper.setup(30,43);
});