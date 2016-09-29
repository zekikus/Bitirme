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


	$uyariKonu = new SicaklikUyari();
	$islem = new AlarmUyariIslem();

	$sonuc = $islem -> listele("SELECT sensor_id,kayit_zamani FROM tehlikeli_sicaklik LIMIT 1");
	$satir = mysqli_fetch_assoc($sonuc);
	$ilkOlcum = $satir['kayit_zamani'];

	if(gecenZamanHesapla($ilkOlcum) > 20){

		$sonuc = $islem -> listele("SELECT DISTINCT(sensor_id) FROM tehlikeli_sicaklik");
		while ($satir = mysqli_fetch_assoc($sonuc)) {
			$kSonuc = $islem -> listele("SELECT ad,soyad FROM kullanici WHERE birimID = (SELECT birim_id FROM stok_birim WHERE sensor_id = '".$satir['sensor_id']."' LIMIT 1 )");

			while ($kSatir = mysqli_fetch_assoc($kSonuc)) {
				$gozlemci = new BirimGozlemci(new Kullanici($kSatir['ad'],$kSatir['soyad'],"zkus@gmail.com"));
				
				//$smsUyariGozlemci = new SmsUyariGozlemci();
				$mailUyariGozlemci = new EmailUyariGozlemci();

				//$gozlemci -> ekle($smsUyariGozlemci);
				$gozlemci -> ekle($mailUyariGozlemci);

				$uyariKonu -> ekle($gozlemci);
			}
		}

		$uyariKonu -> uyariGonder();
		$alici = UyariAlici::getInstance();
		$alici -> ExecuteAll();

		$islem -> sil("DELETE FROM tehlikeli_sicaklik");
	}else{
		if(isset($_POST['temp'])){

			$temp = $_POST['temp'];
			
			if($temp > -5 && $temp < 5){
				$islem -> sorguCalistir("INSERT INTO `tehlikeli_sicaklik`(`id`, `sensor_id`, `sicaklik_deger`, `kayit_zamani`, `olcum_zamani`) VALUES (NULL,'".$temp."','".$temp."','".date("d.m.Y H:i:s")."','".date("d.m.Y H:i:s")."')");
			}else{
				$islem -> sorguCalistir("INSERT INTO `sicaklik`(`id`, `sensor_id`, `sicaklik_deger`, `kayit_zamani`, `olcum_zamani`) VALUES (NULL,'5','".$temp."','".date("d.m.Y H:i:s")."','".date("d.m.Y H:i:s")."')");
			}
		}
	}

	function gecenZamanHesapla($ilk_zaman){
		$now     = new DateTime();
		$created = new DateTime($ilk_zaman);
		$diff    = date_diff($now, $created);
		$second    = $diff->format('%s');

		return $second;
	}

?>
<body>
	<form method="POST">
		<input type="text" name="temp" />
		<input type="submit" value="Ekle"/>
		<a href="Test.php?q=alarm">Alarm Gönder</a>
	</form>
</body>
</html>
