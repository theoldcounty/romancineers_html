<?php
//define specific meta tags
$title_tag ="When Scott Met Michelle";
$keyword_tag ="whenscottmetmichelle.com, online dating, singles, dating, personals, matchmaker, matchmaking, love, match, dating site, free personals, christian singles, black singles, asian singles, jewish singles, local singles";
$description_tag="An upcoming dating website with millions of profiles. It's free to search and contact your dates.";
include"includes/header.php";
?>
    <div id="sub-twocols" class="clearfix"><!--two col --> 
        <div id="maincol"><!--main col -->
            <div class="info"><!--info col -->
				<?php
				
				$ea = $_REQUEST[ea];		
				
				//request functions 
				$what_is_your_gender=$_REQUEST[what_is_your_gender];
				$gender_you_looking_for=$_REQUEST[gender_you_looking_for];
				$age_range_you_looking_for1=$_REQUEST[age_range_you_looking_for1];
				$age_range_you_looking_for2=$_REQUEST[age_range_you_looking_for2];
				$which_country=$_REQUEST[which_country];
				$interests=$_REQUEST[interests];
				
				
								
				$e = $_REQUEST[e];
				$ad = $_REQUEST[ad]; //advanced
				$ba = $_REQUEST[ba]; //basic
				$o = $_REQUEST[o]; //online tag
				$online = $_REQUEST[online];
				$submit=$_REQUEST[submit];
				
				
				$interests1=$_GET[interests];
				if(!empty($interests1))
				{
							
					//iniate advance search immediately
					$ad=1;
					$e="ad";
				}
				
				//request functions
				
				//protect variables for database entry
				$what_is_your_gender = mysql_real_escape_string($what_is_your_gender);
				$gender_you_looking_for = mysql_real_escape_string($gender_you_looking_for);
				$age_range_you_looking_for1 = mysql_real_escape_string($age_range_you_looking_for1);
				$age_range_you_looking_for2 = mysql_real_escape_string($age_range_you_looking_for2);
				$which_country = mysql_real_escape_string($which_country);
				//protect variables for database entry

/*						
				echo'your gend- '.$what_is_your_gender.'<br>';
				echo'ther gend- '.$gender_you_looking_for.'<br>';
				echo'age 1    - '.$age_range_you_looking_for1.'<br>';
				echo'age 2    - '.$age_range_you_looking_for2.'<br>';
				echo'which co - '.$which_country.'<br>';
				echo'submit   - '.$submit.'<br>';
*/


				switch ($e) {
					case "ba":
						//basic
							$title="quick results";
							//1983-02-15
if(isset($ba))
{
					$youngest  = date("Y-m-d", mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-$age_range_you_looking_for1));
					$oldest  = date("Y-m-d", mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-$age_range_you_looking_for2));
							
							// AND bio.birth_date = '' AND
							//echo'oldest date - '.$oldest.'  youngest - '.$youngest .'<br/><br/>';
							
							//basic search
							$ords ="tm";
							$updown="DESC";
							$whr.="WHERE "; 
							$whr.="bio.what_is_your_gender = '$gender_you_looking_for' AND
							bio.gender_you_looking_for = '$what_is_your_gender' AND
							(signup.birth_date >= '$oldest' AND signup.birth_date <= '$youngest')
							";
							if(!empty($which_country))
							{
							$whr.=" AND bio.where_is_your_home_town = '$which_country'";
							}
							
							$q1="
							SELECT signup.id,
							signup.name,
							signup.userid,
							signup.birth_date,
							signup.profile_prefer,
							login.status,
							login.userid,
							bio.what_is_your_gender,
							bio.gender_you_looking_for,
							bio.where_is_your_home_town,
							bio.age_range_you_looking_for_youngest,
							bio.age_range_you_looking_for_oldest
							FROM signup
							LEFT JOIN login ON signup.userid = login.userid
							LEFT JOIN bio ON signup.id = bio.id
							$whr ORDER BY $ords $updown LIMIT 0, 16";							
						
							//echo''.$q1.'';
}						
						break;
					case "ad":
						//advanced
							$title="advanced results";

