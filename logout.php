<?php
	session_start();
	session_destroy();
	exit("<script>window.location='index.php';</script>");
?>