<?php
	
	/**
	* Sehir DAO
	*/

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/OrtakIslemler.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/jsonManager.php");

	class UreticiDAO extends jsonManager
	{

		private $ureticiIslem;
		
		function __construct()
		{
			$this -> ureticiIslem = new OrtakIslem();
		}
		
		public function getUreticiByName($uretici_ad){
			$query = "SELECT * FROM uretici WHERE ad LIKE '%".$uretici_ad."%'";
			$this -> listele($query);
		}

		public function getUreticiById($uretici_id){
			$query = "SELECT * FROM uretici WHERE id = '$uretici_id'";
			$this -> listele($query);
		}

		public function listele($query){
			$result = $this -> ureticiIslem -> listele($query);
			$list = array();
			
			while ($data = @mysqli_fetch_assoc($result)) {
				array_push($list,$data);
			}

			echo $this -> encodeJSON($list);
		}
	}

?>