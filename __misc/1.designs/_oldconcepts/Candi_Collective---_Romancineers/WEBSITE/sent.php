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

if(!isset($_SESSION['id']))
{
	?>Sorry only logged in members can view this page<?php
}
else
{
			$c1->query("SELECT * FROM `signup` WHERE `userid` = '$_SESSION[userid]'");  
			//scan results and pull out array
			if($rec=$c1->fetchAll())
			{  
				//foreach
				foreach ($rec as &$value)
				{
					//relationship_status
					$profile_id = $value[id];// your profile id
				}
			}


		?><h2><a href="inbox.php">Inbox</a> / <a href="sent.php">Sent</a></h2><?php

	
		$c1->query("SELECT * FROM `private_message` WHERE `fromuser` = '$profile_id' AND `deleted` = '0' ORDER BY `datesent` DESC");  
			
		$pm_num = $c1->getNumRows();
		if($pm_num!=0)
		{	
			//scan results and pull out array
			if($rec=$c1->fetchAll())
			{  
				//foreach
				foreach ($rec as &$value)
				{
					//relationship_status
					$id = $value[id];
					$touser = $value[touser];
					$fromuser = $value[fromuser];
	
	
					$c1->query("SELECT 
	signup.userid, basics.what_is_your_gender
	FROM signup
	LEFT JOIN basics ON signup.id = basics.id
	WHERE signup.id =$fromuser");  
					//scan results and pull out array
					if($rec2=$c1->fetchAll())
					{  
						//foreach
						foreach ($rec2 as &$value2)
						{
							//relationship_status
							$fromuserid = $value2[userid];
							
							//portrait picture code		
							switch ($value2[what_is_your_gender]) {
							case 1:
								$profile_pic_thumbnail = "i_am_a_scott_t.jpg";
								break;
							case 2:
								$profile_pic_thumbnail = "i_am_a_michelle_t.jpg";
								break;
							default:
								$profile_pic_thumbnail = "i_am_a_neutral.jpg";
								break; 							     
							}								
						}
					}				
					
					
					$subject = $value[subject];
					$message = $value[message];
					$read = $value[read];
					$deleted = $value[deleted];
					$datesent = $value[datesent];


						$c1->query("SELECT * FROM `signup` WHERE `id` = '$touser'");  
						//scan results and pull out array
						if($rec=$c1->fetchAll())
						{  
							//foreach
							foreach ($rec as &$value)
							{
								//relationship_status
								$touserid = $value[userid];// their profile user id
							}
						}
										
					?>
					
					
					
	 <dl class="layout">
		<dt>
			<a href="view-profile.php?id=<?php echo''.$fromuser.'';?>">
				<img src="graphics/<?php echo''.$profile_pic_thumbnail.'';?>" alt="<?php echo''.$fromuserid.''; ?>">
			</a>
		</dt>
		<dd>
			<dl class="message">
				<dt><b>Subject</b>:</dt>
				<dd>
					<?php echo''.$subject.'';?>
				</dd>
				<dt><b>Message</b>:</dt>
				<dd><?php echo''.$message.'';?></dd>
			</dl>
			
			<div class="container_meta" style="margin-top: 8px; margin-bottom: 12px;">
				<p>
					from <a href="view-profile.php?id=<?php echo''.$touser.'';?>"><?php echo''.$touserid.''; ?></a>, <?php echo''.$datesent.''; ?>
				</p>
			</div>
		</dd>
	</dl>
	  
	<div class="clr"></div>
	
					<?php
				}	
		}
		else
		{
			?>sorry you don't have any recent messages.<?php
		}
	
	}
}    
?>

        
                
                
                
                    
            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

