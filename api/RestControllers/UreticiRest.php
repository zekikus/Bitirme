<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/DAO/UreticiDAO.php");

	$view = "";

	if(isset($_GET["view"])){
       $view = $_GET["view"];
       $ureticiDAO = new UreticiDAO();
	}

	switch ($view) {
		case 'byName':
			$ureticiDAO -> getUreticiByName($_GET['name']);
			break;
		case 'byId':
			$ureticiDAO -> getUreticiById($_GET['id']);
			break;
	}

?>