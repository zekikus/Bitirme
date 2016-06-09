<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/UrunKontrol.php");


	if(isset($_POST['query'])){

		$query = @$_POST['query'];
		$deger = @$query["deger"];
		$deger1 = @$query["deger1"];
		$islem = @$query["islem"];

		if($islem == "listele"){
			kayitListele($deger,$deger1);
		}else if($islem == "sil"){
			kayitSil($deger);
			kayitListele("","");
		}else if($islem == "kaydet"){
			kayitEkle($query);
			kayitListele("","");
		}else if($islem == "guncelle"){
			kayitGuncelle($query);
			kayitListele("","");
		}else{
			inputDoldur($deger);
		}
	}

	function inputDoldur($deger){

		$sorgu = "SELECT * FROM urun WHERE id = $deger";
		
		$kontrol = new UrunKontrol();
		$sonuc = $kontrol -> listele($sorgu);

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<script>
				$(document).ready(function(){
					$('#ad').val('".$satir['ad']."');
					$('#urunTanim').val('".$satir['tanim_id']."');
					$('#urunNo').val('".$satir['tag_id']."');
					$('#uretici').val('".$satir['uretici_id']."');
					$('#aciklama').val('".$satir['aciklama']."');
					$('#urunDoz').val('".$satir['doz']."');
					$('#seansSayi').val('".$satir['seans_sayisi']."');
					$('#kullanimSuresi').val('".$satir['kullanim_suresi']."');

					$('#kaydetUrun').val('Guncelle');
					$('#kaydetUrun').html('Guncelle');
				});
			</script>";
		}
		setcookie("urunID",$deger,time() + 30);
	}

	function kayitGuncelle($query){
		$ad = $query["ad"];
		$urunTanim = $query["urunTanim"];
		$urunNo = $query["urunNo"];
		$uretici = $query["uretici"];
		$aciklama = $query["aciklama"];
		$urunDoz = $query["urunDoz"];
		$seansTip = $query["seansTip"];
		$seansSayi = $query["seansSayi"];
		$kullanimSuresi = $query["kullanimSuresi"];

		$id = $_COOKIE['urunID'];
		
		$sorgu = "UPDATE urun SET uretici_id = ".$uretici.",tanim_id = ".$urunTanim.",ad = '".$ad."',tag_id = ".$urunNo.",aciklama = '".$aciklama."',doz = '".$urunDoz."',seans_tipi = '".$seansTip."',seans_sayisi = '".$seansSayi."',kullanim_suresi = '".$kullanimSuresi."' WHERE id = $id";
		$kontrol = new UrunKontrol();
		$kontrol -> duzenle($sorgu,"guncelle");

		echo "<script>
			$(document).ready(function(){
				$('#kaydetUrun').val('');
				$('#kaydetUrun').html('Kaydet');
			});
		</script>";
	}

	function kayitEkle($query){

		$ad = $query["ad"];
		$urunTanim = $query["urunTanim"];
		$urunNo = $query["urunNo"];
		$uretici = $query["uretici"];
		$aciklama = $query["aciklama"];
		$urunDoz = $query["urunDoz"];
		$seansTip = $query["seansTip"];
		$seansSayi = $query["seansSayi"];
		$kullanimSuresi = $query["kullanimSuresi"];

		$sorgu = "INSERT INTO `urun` (`id`, `uretici_id`, `tanim_id`, `ad`, `tag_id`, `aciklama`, `doz`, `seans_tipi`, `seans_sayisi`, `kullanim_suresi`) VALUES (NULL, '".$uretici."', '".$urunTanim."', '".$ad."', '".$urunNo."', '".$aciklama."', '".$urunDoz."', '".$seansTip."', '".$seansSayi."', '".$kullanimSuresi."')";

		$kontrol = new UrunKontrol();
		$kontrol -> kaydet($sorgu);

	}

	function kayitSil($deger){

		$sorgu = "DELETE FROM urun WHERE id = $deger";

		$kontrol = new UrunKontrol();
		$kontrol -> duzenle($sorgu,"sil");
	}

	function kayitListele($deger,$deger1){

		$kontrol = new UrunKontrol();
		$sonuc = $kontrol -> listele("SELECT u.id,u.ad,u.tag_id,ut.ad as 'TanimAd' FROM urun u,uruntanim ut WHERE u.tanim_id = ut.id and u.tag_id LIKE '%".$deger."%' and u.ad LIKE '%".$deger1."%'");

		echo "<table class='table table-striped'>
		<tr>
					<th>Ürün Adı</th>
					<th>Ürün Tanım</th>
					<th>Ürün No</th>
					<th>Islemler</th>
				</tr>

		";
		while ($satir = mysqli_fetch_assoc($sonuc)) {

			echo "
				<tr>
					<td>".$satir["ad"]."</td>
					<td>".$satir['TanimAd']."</td>
					<td>".$satir['tag_id']."</td>
					<td>
						<button id='upBtn' onclick=\"ajaxInputDoldur(this,'urunAjax');\" value=".$satir["id"].">Guncelle</button>
						<button id='silBtn' onclick=\"ajaxSil(this,'urunAjax');\" value=".$satir["id"].">Sil</button>
					</td>
				</tr>
			";
		}
		echo "</table>";
	}
?>