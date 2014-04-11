<?php
//define specific meta tags
$title_tag ="When Scott Met Michelle";
$keyword_tag ="whenscottmetmichelle.com, online dating, singles, dating, personals, matchmaker, matchmaking, love, match, dating site, free personals, christian singles, black singles, asian singles, jewish singles, local singles";
$description_tag="An upcoming dating website with millions of profiles. It's free to search and contact your dates.";
include"includes/header.php";
ini_set("memory_limit","64M");
?>
		<div id="sub-twocols" class="clearfix"><!--two col --> 
			<div id="maincol"><!--main col -->
				<?php


/*PROFILE BROWSE*/

//starting val				
$submit=$_REQUEST[submit];
$query =$_REQUEST[query];


$what_is_your_gender=$_REQUEST[what_is_your_gender];
$gender_you_looking_for=$_REQUEST[gender_you_looking_for];
$age_range_you_looking_for=$_REQUEST[age_range_you_looking_for];
   
   
/*   
echo''.$what_is_your_gender.'<br/>';
echo''.$gender_you_looking_for.'<br/>';
echo''.$age_range_you_looking_for[0].'<br/>';
echo''.$age_range_you_looking_for[1].'<br/>';
*/



//generic variables for browsing
$ords ="registered"; //last registered
$updown="DESC"; //latest

$condition="WHERE";
if(!empty($gender_you_looking_for)&& !empty($what_is_your_gender))
{
	$whr.=" $condition basics.what_is_your_gender = '$gender_you_looking_for'";
	$whr.=" AND basics.gender_you_looking_for = '$what_is_your_gender'"; 
	$whr.=" AND basics.age_range_you_looking_for_youngest >= '$age_range_you_looking_for[0]'"; 
	$whr.=" AND basics.age_range_you_looking_for_oldest <= '$age_range_you_looking_for[1]'"; 
}
else
{
	//$whr="$condition status = 'ON'"; 
}

				
$q1="SELECT"; 
$q1.=" signup.id"; //id

$q1.="
FROM 
signup LIMIT 210144,110144";


/*PROFILE BROWSE*/

echo'<b>'.$q1.'</b>';
				

                        $c1->query($q1);      
                      
                        if($rec=$c1->fetchAll())
                        {  
							foreach ($rec as &$value)
							{
									$country = array(1,2, 224, 43, 96,109);
									$country = array_rand($country);

	$qu = "INSERT INTO `express` ( `id` , `where_is_your_home_town`) VALUES ('$value[id]', '$country[0]');";
	$c1->query($qu);    
	//echo''.$qu.'<br/>';
																		
									
							}
						}
						else
						{
							?>Currently no one is online.<?php
							$none=1;
						}
                ?>
                <div class="clr"></div>
                
             
            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

