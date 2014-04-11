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
 
function check_email($str)
{
	//returns 1 if valid email, 0 if not
	if(ereg("^.+@.+\..+$", $str))
		return 1;
	else
		return 0;
}



$sub = $_REQUEST[sub];
$subscribe = $_REQUEST[subscribe];
$myemail = $_REQUEST[myemail];
$myemail1 = trim($myemail); //trim whitespace from the stored variable
$myemail = addslashes($myemail);


if(!empty($subscribe))
{

		if(!empty($myemail) && check_email("$myemail"))
		{
					if ($sub==1)
					{
						$c1->query("SELECT * FROM  `newsletter`  WHERE `email_address` = '$myemail'");
						$num_rows = $c1->getNumRows();	
						
						if($num_rows!=0)
						{
							?>We apologise, your email address seems to already exist in our system<?php
						}
						else
						{			//insert email into system
							$c1->query("INSERT INTO `newsletter` (`email_address`,`date`) VALUES ('$myemail1','$current_date');");
								
							//query number of emails							
							$c1->query("SELECT * FROM newsletter");
							$num_rows = $c1->getNumRows();				
							
							//welcome text
							?>Thank you for subscribing to our newsletter. You will be among <?php echo''.$num_rows.''; ?> others who will recieve this months newsletter. Your address <b><?php echo''.$myemail.''; ?></b> has been included.	<br/>Thank you again for your support.<?php
						}							
		
					}
					else
					{	
									//delete email from newsletter
									$c1->query("DELETE  FROM  `newsletter`  WHERE `email_address` = '$myemail' LIMIT 1");
																		
									//query how many are on the newsletter
									$c1->query("SELECT * FROM newsletter");
									$num_rows = $c1->getNumRows();		
							
							//goodbye text
							?>We are sorry to see you leave, but thank you for being part of the experience. <?php echo''.$num_rows.''; ?> others will now recieve this months newsletter. Your address <b><?php echo''.$myemail.''; ?></b> has been removed.	<br/>Thank you again for your support.<?php		
		
					}
		
		}
		else
		{
			?>Your email address was not valid<?php
		}
}
else
{
			//if not submit
		?>	

			A sample of the newsletter is below. This is how it will appear in the e-mail. To receive the Insomniac Mania newsletter please enter your email address below. You may cancel the newsletter at anytime, by re-entering the same e-mail address and by selecting unsubscribe.<br/>

				<form name="form1" method="post" action="#">
				Email Address:<br/>
				<input type="text" name="myemail" size="50"><br/>
				<input type="radio" name="sub" value="1" checked="checked">Subscribe
				<input type="radio" name="sub" value="2">Unsubscribe
				<br/>
				<input type="submit" name="subscribe" value="Submit">
				<input type="reset" name="Submit2" value="Reset">
				</form>

			<?php
}
?>                    
                
		
                <div class="clr"></div>
 
            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

