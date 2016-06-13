<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/KullaniciKontrol.php");

	if(isset($_POST['query'])){

		$query = @$_POST['query'];
		$deger = @$query["deger"];
		$islem = @$query["islem"];

		if($islem == "listele"){
			kayitListele($query);
		}else if($islem == "sil"){
			kayitSil($query['deger']);
		}else if($islem == "kaydet"){
			if(isset($query['adresIslem']))
				adresEkle($query);
			else if(isset($query['iletisimIslem']))
				iletisimEkle($query);
			else
				kayitEkle($query);
		}else if($islem == "guncelle"){
			if(isset($query['adresIslem']))
				adresGuncelle($query);
			else if(isset($query['iletisimIslem']))
				iletisimGuncelle($query);
			else
				kayitGuncelle($query);
		}else if($islem == "ilceGetir")
			ilceGetir($query);
		else if($islem == "kullaniciKontrol"){
			kullaniciKontrol($query);
		}else if($islem == "iletisimGetir"){
			iletisimTipGetir($query);	
		}else if($islem == "adresDoldur"){
			adresDoldur($query);	
		}else if($islem == "iletisimDoldur"){
			iletisimDoldur($query);	
		}else if($islem == "adresListele"){
			adresGetir($query['deger']);
		}else if($islem == "iletisimListele"){
			iletisimGetir($query['deger']);
		}else if($islem == "adresSil"){
			adresSil($query);
		}else if($islem == "iletisimSil"){
			iletisimSil($query);
		}else{
			inputDoldur($deger);
		}
	}

	function inputDoldur($deger){

		$sorgu = "SELECT * FROM kullanici WHERE id = $deger LIMIT 1";
		
		$kontrol = new KullaniciKontrol();
		$sonuc = $kontrol -> listele($sorgu);

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<script>
				$(document).ready(function(){
					$('#aLink').show();
    				$('#iLink').show();
					$('#kLink').hide();
					$('#sPlus').hide();
					$('#sPluss').hide();
					$('#userID').val('".$satir['id']."');
					$('#gTCNO').val('".$satir['tcNo']."');
					$('#gAd').val('".$satir['ad']."');
					$('#gSoyad').val('".$satir['soyad']."');
					$('#gKadi').val('".$satir['kullaniciAdi']."');
					$('#gSifre').val('".$satir['kullaniciSifre']."');
					$('#gSifreTekrar').val('".$satir['kullaniciSifre']."');
					$('#kaydetKu').val('Guncelle');
					$('#kaydetKu').html('Guncelle');
				});
			</script>";
		}
		setcookie("kuID",$deger,time() + 900);
	}

	function kayitGuncelle($query){
		$id = $_COOKIE['kuID'];
		
		$sorgu = "UPDATE kullanici SET ad = '".$query['gAd']."',soyad = '".$query['gSoyad']."',kullaniciAdi = '".$query['gKadi']."',kullaniciSifre = '".$query['gSifre']."' WHERE id = $id";
		$kontrol = new KullaniciKontrol();
		$kontrol -> duzenle($sorgu,"guncelle");

		echo "<script>
			$(document).ready(function(){
				$('#kaydetKu').val('');
				$('#kaydetKu').html('Kaydet');
			});
		</script>";
	}

	function kayitEkle($query){

		$sorgu = "INSERT INTO `kullanici`(`id`, `tcNo`, `ad`, `soyad`, `tip`, `kullaniciAdi`, `kullaniciSifre`) VALUES (NULL,'".$query['gTCNO']."','".$query['gAd']."','".$query['gSoyad']."','test','".$query['gKadi']."','".$query['gSifre']."')";

		$kontrol = new KullaniciKontrol();
		$kontrol -> kaydet($sorgu);

		echo "<script>
				$('#kLink').hide();
				$('#kisLink').hide();
				$('#aLink').show();
    			$('#iLink').show();
    			$('#uID').val('".$query['gTCNO']."');
				$('.nav-tabs a[href=\"#adresBilgi\"]').tab('show');
			  </script>";
	}

	function adresEkle($query){

		$kontrol = new KullaniciKontrol();

		$sonuc = $kontrol -> listele("SELECT id FROM kullanici ORDER BY id DESC LIMIT 0,1");
		$sonKID = mysqli_fetch_assoc($sonuc);

		setcookie('kullaniciID',$sonKID['id'],time()+900);

		$sorgu = "INSERT INTO `adres`(`id`,`kullanici_id`, `il`, `ilce`, `acikAdres`) VALUES (NULL,'".$sonKID['id']."','".$query['il']."','".$query['ilce']."','".$query['adres']."')";

		$kontrol -> kaydet($sorgu);

		echo "<script>
				$('#aLink').hide();
				$('.nav-tabs a[href=\"#iletisimBilgi\"]').tab('show');
			  </script>";
	}

	function adresGetir($deger){

		$kontrol = new KullaniciKontrol();
		$sonuc = $kontrol -> listele("SELECT * FROM adres WHERE kullanici_id = $deger");

		echo "<table class='table table-striped'>
		<tr>
			<th>İl</th>
			<th>İlçe</th>
			<th>Açık Adres</th>
			<th>Islemler</th>
		</tr>
		";

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "
				<tr>
					<td>".$satir["il"]."</td>
					<td>".$satir["ilce"]."</td>
					<td>".$satir["acikAdres"]."</td>
					<td>
						<button id='upBtn' onclick=\"ajaxIslemYap(this,'adresDoldur','#adresSonucccc','kullaniciAjax');\" value=".$satir["id"].">Guncelle</button>
						<button id='silBtn' onclick=\"ajaxIslemYap(this,'adresSil','#adresSonucccc','kullaniciAjax');\" value=".$satir["id"].">Sil</button>
					</td>
				</tr>
			";
		} 
		echo "</table>";
	}

	function adresDoldur($query){

		$sorgu = "SELECT * FROM adres WHERE id = ".$query['deger']." LIMIT 1";
		
		$kontrol = new KullaniciKontrol();
		$sonuc = $kontrol -> listele($sorgu);

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<script>
				$(document).ready(function(){
					
					$('#modalAdres').css({
				           'overlay' : '0.6',
				           'top' : '50px'
				        });
				    $('#modalAdres').toggle();
					$('#kullaniciIl select #ilkOpt').text('".$satir['il']."');
					
					$('#kullaniciIl select #ilkOpt').prop('selected','true').text('".$satir['il']."');
					$('#kullaniciIlce').html('<label>İlçe :</label> <select><option>".$satir["ilce"]."</option></select>');
					$('#kullaniciAdres').val('".$satir['acikAdres']."');


					$('#kaydetAdr').val('Guncelle');
					$('#kaydetAdr').html('Guncelle');
				});
			</script>";
		}
		setcookie("adrID",$query['deger'],time() + 3600);
	}

	function adresGuncelle($query){
		
		$id = $_COOKIE['adrID'];
		
		$sorgu = "UPDATE adres SET il = '".$query['il']."',ilce = '".$query['ilce']."',acikAdres = '".$query['adres']."' WHERE id = $id";
		$kontrol = new KullaniciKontrol();
		$kontrol -> duzenle($sorgu,"guncelle");

		echo "<script>
			$(document).ready(function(){
				$('#kaydetAdr').val('');
				$('#kaydetAdr').html('Kaydet');
			});
		</script>";
		adresGetir($query['kullaniciID']);
	}

	function iletisimEkle($query){

		$kontrol = new KullaniciKontrol();
		$sonKID = $_COOKIE['kullaniciID'];

		$sorgu = "INSERT INTO `iletisim`(`id`, `kullanici_id`, `tip`, `deger`) VALUES (NULL,'".$sonKID."','".$query['iletisimTip']."','".$query['deger']."')";

		$kontrol -> kaydet($sorgu);

		echo "<script>
				$('#modal').hide();
			  </script>";
	}

	function iletisimGuncelle($query){
		$id = $_COOKIE['ileID'];
		
		$sorgu = "UPDATE iletisim SET tip = '".$query['iletisimTip']."',deger = '".$query['deger']."' WHERE id = $id";
		$kontrol = new KullaniciKontrol();
		$kontrol -> duzenle($sorgu,"guncelle");

		echo "<script>
			$(document).ready(function(){
				$('#kaydetIle').val('');
				$('#kaydetIle').html('Kaydet');
			});
		</script>";
		iletisimGetir($query['kullaniciID']);
	}

	function iletisimDoldur($query){
		$sorgu = "SELECT * FROM iletisim WHERE id = ".$query['deger']." LIMIT 1";
		
		$kontrol = new KullaniciKontrol();
		$sonuc = $kontrol -> listele($sorgu);

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<script>
				$(document).ready(function(){
					 $('#modalIletisim').css({
				           'overlay' : '0.6',
				           'top' : '50px'
				        });
				    $('#modalIletisim').toggle();
					$('#iletisimTip').val('".$satir['tip']."');
					$('#iDeger').val('".$satir['deger']."');
					$('#kaydetIle').val('Guncelle');
					$('#kaydetIle').html('Guncelle');
				});
			</script>";
		}
		setcookie("ileID",$query['deger'],time() + 3600);
	}

	function kullaniciKontrol($query){
		
		$kontrol = new KullaniciKontrol();
		$kayitSayisi = $kontrol -> etkilenenKayitSayisi("SELECT * FROM kullanici WHERE tcNo = ".$query["deger"]."");

		if($kayitSayisi > 0)
			echo "<script>alert('Bu Kullanıcı Zaten Kayıtlı!')</script>";
		else{
			echo "<script>
				if (confirm('Kullanıcı kayıtlı değil kaydetmek ister misiniz?')) {
					   $('.nav-tabs a[href=\"#kisiBilgi\"]').tab('show');
					   $('#gTCNO').val(''+$('#tcNo').val()+'');
					}
			</script>
			";
		}
	}

	function ilceGetir($query){

		$il = $query["deger"];

		$sorgu = "SELECT * FROM ilce WHERE il_id = $il";
		$kontrol = new KullaniciKontrol();
		$sonuc = $kontrol -> listele($sorgu);
		
		echo "<label>İlçe:</label>
			  <select id='sInput2' value=''>";
				while ($satir = mysqli_fetch_assoc($sonuc)){
						echo "<option value=".$satir["id"].">".$satir["ad"]."</option>";
			  	}
			echo "</select>";
	}

	function iletisimTipGetir($query){
		
		$iletisim = $query["deger"];

		echo "<label>Değer: </label>";
		if($iletisim == "Cep Telefonu" or $iletisim == "Sabit Telefon"){
			echo "<input type='text' id='iDeger' />";
		}else{
			echo "<input type='email' id='iDeger'/>";
		}
	}

	function iletisimGetir($deger){
		$kontrol = new KullaniciKontrol();
		$sonuc = $kontrol -> listele("SELECT id,tip,deger FROM iletisim WHERE kullanici_id = $deger");

		echo "<table class='table table-striped'>
		<tr>
			<th>İletişim Tipi</th>
			<th>Değer</th>
			<th>Islemler</th>
		</tr>
		";

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "
				<tr>
					<td>".$satir["tip"]."</td>
					<td>".$satir["deger"]."</td>
					<td>
						<button id='upBtn' onclick=\"ajaxIslemYap(this,'iletisimDoldur','#iletisimSonuc','kullaniciAjax');\" value=".$satir["id"].">Guncelle</button>
						<button id='silBtn' onclick=\"ajaxIslemYap(this,'iletisimSil','#iletisimSonuc','kullaniciAjax');\" value=".$satir["id"].">Sil</button>
					</td>
				</tr>
			";
		} 
		echo "</table>";
	}

	function kayitSil($deger){

		$sorgu = "DELETE FROM kullanici WHERE id = $deger";

		$kontrol = new KullaniciKontrol();
		$kontrol -> duzenle($sorgu,"sil");

	}

	function adresSil($query){

		$sorgu = "DELETE FROM adres WHERE id = ".$query['deger']."";

		$kontrol = new KullaniciKontrol();
		$kontrol -> duzenle($sorgu,"sil");

		adresGetir($query['kullaniciID']);
	}

	function iletisimSil($query){

		$sorgu = "DELETE FROM iletisim WHERE id = ".$query['deger']."";

		$kontrol = new KullaniciKontrol();
		$kontrol -> duzenle($sorgu,"sil");

		iletisimGetir($query['kullaniciID']);
	}

	function kayitListele($query){

		$kontrol = new KullaniciKontrol();
		$sonuc = $kontrol -> listele("SELECT k.id as 'kID',k.ad as 'kAd',k.soyad,k.birimID,b.* FROM kullanici k,birim b WHERE k.birimID = b.id and k.tcNo = '".$query['deger']."'");

		echo "<table class='table table-striped'>
				<tr>
					<th>Ad</th>
					<th>Soyad</th>
					<th>Birim Ad</th>
					<th>Birim İl</th>
					<th>Birim İlçe</th>
					<th>Islemler</th>
				</tr>

		";
		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "
				<tr>
					<td>".$satir["kAd"]."</td>
					<td>".$satir["soyad"]."</td>
					<td>".$satir["ad"]."</td>
					<td>".$satir["il"]."</td>
					<td>".$satir["ilce"]."</td>
					<td>
						<button id='upBtn' onclick=\"ajaxInputDoldur(this,'kullaniciAjax','doldur');\" value=".$satir["kID"].">Guncelle</button>
						<button id='silBtn' onclick=\"ajaxSil(this,'kullaniciAjax');\" value=".$satir["kID"].">Sil</button>
					</td>
				</tr>
			";
		}
		echo "</table>";
	}

?>