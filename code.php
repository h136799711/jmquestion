<?php 
	
	function _code($_width = 75,$_height = 25,$_rnd_code = 4,$_flag = false) {
	
		//���������
		for ($i=0;$i<$_rnd_code;$i++) {
			$_nmsg .= dechex(mt_rand(0,15));
		}
		
		//������session
		$_SESSION['code'] = '1234';// $_nmsg;
		
		//����һ��ͼ��
		$_img = imagecreatetruecolor($_width,$_height);
		
		//��ɫ
		$_white = imagecolorallocate($_img,255,255,255);
		
		//���
		imagefill($_img,0,0,$_white);
		
		if ($_flag) {
			//��ɫ,�߿�
			$_black = imagecolorallocate($_img,0,0,0);
			imagerectangle($_img,0,0,$_width-1,$_height-1,$_black);
		}
		
		//�漴����6������
		for ($i=0;$i<6;$i++) {
			$_rnd_color = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imageline($_img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rnd_color);
		}
		
		//�漴ѩ��
		for ($i=0;$i<100;$i++) {
			$_rnd_color = imagecolorallocate($_img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
			imagestring($_img,1,mt_rand(1,$_width),mt_rand(1,$_height),'*',$_rnd_color);
		}
		
		//�����֤��
		for ($i=0;$i<strlen($_SESSION['code']);$i++) {
			$_rnd_color = imagecolorallocate($_img,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200));
			imagestring($_img,5,$i*$_width/$_rnd_code+mt_rand(1,10),mt_rand(1,$_height/2),$_SESSION['code'][$i],$_rnd_color);
		}
		
		//���ͼ��
		header('Content-Type: image/png');
		imagepng($_img);
		
		//����
		imagedestroy($_img);
	}
	session_start();
	_code(70,25,4,false);
?>