<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/DAO/KullaniciDAO.php");

	$view = "";

	if(isset($_GET["view"])){
       $view = $_GET["view"];
       $kullaniciDAO = new KullaniciDAO();
	}

	switch ($view) {
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
	}

?>