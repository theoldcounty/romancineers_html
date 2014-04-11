<?php
//define specific meta tags
//using database connection
include"includes/header.php";
?>
		<div id="sub-twocols" class="clearfix"><!--two col --> 
			<div id="maincol"><!--main col -->
  <!--
<script type="text/javascript">
google_ad_client = "pub-5342663954552346";
google_ad_slot = "3180974968";
google_ad_width = 728;
google_ad_height = 90;

</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>  
  -->
<?php
$profile_id = $_REQUEST[id];
if(!get_magic_quotes_gpc()) { $profile_id=mysql_real_escape_string($profile_id); }	


$c1->query("
SELECT 
signup.id, signup.userid, signup.name, signup.email, signup.profile_prefer, signup.popularity, signup.login_count, signup.birth_date, signup.registered, signup.last_updated, login.status, bio.where_is_your_home_town, bio.do_you_have_any_brothers_or_sisters, bio.you_an_early_bird_or_night_owl, bio.do_you_play_a_musical_instrument, bio.what_is_your_favourite_colour, bio.describe_yourself, bio.date_headline, bio.what_brings_you_here, bio.relationship_status, bio.what_is_your_gender, bio.gender_you_looking_for, bio.age_range_you_looking_for_youngest, bio.age_range_you_looking_for_oldest, bio.where_should_we_look, bio.how_tall_are_you, bio.your_body_type, bio.your_sign, intro.status_tag, interests.interested_in, interests.what_do_you_do_for_fun, interests.local_hot_spots, interests.favourite_things, interests.favourite_book, interests.favourite_tv, interests.favourite_music, interests.favourite_quotations, interests.favourite_films, interests.sports_and_exercise, interests.common_interests, lifestyle.how_often_do_you_exercise, lifestyle.what_best_describes_your_diet, lifestyle.do_you_smoke, lifestyle.how_often_do_you_drink, lifestyle.what_about_your_job, lifestyle.what_kind_of_job_do_you_have, lifestyle.current_annual_income, lifestyle.tell_us_more, lifestyle.do_you_live_alone, lifestyle.do_you_have_any_kids, lifestyle.do_you_want_children, lifestyle.how_many_kids_do_you_want, lifestyle.pets, background.sit_on_the_political_fence, background.languages_do_you_speak, background.describe_your_education, background.what_is_your_faith, background.ethnicities_describe_you_the_best, background.describe_your_background, appearance.your_eye_colour, appearance.colour_is_your_hair, appearance.body_art, appearance.your_best_feature, personality.describe_your_personality, personality.person_words, about_date.date_hair, about_date.date_eyes, about_date.date_height1, about_date.date_height2, about_date.date_bodytype, about_date.date_languages, about_date.date_ethnicity, about_date.date_faith, about_date.date_education, about_date.date_job, about_date.date_tell_us_more, about_date.date_income, about_date.date_smoke, about_date.date_drink, about_date.date_relationships, about_date.date_have_kids, about_date.date_want_kids, about_date.date_turn_ons, about_date.date_turn_offs
FROM signup
LEFT JOIN bio ON signup.id = bio.id
LEFT JOIN appearance ON signup.id = appearance.id
LEFT JOIN background ON signup.id = background.id
LEFT JOIN personality ON signup.id = personality.id
LEFT JOIN interests ON signup.id = interests.id
LEFT JOIN intro ON signup.id = intro.id
LEFT JOIN lifestyle ON signup.id = lifestyle.id
LEFT JOIN about_date ON signup.id = about_date.id
LEFT JOIN login ON signup.userid = login.userid
WHERE signup.id =$profile_id");  
?>    


<?php 
if(!$c1->getNumRows())
{
	echo'This account no longer exists, it could have been disabled or deleted.';
}
else
{
	//scan results and pull out array
	if($rec=$c1->fetchAll())
	{  
		//foreach
		foreach ($rec as &$value)
		{
			$last_updated = $value[last_updated];

		//signup
			$profile_prefer= $value[profile_prefer];
	
		//appearance
			//your eye colour
			$your_eye_colour = $value[your_eye_colour];
			switch ($your_eye_colour) {
				case 123:
					$your_eye_colour="Black";
					break;
				case 118:
					$your_eye_colour="Blue";
					break;
				case 119:
					$your_eye_colour="Brown";
					break;
				case 120:
					$your_eye_colour="Grey";
					break;
				case 121:
					$your_eye_colour="Green";
					break;
				case 122:
					$your_eye_colour="Hazel";
					break;        							        
			}	
			
			//hair colour		
			$colour_is_your_hair = $value[colour_is_your_hair];
			switch ($colour_is_your_hair) {
				case 126:
					$colour_is_your_hair="Black";
					break;
				case 129:
					$colour_is_your_hair="Blonde";
					break;
				case 133:
					$colour_is_your_hair="Dark blonde";
					break;
				case 127:
					$colour_is_your_hair="Light brown";
					break;
				case 128:
					$colour_is_your_hair="Dark brown";
					break;
				case 125:
					$colour_is_your_hair="Auburn / Red";
					break;
				case 134:
					$colour_is_your_hair="Grey";
					break;
				case 130:
					$colour_is_your_hair="Salt and pepper";
					break;							
				case 135:
					$colour_is_your_hair="Platinum";
					break;
				case 131:
					$colour_is_your_hair="Silver";
					break;
				case 136:
					$colour_is_your_hair="Bald";
					break;    
			}			
			
			//body art
			$body_art = $value[body_art];
			$body_art = explode(",",$body_art);
			foreach ($body_art as &$features) {
					$body_art_string.="$features, ";
			}
			unset($features);
			$body_art=substr($body_art_string, 0,-2); 
			
			//your best feature
			$your_best_feature = $value[your_best_feature];
			switch ($your_best_feature) {
				case 19:
					$your_best_feature="Arms";
					break;
				case 20:
					$your_best_feature="Belly button";
					break;
				case 21:
					$your_best_feature="Butt";
					break;
				case 22:
					$your_best_feature="Calves";
					break; 	
				case 23:
					$your_best_feature="Chest";
					break;
				case 25:
					$your_best_feature="Eyes";
					break;
				case 26:
					$your_best_feature="Feet";
					break;
				case 28:
					$your_best_feature="Hands";
					break; 							
				case 27:
					$your_best_feature="Hair";
					break;
				case 29:
					$your_best_feature="Eyes";
					break;
				case 26:
					$your_best_feature="Legs";
					break;
				case 30:
					$your_best_feature="Lips";
					break; 
				case 31:
					$your_best_feature="Neck";
					break; 	        
			}				

		//background
			//describe your background			
			$describe_your_background = $value[describe_your_background];
		
			//ethnicities describe you the best
			$ethnicities_describe_you_the_best = $value[ethnicities_describe_you_the_best];
			$ethnicities_describe_you_the_best = explode(",",$ethnicities_describe_you_the_best);
			foreach ($ethnicities_describe_you_the_best as &$features) {
					$ethnicities_describe_you_the_best_string.="$features, ";
			}
			unset($features);
			$ethnicities_describe_you_the_best=substr($ethnicities_describe_you_the_best_string, 0,-2); 	


			
			//what is your faith
			$what_is_your_faith = $value[what_is_your_faith];
			switch ($what_is_your_faith) {
				case "Agnostic":
					$what_is_your_faith="Agnostic";
					break;
				case "Buddhist":
					$what_is_your_faith="Buddhist / Taoist";
					break;
				case "Christian LDS":
					$what_is_your_faith="Christian / LDS";
					break;
				case "Hindu":
					$what_is_your_faith="Hindu";
					break;
				case "Muslim":
					$what_is_your_faith="Muslim / Islam";
					break;
				case "Other":
					$what_is_your_faith="Other";
					break;
				case "Atheist":
					$what_is_your_faith="Atheist";
					break;														
				case "Christian Catholic":
					$what_is_your_faith="Christian / Catholic";
					break;
				case "Christian Protestant":
					$what_is_your_faith="Christian / Protestant";
					break;												
				case "Jewish":
					$what_is_your_faith="Jewish";
					break;
				case "Spiritual but not religious":
					$what_is_your_faith="Spiritual but not religious";
					break;
				case "Christian":
					$what_is_your_faith="Christian / Other";
					break;     
			}			
			
			//describe your education
			$describe_your_education = $value[describe_your_education];
			
			//languages_do_you_speak
			$languages_do_you_speak = $value[languages_do_you_speak];
			$languages_do_you_speak = explode(",",$languages_do_you_speak);
			foreach ($languages_do_you_speak as &$features) {
					$languages_do_you_speak_string.="$features, ";
			}
			unset($features);
			$languages_do_you_speak=substr($languages_do_you_speak_string, 0,-2); 	

			
			//sit on the political fence
			$sit_on_the_political_fence = $value[sit_on_the_political_fence];
			switch ($sit_on_the_political_fence) {
				case 277:
					$sit_on_the_political_fence ="Ultra Conservative";
					break;
				case 278:
					$sit_on_the_political_fence ="Conservative";
					break;
				case 279:
					$sit_on_the_political_fence ="Middle of the Road";
					break;
				case 280:
					$sit_on_the_political_fence ="Liberal";
					break;  
				case 281:
					$sit_on_the_political_fence ="Very Liberal";
					break;
				case 282:
					$sit_on_the_political_fence ="Non-conformist";
					break;
				case 283:
					$sit_on_the_political_fence ="Some other viewpoint";
					break;
			}			
	
		//basics values
			$what_brings_you_here = $value[what_brings_you_here];
			
			//relationship_status
			$relationship_status = $value[relationship_status];
			switch ($relationship_status) {
				case 221:
					$relationship_status ="Never Married";
					break;
				case 223:
					$relationship_status ="Currently Separated";
					break;
				case 224:
					$relationship_status ="Divorced";
					break;
				case 222:
					$relationship_status ="Widowed";
					break;     							     
			}			
			
			$what_is_your_gender = $value[what_is_your_gender];
			
			//portrait picture code		
			switch ($what_is_your_gender) {
			case 1:
				$profile_pic = "i_am_a_scott.jpg";
				break;
			case 2:
				$profile_pic = "i_am_a_michelle.jpg";
				break;
			default:
				$profile_pic = "i_am_a_neutral.jpg";
				break; 							     
			}		
	
			//portrait picture code				
			
			$gender_you_looking_for = $value[gender_you_looking_for];
			$age_range_you_looking_for_youngest = $value[age_range_you_looking_for_youngest];
			$age_range_you_looking_for_oldest = $value[age_range_you_looking_for_oldest];
			$where_should_we_look = $value[where_should_we_look];

			//how tall are you
			$how_tall_are_you = $value[how_tall_are_you];
			if(!empty($how_tall_are_you))
			{
				$how_tall_are_you = explode(",",$how_tall_are_you);
				$feet = $how_tall_are_you[0];
				$inch = $how_tall_are_you[1];
				$inches = $feet*12;
				$inches = $inch + $inches;
				$cm = $inches * 2.54;
				$how_tall_are_you = "$feet'$inch\" ($cm cms)";	//5'4" (162.56 cms)
			}

			//your body type
			$your_body_type = $value[your_body_type];
			switch ($your_body_type) {
				case 45:
					$your_body_type="Slender";
					break;
				case 46:
					$your_body_type="About average";
					break;
				case 47:
					$your_body_type="Athletic and toned";
					break;  							
				case 48:
					$your_body_type="Heavyset";
					break;    
				case 49:
					$your_body_type="A few extra pounds";
					break;    
				case 55:
					$your_body_type="Stocky";
					break; 
			}			
			
			//your sign
			$your_sign = $value[your_sign];
			switch ($your_sign) {
				case 5:
					$your_sign ="Capricorn";
					break;
				case 6:
					$your_sign ="Aquarius";
					break;
				case 7:
					$your_sign ="Pisces";
					break;
				case 8:
					$your_sign ="Aries";
					break;  
				case 9:
					$your_sign ="Taurus";
					break;
				case 10:
					$your_sign ="Gemini";
					break;
				case 11:
					$your_sign ="Cancer";
					break;
				case 12:
					$your_sign ="Leo";
					break;
				case 13:
					$your_sign ="Virgo";
					break;
				case 14:
					$your_sign ="Libra";
					break;
				case 15:
					$your_sign ="Scorpio";
					break;
				case 16:
					$your_sign ="Sagittarius";
					break;
				case 17:
					$your_sign ="I don't believe in astrology";
					break;		      
			}			
			
					
		//express
			$where_is_your_home_town = $value[where_is_your_home_town];	
			$do_you_have_any_brothers_or_sisters = $value[do_you_have_any_brothers_or_sisters];	
			$you_an_early_bird_or_night_owl = $value[you_an_early_bird_or_night_owl];	
			$do_you_play_a_musical_instrument = $value[do_you_play_a_musical_instrument];	
			$what_is_your_favourite_colour = $value[what_is_your_favourite_colour];	
			
		//interests
			$interested_in = $value[interested_in];
			$what_do_you_do_for_fun = $value[what_do_you_do_for_fun];	
			$local_hot_spots = $value[local_hot_spots];	
			$favourite_things = $value[favourite_things];	
			$favourite_book = $value[favourite_book];
			$favourite_films = $value[favourite_films];
			$favourite_tv = $value[favourite_tv];
			$favourite_music = $value[favourite_music];
			$favourite_quotations = $value[favourite_quotations];


			
			//sports and exercise
			$sports_and_exercise = $value[sports_and_exercise];
			$sports_and_exercise = explode(",",$sports_and_exercise);
			foreach ($sports_and_exercise as &$features) {
					$sports_and_exercise_string.="$features, ";
			}
			unset($features);
			$sports_and_exercise=substr($sports_and_exercise_string, 0,-2); 			
			
			//common_interests	
			$common_interests = $value[common_interests];
			$common_interests = explode(",",$common_interests);
			foreach ($common_interests as &$features) {
					//clean up spaces
					$features1  = str_replace(" ", "%20", $features);
					$common_interests_string.="<a href=\"browsing.php?interests=$features1&amp;e=ad\">$features</a>, ";
			}
			unset($features);
			$common_interests=substr($common_interests_string, 0,-2); 	
	
	
		//intro
			$describe_yourself = $value[describe_yourself];
			$date_headline = $value[date_headline];		
			$status_tag = $value[status_tag];
								
		//lifestyle
			//how often do you exercise
			$how_often_do_you_exercise = $value[how_often_do_you_exercise];
			switch ($how_often_do_you_exercise) {
				case 96:
					$how_often_do_you_exercise ="Never";
					break;
				case 97:
					$how_often_do_you_exercise ="Exercise 1-2 times per week";
					break;
				case 98:
					$how_often_do_you_exercise ="Exercise 3-4 times per week";
					break;
				case 99:
					$how_often_do_you_exercise ="Exercise 5 or more times per week";
					break;        
			}			
			
			//what best describes your diet
			$what_best_describes_your_diet = $value[what_best_describes_your_diet];
			$what_best_describes_your_diet = explode(",",$what_best_describes_your_diet);
			foreach ($what_best_describes_your_diet as &$features) {
					$what_best_describes_your_diet_string.="$features, ";
			}
			unset($features);
			$what_best_describes_your_diet=substr($what_best_describes_your_diet_string, 0,-2); 				
			
			
			//do you smoke
			$do_you_smoke = $value[do_you_smoke];
			switch ($do_you_smoke) {
				case 297:
					$do_you_smoke="No Way";
					break;
				case 298:
					$do_you_smoke="Occasionally";
					break;
				case 299:
					$do_you_smoke="Daily";
					break;  
				case 300:
					$do_you_smoke="Cigars";
					break;     
				case 302:
					$do_you_smoke="Trying to quit";
					break;     														   
			}


			//how often do you drink
			$how_often_do_you_drink = $value[how_often_do_you_drink];
			switch ($how_often_do_you_drink) {
				case 76:
					$how_often_do_you_drink="I don't drink alcohol";
					break;
				case 77:
					$how_often_do_you_drink="Social drinker, maybe one or two";
					break;
				case 78:
					$how_often_do_you_drink="Regularly";
					break;     
			}			
			
			//what about your job
			$what_about_your_job = $value[what_about_your_job];
			
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
			
			//current annual income
			$current_annual_income = $value[current_annual_income];
			switch ($current_annual_income) {
				case "Less Than 25000":
					$current_annual_income="Less Than &pound;25,000";
					break;
				case "25000":
					$current_annual_income="&pound;25,001 to &pound;35,000";
					break;							
				case "35000":
					$current_annual_income="&pound;35,001 to &pound;50,000";
					break;
				case "50000":
					$current_annual_income="&pound;50,001 to &pound;75,000";
					break;
				case "75000":
					$current_annual_income="&pound;75,001 to &pound;100,000";
					break;
				case "100000":
					$current_annual_income="&pound;100,001 to &pound;150,000";
					break;
				case "150000":
					$current_annual_income="&pound;150,001+";
					break;  
			}			
			
			
			$tell_us_more = $value[tell_us_more];
			$do_you_live_alone = $value[do_you_live_alone];
			
			//do you have any kids
			$do_you_have_any_kids = $value[do_you_have_any_kids];
			switch ($do_you_have_any_kids) {
				case 57:
					$do_you_have_any_kids="None";
					break;
				case 56:
					$do_you_have_any_kids="Yes, and they live at home";
					break;
				case 58:
					$do_you_have_any_kids="Yes, and they live away from home";
					break;
				case 59:
					$do_you_have_any_kids="Yes, and sometimes they live at home";
					break;     							     
			}
			
			//how_many_kids_do_you_want
			$how_many_kids_do_you_want = $value[how_many_kids_do_you_want];
			switch ($how_many_kids_do_you_want) {
				case 243:
					$how_many_kids_do_you_want = "1";
					break;
				case 244:
					$how_many_kids_do_you_want = "2";
					break;
				case 245:
					$how_many_kids_do_you_want = "3";
					break;
				case 246:
					$how_many_kids_do_you_want = "More than 3";
					break; 														     
			}		
			
			//do_you_want_children
			$do_you_want_children = $value[do_you_want_children];
			if(!empty($do_you_want_children))
			{
				switch ($do_you_want_children) {
				case 273:
					$do_you_want_children="Definitely";
					if(isset($how_many_kids_do_you_want)){ $do_you_want_children.=" ($how_many_kids_do_you_want)";}
					break;
				case 275:
					$do_you_want_children="Someday";
					if(isset($how_many_kids_do_you_want)){ $do_you_want_children.=" ($how_many_kids_do_you_want)";}
					break;
				case 272:
					$do_you_want_children="Not sure";
					break;
				case 276:
					$do_you_want_children="Probably not";
					break;  
				case 274:
					$do_you_want_children="Do not want to have kids";
					break;  														     
				}							
			}
			//pets
			$pets = $value[pets];
			$pets = explode(",",$pets);
			foreach ($pets as &$features) {
					$pets_string.="$features, ";
			}
			unset($features);
			$pets=substr($pets_string, 0,-2); 
		
			//personality
			$describe_your_personality= $value[describe_your_personality];	
			$person_words = $value[person_words];	
		
			//login
			$status = $value[status];		
		
			//signup values
			$name = $value[name];	
			$userid = $value[userid];
			$signupid = $value[id];
			$email = $value[email];
			$registered = $value[registered];
			$login_count = $value[login_count];
			$birth_date = $value[birth_date];

			$birth_date = explode("-", $birth_date);
			$birth_y = $birth_date[0];
			$birth_m = $birth_date[1];
			$birth_d = $birth_date[2];
			
			$birth =  date("j F Y", mktime(0, 0, 0, $birth_m, $birth_d, $birth_y));
			
			$ageTime = mktime(0, 0, 0, $birth_m, $birth_d, $birth_y); // Get the person's birthday timestamp
			$t = time(); // Store current time for consistency
			$age = ($ageTime < 0) ? ( $t + ($ageTime * -1) ) : $t - $ageTime;
			$year = 60 * 60 * 24 * 365;
			$ageYears = $age / $year;
			
			//age
			$age = floor($ageYears);	
			//gender			
			if($what_is_your_gender==1){ $what_is_your_gender = "male"; } else { $what_is_your_gender = "female";}	
            if($gender_you_looking_for==1){ $gender_you_looking_for = "male"; } else { $gender_you_looking_for = "female";}		



			if(!empty($age))
			{
				$details.="$age-year-old ";
			}

			if(!empty($what_is_your_gender))
			{
				$details.="$what_is_your_gender ";
			}

			if(!empty($gender_you_looking_for))
			{
				$details.="seeking $gender_you_looking_for ";
			}

			if(!empty($age_range_you_looking_for_youngest) && !empty($age_range_you_looking_for_oldest))
			{
				$details.="between $age_range_you_looking_for_youngest-$age_range_you_looking_for_oldest ";
			}									
			

			//about date
			$date_hair = $value[date_hair];
			$date_eyes = $value[date_eyes];
			
			
		//sort out height
			$date_height1 = $value[date_height1];		
			if(!empty($date_height1))
			{				
				$date_height1 = explode(",", $date_height1);
				$f1 = $date_height1[0];
				$i1 = $date_height1[1];
				$inches1 = $f1*12;
				$inches1 = $i1 + $inches1;
				$cm1 = $inches1 * 2.54;
				$date_height1 = "$f1'$i1\" ($cm1 cms)";
			}
			

			$date_height2 = $value[date_height2];			
			if(!empty($date_height2))
			{	
				$date_height2 = explode(",", $date_height2);
				$f2 = $date_height2[0];
				$i2 = $date_height2[1];
				$inches2 = $f2*12;
				$inches2 = $i2 + $inches2;
				$cm2 = $inches2 * 2.54;			
				$date_height2 = "$f2'$i2\" ($cm2 cms)";	
			}
			

			$date_hair = $value[date_hair];
			$date_eyes = $value[date_eyes];
			$date_height1 = $value[date_height1];
			$date_height2 = $value[date_height2];				
			$date_bodytype = $value[date_bodytype];
			$date_languages = $value[date_languages];
			$date_ethnicity = $value[date_ethnicity];			 
			$date_faith = $value[date_faith];
			$date_education = $value[date_education];
			$date_job = $value[date_job];
			$date_tell_us_more = $value[date_tell_us_more];
			$date_income = $value[date_income];
			$date_smoke = $value[date_smoke];
			$date_drink = $value[date_drink];
			$date_relationships = $value[date_relationships];
			$date_have_kids	= $value[date_have_kids];
			$date_want_kids = $value[date_want_kids];
			$date_turn_ons = $value[date_turn_ons];
			$date_turn_offs = $value[date_turn_offs];
			

			
			//update popularity
			$popularity = $value[popularity];
			$popularity++;
			$c1->query("UPDATE `signup` SET `popularity` = '$popularity' WHERE signup.id =$profile_id LIMIT 1");  
		}
		//foreach
	}
	//scan results and pull out array
	
	
				
	
if(isset($_SESSION['userid']))
{
$c1->query("
SELECT 
signup.id, signup.userid, about_date.date_hair, about_date.date_eyes, about_date.date_height1, about_date.date_height2, about_date.date_bodytype, about_date.date_languages, about_date.date_ethnicity, about_date.date_faith, about_date.date_education, about_date.date_job, about_date.date_tell_us_more, about_date.date_income, about_date.date_smoke, about_date.date_drink, about_date.date_relationships, about_date.date_have_kids, about_date.date_want_kids, about_date.date_turn_ons, about_date.date_turn_offs, appearance.your_eye_colour, appearance.colour_is_your_hair,  bio.age_range_you_looking_for_youngest, bio.age_range_you_looking_for_oldest, bio.your_body_type,  bio.relationship_status, background.ethnicities_describe_you_the_best, background.languages_do_you_speak, background.what_is_your_faith, background.describe_your_education, lifestyle.current_annual_income, lifestyle.tell_us_more, lifestyle.do_you_smoke, lifestyle.how_often_do_you_drink, lifestyle.do_you_want_children, lifestyle.what_kind_of_job_do_you_have, lifestyle.do_you_live_alone, lifestyle.do_you_have_any_kids
FROM signup
LEFT JOIN about_date ON signup.id = about_date.id
LEFT JOIN bio ON signup.id = bio.id
LEFT JOIN appearance ON signup.id = appearance.id
LEFT JOIN background ON signup.id = background.id
LEFT JOIN lifestyle ON signup.id = lifestyle.id
WHERE signup.userid ='{$_SESSION['userid']}'");  	
	
	//scan results and pull out array
	if($rec=$c1->fetchAll())
	{  
		//foreach
		foreach ($rec as &$value)
		{
			//user that is logged in
			//your specifications
			$your_hair = $value[colour_is_your_hair];
			$your_eyes = $value[your_eye_colour];
			$your_height1 = $value[how_tall_are_you];			
			$your_bodytype = $value[your_body_type];
			$your_languages = $value[languages_do_you_speak];
			$your_ethnicity = $value[ethnicities_describe_you_the_best];			 
			$your_faith = $value[what_is_your_faith];
			$your_education = $value[describe_your_education];
			$your_job = $value[what_kind_of_job_do_you_have];
			$your_tell_us_more = $value[tell_us_more];
			$your_income = $value[current_annual_income];
			$your_smoke = $value[do_you_smoke];
			$your_drink = $value[how_often_do_you_drink];
			$your_relationships = $value[relationship_status];
			$your_live_alone =  $value[do_you_live_alone];
			$your_have_kids	= $value[do_you_have_any_kids];
			$your_want_kids = $value[do_you_want_children];
	
			
			//date expecatations
			$your_date_hair = $value[date_hair];
			$your_date_eyes = $value[date_eyes];
			$your_date_height1 = $value[date_height1];
			$your_date_height2 = $value[date_height2];			
			$your_date_bodytype = $value[date_bodytype];
			$your_date_languages = $value[date_languages];
			$your_date_ethnicity = $value[date_ethnicity];			 
			$your_date_faith = $value[date_faith];
			$your_date_education = $value[date_education];
			$your_date_job = $value[date_job];
			$your_date_tell_us_more = $value[date_tell_us_more];
			$your_date_income = $value[date_income];
			$your_date_smoke = $value[date_smoke];
			$your_date_drink = $value[date_drink];
			$your_date_relationships = $value[date_relationships];
			$your_date_have_kids	= $value[date_have_kids];
			$your_date_want_kids = $value[date_want_kids];
			$your_date_turn_ons = $value[date_turn_ons];
			$your_date_turn_offs = $value[date_turn_offs];
		}
		//foreach
	}
	//scan results and pull out array	
}//if logged in
	?>

    <!-- portrait -->
    <div class="portrait">
    
        <!-- Portion Left -->
        <div class="portrait-left">
        	<?php
            if(!empty($profile_pic))
            {
            ?>
                <!-- Portrait picture -->
                <div class="profile-picture">
                	<?php
						$dir = "profile/$profile_id/";
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
										//echo"filetype: ".filetype($dir.$file)."<br/>";
									}
								}
								closedir($dh);
							}
						}					
					
					//if the array is empty dont do something stupid
					if(!empty($profile_pic_array))
					{
						$rand_keys = array_rand($profile_pic_array, 1);
					}
					
					if (is_dir($dir) && $filecount>=1) 
					{
						//connect to database to see if there is a preference.
						if(!empty($profile_prefer))
						{
							//profile has a picture preference
							$profile_pic = $profile_prefer;
						}
						else
						{
							//no preference display random
							$profile_pic = $profile_pic_array[$rand_keys];
						}
												
						?><img src="<?php echo''.$dir.'';?><?php echo''.$profile_pic.'';?>" alt="Profile" width="140"/><?php
					}
					else
					{
						//display generic gender pics
						?><img src="graphics/<?php echo''.$profile_pic.'';?>" alt="Profile"/><?php
					}
					?>
                </div>						
                <!-- /Portrait picture --> 
                <b><?php echo''.$name.'';?>(<span class="alternative"><a href="#"><?php echo''.$filecount.'';?></a></span>)</b><br/>      
            <?php
            }
            else
            {
                ?><b>No gallery available</b><br/><?php
            }
            ?>        
           
            <!-- Further relationship information -->
            <div>
			<?php if(isset($_SESSION['signupid']) && ($_SESSION['signupid']!=$signupid)) { ?>   
                <b>Send <?php echo''.$name.'';?> a message</b><br/>
			    <b>Wink</b><br/>
                <b>Add as a buddy</b><br/>
                <b>Do you match?</b><br/>
                <b>Block from Contact</b><br/>
                <b>Block from Search</b><br/>
                <b>Report a Concern</b><br/>
            <?php } ?>

                
     
                
    <?php if(!empty($date_headline)){ ?> 
        	<div class="square_box1"><?php echo''.$date_headline.'';?></div> 
	<?php }?>    
                            

                <div class="square_box2">
                    <b>Information</b><br/>
                    
                    <?php if(!empty($relationship_status)){ ?>
                        <span class="shader">Relationship:</span><br/>
                        <?php echo''.$relationship_status.'';?><br/>
                    <?php }?>
                    <br/>                
                    <span class="shader">Location:</span><br/>
                <?php    
				$q2 = "SELECT * FROM `_country` WHERE `id` = '$where_is_your_home_town'";
				$c1->query($q2);		
				
				if($rec=$c1->fetchAll())
				{  
					foreach ($rec as &$value)
					{
						echo''.$value[country].'';
					}
				}                    
                ?>
                	<br/>                
                    <br/>

			<?php if(isset($_SESSION['signupid']) && ($_SESSION['signupid']!=$signupid)) { ?>   
			    Comparing your profiles<br>
<p>Comparing your profiles side by side is a quick way to calculate chemistry</p>
		
<?php

/*
//user logged in variables

	//PROFILE wnats
    	 .. what the user is
	
			..what profile wants
	
	
	//USER WANTS
		..what user wants

			.. what profile is

	if($your_date_hair==$date_hair)
	{
		echo'x';
	}

	
	if($your_date_eyes==$date_eyes)
	{
		echo'x';	
	}


	if($your_date_bodytype==$date_bodytype)
	{
		echo'x';	
	}

your_date_job
date_job


your_date_income
date_job


your_date_education
date_education


your_date_have_kids
date_have_kids



your_date_want_kids
date_want_kids


your_date_faith
date_faith


*/


?>
			
			
 <?php echo'misc'.$your_height1.' <br/>  '.$your_live_alone.'<br/> '.$your_tell_us_more.' <br/> '.$your_ethnicity.' <br/> '.$your_languages.'<br/> ';?><br/>       
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo''.$date_hair.'';?></td>
    <td>Hair</td>
    <td><?php echo'm: '.$your_hair.'   y:'.$your_date_hair.'';?></td>
  </tr>
  <tr>
    <td><?php echo''.$date_eyes.'';?></td>
    <td>Eyes</td>
    <td><?php echo'm: '.$your_eyes.' y:'.$your_date_eyes.'';?></td>
  </tr>
  <tr>
    <td><?php echo''.$date_bodytype.'';?></td>
    <td>Bodytype</td>
    <td><?php echo'm: '.$your_bodytype.' y:'.$your_date_bodytype.'';?></td>
  </tr>
  <tr>
    <td><?php echo''.$date_faith.'';?></td>
    <td>Faith</td>
    <td><?php echo'm: '.$your_faith.' y: '.$your_date_faith.'';?></td>
  </tr>
  <tr>
    <td><?php echo''.$date_job.'';?></td>
    <td>Job</td>
    <td><?php echo'm: '.$your_job.' y:'.$your_date_job.'';?></td>
  </tr>
  <tr>
    <td><?php echo''.$date_income.'';?></td>
    <td>Income</td>
    <td><?php echo'm:'.$your_income.' y:'.$your_date_income.'';?></td>
  </tr>
  <tr>
    <td><?php echo''.$date_education.'';?></td>
    <td>Education</td>
    <td><?php echo'm: '.$your_education.' y:'.$your_date_education.'';?></td>
  </tr>
  <tr>
    <td><?php echo''.$date_smoke.'';?></td>
    <td>Smoke</td>
    <td><?php echo'm: '.$your_smoke.'  y:'.$your_date_smoke.'';?></td>
  </tr>
  <tr>
    <td><?php echo''.$date_drink.'';?></td>
    <td>Drink</td>
    <td><?php echo'm:'.$your_drink.'  y:'.$your_date_drink.'';?></td>
  </tr>    
  <tr>
    <td><?php echo''.$date_relationships.'';?></td>
    <td>Relationship</td>
    <td><?php echo'm:'.$your_relationships.'  y:'.$your_date_relationships.'';?></td>
  </tr>
  <tr>
    <td><?php echo''.$date_have_kids.'';?></td>
    <td>Have Kids</td>
    <td><?php echo'm:'.$your_have_kids.'  y:'.$your_date_have_kids.'';?></td>
  </tr>
  <tr>
    <td><?php echo''.$date_want_kids.'';?></td>
    <td>Want Kids</td>
    <td><?php echo'm:'.$your_want_kids.'  y:'.$your_date_want_kids.'';?></td>
  </tr>                    
</table>
      
        
<?php
//echo''.$_SESSION['signupid'].' - logged in <br>';
//echo''.$signupid.' -looking at<br>';

echo'<br><br><br>';

//their date
echo'1 x- '.$date_hair.' -specific<br>';
echo'2 x- '.$date_eyes.' -specific<br>';
echo'3 - '.$date_height1.' -range<br>';
echo'4 - '.$date_height2.' -range<br>';
echo'5 x- '.$date_bodytype.' - specific<br>';
echo'6 - '.$date_languages.'  -range<br>';
echo'7 - '.$date_ethnicity.'  -range<br>';
echo'8 x- '.$date_faith.' -specific<br>';
echo'9 x- '.$date_education.'- specific<br>';
echo'10x - '.$date_job.'- specific<br>';
echo'11 - '.$date_tell_us_more.' -words<br>';
echo'12 x- '.$date_income.' - specific<br>';
echo'13 c- '.$date_smoke.' -specific<br>';
echo'14 x- '.$date_drink.' -specific<br>';
echo'15 - '.$date_relationships.' -specific<br>';
echo'16 - '.$date_have_kids.' -specific<br>';
echo'17 - '.$date_want_kids.' -specific<br>';
echo'18 - '.$date_turn_ons.' -specific<br>';
echo'19 - '.$date_turn_offs.' -specific<br>';

echo'<br><br><br>';

//your preferences
echo'1 x- '.$your_date_hair.' -specific<br>';
echo'2 x- '.$your_date_eyes.' -specific<br>';
echo'3 - '.$your_date_height1.' -range<br>';
echo'4 - '.$your_date_height2.' -range<br>';
echo'5 x- '.$your_date_bodytype.' -specific<br>';
echo'6 - '.$your_date_languages.' -range<br>';
echo'7 - '.$your_date_ethnicity.' -range<br>';
echo'8 x- '.$your_date_faith.' -specific<br>';
echo'9 x- '.$your_date_education.' -specific<br>';
echo'10x - '.$your_date_job.' -specific<br>';
echo'11 - '.$your_date_tell_us_more.' -words<br>';
echo'12x - '.$your_date_income.' -specific<br>';
echo'13x - '.$your_date_smoke.' -specific<br>';
echo'14 x- '.$your_date_drink.' -specific<br>';
echo'15 - '.$your_date_relationships.' -specific<br>';
echo'16 - '.$your_date_have_kids.' -specific<br>';
echo'17 - '.$your_date_want_kids.' -specific<br>';
echo'18 - '.$your_date_turn_ons.' -specific<br>';
echo'19 - '.$your_date_turn_offs.' -specific<br>';

/*
echo''.$_SESSION['signupid'].' - logged in <br>';
echo''.$signupid.' -looking at<br>';


echo''.$_SESSION['userid'].' - logged in <br>';
echo''.$userid.' -looking at<br>';
*/
?>                

            <?php } ?>
                </div>
            </div>
            <!-- /Further relationship information -->
        </div>
        <!-- /Portion Left -->
    
        <!-- Portion Right -->
        <div class="portrait-right">  

