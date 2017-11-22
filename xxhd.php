<?php
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>大学生跟踪调查</title>
<link href="style/question.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/question_do.js"></script>
</head>	
<body>

<?php
	if(!isset($_SESSION['username']) || !isset($_SESSION['level'])){
		exit ("<script>alert('请先登录！');location.href='index.php ';</script>");
	}
	require 'includes/mysql_connect.php';
	
	$phone = $_GET['phone'];
	$email = $_GET['email'];
	$work = $_GET['work'];
	$query = "update student set (Student_Phone,Student_Emial,Student_Work) values ('$phone','$email','$work')";
	mysql_query($query);
	mysql_close();
?>
</body>
</html>