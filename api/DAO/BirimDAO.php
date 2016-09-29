<?php
	
	/**
	* Sehir DAO
	*/

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/BirimIslemleri.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/jsonManager.php");

	class BirimDAO extends jsonManager
	{

		private $birimIslem;
		
		function __construct()
		{
			$this -> birimIslem = new BirimIslemleri();
		}

		public function getBirimByIlceName($il_ad,$ilce_ad){
			$query = "SELECT * FROM birim  WHERE il LIKE '%".$il_ad."%' and ilce LIKE '%".$ilce_ad."%'";
			$this -> listele($query);
		}

		public function getBirimInfoById($birim_id){
			$query = "SELECT * FROM birim WHERE id = $birim_id LIMIT 1";
			$this -> listele($query);
		}

		public function getBirimStokById($birim_id){
			$query = "SELECT u.ad,u.doz FROM stok s,urun u WHERE s.urun_id = u.id and s.stokbirim_id IN (SELECT id FROM stok_birim WHERE birim_id = $birim_id)";
			$this -> listele($query);
		}

		public function getBirimKullaniciById($birim_id){
			$query = "SELECT ad,soyad,tip FROM kullanici WHERE birimID =  $birim_id";
			$this -> listele($query);
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