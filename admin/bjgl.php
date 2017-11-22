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
	function dodel(value) {
		//confirm弹出一个对话框，让你确定或者取消
		//这个对话框会返回一个值：这个值是：true和false
		//当点击确定的时候返回true，当点击取消的时候返回false
		var x = confirm('你真的删除吗？');
		if (x) {
			window.location.href='bjgl_del.php?id='+value;
		}
		else {
			return false;  //不执行,阻止了。。。
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
	require 'includes/fun.php';
?>

	<div id="zhgl_list">
		<h1>班级管理</h1>
		<form name="search_form" method="post" action="?sent=search" id="sf" style="padding-left:30px;">
			班级名：<input type="text" name="classname" class="text" />
			专业：<select name="major">
							<option value="all">全部</option>
							<?php
								$query = "select * from major";
								$result = mysql_query($query);
								while($rows = mysql_fetch_array($result)){
							?>
							<option value="<?php echo $rows['Major_ID']?>"><?php echo $rows['Major_Name']?></option>
							<?php
								}
							?>
						</select>
			<input type="submit" name="sent" value="查询"  />
			<input type="button" value="添加" onclick="location.href='bjgl_add.php';"  />
		</form>
		<table cellpadding="0" cellspacing="1">
			<tr>
				<th>序号</th>
				<th>班级名称</th>
				<th>所属专业</th>
				<th>操作</th>
			</tr>
			<?php
				global $_pagesize,$_pagenum;
				if(isset($_GET['sent'])&&$_GET['sent']=='search'){
					if(isset($_POST['classname'])){
						$classname = $_POST['classname'];
					}else{
						$classname = $_GET['classname'];
					}
					if(isset($_POST['major'])){
						$mid = $_POST['major'];
					}else{
						$mid = $_GET['major'];
					}
					if($mid=="all"){
						_page("select * from class where Class_Name like '%$classname%'",15);
						$query = "select * from class where Class_Name like '%$classname%' limit $_pagenum,$_pagesize";
					}else{
						_page("select * from class where Class_Name like '%$classname%' and Major_ID = $mid",15);
						$query = "select * from class where Class_Name like '%$classname%' and Major_ID = $mid limit $_pagenum,$_pagesize";
					}
				}else{
					_page("select * from class",15);
					$query = "select * from class limit $_pagenum,$_pagesize";
				}
				//echo "<tr><td>".$query."</td></tr>";
				$result = mysql_query($query);
				$i = 0;
				while($rows = mysql_fetch_array($result)){
					$i++;
					$query1 = "select * from major where Major_ID = {$rows['Major_ID']}";
					$result1 = mysql_query($query1);
					if($rows1 = mysql_fetch_array($result1)){
						$major = $rows1['Major_Name'];
					}
					mysql_free_result($result1);
			?>
			<tr <?php if($i%2==1)echo "class='odd'"?>>
				<td><?php echo $i;?></td>
				<td><?php echo $rows['Class_Name']?></td>
				<td><?php echo $major?></td>
				<td><a href="bjgl_alter.php?id=<?php echo $rows['Class_ID']?>">修改</a> | <a href="javascript:void(0);" onclick="dodel(<?php echo $rows['Class_ID']?>)">删除</a></td>
			</tr>
			<?php
				}
				mysql_free_result($result);
				mysql_close();
			?>
		</table>
		<div id="admin_page">
			共有 <?php echo $_num?> 条记录，当前第 <?php echo $_page; ?>/<?php echo $_pageabsolute?>页
			<form name="page_form" action="?sent=search" method="post">
				<?php 
					if($_page == 1){
				?>
				首页 上一页
				<?php
					}else{
				?>
				<a href="?page=0&classname=<?php echo $classname;?>&major=<?php echo $mid;?>&sent=search">首页</a> 
				<a href="?page=<?php echo $_page - 1?>&classname=<?php echo $classname;?>&major=<?php echo $mid;?>&sent=search">上一页</a> 
				<?php 
					}
					if ($_page == $_pageabsolute) {
				?>
				下一页 尾页
				<?php 
					}else{
				?>
				<a href="?page=<?php echo $_page + 1?>&classname=<?php echo $classname;?>&major=<?php echo $mid;?>&sent=search">下一页</a> 
				<a href="?page=<?php echo $_pageabsolute?>&classname=<?php echo $classname;?>&major=<?php echo $mid;?>&sent=search">尾页</a> 
				<?php 
					}
				?>
				转到第 
				<input type="text" name="page" style="width:25px;text-align:center;" /> 
				页 
					<input type="hidden" name="classname" value="<?php echo $classname?>" />
					<input type="hidden" name="major" value="<?php echo $mid?>" />
					<input type="submit" value="GO" name="sent" />
			</form>
		</div>
	</div>



</body>
</html>

















