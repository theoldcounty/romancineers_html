<?php
include "session.php";
require_once('includes/database.php');
error_reporting (E_ALL ^ E_NOTICE);
$current_date = date("Y-m-d H:i:s");
$current_page = $_SERVER['REQUEST_URI'];
//connection1 object


if(ereg("about_date", $current_page)) 
{ 
	$submit = $_REQUEST[submit];
	if(!empty($submit))
	{
		header('Location: edit.php?e=about_date');
	}
}


//functions
	function getHomeCountry($id)
	{
			global $c1;
			$q2 = "SELECT * FROM `_country` WHERE `id` =$id";
			$c1->query($q2);	
			
			if($rec=$c1->fetchAll())
			{  
				foreach ($rec as &$value)
				{
					$country = $value[country];
				}
			}			
			return $country;									
	}

//functions

/** Profile **/
$profile_id = $_REQUEST[id];
if(!get_magic_quotes_gpc()) { $profile_id=mysql_real_escape_string($profile_id); }	


if(!empty($profile_id ))
{
	
	$c1->query("
	SELECT *
	FROM signup
	LEFT JOIN bio ON signup.id = bio.id
	LEFT JOIN appearance ON signup.id = appearance.id
	LEFT JOIN background ON signup.id = background.id
	LEFT JOIN intro ON signup.id = intro.id
	LEFT JOIN interests ON signup.id = interests.id
	LEFT JOIN lifestyle ON signup.id = lifestyle.id
	LEFT JOIN login ON signup.userid = login.userid
	WHERE signup.id =$profile_id");  
	
	//scan results and pull out array
	if($rec=$c1->fetchAll())
	{  
		//foreach
		foreach ($rec as &$value)
		{
			//relationship_status
			$relationship_status = $value[relationship_status];
			switch ($relationship_status) {
				case 221:
					$relationship_status = "Never Married";
					break;
				case 223:
					$relationship_status = "Currently Separated";
					break;
				case 224:
					$relationship_status = "Divorced";
					break;
				case 222:
					$relationship_status = "Widowed";
					break;     							     
			}
					
			//do you have any kids
			$do_you_have_any_kids = $value[do_you_have_any_kids];	
			switch ($do_you_have_any_kids) {
				case 57:
					$do_you_have_any_kids= "I don't have any kids";
					break;
				case 56:
					$do_you_have_any_kids= "I have kids and they live at home";
					break;
				case 58:
					$do_you_have_any_kids ="I have kids and they live away from home";
					break;
				case 59:
					$do_you_have_any_kids = "I have kids and sometimes they live at home";
					break;     							     
			}	

			//do you want kids
			$do_you_want_children = $value[do_you_want_children];
			$how_many_kids_do_you_want = $value[how_many_kids_do_you_want];
			switch ($how_many_kids_do_you_want) {
				case 243:
					$kid_demand = "1";
					break;
				case 244:
					$kid_demand = "2";
					break;
				case 245:
					$kid_demand = "3";
					break;
				case 246:
					$kid_demand = "more than 3";
					break; 														     
			}		

			//do_you_want_children
			switch ($do_you_want_children) {
				case 273:
					if(isset($kid_demand)){ $do_you_want_children ="Definitely want $kid_demand kid(s)"; }
					break;
				case 275:
					if(isset($kid_demand)){ $do_you_want_children ="Someday want $kid_demand kid(s)"; }
					break;
				case 272:
					if(isset($kid_demand)){ $do_you_want_children ="Not sure want $kid_demand kid(s)"; }
					break;
				case 276:
					if(isset($kid_demand)){ $do_you_want_children ="Probably not want $kid_demand kid(s)"; }
					break;  
				case 274:
					if(isset($kid_demand)){ $do_you_want_children ="Do not want to have want $kid_demand kid(s))"; }
					break;  														     
			}

			//genders
			$what_is_your_gender = $value[what_is_your_gender];
			$gender_you_looking_for = $value[gender_you_looking_for];

			//what_is_your_gender
			$what_is_your_gender = $value[what_is_your_gender];
			switch ($what_is_your_gender) {
				case 1:
					$what_is_your_gender = "I a male";
					break;
				case 2:
					$what_is_your_gender = "I a female";
					break;   
			}

			//gender_you_looking_for
			$gender_you_looking_for = $value[gender_you_looking_for];
			switch ($gender_you_looking_for) {
				case 1:
					$gender_you_looking_for = "I am looking for man";
					break;
				case 2:
					$gender_you_looking_for = "I am looking for woman";
					break;   
			}

			//signup values
			$name = $value[name];	
			$userid = $value[userid];

			//what kind of job do you have
			$what_kind_of_job_do_you_have = $value[what_kind_of_job_do_you_have];
			switch ($what_kind_of_job_do_you_have) {
				case 167:
					$what_kind_of_job_do_you_have = "Administrative / Secretarial";
					break;
				case 170:
					$what_kind_of_job_do_you_have = "Artistic / Creative / Performance";
					break;
				case 166:
					$what_kind_of_job_do_you_have = "Executive / Management";
					break;
				case 168:
					$what_kind_of_job_do_you_have = "Financial services";
					break;  
				case 177:
					$what_kind_of_job_do_you_have = "Labour / Construction";
					break;
				case 175:
					$what_kind_of_job_do_you_have = "Legal";
					break;
				case 176:
					$what_kind_of_job_do_you_have = "Medical / Dental / Veterinary";
					break;
				case 169:
					$what_kind_of_job_do_you_have = "Political / Govt / Civil Service / Military";
					break;
				case 174:
					$what_kind_of_job_do_you_have = "Retail / Food services";
					break;
				case 181:
					$what_kind_of_job_do_you_have = "Retired";
					break;
				case 171:
					$what_kind_of_job_do_you_have = "Sales / Marketing";
					break;
				case 179:
					$what_kind_of_job_do_you_have = "Self Employed";
					break;
				case 180:
					$what_kind_of_job_do_you_have = "Student";
					break;
				case 173:
					$what_kind_of_job_do_you_have = "Teacher / Professor";
					break;
				case 172:
					$what_kind_of_job_do_you_have = "Technical / Computers / Engineering";
					break;
				case 178:
					$what_kind_of_job_do_you_have = "Travel / Hospitality / Transportation";
					break;
				case 182:
					$what_kind_of_job_do_you_have = "Other profession";
					break;					   							      
			}

			//your eye colour
			$your_eye_colour = $value[your_eye_colour];
			switch ($your_eye_colour) {
				case 123:
					$your_eye_colour = "Black eyes";
					break;
				case 118:
					$your_eye_colour = "Blue eyes";
					break;
				case 119:
					$your_eye_colour = "Brown eyes";
					break;
				case 120:
					$your_eye_colour = "Grey eyes";
					break;
				case 121:
					$your_eye_colour = "Green eyes";
					break;
				case 122:
					$your_eye_colour = "Hazel eyes";
					break;        							        
			}

			//your body type
			$your_body_type = $value[your_body_type];
			switch ($your_body_type) {
				case 45:
					$your_body_type = "Slender build";
					break;
				case 46:
					$your_body_type = "Average build";
					break;
				case 47:
					$your_body_type = "Athletic and toned";
					break;  							
				case 48:
					$your_body_type = "Heavyset";
					break;    
				case 49:
					$your_body_type = "A few extra pounds";
					break;    
				case 55:
					$your_body_type = "Stocky build";
					break; 
			}

			//what is your faith
			$what_is_your_faith = $value[what_is_your_faith];
			switch ($what_is_your_faith) {
				case "Agnostic":
					$what_is_your_faith = "Agnostic";
					break;
				case "Buddhist":
					$what_is_your_faith = "Buddhist / Taoist";
					break;
				case "Christian LDS":
					$what_is_your_faith = "Christian / LDS";
					break;
				case "Hindu":
					$what_is_your_faith = "Hindu";
					break;
				case "Muslim":
					$what_is_your_faith = "Muslim / Islam";
					break;
				case "Other":
					$what_is_your_faith = "Other religion";
					break;
				case "Atheist":
					$what_is_your_faith =  "Atheist";
					break;														
				case "Christian Catholic":
					$what_is_your_faith =  "Christian / Catholic";
					break;
				case "Christian Protestant":
					$what_is_your_faith = "Christian / Protestant";
					break;												
				case "Jewish":
					$what_is_your_faith =  "Jewish";
					break;
				case "Spiritual but not religious":
					$what_is_your_faith = "Spiritual but not religious";
					break;
				case "Christian":
					$what_is_your_faith =  "Christian / Other";
					break;     
			}

			//how often do you drink
			$how_often_do_you_drink = $value[how_often_do_you_drink];
			switch ($how_often_do_you_drink) {
				case 76:
					$how_often_do_you_drink = "I don't drink alcohol";
					break;
				case 77:
					$how_often_do_you_drink = "Social drinker, maybe one or two";
					break;
				case 78:
					$how_often_do_you_drink =  "Regularly drink";
					break;     
			}

			//do you smoke
			$do_you_smoke = $value[do_you_smoke];
			switch ($do_you_smoke) {
				case 297:
					$do_you_smoke = "I don't smoke";
					break;
				case 298:
					$do_you_smoke = "Smoke occasionally";
					break;
				case 299:
					$do_you_smoke = "Smoke daily";
					break;  
				case 300:
					$do_you_smoke = "Smoke cigars";
					break;     
				case 302:
					$do_you_smoke = "Trying to quit smoking";
					break;     														   
			}

			//colour is your hair
			$colour_is_your_hair = $value[colour_is_your_hair];
			switch ($colour_is_your_hair) {
				case 126:
					$colour_is_your_hair = "Black hair";
					break;
				case 129:
					$colour_is_your_hair = "Blonde hair";
					break;
				case 133:
					$colour_is_your_hair = "Dark blonde hair";
					break;
				case 127:
					$colour_is_your_hair = "Light brown hair";
					break;
				case 128:
					$colour_is_your_hair = "Dark brown hair";
					break;
				case 125:
					$colour_is_your_hair = "Auburn / Red hair";
					break;
				case 134:
					$colour_is_your_hair = "Grey hair";
					break;
				case 130:
					$colour_is_your_hair = "Salt and pepper hair";
					break;							
				case 135:
					$colour_is_your_hair = "Platinum hair";
					break;
				case 131:
					$colour_is_your_hair = "Silver hair";
					break;
				case 136:
					$colour_is_your_hair = "Bald";
					break;  
			}

			//your best feature
			$your_best_feature = $value[your_best_feature];
			switch ($your_best_feature) {
				case 19:
					$your_best_feature = "Arms are my best feature";
					break;
				case 20:
					$your_best_feature = "Belly button is my best feature";
					break;
				case 21:
					$your_best_feature = "Butt my best feature";
					break;
				case 22:
					$your_best_feature = "Calves my best feature";
					break; 	
				case 23:
					$your_best_feature = "Chest my best feature";
					break;
				case 25:
					$your_best_feature = "Eyes my best feature";
					break;
				case 26:
					$your_best_feature = "Feet my best feature";
					break;
				case 28:
					$your_best_feature = "Hands my best feature";
					break; 							
				case 27:
					$your_best_feature = "Hair my best feature";
					break;
				case 29:
					$your_best_feature = "Eyes my best feature";
					break;
				case 26:
					$your_best_feature = "Legs my best feature";
					break;
				case 30:
					$your_best_feature = "Lips my best feature";
					break; 																						      												 				case 31:
					$your_best_feature = "Neck my best feature";
					break; 	        
			}

			//how often do you exercise
			$how_often_do_you_exercise = $value[how_often_do_you_exercise];
			switch ($how_often_do_you_exercise) {
				case 96:
					$how_often_do_you_exercise = "I never exercise";
					break;
				case 97:
					$how_often_do_you_exercise = "Exercise 1-2 times per week";
					break;
				case 98:
					$how_often_do_you_exercise = "Exercise 3-4 times per week";
					break;
				case 99:
					$how_often_do_you_exercise = "Exercise 5 or more times per week";
					break;        
			}

			//current income
			$current_annual_income = $value[current_annual_income];
			switch ($current_annual_income) {
			case "Less Than 25000":
				$current_annual_income = "Less Than &pound;25,000";
				break;
			case "25000":
				$current_annual_income = "&pound;25,001 to &pound;35,000";
				break;							
			case "35000":
				$current_annual_income = "&pound;35,001 to &pound;50,000";
				break;
			case "50000":
				$current_annual_income = "&pound;50,001 to &pound;75,000";
				break;
			case "75000":
				$current_annual_income = "&pound;75,001 to &pound;100,000";
				break;
			case "100000":
				$current_annual_income = "&pound;100,001 to &pound;150,000";
				break;
			case "150000":
				$current_annual_income = "&pound;150,001+";
				break;  
			}

			//sit_on_the_political_fence
			$sit_on_the_political_fence = $value[sit_on_the_political_fence];
			switch ($sit_on_the_political_fence) {
			case 277:
				$sit_on_the_political_fence = "Ultra Conservative";
				break;
			case 278:
				$sit_on_the_political_fence = "Conservative";
				break;							
			case 279:
				$sit_on_the_political_fence = "Middle of the Road";
				break;
			case 280:
				$sit_on_the_political_fence = "Liberal";
				break;
			case 281:
				$sit_on_the_political_fence = "Very Liberal";
				break;
			case 282:
				$sit_on_the_political_fence = "Non-conformist";
				break;
			case 283:
				$sit_on_the_political_fence = "Some other viewpoint";
				break;  
			}

			//what_brings_you_here
			$what_brings_you_here = $value[what_brings_you_here];
			switch ($what_brings_you_here) {
			case 554:
				$what_brings_you_here = "A friend found someone great on WhenScottMetMichelle.com";
				break;
			case 555:
				$what_brings_you_here = "I'm new to the area and I'm looking for someone to show me around";
				break;							
			case 556:
				$what_brings_you_here = "My career keeps me busy, so I need a more efficient way to meet people";
				break;
			case 557:
				$what_brings_you_here = "WhenScottMetMichelle.com has more quality singles than any other dating site";
				break;
			case 558:
				$what_brings_you_here = "I'm looking to meet people outside my social circle";
				break;
			case 559:
				$what_brings_you_here = "I'm just checking out WhenScottMetMichelle.com - not sure if I want to do this";
				break;
			case 560:
				$what_brings_you_here = "Other reasons why I joined this site";
				break;  
			}
			
			//not used?
			$email = $value[email];
			$where_is_your_home_town = $value[where_is_your_home_town];	
			$where_should_we_look = $value[where_should_we_look];
			
			//appearance
			$body_art = $value[body_art];
			
			//background
			$ethnicities_describe_you_the_best = $value[ethnicities_describe_you_the_best];
			
			$describe_your_education = $value[describe_your_education];
			$languages_do_you_speak = $value[languages_do_you_speak];
				
			//basics values
			$age_range_you_looking_for = $value[age_range_you_looking_for];			
			$how_tall_are_you = $value[how_tall_are_you];
			$your_sign = $value[your_sign];
					
			//express			
			$do_you_have_any_brothers_or_sisters = $value[do_you_have_any_brothers_or_sisters];	
			$you_an_early_bird_or_night_owl = $value[you_an_early_bird_or_night_owl];	
			$do_you_play_a_musical_instrument = $value[do_you_play_a_musical_instrument];	
			$what_is_your_favourite_colour = $value[what_is_your_favourite_colour];	
			
			//interests
			$what_do_you_do_for_fun = $value[what_do_you_do_for_fun];	
			$local_hot_spots = $value[local_hot_spots];	
			$favourite_things = $value[favourite_things];	
			$favourite_book = $value[favourite_book];	
			$sports_and_exercise = $value[sports_and_exercise];	
			$common_interests = $value[common_interests];		
	
			//intro
			$describe_yourself = $value[describe_yourself];
			$date_headline = $value[date_headline];		
					
			//lifestyle
			$what_best_describes_your_diet = $value[what_best_describes_your_diet];			
			$tell_us_more = $value[tell_us_more];
			$do_you_live_alone = $value[do_you_live_alone];
			$pets = $value[pets];
		
$title_tag ="When Scott Met Michelle > $name";
$keyword_tag.="When Scott Met Michelle, ";
if(!empty($date_headline)) { $keyword_tag.="$date_headline, "; }
if(!empty($describe_yourself)) { $keyword_tag.="$describe_yourself, "; }
if(!empty($name)) { $keyword_tag.="$name, "; }
if(!empty($what_is_your_gender)) { $keyword_tag.="$what_is_your_gender, "; }
if(!empty($gender_you_looking_for)) { $keyword_tag.="$gender_you_looking_for, "; }
if(!empty($userid)) { $keyword_tag.="$userid, "; }
if(!empty($relationship_status)) { $keyword_tag.="$relationship_status, "; }
if(!empty($do_you_have_any_kids)) { $keyword_tag.="$do_you_have_any_kids, "; }
if(!empty($do_you_want_children)) { $keyword_tag.="$do_you_want_children, "; }
if(!empty($sports_and_exercise)) { $keyword_tag.="$sports_and_exercise, "; }
if(!empty($common_interests)) { $keyword_tag.="$common_interests, "; }
if(!empty($what_is_your_faith)) { $keyword_tag.="$what_is_your_faith, "; }
if(!empty($colour_is_your_hair)) { $keyword_tag.="$colour_is_your_hair, "; }
if(!empty($do_you_smoke)) { $keyword_tag.="$do_you_smoke, "; }
if(!empty($how_often_do_you_drink)) { $keyword_tag.="$how_often_do_you_drink, "; }
if(!empty($your_body_type)) { $keyword_tag.="$your_body_type, "; }
if(!empty($your_eye_colour)) { $keyword_tag.="$your_eye_colour, "; }
if(!empty($your_best_feature)) { $keyword_tag.="$your_best_feature, "; }
if(!empty($how_often_do_you_exercise)) { $keyword_tag.="$how_often_do_you_exercise, "; }
if(!empty($what_kind_of_job_do_you_have)) { $keyword_tag.="$what_kind_of_job_do_you_have, "; }
if(!empty($current_annual_income)) { $keyword_tag.="$current_annual_income, "; }
//if(!empty($email)) { $keyword_tag.="$email, "; }
if(!empty($body_art)) { $keyword_tag.="$body_art, "; }
if(!empty($ethnicities_describe_you_the_best)) { $keyword_tag.="$ethnicities_describe_you_the_best, "; }
if(!empty($describe_your_education)) { $keyword_tag.="$describe_your_education, "; }
if(!empty($languages_do_you_speak)) { $keyword_tag.="$languages_do_you_speak, "; }
if(!empty($sit_on_the_political_fence)) { $keyword_tag.="$sit_on_the_political_fence, "; }
if(!empty($what_brings_you_here)) { $keyword_tag.="$what_brings_you_here, "; }
if(!empty($age_range_you_looking_for)) { $keyword_tag.="$age_range_you_looking_for, "; }
if(!empty($how_tall_are_you)) { $keyword_tag.="$how_tall_are_you, "; }
//if(!empty($where_should_we_look)) { $keyword_tag.="$where_should_we_look, "; }
//if(!empty($where_is_your_home_town)) { $keyword_tag.="$where_is_your_home_town, "; }
if(!empty($do_you_have_any_brothers_or_sisters)) { $keyword_tag.="$do_you_have_any_brothers_or_sisters, "; }
if(!empty($do_you_play_a_musical_instrument)) { $keyword_tag.="$do_you_play_a_musical_instrument, "; }
if(!empty($you_an_early_bird_or_night_owl)) { $keyword_tag.="$you_an_early_bird_or_night_owl, "; }
if(!empty($what_is_your_favourite_colour)) { $keyword_tag.="$what_is_your_favourite_colour, "; }
if(!empty($what_do_you_do_for_fun)) { $keyword_tag.="$what_do_you_do_for_fun, "; }
if(!empty($local_hot_spots)) { $keyword_tag.="$local_hot_spots, "; }
if(!empty($favourite_things)) { $keyword_tag.="$favourite_things, "; }
if(!empty($favourite_book)) { $keyword_tag.="$favourite_book, "; }
if(!empty($what_best_describes_your_diet)) { $keyword_tag.="$what_best_describes_your_diet, "; }
if(!empty($tell_us_more)) { $keyword_tag.="$tell_us_more, "; }
if(!empty($do_you_live_alone)) { $keyword_tag.="$do_you_live_alone, "; }
if(!empty($pets)) { $keyword_tag.="$pets, "; }

$description_tag.="$keyword_tag";
$keyword_tag = str_replace(" ", ", ", $keyword_tag);
$keyword_tag = str_replace(",,", ", ", $keyword_tag);
$keyword_tag = trim($keyword_tag);
$keyword_tag = substr($keyword_tag, 0, -1); 

		}
		//foreach
	}
	//scan results and pull out array
}
/** Profile **/


//variables
$site_editor_host ="http://www.whenscottmetmichelle.com";
$site_name ="When Scott Met Michelle";
$site_admin_email ="info@whenscottmetmichelle.com";  //test email
$site_admin_name = "Rob Shan Lone";
$current_time = date('Y-m-d h:i:s'); 

function generateRandomString($length = 10, $letters = '1234567890qwertyuiopasdfghjklzxcvbnm')
{
	$s = '';
	$lettersLength = strlen($letters)-1;
	for($i = 0 ; $i < $length ; $i++)
	{
		$s .= $letters[rand(0,$lettersLength)];
	}
	return $s;
}

$current_page = $_SERVER['REQUEST_URI'];
$pattern1 = "/logout/";
$sourceislogout = preg_match($pattern1, $current_page);

$pattern2 = "/catalog.php/";
$sourceiscatlog = preg_match($pattern2, $current_page);

if($sourceislogout)
{
	//logout
	$c1->query("DELETE FROM `login` WHERE `signupid`='$_SESSION[signupid]'");
	//$c1->query("UPDATE login SET status='OFF' WHERE userid='$_SESSION[userid]'");
	session_unset();
	session_destroy();
}

$userid=$_POST['userid'];
$password=$_POST['password'];

if(isset($userid))
{
	$userid=mysql_real_escape_string($userid);
	$password=mysql_real_escape_string($password);
	//emcrypt password
	$password= md5($password);

	$c1->query("SELECT * FROM signup WHERE userid='$userid' AND password = '$password'");

	if($rec = $c1->fetchAll())
	{
		//admin has username, password, confirmed and is enabled.
		if(($rec[0]['userid']==$userid)&&($rec[0]['password']==$password)&&($rec[0]['is_confirmed']=='1'))
		{
			$signupid = $rec[0]['id'];
			include "includes/newsession.php";
			$tm=date("Y-m-d H:i:s");
			$ip=$_SERVER['REMOTE_ADDR'];
			
			$login_count = $rec[0]['login_count'];
			$login_count++;

			//if not already in login database
			$c1->query("UPDATE signup SET login_count='$login_count', last_logged='$tm' WHERE userid='$_SESSION[userid]'");
			
			//if not already in login database
			//$c1->query("UPDATE login SET id='$_SESSION[id]', ip='$ip', tm='$tm' WHERE userid='$_SESSION[userid]'");
//if already logged in...delete so we can have only one session ever!
$c1->query("DELETE FROM `login` WHERE `signupid`='$_SESSION[signupid]'");

// No records updated, so add it
$c1->query("INSERT INTO login(id,userid,signupid,ip,tm) values('$_SESSION[id]','$_SESSION[userid]','$_SESSION[signupid]','$ip','$tm')");
			
		}
	}
	else
	{
		session_unset();
		//echo "<font face='Verdana' size='2' color=red>Wrong Login. Use your correct  Userid and Password and Try <br><center><input type='button' value='Retry' onClick='history.go(-1)'></center>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<title><?php echo''.$title_tag.'';?></title>
<meta http-equiv="Content-Style-Type" content="text/css"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="generator" content="www.fusionrobotdesign.com"/>
<meta name="keywords" content="<?php echo''.$keyword_tag.'';?>" />
<meta name="description" content="<?php echo''.$description_tag.'';?>" />
<meta name="verify-v1" content="XCt8jWbdXi/expTFP+KedzVrfgNozS7lekJVWrUwQ28=" />

	<?php
    if(eregi('_fakeraccountmaker',$current_page))
    {
        ?><meta http-equiv='refresh' content='1;URL=_fakeraccountmaker.php'><?php
    }
    ?>
	<?php include "session_check.php";?>
<!-- stylesheets -->
<link rel="stylesheet" href="css/generic.css" type="text/css"/>

<!-- scripts -->


<!--[if lt IE 7.]>
<link rel="stylesheet" href="/css/ie7.css" type="text/css" />
<script defer type="text/javascript" src="pngfix.js"></script>
<![endif]-->

<!-- SIFR -->



  <link rel="stylesheet" href="/css/sifr.css" type="text/css"/>

  <style type="text/css" media="screen">
    /*****************************************************************************
    These styles should be at the bottom of `sifr.css`. Make sure that they're
    only applied for the screen media type!
    *****************************************************************************/
    .sIFR-active h2,
	.sIFR-active h2.edit,
    .sIFR-active h3,
    .sIFR-active h4,
    .sIFR-active h5#pullquote {
      visibility: hidden;
      font-family: Verdana;
    }

    .sIFR-active #special h2.supernav {
      font-size: 19px;
	  line-height:19px;
	  margin:0;
      display: block;
    }

    .sIFR-active h2 {
      font-size: 23px;
	  margin:0;
      display: block;
	  line-height: 24px;
    }

    .sIFR-active h3 {
		background:#000000 none repeat scroll 0 0;
		font-size:22px;
		height:27px;
		margin-left:13px;
		width:76px;
    }

    .sIFR-active h4 {
      font-size: 23px;
	  margin:0;
      display: block;
	  line-height: 24px;
    }

    .sIFR-active h5#pullquote {
      font-size: 24px;
    }
  </style>


