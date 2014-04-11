<?php
	require_once('includes/header.php');
?>

			<div id="maincol" >

			<?php
            if(isset($_SESSION['id']))
            {
                echo'Successfully logged';
            }
			else
			{
				echo'You are currently a guest. Access to confidential material forbidean.';
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


