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
			$id = $_POST['id'];
			if($id==""){
				exit("<script>alert('非法操作！');window.close();</script>");
			}
			$type = $_POST['type'];
			$title = $_POST['title'];
			if(trim($title)==""){
				exit ("<script>alert('问题不得为空！');history.back();</script>");
			}
			if($type!="简单题"){
				$a = $_POST['a'];
				$b = $_POST['b'];
				$c = $_POST['c'];
				$d = $_POST['d'];
				$e = $_POST['e'];
				$f = $_POST['f'];
			}else{
				$a = "";
				$b = "";
				$c = "";
				$d = "";
				$e = "";
				$f = "";
			}
			require 'includes/mysql_connect.php';
			$query = "insert into question(		 Basic_ID,
																	 Question_Title,
																	 Question_Type,
																	 Question_DateTime,
																	 Question_A,
																	 Question_B,
																	 Question_C,
																	 Question_D,
																	 Question_E,
																	 Question_F,
																	 Question_Major
																)values(
																	$id,
																	'$title',
																	'$type',
																	NOW(),
																	'$a',
																	'$b',
																	'$c',
																	'$d',
																	'$e',
																	'$f',
																	'{$_SESSION['major']}'
																)";
			$result = mysql_query($query);
			if($result){
				exit ("<script>location.href='wjnrtj.php?id=$id';</script>");
			}else{
				exit ("<script>alert('添加失败');history.back();</script>");
			}
		}else{
			exit("<script>alert('非法操作！');window.close();</script>");
		}
		mysql_close();
	?>

</body>
</html>

















