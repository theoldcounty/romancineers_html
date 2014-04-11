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
		
			$c1->query("SELECT * FROM appearance WHERE id=$row->id");  
		
			if(!$c1->getNumRows())
			{		
				if($c1->query("INSERT INTO `appearance` ( `id` , `your_eye_colour` , `colour_is_your_hair` , `body_art` , `your_best_feature`, `last_updated` )
VALUES ('$row->id', '$your_eye_colour', '$colour_is_your_hair', '$body_art', '$your_best_feature', '$current_time')"))
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
			
				if($c1->query("UPDATE `appearance` 
				SET `your_eye_colour` = '$your_eye_colour', 
				`colour_is_your_hair` = '$colour_is_your_hair' , 
				`body_art` = '$body_art',
				`your_best_feature` = '$your_best_feature'							 
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
	<h2>Appearance</h2>
	</div>

	<?php
	$body_art = explode(",", $row->body_art);
	?>    
	
	<ul>
	<li id="decfie2" class="">
		<label class="desc" id="title14" for="Field14">
		What best describes your eye colour?
		</label>
		<div>
		<select id="Field14" name="your_eye_colour" class="field select medium" tabindex="15"> 
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
	
	
	
	
	<li id="decfie2" class="">
		<label class="desc" id="title14" for="Field14">
		What colour is your hair?
		</label>
		<div>
		<select id="Field14" name="colour_is_your_hair" class="field select medium" tabindex="15"> 
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
	
	
	<li id="fo56li15" class="">
		<label class="desc" id="title0" for="Field0">
		Body art?
		<span id="req_0" class="req">*</span>
		</label>
		<div class="column1">
			<input id="Field15" name="body_art[]" class="field checkbox" value="Strategically placed tattoo" tabindex="13" type="checkbox" <?php if(in_array("Strategically placed tattoo", $body_art)) { ?>checked="checked"<?php } ?>/>
			<label class="choice" for="Field15">Strategically placed tattoo</label>
            
			<input id="Field15" name="body_art[]" class="field checkbox" value="Pierced ear" tabindex="13" type="checkbox" <?php if(in_array("Pierced ear", $body_art)) { ?>checked="checked"<?php } ?>/>
			<label class="choice" for="Field15">Pierced ear(s)</label>    
            
			<input id="Field15" name="body_art[]" class="field checkbox" value="None" tabindex="13" type="checkbox" <?php if(in_array("None", $body_art)) { ?>checked="checked"<?php } ?>/>
			<label class="choice" for="Field15">None</label>
		</div>
		
		<div class="column2">
			<input id="Field15" name="body_art[]" class="field checkbox" value="Visible tattoo" tabindex="13" type="checkbox" <?php if(in_array("Visible tattoo", $body_art)) { ?>checked="checked"<?php } ?>/>
			<label class="choice" for="Field15">Visible tattoo</label>  
              
			<input id="Field15" name="body_art[]" class="field checkbox" value="Belly button ring" tabindex="13" type="checkbox" <?php if(in_array("Belly button ring", $body_art)) { ?>checked="checked"<?php } ?>/>
			<label class="choice" for="Field15">Belly button ring</label>    
            
			<input id="Field15" name="body_art[]" class="field checkbox" value="No Answer" tabindex="13" type="checkbox" <?php if(in_array("No Answer", $body_art)) { ?>checked="checked"<?php } ?>/>
			<label class="choice" for="Field15">No Answer</label>
		</div>
		<div class="clr"></div>
	</li>
	
	
	<li id="decfie2" class="">
		<label class="desc" id="title14" for="Field14">
		Brag a little: What's your best feature?
		</label>
		<div>
		<select id="Field14" name="your_best_feature" class="field select medium" tabindex="15"> 
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

