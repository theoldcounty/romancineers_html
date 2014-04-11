<?php
	require_once('includes/header.php');
?>
			<div id="maincol" >

			<?php
			
			
			
//variables
$todo=$_REQUEST[todo];
$name=$_REQUEST[name];
$email=$_REQUEST[email];
$i=$_REQUEST[i];

if(!get_magic_quotes_gpc())
{
	$todo=mysql_real_escape_string($todo);
	$name=mysql_real_escape_string($name);
	$email=mysql_real_escape_string($email);
	$i=mysql_real_escape_string($i);
}		

	
	
				
// check the login details of the user and stop execution if not logged in
require "check.php";





switch ($i) {
    case 0:
        include"update_account.php";	
        break;
    case 1:
        echo "i equals 1";
        break;
    case 2:
        echo "i equals 2";
        break;
    default:       
	   	echo"Access denied";   
        break;		
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


