<?php

////// To update session status for login table to get who is online ////////
if(isset($_SESSION['id']))
{
	$tm=date("Y-m-d H:i:s");
	$c1->query("UPDATE login SET status='ON',tm='$tm' WHERE userid='$_SESSION[userid]'");
	
	$c1->getError();	
}

///// ////////////// End of updating login status for who is online ///////

// Find out who is online /////////
$gap=20; // change this to change the time in minutes, This is the time for which active users are collected.
$tm=date ("Y-m-d H:i:s", mktime (date("H"),date("i")-$gap,date("s"),date("m"),date("d"),date("Y")));
//// Let us update the table and set the status to OFF
////for the users who have not interacted with
////pages in last 10 minutes ( set by $gap variable above ) ///


	//logout
	$c1->query("DELETE FROM `login` WHERE tm < '$tm'");
	//$c1->query("UPDATE login SET status='OFF' WHERE userid='$_SESSION[userid]'");


//$c1->query("UPDATE login SET status='OFF' WHERE tm < '$tm'");
$c1->getError();



?>