if(isset($ad))
{
					if(!empty($age_range_you_looking_for1))
					{
						$youngest  = date("Y-m-d", mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-$age_range_you_looking_for1));
					}
					
					if(!empty($age_range_you_looking_for2))
					{
						$oldest  = date("Y-m-d", mktime(0, 0, 0, date("m"),   date("d"),   date("Y")-$age_range_you_looking_for2));
					}	
							// AND bio.birth_date = '' AND
							//echo'oldest date - '.$oldest.'  youngest - '.$youngest .'<br/><br/>';
							
							//basic search
							$ords ="tm";
							$updown="DESC";
							$whr.="WHERE "; 
							
							if(!empty($gender_you_looking_for) && !empty($what_is_your_gender))
							{
							$whr.="bio.what_is_your_gender = '$gender_you_looking_for' AND bio.gender_you_looking_for = '$what_is_your_gender'";
							$condition="AND";
							}							



							if(!empty($oldest) && !empty($youngest))
							{
							$whr.=" $condition (signup.birth_date >= '$oldest' AND signup.birth_date <= '$youngest')";
							}	
							
							if(!empty($which_country))
							{
							$whr.=" $condition bio.where_is_your_home_town = '$which_country'";
							}
							
							if(!empty($online))
							{
							$whr.=" $condition login.status = 'ON'";
							}
							
							
							if(!empty($interests))
							{
							//if an array - loop it and turn it into a series of or strings
							
							//if a string - wack it into just one string
							if(is_array($interests))
							{
									$whr.=" $condition (";
									foreach ($interests as &$value) 
									{
										$value = mysql_real_escape_string($value);
										$whr.="interests.common_interests LIKE '%$value%' OR ";
									}
									$whr = substr($whr, 0, -4);
									$whr.=" )";
							}
							else
							{
								$interests = mysql_real_escape_string($interests);
								$whr.=" $condition interests.common_interests LIKE '%$interests%'";
							}
							
							
							
							}							
							
							$q1="
							SELECT signup.id,
							signup.name,
							signup.userid,
							signup.birth_date,
							signup.profile_prefer,
							login.status,
							login.userid,
							bio.what_is_your_gender,
							bio.gender_you_looking_for,
							bio.where_is_your_home_town,
							bio.age_range_you_looking_for_youngest,
							bio.age_range_you_looking_for_oldest,
							interests.common_interests
							FROM signup
							LEFT JOIN login ON signup.userid = login.userid
							LEFT JOIN bio ON signup.id = bio.id
							LEFT JOIN interests ON signup.id = interests.id
							$whr ORDER BY $ords $updown LIMIT 0, 16";	
							
							//echo'<b>'.$q1.'</b><br/>';						
						
}
						
						break;
					default:
						//default
							$title="recently online";
							//browse list of people
							
							$ords ="last_logged";
							$updown="DESC";
							if(!empty($o))
							{
								$whr="WHERE login.status = 'ON'";
							}
							$q1="
							SELECT signup.id,
							signup.name,
							signup.userid,
							signup.birth_date,
							signup.profile_prefer,
							login.status,
							login.userid,
							bio.what_is_your_gender,
							bio.where_is_your_home_town
							FROM signup
							LEFT JOIN login ON signup.userid = login.userid
							LEFT JOIN bio ON signup.id = bio.id
							$whr ORDER BY $ords $updown LIMIT 0, 16";
						
						break;
				}


						
						?>
                        
<ul class="options">
<?php
if(!empty($e))
{
	?>
    <li <?php if(preg_match("/e=ba$/", $current_page)){?>class="selected"<?php } ?>><a href="browsing.php?e=ba">Search Results</a></li>
    <li <?php if(preg_match("/e=ad/", $current_page)){?>class="selected"<?php } ?>><a href="browsing.php?e=ad">Advanced Search</a></li>    
    <?php
}
else
{
	?>
	<li <?php if(preg_match("/browsing.php$/", $current_page)){?>class="selected"<?php } ?>><a href="browsing.php">Recently Online</a></li>
    <li <?php if(preg_match("/o=1$/", $current_page)){?>class="selected"<?php } ?>><a href="browsing.php?o=1">Who's Checking You Out</a></li>    
    <?php
}
?>
</ul>
<div class="clr"></div>                       
                        
                        
                        <!-- <h4><?php echo''.$title.''; ?></h4> -->
						
						<?php

				
