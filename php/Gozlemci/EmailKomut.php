<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/Gozlemci.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/UyariKomut.php");

	class EmailKomut extends UyariKomut{

		private $gozlemci;

		public function __construct(Gozlemci $gozlemci){
			$this -> gozlemci = $gozlemci;
		}

		public function Execute(){
			echo $this -> gozlemci -> getKullanici() -> getAd()."<br/>";
			echo "Mail Gönderildi.<br/>";
		}

	}

?>