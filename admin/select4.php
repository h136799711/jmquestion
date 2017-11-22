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
	
	$qid = explode("|",$_GET['qid']);
	if($qid==""){
		exit ("<script>alert('非法操作！');window.close();</script>");
	}else{
		$query = "select * from question where Question_ID = {$qid[0]} and Question_Major = '{$_SESSION['major']}'";
		$result = mysql_query($query);
		$result1 = mysql_query($query);
		if($rows1 = mysql_fetch_array($result1)){
			$type = $rows1['Question_Type'];
			$title = $rows1['Question_Title'];
		}
		mysql_free_result($result1);
		echo "<h2 style='height:40px;line-height:40px;font-size:14px;color:blue;'>(".$type.")".$title."</h2>";
		echo "<table id='gjtable' width='820' cellspacing='1' cellpadding='0' style='background:#ccc'>";
		$sums = 0;
		if($rows = mysql_fetch_array($result)){
			$array1 = array('Question_A','Question_B','Question_C','Question_D','Question_E','Question_F');
			echo "<tr align='center'>";
			echo "<td style='background:white;height:30px;line-height:30px;'>毕业届数</td>";
			for($i=0;$i<count($array1);$i++){
				if($rows[$array1[$i]]!=''){
					echo "<td style='background:white;height:30px;line-height:30px;'>{$rows[$array1[$i]]}</td>";
					$sums++;
				}
			}
			echo "</tr>";
			
			for($j=0;$j<count($qid);$j++){
				echo "<tr align='center'>";
				$query2 = "select * from question where Question_ID = {$qid[$j]}";
				$result2 = mysql_query($query2);
				
				if($rows2 = mysql_fetch_array($result2)){
					$query3 = "select * from basicinfo where Basic_ID = {$rows2['Basic_ID']}";
					$result3 = mysql_query($query3);
					if($rows3 = mysql_fetch_array($result3)){
						$object1 = $rows3['Basic_Object'];
					}
					mysql_free_result($result3);
				}
				mysql_free_result($result2);
				
				echo "<td style='background:white;height:30px;line-height:30px;'>".$object1."</td>";
				$array2 = array('A','B','C','D','E','F');
				for($i=0;$i<$sums;$i++){
					$query2 = "select * from answer where Question_ID = {$qid[$j]} and Answer_Content = '{$array2[$i]}'";
					$num2 = mysql_num_rows(mysql_query($query2));
					echo "<td style='background:white;height:30px;line-height:30px;'>".$num2."</td>";
				}
				
				echo "</tr>";
			}
			
		}
		echo "</table>";

		mysql_close();
		
	}
	
?>




</body>
</html>

















