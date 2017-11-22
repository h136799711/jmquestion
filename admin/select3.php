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
	
	$object1 = $_GET['object1'];
	$object2= $_GET['object2'];
	$object3= $_GET['object3'];
	
	if(isset($_GET['major']) && $_GET['major']!=''){
		$major = $_GET['major'];
	}else{
		$major = $_SESSION['major'];
	}
	if($object1 == "" || $object2 == "" || $object3 == ""){
		exit ("<script>alert('非法操作！');window.close();</script>");
	}else{
		$query = "select * from object where Object_ID = $object1";
		$result = mysql_query($query);
		if($rows = mysql_fetch_array($result)){
			$query1 = "select * from basicinfo where Basic_Object = '{$rows['Object_Name']}' and Basic_Major = '$major'";
			$result1 = mysql_query($query1);
			if($rows1 = mysql_fetch_array($result1)){
				$bid1 = $rows1['Basic_ID'];
			}
			mysql_free_result($result1);
		}
		mysql_free_result($result);
		
		$query = "select * from object where Object_ID = $object2";
		$result = mysql_query($query);
		if($rows = mysql_fetch_array($result)){
			$query1 = "select * from basicinfo where Basic_Object = '{$rows['Object_Name']}' and Basic_Major = '$major'";
			$result1 = mysql_query($query1);
			if($rows1 = mysql_fetch_array($result1)){
				$bid2 = $rows1['Basic_ID'];
			}
			mysql_free_result($result1);
		}
		mysql_free_result($result);
		
		$query = "select * from object where Object_ID = $object3";
		$result = mysql_query($query);
		if($rows = mysql_fetch_array($result)){
			$query1 = "select * from basicinfo where Basic_Object = '{$rows['Object_Name']}' and Basic_Major = '$major'";
			$result1 = mysql_query($query1);
			if($rows1 = mysql_fetch_array($result1)){
				$bid3 = $rows1['Basic_ID'];
			}
			mysql_free_result($result1);
		}
		mysql_free_result($result);
		
		echo "<option>请选择...</option>";

		$query = "select * from question where Basic_ID = $bid1";
		$result = mysql_query($query);
		while($rows = mysql_fetch_array($result)){
			$query1 = "select * from question where Basic_ID = $bid2";
			$result1 = mysql_query($query1);
			while($rows1 = mysql_fetch_array($result1)){
				$query2 = "select * from question where Basic_ID = $bid3";
				$result2 = mysql_query($query2);
				while($rows2 = mysql_fetch_array($result2)){
					if($rows['Question_Type'] !='简答题' && $rows['Question_Title']==$rows1['Question_Title'] && $rows['Question_Title']==$rows2['Question_Title'] && $rows['Question_A']==$rows1['Question_A'] && $rows['Question_A']==$rows2['Question_A'] && $rows['Question_B']==$rows1['Question_B'] && $rows['Question_B']==$rows2['Question_B'] && $rows['Question_C']==$rows1['Question_C'] && $rows['Question_C']==$rows2['Question_C'] && $rows['Question_D']==$rows1['Question_D'] && $rows['Question_D']==$rows2['Question_D'] && $rows['Question_E']==$rows1['Question_E'] && $rows['Question_E']==$rows2['Question_E'] && $rows['Question_F']==$rows1['Question_F'] && $rows['Question_F']==$rows2['Question_F']){
						echo "<option value='{$rows['Question_ID']}|{$rows1['Question_ID']}|{$rows2['Question_ID']}'>{$rows['Question_Title']}</option>";
					}
				}
				mysql_free_result($result2);
			}
			mysql_free_result($result1);
		}
		mysql_free_result($result);
		mysql_close();
		
	}
	
?>




</body>
</html>

















