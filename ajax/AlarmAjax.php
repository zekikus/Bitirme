<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/AlarmKontrol.php");


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
		$kontrol = new AlarmKontrol();
		$sorgu = "SELECT a.id as 'aID', a.tip as 'aTip', b.il as 'bIl' , b.ilce as 'bIlce' , b.ad as 'bAd' , sb.id as 'sbID' , sb.sensor_id as 'sbStcID' FROM alarm a, birim b, stok_birim sb WHERE a.sensor_id=sb.sensor_id AND sb.birim_id=b.id AND (a.id LIKE '%".$query['deger']."%' OR sb.sensor_id LIKE '%".$query['deger1']."%')";
		$sonuc = $kontrol -> listele($sorgu);

		echo "<table class='table table-striped'>
		<tr>
					<th>Alarm No</th>
					<th>İl</th>
					<th>İlçe</th>
					<th>Depo</th>
					<th>Stok BirimNo</th>
					<th>STC No</th>
					<th>Alarm Tipi</th>
					<th>Detay</th>
				</tr>

		";
		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "
				<tr>
					<td>".$satir["aID"]."</td>
					<td>".$satir["bIl"]."</td>
					<td>".$satir["bIlce"]."</td>
					<td>".$satir["bAd"]."</td>
					<td>".$satir["sbID"]."</td>
					<td>".$satir["sbStcID"]."</td>
					<td>".$satir["aTip"]."</td>
					<td>
						<button id='detayBtn' onclick=\"ajaxAlarmDetayListele(this,'AlarmAjax');\" value=".$satir["aID"].">Detay</button>
					</td>
				</tr>
			";
		}
		echo "</table>";
	}

	function alarmListele($deger){

		$kontrol = new AlarmKontrol();
		$sorgu = "SELECT a.id as 'aID', a.tip as 'aTip', a.baslangic_zaman as 'basZaman', a.bitis_zaman as 'bitZaman' , b.id as 'bID' , b.il as 'bIl' , b.ilce as 'bIlce' , b.ad as 'bAd' , sb.id as 'sbID' , sb.sensor_id as 'sbStcID' FROM alarm a, birim b, stok_birim sb WHERE a.sensor_id=sb.sensor_id AND sb.birim_id=b.id";
		$sonuc = $kontrol -> listele($sorgu);

		echo "<table class='table table-striped' style='width:100%'>
		<tr>
			<th>Alarm No</th>
			<th>Alarm Tipi</th>
			<th>Alarm Başlangıç Zamanı</th>
			<th>Alarm Bitiş Zamanı</th>
			<th>Birim İl</th>
			<th>Birim İlçe</th>
			<th>Birim No</th>
			<th>Birim Ad</th>
			<th>Stok Birim No</th>
			<th>STC No</th>
		</tr>

		";
		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "
				<tr>
					<td>".$satir["aID"]."</td>
					<td>".$satir["aTip"]."</td>
					<td>".$satir["basZaman"]."</td>
					<td>".$satir["bitZaman"]."</td>
					<td>".$satir["bIl"]."</td>
					<td>".$satir["bIlce"]."</td>
					<td>".$satir["bID"]."</td>
					<td>".$satir["bAd"]."</td>
					<td>".$satir["sbID"]."</td>
					<td>".$satir["sbStcID"]."</td>
				</tr>
			";
		}
		echo "</table>";
	}
?>