<script type="text/javascript">
function delayer(variable){
    window.location = variable;
}
</script>


  <script src="/js/sifr.js" type="text/javascript"></script>
  <script src="/js/sifr-debug.js" type="text/javascript"></script>
  <script type="text/javascript">
    /*****************************************************************************
    The sIFR configuration should typically go in `sifr-config.js`, but in order to
    keep the config file clean, and to give a quick overview, it's done here instead.
    *****************************************************************************/
  
    var cochin = {
      src: '/css/forte.swf'
      ,ratios: [7, 1.32, 11, 1.31, 13, 1.24, 14, 1.25, 19, 1.23, 27, 1.2, 34, 1.19, 42, 1.18, 47, 1.17, 48, 1.18, 69, 1.17, 74, 1.16, 75, 1.17, 1.16]
    };


    // You probably want to switch this on, but read wiki.novemberborn.net/sifr3/DetectingCSSLoad first.
    // sIFR.useStyleCheck = true;
    sIFR.activate(cochin);
  </script>

<script type="text/javascript">    
sIFR.replace(cochin, { selector: 'h2', wmode: 'transparent',css: [ '.sIFR-root { text-align: left; font-size: 22px;font-weight: normal; color:#ffffff; }' ,'a { text-decoration: none }' ,'a:link { color: #ffffff }' ,'a:hover { color: #eb008d }' ] }); 

