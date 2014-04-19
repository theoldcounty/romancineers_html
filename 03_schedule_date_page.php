<?php include "includes/header.php";?>
			
				<!--<div class="flask">--><!--flask-->
					<div class="batch">
						
						<!--googlemaps-->
						<div class="googlemaps" data-role="scheduledate">
							<section id="map_canvas" class="grid-80 mobile-grid-100"></section>
							<section class="grid-20 mobile-grid-100 maps-panel">
									<div class="control-container">
										<div class="data-attributes">
											<div id="googleMapData" data-dating-page="_scheduledate_lightbox.php">
												<div id="userData" class="user-option" data-user-id="51895628d1efa7a5d9df83c9" data-user-lat="51.529622428012544" data-user-long="-0.1381740757634631"></div>
												<div id="candidateData" class="user-option" data-user-id="518b090fd1ef11c72b4bcb85" data-user-lat="53.331647402998776" data-user-long="-2.9767332668951405"></div>
											</div>
										</div>
										<form id="searchForm" action="#">
												<input type="hidden" name="enableCoupons" value="false"/>
												<input type="hidden" name="longitude" value=""/>
												<input type="hidden" name="latitude" value=""/>
												<input type="hidden" name="id" value="114">
												<input type="hidden" name="searchfield" value="">
												<input type="hidden" name="radius" value="5">
																								
												<div class="search-textfield-container">
													<input data-role="autocomplete" data-minlength=0 data-availabletags="Cafe, Restaurant, Theatre, Bowling, Cinema, Ice Cream, Comedy Show, Pub, Club, Concert, Park, Museum, Zoo, Horse Back Riding, Picnic, Amusement Park, Water Park, Hiking, Aquarium, Driving Range, Art Gallery, Local Music Show, Ice-Skating, Stringfellows, Cocktail Bar, Art Gallery, Gay Bar, Casino, Hotel, Beer Garden, Theme Park, Playground, Library, Nightclub" id="queryFoursquare" class="foursquare-textfield" name="queryFoursquare" type="text" placeholder="I want to go out for...">
													<input id="searchTextField" class="search-textfield" name="searchTextField" type="text" placeholder="Location"/>
													
													<span data-id="search-button" class="link-button small">
														<input class="submit" type="submit" value="Go"/>
													</span>
												</div>
										</form>
									</div>
									<div class="venue-list-container">
										<ul class="venue-list" data-custom-scroller="true" data-horizontalscroll="false" data-theme="dark">
											<li>
												<div class="grid-100 mobile-grid-100">
													<span class="venue-number">1.</span> 
													<h3 class="venue-title" data-venue-id="">Honest Burgers</h3>
													
													<!--<span class="venue-rating">9.3</span>-->
													<span class="venue-address">4 Meard Street</span>
												</div>
												<!--
												<div class="grid-25 mobile-grid-100">	
													<div class="venue-image"><img src="http://www.burgerbusiness.com/wp-content/uploads/Giraffas_BrutusBurger.jpg"></div> 
												</div>
												
												<div class="grid-100 mobile-grid-100">	
													<ul class="venue-tips">
														<li>"One of the best burgers in London for sure"</li>
														<li>"Ask for the Federation"</li>
													</ul>
												</div>
												-->
											</li>
										</ul>
									</div>
								</section>
						</div>
						<!--googlemaps-->

					</div>				
				<!--</div>--><!--flask-->
				
<?php include "includes/footer.php";?>
