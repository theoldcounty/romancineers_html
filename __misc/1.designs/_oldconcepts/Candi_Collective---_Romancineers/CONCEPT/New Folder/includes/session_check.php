<?php

////// To update session status for plus_login table to get who is online ////////
if(isset($_SESSION['id']))
{
	$tm=date("Y-m-d H:i:s");
	$c1->query("UPDATE login SET status='ON',tm='$tm' WHERE id='$_SESSION[id]'");
	
	echo'<a href=update-profile.php?i=0>'.$_SESSION[userid].'</a> | <a href=change-password.php>Change Password</a> | <a href=logout.php>Sign Out</a>';
	$c1->getError();	
}
else
{
	echo'<a href="signup.php">Sign Up</a> | <a href="forgot-password.php">Forgot Password</a> | Help | <a href="login.php">Sign In</a>';
}
///// ////////////// End of updating login status for who is online ///////

// Find out who is online /////////
$gap=10; // change this to change the time in minutes, This is the time for which active users are collected.
$tm=date ("Y-m-d H:i:s", mktime (date("H"),date("i")-$gap,date("s"),date("m"),date("d"),date("Y")));
//// Let us update the table and set the status to OFF
////for the users who have not interacted with
////pages in last 10 minutes ( set by $gap variable above ) ///

$c1->query("UPDATE login SET status='OFF' WHERE tm < '$tm'");
$c1->getError();


?>