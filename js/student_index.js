window.onload = function(){
	var tooltip = document.getElementById("tooltip");
	tooltip.style.height=document.body.scrollHeight+"px";
	tooltip.style.width=document.body.scrollWidth+"px";
}
function hover(name){
	var strong_1 = document.getElementById("strong_1");
	var strong_2 = document.getElementById("strong_2");
	var s1 = document.getElementById("s1");
	var s2 = document.getElementById("s2");
	if(name=='s1'){
		strong_1.style.display="block";
		strong_2.style.display="none";
		s1.className = "s1";
		s2.className = "";
	}else if(name=='s2'){
		strong_1.style.display="none";
		strong_2.style.display="block";
		s1.className = "";
		s2.className = "s1";
	}
}

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
			
			//http_request.responseText;
		}
		else{//页面不正常
			alert("您所请求的页面不正常！");
		}
	}
}
function xxhd(){
	var phone = document.getElementById("phone").vaue;
	var email = document.getElementById("email").value;
	var work = document.getElementById("work").value;
	send_request("xxhd.php?phone="+phone+"&email="+email+"&work="+work);
}
function showTip(){
	document.getElementById("tooltip").style.display="block";
	document.getElementById("hdxx").style.display="block";
}
function hiddenTip(){
	document.getElementById("tooltip").style.display="none";
	document.getElementById("hdxx").style.display="none";
}