<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/DAO/StcDAO.php");

	$view = "";

	if(isset($_GET["view"])){
       $view = $_GET["view"];
       $stcDAO = new StcDAO();
	}

	switch ($view) {
		case 'byId':
			$stcDAO -> getStcById($_GET['id']);
			break;
		case 'sicaklikbyid':
			$stcDAO -> getStcSicaklikById($_GET['id']);
			break;
	}

?>