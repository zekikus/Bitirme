<?php
	
	/**
	* TuketimNedeni
	*/

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/BirimIslemleri.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/jsonManager.php");

	class TuketimNedeniDAO extends jsonManager
	{

		private $tuketimNedeniIslem;
		
		function __construct()
		{
			$this -> tuketimNedeniIslem = new BirimIslemleri();
		}

		public function getTuketimNedeniByName($tuketim_nedeni){
			$query = "SELECT * FROM tuketim_nedeni WHERE tanim LIKE '%".$tuketim_nedeni."%'";
			$this -> listele($query);
		}

		public function listele($query){
			$result = $this -> tuketimNedeniIslem -> listele($query);
			$list = array();
			
			while ($data = @mysqli_fetch_assoc($result)) {
				array_push($list,$data);
			}

			echo $this -> encodeJSON($list);
		}
	}

?>