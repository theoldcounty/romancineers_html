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
if(isset($_GET['news_id']) && isset($_GET['related_id']))
{
	
	$news_id= $_GET['news_id'];
	$related_id= $_GET['related_id'];
	
	$insertSite_sql = "INSERT INTO `news_related` (`news_id`, `related_id`) VALUES ('$related_id', '$news_id')";
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