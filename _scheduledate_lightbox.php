
<?php

//include "includes/header.php"

/*
<!--  
				<%=request.getParameter("venueId")%>
				<%=request.getParameter("senderUid")%>
				<%=request.getParameter("recepientUid")%>
				-->
*/
?>

		<form id="date" data-role="date" data-venue-id="<?php echo $_GET["venueId"]; ?>" data-senderUid="<?php echo $_GET["senderUid"]; ?>" data-recepientUid="<?php echo $_GET["recepientUid"]; ?>" action="date" enctype="multipart/form-data" method="post" action="">
					<div data-role="tabs" data-active="0," data-disable="1,2" data-heightStyle="auto" id="dating">
						<ul>
							<li><a href="#tabs-1">Review Venue</a></li>
							<li><a href="#tabs-2">Schedule Date</a></li>
							<li><a href="#tabs-3">Wait For Response</a></li>
						</ul>
						<div id="tabs-1">
								<div class="dating-holder">									
									<h1>Review Venue</h1>

									<div class="grid-66 mobile-grid-100 venue">
										<div class="grid-50 mobile-grid-100">
											<h2>The Venue</h2>
											
											<div class="grid-100 mobile-grid-100 venue-map"><img src="http://maps.google.com/maps/api/staticmap?center=23,34&zoom=16&markers=icon:http://tinyurl.com/2ftvtt6|23,34&size=768x768&sensor=true"></div>
											
											<div class="grid-50 mobile-grid-100">
												<span class="venue-name">Curzon Cinema</span><br/>
												<div class="venue-location">
													99 Shaftesbury Ave.<br/>
													London<br/>
													United Kingdom<br/>
													W1D 5DY
												</div>
											</div>
											
											<div class="grid-50 mobile-grid-100">
												<div class="venue-rating-title">Rating</div>
												<div class="venue-rating">
													<fieldset data-fieldname="interestknobs" id="knob1" class="knob" data-fgcolor="#ebb801" data-bgcolor="#e97424" data-role="doughnut-knob" data-value="9" data-height=85 data-width=85 data-min=0  data-max=10 data-readonly=true></fieldset>
												</div>
											</div>
										</div>
										
										<div class="grid-50 mobile-grid-100">
											<div class="grid-100 mobile-grid-100 venue-event">
												<h3>Events</h3>
												<div class="venue-event-container">
													<ul class="venue-event-list" data-custom-scroller="true" data-horizontalscroll="false" data-theme="dark">
														<li><input type="radio" name="event" value="Oz The Great and Powerful"> Oz The Great and Powerful</li>
													</ul>
												</div>
											</div>
											
											<div class="grid-100 mobile-grid-100 venue-feedbacks">
												<h3>Feedback</h3>
												<div class="venue-feedback-container">
													<ul class="venue-feedback" data-custom-scroller="true" data-horizontalscroll="false" data-theme="dark">
														<li>tip</li>
													</ul>
												</div>
											</div>
										</div>
										
										<div class="grid-100 mobile-grid-100 venue-images">
											<div class="venue-image-container">
												<ul class="venue-image" data-custom-scroller="true" data-horizontalscroll="false" data-theme="dark">
													<li><img src="__temp_images/venue1.jpg"></li>
												</ul>
											</div>
										</div>										
									</div>
									
									<div class="grid-33 mobile-grid-100 candidate">
										<h2>Candidate</h2>
										
										<div class="feature-image"><img src="http://www.forum-auto.com/uploads/200404/sebswxs_1081520131_charlize_theron.jpg"></div>
										
										<h3>Charlize Theron, 21</h3>
										<h3>London, United Kingdom</h3>
										
										<div class="user-interests">
											<div class="piechart" data-role="piechart" data-width=95 data-height=95 data-r=45 data-ir=0 data-colors="#1f78b4,#fe7f0e,#ffbc78,#b2cae6,#ff08d9"></div>
										</div>
										
										<button name="scheduledate" value="Schedule a date">Schedule a date</button>
									</div>
								</div>
						</div>
						<div id="tabs-2">
						
								<div class="dating-holder">
									<h1>Schedule Date</h1>
									
									<div class="grid-66 mobile-grid-100 venue">
										<div class="grid-100 mobile-grid-100">
											<h2>The Venue</h2>
											
											<div class="grid-50 mobile-grid-50 venue-map"><img src="http://maps.google.com/maps/api/staticmap?center=23,34&zoom=16&markers=icon:http://tinyurl.com/2ftvtt6|23,34&size=768x768&sensor=true"></div>
											
											<div class="grid-50 mobile-grid-50">												
												<div class="grid-100 mobile-grid-100">
													<h3>Where</h3>
													<span class="venue-name">Curzon Cinema</span><br/>
													<div class="venue-location">
														99 Shaftesbury Ave.<br/>
														London<br/>
														United Kingdom<br/>
														W1D 5DY
													</div>												
													
													<h3>Event</h3>
													<b class="event-name">Just a fun day out!</b>
															
													<h3>When</h3>
													<input type="text" value="10/12/2014" data-role="date-picker" data-showanim="clip">
												</div>
											</div>
											
										</div>
										
										<div class="grid-100 mobile-grid-100">
											<textarea class="private-message" name="message" rows="4" cols="50">
												Write a private message for Charlize...
											</textarea>
										</div>										
									</div>

									<div class="grid-33 mobile-grid-100 candidate">
										<h2>Candidate</h2>
										
										<div class="feature-image"><img src="http://www.forum-auto.com/uploads/200404/sebswxs_1081520131_charlize_theron.jpg"></div>
										
										<h3>Charlize Theron, 21</h3>
										<h3>London, United Kingdom</h3>
										
										<div class="user-interests">
											<div class="piechart" data-role="piechart" data-width=95 data-height=95 data-r=45 data-ir=0 data-colors="#1f78b4,#fe7f0e,#ffbc78,#b2cae6,#ff08d9"></div>
										</div>
										
										<input type="hidden" value="" name="recepientUid"/>
										<input type="hidden" value="" name="senderUid"/>

										<input type="submit" value="Ask Charlize Out" name="submitdate"/>
									</div>
								</div>
						</div>
						<div id="tabs-3">
							<div class="dating-holder">
								<h1>Wait For Response</h1>
								<div class="grid-100 mobile-grid-100">
									<p>A notification has been sent to both parties. Please check back soon to see if there is a response from your proposal.</p>
									<div class="marketing-image"><img src="__temp_images/datescheduled.jpg"></div>
								</div>
							</div>
						</div>
					</div>				

		</form>
		
		