<div class="user_name2"><h4><?php echo''.$name.'';?></h4></div>
<?php if(!empty($status_tag)){ ?><div class="status_tag"><span class="shader"><?php echo''.$status_tag.''; ?></span><br/></div><?php }?>
<div class="clr"></div>



<h4>Basic Information</h4>
<div>
<dl class="sum">
	<?php if(!empty($details)){ ?> <dt>Details:</dt><dd><?php echo''.$details.'';?></dd> <?php }?>    
    <?php if(!empty($do_you_have_any_kids)){ ?> <dt>Have kids:</dt><dd><?php echo''.$do_you_have_any_kids.''; ?></dd> <?php }?>  
    <?php if(!empty($do_you_want_children)){ ?> <dt>Want kids:</dt><dd><?php echo''.$do_you_want_children.'';?></dd> <?php }?>      
    <?php if(!empty($ethnicities_describe_you_the_best)){ ?> <dt>Ethnicity:</dt><dd><?php echo''.$ethnicities_describe_you_the_best.'';?></dd> <?php }?>
    <?php if(!empty($your_body_type)){ ?> <dt>Body type:</dt><dd><?php echo''.$your_body_type.'';?></dd> <?php }?>  
    <?php if(!empty($how_tall_are_you)){ ?> <dt>Height:</dt><dd><?php echo''.$how_tall_are_you.''; ?></dd> <?php }?>  
    <?php if(!empty($what_is_your_faith)){ ?> <dt>Religion:</dt><dd><?php echo''.$what_is_your_faith.'';?></dd> <?php }?>  
    <?php if(!empty($do_you_smoke)){ ?> <dt>Smoke:</dt><dd><?php echo''.$do_you_smoke.'';?></dd> <?php }?>  
    <?php if(!empty($how_often_do_you_drink)){ ?> <dt>Drink:</dt><dd><?php echo''.$how_often_do_you_drink.'';?></dd> <?php }?>          
