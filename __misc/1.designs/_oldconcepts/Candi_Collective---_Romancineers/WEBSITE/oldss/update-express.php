<?php
include"includes/header.php";
?>
		<div id="sub-twocols" class="clearfix"><!--two col --> 
			<div id="maincol"><!--main col -->
          
<?php
if(isset($_SESSION['id']))
{
	//variables
	$todo=$_REQUEST[todo];
	$where_is_your_home_town=$_REQUEST[where_is_your_home_town];
	$do_you_have_any_brothers_or_sisters=$_REQUEST[do_you_have_any_brothers_or_sisters];
	$you_an_early_bird_or_night_owl=$_REQUEST[you_an_early_bird_or_night_owl];
	$do_you_play_a_musical_instrument=$_REQUEST[do_you_play_a_musical_instrument];
	$what_is_your_favourite_colour=$_REQUEST[what_is_your_favourite_colour];
	
	if(!get_magic_quotes_gpc())
	{
		$todo=mysql_real_escape_string($todo);
		$where_is_your_home_town=mysql_real_escape_string($where_is_your_home_town);
		$do_you_have_any_brothers_or_sisters=mysql_real_escape_string($do_you_have_any_brothers_or_sisters);
		$you_an_early_bird_or_night_owl=mysql_real_escape_string($you_an_early_bird_or_night_owl);
		$do_you_play_a_musical_instrument=mysql_real_escape_string($do_you_play_a_musical_instrument);
		$what_is_your_favourite_colour=mysql_real_escape_string($what_is_your_favourite_colour);
	}		
	
	
	if(!is_null($do_you_play_a_musical_instrument))
	{		
		$do_you_play_a_musical_instrument = implode(",", $do_you_play_a_musical_instrument);
	}
	

		//collect all data of the member
		$c1->query("
		SELECT signup.id, signup.userid, express.where_is_your_home_town, express.do_you_have_any_brothers_or_sisters, express.you_an_early_bird_or_night_owl, express.do_you_play_a_musical_instrument, express.what_is_your_favourite_colour
		FROM signup
		LEFT JOIN express
		ON signup.id = express.id WHERE signup.userid='$_SESSION[userid]'");  
	
		//row results
		$row = $c1->fetchObject();	  	
					
	// check the login details of the user and stop execution if not logged in
	
	//form submitted validate results
	if(isset($todo) and $todo=="update-profile")
	{
		// set the flags for validation and messages
		$status = "OK";
		$msg="";
		
		if($status<>"OK")
		{ // if validation failed
			echo "<font face='Verdana' size='2' color=red>$msg</font>
			<br><input type='button' value='Retry' onClick='history.go(-1)'>";
		}
		else
		{ // if all validations are passed.	
		
			$c1->query("SELECT * FROM express WHERE id=$row->id");  
		
			if(!$c1->getNumRows())
			{		
				if($c1->query("INSERT INTO `express` ( `id` , `where_is_your_home_town` , `do_you_have_any_brothers_or_sisters`,`you_an_early_bird_or_night_owl`,`do_you_play_a_musical_instrument`,`what_is_your_favourite_colour`, `last_updated` )
VALUES ('$row->id', '$what_is_your_home_town', '$your_brothers_or_sisters', '$you_an_early_bird_or_night_owl', '$do_you_play_a_musical_instrument', '$your_favourite_colour', '$current_time')"))
				{
					echo "You have successfully updated your profile<br>";
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
				}			
			}
			else
			{	
			
				if($c1->query("UPDATE `express` 
				SET `where_is_your_home_town` = '$where_is_your_home_town', 
				`do_you_have_any_brothers_or_sisters` = '$do_you_have_any_brothers_or_sisters' ,
				`you_an_early_bird_or_night_owl` = '$you_an_early_bird_or_night_owl', 	
				`do_you_play_a_musical_instrument` = '$do_you_play_a_musical_instrument' ,
				`what_is_your_favourite_colour` = '$what_is_your_favourite_colour' 
				WHERE id='$row->id'"))				
				{
					echo "You have successfully updated your profile<br>";
				}
				else
				{
					echo "There is some problem in updating your profile. Please contact site admin<br>";
				}
			}
		}
		
		//clear submit variables
		unset($todo);
		//refresh
	}
	else
	{

	?>
	
	
				
	<form id="form55" name="form55" class="wufoo" autocomplete="off" enctype="multipart/form-data" method="post" action="#public">
    <input type="hidden" name="todo" value="update-profile"/>
    	
	<div class="info">
	<h2>Express Yourself</h2>
	</div>

	<?php
	$do_you_play_a_musical_instrument = explode(",", $row->do_you_play_a_musical_instrument);
	?>    

	
	<ul>
	<li id="decfie2" class="">
	<label class="desc" id="title14" for="Field14">
	Where is your home town?
	</label>
	<div>
	<select id="Field14" name="where_is_your_home_town" class="field select medium" tabindex="15">
	<option value="1" <?php if($row->where_is_your_home_town== "1") { ?> selected="selected" <?php } ?>>United States</option>
	<option value="2" <?php if($row->where_is_your_home_town== "2") { ?> selected="selected" <?php } ?>>Canada</option>
	<option value="224" <?php if($row->where_is_your_home_town== "224") { ?> selected="selected" <?php } ?>>United Kingdom</option>
	<option value="3" <?php if($row->where_is_your_home_town== "3") { ?> selected="selected" <?php } ?>>Afghanistan</option>
	<option value="4" <?php if($row->where_is_your_home_town== "4") { ?> selected="selected" <?php } ?>>Albania</option>
	<option value="5" <?php if($row->where_is_your_home_town== "5") { ?> selected="selected" <?php } ?>>Algeria</option>
	<option value="6" <?php if($row->where_is_your_home_town== "6") { ?> selected="selected" <?php } ?>>American Samoa</option>
	<option value="7" <?php if($row->where_is_your_home_town== "7") { ?> selected="selected" <?php } ?>>Andorra</option>
	<option value="9" <?php if($row->where_is_your_home_town== "9") { ?> selected="selected" <?php } ?>>Angola</option>
	<option value="10" <?php if($row->where_is_your_home_town== "10") { ?> selected="selected" <?php } ?>>Anguilla</option>
	<option value="11" <?php if($row->where_is_your_home_town== "11") { ?> selected="selected" <?php } ?>>Antigua and Barbuda</option>
	<option value="8" <?php if($row->where_is_your_home_town== "8") { ?> selected="selected" <?php } ?>>Argentina</option>
	<option value="12" <?php if($row->where_is_your_home_town== "12") { ?> selected="selected" <?php } ?>>Armenia</option>
	<option value="14" <?php if($row->where_is_your_home_town== "14") { ?> selected="selected" <?php } ?>>Ascension Island</option>
	<option value="15" <?php if($row->where_is_your_home_town== "15") { ?> selected="selected" <?php } ?>>Australia</option>
	<option value="16" <?php if($row->where_is_your_home_town== "16") { ?> selected="selected" <?php } ?>>Austria</option>
	<option value="17" <?php if($row->where_is_your_home_town== "17") { ?> selected="selected" <?php } ?>>Azerbaijan</option>
	<option value="18" <?php if($row->where_is_your_home_town== "18") { ?> selected="selected" <?php } ?>>Bahamas</option>
	<option value="19" <?php if($row->where_is_your_home_town== "19") { ?> selected="selected" <?php } ?>>Bahrain</option>
	<option value="20" <?php if($row->where_is_your_home_town== "20") { ?> selected="selected" <?php } ?>>Bangladesh</option>
	<option value="21" <?php if($row->where_is_your_home_town== "21") { ?> selected="selected" <?php } ?>>Barbados</option>
	<option value="22" <?php if($row->where_is_your_home_town== "22") { ?> selected="selected" <?php } ?>>Belarus</option>
	<option value="23" <?php if($row->where_is_your_home_town== "23") { ?> selected="selected" <?php } ?>>Belgium</option>
	<option value="24" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Belize</option>
	<option value="25" <?php if($row->where_is_your_home_town== "25") { ?> selected="selected" <?php } ?>>Benin</option>
	<option value="26" <?php if($row->where_is_your_home_town== "26") { ?> selected="selected" <?php } ?>>Bermuda</option>
	<option value="27" <?php if($row->where_is_your_home_town== "27") { ?> selected="selected" <?php } ?>>Bhutan</option>
	<option value="28" <?php if($row->where_is_your_home_town== "28") { ?> selected="selected" <?php } ?>>Bolivia</option>
	<option value="29" <?php if($row->where_is_your_home_town== "29") { ?> selected="selected" <?php } ?>>Bosnia and Herzegovina</option>
	<option value="30" <?php if($row->where_is_your_home_town== "30") { ?> selected="selected" <?php } ?>>Botswana</option>
	<option value="31" <?php if($row->where_is_your_home_town== "31") { ?> selected="selected" <?php } ?>>Brazil</option>
	<option value="32" <?php if($row->where_is_your_home_town== "32") { ?> selected="selected" <?php } ?>>British Indian Ocean Territory</option>
	<option value="33" <?php if($row->where_is_your_home_town== "33") { ?> selected="selected" <?php } ?>>Brunei Darussalam</option>
	<option value="34" <?php if($row->where_is_your_home_town== "34") { ?> selected="selected" <?php } ?>>Bulgaria</option>
	<option value="35" <?php if($row->where_is_your_home_town== "35") { ?> selected="selected" <?php } ?>>Burkina Faso</option>
	<option value="36" <?php if($row->where_is_your_home_town== "36") { ?> selected="selected" <?php } ?>>Burundi</option>
	<option value="38" <?php if($row->where_is_your_home_town== "38") { ?> selected="selected" <?php } ?>>Camaroon</option>
	<option value="37" <?php if($row->where_is_your_home_town== "37") { ?> selected="selected" <?php } ?>>Cambodia</option>
	<option value="301" <?php if($row->where_is_your_home_town== "301") { ?> selected="selected" <?php } ?>>Cameroon</option>
	<option value="39" <?php if($row->where_is_your_home_town== "39") { ?> selected="selected" <?php } ?>>Cape Verde</option>
	<option value="40" <?php if($row->where_is_your_home_town== "40") { ?> selected="selected" <?php } ?>>Cayman Islands</option>
	<option value="41" <?php if($row->where_is_your_home_town== "41") { ?> selected="selected" <?php } ?>>Central African Republic</option>
	<option value="42" <?php if($row->where_is_your_home_town== "42") { ?> selected="selected" <?php } ?>>Chad</option>
	<option value="44" <?php if($row->where_is_your_home_town== "44") { ?> selected="selected" <?php } ?>>Chile</option>
	<option value="43" <?php if($row->where_is_your_home_town== "43") { ?> selected="selected" <?php } ?>>China</option>
	<option value="47" <?php if($row->where_is_your_home_town== "47") { ?> selected="selected" <?php } ?>>Colombia</option>
	<option value="48" <?php if($row->where_is_your_home_town== "48") { ?> selected="selected" <?php } ?>>Comoros</option>
	<option value="49" <?php if($row->where_is_your_home_town== "49") { ?> selected="selected" <?php } ?>>Congo</option>
	<option value="50" <?php if($row->where_is_your_home_town== "50") { ?> selected="selected" <?php } ?>>Cook Islands</option>
	<option value="51" <?php if($row->where_is_your_home_town== "51") { ?> selected="selected" <?php } ?>>Costa Rica</option>
	<option value="52" <?php if($row->where_is_your_home_town== "52") { ?> selected="selected" <?php } ?>>Cote D Ivoire</option>
	<option value="53" <?php if($row->where_is_your_home_town== "53") { ?> selected="selected" <?php } ?>>Croatia</option>
	<option value="54" <?php if($row->where_is_your_home_town== "54") { ?> selected="selected" <?php } ?>>Cuba</option>
	<option value="55" <?php if($row->where_is_your_home_town== "55") { ?> selected="selected" <?php } ?>>Cyprus</option>
	<option value="56" <?php if($row->where_is_your_home_town== "56") { ?> selected="selected" <?php } ?>>Czech Republic</option>
	<option value="57" <?php if($row->where_is_your_home_town== "57") { ?> selected="selected" <?php } ?>>Denmark</option>
	<option value="58" <?php if($row->where_is_your_home_town== "58") { ?> selected="selected" <?php } ?>>Djibouti</option>
	<option value="59" <?php if($row->where_is_your_home_town== "59") { ?> selected="selected" <?php } ?>>Dominica</option>
	<option value="60" <?php if($row->where_is_your_home_town== "60") { ?> selected="selected" <?php } ?>>Dominican Republic</option>
	<option value="63" <?php if($row->where_is_your_home_town== "63") { ?> selected="selected" <?php } ?>>Ecuador</option>
	<option value="61" <?php if($row->where_is_your_home_town== "61") { ?> selected="selected" <?php } ?>>Egypt</option>
	<option value="62" <?php if($row->where_is_your_home_town== "62") { ?> selected="selected" <?php } ?>>El Salvador</option>
	<option value="64" <?php if($row->where_is_your_home_town== "64") { ?> selected="selected" <?php } ?>>Equatorial Guinea</option>
	<option value="65" <?php if($row->where_is_your_home_town== "65") { ?> selected="selected" <?php } ?>>Eritrea</option>
	<option value="66" <?php if($row->where_is_your_home_town== "66") { ?> selected="selected" <?php } ?>>Estonia</option>
	<option value="67" <?php if($row->where_is_your_home_town== "67") { ?> selected="selected" <?php } ?>>Ethiopia</option>
	<option value="68" <?php if($row->where_is_your_home_town== "68") { ?> selected="selected" <?php } ?>>Falkland Islands</option>
	<option value="69" <?php if($row->where_is_your_home_town== "69") { ?> selected="selected" <?php } ?>>Faroe Islands</option>
	<option value="70" <?php if($row->where_is_your_home_town== "70") { ?> selected="selected" <?php } ?>>Federated States of Micronesia</option>
	<option value="71" <?php if($row->where_is_your_home_town== "71") { ?> selected="selected" <?php } ?>>Fiji</option>
	<option value="72" <?php if($row->where_is_your_home_town== "72") { ?> selected="selected" <?php } ?>>Finland</option>
	<option value="73" <?php if($row->where_is_your_home_town== "73") { ?> selected="selected" <?php } ?>>France</option>
	<option value="74" <?php if($row->where_is_your_home_town== "74") { ?> selected="selected" <?php } ?>>French Guiana</option>
	<option value="75" <?php if($row->where_is_your_home_town== "75") { ?> selected="selected" <?php } ?>>French Polynesia</option>
	<option value="76" <?php if($row->where_is_your_home_town== "76") { ?> selected="selected" <?php } ?>>Gabon</option>
	<option value="79" <?php if($row->where_is_your_home_town== "79") { ?> selected="selected" <?php } ?>>Georgia</option>
	<option value="80" <?php if($row->where_is_your_home_town== "80") { ?> selected="selected" <?php } ?>>Germany</option>
	<option value="81" <?php if($row->where_is_your_home_town== "81") { ?> selected="selected" <?php } ?>>Ghana</option>
	<option value="82" <?php if($row->where_is_your_home_town== "82") { ?> selected="selected" <?php } ?>>Gibralter</option>
	<option value="83" <?php if($row->where_is_your_home_town== "83") { ?> selected="selected" <?php } ?>>Greece</option>
	<option value="84" <?php if($row->where_is_your_home_town== "84") { ?> selected="selected" <?php } ?>>Greenland</option>
	<option value="85" <?php if($row->where_is_your_home_town== "85") { ?> selected="selected" <?php } ?>>Grenada</option>
	<option value="86" <?php if($row->where_is_your_home_town== "86") { ?> selected="selected" <?php } ?>>Guadeloupe</option>
	<option value="87" <?php if($row->where_is_your_home_town== "87") { ?> selected="selected" <?php } ?>>Guam</option>
	<option value="88" <?php if($row->where_is_your_home_town== "88") { ?> selected="selected" <?php } ?>>Guatemala</option>
	<option value="90" <?php if($row->where_is_your_home_town== "90") { ?> selected="selected" <?php } ?>>Guinea</option>
	<option value="91" <?php if($row->where_is_your_home_town== "91") { ?> selected="selected" <?php } ?>>Guinea Bissau</option>
	<option value="92" <?php if($row->where_is_your_home_town== "92") { ?> selected="selected" <?php } ?>>Guyana</option>
	<option value="93" <?php if($row->where_is_your_home_town== "93") { ?> selected="selected" <?php } ?>>Haiti</option>
	<option value="95" <?php if($row->where_is_your_home_town== "95") { ?> selected="selected" <?php } ?>>Honduras</option>
	<option value="96" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Hong Kong</option>
	<option value="97" <?php if($row->where_is_your_home_town== "97") { ?> selected="selected" <?php } ?>>Hungary</option>
	<option value="98" <?php if($row->where_is_your_home_town== "98") { ?> selected="selected" <?php } ?>>Iceland</option>
	<option value="99" <?php if($row->where_is_your_home_town== "99") { ?> selected="selected" <?php } ?>>India</option>
	<option value="100" <?php if($row->where_is_your_home_town== "100") { ?> selected="selected" <?php } ?>>Indonesia</option>
	<option value="101" <?php if($row->where_is_your_home_town== "101") { ?> selected="selected" <?php } ?>>Iran</option>
	<option value="102" <?php if($row->where_is_your_home_town== "102") { ?> selected="selected" <?php } ?>>Iraq</option>
	<option value="103" <?php if($row->where_is_your_home_town== "103") { ?> selected="selected" <?php } ?>>Ireland</option>
	<option value="302" <?php if($row->where_is_your_home_town== "302") { ?> selected="selected" <?php } ?>>Isle of Man</option>
	<option value="104" <?php if($row->where_is_your_home_town== "104") { ?> selected="selected" <?php } ?>>Israel</option>
	<option value="105" <?php if($row->where_is_your_home_town== "105") { ?> selected="selected" <?php } ?>>Italy</option>
	<option value="106" <?php if($row->where_is_your_home_town== "106") { ?> selected="selected" <?php } ?>>Jamaica</option>
	<option value="109" <?php if($row->where_is_your_home_town== "109") { ?> selected="selected" <?php } ?>>Japan</option>
	<option value="110" <?php if($row->where_is_your_home_town== "110") { ?> selected="selected" <?php } ?>>Jordan</option>
	<option value="111" <?php if($row->where_is_your_home_town== "111") { ?> selected="selected" <?php } ?>>Kazakhstan</option>
	<option value="112" <?php if($row->where_is_your_home_town== "112") { ?> selected="selected" <?php } ?>>Kenya</option>
	<option value="113" <?php if($row->where_is_your_home_town== "113") { ?> selected="selected" <?php } ?>>Kiribati</option>
	<option value="114" <?php if($row->where_is_your_home_town== "114") { ?> selected="selected" <?php } ?>>Korea (Peoples Republic of)</option>
	<option value="115" <?php if($row->where_is_your_home_town== "115") { ?> selected="selected" <?php } ?>>Korea (Republic of)</option>
	<option value="116" <?php if($row->where_is_your_home_town== "116") { ?> selected="selected" <?php } ?>>Kuwait</option>
	<option value="304" <?php if($row->where_is_your_home_town== "304") { ?> selected="selected" <?php } ?>>Kyrgyzstan</option>
	<option value="117" <?php if($row->where_is_your_home_town== "117") { ?> selected="selected" <?php } ?>>Laos</option>
	<option value="118" <?php if($row->where_is_your_home_town== "118") { ?> selected="selected" <?php } ?>>Latvia</option>
	<option value="119" <?php if($row->where_is_your_home_town== "119") { ?> selected="selected" <?php } ?>>Lebanon</option>
	<option value="120" <?php if($row->where_is_your_home_town== "120") { ?> selected="selected" <?php } ?>>Lesotho</option>
	<option value="121" <?php if($row->where_is_your_home_town== "121") { ?> selected="selected" <?php } ?>>Liberia</option>
	<option value="305" <?php if($row->where_is_your_home_town== "305") { ?> selected="selected" <?php } ?>>Libya</option>
	<option value="123" <?php if($row->where_is_your_home_town== "123") { ?> selected="selected" <?php } ?>>Liechtenstein</option>
	<option value="124" <?php if($row->where_is_your_home_town== "124") { ?> selected="selected" <?php } ?>>Lithuania</option>
	<option value="125" <?php if($row->where_is_your_home_town== "125") { ?> selected="selected" <?php } ?>>Luxembourg</option>
	<option value="126" <?php if($row->where_is_your_home_town== "126") { ?> selected="selected" <?php } ?>>Macau</option>
	<option value="127" <?php if($row->where_is_your_home_town== "127") { ?> selected="selected" <?php } ?>>Macedonia</option>
	<option value="128" <?php if($row->where_is_your_home_town== "128") { ?> selected="selected" <?php } ?>>Madagascar</option>
	<option value="129" <?php if($row->where_is_your_home_town== "129") { ?> selected="selected" <?php } ?>>Malawi</option>
	<option value="130" <?php if($row->where_is_your_home_town== "130") { ?> selected="selected" <?php } ?>>Malaysia</option>
	<option value="131" <?php if($row->where_is_your_home_town== "131") { ?> selected="selected" <?php } ?>>Maldives</option>
	<option value="132" <?php if($row->where_is_your_home_town== "132") { ?> selected="selected" <?php } ?>>Mali</option>
	<option value="133" <?php if($row->where_is_your_home_town== "133") { ?> selected="selected" <?php } ?>>Malta</option>
	<option value="134" <?php if($row->where_is_your_home_town== "134") { ?> selected="selected" <?php } ?>>Marshall Islands</option>
	<option value="135" <?php if($row->where_is_your_home_town== "135") { ?> selected="selected" <?php } ?>>Martinique</option>
	<option value="136" <?php if($row->where_is_your_home_town== "136") { ?> selected="selected" <?php } ?>>Mauritius</option>
	<option value="137" <?php if($row->where_is_your_home_town== "137") { ?> selected="selected" <?php } ?>>Mayotte</option>
	<option value="138" <?php if($row->where_is_your_home_town== "138") { ?> selected="selected" <?php } ?>>Mexico</option>
	<option value="139" <?php if($row->where_is_your_home_town== "139") { ?> selected="selected" <?php } ?>>Moldova</option>
	<option value="140" <?php if($row->where_is_your_home_town== "140") { ?> selected="selected" <?php } ?>>Monaco</option>
	<option value="141" <?php if($row->where_is_your_home_town== "141") { ?> selected="selected" <?php } ?>>Mongolia</option>
	<option value="142" <?php if($row->where_is_your_home_town== "142") { ?> selected="selected" <?php } ?>>Montenegro</option>
	<option value="143" <?php if($row->where_is_your_home_town== "143") { ?> selected="selected" <?php } ?>>Montserrat</option>
	<option value="144" <?php if($row->where_is_your_home_town== "144") { ?> selected="selected" <?php } ?>>Morocco</option>
	<option value="145" <?php if($row->where_is_your_home_town== "145") { ?> selected="selected" <?php } ?>>Mozambique</option>
	<option value="146" <?php if($row->where_is_your_home_town== "146") { ?> selected="selected" <?php } ?>>Myanmar</option>
	<option value="147" <?php if($row->where_is_your_home_town== "147") { ?> selected="selected" <?php } ?>>Namibia</option>
	<option value="148" <?php if($row->where_is_your_home_town== "148") { ?> selected="selected" <?php } ?>>Nauru</option>
	<option value="149" <?php if($row->where_is_your_home_town== "149") { ?> selected="selected" <?php } ?>>Nepal</option>
	<option value="150" <?php if($row->where_is_your_home_town== "150") { ?> selected="selected" <?php } ?>>Netherlands</option>
	<option value="151" <?php if($row->where_is_your_home_town== "151") { ?> selected="selected" <?php } ?>>Netherlands Antilles</option>
	<option value="152" <?php if($row->where_is_your_home_town== "152") { ?> selected="selected" <?php } ?>>New Caledonia</option>
	<option value="153" <?php if($row->where_is_your_home_town== "153") { ?> selected="selected" <?php } ?>>New Zealand</option>
	<option value="154" <?php if($row->where_is_your_home_town== "154") { ?> selected="selected" <?php } ?>>Nicaragua</option>
	<option value="155" <?php if($row->where_is_your_home_town== "155") { ?> selected="selected" <?php } ?>>Niger</option>
	<option value="156" <?php if($row->where_is_your_home_town== "156") { ?> selected="selected" <?php } ?>>Nigeria</option>
	<option value="157" <?php if($row->where_is_your_home_town== "157") { ?> selected="selected" <?php } ?>>Niue</option>
	<option value="158" <?php if($row->where_is_your_home_town== "158") { ?> selected="selected" <?php } ?>>Norfolk Island</option>
	<option value="160" <?php if($row->where_is_your_home_town== "160") { ?> selected="selected" <?php } ?>>Northern Mariana Islands</option>
	<option value="161" <?php if($row->where_is_your_home_town== "161") { ?> selected="selected" <?php } ?>>Norway</option>
	<option value="162" <?php if($row->where_is_your_home_town== "162") { ?> selected="selected" <?php } ?>>Oman</option>
	<option value="163" <?php if($row->where_is_your_home_town== "163") { ?> selected="selected" <?php } ?>>Pakistan</option>
	<option value="164" <?php if($row->where_is_your_home_town== "164") { ?> selected="selected" <?php } ?>>Palau</option>
	<option value="165" <?php if($row->where_is_your_home_town== "165") { ?> selected="selected" <?php } ?>>Panama</option>
	<option value="166" <?php if($row->where_is_your_home_town== "166") { ?> selected="selected" <?php } ?>>Papua New Guinea</option>
	<option value="167" <?php if($row->where_is_your_home_town== "167") { ?> selected="selected" <?php } ?>>Paraguay</option>
	<option value="168" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Peru</option>
	<option value="169" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Philippines</option>
	<option value="170" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Pitcairn</option>
	<option value="171" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Poland</option>
	<option value="172" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Portugal</option>
	<option value="173" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Puerto Rico</option>
	<option value="174" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Qatar</option>
	<option value="175" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Reunion</option>
	<option value="176" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Romania</option>
	<option value="177" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Russian Federation</option>
	<option value="178" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Rwanda</option>
	<option value="179" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Saint Vincent and the Grenadines</option>
	<option value="180" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>San Marino</option>
	<option value="181" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Sao Tome and Principe</option>
	<option value="182" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Saudi Arabia</option>
	<option value="183" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Senegal</option>
	<option value="184" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Serbia</option>
	<option value="185" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Seychelles</option>
	<option value="186" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Sierra Leone</option>
	<option value="187" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Singapore</option>
	<option value="189" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Slovakia</option>
	<option value="190" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Slovenia</option>
	<option value="191" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Solomon Islands</option>
	<option value="192" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Somalia</option>
	<option value="193" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>South Africa</option>
	<option value="194" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>South Georgia</option>
	<option value="196" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Spain</option>
	<option value="188" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Sri Lanka</option>
	<option value="198" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>St. Kitts and Nevis</option>
	<option value="199" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>St. Lucia</option>
	<option value="307" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>St. Pierre and Miquelon</option>
	<option value="200" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Sudan</option>
	<option value="201" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Suriname</option>
	<option value="203" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Swaziland</option>
	
	<option value="204" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Sweden</option>
	<option value="205" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Switzerland</option>
	<option value="206" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Syrian Arab Republic</option>
	<option value="209" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Taiwan</option>
	<option value="207" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Tajikistan</option>
	<option value="208" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Tanzania</option>
	<option value="210" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Thailand</option>
	<option value="77" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>The Gambia</option>
	<option value="211" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Togo</option>
	<option value="212" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Tokelau</option>
	<option value="213" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Tonga</option>
	<option value="214" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Trinidad and Tobago</option>
	<option value="216" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Tunisia</option>
	<option value="217" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Turkey</option>
	<option value="218" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Turkmenistan</option>
	<option value="219" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Turks and Caicos Islands</option>
	<option value="220" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Tuvalu</option>
	<option value="221" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Uganda</option>
	<option value="222" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Ukraine</option>
	<option value="223" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>United Arab Emirates</option>
	<option value="225" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Uruguay</option>
	<option value="226" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Uzbekistan</option>
	<option value="227" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Vanuatu</option>
	<option value="228" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Venezuela</option>
	<option value="229" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Viet Nam</option>
	<option value="230" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Virgin Islands (U.K.)</option>
	<option value="231" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Virgin Islands (U.S.)</option>
	<option value="232" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Wallis and Futuna Islands</option>
	<option value="235" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Western Samoa</option>
	<option value="236" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Yemen</option>
	<option value="237" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Yugoslavia</option>
	<option value="238" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Zaire</option>
	<option value="239" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Zambia</option>
	<option value="240" <?php if($row->where_is_your_home_town== "96") { ?> selected="selected" <?php } ?>>Zimbabwe</option>
	</select>
	</div>
	</li>
	
	
	<li id="fo56li15" class="">
	<label class="desc" id="title0" for="Field0">
	Tell us about your brothers or sisters. Are you:
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
	<input id="Field15" name="do_you_have_any_brothers_or_sisters" class="field checkbox" value="the only child" tabindex="13" type="radio" <?php if($row->do_you_have_any_brothers_or_sisters== "the only child") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">the only child</label>
	
	<input id="Field15" name="do_you_have_any_brothers_or_sisters" class="field checkbox" value="the middle" tabindex="13" type="radio" <?php if($row->do_you_have_any_brothers_or_sisters== "the middle") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">the middle</label>
	
	<input id="Field15" name="do_you_have_any_brothers_or_sisters" class="field checkbox" value="from a large family" tabindex="13" type="radio" <?php if($row->do_you_have_any_brothers_or_sisters== "from a large family") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">from a large family</label>
	
	</div>
	
	<div class="column2">
	<input id="Field15" name="do_you_have_any_brothers_or_sisters" class="field checkbox" value="the oldest" tabindex="13" type="radio" <?php if($row->do_you_have_any_brothers_or_sisters== "the oldest") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">the oldest</label>
	
	<input id="Field15" name="do_you_have_any_brothers_or_sisters" class="field checkbox" value="the youngest" tabindex="13" type="radio" <?php if($row->do_you_have_any_brothers_or_sisters== "the youngest") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">the youngest</label>
	
	</div>
	<div class="clr"></div>
	</li>
	
	
	

	
	
	<li id="fo56li15" class="">
	<label class="desc" id="title0" for="Field0">
	Are you an early bird or night owl?
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
	<input id="Field15" name="you_an_early_bird_or_night_owl" class="field checkbox" value="early bird" tabindex="13" type="radio" <?php if($row->you_an_early_bird_or_night_owl== "early bird") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">early bird</label>
	
	<input id="Field15" name="you_an_early_bird_or_night_owl" class="field checkbox" value="neither" tabindex="13" type="radio" <?php if($row->you_an_early_bird_or_night_owl== "neither") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">neither</label>
	</div>
	
	<div class="column2">
	<input id="Field15" name="you_an_early_bird_or_night_owl" class="field checkbox" value="night owl" tabindex="13" type="radio" <?php if($row->you_an_early_bird_or_night_owl== "night owl") { ?> checked="checked" <?php } ?>/>
	<label class="choice" for="Field15">night owl</label>
	
	</div>
	<div class="clr"></div>
	</li>
	
	
		

	
	
	<li id="fo56li15" class="">
	<label class="desc" id="title0" for="Field0">
	Do you sing or play a musical instrument?
	<span id="req_0" class="req">*</span>
	</label>
	<div class="column1">
	<input id="Field15" name="do_you_play_a_musical_instrument[]" class="field checkbox" value="sing" tabindex="13" type="checkbox" <?php if(in_array("sing", $do_you_play_a_musical_instrument)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">sing</label>
	
	<input id="Field15" name="do_you_play_a_musical_instrument[]" class="field checkbox" value="jazz band" tabindex="13" type="checkbox" <?php if(in_array("jazz band", $do_you_play_a_musical_instrument)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">jazz band</label>
	
	<input id="Field15" name="do_you_play_a_musical_instrument[]" class="field checkbox" value="string quartet" tabindex="13" type="checkbox" <?php if(in_array("string quartet", $do_you_play_a_musical_instrument)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">string quartet</label>
	
	<input id="Field15" name="do_you_play_a_musical_instrument[]" class="field checkbox" value="other" tabindex="13" type="checkbox" <?php if(in_array("other", $do_you_play_a_musical_instrument)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">other</label>
	
	</div>
	
	<div class="column2">
	<input id="Field15" name="do_you_play_a_musical_instrument[]" class="field checkbox" value="rock band" tabindex="13" type="checkbox" <?php if(in_array("rock band", $do_you_play_a_musical_instrument)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">rock band</label>
	
	<input id="Field15" name="do_you_play_a_musical_instrument[]" class="field checkbox" value="orchestra" tabindex="13" type="checkbox" <?php if(in_array("orchestra", $do_you_play_a_musical_instrument)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">orchestra</label>
	
	
	<input id="Field15" name="do_you_play_a_musical_instrument[]" class="field checkbox" value="would love to learn" tabindex="13" type="checkbox" <?php if(in_array("would love to learn", $do_you_play_a_musical_instrument)) { ?>checked="checked"<?php } ?>/>
	<label class="choice" for="Field15">would love to learn</label>
	
	
	</div>
	<div class="clr"></div>
	</li>	
	
	<li id="decfie2" class="">
	<label class="desc" id="title14" for="Field14">
	What is your favourite colour?
	</label>
	<div>
	<select id="Field14" name="what_is_your_favourite_colour" class="field select medium" tabindex="15">
	<option value="NoAnswer" <?php if($row->what_is_your_favourite_colour== "NoAnswer") { ?> selected="selected" <?php } ?>>No Answer</option>
	<option value="430" <?php if($row->what_is_your_favourite_colour== "430") { ?> selected="selected" <?php } ?>>black</option>
	<option value="431" <?php if($row->what_is_your_favourite_colour== "431") { ?> selected="selected" <?php } ?>>blue</option>
	<option value="432" <?php if($row->what_is_your_favourite_colour== "432") { ?> selected="selected" <?php } ?>>brown</option>
	<option value="439" <?php if($row->what_is_your_favourite_colour== "439") { ?> selected="selected" <?php } ?>>gray</option>
	<option value="433" <?php if($row->what_is_your_favourite_colour== "433") { ?> selected="selected" <?php } ?>>green</option>
	<option value="434" <?php if($row->what_is_your_favourite_colour== "434") { ?> selected="selected" <?php } ?>>orange</option>
	<option value="438" <?php if($row->what_is_your_favourite_colour== "438") { ?> selected="selected" <?php } ?>>pink</option>
	<option value="436" <?php if($row->what_is_your_favourite_colour== "436") { ?> selected="selected" <?php } ?>>purple</option>
	<option value="435" <?php if($row->what_is_your_favourite_colour== "435") { ?> selected="selected" <?php } ?>>red</option>
	<option value="440" <?php if($row->what_is_your_favourite_colour== "440") { ?> selected="selected" <?php } ?>>white</option>
	<option value="437" <?php if($row->what_is_your_favourite_colour== "437") { ?> selected="selected" <?php } ?>>yellow</option>
	</select>
	</div>
	</li>
	
	</ul>
	<input type="reset" value="Reset" size="20" />
	<input type="submit" value="Submit" size="20" />
	</form>
	
	<?php
	}//end of else
}
else
{
	?> Sorry you can not view this page unless you are logged in<?php
}	

?>               
            </div><!--main col -->

            <?php include"includes/right.php";?>
		</div><!--two col --> 
<?php include"includes/footer.php";?>

