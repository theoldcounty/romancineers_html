<div id="leftcol" >
			<?php
            if(isset($_SESSION['id']))
            {			
				?>
                Administration<br/>
                <br/>
                
                <ul>
                	<li><a href="high-maintenance.php">Create RSS and XML</a></li>
                </ul>
                <?php
            }
			else
			{
			?>
            	Admin section to maintain content.
			<?php
			}
			
			
			//other members online?
			
$c1->query("SELECT * FROM plus_login WHERE status='ON' ORDER BY tm DESC");

	if($rec = $c1->fetchAll())
	{
				?><ul><?php
				foreach($rec as &$value) 
				{			
				   ?><li><?php echo''.$value[userid].'';?></li><?php		   
				}
				?></ul><?php		
	}	  	            
	           		
			
            ?>
</div>