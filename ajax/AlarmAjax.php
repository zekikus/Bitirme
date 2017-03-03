<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/AlarmKontrol.php");
	$myDefines = include("myDefines.php");

	if(isset($_POST['query'])){

		$query = @$_POST['query'];
		$degerID = @$query["degerID"];
		$degerStcID = @$query["degerStcID"];
		$islem = @$query["islem"];

		if($islem == "listele"){
			kayitListele($query);
		}	
		else{
			alarmListele($degerID);
		}
	}

	function kayitListele($query){
		global $myDefines;
		$kontrol = new AlarmKontrol();
		$sorgu = "SELECT a.id as 'aID', a.tip as 'aTip', b.il as 'bIl' , b.ilce as 'bIlce' , b.ad as 'bAd' , sb.id as 'sbID' , sb.sensor_id as 'sbStcID' FROM alarm a, birim b, stok_birim sb WHERE a.sensor_id=sb.sensor_id AND sb.birim_id=b.id AND (a.id LIKE '%".$query['deger']."%' OR sb.sensor_id LIKE '%".$query['deger1']."%')";
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