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
		if($_SESSION['level']!="系部"){
			exit ("<script>alert('你没有权限使用！');window.close();</script>");
		}
	}
	require 'includes/mysql_connect.php';
?>

	<div id="dcqkjbfx">
		<h1>调查情况基本分析</h1>
		<div id="dcqkjbfx_search" style="">
				　调查对象：
				<select name="major" id="majors" onchange="location.href='?major='+this.value+'&object='+document.getElementById('objects').value+'&$bid='+document.getElementById('bids').value">
					<?php
						if(isset($_GET['major'])){
							$selectMajor = $_GET['major'];
						}else{
							$selectMajor = "";
						}
						$query = "select * from major";
						$result = mysql_query($query);
						while($rows = mysql_fetch_array($result)){
							$i++;
							if($i==1){
								$major = $rows['Major_Name'];
							}
					?>
					<option value="<?php echo $rows['Major_Name']?>" <?php if($selectMajor == $rows['Major_Name']) echo "selected='selected'"?> ><?php echo $rows['Major_Name']?></option>
					<?php
						}
						mysql_free_result($result);
						if(isset($_GET['major'])){
							$major = $_GET['major'];
						}
					?>
				</select>
				
				<select name="object" id="objects" onchange="location.href='?object='+this.value+'&major='+document.getElementById('majors').value+'&$bid='+document.getElementById('bids').value">
					<?php
						if(isset($_GET['object'])){
							$selectObject = $_GET['object'];
						}else{
							$selectObject = "";
						}
						if(isset($_GET['bid'])){
							$selectBid = $_GET['bid'];
						}else{
							$selectBid = "";
						}
						$query = "select * from object order by Object_DateTime desc";
						$result = mysql_query($query);
						$i = 0;
						$object = "";
						while($rows = mysql_fetch_array($result)){
							$i++;
							if($i==1){
								$object = $rows['Object_Name'];
							}
					?>
					<option value="<?php echo $rows['Object_Name']?>" <?php if($selectObject == $rows['Object_Name']) echo "selected='selected'"?> ><?php echo $rows['Object_Name']?></option>
					<?php
						}
						mysql_free_result($result);
						if(isset($_GET['object'])){
							$object = $_GET['object'];
						}
						if(isset($_GET['major'])){
							$major = $_GET['major'];
						}
					?>
				</select>
				<select name="bid" id="bids" onchange="location.href='?bid='+this.value+'&major='+document.getElementById('majors').value+'&object='+document.getElementById('objects').value">
					<?php
						$query = "select * from basicinfo where Basic_Object = '$object' and Basic_Major = '$major'";
						$result = mysql_query($query);
						if(mysql_num_rows($result)>0){
							$i = 0;
							while($rows = mysql_fetch_array($result)){
								$i++;
								if($i==1){
									$bid = $rows['Basic_ID'];
								}
					?>
					<option value="<?php echo $rows['Basic_ID']?>" <?php if($rows['Basic_ID']==$selectBid) echo "selected='selected'"?>><?php echo $rows['Basic_Title']?></option>
					<?php
							}
							mysql_free_result($result);
							if(isset($_GET['bid'])){
								$bid = $_GET['bid'];
							}
						}else{
							$bid = -1;
					?>
					<option value="-1">无</option>
					<?php
						}
					?>
				</select>
				<br/><br/>
				<?php
					$major = trim($major);
					$object = trim($object);
					$query = "select * from student where Student_Object = '$object' and Student_Major = '$major'";
					$sum = mysql_num_rows(mysql_query($query));
					$query = "select * from submit where Student_Object = '$object' and Submit_Major = '$major'";
					$cynum = mysql_num_rows(mysql_query($query));
				?>
				<table id="jbfx" cellpadding="0" cellspacing="1" align="center" width="820">
					<tr>
						<td>调查对象</td>
						<td><?php echo $object?></td>
					</tr>
					<tr>
						<td>抽样比例</td>
						<td><?php echo $object?>总计<?php echo $sum?>人，抽样学生<?php echo $cynum;?>人，抽样比例<?php if($sum!=0)echo  sprintf("%.2f", $cynum/$sum*100); else echo 0;?>%</td>
					</tr>
					<tr>
						<td>答卷情况</td>
						<td>应答卷<?php echo $cynum;?>人，实际有效答卷<?php echo $cynum;?>份，答卷比例100%</td>
					</tr>
				</table>
				
				
				
				<?php
					$query = "select * from basicinfo where Basic_Object = '$object' and Basic_ID = $bid and Basic_Major = '$major'";
					$result = mysql_query($query);
					if($rows = mysql_fetch_array($result)){
						$bid = $rows['Basic_ID'];
					}
					if(mysql_num_rows($result)>0){
						mysql_free_result($result);
						$query = "select * from question where Basic_ID = $bid";
						$result = mysql_query($query);
						$j=0;
						while($rows = mysql_fetch_array($result)){
							$j++;
							if($rows['Question_Type']!='简答题'){
				?>
				<div class="content">
					<h1>第<?php echo $j;?>题（<?php echo $rows['Question_Type']?>）<?php echo $rows['Question_Title']?></h1>
					<table class="sj" cellpadding="0" cellspacing="1" width="820">
						<tr>
							<?php
								$array1 = array('Question_A','Question_B','Question_C','Question_D','Question_E','Question_F');
								for($i=0;$i<count($array1);$i++){
									if($rows[$array1[$i]]!=""){
							?>
							<td><?php echo $rows[$array1[$i]];?></td>
							<?php
									}
								}
							?>
							<td>总数</td>
						</tr>
						<tr>
							<?php
								$array2 = array('A','B','C','D','E','F');
								$sums = 0;
								for($i=0;$i<count($array1);$i++){
									if($rows[$array1[$i]]!=""){
										$query2 = "select * from answer where Question_ID = {$rows['Question_ID']} and Answer_Content = '{$array2[$i]}'";
										$number  = mysql_num_rows(mysql_query($query2));
										$sums += $number;
							?>
										<td>
										<?php echo $number;?>
										</td>
							<?php
									}
								}
							?>
							
							<td><?php echo $sums;?></td>
						</tr>
					</table>
					<div style="height:20px;"></div>
					<table class="draw" cellpadding="0" cellspacing="0" width="820" class="draw">
						<?php
								for($i=0;$i<count($array1);$i++){
									if($rows[$array1[$i]]!=""){
										$query2 = "select * from answer where Question_ID = {$rows['Question_ID']} and Answer_Content = '{$array2[$i]}'";
										$number  = mysql_num_rows(mysql_query($query2));
							?>
						<tr>
							<td align="center"> <?php echo $rows[$array1[$i]];?> </td>
							<td class="img"> <img src="images/draw.jpg" width="<?php if($sums==0) echo 0; else echo $number/$sums*400;?>" height="20"/> <font style="color:#0000ff;">
							<?php if($sums!=0)echo  sprintf("%.2f", $number/$sums*100); else echo "0.00";?>%
							</font></td>
						</tr>
						<?php
									}
								}
						?>
					</table>
				</div>
				<?php
							}else{
				?>
				<div class="content">
					<h1>第<?php echo $i;?>题（<?php echo $rows['Question_Type']?>）<?php echo $rows['Question_Title']?></h1>
					<a href="student_content.php?id=<?php echo $rows['Question_ID']?>" target="_blank">查看学生回答</a>
				</div>
				<?php
							}
						}
						mysql_free_result($result);
					}
					mysql_close();
				?>
				
				
				

				
		</div>

	</div>



</body>
</html>

















