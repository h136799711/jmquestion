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
	
	$sent = $_GET['sent'];
	if($sent != "add"){
		exit ("<script>alert('非法操作！');window.close();</script>");
	}else{
		$username = $_POST['username'];
		if($username==""){
			exit ("<script>alert('用户名不得为空！');history.back();</script>");
		}
		$password = $_POST['password'];
		if($password==""){
			exit ("<script>alert('密码不得为空！');history.back();</script>");
		}
		$levels = $_POST['levels'];
		$major = $_POST['major'];
		if($levels!="教研室"){
			$major = "";
		}
		$query = "select * from admin where Admin_UserName = '$username'";
		if(mysql_num_rows(mysql_query($query))<=0){
			$query = "insert into admin (Admin_UserName,Admin_PassWord,Admin_Level,Admin_Major) values ('$username','$password','$levels','$major')";
			mysql_query($query);
		}else{
			exit ("<script>alert('用户名重复，请重新添加！');history.back();</script>");
		}
		mysql_close();
		exit ("<script>alert('添加成功！');location.href='zhgl.php';</script>");
	}
	
?>




</body>
</html>

















