<?php
include"includes/header.php";
?>
		<div id="sub-twocols" class="clearfix"><!--two col --> 
			<div id="maincol"><!--main col -->

<?php
if(isset($_SESSION['id']))
{
	//variables
	$todo=$_REQUEST[todo];
	$name=$_REQUEST[name];
	$email=$_REQUEST[email];
	$password1=$_REQUEST[password1];
	$password2=$_REQUEST[password2];
	
	
	if(!get_magic_quotes_gpc())
	{
		$todo=mysql_real_escape_string($todo);
		$name=mysql_real_escape_string($name);
		$email=mysql_real_escape_string($email);
		$password1=mysql_real_escape_string($password1);
		$password2=mysql_real_escape_string($password2);	
	}		
	
		
		
					
	// check the login details of the user and stop execution if not logged in
	
	//form submitted validate results
	if(isset($todo) and $todo=="update-profile")
	{
		// set the flags for validation and messages
		$status = "OK";
		$msg="";
	
		// if name is less than 5 char then status is not ok
		if (strlen($name) < 3) 
		{
			$msg=$msg."Your name  must be more than 3 char length<BR>";
			$status= "NOTOK";
		}
	
		// you can add email validation here if required.
		// The code for email validation is available at www.plus2net.com
	
		if(!is_null($password1))
		{
			if (strlen($password1) < 3 or strlen($password1)> 8 )
			{
				$msg=$msg."Password must be more than 3 char legth and maximum 8 char lenght<BR>";
				$status= "NOTOK";
			}
		
			if ( $password1 <> $password2 )
			{
				$msg=$msg."Both passwords are not matching<BR>";
				$status= "NOTOK";
			}
		}
	
		if($status<>"OK")
		{ // if validation failed
			echo "<font face='Verdana' size='2' color=red>$msg</font>
			<br><input type='button' value='Retry' onClick='history.go(-1)'>";
		}
		else
		{ // if all validations are passed.	
		if(!is_null($password1))
		{
			//emcrypt password
			$password1= md5($password1);
			if($c1->query("UPDATE signup SET password='$password1' WHERE userid='$_SESSION[userid]'"))
			{
				echo "Your password changed successfully. Please keep changing your password for better security.<br>";
			}
			else
			{
				echo "Sorry <br> Failed to change password";
			}
		}
	
	
			if($c1->query("UPDATE signup SET email='$email',name='$name' WHERE userid='$_SESSION[userid]'"))
			{
				echo "You have successfully updated your profile<br>";
			}
			else
			{
				echo "There is some problem in updating your profile. Please contact site admin<br>";
			}
		}
		
		
	
		//clear submit variables
		unset($todo);
		//refresh
	}
	else
	{
		//collect all data of the member
		$c1->query("SELECT * FROM signup WHERE userid='$_SESSION[userid]'");
		
		//row results
		$row = $c1->fetchObject();	   
	?>
	
	
	<form id="form55" name="form55" class="wufoo" autocomplete="off" enctype="multipart/form-data" method="post" action="#public">
	<input type="hidden" name="todo" value="update-profile">
	<div class="info">
	<h2>Edit</h2>
	</div>
	
	<ul>
	
	
	<li id="foli2" 	class="">
		<label class="desc" id="title2" for="Field2">
		Email
		</label>
		<div>
		<input id="Field2" name="email" type="text" class="field text medium" value="<?php echo $row->email ; ?>"	maxlength="255" tabindex="3"/>
		</div>
	</li>
	
	
	<li id="foli2" class="">
		<label class="desc" id="title2" for="Field2">
		Name
		</label>
		<div>
		<input id="Field2" name="name" type="text" class="field text medium" value="<?php echo $row->name ; ?>"	maxlength="255" tabindex="3"/>
		</div>
	</li>
	
	
	
	<li id="foli2" class="">
		<label class="desc" id="title2" for="Field2">
		New Password
		</label>
		<div>
		<input id="Field2" name="password1" type="password" class="field text medium" value=""	maxlength="255" tabindex="3"/>
		</div>
		
		<label class="desc" id="title2" for="Field2">
		Re-enter New Password
		</label>
		<div>
		<input id="Field2" name="password2" type="password" class="field text medium" value=""	maxlength="255" tabindex="3"/>
		</div>
	</li>
	
	
	<input type="reset" value="Reset" size="20" />
	<input type="submit" value="Submit" size="20" />
	</ul>
	</form>
	
	<?php
	}//end of else


}
else
{
	?> Sorry you can not view this page unless you are logged in<?php
}
?>

            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

