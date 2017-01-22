<?php
	
	/**
	* Sehir DAO
	*/

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/OrtakIslemler.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/jsonManager.php");

	class SehirDAO extends jsonManager
	{

		private $birimIslem;
		
		function __construct()
		{
			$this -> birimIslem = new OrtakIslem();
		}

		public function getAllSehir(){
			$query = "SELECT * FROM il";
			$this -> listele($query);
		}

		public function getIlceByID($il_id){
			$query = "SELECT * FROM ilce WHERE il_id = $il_id";
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