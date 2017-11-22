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
?>

	<div id="zhgl_add">
		<h1>账户管理</h1>
		<form name="zhgl_add" method="post" action="bjgl_add_do.php?sent=add">
			<ul>
				<li>
					所属专业：
					<select name="major">		
					<?php
						$query = "select * from major";
						$result = mysql_query($query);
						while($rows = mysql_fetch_array($result)){
					?>
						<option value="<?php echo $rows['Major_ID']?>"><?php echo $rows['Major_Name']?></option>
					<?php
						}
						mysql_free_result($result);
					?>
					</select>
				</li>
				<li>班级名称： <input type="text" name="classname" class="text" /></li>
				<li><input type="submit" name="sent" class="submit" value="添加" /></li>
			</ul>
		</form>
	</div>



</body>
</html>

















