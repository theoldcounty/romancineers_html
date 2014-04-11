<?php
	require_once('includes/header.php');
?>
			<div id="maincol" >

<?php

//xml maker
$xml.="<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
$xml.="<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
//xml maker

echo"<h2>Processing XML and RSS feeds</h2>";
						
$c1->query("SELECT * FROM `signup` ORDER BY `registered` DESC LIMIT 0,1000");
$counted = $c1->getNumRows();
$priority = 1;
if($rec = $c1->fetchAll())
{
	foreach($rec as &$value) 
	{	
		$priority = $priority - (1/$counted);	
		$priority=abs($priority);
		//echo''.$priority.'<br/>';
		
		$explode_date = explode("-", $value[registered]);
		$y= $explode_date[0];
		$m= $explode_date[1];
		$d= $explode_date[2];
		
		$dater = date("Y-m-d", mktime(0, 0, 0, $m,$d, $y));
		//echo''.$dater.'';
		
		//xml maker
		$xml.="<url>";
			$xml.="<loc>http://www.whenscottmetmichelle.com/view-profile.php?id=$value[id]</loc>";
			$xml.="<lastmod>$dater</lastmod>";
			$xml.="<changefreq>daily</changefreq>";
			$xml.="<priority>$priority</priority>";
		$xml.="</url>";	
		//xml maker
	}
}
//xml maker
$xml.="</urlset>";	
//xml maker



//echo''.$xml.'';
//write to xml news feed file
$myFile = "site-map-profile.xml";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $xml);
fclose($fh);



$date = date("r");

//rss maker
$rss.="<?xml version=\"1.0\"?>";
$rss.="<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">";
$rss.="<channel>";
$rss.="<atom:link href=\"http://www.whenscottmetmichelle.com/site-editor/rss-news-feed.xml\" rel=\"self\" type=\"application/rss+xml\" />";
$rss.="<title>When Scott Met Michelle</title>";
$rss.="<link>http://www.whenscottmetmichelle.com</link>";
$rss.="<description>The movie site that never sleeps</description>";
$rss.="<language>en-us</language>";
$rss.="<pubDate>$date</pubDate>";
$rss.="<lastBuildDate>$date</lastBuildDate>";
$rss.="<docs>http://blogs.law.harvard.edu/tech/rss</docs>";
$rss.="<generator>Fusion Robot</generator>";
$rss.="<managingEditor>info@whenscottmetmichelle.com (Rob Shan Lone)</managingEditor>";
$rss.="<webMaster>info@whenscottmetmichelle.com (Rob Shan Lone)</webMaster>";
$rss.="<ttl>5</ttl>";
//rss maker
    	
$c1->query("SELECT * FROM `signup` ORDER BY `registered` DESC LIMIT 0,50");
$counted = $c1->getNumRows();
$priority = 1;
if($rec = $c1->fetchAll())
{
	foreach($rec as &$value) 
	{	
		$description = strip_tags($value[source]);
		$description = trim($description);
		$description = htmlentities($description);
		  
		$explode_date_year = substr($value[registered], 0, 10);		
		$explode_date_year = explode("-", $explode_date_year);
		$y= $explode_date_year[0];
		$m= $explode_date_year[1];
		$d= $explode_date_year[2];
				
		$explode_date_time = substr($value[registered], 10);	
		$explode_date_time = explode(":", $explode_date_time);
		$hour= $explode_date_time[0];
		$min= $explode_date_time[1];
		$sec= $explode_date_time[2];
		
		/*
		echo'<br/>year '.$y.'<br/>';
		echo'<br/>day '.$d.'<br/>';
		echo'<br/>month '.$m.'<br/>';
		echo'<br/>hour '.$hour.'<br/>';
		echo'<br/>min '.$min.'<br/>';
		echo'<br/>sec '.$sec.'<br/>';
		*/
		
		$datepub = date("r", mktime($hour, $min, $sec, $m,$d, $y));
		//echo'<br/>'.$datepub.'<br/>';
		
		
		//rss maker	
		$rss.="<item>";
			$rss.="<title>$value[name]</title>";
			$rss.="<link>http://www.whenscottmetmichelle.com/view-profile.php?id=$value[id]</link>";
			$rss.="<description>$description</description>";
			$rss.="<pubDate>$datepub</pubDate>";
			$rss.="<guid>http://www.whenscottmetmichelle.com/view-profile.php?id=$value[id]</guid>";
		$rss.="</item>";		
		//rss maker
	}
}	
 
$rss.="</channel>";
$rss.="</rss>";


//write to xml news feed file
$myFile = "rss-profile-feed.xml";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $rss);
fclose($fh);


?>

			</div>



	<?php
		require_once('includes/left.php');
	?>

</div>


<?php
	require_once('includes/footer.php');
?>


