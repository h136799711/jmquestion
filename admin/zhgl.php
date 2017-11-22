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
			window.location.href='zhgl_del.php?id='+value;
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
		<h1>账户管理</h1>
		<form name="search_form" method="post" action="?sent=search" id="sf" style="padding-left:30px;">
			用户名：<input type="text" name="username" class="text" />
			角色：<select name="levels">
							<option value="全部">全部</option>
							<option value="教研室">教研室</option>
							<option value="系部">系部</option>
							<option value="管理员">管理员</option>
						</select>
			<input type="submit" name="sent" value="查询"  />
			<input type="button" value="添加" onclick="location.href='zhgl_add.php';"  />
		</form>
		<table cellpadding="0" cellspacing="1">
			<tr>
				<th>序号</th>
				<th>用户名</th>
				<th>角色</th>
				<th>操作</th>
			</tr>
			<?php
				global $_pagesize,$_pagenum;
				if(isset($_GET['sent'])&&$_GET['sent']=='search'){
					if(isset($_POST['username'])){
						$username = $_POST['username'];
					}else{
						$username = $_GET['username'];
					}
					if(isset($_POST['levels'])){
						$levels = $_POST['levels'];
					}else{
						$levels = $_GET['levels'];
					}
					
					if($levels=="全部"){
						_page("select * from admin where Admin_UserName like '%$username%'",15);
						$query = "select * from admin where Admin_UserName like '%$username%' limit $_pagenum,$_pagesize";
					}else{
						_page("select * from admin where Admin_UserName like '%$username%' and Admin_Level = '$levels'",15);
						$query = "select * from admin where Admin_UserName like '%$username%' and Admin_Level = '$levels' limit $_pagenum,$_pagesize";
					}
				}else{
					_page("select * from admin",15);
					$query = "select * from admin limit $_pagenum,$_pagesize";
				}
				
				$result = mysql_query($query);
				$i = 0;
				while($rows = mysql_fetch_array($result)){
					$i++;
			?>
			<tr <?php if($i%2==1)echo "class='odd'"?>>
				<td><?php echo $i;?></td>
				<td><?php echo $rows['Admin_UserName']?></td>
				<td><?php echo $rows['Admin_Level']?></td>
				<td><a href="zhgl_alter.php?id=<?php echo $rows['Admin_ID']?>">修改</a> | <a href="javascript:void(0);" onclick="dodel(<?php echo $rows['Admin_ID']?>)">删除</a></td>
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
				<a href="?page=0&sent=search&username=<?php echo $username;?>&levels=<?php echo $levels;?>">首页</a> 
				<a href="?page=<?php echo $_page - 1?>&sent=search&username=<?php echo $username;?>&levels=<?php echo $levels;?>">上一页</a> 
				<?php 
					}
					if ($_page == $_pageabsolute) {
				?>
				下一页 尾页
				<?php 
					}else{
				?>
				<a href="?page=<?php echo $_page + 1?>&sent=search&username=<?php echo $username;?>&levels=<?php echo $levels;?>">下一页</a> 
				<a href="?page=<?php echo $_pageabsolute?>&sent=search&username=<?php echo $username;?>&levels=<?php echo $levels;?>">尾页</a> 
				<?php 
					}
				?>
				转到第 
				<input type="text" name="page" style="width:25px;text-align:center;" /> 
				页 
					<input type="hidden" name="username" value="<?php echo $username?>" />
					<input type="hidden" name="levels" value="<?php echo $levels?>" />
					<input type="submit" value="GO" name="sent" />
			</form>
		</div>
		
		
	</div>



</body>
</html>

















