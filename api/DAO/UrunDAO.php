<?php

	/**
	* Sehir DAO
	*/

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/OrtakIslemler.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/jsonManager.php");

	class UrunDAO extends jsonManager
	{

		private $urunIslem;

		function __construct()
		{
			$this -> urunIslem = new OrtakIslem();
		}

		public function getUrunByTagOrName($tag_id,$urun_ad){
			$query = "SELECT u.id,u.ad,u.tag_id,ut.ad as 'TanimAd',u.kullanim_suresi,u.doz FROM urun u,uruntanim ut WHERE u.tanim_id = ut.id and u.tag_id LIKE '%".$tag_id."%' and u.ad LIKE '%".$urun_ad."%'";
			$this -> listele($query);
		}

		public function getUrunInfoById($urun_id){
			$query = "SELECT * FROM urun WHERE id = $urun_id";
			$this -> listele($query);
		}

		public function getSKTInfo($birimID){
			$query = "SELECT s.stokbirim_ad,s.tag_id as TagID,u.ad,u.kullanim_suresi FROM stok s,urun u WHERE s.urun_id = u.id and s.stokbirim_id IN (SELECT id FROM stok_birim WHERE stok_birim.birim_id = ".$birimID.")";
			$this -> listele($query);
		}

		public function listele($query){
			$result = $this -> urunIslem -> listele($query);
			$list = array();

			while ($data = @mysqli_fetch_assoc($result)) {
				array_push($list,$data);
			}

			echo $this -> encodeJSON($list);
		}
	}

?>
