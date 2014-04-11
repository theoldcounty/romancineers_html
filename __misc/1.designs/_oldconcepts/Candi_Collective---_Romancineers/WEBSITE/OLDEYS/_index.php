<?php
//define specific meta tags
$title_tag ="When Scott Met Michelle";
$keyword_tag ="whenscottmetmichelle.com, online dating, singles, dating, personals, matchmaker, matchmaking, love, match, dating site, free personals, christian singles, black singles, asian singles, jewish singles, local singles";
$description_tag="An upcoming dating website with millions of profiles. It's free to search and contact your dates.";
include"includes/header.php";
?>
		<div id="sub-twocols" class="clearfix"><!--two col --> 
			<div id="maincol"><!--main col -->
         			
                    <?php
                    $date1 = "1980-1-1";
                    $date2 = "2000-1-1";
					
					$k=21;
					$date3 = date("Y-m-d", mktime(0, 0, 0, 3, 0, date("Y")-$k));
					
					echo'date 3 '.$date3.'';
					
					if($date1 < $date3)
					{
						echo'too young';
					}
					else
					{
						echo'allowed';
					}
                    ?>
            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

