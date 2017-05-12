<?php

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/IKontrol.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/OrtakIslemler.php");

	class AnasayfaKontrol implements IKontrol{

		private $anasayfaIslem;

		public function __construct(){
			$this -> anasayfaIslem = new OrtakIslem();
		}

		public function kaydet($sorgu){
			$this -> anasayfaIslem -> ekle($sorgu);
		}

		public function duzenle($sorgu,$islem){
			if($islem == "sil")
				$this -> anasayfaIslem -> sil($sorgu);
			else
				$this -> anasayfaIslem -> guncelle($sorgu);
		}

		public function listele($sorgu){
			return $this -> anasayfaIslem -> listele($sorgu);
		}

		public function sorguCalistir($sorgu){
			return $this -> anasayfaIslem -> sorguCalistir($sorgu);
		}

		public function etkilenenKayitSayisi($sorgu){
			return $this -> anasayfaIslem -> etkilenenKayitSayisi($sorgu);
		}

	}

?>
