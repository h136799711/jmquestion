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
		if($sent=="del"){
			if(isset($_GET['flag'])){
				$flag = $_GET['flag'];
			}else{
				$flag = "";
			}
			$id = $_GET['id'];
			require 'includes/mysql_connect.php';
			$query = "delete from basicinfo where Basic_ID = $id";
			mysql_query($query);
			$query = "delete from question where Basic_ID = $id";
			mysql_query($query);
			$query = "delete from answer where Basic_ID = $id";
			mysql_query($query);
			$query = "delete from submit where Basic_ID = $id";
			mysql_query($query);
			if($flag=='zhgl'){
				exit("<script>alert('删除成功！');location.href='wjzhgl.php';</script>");
			}else{
				exit("<script>alert('删除成功！');location.href='wjjbsz.php';</script>");
			}
			
			mysql_close();
		}else{
			exit("<script>alert('非法操作！');window.close();</script>");
		}
		
	?>

</body>
</html>

















