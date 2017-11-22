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

	<div id="zhgl_list">
		<h1>公告管理</h1>
		<form name="gggl_form" method="post" action="gggl_alter_do.php">
		<?php
			$query = "select * from new limit 1";
			$result = mysql_query($query);
			if($rows = mysql_fetch_array($result)){
				$content = $rows['New_Content'];
			}
			mysql_free_result($result);
			mysql_close();
		?>
			<ul>
				<li>
					<?php
						    //包含fckeditor类
						    include("fckeditor/fckeditor.php") ;
						    //创建一个FCKeditor，表单名称为 jzleditor
						    $oFCKeditor = new FCKeditor("content");
						    //设置编辑器路径
						    $oFCKeditor->BasePath = "fckeditor/";
						    $oFCKeditor->ToolbarSet = "Default";//工具按钮
						    $oFCKeditor->Value = $content; //;设置初始内容
						    $oFCKeditor->Width="100%"; //设置它的宽度
						    $oFCKeditor->Height="300px"; //设置它的高度
						    $oFCKeditor->Create();
						  ?>
				</li>
				<li></li>
				<li><input type="submit" name="sent" value="发布" class="submit" /></li>
			</ul>
		</form>
		

	</div>



</body>
</html>

















