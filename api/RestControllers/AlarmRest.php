<?php

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/DAO/AlarmDAO.php");

	$view = "";

	if(isset($_GET["view"])){
       $view = $_GET["view"];
       $alarmDAO = new AlarmDAO();
	}

	switch ($view) {
		case 'byIdOrStcNo':
			$alarmDAO -> getAlarmByIdOrStcNo($_GET['id'],$_GET['stcno']);
			break;
		case 'infoById':
			$alarmDAO -> getAlarmInfoById($_GET['id']);
			break;
		case 'infoSicaklik':
			$alarmDAO -> getSicaklikInfo($_GET['stcno']);
			break;
	}

?>
