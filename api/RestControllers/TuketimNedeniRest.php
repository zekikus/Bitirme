<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/DAO/TuketimNedeniDAO.php");

	$view = "";

	if(isset($_GET["view"])){
       $view = $_GET["view"];
       $sehirDAO = new TuketimNedeniDAO();
	}

	switch ($view) {
		case 'byName':
			$sehirDAO -> getTuketimNedeniByName($_GET['name']);
			break;
		case 'byId':
			$sehirDAO -> getTuketimNedeniById($_GET['id']);
			break;
	}

?>