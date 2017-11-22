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
		if($sent=="power"){
			$id = $_GET['id'];
			$power = $_GET['power'];
			if($id==""){
				exit("<script>alert('非法操作！');window.close();</script>");
			}
			if($power==""){
				exit("<script>alert('非法操作！');window.close();</script>");
			}
			require 'includes/mysql_connect.php';
			if($power==1){
				$query = "update basicinfo set Basic_Power=0 where Basic_ID = $id ";
				mysql_query($query);
			}else if($power==0){
				$query = "update basicinfo set Basic_Power=0 where Basic_Major = '{$_SESSION['major']}'";
				mysql_query($query);
				$query = "update basicinfo set Basic_Power=1 where Basic_ID = $id";
				mysql_query($query);
			}
			exit("<script>location.href='wjzhgl.php';</script>");
			mysql_close();
		}else{
			exit("<script>alert('非法操作！');window.close();</script>");
		}
		
	?>

</body>
</html>

















