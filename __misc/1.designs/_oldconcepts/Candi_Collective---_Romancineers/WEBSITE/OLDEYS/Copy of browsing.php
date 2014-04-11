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

//generic variables for browsing
$ords ="registered";
$updown="DESC";
$whr="WHERE status = 'ON'";

$ords=mysql_real_escape_string($ords);
$updown=mysql_real_escape_string($updown);	
//$whr=mysql_real_escape_string($whr);			
				
$q1 ="
SELECT 
signup.id, signup.userid, signup.name, login.status, basics.what_is_your_gender
FROM signup
LEFT JOIN basics ON signup.id = basics.id
LEFT JOIN login ON signup.userid = login.userid
$whr ORDER BY $ords $updown";


//starting val				
$submit=$_REQUEST[submit];
$query =$_REQUEST[query];


$what_is_your_gender=$_REQUEST[what_is_your_gender];
$gender_you_looking_for=$_REQUEST[gender_you_looking_for];
$age_range_you_looking_for=$_REQUEST[age_range_you_looking_for];
   
//uncover how many pages we need
$what_is_your_gender=mysql_real_escape_string($what_is_your_gender);
$gender_you_looking_for=mysql_real_escape_string($gender_you_looking_for);

if(!empty($age_range_you_looking_for)) { $age_range_you_looking_for=implode(",", $age_range_you_looking_for); }
$age_range_you_looking_for=mysql_real_escape_string($age_range_you_looking_for);


//A search has been made...prepare the database
if(isset($query))
{
	echo'do a search these guys like '.$query.'';
	$query =mysql_real_escape_string($query);
	
				$c1->query("
				SELECT interests.sports_and_exercise, interests.common_interests,
				MATCH (sports_and_exercise, common_interests)
				AGAINST ('$query' IN BOOLEAN MODE) AS score 
				FROM interests WHERE MATCH (subject)
				AGAINST ('$query' IN BOOLEAN MODE)
				ORDER BY `score` DESC");	
}


//A search has been made...prepare the database
if(isset($submit))
{
	//you want people opposite of you
	//you are a man looking for a woman
	//we want women looking for men

	$age_range_you_looking_for = explode(",",$age_range_you_looking_for);
	$min_age_range =  $age_range_you_looking_for[0];
	$max_age_range =  $age_range_you_looking_for[1];
	
	//birthday of youngest age
	//birthday of eldest age	
	
	$min_age_range  = date("Y-m-d",  mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-$min_age_range)); 
	$max_age_range  = date("Y-m-d",  mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-$max_age_range)); 
	
	$max_age_range=mysql_real_escape_string($max_age_range);
	$min_age_range=mysql_real_escape_string($min_age_range);

	$whr="WHERE what_is_your_gender = $gender_you_looking_for AND gender_you_looking_for = $what_is_your_gender AND birth_date <= '$min_age_range' AND birth_date >= '$max_age_range'";
	
	
	//now look for age range

$q1 ="
SELECT 
signup.id, signup.userid, signup.name, signup.email, signup.popularity, signup.login_count, signup.birth_date, signup.registered, signup.last_updated, login.status, login.userid, express.where_is_your_home_town, express.do_you_have_any_brothers_or_sisters, express.you_an_early_bird_or_night_owl, express.do_you_play_a_musical_instrument, express.what_is_your_favourite_colour, intro.describe_yourself, intro.date_headline, interests.what_do_you_do_for_fun, interests.local_hot_spots, interests.favourite_things, interests.favourite_book, interests.sports_and_exercise, interests.common_interests, lifestyle.how_often_do_you_exercise, lifestyle.what_best_describes_your_diet, lifestyle.do_you_smoke, lifestyle.how_often_do_you_drink, lifestyle.what_kind_of_job_do_you_have, lifestyle.current_annual_income, lifestyle.tell_us_more, lifestyle.do_you_live_alone, lifestyle.do_you_have_any_kids, lifestyle.do_you_want_children, lifestyle.how_many_kids_do_you_want, lifestyle.pets, basics.what_brings_you_here, basics.relationship_status, basics.what_is_your_gender, basics.gender_you_looking_for, basics.age_range_you_looking_for, basics.where_should_we_look, basics.how_tall_are_you, basics.your_body_type, basics.your_sign, background.sit_on_the_political_fence, background.languages_do_you_speak, background.describe_your_education, background.what_is_your_faith, background.ethnicities_describe_you_the_best, appearance.your_eye_colour, appearance.colour_is_your_hair, appearance.body_art, appearance.your_best_feature
FROM signup
LEFT JOIN basics ON signup.id = basics.id
LEFT JOIN appearance ON signup.id = appearance.id
LEFT JOIN background ON signup.id = background.id
LEFT JOIN express ON signup.id = express.id
LEFT JOIN interests ON signup.id = interests.id
LEFT JOIN intro ON signup.id = intro.id
LEFT JOIN lifestyle ON signup.id = lifestyle.id
LEFT JOIN login ON signup.userid = login.userid
	$whr ORDER BY $ords $updown";
}

				
$c1->query($q1);
$complete_results = $c1->getNumRows(); //complete results
$rpp = 8; //15 results per page



