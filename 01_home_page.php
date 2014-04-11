<?php include "includes/header.php";?>
			
				<div class="flask"><!--flask-->
					<div class="batch">
					  	<h1>welcome on visual dating find love, in a visual way</h1>
						
							<?php
								$people = array
								(
									array("Rihanna","http://cdn.urbanislandz.com/wp-content/uploads/2013/07/Rihanna-twerk.jpg","http://cdn.funkidslive.com/wp-content/uploads/2013/01/Rihanna-11.jpg"),
									array("Charlize Theron","http://www.moviehole.net/img/charlizegold.jpg","http://1.bp.blogspot.com/-3p0-wbbnUrI/UFITA5BSWoI/AAAAAAAAGpA/YtuUyGC87iA/s1600/07+-+Charlize-Theron.jpg"),
									array("Beyonce","http://3.bp.blogspot.com/-EeI-NlLDl98/UV6IFMrZRtI/AAAAAAAADAA/zYAnQl85FCk/s1600/Beyonce+the+queen.jpg","http://images.boomsbeat.com/data/images/full/515/beyonce-jpeg.jpg"),
									array("Johnny Depp","http://hollywoodneuz.com/wp-content/uploads/2013/07/Johnny-Depp-johnny-depp-34330259-589-707.jpg", "http://img2.timeinc.net/people/i/2009/specials/archive35/hotguys/johnny-depp-435.jpg"),
									array("Chris Evans","http://4.bp.blogspot.com/-oenljxgt_fo/UJEUfqrfjnI/AAAAAAAABB8/QIFF_cMxRnw/s1600/Chris+Evans.jpg", "http://images6.fanpop.com/image/photos/36100000/Chris-Evans-image-chris-evans-36105395-1650-1464.jpg"),
									array("Paris Hilton", "http://newsplies.com/wp-content/uploads/2014/01/Paris-Hilton-Wallpaper.jpg", "http://wallhdgallery.com/wp-content/uploads/2014/04/paris-hilton-carls-jr.jpg"),
									array("Jamie Pressly", "http://bhanks.encblogs.com/wp-content/uploads/2011/01/010711-jaime-pressly-is-a-lovely-woman.jpg", "http://2.bp.blogspot.com/-ayKMsvLBrYc/UPnUsoTlBGI/AAAAAAAABpk/ioASF5osqF0/s1600/jaime%2011.jpg")
								);
							
							?>
						

							<ul data-role="isotope-user" id="isotope" class="isotope">
								
								<?php
									foreach ($people as &$value) {
									//$value = $value * 2;
									//}
								?>
								<li class="user">
									<a class="user-link" href="02_profile_page.php">
										<img class="user-image" data-src-large="<?php echo $value[1];?>" src="<?php echo $value[2];?>" data-src-standard="<?php echo $value[2];?>">
									</a>
									
									<div class="user-bio">
										31 years old<br>
										London, United Kingdom
									</div>
									
									<div class="user-focus">
										<img src="__temp_images/users.jpg">
									</div>
									
									<div class="interest-pie">
										<!--<img src="__temp_images/interestpie.jpg">-->
										<div class="piechart" data-role="piechart" data-width=95 data-height=95 data-r=45 data-ir=0></div>
									</div>
									
									<div class="user-details">
										<h1 class="user-title"><?php echo $value[0];?> <span class="gender female"></span></h1>
										<p class="user-description">Jetzt ist Big Rosti-Zeit! Ein leckerer Burger aus Weizenbrotchen mit Kase-Speck-Bestreuung, zartem Rindfleisch, Schmelzkasezubereitung Emmentaler, einem Kartoffelrosti, knusprigem Bacon und herzhafter Kasesauce. Hmmm, rostlich!</p>
									</div>
									
									<div class="last-online">
										Last online 2 hours ago. <span class="status online"></span>
									</div>
									
									<nav class="user-bar">
										<a href="#">My Photos</a>
										<a href="#">Followers</a>
										<a href="#">Following</a>
										<a href="#">Talk To Me</a>
									</nav>
									
									<a class="user-profile-link" href="02_profile_page.php">Details zum produkt</a>
									
								</li>
								<?php
									}
								?>
								
							</ul>



					</div>				
				
				</div><!--flask-->
				
<?php include "includes/footer.php";?>