</dl>
<div class="clr"></div> 
</div>
  
<?php if(!empty($describe_yourself)){ ?>
<h4>Personal Information</h4>
    <div>
    <p><?php echo''.$describe_yourself.'';?></p>
    </div>
<?php }?>   



<?php
/*About me*/ 
if(!empty($what_is_your_gender) ||
!empty($birth) ||
!empty($relationship_status) ||
!empty($colour_is_your_hair) ||
!empty($your_eye_colour) ||
!empty($your_best_feature) ||
!empty($body_art) ||
!empty($sports_and_exercise) ||
!empty($how_often_do_you_exercise) ||
!empty($what_best_describes_your_diet) ||
!empty($common_interests) ||
!empty($describe_your_education) ||
!empty($what_kind_of_job_do_you_have) ||
!empty($current_annual_income) ||
!empty($languages_do_you_speak) ||
!empty($sit_on_the_political_fence) ||
!empty($your_sign) ||
!empty($do_you_live_alone) ||
!empty($pets) ||
!empty($describe_your_personality) ||
!empty($interested_in) ||
!empty($favourite_things) ||
!empty($favourite_music) ||
!empty($favourite_films) ||
!empty($favourite_quotations) ||
!empty($favourite_tv) ||
!empty($favourite_book)
){ ?>
       
<h4>About me</h4>
<div>




<dl class="sum">    
    <?php if(!empty($what_is_your_gender)){ ?> <dt>Gender:</dt><dd><?php echo''.ucfirst($what_is_your_gender).'';?></dd> <?php }?>
    <?php if(!empty($birth)){ ?> <dt>Birthday:</dt><dd><?php echo''.$birth.'';?></dd> <?php }?>
    <?php if(!empty($relationship_status)){ ?> <dt>Relationship Status:</dt><dd><?php echo''.$relationship_status.'';?></dd> <?php }?>
    <?php if(!empty($colour_is_your_hair)){ ?> <dt>Hair:</dt><dd><?php echo''.$colour_is_your_hair.'';?></dd> <?php }?> 
    <?php if(!empty($your_eye_colour)){ ?> <dt>Eyes:</dt><dd><?php echo''.$your_eye_colour.'';?></dd> <?php }?> 
    <?php if(!empty($your_best_feature)){ ?> <dt>Best Feature:</dt><dd><?php echo''.$your_best_feature.'';?></dd> <?php }?> 
    <?php if(!empty($body_art)){ ?> <dt>Body art:</dt><dd><?php echo''.$body_art.'';?></dd> <?php }?> 
    <?php if(!empty($sports_and_exercise)){ ?> <dt>Sports and exercise:</dt><dd><?php echo''.$sports_and_exercise.'';?></dd> <?php }?> 
    <?php if(!empty($how_often_do_you_exercise)){ ?> <dt>Exercise:</dt><dd><?php echo''.$how_often_do_you_exercise.'';?></dd> <?php }?> 
    <?php if(!empty($what_best_describes_your_diet)){ ?> <dt>Daily diet:</dt><dd><?php echo''.$what_best_describes_your_diet.'';?></dd> <?php }?>
    <?php if(!empty($common_interests)){ ?> <dt>Interests:</dt><dd><?php echo''.$common_interests.'';?></dd> <?php }?> 
    <?php if(!empty($describe_your_education)){ ?> <dt>Education:</dt><dd><?php echo''.$describe_your_education.'';?></dd> <?php }?>   
    <?php if(!empty($what_kind_of_job_do_you_have)){ ?> <dt>Occupation:</dt><dd><?php echo''.$what_kind_of_job_do_you_have.'';?></dd> <?php }?> 
    <?php if(!empty($current_annual_income)){ ?> <dt>Income:</dt><dd><?php echo''.$current_annual_income.'';?></dd> <?php }?> 
    <?php if(!empty($languages_do_you_speak)){ ?> <dt>Languages:</dt><dd><?php echo''.$languages_do_you_speak.'';?></dd> <?php }?> 
    <?php if(!empty($sit_on_the_political_fence)){ ?> <dt>Politics:</dt><dd><?php echo''.$sit_on_the_political_fence.'';?></dd> <?php }?> 
    <?php if(!empty($your_sign)){ ?> <dt>Sign:</dt><dd><?php echo''.$your_sign.'';?></dd> <?php }?> 
    <?php if(!empty($do_you_live_alone)){ ?> <dt>My Place:</dt><dd><?php echo''.$do_you_live_alone.'';?></dd> <?php }?>           
    <?php if(!empty($pets)){ ?> <dt>Pets I like:</dt><dd><?php echo''.$pets.'';?></dd> <?php }?> 
<?php if(!empty($describe_your_personality)){ ?> <dt>Personality:</dt><dd><?php echo''.$describe_your_personality.'';?></dd> <?php }?>
<?php if(!empty($interested_in)){ ?> <dt>Interests:</dt><dd><?php echo''.$interested_in.'';?></dd> <?php }?> 
<?php if(!empty($favourite_things)){ ?> <dt>Favourite Things:</dt><dd><?php echo''.$favourite_things.'';?></dd> <?php }?>
<?php if(!empty($favourite_music)){ ?> <dt>Favourite Music:</dt><dd><?php echo''.$favourite_music.'';?></dd> <?php }?>    
<?php if(!empty($favourite_films)){ ?> <dt>Favourite Films:</dt><dd><?php echo''.$favourite_films.'';?></dd> <?php }?>  
<?php if(!empty($favourite_quotations)){ ?> <dt>Favourite quotations:</dt><dd><?php echo''.$favourite_quotations.'';?></dd> <?php }?>  
<?php if(!empty($favourite_tv)){ ?> <dt>Favourite Tv:</dt><dd><?php echo''.$favourite_tv.'';?></dd> <?php }?>  
<?php if(!empty($favourite_book)){ ?> <dt>Favourite Book:</dt><dd><?php echo''.$favourite_book.'';?></dd> <?php }?>  

</dl> 
<div class="clr"></div>
</div>
<?php }
/*About me*/
?>



