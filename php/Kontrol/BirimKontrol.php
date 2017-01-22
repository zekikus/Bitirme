<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/IKontrol.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/OrtakIslemler.php");

	class BirimKontrol implements IKontrol{

		private $birimIslem;

		public function __construct(){
			$this -> birimIslem = new OrtakIslem();
		}

		public function kaydet($sorgu){
			$this -> birimIslem -> ekle($sorgu);
		}

		public function duzenle($sorgu,$islem){
			if($islem == "sil")
				$this -> birimIslem -> sil($sorgu);
			else
				$this -> birimIslem -> guncelle($sorgu);
		}

		public function listele($sorgu){
			return $this -> birimIslem -> listele($sorgu);
		}

		public function sorguCalistir($sorgu){
			return $this -> birimIslem -> sorguCalistir($sorgu);
		}

		public function etkilenenKayitSayisi($sorgu){
			return $this -> birimIslem -> etkilenenKayitSayisi($sorgu);
		}

	}

?>