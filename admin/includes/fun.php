<?php
	function _page($_sql,$_size) {
		//����������б���ȡ�������ⲿ���Է���
		global $_page,$_pagesize,$_pagenum,$_pageabsolute,$_num;
		if(isset($_GET['page']) || isset($_POST['page'])){
		
			if (isset($_GET['page'])) {
				$_page = $_GET['page'];
				if (empty($_page) || $_page < 0 || !is_numeric($_page)) {
					$_page = 1;
				} else {
					$_page = intval($_page);
				}
			} 
			
			if (isset($_POST['page'])) {
				$_page = $_POST['page'];
				if (empty($_page) || $_page < 0 || !is_numeric($_page)) {
					$_page = 1;
				} else {
					$_page = intval($_page);
				}
			}
		}else {
			$_page = 1;
		}
		$_pagesize = $_size;
		$_num = mysql_num_rows(mysql_query($_sql));
		if ($_num == 0) {
			$_pageabsolute = 1;
		} else {
			$_pageabsolute = ceil($_num / $_pagesize);
		}
		if ($_page > $_pageabsolute) {
			$_page = $_pageabsolute;
		}
		$_pagenum = ($_page - 1) * $_pagesize;

	}
	
	
	
	//����һ���Զ�ת��״̬�ĳ���
	define('GPC',get_magic_quotes_gpc());

	function _mysql_string($_string) {
		//get_magic_quotes_gpc()�������״̬����ô�Ͳ���Ҫת��
		if (!GPC) {
			return mysql_real_escape_string($_string);
		} 
		return $_string;
	}
	
?>