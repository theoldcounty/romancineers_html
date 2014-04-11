<div id="leftcol" >
			<?php
            if(isset($_SESSION['id']))
            {			
				?>
                Find love today.<br/>
                <br/>

                
                
                <?php
            }
			else
			{
			?>
            	Find love today.
			<?php
			}
			


	$c1->query("SELECT * FROM login WHERE status='ON' ORDER BY tm DESC");
	$num_rows = $c1->getNumRows();
	
	if($num_rows!=0)
	{	
		echo'Lovers online<br/>';

		if($rec = $c1->fetchAll())
		{
					?><ul><?php
					foreach($rec as &$value) 
					{			
					   ?><li><?php echo''.$value[userid].'';?></li><?php		   
					}
					?></ul><?php		
		}
	}	  	            			
			
            ?>
</div>