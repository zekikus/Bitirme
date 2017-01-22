<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/IKontrol.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/OrtakIslemler.php");

	class KullaniciKontrol implements IKontrol{

		private $kullaniciIslem;

		public function __construct(){
			$this -> kullaniciIslem = new OrtakIslem();
		}

		public function kaydet($sorgu){
			$this -> kullaniciIslem -> ekle($sorgu);
		}

		public function duzenle($sorgu,$islem){
			if($islem == "sil")
				$this -> kullaniciIslem -> sil($sorgu);
			else
				$this -> kullaniciIslem -> guncelle($sorgu);
		}

		public function listele($sorgu){
			return $this -> kullaniciIslem -> listele($sorgu);
		}

		public function sorguCalistir($sorgu){
			return $this -> kullaniciIslem -> sorguCalistir($sorgu);
		}

		public function etkilenenKayitSayisi($sorgu){
			return $this -> kullaniciIslem -> etkilenenKayitSayisi($sorgu);
		}

	}

?>