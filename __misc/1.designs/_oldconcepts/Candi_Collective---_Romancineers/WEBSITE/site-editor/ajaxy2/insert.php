<!-- Include Database connections info. -->
<?php 
$dbhost = "localhost";
$dbuser = "insomniac";
$dbpass = "peter";
$dbname = "insomniac_mania";


 //Connect to MySQL Server
mysql_connect($dbhost, $dbuser, $dbpass);
 //Select Database
mysql_select_db($dbname) or die(mysql_error());
 ?>

<?php
if(isset($_GET['site_url']) && isset($_GET['site_name']))
{

	$url= $_GET['site_url'];
	$sitename= $_GET['site_name'];
	
	$insertSite_sql = "INSERT INTO `ajax_example` (`name`, `sex`) VALUES ('$url', '$sitename')";
	echo''.$insertSite_sql.'';
	$insertSite= mysql_query($insertSite_sql) or die(mysql_error());
	
	// If is set URL variables and insert is ok, show the site name 
	echo $sitename;
} 
else 
{
	echo 'Error! Please fill all fileds!';
}
?>