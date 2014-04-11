<?php
	require_once('includes/header.php');
?>

			<div id="maincol" >

			<?php
            if(isset($_SESSION['id']))
            {
                echo'Successfully logged';
            }
			else
			{



// Collect the data from post method of form submission //
$userid=$_POST['userid'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$agree=$_POST['agree'];
$todo=$_POST['todo'];
$email=$_POST['email'];
$name=$_POST['name'];
$sex=$_POST['sex'];

$userid=mysql_real_escape_string($userid);
$password=mysql_real_escape_string($password);
$password2=mysql_real_escape_string($password2);
$agree=mysql_real_escape_string($agree);
$todo=mysql_real_escape_string($todo);
$email=mysql_real_escape_string($email);
$name=mysql_real_escape_string($name);
$sex=mysql_real_escape_string($sex);

if(isset($todo) and $todo=="post")
{
	$status = "OK";
	$msg="";
		
	// if userid is less than 3 char then status is not ok
	if(!isset($userid) or strlen($userid) <3)
	{
		$msg=$msg."User id should be =3 or more than 3 char length<BR>";
		$status= "NOTOK";
	}
	
	if(!ctype_alnum($userid))
	{
		$msg=$msg."User id should contain alphanumeric  chars only<BR>";
		$status= "NOTOK";
	}

	$c1->query("SELECT userid FROM signup WHERE userid = '$userid'");	
	
	if($c1->getNumRows())
	{
		$msg=$msg."Userid already exists. Please try another one<BR>";
		$status= "NOTOK";
	}

	if ( strlen($password) < 3 )
	{
		$msg=$msg."Password must be more than 3 char legth<BR>";
		$status= "NOTOK";
	}
	
	if ( $password <> $password2 )
	{
		$msg=$msg."Both passwords are not matching<BR>";
		$status= "NOTOK";
	}

	if ($agree<>"yes")
	{
		$msg=$msg."You must agree to terms and conditions<BR>";
		$status= "NOTOK";
	}
	
	if($status<>"OK")
	{
		echo "<font face='Verdana' size='2' color=red>$msg</font><br><input type='button' value='Retry' onClick='history.go(-1)'>";
	}
	else
	{ // if all validations are passed.


		//random hash
		$hash= generateRandomString();
		$hash= md5($hash);
				
		echo "<font face='Verdana' size='2' color=green>Welcome, You have successfully signed up<br><br><a href=login.php>Click here to login</a><br></font>";		
			$adminemail="$site_admin_email";         ///// Change this address within quotes to your address ///
			$headers.="Reply-to: $adminemail\n";
			$headers .= "From: $adminemail\n";
			$headers .= "Errors-to: $adminemail\n";
			//$headers = "Content-Type: text/html; charset=iso-8859-1\n".$headers;// for html mail un-comment this line
	
			if(mail("$email","Your Admin account for $site_name","This is in response to your request for login details at $site_name \n \nLogin ID: $userid \n Password: $password \n\n Please confirm your account via this link $site_editor_host/confirm.php?email=$email&hash=$hash \n\nThank You \n \n $site_admin_name","$headers"))
			{
				echo "<center><font face='Verdana' size='2' ><b>THANK YOU</b> <br>Your password is posted to your email address . Please check your mail after some time. </center>";
			}		
			

			
		//encyrpt password
		$password= md5($password);
		echo'TIME '.$current_time.'';
		
	$c1->query("INSERT INTO signup(userid,password,email,name,registered,confirm_hash,is_confirmed) values('$userid','$password','$email','$name', '$current_time','$hash','0')");	
	
	$c1->query("INSERT INTO basics(id, what_is_your_gender) values('mysql_insert_id()','$sex')");					



	}
}
else
{
?>

    <table border='0' width='50%' cellspacing='0' cellpadding='0' align=center><form name=form1 method=post action=signup.php onsubmit='return validate(this)'><input type=hidden name=todo value=post>
    
    <tr bgcolor='#f1f1f1'><td align=center colspan=2><font face='Verdana' size='2' ><b>Signup</b></td></tr>
    <tr ><td >&nbsp;<font face='Verdana' size='2' >User ID (alphanumeric  chars only)</td><td ><font face='Verdana' size='2'><input type=text name=userid></td></tr>
    
    <tr bgcolor='#f1f1f1'><td >&nbsp;<font face='Verdana' size='2' >Password</td><td ><font face='Verdana' size='2'><input type=password name=password></td></tr>
    <tr ><td >&nbsp;<font face='Verdana' size='2' >Re-enter Password</td><td ><font face='Verdana' size='2'><input type=password name=password2></td></tr>
    
    
    <tr bgcolor='#f1f1f1'><td ><font face='Verdana' size='2' >&nbsp;Email</td><td  ><input type=text name=email></td></tr>
    <tr ><td >&nbsp;<font face='Verdana' size='2' >Name</td><td ><font face='Verdana' size='2'><input type=text name=name></td></tr>
    
    <tr bgcolor='#f1f1f1'><td >&nbsp;<font face='Verdana' size='2' >Sex</td><td ><font face='Verdana' size='2'>  <input type='radio' value=male checked name='sex'>Male <input type='radio' value=female  name='sex'>Female</td></tr>
    
    <tr ><td >&nbsp;<font face='Verdana' size='2' >I agree to terms and conditions</td><td ><font face='Verdana' size='2'><input type=checkbox name=agree value='yes'></td></tr>
    
    <tr bgcolor='#f1f1f1'><td align=center colspan=2><input type=submit value=Signup></td></tr>
    </table>
<?php
}


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


