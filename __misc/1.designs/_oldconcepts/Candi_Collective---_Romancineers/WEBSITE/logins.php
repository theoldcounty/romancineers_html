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


	$e=$_REQUEST[e];
	switch ($e) {
		case "signup":
		/*Signup*/
		?><div class="info">
		<h4>Signup</h4><?php
		
		// Collect the data from post method of form submission //
		$userid=$_POST['userid'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];
		$agree=$_POST['agree'];
		$todo=$_POST['todo'];
		$email=$_POST['email'];
		$first = $_POST['first'];
		$last = $_POST['last'];
		$sex=$_POST['sex'];
		
		$where_is_your_home_town=$_POST['where_is_your_home_town'];
		$person=$_POST['person'];
		
		if(!empty($person))
		{
			$person = implode(",", $person);
		}
		$person=mysql_real_escape_string($person);
		
		
		$gender_you_looking_for=$_POST['gender_you_looking_for'];
		$birth_year=$_POST['birth_year'];
		$birth_month=$_POST['birth_month'];
		$birth_day=$_POST['birth_day'];
		
		$age_range_you_looking_for =$_POST['age_range_you_looking_for'];
		
		$youngest = $age_range_you_looking_for[0];
		$oldest = $age_range_you_looking_for[1];
		
		$userid=mysql_real_escape_string($userid);
		$password=mysql_real_escape_string($password);
		$password2=mysql_real_escape_string($password2);
		$agree=mysql_real_escape_string($agree);
		$todo=mysql_real_escape_string($todo);
		$email=mysql_real_escape_string($email);
		$first=mysql_real_escape_string($first);
		$last=mysql_real_escape_string($last);
		$sex=mysql_real_escape_string($sex);
		$gender_you_looking_for=mysql_real_escape_string($gender_you_looking_for);
		$birth_year=mysql_real_escape_string($birth_year);
		$birth_month=mysql_real_escape_string($birth_month);
		$birth_day=mysql_real_escape_string($birth_day);
		
		$youngest=mysql_real_escape_string($youngest);
		$oldest=mysql_real_escape_string($oldest);
		$where_is_your_home_town=mysql_real_escape_string($where_is_your_home_town);
		
		
		$birth_date = $birth_year."-".$birth_month."-".$birth_day;
		
		if(isset($todo) and $todo=="signup")
		{
			$status = "OK";
			$msg="";
				
			// if userid is less than 3 char then status is not ok
			if(!isset($userid) || strlen($userid) <3 && strlen($userid) >255)
			{
				$msg=$msg."User id should be at least three but no more two hundred and fifty five characters in length<br/>";
				$status= "NOTOK";
			}
			
		
			$c1->query("SELECT userid FROM signup WHERE userid = '$userid'");	
			if($c1->getNumRows())
			{
				$msg=$msg."Userid already exists. Please try another one<br/>";
				$status= "NOTOK";
			}
			
			$c1->query("SELECT email FROM signup WHERE email = '$email'");	
			if($c1->getNumRows())
			{
				$msg=$msg."This email already exists in our system. If you have forgotten your password please visit this <a href=\"logins.php?e=forgot_password\">link</a>. If you encounter further problems please contact an <a href=\"mailto:$site_admin_email\">administrator</a>.<br/>";
				$status= "NOTOK";
			}			
		
			if (strlen($password) < 3 )
			{
				$msg=$msg."Password must be more than 3 characters length<br/>";
				$status= "NOTOK";
			}
			
			if ( $password <> $password2 )
			{
				$msg=$msg."Both passwords are not matching<br/>";
				$status= "NOTOK";
			}
		
			if ($agree<>"yes")
			{
				$msg=$msg."You must agree to terms and conditions<br/>";
				$status= "NOTOK";
			}
			
			
			$k=18;
			$date3 = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")-$k));
			if ($birth_date >= $date3)
			{
				$msg=$msg."You have to be over 18 to join this site.<br/>";
				$status= "NOTOK";
			}	
			
			if($status<>"OK")
			{
				?><font face='Verdana' size='2' color=red><?php echo''.$msg.''; ?></font><br/>
				<input type="image" name="retry" value="retry" class="field_submit" src="../graphics/login.jpg" onClick="history.go(-1);"/>
				<?php
			}
			else
			{ // if all validations are passed.
		
		
				//random hash
				$hash= generateRandomString();
				$hash= md5($hash);
						
				echo "<font face='Verdana' size='2' color=green>Welcome, You have successfully signed up<br><br><a href=login.php>Click here to login</a><br></font>";		
					$adminemail="$site_admin_email";         ///// Change this address within quotes to your address ///
					$headers.="Reply-to: $adminemail\n";
					$headers .= "From: $adminemail\n";
					$headers .= "Errors-to: $adminemail\n";
					//$headers = "Content-Type: text/html; charset=iso-8859-1\n".$headers;// for html mail un-comment this line
				
					if(mail("$email","Your account for $site_name","Thank you for joining $site_name . We hope you are able to find the right person with us. Your login details are as follows: \n \nLogin ID: $userid \n Password: $password \n\n Please confirm your account via this link $site_editor_host/logins.php?e=confirm&email=$email&hash=$hash \n\nThank You \n \n $site_admin_name","$headers"))
					{
						echo "<b>Thank you</b> <br>Your password has been posted to your email address . Please check your mail.";
					}		
					
		
					
				//encyrpt password
				$password= md5($password);
				$name = "$first $last";
				
		
		//signup
		$c1->query("INSERT INTO signup(userid,password,email,name,registered,birth_date,last_logged,login_count,confirm_hash,is_confirmed) values('$userid','$password','$email','$name','$current_time','$birth_date','$current_time','1','$hash','0')");	
		
		$lastid =mysql_insert_id();
		
		//bio
		$c1->query("INSERT INTO bio(id, what_is_your_gender, gender_you_looking_for, age_range_you_looking_for_youngest, age_range_you_looking_for_oldest, where_is_your_home_town, last_updated) values('$lastid','$sex','$gender_you_looking_for', '$youngest', '$oldest', '$where_is_your_home_town' , '$current_time')");					
		
		
		//login
		$c1->query("INSERT INTO login(userid,ip,tm,status)  values('$userid','$ip','$tm','OFF')");
		
		
		//personality
		$c1->query("INSERT INTO personality(id, person_words, last_updated) values('$lastid','$person','$current_time')");
		
		
?>
            	<?php $return_url = "browsing.php"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 2500);
                </script>	
<?php			
		
		
			}
		}
		else
		{
		?>
		<form id="signup" name="signup" class="gloss" autocomplete="off" enctype="multipart/form-data" method="post" action="#public">
		<input type="hidden" name="todo" value="signup"/>
		
		<ul>
		<li>
		<label class="out" id="title2" for="Field2">
		User ID
		</label>
		<div>
		<input id="Field2" name="userid" type="text" class="field_text_medium" value=""	maxlength="255" tabindex="3"/>
		</div>
		</li>
		
		<li>
		<label class="out" id="title2" for="Field2">
		Password
		</label>
		<div>
		<input id="Field2" name="password" type="password" class="field_text_medium" value=""	maxlength="255" tabindex="3"/>
		</div>
		
		<label class="out" id="title2" for="Field2">
		Re-enter Password
		</label>
		<div>
		<input id="Field2" name="password2" type="password" class="field_text_medium" value=""	maxlength="255" tabindex="3"/>
		</div>
		</li>
		
		<li>
		<label class="out" id="title2" for="Field2">
		Email
		</label>
		<div>
		<input id="Field2" name="email" type="text" class="field_text_medium" value=""	maxlength="255" tabindex="3"/>
		</div>
		</li>
		
		<li>
		<label class="out" id="title106" for="Field106">
		Name
		</label>
		<span>
		<input id="Field106" name="first" type="text" class="field_text_medium" value="" size="8" tabindex="1"/>
		<label for="Field106">First</label>
		</span>
		<span>
		<input id="Field107" name="last" type="text" class="field_text_medium" value="" size="14" tabindex="2"/>
		<label for="Field107">Last</label>
		</span>
		</li>
		
		
		
		<li>
		<label class="out" id="title14" for="Field14">
		Birthday
		</label>
		<span>
		Year:
		<select id="Field14" name="birth_year" class="field_select_medium" tabindex="15">
		<?php 
		for($j=date("Y");$j>=1900;$j--)
		{
			if($j==date("Y")-18) { ?><option value="<?php echo''.$j.'';?>" selected="selected"><?php echo''.$j.'';?></option><?php }
			else {?><option value="<?php echo''.$j.'';?>" ><?php echo''.$j.'';?></option><?php }
		}
		?>
		</select>
		</span>
		
		<span>
		Month:
		<select id="Field14" name="birth_month" class="field_select_medium" tabindex="15">
		<?php 
		for($j=1;$j<=12;$j++)
		{
			?><option value="<?php echo''.$j.'';?>" ><?php echo''.$j.'';?></option><?php
		}
		?>
		</select>
		</span>
		
		<span>
		Day:
		<select id="Field14" name="birth_day" class="field_select_medium" tabindex="15">
		<?php 
		for($j=1;$j<=31;$j++)
		{
			?><option value="<?php echo''.$j.'';?>" ><?php echo''.$j.'';?></option><?php
		}
		?>
		</select>
		</span>
		</li>
		
		
		<li>
		<label class="out" id="title0" for="Field0">
		Gender
		<span id="req_0" class="req">*</span>
		</label>
		<span>
		<input id="Field15" name="sex" class="field_checkbox" value="1" tabindex="13" type="radio" />
		<label class="choice" for="Field15">Male</label>
		</span>
		
		<span>
		<input id="Field15" name="sex" class="field_checkbox" value="2" tabindex="13" type="radio" />
		<label class="choice" for="Field15">Female</label>
		</span>
		</li>
		
		<li>
			<label class="out" id="title0" for="Field0">
			What words describe your personality?
			<span id="req_0" class="req">*</span>
			</label>
			<div class="column1">
				<input id="Field15" name="person[]" class="field_checkbox" value="Creative" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Creative</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Entrepreneur" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Entrepreneur</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Erratic" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Erratic</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Logical" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Logical</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Sexy" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Sexy</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Open minded" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Open minded</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Vivacious" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Vivacious</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Thoughtful" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Thoughtful</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="A home lover" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">A home lover</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Chic" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Chic</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="A deep thinker" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">A deep thinker</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Humorous" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Humorous</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Generous" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Generous</label>
		
				<input id="Field15" name="person[]" class="field_checkbox" value="Successful" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Successful</label>                
			</div>
			
			<div class="column2">
				<input id="Field15" name="person[]" class="field_checkbox" value="A little scruffy" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">A little scruffy</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Heroic" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Heroic</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Musical" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Musical</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Argumentative" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Argumentative</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Possibly marriage material" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Possibly marriage material</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Witty" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Witty</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Independent" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Independent</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="A hopeless romantic" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">A hopeless romantic</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Intelligent" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Intelligent</label>
				
				<input id="Field15" name="person[]" class="field_checkbox" value="Loyal" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Loyal</label>
		
				<input id="Field15" name="person[]" class="field_checkbox" value="Confident" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Confident</label>
			
				<input id="Field15" name="person[]" class="field_checkbox" value="A dedicated follower of fashion" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">A dedicated follower of fashion</label>
			
				<input id="Field15" name="person[]" class="field_checkbox" value="Outgoing" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Outgoing</label>
			
			
				<input id="Field15" name="person[]" class="field_checkbox" value="A bit of a drama queen" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">A bit of a drama queen</label>
			
				<input id="Field15" name="person[]" class="field_checkbox" value="Flexible" tabindex="13" type="checkbox"/>
				<label class="choice" for="Field15">Flexible</label>
			</div>
			<div class="clr"></div>
			</li>
		
			<li>
				<label class="out" id="title14" for="Field14">
				Where do you live?
				</label>
				<div>
					<select id="Field14" name="where_is_your_home_town" class="field_select_medium" tabindex="15"> 
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
		
				<label class="out" id="title14" for="Field14">
				Which gender are you looking for?
				<span id="req_0" class="req">*</span>
				</label>
				<span>
				<input id="Field15" name="gender_you_looking_for" class="field_checkbox" value="1" tabindex="13" type="radio" />
				<label class="choice" for="Field15">Male</label>
				</span>
				
				<span>
				<input id="Field15" name="gender_you_looking_for" class="field_checkbox" value="2" tabindex="13" type="radio" />
				<label class="choice" for="Field15">Female</label>
				</span>
			</li>
		
		
			<li>
			<div>
				Between the ages
				<select id="Field14" name="age_range_you_looking_for[]" class="field_select_medium" tabindex="15">
				<?php
				for($i=18; $i<=121; $i++)
				{
					?><option value="<?php echo''.$i.'';?>" <?php if($i==18){?>selected="selected"<?php } ?> ><?php echo''.$i.'';?></option><?php
				}
				?>
				</select>
				and
				
				<select id="Field14" name="age_range_you_looking_for[]" class="field_select_medium" tabindex="15"> 
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
			<label class="out" id="title0" for="Field0">
			 I agree to terms and conditions
			<span id="req_0" class="req">*</span>
			</label>
			<div class="column1">
			<input id="Field15" name="agree" class="field_checkbox" value="yes" tabindex="13" type="checkbox"/>
			<label class="choice" for="Field15">Yes I do</label>
			<input type="hidden" name="e" value="signup" />
			<input type="image" name="submit" value="Submit" class="field_submit" src="../graphics/login.jpg"/>
			</li>
		</ul>
		</form>
		<?php
		}
		?></div><?php
		/*Signup*/
	break;
	case "logout":
			/*logout*/
			?><div class="info">
			<h4>Logged out</h4>
			<p>You have logged out</p>
			</div>
			
            	<?php $return_url = "browsing.php"; ?>	
                <script type="text/javascript">
                    setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1500);
                </script>		
			<?php
			/*logout*/
		break;
	case "login":
			/*login*/
			?>			
			<div class="info">
			
			<?php
					$c1->query("SELECT * FROM signup WHERE userid='$userid' AND password = '$password'");
			
					if($rec = $c1->fetchAll())
					{		
						?><h4>Login</h4><?php
						//admin has username, password, confirmed and is enabled.
						if(($rec[0]['userid']==$userid)&&($rec[0]['password']==$password)&&($rec[0]['is_confirmed']=='1'))
						{
							echo mysql_error();
							?>
								<?php echo''.$userid.''; ?>, you have Successfully Logged in
                            <?php
					?>		
						<?php $return_url = "edit.php?e=status"; ?>	
                        <script type="text/javascript">
                            setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                        </script>								
					<?php			
						}
						else
						{
							echo'Your account may still be awaiting confirmation from yourself.<br>';	
						}
					}
					else 
					{
						if(isset($userid))
						{
							?>
                            <h4>Login</h4>
							Wrong Login. Use your correct  Userid and Password and Try <br>
							<input type='button' value='Retry' onClick='history.go(-1)'>
							<?php	
						}
					}
					
			if(!isset($_SESSION['id']))
			{
			?>
			<p>Welcome to When Scott Met Michelle. Please use the form on the right to login to the site and start looking for the perfect match right now. </p>
			<?php
			}
			?>
			</div>
			<?php				
			/*login*/
		break;
	case "forgot_password":
			?>
            <div class="info">
            <h4>Forgot Password ?</h4>
            <?php 
            /*Forgot password*/
            $email = $_REQUEST[email];
            
            if(isset($email))
            {
                while (list ($key,$val) = each ($_POST)) 
                {
                    $$key = $val;
                }
            
                $email=mysql_real_escape_string($email);
                $status = "OK";
                $msg="";
                //error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);
                if (!stristr($email,"@") OR !stristr($email,".")) 
                {
                    $msg="Your email address is not correct<BR>";
                    $status= "NOTOK";
                }
                echo "<br><br>";
                if($status=="OK")
                {
                        $c1->query("SELECT email,userid,password FROM signup WHERE signup.email = '$email'");		
                        $recs= $c1->getNumRows();
                        $row=$c1->fetchObject();
                        $em=$row->email;// email is stored to a variable
            
                        if($recs == 0)
                        {
                            echo "<center><font face='Verdana' size='2' color=red><b>No Password</b><br> Sorry Your address is not there in our database. You can signup and login to use our site. <BR><BR><a href='signup.php'> Sign UP </a> </center>";
                        }
                        
                        //generate random password
                        //random hash
                        $newpassword= generateRandomString();
                        $newpassword2= md5($newpassword);
            
                        //encrypt and reset password
                        if($c1->query("UPDATE signup SET password='$newpassword2' WHERE email='$em'"))
                        {
                            echo "<font face='Verdana' size='2' color=green>You have successfully reset your password, please check your email.<br></font>";
							
					?>		
						<?php $return_url = "browsing.php"; ?>	
                        <script type="text/javascript">
                            setTimeout('delayer("<?php echo''.$return_url.'';?>")', 5000);
                        </script>								
					<?php							
                        }			
                
                        $adminemail="$site_admin_email";         ///// Change this address within quotes to your address ///
                        $headers.="Reply-to: $adminemail\n";
                        $headers .= "From: $adminemail\n";
                        $headers .= "Errors-to: $adminemail\n";
                        //$headers = "Content-Type: text/html; charset=iso-8859-1\n".$headers;// for html mail un-comment this line
                
                        if(mail("$em","Your Request for login details","This is in response to your request for a new password. \n \nLogin ID: $row->userid \n Password: $newpassword \n\n Thank You \n \n $site_admin_name","$headers"))
                        {
                            echo "<center><font face='Verdana' size='2' ><b>THANK YOU</b> <br>Your password is posted to your email address . Please check your mail after some time. </center>";
                        }
                        else
                        { 
                            echo " <center><font face='Verdana' size='2' color=red >There is some system problem in sending login details to your address. Please contact site-admin. <br><br><input type='button' value='Retry' onClick='history.go(-1)'></center></font>";
                        }
                        unset($newpassword);
                        unset($newpassword2);
                }
                else
                {
                    echo "<center><font face='Verdana' size='2' color=red >$msg <br><br><input type='button' value='Retry' onClick='history.go(-1)'></center></font>";
					
					?>		
						<?php $return_url = "logins.php?e=forgot_password"; ?>	
                        <script type="text/javascript">
                            setTimeout('delayer("<?php echo''.$return_url.'';?>")', 1000);
                        </script>								
					<?php					
                }
            }
            else
            {
            ?>
            
            <form id="forgot_password" name="forgot_password" class="gloss" autocomplete="off" enctype="multipart/form-data" method="post" action="logins.php?e=forgot_password#">
            <input type="hidden" name="todo" value="forgot_password">
            
            <ul>
            <li>
            <label class="out" id="title2" for="Field2">
            Enter your email address:
            </label>
            <div>
            <input id="Field2" name="email" type="text" class="field_text_medium" value=""	maxlength="255" tabindex="3"/>
            </div>
            </li>
            <input type="hidden" name="e" value="forgot_password" />
            <input type="image" name="submit" value="Submit" class="field_submit" src="../graphics/login.jpg"/>
            </ul>
            </form>
            <?php
            }
            ?>
            </div>			
			<?php
			/*Forgot password*/
		break;
		case "confirm":
			/*confirm*/
			?><div class="info">
			<h4>Confirm</h4><?php	
			
			$hash = $_REQUEST['hash'];  
			$email = $_REQUEST['email']; 

			$hash=mysql_real_escape_string($hash);
			$email=mysql_real_escape_string($email);			 
			
            if(isset($_REQUEST['hash']) && isset($_REQUEST['email']))
            { 					             
					$c1->query("SELECT * FROM signup WHERE email='$email' AND confirm_hash = '$hash'");
						
					if($rec=$c1->fetchRow())
					{
						if(($rec['email']==$email)&&($rec['confirm_hash']==$hash))
						{
							$c1->getError();
							if($c1->query("UPDATE signup SET is_confirmed='1' WHERE email='$email'"))
							{
								echo'You have successfully confirmed your account<br>';
								echo'Please <a href="login.php">login</a> and find your hot date.';
								unset($hash);
								unset($email);
					?>		
						<?php $return_url = "logins.php?e=login"; ?>	
                        <script type="text/javascript">
                            setTimeout('delayer("<?php echo''.$return_url.'';?>")', 4000);
                        </script>								
					<?php									
							}			
						} 
					}
            }
			else
			{
				echo'You may have accidentally arrived here.';
			}
			?></div><?php
			/*confirm*/
		break;
	default:
			echo'An error has occured, an invalid selection has been made';
		break;
}

?>

            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

