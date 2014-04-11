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
	$how_often_do_you_exercise=$_REQUEST[how_often_do_you_exercise];
	$what_best_describes_your_diet=$_REQUEST[what_best_describes_your_diet];
	$do_you_smoke=$_REQUEST[do_you_smoke];
	$how_often_do_you_drink=$_REQUEST[how_often_do_you_drink];
	$what_kind_of_job_do_you_have=$_REQUEST[what_kind_of_job_do_you_have];
	$tell_us_more=$_REQUEST[tell_us_more];
	$current_annual_income=$_REQUEST[current_annual_income];
	$do_you_live_alone=$_REQUEST[do_you_live_alone];
	$do_you_have_any_kids=$_REQUEST[do_you_have_any_kids];
	$do_you_want_children=$_REQUEST[do_you_want_children];			
	$how_many_kids_do_you_want=$_REQUEST[how_many_kids_do_you_want];	
	$pets=$_REQUEST[pets];

	
	if(!get_magic_quotes_gpc())
	{
		$todo=mysql_real_escape_string($todo);
		$how_often_do_you_exercise=mysql_real_escape_string($how_often_do_you_exercise);
		$what_best_describes_your_diet=mysql_real_escape_string($what_best_describes_your_diet);
		$do_you_smoke=mysql_real_escape_string($do_you_smoke);
		$how_often_do_you_drink=mysql_real_escape_string($how_often_do_you_drink);
		$what_kind_of_job_do_you_have=mysql_real_escape_string($what_kind_of_job_do_you_have);
		$tell_us_more=mysql_real_escape_string($tell_us_more);
		$current_annual_income=mysql_real_escape_string($current_annual_income);
		$do_you_live_alone=mysql_real_escape_string($do_you_live_alone);
		$do_you_have_any_kids=mysql_real_escape_string($do_you_have_any_kids);
		$do_you_want_children=mysql_real_escape_string($do_you_want_children);		
		$how_many_kids_do_you_want=mysql_real_escape_string($how_many_kids_do_you_want);
		$pets=mysql_real_escape_string($pets);				
	}		
	
	
	if(!is_null($what_best_describes_your_diet))
	{		
		$what_best_describes_your_diet = implode(",", $what_best_describes_your_diet);
	}
	
	if(!is_null($pets))
	{		
		$pets = implode(",", $pets);
	}

		
		//collect all data of the member
		$c1->query("
		SELECT signup.id, signup.userid, lifestyle.how_often_do_you_exercise, lifestyle.what_best_describes_your_diet, lifestyle.do_you_smoke, lifestyle.how_often_do_you_drink, lifestyle.what_kind_of_job_do_you_have, lifestyle.current_annual_income, lifestyle.tell_us_more, lifestyle.do_you_live_alone, lifestyle.do_you_have_any_kids, lifestyle.do_you_want_children, lifestyle.how_many_kids_do_you_want, lifestyle.pets
		FROM signup
		LEFT JOIN lifestyle
		ON signup.id = lifestyle.id WHERE signup.userid='$_SESSION[userid]'");  
	
	
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
		
			$c1->query("SELECT * FROM lifestyle WHERE id=$row->id");  
		
			if(!$c1->getNumRows())
			{		
				if($c1->query("INSERT INTO `lifestyle` ( `id` , `how_often_do_you_exercise` , `what_best_describes_your_diet` , `do_you_smoke` , `how_often_do_you_drink` , `what_kind_of_job_do_you_have` , `current_annual_income` , `tell_us_more` , `do_you_live_alone` , `do_you_have_any_kids` , `do_you_want_children` , `how_many_kids_do_you_want` , `pets` , `last_updated` )
VALUES (
'$row->id', '$how_often_do_you_exercise', '$what_best_describes_your_diet', '$do_you_smoke', '$how_often_do_you_drink', '$what_kind_of_job_do_you_have', '$current_annual_income', '$tell_us_more', '$do_you_live_alone', '$do_you_have_any_kids', '$do_you_want_children', '$how_many_kids_do_you_want', '$pets', '$current_time')"))
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
			
				if($c1->query("UPDATE `lifestyle` 
				SET `how_often_do_you_exercise` = '$how_often_do_you_exercise', 
				`what_best_describes_your_diet` = '$what_best_describes_your_diet' , 
				`do_you_smoke` = '$do_you_smoke',
				`how_often_do_you_drink` = '$how_often_do_you_drink' , 
				`what_kind_of_job_do_you_have` = '$what_kind_of_job_do_you_have' , 
				`current_annual_income` = '$current_annual_income', 
				`tell_us_more` = '$tell_us_more' , 
				`do_you_live_alone` = '$do_you_live_alone',
				`do_you_have_any_kids`  = '$do_you_have_any_kids' , 
				`do_you_want_children` = '$do_you_want_children' ,
				`how_many_kids_do_you_want` = '$how_many_kids_do_you_want' , 
				`pets`  = '$pets'																		 
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
	<h2>Lifestyle</h2>
	</div>

	<?php
	$what_best_describes_your_diet = explode(",", $row->what_best_describes_your_diet);
	$pets = explode(",", $row->pets);
	?>    

	<ul>
	<li id="decfie2" class="">
	<label class="desc" id="title14" for="Field14">
	How often do you exercise?
	</label>
	<div>
	<select id="Field14" name="how_often_do_you_exercise" class="field select medium" tabindex="15">
	<option value="NoAnswer" <?php if($row->how_often_do_you_exercise== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="96" <?php if($row->how_often_do_you_exercise== "96") { ?> selected="selected" <?php } ?>>Never</option>
	<option value="97" <?php if($row->how_often_do_you_exercise== "97") { ?> selected="selected" <?php } ?>>Exercise 1-2 times per week</option>
	<option value="98" <?php if($row->how_often_do_you_exercise== "98") { ?> selected="selected" <?php } ?>>Exercise 3-4 times per week</option>
	<option value="99" <?php if($row->how_often_do_you_exercise== "99") { ?> selected="selected" <?php } ?>>Exercise 5 or more times per week</option>
	</select>
	</div>
	</li>
	
	
	
	
	<li id="fo56li15" class="">
	<label class="desc" id="title0" for="Field0">
	Which best describes your daily diet?
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
	<input id="Field15" name="what_best_describes_your_diet[]" class="field checkbox" value="Meat and potatoes" tabindex="13" type="checkbox" <?php if(in_array("Meat and potatoes", $what_best_describes_your_diet)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Meat and potatoes</label>
	
	<input id="Field15" name="what_best_describes_your_diet[]" class="field checkbox" value="Vegetarian" tabindex="13" type="checkbox" <?php if(in_array("Vegetarian", $what_best_describes_your_diet)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Vegetarian/Vegan</label>
	</div>
	
	<div class="column2">
	<input id="Field15" name="what_best_describes_your_diet[]" class="field checkbox" value="Keep it healthy" tabindex="13" type="checkbox" <?php if(in_array("Keep it healthy", $what_best_describes_your_diet)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Keep it healthy</label>
	
	<input id="Field15" name="what_best_describes_your_diet[]" class="field checkbox" value="Fast Food" tabindex="13" type="checkbox" <?php if(in_array("Fast Food", $what_best_describes_your_diet)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Fast Food</label>
	</div>
	<div class="clr"></div>
	</li>
	
	<li id="decfie2" class="">
	<label class="desc" id="title14" for="Field14">
	Do you smoke?
	</label>
	<div>
	<select id="Field14" name="do_you_smoke" class="field select medium" tabindex="15">
	<option value="NoAnswer" <?php if($row->do_you_smoke== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="297" <?php if($row->do_you_smoke== "297") { ?> selected="selected" <?php } ?>>No Way</option>
	<option value="298" <?php if($row->do_you_smoke== "298") { ?> selected="selected" <?php } ?>>Occasionally</option>
	<option value="299" <?php if($row->do_you_smoke== "299") { ?> selected="selected" <?php } ?>>Daily</option>
	<option value="300" <?php if($row->do_you_smoke== "300") { ?> selected="selected" <?php } ?>>Cigars</option>
	<option value="302" <?php if($row->do_you_smoke== "302") { ?> selected="selected" <?php } ?>>Trying to quit</option>
	</select>
	</div>
	</li>
	
	
	
	<li id="decfie2" class="">
	<label class="desc" id="title14" for="Field14">
	How often do you drink?
	</label>
	<div>
	<select id="Field14" name="how_often_do_you_drink" class="field select medium" tabindex="15">
	<option value="NoAnswer" <?php if($row->how_often_do_you_drink== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="76" <?php if($row->how_often_do_you_drink== "76") { ?> selected="selected" <?php } ?>>I don't drink alcohol</option>
	<option value="77" <?php if($row->how_often_do_you_drink== "77") { ?> selected="selected" <?php } ?>>Social drinker, maybe one or two</option>
	<option value="78" <?php if($row->how_often_do_you_drink== "78") { ?> selected="selected" <?php } ?>>Regularly</option>
	</select>
	</div>
	</li>
	

	
	<li id="decfie2" class="">
	<label class="desc" id="title14" for="Field14">
	Are you a 9-to-5er? Your own boss? What kind of job do you have?
	</label>
	<div>
	<select id="Field14" name="what_kind_of_job_do_you_have" class="field select medium" tabindex="15">
	<option value="NoAnswer" <?php if($row->what_kind_of_job_do_you_have== "No Answer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="167" <?php if($row->what_kind_of_job_do_you_have== "Administrative") { ?> selected="selected" <?php } ?>>Administrative / Secretarial</option>
	<option value="170" <?php if($row->what_kind_of_job_do_you_have== "Artistic") { ?> selected="selected" <?php } ?>>Artistic / Creative / Performance</option>
	<option value="166" <?php if($row->what_kind_of_job_do_you_have== "Executive") { ?> selected="selected" <?php } ?>>Executive / Management</option>
	<option value="168" <?php if($row->what_kind_of_job_do_you_have== "Financial") { ?> selected="selected" <?php } ?>>Financial services</option>
	<option value="177" <?php if($row->what_kind_of_job_do_you_have== "Labour") { ?> selected="selected" <?php } ?>>Labour / Construction</option>
	<option value="175" <?php if($row->what_kind_of_job_do_you_have== "Legal") { ?> selected="selected" <?php } ?>>Legal</option>
	<option value="176" <?php if($row->what_kind_of_job_do_you_have== "Medical") { ?> selected="selected" <?php } ?>>Medical / Dental / Veterinary</option>
	<option value="169" <?php if($row->what_kind_of_job_do_you_have== "Political") { ?> selected="selected" <?php } ?>>Political / Govt / Civil Service / Military</option>
	<option value="174" <?php if($row->what_kind_of_job_do_you_have== "Retail") { ?> selected="selected" <?php } ?>>Retail / Food services</option>
	<option value="181" <?php if($row->what_kind_of_job_do_you_have== "Retired") { ?> selected="selected" <?php } ?>>Retired</option>
	<option value="171" <?php if($row->what_kind_of_job_do_you_have== "Sales") { ?> selected="selected" <?php } ?>>Sales / Marketing</option>
	<option value="179" <?php if($row->what_kind_of_job_do_you_have== "Self") { ?> selected="selected" <?php } ?>>Self Employed</option>
	<option value="180" <?php if($row->what_kind_of_job_do_you_have== "Student") { ?> selected="selected" <?php } ?>>Student</option>
	<option value="173" <?php if($row->what_kind_of_job_do_you_have== "Teacher") { ?> selected="selected" <?php } ?>>Teacher / Professor</option>
	<option value="172" <?php if($row->what_kind_of_job_do_you_have== "Technical") { ?> selected="selected" <?php } ?>>Technical / Computers / Engineering</option>
	<option value="178" <?php if($row->what_kind_of_job_do_you_have== "Travel") { ?> selected="selected" <?php } ?>>Travel / Hospitality / Transportation</option>
	<option value="182" <?php if($row->what_kind_of_job_do_you_have== "Other") { ?> selected="selected" <?php } ?>>Other profession</option>
	</select>
	</div>
	
	Tell us more:
	<span id="req_1" class="req">*</span>
	</label>
	
	<div>
	<textarea id="Field1" name="tell_us_more" class="field textarea medium" rows="10" cols="50" tabindex="2"><?php echo''.$row->tell_us_more.'';?></textarea>	
	</div>            
	</li>
	

	
	
	<li id="fo56li15" class="">
	<label class="desc" id="title0" for="Field0">
	Current annual income?
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
	<input id="Field15" name="current_annual_income" class="field checkbox" value="Less Than 25000" tabindex="13" type="radio" <?php if($row->current_annual_income== "Less Than 25000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Less Than £25,000</label>
	
	
	<input id="Field15" name="current_annual_income" class="field checkbox" value="35000" tabindex="13" type="radio" <?php if($row->current_annual_income== "35000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">£35,001 to £50,000</label>
	
	
	<input id="Field15" name="current_annual_income" class="field checkbox" value="75000" tabindex="13" type="radio" <?php if($row->current_annual_income== "75000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">£75,001 to £100,000</label>
	
	
	<input id="Field15" name="current_annual_income" class="field checkbox" value="150000" tabindex="13" type="radio" <?php if($row->current_annual_income== "150000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">£150,001+</label>
	</div>
	
	<div class="column2">
	<input id="Field15" name="current_annual_income" class="field checkbox" value="25000" tabindex="13" type="radio" <?php if($row->current_annual_income== "25000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">£25,001 to £35,000</label>
	
	<input id="Field15" name="current_annual_income" class="field checkbox" value="50000" tabindex="13" type="radio" <?php if($row->current_annual_income== "50000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">£50,001 to £75,000</label>
	
	<input id="Field15" name="current_annual_income" class="field checkbox" value="100000" tabindex="13" type="radio" <?php if($row->current_annual_income== "100000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">£100,001 to £150,000</label>
	
	<input id="Field15" name="current_annual_income" class="field checkbox" value="No Answer" tabindex="13" type="radio" <?php if($row->current_annual_income== "No Answer") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">No Answer</label>
	</div>
	<div class="clr"></div>
	</li>
	
	
	<li id="fo56li15" class="">
	<label class="desc" id="title0" for="Field0">
	Do you live alone?
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
	<input id="Field15" name="do_you_live_alone" class="field checkbox" value="Live alone" tabindex="13" type="radio" <?php if($row->do_you_live_alone== "Live alone") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Live alone</label>
	
	<input id="Field15" name="do_you_live_alone" class="field checkbox" value="Live with parents" tabindex="13" type="radio" <?php if($row->do_you_live_alone== "Live with parents") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Live with parents/extended family</label>
	</div>
	
	<div class="column2">
	<input id="Field15" name="do_you_live_alone" class="field checkbox" value="Live with kids" tabindex="13" type="radio" <?php if($row->do_you_live_alone== "Live with kids") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Live with kids</label>
	
	<input id="Field15" name="do_you_live_alone" class="field checkbox" value="Live with roommate" tabindex="13" type="radio" <?php if($row->do_you_live_alone== "Live with roommate") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">Live with roommate(s)</label>
	</div>
	<div class="clr"></div>
	</li>
	
	
	
	<li id="decfie2" class="">
	<label class="desc" id="title14" for="Field14">
	Do you have any kids?
	</label>
	<div>
	<select id="Field14" name="do_you_have_any_kids" class="field select medium" tabindex="15">
	<option value="57" <?php if($row->do_you_have_any_kids== "57") { ?> selected="selected" <?php } ?>>None</option>
	<option value="56" <?php if($row->do_you_have_any_kids== "56") { ?> selected="selected" <?php } ?>>Yes, and they live at home</option>
	<option value="58" <?php if($row->do_you_have_any_kids== "58") { ?> selected="selected" <?php } ?>>Yes, and they live away from home</option>
	<option value="59" <?php if($row->do_you_have_any_kids== "59") { ?> selected="selected" <?php } ?>>Yes, and sometimes they live at home</option>
	</select>
	</div>
	</li>
	
	
	
	
	
	<li id="decfie2" class="">
	<label class="desc" id="title14" for="Field14">
	Do you want children?
	</label>
	<div>
	<select id="Field14" name="do_you_want_children" class="field select medium" tabindex="15">
	<option value="273" <?php if($row->do_you_want_children== "273") { ?> selected="selected" <?php } ?>>Definitely</option>
	<option value="275" <?php if($row->do_you_want_children== "275") { ?> selected="selected" <?php } ?>>Someday</option>
	<option value="272" <?php if($row->do_you_want_children== "272") { ?> selected="selected" <?php } ?>>Not sure</option>
	<option value="276" <?php if($row->do_you_want_children== "276") { ?> selected="selected" <?php } ?>>Probably not</option>
	<option value="274" <?php if($row->do_you_want_children== "274") { ?> selected="selected" <?php } ?>>Do not want to have kids</option>
	</select>
	</div>
	
	<label class="desc" id="title14" for="Field14">
	How many would you want?
	</label>
	<div>
	<select id="Field14" name="how_many_kids_do_you_want" class="field select medium" tabindex="15">
	<option value="243" <?php if($row->how_many_kids_do_you_want== "243") { ?> selected="selected" <?php } ?>>1</option>
	<option value="244" <?php if($row->how_many_kids_do_you_want== "244") { ?> selected="selected" <?php } ?>>2</option>
	<option value="245" <?php if($row->how_many_kids_do_you_want== "245") { ?> selected="selected" <?php } ?>>3</option>
	<option value="246" <?php if($row->how_many_kids_do_you_want== "246") { ?> selected="selected" <?php } ?>>More than 3</option>
	</select>
	</div>            
	</li>
	
    
	
	
	
	<li id="fo56li15" class="">
	<label class="desc" id="title0" for="Field0">
	You like animals?
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
	<input id="Field15" name="pets[]" class="field checkbox" value="Birds" tabindex="13" type="checkbox" <?php if(in_array("Birds", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Birds</label>
	
	<input id="Field15" name="pets[]" class="field checkbox" value="Cats" tabindex="13" type="checkbox" <?php if(in_array("Cats", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Cats</label>
    
	<input id="Field15" name="pets[]" class="field checkbox" value="Gerbils" tabindex="13" type="checkbox" <?php if(in_array("Gerbils", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Gerbils / Guinea Pigs</label>    
    
	<input id="Field15" name="pets[]" class="field checkbox" value="Reptiles" tabindex="13" type="checkbox" <?php if(in_array("Reptiles", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Reptiles</label>       

	<input id="Field15" name="pets[]" class="field checkbox" value="Other" tabindex="13" type="checkbox" <?php if(in_array("Other", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Other</label>                   
	</div>
	
	<div class="column2">
	<input id="Field15" name="pets[]" class="field checkbox" value="Dogs" tabindex="13" type="checkbox" <?php if(in_array("Dogs", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Dogs</label>
	
	<input id="Field15" name="pets[]" class="field checkbox" value="Exotic pets" tabindex="13" type="checkbox" <?php if(in_array("Exotic pets", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Exotic pets</label>
    
    
	<input id="Field15" name="pets[]" class="field checkbox" value="Fish" tabindex="13" type="checkbox" <?php if(in_array("Fish", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Fish</label>    
    
    
	<input id="Field15" name="pets[]" class="field checkbox" value="Horses" tabindex="13" type="checkbox" <?php if(in_array("Horses", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">Horses</label>        
	</div>
	<div class="clr"></div>
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

