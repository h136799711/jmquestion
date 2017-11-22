<?php

	require "phpmail_jiucool.php";
	$address = $_POST['address'];

	//$addresss = split(";",$address);
	$addresss = explode(";",$address);
	//print_r($addresss);
	$title = $_POST['title'];
	$content = $_POST['content'];
	postmail_jiucool_com($addresss,$title,$content);
?>