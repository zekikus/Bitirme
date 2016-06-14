<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/ImhaKontrol.php");


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
		}
	}


	function kayitEkle($query){

		$urun_id = $query["urun_id"];
		$tarih = $query["tarih"];
		$tuketim = $query["tuketim"];
		$aciklama = $query["aciklama"];
		

		$sorgu = "INSERT INTO `imha` (`id`, `urun_id`, `tarih`, `tuketim_neden`, `aciklama`) VALUES (NULL, '".$urun_id."', '".$tarih."', '".$tuketim."', '".$aciklama."')";

		$kontrol = new ImhaKontrol();
		$kontrol -> kaydet($sorgu);

	}

	function kayitSil($deger){

		$kontrol = new ImhaKontrol();
		
		$sorgu_stok = "SELECT * FROM stok WHERE urun_id = $deger";
		
		$etkilenenStok = $kontrol -> etkilenenKayitSayisi($sorgu_stok);

		if($etkilenenStok > 0){

			$sorgu = "DELETE FROM stok WHERE urun_id = $deger";
			$kontrol -> duzenle($sorgu,"sil");
		}
		else{
			echo "<script>alert('Ürün Önceden İmha Edilmiş.')</script>";
		}
	}

	function kayitListele($deger){

		$kontrol = new ImhaKontrol();
		$sonuc = $kontrol -> listele("SELECT * FROM imha WHERE urun_id LIKE '%".$deger."%'");

		echo "<table class='table table-striped'>
		<tr>
					<th>Ürün No</th>
					<th>İşlem Tarihi</th>
					<th>Tüketim Nedeni</th>
					<th>Açıklama</th>
					<th>İşlem</th>
				</tr>

		";
		while ($satir = mysqli_fetch_assoc($sonuc)) {

			echo "
				<tr>
					<td>".$satir["urun_id"]."</td>
					<td>".$satir["tarih"]."</td>
					<td>".$satir["tuketim_neden"]."</td>
					<td>".$satir["aciklama"]."</td>
					<td>
						<button id='silBtn' onclick=\"ajaxSil(this,'imhaAjax');\" value=".$satir["urun_id"].">İmha Et</button>
					</td>
				</tr>
			";
		}
		echo "</table>";
	}
?>