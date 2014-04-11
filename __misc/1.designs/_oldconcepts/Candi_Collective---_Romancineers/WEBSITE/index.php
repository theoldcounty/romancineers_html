<?php
//define specific meta tags
$title_tag ="When Scott Met Michelle";
$keyword_tag ="whenscottmetmichelle.com, online dating, singles, dating, personals, matchmaker, matchmaking, love, match, dating site, free personals, christian singles, black singles, asian singles, jewish singles, local singles";
$description_tag="An upcoming dating website with millions of profiles. It's free to search and contact your dates.";
include"includes/header.php";
?>
		<div id="sub-twocols" class="clearfix"><!--two col --> 
<div class="hot_splash">
<?php
/*signup*/ 
?>
		<?php $i= rand(1,3);?>
    	<div class="hot_pic">
       		<div><img src="graphics/whenscottminihead.jpg" alt="logo"/></div>
        	<div><img src="graphics/graphic<?php echo''.$i.'';?>.jpg"  alt="When Scott Met Michelle"/></div>
        </div>
    
        <div class="hot_signup">
        	<div class="member_wrap">
			<?php
            if(!isset($_SESSION['id']))
			{
        		?><a href="logins.php?e=login">Members sign in here</a><?php
			}
			else
			{
				?><a href="logins.php?e=logout">Members logut here</a><?php
			}
			?>
            </div>
            <div>
            	<img src="../graphics/makelove.jpg" alt="Make Love happen"/>
        	</div>
        <form id="signup" class="gloss" enctype="multipart/form-data" method="post" action="logins.php?e=signup#" onsubmit="return formValidator();">
		<ul>
            <li>
                <label class="in">
                I am a :
                </label>
                <span>
                <input id="Man1" name="sex" class="field_checkbox" value="1" tabindex="1" type="radio" /> Man
                <input id="Woman1" name="sex" class="field_checkbox" value="2" tabindex="2" type="radio" /> Woman
                </span>
            </li>        
               
        	<li> 
        		<label class="in">
				Seeking a :
				</label>
				<span>
				<input id="Man2" name="gender_you_looking_for" class="field_checkbox" value="1" tabindex="3" type="radio" /> Man
				<input id="Woman2" name="gender_you_looking_for" class="field_checkbox" value="2" tabindex="4" type="radio" /> Woman
				</span>
			</li>
		
			<li>
			<div>
				Between the ages
				<select id="youngage" name="age_range_you_looking_for[]" class="field_select_alternative" tabindex="15">
				<?php
				for($i=18; $i<=121; $i++)
				{
					?><option value="<?php echo''.$i.'';?>" <?php if($i==18){?>selected="selected"<?php } ?> ><?php echo''.$i.'';?></option><?php
				}
				?>
				</select>
				and
				
				<select id="oldage" name="age_range_you_looking_for[]" class="field_select_alternative" tabindex="15"> 
				<?php
				for($i=18; $i<=121; $i++)
				{
					?><option value="<?php echo''.$i.'';?>" <?php if($i==29){?>selected="selected"<?php } ?> ><?php echo''.$i.'';?></option><?php
				}
				?>
				</select>           
			</div>	
			</li>       

            <li>
            <label class="out">
                Your Date of Birth:
            </label>
            
            <span>
                <select id="birthdayday" name="birth_day" class="field_select_alternative" tabindex="15">
                <option value="">Day</option>
                <?php 
                for($j=1;$j<=31;$j++)
                {
                    ?><option value="<?php echo''.$j.'';?>" ><?php echo''.$j.'';?></option><?php
                }
                ?>
                </select>
            </span>
            
            
            <span>
                <select id="birthdaymonth" name="birth_month" class="field_select_alternative" tabindex="15">
                <option value="">Month</option>
                <?php 
                for($j=0;$j<=11;$j++)
                {
                    $montharray=array("January","February","March","April","May","June","July","August","September","October","November","December");
                    ?><option value="<?php echo''.($j+1).'';?>" ><?php echo''.$montharray[$j].'';?></option><?php
                }
                ?>
                </select>
            </span>
            
            
            <span>
                <select id="birthdayyear" name="birth_year" class="field_select_alternative" tabindex="15">
                <option value="">Year</option>
                <?php 
                for($j=1900;$j<=date("Y");$j++)
                {
                    ?><option value="<?php echo''.$j.'';?>" ><?php echo''.$j.'';?></option><?php
                }
                ?>
                </select>
                </span>
            </li>
            
        
            <li>
               <div class="lucoleftfloat">
                <label class="out" for="userid">
                Create Username:
                </label>
                <div>
                <input id="userid" name="userid" type="text" class="field_text_medium" value=""	maxlength="255" tabindex="3"/>
                </div>
               
                <label class="out" for="password">
                Choose Password:
                </label>
                <div>
                <input id="password" name="password" type="password" class="field_text_medium" value=""	maxlength="255" tabindex="3"/>               </div>
               </div>
           
              <div class="lucoleftfloat">     
                   <label class="out" for="email">
                    Email
                    </label>
                    <div>
                    <input id="email" name="email" type="text" class="field_text_medium" value=""	maxlength="255" tabindex="3"/>
                    </div>
                
                <label class="out" id="title2" for="password2">
                    Re-enter Password
                    </label>
                    <div>
                    <input id="password2" name="password2" type="password" class="field_text_medium" value=""	maxlength="255" tabindex="3"/>
                    </div>
                
          	 </div>    
           <div class="clr"></div>
           </li>
                
                <li>
				<div class="lucoleftfloat">                  
                    <label for="userid" class="out">
                    First Name:
                    </label>
                    <div>
                    <input id="first" name="first" type="text" class="field_text_medium" value="" size="8" tabindex="1"/>
                    </div>
            	</div>
           		<div class="lucoleftfloat"> 
                    <label for="email" class="out">
                    Last Name:
                    </label>
                    <div>
                    <input id="last" name="last" type="text" class="field_text_medium" value="" size="14" tabindex="2"/>
                    </div>
                </div>
                <div class="clr"></div>    
                </li>
                
                    
                <li>
                    <label class="out" for="where_is_your_home_town">
                    Where do you live?
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
                        ?><option value="<?php echo''.$value[id].'';?>"><?php echo''.$value[country].'';?></option><?php
                    }
                }
                    ?>
                        </select>
                    </div>
                </li>    
            
            
                <li>             
                    <div class="spanleftfloat">
                    <input id="agree" name="agree" class="field_checkbox" value="yes" tabindex="13" type="checkbox"/>
                    </div>
                    
                    <div class="spanrightfloat">
                    <span class="finedetail">Send me photos of compatible matches, tips announcements and special offers from WhenScottMetMichelle.com.<br/>
        
        			I am at least 18 years old &amp; have read &amp; agree to whenscottmetmichelle.com's terms of use &amp; privacy policy.<br/></span>
                    </div>
                </li>
                
                <li>
                	<input type="hidden" name="todo" value="signup"/>
                    <input type="hidden" name="e" value="signup" />
                    <input type="image" name="submit" value="Submit" class="field_submit" src="../graphics/joinupdate.jpg"/>
                </li>
		</ul>
		</form>
        </div><!-- end of hot signup-->
        <div class="clr"></div><!-- clr right-->
		
