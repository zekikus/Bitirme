<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/DBManagerBase.php");

	class MySQLDBManager extends DBManagerBase{

		public function __construct($connectionString){
			$string = explode("#", $connectionString);
		
			$this -> setServer(trim($string[0]));
			$this -> setKadi(trim($string[1]));
			$this -> setSifre(trim($string[2]));
			$this -> setVtAdi(trim($string[3]));
		}

		public function getYeniVTBaglanti(){
			
			return mysqli_connect($this -> getServer(),$this -> getKadi(),$this -> getSifre(),$this -> getVtAdi());
		}
		
		public function getYeniVTResultSet($sorgu){
			$baglanti = $this -> getYeniVTBaglanti();
			return mysqli_query($baglanti,$sorgu);

		}

		public function getYeniVTKomutIsle($sorgu){
			$sonuc = $this -> getYeniVTResultSet($sorgu);

			if($sonuc)
				echo "<script>alert('İşlem Başarılı')</script>";
			else
				echo "<script>alert('İşlem Başarısız')</script>";
		}

		public function getEtkilenenKayitSayisi($sorgu){
			return mysqli_num_rows(getYeniVTResultSet($sorgu));
		}
		
	}

?>