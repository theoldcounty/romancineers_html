<?php
require_once('mysql.inc');
$c1 = new connection('localhost', 'wsmm', 'luckylove', 'wsmm_loveserver');
$current_date = date("Y-m-d H:i:s");

$chat = $_GET[chat];
$id = $_GET[id];


if(is_numeric($id))
{
	if(!empty($chat))
	{
		$chat = addslashes($chat);
		$c1->query("SELECT * FROM `intro` WHERE `id` ='$id'");
		$rc = $c1->getNumRows();
		
		if($rc>=1)
		{		
			$c1->query("UPDATE intro SET status_tag='$chat' WHERE id='$id'");
		}
		else
		{
			$c1->query("INSERT INTO `intro` (`id`,`status_tag`, `last_updated`) VALUES ('$id', '$chat', '$current_date');");
		}
		$chat  = str_replace('\\', '', $chat);
		echo''.$chat.'';		
	}
}
?>