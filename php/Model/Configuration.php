<?php
	
	class Configuration{

		private $dbProviderType;
		private $dbServer;
		private $dbUser;
		private $dbPass;
		private $dbName;

		//Config Ayarlarını Al;
		public function initialize(){

			$xml=simplexml_load_file($_SERVER["DOCUMENT_ROOT"]."/Bitirme/config.xml");
			
			$this -> dbProviderType = $xml -> dbProviderType;
			$this -> dbServer = $xml -> dbServer;
			$this -> dbUser = $xml -> dbUser;
			$this -> dbPass = $xml -> dbPass;
			$this -> dbName = $xml -> dbName;

			return $this -> dbServer."#".$this -> dbUser."#".$this -> dbPass."#".$this -> dbName;
		}

		public function getDbProviderType(){
			return $this -> dbProviderType;
		}

		public function getDbServer(){
			return $this -> dbServer;
		}

		public function getDbUser(){
			return $this -> dbUser;
		}

		public function getDbPass(){
			return $this -> dbPass;
		}

		public function getDbName(){
			return $this -> dbName;
		}


	}

	

?>