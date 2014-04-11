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
	$what_do_you_do_for_fun=$_REQUEST[what_do_you_do_for_fun];
	$local_hot_spots=$_REQUEST[local_hot_spots];
	$favourite_things=$_REQUEST[favourite_things];
	$favourite_book=$_REQUEST[favourite_book];
	$exercise=$_REQUEST[exercise];
	$interests=$_REQUEST[interests];
	
	if(!get_magic_quotes_gpc())
	{
		$todo=mysql_real_escape_string($todo);
		$what_do_you_do_for_fun=mysql_real_escape_string($what_do_you_do_for_fun);
		$local_hot_spots=mysql_real_escape_string($local_hot_spots);
		$favourite_things=mysql_real_escape_string($favourite_things);
		$favourite_book=mysql_real_escape_string($favourite_book);
		$exercise=mysql_real_escape_string($exercise);
		$interests=mysql_real_escape_string($interests);			
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
		SELECT signup.id, signup.userid, interests.what_do_you_do_for_fun, interests.local_hot_spots, interests.favourite_things, interests.favourite_book, interests.sports_and_exercise, interests.common_interests
		FROM signup
		LEFT JOIN interests
		ON signup.id = interests.id WHERE signup.userid='$_SESSION[userid]'");  
	
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
		
			$c1->query("SELECT * FROM interests WHERE id=$row->id");  
		
			if(!$c1->getNumRows())
			{		
				if($c1->query("INSERT INTO `interests` (`id`, `what_do_you_do_for_fun` , `local_hot_spots` , `favourite_things`, `favourite_book` ,`sports_and_exercise` ,`common_interests` , `last_updated` )
				VALUES ('$row->id', '$what_do_you_do_for_fun', '$local_hot_spots', '$favourite_things', '$favourite_book', '$exercise','$interests', '$current_time')"))
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
				if($c1->query("UPDATE interests 
				SET 
				what_do_you_do_for_fun='$what_do_you_do_for_fun',
				local_hot_spots='$local_hot_spots',
				favourite_things='$favourite_things',
				favourite_book='$favourite_book',
				sports_and_exercise='$exercise',
				common_interests='$interests'												 
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
	<h2>Interests</h2>
	</div>
	
	<ul>
	<li id="fo59li1" class="altInstruct">
		<label class="desc" id="title1" for="Field1">
		What do you do for fun?
		<span id="req_1" class="req">*</span>
		<p>Here's a great opportunity to get noticed. But remember, it's all in the details. What's your favourite genre? Who's your favourite actor? Enjoy having popcorn and a soft drink in the back row at the theatre, or watching a DVD at home, all comfy in your pyjamas? Any unusual hobbies or interests? Don't be shy. The more information people know about you, the better odds of finding your match.</p>
		</label>
		<div>
		<textarea id="Field1" name="what_do_you_do_for_fun" class="field textarea medium" rows="10" cols="50" tabindex="2"><?php echo''.$row->what_do_you_do_for_fun.'';?></textarea>
		</div>
		<p class="instruct" id="instruct1"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>
	
	<li id="fo59li1" class="altInstruct">
		<label class="desc" id="title1" for="Field1">
		Favourite local hot spots or travel destinations?
		<span id="req_1" class="req">*</span>
		<p>Once you find your match, where would you want to take her? Where's your favourite place to eat? Do you like going to wild and crazy bars or small and cosy coffee shops? Where was your favourite place to visit on a holiday? Where have you always wanted to go, but never have?</p>
		</label>
		<div>
		<textarea id="Field1" name="local_hot_spots" class="field textarea medium" rows="10" cols="50" tabindex="2"><?php echo''.$row->local_hot_spots.'';?></textarea>
		</div>
		<p class="instruct" id="instruct1"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>
	
	
	<li id="fo59li1" class="altInstruct">
		<label class="desc" id="title1" for="Field1">
		Favourite things?
		<span id="req_1" class="req">*</span>
		<p>Everyone has their favourite things. What's your favourite thing to eat? Favourite colour? Favourite thing to do when it's raining outside? Where do you like to go shopping? Tell us your favourite books, TV shows, foods, clothes, music and more.</p>
		</label>
		<div>
		<textarea id="Field1" name="favourite_things" class="field textarea medium" rows="10" cols="50" tabindex="2"><?php echo''.$row->favourite_things.'';?></textarea>
		</div>
		<p class="instruct" id="instruct1"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>
	
	
	<li id="fo59li1" class="altInstruct">
		<label class="desc" id="title1" for="Field1">
		What is your favourite book?
		<span id="req_1" class="req">*</span>
		<p>Whether it's a love-story or a thriller, biography or a classic - tell us about a favourite literary adventure. </p>
		</label>
		<div>
		<textarea id="Field1" name="favourite_book" class="field textarea medium" rows="10" cols="50" tabindex="2"><?php echo''.$row->favourite_book.'';?></textarea>
		</div>
		<p class="instruct" id="instruct1"><small>Please be as specific as
		possible. Basically, tell us what steps we need to take to create the
		bug, what you expected to happen and what actually happened.</small></p>
	</li>
	
	
	<?php
	$common_interests = explode(",", $row->common_interests);
	$sports_and_exercise = explode(",", $row->sports_and_exercise);
	?>
	
	
	<li id="fo56li15" class="">
	<label class="desc" id="title0" for="Field0">
	What kinds of sports and exercise do you enjoy?
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
		<input id="Field15" name="exercise[]" class="field checkbox" value="Aerobics" tabindex="13" type="checkbox" <?php if(in_array("Aerobics", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Aerobics</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Baseball" tabindex="13" type="checkbox"<?php if(in_array("Baseball", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Baseball</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Billiards" tabindex="13" type="checkbox"<?php if(in_array("Billiards", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Billiards/Pool</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Cycling" tabindex="13" type="checkbox"<?php if(in_array("Cycling", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Cycling</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Golf" tabindex="13" type="checkbox"<?php if(in_array("Golf", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Golf</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Inline skating" tabindex="13" type="checkbox"<?php if(in_array("Inline skating", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Inline skating</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Running	Skiing" tabindex="13" type="checkbox"<?php if(in_array("Running	Skiing", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Running	Skiing</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Soccer" tabindex="13" type="checkbox"<?php if(in_array("Soccer", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Soccer</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Tennis" tabindex="13" type="checkbox"<?php if(in_array("Tennis", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Tennis/Racquet sports</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Weights" tabindex="13" type="checkbox"<?php if(in_array("Weights", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Weights/Machines</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Other types of exercise" tabindex="13" type="checkbox"<?php if(in_array("Other types of exercise", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Other types of exercise</label>
	</div>
	
	<div class="column2">
		<input id="Field15" name="exercise[]" class="field checkbox" value="Auto racing" tabindex="13" type="checkbox"<?php if(in_array("Auto racing", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Auto racing/Motorcross</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Basketball" tabindex="13" type="checkbox"<?php if(in_array("Basketball", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Basketball</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Bowling" tabindex="13" type="checkbox"<?php if(in_array("Bowling", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Bowling</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Football" tabindex="13" type="checkbox"<?php if(in_array("Football", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Football</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Dancing" tabindex="13" type="checkbox"<?php if(in_array("Dancing", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Dancing</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Martial arts" tabindex="13" type="checkbox"<?php if(in_array("Martial arts", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Martial arts</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Swimming" tabindex="13" type="checkbox"<?php if(in_array("Swimming", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Swimming</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Walking" tabindex="13" type="checkbox"<?php if(in_array("Walking", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Walking/Hiking</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Yoga" tabindex="13" type="checkbox"<?php if(in_array("Yoga", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Yoga</label>
		
		<input id="Field15" name="exercise[]" class="field checkbox" value="Hockey" tabindex="13" type="checkbox"<?php if(in_array("Hockey", $sports_and_exercise)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Hockey</label>
	
	</div>
	<div class="clr"></div>
	</li>
	
	
	
	<li id="fo56li15" class="">
	<label class="desc" id="title0" for="Field0">
	What common interests would you like to share with other members?
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
		<input id="Field15" name="interests[]" class="field checkbox" value="University Friends" tabindex="13" type="checkbox" <?php if(in_array("University Friends", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">University Friends</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Camping" tabindex="13" type="checkbox"<?php if(in_array("Camping", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Camping</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Business networking" tabindex="13" type="checkbox"<?php if(in_array("Business networking", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Business networking</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Dining out" tabindex="13" type="checkbox"<?php if(in_array("Dining out", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Dining out</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Gardening" tabindex="13" type="checkbox"<?php if(in_array("Gardening", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Gardening/Landscaping</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Movies" tabindex="13" type="checkbox"<?php if(in_array("Movies", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Movies/Videos</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Music and concerts" tabindex="13" type="checkbox"<?php if(in_array("Music and concerts", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Music and concerts</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Nightclubs" tabindex="13" type="checkbox"<?php if(in_array("Nightclubs", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Nightclubs/Dancing</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Playing cards" tabindex="13" type="checkbox"<?php if(in_array("Playing cards", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Playing cards</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Political interests" tabindex="13" type="checkbox"<?php if(in_array("Political interests", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Political interests</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Shopping" tabindex="13" type="checkbox"<?php if(in_array("Shopping", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Shopping/Antiques</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Video games" tabindex="13" type="checkbox"<?php if(in_array("Video games", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Video games</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Watching sports" tabindex="13" type="checkbox"<?php if(in_array("Watching sports", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Watching sports</label>
	</div>
	
	<div class="column2">
		<input id="Field15" name="interests[]" class="field checkbox" value="Book club" tabindex="13" type="checkbox"<?php if(in_array("Book club", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Book club/Discussion</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Coffee and conversation" tabindex="13" type="checkbox"<?php if(in_array("Coffee and conversation", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Coffee and conversation</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Cooking" tabindex="13" type="checkbox"<?php if(in_array("Cooking", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Cooking</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Fishing" tabindex="13" type="checkbox"<?php if(in_array("Fishing", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Fishing/Hunting</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Hobbies and crafts" tabindex="13" type="checkbox"<?php if(in_array("Hobbies and crafts", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Hobbies and crafts</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Museums and art" tabindex="13" type="checkbox"<?php if(in_array("Museums and art", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Museums and art</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="New to the area" tabindex="13" type="checkbox"<?php if(in_array("New to the area", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">New to the area</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Performing arts" tabindex="13" type="checkbox"<?php if(in_array("Performing arts", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Performing arts</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Playing sports" tabindex="13" type="checkbox"<?php if(in_array("Playing sports", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Playing sports</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Religion" tabindex="13" type="checkbox"<?php if(in_array("Religion", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Religion</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Travel" tabindex="13" type="checkbox"<?php if(in_array("Travel", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Travel</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Volunteering" tabindex="13" type="checkbox"<?php if(in_array("Volunteering", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Volunteering</label>
		
		<input id="Field15" name="interests[]" class="field checkbox" value="Wine tasting" tabindex="13" type="checkbox"<?php if(in_array("Wine tasting", $common_interests)) { ?>checked="checked"<?php } ?>/>
		<label class="choice" for="Field15">Wine tasting</label>
	</div>
	<div class="clr"></div>
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