if(($e=="ba"  && !empty($ba)) || ($e=="ad" && !empty($ad)) || ($e!="ad" && $e!="ba") )
{
//echo''.$q1.'';
$c1->query($q1);

if(!$c1->getNumRows())
{
	if($e=="ba"){?><h4>Error</h4>Sorry we found no matches<?php }
	if($e=="ad" && !empty($ad)){?><h4>Error</h4>Sorry your requirements were too demanding for our current users. If you know anyone that matches your search, get them to join so we can avoid these mistakes.<?php }
	if($e!="ad" && $e!="ba" && $o!="1"){?><h4>Error</h4>Currently no one has registered.<?php }
	if($e!="ad" && $e!="ba" && $o=="1"){?><h4>Error</h4>Currently no one is online.<?php }
}
else
{                      
                        if($rec=$c1->fetchAll())
                        {  

							foreach ($rec as &$value)
							{
									//portrait picture code
									
									$profile_prefer = $value[profile_prefer];		
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
                            <div class="profiles">
                                <div class="profilepiccy">
                                <a href="view-profile.php?id=<?php echo''.$value[id].'';?>" title="<?php echo''.$value[name].'';?>"><?php
						//PROFILE PICTURE

						$dir = "profile/$value[id]/";
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
							$rand_keys = array_rand($profile_pic_array, 1);
							$profile_pic = $profile_pic_array[$rand_keys];
						}
												
						?><img src="<?php echo''.$dir.'';?><?php echo''.$profile_pic.'';?>" alt="Want to date me?" width="140"/><?php
					}
					else
					{
						//display generic gender pics
						?><img src="graphics/<?php echo''.$profile_pic.'';?>" alt="Want to date me?"/><?php
					}


						//PROFILE PICTURE
?>                                
                                
                                </a>
                                </div>
                                <div class="profile-name">
                                <?php 
                                    $pieces = explode(" ", $value[name]);
                                    echo''.$pieces[0].'<br/>'; // piece1		
                                    //echo''.$value[birth_date].'<br/>';
                                    
                                    $d1=strtotime($value[birth_date]);//birth day
                                    $d2=strtotime(date("Y-m-d"));//date
                                    $year = floor(($d2-$d1)/31536000);
                                    
                                $q2 = "SELECT * FROM `_country` WHERE `id` = '$value[where_is_your_home_town]'";
                                $c1->query($q2);		
                                echo''.$year.'';
                                if($rec=$c1->fetchAll())
                                {  
                                    foreach ($rec as &$value2)
                                    {
                                      echo', '.$value2[country].'';
                                    }
                                }	
                                ?>
                                <br/>
                                Status : <?php echo''.$value[status].'';?><br/>
                        <a href="relationships.php?a=1&amp;i=<?php echo''.$value[id].'';?>"><img src="graphics/addBuddy.jpg" alt="Add as a buddy"/></a>
                        <a href="relationships.php?b=1&amp;i=<?php echo''.$value[id].'';?>"><img src="graphics/blockNow.jpg" alt="Block"/></a>
                        <a href="#"><img src="graphics/addFav.jpg" alt="Add to fav"/></a>
                        <a href="#"><img src="graphics/doYouMatch.jpg" alt="Do you match"/></a>
                        <a href="#"><img src="graphics/emailMe.jpg" alt="Email me"/></a>
                        <a href="#"><img src="graphics/forwardNow.jpg" alt="Forward now"/></a>
                        <a href="#"><img src="graphics/reportConcern.jpg" alt="Report concern"/></a>
                        <a href="view-profile.php?id=<?php echo''.$value[id].'';?>"><img src="graphics/seeMore.jpg" alt="See more"/></a>
                                </div>
                                
                            </div>                                
                                <?php
							}//foreach
						}//if
					
}//end of else

}// if conditions met
else
{
	
	if($e=="ad")
	{
		?>
	
	<form id="search2" class="gloss" enctype="multipart/form-data" method="post" action="browsing.php?e=ad#">
		<ul>
		<li>
			<label class="desc" for="what_is_your_gender">
			What is your gender?
			</label>
			<div>
				<select id="what_is_your_gender" name="what_is_your_gender" class="field_select_medium" tabindex="15"> 
					<option value="1" <?php if($what_is_your_gender==1){?>selected="selected"<?php }?> >Man</option>
					<option value="2" <?php if($what_is_your_gender==2){?>selected="selected"<?php }?>>Woman</option>
				</select>
			</div>
		</li>
		
		
		
		<li>
			<label class="desc" for="gender_you_looking_for">
			Who are you looking for?
			</label>
			<div>
				<select id="gender_you_looking_for" name="gender_you_looking_for" class="field_select_medium" tabindex="15"> 
				<option value="2" <?php if($gender_you_looking_for==2){?>selected="selected"<?php }?>>Woman</option>
				<option value="1" <?php if($gender_you_looking_for==1){?>selected="selected"<?php }?>>Man</option>
				</select>
			</div>
		
		<div>
			<label class="desc" for="age_range_you_looking_for1">
			Between the ages
			</label>
				
			
			<select id="age_range_you_looking_for1" name="age_range_you_looking_for1" class="field_select_small" tabindex="15">
			<?php
			for($i=18; $i<=121; $i++)
			{
				?><option value="<?php echo''.$i.'';?>" <?php if(($i==18 && empty($age_range_you_looking_for1)) || ($i==$age_range_you_looking_for1)){?>selected="selected"<?php } ?> ><?php echo''.$i.'';?></option><?php
			}
			?>
			</select>
			and
			
			<select id="age_range_you_looking_for2" name="age_range_you_looking_for2" class="field_select_small" tabindex="15"> 
			<?php
			for($i=18; $i<=121; $i++)
			{
				?><option value="<?php echo''.$i.'';?>" <?php if(($i==39 && empty($age_range_you_looking_for2)) || ($i==$age_range_you_looking_for2)){?>selected="selected"<?php } ?> ><?php echo''.$i.'';?></option><?php
			}
			?>
			</select>           
		</div>	
		</li>
		
		<li>
			<label class="desc" for="which_country">
			Which country?
			</label>
			<div>
				<select id="which_country" name="which_country" class="field_select_medium" tabindex="15"> 
			<?php
		
					$q2 = "SELECT * FROM `_country`";
					$c1->query($q2);		
					
					if($rec=$c1->fetchAll())
					{  
						?><option value="" <?php if($which_country==""){?>selected="selected"<?php }?>>Any</option><?php
						foreach ($rec as &$value)
						{
							?><option value="<?php echo''.$value[id].'';?>" <?php if($which_country==$value[id]){?>selected="selected"<?php }?>><?php echo''.$value[country].'';?></option><?php
						}
					}
			?>
				</select>
			  </div>
		</li>             
				
		
		<li>
				<label class="desc" for="which_country">
				Only those online now?
				</label>
				<div>  
					<input type="checkbox" name="online" value="1"/>
				</div>
		</li>
        
        
        
        
        

	<li>
	<label class="out" for="interests">
	What common interests would you like to share with other members?
	<span id="req_10" class="req">*</span>
	</label>
	<div class="column1">
		<input id="University_Friends" name="interests[]" class="field checkbox" value="University Friends" tabindex="13" type="checkbox"/>
		<label class="choice" for="University_Friends">University Friends</label>
		
		<input id="Camping" name="interests[]" class="field checkbox" value="Camping" tabindex="13" type="checkbox"/>
		<label class="choice" for="Camping">Camping</label>
		
		<input id="Business_networking" name="interests[]" class="field checkbox" value="Business networking" tabindex="13" type="checkbox"/>
		<label class="choice" for="Business_networking">Business networking</label>
		
		<input id="Dining_out" name="interests[]" class="field checkbox" value="Dining out" tabindex="13" type="checkbox"/>
		<label class="choice" for="Dining_out">Dining out</label>
		
		<input id="Gardening_Landscaping" name="interests[]" class="field checkbox" value="Gardening" tabindex="13" type="checkbox"/>
		<label class="choice" for="Gardening_Landscaping">Gardening/Landscaping</label>
		
		<input id="Movies_Videos" name="interests[]" class="field checkbox" value="Movies" tabindex="13" type="checkbox"/>
		<label class="choice" for="Movies_Videos">Movies/Videos</label>
		
		<input id="Music_and_concerts" name="interests[]" class="field checkbox" value="Music and concerts" tabindex="13" type="checkbox"/>
		<label class="choice" for="Music_and_concerts">Music and concerts</label>
		
		<input id="Nightclubs_Dancing" name="interests[]" class="field checkbox" value="Nightclubs" tabindex="13" type="checkbox"/>
		<label class="choice" for="Nightclubs_Dancing">Nightclubs/Dancing</label>
		
		<input id="Playing_cards" name="interests[]" class="field checkbox" value="Playing cards" tabindex="13" type="checkbox"/>
		<label class="choice" for="Playing_cards">Playing cards</label>
		
		<input id="Political_interests" name="interests[]" class="field checkbox" value="Political interests" tabindex="13" type="checkbox"/>
		<label class="choice" for="Political_interests">Political interests</label>
		
		<input id="Shopping_Antiques" name="interests[]" class="field checkbox" value="Shopping" tabindex="13" type="checkbox"/>
		<label class="choice" for="Shopping_Antiques">Shopping/Antiques</label>
		
		<input id="Video_games" name="interests[]" class="field checkbox" value="Video games" tabindex="13" type="checkbox"/>
		<label class="choice" for="Video_games">Video games</label>
		
		<input id="Watching_sports" name="interests[]" class="field checkbox" value="Watching sports" tabindex="13" type="checkbox"/>
		<label class="choice" for="Watching_sports">Watching sports</label>
	</div>
	
	<div class="column2">
		<input id="Book_club_Discussion" name="interests[]" class="field checkbox" value="Book club" tabindex="13" type="checkbox"/>
		<label class="choice" for="Book_club_Discussion">Book club/Discussion</label>
		
		<input id="Coffee_and_conversation" name="interests[]" class="field checkbox" value="Coffee and conversation" tabindex="13" type="checkbox"/>
		<label class="choice" for="Coffee_and_conversation">Coffee and conversation</label>
		
		<input id="Cooking" name="interests[]" class="field checkbox" value="Cooking" tabindex="13" type="checkbox"/>
		<label class="choice" for="Cooking">Cooking</label>
		
		<input id="Fishing_Hunting" name="interests[]" class="field checkbox" value="Fishing" tabindex="13" type="checkbox"/>
		<label class="choice" for="Fishing_Hunting">Fishing/Hunting</label>
		
		<input id="Hobbies_and_crafts" name="interests[]" class="field checkbox" value="Hobbies and crafts" tabindex="13" type="checkbox"/>
		<label class="choice" for="Hobbies_and_crafts">Hobbies and crafts</label>
		
		<input id="Museums_and_art" name="interests[]" class="field checkbox" value="Museums and art" tabindex="13" type="checkbox"/>
		<label class="choice" for="Museums_and_art">Museums and art</label>
		
		<input id="New_to_the_area" name="interests[]" class="field checkbox" value="New to the area" tabindex="13" type="checkbox"/>
		<label class="choice" for="New_to_the_area">New to the area</label>
		
		<input id="Performing_arts" name="interests[]" class="field checkbox" value="Performing arts" tabindex="13" type="checkbox"/>
		<label class="choice" for="Performing_arts">Performing arts</label>
		
		<input id="Playing_sports" name="interests[]" class="field checkbox" value="Playing sports" tabindex="13" type="checkbox"/>
		<label class="choice" for="Playing_sports">Playing sports</label>
		
		<input id="Religion" name="interests[]" class="field checkbox" value="Religion" tabindex="13" type="checkbox"/>
		<label class="choice" for="Religion">Religion</label>
		
		<input id="Travel" name="interests[]" class="field checkbox" value="Travel" tabindex="13" type="checkbox"/>
		<label class="choice" for="Travel">Travel</label>
		
		<input id="Volunteering" name="interests[]" class="field checkbox" value="Volunteering" tabindex="13" type="checkbox"/>
		<label class="choice" for="Volunteering">Volunteering</label>
		
		<input id="Wine_tasting" name="interests[]" class="field checkbox" value="Wine tasting" tabindex="13" type="checkbox"/>
		<label class="choice" for="Wine_tasting">Wine tasting</label>
	</div>
	<div class="clr"></div>
	</li>          
        
        
        
        
        
		<li>
			   <div> 
				<input type="hidden" name="e" value="ad"/>
				<input type="hidden" name="ad" value="1"/>
				<input type="image" name="submit" value="submit" class="field_submit" src="../graphics/search.jpg"/>
			  </div>
		</li>  
		</ul>
		</form>
		
		<?php
	}
	if($e=="ba")
	{
		?>

<form id="search2" class="gloss" enctype="multipart/form-data" method="post" action="browsing.php?e=ba#">
	<ul>
	<li>
        <label class="desc" for="what_is_your_gender">
        What is your gender?
        </label>
        <div>
            <select id="what_is_your_gender" name="what_is_your_gender" class="field_select_medium" tabindex="15"> 
                <option value="1" <?php if($what_is_your_gender==1){?>selected="selected"<?php }?> >Man</option>
                <option value="2" <?php if($what_is_your_gender==2){?>selected="selected"<?php }?>>Woman</option>
            </select>
        </div>
	</li>
	
	
	
	<li>
        <label class="desc" for="gender_you_looking_for">
        Who are you looking for?
        </label>
        <div>
            <select id="gender_you_looking_for" name="gender_you_looking_for" class="field_select_medium" tabindex="15"> 
            <option value="2" <?php if($gender_you_looking_for==2){?>selected="selected"<?php }?>>Woman</option>
            <option value="1" <?php if($gender_you_looking_for==1){?>selected="selected"<?php }?>>Man</option>
            </select>
        </div>
	
	<div>
        <label class="desc" for="age_range_you_looking_for1">
        Between the ages
        </label>
            
        
        <select id="age_range_you_looking_for1" name="age_range_you_looking_for1" class="field_select_small" tabindex="15">
        <?php
        for($i=18; $i<=121; $i++)
        {
            ?><option value="<?php echo''.$i.'';?>" <?php if(($i==18 && empty($age_range_you_looking_for1)) || ($i==$age_range_you_looking_for1)){?>selected="selected"<?php } ?> ><?php echo''.$i.'';?></option><?php
        }
        ?>
        </select>
        and
        
        <select id="age_range_you_looking_for2" name="age_range_you_looking_for2" class="field_select_small" tabindex="15"> 
        <?php
        for($i=18; $i<=121; $i++)
        {
            ?><option value="<?php echo''.$i.'';?>" <?php if(($i==39 && empty($age_range_you_looking_for2)) || ($i==$age_range_you_looking_for2)){?>selected="selected"<?php } ?> ><?php echo''.$i.'';?></option><?php
        }
        ?>
        </select>           
	</div>	
	</li>
    
	<li>
        <label class="desc" for="which_country">
        Which country?
        </label>
        <div>
            <select id="which_country" name="which_country" class="field_select_medium" tabindex="15"> 
        <?php
	
				$q2 = "SELECT * FROM `_country`";
				$c1->query($q2);		
				
				if($rec=$c1->fetchAll())
				{  
					?><option value="" <?php if($which_country==""){?>selected="selected"<?php }?>>Any</option><?php
					foreach ($rec as &$value)
					{
						?><option value="<?php echo''.$value[id].'';?>" <?php if($which_country==$value[id]){?>selected="selected"<?php }?>><?php echo''.$value[country].'';?></option><?php
					}
				}
        ?>
            </select>
            
            <input type="hidden" name="ba" value="1"/>
    		<input type="hidden" name="e" value="ba"/>
            <input type="image" name="submit" value="submit" class="field_submit" src="../graphics/search.jpg"/>
        </div>
	</li>    
	</ul>
	</form>        
		
		<?php
	}
	
}
                ?>
                <div class="clr"></div>
            </div><!--info col -->
        </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

