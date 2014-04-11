
<h3>Photo Upload and Crop</h3>
<noscript>Javascript must be enabled!</noscript>
<div id="upload_status" style="font-size:12px; width:80%; margin:10px; padding:5px; display:none; border:1px #999 dotted; background:#eee;"></div>
<p>
	<a id="upload_link" style="background:#39f; font-size: 24px; color: white;" href="#">
	Click here to upload a photo
	</a>
</p>
<span id="loader" style="display:none;"><img src="loader.gif" alt="Loading..."/></span> 
<span id="progress"></span>
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
