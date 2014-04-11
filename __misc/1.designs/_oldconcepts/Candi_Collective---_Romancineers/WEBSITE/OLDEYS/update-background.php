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
	$ethnicities_describe_you_the_best=$_REQUEST[ethnicities_describe_you_the_best];
	$what_is_your_faith=$_REQUEST[what_is_your_faith];
	$describe_your_education=$_REQUEST[describe_your_education];
	$languages_do_you_speak=$_REQUEST[languages_do_you_speak];
	$sit_on_the_political_fence=$_REQUEST[sit_on_the_political_fence];
	
	if(!get_magic_quotes_gpc())
	{
		$todo=mysql_real_escape_string($todo);
		$ethnicities_describe_you_the_best=mysql_real_escape_string($ethnicities_describe_you_the_best);
		$what_is_your_faith=mysql_real_escape_string($what_is_your_faith);
		$describe_your_education=mysql_real_escape_string($describe_your_education);
		$languages_do_you_speak=mysql_real_escape_string($languages_do_you_speak);
		$sit_on_the_political_fence=mysql_real_escape_string($sit_on_the_political_fence);
	}
	
	if(!is_null($ethnicities_describe_you_the_best))
	{		
		$ethnicities_describe_you_the_best = implode(",", $ethnicities_describe_you_the_best);
	}
	
	if(!is_null($languages_do_you_speak))
	{		
		$languages_do_you_speak = implode(",", $languages_do_you_speak);
	}
	
	
		//collect all data of the member
		$c1->query("
		SELECT signup.id, signup.userid, background.ethnicities_describe_you_the_best, background.what_is_your_faith, background.describe_your_education, background.languages_do_you_speak, background.sit_on_the_political_fence
		FROM signup
		LEFT JOIN background
		ON signup.id = background.id WHERE signup.userid='$_SESSION[userid]'");  
	
	
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
		
			$c1->query("SELECT * FROM background WHERE id=$row->id");  
		
			if(!$c1->getNumRows())
			{		
				if($c1->query("INSERT INTO `background` (`id`, `ethnicities_describe_you_the_best` , `what_is_your_faith` , `describe_your_education`, `languages_do_you_speak` ,`sit_on_the_political_fence` , `last_updated` )
				VALUES ('$row->id', '$ethnicities_describe_you_the_best', '$what_is_your_faith', '$describe_your_education', '$languages_do_you_speak', '$sit_on_the_political_fence', '$current_time')"))
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
				if($c1->query("UPDATE background 
				SET 
				ethnicities_describe_you_the_best='$ethnicities_describe_you_the_best',
				what_is_your_faith='$what_is_your_faith',
				describe_your_education='$describe_your_education',
				languages_do_you_speak='$languages_do_you_speak',
				sit_on_the_political_fence='$sit_on_the_political_fence'					 
				WHERE id='$row->id'"))
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
	<h2>Background/Values</h2>
	</div>
	
    
	<?php
	$ethnicities_describe_you_the_best = explode(",", $row->ethnicities_describe_you_the_best);
	$languages_do_you_speak = explode(",", $row->languages_do_you_speak);
	?>    
    
	<ul>
	<li id="fo56li15" class="">
	<label class="desc" id="title0" for="Field0">
	Which ethnicities describe you the best?
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
	<input id="Field15" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="Asian" tabindex="13" type="checkbox" <?php if(in_array("Asian", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Asian</label>
	
	<input id="Field15" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="East Indian" tabindex="13" type="checkbox" <?php if(in_array("East Indian", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">East Indian</label>
	
	<input id="Field15" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="Middle Eastern" tabindex="13" type="checkbox" <?php if(in_array("Middle Eastern", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Middle Eastern</label>
	
	<input id="Field15" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="Pacific Islander" tabindex="13" type="checkbox" <?php if(in_array("Pacific Islander", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Pacific Islander</label>
	
	<input id="Field15" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="Other" tabindex="13" type="checkbox" <?php if(in_array("Other", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Other</label>
	</div>
	
	<div class="column2">
	<input id="Field15" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="Black" tabindex="13" type="checkbox" <?php if(in_array("Black", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Black / African descent</label>
	
	<input id="Field15" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="Latino" tabindex="13" type="checkbox" <?php if(in_array("Latino", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Latino / Hispanic</label>
	
	<input id="Field15" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="Native American" tabindex="13" type="checkbox" <?php if(in_array("Native American", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Native American</label>
	
	<input id="Field15" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="White" tabindex="13" type="checkbox" <?php if(in_array("White", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">White / Caucasian</label>
	
	</div>
	<div class="clr"></div>
	</li>
	
	
	
	
	<li id="fo56li15" class="">
	<label class="desc" id="title0" for="Field0">
	What is your faith?
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
	<input id="Field15" name="what_is_your_faith" class="field checkbox" value="Agnostic" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Agnostic") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Agnostic</label>
	
	<input id="Field15" name="what_is_your_faith" class="field checkbox" value="Buddhist" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Buddhist") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Buddhist / Taoist</label>
	
	<input id="Field15" name="what_is_your_faith" class="field checkbox" value="Christian LDS" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Christian LDS") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Christian / LDS</label>
	
	<input id="Field15" name="what_is_your_faith" class="field checkbox" value="Hindu" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Hindu") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Hindu</label>
	
	<input id="Field15" name="what_is_your_faith" class="field checkbox" value="Muslim" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Muslim") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Muslim / Islam</label>
	
	<input id="Field15" name="what_is_your_faith" class="field checkbox" value="Other" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Other") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Other</label>
	
	<input id="Field15" name="what_is_your_faith" class="field checkbox" value="No Answer" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "No Answer") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">No Answer</label>
	
	</div>
	
	<div class="column2">
	<input id="Field15" name="what_is_your_faith" class="field checkbox" value="Atheist" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Atheist") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Atheist</label>
	
	<input id="Field15" name="what_is_your_faith" class="field checkbox" value="Christian Catholic" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Christian Catholic") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Christian / Catholic</label>
	
	<input id="Field15" name="what_is_your_faith" class="field checkbox" value="Christian Protestant" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Christian Protestant") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Christian / Protestant</label>
	
	<input id="Field15" name="what_is_your_faith" class="field checkbox" value="Jewish" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Jewish") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Jewish</label>
	
	<input id="Field15" name="what_is_your_faith" class="field checkbox" value="Spiritual but not religious" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Spiritual but not religious") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Spiritual but not religious</label>
	
	<input id="Field15" name="what_is_your_faith" class="field checkbox" value="Christian" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Christian") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Christian / Other</label>
	
	</div>
	<div class="clr"></div>
	</li>
	
	
	
	
	
	
	<li id="fo56li15" class="">
	<label class="desc" id="title0" for="Field0">
	How would you describe your education?
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
	<input id="Field15" name="describe_your_education" class="field checkbox" value="High school" tabindex="13" type="radio" <?php if($row->describe_your_education== "High school") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">High school</label>
	
	
	<input id="Field15" name="describe_your_education" class="field checkbox" value="Associates degree" tabindex="13" type="radio" <?php if($row->describe_your_education== "Associates degree") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Associates degree</label>
	
	
	<input id="Field15" name="describe_your_education" class="field checkbox" value="Graduate degree" tabindex="13" type="radio" <?php if($row->describe_your_education== "Graduate degree") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Graduate degree</label>
	
	
	<input id="Field15" name="describe_your_education" class="field checkbox" value="No Answer" tabindex="13" type="radio" <?php if($row->describe_your_education== "No Answer") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">No Answer</label>
	
	</div>
	
	<div class="column2">
	<input id="Field15" name="describe_your_education" class="field checkbox" value="Some college" tabindex="13" type="radio" <?php if($row->describe_your_education== "Some college") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Some college</label>
	
	<input id="Field15" name="describe_your_education" class="field checkbox" value="Bachelors degree" tabindex="13" type="radio" <?php if($row->describe_your_education== "Bachelors degree") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Bachelors degree</label>
	
	<input id="Field15" name="describe_your_education" class="field checkbox" value="PhD" tabindex="13" type="radio" <?php if($row->describe_your_education== "PhD") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">PhD / Post Doctoral</label>
	
	</div>
	<div class="clr"></div>
	</li>
	
	
	
	
	<li id="fo56li15" class="">
	<label class="desc" id="title0" for="Field0">
	What languages do you speak?
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Arabic" tabindex="13" type="checkbox" <?php if(in_array("Arabic", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Arabic</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Dutch" tabindex="13" type="checkbox" <?php if(in_array("Dutch", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Dutch</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="French" tabindex="13" type="checkbox" <?php if(in_array("French", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">French</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Hebrew" tabindex="13" type="checkbox" <?php if(in_array("Hebrew", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Hebrew</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Italian" tabindex="13" type="checkbox" <?php if(in_array("Italian", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Italian</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Norwegian" tabindex="13" type="checkbox" <?php if(in_array("Norwegian", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Norwegian</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Russian" tabindex="13" type="checkbox" <?php if(in_array("Russian", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Russian</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Swedish" tabindex="13" type="checkbox" <?php if(in_array("Swedish", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Swedish</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Urdu" tabindex="13" type="checkbox" <?php if(in_array("Urdu", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Urdu</label>
	</div>
	
	<div class="column2">
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Chinese" tabindex="13" type="checkbox" <?php if(in_array("Chinese", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Chinese</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="English" tabindex="13" type="checkbox" <?php if(in_array("English", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">English</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="German" tabindex="13" type="checkbox" <?php if(in_array("German", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">German</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Hindi" tabindex="13" type="checkbox" <?php if(in_array("Hindi", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Hindi</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Japanese" tabindex="13" type="checkbox" <?php if(in_array("Japanese", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Japanese</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Portuguese" tabindex="13" type="checkbox" <?php if(in_array("Portuguese", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Portuguese</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Spanish" tabindex="13" type="checkbox" <?php if(in_array("Spanish", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Spanish</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Tagalog" tabindex="13" type="checkbox" <?php if(in_array("Tagalog", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Tagalog</label>
	
	<input id="Field15" name="languages_do_you_speak[]" class="field checkbox" value="Other" tabindex="13" type="checkbox" <?php if(in_array("Other", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Other</label>
	</div>
	<div class="clr"></div>
	</li>
	
	
	<li id="decfie2" class="">
	<label class="desc" id="title14" for="Field14">
	Where do you sit on the political fence?
	</label>
	<div>
	<select id="Field14" name="sit_on_the_political_fence" class="field select medium" tabindex="15">
		<option value="277" <?php if($row->sit_on_the_political_fence== "277") { ?> selected="selected" <?php } ?>>Ultra Conservative</option>
		<option value="278" <?php if($row->sit_on_the_political_fence== "278") { ?> selected="selected" <?php } ?>>Conservative</option>
		<option value="279" <?php if($row->sit_on_the_political_fence== "279") { ?> selected="selected" <?php } ?>>Middle of the Road</option>
		<option value="280" <?php if($row->sit_on_the_political_fence== "280") { ?> selected="selected" <?php } ?>>Liberal</option>
		<option value="281" <?php if($row->sit_on_the_political_fence== "281") { ?> selected="selected" <?php } ?>>Very Liberal</option>
		<option value="282" <?php if($row->sit_on_the_political_fence== "282") { ?> selected="selected" <?php } ?>>Non-conformist</option>
		<option value="283" <?php if($row->sit_on_the_political_fence== "283") { ?> selected="selected" <?php } ?>>Some other viewpoint</option>
	</select>
	</div>
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

