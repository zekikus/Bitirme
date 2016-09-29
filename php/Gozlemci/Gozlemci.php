<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/Kullanici.php");

	abstract class Gozlemci{

		public $uyariGozlemciler;
		public $kullanici;
		
		public function __construct(){
			$this -> uyariGozlemciler = array();
		}

		public function ekle(UyariGozlemci $uyariGozlemci){
			$this -> uyariGozlemciler[] = $uyariGozlemci;
		}

		public function Notify(){
			foreach ($this -> uyariGozlemciler as  $uyariGozlemci) {
				$uyariGozlemci -> Update($this);
			}
		}

		public function getKullanici(){
			return $this -> kullanici;
		}
		
		abstract public function Update();
	} 


?>