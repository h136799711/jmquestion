<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>大学生跟踪调查</title>
<link href="style/index.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="zhgl_add">
	<h1>账户管理</h1>
<?php 
	if(empty($_GET[submit])) { 
?> 
	<form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']?>?submit=1" method="post" style="padding-left:30px;"> 
	选择xls文件: <input name="filename" type="file"> 
	<input type="submit" value="上传"> (*注意XLS的格式<a href="images/model.jpg" target="_blank">查看样本</a>)
	</form> 
<?php 
	}else{ 
		$path="../uploadfile/"; //上传路径 
		//echo $_FILES["filename"]["type"]; 
		if(!file_exists($path)) { 
			//检查是否有该文件夹，如果没有就创建，并给予最高权限 
			mkdir("$path", 0700); 
		}//END IF 
		//允许上传的文件格式 
		$tp = array("application/kset"); 
		//检查上传文件是否在允许上传的类型 
		if(!in_array($_FILES["filename"]["type"],$tp)) 
		{ 
			echo "File Type is incorrect"; 
			exit; 
		}//END IF 
		if($_FILES["filename"]["name"]) { 
			//$file1=$_FILES["filename"]["name"]; 
			$date = date('Ymdhis');
			$name = explode('.',$_FILES["filename"]["name"]);
			$file1 = $date.'.'.$name[1];
			//$file2 = $path.time().$file1; 
			//文件名称 取原文件名
			$file2 = $path.$file1;
			$flag=1; 
		}//END IF 
		if($flag) $result=move_uploaded_file($_FILES["filename"]["tmp_name"],$file2); 
		//特别注意这里传递给move_uploaded_file的第一个参数为上传到服务器上的临时文件 
		if($result) { 
			//echo "上传成功!".$file2; 
			//将xls文件导入mysql
			require_once 'reader.php';  
			$data = new Spreadsheet_Excel_Reader();  
			$data->setOutputEncoding('UTF-8');  
			$data->read('../uploadfile/'.$file1);  
			require 'includes/mysql_connect.php';
			error_reporting(E_ALL ^ E_NOTICE);  
			echo "<table id='dr_table' cellpadding='0' cellspacing='0' border='1'>";
			for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) { 
				$sql = "INSERT INTO student (Student_ID,Student_Name,Student_Sex,Student_Major,Student_Class,Student_Work,Student_Phone,Student_Email,Student_Object,Student_Card) VALUES('".
				$data->sheets[0]['cells'][$i][1]."','". 
				$data->sheets[0]['cells'][$i][2]."','". 
				$data->sheets[0]['cells'][$i][3]."','". 
				$data->sheets[0]['cells'][$i][4]."','". 
				$data->sheets[0]['cells'][$i][5]."','". 
				$data->sheets[0]['cells'][$i][6]."','". 
				$data->sheets[0]['cells'][$i][7]."','". 
				$data->sheets[0]['cells'][$i][8]."','". 
				$data->sheets[0]['cells'][$i][9]."','". 
				$data->sheets[0]['cells'][$i][10]."')";  
				if($i==1){
					echo "<tr><th>序号</th><th>姓名</th><th>性别</th>	<th>专业</th><th>班级</th><th>工作单位</th><th>手机</th><th>邮件</th><th>毕业届数</th><th>身份证</th></tr>";
				}else{
					echo "<tr><td>{$data->sheets[0]['cells'][$i][1]}</td><td>{$data->sheets[0]['cells'][$i][2]}</td><td>{$data->sheets[0]['cells'][$i][3]}</td><td>{$data->sheets[0]['cells'][$i][4]}</td><td>{$data->sheets[0]['cells'][$i][5]}</td><td>{$data->sheets[0]['cells'][$i][6]}</td><td>{$data->sheets[0]['cells'][$i][7]}</td><td>{$data->sheets[0]['cells'][$i][8]}</td><td>{$data->sheets[0]['cells'][$i][9]}</td><td>{$data->sheets[0]['cells'][$i][10]}</td></tr>";
				}
				//echo $sql.'< br />';  
				$res = mysql_query($sql); 
			}
			//删除上传的文件
			$result = @unlink('../uploadfile/'.$file1); 
			if(!result){
				echo "<script>alert('import success!');</script>";
			}
?>
			<form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']?>?submit=1" method="post" style="padding-left:30px;"> 
			选择xls文件: <input name="filename" type="file"> 
			<input type="submit" value="继续上传"> 
			</form> 
<?php
		}
	} 

?>
</div>
</body>
</html>