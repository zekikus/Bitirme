<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/Gozlemci.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/UyariGozlemci.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/SmsKomut.php");

	// Sms Gözlemci
	class SmsUyariGozlemci extends UyariGozlemci{

		public function Update(Gozlemci $gozlemci){
			$komut = new SmsKomut($gozlemci);
			UyariAlici::getInstance() -> ekle($komut);
		}

	}

?>