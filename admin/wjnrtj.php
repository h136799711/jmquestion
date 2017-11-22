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

	function dodel(value1,value2) {
		//confirm弹出一个对话框，让你确定或者取消
		//这个对话框会返回一个值：这个值是：true和false
		//当点击确定的时候返回true，当点击取消的时候返回false
		var x = confirm('你真的删除吗？');
		if (x) {
			window.location.href="wjnrtj_del.php?id="+value1+"&sent=del&bid="+value2;
		}
		else {
			return false;  //不执行,阻止了。。。
		}
	}
	
	function typeChange(value){
		var xzt = document.getElementById("xzt");
		var wjnrtj_search = document.getElementById("wjnrtj_search");
		if(value=="单选题" || value=="多选题"){
			xzt.style.display="block";
			wjnrtj_search.style.height="360px";
		}else if(value=="简答题"){
			xzt.style.display="none";
			wjnrtj_search.style.height="240px";
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
<div id="wjnrtj">
	<?php
		$id = $_GET['id'];
		if($id==""){
			 exit("<script>alert('非法操作！');window.close();</script>");
		}
	?>
	<div id="wjnrtj_search">
		<form name="wjnrtj_form" method="post" action="wjnrtj_do.php?sent=add">
			<input type="hidden" name="id" value="<?php echo $id;?>" />
			<br/>
			题目类型：
			<select name="type" onchange="typeChange(this.value)">
				<option value="单选题">单选题</option>
				<option value="多选题">多选题</option>
				<option value="简答题">简答题</option>
			</select><br/><br/>
			问题：<textarea name="title" rows="5" cols="88"></textarea><br/><br/>
			<div id="xzt">
			　　A:<input type="text" name="a" class="text"/> B:<input type="text" name="b" class="text"/><br/><br/>
			　　C:<input type="text" name="c" class="text"/> D:<input type="text" name="d" class="text"/><br/><br/>
			　　E:<input type="text" name="e" class="text"/> F:<input type="text" name="f" class="text"/><br/><br/>
			</div>
			　　　<input type="submit" name="sent" value="添加问题" />
		</form>
	</div>
	
	<div id="wjnrtj_content">
		<h1>问卷内容添加</h1>
		<table cellspacing="0" cellpadding="0" align="center">
			<tr>
				<th>序号</th>
				<th>问题</th>
				<th>题目类型</th>
				<th>添加日期</th>
				<th>管理</th>
			</tr>
			<?php
				require 'includes/mysql_connect.php';
				require 'includes/fun.php';
				global $_pagesize,$_pagenum;
				_page("select * from question where Basic_ID = $id",18);
				$query = "select * from question where Basic_ID = $id order by Question_DateTime desc limit $_pagenum,$_pagesize";
				$result = mysql_query($query);
				$i = 1;
				while($rows = mysql_fetch_array($result)){
			?>
			<tr <?php if($i%2==1)echo'class=odd'?>>
				<td><?php echo $i;?></td>
				<td>
				<?php 
					if (mb_strlen($rows['Question_Title'],utf8) > 25){
						echo mb_substr($rows['Question_Title'],0,25,utf8)."...";
					}else{
						echo $rows['Question_Title'];
					}
				?>
				</td>
				<td><?php echo $rows['Question_Type'];?></td>
				<td><?php echo date('Y-m-d',strtotime($rows['Question_DateTime']));?></td>
				<td>
					<a href="wjnrtj_alter.php?id=<?php echo $rows['Question_ID']?>&bid=<?php echo $id?>"><img src="images/alter.png" border="0" /> 修改</a> 
					<a href="javascript:void(0);" onclick="dodel(<?php echo $rows['Question_ID']?>,<?php echo $id;?>)"><img src="images/del.png" border="0" /> 删除 </a>
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
				<a href="?page=0&id=<?php echo $id?>">首页</a> 
				<a href="?page=<?php echo $_page - 1?>&id=<?php echo $id?>">上一页</a> 
				<?php 
					}
					if ($_page == $_pageabsolute) {
				?>
				下一页 尾页
				<?php 
					}else{
				?>
				<a href="?page=<?php echo $_page + 1?>&id=<?php echo $id?>">下一页</a> 
				<a href="?page=<?php echo $_pageabsolute?>&id=<?php echo $id?>">尾页</a> 
				<?php 
					}
				?>
				转到第 
				<input type="text" name="page" style="width:25px;text-align:center;" /> 
				页 
					<input type="hidden" name="id" value="<?php echo $id?>"/>
					<input type="submit" value="GO" name="sent" />
			</form>
		</div>
		
		
	</div>


</div>
</body>
</html>

















