<?php

	/**
	* Sehir DAO
	*/

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/OrtakIslemler.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/jsonManager.php");

	class KullaniciDAO extends jsonManager
	{

		private $birimIslem;

		function __construct()
		{
			$this -> birimIslem = new OrtakIslem();
		}

		public function getKullaniciInfo($username,$password){
			$query = "SELECT id,ad,soyad,kullaniciAdi,birimID FROM kullanici WHERE kullaniciAdi = '".$username."' and kullaniciSifre = '".md5($password)."'";
			$this -> listele($query);
		}

		public function getKullaniciByTC($tc_no){
			$query = "SELECT k.id as 'kID',k.ad as 'kAd',k.soyad,k.birimID,b.ad FROM kullanici k,birim b WHERE k.birimID = b.id and k.tcNo = '".$tc_no."'";
			$this -> listele($query);
		}

		public function getKullaniciInfoById($kullanici_id){
			$query = "SELECT * FROM kullanici WHERE id = $kullanici_id LIMIT 1";
			$this -> listele($query);
		}

		public function getKullaniciInfoByBirimId($birim_id){
			$query = "SELECT ad,soyad,tip FROM kullanici WHERE birimID =  $birim_id";
			$this -> listele($query);
		}

		public function getKullaniciAdresById($kullanici_id){
			$query = "SELECT * FROM adres WHERE kullanici_id = $kullanici_id";
			$this -> listele($query);
		}

		public function getKullaniciIletisimById($kullanici_id){
			$query = "SELECT id,tip,deger FROM iletisim WHERE kullanici_id = $kullanici_id";
			$this -> listele($query);
		}

		public function setToken($kullanici_id,$token){
			$query = "UPDATE `kullanici` SET `registration_id`='".$token."' WHERE `id`= $kullanici_id";
			$this -> birimIslem -> sorguCalistir($query);
			$list = array("Güncellendi");
			echo $this -> encodeJSON($list);
		}

		public function listele($query){
			$result = $this -> birimIslem -> listele($query);
			$list = array();

			while ($data = @mysqli_fetch_assoc($result)) {
				array_push($list,$data);
			}

			echo $this -> encodeJSON($list);
		}
	}

?>
