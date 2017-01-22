<?php
	
	/**
	* Sehir DAO
	*/

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/OrtakIslemler.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/jsonManager.php");

	class AlarmDAO extends jsonManager
	{

		private $alarmIslem;
		
		function __construct()
		{
			$this -> alarmIslem = new OrtakIslemler();
		}

		public function getAlarmByIdOrStcNo($alarm_no,$stc_no){
			$query = "SELECT a.id as 'aID', a.tip as 'aTip', b.il as 'bIl' , b.ilce as 'bIlce' , b.ad as 'bAd' , sb.id as 'sbID' , sb.sensor_id as 'sbStcID' FROM alarm a, birim b, stok_birim sb WHERE a.sensor_id=sb.sensor_id AND sb.birim_id=b.id AND (a.id LIKE '%".$alarm_no."%' OR sb.sensor_id LIKE '%".$stc_no."%')";
			$this -> listele($query);
		}

		public function listele($query){
			$result = $this -> alarmIslem -> listele($query);
			$list = array();
			
			while ($data = @mysqli_fetch_assoc($result)) {
				array_push($list,$data);
			}

			echo $this -> encodeJSON($list);
		}
	}

?>