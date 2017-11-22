<?php
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>大学生跟踪调查</title>
<link href="style/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="style/jquery.ui.all.css"/>
<link rel="stylesheet" href="style/jquery.ui.base.css"/>
<link rel="stylesheet" href="style/jquery.ui.core.css"/>
<link rel="stylesheet" href="style/jquery.ui.datepicker.css"/>
<link rel="stylesheet" href="style/jquery.ui.theme.css"/>
<script src="js/jquery-1.6.2.js"></script>
<script src="js/jquery.ui.core.js"></script>
<script src="js/jquery.ui.widget.js"></script>
<script src="js/jquery.ui.datepicker.js"></script>
<script type="text/javascript">
	$(function() {
		$( "#start" ).datepicker({
			 changeMonth: true,   
		changeYear: true,   
		monthNamesShort:['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],   
	   dateFormat: 'yy-mm-dd',    
		buttonImageOnly: true,    
	   yearRange: '1900:2222',   
		clearText:'清除',   
		closeText:'关闭',   
	   prevText:'前一月',   
	   nextText:'后一月',   
		currentText:'今天',   
		monthNames:['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'] 
		});
	});

	$(function() {
		$( "#end" ).datepicker({
			 changeMonth: true,   
		changeYear: true,   
		monthNamesShort:['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],   
	   dateFormat: 'yy-mm-dd',    
		buttonImageOnly: true,    
	   yearRange: '1900:2222',   
		clearText:'清除',   
		closeText:'关闭',   
	   prevText:'前一月',   
	   nextText:'后一月',   
		currentText:'今天',   
		monthNames:['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'] 
		});
	});
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
		if(isset($_GET['flag'])){
				$flag = $_GET['flag'];
			}else{
				$flag = "";
		}
		require 'includes/mysql_connect.php';
		$id = $_GET['id'];
		$query = "select * from basicinfo where Basic_ID = $id";
		$result = mysql_query($query);
		if($rows = mysql_fetch_array($result)){
	?>
	<div id="wjnrtj_content">
		<h1>问卷基本设置</h1>
		<form name="wjjbsz_form" id="wjjbsz_form" method="post" action="wjtj_update.php?sent=update">
			<input type="hidden" name="flag" value="<?php echo $flag?>" />
			<input type="hidden" name="id" value="<?php echo $rows['Basic_ID']?>" />
			<ul>
				<li>问卷名称：<input type="text" name="title" class="text" style="width:500px" value="<?php echo $rows['Basic_Title']?>" /></li>
				<li>问卷说明：<textarea name="abstract" rows="8" cols="70"><?php echo $rows['Basic_Abstract']?></textarea></li>
				<li>调查对象：
					<select name="object">
						<?php
							require 'includes/mysql_connect.php';
							$query1 = "select * from object order by Object_DateTime desc";
							$result1 = mysql_query($query1);
							while($rows1 = mysql_fetch_array($result1)){
						?>
						<option value="<?php echo $rows1['Object_Name']?>" <?php if($rows['Basic_Object']==$rows1['Object_Name']) echo "selected='selected'" ?>><?php echo $rows1['Object_Name']?></option>
						<?php
							}
						?>					
					</select>
				</li>
				<li>调查人数设置：
				<select name="number">
					<option value="全部调查" <?php if($rows['Basic_Number']=="全部调查") echo "selected='selected'";?>>全部调查</option>
					<option value="随机抽取" <?php if($rows['Basic_Number']=="随机抽取") echo "selected='selected'";?>>随机抽取</option>
				</select>
				</li>
				<li>问卷时间：
				开始时间：<input type="text" id="start" name="startTime" readonly="readonly" value="<?php echo  date('Y-m-d',strtotime($rows['Basic_StartTime']))?>"/> 
				结束时间：<input type="text" id="end" name="endTime" readonly="readonly" value="<?php echo date('Y-m-d',strtotime($rows['Basic_EndTime']))?>" />
				</li>
				<li>是否开始：<input type="radio" name="power" value="0" <?php if($rows['Basic_Power']==0) echo "checked='checked'";?> /> 否 <input type="radio" name="power" value="1" <?php if($rows['Basic_Power']==1) echo "checked='checked'";?> />是</li>
				<li><img src="images/default.jpg" onclick="document.getElementById('wjjbsz_form').submit()" /></li>
			</ul>
		</form>
	</div>
	<?php
		}
		mysql_close();
	?>

</div>
</body>
</html>

















