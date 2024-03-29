<?php

	/**
	* StokBirim DAO
	*/

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/OrtakIslemler.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/jsonManager.php");

	class StokBirimDAO extends jsonManager
	{

		private $stokBirim;

		function __construct()
		{
			$this -> stokBirim = new OrtakIslem();
		}

		public function getStokBirimById($birim_id){
			$query = "SELECT id,ad,tanim,aciklama,hacim,sensor_id FROM stok_birim WHERE birim_id = ".$birim_id."";
			$this -> listele($query);
		}

		public function getStokBirimInfoById($birim_id){
			$query = "SELECT `id`,`ad`,`aciklama`,`hacim`,`marka`,`model`,`uretim_tarihi`,`tanim`,`sicaklik_alt_limit`,`sicaklik_ust_limit` FROM `stok_birim` WHERE id = $birim_id LIMIT 1";
			$this -> listele($query);
		}

		public function getStokById($birim_id){
			$query = "SELECT tag_id,ad,doz,kullanim_suresi FROM urun u WHERE u.id IN (SELECT urun_id FROM stok WHERE stokbirim_id = ".$birim_id.")";
			$this -> listele($query);
		}

		public function getSicaklikById($sensor_id){
			$query = "SELECT * FROM sicaklik WHERE sensor_id = $sensor_id";
			$this -> listele($query);
		}

		public function listele($query){
			$result = $this -> stokBirim -> listele($query);
			$list = array();

			while ($data = @mysqli_fetch_assoc($result)) {
				array_push($list,$data);
			}

			echo $this -> encodeJSON($list);
		}
	}

?>
