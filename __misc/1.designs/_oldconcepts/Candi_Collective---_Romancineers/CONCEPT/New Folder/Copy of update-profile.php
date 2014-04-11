<?php
	require_once('includes/header.php');
?>
			<div id="maincol" >

			<?php
			
			//variables
			$todo=$_REQUEST[todo];
			$name=$_REQUEST[name];
			$email=$_REQUEST[email];
			$sex=$_REQUEST[sex];	
			$biography=$_REQUEST[biography];	
			$orientation1=$_REQUEST[orientation1];
			$orientation2=$_REQUEST[orientation2];
					
			
	if(!get_magic_quotes_gpc())
	{
		$todo=mysql_real_escape_string($todo);
		$name=mysql_real_escape_string($name);
		$email=mysql_real_escape_string($email);
		$sex=mysql_real_escape_string($sex);
		$biography=mysql_real_escape_string($biography);
		$orientation1=mysql_real_escape_string($orientation1); //male
		$orientation2=mysql_real_escape_string($orientation2); //female
	}		
	
	
	
	//set orientation
	if(isset($orientation1) && isset($orientation2))
	{
		$orientation = "bisexual";
	}
	else
	{
		if(isset($orientation1))
		{
			$orientation = $orientation1;//male - if a man gay, if a woman straight
		}	
		if(isset($orientation2))
		{
			$orientation = $orientation2;//female - if a man straight, if a woman lesbian
		}
	}
	
				
			// check the login details of the user and stop execution if not logged in
			require "check.php";

