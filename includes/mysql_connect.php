<?php 
	define('DB_HOST','47.88.216.242');   //服务器地址
	define('DB_USER','hebidu');        //登录数据库的帐号
	define('DB_PWD','364945361');	 //登录数据库的密码
	define('DB_NAME','test_question');      //要连接的数据库名称

	$conn=@mysql_connect(DB_HOST,DB_USER,DB_PWD) or die('数据库错误'.mysql_error());  //连接数据库
	mysql_select_db(DB_NAME) or die('数据库错误，错误信息：'.mysql_error());          //选择指定的数据库
	mysql_query('SET NAMES UTF8') or die('字符集设置密码'.mysql_error());             //设置字符编码
?>