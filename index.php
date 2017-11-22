<?php
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>大学生跟踪调查</title>
<link href="style/index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
<div id="big">
	<?php
		require 'includes/mysql_connect.php';
				require 'includes/fun.php';
		if(isset($_GET['sent'])){
			$sent = $_GET['sent'];
		}else{
			$sent = "";
		}
		if($sent=='login'){
			$yzm = $_POST['yzm'];
			if($yzm == $_SESSION['code']){
				
				$level = _mysql_string(trim($_POST['level']));
				if($level=='学生'){
					$name = _mysql_string(trim($_POST['name']));
					$card = _mysql_string(trim($_POST['card']));
					if($name==""){
						exit ("<script>alert('请填写姓名！');history.back();</script>");
					}
					if($card==""){
						exit ("<script>alert('请身份证姓名！');history.back();</script>");
					}
					$query = "select * from student where Student_Name = '$name' and Student_Card = '$card'";
					$count = mysql_num_rows(mysql_query($query));
					if($count>0){
						$result = mysql_query($query);
						if($rows=mysql_fetch_array($result)){
							$_SESSION['level'] = "student";
							$_SESSION['sid'] = $rows['Student_ID'];
							$_SESSION['username'] = $name;
							$_SESSION['major'] = $rows['Student_Major'];
						}
						exit ("<script>location.href='student_index.php';</script>");
					}else{
						exit ("<script>alert('信息填写有错误！');history.back();</script>");
					}
				}else{
					$name = _mysql_string(trim($_POST['username']));
					$card = _mysql_string(trim($_POST['password']));
					if($name==""){
						exit ("<script>alert('请填写姓名！');history.back();</script>");
					}
					if($card==""){
						exit ("<script>alert('请身份证姓名！');history.back();</script>");
					}
					$card = sha1($card);
					// var_dump($card);
					// exit;
					$query = "select * from admin where Admin_UserName = '$name' and Admin_Password = '$card' and Admin_Level = '$level'";
					$count = mysql_num_rows(mysql_query($query));
					if($count>0){
						$result = mysql_query($query);
						if($rows=mysql_fetch_array($result)){
							$_SESSION['level'] = $level;
							$_SESSION['username'] = $name;
							$_SESSION['major'] = $rows['Admin_Major'];
							exit ("<script>location.href='admin/jys_index.php';</script>");
						}
					}else{
						exit ("<script>alert('信息填写有错误！');history.back();</script>");
					}
				}
			}else{
				exit ("<script>alert('验证码错误！');history.back();</script>");
			}
		}
	?>
	<div id="login">
		<div id="login_left">
			<marquee scrolldelay="180" onMouseOut="this.start()" onMouseOver="this.stop();" behavior="scroll" direction="up">
			<?php
			$query = "select * from new limit 1";
			$result = mysql_query($query);
			if($rows = mysql_fetch_array($result)){
				echo($rows['New_Content']);
			}
			mysql_free_result($result);
			mysql_close();
			?>
			</marquee>
		</div>
		<div id="login_right">
			<h1>用户认证</h1>
			<form name="login_form" method="post" action="?sent=login" id="login_form">
				<ul id="cul">
					<!--
					<li>
						届　数：
						<select name="grade" class="select">
							<option>请选择</option>
							<option value="08届">08届</option>
							<option value="09届">09届</option>
							<option value="10届">10届</option>
							<option value="11届">11届</option>
							<option value="12届">12届</option>
							<option value="13届">13届</option>
							<option value="14届">14届</option>
						</select>
					</li>
					<li>
						专　业：
						<select name="major" class="select">
							<option>请选择</option>
							<option value="动漫设计">动漫设计</option>
							<option value="电子商务">电子商务</option>
							<option value="计算机应用">计算机应用</option>
							<option value="软件技术">软件技术</option>
							<option value="计算机网络">计算机网络</option>
						</select>
					</li>
					-->
					
					<li class="sli">
						姓　名： <input type="text" class="text" name="name" />
					</li>
					<li class="sli">
						身份证： <input type="password" class="text" name="card" />
					</li>
					<li class="ali">
						用户名： <input type="text" class="text" name="username" />
					</li>
					<li class="ali">
						密　码： <input type="password" class="text" name="password" />
					</li>
					<li>
						验证码： <input type="text" name="yzm" class="text yzm" style="width:120px;" /> <img src="code.php" id="code" onclick="this.src='code.php?tm='+Math.random();" />
					</li>
					<li>
						<input type="radio" name="level" value="学生" checked="checked" onclick="show(0)" /> 学生 <input type="radio" name="level" value="教研室" onclick="show(1)" /> 教研室 <input type="radio" name="level" value="系部" onclick="show(1)" /> 系部 <input type="radio" name="level" value="管理员" onclick="show(1)" /> 管理员
					</li>
					<li>
						<img src="images/login_dl.jpg" onclick="document.getElementById('login_form').submit();" />  
						<img src="images/login_cz.jpg" onclick="document.getElementById('login_form').reset();show(0);" />
					</li>
				</ul>
			</form>
		</div>
	</div>



</div>
</body>
</html>