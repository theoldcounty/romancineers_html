<?php
include"includes/header.php";
?>
		<div id="sub-twocols" class="clearfix"><!--two col --> 
			<div id="maincol"><!--main col -->

				<?php
$profile_id = $_REQUEST[id];

if(!get_magic_quotes_gpc())
{
	$profile_id=mysql_real_escape_string($profile_id);
}		
				
                        $c1->query("
SELECT signup.id, signup.name, basics.what_is_your_gender
FROM signup
LEFT JOIN basics
ON signup.id = basics.id WHEN signup.id=$profile_id");                            
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
                                
<div><img src="graphics/<?php echo''.$profile_pic.'';?>"/></div>
<?php echo''.$value[name].'';?>

<div class="profile-summary">Summary... 
<br/> | 
<br/><a href="#">Send a wink</a> | 
<br/><a href="#">Send a message</a></div>
                                    
                                    
<?php

/*                                    
L2711
Do i take ur fancy...???
Active within 24 hours

* 28-year-old woman
* Rochester, Kent, United Kingdom
* seeking men 28-35
* within 50 miles of Rochester, Kent, United Kingdom

Relationships: 	
* Never Married


Have kids: 	
* Yes, and they live at home (2)


Want kids: 	
* Not sure


Ethnicity: 	
* White / Caucasian


Body type: 	
* About average


Height: 	
* 5'4" (162cms)

Religion: 	No answer 	
Smoke: 	
* No Way

Drink: 	
* Social drinker, maybe one or two





///left bit bottom


for fun:

I like to watch Chelsea FC, go to the theatre, cinema, out for meals! I like to do the odd soppy thing like a nice stroll along the beach in the evening hand in hand
favorite hot spots:

Anywhere hot and sunny!
last read:

My fav book that im readin at the mo is called 'call me madam' which is a follow on from a book called 'call me elizabeth' fantastic books!
18things you are both looking for

Comparing your profiles side by side is a quick way to calculate chemistry


about me...

Hey all, im a single mum of 2 boys! Im a trained hairdresser but my life is busy lookin after the kids at the mo!
Im lookin for the 'man of my dreams' if there is such a thing haha, i like to go out and socialise, but also love to cuddle up on the sofa with a good dvd! I like to go out for days out with the kids mainly and on the odd occasion without them!
Well if i take ur fancy get in contact, oh but i dont pay for this :0) x
             


Hair:  	
* Dark brown
	
Eyes: 	
* Brown
	
Best Feature: 	No answer 	
Body art: 	
* Strategically placed tattoo,
* Pierced ear(s)
	
Sports and exercise: 	
 * Weights / Machines

	
Exercise habits: 	
* Exercise 1-2 times per week

	
Daily diet: 	
 * Meat and potatoes

	
Interests 	
* Dining out,
* Music and concerts,
* Nightclubs/Dancing,
* Shopping/Antiques

	
Education: 	
* Some college

	
Occupation: No answer 	
Income: No answer 	
Languages:* English

	
Politics: 	
* Middle of the Road

	
Sign: 	
 * Sagittarius

	
My Place: 	
* Live with kids

	
Pets I have: 	
* Gerbils

	
Pets I like: No answer
			                       
     */                               
                                    
                                    
                                                             
                                <?php
							}
						}
                ?>

            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

