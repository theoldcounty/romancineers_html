


		<div class="login-container">
			<style>
				.login-container {
					height: 320px;
					padding: 20px;
				}
  			</style>
			
			<form data-role="login-handler" data-validate=true id="loginForm" action="login" enctype="multipart/form-data" method="post" action="">
					
					<div class="send-pane grid-100 mobile-grid-100">
						<div class="message-data grid-100 mobile-grid-100">
							<div class="login-email"><input type="email" name="emailaddress" placeholder="email..." data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2"></div>
							<div class="login-password"><input type="password" name="password" placeholder="password..." data-required=true data-message-required="We need this!" data-minlength="2" data-message-minlength="More than 2"></div>
						</div>
						<div class="message-data grid-100 mobile-grid-100">
							<a data-role="fancybox" class="fancybox.ajax" href="_lightbox_template.html">I forgot password</a>
							<input type="submit" value="Log In" name="submit"/>
						</div>	
					</div>					
			</form>
			
			<button data-role="fancybox" class="fancybox.ajax" href="_lightbox_template.html">Create Your Account</button>
			
		</div>