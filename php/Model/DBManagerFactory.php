<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/MySQLDBManager.php");

	class DBManagerFactory{

		public  function getDBManagerBase($dbType,$connectionString){
			switch (trim($dbType)) {
				case 'MYSQL':
					return new MySQLDBManager($connectionString);
					break;
				default:
					echo "yok";
					break;
			}

		}

	}

?>