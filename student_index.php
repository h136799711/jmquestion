<?php
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>大学生跟踪调查</title>
<link href="style/question.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/student_index.js"></script>
</head>
<body>
<?php
	if(!isset($_SESSION['username']) || !isset($_SESSION['level'])){
		exit ("<script>alert('请先登录！');location.href='index.php ';</script>");
	}
?>

<div id="big">
	
	<?php require 'header.php'; ?>
	
	<div id="student_content">
		<div id="content_left">
			<div id="left_1">
				<h1>信息提示</h1>
				<br/>
				<p>你好！<font style="font-weight:bold;color:red;font-size:16px;"><?php echo $_SESSION['username']?></font></p>
				<?php
					require 'includes/mysql_connect.php';
					$query = "select * from student where Student_ID = '{$_SESSION['sid']}'";
					$result = mysql_query($query);
					if($rows = mysql_fetch_array($result)){
						$object = $rows['Student_Object'];
					}
					mysql_free_result($result);
					
					$query = "select * from basicinfo where Basic_Major = '{$_SESSION['major']}' and Basic_Object = '$object' and Basic_Power = 1";
					$result = mysql_query($query);
					$flag = false;
					if($rows = mysql_fetch_array($result)){
						$bid = $rows['Basic_ID'];
						$query1 = "select * from submit where Student_ID = '{$_SESSION['sid']}' and Basic_ID = $bid";
						$count = mysql_num_rows(mysql_query($query1));
						if($count>0){
				?>
							<p>你 <font style="color:#00b0df;">没有</font> 调查表需要填写！</p>
				<?php
						}else{
							$flag = true;
				?>
							<p>你有 <font style="color:#00b0df;">1份</font> 调查表需要填写！</p>
				<?php
						}
					}else{
				?>
						<p>你 <font style="color:#00b0df;">没有</font> 调查表需要填写！</p>
				<?php
					}
					mysql_free_result($result);
				?>
				<p>先核对个人信息再填写问卷</p><br/>
				 <img src="images/xxhd.jpg" onclick="showTip()" />
				 <?php
					if($flag){
				 ?>
				 <a href="question.php"><font style="color:#3f84c9;font-weight:bold;display:inline-block;position:relative;top:-8px;height:30px;line-height:30px;">填写问卷</font></a>
				<?php
					}
				?>
			</div>
			<div id="left_2">
				<a href="http://www.zjiet.edu.cn" target="_blank"><img src="images/link_zjiet.jpg" /></a>
			</div>
			<div id="left_3">
				<a href="http://it.zjiet.edu.cn/" target="_blank"><img src="images/link_xxx.jpg" /></a>
			</div>
		</div>
		<div id="content_right">
			<div id="right_1">
				<h1>
					<img src="images/right_1_h1.jpg" />
					调查表填写流程介绍
				</h1>
				<p>
					开展此<font color="#0647a5">调查</font>是为了加强我系毕业生与母校之间的<font color="#0647a5">相互联系</font>，为了解<font color="#0647a5">毕业后的工作情况</font>级对我系在学生培养、教育管理和就业工作的<font color="#0647a5">建议</font>和<font color="#0647a5">看法</font>，更好地改进我系工作。本调查仅用于统计分析，不会给你个人带来任何不利影响，请如实回答。
				</p>
				<img src="images/right_1_img1.jpg" />
			</div>
			<div id="clear"></div>
			<div id="right_2">
				<h1>
					<strong id="s1" class="s1" onmouseover="hover('s1')">已参与调查的名单</strong>
					<strong id="s2" onmouseover="hover('s2')">我参与的调查</strong>
				</h1>
				<div id="strong_1">
					<ul>
						<?php
							$query = "select * from submit order by Submit_DateTime desc limit 4";
							$result = mysql_query($query);
							$have = false;
							while($rows = mysql_fetch_array($result)){
								$have = true;
								$query1 = "select * from student where Student_ID = '{$rows['Student_ID']}'";
								$result1 = mysql_query($query1);
								if($rows1 = mysql_fetch_array($result1)){
									$sname = $rows1['Student_Name'];
								}
								mysql_free_result($result1);
								$query1 = "select * from basicinfo where Basic_ID = {$rows['Basic_ID']}";
								$result1 = mysql_query($query1);
								if($rows1 = mysql_fetch_array($result1)){
									$basicname = $rows1['Basic_Title'];
								}
								mysql_free_result($result1);
						?>
						<li><?php echo $sname?>在 <?php echo date("Y-m-d",strtotime($rows['Submit_DateTime']))?> 填写了 <?php echo $basicname?></li>
						<?php
							}
							if($have==false){
						?>
						<li>暂无信息</li>
						<?php
							}
							mysql_free_result($result);
							
						?>
						
					</ul>
				</div>
				<div id="strong_2" style="display:none;">
					<ul>
						<?php
							$query = "select * from submit where Student_ID = '{$_SESSION['sid']}' order by Submit_DateTime desc limit 4 ";
							$result = mysql_query($query);
							$have = false;
							while($rows = mysql_fetch_array($result)){
								$have = true;
								$query1 = "select * from basicinfo where Basic_ID = {$rows['Basic_ID']}";
								$result1 = mysql_query($query1);
								if($rows1 = mysql_fetch_array($result1)){
									$basicname = $rows1['Basic_Title'];
								}
								mysql_free_result($result1);
						?>
						<li>您在 <?php echo date("Y-m-d",strtotime($rows['Submit_DateTime']))?> 填写了 <?php echo $basicname?></li>
						<?php
							}
							if($have==false){
						?>
						<li>暂无信息</li>
						<?php
							}
							mysql_free_result($result);
							
						?>
					</ul>
				</div>
			</div>
			
			<div id="right_3">
				<h1>
					<img src="images/right_1_h1.jpg" />
					联系管理员
				</h1>
				<img src="images/right_3.jpg" />
				<ul>
					<li>0576-8610942</li>
					<li>9:00-17:00 周一至周五</li>
					<li>zjjm@xd.com</li>
				</ul>
			</div>
		</div>
	</div>
	
	
	
	<?php require 'footer.php'; ?>

</div>
<div id="tooltip">
</div>
<div id="hdxx">
	<h1>核对信息</h1>
	<?php
		$query = "select * from student where Student_ID = '{$_SESSION['sid']}'";
		$result = mysql_query($query);
		if($rows = mysql_fetch_array($result)){
	?>
	<form name="xxhd_form" method="post" id="xxhd_form">
		<ul>
			<li>手机号码：<input class="text" type="text" id="phone" name="phone" value="<?php echo $rows['Student_Phone']?>" /></li>
			<li>E-Mail：<input class="text" type="text" id="email" name="email" value="<?php echo $rows['Student_Email']?>" /></li>
			<li>工作单位：<input class="text" type="text" id="work" name="work" value="<?php echo $rows['Student_Work']?>" /></li>
			<li style="text-align:center"><img src="images/hdxx.jpg" onclick="xxhd();hiddenTip()" /></li>
		</ul>
	</form>
	<?php
		}
		mysql_close();
	?>
</div>
</body>
</html>