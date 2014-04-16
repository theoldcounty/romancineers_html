<?php include "includes/header.php";?>
			
				<!--<div class="flask">--><!--flask-->
					<div class="batch">
						
						<!--googlemaps-->
						<div class="googlemaps" data-role="scheduledate">
									<section class="maps-panel">
										<div class="data-attributes">
											<div id="googleMapData">
												<a class="user-option" id="userData" href="#" data-user-id="" data-user-lat="51.529622428012544" data-user-long="-0.1381740757634631"><span class="face"><img src="http://www.rapbasement.com/wp-content/uploads/2013/10/Rihanna+striking+beauty.png"></span> User Focused</a><br>
												<a class="user-option" id="candidateData" href="#" data-user-id="" data-user-lat="53.331647402998776" data-user-long="-2.9767332668951405"><span class="face"><img src="http://images6.fanpop.com/image/photos/36100000/Chris-Evans-image-chris-evans-36105395-1650-1464.jpg"></span> Candidate Focused</a><br>
											</div>
										</div>
										<div class="control-container">
											<form id="searchForm" action="#">
													<input type="hidden" name="enableCoupons" value="false"/>
													<input type="hidden" name="longitude" value=""/>
													<input type="hidden" name="latitude" value=""/>
													<input type="hidden" name="id" value="114">
													<input type="hidden" name="searchfield" value="">
													<input type="hidden" name="radius" value="5">
													<div class="search-textfield-container">
														<span class="textfield">
															<input id="searchTextField" class="search-textfield" type="text" placeholder="Location, postcode or street"/>
														</span>
														
														<span class="selectbox">
															<select name="queryFoursquare" id="queryFoursquare" class="foursquare-textfield">
																<option value="theatre">Theatre</option>
																<option value="bowling">Bowling</option>
																<option value="restaurant">Restaurant</option>
																<option value="cafe">Cafe</option>
																<option value="cinema">Cinema</option>
																<option value="ice cream">Ice Cream</option>
																<option value="comedy shows">Comedy Shows</option>
																<option value="pub">Pub</option>
																<option value="club">Club</option>
																<option value="concerts">Concerts</option>
																<option value="parks">Parks</option>
																<option value="museums">Museums</option>
																<option value="zoo">Zoo</option>
																<option value="horse back riding">Horse back riding</option>
																<option value="picnic">Picnic</option>
																<option value="amusement parks">Amusement Parks</option>
																<option value="Water parks">Water Parks</option>
																<option value="hiking">Hiking</option>
																<option value="aquarium">Aquarium</option>
																<option value="driving range">Driving Range</option>
																<option value="art gallery">Art Gallery</option>
																<option value="local music show">Local Music Show</option>
																<option value="ice-skating">Ice-Skating</option>
																<option value="stringfellows">Stringfellows</option>
															</select>
														</span>

														<span data-id="search-button" class="link-button small">
															<input class="text" type="button" value="Go"/>
														</span>
													</div>
											</form>
										</div>
									</section>
									<div id="map_canvas"></div>
						</div>
						<!--googlemaps-->

					</div>				
				<!--</div>--><!--flask-->
				
<?php include "includes/footer.php";?>
