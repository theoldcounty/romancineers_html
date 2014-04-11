<?php
	require_once('includes/header.php');
?>

			<div id="maincol" >

    
			<?php
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
								echo'Please click here to <a href="login.php">login</a>';
								unset($hash);
								unset($email);
							}			
						} 
					}
            }
			else
			{
				echo'You may have accidentally arrived here.';
			}
            ?>

			</div>


	<?php
		require_once('includes/left.php');
	?>

</div>


<?php
	require_once('includes/footer.php');
?>


