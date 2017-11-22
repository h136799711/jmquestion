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
				alert(http_request.responseText);
				className.innerHTML = http_request.responseText;
			}
			else{//页面不正常
				alert("您所请求的页面不正常！");
			}
		}
	}
	function classS(){
		var value1 = document.getElementById('majors').value;
		value1 = "class.php?major="+value1;
		alert(value1);
		send_request(value1);
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
?>

	<div id="zhgl_add">
		<h1>账户管理</h1>
		<form name="zhgl_add" method="post" action="xsgl_add_do.php?sent=add">
			<ul>
				<li>学　　号：<input type="text" name="sid" class="text" /></li>
				<li>姓　　名：<input type="text" name="sname" class="text" /></li>
				<li>性　　别：<input type="text" name="sex" class="text" /></li>
				<li>
					专　　业：
					<select name="major" id="majors" onchange="classS()">		
					<?php
						$query = "select * from major";
						$result = mysql_query($query);
						$i=0;
						while($rows = mysql_fetch_array($result)){
							$i++;
							if($i==1){
								$major = $rows['Major_Name'];
							}
					?>
						<option value="<?php echo $rows['Major_Name']?>"><?php echo $rows['Major_Name']?></option>
					<?php
						}
						mysql_free_result($result);
					?>
					</select>
				</li>
				<li>班　　级：
					<select name="class" id="className">		
					<?php
						$query = "select * from major where Major_Name = '$major'";
						$result = mysql_query($query);
						if($rows = mysql_fetch_array($result)){
							$mid = $rows['Major_ID'];
						}
						mysql_free_result($result);
						$query = "select * from class where Major_ID = $mid";
						$result = mysql_query($query);
						while($rows = mysql_fetch_array($result)){
					?>
						<option value="<?php echo $rows['Class_Name']?>"><?php echo $rows['Class_Name']?></option>
					<?php
						}
						mysql_free_result($result);
					?>
					</select>
				</li>
				<li>工作单位：<input type="text" name="work" class="text" /></li>
				<li>手机号码：<input type="text" name="phone" class="text" /></li>
				<li>E - mail：<input type="text" name="email" class="text" /></li>
				<li>
				毕业届数：
				<select name="object">		
					<?php
						$query = "select * from object";
						$result = mysql_query($query);
						while($rows = mysql_fetch_array($result)){
					?>
						<option value="<?php echo $rows['Object_Name']?>"><?php echo $rows['Object_Name']?></option>
					<?php
						}
						mysql_free_result($result);
					?>
					</select>
				</li>
				<li>身 份 证：<input type="text" name="card" class="text" /></li>
				<li><input type="submit" name="sent" class="submit" value="添加" /></li>
			</ul>
		</form>
	</div>



</body>
</html>

















