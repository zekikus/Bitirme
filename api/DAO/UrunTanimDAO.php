<?php
	
	/**
	* Sehir DAO
	*/

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/OrtakIslemler.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/jsonManager.php");

	class UrunTanimDAO extends jsonManager
	{

		private $urunTanimIslem;
		
		function __construct()
		{
			$this -> urunTanimIslem = new OrtakIslem();
		}

		public function getUrunTanimByName($urun_tanim_ad){
			$query = "SELECT * FROM uruntanim WHERE ad LIKE '%".$urun_tanim_ad."%'";
			$this -> listele($query);
		}

		public function listele($query){
			$result = $this -> urunTanimIslem -> listele($query);
			$list = array();
			
			while ($data = @mysqli_fetch_assoc($result)) {
				array_push($list,$data);
			}

			echo $this -> encodeJSON($list);
		}
	}

?>