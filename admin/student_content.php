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
			exit ("<script>alert('你没有权限操作！');window.close();</script>");
		}
	}
	require 'includes/mysql_connect.php';
?>

	<div id="student_content">
		<?php
			$qid = $_GET['id'];
			$query = "select * from question where Question_ID = $qid";
			$result = mysql_query($query);
			if($rows = mysql_fetch_array($result)){
				$title = $rows['Question_Title'];
			}
			mysql_free_result($result);
		?>
		<h1><?php echo $title;?></h1>
		<ul>
		<?php
			$query = "select * from answer where Question_ID = $qid";
			$result = mysql_query($query);
			while($rows = mysql_fetch_array($result)){
				$query1 = "select * from student where Student_ID = '{$rows['Student_ID']}'";
				$result1 = mysql_query($query1);
				if($rows1 = mysql_fetch_array($result1)){
					$sname = $rows1['Student_Name'];
				}
				mysql_free_result($result1);
		?>
			<li><?php echo '<font color=red>'.$sname.'</font>：'.htmlspecialchars($rows['Answer_Content'])?></li>
		<?php
			}
			mysql_free_result($result);
			mysql_close();
		?>
		</ul>
	</div>



</body>
</html>

















