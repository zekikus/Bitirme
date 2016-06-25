<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/StokBirimKontrol.php");

	if(isset($_POST['query'])){

		$query = @$_POST['query'];
		$deger = @$query["deger"];
		$islem = @$query["islem"];

		if($islem == "listele"){
			kayitListele($query);
		}else if($islem == "sil"){
			kayitSil($deger);
		}else if($islem == "kaydet"){
			kayitEkle($query);
		}else if($islem == "guncelle"){
			kayitGuncelle($query);
		}else if($islem == "ilceGetir"){
			ilceGetir($query);
		}else if($islem == "birimGetir"){
			birimGetir($query);
		}else if($islem == "stokListele"){
			stokListele($query);
		}else if($islem == "sicaklikListele"){
			sicaklikListele($query);
		}
		else{
			inputDoldur($deger);
		}
	}

	function inputDoldur($deger){

		$kullanici1 = "";
		$kullanici2 = "";
		$sayac = 1;

		$kontrol = new StokBirimKontrol();
		$sorgu = "SELECT * FROM stok_birim WHERE id = $deger LIMIT 1";
		
		$sonuc = $kontrol -> listele($sorgu);
		
		$sonuc1 = $kontrol -> listele("SELECT k.ad,k.soyad FROM kullanici k,stok_birim sb WHERE k.birimID = sb.birim_id and sb.id = $deger");

		while($ySatir = mysqli_fetch_assoc($sonuc1)){
			if($sayac == 1)
				$kullanici1 = $ySatir['ad']." ".$ySatir['soyad'];
			else
				$kullanici2 = $ySatir['ad']." ".$ySatir['soyad'];
			$sayac++;
		}
		

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<script>
				$(document).ready(function(){
					$('.nav-tabs a[href=\"#stokBirimPanel\"]').tab('show');
					$('#stLink,#siLink').show();
					$('#panelBirim').val($('#sInput option:selected').text());
					$('#panelSBirim').val('".$satir['ad']."');
					$('#birimDeger').val('".$satir['birim_id']."');
					$('#birimDeger').attr('disabled','true');
					$('#sbID').val('".$satir['id']."');
					$('#stokBirimID').val('".$satir['ad']."');
					$('#sAlt').val('".$satir['sicaklik_alt_limit']."');
					$('#sUst').val('".$satir['sicaklik_ust_limit']."');
					$('#uyariUser1').val('".$kullanici1."');
					$('#uyariUser2').val('".$kullanici2."');
					$('#sbTip').val('".$satir['tanim']."');
					$('#sbAciklama').val('".$satir['aciklama']."');
					$('#sbHacim').val('".$satir['hacim']."');
					$('#sbMarka').val('".$satir['marka']."');
					$('#sbModel').val('".$satir['model']."');
					$('#sbUT').val('".$satir['uretim_tarihi']."');
					$('#kaydetSB').val('Guncelle');
					$('#kaydetSB').html('Guncelle');
				});
			</script>";
		}
	}

	function kayitGuncelle($query){
		
		$sorgu = "UPDATE stok_birim SET sicaklik_alt_limit = '".$query['sAlt']."',sicaklik_ust_limit = '".$query['sUst']."', tanim = '".$query['sbTip']."',aciklama = '".$query['sbAciklama']."',hacim = '".$query['sbHacim']."',marka = '".$query['sbMarka']."',model = '".$query['sbModel']."',uretim_tarihi = '".$query['sbUT']."' WHERE id = ".$query['sbID']."";
		
		$kontrol = new StokBirimKontrol();
		$kontrol -> duzenle($sorgu,"guncelle");

		echo "<script>
			$(document).ready(function(){
				$('#kaydetSB').val('');
				$('#kaydetSB').html('Kaydet');
			});
		</script>";
	}

	function kayitEkle($query){

		$sorgu = "INSERT INTO `stok_birim`(`id`, `ad`, `birim_id`, `aciklama`, `hacim`, `marka`, `model`, `uretim_tarihi`, `tanim`, `sicaklik_alt_limit`, `sicaklik_ust_limit`) VALUES (NULL,'".$query['stokBirimID']."',".$query['birimDeger'].",'".$query['sbAciklama']."','".$query['sbHacim']."','".$query['sbMarka']."','".$query['sbModel']."','".$query['sbUT']."','".$query['sbTip']."','".$query['sAlt']."','".$query['sUst']."')";

		$kontrol = new StokBirimKontrol();
		$kontrol -> kaydet($sorgu);

	}

	function kayitSil($deger){

		$sorgu = "DELETE FROM stok_birim WHERE id = $deger";

		$kontrol = new StokBirimKontrol();
		$kontrol -> duzenle($sorgu,"sil");
	}

	function kayitListele($query){

		$kontrol = new StokBirimKontrol();
		$sonuc = $kontrol -> listele("SELECT id,ad,tanim,aciklama,hacim FROM stok_birim WHERE birim_id = ".$query['deger']."");

		echo "<table class='table table-striped'>
		<tr>
					<th>Stok Birim ID</th>
					<th>Stok Birim Tipi</th>
					<th>Açıklama</th>
					<th>Hacim</th>
					<th>Islemler</th>
				</tr>

		";
		while ($satir = mysqli_fetch_assoc($sonuc)) {

			echo "
				<tr>
					<td>".$satir["ad"]."</td>
					<td>".$satir["tanim"]."</td>
					<td>".$satir["aciklama"]."</td>
					<td>".$satir["hacim"]."</td>
					<td>
						<button id='upBtn' onclick=\"ajaxInputDoldur(this,'stokBirimAjax');\" value=".$satir["id"].">Guncelle</button>
						<button id='silBtn' onclick=\"ajaxSil(this,'stokBirimAjax');\" value=".$satir["id"].">Sil</button>
					</td>
				</tr>
			";
		}
		echo "</table>";
	}

	function stokListele($query){

		$kontrol = new StokBirimKontrol();
		$sonuc = $kontrol -> listele("SELECT tag_id,ad,doz,kullanim_suresi FROM urun u WHERE u.id IN (SELECT urun_id FROM stok WHERE stokbirim_id = ".$query['deger'].")");

		echo "<table class='table table-striped'>
		<tr>
					<th>Ürün No</th>
					<th>Ürün Adı</th>
					<th>Doz</th>
					<th>Son Kullanma Tarihi</th>
				</tr>

		";
		while ($satir = mysqli_fetch_assoc($sonuc)) {

			echo "
				<tr>
					<td>".$satir["tag_id"]."</td>
					<td>".$satir["ad"]."</td>
					<td>".$satir["doz"]."</td>
					<td>".$satir["kullanim_suresi"]."</td>
				</tr>
			";
		}
		echo "</table>";
	}

	function sicaklikListele($query){

		$kontrol = new StokBirimKontrol();
		$sonuc = $kontrol -> listele("SELECT * FROM sicaklik WHERE sensor_id IN (SELECT sensor_id FROM stok_birim WHERE id = ".$query['deger'].")");

		echo "<table class='table table-striped'>
		<tr>
					<th>Sensör ID</th>
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

	function ilceGetir($query){

		$il = $query["deger"];

		$sorgu = "SELECT * FROM ilce WHERE il_id = $il";
		$kontrol = new StokBirimKontrol();
		$sonuc = $kontrol -> listele($sorgu);
		
		echo "<label>Stok Birim İlçe:</label>
			  <select id='stokIlce' value='' onchange=\"ajaxBirimGetir('#biSonuc','#stokIl','#stokIlce','stokBirimAjax')\">";
			  	echo "<option id='ilkIlce'></option>";
				while ($satir = mysqli_fetch_assoc($sonuc)){
						echo "<option value=".$satir["id"].">".$satir["ad"]."</option>";
			  	}
			echo "</select><br/>";
	}

	function birimGetir($query){
		$il = $query['il'];
		$ilce = $query['ilce'];

		$sorgu = "SELECT id,ad FROM birim WHERE il = '".$il."' and ilce = '".$ilce."' ";
		$kontrol = new StokBirimKontrol();
		$sonuc = $kontrol -> listele($sorgu);
		
		echo "<label>Birim:</label>
			  <select id='sInput' value=''>";
			  echo "<option id='ilkBirim'></option>";
				while ($satir = mysqli_fetch_assoc($sonuc)){
						echo "<option value=".$satir["id"].">".$satir["ad"]."</option>";
			  	}
			echo "</select><a onclick=\"ajaxListele('stokBirimAjax');\"><span class='glyphicon glyphicon-list'></span></a><br/>";
	}
?>