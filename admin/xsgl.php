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
			window.location.href='xsgl_del.php?id='+value;
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
			学号：<input type="text" name="sid" class="text" />
			姓名：<input type="text" name="sname" class="text" />
			<input type="submit" name="sent" value="查询"  />
			<input type="button" value="添加" onclick="location.href='xsgl_add.php';"  />
			<input type="button" value="导入学生信息" onclick="location.href='xsgl_dr.php';"  />
		</form>
		<table cellpadding="0" cellspacing="1">
			<tr>
				<th>序号</th>
				<th>学号</th>
				<th>姓名</th>
				<th>专业</th>
				<th>班级</th>
				<th>毕业届数</th>
				<th>操作</th>
			</tr>
			<?php
				global $_pagesize,$_pagenum;
				if(isset($_GET['sent'])&&$_GET['sent']=='search'){
					if(isset($_POST['sid'])){
						$sid = $_POST['sid'];
					}else{
						$sid = $_GET['sid'];
					}
					if(isset($_POST['sname'])){
						$sname = $_POST['sname'];
					}else{
						$sname = $_GET['sname'];
					}
					_page("select * from student where Student_Name like '%$sname%' and Student_ID like '%$sid%'",15);
					$query = "select * from student where Student_Name like '%$sname%' and Student_ID like '%$sid%' limit $_pagenum,$_pagesize";
				}else{
					_page("select * from student",15);
					$query = "select * from student limit $_pagenum,$_pagesize";
				}
				
				$result = mysql_query($query);
				$i = 0;
				while($rows = mysql_fetch_array($result)){
					$i++;
			?>
			<tr <?php if($i%2==1)echo "class='odd'"?>>
				<td><?php echo $i;?></td>
				<td><?php echo $rows['Student_ID'];?></td>
				<td><?php echo $rows['Student_Name']?></td>
				<td><?php echo $rows['Student_Major']?></td>
				<td><?php echo $rows['Student_Class']?></td>
				<td><?php echo $rows['Student_Object']?></td>
				<td><a href="xsgl_alter.php?id=<?php echo $rows['Student_SID']?>">修改</a> | <a href="javascript:void(0)" onclick="dodel(<?php echo $rows['Student_SID']?>)">删除</a></td>
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
				<a href="?page=0&sent=search&sid=<?php echo $sid;?>&sname=<?php echo $sname;?>">首页</a> 
				<a href="?page=<?php echo $_page - 1?>&sent=search&sid=<?php echo $sid;?>&sname=<?php echo $sname;?>">上一页</a> 
				<?php 
					}
					if ($_page == $_pageabsolute) {
				?>
				下一页 尾页
				<?php 
					}else{
				?>
				<a href="?page=<?php echo $_page + 1?>&sent=search&sid=<?php echo $sid;?>&sname=<?php echo $sname;?>">下一页</a> 
				<a href="?page=<?php echo $_pageabsolute?>&sent=search&sid=<?php echo $sid;?>&sname=<?php echo $sname;?>">尾页</a> 
				<?php 
					}
				?>
				转到第 
				<input type="text" name="page" style="width:25px;text-align:center;" /> 
				页 
					<input type="hidden" name="sid" value="<?php echo $sid;?>" />
					<input type="hidden" name="sname" value="<?php echo $sname;?>" />
					<input type="submit" value="GO" name="sent" />
			</form>
		</div>
	</div>



</body>
</html>

















