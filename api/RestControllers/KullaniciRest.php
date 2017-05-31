<?php

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/DAO/KullaniciDAO.php");

	$view = "";

	if(isset($_GET["view"])){
       $view = $_GET["view"];
       $kullaniciDAO = new KullaniciDAO();
	}

	switch ($view) {
		case 'checkAuth':
			$kullaniciDAO -> getKullaniciInfo($_GET['user'],$_GET['pass']);
			break;
		case 'byTC':
			$kullaniciDAO -> getKullaniciByTC($_GET['tc']);
			break;
		case 'byId':
			$kullaniciDAO -> getKullaniciInfoById($_GET['id']);
			break;
		case 'adresbyid':
			$kullaniciDAO -> getKullaniciAdresById($_GET['id']);
			break;
		case 'iletisimbyid':
			$kullaniciDAO -> getKullaniciIletisimById($_GET['id']);
			break;
		case 'birimbyid':
			$kullaniciDAO -> getKullaniciInfoByBirimId($_GET['id']);
			break;
		case 'upToken':
				$kullaniciDAO -> setToken($_GET['id'],$_GET['token']);
				break;
		case 'bySTC':
				$kullaniciDAO -> getSTCInfo($_GET['stcid']);
				break;
	}

?>