if(isset($todo) and $todo=="update-profile")
{
	// set the flags for validation and messages
	$status = "OK";
	$msg="";

	// if name is less than 5 char then status is not ok
	if (strlen($name) > 3) 
	{
		$msg=$msg."Your name  must be more than 3 char length<BR>";
		$status= "NOTOK";
	}

	// you can add email validation here if required.
	// The code for email validation is available at www.plus2net.com

	if($status<>"OK")
	{ // if validation failed
		echo "<font face='Verdana' size='2' color=red>$msg</font><br><input type='button' value='Retry' onClick='history.go(-1)'>";
	}
	else
	{ // if all validations are passed.
	

		if($c1->query("update signup set email='$email',name='$name',sex='$sex',orientation='$orientation',biography='$biography' where userid='$_SESSION[userid]'"))
		{
			echo "<font face='Verdana' size='2' color=green>You have successfully updated your profile<br></font>";
		}
		else{
			echo "<font face='Verdana' size='2' color=red>There is some problem in updating your profile. Please contact site admin<br></font>";
		}
	}
	
	//clear submit variables
	unset($todo);
	//refresh
}
else
{
            // check the login details of the user and stop execution if not logged in
            //require "check.php";
            
            // If member has logged in then below script will be execuated.
            // let us collect all data of the member
			$c1->query("select * from signup where userid='$_SESSION[userid]'");
			
			$row = $c1->fetchObject();
            
            //Let us set the period button based on the data of the sex field
            // You can see male button is checked if it is set to male
            // else it is  set to female
            if($row->sex == "male")
            {
                $ckb="<input type=\"radio\" value=\"male\" name=\"sex\" checked=\"checked\" />Male
                <input type=\"radio\" value=\"female\"  name=\"sex\" />Female";
            }
            else
            {
                $ckb="<input type=\"radio\" value=\"male\" name=\"sex\" />Male
                <input type=\"radio\" value=\"female\" name=\"sex\" checked=\"checked\" />Female";
            } 
			


switch ($row->orientation) {
    case "male":
       			$skb="<input type=\"checkbox\" value=\"male\" name=\"orientation1\" checked=\"checked\" />Male
                <input type=\"checkbox\" value=\"female\"  name=\"orientation2\" />Female";
        break;
    case "female":
       			$skb="<input type=\"checkbox\" value=\"male\" name=\"orientation1\" />Male
                <input type=\"checkbox\" value=\"female\"  name=\"orientation2\" checked=\"checked\" />Female";
        break;
    case "bisexual":
                $skb="<input type=\"checkbox\" value=\"male\" name=\"orientation1\" checked=\"checked\" />Male
                <input type=\"checkbox\" value=\"female\" name=\"orientation2\" checked=\"checked\" />Female";
        break;
	default:
			//presume person is straight - judge from their gender        
            if($row->sex == "male")
            {
       			$skb="<input type=\"checkbox\" value=\"male\" name=\"orientation1\" />Male
                <input type=\"checkbox\" value=\"female\"  name=\"orientation2\" checked=\"checked\" />Female";
            }
            else
            {
       			$skb="<input type=\"checkbox\" value=\"male\" name=\"orientation1\" checked=\"checked\" />Male
                <input type=\"checkbox\" value=\"female\"  name=\"orientation2\" />Female";
            }
        break;	
}
			
		
		
		echo "$row->lookingfor";
		$lookingfor = "1,4,5";
		$lookingfor = explode(',', $lookingfor); 
 
 
		if (in_array("1", $lookingfor)) 
		{
			$lkb.="<input type=\"checkbox\" value=\"1\" name=\"lookingfor1\" checked=\"checked\"/><label class=\"simple\">Adult Dating</label>";
		}
		else
		{
			$lkb.="<input type=\"checkbox\" value=\"1\" name=\"lookingfor1\" /><label class=\"simple\">Adult Dating</label>";
		}
		
		if (in_array("2", $lookingfor)) 
		{
			$lkb.="<input type=\"checkbox\" value=\"2\" name=\"lookingfor2\" checked=\"checked\"/><label class=\"simple\">Casual Chat</label>";
		}
		else
		{
			$lkb.="<input type=\"checkbox\" value=\"2\" name=\"lookingfor2\" /><label class=\"simple\">Casual Chat</label>";
		}
		
		if (in_array("3", $lookingfor)) 
		{
			$lkb.="<input type=\"checkbox\" value=\"3\" name=\"lookingfor3\" checked=\"checked\"/><label class=\"simple\">Relationship/Dating</label>";
		}
		else
		{
			$lkb.="<input type=\"checkbox\" value=\"3\" name=\"lookingfor3\" /><label class=\"simple\">Relationship/Dating</label>";
		}
		 
		
		if (in_array("4", $lookingfor)) 
		{
			$lkb.="<input type=\"checkbox\" value=\"4\" name=\"lookingfor4\" checked=\"checked\"/><label class=\"simple\">Webcam</label>";
		}
		else
		{
			$lkb.="<input type=\"checkbox\" value=\"4\" name=\"lookingfor4\" /><label class=\"simple\">Webcam</label>";
		}
		 
		 
		if (in_array("5", $lookingfor)) 
		{
			$lkb.="<input type=\"checkbox\" value=\"5\" name=\"lookingfor5\" checked=\"checked\"/><label class=\"simple\">Friendship</label>";
		}
		else
		{
			$lkb.="<input type=\"checkbox\" value=\"5\" name=\"lookingfor5\" /><label class=\"simple\">Friendship</label>";
		}
		 
		
		if (in_array("6", $lookingfor)) 
		{
			$lkb.="<input type=\"checkbox\" value=\"6\" name=\"lookingfor6\" checked=\"checked\"/><label class=\"simple\">Phone</label>";
		}
		else
		{
			$lkb.="<input type=\"checkbox\" value=\"6\" name=\"lookingfor6\" /><label class=\"simple\">Phone</label>";
		}
 
 	
			    			           
            // One form with a hidden field is prepared with default values taken from field.
            ?>
            
			<h3>Edit.<span>Your profile</span></h3>
			<form id="preview" name="preview" action="update-profile.php" method="post">
            	<input type="hidden" name="todo" value="update-profile">

<h2><span>Account Details</span></h2>

<fieldset>
<dl class="form">


<!--email-->
<dt>
    <label class="mylabelstyle">
    Email :
    </label>
</dt>
<dd>    
	<input type="text" class="myinputstyle" name="email" value="<?php echo $row->email ; ?>" size="40" />
</dd>
                    	
<!--name-->
<dt>
    <label class="mylabelstyle">
    Name :
    </label>
</dt>
<dd>    
	<input type="text" class="myinputstyle" name="name" value="<?php echo $row->name ; ?>" size="40" />
</dd>

		
<!--gender-->
<dt>
    <label class="mylabelstyle">
    Gender :
    </label>
</dt>
<dd>    
	<?php echo $ckb ; ?>
</dd>


<!--salary-->
<dt>
    <label class="mylabelstyle">
    Annual Income :
    </label>
</dt>
<dd>    
	<?php echo $ckb ; ?>
</dd>

		
<!--seeking a male or female-->
<dt>
    <label class="mylabelstyle">
    Seeking a :
    </label>
</dt>
<dd>    
	<?php echo $skb ; ?>
</dd>
					
					
<!--date of birth-->
<dt>
    <label class="mylabelstyle">
    Date of Birth:
    </label>
</dt>
<dd>    
	<?php echo $ckb ; ?>
</dd>

<!--looking for-->
<dt>
    <label class="mylabelstyle">
    Looking For:
    </label>
</dt>
<dd>    
	<?php echo $lkb ; ?>
</dd>

<!--describe yourself-->
<dt>  
    <label class="mylabelstyle">
    Describe Yourself
    </label>
</dt>    
<dd>
	<textarea class="myinputstyle" name="biography">
	<?php echo $row->biography ; ?>
    </textarea>
</dd>

</dl>
</fieldset>            
<input class="myinputstyle" type="reset" value="Delete" size="20" />
<input name="update" class="myinputstyle" type="submit" value="Update" size="20" />
</form>
            
            
            
            
<?php
}//end of else
?>
			</div>



	<?php
		require_once('includes/left.php');
	?>

</div>


<?php
	require_once('includes/footer.php');
?>


