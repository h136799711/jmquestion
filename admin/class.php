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
	$major = "";
	$major = $_GET['major'];
	echo "major=".$major.'|';
	if($major==""){
		exit ("<script>alert('非法操作！');window.close();</script>");
	}else{
		$query = "select * from major where Major_Name = '$major'";
		echo $query;
		$result = mysql_query($query);
		$mid = "";
		if($rows = mysql_fetch_array($result)){
			$mid = $rows['Major_ID'];
		}
		mysql_free_result($result);
		$query = "select * from class where Major_ID = $mid";
		$result = mysql_query($query);
		while($rows = mysql_fetch_array($result)){
			echo "<option value='{$rows['Class_Name']}'>{$rows['Class_Name']}</option>";
		}
		mysql_close();
		
	}
	
?>




</body>
</html>

















