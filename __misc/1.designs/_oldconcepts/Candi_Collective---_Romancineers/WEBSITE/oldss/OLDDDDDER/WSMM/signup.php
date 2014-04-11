<?php
include"includes/header.php";
?>
		<div id="sub-twocols" class="clearfix"><!--two col --> 
			<div id="maincol"><!--main col -->


<?php

// Collect the data from post method of form submission //
$userid=$_POST['userid'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$agree=$_POST['agree'];
$todo=$_POST['todo'];
$email=$_POST['email'];
$first = $_POST['first'];
$last = $_POST['last'];
$sex=$_POST['sex'];

$userid=mysql_real_escape_string($userid);
$password=mysql_real_escape_string($password);
$password2=mysql_real_escape_string($password2);
$agree=mysql_real_escape_string($agree);
$todo=mysql_real_escape_string($todo);
$email=mysql_real_escape_string($email);
$first=mysql_real_escape_string($first);
$last=mysql_real_escape_string($last);
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
	
			if(mail("$email","Your account for $site_name","Thank you for joining $site_name . We hope you are able to find the right person with us. Your login details are as follows: \n \nLogin ID: $userid \n Password: $password \n\n Please confirm your account via this link $site_editor_host/confirm.php?email=$email&hash=$hash \n\nThank You \n \n $site_admin_name","$headers"))
			{
				echo "<b>Thank you</b> <br>Your password has been posted to your email address . Please check your mail.";
			}		
			

			
		//encyrpt password
		$password= md5($password);
		$name = "$first $last";
	$c1->query("INSERT INTO signup(userid,password,email,name,registered,confirm_hash,is_confirmed) values('$userid','$password','$email','$name', '$current_time','$hash','0')");	
	$lastid =mysql_insert_id();
	$c1->query("INSERT INTO basics(id, what_is_your_gender, last_updated) values('$lastid','$sex','$current_time')");					



	}
}
else
{
?>
<form id="form55" name="form55" class="wufoo" autocomplete="off" enctype="multipart/form-data" method="post" action="#public">
<input type="hidden" name="todo" value="post"/>
<div class="info">
<h2>Signup</h2>
</div>

<ul>


<li id="foli2" 	class="">
<label class="desc" id="title2" for="Field2">
User ID
</label>
<div>
<input id="Field2" name="userid" type="text" class="field text medium" value=""	maxlength="255" tabindex="3"/>
</div>
</li>


<li id="foli2" class="">
<label class="desc" id="title2" for="Field2">
Password
</label>
<div>
<input id="Field2" name="password" type="password" class="field text medium" value=""	maxlength="255" tabindex="3"/>
</div>

<label class="desc" id="title2" for="Field2">
Re-Password
</label>
<div>
<input id="Field2" name="password2" type="password" class="field text medium" value=""	maxlength="255" tabindex="3"/>
</div>
</li>



<li id="foli2" class="">
<label class="desc" id="title2" for="Field2">
Email
</label>
<div>
<input id="Field2" name="email" type="text" class="field text medium" value=""	maxlength="255" tabindex="3"/>
</div>
</li>


<li id="foli106" class="">
<label class="desc" id="title106" for="Field106">
Name
</label>
<span>
<input id="Field106" name="first" type="text" class="field text" value="" size="8" tabindex="1"/>
<label for="Field106">First</label>
</span>
<span>
<input id="Field107" name="last" type="text" class="field text" value="" size="14" tabindex="2"/>
<label for="Field107">Last</label>
</span>
</li>




<li id="fo56li15" class="">
<label class="desc" id="title0" for="Field0">
Gender
<span id="req_0" class="req">*</span>
</label>
<div class="column1">
<input id="Field15" name="sex" class="field checkbox" value="male" tabindex="13" type="radio"/>
<label class="choice" for="Field15">Male</label>
</div>

<div class="column2">
<input id="Field15" name="sex" class="field checkbox" value="female" tabindex="13" type="radio"/>
<label class="choice" for="Field15">Female</label>
</div>
<div class="clr"></div>
</li>


<li id="fo56li15" class="">
<label class="desc" id="title0" for="Field0">
 I agree to terms and conditions
<span id="req_0" class="req">*</span>
</label>
<div class="column1">
<input id="Field15" name="agree" class="field checkbox" value="yes" tabindex="13" type="checkbox"/>
<label class="choice" for="Field15">Yes I do</label>

<input type="submit" value="Signup"/>
</ul>
</form>

<?php
}
?>

            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

