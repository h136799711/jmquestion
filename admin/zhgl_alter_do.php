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
	if($sent != "alter"){
		exit ("<script>alert('非法操作！');window.close();</script>");
	}else{
		$id = $_POST['id'];
		$username = $_POST['username'];
		if($username==""){
			exit ("<script>alert('用户名不得为空！');history.back();</script>");
		}
		$password = $_POST['password'];
		if($password!=""){
			$password = sha1($password);
		}
		$levels = $_POST['levels'];
		$major = $_POST['major'];
		if($levels!="教研室"){
			$major = "";
		}
		$query = "select * from admin where Admin_UserName = '$username' and Admin_ID <> $id";
		if(mysql_num_rows(mysql_query($query))<=0){
			if($password==""){
				$query = "update admin set Admin_UserName = '$username',Admin_Level = '$levels',Admin_Major = '$major' where Admin_ID = $id";
			}else{
				$query = "update admin set Admin_UserName = '$username',Admin_PassWord = '$password',Admin_Level = '$levels',Admin_Major = '$major' where Admin_ID = $id";
			}
			mysql_query($query);
		}else{
			exit ("<script>alert('用户名重复，请重新添加！');history.back();</script>");
		}
		mysql_close();
		exit ("<script>alert('修改成功！');location.href='zhgl.php';</script>");
	}
	
?>




</body>
</html>

















