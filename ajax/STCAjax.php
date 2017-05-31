<?php

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/STCKontrol.php");
	session_start();
	$myDefines = include("myDefines.php");
	$kontrol = new STCKontrol();

	if(isset($_POST['query'])){

		$query = @$_POST['query'];
		$deger = @$query["deger"];
		$islem = @$query["islem"];

		if($islem == "listele"){
			kayitListele($deger);
		}else if($islem == "sil"){
			kayitSil($deger);
			kayitListele("");
		}else if($islem == "kaydet"){
			kayitEkle($query);
			kayitListele("");
		}else if($islem == "guncelle"){
			kayitGuncelle($query);
			kayitListele("");
		}
		else if($islem == "sicaklikListele"){
			sicaklikListele($deger);
		}
		else{
			inputDoldur($deger);
		}
	}

	function inputDoldur($deger){
		global $kontrol;
		$sorgu = "SELECT cihaz_durum, alarm_uret FROM sicakliktakipcihazi WHERE id = $deger LIMIT 1";

		$sonuc = $kontrol -> listele($sorgu);

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			$cihaz = ($satir['cihaz_durum'] == 1) ? 'true' : 'false';
			$cihazDeger = ($cihaz == 'true') ? 1 : 0;
			$alarm = ($satir['alarm_uret'] == 1) ? 'true' : 'false';
			$alarmDeger = ($alarm == 'true') ? 1 : 0;
			echo "<script>
				$(document).ready(function(){
					$('#cihazAktif').prop('checked', $cihaz);
					$('#cihazAktif').val($cihazDeger);
					$('#alarmAktif').prop('checked', $alarm);
					$('#alarmAktif').val($alarmDeger);
					$('#kaydetSTC').val('Guncelle');
					$('#kaydetSTC').html('Guncelle');
				});
			</script>";
		}
		setcookie("stcID",$deger,time() + 30);
	}

	function kayitGuncelle($query){
		global $kontrol;
		$stokbirim_id = $query["stokbirim_id"];
		$cihaz_durum = $query["cihaz_durum"];
		$alarm_uret = $query["alarm_uret"];
		$id = $_COOKIE['stcID'];

		$sorgu = "UPDATE sicakliktakipcihazi SET stokbirim_id = '".$stokbirim_id."',cihaz_durum = '".$cihaz_durum."', alarm_uret = '".$alarm_uret."' WHERE id = $id";
		$kontrol -> duzenle($sorgu,"guncelle");
		$kontrol -> sorguCalistir("UPDATE stok_birim SET sensor_id = ".$id." WHERE id = $stokbirim_id");

		echo "<script>
			$(document).ready(function(){
				$('#kaydetSTC').val('');
				$('#kaydetSTC').html('Kaydet');
			});
		</script>";
	}

	function kayitEkle($query){
		global $kontrol;
		$stokbirim_id = $query["stokbirim_id"];
		$cihaz_durum = $query["cihaz_durum"];
		$alarm_uret = $query["alarm_uret"];

		$sorgu = "INSERT INTO `sicakliktakipcihazi` (`id`, `stokbirim_id`, `cihaz_durum`, `alarm_uret`) VALUES (NULL, '".$stokbirim_id."', '".$cihaz_durum."', '".$alarm_uret."')";
		$kontrol -> kaydet($sorgu);

		$sonuc = $kontrol -> listele("SELECT id FROM sicakliktakipcihazi ORDER BY id DESC LIMIT 0,1");
		$sonSID = mysqli_fetch_assoc($sonuc);

		echo "<script>alert('".$sonSID['id']."')</script>";

		$kontrol -> sorguCalistir("UPDATE stok_birim SET sensor_id = ".$sonSID['id']." WHERE id = $stokbirim_id");

	}

	function kayitSil($deger){
		global $kontrol;
		$sorgu = "DELETE FROM sicakliktakipcihazi WHERE id = $deger";

		$kontrol -> duzenle($sorgu,"sil");
	}

	function kayitListele($deger){

		global $kontrol,$myDefines;
		$sonuc = $kontrol -> listele("SELECT sc.*,sb.ad,sb.birim_id FROM sicakliktakipcihazi sc,stok_birim sb WHERE sc.stokbirim_id = sb.id and sc.id LIKE '%".$deger."%'");

		echo "<table class='table table-striped'>
				<tr>";
					foreach ($myDefines["stcHeaderNames"] as $headerName) {
						echo "<th>".$headerName."</th>";
					}
		echo	"</tr>";
		while ($satir = mysqli_fetch_assoc($sonuc)) {

			$cihaz = ($satir["cihaz_durum"] == 1) ? "Aktif" : 'Aktif Değil';
			$alarm = ($satir["alarm_uret"] == 1) ? "Aktif" : 'Aktif Değil';
			echo "<tr>";
					foreach ($myDefines["stcColNames"] as $colName) {
						echo "<td>".$satir[$colName]."</td>";
					}
			echo   "<td>".$alarm."</td>
					<td>".$cihaz."</td>
					<td>";
						$session_Birim = $_SESSION["kullanici"];
						if($session_Birim == $satir["birim_id"] || $session_Birim == -1){
							echo "<button id='detayBtn' onclick=\"ajaxIslemYap(this,'sicaklikListele','#detaySicaklik','STCAjax');\" value=".$satir["id"].">Detay</button>
							<button id='upBtn' onclick=\"ajaxInputDoldur(this,'STCAjax');\" value=".$satir["id"].">Guncelle</button>
							<button id='silBtn' onclick=\"ajaxSil(this,'STCAjax');\" value=".$satir["id"].">Sil</button>";
						}
					"</td>
				</tr>
			";
		}
		echo "</table>";
	}

	function sicaklikListele($deger){
		global $kontrol,$myDefines;
		echo "<script>
				$('#sicaklikDetay').css({
		           'overlay' : '0.6',
		           'top' : '50px'
		        });
		    	$('#sicaklikDetay').toggle();
		    	alert(".$deger.")</script>";

		$sonuc = $kontrol -> listele("SELECT sensor_id, sicaklik_deger, kayit_zamani FROM sicaklik WHERE sensor_id = $deger");

		echo "<table class='table table-striped'>
				<tr>";
					foreach ($myDefines["stcSicaklikHeaderNames"] as $headerName) {
						echo "<th>".$headerName."</th>";
					}
		echo	"</tr>";
		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<tr>";
				foreach ($myDefines["stcSicaklikColNames"] as $colName) {
					echo "<td>".$satir[$colName]."</td>";
				}
			echo "</tr>";
		}
		echo "</table>";
	}
?>
