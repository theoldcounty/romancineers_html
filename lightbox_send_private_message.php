
		<div class="sendmessages-container">
			<style>
				
  			</style>
			
			<form data-role="send-message" data-validate=true id="sendPrivateMessage" action="sendPrivateMessages" enctype="multipart/form-data" method="post" action="">
						<?php
							$messages = array
							(
								array("Rihanna","http://cdn.urbanislandz.com/wp-content/uploads/2013/07/Rihanna-twerk.jpg"),
							);
						?>

						<div class="send-pane grid-100 mobile-grid-100">
							<div class="user-data grid-100 mobile-grid-100">
								<div class="user-image grid-10 mobile-grid-30">
									<img src="<?php echo $messages[0][1];?>">
								</div>
								<div class="user-information grid-90 mobile-grid-70">
									<div class="user-name"><?php echo $messages[0][0];?></div>
								</div>								
							</div>
							<div class="message-data grid-100 mobile-grid-100">
								<div class="message-subject"><input type="text" name="subject" placeholder="Subject" data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2"></div>
								<div class="message-body-container">
									<div class="message-body">
										<textarea name="body" rows="4" cols="50" data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2">type your message here...</textarea>
									</div>								
								</div>
							</div>
							<div class="message-data grid-100 mobile-grid-100">
								<input type="hidden" name="recepientUid" value="51895628d1efa7a5d9df83c9"/>
								<input type="hidden" name="senderUid" value="518b090fd1ef11c72b4bcb85"/>

								<input type="submit" value="submit" name="submit"/>
							</div>	
						</div>					
				</form>		

		</div>
		