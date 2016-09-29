<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/Gozlemci.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/UyariGozlemci.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/EmailKomut.php");

	// EMail Gözlemci
	class EmailUyariGozlemci extends UyariGozlemci{

		public function Update(Gozlemci $gozlemci){
			$komut = new EmailKomut($gozlemci);
			UyariAlici::getInstance() -> ekle($komut);
		}

	}
?>