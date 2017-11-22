function show(value){
	if(value==1){
		$name = 'sli';
	}else if(value==0){
		$name = 'ali';
	}
	var li = document.getElementById("cul").getElementsByTagName("li");
	for(var i = 0;i < li.length;i++){
		if(li[i].className == $name){
			li[i].style.display = 'none';
		}else{
			li[i].style.display = 'block';
		}
	}
}