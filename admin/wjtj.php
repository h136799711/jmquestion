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
	session_start();
?>
<div id="wjnrtj">
	
	<div id="wjnrtj_content">
		<h1>问卷基本设置</h1>
		<form name="wjjbsz_form" id="wjjbsz_form" method="post" action="wjtj_do.php?sent=add">
			<ul>
				<li>问卷名称：<input type="text" name="title" class="text" style="width:500px" /></li>
				<li>问卷说明：<textarea name="abstract" rows="8" cols="70"></textarea></li>
				<li>调查对象：
					<select name="object">
						<?php
							require 'includes/mysql_connect.php';
							$query = "select * from object order by Object_DateTime desc";
							$result = mysql_query($query);
							while($rows = mysql_fetch_array($result)){
						?>
						<option value="<?php echo $rows['Object_Name']?>"><?php echo $rows['Object_Name']?></option>
						<?php
							}
						?>
					</select>
				</li>
				<li>调查人数设置：
				<select name="number">
					<option value="全部调查">全部调查</option>
					<option value="随机抽取">随机抽取</option>
				</select>
				</li>
				<!--<li>问卷时间：
				开始时间：<input type="text" id="start" name="startTime" readonly="readonly"/> 
				结束时间：<input type="text" id="end" name="endTime" readonly="readonly"/>
				</li>
				-->
				<li>是否开始：<input type="radio" name="power" checked="checked" value="0" /> 否 <input type="radio" name="power" value="1" />是</li>
				<li><img src="images/default.jpg" onclick="document.getElementById('wjjbsz_form').submit()" /></li>
			</ul>
		</form>
	</div>


</div>
</body>
</html>

















