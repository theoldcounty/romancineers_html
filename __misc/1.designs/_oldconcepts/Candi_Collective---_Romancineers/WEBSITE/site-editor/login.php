<?php
	require_once('includes/header.php');
?>
			<div id="maincol" >

<?php
		$c1->query("SELECT * FROM plus_signup WHERE userid='$userid' AND password = '$password'");

		if($rec = $c1->fetchAll())
		{		
			//admin has username, password, confirmed and is enabled.
			if(($rec[0]['userid']==$userid)&&($rec[0]['password']==$password)&&($rec[0]['is_confirmed']=='1')&&($rec[0]['enable']=='1'))
			{
				echo mysql_error();
				echo'You have Successfully Logged in';		
			}
			else
			{
				echo'Your account may still be awaiting confirmation from yourself or the super admins.<br>';	
			}
		}
		else 
		{
			if(isset($userid))
			{
				echo "Wrong Login. Use your correct  Userid and Password and Try <br>
				<input type='button' value='Retry' onClick='history.go(-1)'>";	
			}
		}
		
	
if(!isset($_SESSION['id']))
{
?>
			<h3>Login</h3>
            
            
            
            
			<form id="preview" name="preview" action="login.php" method="post">
            	<input type="hidden" name="todo" value="update-profile">
				<div class="form_row">					
					<label class="mylabelstyle">Login:</label>
					<input type="text" class="myinputstyle" name="userid" size="40" />
				</div>
				<div class="form_row">
						<label class="mylabelstyle">Password:</label>
						<input type="password" class="myinputstyle" name="password" size="40" />				
				</div>
				<div class="form_row_centered">				
					<input class="myinputstyle" type="reset" value="Delete" size="20" />
					<input class="myinputstyle" type="submit" value="Login" size="20" />
				</div>
			</form>
<?php
}
?>







			</div>


	<?php
		require_once('includes/left.php');
	?>

</div>


<?php
	require_once('includes/footer.php');
?>


