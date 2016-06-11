<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/IKontrol.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/BirimIslemleri.php");

	class BirimKontrol implements IKontrol{

		private $birimIslem;

		public function __construct(){
			$this -> urunIslem = new BirimIslemleri();
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