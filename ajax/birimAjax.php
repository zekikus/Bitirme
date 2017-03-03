<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/BirimKontrol.php");
	session_start();

	$myDefines = include("myDefines.php");

	if(isset($_POST['query'])){

		$query = @$_POST['query'];
		$deger = @$query["deger2"];
		$deger1 = @$query["deger3"];
		$islem = @$query["islem"];

		if($islem == "listele")
			kayitListele($deger,$deger1);
		else if($islem == "sil")
			kayitSil($query["deger"]);
		else if($islem == "kaydet")
			kayitEkle($query);
		else if($islem == "guncelle")
			kayitGuncelle($query);
		else if($islem == "ilceGetir")
			ilceGetir($query);
		else if($islem == "stokForm")
			formGetir($query);
		else if($islem == "kullaniciForm")
			kullaniciFormGetir($query);
		else
			inputDoldur($query["deger"]);
		
	}

	function inputDoldur($deger){

		$sorgu = "SELECT * FROM birim WHERE id = $deger LIMIT 1";
		
		$kontrol = new BirimKontrol();
		$sonuc = $kontrol -> listele($sorgu);

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<script>
				$(document).ready(function(){
					$('#stokLink').show();
    				$('#kullaniciLink').show();
    				$('#kullanici1 select').val('0');
					$('#kullanici2 select').val('0');
					$('#birimID').val('".$satir['id']."');
					$('#ad').val('".$satir['ad']."');
					$('#birimIl select').prop('disabled','disabled');
					$('#birimIl select #ilkOpt').prop('selected','true').text('".$satir['il']."');
					$('#birimIlce').html('<label>Birim İlce :</label> <select><option>".$satir["ilce"]."</option></select>');
					$('#birimIlce select').prop('disabled','disabled');
					$('#birimAdres').val('".$satir['adres']."');
					$('#kaydetBT').val('Guncelle');
					$('#kaydetBT').html('Guncelle');
				});
			</script>";
		}

		$sorgu = "SELECT b.*,k.id as 'kullaniciID' FROM birim b,kullanici k WHERE b.id = k.birimID and b.id = $deger";
		$sonuc = $kontrol -> listele($sorgu);
		$etkilenenKayitlar = $kontrol -> etkilenenKayitSayisi($sorgu);

		if($etkilenenKayitlar > 0){
			$sayac = 1;
			while ($satir = mysqli_fetch_assoc($sonuc)) {
				echo "<script>
				$(document).ready(function(){
					$('#kullanici".$sayac." select').val('".$satir['kullaniciID']."');
				});
				</script>";
			$sayac++;
			}
		}else{
			echo "<script>
				$(document).ready(function(){
					$('#kullanici1 #firstOpt,#kullanici2 #firstOpt').attr('selected','true');
				});
				</script>";
		}
		
		setcookie("birimID",$deger,time() + 30);
	}

	function kayitGuncelle($query){
		$ad = $query["ad"];
		$birimIl = $query["birimIl"];
		$birimIlce = $query["birimIlce"];
		$birimAdres = $query["birimAdres"];
		$kullaniciID = $query["kullaniciID"];
		$kullaniciID2 = $query["kullaniciID2"];

		$id = $_COOKIE['birimID'];
		
		$sorgu = "UPDATE birim SET adres = '".$birimAdres."' WHERE id = $id";
		$kontrol = new BirimKontrol();
		$kontrol -> duzenle($sorgu,"guncelle");

		birimKullaniciKontrol($id,$kullaniciID,$kullaniciID2);

		echo "<script>
			$(document).ready(function(){
				$('#kullanici1 select').val('0');
				$('#kullanici2 select').val('0');
				$('#kaydetBT').val('');
				$('#kaydetBT').html('Kaydet');
			});
		</script>";

		kayitListele($birimIl,$birimIlce);
	}

	function kayitEkle($query){

		$ad = $query["ad"];
		$birimIl = $query["birimIl"];
		$birimIlce = $query["birimIlce"];
		$birimAdres = $query["birimAdres"];
		$kullaniciID = $query["kullaniciID"];
		$kullaniciID2 = $query["kullaniciID2"];

		$sorgu = "INSERT INTO `birim` (`id`, `ad`, `il`, `ilce`, `adres`) VALUES (NULL, '".$ad."', '".$birimIl."', '".$birimIlce."', '".$birimAdres."')";

		$kontrol = new BirimKontrol();
		$kontrol -> kaydet($sorgu);

		$sonuc = $kontrol -> listele("SELECT id FROM birim ORDER BY id DESC LIMIT 0,1");

		$son = mysqli_fetch_assoc($sonuc);

		birimKullaniciKontrol($son['id'],$kullaniciID,$kullaniciID2);

		kayitListele($birimIl,$birimIlce);	
	}

	function kayitSil($deger){

		$sorgu = "DELETE FROM birim WHERE id = $deger";

		$kontrol = new BirimKontrol();
		$kontrol -> duzenle($sorgu,"sil");
	}

	function ilceGetir($query){

		$il = $query["deger"];

		$sorgu = "SELECT * FROM ilce WHERE il_id = $il";
		$kontrol = new BirimKontrol();
		$sonuc = $kontrol -> listele($sorgu);
		
		echo "<label>Birim İlçe:</label>
			  <select id='sInput2' value=''>";
				while ($satir = mysqli_fetch_assoc($sonuc)){
						echo "<option value=".$satir["id"].">".$satir["ad"]."</option>";
			  	}
			echo "</select><a onclick=\"ajaxCokluListele('birimAjax');\"><span class='glyphicon glyphicon-list'></span></a><br/>";
	}

	function birimKullaniciKontrol($id,$kullaniciID,$kullaniciID2){
		$kontrol = new BirimKontrol();

		$kontrol -> sorguCalistir("UPDATE kullanici SET birimID = ".$id." WHERE id = $kullaniciID or id = $kullaniciID2"
			,"guncelle");

		$kontrol -> sorguCalistir("UPDATE kullanici SET birimID = 0 WHERE birimID = ".$id." and id <> $kullaniciID and id <> $kullaniciID2","guncelle");
	}

	function formGetir($query){
		$id = $query['birimID'];
		global $myDefines;
		$kontrol = new BirimKontrol();
		$sonuc = $kontrol -> listele("SELECT u.tag_id,u.ad,u.doz FROM stok s,urun u WHERE s.urun_id = u.id and s.stokbirim_id IN (SELECT id FROM stok_birim WHERE birim_id = $id)");

		echo "<table class='table table-striped'>
				<tr>";
					foreach ($myDefines["birimStokHeader"] as $headerName) {
						echo "<th>".$headerName."</th>";
					}
				"</tr>";
		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "
				<tr>";
					foreach ($myDefines["birimStokColNames"] as $colName) {
						echo "<td>".$satir[$colName]."</td>";
					}					
				"</tr>
			";
		}
		echo "</table>";
	}

	function kullaniciFormGetir($query){

		$id = $query["birimID"];
		$kontrol = new BirimKontrol();
		$sonuc = $kontrol -> listele("SELECT ad,soyad,tip FROM kullanici WHERE birimID =  $id");
		global $myDefines;

		echo "<table class='table table-striped'>
		<tr>";
			foreach ($myDefines["birimKullaniciHeader"] as $headerName) {
				echo "<th>".$headerName."</th>";
			}				
		"</tr>";
		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "
				<tr>";
					foreach ($myDefines["birimKullaniciColNames"] as $colName) {
						echo "<td>".$satir[$colName]."</td>";
					}
				"</tr>
			";
		}
		echo "</table>";
	}

	function kayitListele($deger,$deger1){

		$kontrol = new BirimKontrol();
		$sonuc = $kontrol -> listele("SELECT * FROM birim  WHERE il LIKE '%".$deger."%' and ilce LIKE '%".$deger1."%'");

		global $myDefines;

		echo "<table class='table table-striped'>
		<tr>";
			foreach ($myDefines["birimHeader"] as $key => $headerName) {
				echo "<th>".$headerName."</th>";	
			}
		echo "</tr>";

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<tr>";
					foreach ($myDefines["birimColonNames"] as $key => $colonName) {
						echo "<td>".$satir[$colonName]."</td>";
					}

					echo "<td>";
						if($_SESSION["kullanici"] == -1){
							echo "<button id='upBtn' onclick=\"ajaxInputDoldur(this,'birimAjax','doldur');\" value=".$satir["id"].">Guncelle</button>
							<button id='silBtn' onclick=\"ajaxSil(this,'birimAjax');\" value=".$satir["id"].">Sil</button>";
						}
					"</td>
				</tr>";
		}
		echo "</table>";
	}
?>