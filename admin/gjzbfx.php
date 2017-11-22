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
	var flag = 0;
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
				if(flag==1){
					var object2 = document.getElementById("object2");
					object2.innerHTML = http_request.responseText;
					var object3 = document.getElementById("object3");
					object3.innerHTML = "<option>请选择...</option>";
					var questionName = document.getElementById("questionName");
					questionName.innerHTML = "<option>请选择...</option>";
				}else if(flag==2){
					var object3 = document.getElementById("object3");
					object3.innerHTML = http_request.responseText;
					var questionName = document.getElementById("questionName");
					questionName.innerHTML = "<option>请选择...</option>";
				}else if(flag==3){
					var questionName = document.getElementById("questionName");
					questionName.innerHTML = http_request.responseText;
				}else if(flag==4){
					var table = document.getElementById("table");
					table.innerHTML = http_request.responseText;
				}
				
				//http_request.responseText;
				//alert(http_request.responseText);
			}
			else{//页面不正常
				alert("您所请求的页面不正常！");
			}
		}
	}
	function select1(value){
		flag = 1;
		send_request("select1.php?object1="+value);
	}
	function select2(value){
		flag = 2;
		var object1 = document.getElementById("object1").value;
		send_request("select2.php?object2="+value+"&object1="+object1);
	}
	function select3(value){
		flag = 3;
		var object1 = document.getElementById("object1").value;
		var object2 = document.getElementById("object2").value;
		send_request("select3.php?object2="+object2+"&object1="+object1+"&object3="+value);
	}
	function select4(value){
		flag = 4;
		send_request("select4.php?qid="+value);
	}
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
	require 'includes/mysql_connect.php';
?>

	<div id="dcqkjbfx">
		<h1>毕业生关键指标分析</h1>
		<div id="dcqkjbfx_search" style="">
				　选择比较对象1：
				<select name="object1" id="object1" onchange="select1(this.value);">
					<option>请选择...</option>
					<?php
						$query = "select * from object";
						$result = mysql_query($query);
						while($rows = mysql_fetch_array($result)){
					?>
					<option value="<?php echo $rows['Object_ID']?>"><?php echo $rows['Object_Name']?></option>
					<?php
						}
					?>
				</select>
					选择比较对象2：
				<select name="object2" id="object2" onchange="select2(this.value)">
					<option>请选择...</option>
				</select>
					选择比较对象3：
				<select name="object3" id="object3" onchange="select3(this.value)">
					<option>请选择...</option>
				</select>
				<br/><br/>
				　选择关键指标：
				<select name="questionName" id="questionName" onchange="select4(this.value)">
					<option>请选择...</option>
				</select>
				<br/><br/>
				
				
				<!--
				<div id="drawImage">
					<h2>
						<ul>
							<li style="background:#67caf4;" class="color"></li>
							<li>2014年毕业生</li>
							<li style="background:#f66763;" class="color"></li>
							<li>2013年毕业生</li>
							<li style="background:#e1f379;" class="color"></li>
							<li>2012年毕业生</li>
						</ul>
					</h2>
					
					<div class="white">
						<div class="one"></div>
						<div class="two"></div>
						<div class="three"></div>
					</div>
					<div class="white">
						<div class="one"></div>
						<div class="two"></div>
						<div class="three"></div>
					</div>
					<div class="white">
						<div class="one"></div>
						<div class="two"></div>
						<div class="three"></div>
					</div>
					<div class="white">
						<div class="one"></div>
						<div class="two"></div>
						<div class="three"></div>
					</div>
					<div class="white">
						<div class="one"></div>
						<div class="two"></div>
						<div class="three"></div>
					</div>
					<div class="white">
						<div class="one"></div>
						<div class="two"></div>
						<div class="three"></div>
					</div>
				</div>

		</div>
		-->
		
		<div id="table">
				
		</div>
	</div>



</body>
</html>

















