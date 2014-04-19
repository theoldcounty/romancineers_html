
<?php 
	//include "includes/header.php";
?>


		<div class="privatemessages-container">
			
  			<style>
  				
  			</style>
			
			
			
			<div data-role="tabs" data-active="0," data-disable="" data-heightStyle="auto" id="tabs">
				<ul>
					<li><a href="#yourphotos">Your Photos</a></li>
					<li><a href="#uploadphotos">Upload Photos</a></li>
				</ul>
				<div id="yourphotos" class="privatemessages">
				
						<?php
							$messages = array
							(
								array("Rihanna","http://cdn.urbanislandz.com/wp-content/uploads/2013/07/Rihanna-twerk.jpg", "No way", "very hot some work is neeeded here",  "very hot some work is neeeded here but I wanted to share how I feel about what you said recently. very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.very hot some work is neeeded here but I wanted to share how I feel about what you said recently.", "kdsfs932432432", "read"),
								array("Charlize Theron","http://www.moviehole.net/img/charlizegold.jpg", "Did you get my message", "Do you know how",  "Do you know how to cook the cake ok?", "werewr3532432", "read"),
								array("Beyonce","http://3.bp.blogspot.com/-EeI-NlLDl98/UV6IFMrZRtI/AAAAAAAADAA/zYAnQl85FCk/s1600/Beyonce+the+queen.jpg", "test 1", "short test 1",  "long test 1", "sdf2", "read"),
								array("Johnny Depp","http://hollywoodneuz.com/wp-content/uploads/2013/07/Johnny-Depp-johnny-depp-34330259-589-707.jpg", "test 2", "short test 2",  "long test 2", "nmkmksdf834", "unread"),
								array("Chris Evans","http://4.bp.blogspot.com/-oenljxgt_fo/UJEUfqrfjnI/AAAAAAAABB8/QIFF_cMxRnw/s1600/Chris+Evans.jpg", "test 3", "short test 3",  "long test 3", "kjskdf3", "read"),
								array("Paris Hilton", "http://newsplies.com/wp-content/uploads/2014/01/Paris-Hilton-Wallpaper.jpg", "test 4", "short test 4",  "long test 4", "mkdfg8435", "unread"),
								array("Jamie Pressly", "http://bhanks.encblogs.com/wp-content/uploads/2011/01/010711-jaime-pressly-is-a-lovely-woman.jpg", "test 5", "short test 5",  "long test 5", "msdf832", "unread"),
								array("Leonardo Dicaprio", "http://img2.timeinc.net/people/i/2006/celebdatabase/leonardodicaprio/leo_dicaprio1_300_400.jpg", "test 6", "short test 6",  "long test 6", "nnbbsad324", "unread"),
								array("Robert de Niro", "http://1.bp.blogspot.com/_9jGIJwx7ks8/RywV033v6dI/AAAAAAAABjc/BS1tZF10-xQ/s400/Robert+de+Niro.jpg", "test 7", "short test 7",  "long test 7", "lll934", "uread"),
								array("Jack Nicholson", "http://brochureshelf.co.uk/images/bb/5891/005891-000047-990w.jpg", "test 8", "short test 8",  "long test 8", "bbbasd213", "read"),
								array("Daniel Day Lewis", "http://i1.cdnds.net/13/02/618x931/daniel_day_lewis.jpg", "test 9", "short test 9",  "long test 9", "mmmmsdf324", "unread"),
								array("Christian Bale", "http://1.bp.blogspot.com/-pl173nNSEYQ/UAm0BzjG-JI/AAAAAAAAF9E/NjCEzbDsNus/s1600/LRA_christian_bale_portrait.jpg", "test 10", "short test 10",  "long test 10", "mmsdf234", "read"),
								array("Cate Blanchett", "http://1.bp.blogspot.com/-vE-eu5KfWWw/UNiryazqWJI/AAAAAAAAAgU/tajq6I7WP9s/s1600/Cate%20Blanchett%20portrait.jpg", "test 11", "short test 11",  "long test 11", "vasdasd123", "unread"),
								array("Jennifer Lawrence", "http://p1.trrsf.com/image/fget/cf/308/464/images.terra.com/2013/08/01/07-jennifer-lawrence.jpg", "test 12", "short test 12",  "long test 12", "asd2334", "read"),
								array("Jodie Foster", "http://images.fanpop.com/images/image_uploads/Jodie-Foster-jodie-foster-212714_785_1000.jpg", "test 13", "short test 13",  "long test 13", "mmmsfds9", "read")
							);
						?>
					
						<div data-role="swiper" data-showpagination=false data-direction="horizontal" data-loop=true data-grabcursor=true data-speed=600 data-paginationclickable=true data-noswiping="swiper-no-swiping" data-initialslide=0>
							
							<div data-role="private-message" class="swiper-container"><!--swiper-container-->
								<div class="swiper-wrapper"><!--swiper-wrapper-->
									
									<?php
										foreach ($messages as &$value) {
									?>
									<div class="swiper-slide">
										<!--slide 1-->

											<img src="<?php echo $value[1];?>">
											
										<!--slide 1-->
									</div>
									<?php
										}
									?>
									
								</div><!--swiper-wrapper-->
								
								<!--<div class="pagination"></div>-->
							</div><!--swiper-container-->
						</div>
				</div>
				<div id="uploadphotos" class="privatemessages">
						
						<form id="imageForm" action="uploadimage" method="post" enctype="multipart/form-data">
							<label>userId</label>
							<input type="text" name="userId" value="<%=request.getParameter("userId")%>"/>
						   <br/>
							<label>image</label>			
							<input type="file" name="image" />
							<br/>
							
							<input type="hidden" value="submitted" name="submitted"/>
							<input type="submit" value="submit" name="submit"/>
						</form>
													
				</div>
			</div>

		
		</div>
		