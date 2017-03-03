<?php
	
	/**
	* Dolap Tipi DAO
	*/

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/OrtakIslemler.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/jsonManager.php");

	class DolapTipiDAO extends jsonManager
	{

		private $dolapTipiIslem;
		
		function __construct()
		{
			$this -> dolapTipiIslem = new OrtakIslem();
		}

		public function getDolapTipiByName($dolap_ad){
			$query = "SELECT * FROM dolap_tip WHERE ad LIKE '%".$dolap_ad."%'";
			$this -> listele($query);
		}
		
		public function getDolapTipiById($dolap_id){
			$query = "SELECT * FROM dolap_tip WHERE id LIKE '".$dolap_id."'";
			$this -> listele($query);
		}

		public function listele($query){
			$result = $this -> dolapTipiIslem -> listele($query);
			$list = array();
			
			while ($data = @mysqli_fetch_assoc($result)) {
				array_push($list,$data);
			}

			echo $this -> encodeJSON($list);
		}
	}

?>
