<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/DAO/BirimDAO.php");

	$view = "";

	if(isset($_GET["view"])){
       $view = $_GET["view"];
       $birimDAO = new BirimDAO();
	}

	switch ($view) {
		case 'byIlceName':
			$birimDAO -> getBirimByIlceName($_GET['il'],$_GET['ilce']);
			break;
		case 'biriminfo':
			$birimDAO -> getBirimInfoById($_GET['id']);
			break;
		case 'birimstokbyid':
			$birimDAO -> getBirimStokById($_GET['id']);
			break;
		case 'birimkullanicibyid':
			$birimDAO -> getBirimKullaniciById($_GET['id']);
			break;
	}

?>