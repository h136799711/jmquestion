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
	if($_SESSION['level']!="教研室" && $_SESSION['level']!="系部"){
			exit ("<script>alert('你没有权限操作！');window.close();</script>");
		}
	}
	require 'includes/mysql_connect.php';
	
	$object = $_GET['object1'];
	if($object==""){
		exit ("<script>alert('非法操作！');window.close();</script>");
	}else{
		$query = "select * from object where Object_ID <> $object";
		$result = mysql_query($query);
		echo "<option>请选择...</option>";
		while($rows = mysql_fetch_array($result)){
			echo "<option value='{$rows['Object_ID']}'>{$rows['Object_Name']}</option>";
		}
		mysql_close();
		
	}
	
?>




</body>
</html>

















