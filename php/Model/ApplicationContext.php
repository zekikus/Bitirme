<?php
	
	include "php/Model/Configuration.php";
	include "php/Model/DBManagerFactory.php";

	class ApplicationContext{

		private $config;
		private $dbManager;
		private $dbFactory;
		private $connectionString;

		public function __construct(){
			$this -> config = new Configuration();
			$this -> config -> initialize();
			$this -> dbFactory = new DBManagerFactory();
			$this -> connectionString = $this -> config -> initialize();
		}

		public function getDbFactory(){
			return $this -> dbFactory;
		}

		public function setDBManager($dbManager){
			$this -> dbManager = $dbManager;
		}

		public function getDbManager(){
			$this -> dbManager = $this -> getDbFactory() -> getDBManagerBase($this -> config -> getDbProviderType(),$this -> connectionString);
			return $this -> dbManager;
		}


	}
	
?>