<?php
include "session.php";
require_once('includes/mysql.inc');
error_reporting (E_ALL ^ E_NOTICE);


//variables
$site_editor_host ="http://www.whenscottmetmichelle.com";
$site_name ="When Scott Met Michelle";
$site_admin_email ="info@whenscottmetmichelle.com";  //test email
$site_admin_name = "Rob Shan Lone";
$current_time = date('Y-m-d h:i:s'); 

//connection1 object
$c1 = new connection('localhost', 'wsmm', 'luckylove', 'wsmm_loveserver');

function generateRandomString($length = 10, $letters = '1234567890qwertyuiopasdfghjklzxcvbnm')
{
	$s = '';
	$lettersLength = strlen($letters)-1;
	for($i = 0 ; $i < $length ; $i++)
	{
		$s .= $letters[rand(0,$lettersLength)];
	}
	return $s;
}

$current_page = $_SERVER['REQUEST_URI'];
$pattern1 = "/logout.php/";
$sourceislogout = preg_match($pattern1, $current_page);

$pattern2 = "/catalog.php/";
$sourceiscatlog = preg_match($pattern2, $current_page);

if($sourceislogout)
{
	//logout
	$c1->query("UPDATE login SET status='OFF' WHERE userid='$_SESSION[userid]'");
	session_unset();
	session_destroy();
}

$userid=$_POST['userid'];
$password=$_POST['password'];

if(isset($userid))
{
	$userid=mysql_real_escape_string($userid);
	$password=mysql_real_escape_string($password);
	//emcrypt password
	$password= md5($password);

	$c1->query("SELECT * FROM signup WHERE userid='$userid' AND password = '$password'");

	if($rec = $c1->fetchAll())
	{
		//admin has username, password, confirmed and is enabled.
		if(($rec[0]['userid']==$userid)&&($rec[0]['password']==$password)&&($rec[0]['is_confirmed']=='1'))
		{
			include "includes/newsession.php";
			$tm=date("Y-m-d H:i:s");
			$ip=$_SERVER['REMOTE_ADDR'];
			
			$login_count = $rec[0]['login_count'];
			$login_count++;

			//if not already in login database
			$c1->query("UPDATE signup SET login_count='$login_count' WHERE userid='$_SESSION[userid]'");
			
			//if not already in login database
			$c1->query("UPDATE login SET id='$_SESSION[id]', ip='$ip', tm='$tm' WHERE userid='$_SESSION[userid]'");

			if ($c1->getAffectedRows() == 0)
			{
				// No records updated, so add it
				$c1->query("INSERT INTO login(id,userid,ip,tm) values('$_SESSION[id]','$_SESSION[userid]','$ip','$tm')");
			}

		}
	}
	else
	{
		session_unset();
		//echo "<font face='Verdana' size='2' color=red>Wrong Login. Use your correct  Userid and Password and Try <br><center><input type='button' value='Retry' onClick='history.go(-1)'></center>";
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<title>When Scott Met Michelle</title>
<meta http-equiv="Content-Style-Type" content="text/css"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="generator" content="www.fusionrobotdesign.com"/>


<!-- stylesheets -->
<link rel="stylesheet" href="css/generic.css" type="text/css"/>

<!-- scripts -->
<script type="text/javascript" src="scripts/dynamic.js"></script>

</head>

<body>
<div id="pagewidth"><!--pagewidth-->
	<div id="header"><!--header--> 
    	Head 
        <?php include "session_check.php";?>
    </div><!--header-->
			<div id="wrapper" class="clearfix"><!--wrapper-->