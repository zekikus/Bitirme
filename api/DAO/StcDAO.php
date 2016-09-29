<?php
	
	/**
	* Sehir DAO
	*/

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/BirimIslemleri.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/jsonManager.php");

	class StcDAO extends jsonManager
	{

		private $stcIslem;
		
		function __construct()
		{
			$this -> stcIslem = new BirimIslemleri();
		}

		public function getStcById($stc_id){
			$query = "SELECT sc.*,sb.ad FROM sicakliktakipcihazi sc,stok_birim sb WHERE sc.stokbirim_id = sb.id and sc.id LIKE '%".$stc_id."%'";
			$this -> listele($query);
		}

		public function getStcSicaklikById($stc_id){
			$query = "SELECT sensor_id, sicaklik_deger, kayit_zamani, olcum_zamani FROM sicaklik WHERE sensor_id = $stc_id";
			$this -> listele($query);
		}

		public function listele($query){
			$result = $this -> stcIslem -> listele($query);
			$list = array();
			
			while ($data = @mysqli_fetch_assoc($result)) {
				array_push($list,$data);
			}

			echo $this -> encodeJSON($list);
		}
	}

?>