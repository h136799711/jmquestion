<?php 
	define('DB_HOST','47.88.216.242');   //·þÎñÆ÷µØÖ·
	define('DB_USER','hebidu');        //µÇÂ¼Êý¾Ý¿âµÄÕÊºÅ
	define('DB_PWD','364945361');	 //µÇÂ¼Êý¾Ý¿âµÄÃÜÂë
	define('DB_NAME','test_question');      //ÒªÁ¬½ÓµÄÊý¾Ý¿âÃû³Æ
	
	$conn=@mysql_connect(DB_HOST,DB_USER,DB_PWD) or die('Êý¾Ý¿â´íÎó'.mysql_error());  //Á¬½ÓÊý¾Ý¿â
	mysql_select_db(DB_NAME) or die('Êý¾Ý¿â´íÎó£¬´íÎóÐÅÏ¢£º'.mysql_error());          //Ñ¡ÔñÖ¸¶¨µÄÊý¾Ý¿â
	mysql_query('SET NAMES UTF8') or die('×Ö·û¼¯ÉèÖÃÃÜÂë'.mysql_error());             //ÉèÖÃ×Ö·û±àÂë
?>