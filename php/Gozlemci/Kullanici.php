<?php
	class Kullanici{
		private $ad;
		private $soyad;
		private $email;

		public function __construct($ad,$soyad,$email){
			$this -> ad = $ad;
			$this -> soyad = $soyad;
			$this -> email = $email;
		}

		public function setAd($ad){
			$this -> ad = $ad;
		}

		public function getAd(){
			return $this -> ad;
		}

		public function setSoyad($soyad){
			$this -> soyad = $soyad;
		}

		public function getSoyad(){
			return $this -> soyad;
		}

		public function setEmail($email){
			$this -> email = $email;
		}

		public function getEmail(){
			return $this -> email;
		}
	}
?>