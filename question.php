<?php
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>大学生跟踪调查</title>
<link href="style/question.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/question.js"></script>
</head>
<body>
<?php
	if(!isset($_SESSION['username']) || !isset($_SESSION['level'])){
		exit ("<script>alert('请先登录！');location.href='index.php ';</script>");
	}
	require 'includes/mysql_connect.php';
?>

	<?php
		require 'header.php';
	?>
	
	<div id="content">
		<div id="content_main">
			<h1>毕业生跟踪调查表</h1>
			<p>
				亲爱的毕业生同学：</br>
					您好！</br>
					<?php
						$query = "select * from student where Student_ID = '{$_SESSION['sid']}'";
						$result = mysql_query($query);
						if($rows = mysql_fetch_array($result)){
							$object = $rows['Student_Object'];
						}
						mysql_free_result($result);
						$query = "select * from basicinfo where Basic_Object = '$object' and Basic_Power = 1 and Basic_Major = '{$_SESSION['major']}'";
						$result = mysql_query($query);
						if($rows = mysql_fetch_array($result)){
							$bid = $rows['Basic_ID'];
							$abstract = $rows['Basic_Abstract'];
						}else{
							exit("<script>alert('你暂时没有要填写的调查表！');history.back();</script>");
						}
						echo $abstract;
						mysql_free_result($result);
						$query = "select * from submit where Student_ID = '$studentID' and Basic_ID = $bid";
						$count = mysql_num_rows(mysql_query($query));
						if($count>0){
							exit("<script>alert('你已经提交过！');history.back();</script>");
						}
					?>
			</p>
			
			<form name="question_form" id="question_form" method="post" action="question_do.php">
			<div id="clear"></div>
			<?php
				$query = "select * from question where Basic_ID = $bid";
				$result = mysql_query($query);
				$xh = 0;
				$questionID = "";
				while($rows = mysql_fetch_array($result)){
					$xh++;
					$array2 = array('A','B','C','D','E','F');
			?>
			<?php
				if($rows['Question_Type']=='单选题'){
					if($xh==1){
						$questionID = 'dx|'.$rows['Question_ID'];
					}else{
						$questionID = $questionID.',dx|'.$rows['Question_ID'];
					}
			?>
			<div class="question">
				<a name="question<?php echo $xh;?>"></a>
				<h2><span><?php echo $xh;?></span><?php echo $rows['Question_Title']?></h2>
				<ul>
					<?php
						$array1 = array('Question_A','Question_B','Question_C','Question_D','Question_E','Question_F');
						for($i=0;$i<count($array1);$i++){
							if($rows[$array1[$i]]!=""){
					?>
					<li><input type="radio" name="dx|<?php echo $rows['Question_ID']?>" value="<?php echo $array2[$i]?>" /> <?php echo $rows[$array1[$i]];?></li>
					<?php
							}
						}
					?>
				</ul>
			</div>
			<?php
				}else if($rows['Question_Type']=='多选题'){
					if($xh==1){
						$questionID = 'dxt|'.$rows['Question_ID'];
					}else{
						$questionID = $questionID.',dxt|'.$rows['Question_ID'];
					}
			?>
			<div class="question">
				<a name="question<?php echo $xh;?>"></a>
				<h2><span><?php echo $xh;?></span><?php echo $rows['Question_Title']?></h2>
				<ul>
					<?php
						$array1 = array('Question_A','Question_B','Question_C','Question_D','Question_E','Question_F');
						for($i=0;$i<count($array1);$i++){
							if($rows[$array1[$i]]!=""){
					?>
					<li><input type="checkbox" name="dxt|<?php echo $rows['Question_ID']?>[]" value="<?php echo $array2[$i]?>" /> <?php echo $rows[$array1[$i]];?></li>
					<?php
							}
						}
					?>
				</ul>
			</div>
			<?
				}else if($rows['Question_Type']=='简答题'){
					if($xh==1){
						$questionID = 'jd|'.$rows['Question_ID'];
					}else{
						$questionID = $questionID.',jd|'.$rows['Question_ID'];
					}
			?>
			<div class="question" style="height:190px;">
				<a name="question<?php echo $xh;?>"></a>
				<h2><span><?php echo $xh;?></span><?php echo $rows['Question_Title']?></h2>
				<ul>
					<li><textarea name="jd|<?php echo $rows['Question_ID']?>" rows="8" cols="90" onblur="textarea(this,<?php echo $xh?>)"></textarea></li>
				</ul>
			</div>
			<?php
				}
			?>
			<div id="clear"></div>
			<?php
				}
				mysql_free_result($result);
				mysql_close();
			?>
			<input type="hidden" name="questionID" value="<?php echo $questionID;?>" />
			<input type="hidden" name="xh" value="<?php echo $xh;?>" />
			<input type="hidden" name="bid" value="<?php echo $bid;?>" />
			
			
			
			
			
			
			<div id="submit"><img src="images/submit.jpg" width="200" height="40" onclick="check();" /></div>
			</form>
			<div id="clear"></div>
		</div>
	</div>
	<div id="clear" style="height:0px;"></div>
	<?php
		require 'footer.php';
	?>
	
	
	<div id="right_center">
		<table cellspacing="1" width="100%">
			<?php
				$row = ceil($xh/5.0);
				$j=0;
				for($i=0;$i<$row;$i++){
			?>
			<tr>
				<?php
					for(;$j<5*($i+1);$j++){
						if($j<$xh){
				?>
				<td><a href="#question<?php echo $j+1;?>"><?php echo $j+1;?></a></td>
				<?php
						}else{
				?>
					<td></td>
				<?php
						}
					}
				?>
			</tr>
			<?php
				}
			?>
		</table>
	</div>
	
	
	
</div>



</body>
</html>