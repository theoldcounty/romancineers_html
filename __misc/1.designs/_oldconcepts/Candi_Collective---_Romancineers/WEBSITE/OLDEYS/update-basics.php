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
	$what_brings_you_here=$_REQUEST[what_brings_you_here];
	$relationship_status=$_REQUEST[relationship_status];
	$what_is_your_gender=$_REQUEST[what_is_your_gender];
	$gender_you_looking_for=$_REQUEST[gender_you_looking_for];
	$age_range_you_looking_for=$_REQUEST[age_range_you_looking_for];
	$where_should_we_look=$_REQUEST[where_should_we_look];
	$how_tall_are_you=$_REQUEST[how_tall_are_you];
	$your_body_type=$_REQUEST[your_body_type];
	$your_sign=$_REQUEST[your_sign];
	
	
	if(!get_magic_quotes_gpc())
	{
		$todo=mysql_real_escape_string($todo);
		$what_brings_you_here=mysql_real_escape_string($what_brings_you_here);
		$relationship_status=mysql_real_escape_string($relationship_status);
		$what_is_your_gender=mysql_real_escape_string($what_is_your_gender);
		$gender_you_looking_for=mysql_real_escape_string($gender_you_looking_for);
		$age_range_you_looking_for=mysql_real_escape_string($age_range_you_looking_for);
		$where_should_we_look=mysql_real_escape_string($where_should_we_look);
		$how_tall_are_you=mysql_real_escape_string($how_tall_are_you);
		$your_body_type=mysql_real_escape_string($your_body_type);
		$your_sign=mysql_real_escape_string($your_sign);					
	}		
	
	if(!is_null($age_range_you_looking_for))
	{
		$age_range_you_looking_for = implode(",", $age_range_you_looking_for);
	}
	
	if(!is_null($how_tall_are_you))
	{
		$how_tall_are_you = implode(",", $how_tall_are_you);
	}
	
		//collect all data of the member
		$c1->query("
		SELECT signup.id, signup.userid, basics.what_brings_you_here, basics.what_brings_you_here, basics.what_is_your_gender, basics.gender_you_looking_for, basics.age_range_you_looking_for, basics.where_should_we_look, basics.how_tall_are_you, basics.your_body_type, basics.your_sign
		FROM signup
		LEFT JOIN basics
		ON signup.id = basics.id WHERE signup.userid='$_SESSION[userid]'");  
	
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
		
			$c1->query("SELECT * FROM basics WHERE id=$row->id");  
		
			if(!$c1->getNumRows())
			{
				if($c1->query("INSERT INTO `basics` (`id`, `what_brings_you_here` , `what_is_your_gender` , `gender_you_looking_for` ,`age_range_you_looking_for` , `where_should_we_look` ,`how_tall_are_you` , `your_body_type` , `your_sign` , `last_updated` )
	VALUES ('$row->id', '$what_brings_you_here', '$what_is_your_gender', '$gender_you_looking_for','$age_range_you_looking_for', '$where_should_we_look', `how_tall_are_you` , `your_body_type` , `your_sign` ,'$current_time')"))
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
				if($c1->query("UPDATE basics SET what_brings_you_here='$what_brings_you_here', what_is_your_gender='$what_is_your_gender', gender_you_looking_for='$gender_you_looking_for',
	age_range_you_looking_for='$age_range_you_looking_for', where_should_we_look='$where_should_we_look', how_tall_are_you='$how_tall_are_you', your_body_type='$your_body_type', your_sign='$your_sign' WHERE id='$row->id'"))
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

		$age_range_you_looking_for = explode(",", $row->age_range_you_looking_for); 
		$how_tall_are_you = explode(",", $row->how_tall_are_you); 
	?>
	
	<form id="form55" name="form55" class="wufoo" autocomplete="off" enctype="multipart/form-data" method="post" action="#public">
	<input type="hidden" name="todo" value="update-profile"/>
	<div class="info">
	<h2>Basics</h2>
	</div>
	
	<ul>
	<li id="decfie1" class="">
	<label class="desc" id="title14" for="Field14">
	Welcome to our community! What brings you here today?
	</label>
	<div>
	<select id="Field14" name="what_brings_you_here" class="field select medium" tabindex="15"> 
	<option value="NoAnswer" <?php if($row->what_brings_you_here== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="554" <?php if($row->what_brings_you_here== "554") { ?> selected="selected" <?php } ?>>A friend found someone great on WhenScottMetMichelle.com.</option>
	<option value="555" <?php if($row->what_brings_you_here== "555") { ?> selected="selected" <?php } ?>>I'm new to the area and I'm looking for someone to show me around.</option>
	<option value="556" <?php if($row->what_brings_you_here== "556") { ?> selected="selected" <?php } ?>>My career keeps me busy, so I need a more efficient way to meet people.</option>
	<option value="557" <?php if($row->what_brings_you_here== "557") { ?> selected="selected" <?php } ?>>WhenScottMetMichelle.com has more quality singles than any other dating site.</option>
	<option value="558" <?php if($row->what_brings_you_here== "558") { ?> selected="selected" <?php } ?>>I'm looking to meet people outside my social circle.</option>
	<option value="559" <?php if($row->what_brings_you_here== "559") { ?> selected="selected" <?php } ?>>I'm just checking out WhenScottMetMichelle.com - not sure if I want to do this.</option>
	<option value="560" <?php if($row->what_brings_you_here== "560") { ?> selected="selected" <?php } ?>>Other</option>
	</select>
	</div>
	</li>
	
	
	<li id="decfie2" class="">
	<label class="desc" id="title14" for="Field14">
	What is your relationship status?
	</label>
	<div>
	<select id="Field14" name="relationship_status" class="field select medium" tabindex="15"> 
	<option selected="selected" value="221" <?php if($row->relationship_status== "221") { ?> selected="selected" <?php } ?>>Never Married</option>
	<option value="223" <?php if($row->relationship_status== "223") { ?> selected="selected" <?php } ?>>Currently Separated</option>
	<option value="224" <?php if($row->relationship_status== "224") { ?> selected="selected" <?php } ?>>Divorced</option>
	<option value="222" <?php if($row->relationship_status== "222") { ?> selected="selected" <?php } ?>>Widowed</option>
	</select>
	</div>
	</li>
	
	
	
	<li id="decfie3" class="">
	<label class="desc" id="title14" for="Field14">
	What is your gender?
	</label>
	<div>
	<select id="Field14" name="what_is_your_gender" class="field select medium" tabindex="15"> 
	<option value="0" <?php if($row->what_is_your_gender== "0") { ?> selected="selected" <?php } ?>>Choose</option>
	<option value="2" <?php if($row->what_is_your_gender== "2") { ?> selected="selected" <?php } ?>>Woman</option>
	<option value="1" <?php if($row->what_is_your_gender== "1") { ?> selected="selected" <?php } ?>>Man</option>
	</select>
	</div>
	</li>
	
	
	
	<li id="decfie4" class="">
	<label class="desc" id="title14" for="Field14">
	Who are you looking for?
	</label>
	<div>
	<select id="Field14" name="gender_you_looking_for" class="field select medium" tabindex="15"> 
	<option value="0" <?php if($row->gender_you_looking_for== "0") { ?> selected="selected" <?php } ?>>Choose</option>
	<option value="2" <?php if($row->gender_you_looking_for== "2") { ?> selected="selected" <?php } ?>>Woman</option>
	<option value="1" <?php if($row->gender_you_looking_for== "1") { ?> selected="selected" <?php } ?>>Man</option>
	</select>
	</div>
	
	<div>
	Between the ages
	<select id="Field14" name="age_range_you_looking_for[]" class="field select medium" tabindex="15">
	<?php
	for($i=18; $i<=121; $i++)
	{
		?><option value="<?php echo''.$i.'';?>" <?php if($age_range_you_looking_for[0]== $i) { ?> selected="selected" <?php } ?>><?php echo''.$i.'';?></option><?php
	}
	?>
	</select>
	and
	
	<select id="Field14" name="age_range_you_looking_for[]" class="field select medium" tabindex="15"> 
	<?php
	for($i=18; $i<=121; $i++)
	{
		?><option value="<?php echo''.$i.'';?>" <?php if($age_range_you_looking_for[1]== $i) { ?> selected="selected" <?php } ?>><?php echo''.$i.'';?></option><?php
	}
	?>
	</select>           
	</div>
	
	</li>
	
	
	<li id="decfie6" class="">
	<label class="desc" id="title14" for="Field14">
	Where should we look?
	</label>
	<div>
	<select id="Field14" name="where_should_we_look" class="field select medium" tabindex="15">
	<option value="1" <?php if($row->where_should_we_look== "1") { ?> selected="selected" <?php } ?>>United States</option>
	<option value="2" <?php if($row->where_should_we_look== "2") { ?> selected="selected" <?php } ?>>Canada</option>
	<option value="224" <?php if($row->where_should_we_look== "224") { ?> selected="selected" <?php } ?>>United Kingdom</option>
	</select>
	</div>
	</li>
	
	
	<li id="decfie6" class="">
	<label class="desc" id="title14" for="Field14">
	How tall are you?
	</label>
	<div>
	<select id="Field14" name="how_tall_are_you[]" class="field select medium" tabindex="15"> 
	<?php
	for($i=3; $i<=8; $i++)
	{
		?><option value="<?php echo''.$i.'';?>" <?php if($how_tall_are_you[0]== $i) { ?> selected="selected" <?php } ?>><?php echo''.$i.'';?></option><?php
	}
	?>
	</select>
	feet
	
	<select id="Field14" name="how_tall_are_you[]" class="field select medium" tabindex="15"> 
	<?php
	for($i=0; $i<=11; $i++)
	{
		?><option value="<?php echo''.$i.'';?>" <?php if($how_tall_are_you[1]== $i) { ?> selected="selected" <?php } ?>><?php echo''.$i.'';?></option><?php
	}
	?>
	</select>
	inches                
	</div>
	</li>
	
	
	<li id="decfie5" class="">
	<label class="desc" id="title14" for="Field14">
	Which best describes your body type?
	</label>
	<div>
	<select id="Field14" name="your_body_type" class="field select medium" tabindex="15">
	<option value="NoAnswer" <?php if($row->your_body_type== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="45" <?php if($row->your_body_type== "45") { ?> selected="selected" <?php } ?>>Slender</option>
	<option value="46" <?php if($row->your_body_type== "46") { ?> selected="selected" <?php } ?>>About average</option>
	<option value="47" <?php if($row->your_body_type== "47") { ?> selected="selected" <?php } ?>>Athletic and toned</option>
	<option value="48" <?php if($row->your_body_type== "48") { ?> selected="selected" <?php } ?>>Heavyset</option>
	<option value="49" <?php if($row->your_body_type== "49") { ?> selected="selected" <?php } ?>>A few extra pounds</option>
	<option value="55" <?php if($row->your_body_type== "55") { ?> selected="selected" <?php } ?>>Stocky</option>
	</select>
	</div>
	</li>
	
	
	
	
	<li id="decfie6" class="">
	<label class="desc" id="title14" for="Field14">
	What's your sign?
	</label>
	<div>
	<select id="Field14" name="your_sign" class="field select medium" tabindex="15">
	<option value="18" <?php if($row->your_sign== "18") { ?> selected="selected" <?php } ?>>Don't display my sign</option>
	<option value="5" <?php if($row->your_sign== "5") { ?> selected="selected" <?php } ?>>Capricorn</option>
	<option value="6" <?php if($row->your_sign== "6") { ?> selected="selected" <?php } ?>>Aquarius</option>
	<option value="7" <?php if($row->your_sign== "7") { ?> selected="selected" <?php } ?>>Pisces</option>
	<option value="8" <?php if($row->your_sign== "8") { ?> selected="selected" <?php } ?>>Aries</option>
	<option value="9" <?php if($row->your_sign== "9") { ?> selected="selected" <?php } ?>>Taurus</option>
	<option value="10" <?php if($row->your_sign== "10") { ?> selected="selected" <?php } ?>>Gemini</option>
	<option value="11" <?php if($row->your_sign== "11") { ?> selected="selected" <?php } ?>>Cancer</option>
	<option value="12" <?php if($row->your_sign== "12") { ?> selected="selected" <?php } ?>>Leo</option>
	<option value="13" <?php if($row->your_sign== "13") { ?> selected="selected" <?php } ?>>Virgo</option>
	<option value="14" <?php if($row->your_sign== "14") { ?> selected="selected" <?php } ?>>Libra</option>
	<option value="15" <?php if($row->your_sign== "15") { ?> selected="selected" <?php } ?>>Scorpio</option>
	<option value="16" <?php if($row->your_sign== "16") { ?> selected="selected" <?php } ?>>Sagittarius</option>
	<option value="17" <?php if($row->your_sign== "17") { ?> selected="selected" <?php } ?>>I don't believe in astrology</option>
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
	?>	Sorry you can not view this page unless you are logged in <?php
}
	?>                   

            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

