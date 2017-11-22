	
<?php  
	
	$file = $_POST['file'];
	echo $file;

	require_once 'reader.php';  
	$data = new Spreadsheet_Excel_Reader();  
	$data->setOutputEncoding('UTF-8');  

	$data->read('C:\Users\Administrator\Desktop\data.xls');  
	@ $db = mysql_connect('localhost', 'root', '123456') or  die("Could not connect to database.");
	mysql_query("set names UTF8");
	mysql_select_db('mydb');
	error_reporting(E_ALL ^ E_NOTICE);  
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) { 
		$sql = "INSERT INTO test (xuhao,mima,xingbie,dianhua,mail,tj) VALUES('".
		$data->sheets[0]['cells'][$i][2]."','". 
		$data->sheets[0]['cells'][$i][3]."','". 
		$data->sheets[0]['cells'][$i][4]."','". 
		$data->sheets[0]['cells'][$i][5]."','". 
		$data->sheets[0]['cells'][$i][6]."','". 
		$data->sheets[0]['cells'][$i][7]."')";  
		echo $sql.'< br />';  
		$res = mysql_query($sql);  
	}

?> 