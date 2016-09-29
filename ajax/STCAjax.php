<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/STCKontrol.php");


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

		$sorgu = "SELECT cihaz_durum, alarm_uret FROM sicakliktakipcihazi WHERE id = $deger LIMIT 1";
		
		$kontrol = new STCKontrol();
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
		$stokbirim_id = $query["stokbirim_id"];
		$cihaz_durum = $query["cihaz_durum"];
		$alarm_uret = $query["alarm_uret"];
		$id = $_COOKIE['stcID'];
		
		$sorgu = "UPDATE sicakliktakipcihazi SET stokbirim_id = '".$stokbirim_id."',cihaz_durum = '".$cihaz_durum."', alarm_uret = '".$alarm_uret."' WHERE id = $id";
		$kontrol = new STCKontrol();
		$kontrol -> duzenle($sorgu,"guncelle");

		echo "<script>
			$(document).ready(function(){
				$('#kaydetSTC').val('');
				$('#kaydetSTC').html('Kaydet');
			});
		</script>";
	}

	function kayitEkle($query){

		$stokbirim_id = $query["stokbirim_id"];
		$cihaz_durum = $query["cihaz_durum"];
		$alarm_uret = $query["alarm_uret"];


		$sorgu = "INSERT INTO `sicakliktakipcihazi` (`id`, `stokbirim_id`, `cihaz_durum`, `alarm_uret`) VALUES (NULL, '".$stokbirim_id."', '".$cihaz_durum."', '".$alarm_uret."')";

		$kontrol = new STCKontrol();
		$kontrol -> kaydet($sorgu);

		$sonuc = $kontrol -> listele("SELECT id FROM sicakliktakipcihazi ORDER BY id DESC LIMIT 0,1");
		$sonSID = mysqli_fetch_assoc($sonuc);

		echo "<script>alert('".$sonSID['id']."')</script>";

		$kontrol -> sorguCalistir("UPDATE stok_birim SET sensor_id = ".$sonSID['id']." WHERE id = $stokbirim_id");

	}

	function kayitSil($deger){

		$sorgu = "DELETE FROM sicakliktakipcihazi WHERE id = $deger";

		$kontrol = new STCKontrol();
		$kontrol -> duzenle($sorgu,"sil");
	}

	function kayitListele($deger){

		$kontrol = new STCKontrol();
		$sonuc = $kontrol -> listele("SELECT sc.*,sb.ad FROM sicakliktakipcihazi sc,stok_birim sb WHERE sc.stokbirim_id = sb.id and sc.id LIKE '%".$deger."%'");

		echo "<table class='table table-striped'>
		<tr>
					<th>Cihaz ID</th>
					<th>Stok Birim</th>
					<th>Alarm Üret</th>
					<th>Cihaz Durum</th>
					<th>Islemler</th>
				</tr>

		";
		while ($satir = mysqli_fetch_assoc($sonuc)) {

			$cihaz = ($satir["cihaz_durum"] == 1) ? "Aktif" : 'Aktif Değil';
			$alarm = ($satir["alarm_uret"] == 1) ? "Aktif" : 'Aktif Değil';
			echo "
				<tr>
					<td>".$satir["id"]."</td>
					<td>".$satir["ad"]."</td>
					<td>".$alarm."</td>
					<td>".$cihaz."</td>
					<td>
						<button id='detayBtn' onclick=\"ajaxIslemYap(this,'sicaklikListele','#detaySicaklik','STCAjax');\" value=".$satir["id"].">Detay</button>
						<button id='upBtn' onclick=\"ajaxInputDoldur(this,'STCAjax');\" value=".$satir["id"].">Guncelle</button>
						<button id='silBtn' onclick=\"ajaxSil(this,'STCAjax');\" value=".$satir["id"].">Sil</button>
					</td>
				</tr>
			";
		}
		echo "</table>";
	}

	function sicaklikListele($deger){

		echo "<script>
				$('#sicaklikDetay').css({
		           'overlay' : '0.6',
		           'top' : '50px'
		        });
		    	$('#sicaklikDetay').toggle();
		    	alert(".$deger.")</script>";

		$kontrol = new STCKontrol();
		$sonuc = $kontrol -> listele("SELECT sensor_id, sicaklik_deger, kayit_zamani, olcum_zamani FROM sicaklik WHERE sensor_id = $deger");

		echo "<table class='table table-striped'>
		<tr>
					<th>Cihaz ID</th>
					<th>Sıcaklık Değer</th>
					<th>Kayıt Zamanı</th>
					<th>Ölçüm Zamanı</th>
				</tr>

		";
		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "
				<tr>
					<td>".$satir["sensor_id"]."</td>
					<td>".$satir["sicaklik_deger"]."</td>
					<td>".$satir["kayit_zamani"]."</td>
					<td>".$satir["olcum_zamani"]."</td>
				</tr>
			";
		}
		echo "</table>";
	}

	//onclick="test('this','dolapTipiAjax');"
?>