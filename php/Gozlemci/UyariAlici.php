<?php

	//Singleton Alici
	class UyariAlici{

		private static $uyariAlici;
		private static $komutListesi; //Uyarı Komut Tipinde Dizi

		private function __construct(){
			self::$komutListesi = array();
		}

		public static function getInstance(){
			if(NULL == self::$uyariAlici)
				self::$uyariAlici = new UyariAlici();
			return self::$uyariAlici;
		}

		public static function ekle(UyariKomut $komut){
			self::$komutListesi[] = $komut;
		}

		public static function getKomutListesi(){
			return self::$komutListesi;
		}

		public static function ExecuteAll(){
			foreach (self::$komutListesi as $komut) {
				$komut -> Execute();
			}
		}

	}
?>