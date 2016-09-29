<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/Gozlemci.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/Kullanici.php");

	class BirimGozlemci extends Gozlemci{

		public function __construct(Kullanici $kullanici){
			$this -> kullanici = $kullanici;
		}

		public function Update(){
			parent::Notify();
		}
	}
?>