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
<div id="qfyjtx">
	<form name="mail_form" action="mail/mail.php" method="post">
	<h1>群发邮件提醒</h1>
	<p>
			请选择发送对象：<select onchange="javascript:location.href='?object='+this.value">
	<?php
		require 'includes/mysql_connect.php';
		
		$query1 = "select * from object order by Object_DateTime desc";
		$result1 = mysql_query($query1);
		$flag = 1;
		while($rows1 = mysql_fetch_array($result1)){
			if($flag == 1){
				$objectName = $rows1['Object_Name'];
			}
	?>
			<option value="<?php echo $rows1['Object_Name']?>" <?php if(isset($_GET['object']) && $_GET['object']==$rows1['Object_Name']) echo "selected='selected'" ?>><?php echo $rows1['Object_Name']?></option>
	<?php
			$flag++;
		}
	?>
			<option value="全部" <?php if(isset($_GET['object']) && $_GET['object']=="全部") echo "selected='selected'" ?>>全部</option>
		</select>
	</p>
	<?php
		if(isset($_GET['object']) && $_GET['object']!=''){
			$objectName = $_GET['object'];
		}
		if($objectName=="全部"){
			$query = "select * from student where Student_Major = '{$_SESSION['major']}'";
		}else{
			$query = "select * from student where Student_Major = '{$_SESSION['major']}' and Student_Object = '$objectName'";
		}
		$result = mysql_query($query);
		$str = "";
		$addresss = array();
		while($rows = mysql_fetch_array($result)){
			if(trim($rows['Student_Email'])!=""){
				$str .= $rows['Student_Email'].';';
				array_push($addresss,trim($rows['Student_Email']));
			}
		}
		mysql_free_result($result);
		mysql_close();
	?>
	<p>邮件地址：<textarea cols="100" rows="5" readonly="readonly" name="address"><?php echo $str;?></textarea></p>
	<p>主题：<input type="text" name="title" style="width:750px;" /></p>
	<p>
		<?php
			//包含fckeditor类
			include("fckeditor/fckeditor.php") ;
			//创建一个FCKeditor，表单名称为 jzleditor
			$oFCKeditor = new FCKeditor("content");
			//设置编辑器路径
			$oFCKeditor->BasePath = "fckeditor/";
			$oFCKeditor->ToolbarSet = "Default";//工具按钮
			$oFCKeditor->Value = ""; //;设置初始内容
			$oFCKeditor->Width="100%"; //设置它的宽度
			$oFCKeditor->Height="300px"; //设置它的高度
			$oFCKeditor->Create();
		?>
	</p>
	<p>
		<input type="submit" name="sent" value="发送" />
	</p>
	</form>
</div>
</body>
</html>

















