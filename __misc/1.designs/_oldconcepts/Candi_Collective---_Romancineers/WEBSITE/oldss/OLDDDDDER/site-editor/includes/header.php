<?php
include "session.php";
require_once('includes/mysql.inc');
error_reporting (E_ALL ^ E_NOTICE);
include("image_functions.php");	

//variables
$site_editor_host ="http://www.wallersclothing.com/site-editor/";
$site_name ="Wallers Clothing"; 
$site_admin_email ="zee_zack@hotmail.com";  //test email
$site_admin_name = "Rob Shan Lone";

//connection1 object
$c1 = new connection('localhost', 'wallers', 'jaffa', 'wallers_suits');

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
	$c1->query("update plus_login set status='OFF' where id='$_SESSION[id]'");
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

	$c1->query("SELECT * FROM plus_signup WHERE userid='$userid' AND password = '$password'");

	if($rec = $c1->fetchAll())
	{
		//admin has username, password, confirmed and is enabled.
		if(($rec[0]['userid']==$userid)&&($rec[0]['password']==$password)&&($rec[0]['is_confirmed']=='1')&&($rec[0]['enable']=='1'))
		{
			include "includes/newsession.php";					
			$tm=date("Y-m-d H:i:s");			
			$ip=$_SERVER['REMOTE_ADDR'];
			
			//if not already in login database
			$c1->query("UPDATE plus_login SET id='$_SESSION[id]', ip='$ip', tm='$tm' WHERE userid='$_SESSION[userid]'");
			
			if ($c1->getAffectedRows() == 0)
			{
				// No records updated, so add it
				$c1->query("insert into plus_login(id,userid,ip,tm) values('$_SESSION[id]','$_SESSION[userid]','$ip','$tm')");
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
<head>
<title>Admin Editor</title>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<meta name="generator" content="www.fusionrobotdesign.com" />

<link rel="stylesheet" href="css/generic.css" type="text/css" />


<script type="text/javascript" src="js/jquery-pack.js"></script>
<script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="js/jquery.ocupload-packed.js"></script>


<script type="text/javascript">
//<![CDATA[
var myimages=new Array();

//create a preview of the selection
function preview(img, selection) {
	//get width and height of the uploaded image.
	var current_width = $('#uploaded_image').find('#thumbnail').width();
	var current_height = $('#uploaded_image').find('#thumbnail').height();

	var scaleX = <?php echo $thumb_width;?> / selection.width;
	var scaleY = <?php echo $thumb_height;?> / selection.height;

	$('#uploaded_image').find('#thumbnail_preview').css({
		width: Math.round(scaleX * current_width) + 'px',
		height: Math.round(scaleY * current_height) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
	});
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
}

//show and hide the loading message
function loadingmessage(msg, show_hide){
	if(show_hide=="show"){
		$('#loader').show();
		$('#progress').show().text(msg);
		$('#uploaded_image').html('');
	}else if(show_hide=="hide"){
		$('#loader').hide();
		$('#progress').text('').hide();
	}else{
		$('#loader').hide();
		$('#progress').text('').hide();
		$('#uploaded_image').html('');
	}
}

//delete the image when the delete link is clicked.
function deleteimage(large_image, thumbnail_image){
	loadingmessage('Please wait, deleting images...', 'show');
	$.ajax({
		type: 'POST',
		url: '<?=$image_handling_file?>',
		data: 'a=delete&large_image='+large_image+'&thumbnail_image='+thumbnail_image,
		cache: false,
		success: function(response){
			loadingmessage('', 'hide');
			response = unescape(response);
			var response = response.split("|");
			var responseType = response[0];
			var responseMsg = response[1];
			if(responseType=="success"){
				$('#upload_status').show().html('<h1>Success</h1><p>'+responseMsg+'</p>');
				$('#uploaded_image').html('');
				
				var len = myimages.length;
				myimages.splice(len-1,1);
				var variable = "<input type='hidden' name='images' size='80' value='"+myimages+"'>"
				$('#uploaded_image2').html(variable);	

			}else{
				$('#upload_status').show().html('<h1>Unexpected Error</h1><p>Please try again</p>'+response);
			}
		}
	});
}

$(document).ready(function () {
		$('#loader').hide();
		$('#progress').hide();
		var myUpload = $('#upload_link').upload({
		   name: 'image',
		   action: '<?=$image_handling_file?>',
		   enctype: 'multipart/form-data',
		   params: {upload:'Upload'},
		   autoSubmit: true,
		   onSubmit: function() {
		   		$('#upload_status').html('').hide();
				loadingmessage('Please wait, uploading file...', 'show');
		   },
		   onComplete: function(response) {
		   		loadingmessage('', 'hide');
				response = unescape(response);
				var response = response.split("|");
				var responseType = response[0];
				var responseMsg = response[1];
				if(responseType=="success"){
					var current_width = response[2];
					var current_height = response[3];
					//display message that the file has been uploaded
					$('#upload_status').show().html('<h1>Success</h1><p>The image has been uploaded</p>');
					//put the image in the appropriate div
					$('#uploaded_image').html('<img src="'+responseMsg+'" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" /><div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;"><img src="'+responseMsg+'" style="position: relative;" id="thumbnail_preview" alt="Thumbnail Preview" /></div>')
					
					//grab the loaded temp image
					//myimages.push(responseMsg);
					
					myimages.push(responseMsg);

					var variable = "<input type='hidden' name='images' size='80' value='"+myimages+"'>"
					$('#uploaded_image2').html(variable);						
						
					//find the image inserted above, and allow it to be cropped
					$('#uploaded_image').find('#thumbnail').imgAreaSelect({ aspectRatio: '1:<?php echo $thumb_height/$thumb_width;?>', onSelectChange: preview });
					//display the hidden form
					$('#thumbnail_form').show();
				}else if(responseType=="error"){
					$('#upload_status').show().html('<h1>Error</h1><p>'+responseMsg+'</p>');
					$('#uploaded_image').html('');
					$('#thumbnail_form').hide();
				}else{
					$('#upload_status').show().html('<h1>Unexpected Error</h1><p>Please try again</p>'+response);
					$('#uploaded_image').html('');
					$('#thumbnail_form').hide();
				}
		   }
		});

	//create the thumbnail
	$('#save_thumb').click(function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("You must make a selection first");
			return false;
		}else{
			//hide the selection and disable the imgareaselect plugin
			$('#uploaded_image').find('#thumbnail').imgAreaSelect({ disable: true, hide: true });
			loadingmessage('Please wait, saving thumbnail....', 'show');
			$.ajax({
				type: 'POST',
				url: '<?=$image_handling_file?>',
				data: 'save_thumb=Save Thumbnail&x1='+x1+'&y1='+y1+'&x2='+x2+'&y2='+y2+'&w='+w+'&h='+h,
				cache: false,
				success: function(response){
					loadingmessage('', 'hide');
					response = unescape(response);
					var response = response.split("|");
					var responseType = response[0];
					var responseLargeImage = response[1];
					var responseThumbImage = response[2];
					if(responseType=="success"){
						$('#upload_status').show().html('<h1>Success</h1><p>The thumbnail has been saved!</p>');
						//load the new images
						$('#uploaded_image').html('<img src="'+responseLargeImage+'" alt="Large Image"/>&nbsp;<img src="'+responseThumbImage+'" alt="Thumbnail Image"/><br /><a href="javascript:deleteimage(\''+responseLargeImage+'\', \''+responseThumbImage+'\');">Delete Images</a>');
						//hide the thumbnail form
						$('#thumbnail_form').hide();
					}else{
						$('#upload_status').show().html('<h1>Unexpected Error</h1><p>Please try again</p>'+response);
						//reactivate the imgareaselect plugin to allow another attempt.
						$('#uploaded_image').find('#thumbnail').imgAreaSelect({ aspectRatio: '1:<?php echo $thumb_height/$thumb_width;?>', onSelectChange: preview });
						$('#thumbnail_form').show();
					}
				}
			});

			return false;
		}
	});
});


//]]>
</script>



<script type="text/javascript">
function validate(form) {
if (!document.form1.agree.checked) { alert("Please Read the guidlines and check the box below  .");
 return false; }
return true;
}
</script>






<script type="text/javascript">

function fillCategory()
{
     // this function is used to fill the category list on load
    <?php
	$c1->query("select * from category");
 
	if($rec = $c1->fetchAll())
	{				
		foreach ($rec as &$value) 
		{
			?>addOption(document.preview.category, '<?php echo''.$value[cat_id].''; ?>', '<?php echo''.$value[category].''; ?>');<?php
		}
	} 

    ?>
} // end of JS function

function SelectSubCat()
{
        // ON or after selection of category this function will work
                
        removeAllOptions(document.preview.subcat);
        addOption(document.preview.subcat, "", "SubCat", "");
        
        // Collect all element of subcategory for various cat_id
    
    <?php
        // let us collect all cat_id and then collect all subcategory for each cat_id
			$c1->query("select distinct(cat_id) from subcategory");

		if($rec = $c1->fetchAll())
		{				
			foreach ($rec as &$value) 
			{
				?>
				if(document.preview.category.value == '<?php echo''.$value[cat_id].''; ?>')
				{
				<?php
					$c1->query("select subcategory from subcategory where cat_id='$value[cat_id]'");
	
					if($rec = $c1->fetchAll())
					{				
						foreach ($rec as &$value) 
						{
							echo "addOption(document.preview.subcat,'$value[subcategory]', '$value[subcategory]');";
						}
					}
					?>       
				}		
				<?php
			}
		} 
?>
} // end of JS function

function removeAllOptions(selectbox)
{
	var i;
	for(i=selectbox.options.length-1;i>=0;i--)
	{
		//selectbox.options.remove(i);
		selectbox.remove(i);
	}
} // end of JS function


function addOption(selectbox, value, text )
{
	var optn = document.createElement("OPTION");
	optn.text = text;
	optn.value = value;
	selectbox.options.add(optn);
} // end of JS function
</script>



  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("li");

//Built a url to send
var info = 'li=../' + del_id;


if(confirm("Sure you want to delete this update? There is NO undo!"))
{

$.ajax({
type: "POST",
url: "includes/deleteimage.php",
data: info,
success: function(){
}
});
 
//document.write('<a href="includes/deleteimage.php?'+info+'">another page</a>'); 
			
	$(this).parents(".record")
	.animate({ backgroundColor: "#fbc7c7" }, "fast")
	.animate({ opacity: "hide" }, "slow");
}

return false;

});

});
</script>






<link rel="stylesheet" type="text/css" href="js/simple_editor_clean_files/fonts-min.css">
<link rel="stylesheet" type="text/css" href="js/simple_editor_clean_files/simpleeditor.css">
<script type="text/javascript" src="js/simple_editor_clean_files/yahoo-dom-event.js"></script>
<script type="text/javascript" src="js/simple_editor_clean_files/element-beta-min.js"></script>
<script type="text/javascript" src="js/simple_editor_clean_files/container_core-min.js"></script>
<script type="text/javascript" src="js/simple_editor_clean_files/simpleeditor-min.js"></script>



</head>

<body  class="yui-skin-sam" <? if($sourceiscatlog){?>onLoad="fillCategory();"<?php }?>>



<div id="pagewidth">
	<div id="header"> 
    	<div class="logo">Head</div>
        <div class="navigation"><?php include "session_check.php"; ?></div>	
        <div class="clr"></div>	   
    </div>
			<div id="wrapper" class="clearfix" >
