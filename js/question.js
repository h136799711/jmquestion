window.onload = function(){
	var td = document.getElementById("right_center").getElementsByTagName("td");
	var ul = document.getElementById("content_main").getElementsByTagName("ul");
	for(var i=0;i<ul.length;i++){
		var input = ul[i].getElementsByTagName("input");
		ul[i].index = i;
		ul[i].onclick = function(){
			var thisindex = this.index;
			var sum=0;
			for(var j=0;j<thisindex;j++){
				sum+=ul[this.index].getElementsByTagName("input").length;
			}
			var input = ul[thisindex].getElementsByTagName("input");
			var suminput=sum+input.length;
			var flag = false;
			for(var j=0;j<input.length;j++){
				if(input[j].checked){
					flag = true;
					td[thisindex].getElementsByTagName("a")[0].style.backgroundColor = "#1bacff";
					td[thisindex].getElementsByTagName("a")[0].style.color="#ffffff";
				}
			}
			if(flag==false && suminput>0){
				td[thisindex].getElementsByTagName("a")[0].style.backgroundColor = "#ffffff";
				td[thisindex].getElementsByTagName("a")[0].style.color="#666666";
			}
		}
		
	}
}

function check(){
	var div = document.getElementsByClassName("question");
	var td = document.getElementById("right_center").getElementsByTagName("td");
	var flag = true;
	for(var i=0;i<div.length;i++){
		if(td[i].getElementsByTagName("a")[0].style.backgroundColor==""){
			div[i].style.border="5px solid #1bacff";
			div[i].style.borderRadius="5px";
			div[i].style.height = div[i].offsetHeight + "px";
			flag = false;
		}else{
			div[i].style.border="0px solid #1bacff";
			div[i].style.borderRadius="0px";
		}
	}
	var form = document.getElementById("question_form");
	if(flag){
		form.submit();
	}
}



function textarea(obj,xh){
	xh = xh-1;
	var td = document.getElementById("right_center").getElementsByTagName("td");
	if(obj.value!=""){
		td[xh].getElementsByTagName("a")[0].style.backgroundColor = "#1bacff";
		td[xh].getElementsByTagName("a")[0].style.color="#ffffff";
	}else{
		td[xh].getElementsByTagName("a")[0].style.backgroundColor = "#ffffff";
		td[xh].getElementsByTagName("a")[0].style.color="#666666";
	}
}