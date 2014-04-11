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
	//uncover your id
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
	$sendto=$_REQUEST[sendto];
	$type=$_REQUEST[type];
	$subject_r=$_REQUEST[subject_r];
	$todo=$_REQUEST[todo];
	$message_r=$_REQUEST[message_r];
	

	
	if(!get_magic_quotes_gpc())
	{
		$subject_r=mysql_real_escape_string($subject_r);
		$todo=mysql_real_escape_string($todo);
		$message_r=mysql_real_escape_string($message_r);				
	}	


	switch ($type) {
		case 1:
			//send private message
			echo'<h3>Send a private message</h3>';
			//$profile_id - your id
			//$sendto their id
			
							//form submitted validate results
							if(isset($todo) and $todo=="update-profile")
							{
										if($c1->query("
INSERT INTO `private_message` ( `touser` , `fromuser` , `subject` , `message` , `read` , `deleted` , `datesent` )
VALUES ('$sendto', '$profile_id', '$subject_r', '$message_r', '0', '0', NOW( ))"))
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
							<h2>Send a private message</h2>
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
							<input type="hidden" name="sendto" value="<?php echo''.$sendto.''; ?>" size="20" />
                            <input type="hidden" name="type" value="1" size="20" />
							<input type="reset" value="Reset" size="20" />
							<input type="submit" value="Submit" size="20" />
							</form>
							
							<?php
							}//end of else
	
				
			break;
		case 2:
			//send wink
			echo'<h3>Send a wink</h3>';			
			//$profile_id - your id
			//$sendto their id
			$type=2;
						
			break;
	}

}    
?>
            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

