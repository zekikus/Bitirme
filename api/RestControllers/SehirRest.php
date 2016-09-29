<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/DAO/SehirDAO.php");

	$view = "";

	if(isset($_GET["view"])){
       $view = $_GET["view"];
       $sehirDAO = new SehirDAO();
	}

	switch ($view) {
		case 'all':
			$sehirDAO -> getAllSehir();
			break;
		case 'allIlce':
			$sehirDAO -> getIlceByID($_GET['id']);
			break;
	}

?>