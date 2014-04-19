
<?php 
	//include "includes/header.php";
?>

<div id="shazam-wrapper" class="regular">
		<div class="privateMessages">
			
  			<style>
  				
  			</style>
			
			
			
			<div data-role="tabs" data-active="0," data-disable="" data-heightStyle="auto" id="tabs">
				<ul>
					<li><a href="#inbox">Inbox</a></li>
					<li><a href="#sent">Sent</a></li>
				</ul>
				<div id="inbox" class="privatemessages">
				
						<?php
							$messages = array
							(
								array("Rihanna","http://cdn.urbanislandz.com/wp-content/uploads/2013/07/Rihanna-twerk.jpg", "No way", "very hot some work is neeeded here",  "very hot some work is neeeded here but I wanted to share how I feel about what you said recently. very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.", "kdsfs932432432"),
								array("Charlize Theron","http://www.moviehole.net/img/charlizegold.jpg", "Did you get my message", "Do you know how",  "Do you know how to cook the cake ok?", "werewr3532432"),
								array("Beyonce","http://3.bp.blogspot.com/-EeI-NlLDl98/UV6IFMrZRtI/AAAAAAAADAA/zYAnQl85FCk/s1600/Beyonce+the+queen.jpg", "test 1", "short test 1",  "long test 1", "sdf2"),
								array("Johnny Depp","http://hollywoodneuz.com/wp-content/uploads/2013/07/Johnny-Depp-johnny-depp-34330259-589-707.jpg", "test 2", "short test 2",  "long test 2", "nmkmksdf834"),
								array("Chris Evans","http://4.bp.blogspot.com/-oenljxgt_fo/UJEUfqrfjnI/AAAAAAAABB8/QIFF_cMxRnw/s1600/Chris+Evans.jpg", "test 3", "short test 3",  "long test 3", "kjskdf3"),
								array("Paris Hilton", "http://newsplies.com/wp-content/uploads/2014/01/Paris-Hilton-Wallpaper.jpg", "test 4", "short test 4",  "long test 4", "mkdfg8435"),
								array("Jamie Pressly", "http://bhanks.encblogs.com/wp-content/uploads/2011/01/010711-jaime-pressly-is-a-lovely-woman.jpg", "test 5", "short test 5",  "long test 5", "msdf832"),
								array("Leonardo Dicaprio", "http://img2.timeinc.net/people/i/2006/celebdatabase/leonardodicaprio/leo_dicaprio1_300_400.jpg", "test 6", "short test 6",  "long test 6", "nnbbsad324"),
								array("Robert de Niro", "http://1.bp.blogspot.com/_9jGIJwx7ks8/RywV033v6dI/AAAAAAAABjc/BS1tZF10-xQ/s400/Robert+de+Niro.jpg", "test 7", "short test 7",  "long test 7", "lll934"),
								array("Jack Nicholson", "http://brochureshelf.co.uk/images/bb/5891/005891-000047-990w.jpg", "test 8", "short test 8",  "long test 8", "bbbasd213"),
								array("Daniel Day Lewis", "http://i1.cdnds.net/13/02/618x931/daniel_day_lewis.jpg", "test 9", "short test 9",  "long test 9", "mmmmsdf324"),
								array("Christian Bale", "http://1.bp.blogspot.com/-pl173nNSEYQ/UAm0BzjG-JI/AAAAAAAAF9E/NjCEzbDsNus/s1600/LRA_christian_bale_portrait.jpg", "test 10", "short test 10",  "long test 10", "mmsdf234"),
								array("Cate Blanchett", "http://1.bp.blogspot.com/-vE-eu5KfWWw/UNiryazqWJI/AAAAAAAAAgU/tajq6I7WP9s/s1600/Cate%20Blanchett%20portrait.jpg", "test 11", "short test 11",  "long test 11", "vasdasd123"),
								array("Jennifer Lawrence", "http://p1.trrsf.com/image/fget/cf/308/464/images.terra.com/2013/08/01/07-jennifer-lawrence.jpg", "test 12", "short test 12",  "long test 12", "asd2334"),
								array("Jodie Foster", "http://images.fanpop.com/images/image_uploads/Jodie-Foster-jodie-foster-212714_785_1000.jpg", "test 13", "short test 13",  "long test 13", "mmmsfds9")
							);
						?>

						<nav class="message-handler">
							<a class="markread" href="#">mark as read</a>
							<a class="markasunread" href="#">mark as unread</a>
							<a class="delete" href="#">delete</a>
						</nav>
					
						<div data-role="swiper" data-showpagination=false data-direction="horizontal" data-loop=false data-grabcursor=false data-speed=600 data-paginationclickable=true data-noswiping="swiper-no-swiping" data-initialslide=0>
							
							<div data-role="private-message" class="swiper-container"><!--swiper-container-->
								<div class="swiper-wrapper"><!--swiper-wrapper-->
									<div class="swiper-slide swiper-no-swiping">
										<!--slide 1-->

											<form class="private-message-list-container">
												<ul class="private-message-list grid-100 mobile-grid-100" data-custom-scroller="true" data-horizontalscroll="false" data-theme="dark">
													<?php
													foreach ($messages as &$value) {
													?>
														<li class="view-message-trigger" data-message-id="<?php echo $value[5];?>">
															<div class="user-data grid-40 mobile-grid-100">
																<div class="user-image grid-50 mobile-grid-50">
																	<input class="private-message-marker" type="checkbox" name="privatemessage" data-message-id="<?php echo $value[5];?>"/>
																	<img src="<?php echo $value[1];?>">
																</div>
																<div class="user-information grid-50 mobile-grid-50">
																	<div class="user-name"><?php echo $value[0];?></div>
																	<div class="user-date">July 23rd 2012 at 1:34p.m.</div>
																</div>								
															</div>
															<div class="message-data grid-60 mobile-grid-100">
																<div class="message-subject grid-100 mobile-grid-100"><?php echo $value[2];?></div>
																<div class="message-summary grid-100 mobile-grid-100"><?php echo $value[3];?></div>
																<div class="message-body grid-100 mobile-grid-100"><?php echo $value[4];?></div>
															</div>							
														</li>
													<?php
													}
													?>
												</ul>
											</form>	
											
										<!--slide 1-->
									</div>
									<div class="swiper-slide">
										
										<!--slide 2-->

											<div class="private-pane grid-100 mobile-grid-100">
												<div class="user-data grid-100 mobile-grid-100">
													<div class="user-image grid-10 mobile-grid-30">
														<input class="private-message-marker" type="checkbox" name="privatemessage" data-message-id="kjskdnflks332432"/>
														<img src="http://cdn.urbanislandz.com/wp-content/uploads/2013/07/Rihanna-twerk.jpg">
													</div>
													<div class="user-information grid-90 mobile-grid-70">
														<div class="user-name">Sandy MKlein</div>
														<div class="user-date">July 23rd 2012 at 1:34p.m.</div>
													</div>								
												</div>
												<div class="message-data grid-100 mobile-grid-100">
													<div class="message-subject">Cake Making 2</div>
													<div class="message-body-container">
														<div class="message-body" data-custom-scroller="true" data-horizontalscroll="false" data-theme="dark">12-hole muffin tins with paper cases. Put the eggs, yogurt, vanilla, sugar, flour, almonds and butter in your largest mixing bowl and beat until smooth and lump-free. Divide between the paper cases and bake for 25-30 mins (swapping the trays after 15 mins if you have to use 2 shelves) until a skewer poked into the centre of the cakes comes out clean. Cool on a wire rack. They can be frozen for up to 1 month or kept in an airtight container overnight.</div>								
													</div>
												</div>
											</div>
											
											<a class="view-list-trigger" href="#">back</a>
										
										<!--slide 2-->
										
									</div>
									
								</div><!--swiper-wrapper-->
								
								<!--<div class="pagination"></div>-->
							</div><!--swiper-container-->
						</div>
				</div>
				<div id="sent" class="privatemessages">
						<?php
							$messages = array
							(
								array("Christian Bale", "http://1.bp.blogspot.com/-pl173nNSEYQ/UAm0BzjG-JI/AAAAAAAAF9E/NjCEzbDsNus/s1600/LRA_christian_bale_portrait.jpg", "sent test 10", "short test 10",  "sent long test 10", "kkksdf8324"),
								array("Cate Blanchett", "http://1.bp.blogspot.com/-vE-eu5KfWWw/UNiryazqWJI/AAAAAAAAAgU/tajq6I7WP9s/s1600/Cate%20Blanchett%20portrait.jpg", "sent test 11", "short test 11",  "sent long test 11", "asdas234324"),
								array("Jennifer Lawrence", "http://p1.trrsf.com/image/fget/cf/308/464/images.terra.com/2013/08/01/07-jennifer-lawrence.jpg", "test 12", "sent short test 12",  "sent long test 12", "kkfdgo345"),
								array("Jodie Foster", "http://images.fanpop.com/images/image_uploads/Jodie-Foster-jodie-foster-212714_785_1000.jpg", "test 13", "sent short test 13",  "sent long test 13", "sdfpp024")
							);
						?>
						
						<nav class="message-handler">
							<a class="markread" href="#">mark as read</a>
							<a class="markasunread" href="#">mark as unread</a>
							<a class="delete" href="#">delete</a>
						</nav>
					
						<div data-role="swiper" data-showpagination=false data-direction="horizontal" data-loop=false data-grabcursor=false data-speed=600 data-paginationclickable=true data-noswiping="swiper-no-swiping" data-initialslide=0>
							
							<div data-role="private-message" class="swiper-container"><!--swiper-container-->
								<div class="swiper-wrapper"><!--swiper-wrapper-->
									<div class="swiper-slide swiper-no-swiping">
										<!--slide 1-->

											<form class="private-message-list-container">
												<ul class="private-message-list grid-100 mobile-grid-100" data-custom-scroller="true" data-horizontalscroll="false" data-theme="dark">
													<?php
													foreach ($messages as &$value) {
													?>
														<li class="view-message-trigger" data-message-id="<?php echo $value[5];?>">
															<div class="user-data grid-40 mobile-grid-100">
																<div class="user-image grid-50 mobile-grid-50">
																	<input class="private-message-marker" type="checkbox" name="privatemessage" data-message-id="<?php echo $value[5];?>"/>
																	<img src="<?php echo $value[1];?>">
																</div>
																<div class="user-information grid-50 mobile-grid-50">
																	<div class="user-name"><?php echo $value[0];?></div>
																	<div class="user-date">July 23rd 2012 at 1:34p.m.</div>
																</div>								
															</div>
															<div class="message-data grid-60 mobile-grid-100">
																<div class="message-subject grid-100 mobile-grid-100"><?php echo $value[2];?></div>
																<div class="message-summary grid-100 mobile-grid-100"><?php echo $value[3];?></div>
																<div class="message-body grid-100 mobile-grid-100"><?php echo $value[4];?></div>
															</div>							
														</li>
													<?php
													}
													?>
												</ul>
											</form>	
											
										<!--slide 1-->
									</div>
									<div class="swiper-slide">
										
										<!--slide 2-->

											<div class="private-pane grid-100 mobile-grid-100">
												<div class="user-data grid-100 mobile-grid-100">
													<div class="user-image grid-10 mobile-grid-30">
														<input class="private-message-marker" type="checkbox" name="privatemessage" data-message-id="kjskdnflks332432"/>
														<img src="http://cdn.urbanislandz.com/wp-content/uploads/2013/07/Rihanna-twerk.jpg">
													</div>
													<div class="user-information grid-90 mobile-grid-70">
														<div class="user-name">Sandy MKlein</div>
														<div class="user-date">July 23rd 2012 at 1:34p.m.</div>
													</div>								
												</div>
												<div class="message-data grid-100 mobile-grid-100">
													<div class="message-subject">Cake Making 2</div>
													<div class="message-body-container">
														<div class="message-body" data-custom-scroller="true" data-horizontalscroll="false" data-theme="dark">12-hole muffin tins with paper cases. Put the eggs, yogurt, vanilla, sugar, flour, almonds and butter in your largest mixing bowl and beat until smooth and lump-free. Divide between the paper cases and bake for 25-30 mins (swapping the trays after 15 mins if you have to use 2 shelves) until a skewer poked into the centre of the cakes comes out clean. Cool on a wire rack. They can be frozen for up to 1 month or kept in an airtight container overnight.</div>								
													</div>
												</div>
											</div>
											
											<a class="view-list-trigger" href="#">back</a>
										
										<!--slide 2-->
										
									</div>
									
								</div><!--swiper-wrapper-->
								
								<!--<div class="pagination"></div>-->
							</div><!--swiper-container-->
						</div>	
													
				</div>
			</div>

		
		</div>
		
		<div class="error"></div>
</div>