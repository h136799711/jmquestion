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
function send_request(url){//��ʼ����ָ������������������ĺ���
	http_request=false;
	//��ʼ��ʼ��XMLHttpRequest����
	if(window.XMLHttpRequest){//Mozilla�����
		http_request=new XMLHttpRequest();
		if(http_request.overrideMimeType){//����MIME���
			http_request.overrideMimeType("text/xml");
		}
	}
	else if(window.ActiveXObject){//IE�����
		try{
			http_request=new ActiveXObject("Msxml2.XMLHttp");
		}catch(e){
			try{
				http_request=new ActiveXobject("Microsoft.XMLHttp");
			}catch(e){}
		}
	}
if(!http_request){//�쳣����������ʵ��ʧ��
	window.alert("����XMLHttp����ʧ�ܣ�");
	return false;
}
http_request.onreadystatechange=processrequest;
//ȷ����������ʽ��URL�����Ƿ�ͬ��ִ���¶δ���
http_request.open("GET",url,true);
http_request.send(null);
 }
 
  //��������Ϣ�ĺ���
function processrequest(){
	if(http_request.readyState==4){//�ж϶���״̬
		if(http_request.status==200){//��Ϣ�ѳɹ����أ���ʼ������Ϣ
			
			//http_request.responseText;
		}
		else{//ҳ�治����
			alert("���������ҳ�治������");
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