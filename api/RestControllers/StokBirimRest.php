<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/DAO/StokBirimDAO.php");

	$view = "";

	if(isset($_GET["view"])){
       $view = $_GET["view"];
       $stokBirimDAO = new StokBirimDAO();
	}

	switch ($view) {
		case 'birimID':
			$stokBirimDAO -> getStokBirimById($_GET["id"]);
			break;
		case 'birimInfo':
			$stokBirimDAO -> getStokBirimInfoById($_GET["id"]);
			break;
		case 'stokbyid':
			$stokBirimDAO -> getStokById($_GET["id"]);
			break;
		case 'sicaklikbyid':
			$stokBirimDAO -> getSicaklikById($_GET["id"]);
			break;
	}

?>