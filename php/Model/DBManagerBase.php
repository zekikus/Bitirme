<?php
	
	//Ortak Database Metodları ve Özellikleri
	abstract class DBManagerBase{

		private $baglanti = null; 
		private $server = null;
		private $kadi = null; //Kullanıcı Adı.
		private $sifre = null;
		private $vt_adi = null;
		private $sorgu_sonuc = null; //ResultSet : Sorgudan Dönen Değerler.

		public function getBaglanti(){
			return $this -> baglanti;
		}

		public function setBaglanti($baglanti){
			$this -> baglanti = $baglanti;
		}

		public function getServer(){
			return $this -> server;
		}

		public function setServer($server){
			$this -> server = $server;
		}

		public function getKadi(){
			return $this -> kadi;
		}

		public function setKadi($kadi){
			$this -> kadi = $kadi;
		}

		public function getSifre(){
			return $this -> sifre;
		}

		public function setSifre($sifre){
			$this -> sifre = $sifre;
		}

		public function getVtAdi(){
			return $this -> vt_adi;
		}

		public function setVtAdi($vt_adi){
			$this -> vt_adi = $vt_adi;
		}

		public function getSorguSonuc(){
			return $this -> sorgu_sonuc;
		}

		public function setSorguSonuc($sorgu_sonuc){
			$this -> sorgu_sonuc = $sorgu_sonuc;
		}

		abstract public function getYeniVTBaglanti(); // Veritabanı Bağlantısı Kurar.
		abstract public function getYeniVTResultSet($sorgu); // Sorgudan dönen sonucları döndürür.
		abstract public function getYeniVTKomutIsle($sorgu); // Gelen komutu işler. INSERT UPDATE DELETE Işlemleri için
		abstract public function getEtkilenenKayitSayisi($sorgu); // Sorgudan dönen sonuçların sayısını verir.

	}

?>