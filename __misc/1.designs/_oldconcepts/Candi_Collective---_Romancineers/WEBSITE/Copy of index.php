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
//functions



//functions

				
$ords ="tm";
$updown="DESC";
//$whr="WHERE login.status = 'ON'";

$q1="
SELECT signup.id, signup.name, signup.userid, signup.birth_date, login.status, login.userid, bio.what_is_your_gender,  bio.where_is_your_home_town
FROM signup
LEFT JOIN login ON signup.userid = login.userid
LEFT JOIN bio ON signup.id = bio.id
$whr ORDER BY $ords $updown LIMIT 0, 16";	

//echo''.$q1.'';
$c1->query($q1);

if(!$c1->getNumRows())
{
	?><h4>Currently no one has registered</h4><?php
}
else
{                      
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
<div class="profiles">
    <div><a href="view-profile.php?id=<?php echo''.$value[id].'';?>"><img src="graphics/<?php echo''.$profile_pic.'';?>" alt="Want to date me?"/></a></div>
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
    Status : <?php echo''.$value[status].'';?><br>
	<a href="#"><img src="graphics/buddy.jpg" alt="Send a wink"/></a>
	<a href="view-profile.php?id=<?php echo''.$value[id].'';?>"><img src="graphics/buddy.jpg" alt="Add as a buddy"/></a>
	<a href="#"><img src="graphics/buddy.jpg" alt="Send a private message"/></a>
	<a href="#"><img src="graphics/buddy.jpg" alt="View profile"/></a>	
    </div>
    
</div>                                
                                <?php
							}
						}
}
                ?>
                <div class="clr"></div>
 
            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

