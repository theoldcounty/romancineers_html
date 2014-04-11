<?php
	require_once('includes/header.php');
?>

			<div id="maincol" >


<?php
//do you want to add or edit journals


//add journal
?>





<form method="post" action="journal.php?s=0">
	<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
	<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 100%">
	</textarea>

	<div>
		<!-- Some integration calls -->
		<a href="javascript:;" onmousedown="tinyMCE.get('elm1').show();">[Show]</a>
		<a href="javascript:;" onmousedown="tinyMCE.get('elm1').hide();">[Hide]</a>
		<a href="javascript:;" onmousedown="tinyMCE.get('elm1').execCommand('Bold');">[Bold]</a>

	</div>

	<br />
	<input type="submit" name="save" value="Submit" />
	<input type="reset" name="reset" value="Reset" />
</form>





<?php
//upload photos on the fly


?>




<h1>Photo Upload and Crop</h1>
<noscript>Javascript must be enabled!</noscript>
	<h2>Upload Photo</h2>
	<div id="upload_status" style="font-size:12px; width:80%; margin:10px; padding:5px; display:none; border:1px #999 dotted; background:#eee;"></div>
	<p><a id="upload_link" style="background:#39f; font-size: 24px; color: white;" href="#">Click here to upload a photo</a></p>
	<span id="loader" style="display:none;"><img src="loader.gif" alt="Loading..."/></span> <span id="progress"></span>
	<br />
	<div id="uploaded_image"></div>
	<div id="thumbnail_form" style="display:none;">
		<form name="form" action="" method="post">
			<input type="hidden" name="x1" value="" id="x1" />
			<input type="hidden" name="y1" value="" id="y1" />
			<input type="hidden" name="x2" value="" id="x2" />
			<input type="hidden" name="y2" value="" id="y2" />
			<input type="hidden" name="w" value="" id="w" />
			<input type="hidden" name="h" value="" id="h" />
			<input type="submit" name="save_thumb" value="Save Thumbnail" id="save_thumb" />
		</form>
	</div>




<?php
echo''.stripslashes($_REQUEST[elm1]).'';
?>


<?php

//edit
?>



			</div>


	<?php
		require_once('includes/left.php');
	?>

</div>


<?php
	require_once('includes/footer.php');
?>


