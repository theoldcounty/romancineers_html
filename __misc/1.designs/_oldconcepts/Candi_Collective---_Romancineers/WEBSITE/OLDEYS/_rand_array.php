<?php

$interest_list = array("University Friends","Camping","Business networking","Dining out","Gardening","Movies","Music and concerts","Nightclubs","Playing cards","Political interests","Shopping","Video games","Watching sports","Coffee and conversation","Fishing","Book club","Cooking","Hobbies and crafts","Museums and art","New to the area","Performing arts","Playing sports","Religion","Travel","Volunteering","Wine tasting");


shuffle($interest_list);

$in_size = count($interest_list)-1;
$in_r = rand(1,$in_size);

for($k=0;$k<=$in_r;$k++)
{
	echo'random number of interests.. '.$k.'<br/>';
	$string.="$interest_list[$k],";
}

$string = substr($string, 0,-1);
echo'<br/>end string '.$string.'';

?>