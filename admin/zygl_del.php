<?php
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>大学生跟踪调查</title>
<link href="style/index.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
	if(!isset($_SESSION['level']) || !isset($_SESSION['username'])){
		exit ("<script>alert('非法操作！');window.close();</script>");
	}else{
		if($_SESSION['level']!="管理员"){
			exit ("<script>alert('你没有权限操作！');window.close();</script>");
		}
	}
	require 'includes/mysql_connect.php';
	
	$id = $_GET['id'];
	if($id==""){
		exit ("<script>alert('非法操作！');window.close();</script>");
	}
	$query = "delete from class where Major_ID = $id";
	mysql_query($query);
	$query = "delete from major where Major_ID = $id";
	mysql_query($query);
	mysql_close();
	exit ("<script>alert('删除成功！');history.back();</script>");
?>




</body>
</html>

















