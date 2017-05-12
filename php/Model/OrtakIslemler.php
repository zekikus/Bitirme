<?php

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/ApplicationContext.php");

	class OrtakIslem{

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
			$this -> manager = $this -> context -> getDbManager();
		}

		public function ekle($sorgu){
			$this -> manager -> getYeniVTKomutIsle($sorgu);
		}

		public function listele($sorgu){
			$sonuc = $this -> manager -> getYeniVTResultSet($sorgu);
			return $sonuc;
		}

		public function sil($sorgu){
			$this -> manager -> getYeniVTKomutIsle($sorgu);
		}

		public function guncelle($sorgu){
			$this -> manager -> getYeniVTKomutIsle($sorgu);
		}

		public function etkilenenKayitSayisi($sorgu){
			return $this -> manager -> getEtkilenenKayitSayisi($sorgu);
		}

		public function sorguCalistir($sorgu){
			return $this -> manager -> sorguCalistir($sorgu);
		}
}

?>
