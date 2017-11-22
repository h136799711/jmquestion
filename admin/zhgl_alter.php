<?php
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>大学生跟踪调查</title>
<link href="style/index.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	function show(value){
		var li = document.getElementById("juese");
		if(value=="教研室"){
			li.style.display="block";
		}else{
			li.style.display="none";
		}
	}
</script>
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
	$id = $_GET['id'];
	if($id==""){
		exit ("<script>alert('非法操作！');window.close();</script>");
	}
	$query = "select * from admin where Admin_ID = $id";
	$result = mysql_query($query);
	if($rows = mysql_fetch_array($result)){
		$flag = false;
?>

	<div id="zhgl_add">
		<h1>账户管理</h1>
		<form name="zhgl_add" method="post" action="zhgl_alter_do.php?sent=alter">
			<ul>
				<input type="hidden" name="id" value="<?php echo $id;?>" />
				<li>用户名：<input type="text" name="username" class="text" value="<?php echo $rows['Admin_UserName']?>" /></li>
				<li>密　码：<input type="password" name="password" class="text" />(*留空不修改)</li>
				<li>角　色： 
				<select name="levels" onchange="show(this.value)">
					<option value="教研室" <?php if($rows['Admin_Level']=="教研室") {echo "selected='selected'";$flag = true;}?>>教研室</option>
					<option value="系部" <?php if($rows['Admin_Level']=="系部") echo "selected='selected'"?>>系部</option>
					<option value="管理员" <?php if($rows['Admin_Level']=="管理员") echo "selected='selected'"?>>管理员</option>
				</select>
				</li>
				<li id="juese" <?php if($flag) echo "style='display:block;'";else echo "style='display:none;'";?>>
					专　业：
					<select name="major">		
					<?php
						$query1 = "select * from major";
						$result1 = mysql_query($query1);
						while($rows1 = mysql_fetch_array($result1)){
					?>
						<option value="<?php echo $rows1['Major_Name']?>" <?php if($rows1['Major_Name']==$rows['Admin_Major']) echo "selected='selected'"?>><?php echo $rows1['Major_Name']?></option>
					<?php
						}
						mysql_free_result($result1);
					?>
					</select>
				</li>
				<li><input type="submit" name="sent" class="submit" value="修改" /></li>
			</ul>
		</form>
	</div>
<?php
	}
?>


</body>
</html>

















