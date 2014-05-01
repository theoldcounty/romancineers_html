
			<style>
				.register-container {
					height: 600px;
					padding: 20px;
				}
				
				h2{
					font-size: 13px;
				}
				
				.register-preview .previewimage{
					width: 100px;
					height: 100px;
					background: grey;
					overflow:hidden;
				}
				
				.register-preview .previewimage img{
					width: 100px;
					height: auto;
				}
				
				.mapContainer{
					overflow:hidden;
					width: 230px;
					height: 230px;
					background: grey;
					float: right;
					margin-top: 20px;
				}
				
				#previewmap2{
					overflow:hidden;
					width: 230px;
					height: 230px;
				}
				
  			</style>

		<div class="register-container">			


			<div data-role="tabs" data-active="0," data-disable="" data-heightStyle="auto" id="tabs">
				<ul>
					<li><a href="#step1">Step 1<br>identification</a></li>
					<li><a href="#step2">Step 2<br>your qualities</a></li>
					<li><a href="#step3">Step 3<br>your personality</a></li>
					<li><a href="#step4">Step 4<br>your interests</a></li>
				</ul>
				
				<form data-role="registration-handler" data-validate=true id="registerForm" action="register" enctype="multipart/form-data" method="post" action="">	
					
					<div id="step1" class="step1 grid-100 mobile-grid-100">
						
						<div class="grid-50 mobile-grid-100">
							<h2>Create your account in 5 minutes!</h2>
							<div class="register-realname">
								<label>Name In full* [your name can be selected as a screen name]</label>
								<input type="text" name="realname" placeholder="realname..." data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2">
							</div>

							<div class="register-username">
								<label>Username* [Username can be selected as a screen name]</label>
								<input type="text" name="username" placeholder="username..." data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2">
							</div>

							<div class="register-email">
								<label>Email*</label>
								<input type="email" name="emailaddress" placeholder="email..." data-email=true data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2">
							</div>		

							<div class="register-confirm-email">
								<label>Confirmed Email*</label>
								<input type="email" name="confirmemailaddress" placeholder="email..." data-email=true data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2">
							</div>			

							<div class="register-password">
								<label>Password*</label>
								<input type="password" name="password" placeholder="password..." data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2">
							</div>		

							<div class="register-confirm-password">
								<label>Confirmed Password*</label>
								<input type="password" name="confirmpassword" placeholder="confirmpassword..." data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2">
							</div>

							<div class="register-screenname-or-username">
								<fieldset>
									<input type="radio" name="whichscreenname" value="realname" placeholder="realname..." data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2">Please, use my name in full as a screen name
								</fieldset>
								<fieldset>
									<input type="radio" name="whichscreenname" value="username" placeholder="username..." data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2">Please, use my username as a screen name
								</fieldset>
							</div>			
						</div>
						
						
						<div class="grid-50 mobile-grid-100">			
							<div class="register-dob">
								<div class="grid-100 mobile-grid-100">
									<label>Date of Birth*</label>
								</div>
								<div class="grid-33 mobile-grid-100">
									<input type="text" name="birthday" placeholder="dd" class="day" data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2">
								</div>
								
								<div class="grid-33 mobile-grid-100">
									<input type="text" name="birthmonth" placeholder="mm" class="month" data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2">
								</div>
								
								<div class="grid-33 mobile-grid-100">
									<input type="text" name="birthyear" placeholder="yyyy" class="year" data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2">
								</div>
							</div>
											
							<div class="register-gender grouped">
								<label>Gender*</label>
								<fieldset>
									<input type="radio" name="gender" value="Male" checked="checked" data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2"> Male
								</fieldset>	
								<fieldset>
									<input type="radio" name="gender" value="Female" data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2"> Female
								</fieldset>
							</div>

							

							<div class="register-map" data-role="google-map-locker">
								<label>Country*</label>
								<select name="country" data-required=true data-message-required="We need this!">
									<option value="United Kingdom" selected="selected">United Kingdom</option>
									<option value="United States">United States</option>
									<option value="China">China</option>
								</select>
								
								<div class="mapContainer">
									<div id="previewmap2" data-lat="30"  data-lng="43" data-role="googlemap" data-width=240 data-height=240 data-is-draggable=true></div>
								</div>
								<input type="hidden" name="latitude" value="51.523911">
								<input type="hidden" name="longitude" value="-0.12763">		
							</div>					

							
						</div>
					</div>

					<div id="step2" class="step2 grid-100 mobile-grid-100">
					
						<div class="grid-100 mobile-grid-100" data-role="preview-image">
							<div class="register-preview grid-30 mobile-grid-100">
								<div class="previewimage"><img id="uploadPreview" src="http://mcdonnell.wustl.edu/wp-content/themes/mcdonnell/images/temp_avatar.png"></div>							
							</div>
							<div class="register-photos grid-70 mobile-grid-100">
								<label>Upload photos</label>
								<div class="file_button_container">
									<input type="file" name="image" data-error-message="File needs to be under %" data-placeholder="Select from your computer" data-max-size="2m" data-type="image"/>
								</div>
							</div>	
						</div>	
	
						<div class="grid-50 mobile-grid-100">
							<div class="register-ethnicity">
								<label>Ethnicity*</label>
								<select name="ethnicity" data-required=true data-message-required="We need this!">
									<option value="Caucasian" selected="selected">Caucasian</option>
									<option value="Black">Black</option>
									<option value="Asian">Asian</option>
								</select>
							</div>

							<div class="register-language">
								<label>Language*</label>
								<select name="languages" multiple="multiple" data-required=true data-message-required="We need this!">
									<option value="English">English</option>
									<option value="Spanish">Spanish</option>
									<option value="French">French</option>
									<option value="Japanese">Japanese</option>
									<option value="Chinese">Chinese</option>					
								</select>
							</div>	
						</div>
						
						<div class="grid-50 mobile-grid-100">
							<div class="register-seeking">
								<label>Looking For*</label>
								<select name="lookingfor" data-required=true data-message-required="We need this!">
									<option value="A Woman">A Woman</option>
									<option value="A Man">A Man</option>					
								</select>
							</div>

							<div class="register-relationship">
								<label>Kind of Relationship*</label>
								<select name="kindofrelationship" data-required=true data-message-required="We need this!">
									<option value="Serious">Serious</option>
									<option value="A Fling">A Fling</option>					
								</select>
							</div>
						</div>
						
						
					</div>
					
					<div id="step3" class="step3 grid-100 mobile-grid-100">
						
						<div class="grid-100 mobile-grid-100">
							step 3

							<p>To have the best experiences, we recommend you to fill your profile. It's going to be more attractive and bring your more new friends. Once your account is activated you can edit those information whenever you want.</p>

							<div class="register-goals">
								<div class="grid-100 mobile-grid-100">
									<label>Please indicate what mostly drives your life</label>
								</div>
								
								<div class="grid-33 mobile-grid-100">
									<select name="goal1">
										<option value="Creativity">Creativity</option>
										<option value="Drama">Drama</option>
										<option value="Entertainment">Entertainment</option>
										<option value="Family">Family</option>
										<option value="Power">Power</option>
										<option value="Popularity">Popularity</option>		
									</select>
								</div>
								<div class="grid-33 mobile-grid-100">
									<select name="goal2">
										<option value="Health">Health</option>
										<option value="Hobbies">Hobbies</option>
										<option value="Fun">Fun</option>
										<option value="Friends">Friends</option>
										<option value="Education">Education</option>
										<option value="Marriage">Marriage</option>			
									</select>
								</div>
								<div class="grid-33 mobile-grid-100">	
									<select name="goal3">
										<option value="Adventure">Adventure</option>
										<option value="Career">Career</option>
										<option value="Community">Community</option>
										<option value="Music">Music</option>
										<option value="Sports">Sports</option>
										<option value="Travel">Travel</option>
										<option value="Possessions">Possessions</option>		
									</select>
								</div>
							</div>

							<div class="register-personality">
								<label>Please indicate what describes you more</label>
								
								<div class="grid-100 mobile-grid-100">
									<div class="grid-50 mobile-grid-100">	
										<div id="controls" class="sliderToggles" data-role="slider-controls-nav" data-disable=false>
											<span data-label-left="Reserved" data-label-right="Outgoing">88</span>
											<span data-label-left="Quiet" data-label-right="Loud">70</span> 
											<span data-label-left="Stubborn" data-label-right="Flexible">77</span>
											<span data-label-left="Senstitive" data-label-right="Steady">55</span>
											<span data-label-left="Consitent" data-label-right="Curious">33</span>
											<span data-label-left="Couple" data-label-right="Family">40</span>
											<span data-label-left="Distracted" data-label-right="Focused">70</span>
											<span data-label-left="Tender" data-label-right="Passionate">45</span>
											<span data-label-left="Focus" data-label-right="Funny">70</span>
										</div>
									</div>						
									
									<div class="grid-50 mobile-grid-100">
										<div id="controls" class="sliderToggles" data-role="slider-controls-nav" data-disable=false>
											<span data-label-left="Rigid" data-label-right="Adaptable">70</span>
											<span data-label-left="Impatient" data-label-right="Patient">70</span>
											<span data-label-left="Dishonest" data-label-right="Honest">70</span>
											<span data-label-left="Average" data-label-right="Intelligent">70</span>
											<span data-label-left="Analyitcal" data-label-right="Creative">70</span>
											<span data-label-left="Callous" data-label-right="Caring">70</span>
											<span data-label-left="Lazy" data-label-right="Busy">70</span>
											<span data-label-left="Self Critical" data-label-right="Confident">70</span>
										</div>
									</div>
								</div>
								
							</div>

							<div class="message-data grid-100 mobile-grid-100">
								<input type="submit" value="Log In" name="submit"/>
							</div>			
						</div>
					</div>
					
					<div id="step4" class="step4 grid-100 mobile-grid-100">
						
						<label>Please indicate 5 of your interest and their importance from 0 to 100</label>

						<div id="holderCharts">
							<fieldset class="doughnutWrap grid-100 mobile-grid-100">
								<select name="interests" class="grid-80 mobile-grid-100">
									<option value="Cinema">Cinema</option>
									<option value="Clubbing">Clubbing</option>
									<option value="Football">Football</option>
									<option value="Baseball">Baseball</option>					
								</select>
								<fieldset data-fieldname="interestknobs" id="knob1" class="knob grid-20 mobile-grid-100" data-color="#E2B227" data-role="doughnut-knob" data-value="5" data-width="55" data-height="55"></fieldset>
							</fieldset>
							
							<fieldset class="doughnutWrap grid-100 mobile-grid-100">
								<select name="interests" class="grid-80 mobile-grid-100">
									<option value="Interest 02">Interest 02</option>				
								</select>
								<fieldset data-fieldname="interestknobs" id="knob2" class="knob grid-20 mobile-grid-100" data-color="#E2B227" data-role="doughnut-knob" data-value="15" data-width="55" data-height="55"></fieldset>
							</fieldset>
									
							<fieldset class="doughnutWrap grid-100 mobile-grid-100">	
								<select name="interests" class="grid-80 mobile-grid-100">
									<option value="Interest 03">Interest 03</option>				
								</select>
								<fieldset data-fieldname="interestknobs" id="knob3" class="knob grid-20 mobile-grid-100" data-color="#E2B227" data-role="doughnut-knob" data-value="45" data-width="55" data-height="55"></fieldset>
							</fieldset>
							
							<fieldset class="doughnutWrap grid-100 mobile-grid-100">
								<select name="interests" class="grid-80 mobile-grid-100">
									<option value="Interest 04">Interest 04</option>				
								</select>
								<fieldset data-fieldname="interestknobs" id="knob4" class="knob grid-20 mobile-grid-100" data-color="#E2B227" data-role="doughnut-knob" data-value="85" data-width="55" data-height="55"></fieldset>
							</fieldset>		
										
							<fieldset class="doughnutWrap grid-100 mobile-grid-100">		
								<select name="interests" class="grid-80 mobile-grid-100">
									<option value="Interest 05">Interest 05</option>				
								</select>
								<fieldset data-fieldname="interestknobs" id="knob5" class="knob grid-20 mobile-grid-100" data-color="#E2B227" data-role="doughnut-knob" data-value="35" data-width="55" data-height="55"></fieldset>		
							</fieldset>
						</div>
							
						<input type="hidden" value="" name="chartId"/>
						<input type="hidden" value=" " name="chart"/>						
						
					
					</div>
					

				</form>
			</div>
						
			<button data-role="fancybox" class="fancybox.ajax" href="_lightbox_template.html">login</button>
			
		</div>
