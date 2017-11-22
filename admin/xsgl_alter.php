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
	var http_request=false;
	function send_request(url){//初始化，指定处理函数，发送请求的函数
		http_request=false;
		//开始初始化XMLHttpRequest对象
		if(window.XMLHttpRequest){//Mozilla浏览器
			http_request=new XMLHttpRequest();
			if(http_request.overrideMimeType){//设置MIME类别
				http_request.overrideMimeType("text/xml");
			}
		}
		else if(window.ActiveXObject){//IE浏览器
			try{
				http_request=new ActiveXObject("Msxml2.XMLHttp");
			}catch(e){
				try{
					http_request=new ActiveXobject("Microsoft.XMLHttp");
				}catch(e){}
			}
		}
	if(!http_request){//异常，创建对象实例失败
		window.alert("创建XMLHttp对象失败！");
		return false;
	}
	http_request.onreadystatechange=processrequest;
	//确定发送请求方式，URL，及是否同步执行下段代码
	http_request.open("GET",url,true);
	http_request.send(null);
	 }
	 
	  //处理返回信息的函数
	function processrequest(){
		if(http_request.readyState==4){//判断对象状态
			if(http_request.status==200){//信息已成功返回，开始处理信息
				var className = document.getElementById("className");
				className.innerHTML = http_request.responseText;
				//http_request.responseText;
				//alert(http_request.responseText);
			}
			else{//页面不正常
				alert("您所请求的页面不正常！");
			}
		}
	}
	function classS(value){
		send_request("class.php?major="+value);
	}
</script>
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
	$id = $_GET['id'];
	if($id==""){
		exit ("<script>alert('非法操作！');window.close();</script>");
	}
	$query = "select * from student where Student_SID = $id";
	$result = mysql_query($query);
	while($rows = mysql_fetch_array($result)){
?>

	<div id="zhgl_add">
		<h1>账户管理</h1>
		<form name="zhgl_add" method="post" action="xsgl_alter_do.php?sent=alter">
			<ul>
				<input type="hidden" value="<?php echo $id?>" name="id" />
				<li>学　　号：<input type="text" name="sid" class="text" value="<?php echo $rows['Student_ID']?>" /></li>
				<li>姓　　名：<input type="text" name="sname" class="text" value="<?php echo $rows['Student_Name']?>" /></li>
				<li>性　　别：<input type="text" name="sex" class="text" value="<?php echo $rows['Student_Sex']?>" /></li>
				<li>
					专　　业：
					<select name="major" onchange="classS(this.value)">		
					<?php
						$query1 = "select * from major";
						$result1 = mysql_query($query1);
						while($rows1 = mysql_fetch_array($result1)){
					?>
						<option value="<?php echo $rows1['Major_Name']?>" <?php if($rows1['Major_Name']==$rows['Student_Major']) echo "selected='selected'";?>><?php echo $rows1['Major_Name']?></option>
					<?php
						}
						mysql_free_result($result1);
					?>
					</select>
				</li>
				<li>班　　级：
					<select name="class" id="className">		
					<?php
						$query1 = "select * from major where Major_Name = '{$rows['Student_Major']}'";
						$result1 = mysql_query($query1);
						if($rows1 = mysql_fetch_array($result1)){
							$mid = $rows1['Major_ID'];
						}
						mysql_free_result($result1);
						$query1 = "select * from class where Major_ID = $mid";
						$result1 = mysql_query($query1);
						while($rows1 = mysql_fetch_array($result1)){
					?>
						<option value="<?php echo $rows1['Class_Name']?>" <?php if($rows1['Class_Name']==$rows['Class_Name']) echo "selected='selected'"?>><?php echo $rows1['Class_Name']?></option>
					<?php
						}
						mysql_free_result($result1);
					?>
					</select>
				</li>
				<li>工作单位：<input type="text" name="work" class="text" value="<?php echo $rows['Student_Work']?>" /></li>
				<li>手机号码：<input type="text" name="phone" class="text" value="<?php echo $rows['Student_Phone']?>" /></li>
				<li>E - mail：<input type="text" name="email" class="text" value="<?php echo $rows['Student_Email']?>" /></li>
				<li>
				毕业届数：
				<select name="object">		
					<?php
						$query1 = "select * from object";
						$result1 = mysql_query($query1);
						while($rows1 = mysql_fetch_array($result1)){
					?>
						<option value="<?php echo $rows1['Object_Name']?>" <?php if($rows1['Object_Name']==$rows['Student_Object']) echo "selected='selected'";?> ><?php echo $rows1['Object_Name']?></option>
					<?php
						}
						mysql_free_result($result1);
					?>
					</select>
				</li>
				<li>身 份 证：<input type="text" name="card" class="text" value="<?php echo $rows['Student_Card']?>" /></li>
				<li><input type="submit" name="sent" class="submit" value="修改" /></li>
			</ul>
		</form>
	</div>
<?php
	}
	mysql_free_result($result);
	mysql_close();
?>


</body>
</html>

















