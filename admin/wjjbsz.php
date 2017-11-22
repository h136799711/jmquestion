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
			window.location.href="wjtj_del.php?id="+value+"&sent=del";
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
		if($_SESSION['level']!="教研室"){
			exit ("<script>alert('你没有权限使用！');window.close();</script>");
		}
	}
?>
<div id="wjjbsz">

	<div id="wjjbsz_search">
		<a href="wjtj.php"><image src="images/tjxddcwj.jpg" border="0" /></a>
	</div>
	
	<div id="wjjbsz_content">
		<h1>问卷基本设置</h1>
		<table cellspacing="0" cellpadding="0" align="center">
			<tr>
				<th>序号</th>
				<th>标题</th>
				<th>调查对象</th>
				<!--<th>到期天数</th>-->
				<th>管理</th>
			</tr>
			<?php
				require 'includes/mysql_connect.php';
				require 'includes/fun.php';
				global $_pagesize,$_pagenum;
				_page("select * from basicinfo where Basic_Major = '{$_SESSION['major']}'",16);
				$query = "select * from basicinfo where Basic_Major = '{$_SESSION['major']}' order by Basic_DateTime desc limit $_pagenum,$_pagesize";
				$result = mysql_query($query);
				$i = 1;
				while($rows = mysql_fetch_array($result)){	
			?>
			<tr <?php if($i%2==1)echo'class=odd'?>>
				<td><?php echo $i;?></td>
				<td>
				<?php 
					if (mb_strlen($rows['Basic_Title'],utf8) > 25){
						echo mb_substr($rows['Basic_Title'],0,25,utf8)."...";
					}else{
						echo $rows['Basic_Title'];
					}
				?>
				</td>
				<td><?php echo $rows['Basic_Object'];?></td>
				<!--<td>
				<?php
					/*$days = (strtotime($rows['Basic_EndTime']) - strtotime(date("Y-m-d")))/86400;
					if($days>0){
						echo $days.'天';
					}else{
						echo "<font color='red'>已经到期</font>";
					}*/
				?>
				</td>-->
				<td>
					<a href="wjtj_alter.php?id=<?php echo $rows['Basic_ID']?>"><img src="images/alter.png" border="0" /> 修改</a> 
					<a href="javascript:void(0);" onclick="dodel(<?php echo $rows['Basic_ID']?>)"><img src="images/del.png" border="0" /> 删除 </a>
				</td>
			</tr>
			<?php
					$i++;
				}
				mysql_free_result($result);
				mysql_close();
			?>
		</table>
		
		<div id="admin_page">
			共有 <?php echo $_num?> 条记录，当前第 <?php echo $_page; ?>/<?php echo $_pageabsolute?>页
			<form name="page_form" action="" method="post">
				<?php 
					if($_page == 1){
				?>
				首页 上一页
				<?php
					}else{
				?>
				<a href="?page=0">首页</a> 
				<a href="?page=<?php echo $_page - 1?>">上一页</a> 
				<?php 
					}
					if ($_page == $_pageabsolute) {
				?>
				下一页 尾页
				<?php 
					}else{
				?>
				<a href="?page=<?php echo $_page + 1?>">下一页</a> 
				<a href="?page=<?php echo $_pageabsolute?>">尾页</a> 
				<?php 
					}
				?>
				转到第 
				<input type="text" name="page" style="width:25px;text-align:center;" /> 
				页 
				
					<input type="submit" value="GO" name="sent" />
			</form>
		</div>
		
	</div>


</div>
</body>
</html>

















