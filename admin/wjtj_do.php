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
		if($_SESSION['level']!="教研室"){
			exit ("<script>alert('你没有权限使用！');window.close();</script>");
		}
	}
?>
	<?php
		$sent = $_GET['sent'];
		if($sent=="add"){
			$title = $_POST['title'];
			if(trim($title)==""){
				exit ("<script>alert('问卷名称不得为空！');history.back();</script>");
			}
			$abstract = $_POST['abstract'];
			if(trim($abstract)==""){
				exit ("<script>alert('问卷说明不得为空！');history.back();</script>");
			}
			$object = $_POST['object'];
			if(trim($object)==""){
				exit ("<script>alert('调查对象不得为空！');history.back();</script>");
			}
			$number = $_POST['number'];
			if(trim($number)==""){
				exit ("<script>alert('调查人数不得为空！');history.back();</script>");
			}
			/*
			$starttime = $_POST['startTime'];
			if(trim($starttime)==""){
				exit ("<script>alert('开始时间不得为空！');history.back();</script>");
			}
			$endtime = $_POST['endTime'];
			if(trim($endtime)==""){
				exit ("<script>alert('结束时间不得为空！');history.back();</script>");
			}
			*/
			$power = $_POST['power'];			
			require 'includes/mysql_connect.php';
			if($power==1){
				$query = "update basicinfo set Basic_Power = 0 where Basic_Power = 1 and Basic_Major = '{$_SESSION['major']}'";
				mysql_query($query);
			}
			$query = "insert into basicinfo(		Basic_Title,
																	Basic_Abstract,
																	Basic_Object,
																	Basic_Number,
																	Basic_Power,
																	Basic_DateTime,
																	Basic_Major
																)values(
																	'$title',
																	'$abstract',
																	'$object',
																	'$number',
																	$power,
																	NOW(),
																	'{$_SESSION['major']}'
																)";
			$result = mysql_query($query);
			if($result){
				exit ("<script>location.href='wjjbsz.php';</script>");
			}else{
				exit ("<script>alert('添加失败');history.back();</script>");
			}
			mysql_close();
		}else{
			exit("<script>alert('非法操作！');window.close();</script>");
		}
		
	?>

</body>
</html>

















