<?php
	require_once('includes/header.php');
?>

			<div id="maincol" >

<?php

// check the login details of the user and stop execution if not logged in
require "check.php";


$todo=$_POST['todo'];
$password=$_POST['password'];
$password2=$_POST['password2'];
/////////////////////////

if(isset($todo) and $todo=="change-password")
{
	$password=mysql_real_escape_string($password);
	
	//Setting flags for checking
	$status = "OK";
	$msg="";
	
	
		if ( strlen($password) < 3 or strlen($password) > 8 )
		{
			$msg=$msg."Password must be more than 3 char legth and maximum 8 char lenght<BR>";
			$status= "NOTOK";
		}
	
		if ( $password <> $password2 )
		{
			$msg=$msg."Both passwords are not matching<BR>";
			$status= "NOTOK";
		}
	
		if($status<>"OK")
		{
			echo "<font face='Verdana' size='2' color=red>$msg</font><br><center><input type='button' value='Retry' onClick='history.go(-1)'>	</center>";
		}
		else
		{ // if all validations are passed.
		
			//emcrypt password
			$password= md5($password);
			if($c1->query("update plus_signup set password='$password' where userid='$_SESSION[userid]'"))
			{
				echo "<font face='Verdana' size='2' ><center>Thanks <br> Your password changed successfully. Please keep changing your password for better security</font></center>";
			}
			else
			{
				echo "<font face='Verdana' size='2' color=red><center>Sorry <br> Failed to change password Contact Site Admin</font></center>";
			}
		}
}
else
{

	//form not submitted
	
	echo "<form action='change-password.php' method=post><input type=hidden name=todo value=change-password>
	
	 <tr bgcolor='#f1f1f1' > <td colspan='2' align='center'><font face='verdana, arial, helvetica' size='2' align='center'>&nbsp;<b>Change  Password</b> </font></td> </tr>
	
	<tr bgcolor='#ffffff' > <td ><font face='verdana, arial, helvetica' size='2' align='center'>  &nbsp;New Password
	</font></td> <td  align='center'><font face='verdana, arial, helvetica' size='2' >
	<input type ='password' class='bginput' name='password' ></font></td></tr>
	
	<tr bgcolor='#f1f1f1' > <td ><font face='verdana, arial, helvetica' size='2' align='center'>  &nbsp;Re-enter New Password
	</font></td> <td  align='center'><font face='verdana, arial, helvetica' size='2' >
	<input type ='password' class='bginput' name='password2' ></font></td></tr>
	
	<tr bgcolor='#ffffff' > <td colspan=2 align=center><input type=submit value='Change Password'><input type=reset value=Reset></font></td></tr>
	
	";

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


