<html>
<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/Kullanici.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/UyariAlici.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/Gozlemci.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/BirimGozlemci.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/UyariGozlemci.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/SmsUyariGozlemci.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/EmailUyariGozlemci.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/SicaklikUyari.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Gozlemci/AlarmUyariIslem.php");

	class Test2{
		private static $test;
		private static $uyariKonu;
		private static $islem;

		private function __construct(){
			echo "hOOP";
			self::$uyariKonu = new SicaklikUyari();
			self::$islem = new AlarmUyariIslem();
		}

		public static function getInstance(){
			if(NULL == self::$test)
				self::$test = new Test2();
			return self::$test;
		}

		public static function ekle($id){
			$sonuc = self::$islem -> listele("SELECT ad,soyad FROM kullanici WHERE birimID = (SELECT birim_id FROM stok_birim WHERE id = '".$id."')");
			$veri = mysqli_fetch_assoc($sonuc);

			$gozlemci = new BirimGozlemci(new Kullanici($veri['ad'],$veri['soyad'],"zkus@gmail.com"));
			
			$smsUyariGozlemci = new SmsUyariGozlemci();
			$mailUyariGozlemci = new EmailUyariGozlemci();

			$gozlemci -> ekle($smsUyariGozlemci);
			$gozlemci -> ekle($mailUyariGozlemci);

			self::$uyariKonu -> ekle($gozlemci);
			print_r(self::$uyariKonu -> getGozlemciler());
			echo "Ekledim";
		}

		public static function gonder(){
			self::$uyariKonu -> uyariGonder();
			$alici = UyariAlici::getInstance();
			$alici -> ExecuteAll();
		}
	}

	if(isset($_POST['temp'])){
		Test2::getInstance() -> ekle($_POST['temp']);
	}else if(isset($_GET['q'])){
		echo "Gonder";
		Test2::getInstance() -> gonder();
	}




	/*
	

	$alertFile = fopen("alert_time.txt", "a+");
	$alertSatir = fgets($alertFile);


	if(isset($_POST['temp'])){

		$temp = $_POST['temp'];
		$islem -> sorguCalistir("INSERT INTO `sicaklik`(`id`, `sensor_id`, `sicaklik_deger`, `kayit_zamani`, `olcum_zamani`) VALUES (NULL,'5','".$temp."','".date("d.m.Y H:i:s")."','".date("d.m.Y H:i:s")."')");

		if($temp > -5 && $temp < 5){
			

			$sonuc = $islem -> listele("SELECT ad,soyad FROM kullanici WHERE birimID = (SELECT birim_id FROM stok_birim WHERE id = '1')");
			$veri = mysqli_fetch_assoc($sonuc);

			$gozlemci = new BirimGozlemci(new Kullanici($veri['ad'],$veri['soyad'],"zkus@gmail.com"));
			
			$smsUyariGozlemci = new SmsUyariGozlemci();
			$mailUyariGozlemci = new EmailUyariGozlemci();

			$gozlemci -> ekle($smsUyariGozlemci);
			$gozlemci -> ekle($mailUyariGozlemci);

			$uyariKonu -> ekle($gozlemci);
			
		}

	}if(isset($_GET['q'])){
		
	}*/
	

	/*function gecenZamanHesapla($ilk_zaman){
		$now     = new DateTime();
		$created = new DateTime($ilk_zaman);
		$diff    = date_diff($now, $created);
		$second    = $diff->format('%s');

		return $second;
	}*/

	/*$gozlemci = new BirimGozlemci(new Kullanici("Zeki","Kuş","zkus@gmail.com"));
	$gozlemci2 = new BirimGozlemci(new Kullanici("Furkan","Kuş","zkus@gmail.com"));
	
	$smsUyariGozlemci = new SmsUyariGozlemci();
	$mailUyariGozlemci = new EmailUyariGozlemci();

	$gozlemci -> ekle($smsUyariGozlemci);
	$gozlemci -> ekle($mailUyariGozlemci);

	$gozlemci2 -> ekle($smsUyariGozlemci);

	$uyariKonu = new SicaklikUyari();
	$uyariKonu -> ekle($gozlemci);
	$uyariKonu -> ekle($gozlemci2);
	$uyariKonu -> uyariGonder();

	$alici = UyariAlici::getInstance();
	$alici -> ExecuteAll();*/

?>
<body>
	<form method="POST">
		<input type="text" name="temp" />
		<input type="submit" value="Gönder" />
		<a href="Test2.php?q=alarm">Alarm Gönder</a>
	</form>
</body>
</html>
