<?php
include"includes/header.php";
?>
		<div id="sub-twocols" class="clearfix"><!--two col --> 
			<div id="maincol"><!--main col -->
<?php
		$c1->query("SELECT * FROM signup WHERE userid='$userid' AND password = '$password'");

		if($rec = $c1->fetchAll())
		{		
			//admin has username, password, confirmed and is enabled.
			if(($rec[0]['userid']==$userid)&&($rec[0]['password']==$password)&&($rec[0]['is_confirmed']=='1'))
			{
				echo mysql_error();
				echo'You have Successfully Logged in';		
			}
			else
			{
				echo'Your account may still be awaiting confirmation from yourself.<br>';	
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


<form id="form55" name="form55" class="wufoo" autocomplete="off" enctype="multipart/form-data" method="post" action="#public">
<input type="hidden" name="todo" value="update-profile">
<div class="info">
<h2>Login</h2>
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

