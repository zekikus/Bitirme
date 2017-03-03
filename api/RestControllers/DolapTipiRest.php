<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/DAO/DolapTipiDAO.php");

	$view = "";

	if(isset($_GET["view"])){
       $view = $_GET["view"];
       $dolaptipiDAO = new DolapTipiDAO();
	}

	switch ($view) {
		case 'byName':
			$dolaptipiDAO -> getDolapTipiByName($_GET['name']);
			break;
		case 'byId':
			$dolaptipiDAO -> getDolapTipiById($_GET['id']);
			break;
	}

?>
