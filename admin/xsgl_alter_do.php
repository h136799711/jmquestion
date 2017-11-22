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
		$sid = $_POST['sid'];
		if($sid==""){
			exit ("<script>alert('学号不得为空！');history.back();</script>");
		}
		$sname = $_POST['sname'];
		if($sname==""){
			exit ("<script>alert('姓名不得为空！');history.back();</script>");
		}
		$sex = $_POST['sex'];
		if($sex==""){
			exit ("<script>alert('性别不得为空！');history.back();</script>");
		}
		$major = $_POST['major'];
		if($major==""){
			exit ("<script>alert('专业不得为空！');history.back();</script>");
		}
		$class = $_POST['class'];
		if($class==""){
			exit ("<script>alert('班级不得为空！');history.back();</script>");
		}
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$object = $_POST['object'];
		$card = $_POST['card'];
		$work = $_POST['work'];
		if($card==""){
			exit ("<script>alert('身份证不得为空！');history.back();</script>");
		}
		if($username==""){
			exit ("<script>alert('用户名不得为空！');history.back();</script>");
		}
		
		
		$query = "select * from student where Student_ID = '$sid' and Student_SID <> $id";
		if(mysql_num_rows(mysql_query($query))<=0){
			$query = "update student set Student_ID='$sid',Student_Name='$sname',Student_Sex='$sex',Student_Major='$major',Student_Class='$class',Student_Phone='$phone',Student_Email='$email',Student_Object='$object',Student_Card='$card',Student_Work = '$work' where Student_SID = $id";
			mysql_query($query);
		}else{
			exit ("<script>alert('学号重复，请重新添加！');history.back();</script>");
		}
		mysql_close();
		exit ("<script>alert('修改成功！');location.href='xsgl.php';</script>");
	}
	
?>




</body>
</html>

















