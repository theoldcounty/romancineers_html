<?php
//define specific meta tags
$title_tag ="When Scott Met Michelle";
$keyword_tag ="whenscottmetmichelle.com, online dating, singles, dating, personals, matchmaker, matchmaking, love, match, dating site, free personals, christian singles, black singles, asian singles, jewish singles, local singles";
$description_tag="An upcoming dating website with millions of profiles. It's free to search and contact your dates.";
include"includes/header.php";
?>
		<div id="sub-twocols" class="clearfix"><!--two col --> 
			<div id="maincol"><!--main col -->
       
<?php
if(isset($_SESSION['id']))
{
	$p=$_REQUEST[p];

	$e=$_REQUEST[e];
	switch ($e) {
		case "aboutdate":

		?><div class="info">
		<h4>About your date</h4><?php		
		//echo'is lifestyle';			

	/*about_date*/
	//variables
	$todo=$_REQUEST[todo];
	$date_hair=$_REQUEST[date_hair];
	$date_eyes=$_REQUEST[date_eyes];
	$date_height1=$_REQUEST[date_height1];
	$date_height2=$_REQUEST[date_height2];
	$date_bodytype=$_REQUEST[date_bodytype];
	$date_languages=$_REQUEST[date_languages];
	$date_ethnicity=$_REQUEST[date_ethnicity];
	$date_faith=$_REQUEST[date_faith];
	$date_education=$_REQUEST[date_education];	
	$date_job=$_REQUEST[date_job];
	$date_tell_us_more =$_REQUEST[date_tell_us_more];
	$date_income=$_REQUEST[date_income];	
	$date_smoke=$_REQUEST[date_smoke];
	$date_drink=$_REQUEST[date_drink];	
	$date_relationships=$_REQUEST[date_relationships];	
	$date_have_kids=$_REQUEST[date_have_kids];	
	$date_want_kids=$_REQUEST[date_want_kids];	
	$date_turn_ons=$_REQUEST[date_turn_ons];	
	$date_turn_offs=$_REQUEST[date_turn_offs];
	
	
	
	if(!get_magic_quotes_gpc())
	{
		$todo=mysql_real_escape_string($todo);
		$date_hair=mysql_real_escape_string($date_hair);
		$date_eyes=mysql_real_escape_string($date_eyes);	
		$date_height1=mysql_real_escape_string($date_height1);
		$date_height2=mysql_real_escape_string($date_height2);	
		$date_bodytype=mysql_real_escape_string($date_bodytype);	
		$date_languages=mysql_real_escape_string($date_languages);	
		$date_ethnicity=mysql_real_escape_string($date_ethnicity);	
		$date_faith=mysql_real_escape_string($date_faith);	
		$date_education=mysql_real_escape_string($date_education);	
		$date_job=mysql_real_escape_string($date_job);
		$date_tell_us_more = mysql_real_escape_string($date_tell_us_more);
		$date_income=mysql_real_escape_string($date_income);
		$date_smoke=mysql_real_escape_string($date_smoke);
		$date_drink=mysql_real_escape_string($date_drink);
		$date_relationships=mysql_real_escape_string($date_relationships);
		$date_have_kids=mysql_real_escape_string($date_have_kids);
		$date_want_kids=mysql_real_escape_string($date_want_kids);
		$date_turn_ons=mysql_real_escape_string($date_turn_ons);
		$date_turn_offs=mysql_real_escape_string($date_turn_offs);
	}		
	
	if(!is_null($date_height1))
	{
		$date_height1= implode(",", $date_height1);
	}

	if(!is_null($date_height2))
	{
		$date_height2= implode(",", $date_height2);
	}

	if(!is_null($date_ethnicity))
	{		
		$date_ethnicity = implode(",", $date_ethnicity);
	}



		//collect all data of the member
		$c1->query("
		SELECT signup.id, signup.userid, about_date.date_hair, about_date.date_eyes, about_date.date_height1,  about_date.date_height2, about_date.date_bodytype, about_date.date_languages, about_date.date_ethnicity, about_date.date_faith, about_date.date_education, about_date.date_job, about_date.date_tell_us_more, about_date.date_income, about_date.date_smoke, about_date.date_drink, about_date.date_relationships, about_date.date_have_kids, about_date.date_want_kids, about_date.date_turn_ons, about_date.date_turn_offs 
		FROM signup
		LEFT JOIN about_date
		ON signup.id = about_date.id WHERE signup.userid='$_SESSION[userid]'");  
	
	
		//row results
		$row = $c1->fetchObject();	  
	
					
	// check the login details of the user and stop execution if not logged in
	
	//form submitted validate results
	if(isset($todo) and $todo=="aboutdate")
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
		
			$c1->query("SELECT * FROM about_date WHERE id=$row->id");  
		
			if(!$c1->getNumRows())
			{		
				if($c1->query("INSERT INTO `about_date` ( `id` , `date_hair`, `date_eyes`, `date_height1`, `date_height2`, `date_bodytype`, `date_languages`, `date_ethnicity`, `date_faith`, `date_education`, `date_job`, `date_tell_us_more`, `date_income`, `date_smoke`, `date_drink`, `date_relationships`, `date_have_kids`, `date_want_kids`, `date_turn_ons`, `date_turn_offs`, `last_updated` )
VALUES (
'$row->id', '$date_hair', '$date_eyes', '$date_height1', '$date_height2', '$date_bodytype', '$date_languages', '$date_ethnicity', '$date_faith', '$date_education', '$date_job', '$date_tell_us_more', '$date_income', '$date_smoke', '$date_drink', '$date_relationships', '$date_have_kids', '$date_want_kids', '$date_turn_ons', '$date_turn_offs', '$current_time')"))
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=aboutdate"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=aboutdate"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}			
			}
			else
			{	
				if($c1->query("UPDATE `about_date` 
				SET `date_hair` = '$date_hair',
				`date_eyes` = '$date_eyes',
				`date_height1` = '$date_height1',
				`date_height2` = '$date_height2',
				`date_bodytype` = '$date_bodytype',
				`date_languages` = '$date_languages',
				`date_ethnicity` = '$date_ethnicity',
				`date_faith` = '$date_faith',
				`date_education` = '$date_education',
				`date_job` = '$date_job',
				`date_tell_us_more` ='$date_tell_us_more',
				`date_income` = '$date_income',
				`date_smoke` = '$date_smoke',
				`date_drink` = '$date_drink',
				`date_relationships` = '$date_relationships',
				`date_have_kids` = '$date_have_kids',
				`date_want_kids` = '$date_want_kids',
				`date_turn_ons` = '$date_turn_ons',
				`date_turn_offs` = '$date_turn_offs'
				WHERE id='$row->id'"))				
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=aboutdate"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=aboutdate"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
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
    
	<?php
	$date_height1 = explode(",", $row->date_height1);
	$date_height2 = explode(",", $row->date_height2);
	$date_ethnicity = explode(",", $row->date_ethnicity);
	?>    
    
       
	<form id="aboutdate" class="gloss" enctype="multipart/form-data" method="post" action="#">

	<ul>
   <li>
    	<label class="out" for="date_turn_ons">
		Describe your date_turn_ons 
		<span id="req_0" class="req">*</span>
		</label>
		<div>
		<textarea id="date_turn_ons" name="date_turn_ons" class="field_text_area" rows="4" cols="50" tabindex="2"><?php echo''.$row->date_turn_ons.'';?></textarea>
		</div>
		<p class="instruct"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>    
        	                

 
     
   <li>
    	<label class="out" for="date_turn_offs">
		Describe your date_turn_offs  
		<span id="req_1" class="req">*</span>
		</label>
		<div>
		<textarea id="date_turn_offs" name="date_turn_offs" class="field_text_area" rows="4" cols="50" tabindex="2"><?php echo''.$row->date_turn_offs.'';?></textarea>
		</div>
		<p class="instruct"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>        
    
  <li>
		<label class="out" for="date_eyes">
		What best describes your date's eye colour?
		</label>
		<select id="date_eyes" name="date_eyes" class="field_select_medium" tabindex="15"> 
			<option value="NoAnswer" <?php if($row->date_eyes== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
			<option value="123" <?php if($row->date_eyes== "123") { ?> selected="selected" <?php } ?>>Black</option>
			<option value="118" <?php if($row->date_eyes== "118") { ?> selected="selected" <?php } ?>>Blue</option>
			<option value="119" <?php if($row->date_eyes== "119") { ?> selected="selected" <?php } ?>>Brown</option>
			<option value="120" <?php if($row->date_eyes== "120") { ?> selected="selected" <?php } ?>>Grey</option>
			<option value="121" <?php if($row->date_eyes== "121") { ?> selected="selected" <?php } ?>>Green</option>
			<option value="122" <?php if($row->date_eyes== "122") { ?> selected="selected" <?php } ?>>Hazel</option>
		</select>
	</li>
	
	<li>
		<label class="out" for="date_hair">
		What colour is your date's hair?
		</label>
		<select id="date_hair" name="date_hair" class="field_select_medium" tabindex="15"> 
		<option value="NoAnswer" <?php if($row->date_hair== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
		<option value="126" <?php if($row->date_hair== "126") { ?> selected="selected" <?php } ?>>Black</option>
		<option value="129" <?php if($row->date_hair== "129") { ?> selected="selected" <?php } ?>>Blonde</option>
		<option value="133" <?php if($row->date_hair== "133") { ?> selected="selected" <?php } ?>>Dark blonde</option>
		<option value="127" <?php if($row->date_hair== "127") { ?> selected="selected" <?php } ?>>Light brown</option>
		<option value="128" <?php if($row->date_hair== "128") { ?> selected="selected" <?php } ?>>Dark brown</option>
		<option value="125" <?php if($row->date_hair== "125") { ?> selected="selected" <?php } ?>>Auburn / Red</option>
		<option value="134" <?php if($row->date_hair== "134") { ?> selected="selected" <?php } ?>>Grey</option>
		<option value="130" <?php if($row->date_hair== "130") { ?> selected="selected" <?php } ?>>Salt and pepper</option>
		<option value="135" <?php if($row->date_hair== "135") { ?> selected="selected" <?php } ?>>Platinum</option>
		<option value="131" <?php if($row->date_hair== "131") { ?> selected="selected" <?php } ?>>Silver</option>
		<option value="136" <?php if($row->date_hair== "136") { ?> selected="selected" <?php } ?>>Bald</option>
		</select>
	</li>
 
 
 
	<li>
	<label class="out">
	How tall is your date?
	</label>
	<div>
	<select name="date_height1[]" class="field_select_small" tabindex="15"> 
	<?php
	for($i=3; $i<=8; $i++)
	{
		if(empty($date_height1[0])) 
		{
			?><option value="5" selected="selected">5</option><?php
		}
	
		?><option value="<?php echo''.$i.'';?>" <?php if($date_height1[0]== $i) { ?> selected="selected" <?php } ?>><?php echo''.$i.'';?></option><?php
	}
	?>
	</select>
	feet
	
	<select name="date_height1[]" class="field_select_small" tabindex="15"> 
	<?php
	for($j=11; $j>=0; $j--)
	{
		if(empty($date_height1[1])) 
		{
			?><option value="3" selected="selected">3</option><?php
		}
	
		?><option value="<?php echo''.$j.'';?>" <?php if($date_height1[1]== $j) { ?> selected="selected" <?php } ?>><?php echo''.$j.'';?></option><?php
	}
	?>
	</select>
	inches                
	</div>
    
	<div>
	<select name="date_height2[]" class="field_select_small" tabindex="15"> 
	<?php
	for($i=3; $i<=8; $i++)
	{
		if(empty($date_height1[0])) 
		{
			?><option value="6" selected="selected">6</option><?php
		}	
		?><option value="<?php echo''.$i.'';?>" <?php if($date_height2[0]== $i) { ?> selected="selected" <?php } ?>><?php echo''.$i.'';?></option><?php
	}
	?>
	</select>
	feet
	
	<select name="date_height2[]" class="field_select_small" tabindex="15"> 
	<?php
	for($j=11; $j>=0; $j--)
	{
		if(empty($date_height1[1])) 
		{
			?><option value="3" selected="selected">3</option><?php
		}	
		?><option value="<?php echo''.$j.'';?>" <?php if($date_height2[1]== $j) { ?> selected="selected" <?php } ?>><?php echo''.$j.'';?></option><?php
	}
	?>
	</select>
	inches                
	</div>    
	</li>


	
	<li>
	<label class="out" for="date_smoke">
	Do you want your date to smoke?
	</label>
	<select id="date_smoke" name="date_smoke" class="field_select_medium" tabindex="15">
	<option value="NoAnswer" <?php if($row->date_smoke== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="297" <?php if($row->date_smoke== "297") { ?> selected="selected" <?php } ?>>No Way</option>
	<option value="298" <?php if($row->date_smoke== "298") { ?> selected="selected" <?php } ?>>Occasionally</option>
	<option value="299" <?php if($row->date_smoke== "299") { ?> selected="selected" <?php } ?>>Daily</option>
	<option value="300" <?php if($row->date_smoke== "300") { ?> selected="selected" <?php } ?>>Cigars</option>
	<option value="302" <?php if($row->date_smoke== "302") { ?> selected="selected" <?php } ?>>Trying to quit</option>
	</select>
	</li>
		
	<li>
	<label class="out" for="date_drink">
	Would you want your date to drink?
	</label>
	<select id="date_drink" name="date_drink" class="field_select_medium" tabindex="15">
	<option value="NoAnswer" <?php if($row->date_drink== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="76" <?php if($row->date_drink== "76") { ?> selected="selected" <?php } ?>>I don't drink alcohol</option>
	<option value="77" <?php if($row->date_drink== "77") { ?> selected="selected" <?php } ?>>Social drinker, maybe one or two</option>
	<option value="78" <?php if($row->date_drink== "78") { ?> selected="selected" <?php } ?>>Regularly</option>
	</select>
	</li>
	

	<li>
	<label class="out" for="date_relationships">
	What is relationship status would you want your date to be at?
	</label>
	<select id="date_relationships" name="date_relationships" class="field_select_medium" tabindex="15"> 
	<option value="221" <?php if($row->date_relationships== "221") { ?> selected="selected" <?php } ?>>Never Married</option>    
	<option value="223" <?php if($row->date_relationships== "223") { ?> selected="selected" <?php } ?>>Currently Separated</option>
	<option value="224" <?php if($row->date_relationships== "224") { ?> selected="selected" <?php } ?>>Divorced</option>
	<option value="222" <?php if($row->date_relationships== "222") { ?> selected="selected" <?php } ?>>Widowed</option>
	</select>
	</li>

	
	<li>
	<label class="out" for="date_have_kids">
	Would you want your date to have any kids?
	</label>
	<select id="date_have_kids" name="date_have_kids" class="field_select_medium" tabindex="15">
	<option value="57" <?php if($row->date_have_kids== "57") { ?> selected="selected" <?php } ?>>No</option>
	<option value="56" <?php if($row->date_have_kids== "56") { ?> selected="selected" <?php } ?>>Yes, and they live at home</option>
	<option value="58" <?php if($row->date_have_kids== "58") { ?> selected="selected" <?php } ?>>Yes, and they live away from home</option>
	<option value="59" <?php if($row->date_have_kids== "59") { ?> selected="selected" <?php } ?>>Yes, and sometimes they live at home</option>
	</select>
	</li>
	
	<li>
	<label class="out" for="date_want_kids">
	Would you want your date, to want to have children?
	</label>
	<select id="date_want_kids" name="date_want_kids" class="field_select_medium" tabindex="15">
	<option value="273" <?php if($row->date_want_kids== "273") { ?> selected="selected" <?php } ?>>Definitely</option>
	<option value="275" <?php if($row->date_want_kids== "275") { ?> selected="selected" <?php } ?>>Someday</option>
	<option value="272" <?php if($row->date_want_kids== "272") { ?> selected="selected" <?php } ?>>Not sure</option>
	<option value="276" <?php if($row->date_want_kids== "276") { ?> selected="selected" <?php } ?>>Probably not</option>
	<option value="274" <?php if($row->date_want_kids== "274") { ?> selected="selected" <?php } ?>>Do not want them to have kids</option>
	</select>
	</li>

     
	<li>
	<label class="out" for="date_bodytype">
	Which best describes your date's body type?
	</label>
	<select id="date_bodytype" name="date_bodytype" class="field_select_medium" tabindex="15">
	<option value="NoAnswer" <?php if($row->date_bodytype== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="45" <?php if($row->date_bodytype== "45") { ?> selected="selected" <?php } ?>>Slender</option>
	<option value="46" <?php if($row->date_bodytype== "46") { ?> selected="selected" <?php } ?>>About average</option>
	<option value="47" <?php if($row->date_bodytype== "47") { ?> selected="selected" <?php } ?>>Athletic and toned</option>
	<option value="48" <?php if($row->date_bodytype== "48") { ?> selected="selected" <?php } ?>>Heavyset</option>
	<option value="49" <?php if($row->date_bodytype== "49") { ?> selected="selected" <?php } ?>>A few extra pounds</option>
	<option value="55" <?php if($row->date_bodytype== "55") { ?> selected="selected" <?php } ?>>Stocky</option>
	</select>
	</li>



	<li>
	<label class="out">
	Which ethnicities describe you the best?
	<span id="req_3" class="req">*</span>
	</label>
	<input id="Asian" name="date_ethnicity[]" class="field checkbox" value="Asian" tabindex="13" type="checkbox" <?php if(in_array("Asian", $date_ethnicity)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Asian">Asian</label>
	
	<input id="East_Indian" name="date_ethnicity[]" class="field checkbox" value="East Indian" tabindex="13" type="checkbox" <?php if(in_array("East Indian", $date_ethnicity)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="East_Indian">East Indian</label>
	
	<input id="Middle_Eastern" name="date_ethnicity[]" class="field checkbox" value="Middle Eastern" tabindex="13" type="checkbox" <?php if(in_array("Middle Eastern", $date_ethnicity)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Middle_Eastern">Middle Eastern</label>
	
	<input id="Pacific_Islander" name="date_ethnicity[]" class="field checkbox" value="Pacific Islander" tabindex="13" type="checkbox" <?php if(in_array("Pacific Islander", $date_ethnicity)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Pacific_Islander">Pacific Islander</label>
	
	<input id="Other1" name="date_ethnicity[]" class="field checkbox" value="Other" tabindex="13" type="checkbox" <?php if(in_array("Other", $date_ethnicity)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Other1">Other</label>
    
	<input id="Black_African_descent" name="date_ethnicity[]" class="field checkbox" value="Black" tabindex="13" type="checkbox" <?php if(in_array("Black", $date_ethnicity)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Black_African_descent">Black / African descent</label>
	
	<input id="Latino_Hispanic" name="date_ethnicity[]" class="field checkbox" value="Latino" tabindex="13" type="checkbox" <?php if(in_array("Latino", $date_ethnicity)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Latino_Hispanic">Latino / Hispanic</label>
	
	<input id="Native_American" name="date_ethnicity[]" class="field checkbox" value="Native American" tabindex="13" type="checkbox" <?php if(in_array("Native American", $date_ethnicity)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Native_American">Native American</label>
	
	<input id="White_Caucasian" name="date_ethnicity[]" class="field checkbox" value="White" tabindex="13" type="checkbox" <?php if(in_array("White", $date_ethnicity)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="White_Caucasian">White / Caucasian</label>    
	</li>
	
		
	<li>
	<label class="out">
	What is your faith?
	<span id="req_4" class="req">*</span>
	</label>

 	<input id="Agnostic" name="date_faith" class="field checkbox" value="Agnostic" tabindex="13" type="radio" <?php if($row->date_faith== "Agnostic") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Agnostic">Agnostic</label>
	
	<input id="Buddhist_Taoist" name="date_faith" class="field checkbox" value="Buddhist" tabindex="13" type="radio" <?php if($row->date_faith== "Buddhist") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Buddhist_Taoist">Buddhist / Taoist</label>
	
	<input id="Christian_LDS" name="date_faith" class="field checkbox" value="Christian LDS" tabindex="13" type="radio" <?php if($row->date_faith== "Christian LDS") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Christian_LDS">Christian / LDS</label>
	
	<input id="Hindu" name="date_faith" class="field checkbox" value="Hindu" tabindex="13" type="radio" <?php if($row->date_faith== "Hindu") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Hindu">Hindu</label>
	
	<input id="Muslim_Islam" name="date_faith" class="field checkbox" value="Muslim" tabindex="13" type="radio" <?php if($row->date_faith== "Muslim") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Muslim_Islam">Muslim / Islam</label>
	
	<input id="Other2" name="date_faith" class="field checkbox" value="Other" tabindex="13" type="radio" <?php if($row->date_faith== "Other") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Other2">Other</label>
	
	<input id="No_Answer" name="date_faith" class="field checkbox" value="No Answer" tabindex="13" type="radio" <?php if($row->date_faith== "No Answer") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="No_Answer">No Answer</label>   

	<input id="Atheist" name="date_faith" class="field checkbox" value="Atheist" tabindex="13" type="radio" <?php if($row->date_faith== "Atheist") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Atheist">Atheist</label>
	
	<input id="Christian_Catholic" name="date_faith" class="field checkbox" value="Christian Catholic" tabindex="13" type="radio" <?php if($row->date_faith== "Christian Catholic") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Christian_Catholic">Christian / Catholic</label>
	
	<input id="Christian_Protestant" name="date_faith" class="field checkbox" value="Christian Protestant" tabindex="13" type="radio" <?php if($row->date_faith== "Christian Protestant") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Christian_Protestant">Christian / Protestant</label>
	
	<input id="Jewish" name="date_faith" class="field checkbox" value="Jewish" tabindex="13" type="radio" <?php if($row->date_faith== "Jewish") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Jewish">Jewish</label>
	
	<input id="Spiritual_but_not_religious" name="date_faith" class="field checkbox" value="Spiritual but not religious" tabindex="13" type="radio" <?php if($row->date_faith== "Spiritual but not religious") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Spiritual_but_not_religious">Spiritual but not religious</label>
	
	<input id="Christian_Other" name="date_faith" class="field checkbox" value="Christian" tabindex="13" type="radio" <?php if($row->date_faith== "Christian") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Christian_Other">Christian / Other</label>    
	</li>
	
    
    
    
    
	<li>
	<label class="out">
	How would you describe your education?
	<span id="req_5" class="req">*</span>
	</label>
	<input id="High_school" name="date_education" class="field checkbox" value="High school" tabindex="13" type="radio" <?php if($row->date_education== "High school") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="High_school">High school</label>
	
	
	<input id="Associates_degree" name="date_education" class="field checkbox" value="Associates degree" tabindex="13" type="radio" <?php if($row->date_education== "Associates degree") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Associates_degree">Associates degree</label>
	
	
	<input id="Graduate_degree" name="date_education" class="field checkbox" value="Graduate degree" tabindex="13" type="radio" <?php if($row->date_education== "Graduate degree") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Graduate_degree">Graduate degree</label>
	
	
	<input id="No_Answer1" name="date_education" class="field checkbox" value="No Answer" tabindex="13" type="radio" <?php if($row->date_education== "No Answer") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="No_Answer1">No Answer</label>


	<input id="Some_college" name="date_education" class="field checkbox" value="Some college" tabindex="13" type="radio" <?php if($row->date_education== "Some college") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Some_college">Some college</label>
	
	<input id="Bachelors_degree" name="date_education" class="field checkbox" value="Bachelors degree" tabindex="13" type="radio" <?php if($row->date_education== "Bachelors degree") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Bachelors_degree">Bachelors degree</label>
	
	<input id="PhD_Post_Doctoral" name="date_education" class="field checkbox" value="PhD" tabindex="13" type="radio" <?php if($row->date_education== "PhD") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="PhD_Post_Doctoral">PhD / Post Doctoral</label>
	</li>


    
	<li>
	<label class="out" for="date_job">
	Would you want your date to be a 9-to-5er? Their own boss? What kind of job would you want them to have?
	</label>
	<select id="date_job" name="date_job" class="field_select_medium" tabindex="15">
	<option value="NoAnswer" <?php if($row->date_job== "No Answer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="167" <?php if($row->date_job== "167") { ?> selected="selected" <?php } ?>>Administrative / Secretarial</option>
	<option value="170" <?php if($row->date_job== "170") { ?> selected="selected" <?php } ?>>Artistic / Creative / Performance</option>
	<option value="166" <?php if($row->date_job== "166") { ?> selected="selected" <?php } ?>>Executive / Management</option>
	<option value="168" <?php if($row->date_job== "168") { ?> selected="selected" <?php } ?>>Financial services</option>
	<option value="177" <?php if($row->date_job== "177") { ?> selected="selected" <?php } ?>>Labour / Construction</option>
	<option value="175" <?php if($row->date_job== "175") { ?> selected="selected" <?php } ?>>Legal</option>
	<option value="176" <?php if($row->date_job== "176") { ?> selected="selected" <?php } ?>>Medical / Dental / Veterinary</option>
	<option value="169" <?php if($row->date_job== "169") { ?> selected="selected" <?php } ?>>Political / Govt / Civil Service / Military</option>
	<option value="174" <?php if($row->date_job== "174") { ?> selected="selected" <?php } ?>>Retail / Food services</option>
	<option value="181" <?php if($row->date_job== "181") { ?> selected="selected" <?php } ?>>Retired</option>
	<option value="171" <?php if($row->date_job== "171") { ?> selected="selected" <?php } ?>>Sales / Marketing</option>
	<option value="179" <?php if($row->date_job== "179") { ?> selected="selected" <?php } ?>>Self Employed</option>
	<option value="180" <?php if($row->date_job== "180") { ?> selected="selected" <?php } ?>>Student</option>
	<option value="173" <?php if($row->date_job== "173") { ?> selected="selected" <?php } ?>>Teacher / Professor</option>
	<option value="172" <?php if($row->date_job== "172") { ?> selected="selected" <?php } ?>>Technical / Computers / Engineering</option>
	<option value="178" <?php if($row->date_job== "178") { ?> selected="selected" <?php } ?>>Travel / Hospitality / Transportation</option>
	<option value="182" <?php if($row->date_job== "182") { ?> selected="selected" <?php } ?>>Other profession</option>
	</select>
	</li>
	

	<li>
	Tell us more:
	<span id="req_6" class="req">*</span>    
	<div>
	<textarea id="date_tell_us_more" name="date_tell_us_more" class="field_text_medium" rows="5" cols="50" tabindex="2"><?php echo''.$row->date_tell_us_more.'';?></textarea>	
	</div>            
	</li>
	
	<li>
	<label class="out">
	What salary range would you want your date to be on?
	<span id="req_7" class="req">*</span>
	</label>
	<div class="column1">
	<input id="iLess_Than_25000" name="date_income" class="field_checkbox" value="Less Than 25000" tabindex="13" type="radio" <?php if($row->date_income== "Less Than 25000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="iLess_Than_25000">Less Than &pound;25,000</label>
	
	
	<input id="i35001_to_50000" name="date_income" class="field_checkbox" value="35000" tabindex="13" type="radio" <?php if($row->date_income== "35000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="i35001_to_50000">&pound;35,001 to &pound;50,000</label>
	
	
	<input id="i75001_to_100000" name="date_income" class="field_checkbox" value="75000" tabindex="13" type="radio" <?php if($row->date_income== "75000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="i75001_to_100000">&pound;75,001 to &pound;100,000</label>
	
	
	<input id="i150001" name="date_income" class="field_checkbox" value="150000" tabindex="13" type="radio" <?php if($row->date_income== "150000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="i150001">&pound;150,001+</label>
	</div>
	
	<div class="column2">
	<input id="i25001_to_35000" name="date_income" class="field_checkbox" value="25000" tabindex="13" type="radio" <?php if($row->date_income== "25000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="i25001_to_35000">&pound;25,001 to &pound;35,000</label>
	
	<input id="i50001_to_75000" name="date_income" class="field_checkbox" value="50000" tabindex="13" type="radio" <?php if($row->date_income== "50000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="i50001_to_75000">&pound;50,001 to &pound;75,000</label>
	
	<input id="i100001_to_150000" name="date_income" class="field_checkbox" value="100000" tabindex="13" type="radio" <?php if($row->date_income== "100000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="i100001_to_150000">&pound;100,001 to &pound;150,000</label>
	
	<input id="iNo_Answer" name="date_income" class="field_checkbox" value="No Answer" tabindex="13" type="radio" <?php if($row->date_income== "No Answer") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="iNo_Answer">No Answer</label>
	</div>
	<div class="clr"></div>
	</li>
	
	<li>
    <input type="hidden" name="todo" value="aboutdate"/>
	<input type="hidden" name="e" value="aboutdate" />
	<input type="image" name="submit" value="Submit" class="field_submit" src="../graphics/login.jpg"/>
    </li>
    </ul>
	</form>
	
	<?php
	}//end of else
	?></div><?php
	/*About date*/	
				
			break;
		case "lifestyle":
		?><div class="info">
		<h4>Lifestyle</h4><?php		
		//echo'is lifestyle';			

	/*Lifestyle*/
	//variables
	$todo=$_REQUEST[todo];
	$how_often_do_you_exercise=$_REQUEST[how_often_do_you_exercise];
	$what_best_describes_your_diet=$_REQUEST[what_best_describes_your_diet];
	$do_you_smoke=$_REQUEST[do_you_smoke];
	$what_about_your_job=$_REQUEST[what_about_your_job];
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
		$what_about_your_job=mysql_real_escape_string($what_about_your_job);
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
		SELECT signup.id, signup.userid, lifestyle.how_often_do_you_exercise, lifestyle.what_best_describes_your_diet, lifestyle.do_you_smoke, lifestyle.how_often_do_you_drink, lifestyle.what_about_your_job, lifestyle.what_kind_of_job_do_you_have, lifestyle.current_annual_income, lifestyle.tell_us_more, lifestyle.do_you_live_alone, lifestyle.do_you_have_any_kids, lifestyle.do_you_want_children, lifestyle.how_many_kids_do_you_want, lifestyle.pets
		FROM signup
		LEFT JOIN lifestyle
		ON signup.id = lifestyle.id WHERE signup.userid='$_SESSION[userid]'");  
	
	
		//row results
		$row = $c1->fetchObject();	  
	
					
	// check the login details of the user and stop execution if not logged in
	
	//form submitted validate results
	if(isset($todo) and $todo=="lifestyle")
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
				if($c1->query("INSERT INTO `lifestyle` ( `id` , `how_often_do_you_exercise` , `what_best_describes_your_diet` , `do_you_smoke` , `how_often_do_you_drink` , `what_about_your_job`, `what_kind_of_job_do_you_have` , `current_annual_income` , `tell_us_more` , `do_you_live_alone` , `do_you_have_any_kids` , `do_you_want_children` , `how_many_kids_do_you_want` , `pets` , `last_updated` )
VALUES (
'$row->id', '$how_often_do_you_exercise', '$what_best_describes_your_diet', '$do_you_smoke', '$how_often_do_you_drink', '$what_about_your_job', '$what_kind_of_job_do_you_have', '$current_annual_income', '$tell_us_more', '$do_you_live_alone', '$do_you_have_any_kids', '$do_you_want_children', '$how_many_kids_do_you_want', '$pets', '$current_time')"))
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=lifestyle"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=lifestyle"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}			
			}
			else
			{	
			
				if($c1->query("UPDATE `lifestyle` 
				SET `how_often_do_you_exercise` = '$how_often_do_you_exercise', 
				`what_best_describes_your_diet` = '$what_best_describes_your_diet' , 
				`do_you_smoke` = '$do_you_smoke',
				`how_often_do_you_drink` = '$how_often_do_you_drink' , 
				`what_about_your_job` ='$what_about_your_job' ,
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
?>
            	<?php $return_url = "edit.php?e=lifestyle"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=lifestyle"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
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
	<form id="lifestyle" class="gloss" enctype="multipart/form-data" method="post" action="#">
	

	<?php
	$what_best_describes_your_diet = explode(",", $row->what_best_describes_your_diet);
	$pets = explode(",", $row->pets);
	?>    

	<ul>
	<li>
	<label class="out" for="how_often_do_you_exercise">
	How often do you exercise?
	</label>
	<div>
	<select id="how_often_do_you_exercise" name="how_often_do_you_exercise" class="field_select_medium" tabindex="15">
	<option value="NoAnswer" <?php if($row->how_often_do_you_exercise== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="96" <?php if($row->how_often_do_you_exercise== "96") { ?> selected="selected" <?php } ?>>Never</option>
	<option value="97" <?php if($row->how_often_do_you_exercise== "97") { ?> selected="selected" <?php } ?>>Exercise 1-2 times per week</option>
	<option value="98" <?php if($row->how_often_do_you_exercise== "98") { ?> selected="selected" <?php } ?>>Exercise 3-4 times per week</option>
	<option value="99" <?php if($row->how_often_do_you_exercise== "99") { ?> selected="selected" <?php } ?>>Exercise 5 or more times per week</option>
	</select>
	</div>
	</li>
		
	<li>
	<label class="out">
	Which best describes your daily diet?
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
	<input id="Meat_and_potatoes" name="what_best_describes_your_diet[]" class="field_checkbox" value="Meat and potatoes" tabindex="13" type="checkbox" <?php if(in_array("Meat and potatoes", $what_best_describes_your_diet)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Meat_and_potatoes">Meat and potatoes</label>
	
	<input id="Vegetarian_Vegan" name="what_best_describes_your_diet[]" class="field_checkbox" value="Vegetarian" tabindex="13" type="checkbox" <?php if(in_array("Vegetarian", $what_best_describes_your_diet)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Vegetarian_Vegan">Vegetarian/Vegan</label>
	</div>
	
	<div class="column2">
	<input id="Keep_it_healthy" name="what_best_describes_your_diet[]" class="field_checkbox" value="Keep it healthy" tabindex="13" type="checkbox" <?php if(in_array("Keep it healthy", $what_best_describes_your_diet)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Keep_it_healthy">Keep it healthy</label>
	
	<input id="Fast_Food" name="what_best_describes_your_diet[]" class="field_checkbox" value="Fast Food" tabindex="13" type="checkbox" <?php if(in_array("Fast Food", $what_best_describes_your_diet)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Fast_Food">Fast Food</label>
	</div>
	<div class="clr"></div>
	</li>
	
	<li>
	<label class="out" for="do_you_smoke">
	Do you smoke?
	</label>
	<div>
	<select id="do_you_smoke" name="do_you_smoke" class="field_select_medium" tabindex="15">
	<option value="NoAnswer" <?php if($row->do_you_smoke== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="297" <?php if($row->do_you_smoke== "297") { ?> selected="selected" <?php } ?>>No Way</option>
	<option value="298" <?php if($row->do_you_smoke== "298") { ?> selected="selected" <?php } ?>>Occasionally</option>
	<option value="299" <?php if($row->do_you_smoke== "299") { ?> selected="selected" <?php } ?>>Daily</option>
	<option value="300" <?php if($row->do_you_smoke== "300") { ?> selected="selected" <?php } ?>>Cigars</option>
	<option value="302" <?php if($row->do_you_smoke== "302") { ?> selected="selected" <?php } ?>>Trying to quit</option>
	</select>
	</div>
	</li>
		
	<li>
	<label class="out" for="how_often_do_you_drink">
	How often do you drink?
	</label>
	<div>
	<select id="how_often_do_you_drink" name="how_often_do_you_drink" class="field_select_medium" tabindex="15">
	<option value="NoAnswer" <?php if($row->how_often_do_you_drink== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="76" <?php if($row->how_often_do_you_drink== "76") { ?> selected="selected" <?php } ?>>I don't drink alcohol</option>
	<option value="77" <?php if($row->how_often_do_you_drink== "77") { ?> selected="selected" <?php } ?>>Social drinker, maybe one or two</option>
	<option value="78" <?php if($row->how_often_do_you_drink== "78") { ?> selected="selected" <?php } ?>>Regularly</option>
	</select>
	</div>
	</li>
	
    
    
  
   <li>
    	<label class="out">
		Describe your job 
		<span id="req_1" class="req">*</span>
		<span>Tell us more about what you do.</span>
		</label>
		<div>
		<textarea id="Field1" name="what_about_your_job" class="field_text_area" rows="4" cols="50" tabindex="2"><?php echo''.$row->what_about_your_job.'';?></textarea>
		</div>
		<p class="instruct" id="instruct1"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>    
    
    
    
	<li>
	<label class="out" for="what_kind_of_job_do_you_have">
	Are you a 9-to-5er? Your own boss? What kind of job do you have?
	</label>
	<div>
	<select id="what_kind_of_job_do_you_have" name="what_kind_of_job_do_you_have" class="field_select_medium" tabindex="15">
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
	<span id="req_2" class="req">*</span>
	
	<div>
	<textarea id="tell_us_more" name="tell_us_more" class="field_text_medium" rows="5" cols="50" tabindex="2"><?php echo''.$row->tell_us_more.'';?></textarea>	
	</div>            
	</li>
	
	<li>
	<label class="out">
	Current annual income?
	<span id="req_3" class="req">*</span>
	</label>
	<div class="column1">
	<input id="iLess_Than_25000" name="current_annual_income" class="field_checkbox" value="Less Than 25000" tabindex="13" type="radio" <?php if($row->current_annual_income== "Less Than 25000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="iLess_Than_25000">Less Than &pound;25,000</label>
	
	
	<input id="i35001_to_50000" name="current_annual_income" class="field_checkbox" value="35000" tabindex="13" type="radio" <?php if($row->current_annual_income== "35000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="i35001_to_50000">&pound;35,001 to &pound;50,000</label>
	
	
	<input id="i75001_to_100000" name="current_annual_income" class="field_checkbox" value="75000" tabindex="13" type="radio" <?php if($row->current_annual_income== "75000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="i75001_to_100000">&pound;75,001 to &pound;100,000</label>
	
	
	<input id="i150001" name="current_annual_income" class="field_checkbox" value="150000" tabindex="13" type="radio" <?php if($row->current_annual_income== "150000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="i150001">&pound;150,001+</label>
	</div>
	
	<div class="column2">
	<input id="i25001_to_35000" name="current_annual_income" class="field_checkbox" value="25000" tabindex="13" type="radio" <?php if($row->current_annual_income== "25000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="i25001_to_35000">&pound;25,001 to &pound;35,000</label>
	
	<input id="i50001_to_75000" name="current_annual_income" class="field_checkbox" value="50000" tabindex="13" type="radio" <?php if($row->current_annual_income== "50000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="i50001_to_75000">&pound;50,001 to &pound;75,000</label>
	
	<input id="i100001_to_150000" name="current_annual_income" class="field_checkbox" value="100000" tabindex="13" type="radio" <?php if($row->current_annual_income== "100000") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="i100001_to_150000">&pound;100,001 to &pound;150,000</label>
	
	<input id="iNo_Answer" name="current_annual_income" class="field_checkbox" value="No Answer" tabindex="13" type="radio" <?php if($row->current_annual_income== "No Answer") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="iNo_Answer">No Answer</label>
	</div>
	<div class="clr"></div>
	</li>
	
	
	<li>
	<label class="out">
	Do you live alone?
	<span id="req_4" class="req">*</span>
	</label>
	<div class="column1">
	<input id="Live_alone" name="do_you_live_alone" class="field_checkbox" value="Live alone" tabindex="13" type="radio" <?php if($row->do_you_live_alone== "Live alone") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Live_alone">Live alone</label>
	
	<input id="Live_with_parents_extended_family" name="do_you_live_alone" class="field_checkbox" value="Live with parents" tabindex="13" type="radio" <?php if($row->do_you_live_alone== "Live with parents") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Live_with_parents_extended_family">Live with parents/extended family</label>
	</div>
	
	<div class="column2">
	<input id="Live_with_kids" name="do_you_live_alone" class="field_checkbox" value="Live with kids" tabindex="13" type="radio" <?php if($row->do_you_live_alone== "Live with kids") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Live_with_kids">Live with kids</label>
	
	<input id="Live_with_roommate" name="do_you_live_alone" class="field_checkbox" value="Live with roommate" tabindex="13" type="radio" <?php if($row->do_you_live_alone== "Live with roommate") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Live_with_roommate">Live with roommate(s)</label>
	</div>
	<div class="clr"></div>
	</li>
	
	<li>
	<label class="out" for="do_you_have_any_kids">
	Do you have any kids?
	</label>
	<div>
	<select id="do_you_have_any_kids" name="do_you_have_any_kids" class="field_select_medium" tabindex="15">
	<option value="57" <?php if($row->do_you_have_any_kids== "57") { ?> selected="selected" <?php } ?>>None</option>
	<option value="56" <?php if($row->do_you_have_any_kids== "56") { ?> selected="selected" <?php } ?>>Yes, and they live at home</option>
	<option value="58" <?php if($row->do_you_have_any_kids== "58") { ?> selected="selected" <?php } ?>>Yes, and they live away from home</option>
	<option value="59" <?php if($row->do_you_have_any_kids== "59") { ?> selected="selected" <?php } ?>>Yes, and sometimes they live at home</option>
	</select>
	</div>
	</li>
	
	
	<li>
	<label class="out" for="do_you_want_children">
	Do you want children?
	</label>
	<div>
	<select id="do_you_want_children" name="do_you_want_children" class="field_select_medium" tabindex="15">
	<option value="273" <?php if($row->do_you_want_children== "273") { ?> selected="selected" <?php } ?>>Definitely</option>
	<option value="275" <?php if($row->do_you_want_children== "275") { ?> selected="selected" <?php } ?>>Someday</option>
	<option value="272" <?php if($row->do_you_want_children== "272") { ?> selected="selected" <?php } ?>>Not sure</option>
	<option value="276" <?php if($row->do_you_want_children== "276") { ?> selected="selected" <?php } ?>>Probably not</option>
	<option value="274" <?php if($row->do_you_want_children== "274") { ?> selected="selected" <?php } ?>>Do not want to have kids</option>
	</select>
	</div>
	
	<label class="out" for="how_many_kids_do_you_want">
	How many would you want?
	</label>
	<div>
	<select id="how_many_kids_do_you_want" name="how_many_kids_do_you_want" class="field_select_medium" tabindex="15">
	<option value="243" <?php if($row->how_many_kids_do_you_want== "243") { ?> selected="selected" <?php } ?>>1</option>
	<option value="244" <?php if($row->how_many_kids_do_you_want== "244") { ?> selected="selected" <?php } ?>>2</option>
	<option value="245" <?php if($row->how_many_kids_do_you_want== "245") { ?> selected="selected" <?php } ?>>3</option>
	<option value="246" <?php if($row->how_many_kids_do_you_want== "246") { ?> selected="selected" <?php } ?>>More than 3</option>
	</select>
	</div>            
	</li>
	
	<li>
	<label class="out">
	You like animals?
	<span id="req_5" class="req">*</span>
	</label>
	<div class="column1">
	<input id="Birds" name="pets[]" class="field_checkbox" value="Birds" tabindex="13" type="checkbox" <?php if(in_array("Birds", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Birds">Birds</label>
	
	<input id="Cats" name="pets[]" class="field_checkbox" value="Cats" tabindex="13" type="checkbox" <?php if(in_array("Cats", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Cats">Cats</label>
    
	<input id="Gerbils_Guinea_Pigs" name="pets[]" class="field_checkbox" value="Gerbils" tabindex="13" type="checkbox" <?php if(in_array("Gerbils", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Gerbils_Guinea_Pigs">Gerbils / Guinea Pigs</label>    
    
	<input id="Reptiles" name="pets[]" class="field_checkbox" value="Reptiles" tabindex="13" type="checkbox" <?php if(in_array("Reptiles", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Reptiles">Reptiles</label>       

	<input id="Other" name="pets[]" class="field_checkbox" value="Other" tabindex="13" type="checkbox" <?php if(in_array("Other", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Other">Other</label>                   
	</div>
	
	<div class="column2">
	<input id="Dogs" name="pets[]" class="field_checkbox" value="Dogs" tabindex="13" type="checkbox" <?php if(in_array("Dogs", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Dogs">Dogs</label>
	
	<input id="Exotic_pets" name="pets[]" class="field_checkbox" value="Exotic pets" tabindex="13" type="checkbox" <?php if(in_array("Exotic pets", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Exotic_pets">Exotic pets</label>
    
    
	<input id="Fish" name="pets[]" class="field_checkbox" value="Fish" tabindex="13" type="checkbox" <?php if(in_array("Fish", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Fish">Fish</label>    
    
    
	<input id="Horses" name="pets[]" class="field_checkbox" value="Horses" tabindex="13" type="checkbox" <?php if(in_array("Horses", $pets)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Horses">Horses</label>        
	</div>
	<div class="clr"></div>
	</li>
    <li>
	<input type="hidden" name="todo" value="lifestyle"/>
	<input type="hidden" name="e" value="lifestyle" />
	<input type="image" name="submit" value="Submit" class="field_submit" src="../graphics/login.jpg"/>
    </li>
	</ul>
	</form>
	
	<?php
	}//end of else
	?></div><?php
	/*Lifestyle*/			
			
			
				break;
		case "interests":
		?><div class="info">
		<h4>Interests</h4><?php
			
	/*Interests*/
	//variables
	$todo=$_REQUEST[todo];
	$what_do_you_do_for_fun=$_REQUEST[what_do_you_do_for_fun];
	$local_hot_spots=$_REQUEST[local_hot_spots];
	$favourite_things=$_REQUEST[favourite_things];
	$favourite_films=$_REQUEST[favourite_films];
	$favourite_tv=$_REQUEST[favourite_tv];
	$favourite_quotations=$_REQUEST[favourite_quotations];
	$favourite_music=$_REQUEST[favourite_music];
	$favourite_book=$_REQUEST[favourite_book];
	$exercise=$_REQUEST[exercise];
	$interests=$_REQUEST[interests];
	$interested_in=$_REQUEST[interested_in];
	
	
	if(!get_magic_quotes_gpc())
	{
		$todo=mysql_real_escape_string($todo);
		$what_do_you_do_for_fun=mysql_real_escape_string($what_do_you_do_for_fun);
		$local_hot_spots=mysql_real_escape_string($local_hot_spots);
		$favourite_things=mysql_real_escape_string(favourite_things);
		$favourite_films=mysql_real_escape_string(favourite_films);
		$favourite_tv=mysql_real_escape_string(favourite_tv);
		$favourite_quotations=mysql_real_escape_string(favourite_quotations);
		$favourite_music=mysql_real_escape_string(favourite_music);
		$favourite_book=mysql_real_escape_string(favourite_book);		
		$exercise=mysql_real_escape_string($exercise);
		$interests=mysql_real_escape_string($interests);	
		$interested_in=mysql_real_escape_string($interested_in);
	}
	
	if(!is_null($exercise))
	{		
		$exercise = implode(",", $exercise);
	}
	
	if(!is_null($interests))
	{		
		$interests = implode(",", $interests);
	}
	
		//collect all data of the member
		$c1->query("
		SELECT signup.id, signup.userid, interests.what_do_you_do_for_fun, interests.local_hot_spots, interests.favourite_things, interests.favourite_films, interests.favourite_tv, interests.favourite_quotations, interests.favourite_music,interests.favourite_book, interests.sports_and_exercise, interests.common_interests, interests.interested_in
		FROM signup
		LEFT JOIN interests
		ON signup.id = interests.id WHERE signup.userid='$_SESSION[userid]'");  
	
		//row results
		$row = $c1->fetchObject();	  
	
	// check the login details of the user and stop execution if not logged in
	
	//form submitted validate results
	if(isset($todo) and $todo=="interests")
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
		
			$c1->query("SELECT * FROM interests WHERE id=$row->id");  
		
			if(!$c1->getNumRows())
			{		
				if($c1->query("INSERT INTO `interests` (`id`, `what_do_you_do_for_fun` , `local_hot_spots` , `favourite_things`, `favourite_book`, `favourite_films`, `favourite_tv`, `favourite_quotations`, `favourite_music` ,`sports_and_exercise` ,`common_interests` , `interested_in`, `last_updated` )
				VALUES ('$row->id', '$what_do_you_do_for_fun', '$local_hot_spots', '$favourite_things', '$favourite_book', '$favourite_films','$favourite_tv','$favourite_quotations','$favourite_music','$exercise', '$interests', '$interested_in', '$current_time')"))
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=interests"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=interests"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php						
				}			
			}
			else
			{	
				if($c1->query("UPDATE interests 
				SET 
				what_do_you_do_for_fun='$what_do_you_do_for_fun',
				local_hot_spots='$local_hot_spots',
				favourite_things='$favourite_things',
				favourite_book='$favourite_book',
				favourite_films='$favourite_films',
				favourite_tv='$favourite_tv',
				favourite_quotations='$favourite_quotations',
				favourite_music='$favourite_music',
				sports_and_exercise='$exercise',
				interested_in='$interested_in',
				common_interests='$interests'												 
				WHERE id='$row->id'"))
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=interests"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php						
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=interests"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php						
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
	<form id="interests" class="gloss" enctype="multipart/form-data" method="post" action="#">
	<ul>
	<li>
      	<label class="out" for="interested_in">
		What are your interests?
		<span id="req_0" class="req">*</span>
		<span>Do you have any amazing interests?</span>
		</label>
		<div>
		<textarea id="interested_in" name="interested_in" class="field_text_area" rows="4" cols="50" tabindex="2"><?php echo''.$row->interested_in.'';?></textarea>
		</div>
		<p class="instruct"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>
	  
    
    <li>
    	<label class="out" for="what_do_you_do_for_fun">
		What do you do for fun?
		<span id="req_1" class="req">*</span>
		<span>Here's a great opportunity to get noticed. But remember, it's all in the details. What's your favourite genre? Who's your favourite actor? Enjoy having popcorn and a soft drink in the back row at the theatre, or watching a DVD at home, all comfy in your pyjamas? Any unusual hobbies or interests? Don't be shy. The more information people know about you, the better odds of finding your match.</span>
		</label>
		<div>
		<textarea id="what_do_you_do_for_fun" name="what_do_you_do_for_fun" class="field_text_area" rows="4" cols="50" tabindex="2"><?php echo''.$row->what_do_you_do_for_fun.'';?></textarea>
		</div>
		<p class="instruct"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>
	    
	<li>
		<label class="out" for="local_hot_spots">
		Favourite local hot spots or travel destinations?
		<span id="req_2" class="req">*</span>
		<span>Once you find your match, where would you want to take her? Where's your favourite place to eat? Do you like going to wild and crazy bars or small and cosy coffee shops? Where was your favourite place to visit on a holiday? Where have you always wanted to go, but never have?</span>
		</label>
		<div>
		<textarea id="local_hot_spots" name="local_hot_spots" class="field_text_area" rows="4" cols="50" tabindex="2"><?php echo''.$row->local_hot_spots.'';?></textarea>
		</div>
		<p class="instruct"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>
	
	<li>
		<label class="out" for="favourite_things">
		Favourite things?
		<span id="req_3" class="req">*</span>
		<span>Everyone has their favourite things. What's your favourite thing to eat? Favourite colour? Favourite thing to do when it's raining outside? Where do you like to go shopping? Tell us your favourite books, TV shows, foods, clothes, music and more.</span>
		</label>
		<div>
		<textarea id="favourite_things" name="favourite_things" class="field_text_area" rows="4" cols="50" tabindex="2"><?php echo''.$row->favourite_things.'';?></textarea>
		</div>
		<p class="instruct"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>



	<li>
		<label class="out" for="favourite_films">
		Favourite films?
		<span id="req_4" class="req">*</span>
		<span>Tell us more about your favourite films?</span>
		</label>
		<div>
		<textarea id="favourite_films" name="favourite_films" class="field_text_area" rows="4" cols="50" tabindex="2"><?php echo''.$row->favourite_things.'';?></textarea>
		</div>
		<p class="instruct"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>


	<li>
		<label class="out" for="favourite_quotations">
		Favourite quotations?
		<span id="req_5" class="req">*</span>
		<span>Tell us more about your favourite quotations?</span>
		</label>
		<div>
		<textarea id="favourite_quotations" name="favourite_quotations" class="field_text_area" rows="4" cols="50" tabindex="2"><?php echo''.$row->favourite_things.'';?></textarea>
		</div>
		<p class="instruct"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>




	<li>
		<label class="out" for="favourite_tv">
		Favourite tv?
		<span id="req_6" class="req">*</span>
		<span>Tell us more about your favourite tv?</span>
		</label>
		<div>
		<textarea id="favourite_tv" name="favourite_tv" class="field_text_area" rows="4" cols="50" tabindex="2"><?php echo''.$row->favourite_things.'';?></textarea>
		</div>
		<p class="instruct"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>



	<li>
		<label class="out" for="favourite_music">
		Favourite music?
		<span id="req_7" class="req">*</span>
		<span>Tell us more about your favourite music?</span>
		</label>
		<div>
		<textarea id="favourite_music" name="favourite_music" class="field_text_area" rows="4" cols="50" tabindex="2"><?php echo''.$row->favourite_things.'';?></textarea>
		</div>
		<p class="instruct"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>

	
	<li>
		<label class="out" for="favourite_book">
		What is your favourite book?
		<span id="req_8" class="req">*</span>
		<span>Whether it's a love-story or a thriller, biography or a classic - tell us about a favourite literary adventure. </span>
		</label>
		<div>
		<textarea id="favourite_book" name="favourite_book" class="field_text_area" rows="4" cols="50" tabindex="2"><?php echo''.$row->favourite_book.'';?></textarea>
		</div>
		<p class="instruct"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>
	
	<?php
	$common_interests = explode(",", $row->common_interests);
	$sports_and_exercise = explode(",", $row->sports_and_exercise);
	?>
	
	<li>
	<label class="out">
	What kinds of sports and exercise do you enjoy?
	<span id="req_9" class="req">*</span>
	</label>
	<div class="column1">
		<input id="Aerobics" name="exercise[]" class="field checkbox" value="Aerobics" tabindex="13" type="checkbox" <?php if(in_array("Aerobics", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Aerobics">Aerobics</label>
		
		<input id="Baseball" name="exercise[]" class="field checkbox" value="Baseball" tabindex="13" type="checkbox"<?php if(in_array("Baseball", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Baseball">Baseball</label>
		
		<input id="Billiards" name="exercise[]" class="field checkbox" value="Billiards" tabindex="13" type="checkbox"<?php if(in_array("Billiards", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Billiards">Billiards/Pool</label>
		
		<input id="Cycling" name="exercise[]" class="field checkbox" value="Cycling" tabindex="13" type="checkbox"<?php if(in_array("Cycling", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Cycling">Cycling</label>
		
		<input id="Golf" name="exercise[]" class="field checkbox" value="Golf" tabindex="13" type="checkbox"<?php if(in_array("Golf", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Golf">Golf</label>
		
		<input id="Inline_skating" name="exercise[]" class="field checkbox" value="Inline skating" tabindex="13" type="checkbox"<?php if(in_array("Inline skating", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Inline_skating">Inline skating</label>
		
		<input id="Running_Skiing" name="exercise[]" class="field checkbox" value="Running	Skiing" tabindex="13" type="checkbox"<?php if(in_array("Running Skiing", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Running_Skiing">Running	Skiing</label>
		
		<input id="Soccer" name="exercise[]" class="field checkbox" value="Soccer" tabindex="13" type="checkbox"<?php if(in_array("Soccer", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Soccer">Soccer</label>
		
		<input id="Tennis_Racquet_sports" name="exercise[]" class="field checkbox" value="Tennis" tabindex="13" type="checkbox"<?php if(in_array("Tennis", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Tennis_Racquet_sports">Tennis/Racquet sports</label>
		
		<input id="Weights_Machines" name="exercise[]" class="field checkbox" value="Weights" tabindex="13" type="checkbox"<?php if(in_array("Weights", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Weights_Machines">Weights/Machines</label>
		
		<input id="Other_types_of_exercise" name="exercise[]" class="field checkbox" value="Other types of exercise" tabindex="13" type="checkbox"<?php if(in_array("Other types of exercise", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Other_types_of_exercise">Other types of exercise</label>
	</div>
	
	<div class="column2">
		<input id="Auto_racing_Motorcross" name="exercise[]" class="field checkbox" value="Auto racing" tabindex="13" type="checkbox"<?php if(in_array("Auto racing", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Auto_racing_Motorcross">Auto racing/Motorcross</label>
		
		<input id="Basketball" name="exercise[]" class="field checkbox" value="Basketball" tabindex="13" type="checkbox"<?php if(in_array("Basketball", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Basketball">Basketball</label>
		
		<input id="Bowling" name="exercise[]" class="field checkbox" value="Bowling" tabindex="13" type="checkbox"<?php if(in_array("Bowling", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Bowling">Bowling</label>
		
		<input id="Football" name="exercise[]" class="field checkbox" value="Football" tabindex="13" type="checkbox"<?php if(in_array("Football", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Football">Football</label>
		
		<input id="Dancing" name="exercise[]" class="field checkbox" value="Dancing" tabindex="13" type="checkbox"<?php if(in_array("Dancing", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Dancing">Dancing</label>
		
		<input id="Martial_arts" name="exercise[]" class="field checkbox" value="Martial arts" tabindex="13" type="checkbox"<?php if(in_array("Martial arts", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Martial_arts">Martial arts</label>
		
		<input id="Swimming" name="exercise[]" class="field checkbox" value="Swimming" tabindex="13" type="checkbox"<?php if(in_array("Swimming", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Swimming">Swimming</label>
		
		<input id="Walking_Hiking" name="exercise[]" class="field checkbox" value="Walking" tabindex="13" type="checkbox"<?php if(in_array("Walking", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Walking_Hiking">Walking/Hiking</label>
		
		<input id="Yoga" name="exercise[]" class="field checkbox" value="Yoga" tabindex="13" type="checkbox"<?php if(in_array("Yoga", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Yoga">Yoga</label>
		
		<input id="Hockey" name="exercise[]" class="field checkbox" value="Hockey" tabindex="13" type="checkbox"<?php if(in_array("Hockey", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Hockey">Hockey</label>
	
	</div>
	<div class="clr"></div>
	</li>
		
	<li>
	<label class="out" for="interests">
	What common interests would you like to share with other members?
	<span id="req_10" class="req">*</span>
	</label>
	<div class="column1">
		<input id="University_Friends" name="interests[]" class="field checkbox" value="University Friends" tabindex="13" type="checkbox" <?php if(in_array("University Friends", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="University_Friends">University Friends</label>
		
		<input id="Camping" name="interests[]" class="field checkbox" value="Camping" tabindex="13" type="checkbox"<?php if(in_array("Camping", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Camping">Camping</label>
		
		<input id="Business_networking" name="interests[]" class="field checkbox" value="Business networking" tabindex="13" type="checkbox"<?php if(in_array("Business networking", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Business_networking">Business networking</label>
		
		<input id="Dining_out" name="interests[]" class="field checkbox" value="Dining out" tabindex="13" type="checkbox"<?php if(in_array("Dining out", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Dining_out">Dining out</label>
		
		<input id="Gardening_Landscaping" name="interests[]" class="field checkbox" value="Gardening" tabindex="13" type="checkbox"<?php if(in_array("Gardening", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Gardening_Landscaping">Gardening/Landscaping</label>
		
		<input id="Movies_Videos" name="interests[]" class="field checkbox" value="Movies" tabindex="13" type="checkbox"<?php if(in_array("Movies", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Movies_Videos">Movies/Videos</label>
		
		<input id="Music_and_concerts" name="interests[]" class="field checkbox" value="Music and concerts" tabindex="13" type="checkbox"<?php if(in_array("Music_and_concerts", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Music_and_concerts">Music and concerts</label>
		
		<input id="Nightclubs_Dancing" name="interests[]" class="field checkbox" value="Nightclubs" tabindex="13" type="checkbox"<?php if(in_array("Nightclubs", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Nightclubs_Dancing">Nightclubs/Dancing</label>
		
		<input id="Playing_cards" name="interests[]" class="field checkbox" value="Playing cards" tabindex="13" type="checkbox"<?php if(in_array("Playing cards", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Playing_cards">Playing cards</label>
		
		<input id="Political_interests" name="interests[]" class="field checkbox" value="Political interests" tabindex="13" type="checkbox"<?php if(in_array("Political interests", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Political_interests">Political interests</label>
		
		<input id="Shopping_Antiques" name="interests[]" class="field checkbox" value="Shopping" tabindex="13" type="checkbox"<?php if(in_array("Shopping", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Shopping_Antiques">Shopping/Antiques</label>
		
		<input id="Video_games" name="interests[]" class="field checkbox" value="Video games" tabindex="13" type="checkbox"<?php if(in_array("Video games", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Video_games">Video games</label>
		
		<input id="Watching_sports" name="interests[]" class="field checkbox" value="Watching sports" tabindex="13" type="checkbox"<?php if(in_array("Watching sports", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Watching_sports">Watching sports</label>
	</div>
	
	<div class="column2">
		<input id="Book_club_Discussion" name="interests[]" class="field checkbox" value="Book club" tabindex="13" type="checkbox"<?php if(in_array("Book club", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Book_club_Discussion">Book club/Discussion</label>
		
		<input id="Coffee_and_conversation" name="interests[]" class="field checkbox" value="Coffee and conversation" tabindex="13" type="checkbox"<?php if(in_array("Coffee and conversation", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Coffee_and_conversation">Coffee and conversation</label>
		
		<input id="Cooking" name="interests[]" class="field checkbox" value="Cooking" tabindex="13" type="checkbox"<?php if(in_array("Cooking", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Cooking">Cooking</label>
		
		<input id="Fishing_Hunting" name="interests[]" class="field checkbox" value="Fishing" tabindex="13" type="checkbox"<?php if(in_array("Fishing", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Fishing_Hunting">Fishing/Hunting</label>
		
		<input id="Hobbies_and_crafts" name="interests[]" class="field checkbox" value="Hobbies and crafts" tabindex="13" type="checkbox"<?php if(in_array("Hobbies and crafts", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Hobbies_and_crafts">Hobbies and crafts</label>
		
		<input id="Museums_and_art" name="interests[]" class="field checkbox" value="Museums and art" tabindex="13" type="checkbox"<?php if(in_array("Museums and art", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Museums_and_art">Museums and art</label>
		
		<input id="New_to_the_area" name="interests[]" class="field checkbox" value="New to the area" tabindex="13" type="checkbox"<?php if(in_array("New to the area", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="New_to_the_area">New to the area</label>
		
		<input id="Performing_arts" name="interests[]" class="field checkbox" value="Performing arts" tabindex="13" type="checkbox"<?php if(in_array("Performing arts", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Performing_arts">Performing arts</label>
		
		<input id="Playing_sports" name="interests[]" class="field checkbox" value="Playing sports" tabindex="13" type="checkbox"<?php if(in_array("Playing sports", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Playing_sports">Playing sports</label>
		
		<input id="Religion" name="interests[]" class="field checkbox" value="Religion" tabindex="13" type="checkbox"<?php if(in_array("Religion", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Religion">Religion</label>
		
		<input id="Travel" name="interests[]" class="field checkbox" value="Travel" tabindex="13" type="checkbox"<?php if(in_array("Travel", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Travel">Travel</label>
		
		<input id="Volunteering" name="interests[]" class="field checkbox" value="Volunteering" tabindex="13" type="checkbox"<?php if(in_array("Volunteering", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Volunteering">Volunteering</label>
		
		<input id="Wine_tasting" name="interests[]" class="field checkbox" value="Wine tasting" tabindex="13" type="checkbox"<?php if(in_array("Wine tasting", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Wine_tasting">Wine tasting</label>
	</div>
	<div class="clr"></div>
	</li>  

    <li> 
	<input type="hidden" name="e" value="interests" />
    <input type="hidden" name="todo" value="interests"/>
	<input type="image" name="submit" value="Submit" class="field_submit" src="../graphics/login.jpg"/>
	</li> 
	</ul>
    </form>
	<?php
	}//end of else
	?></div><?php
	/*Interests*/			
			
				break;
		case "background":
		?><div class="info">
		<h4>Background</h4><?php
/*Background*/

	//variables
	$todo=$_REQUEST[todo];
	$describe_your_background=$_REQUEST[describe_your_background];
	$ethnicities_describe_you_the_best=$_REQUEST[ethnicities_describe_you_the_best];
	$what_is_your_faith=$_REQUEST[what_is_your_faith];
	$describe_your_education=$_REQUEST[describe_your_education];
	$languages_do_you_speak=$_REQUEST[languages_do_you_speak];
	$sit_on_the_political_fence=$_REQUEST[sit_on_the_political_fence];
	
	if(!get_magic_quotes_gpc())
	{
		$todo=mysql_real_escape_string($todo);
		$describe_your_background=mysql_real_escape_string($describe_your_background);
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
		SELECT signup.id, signup.userid, background.ethnicities_describe_you_the_best, 
		background.describe_your_background, background.what_is_your_faith, background.describe_your_education, background.languages_do_you_speak, background.sit_on_the_political_fence
		FROM signup
		LEFT JOIN background
		ON signup.id = background.id WHERE signup.userid='$_SESSION[userid]'");  
	
		//row results
		$row = $c1->fetchObject();	  
	
	// check the login details of the user and stop execution if not logged in
	
	//form submitted validate results
	if(isset($todo) and $todo=="background")
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
				if($c1->query("INSERT INTO `background` (`id`, `describe_your_background`, `ethnicities_describe_you_the_best` , `what_is_your_faith` , `describe_your_education`, `languages_do_you_speak` ,`sit_on_the_political_fence` , `last_updated` )
				VALUES ('$row->id', '$describe_your_background', '$ethnicities_describe_you_the_best', '$what_is_your_faith', '$describe_your_education', '$languages_do_you_speak', '$sit_on_the_political_fence', '$current_time')"))
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=background"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php						
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=background"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}			
			}
			else
			{	
				if($c1->query("UPDATE background 
				SET 
				describe_your_background='$describe_your_background',
				ethnicities_describe_you_the_best='$ethnicities_describe_you_the_best',
				what_is_your_faith='$what_is_your_faith',
				describe_your_education='$describe_your_education',
				languages_do_you_speak='$languages_do_you_speak',
				sit_on_the_political_fence='$sit_on_the_political_fence'					 
				WHERE id='$row->id'"))
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=background"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=background"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
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
	<form id="background" class="gloss" enctype="multipart/form-data" method="post" action="#">
	
    
	<?php
	$ethnicities_describe_you_the_best = explode(",", $row->ethnicities_describe_you_the_best);
	$languages_do_you_speak = explode(",", $row->languages_do_you_speak);
	?>    
    
	<ul>
    
    
   <li>
    	<label class="out">
		Describe your background 
		<span id="req_0" class="req">*</span>
		<span>Describe your origins here.</span>
		</label>
		<div>
		<textarea id="Field1" name="describe_your_background" class="field_text_area" rows="5" cols="50" tabindex="2"><?php echo''.$row->describe_your_background.'';?></textarea>
		</div>
		<p class="instruct" id="instruct1"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>    
    
    
	<li>
	<label class="out">
	Which ethnicities describe you the best?
	<span id="req_1" class="req">*</span>
	</label>
	<input id="Asian" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="Asian" tabindex="13" type="checkbox" <?php if(in_array("Asian", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Asian">Asian</label>
	
	<input id="East_Indian" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="East Indian" tabindex="13" type="checkbox" <?php if(in_array("East Indian", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="East_Indian">East Indian</label>
	
	<input id="Middle_Eastern" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="Middle Eastern" tabindex="13" type="checkbox" <?php if(in_array("Middle Eastern", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Middle_Eastern">Middle Eastern</label>
	
	<input id="Pacific_Islander" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="Pacific Islander" tabindex="13" type="checkbox" <?php if(in_array("Pacific Islander", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Pacific_Islander">Pacific Islander</label>
	
	<input id="Other1" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="Other" tabindex="13" type="checkbox" <?php if(in_array("Other", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Other1">Other</label>
    
	<input id="Black_African_descent" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="Black" tabindex="13" type="checkbox" <?php if(in_array("Black", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Black_African_descent">Black / African descent</label>
	
	<input id="Latino_Hispanic" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="Latino" tabindex="13" type="checkbox" <?php if(in_array("Latino", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Latino_Hispanic">Latino / Hispanic</label>
	
	<input id="Native_American" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="Native American" tabindex="13" type="checkbox" <?php if(in_array("Native American", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Native_American">Native American</label>
	
	<input id="White_Caucasian" name="ethnicities_describe_you_the_best[]" class="field checkbox" value="White" tabindex="13" type="checkbox" <?php if(in_array("White", $ethnicities_describe_you_the_best)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="White_Caucasian">White / Caucasian</label>    
	</li>
	
		
	<li>
	<label class="out">
	What is your faith?
	<span id="req_2" class="req">*</span>
	</label>

 	<input id="Agnostic" name="what_is_your_faith" class="field checkbox" value="Agnostic" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Agnostic") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Agnostic">Agnostic</label>
	
	<input id="Buddhist_Taoist" name="what_is_your_faith" class="field checkbox" value="Buddhist" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Buddhist") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Buddhist_Taoist">Buddhist / Taoist</label>
	
	<input id="Christian_LDS" name="what_is_your_faith" class="field checkbox" value="Christian LDS" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Christian LDS") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Christian_LDS">Christian / LDS</label>
	
	<input id="Hindu" name="what_is_your_faith" class="field checkbox" value="Hindu" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Hindu") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Hindu">Hindu</label>
	
	<input id="Muslim_Islam" name="what_is_your_faith" class="field checkbox" value="Muslim" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Muslim") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Muslim_Islam">Muslim / Islam</label>
	
	<input id="Other2" name="what_is_your_faith" class="field checkbox" value="Other" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Other") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Other2">Other</label>
	
	<input id="No_Answer2" name="what_is_your_faith" class="field checkbox" value="No Answer" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "No Answer") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="No_Answer2">No Answer</label>   

	<input id="Atheist" name="what_is_your_faith" class="field checkbox" value="Atheist" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Atheist") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Atheist">Atheist</label>
	
	<input id="Christian_Catholic" name="what_is_your_faith" class="field checkbox" value="Christian Catholic" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Christian Catholic") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Christian_Catholic">Christian / Catholic</label>
	
	<input id="Christian_Protestant" name="what_is_your_faith" class="field checkbox" value="Christian Protestant" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Christian Protestant") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Christian_Protestant">Christian / Protestant</label>
	
	<input id="Jewish" name="what_is_your_faith" class="field checkbox" value="Jewish" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Jewish") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Jewish">Jewish</label>
	
	<input id="Spiritual_but_not_religious" name="what_is_your_faith" class="field checkbox" value="Spiritual but not religious" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Spiritual but not religious") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Spiritual_but_not_religious">Spiritual but not religious</label>
	
	<input id="Christian_Other" name="what_is_your_faith" class="field checkbox" value="Christian" tabindex="13" type="radio" <?php if($row->what_is_your_faith== "Christian") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Christian_Other">Christian / Other</label>    
	</li>
	
	<li>
	<label class="out">
	How would you describe your education?
	<span id="req_3" class="req">*</span>
	</label>
	<input id="High_school" name="describe_your_education" class="field checkbox" value="High school" tabindex="13" type="radio" <?php if($row->describe_your_education== "High school") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="High_school">High school</label>
	
	
	<input id="Associates_degree" name="describe_your_education" class="field checkbox" value="Associates degree" tabindex="13" type="radio" <?php if($row->describe_your_education== "Associates degree") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Associates_degree">Associates degree</label>
	
	
	<input id="Graduate_degree" name="describe_your_education" class="field checkbox" value="Graduate degree" tabindex="13" type="radio" <?php if($row->describe_your_education== "Graduate degree") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Graduate_degree">Graduate degree</label>
	
	
	<input id="No_Answer1" name="describe_your_education" class="field checkbox" value="No Answer" tabindex="13" type="radio" <?php if($row->describe_your_education== "No Answer") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="No_Answer1">No Answer</label>


	<input id="Some_college" name="describe_your_education" class="field checkbox" value="Some college" tabindex="13" type="radio" <?php if($row->describe_your_education== "Some college") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Some_college">Some college</label>
	
	<input id="Bachelors_degree" name="describe_your_education" class="field checkbox" value="Bachelors degree" tabindex="13" type="radio" <?php if($row->describe_your_education== "Bachelors degree") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Bachelors_degree">Bachelors degree</label>
	
	<input id="PhD_Post_Doctoral" name="describe_your_education" class="field checkbox" value="PhD" tabindex="13" type="radio" <?php if($row->describe_your_education== "PhD") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="PhD_Post_Doctoral">PhD / Post Doctoral</label>
	</li>
	
	<li>
	<label class="out">
	What languages do you speak?
	<span id="req_4" class="req">*</span>
	</label>
	<input id="Arabic" name="languages_do_you_speak[]" class="field checkbox" value="Arabic" tabindex="13" type="checkbox" <?php if(in_array("Arabic", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Arabic">Arabic</label>
	
	<input id="Dutch" name="languages_do_you_speak[]" class="field checkbox" value="Dutch" tabindex="13" type="checkbox" <?php if(in_array("Dutch", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Dutch">Dutch</label>
	
	<input id="French" name="languages_do_you_speak[]" class="field checkbox" value="French" tabindex="13" type="checkbox" <?php if(in_array("French", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="French">French</label>
	
	<input id="Hebrew" name="languages_do_you_speak[]" class="field checkbox" value="Hebrew" tabindex="13" type="checkbox" <?php if(in_array("Hebrew", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Hebrew">Hebrew</label>
	
	<input id="Italian" name="languages_do_you_speak[]" class="field checkbox" value="Italian" tabindex="13" type="checkbox" <?php if(in_array("Italian", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Italian">Italian</label>
	
	<input id="Norwegian" name="languages_do_you_speak[]" class="field checkbox" value="Norwegian" tabindex="13" type="checkbox" <?php if(in_array("Norwegian", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Norwegian">Norwegian</label>
	
	<input id="Russian" name="languages_do_you_speak[]" class="field checkbox" value="Russian" tabindex="13" type="checkbox" <?php if(in_array("Russian", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Russian">Russian</label>
	
	<input id="Swedish" name="languages_do_you_speak[]" class="field checkbox" value="Swedish" tabindex="13" type="checkbox" <?php if(in_array("Swedish", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Swedish">Swedish</label>
	
	<input id="Urdu" name="languages_do_you_speak[]" class="field checkbox" value="Urdu" tabindex="13" type="checkbox" <?php if(in_array("Urdu", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Urdu">Urdu</label>

	<input id="Chinese" name="languages_do_you_speak[]" class="field checkbox" value="Chinese" tabindex="13" type="checkbox" <?php if(in_array("Chinese", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Chinese">Chinese</label>
	
	<input id="English" name="languages_do_you_speak[]" class="field checkbox" value="English" tabindex="13" type="checkbox" <?php if(in_array("English", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="English">English</label>
	
	<input id="German" name="languages_do_you_speak[]" class="field checkbox" value="German" tabindex="13" type="checkbox" <?php if(in_array("German", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="German">German</label>
	
	<input id="Hindi" name="languages_do_you_speak[]" class="field checkbox" value="Hindi" tabindex="13" type="checkbox" <?php if(in_array("Hindi", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Hindi">Hindi</label>
	
	<input id="Japanese" name="languages_do_you_speak[]" class="field checkbox" value="Japanese" tabindex="13" type="checkbox" <?php if(in_array("Japanese", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Japanese">Japanese</label>
	
	<input id="Portuguese" name="languages_do_you_speak[]" class="field checkbox" value="Portuguese" tabindex="13" type="checkbox" <?php if(in_array("Portuguese", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Portuguese">Portuguese</label>
	
	<input id="Spanish" name="languages_do_you_speak[]" class="field checkbox" value="Spanish" tabindex="13" type="checkbox" <?php if(in_array("Spanish", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Spanish">Spanish</label>
	
	<input id="Tagalog" name="languages_do_you_speak[]" class="field checkbox" value="Tagalog" tabindex="13" type="checkbox" <?php if(in_array("Tagalog", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Tagalog">Tagalog</label>
	
	<input id="Other" name="languages_do_you_speak[]" class="field checkbox" value="Other" tabindex="13" type="checkbox" <?php if(in_array("Other", $languages_do_you_speak)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Other">Other</label>
	</li>
	
	
	<li>
	<label class="out" for="sit_on_the_political_fence">
	Where do you sit on the political fence?
	</label>
	<div>
	<select id="sit_on_the_political_fence" name="sit_on_the_political_fence" class="field_select_medium" tabindex="15">
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
	
	<li>
    <input type="hidden" name="todo" value="background"/>
    <input type="hidden" name="e" value="background" />
	<input type="image" name="submit" value="Submit" class="field_submit" src="../graphics/login.jpg"/>    
    </li>
	</ul>
	</form>
	<?php
	}//end of else
	?></div><?php
	/*Background*/
		
			break;
		case "personality":
		?><div class="info">
		<h4>Personality</h4><?php
		
	/*Personality*/
	//variables
	$todo=$_REQUEST[todo];
	$person=$_REQUEST[person];
	$describe_your_personality=$_REQUEST[describe_your_personality];
	
	
	
	if(!get_magic_quotes_gpc())
	{
		$todo=mysql_real_escape_string($todo);
		$person=mysql_real_escape_string($person);
		$describe_your_personality=mysql_real_escape_string($describe_your_personality);					
	}
	if(!is_null($person))
	{		
		$person = implode(",", $person);
	}	
		//collect all data of the member
		$c1->query("
		SELECT signup.id, signup.userid, personality.person_words, personality.describe_your_personality
		FROM signup
		LEFT JOIN personality
		ON signup.id = personality.id WHERE signup.userid='$_SESSION[userid]'");  
	
		//row results
		$row = $c1->fetchObject();	  
	
	// check the login details of the user and stop execution if not logged in
	
	//form submitted validate results
	if(isset($todo) and $todo=="personality")
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
		
			$c1->query("SELECT * FROM personality WHERE id=$row->id");  
		
			if(!$c1->getNumRows())
			{		
				if($c1->query("INSERT INTO `personality` (`id`, `describe_your_personality`, `person_words`, `last_updated` )
				VALUES ('$row->id', '$describe_your_personality', '$person', '$current_time')"))
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=personality"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=personality"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}			
			}
			else
			{	
				if($c1->query("UPDATE personality 
				SET
				describe_your_personality='$describe_your_personality', 
				person_words='$person'										 
				WHERE id='$row->id'"))
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=personality"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=personality"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
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
	<form id="personality" class="gloss" enctype="multipart/form-data" method="post" action="#">
	<?php
	$person = explode(",", $row->person_words);
	?>	
	<ul>
    <li>
    	<label class="out" for="describe_your_personality">
		Describe your personality
		<span id="req_1" class="req">*</span>
		<span>Here is your chance to tell potential dates what kind of person you are like.</span>
		</label>
		<div>
		<textarea id="describe_your_personality" name="describe_your_personality" class="field_text_area" rows="7" cols="50" tabindex="2"><?php echo''.$row->describe_your_personality.'';?></textarea>
		</div>
		<p class="instruct" id="instruct1"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>
	        
    
	<li>
	<label class="out" for="personality">
	What words describe your personality?
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
		<input id="Creative" name="person[]" class="field_checkbox" value="Creative" tabindex="13" type="checkbox" <?php if(in_array("Creative", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Creative">Creative</label>
		
		<input id="Entrepreneur" name="person[]" class="field_checkbox" value="Entrepreneur" tabindex="13" type="checkbox"<?php if(in_array("Entrepreneur", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Entrepreneur">Entrepreneur</label>
		
		<input id="Erratic" name="person[]" class="field_checkbox" value="Erratic" tabindex="13" type="checkbox"<?php if(in_array("Erratic", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Erratic">Erratic</label>
		
		<input id="Logical" name="person[]" class="field_checkbox" value="Logical" tabindex="13" type="checkbox"<?php if(in_array("Logical", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Logical">Logical</label>
		
		<input id="Sexy" name="person[]" class="field_checkbox" value="Sexy" tabindex="13" type="checkbox"<?php if(in_array("Sexy", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Sexy">Sexy</label>
		
		<input id="Open_minded" name="person[]" class="field_checkbox" value="Open minded" tabindex="13" type="checkbox"<?php if(in_array("Open minded", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Open_minded">Open minded</label>
		
		<input id="Vivacious" name="person[]" class="field_checkbox" value="Vivacious" tabindex="13" type="checkbox"<?php if(in_array("Vivacious", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Vivacious">Vivacious</label>
		
		<input id="Thoughtful" name="person[]" class="field_checkbox" value="Thoughtful" tabindex="13" type="checkbox"<?php if(in_array("Thoughtful", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Thoughtful">Thoughtful</label>
		
		<input id="A_home_lover" name="person[]" class="field_checkbox" value="A home lover" tabindex="13" type="checkbox"<?php if(in_array("A home lover", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="A_home_lover">A home lover</label>
		
		<input id="Chic" name="person[]" class="field_checkbox" value="Chic" tabindex="13" type="checkbox"<?php if(in_array("Chic", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Chic">Chic</label>
		
		<input id="A_deep_thinker" name="person[]" class="field_checkbox" value="A deep thinker" tabindex="13" type="checkbox"<?php if(in_array("A deep thinker", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="A_deep_thinker">A deep thinker</label>
        
		<input id="Humorous" name="person[]" class="field_checkbox" value="Humorous" tabindex="13" type="checkbox"<?php if(in_array("Humorous", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Humorous">Humorous</label>
	    
		<input id="Generous" name="person[]" class="field_checkbox" value="Generous" tabindex="13" type="checkbox"<?php if(in_array("Generous", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Generous">Generous</label>

		<input id="Successful" name="person[]" class="field_checkbox" value="Successful" tabindex="13" type="checkbox"<?php if(in_array("Successful", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Successful">Successful</label>                
	</div>
	
	<div class="column2">
		<input id="A_little_scruffy" name="person[]" class="field_checkbox" value="A little scruffy" tabindex="13" type="checkbox"<?php if(in_array("A little scruffy", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="A_little_scruffy">A little scruffy</label>
		
		<input id="Heroic" name="person[]" class="field_checkbox" value="Heroic" tabindex="13" type="checkbox"<?php if(in_array("Heroic", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Heroic">Heroic</label>
		
		<input id="Musical" name="person[]" class="field_checkbox" value="Musical" tabindex="13" type="checkbox"<?php if(in_array("Musical", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Musical">Musical</label>
		
		<input id="Argumentative" name="person[]" class="field_checkbox" value="Argumentative" tabindex="13" type="checkbox"<?php if(in_array("Argumentative", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Argumentative">Argumentative</label>
		
		<input id="Possibly_marriage_material" name="person[]" class="field_checkbox" value="Possibly marriage material" tabindex="13" type="checkbox"<?php if(in_array("Possibly marriage material", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Possibly_marriage_material">Possibly marriage material</label>
		
		<input id="Witty" name="person[]" class="field_checkbox" value="Witty" tabindex="13" type="checkbox"<?php if(in_array("Witty", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Witty">Witty</label>
		
		<input id="Independent" name="person[]" class="field_checkbox" value="Independent" tabindex="13" type="checkbox"<?php if(in_array("Independent", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Independent">Independent</label>
		
		<input id="A_hopeless_romantic" name="person[]" class="field_checkbox" value="A hopeless romantic" tabindex="13" type="checkbox"<?php if(in_array("A hopeless romantic", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="A_hopeless_romantic">A hopeless romantic</label>
		
		<input id="Intelligent" name="person[]" class="field_checkbox" value="Intelligent" tabindex="13" type="checkbox"<?php if(in_array("Intelligent", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Intelligent">Intelligent</label>
		
		<input id="Loyal" name="person[]" class="field_checkbox" value="Loyal" tabindex="13" type="checkbox"<?php if(in_array("Loyal", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Loyal">Loyal</label>

		<input id="Confident" name="person[]" class="field_checkbox" value="Confident" tabindex="13" type="checkbox"<?php if(in_array("Confident", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Confident">Confident</label>
	
		<input id="A_dedicated_follower_of_fashion" name="person[]" class="field_checkbox" value="A dedicated follower of fashion" tabindex="13" type="checkbox"<?php if(in_array("A dedicated follower of fashion", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="A_dedicated_follower_of_fashion">A dedicated follower of fashion</label>
	
		<input id="Outgoing" name="person[]" class="field_checkbox" value="Outgoing" tabindex="13" type="checkbox"<?php if(in_array("Outgoing", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Outgoing">Outgoing</label>
	
    	<input id="A_bit_of_a_drama_queen" name="person[]" class="field_checkbox" value="A bit of a drama queen" tabindex="13" type="checkbox"<?php if(in_array("A bit of a drama queen", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="A_bit_of_a_drama_queen">A bit of a drama queen</label>
	
		<input id="Flexible" name="person[]" class="field_checkbox" value="Flexible" tabindex="13" type="checkbox"<?php if(in_array("Flexible", $person)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Flexible">Flexible</label>

	</div>
	<div class="clr"></div>
	</li>
	
    <li>
    <input type="hidden" name="todo" value="personality"/>
    <input type="hidden" name="e" value="personality" />
	<input type="image" name="submit" value="Submit" class="field_submit" src="../graphics/login.jpg"/>    
	</li>
    </ul>
	</form>
	<?php
	}//end of else
	?></div><?php
	/*Personality*/		
			
			break;
		case "appearance":
		?><div class="info">
		<h4>Appearance</h4><?php
		
	/*Appearances*/
	//variables
	$todo=$_REQUEST[todo];
	$your_eye_colour=$_REQUEST[your_eye_colour];
	$colour_is_your_hair=$_REQUEST[colour_is_your_hair];
	$body_art=$_REQUEST[body_art];
	$your_best_feature=$_REQUEST[your_best_feature];

	if(!get_magic_quotes_gpc())
	{
		$todo=mysql_real_escape_string($todo);
		$your_eye_colour=mysql_real_escape_string($your_eye_colour);
		$colour_is_your_hair=mysql_real_escape_string($colour_is_your_hair);
		$body_art=mysql_real_escape_string($body_art);
		$your_best_feature=mysql_real_escape_string($your_best_feature);	
	}		

	if(!is_null($body_art))
	{		
		$body_art = implode(",", $body_art);
	}
	
		//collect all data of the member
		$c1->query("
		SELECT signup.id, signup.userid, appearance.your_eye_colour, appearance.colour_is_your_hair, appearance.body_art, appearance.your_best_feature
		FROM signup
		LEFT JOIN appearance
		ON signup.id = appearance.id WHERE signup.userid='$_SESSION[userid]'");  

		//row results
		$row = $c1->fetchObject();	  	
				
	// check the login details of the user and stop execution if not logged in
	
	//form submitted validate results
	if(isset($todo) and $todo=="appearance")
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
		
			$c1->query("SELECT * FROM appearance WHERE id=$row->id");  
		
			if(!$c1->getNumRows())
			{		
				if($c1->query("INSERT INTO `appearance` ( `id` , `your_eye_colour` , `colour_is_your_hair` , `body_art` , `your_best_feature`, `last_updated` )
VALUES ('$row->id', '$your_eye_colour', '$colour_is_your_hair', '$body_art', '$your_best_feature', '$current_time')"))
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=appearance"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=appearance"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}			
			}
			else
			{	
				if($c1->query("UPDATE `appearance` 
				SET `your_eye_colour` = '$your_eye_colour', 
				`colour_is_your_hair` = '$colour_is_your_hair' , 
				`body_art` = '$body_art',
				`your_best_feature` = '$your_best_feature'							 
				WHERE id='$row->id'"))				
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=appearance"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=appearance"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
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
	<form id="appearance" class="gloss" enctype="multipart/form-data" method="post" action="#">
	

	<?php
	$body_art = explode(",", $row->body_art);
	?>    
	
	<ul>
	<li>
		<label class="out" for="your_eye_colour">
		What best describes your eye colour?
		</label>
		<div>
		<select id="your_eye_colour" name="your_eye_colour" class="field_select_medium" tabindex="15"> 
			<option value="NoAnswer" <?php if($row->your_eye_colour== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
			<option value="123" <?php if($row->your_eye_colour== "123") { ?> selected="selected" <?php } ?>>Black</option>
			<option value="118" <?php if($row->your_eye_colour== "118") { ?> selected="selected" <?php } ?>>Blue</option>
			<option value="119" <?php if($row->your_eye_colour== "119") { ?> selected="selected" <?php } ?>>Brown</option>
			<option value="120" <?php if($row->your_eye_colour== "120") { ?> selected="selected" <?php } ?>>Grey</option>
			<option value="121" <?php if($row->your_eye_colour== "121") { ?> selected="selected" <?php } ?>>Green</option>
			<option value="122" <?php if($row->your_eye_colour== "122") { ?> selected="selected" <?php } ?>>Hazel</option>
		</select>
		</div>
	</li>
	
	<li>
		<label class="out" for="colour_is_your_hair">
		What colour is your hair?
		</label>
		<div>
		<select id="colour_is_your_hair" name="colour_is_your_hair" class="field_select_medium" tabindex="15"> 
		<option value="NoAnswer" <?php if($row->colour_is_your_hair== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
		<option value="126" <?php if($row->colour_is_your_hair== "126") { ?> selected="selected" <?php } ?>>Black</option>
		<option value="129" <?php if($row->colour_is_your_hair== "129") { ?> selected="selected" <?php } ?>>Blonde</option>
		<option value="133" <?php if($row->colour_is_your_hair== "133") { ?> selected="selected" <?php } ?>>Dark blonde</option>
		<option value="127" <?php if($row->colour_is_your_hair== "127") { ?> selected="selected" <?php } ?>>Light brown</option>
		<option value="128" <?php if($row->colour_is_your_hair== "128") { ?> selected="selected" <?php } ?>>Dark brown</option>
		<option value="125" <?php if($row->colour_is_your_hair== "125") { ?> selected="selected" <?php } ?>>Auburn / Red</option>
		<option value="134" <?php if($row->colour_is_your_hair== "134") { ?> selected="selected" <?php } ?>>Grey</option>
		<option value="130" <?php if($row->colour_is_your_hair== "130") { ?> selected="selected" <?php } ?>>Salt and pepper</option>
		<option value="135" <?php if($row->colour_is_your_hair== "135") { ?> selected="selected" <?php } ?>>Platinum</option>
		<option value="131" <?php if($row->colour_is_your_hair== "131") { ?> selected="selected" <?php } ?>>Silver</option>
		<option value="136" <?php if($row->colour_is_your_hair== "136") { ?> selected="selected" <?php } ?>>Bald</option>
		</select>
		</div>
	</li>
	
	<li>
		<label class="out">
		Body art?
		<span id="req_0" class="req">*</span>
		</label>

			<input id="Strategically_placed_tattoo" name="body_art[]" class="field_checkbox" value="Strategically placed tattoo" tabindex="13" type="checkbox" <?php if(in_array("Strategically placed tattoo", $body_art)) { ?>checked="checked"<?php } ?>/>
			<label class="choice" for="Strategically_placed_tattoo">Strategically placed tattoo</label>
            
			<input id="Pierced_ear" name="body_art[]" class="field_checkbox" value="Pierced ear" tabindex="13" type="checkbox" <?php if(in_array("Pierced ear", $body_art)) { ?>checked="checked"<?php } ?>/>
			<label class="choice" for="Pierced_ear">Pierced ear(s)</label>    
            
			<input id="None" name="body_art[]" class="field_checkbox" value="None" tabindex="13" type="checkbox" <?php if(in_array("None", $body_art)) { ?>checked="checked"<?php } ?>/>
			<label class="choice" for="None">None</label>

			<input id="Visible_tattoo" name="body_art[]" class="field_checkbox" value="Visible tattoo" tabindex="13" type="checkbox" <?php if(in_array("Visible tattoo", $body_art)) { ?>checked="checked"<?php } ?>/>
			<label class="choice" for="Visible_tattoo">Visible tattoo</label>  
              
			<input id="Belly_button_ring" name="body_art[]" class="field_checkbox" value="Belly button ring" tabindex="13" type="checkbox" <?php if(in_array("Belly button ring", $body_art)) { ?>checked="checked"<?php } ?>/>
			<label class="choice" for="Belly_button_ring">Belly button ring</label>    
            
			<input id="No_Answer" name="body_art[]" class="field_checkbox" value="No Answer" tabindex="13" type="checkbox" <?php if(in_array("No Answer", $body_art)) { ?>checked="checked"<?php } ?>/>
			<label class="choice" for="No_Answer">No Answer</label>
	</li>
	
	<li>
		<label class="out" for="your_best_feature">
		Brag a little: What's your best feature?
		</label>
		<div>
		<select id="your_best_feature" name="your_best_feature" class="field_select_medium" tabindex="15"> 
		<option value="NoAnswer" <?php if($row->your_best_feature== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
		<option value="19" <?php if($row->your_best_feature== "19") { ?> selected="selected" <?php } ?>>Arms</option>
		<option value="20" <?php if($row->your_best_feature== "20") { ?> selected="selected" <?php } ?>>Belly button</option>
		<option value="21" <?php if($row->your_best_feature== "21") { ?> selected="selected" <?php } ?>>Butt</option>
		<option value="22" <?php if($row->your_best_feature== "22") { ?> selected="selected" <?php } ?>>Calves</option>
		<option value="23" <?php if($row->your_best_feature== "23") { ?> selected="selected" <?php } ?>>Chest</option>
		<option value="25" <?php if($row->your_best_feature== "25") { ?> selected="selected" <?php } ?>>Eyes</option>
		<option value="26" <?php if($row->your_best_feature== "26") { ?> selected="selected" <?php } ?>>Feet</option>
		<option value="28" <?php if($row->your_best_feature== "28") { ?> selected="selected" <?php } ?>>Hands</option>
		<option value="27" <?php if($row->your_best_feature== "27") { ?> selected="selected" <?php } ?>>Hair</option>
		<option value="29" <?php if($row->your_best_feature== "29") { ?> selected="selected" <?php } ?>>Legs</option>
		<option value="30" <?php if($row->your_best_feature== "30") { ?> selected="selected" <?php } ?>>Lips</option>
		<option value="31" <?php if($row->your_best_feature== "31") { ?> selected="selected" <?php } ?>>Neck</option>
		</select>
		</div>
	</li>
	
    <li>
    <input type="hidden" name="todo" value="appearance"/>
    <input type="hidden" name="e" value="appearance"/>
	<input type="image" name="submit" value="Submit" class="field_submit" src="../graphics/login.jpg"/>    
    </li>
	</ul>

	</form>	
	<?php
	}//end of else
	?></div><?php
	/*Appearances*/		
		
			break;	
		case "editaccount":
		?><div class="info">
		<h4>Edit Account</h4><?php
				
	/*Account*/
	//variables
	$todo=$_REQUEST[todo];
	$name=$_REQUEST[name];
	$email=$_REQUEST[email];
	$password1=$_REQUEST[password1];
	$password2=$_REQUEST[password2];
	
	if(!get_magic_quotes_gpc())
	{
		$todo=mysql_real_escape_string($todo);
		$name=mysql_real_escape_string($name);
		$email=mysql_real_escape_string($email);
		$password1=mysql_real_escape_string($password1);
		$password2=mysql_real_escape_string($password2);	
	}		
	
	// check the login details of the user and stop execution if not logged in
	//form submitted validate results
	if(isset($todo) and $todo=="editaccount")
	{
		// set the flags for validation and messages
		$status = "OK";
		$msg="";
	
		// if name is less than 5 char then status is not ok
		if (strlen($name) < 3) 
		{
			$msg=$msg."Your name  must be more than 3 char length<BR>";
			$status= "NOTOK";
		}
	
		// you can add email validation here if required.
		// The code for email validation is available at www.plus2net.com
	

		if(!empty($password1) && !empty($password2))
		{
			if (strlen($password1) < 3 or strlen($password1)> 8 )
			{
				$msg=$msg."Password must be more than 3 char legth and maximum 8 char lenght<BR>";
				$status= "NOTOK";
			}
		
			if ( $password1 <> $password2 )
			{
				$msg=$msg."Both passwords are not matching<BR>";
				$status= "NOTOK";
			}
		}
	
		if($status<>"OK")
		{ // if validation failed
			echo "<font face='Verdana' size='2' color=red>$msg</font>
			<br><input type='button' value='Retry' onClick='history.go(-1)'>";
		}
		else
		{ // if all validations are passed.	


		if(empty($password1) || empty($password2))
		{
			if(empty($password1) && !empty($password2))
			{
$err="The first password field was empty. To change  your password both fields must be filled in and must be exactly the same.<br/>";	
echo''.$err.'';			
			}
			if(!empty($password1) && empty($password2))
			{
$err="The second password field was empty. To change  your password both fields must be filled in and must be exactly the same.<br/>";
echo''.$err.'';			
			}
			
			//give no error... they may have updated something else  if(empty($password1) && empty($password2))
		}

		if(!empty($password1) && !empty($password2))
		{
			//emcrypt password
			$password1= md5($password1);
			
			if($c1->query("UPDATE signup SET password='$password1' WHERE userid='$_SESSION[userid]'"))
			{
				echo "Your password changed successfully. Please keep changing your password for better security.<br/>";
?>
            	<?php $return_url = "edit.php?e=editaccount"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 2000);
                </script>	
<?php	

		$c1->query("SELECT * FROM signup WHERE userid='$_SESSION[userid]'");
		
		//row results
		$row = $c1->fetchObject();	

					$adminemail="$site_admin_email";         ///// Change this address within quotes to your address ///
					$headers.="Reply-to: $adminemail\n";
					$headers .= "From: $adminemail\n";
					$headers .= "Errors-to: $adminemail\n";
					//$headers = "Content-Type: text/html; charset=iso-8859-1\n".$headers;// for html mail un-comment this line
				
					if(mail("$row->email","Password reset for your account on $site_name","You have recently changed your password on $site_name. Your login details are as follows: \n \nLogin ID: $row->userid \n Password: $password2 \n\n Thank You \n \n $site_admin_name","$headers"))
					{
						echo "Your new password has been posted to your email address . Please check your mail.";
					}	
			}
			else
			{
				echo "Sorry <br/> Failed to change password";
?>
            	<?php $return_url = "edit.php?e=editaccount"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 2000);
                </script>	
<?php					
			}
		}
	
			if($c1->query("UPDATE signup SET email='$email',name='$name' WHERE userid='$_SESSION[userid]'"))
			{
				if(!isset($err))
				{
				echo "You have successfully updated your profile<br/>";
?>
            	<?php $return_url = "edit.php?e=editaccount"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 2000);
                </script>	
<?php					
				}
				else
				{
?>
            	<?php $return_url = "edit.php?e=editaccount"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 4500);
                </script>	
<?php				
				}	
			}
			else
			{
				echo "There is some problem in updating your profile. Please contact site admin<br/>";
?>
            	<?php $return_url = "edit.php?e=editaccount"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 2000);
                </script>	
<?php				
			}
		}
		
		//clear submit variables
		unset($todo);
		//refresh
	}
	else
	{
		//collect all data of the member
		$c1->query("SELECT * FROM signup WHERE userid='$_SESSION[userid]'");
		
		//row results
		$row = $c1->fetchObject();	   
	?>
	<form id="profile" class="gloss" enctype="multipart/form-data" method="post" action="#">
	
	<ul>
	<li>
		<label class="out" for="email">
		Email
		</label>
		<div>
		<input id="email" name="email" type="text" class="field_text_medium" value="<?php echo $row->email ; ?>"	maxlength="255" tabindex="3"/>
		</div>
	</li>
	
	<li>
		<label class="out" for="name">
		Name
		</label>
		<div>
		<input id="name" name="name" type="text" class="field_text_medium" value="<?php echo $row->name ; ?>"	maxlength="255" tabindex="3"/>
		</div>
	</li>
		
	<li>
		<label class="out" for="password1">
		New Password
		</label>
		<div>
		<input id="password1" name="password1" type="password" class="field_text_medium" value=""	maxlength="255" tabindex="3"/>
		</div>
		
		<label class="out" for="password2">
		Re-enter New Password
		</label>
		<div>
		<input id="password2" name="password2" type="password" class="field_text_medium" value=""	maxlength="255" tabindex="3"/>
		</div>
	</li>
    <li>
	<input type="hidden" name="todo" value="editaccount"/>
    <input type="hidden" name="e" value="editaccount" />
	<input type="image" name="submit" value="Submit" class="field_submit" src="../graphics/login.jpg"/>
	</li>
    </ul>
	</form>
	<?php
	}//end of else
	?></div><?php
	/*Account*/				
				
			break;
		case "status":
		?><div class="info">
        <?php
	/*BIO*/


		//variables
		$todo=$_REQUEST[todo];
		$status_tag=$_REQUEST[status_tag];
	
		if(!get_magic_quotes_gpc())
		{
			$todo=mysql_real_escape_string($todo);
			$status_tag=mysql_real_escape_string($status_tag);
		}		
	

			//collect all data of the member
		$c1->query("
		SELECT signup.id, signup.userid, intro.status_tag, intro.last_updated
		FROM signup
		LEFT JOIN intro
		ON signup.id = intro.id WHERE signup.userid='$_SESSION[userid]'");  
	
		//row results
		$row = $c1->fetchObject();	  
							
	// check the login details of the user and stop execution if not logged in
	
		
	
	//form submitted validate results
	if(isset($todo) and $todo=="status")
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
			?><div class="clr"></div><?php
			$c1->query("SELECT * FROM intro WHERE id=$row->id");  
		
			if(!$c1->getNumRows())
			{		
				if($c1->query("INSERT INTO `intro` (`id`, `status_tag` )
				VALUES ('$row->id', '$status_tag')"))
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=status"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact the site admin<br>";
?>
            	<?php $return_url = "edit.php?e=status"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}			
			}
			else
			{	
				if($c1->query("UPDATE intro SET status_tag='$status_tag' WHERE id='$row->id'"))
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=status"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=status"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
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
     
<div class="left_float"><!--end of left --> 
	picture
    <br/><br/>
    * What kind of date do you want?<br/>
    * Bio<br/>
    * Appearance<br/>
    * Personality<br/>
    * Background<br/>
    * Interests<br/>
    * Lifestyle<br/>    
</div><!--end of left side --> 
<div class="right_float"><!--end of right -->    

<div class="statusprofile">
        <div class="user_name"><?php echo''.$_SESSION[userid].''; ?> </div>
        <div id="ajaxDiv"><?php echo''.stripslashes($row->status_tag).'';?> 
        <?php if(!empty($row->last_updated)){ ?><span class="finedetail"><?php echo''.nicetime($row->last_updated).'';?></span> <?php }?>
        </div>
        <div class="clr"></div>
</div><!--end of statusprofile --> 
<div class="statusmenu">
    <ul class="options">
    <?php
    if(!empty($e))
    {
    ?>
    <li <?php if(preg_match("/e=status$/", $current_page)){?>class="selected"<?php } ?>><a href="edit.php?e=status">Wall</a></li>
    <li <?php if(preg_match("/e=status&p=1$/", $current_page)){?>class="selected"<?php } ?>><a href="edit.php?e=status&amp;p=1">Photos</a></li>
    <?php
    }
    ?>
    </ul>  
</div><!--end of statusmenu --> 

<?php
if(empty($p))
{//WALL
?>
	<script type="text/javascript">
    function hideDiv(){
    document.getElementById('textcover').style.visibility = 'hidden'; 
    }
    <!-- 
    //Browser Support Code
    function ajaxFunction(){
        var ajaxRequest;  // The variable that makes Ajax possible!
        
        try{
            // Opera 8.0+, Firefox, Safari
            ajaxRequest = new XMLHttpRequest();
        } catch (e){
            // Internet Explorer Browsers
            try{
                ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try{
                    ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e){
                    // Something went wrong
                    alert("Your browser broke!");
                    return false;
                }
            }
        }
        // Create a function that will receive data sent from the server
        ajaxRequest.onreadystatechange = function(){
            if(ajaxRequest.readyState == 4){
                var ajaxDisplay = document.getElementById('ajaxDiv');
                ajaxDisplay.innerHTML = ajaxRequest.responseText;
            }
        }
        var chat = document.getElementById('chat').value;
        var id = document.getElementById('id').value;
        document.getElementById('chat').value ='';
        var queryString = "?chat=" + chat +"&id=" + id;
        if(chat!='')
        {
        ajaxRequest.open("GET", "includes/ajaxupdates.php" + queryString, true);
        ajaxRequest.send(null); 
        }
    }
    //-->
    </script>
    
    <?php 
	$randtext_array = array("What is on your mind?", "Write a comment...", "Tell us about your day", "How are you feeling?");
	srand(time());
	$sizeof = count($randtext_array);
	$random = (rand()%$sizeof);
	$randtext = $randtext_array[$random];
	?>
        <form id="status" class="gloss" action="">             
            <ul>
                <li>
                    <div><div id="textcover"><?php echo''.$randtext.'';?></div>
		<textarea id="chat" name="chat" class="field_text_area" rows="2" cols="50" tabindex="2" onfocus="hideDiv(); document.status.chat.value='';"></textarea>
                    </div>
                    
                    <span><small>Please be as detailed as possible. Remember, sell yourself, be proactive, positive and inspiring to others.</small></span>
                </li>
                <li>
                <input type="hidden" id="id" value="<?php echo''.$row->id.'';?>"/>
                
                </li>
                <li>
<span class="ajaxButton"><input type="button" class="ajaxtext" onclick="ajaxFunction();" value="Submit"/></span>

                </li>
            </ul>
        </form>
<!--Latest Login-->

<?php
	$c1->query("SELECT * FROM `signup` ORDER BY `last_logged` DESC LIMIT 0 , 30");
	//scan results and pull out array
	if($rec=$c1->fetchAll())
	{  
		?><h4>Recent Activity</h4><?php
		//foreach
		foreach ($rec as &$value)
		{
			echo'<a href="view-profile.php?id='.$value[id].'">'.$value[name].'</a> logged in '.nicetime($value[last_logged]).'<br/>';
		}
	}
?>

<!--Latest Login-->
<?php
}//WALL
else
{//PHOTOS
	echo'photos';


						//check directory to see if any photos exist...if so display them ALL
						$dir = "profile/$row->id/";
						//echo'dir: '.$dir.'';
						
						// Open a known directory, and proceed to read its contents
						if (is_dir($dir)) {
							
							//File Count
							$filecount = count(glob("".$dir."*.jpg"));
							//echo'Total files '.$filecount.'<br/>';
						
							if ($dh = opendir($dir)) 
							{
								while (($file = readdir($dh)) !== false) 
								{
									if(filetype($dir.$file) !="dir")
									{
										$profile_pic_array[] = $file;
										//echo"<br/>";
										//echo"filename: $file<br/>";
										?><div class="picture_wrap"><img src="<?php echo''.$dir.''.$file.'';?>" alt="Picture" width="140"/></div><?php
										//echo"filename: $file<br/>";
										//echo"filetype: ".filetype($dir.$file)."<br/>";
									}
								}
								?><div class="clr"></div><?php
								closedir($dh);
							}
						}			


}//PHOTOS
?>




</div><!--end of right side --> 
<div class="clr"></div>                   
    <?php
	}//end of else
	?></div><?php
	/*BIO*/		
			
			break;
		case "bio":
		?><div class="info">
		<h4>Bio</h4><?php
					
	/*Bio*/	
	//variables
	$todo=$_REQUEST[todo];
	$where_is_your_home_town=$_REQUEST[where_is_your_home_town];
	$do_you_have_any_brothers_or_sisters=$_REQUEST[do_you_have_any_brothers_or_sisters];
	$you_an_early_bird_or_night_owl=$_REQUEST[you_an_early_bird_or_night_owl];
	$do_you_play_a_musical_instrument=$_REQUEST[do_you_play_a_musical_instrument];
	$what_is_your_favourite_colour=$_REQUEST[what_is_your_favourite_colour];
	$describe_yourself=$_REQUEST[describe_yourself];
	$date_headline=$_REQUEST[date_headline];
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
		$where_is_your_home_town=mysql_real_escape_string($where_is_your_home_town);
		$do_you_have_any_brothers_or_sisters=mysql_real_escape_string($do_you_have_any_brothers_or_sisters);
		$you_an_early_bird_or_night_owl=mysql_real_escape_string($you_an_early_bird_or_night_owl);
		$do_you_play_a_musical_instrument=mysql_real_escape_string($do_you_play_a_musical_instrument);
		$what_is_your_favourite_colour=mysql_real_escape_string($what_is_your_favourite_colour);
		$describe_yourself=mysql_real_escape_string($describe_yourself);
		$date_headline=mysql_real_escape_string($date_headline);		
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
	
	if(!is_null($do_you_play_a_musical_instrument))
	{		
		$do_you_play_a_musical_instrument = implode(",", $do_you_play_a_musical_instrument);
	}

	if(!is_null($how_tall_are_you))
	{
		$how_tall_are_you = implode(",", $how_tall_are_you);
	}
	
		//collect all data of the member
		$c1->query("
		SELECT signup.id, signup.userid, bio.what_brings_you_here, bio.what_is_your_gender, bio.gender_you_looking_for, bio.age_range_you_looking_for_youngest , bio.age_range_you_looking_for_oldest, bio.where_should_we_look, bio.how_tall_are_you, bio.your_body_type, bio.your_sign, bio.describe_yourself, bio.date_headline, bio.where_is_your_home_town, bio.do_you_have_any_brothers_or_sisters, bio.you_an_early_bird_or_night_owl, bio.do_you_play_a_musical_instrument, bio.what_is_your_favourite_colour
		FROM signup
		LEFT JOIN bio
		ON signup.id = bio.id WHERE signup.userid='$_SESSION[userid]'");  
	
		//row results
		$row = $c1->fetchObject();	  	
					
	// check the login details of the user and stop execution if not logged in
	
	//form submitted validate results
	if(isset($todo) and $todo=="bio")
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
			$c1->query("SELECT * FROM bio WHERE id=$row->id"); 
		
			if(!$c1->getNumRows())
			{		
				if($c1->query("INSERT INTO `bio` ( `id` , `what_brings_you_here` , `what_is_your_gender` , `gender_you_looking_for` ,`age_range_you_looking_for_youngest` , `age_range_you_looking_for_oldest` , `where_should_we_look` ,`how_tall_are_you` , `your_body_type` , `your_sign`, `describe_yourself`, `date_headline`, `where_is_your_home_town` , `do_you_have_any_brothers_or_sisters`,`you_an_early_bird_or_night_owl`,`do_you_play_a_musical_instrument`,`what_is_your_favourite_colour`, `last_updated` )
VALUES ('$row->id', '$what_brings_you_here', '$what_is_your_gender', '$gender_you_looking_for','$age_range_you_looking_for[0]', '$age_range_you_looking_for[1]', '$where_should_we_look', `$how_tall_are_you` , `$your_body_type` , `$your_sign` , '$describe_yourself', '$date_headline', '$what_is_your_home_town', '$your_brothers_or_sisters', '$you_an_early_bird_or_night_owl', '$do_you_play_a_musical_instrument', '$your_favourite_colour', '$current_time')"))
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=bio"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=bio"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}			
			}
			else
			{	
				if($c1->query("UPDATE `bio` 
				SET 
				what_brings_you_here='$what_brings_you_here', 
				what_is_your_gender='$what_is_your_gender', 
				gender_you_looking_for='$gender_you_looking_for',
				age_range_you_looking_for_youngest ='$age_range_you_looking_for[0]',
				age_range_you_looking_for_oldest ='$age_range_you_looking_for[1]',
				where_should_we_look='$where_should_we_look',
				how_tall_are_you='$how_tall_are_you',
				your_body_type='$your_body_type',
				your_sign='$your_sign',
				`describe_yourself` = '$describe_yourself', 
				`date_headline` = '$date_headline', 
				`where_is_your_home_town` = '$where_is_your_home_town', 
				`do_you_have_any_brothers_or_sisters` = '$do_you_have_any_brothers_or_sisters' ,
				`you_an_early_bird_or_night_owl` = '$you_an_early_bird_or_night_owl', 	
				`do_you_play_a_musical_instrument` = '$do_you_play_a_musical_instrument' ,
				`what_is_your_favourite_colour` = '$what_is_your_favourite_colour' 
				WHERE id='$row->id'"))				
				{
					echo "You have successfully updated your profile<br>";
?>
            	<?php $return_url = "edit.php?e=bio"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
?>
            	<?php $return_url = "edit.php?e=bio"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                </script>	
<?php					
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
	<?php
	$do_you_play_a_musical_instrument = explode(",", $row->do_you_play_a_musical_instrument);	
	$age_range_you_looking_for = array($row->age_range_you_looking_for_youngest, $row->age_range_you_looking_for_oldest);
	$how_tall_are_you = explode(",", $row->how_tall_are_you); 	
	?>   

	<form id="bio" class="gloss" enctype="multipart/form-data" method="post" action="#">	
	<ul>
	<li>
		<label class="out" for="describe_yourself">
		Describe yourself and your perfect match to our community.
		<span id="req_0" class="req">*</span>
		</label>
		<div>
		<textarea id="describe_yourself" name="describe_yourself" class="field_text_area" rows="10" cols="50" tabindex="2"><?php echo $row->describe_yourself ; ?></textarea>
		</div>
		<p class="instruct"><small>Please be as detailed as possible. Remember, sell yourself, be proactive, positive and inspiring to others.</small></p>
	</li>
	
	<li>
		<label class="out" for="date_headline">
		Your dating headline.
		<span id="req_1" class="req">*</span>
		</label>
		<div>
		<textarea id="date_headline" name="date_headline" class="field_text_area" rows="2" cols="50" tabindex="2"><?php echo $row->date_headline ; ?></textarea>
		</div>
		<p class="instruct"><small>Express your success and your latest ambitions.</small></p>
	</li>    
    
    
	<li>
	<label class="out" for="what_brings_you_here">
	Welcome to our community! What brings you here today?
	</label>
	<div>
	<select id="what_brings_you_here" name="what_brings_you_here" class="field_select_medium" tabindex="15"> 
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
	
	<li>
	<label class="out" for="relationship_status">
	What is your relationship status?
	</label>
	<div>
	<select id="relationship_status" name="relationship_status" class="field_select_medium" tabindex="15"> 
	<option value="221" <?php if($row->relationship_status== "221") { ?> selected="selected" <?php } ?>>Never Married</option>    
	<option value="223" <?php if($row->relationship_status== "223") { ?> selected="selected" <?php } ?>>Currently Separated</option>
	<option value="224" <?php if($row->relationship_status== "224") { ?> selected="selected" <?php } ?>>Divorced</option>
	<option value="222" <?php if($row->relationship_status== "222") { ?> selected="selected" <?php } ?>>Widowed</option>
	</select>
	</div>
	</li>
	
	<li>
	<label class="out">
	What is your gender?
	</label>
	<div>
	<select name="what_is_your_gender" class="field_select_medium" tabindex="15"> 
	<option value="0" <?php if($row->what_is_your_gender== "0") { ?> selected="selected" <?php } ?>>Choose</option>
	<option value="2" <?php if($row->what_is_your_gender== "2") { ?> selected="selected" <?php } ?>>Woman</option>
	<option value="1" <?php if($row->what_is_your_gender== "1") { ?> selected="selected" <?php } ?>>Man</option>
	</select>
	</div>
	</li>
	
	<li>
	<label class="out" for="gender_you_looking_for">
	Who are you looking for?
	</label>
	<div>
	<select name="gender_you_looking_for" class="field_select_medium" tabindex="15"> 
	<option value="0" <?php if($row->gender_you_looking_for== "0") { ?> selected="selected" <?php } ?>>Choose</option>
	<option value="2" <?php if($row->gender_you_looking_for== "2") { ?> selected="selected" <?php } ?>>Woman</option>
	<option value="1" <?php if($row->gender_you_looking_for== "1") { ?> selected="selected" <?php } ?>>Man</option>
	</select>
	</div>
	
	<div>
	Between the ages
	<select name="age_range_you_looking_for[]" class="field_select_small" tabindex="15">
	<?php
	for($i=18; $i<=121; $i++)
	{
		?><option value="<?php echo''.$i.'';?>" <?php if($age_range_you_looking_for[0]== $i) { ?> selected="selected" <?php } ?>><?php echo''.$i.'';?></option><?php
	}
	?>
	</select>
	and
	
	<select name="age_range_you_looking_for[]" class="field_select_small" tabindex="15"> 
	<?php
	for($i=18; $i<=121; $i++)
	{
		?><option value="<?php echo''.$i.'';?>" <?php if($age_range_you_looking_for[1]== $i) { ?> selected="selected" <?php } ?>><?php echo''.$i.'';?></option><?php
	}
	?>
	</select>           
	</div>
	</li>
	
	<li>
	<label class="out" for="where_should_we_look">
	Where should we look?
	</label>
	<div>
	<select id="where_should_we_look" name="where_should_we_look" class="field_select_medium" tabindex="15">
	<option value="1" <?php if($row->where_should_we_look== "1") { ?> selected="selected" <?php } ?>>United States</option>
	<option value="2" <?php if($row->where_should_we_look== "2") { ?> selected="selected" <?php } ?>>Canada</option>
	<option value="224" <?php if($row->where_should_we_look== "224") { ?> selected="selected" <?php } ?>>United Kingdom</option>
	<option value="3" <?php if($row->where_should_we_look== "3") { ?> selected="selected" <?php } ?>>Afghanistan</option>
	<option value="4" <?php if($row->where_should_we_look== "4") { ?> selected="selected" <?php } ?>>Albania</option>
	<option value="5" <?php if($row->where_should_we_look== "5") { ?> selected="selected" <?php } ?>>Algeria</option>
	<option value="6" <?php if($row->where_should_we_look== "6") { ?> selected="selected" <?php } ?>>American Samoa</option>
	<option value="7" <?php if($row->where_should_we_look== "7") { ?> selected="selected" <?php } ?>>Andorra</option>
	<option value="9" <?php if($row->where_should_we_look== "9") { ?> selected="selected" <?php } ?>>Angola</option>
	<option value="10" <?php if($row->where_should_we_look== "10") { ?> selected="selected" <?php } ?>>Anguilla</option>
	<option value="11" <?php if($row->where_should_we_look== "11") { ?> selected="selected" <?php } ?>>Antigua and Barbuda</option>
	<option value="8" <?php if($row->where_should_we_look== "8") { ?> selected="selected" <?php } ?>>Argentina</option>
	<option value="12" <?php if($row->where_should_we_look== "12") { ?> selected="selected" <?php } ?>>Armenia</option>
	<option value="14" <?php if($row->where_should_we_look== "14") { ?> selected="selected" <?php } ?>>Ascension Island</option>
	<option value="15" <?php if($row->where_should_we_look== "15") { ?> selected="selected" <?php } ?>>Australia</option>
	<option value="16" <?php if($row->where_should_we_look== "16") { ?> selected="selected" <?php } ?>>Austria</option>
	<option value="17" <?php if($row->where_should_we_look== "17") { ?> selected="selected" <?php } ?>>Azerbaijan</option>
	<option value="18" <?php if($row->where_should_we_look== "18") { ?> selected="selected" <?php } ?>>Bahamas</option>
	<option value="19" <?php if($row->where_should_we_look== "19") { ?> selected="selected" <?php } ?>>Bahrain</option>
	<option value="20" <?php if($row->where_should_we_look== "20") { ?> selected="selected" <?php } ?>>Bangladesh</option>
	<option value="21" <?php if($row->where_should_we_look== "21") { ?> selected="selected" <?php } ?>>Barbados</option>
	<option value="22" <?php if($row->where_should_we_look== "22") { ?> selected="selected" <?php } ?>>Belarus</option>
	<option value="23" <?php if($row->where_should_we_look== "23") { ?> selected="selected" <?php } ?>>Belgium</option>
	<option value="24" <?php if($row->where_should_we_look== "96") { ?> selected="selected" <?php } ?>>Belize</option>
	<option value="25" <?php if($row->where_should_we_look== "25") { ?> selected="selected" <?php } ?>>Benin</option>
	<option value="26" <?php if($row->where_should_we_look== "26") { ?> selected="selected" <?php } ?>>Bermuda</option>
	<option value="27" <?php if($row->where_should_we_look== "27") { ?> selected="selected" <?php } ?>>Bhutan</option>
	<option value="28" <?php if($row->where_should_we_look== "28") { ?> selected="selected" <?php } ?>>Bolivia</option>
	<option value="29" <?php if($row->where_should_we_look== "29") { ?> selected="selected" <?php } ?>>Bosnia and Herzegovina</option>
	<option value="30" <?php if($row->where_should_we_look== "30") { ?> selected="selected" <?php } ?>>Botswana</option>
	<option value="31" <?php if($row->where_should_we_look== "31") { ?> selected="selected" <?php } ?>>Brazil</option>
	<option value="32" <?php if($row->where_should_we_look== "32") { ?> selected="selected" <?php } ?>>British Indian Ocean Territory</option>
	<option value="33" <?php if($row->where_should_we_look== "33") { ?> selected="selected" <?php } ?>>Brunei Darussalam</option>
	<option value="34" <?php if($row->where_should_we_look== "34") { ?> selected="selected" <?php } ?>>Bulgaria</option>
	<option value="35" <?php if($row->where_should_we_look== "35") { ?> selected="selected" <?php } ?>>Burkina Faso</option>
	<option value="36" <?php if($row->where_should_we_look== "36") { ?> selected="selected" <?php } ?>>Burundi</option>
	<option value="38" <?php if($row->where_should_we_look== "38") { ?> selected="selected" <?php } ?>>Camaroon</option>
	<option value="37" <?php if($row->where_should_we_look== "37") { ?> selected="selected" <?php } ?>>Cambodia</option>
	<option value="301" <?php if($row->where_should_we_look== "301") { ?> selected="selected" <?php } ?>>Cameroon</option>
	<option value="39" <?php if($row->where_should_we_look== "39") { ?> selected="selected" <?php } ?>>Cape Verde</option>
	<option value="40" <?php if($row->where_should_we_look== "40") { ?> selected="selected" <?php } ?>>Cayman Islands</option>
	<option value="41" <?php if($row->where_should_we_look== "41") { ?> selected="selected" <?php } ?>>Central African Republic</option>
	<option value="42" <?php if($row->where_should_we_look== "42") { ?> selected="selected" <?php } ?>>Chad</option>
	<option value="44" <?php if($row->where_should_we_look== "44") { ?> selected="selected" <?php } ?>>Chile</option>
	<option value="43" <?php if($row->where_should_we_look== "43") { ?> selected="selected" <?php } ?>>China</option>
	<option value="47" <?php if($row->where_should_we_look== "47") { ?> selected="selected" <?php } ?>>Colombia</option>
	<option value="48" <?php if($row->where_should_we_look== "48") { ?> selected="selected" <?php } ?>>Comoros</option>
	<option value="49" <?php if($row->where_should_we_look== "49") { ?> selected="selected" <?php } ?>>Congo</option>
	<option value="50" <?php if($row->where_should_we_look== "50") { ?> selected="selected" <?php } ?>>Cook Islands</option>
	<option value="51" <?php if($row->where_should_we_look== "51") { ?> selected="selected" <?php } ?>>Costa Rica</option>
	<option value="52" <?php if($row->where_should_we_look== "52") { ?> selected="selected" <?php } ?>>Cote D Ivoire</option>
	<option value="53" <?php if($row->where_should_we_look== "53") { ?> selected="selected" <?php } ?>>Croatia</option>
	<option value="54" <?php if($row->where_should_we_look== "54") { ?> selected="selected" <?php } ?>>Cuba</option>
	<option value="55" <?php if($row->where_should_we_look== "55") { ?> selected="selected" <?php } ?>>Cyprus</option>
	<option value="56" <?php if($row->where_should_we_look== "56") { ?> selected="selected" <?php } ?>>Czech Republic</option>
	<option value="57" <?php if($row->where_should_we_look== "57") { ?> selected="selected" <?php } ?>>Denmark</option>
	<option value="58" <?php if($row->where_should_we_look== "58") { ?> selected="selected" <?php } ?>>Djibouti</option>
	<option value="59" <?php if($row->where_should_we_look== "59") { ?> selected="selected" <?php } ?>>Dominica</option>
	<option value="60" <?php if($row->where_should_we_look== "60") { ?> selected="selected" <?php } ?>>Dominican Republic</option>
	<option value="63" <?php if($row->where_should_we_look== "63") { ?> selected="selected" <?php } ?>>Ecuador</option>
	<option value="61" <?php if($row->where_should_we_look== "61") { ?> selected="selected" <?php } ?>>Egypt</option>
	<option value="62" <?php if($row->where_should_we_look== "62") { ?> selected="selected" <?php } ?>>El Salvador</option>
	<option value="64" <?php if($row->where_should_we_look== "64") { ?> selected="selected" <?php } ?>>Equatorial Guinea</option>
	<option value="65" <?php if($row->where_should_we_look== "65") { ?> selected="selected" <?php } ?>>Eritrea</option>
	<option value="66" <?php if($row->where_should_we_look== "66") { ?> selected="selected" <?php } ?>>Estonia</option>
	<option value="67" <?php if($row->where_should_we_look== "67") { ?> selected="selected" <?php } ?>>Ethiopia</option>
	<option value="68" <?php if($row->where_should_we_look== "68") { ?> selected="selected" <?php } ?>>Falkland Islands</option>
	<option value="69" <?php if($row->where_should_we_look== "69") { ?> selected="selected" <?php } ?>>Faroe Islands</option>
	<option value="70" <?php if($row->where_should_we_look== "70") { ?> selected="selected" <?php } ?>>Federated States of Micronesia</option>
	<option value="71" <?php if($row->where_should_we_look== "71") { ?> selected="selected" <?php } ?>>Fiji</option>
	<option value="72" <?php if($row->where_should_we_look== "72") { ?> selected="selected" <?php } ?>>Finland</option>
	<option value="73" <?php if($row->where_should_we_look== "73") { ?> selected="selected" <?php } ?>>France</option>
	<option value="74" <?php if($row->where_should_we_look== "74") { ?> selected="selected" <?php } ?>>French Guiana</option>
	<option value="75" <?php if($row->where_should_we_look== "75") { ?> selected="selected" <?php } ?>>French Polynesia</option>
	<option value="76" <?php if($row->where_should_we_look== "76") { ?> selected="selected" <?php } ?>>Gabon</option>
	<option value="79" <?php if($row->where_should_we_look== "79") { ?> selected="selected" <?php } ?>>Georgia</option>
	<option value="80" <?php if($row->where_should_we_look== "80") { ?> selected="selected" <?php } ?>>Germany</option>
	<option value="81" <?php if($row->where_should_we_look== "81") { ?> selected="selected" <?php } ?>>Ghana</option>
	<option value="82" <?php if($row->where_should_we_look== "82") { ?> selected="selected" <?php } ?>>Gibralter</option>
	<option value="83" <?php if($row->where_should_we_look== "83") { ?> selected="selected" <?php } ?>>Greece</option>
	<option value="84" <?php if($row->where_should_we_look== "84") { ?> selected="selected" <?php } ?>>Greenland</option>
	<option value="85" <?php if($row->where_should_we_look== "85") { ?> selected="selected" <?php } ?>>Grenada</option>
	<option value="86" <?php if($row->where_should_we_look== "86") { ?> selected="selected" <?php } ?>>Guadeloupe</option>
	<option value="87" <?php if($row->where_should_we_look== "87") { ?> selected="selected" <?php } ?>>Guam</option>
	<option value="88" <?php if($row->where_should_we_look== "88") { ?> selected="selected" <?php } ?>>Guatemala</option>
	<option value="90" <?php if($row->where_should_we_look== "90") { ?> selected="selected" <?php } ?>>Guinea</option>
	<option value="91" <?php if($row->where_should_we_look== "91") { ?> selected="selected" <?php } ?>>Guinea Bissau</option>
	<option value="92" <?php if($row->where_should_we_look== "92") { ?> selected="selected" <?php } ?>>Guyana</option>
	<option value="93" <?php if($row->where_should_we_look== "93") { ?> selected="selected" <?php } ?>>Haiti</option>
	<option value="95" <?php if($row->where_should_we_look== "95") { ?> selected="selected" <?php } ?>>Honduras</option>
	<option value="96" <?php if($row->where_should_we_look== "96") { ?> selected="selected" <?php } ?>>Hong Kong</option>
	<option value="97" <?php if($row->where_should_we_look== "97") { ?> selected="selected" <?php } ?>>Hungary</option>
	<option value="98" <?php if($row->where_should_we_look== "98") { ?> selected="selected" <?php } ?>>Iceland</option>
	<option value="99" <?php if($row->where_should_we_look== "99") { ?> selected="selected" <?php } ?>>India</option>
	<option value="100" <?php if($row->where_should_we_look== "100") { ?> selected="selected" <?php } ?>>Indonesia</option>
	<option value="101" <?php if($row->where_should_we_look== "101") { ?> selected="selected" <?php } ?>>Iran</option>
	<option value="102" <?php if($row->where_should_we_look== "102") { ?> selected="selected" <?php } ?>>Iraq</option>
	<option value="103" <?php if($row->where_should_we_look== "103") { ?> selected="selected" <?php } ?>>Ireland</option>
	<option value="302" <?php if($row->where_should_we_look== "302") { ?> selected="selected" <?php } ?>>Isle of Man</option>
	<option value="104" <?php if($row->where_should_we_look== "104") { ?> selected="selected" <?php } ?>>Israel</option>
	<option value="105" <?php if($row->where_should_we_look== "105") { ?> selected="selected" <?php } ?>>Italy</option>
	<option value="106" <?php if($row->where_should_we_look== "106") { ?> selected="selected" <?php } ?>>Jamaica</option>
	<option value="109" <?php if($row->where_should_we_look== "109") { ?> selected="selected" <?php } ?>>Japan</option>
	<option value="110" <?php if($row->where_should_we_look== "110") { ?> selected="selected" <?php } ?>>Jordan</option>
	<option value="111" <?php if($row->where_should_we_look== "111") { ?> selected="selected" <?php } ?>>Kazakhstan</option>
	<option value="112" <?php if($row->where_should_we_look== "112") { ?> selected="selected" <?php } ?>>Kenya</option>
	<option value="113" <?php if($row->where_should_we_look== "113") { ?> selected="selected" <?php } ?>>Kiribati</option>
	<option value="114" <?php if($row->where_should_we_look== "114") { ?> selected="selected" <?php } ?>>Korea (Peoples Republic of)</option>
	<option value="115" <?php if($row->where_should_we_look== "115") { ?> selected="selected" <?php } ?>>Korea (Republic of)</option>
	<option value="116" <?php if($row->where_should_we_look== "116") { ?> selected="selected" <?php } ?>>Kuwait</option>
	<option value="304" <?php if($row->where_should_we_look== "304") { ?> selected="selected" <?php } ?>>Kyrgyzstan</option>
	<option value="117" <?php if($row->where_should_we_look== "117") { ?> selected="selected" <?php } ?>>Laos</option>
	<option value="118" <?php if($row->where_should_we_look== "118") { ?> selected="selected" <?php } ?>>Latvia</option>
	<option value="119" <?php if($row->where_should_we_look== "119") { ?> selected="selected" <?php } ?>>Lebanon</option>
	<option value="120" <?php if($row->where_should_we_look== "120") { ?> selected="selected" <?php } ?>>Lesotho</option>
	<option value="121" <?php if($row->where_should_we_look== "121") { ?> selected="selected" <?php } ?>>Liberia</option>
	<option value="305" <?php if($row->where_should_we_look== "305") { ?> selected="selected" <?php } ?>>Libya</option>
	<option value="123" <?php if($row->where_should_we_look== "123") { ?> selected="selected" <?php } ?>>Liechtenstein</option>
	<option value="124" <?php if($row->where_should_we_look== "124") { ?> selected="selected" <?php } ?>>Lithuania</option>
	<option value="125" <?php if($row->where_should_we_look== "125") { ?> selected="selected" <?php } ?>>Luxembourg</option>
	<option value="126" <?php if($row->where_should_we_look== "126") { ?> selected="selected" <?php } ?>>Macau</option>
	<option value="127" <?php if($row->where_should_we_look== "127") { ?> selected="selected" <?php } ?>>Macedonia</option>
	<option value="128" <?php if($row->where_should_we_look== "128") { ?> selected="selected" <?php } ?>>Madagascar</option>
	<option value="129" <?php if($row->where_should_we_look== "129") { ?> selected="selected" <?php } ?>>Malawi</option>
	<option value="130" <?php if($row->where_should_we_look== "130") { ?> selected="selected" <?php } ?>>Malaysia</option>
	<option value="131" <?php if($row->where_should_we_look== "131") { ?> selected="selected" <?php } ?>>Maldives</option>
	<option value="132" <?php if($row->where_should_we_look== "132") { ?> selected="selected" <?php } ?>>Mali</option>
	<option value="133" <?php if($row->where_should_we_look== "133") { ?> selected="selected" <?php } ?>>Malta</option>
	<option value="134" <?php if($row->where_should_we_look== "134") { ?> selected="selected" <?php } ?>>Marshall Islands</option>
	<option value="135" <?php if($row->where_should_we_look== "135") { ?> selected="selected" <?php } ?>>Martinique</option>
	<option value="136" <?php if($row->where_should_we_look== "136") { ?> selected="selected" <?php } ?>>Mauritius</option>
	<option value="137" <?php if($row->where_should_we_look== "137") { ?> selected="selected" <?php } ?>>Mayotte</option>
	<option value="138" <?php if($row->where_should_we_look== "138") { ?> selected="selected" <?php } ?>>Mexico</option>
	<option value="139" <?php if($row->where_should_we_look== "139") { ?> selected="selected" <?php } ?>>Moldova</option>
	<option value="140" <?php if($row->where_should_we_look== "140") { ?> selected="selected" <?php } ?>>Monaco</option>
	<option value="141" <?php if($row->where_should_we_look== "141") { ?> selected="selected" <?php } ?>>Mongolia</option>
	<option value="142" <?php if($row->where_should_we_look== "142") { ?> selected="selected" <?php } ?>>Montenegro</option>
	<option value="143" <?php if($row->where_should_we_look== "143") { ?> selected="selected" <?php } ?>>Montserrat</option>
	<option value="144" <?php if($row->where_should_we_look== "144") { ?> selected="selected" <?php } ?>>Morocco</option>
	<option value="145" <?php if($row->where_should_we_look== "145") { ?> selected="selected" <?php } ?>>Mozambique</option>
	<option value="146" <?php if($row->where_should_we_look== "146") { ?> selected="selected" <?php } ?>>Myanmar</option>
	<option value="147" <?php if($row->where_should_we_look== "147") { ?> selected="selected" <?php } ?>>Namibia</option>
	<option value="148" <?php if($row->where_should_we_look== "148") { ?> selected="selected" <?php } ?>>Nauru</option>
	<option value="149" <?php if($row->where_should_we_look== "149") { ?> selected="selected" <?php } ?>>Nepal</option>
	<option value="150" <?php if($row->where_should_we_look== "150") { ?> selected="selected" <?php } ?>>Netherlands</option>
	<option value="151" <?php if($row->where_should_we_look== "151") { ?> selected="selected" <?php } ?>>Netherlands Antilles</option>
	<option value="152" <?php if($row->where_should_we_look== "152") { ?> selected="selected" <?php } ?>>New Caledonia</option>
	<option value="153" <?php if($row->where_should_we_look== "153") { ?> selected="selected" <?php } ?>>New Zealand</option>
	<option value="154" <?php if($row->where_should_we_look== "154") { ?> selected="selected" <?php } ?>>Nicaragua</option>
	<option value="155" <?php if($row->where_should_we_look== "155") { ?> selected="selected" <?php } ?>>Niger</option>
	<option value="156" <?php if($row->where_should_we_look== "156") { ?> selected="selected" <?php } ?>>Nigeria</option>
	<option value="157" <?php if($row->where_should_we_look== "157") { ?> selected="selected" <?php } ?>>Niue</option>
	<option value="158" <?php if($row->where_should_we_look== "158") { ?> selected="selected" <?php } ?>>Norfolk Island</option>
	<option value="160" <?php if($row->where_should_we_look== "160") { ?> selected="selected" <?php } ?>>Northern Mariana Islands</option>
	<option value="161" <?php if($row->where_should_we_look== "161") { ?> selected="selected" <?php } ?>>Norway</option>
	<option value="162" <?php if($row->where_should_we_look== "162") { ?> selected="selected" <?php } ?>>Oman</option>
	<option value="163" <?php if($row->where_should_we_look== "163") { ?> selected="selected" <?php } ?>>Pakistan</option>
	<option value="164" <?php if($row->where_should_we_look== "164") { ?> selected="selected" <?php } ?>>Palau</option>
	<option value="165" <?php if($row->where_should_we_look== "165") { ?> selected="selected" <?php } ?>>Panama</option>
	<option value="166" <?php if($row->where_should_we_look== "166") { ?> selected="selected" <?php } ?>>Papua New Guinea</option>
	<option value="167" <?php if($row->where_should_we_look== "167") { ?> selected="selected" <?php } ?>>Paraguay</option>
	<option value="168" <?php if($row->where_should_we_look== "168") { ?> selected="selected" <?php } ?>>Peru</option>
	<option value="169" <?php if($row->where_should_we_look== "169") { ?> selected="selected" <?php } ?>>Philippines</option>
	<option value="170" <?php if($row->where_should_we_look== "170") { ?> selected="selected" <?php } ?>>Pitcairn</option>
	<option value="171" <?php if($row->where_should_we_look== "171") { ?> selected="selected" <?php } ?>>Poland</option>
	<option value="172" <?php if($row->where_should_we_look== "172") { ?> selected="selected" <?php } ?>>Portugal</option>
	<option value="173" <?php if($row->where_should_we_look== "173") { ?> selected="selected" <?php } ?>>Puerto Rico</option>
	<option value="174" <?php if($row->where_should_we_look== "174") { ?> selected="selected" <?php } ?>>Qatar</option>
	<option value="175" <?php if($row->where_should_we_look== "175") { ?> selected="selected" <?php } ?>>Reunion</option>
	<option value="176" <?php if($row->where_should_we_look== "176") { ?> selected="selected" <?php } ?>>Romania</option>
	<option value="177" <?php if($row->where_should_we_look== "177") { ?> selected="selected" <?php } ?>>Russian Federation</option>
	<option value="178" <?php if($row->where_should_we_look== "178") { ?> selected="selected" <?php } ?>>Rwanda</option>
	<option value="179" <?php if($row->where_should_we_look== "179") { ?> selected="selected" <?php } ?>>Saint Vincent and the Grenadines</option>
	<option value="180" <?php if($row->where_should_we_look== "180") { ?> selected="selected" <?php } ?>>San Marino</option>
	<option value="181" <?php if($row->where_should_we_look== "181") { ?> selected="selected" <?php } ?>>Sao Tome and Principe</option>
	<option value="182" <?php if($row->where_should_we_look== "182") { ?> selected="selected" <?php } ?>>Saudi Arabia</option>
	<option value="183" <?php if($row->where_should_we_look== "183") { ?> selected="selected" <?php } ?>>Senegal</option>
	<option value="184" <?php if($row->where_should_we_look== "184") { ?> selected="selected" <?php } ?>>Serbia</option>
	<option value="185" <?php if($row->where_should_we_look== "185") { ?> selected="selected" <?php } ?>>Seychelles</option>
	<option value="186" <?php if($row->where_should_we_look== "186") { ?> selected="selected" <?php } ?>>Sierra Leone</option>
	<option value="187" <?php if($row->where_should_we_look== "187") { ?> selected="selected" <?php } ?>>Singapore</option>
	<option value="189" <?php if($row->where_should_we_look== "189") { ?> selected="selected" <?php } ?>>Slovakia</option>
	<option value="190" <?php if($row->where_should_we_look== "190") { ?> selected="selected" <?php } ?>>Slovenia</option>
	<option value="191" <?php if($row->where_should_we_look== "191") { ?> selected="selected" <?php } ?>>Solomon Islands</option>
	<option value="192" <?php if($row->where_should_we_look== "192") { ?> selected="selected" <?php } ?>>Somalia</option>
	<option value="193" <?php if($row->where_should_we_look== "193") { ?> selected="selected" <?php } ?>>South Africa</option>
	<option value="194" <?php if($row->where_should_we_look== "194") { ?> selected="selected" <?php } ?>>South Georgia</option>
	<option value="196" <?php if($row->where_should_we_look== "196") { ?> selected="selected" <?php } ?>>Spain</option>
	<option value="188" <?php if($row->where_should_we_look== "188") { ?> selected="selected" <?php } ?>>Sri Lanka</option>
	<option value="198" <?php if($row->where_should_we_look== "198") { ?> selected="selected" <?php } ?>>St. Kitts and Nevis</option>
	<option value="199" <?php if($row->where_should_we_look== "199") { ?> selected="selected" <?php } ?>>St. Lucia</option>
	<option value="307" <?php if($row->where_should_we_look== "307") { ?> selected="selected" <?php } ?>>St. Pierre and Miquelon</option>
	<option value="200" <?php if($row->where_should_we_look== "200") { ?> selected="selected" <?php } ?>>Sudan</option>
	<option value="201" <?php if($row->where_should_we_look== "201") { ?> selected="selected" <?php } ?>>Suriname</option>
	<option value="203" <?php if($row->where_should_we_look== "203") { ?> selected="selected" <?php } ?>>Swaziland</option>
	
	<option value="204" <?php if($row->where_should_we_look== "204") { ?> selected="selected" <?php } ?>>Sweden</option>
	<option value="205" <?php if($row->where_should_we_look== "205") { ?> selected="selected" <?php } ?>>Switzerland</option>
	<option value="206" <?php if($row->where_should_we_look== "206") { ?> selected="selected" <?php } ?>>Syrian Arab Republic</option>
	<option value="209" <?php if($row->where_should_we_look== "209") { ?> selected="selected" <?php } ?>>Taiwan</option>
	<option value="207" <?php if($row->where_should_we_look== "207") { ?> selected="selected" <?php } ?>>Tajikistan</option>
	<option value="208" <?php if($row->where_should_we_look== "208") { ?> selected="selected" <?php } ?>>Tanzania</option>
	<option value="210" <?php if($row->where_should_we_look== "210") { ?> selected="selected" <?php } ?>>Thailand</option>
	<option value="77" <?php if($row->where_should_we_look== "77") { ?> selected="selected" <?php } ?>>The Gambia</option>
	<option value="211" <?php if($row->where_should_we_look== "211") { ?> selected="selected" <?php } ?>>Togo</option>
	<option value="212" <?php if($row->where_should_we_look== "212") { ?> selected="selected" <?php } ?>>Tokelau</option>
	<option value="213" <?php if($row->where_should_we_look== "213") { ?> selected="selected" <?php } ?>>Tonga</option>
	<option value="214" <?php if($row->where_should_we_look== "214") { ?> selected="selected" <?php } ?>>Trinidad and Tobago</option>
	<option value="216" <?php if($row->where_should_we_look== "216") { ?> selected="selected" <?php } ?>>Tunisia</option>
	<option value="217" <?php if($row->where_should_we_look== "217") { ?> selected="selected" <?php } ?>>Turkey</option>
	<option value="218" <?php if($row->where_should_we_look== "218") { ?> selected="selected" <?php } ?>>Turkmenistan</option>
	<option value="219" <?php if($row->where_should_we_look== "219") { ?> selected="selected" <?php } ?>>Turks and Caicos Islands</option>
	<option value="220" <?php if($row->where_should_we_look== "220") { ?> selected="selected" <?php } ?>>Tuvalu</option>
	<option value="221" <?php if($row->where_should_we_look== "221") { ?> selected="selected" <?php } ?>>Uganda</option>
	<option value="222" <?php if($row->where_should_we_look== "222") { ?> selected="selected" <?php } ?>>Ukraine</option>
	<option value="223" <?php if($row->where_should_we_look== "223") { ?> selected="selected" <?php } ?>>United Arab Emirates</option>
	<option value="225" <?php if($row->where_should_we_look== "225") { ?> selected="selected" <?php } ?>>Uruguay</option>
	<option value="226" <?php if($row->where_should_we_look== "226") { ?> selected="selected" <?php } ?>>Uzbekistan</option>
	<option value="227" <?php if($row->where_should_we_look== "227") { ?> selected="selected" <?php } ?>>Vanuatu</option>
	<option value="228" <?php if($row->where_should_we_look== "228") { ?> selected="selected" <?php } ?>>Venezuela</option>
	<option value="229" <?php if($row->where_should_we_look== "229") { ?> selected="selected" <?php } ?>>Viet Nam</option>
	<option value="230" <?php if($row->where_should_we_look== "230") { ?> selected="selected" <?php } ?>>Virgin Islands (U.K.)</option>
	<option value="231" <?php if($row->where_should_we_look== "231") { ?> selected="selected" <?php } ?>>Virgin Islands (U.S.)</option>
	<option value="232" <?php if($row->where_should_we_look== "232") { ?> selected="selected" <?php } ?>>Wallis and Futuna Islands</option>
	<option value="235" <?php if($row->where_should_we_look== "235") { ?> selected="selected" <?php } ?>>Western Samoa</option>
	<option value="236" <?php if($row->where_should_we_look== "236") { ?> selected="selected" <?php } ?>>Yemen</option>
	<option value="237" <?php if($row->where_should_we_look== "237") { ?> selected="selected" <?php } ?>>Yugoslavia</option>
	<option value="238" <?php if($row->where_should_we_look== "238") { ?> selected="selected" <?php } ?>>Zaire</option>
	<option value="239" <?php if($row->where_should_we_look== "239") { ?> selected="selected" <?php } ?>>Zambia</option>
	<option value="240" <?php if($row->where_should_we_look== "240") { ?> selected="selected" <?php } ?>>Zimbabwe</option>
	</select>
	</div>
	</li>
	
	<li>
	<label class="out">
	How tall are you?
	</label>
	<div>
	<select name="how_tall_are_you[]" class="field_select_small" tabindex="15"> 
	<?php
	for($i=3; $i<=8; $i++)
	{
		?><option value="<?php echo''.$i.'';?>" <?php if($how_tall_are_you[0]== $i) { ?> selected="selected" <?php } ?>><?php echo''.$i.'';?></option><?php
	}
	?>
	</select>
	feet
	
	<select name="how_tall_are_you[]" class="field_select_small" tabindex="15"> 
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
	
	<li>
	<label class="out" for="your_body_type">
	Which best describes your body type?
	</label>
	<div>
	<select id="your_body_type" name="your_body_type" class="field_select_medium" tabindex="15">
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
	
	<li>
	<label class="out" for="your_sign">
	What's your sign?
	</label>
	<div>
	<select id="your_sign" name="your_sign" class="field_select_medium" tabindex="15">
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

    
	<li>
        <label class="out" for="where_is_your_home_town">
            Where is your home town?
        </label>
	<div>
    
    <select id="where_is_your_home_town" name="where_is_your_home_town" class="field_select_medium" tabindex="15"> 
<?php

        $q2 = "SELECT * FROM `_country`";
        $c1->query($q2);		
        
        if($rec=$c1->fetchAll())
        {  
            foreach ($rec as &$value)
            {
                ?><option value="<?php echo''.$value[id].'';?>" <?php if($row->where_is_your_home_town == $value[id]) { ?> selected="selected" <?php } ?>><?php echo''.$value[country].'';?></option><?php
            }
        }
?>
    </select>    
	</div>
	</li>
	
	<li>
        <label class="out">
        	Tell us about your brothers or sisters. Are you:
        </label>
        <input id="the_only_child" name="do_you_have_any_brothers_or_sisters" class="field_checkbox" value="the only child" tabindex="13" type="radio" <?php if($row->do_you_have_any_brothers_or_sisters== "the only child") { ?> checked="checked" <?php } ?>/>
        <label class="choice" for="the_only_child">the only child</label>
        
        <input id="the_middle" name="do_you_have_any_brothers_or_sisters" class="field_checkbox" value="the middle" tabindex="13" type="radio" <?php if($row->do_you_have_any_brothers_or_sisters== "the middle") { ?> checked="checked" <?php } ?>/>
        <label class="choice" for="the_middle">the middle</label>
        
        <input id="from_a_large_family" name="do_you_have_any_brothers_or_sisters" class="field_checkbox" value="from a large family" tabindex="13" type="radio" <?php if($row->do_you_have_any_brothers_or_sisters== "from a large family") { ?> checked="checked" <?php } ?>/>
        <label class="choice" for="from_a_large_family">from a large family</label>
        
        <input id="the_oldest" name="do_you_have_any_brothers_or_sisters" class="field_checkbox" value="the oldest" tabindex="13" type="radio" <?php if($row->do_you_have_any_brothers_or_sisters== "the oldest") { ?> checked="checked" <?php } ?>/>
        <label class="choice" for="the_oldest">the oldest</label>
        
        <input id="the_youngest" name="do_you_have_any_brothers_or_sisters" class="field_checkbox" value="the youngest" tabindex="13" type="radio" <?php if($row->do_you_have_any_brothers_or_sisters== "the youngest") { ?> checked="checked" <?php } ?>/>
        <label class="choice" for="the_youngest">the youngest</label>
	</li>
		
	<li>
        <label class="out">
        Are you an early bird or night owl?
        </label>
        <input id="early_bird" name="you_an_early_bird_or_night_owl" class="field_checkbox" value="early bird" tabindex="13" type="radio" <?php if($row->you_an_early_bird_or_night_owl== "early bird") { ?> checked="checked" <?php } ?>/>
        <label class="choice" for="early_bird">early bird</label>
        
        <input id="neither" name="you_an_early_bird_or_night_owl" class="field_checkbox" value="neither" tabindex="13" type="radio" <?php if($row->you_an_early_bird_or_night_owl== "neither") { ?> checked="checked" <?php } ?>/>
        <label class="choice" for="neither">neither</label>
        
        <input id="night_owl" name="you_an_early_bird_or_night_owl" class="field_checkbox" value="night owl" tabindex="13" type="radio" <?php if($row->you_an_early_bird_or_night_owl== "night owl") { ?> checked="checked" <?php } ?>/>
        <label class="choice" for="night_owl">night owl</label>    
	</li>
	
	
	<li>
	<label class="out">
		Do you sing or play a musical instrument?
	</label>
	<input id="sing" name="do_you_play_a_musical_instrument[]" class="field_checkbox" value="sing" tabindex="13" type="checkbox" <?php if(in_array("sing", $do_you_play_a_musical_instrument)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="sing">sing</label>
	
	<input id="jazz_band" name="do_you_play_a_musical_instrument[]" class="field_checkbox" value="jazz band" tabindex="13" type="checkbox" <?php if(in_array("jazz band", $do_you_play_a_musical_instrument)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="jazz_band">jazz band</label>
	
	<input id="string_quartet" name="do_you_play_a_musical_instrument[]" class="field_checkbox" value="string quartet" tabindex="13" type="checkbox" <?php if(in_array("string quartet", $do_you_play_a_musical_instrument)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="string_quartet">string quartet</label>
	
	<input id="other" name="do_you_play_a_musical_instrument[]" class="field_checkbox" value="other" tabindex="13" type="checkbox" <?php if(in_array("other", $do_you_play_a_musical_instrument)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="other">other</label>
    

	<input id="rock_band" name="do_you_play_a_musical_instrument[]" class="field_checkbox" value="rock band" tabindex="13" type="checkbox" <?php if(in_array("rock band", $do_you_play_a_musical_instrument)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="rock_band">rock band</label>
	
	<input id="orchestra" name="do_you_play_a_musical_instrument[]" class="field_checkbox" value="orchestra" tabindex="13" type="checkbox" <?php if(in_array("orchestra", $do_you_play_a_musical_instrument)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="orchestra">orchestra</label>
	
	
	<input id="would_love_to_learn" name="do_you_play_a_musical_instrument[]" class="field_checkbox" value="would love to learn" tabindex="13" type="checkbox" <?php if(in_array("would love to learn", $do_you_play_a_musical_instrument)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="would_love_to_learn">would love to learn</label>
	</li>	
	
	<li>
	<label class="out" for="what_is_your_favourite_colour">
	What is your favourite colour?
	</label>
	<div>
	<select id="what_is_your_favourite_colour" name="what_is_your_favourite_colour" class="field_select_medium" tabindex="15">
	<option value="NoAnswer" <?php if($row->what_is_your_favourite_colour== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="430" <?php if($row->what_is_your_favourite_colour== "430") { ?> selected="selected" <?php } ?>>black</option>
	<option value="431" <?php if($row->what_is_your_favourite_colour== "431") { ?> selected="selected" <?php } ?>>blue</option>
	<option value="432" <?php if($row->what_is_your_favourite_colour== "432") { ?> selected="selected" <?php } ?>>brown</option>
	<option value="439" <?php if($row->what_is_your_favourite_colour== "439") { ?> selected="selected" <?php } ?>>gray</option>
	<option value="433" <?php if($row->what_is_your_favourite_colour== "433") { ?> selected="selected" <?php } ?>>green</option>
	<option value="434" <?php if($row->what_is_your_favourite_colour== "434") { ?> selected="selected" <?php } ?>>orange</option>
	<option value="438" <?php if($row->what_is_your_favourite_colour== "438") { ?> selected="selected" <?php } ?>>pink</option>
	<option value="436" <?php if($row->what_is_your_favourite_colour== "436") { ?> selected="selected" <?php } ?>>purple</option>
	<option value="435" <?php if($row->what_is_your_favourite_colour== "435") { ?> selected="selected" <?php } ?>>red</option>
	<option value="440" <?php if($row->what_is_your_favourite_colour== "440") { ?> selected="selected" <?php } ?>>white</option>
	<option value="437" <?php if($row->what_is_your_favourite_colour== "437") { ?> selected="selected" <?php } ?>>yellow</option>
	</select>
	</div>
	</li>
    <li>
    <input type="hidden" name="todo" value="bio"/>
    <input type="hidden" name="e" value="bio"/>
	<input type="image" name="submit" value="Submit" class="field_submit" src="../graphics/login.jpg"/>
	</li>	
	</ul>
	</form>
	
	<?php
	}//end of else
	?></div><?php
	
	/*Express*/			
			
			break;
		default:
			?><div class="info">
			<h4>Error</h4>An error has occured, it appears you have selected a non-existant option
            </div><?php
			
			?>		
				<?php $return_url = "browsing.php"; ?>	
				<script type="text/javascript">
					setTimeout('delayer("<?php echo''.$return_url.'';?>")', 2000);
				</script>								
			<?php			
			break;
	}


}
else
{
			?><div class="info">
			<h4>Error</h4>Sorry you can not view this page unless you are logged in
			</div><?php

			?>		
				<?php $return_url = "browsing.php"; ?>	
				<script type="text/javascript">
					setTimeout('delayer("<?php echo''.$return_url.'';?>")', 2000);
				</script>								
			<?php
}
?>    
            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

