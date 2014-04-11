<?php
include"includes/header.php";
?>
		<div id="sub-twocols" class="clearfix"><!--two col --> 
			<div id="maincol"><!--main col -->
				<?php
                        $c1->query("
SELECT signup.id, signup.name, basics.what_is_your_gender
FROM signup
LEFT JOIN basics
ON signup.id = basics.id");                            
                        if($rec=$c1->fetchAll())
                        {  
							foreach ($rec as &$value)
							{
									
									if($value[what_is_your_gender]==male)
									{
										$profile_pic = "i_am_a_scott.jpg";
									}
									else
									{
										$profile_pic = "i_am_a_michelle.jpg";
									}						
								?>
                                <div class="profile-picture">
                                	<div><img src="graphics/<?php echo''.$profile_pic.'';?>"/></div>
                                    <div class="profile-name"><?php echo''.$value[name].'';?></div>
                                    <div class="profile-summary">Summary... 
                                    <br/><a href="view_profile.php?id=<?php echo''.$value[id].'';?>">View profile</a> | 
                                    <br/><a href="#">Send a wink</a> | 
                                    <br/><a href="#">Send a message</a></div>
                                </div>                                
                                <?php
							}
						}
                ?>
                <div class="clr"></div>
            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

