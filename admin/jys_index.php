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
	function show(obj){
		var dl = document.getElementById("admin_left").getElementsByTagName("dl");
		for(var i=0;i<dl.length;i++){
			dl[i].className="dl2";
		}
		obj.className="dl1";
	}
</script>
</head>
<body>
<?php
	if(!isset($_SESSION['level']) || !isset($_SESSION['username']) || $_SESSION['level']=="student"){
		exit ("<script>alert('非法操作！');window.close();</script>");
	}
?>
<div id="big">

	<div id="admin_top"><a href="password_alter.php" target="in">修改密码</a> | <a href="logout.php">安全退出</a></div>
	<div id="admin_left">
		<?php
			if($_SESSION['level']=="教研室"){
		?>
		<dl class="dl1" onclick="show(this);">
			<dt>问卷发布</dt>
			<dd><a href="wjzhgl.php" target="in">问卷综合管理</a></dd>
			<dd><a href="wjjbsz.php" target="in">问卷基本设置</a></dd>
			<dd><a href="wjnrlist.php" target="in">问卷内容添加</a></dd>
		</dl>
		<dl class="dl2" onclick="show(this);">
			<dt>统计分析</dt>
			<dd><a href="dcqkjbfx.php" target="in">调查情况基本分析</a></dd>
			<dd><a href="gjzbfx.php" target="in">毕业生关键指标分析</a></dd>
		</dl>

		<dl class="dl2" onclick="show(this);">
			<dt>报表下载</dt>
			<dd><a href="#">报表下载</a></dd>
		</dl>

		<dl class="dl2" onclick="show(this);">
			<dt>调查提醒</dt>
			<dd><a href="#">群发短信提醒</a></dd>
			<dd><a href="qfyjtx.php" target="in">群发邮件提醒</a></dd>
		</dl>
		<?php
			}else if($_SESSION['level']=="管理员"){
		?>
		<dl class="dl1" onclick="show(this);">
			<dt>管理员</dt>
			<dd><a href="zhgl.php" target="in">账户管理</a></dd>
			<dd><a href="xsgl.php" target="in">学生管理</a></dd>
			<dd><a href="bjgl.php" target="in">班级管理</a></dd>
			<dd><a href="zygl.php" target="in">专业管理</a></dd>
			<dd><a href="jsgl.php" target="in">届数管理</a></dd>
			<dd><a href="gggl.php" target="in">公告管理</a></dd>
		</dl>
		<?php
			}else if($_SESSION['level']=="系部"){
		?>
		<dl class="dl1" onclick="show(this);">
			<dt>统计分析</dt>
			<dd><a href="dcqkjbfxxb.php" target="in">调查情况基本分析</a></dd>
			<dd><a href="gjzbfxxb.php" target="in">毕业生关键指标分析</a></dd>
		</dl>

		<dl class="dl2" onclick="show(this);">
			<dt>报表下载</dt>
			<dd><a href="#">报表下载</a></dd>
		</dl>
		<?php
			}
		?>
	</div>
	
	<div id="admin_right">
		<?php
			if($_SESSION['level']=="教研室"){
				$url = "wjzhgl.php";
			}else if($_SESSION['level']=="系部"){
				$url = "xb.php";
			}else if($_SESSION['level']=="管理员"){
				$url = "zhgl.php";
			}
		?>
		<iframe name="in" src="<?php echo $url;?>" width="920px" height="800px" style="border:0px solid #ccc;"></iframe>
	</div>

</div>
</body>
</html>