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
	}
	require 'includes/mysql_connect.php';
	
	$sent = $_GET["sent"];
	if($sent == "alter"){
		$oldpassword = trim($_POST['oldpassword']);
		if($oldpassword==""){
			exit ("<script>alert('旧密码不得为空！');history.back();</script>");
		}
		$password = trim($_POST['password']);
		if($password==""){
			exit ("<script>alert('新密码不得为空！');history.back();</script>");
		}
		$qpassword = trim($_POST['qpassword']);
		if($qpassword==""){
			exit ("<script>alert('确认密码不得为空！');history.back();</script>");
		}
		if($password!=$qpassword){
			exit ("<script>alert('两次密码输入不一致！');history.back();</script>");
		}
		$oldpassword = sha1($oldpassword);
		$password = sha1($password);
		$query = "select * from admin where Admin_UserName = '{$_SESSION['username']}' and Admin_PassWord = '$oldpassword'";
		if(mysql_num_rows(mysql_query($query))>0){
			$query = "update admin set Admin_PassWord = '$password' where Admin_UserName = '{$_SESSION['username']}'";
			mysql_query($query);
			exit ("<script>alert('密码修改成功，请重新登录！');location.href='logout.php';</script>");
		}else{
			exit ("<script>alert('旧密码错误！');history.back();</script>");
		}
		
		mysql_close();
	}
?>

	<div id="password_alter" style="height:700px;">
		<h1>密码修改</h1>
		<form name="password_alter_form" method="post" action="?sent=alter">
			<ul>
				<li>旧 密 码：<input type="password" name="oldpassword" class="text" /></li>
				<li>新 密 码：<input type="password" name="password" class="text" /></li>
				<li>确认密码：<input type="password" name="qpassword" class="text" /></li>
				<li><input type="submit" name="sent" value="确认" class="submit" /></li>
			</ul>
		</form>
	</div>



</body>
</html>

















