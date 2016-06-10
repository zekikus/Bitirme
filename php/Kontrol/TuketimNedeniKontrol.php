<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/IKontrol.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/TuketimNedeniIslemleri.php");

	class TuketimNedeniKontrol implements IKontrol{

		private $islem;

		public function __construct(){
			$this -> islem = new TuketimNedeniIslem();
		}

		public function kaydet($sorgu){
			$this -> islem -> ekle($sorgu);
		}

		public function duzenle($sorgu,$islem){
			if($islem == "sil")
				$this -> islem -> sil($sorgu);
			else
				$this -> islem -> guncelle($sorgu);
		}

		public function listele($sorgu){
			return $this -> islem -> listele($sorgu);
		}

		public function sorguCalistir($sorgu){

		}

	}

?>