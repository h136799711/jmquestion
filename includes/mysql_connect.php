<?php 
	define('DB_HOST','47.88.216.242');   //��������ַ
	define('DB_USER','hebidu');        //��¼���ݿ���ʺ�
	define('DB_PWD','364945361');	 //��¼���ݿ������
	define('DB_NAME','test_question');      //Ҫ���ӵ����ݿ�����
	
	$conn=@mysql_connect(DB_HOST,DB_USER,DB_PWD) or die('���ݿ����'.mysql_error());  //�������ݿ�
	mysql_select_db(DB_NAME) or die('���ݿ���󣬴�����Ϣ��'.mysql_error());          //ѡ��ָ�������ݿ�
	mysql_query('SET NAMES UTF8') or die('�ַ�����������'.mysql_error());             //�����ַ�����
?>