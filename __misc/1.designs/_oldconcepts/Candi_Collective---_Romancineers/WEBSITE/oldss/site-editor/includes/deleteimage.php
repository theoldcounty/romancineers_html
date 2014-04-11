<?php
$thumnbnail= $_REQUEST[li];

//delete thumbnail
unlink($thumnbnail);


$pattern = "thumbnail_";
$replacement = "resize_";
$original =  ereg_replace($pattern  , $replacement  , $thumnbnail);

//delete original
unlink($original);


?>