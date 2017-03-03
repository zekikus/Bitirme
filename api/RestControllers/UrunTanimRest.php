<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/DAO/UrunTanimDAO.php");

	$view = "";

	if(isset($_GET["view"])){
       $view = $_GET["view"];
       $urunTanimDAO = new UrunTanimDAO();
	}

	switch ($view) {
		case 'byName':
			$urunTanimDAO -> getUrunTanimByName($_GET['name']);
			break;
		case 'byId':
			$urunTanimDAO -> getUrunTanimById($_GET['id']);
			break;
	}

?>
