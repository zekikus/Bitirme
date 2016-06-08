<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/IKontrol.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/DolapTipiIslemleri.php");

	class DolapTipiKontrol implements IKontrol{

		private $ureticiIslem;

		public function __construct(){
			$this -> ureticiIslem = new DolapTipiIslemleri();
		}

		public function kaydet($sorgu){
			$this -> ureticiIslem -> ekle($sorgu);
		}

		public function duzenle($sorgu,$islem){
			if($islem == "sil")
				$this -> ureticiIslem -> sil($sorgu);
			else
				$this -> ureticiIslem -> guncelle($sorgu);
		}

		public function listele($sorgu){
			return $this -> ureticiIslem -> listele($sorgu);
		}

		public function sorguCalistir($sorgu){

		}

	}

?>