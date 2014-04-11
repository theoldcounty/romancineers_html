<?php
/* PHP on Input */
global $SESS, $DB;
$query = $DB->query("SELECT private_messages FROM exp_members WHERE member_id = '".$DB->escape_str($SESS->userdata['member_id'])."'");
exit($query->row['private_messages']);
?> 


<script type="text/javascript">

var XMLHttp=false;
var checkTime = 15; // 15 seconds

function checkPM()
{

var serverPage = '/ExpressionEngine140/index.php/site/anything/';

if (window.XMLHttpRequest)

{ XMLHttp = new XMLHttpRequest();
XMLHttp.onreadystatechange = processResult
XMLHttp.open("GET", serverPage);
XMLHttp.send(null);
// branch for IE/Windows ActiveX version
}
else if (window.ActiveXObject)
{
try
{
XMLHttp = new ActiveXObject("Microsoft.XMLHTTP");
}
catch(g){ var unSupported = 'y'; }

if (XMLHttp)
{
XMLHttp.onreadystatechange = processResult
XMLHttp.open("GET", serverPage);
XMLHttp.send(null);
}
}
}

function processResult()
{
if (XMLHttp.readyState [h3]4 && XMLHttp.status[/h3] 200)
{
var numPMs = XMLHttp.responseText;

numPMs = numPMs.replace(/\s/, '');
if (numPMs != '0')
{
document.getElementById('pm_off').style.display = 'none';
document.getElementById('pm_on').style.display = 'block';
}
else
{
document.getElementById('pm_off').style.display = 'block';
document.getElementById('pm_on').style.display = 'none';
}

document.getElementById('pm_unread').innerHTML = numPMs;
setTimeout("checkPM()", checkTime * 1000);
}
}

setTimeout("checkPM()", checkTime * 1000);

</script>

<div class="privatemessagebox">

<table cellpadding="0" cellspacing="3" border="0" style="width:100%;">
<tr>
<td style="width:50px;">
{if no_private_messages}
<div id="pm_off"><img src="{path:image_url}priv_msg_off.gif" border='0' width='40' height='40' /></div>
<div id="pm_on" style="display:none"><img src="{path:image_url}priv_msg_on.gif" border='0' width='40' height='40' /></div>
{/if}
{if private_messages}
<div id="pm_off" style="display:none"><img src="{path:image_url}priv_msg_off.gif" border='0' width='40' height='40' /></div>
<div id="pm_on" ><img src="{path:image_url}priv_msg_on.gif" border='0' width='40' height='40' /></div>
{/if}

</td>
<td>
<a href="{path:private_messages}">{lang:private_message}</a><br />
{lang:unread_pm} <span id="pm_unread">{total_unread_private_messages}</span>
</td>
<td>
{include:member_post_total}<br />
{lang:your_last_visit} 12-19-2005 01:41 AM
</td>
</tr>
</table>
</div> 