<?php
include"includes/header.php";
?>
		<div id="sub-twocols" class="clearfix"><!--two col --> 
			<div id="maincol"><!--main col -->

<?php 


$email = $_POST[email];

if(isset($email))
{
	while (list ($key,$val) = each ($_POST)) 
	{
		$$key = $val;
	}

	$email=mysql_real_escape_string($email);
	$status = "OK";
	$msg="";
	//error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);
	if (!stristr($email,"@") OR !stristr($email,".")) 
	{
		$msg="Your email address is not correct<BR>";
		$status= "NOTOK";
	}

	
	echo "<br><br>";
	if($status=="OK")
	{  
	
			$c1->query("SELECT email,userid,password FROM signup WHERE signup.email = '$email'");		



			$recs= $c1->getNumRows();
			$row=$c1->fetchObject();
			$em=$row->email;// email is stored to a variable
		 
		
			if($recs == 0)
			{
				echo "<center><font face='Verdana' size='2' color=red><b>No Password</b><br> Sorry Your address is not there in our database . You can signup and login to use our site. <BR><BR><a href='signup.php'> Sign UP </a> </center>";
			}
			
			//generate random password
			//random hash
			$newpassword= generateRandomString();
			$newpassword2= md5($newpassword);			
								

			//encrypt and reset password
			if($c1->query("UPDATE signup SET password='$newpassword2' WHERE email='$em'"))
			{
				echo "<font face='Verdana' size='2' color=green>You have successfully reset your password, please check your email.<br></font>";
			}			
	
			$adminemail="$site_admin_email";         ///// Change this address within quotes to your address ///
			$headers.="Reply-to: $adminemail\n";
			$headers .= "From: $adminemail\n";
			$headers .= "Errors-to: $adminemail\n";
			//$headers = "Content-Type: text/html; charset=iso-8859-1\n".$headers;// for html mail un-comment this line
	
			if(mail("$em","Your Request for login details","This is in response to your request for a new password. \n \nLogin ID: $row->userid \n Password: $newpassword \n\n Thank You \n \n $site_admin_name","$headers"))
			{
				echo "<center><font face='Verdana' size='2' ><b>THANK YOU</b> <br>Your password is posted to your email address . Please check your mail after some time. </center>";
			}
			else
			{ 
				echo " <center><font face='Verdana' size='2' color=red >There is some system problem in sending login details to your address. Please contact site-admin. <br><br><input type='button' value='Retry' onClick='history.go(-1)'></center></font>";
			}
			unset($newpassword);
			unset($newpassword2);
	}
	else
	{
		echo "<center><font face='Verdana' size='2' color=red >$msg <br><br><input type='button' value='Retry' onClick='history.go(-1)'></center></font>";
	}
}
else
{
?>

<form id="form55" name="form55" class="wufoo" autocomplete="off" enctype="multipart/form-data" method="post" action="#public">
<input type="hidden" name="todo" value="update-profile">
<div class="info">
<h2>Forgot Password ?</h2>
</div>

<ul>


<li id="foli2" 	class="">
<label class="desc" id="title2" for="Field2">
Enter your email address:
</label>
<div>
<input id="Field2" name="email" type="text" class="field text medium" value=""	maxlength="255" tabindex="3"/>
</div>
</li>

<input type="reset" value="Delete" size="20" />
<input type="submit" value="Login" size="20" />
</ul>
</form>
                            
<?php
}
?>
            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

