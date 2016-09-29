<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/UyariKonu.php");

	class SicaklikUyari extends UyariKonu{

		public function uyariGonder(){
			parent::uyariGonder();	
		}

	}

?>