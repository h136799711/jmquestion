<?php
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>大学生跟踪调查</title>
<link href="style/question.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/question_do.js"></script>
</head>	
<body>

<?php
	if(!isset($_SESSION['username']) || !isset($_SESSION['level'])){
		exit ("<script>alert('请先登录！');location.href='index.php ';</script>");
	}
	require 'includes/mysql_connect.php';
	require 'includes/fun.php';
	$xh = $_POST['xh'];
	if($xh==""){
		exit ("<script>alert('非法操作');window.close();</script>");
	}
	$bid = $_POST['bid'];
	$query = "select * from submit where Student_ID = '{$_SESSION['sid']}' and Basic_ID = $bid";
	$count = mysql_num_rows(mysql_query($query));
	if($count>0){
		exit ("<script>alert('你已经提交过！');window.close();</script>");
	}
	$questionID = $_POST['questionID'];
	$xh = $_POST['xh'];
	$array1 = explode(",",$questionID);
	
	for($i=0;$i<count($array1);$i++){
		$array2 = explode("|",$array1[$i]);
		$question = _mysql_string($_POST[$array1[$i]]);
		if($array2[0]=="dx" || $array2[0]=="jd"){
			$query = "insert into answer (Student_ID,Question_ID,Answer_Content,Basic_ID) values ('{$_SESSION['sid']}',$array2[1],'$question',$bid)";
			mysql_query($query);
		}else if($array2[0]=="dxt"){
			for($j=0;$j<count($question);$j++){
				$query = "insert into answer (Student_ID,Question_ID,Answer_Content,Basic_ID) values ('{$_SESSION['sid']}',$array2[1],'$question[$j]',$bid)";
				mysql_query($query);
			}
		}
	}
	$query = "select * from basicinfo where Basic_ID = $bid";
	$result = mysql_query($query);
	if($rows = mysql_fetch_array($result)){
		$object = $rows['Basic_Object'];
	}
	mysql_free_result($result);
	$query = "insert into submit (Basic_ID,Student_ID,Student_Object,Submit_DateTime,Submit_Major) values ($bid,'{$_SESSION['sid']}','$object',NOW(),'{$_SESSION['major']}')";
	mysql_query($query);
	mysql_close();
?>

<div id="tooltip" style="display:block;">
</div>
<div id="tip" style="display:block;">
	<h1>非常感谢您对本次调查的认真答复</h1>
	<p>
		衷心祝愿我们的毕业生：在新的人生征程中，勇往前行，奋发进取，自强不息。<br/><br/>
		<a href="logout.php"><img src="images/default.jpg" onclick="closeWindow()" /></a>
	</p>
</div>


</body>
</html>