//starting val				
$s=$_REQUEST[s];
//ending val
$e=$_REQUEST[e];




if(!isset($s)) { $s = 0; }
if(!isset($e)) { $e = $rpp; }

$s=mysql_real_escape_string($s);
$e=mysql_real_escape_string($e);

$pages = ceil($complete_results/ $rpp);


// Determine what page the script is on.
$current_page = ($s/$rpp) + 1;

$q2 ="$q1 LIMIT $s,$e";	

//echo'<br/><b>'.$q2.'</b><br/>';

                        $c1->query($q2);      
                      
                        if($rec=$c1->fetchAll())
                        {  
							foreach ($rec as &$value)
							{
									
									//portrait picture code		
									switch ($value[what_is_your_gender]) {
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
								?>
                                <div class="profile-picture">
                                	<div><a href="view-profile.php?id=<?php echo''.$value[id].'';?>"><img src="graphics/<?php echo''.$profile_pic.'';?>"/></a></div>
                                    <div class="profile-name"><?php echo''.$value[name].'';?></div>
                                    <div class="profile-summary">Summary... 
                                    <br/><a href="view-profile.php?id=<?php echo''.$value[id].'';?>">View profile</a> | <a href="send_message.php?type=2&sendto=<?php echo''.$value[id].'';?>">Send a wink</a> | <a href="send_message.php?type=1&sendto=<?php echo''.$value[id].'';?>">Send a message</a></div>
                                </div>                                
                                <?php
							}
						}
						else
						{
							?>Currently no one is online.<?php
							$none=1;
						}
                ?>
                <div class="clr"></div>
                
<?php
if(!isset($none))
{
	//DISPLAY PAGE NAVIGATION
	// If it's not the first page, make a Previous button.
	if ($current_page != 1) 
	{
		echo'<div class="prev"><a href="browsing.php?s='.($s - $rpp).'&amp;pages='.$pages.'">Previous</a></div>';
	}
	
	// Make all the numbered pages.
	?><div class="pagination"><?php
	for ($i = $current_page; $i <= $pages; $i++) 
	{
		$f++; // display just 5 pages at a time
		
		if($f!=5)
		{	
			//echo'value of i : '.$i.'<br>';
			//echo'value of current_page : '.$current_page.'<br>';
	
			if ($i != $current_page) 
			{ 
				echo' <a href="browsing.php?s='.(($rpp * ($i - 1))).'&amp;pages='.$pages.'">'.$i.'</a> '; 
			} 
			else 
			{ 
				echo $i.' ';
			}
		}
		else
		{		
			echo' >> of  <a href="browsing.php?s='.(($pages-1) * $rpp).'&amp;pages='.$pages.'">'.$pages.'</a>';
			break; 
		}	
	}
	?></div><?php
	
	if ($current_page != $pages) 
	{ 
		echo'<div class="next"><a href="browsing.php?s='.($s + $rpp).'&amp;pages='.$pages.'">Next</a></div>';
	}	
	
	
	
	// If it's not the last page, make a Next button.
}
//DISPLAY PAGE NAVIGATION
?>                
            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

