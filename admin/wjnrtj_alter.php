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
	
	function typeChange(value){
		var xzt = document.getElementById("xzt");
		var wjnrtj_search = document.getElementById("wjnrtj_search");
		if(value=="单选题" || value=="多选题"){
			xzt.style.display="block";
		}else if(value=="简答题"){
			xzt.style.display="none";
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
		$bid = $_GET['bid'];
		if($bid==""){
			 exit("<script>alert('非法操作！');window.close();</script>");
		}
		$id = $_GET['id'];
		if($id==""){
			 exit("<script>alert('非法操作！');window.close();</script>");
		}
		
	?>
	
	<?php
		require 'includes/mysql_connect.php';
		$query = "select * from question where Question_ID = $id";
		$result = mysql_query($query);
		if($rows = mysql_fetch_array($result)){
	?>
	<div id="wjnrtj_search" style="height:700px;">
		<form name="wjnrtj_form" method="post" action="wjnrtj_update.php?sent=update">
			<input type="hidden" name="id" value="<?php echo $id;?>" />
			<input type="hidden" name="bid" value="<?php echo $bid;?>" />
			<br/>
			题目类型：
			<select name="type" onchange="typeChange(this.value)">
				<option value="单选题" <?php  if($rows['Question_Type']=='单选题') echo 'selected=selected'?>>单选题</option>
				<option value="多选题" <?php  if($rows['Question_Type']=='多选题') echo 'selected=selected'?> >多选题</option>
				<option value="简答题" <?php  if($rows['Question_Type']=='简答题') echo 'selected=selected'?> >简答题</option>
			</select><br/><br/>
			问题：<textarea name="title" rows="5" cols="88"><?php echo $rows['Question_Title']?></textarea><br/><br/>
			<div id="xzt" <?php if($rows['Question_Type']=='简答题') echo "style='display:none;'"?> >
			　　A:<input type="text" name="a" class="text" value="<?php echo $rows['Question_A']?>" /> B:<input type="text" name="b" class="text" value="<?php echo $rows['Question_B']?>" /><br/><br/>
			　　C:<input type="text" name="c" class="text" value="<?php echo $rows['Question_C']?>" /> D:<input type="text" name="d" class="text" value="<?php echo $rows['Question_D']?>" /><br/><br/>
			　　E:<input type="text" name="e" class="text" value="<?php echo $rows['Question_E']?>" /> F:<input type="text" name="f" class="text" value="<?php echo $rows['Question_F']?>" />(*全部留空表示简答题)<br/><br/>
			</div>
			　　　<input type="submit" name="sent" value="修改" />
		</form>
	</div>
	<?php
		}
		mysql_close();
	?>

</div>
</body>
</html>

















