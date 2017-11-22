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
			exit ("<script>alert('你没有权限使用！');window.close();</script>");
		}
	}
?>
<div id="wjnrlist">
	
	<div id="wjnrlist_content">
		<h1>问卷内容添加</h1>
		<table cellspacing="0" cellpadding="0" align="center">
			<tr>
				<th>序号</th>
				<th>标题</th>
				<th>调查对象</th>
				<!--<th>到期天数</th>-->
				<th>状态</th>
				<th>管理</th>
			</tr>
			<?php
				require 'includes/mysql_connect.php';
				require 'includes/fun.php';
				global $_pagesize,$_pagenum;
				_page("select * from basicinfo where Basic_Major = '{$_SESSION['major']}'",17);
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
				<?php
					$query1 = "select * from question where Basic_ID = {$rows['Basic_ID']}";
					$count = mysql_num_rows(mysql_query($query1));
					if($count>0){
						echo '有( <font color="red">'.$count.'</font> )个问题';
					}else{
						echo '暂未添加问题';
					}
				?>
				</td>
				<td><img src="images/alter.png" border="0"  /> <a href="wjnrtj.php?id=<?php echo $rows['Basic_ID']?>">添加</a></td>
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

