<?php
/*In my own words*/ 
if(!empty($what_do_you_do_for_fun) ||
!empty($what_about_your_job) ||
!empty($describe_your_background) ||
!empty($describe_your_education) ||
!empty($local_hot_spots) ||
!empty($favourite_book) ||
!empty($favourite_things)
){ ?>

<h4>In my own words</h4>
<div>
<dl class="sum">    
<?php if(!empty($what_do_you_do_for_fun)){ ?> <dt>For fun:</dt><dd><?php echo''.$what_do_you_do_for_fun.'';?></dd> <?php }?>
<?php if(!empty($what_about_your_job)){ ?> <dt>My job:</dt><dd><?php echo''.$what_about_your_job.'';?></dd> <?php }?>
<?php if(!empty($describe_your_background)){ ?> <dt>My ethnicity:</dt><dd><?php echo''.$describe_your_background.''; ?></dd><?php }?>    

<?php if(!empty($describe_your_education)){ ?> <dt>My education:</dt><dd><?php echo''.$describe_your_education.'';?></dd> <?php }?>   
<?php if(!empty($local_hot_spots)){ ?> <dt>Favorite hot spots:</dt><dd><?php echo''.$local_hot_spots.'';?></dd> <?php }?>
<?php if(!empty($favourite_book)){ ?> <dt>Favourite book:</dt><dd><?php echo''.$favourite_book.'';?></dd> <?php }?>      
<?php if(!empty($favourite_things)){ ?> <dt>Favourite things</dt><dd><?php echo''.$favourite_things.'';?></dd> <?php }?>
</dl> 
<div class="clr"></div>
</div>
<?php }
/*In my own words*/
?>





