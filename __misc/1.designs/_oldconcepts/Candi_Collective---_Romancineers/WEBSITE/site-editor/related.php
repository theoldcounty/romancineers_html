<?php
	require_once('includes/header.php');
?>
<script src="js/ajax_framework.js" language="javascript"></script>

			<div id="maincol" >

<!-- Show Message for AJAX response -->
<div id="insert_response"></div>

			<?php
            if(isset($_SESSION['id']))
            {


				$id= $_REQUEST[id];
				$c = $_REQUEST[c];
				
				$id = mysql_real_escape_string($id);
				$c = mysql_real_escape_string($c);
				
				$c1->query("
				SELECT journal.subject
				FROM journal WHERE news_id = $id");
				
				
				if($rec = $c1->fetchAll())
				{	
				?><ul><?php
				foreach($rec as &$value) 
				{	
					$all = $value[subject];
				}
				}
				
				echo'Search Term <h2>'.$all.'</h2>';
				
				if(!$c)
				{
					?>
					You have not searched for a term
					<?
				}
				else if($c)
				{
				
				if((!$all) || ($all == "")) { $all = ""; } else { $all = "+(".$all.")"; }
				if((!$any) || ($any == "")) { $any = ""; }
				if((!$none) || ($none == "")) { $none = ""; } else { $none = "-(".$none.")"; }
				
				
				$c1->query("
				SELECT journal.subject, journal.news_id,
				MATCH (subject)
				AGAINST ('$all'IN BOOLEAN MODE) AS score 
				FROM journal WHERE MATCH (subject)
				AGAINST ('$all'IN BOOLEAN MODE)
				ORDER BY `score` DESC");
				
				
				
						if($rec = $c1->fetchAll())
						{	
							?><ul><?php
							foreach($rec as &$value) 
							{	 

								?>
								
								<?php							
							                             
								$val = $value[score];
								$val = $val*100;
							   ?><li>
				   
							   
							   <?php echo'<a href="#" onclick="javascript:insert('.$value[news_id].','.$id.');">'.$value[subject].'</a> - '.$val.'';?></li>
							   
                               
							   
							   <?php		   
							}
							?></ul><?php
						}
				
				echo "<br>";
				} 






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


