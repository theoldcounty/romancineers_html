<div id="leftcol" >
			<?php
            if(isset($_SESSION['id']))
            {			
				?>
                Administration<br/>
                <br/>
                <ul>
    	            <li>Journal > <a href="journal.php?a=0">Add</a> | <a href="journal.php?a=1">Edit</a></li>
                    <li>Catalog > <a href="catalog.php?a=0">Add</a> | <a href="catalog.php?a=1">Edit</a></li>
	            </ul>
                
                
                <?php
            }
			else
			{
			?>
            	Admin section to maintain content.
			<?php
			}
            ?>
</div>