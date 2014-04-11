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
	$describe_yourself=$_REQUEST[describe_yourself];
	$date_headline=$_REQUEST[date_headline];
	
	
	if(!get_magic_quotes_gpc())
	{
		$todo=mysql_real_escape_string($todo);
		$describe_yourself=mysql_real_escape_string($describe_yourself);
		$date_headline=mysql_real_escape_string($date_headline);
	}		
	
		//collect all data of the member
		$c1->query("
		SELECT signup.id, signup.userid, intro.describe_yourself, intro.date_headline
		FROM signup
		LEFT JOIN intro
		ON signup.id = intro.id WHERE signup.userid='$_SESSION[userid]'");  
	
		//row results
		$row = $c1->fetchObject();	  
		
	
					
	// check the login details of the user and stop execution if not logged in
	
	//form submitted validate results
	if(isset($todo) and $todo=="update-profile")
	{
		// set the flags for validation and messages
		$status = "OK";
		$msg="";
	
	
		if($status<>"OK")
		{ // if validation failed
			echo "<font face='Verdana' size='2' color=red>$msg</font>
			<br><input type='button' value='Retry' onClick='history.go(-1)'>";
		}
		else
		{ // if all validations are passed.	
		
			$c1->query("SELECT * FROM intro WHERE id=$row->id");  
		
			if(!$c1->getNumRows())
			{		
				if($c1->query("INSERT INTO `intro` (`id`, `describe_yourself` , `date_headline` , `last_updated` )
				VALUES ('$row->id', '$describe_yourself', '$date_headline', '$current_time')"))
				{
					echo "You have successfully updated your profile<br>";
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
				}			
			}
			else
			{	
				if($c1->query("UPDATE intro SET describe_yourself='$describe_yourself',date_headline='$date_headline' WHERE id='$row->id'"))
				{
					echo "You have successfully updated your profile<br>";
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
				}
			}
		}
		
		
	
		//clear submit variables
		unset($todo);
		//refresh
	}
	else
	{
	 
	?>
	   
	<form id="form55" name="form55" class="wufoo" autocomplete="off" enctype="multipart/form-data" method="post" action="#public">
	<input type="hidden" name="todo" value="update-profile"/>
	<div class="info">
	<h2>Intro</h2>
	</div>
	
	<ul>
	<li id="fo59li1" class="altInstruct">
		<label class="desc" id="title1" for="Field1">
		Describe yourself and your perfect match to our community.
		<span id="req_1" class="req">*</span>
		</label>
		<div>
		<textarea id="Field1" name="describe_yourself" class="field textarea medium" rows="10" cols="50" tabindex="2"><?php echo $row->describe_yourself ; ?></textarea>
		</div>
		<p class="instruct" id="instruct1"><small>Please be as detailed as possible. Remember, sell yourself, be proactive, positive and inspiring to others.</small></p>
	</li>
	
	<li id="fo59li1" class="altInstruct">
		<label class="desc" id="title1" for="Field1">
		Your dating headline.
		<span id="req_1" class="req">*</span>
		</label>
		<div>
		<textarea id="Field1" name="date_headline" class="field textarea medium" rows="10" cols="50" tabindex="2"><?php echo $row->date_headline ; ?></textarea>
		</div>
		<p class="instruct" id="instruct1"><small>Express your success and your latest ambitions.</small></p>
	</li>
	</ul>
	
	<input type="reset" value="Reset" size="20" />
	<input type="submit" value="Submit" size="20" />
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