<?php
if(!empty($date_hair) &&
!empty($date_eyes) &&
!empty($date_height1) &&
!empty($date_height2) &&
!empty($date_bodytype) &&
!empty($date_languages) &&
!empty($date_ethnicity) &&
!empty($date_faith) &&
!empty($date_education) &&
!empty($date_job) &&
!empty($date_tell_us_more) &&
!empty($date_income) &&
!empty($date_smoke) &&
!empty($date_drink) &&
!empty($date_relationships) &&
!empty($date_have_kids) &&
!empty($date_want_kids) &&
!empty($date_turn_ons) &&
!empty($date_turn_offs)
){ ?>


<h4>About my date</h4>
<div>
<dl class="sum">
    <?php if(!empty($date_hair)){ ?> <dt>Hair:</dt><dd><?php echo''.$date_hair.'';?></dd> <?php }?>
    <?php if(!empty($date_eyes)){ ?> <dt>Eyes:</dt><dd><?php echo''.$date_eyes.'';?></dd> <?php }?>
    <?php if(!empty($date_height1) && !empty($date_height2)){ ?> <dt>Height:</dt><dd><?php echo''.$date_height1.'';?> to <?php echo''.$date_height2.'';?></dd> <?php }?>
    <?php if(!empty($date_bodytype)){ ?> <dt>Body type:</dt><dd><?php echo''.$date_bodytype.'';?></dd> <?php }?>
    <?php if(!empty($date_languages)){ ?>  <dt>Languages:</dt><dd><?php echo''.$date_languages.'';?></dd>  <?php }?>
    <?php if(!empty($date_ethnicity)){ ?> <dt>Ethnicity:</dt><dd><?php echo''.$date_ethnicity.'';?></dd> <?php }?>  
    <?php if(!empty($date_faith)){ ?> <dt>Faith:</dt><dd><?php echo''.$date_faith.'';?></dd> <?php }?>  
    <?php if(!empty($date_education)){ ?> <dt>Education:</dt><dd><?php echo''.$date_education.'';?></dd> <?php }?> 
    <?php if(!empty($date_job)){ ?> <dt>Job:</dt><dd><?php echo''.$date_job.'';?></dd> <?php }?>
    <?php if(!empty($date_tell_us_more)){ ?> <dt>Job description:</dt><dd><?php echo''.$date_tell_us_more.'';?></dd> <?php }?>
    <?php if(!empty($date_income)){ ?> <dt>Income:</dt><dd><?php echo''.$date_income.'';?></dd> <?php }?>
    <?php if(!empty($date_smoke)){ ?> <dt>Smoke:</dt><dd><?php echo''.$date_smoke.'';?></dd> <?php }?>
    <?php if(!empty($date_drink)){ ?> <dt>Drink:</dt><dd><?php echo''.$date_drink.'';?></dd> <?php }?>
    <?php if(!empty($date_relationships)){ ?> <dt>Relationships:</dt><dd><?php echo''.$date_relationships.'';?></dd> <?php }?>    
    <?php if(!empty($date_have_kids)){ ?> <dt>Have kids:</dt><dd><?php echo''.$date_have_kids.'';?></dd> <?php }?>
    <?php if(!empty($date_want_kids)){ ?> <dt>Want kids:</dt><dd><?php echo''.$date_want_kids.'';?></dd> <?php }?>
    <?php if(!empty($date_turn_ons)){ ?> <dt>Turn-ons:</dt><dd><?php echo''.$date_turn_ons.'';?></dd> <?php }?>
    <?php if(!empty($date_turn_offs)){ ?> <dt>Turn-offs:</dt><dd><?php echo''.$date_turn_offs.'';?></dd> <?php }?>                                        
</dl> 
<div class="clr"></div>
</div>

<?php }
/*About my date*/
?>
 
        </div>
        <!-- /Portion Right -->
    
        <div class="clr"></div>
        <!-- /clear floats -->
    
    

    
    
    </div>
    <!-- /portrait -->                           
<?php
}
?>


            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

