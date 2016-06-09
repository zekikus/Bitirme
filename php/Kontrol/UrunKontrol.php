<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/IKontrol.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/UrunIslemleri.php");

	class UrunKontrol implements IKontrol{

		private $urunIslem;

		public function __construct(){
			$this -> urunIslem = new UrunIslemleri();
		}

		public function kaydet($sorgu){
			$this -> urunIslem -> ekle($sorgu);
		}

		public function duzenle($sorgu,$islem){
			if($islem == "sil")
				$this -> urunIslem -> sil($sorgu);
			else
				$this -> urunIslem -> guncelle($sorgu);
		}

		public function listele($sorgu){
			return $this -> urunIslem -> listele($sorgu);
		}

		public function sorguCalistir($sorgu){

		}

	}

?>