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
									array("Jamie Pressly", "http://bhanks.encblogs.com/wp-content/uploads/2011/01/010711-jaime-pressly-is-a-lovely-woman.jpg", "http://2.bp.blogspot.com/-ayKMsvLBrYc/UPnUsoTlBGI/AAAAAAAABpk/ioASF5osqF0/s1600/jaime%2011.jpg"),
									array("Leonardo Dicaprio", "http://img2.timeinc.net/people/i/2006/celebdatabase/leonardodicaprio/leo_dicaprio1_300_400.jpg", "http://images4.fanpop.com/image/photos/16200000/Leonardo-DiCaprio-leonardo-dicaprio-16244675-461-592.jpg"),
									array("Robert de Niro", "http://1.bp.blogspot.com/_9jGIJwx7ks8/RywV033v6dI/AAAAAAAABjc/BS1tZF10-xQ/s400/Robert+de+Niro.jpg", "http://www.myfilmviews.com/wp-content/uploads/2013/05/robert2.jpg"),
									array("Jack Nicholson", "http://brochureshelf.co.uk/images/bb/5891/005891-000047-990w.jpg", "http://patdollard.com/wp-content/uploads/2013/09/jack-nicholson.jpeg"),
									array("Daniel Day Lewis", "http://i1.cdnds.net/13/02/618x931/daniel_day_lewis.jpg", "http://c15065204.r4.cf2.rackcdn.com/wp-content/uploads/daniel-day-lewis-1131850093.jpg"),
									array("Christian Bale", "http://1.bp.blogspot.com/-pl173nNSEYQ/UAm0BzjG-JI/AAAAAAAAF9E/NjCEzbDsNus/s1600/LRA_christian_bale_portrait.jpg", "http://static.guim.co.uk/sys-images/Film/Pix/pictures/2009/2/9/1234173379825/Christian-Bale-001.jpg"),
									array("Cate Blanchett", "http://1.bp.blogspot.com/-vE-eu5KfWWw/UNiryazqWJI/AAAAAAAAAgU/tajq6I7WP9s/s1600/Cate%20Blanchett%20portrait.jpg", "http://beyouthful.net/wp-content/uploads/2013/11/Cate-Blanchett-cate-blanchett-222511_1280_1024.jpg"),
									array("Jennifer Lawrence", "http://p1.trrsf.com/image/fget/cf/308/464/images.terra.com/2013/08/01/07-jennifer-lawrence.jpg", "http://healthyceleb.com/wp-content/uploads/2012/11/Jennifer-lawrence-bra-size.jpg"),
									array("Jodie Foster", "http://images.fanpop.com/images/image_uploads/Jodie-Foster-jodie-foster-212714_785_1000.jpg", "http://www.autostraddle.com/wp-content/uploads/2013/01/jodie-foster-black-t.jpg")
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
										<div class="piechart" data-role="piechart" data-width=95 data-height=95 data-r=45 data-ir=0 data-colors="#1f78b4,#fe7f0e,#ffbc78,#b2cae6,#ff08d9"></div>
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
