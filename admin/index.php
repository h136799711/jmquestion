<?php 
	session_start();
	if(!isset($_SESSION['level']) || !isset($_SESSION['username'])){
		exit("<script>window.location='../index.php'</script>");
	}else{
		exit("<script>window.location='jys_index.php'</script>");
	}
?>