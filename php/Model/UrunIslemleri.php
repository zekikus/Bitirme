<?php

	 include ("php/Model/ApplicationContext.php");

	class UrunIslemleri{

		private $context = "";
		private $manager = "";
		private $sorgu = "";

		public function setContext(){
			$this -> context = new ApplicationContext();
		}

		public function getContext(){
			return $this -> context;
		}

		public function __construct(){
			$this -> setContext();
		}

		public function ekle(){

			$this -> sorgu = "INSERT INTO `urun` (`id`, `uretici_id`, `tanim_id`, `ad`, `tag_id`, `aciklama`, `doz`, `seans_tipi`, `seans_sayisi`, `kullanim_suresi`) VALUES ('', '1', '1', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test')";
			$this -> manager = $this -> context -> getDbManager();
			$this -> manager -> getYeniVTKomutIsle($this -> sorgu);
		}

	}
	
?>