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
				<h4>Relationships</h4>
				<?php
				
if($_SESSION['signupid'])
{				
				 echo'if you have any buddies they will be listed here.';
				 
				 $i = $_REQUEST[i];
				 $a = $_REQUEST[a];
				 $b = $_REQUEST[b];
				 $c = $_REQUEST[c];
				 
				 $i=mysql_real_escape_string($i);
				 
				 //FRIENDSHIP//
				 if(!is_null($a) && is_null($b) && is_null($c))
				 {
					switch ($a) {
						case 0:
					//remove state
					?><h4>Remove friend</h4><?php
					echo'You have cleared this state.';
										
					//relationship 2 - friend
					$q2 = "DELETE FROM `buddy_system` WHERE  `relationship` = '2'
					AND (`user1` = '{$_SESSION['signupid']}' AND `user2` = '$i'
					OR `user2` = '{$_SESSION['signupid']}' AND `user1` = '$i');";
					$c1->query($q2);
					//remove state
							break;
						case 1:
					//add block
				 	?><b>Confirm your friendship</b><?php
					
					//relationship 2 - friend/buddy
					$q2 = "SELECT * FROM `buddy_system` WHERE `relationship` = '2'
					AND (`user1` = '{$_SESSION['signupid']}' AND `user2` = '$i'
					OR `user2` = '{$_SESSION['signupid']}' AND `user1` = '$i');";
					$c1->query($q2);
					
						$numcount = $c1->getNumRows();	
						if($numcount==0)
						{				
						$q2 = "INSERT INTO `buddy_system` (`user1` , `user2` , `relationship` , `confirm`)
						VALUES ('{$_SESSION['signupid']}', '$i', '2', '1');";
						$c1->query($q2);
							?>An email has been sent to user '.$i.' to confirm your friendship. Please continue to browse for other friends until they accept. Once they have excepted you will be able to take your relationship further with a private message.
							<?php
						}
						else
						{
							?>You are already friends.<?php
						}
					//add block
							break;
					}									
														
				 }
				 //FRIENDSHIP//
				 
				 
				 //BLOCK//
				 if(!is_null($b) && is_null($a) && is_null($c))
				 {
					switch ($b) {
						case 0:
					//remove state
					?><h4>Remove block</h4><?php
					echo'You have cleared this state.';
					
					echo'<br/>user1 : '.$_SESSION['signupid'].'<br/>';
					echo'<br/>user2 : '.$i.'<br/>';
					
					//relationship 1 - blocked
					$q2 = "DELETE FROM `buddy_system` WHERE  `relationship` = '1'
					AND (`user1` = '{$_SESSION['signupid']}' AND `user2` = '$i'
					OR `user2` = '{$_SESSION['signupid']}' AND `user1` = '$i');";
					$c1->query($q2);
					//remove state
							break;
						case 1:
					//add block
					?><h4>Confirm you wish to block this user</h4><?php
					echo'If you choose to block this user, they will no longer show up in your search results or browse results. Also their instanst messages will not be displayed. You may choose to unblock them in the future.';
					
					echo'<br/>user1 : '.$_SESSION['signupid'].'<br/>';
					echo'<br/>user2 : '.$i.'<br/>';
					
					//relationship 1 - blocked
					$q2 = "SELECT * FROM `buddy_system` WHERE `relationship` = '1'
					AND (`user1` = '{$_SESSION['signupid']}' AND `user2` = '$i'
					OR `user2` = '{$_SESSION['signupid']}' AND `user1` = '$i');";
					$c1->query($q2);
					
						$numcount = $c1->getNumRows();	
						if($numcount==0)
						{												
						$q2 = "INSERT INTO `buddy_system` (`user1` , `user2` , `relationship` , `confirm`)
						VALUES ('{$_SESSION['signupid']}', '$i', '1', '1');";
						$c1->query($q2);
						}
						else
						{
							?>You have already blocked this user.<?php
						}
					//add block
							break;
					}														
				 }		
				 //BLOCK//



				 //LOVE//
				 if(is_null($b) && !is_null($a) && !is_null($b))
				 {
					switch ($c) {
						case 0:
					//remove state
					?><h4>Remove Lover state</h4><?php
					echo'You have cleared this state.';
					
					echo'<br/>user1 : '.$_SESSION['signupid'].'<br/>';
					echo'<br/>user2 : '.$i.'<br/>';
					
					//relationship 3 - lovers
					$q2 = "DELETE FROM `buddy_system` WHERE  `relationship` = '3'
					AND (`user1` = '{$_SESSION['signupid']}' AND `user2` = '$i'
					OR `user2` = '{$_SESSION['signupid']}' AND `user1` = '$i');";
					$c1->query($q2);
					//remove state
							break;
						case 1:
					//add block
					?><h4>Confirm you wish to fall in love this user</h4><?php
					echo'They will now pick up a confirmation email to confirm this new state of affection.';
					
					echo'<br/>user1 : '.$_SESSION['signupid'].'<br/>';
					echo'<br/>user2 : '.$i.'<br/>';
					
					//relationship 3 - lovers
					$q2 = "SELECT * FROM `buddy_system` WHERE `relationship` = '3'
					AND (`user1` = '{$_SESSION['signupid']}' AND `user2` = '$i'
					OR `user2` = '{$_SESSION['signupid']}' AND `user1` = '$i');";
					$c1->query($q2);					
					
						$numcount = $c1->getNumRows();	
						if($numcount==0)
						{							
						$q2 = "INSERT INTO `buddy_system` (`user1` , `user2` , `relationship` , `confirm`)
						VALUES ('{$_SESSION['signupid']}', '$i', '3', '1');";
						$c1->query($q2);
						//add block
						}
						else
						{
							?>You are already lovers.<?php
						}
							break;
					}														
				 }		
				 //LOVE//

			
	//if a and b and c are null//			 
	if(is_null($b) && is_null($a) && is_null($c))
	{				 
			//LOVE LIST//			 
						?><h4>Love List</h4><?php 
			$q2 = "SELECT * FROM `buddy_system` WHERE `user1` = '{$_SESSION['signupid']}' AND  `relationship` = '3' AND `confirm` = '1' ;";
			$c1->query($q2);
			if($rec=$c1->fetchAll())
			{  
				foreach ($rec as &$value2)
				{
					$q2 = "SELECT name FROM `signup` WHERE `id` = '{$value2[user2]}'; ";
					$c1->query($q2);
					if($rec1=$c1->fetchAll())
					{  
						foreach ($rec1 as &$value3)
						{
							$name =$value3[name];
						}
					}
					
				  ?><li><a href="view-profile.php?id=<?php echo''.$value2[user2].'';?>"><?php echo''.$name.''; ?></a> - <span class="finedetail"><?php echo''.nicetime($value2[last_updated]).'';?></span> - <a href="relationships.php?c=0&i=<?php echo''.$value2[user2].'';?>">remove</a></li><?php
				}
			}
			else
			{
				?>You have not established a love list yet<?php
			}
			//LOVE LIST//
			
			
			//FRIEND LIST//						 
							?><h4>Friend List</h4><?php 
			
			$q2 = "SELECT * FROM `buddy_system` WHERE `user1` = '{$_SESSION['signupid']}' AND  `relationship` = '2' AND `confirm` = '1' ;";
			$c1->query($q2);	
			if($rec=$c1->fetchAll())
			{  
				?><ul><?php
				foreach ($rec as &$value2)
				{
					$q2 = "SELECT name FROM `signup` WHERE `id` = '{$value2[user2]}'; ";
					$c1->query($q2);
					if($rec1=$c1->fetchAll())
					{  
						foreach ($rec1 as &$value3)
						{
							$name =$value3[name];
						}
					}
					
				  ?><li><a href="view-profile.php?id=<?php echo''.$value2[user2].'';?>"><?php echo''.$name.''; ?></a> - <span class="finedetail"><?php echo''.nicetime($value2[last_updated]).'';?></span> - <a href="relationships.php?a=0&i=<?php echo''.$value2[user2].'';?>">remove</a></li><?php
				}
				?></ul><?php
			}
			else
			{
				?>You have not established a friend list yet<?php
			}
			//FRIEND LIST//	
			
			//BLOCK LIST//					
							?><h4>Block List</h4><?php  
			
			$q2 = "SELECT * FROM `buddy_system` WHERE `user1` = '{$_SESSION['signupid']}' AND  `relationship` = '1' AND `confirm` = '1' ;";
			$c1->query($q2);
			if($rec=$c1->fetchAll())
			{  
				?><ul><?php
				foreach ($rec as &$value2)
				{
					$q2 = "SELECT name FROM `signup` WHERE `id` = '{$value2[user2]}'; ";
					$c1->query($q2);
					if($rec1=$c1->fetchAll())
					{  
						foreach ($rec1 as &$value3)
						{
							$name =$value3[name];
						}
					}
					
				  ?><li><a href="view-profile.php?id=<?php echo''.$value2[user2].'';?>"><?php echo''.$name.''; ?></a> - <span class="finedetail"><?php echo''.nicetime($value2[last_updated]).'';?></span> - <a href="relationships.php?b=0&i=<?php echo''.$value2[user2].'';?>">unblock</a></li><?php
				}
				?></ul><?php
			}				 		 
			else
			{
				?>You have not got anyone on block, lets try and keep it this way.<?php
			}
			//BLOCK LIST//
	}//if a and b and c are null//	

}
else
{
	?>Sorry you need to be logged in.<?php
}
                ?>
                <div class="clr"></div>
 				</div>
            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

