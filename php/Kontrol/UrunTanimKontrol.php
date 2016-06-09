<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/IKontrol.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/UrunTanimIslemleri.php");

	class UrunTanimKontrol implements IKontrol{

		private $urunTanimIslem;

		public function __construct(){
			$this -> urunTanimIslem = new UrunTanimIslemleri();
		}

		public function kaydet($sorgu){
			$this -> urunTanimIslem -> ekle($sorgu);
		}

		public function duzenle($sorgu,$islem){
			if($islem == "sil")
				$this -> urunTanimIslem -> sil($sorgu);
			else
				$this -> urunTanimIslem -> guncelle($sorgu);
		}

		public function listele($sorgu){
			return $this -> urunTanimIslem -> listele($sorgu);
		}

		public function sorguCalistir($sorgu){

		}

	}

?>