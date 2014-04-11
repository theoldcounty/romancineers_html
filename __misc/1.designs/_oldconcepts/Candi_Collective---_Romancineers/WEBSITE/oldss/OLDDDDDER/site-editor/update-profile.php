<?php
	require_once('includes/header.php');
?>
			<div id="maincol" >

			<?php
			$todo=$_POST['todo'];
			$name=$_POST['name'];
			$email=$_POST['email'];
			$sex=$_POST['sex'];			
			// check the login details of the user and stop execution if not logged in
			require "check.php";

if(isset($todo) and $todo=="update-profile")
{
	// set the flags for validation and messages
	$status = "OK";
	$msg="";

	// if name is less than 5 char then status is not ok
	if (strlen($name) < 5) 
	{
		$msg=$msg."Your name  must be more than 5 char length<BR>";
		$status= "NOTOK";
	}

	// you can add email validation here if required.
	// The code for email validation is available at www.plus2net.com

	if($status<>"OK")
	{ // if validation failed
		echo "<font face='Verdana' size='2' color=red>$msg</font><br><input type='button' value='Retry' onClick='history.go(-1)'>";
	}
	else
	{ // if all validations are passed.
	

		if($c1->query("update plus_signup set email='$email',name='$name',sex='$sex' where userid='$_SESSION[userid]'"))
		{
			echo "<font face='Verdana' size='2' color=green>You have successfully updated your profile<br></font>";
		}
		else{
			echo "<font face='Verdana' size='2' color=red>There is some problem in updating your profile. Please contact site admin<br></font>";
		}
	}
	
	//clear submit variables
	unset($todo);
	//refresh
}
else
{
            // check the login details of the user and stop execution if not logged in
            //require "check.php";
            
            // If member has logged in then below script will be execuated.
            // let us collect all data of the member
			$c1->query("select * from plus_signup where userid='$_SESSION[userid]'");
			
			$row = $c1->fetchObject();
            
            //Let us set the period button based on the data of the sex field
            // You can see male button is checked if it is set to male
            // else it is  set to female
            if($row->sex == "male")
            {
                $ckb="<input type=\"radio\" value=\"male\" name=\"sex\" checked=\"checked\" />Male
                <input type=\"radio\" value=\"female\"  name=\"sex\" />Female";
            }
            else
            {
                $ckb="<input type=\"radio\" value=\"male\" name=\"sex\" />Male
                <input type=\"radio\" value=\"female\" name=\"sex\" checked=\"checked\" />Female";
            }            
            // One form with a hidden field is prepared with default values taken from field.
            ?>
            
			<h3>Preview.<span>Your style</span></h3>
			<form id="preview" name="preview" action="update-profile.php" method="post">
            	<input type="hidden" name="todo" value="update-profile">
				<div class="form_row">					
					<label class="mylabelstyle">Email:</label>
					<input type="text" class="myinputstyle" name="email" value="<?php echo $row->email ; ?>" size="40" />
				</div>
				<div class="form_row">
						<label class="mylabelstyle">Name:</label>
						<input type="text" class="myinputstyle" name="name" value="<?php echo $row->name ; ?>" size="40" />				
				</div>
				<div class="form_row">
					<label class="mylabelstyle">Gender:</label>
					<?php echo $ckb ; ?>
				</div>	
				<div class="form_row_centered">				
					<input class="myinputstyle" type="reset" value="Delete" size="20" />
					<input name="update" class="myinputstyle" type="submit" value="Update" size="20" />
				</div>
			</form>
<?php
}//end of else
?>
			</div>



	<?php
		require_once('includes/left.php');
	?>

</div>


<?php
	require_once('includes/footer.php');
?>


