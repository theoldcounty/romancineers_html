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
							//variables
							$todo=$_REQUEST[todo];
							$subject_r=$_REQUEST[subject_r];
							$message_r=$_REQUEST[message_r];
							$fromuser=$_REQUEST[fromuser];
							$reply = $_REQUEST[reply];
							
							if(!get_magic_quotes_gpc())
							{
								$todo=mysql_real_escape_string($todo);
								$subject_r=mysql_real_escape_string($subject_r);
								$message_r=mysql_real_escape_string($message_r);
								$fromuser=mysql_real_escape_string($fromuser);
								$reply=mysql_real_escape_string($reply);
							}		

	//display all messages
	if(!empty($reply))
	{
		//check you should be able to reply and see this message
		$c1->query("SELECT * FROM `private_message` WHERE `id` = '$reply' AND `touser` = '$profile_id'");
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
	signup.id, signup.userid, basics.what_is_your_gender
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
							$fromuser = $value2[id];
							
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
					<a href="inbox.php?reply=<?php echo''.$id.'';?>">
						<?php echo''.$subject.'';?>
					</a>
				</dd>
				<dt><b>Message</b>:</dt>
				<dd><?php echo''.$message.'';?></dd>
			</dl>
			
			<div class="container_meta" style="margin-top: 8px; margin-bottom: 12px;">
				<p>
					from <a href="view-profile.php?id=<?php echo''.$fromuser.'';?>"><?php echo''.$fromuserid.''; ?></a>, <?php echo''.$datesent.''; ?>
				</p>
			</div>
		</dd>
	</dl>
	  
	<div class="clr"></div>
	
					<?php

					
						//display form to reply						


						//** REPLY FORM **//

							
								//collect all data of the member
											
							// check the login details of the user and stop execution if not logged in
							
							//form submitted validate results
							if(isset($todo) and $todo=="update-profile")
							{
										if($c1->query("
INSERT INTO `private_message` ( `touser` , `fromuser` , `subject` , `message` , `read` , `deleted` , `datesent` )
VALUES ('$fromuser', '$profile_id', '$subject_r', '$message_r', '0', '0', NOW( ))"))
										{
											echo "You have successfully replied<br>";
										}
										else
										{
											echo "There is some problem in replying<br>";
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
							<h2>Reply</h2>
							</div>
							

	
                            <li id="foli2" 	class="">
                                <label class="desc" id="title2" for="Field2">
                                Subject
                                </label>
                                <div>
                                <input id="Field2" name="subject_r" type="text" class="field text medium" value=""	maxlength="255" tabindex="3"/>
                                </div>
                            </li>
	
							
							<li id="fo59li1" class="altInstruct">
								<label class="desc" id="title1" for="Field1">
								Message
								<span id="req_1" class="req">*</span>
								</label>
								<div>
								<textarea id="Field1" name="message_r" class="field textarea medium" rows="10" cols="50" tabindex="2"></textarea>
								</div>
								<p class="instruct" id="instruct1"><small>Express your success and your latest ambitions.</small></p>
							</li>
							</ul>
							<input type="hidden" name="reply" value="<?php echo''.$reply.''; ?>" size="20" />
							<input type="hidden" name="fromuser" value="<?php echo''.$fromuser.''; ?>" size="20" />
							<input type="reset" value="Reset" size="20" />
							<input type="submit" value="Submit" size="20" />
							</form>
							
							<?php
							}//end of else
					//** REPLY FORM **//
					
					
				}
			}
		}
		else
		{
			echo'Sorry if this message does not exist, or you have tried to reply to someone elses message...you think we\'re stupid?';
		}
		
		
		
	}
	else
	{
		?><h4><a href="inbox.php">Inbox</a> / <a href="sent.php">Sent</a></h4><?php

	
		$c1->query("SELECT * FROM `private_message` WHERE `touser` = '$profile_id' AND `deleted` = '0' ORDER BY `datesent` DESC");  
			
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
					
	//you are looking at this message so consider it read
					$c1->query("UPDATE `private_message` SET `read` = '1' WHERE `id` = '$id' LIMIT 1");							
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
					<a href="inbox.php?reply=<?php echo''.$id.'';?>">
						<?php echo''.$subject.'';?>
					</a>
				</dd>
				<dt><b>Message</b>:</dt>
				<dd><?php echo''.$message.'';?></dd>
			</dl>
			
			<div class="container_meta" style="margin-top: 8px; margin-bottom: 12px;">
				<p style="float: right;">
					<a href="inbox.php?reply=<?php echo''.$id.'';?>">Reply</a> | <span onclick="message_delete(5134124, this)">Delete</span>
				</p>
				<p>
					from <a href="view-profile.php?id=<?php echo''.$fromuser.'';?>"><?php echo''.$fromuserid.''; ?></a>, <?php echo''.$datesent.''; ?>
				</p>
			</div>
		</dd>
	</dl>
	  
	<div class="clr"></div>
	
					<?php
				}	
			}
		}
		else
		{
			?>sorry you don't have any recent messages.<?php
		}
	
	}
}    
?>

                 </div><!--end of info -->
            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