</div><!-- end of hot splash-->

<div class="info">
    <b>Internet dating with whenscottmetmichelle.com</b>
    <p>whenscottmetmichelle.com is an independent online dating site, we will use the latest web technologies to make you find love even easier!</p>
    
    <div class="minimembers">
<?php
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
							$whr ORDER BY $ords $updown LIMIT 0, 4";
							
							$c1->query($q1);
							
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
									}//end switch
									

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
                        
						?>
						<div class="profiles">
                    	<a href="view-profile.php?id=<?php echo''.$value[id].'';?>" title="<?php echo''.$value[name].'';?>">
						<?php
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
                                                    
                            ?><img src="<?php echo''.$dir.'';?><?php echo''.$profile_pic.'';?>" alt="Want to date me?" width="140"/>					<?php
                        }
                        else
                        {
                            //display generic gender pics
                            ?><img src="graphics/<?php echo''.$profile_pic.'';?>" alt="Want to date me?"/><?php
                        }
						?>
                        </a>
                    </div>
						<?php									
									
}//end of foreach			
							?><div class="clr"></div><?php				
							}//end of if rec

						//PROFILE PICTURE
?>                 							
  
    <a href="browsing.php?e=ba">Search</a> | <a href="browsing.php">Recently Online</a>
    </div>
    
    <b>Search through millions to find the one</b>
    <p>As a registered member you can browse through photos of thousands of gorgeous single men and women absolutely free. We can help refine your search based on your date requirements.</p>
    
    <p>Once subscribed, you can email whoever you like, continue to search other members' dating profiles and see who's shown an interest in dating you!</p>
    
    <p>Join up for free and start online dating today.</p>
</div>

<?php
/*Signup*/
?>   
    
		</div><!--two col --> 
<?php include"includes/footer.php";?>

