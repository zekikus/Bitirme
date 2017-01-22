<?php
	
	/**
	* 
	*/
	class jsonManager
	{
		public function encodeJSON($list){
			header('Content-Type: application/json; charset=utf-8');
			$result = (count($list) > 0) ? json_encode($list,JSON_UNESCAPED_UNICODE) : '[{"result":"error"}]';
			return "{\"results\":".$result."}";
		}
	}

?>