<?php
	require_once('includes/header.php');
	
	function dir_copy($srcdir, $dstdir, $last_id)
	{
		$dst = "../news/".$last_id."";
		//if ../images/101/ does not exist make it
		if(!is_dir($dst))
		{ 
			mkdir($dst);
			echo'Making directory';
		}

		rename($srcdir, $dstdir);
	}	
?>

			<div id="maincol" >


<?php

//client is logged in, allow access to this page

if(isset($_SESSION['id']))
{

$user_name = $_SESSION['userid'];


	$c1->query("SELECT * FROM plus_signup WHERE userid='$user_name'");

	if($rec = $c1->fetchAll())
	{
		$user_id = $rec[0]['id'];
	}


$time = date("Y-m-d H:i:s");

	//variables
	$name = $_REQUEST[name];
	$editor = $_REQUEST[editor];
	$save = $_REQUEST[save];
	$images = $_REQUEST[images];
	$id = $_REQUEST[id];
	$del = $_REQUEST[del];
	$con = $_REQUEST[con];
			
	if(!get_magic_quotes_gpc())
	{
		$name=mysql_real_escape_string($name);
		$editor=mysql_real_escape_string($editor);
		$save=mysql_real_escape_string($save);
		$images=mysql_real_escape_string($images);
		$id=mysql_real_escape_string($id);
		$del=mysql_real_escape_string($del);
		$con=mysql_real_escape_string($con);
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
				//submission has been made			
				if($save)
				{
					echo"<h2>Added successfully</h2>";
		
					$c1->query("INSERT INTO `journal` (`subject` , `source` , `date`, `user_id`) VALUES ('$name', '$editor', '$time','$user_id')");
		
					echo'Name :'.$name.'<br/>';
					echo'Description :'.$editor.'<br/>';
					echo'Field :'.$save.'<br/>';
					echo'Images to use : '.$images[0].'<br/><br/>';	
					$last_id = mysql_insert_id();
					
					
					if(array_filter($images))
					{													
						foreach ($images as &$value) 
						{
							$i++;
							
							//make a copy for the original file
							dir_copy($value, "../news/".$last_id."/resize_".$i.".jpg", $last_id);
							
							$pattern = "resize_";
							$replacement = "thumbnail_";
							$value =  ereg_replace($pattern  , $replacement  , $value);
							
							//make a copy for the thumbnail file
							dir_copy($value, "../news/".$last_id."/thumbnail_".$i.".jpg", $last_id);
						}	
					}//if the array contains new image
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
				
				//edit current contents
				
				//display the list in this section so the client may choose which item they wish to edit.
				if(!isset($id))
				{
				//list items, no idea has been chosen.

						//update article
						echo"<h2>Listing Items for edit</h2>";
												
						$c1->query("SELECT * FROM `journal` ORDER BY `news_id` DESC");
						if($rec = $c1->fetchAll())
						{	
							?><ul><?php
							foreach($rec as &$value) 
							{			
							   ?><li><a href="journal.php?id=<?php echo''.$value[news_id].'';?>&amp;a=1&amp;del=1" title="<?php echo''.$value[subject].'';?>">x</a> | <a href="related.php?id=<?php echo''.$value[news_id].'';?>&amp;c=1">r</a> | <a href="journal.php?id=<?php echo''.$value[news_id].'';?>&amp;a=1"><?php echo''.$value[subject].'';?></a></li><?php		   
							}
							?></ul><?php
						}
				}
				else
				{
				//an item has been chosen, but do they want to delete it or edit it?
				
					//delete
					if(isset($del))
					{
							if(isset($con))
							{
								echo'Deleting record.';
								$c1->query("DELETE FROM `journal` WHERE `news_id` = $id LIMIT 1");
								//delete any pictures associated with article



									$dst = "../news/".$id."";
									echo'Directory : '.$dst.'<br/>';
					
									//if ../images/101/ does not exist make it
									if(is_dir($dst))
									{ 
										//show pictures associated with this item
									
												$files1 = scandir($dst);				
												//print_r($files1);
												foreach ($files1 as &$value) 
												{
													if ($value != "." && $value != "..") 
													{				
														//identify thumbnail and source image
														//only display elements with a thumbnail 
															            
														$pic = "$dst/$value";
														//delete pictures
														
														echo''.$pic.'<br/>';
														unlink($pic);         
													}
												}
												rmdir($dst); 
									}				
							}
							else
							{
								echo'Are you sure you want to delete '.$id.'<br/>';
								//value id ready to delete
								?>
								<a href="journal.php?id=<?php echo''.$id.'';?>&amp;a=1&amp;del=1&amp;con=1" title="<?php echo''.$value[name].'';?>">Yes</a>	
								<?php							
							}
					}
					else
					{
					//content has been selected for editting.

							//submission has been made
							if($save)
							{
								echo"<h2>Updated Successfully</h2>";
					
								$c1->query("UPDATE `journal` SET `subject` = '$name', `source` = '$editor',`date` = '$time', `user_id` = '$user_id'  WHERE `news_id` =$id LIMIT 1 ;");
					
								echo'Name :'.$name.'<br/>';
								echo'Description :'.$editor.'<br/>';
								echo'Images to use : '.$images[0].'<br/><br/>';		
								$last_id = $id;
					
	
								//lets not replace any pictures though...do a count of how many we got first.
								$dst = "../news/".$last_id."";
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
								
								//if the value is not a number - then set it to 0
								if(!is_numeric($value))
								{
									$i = 0;
								}													
	
								if(array_filter($images))
								{							
									foreach ($images as &$value) 
									{
										$i++;
										
										//make a copy for the original file
										dir_copy($value, "../news/".$last_id."/resize_".$i.".jpg", $last_id);
										
										$pattern = "resize_";
										$replacement = "thumbnail_";
										$value =  ereg_replace($pattern  , $replacement  , $value);
										
										//make a copy for the thumbnail file
										dir_copy($value, "../news/".$last_id."/thumbnail_".$i.".jpg", $last_id);
									}			
								}				
					
							}
							else
							{
									//Not yet submitted
									echo"<h2>Update Item</h2>";
	
									$c1->query("SELECT * FROM `journal` WHERE `news_id` =$id");
									if($rec = $c1->fetchAll())
									{	
										foreach ($rec as &$value) 
										{			
										   $name = $value[subject];
										   $editor = $value[source];
										}
									}		
	
	
					
									//include text editor
									include "includes/text_editor.php";	
									
									
									
									//show any current photographs and delete ones not wanted.

									$dst = "../news/".$id."";
	
									//if ../images/101/ does not exist make it
									if(is_dir($dst))
									{ 
										echo"<h3>Current pictures attached to article...click to detele unwanted photographs</h3>";									
										//show pictures associated with this item
										?><form action="" method="post"><?php
										
												$files1 = scandir($dst);				
												//print_r($files1);
												foreach ($files1 as &$value) 
												{
													if ($value != "." && $value != "..") 
													{				
														//identify thumbnail and source image
														//only display elements with a thumbnail 
														if (ereg ("thumbnail", $value)) 
														{		
															// match our pattern containing a special sequence
															preg_match_all("/[\d*]/", $value, $matches);
												
															$val = $matches[0][0];
																				
															?>
																	<div class="record">
																	<a href="#" li="<?php echo''.$dst.'/'.$value.'';?>" class="delbutton">
																	<img src="<?php echo''.$dst.'/'.$value.'';?>" alt=""/></a>
																	</div>
															<?php				
														}				
													}
												}
										?> </form><?php
									}								
														
									
									
									//include photo crop code.
									include "includes/photo_crop.php";				
		
							}//end of if not saved			
				}//else if its delete
				
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


