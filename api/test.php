<?php	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/BirimIslemleri.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/api/jsonManager.php");

	class PostTest extends jsonManager
	{

		private $alarmIslem;
		
		function __construct()
		{
			$this -> alarmIslem = new BirimIslemleri();
		}

		public function kayitEkle($query){
			$result = $this -> alarmIslem -> sorguCalistir($query);
			echo $this -> encodeJSON(array(array("islem" => "Basarili")));
		}
	}

	if(isset($_POST["ilID"])){
		$manager = new PostTest();
		
		$ilID = $_POST["ilID"];
		$ilAd = $_POST["ilAd"];
		
		$sorgu = "INSERT INTO `il`(`id`, `ad`) VALUES (".$ilID.",'".$ilAd."')";
		$manager -> kayitEkle($sorgu);
	}else{
		$manager = new PostTest();
		
		$sorgu = "INSERT INTO `il`(`id`, `ad`) VALUES (22,'zxczxc')";
		$manager -> kayitEkle($sorgu);
	}
	

?>