sIFR.replace(cochin, { selector: 'h3', wmode: 'transparent',css: [ '.sIFR-root { text-align: left; font-size: 20px;font-weight: normal; color:#ffffff; }' ,'a { text-decoration: none }' ,'a:link { color: #ffffff }' ,'a:hover { color: #eb008d }' ] }); 

sIFR.replace(cochin, { selector: 'h4', wmode: 'transparent',css: [ '.sIFR-root { text-align: left; font-size: 22px;font-weight: normal; color:#000000; }' ,'a { text-decoration: none }' ,'a:link { color: #000000 }' ,'a:hover { color: #000000 }' ] }); 
</script>    


<script type="text/javascript">
function checkclear(field)
{
  field.value='';
}
</script>


<script type="text/javascript">
function formValidator(){
	// Make quick references to our fields
	var firstname = document.getElementById('first');
	var lastname = document.getElementById('last');
	var email = document.getElementById('email');
	var userid = document.getElementById('userid');	
	var password1 = document.getElementById('password');
	var password2 = document.getElementById('password2');
	var birthdayday = document.getElementById('birthdayday');
	var birthdaymonth = document.getElementById('birthdaymonth');
	var birthdayyear = document.getElementById('birthdayyear');
	var agree = document.getElementById('agree');
	
	var Man1 = document.getElementById('Man1');
	var Woman1 = document.getElementById('Woman1');
	
	var Man2 = document.getElementById('Man2');
	var Woman2 = document.getElementById('Woman2');
	
	//sex
	//gender_you_looking_for

	//alert(agree);
	
	//alert(Man1.checked);
	if(Man1.checked=="" && Woman1.checked=="")
	{
		//alert("fill in gender");
	}

	
	// Check each input in the order that it appears in the form!
	if(
		madeSelection(birthdayday, "", "Please select a valid birth day") && 
		madeSelection(birthdaymonth, "", "Please select a valid birth month") && 
		madeSelection(birthdayyear, "", "Please select a valid birth year") &&
		isTrue(agree.checked, "You need to agree to the terms and the conditions") &&
		isAlphabet(firstname, "Please enter only letters for your first name") && 
		isAlphabet(lastname, "Please enter only letters for your last name") && 
		emailValidator(email, "Please enter a valid email address") && 
		lengthRestriction(userid, 4, 12, "username") && 
		passMatch(password1, password2, "Please make sure the two password fields match") && 
		lengthRestriction(password1, 4, 12, "password") && 
		madeSelection(where_is_your_home_town, "", "Please select a valid country") &&
		(Man1.checked!="" || Woman1.checked!="")
	)
	{
		return true;
	}
		

	return false;
	/*	
		
		
	if(isAlphanumeric(addr, "Numbers and Letters Only for Address"))
	{
		return false;
	}

	if(isNumeric(zip, "Please enter a valid zip code"))
	{
		return false;
	}

	if(madeSelection(state, "Please Choose a State"))
	{
		return false;
	}					
	
	if(lengthRestriction(username, 6, 8))
	{
		return false;
	}
	*/	

	

}

