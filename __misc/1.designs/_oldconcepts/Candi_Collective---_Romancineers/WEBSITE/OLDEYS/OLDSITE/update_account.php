<?php
//form submitted validate results
if(isset($todo) and $todo=="update-profile")
{
	// set the flags for validation and messages
	$status = "OK";
	$msg="";

	// if name is less than 5 char then status is not ok
	if (strlen($name) < 3) 
	{
		$msg=$msg."Your name  must be more than 3 char length<BR>";
		$status= "NOTOK";
	}

	// you can add email validation here if required.
	// The code for email validation is available at www.plus2net.com

	if($status<>"OK")
	{ // if validation failed
		echo "<font face='Verdana' size='2' color=red>$msg</font>
		<br><input type='button' value='Retry' onClick='history.go(-1)'>";
	}
	else
	{ // if all validations are passed.	

		if($c1->query("UPDATE signup SET email='$email',name='$name' WHERE userid='$_SESSION[userid]'"))
		{
			echo "<font face='Verdana' size='2' color=green>You have successfully updated your profile<br></font>";
		}
		else{
			echo "<font face='Verdana' size='2' color=red>There is some problem in updating your profile. 
			Please contact site admin<br></font>";
		}
	}
	
	//clear submit variables
	unset($todo);
	//refresh
}
else
{
	//collect all data of the member
	$c1->query("SELECT * FROM signup WHERE userid='$_SESSION[userid]'");
	
	//row results
	$row = $c1->fetchObject();	   
?>
            
        <h3>Edit.<span>Your account details</span></h3>
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
                </dl>
            </fieldset>            
            <input class="myinputstyle" type="reset" value="Delete" size="20" />
            <input name="update" class="myinputstyle" type="submit" value="Update" size="20" />
        </form>         
           
            
<?php
}//end of else
?>