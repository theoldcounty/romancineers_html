<?php
	require_once('includes/header.php');
	
	function dir_copy($srcdir, $dstdir, $last_id)
	{
		$dst = "../images/".$last_id."";
		//if ../images/101/ does not exist make it
		if(!is_dir($dst))
		{ 
			mkdir($dst);
		}

		rename($srcdir, $dstdir);
	}	
?>

			<div id="maincol" >


<?php

//client is logged in, allow access to this page

if(isset($_SESSION['id']))
{

	//variables
	$name = $_REQUEST[name];
	$editor = $_REQUEST[editor];
	$save = $_REQUEST[save];
	$category = $_REQUEST[category];
	$subcat = $_REQUEST[subcat];
	$images = $_REQUEST[images];
	$id = $_REQUEST[id];
	
			
	if(!get_magic_quotes_gpc())
	{
		$name=mysql_real_escape_string($name);
		$editor=mysql_real_escape_string($editor);
		$save=mysql_real_escape_string($save);
		$category=mysql_real_escape_string($category);
		$subcat=mysql_real_escape_string($subcat);
		$images=mysql_real_escape_string($images);
		$id=mysql_real_escape_string($id);
	}
	
	$images = split(",", $images);
	
	//do you want to add or edit catalog
	$a = $_REQUEST[a];
	$a=mysql_real_escape_string($a);
	//check to see if this is an integer
	
	switch ($a) {
		//insert new article
		case 0:
				/*************************************/ 
							
				if($save)
				{
					echo"<h2>Added successfully</h2>";
		
					$c1->query("INSERT INTO `catalog` (`name` , `description` , `category`, `subcategory` ) VALUES ('$name', '$editor', '$category', '$subcat')");
		
					echo'Name :'.$name.'<br/>';
					echo'Description :'.$editor.'<br/>';
					echo'Field :'.$save.'<br/>';
					echo'Category :'.$category.'<br/>';
					echo'Subcat :'.$save.'<br/>';
					echo'Images to use : '.$images[0].'<br/><br/>';	
					$last_id = mysql_insert_id();
					
					
					if(array_filter($images))
					{													
						foreach ($images as &$value) 
						{
							$i++;
							
							//make a copy for the original file
							dir_copy($value, "../images/".$last_id."/resize_".$i.".jpg", $last_id);
							
							$pattern = "resize_";
							$replacement = "thumbnail_";
							$value =  ereg_replace($pattern  , $replacement  , $value);
							
							//make a copy for the thumbnail file
							dir_copy($value, "../images/".$last_id."/thumbnail_".$i.".jpg", $last_id);
						}	
					}		
		
		
				}
				else
				{
						//Not yet submitted
						echo"<h2>Add new item</h2>";
		
						//include text editor
						include "includes/text_editor.php";	
						//include photo crop code.
						include "includes/photo_crop.php";				
					?>
		
				<?php
				}//end of if not saved
			break;
				/*************************************/ 
	
		case 1:
				/*************************************/ 
				
				
				if(!isset($id))
				{
				//list items, no idea has been chosen.
	
						//update article
						echo"<h2>Listing Items for edit</h2>";
						
						
						$c1->query("SELECT * FROM `catalog` ORDER BY `id` DESC");
						if($rec = $c1->fetchAll())
						{	
							?><ul><?php
							foreach ($rec as &$value) 
							{			
							   ?><li><a href="catalog.php?id=<?php echo''.$value[id].'';?>&amp;a=1"><?php echo''.$value[name].'';?></a></li><?php		   
							}
							?></ul><?php
						}			
				}
				else
				{
						if($save)
						{
							echo"<h2>Updated Successfully</h2>";
				
							$c1->query("UPDATE `catalog` SET `name` = '$name', `description` = '$editor', `category` = '$category', `subcategory` = '$subcat'  WHERE `id` =$id LIMIT 1 ;");
				
							echo'Name :'.$name.'<br/>';
							echo'Description :'.$editor.'<br/>';
							echo'Field :'.$save.'<br/>';
							echo'Category :'.$category.'<br/>';
							echo'Subcat :'.$save.'<br/>';
							echo'Images to use : '.$images[0].'<br/><br/>';		
							$last_id = $id;
				

							//lets not replace any pictures though...do a count of how many we got first.
							$dst = "../images/".$last_id."";
							//if ../images/101/ does not exist make it
							if(is_dir($dst))
							{ 
								//count number of files
								
								if ($handle = opendir($dst)) 
								{
									while (false !== ($file = readdir($handle))) 
									{
										if ($file != "." && $file != "..") 
										{
												echo'my file '.$file.'';
										
												//only display elements with a thumbnail 
												if (ereg ("thumbnail", $file)) 
												{
									
													// match our pattern containing a special sequence
													preg_match_all("/[\d*]/", $file, $matches);
								
													$value = $matches[0][0];
												}
										}
									}
								}
								
								//and make $i equal to the value
							}	
							$i = $value;														

							if(array_filter($images))
							{							
								foreach ($images as &$value) 
								{
									$i++;
									
									//make a copy for the original file
									dir_copy($value, "../images/".$last_id."/resize_".$i.".jpg", $last_id);
									
									$pattern = "resize_";
									$replacement = "thumbnail_";
									$value =  ereg_replace($pattern  , $replacement  , $value);
									
									//make a copy for the thumbnail file
									dir_copy($value, "../images/".$last_id."/thumbnail_".$i.".jpg", $last_id);
								}			
							}				
				
						}
						else
						{
								//Not yet submitted
								echo"<h2>Update Item</h2>";

								$c1->query("SELECT * FROM `catalog` WHERE `id` =$id");
								if($rec = $c1->fetchAll())
								{	
									foreach ($rec as &$value) 
									{			
									   $name = $value[name];
									   $editor = $value[description];
									   $category = $value[category];
									   $subcat = $value[subcategory];
									   

									   
										$c1->query("SELECT * FROM `category` WHERE `cat_id` =$category");
										if($rec2 = $c1->fetchAll())
										{	
											foreach ($rec2 as &$value2) 
											{		
												$categoryname = $value2[category];
											}
										}	
									}
								}		


				
								//include text editor
								include "includes/text_editor.php";	
								
								
								
								//show any current photographs and delete ones not wanted.
								echo"<h3>Current pictures attached to article...click to detele unwanted photographs</h3>";
								$dst = "../images/".$id."";
					
					
					
								//if ../images/101/ does not exist make it
								if(is_dir($dst))
								{ 
									//show pictures associated with this item
		?><form action="" method="post"><?php

//$files1 = scandir($dir);

//print_r($files1);

							
		if ($handle = opendir($dst)) 
		{
			while (false !== ($file = readdir($handle))) 
			{
				if ($file != "." && $file != "..") 
				{
				
				//identify thumbnail and source image
					
					//only display elements with a thumbnail 
					if (ereg ("thumbnail", $file)) 
					{
		
						// match our pattern containing a special sequence
						preg_match_all("/[\d*]/", $file, $matches);
	
						$value = $matches[0][0];
											
						?>
                                <div class="record">
                                <a href="#" li="<?php echo''.$dst.'/'.$file.'';?>" class="delbutton">
                                <img src="<?php echo''.$dst.'/'.$file.'';?>" alt=""/></a>
                                </div>
						<?php				
					}				
				}
			}
			closedir($handle);
		}
		?> </form><?php	
	
								}								
								
								
								
								//include photo crop code.
								include "includes/photo_crop.php";				
	
						}//end of if not saved			
					
				
				}
				
				/*************************************/
			break;
		default:
			echo "Apologies this page is strictly for site administrators.";
			break;
	}
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