function notEmpty(elem, helperMsg){
	if(elem.value.length == 0){
		alert(helperMsg);
		elem.focus(); // set the focus to this input
		return false;
	}
	return true;
}

function isNumeric(elem, helperMsg){
	var numericExpression = /^[0-9]+$/;
	if(elem.value.match(numericExpression)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}

function isAlphabet(elem, helperMsg){
	var alphaExp = /^[a-zA-Z]+$/;
	if(elem.value.match(alphaExp)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}

function isAlphanumeric(elem, helperMsg){
	var alphaExp = /^[0-9a-zA-Z]+$/;
	if(elem.value.match(alphaExp)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}

function lengthRestriction(elem, min, max, helperMsg){
	var uInput = elem.value;
	if(uInput.length >= min && uInput.length <= max){
		return true;
	}else{
		alert("The " +helperMsg+ " needs to be at least " +min+ " and " +max+ " characters");
		elem.focus();
		return false;
	}
}

function passMatch(elem1, elem2, helperMsg){
	if(elem1.value != elem2.value){
		alert(helperMsg);
		elem1.focus();
		return false;
	}else{
		return true;
	}
}


function isTrue(val, helperMsg){
	if(val == false){ 
		alert(helperMsg);
		return false; 
	}else{
		return true;
	}
}

function madeSelection(elem, defaultMsg, helperMsg){
	if(elem.value == defaultMsg){
		alert(helperMsg);
		elem.focus();
		return false;
	}else{
		return true;
	}
}

function emailValidator(elem, helperMsg){
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(elem.value.match(emailExp)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}

</script>


<?php
function nicetime($date)
{
    if(empty($date)) {
        return "No date provided";
    }
   
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
   
    $now             = time();
    $unix_date         = strtotime($date);
   
       // check validity of date
    if(empty($unix_date)) {   
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {   
        $difference     = $now - $unix_date;
        $tense         = "ago";
       
    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }
   
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
   
    $difference = round($difference);
   
    if($difference != 1) {
        $periods[$j].= "s";
    }
   
    return "$difference $periods[$j] {$tense}";
}
?>

<!-- SIFR -->
</head>

<body>
<div id="pagewidth"><!--pagewidth-->

<?php 

if(!preg_match("/\/$/", $current_page))
{
	if(!preg_match("/index.php$/", $current_page))
	{ 
	?>
		
			<div id="header"><!--header-->	
		<h1 class="home" id="sitetitle">
			<a href="/browsing.php" title="Home Page"><span>When Scott Met Michelle</span></a>
		</h1>   
		
		<div id="navbar2">
			<ul>    
			
			<li <?php if(ereg("browsing", $current_page)) { ?>class="current"<?php }?> ><h3><a href="browsing.php" title="browse">
		   browse</a></h3></li>    
		
		<?php
		if(isset($_SESSION['id']))
		{    
		?>
			<li <?php if(ereg("relationships", $current_page)) { ?>class="current"<?php }?> ><h3><a href="relationships.php" title="Relationships">Relationships</a></h3></li>    
		
			<li <?php if(ereg("inbox", $current_page)) { ?>class="current"<?php }?> ><h3><a href="inbox.php" title="Check private messages">Inbox</a></h3></li>
		<?php
		}
		?>
			</ul>
		</div>
		
		<div class="clr"></div>
	
		</div><!--header-->
	<?php
	}//if index
}
?>   

			<div id="wrapper" class="clearfix"><!--wrapper-->