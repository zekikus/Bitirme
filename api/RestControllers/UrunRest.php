<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/DAO/UrunDAO.php");

	$view = "";

	if(isset($_GET["view"])){
       $view = $_GET["view"];
       $urunDAO = new UrunDAO();
	}

	switch ($view) {
		case 'byTagOrName':
			$urunDAO -> getUrunByTagOrName($_GET['tag'],$_GET['name']);
			break;
		case 'uruninfobyid':
			$urunDAO -> getUrunInfoById($_GET['id']);
			break;
	}

?>