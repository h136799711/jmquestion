<?php
	session_start();
	session_destroy();
	exit("<script>window.open('../index.php','_parent')</script>");
?>