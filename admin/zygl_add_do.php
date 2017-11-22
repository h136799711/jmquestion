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
		$major = $_POST['major'];
		if($major==""){
			exit ("<script>alert('专业名称不得为空！');history.back();</script>");
		}
		$query = "select * from major where Major_Name = '$major'";
		if(mysql_num_rows(mysql_query($query))<=0){
			$query = "insert into major (Major_Name) values ('$major')";
			mysql_query($query);
		}else{
			exit ("<script>alert('专业名称重复，请重新添加！');history.back();</script>");
		}
		mysql_close();
		exit ("<script>alert('添加成功！');location.href='zygl.php';</script>");
	}
	
?>




</body>
</html>

















