window.onload = function(){
	var tooltip = document.getElementById("tooltip");
	tooltip.style.height=document.body.scrollHeight+"px";
	tooltip.style.width=document.body.scrollWidth+"px";
}

function closeWindow(){
	window.opener=null;
	window.open("","_self");
	setTimeout('window.top.close()', 10);
}