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
		$classname = $_POST['classname'];
		if($classname==""){
			exit ("<script>alert('班级名称不得为空！');history.back();</script>");
		}
		$mid = $_POST['major'];
		$query = "select * from class where Class_Name = '$classname' and Class_ID <> $id";
		if(mysql_num_rows(mysql_query($query))<=0){
			$query = "update class set Class_Name = '$classname',Major_ID = $mid where Class_ID = $id";
			mysql_query($query);
		}else{
			exit ("<script>alert('班级名称重复，请重新添加！');history.back();</script>");
		}
		mysql_close();
		exit ("<script>alert('修改成功！');location.href='bjgl.php';</script>");
	}
	
?>




</body>
</html>

















