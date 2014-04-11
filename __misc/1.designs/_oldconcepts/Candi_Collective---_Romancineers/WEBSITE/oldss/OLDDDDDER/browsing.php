<?php
	require_once('includes/header.php');
?>

			<div id="maincol" >

			<?php
					$c1->query("SELECT * FROM signup ORDER BY id");
						
					if($rec=$c1->fetchRow())
					{

						echo''.$rec[userid].', '.$rec[email].', '.$rec[name].', '.$rec[registered].'';

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


