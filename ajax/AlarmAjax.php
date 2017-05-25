<?php

	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/AlarmKontrol.php");
	$myDefines = include("myDefines.php");

	if(isset($_POST['query'])){

		$query = @$_POST['query'];
		$deger = @$query["deger"];
		//$degerID = @$query["degerID"];
		//$degerStcID = @$query["degerStcID"];
		$islem = @$query["islem"];

		if($islem == "listele"){
			kayitListele($query);
		}	else if($islem == "kaydet"){
			kaydet($query);
		}else if($islem == "sil"){
			kayitSil($deger);
		}else if($islem == "guncelle"){
			kayitGuncelle($query);
		}
		else{
			inputDoldur($deger);
		}
	}

	function kaydet($query){
			$kontrol = new AlarmKontrol();
			$durum = ($query['durum'] == 1) ? "Aktif" : "Aktif Değil";
			$sorgu = "INSERT INTO `alarm`(`sensor_id`, `tip`, `baslangic_zaman`, `bitis_zaman`, `durum`) VALUES ('".$query['stc_id']."','Sıcaklık','".$query['startTime']."','".$query['endTime']."','".$durum."')";
			$sonuc = $kontrol -> kaydet($sorgu);
	}

	function kayitSil($deger){
			$kontrol = new AlarmKontrol();
			$sorgu = "DELETE FROM alarm WHERE id = $deger";
			$kontrol -> duzenle($sorgu,"sil");
	}

	function inputDoldur($deger){

		$sorgu = "SELECT id,sensor_id,baslangic_zaman,bitis_zaman,durum FROM alarm WHERE id = $deger LIMIT 1";
		$kontrol = new AlarmKontrol();
		$sonuc = $kontrol -> listele($sorgu);

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			$durum = ($satir['durum'] == "Aktif") ? 1 : 0;
			echo "<script>
				$(document).ready(function(){
					$('#stcID option[value=".$satir['sensor_id']."]').attr('selected','selected');
					$('#durum option[value=".$durum."]').attr('selected','selected');
					$('#alarmID').val('".$satir['id']."');
					$('#startTime').val('".$satir['baslangic_zaman']."');
					$('#endTime').val('".$satir['bitis_zaman']."');
					$('#kaydetAlarm').val('Guncelle');
					$('#kaydetAlarm').html('Guncelle');
				});
			</script>";
		}
	}

	function kayitGuncelle($query){
		$stc_id = $query["stc_id"];
		$startTime = $query["startTime"];
		$endTime = $query["endTime"];

		$sorgu = "UPDATE alarm SET sensor_id = '".$stc_id."',baslangic_zaman = '".$startTime."',bitis_zaman = '".$endTime."',durum = '".$query['durum']."' WHERE id = '".$query['id']."'";
		$kontrol = new AlarmKontrol();
		$kontrol -> duzenle($sorgu,"guncelle");

		echo "<script>
			$(document).ready(function(){
				$('#kaydetAlarm').val('');
				$('#kaydetAlarm').html('Kaydet');
			});
		</script>";
	}

	function kayitListele($query){
		global $myDefines;
		$kontrol = new AlarmKontrol();
		$sorgu = "SELECT a.id as 'aID', a.tip as 'aTip', b.il as 'bIl' , b.ilce as 'bIlce' , b.ad as 'bAd' , sb.id as 'sbID' , sb.sensor_id as 'sbStcID' FROM alarm a, birim b, stok_birim sb WHERE a.sensor_id=sb.sensor_id AND sb.birim_id=b.id AND (a.id LIKE '%".$query['deger']."%' and sb.sensor_id LIKE '%".$query['deger1']."%')";
		$sonuc = $kontrol -> listele($sorgu);

		echo "<table class='table table-striped'>
				<tr>";
					foreach ($myDefines["alarmHeaderNames"] as $headerName) {
						echo "<th>".$headerName."</th>";
					}
		echo	"</tr>";
		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<tr>";
					foreach ($myDefines["alarmColNames"] as $colName) {
						echo "<td>".$satir[$colName]."</td>";
					}
			echo	"<td>
						<button id='detayBtn' onclick=\"ajaxAlarmDetayListele(this,'AlarmAjax');\" value=".$satir["aID"].">Detay</button>
						<button id='upBtn' onclick=\"ajaxInputDoldur(this,'AlarmAjax');\" value=".$satir["aID"].">Guncelle</button>
						<button id='silBtn' onclick=\"ajaxSil(this,'AlarmAjax');\" value=".$satir["aID"].">Sil</button>
					</td>
				</tr>
			";
		}
		echo "</table>";
	}

	function alarmListele($deger){

		global $myDefines;
		$kontrol = new AlarmKontrol();
		$sorgu = "SELECT * FROM alarm";
		$sonuc = $kontrol -> listele($sorgu);

		echo "<table class='table table-striped' style='width:100%'>
				<tr>";
					foreach ($myDefines["alarmDetayHeaderNames"] as $headerName) {
						echo "<th>".$headerName."</th>";
					}
		echo 	"</tr>";
		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<tr>";
					foreach ($myDefines["alarmDetayColNames"] as $colName) {
						echo "<td>".$satir[$colName]."</td>";
					}
			echo  "</tr>";
		}
		echo "</table>";
	}
?>
