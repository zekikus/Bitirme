<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/ImhaKontrol.php");
	session_start();
	$myDefines = include("myDefines.php");
	$kontrol = new ImhaKontrol();

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
		global $kontrol;
		$urun_id = $query["urun_id"];
		$tarih = $query["tarih"];
		$tuketim = $query["tuketim"];
		$aciklama = $query["aciklama"];
		

		$sorgu = "INSERT INTO `imha` (`id`, `urun_id`, `tarih`, `tuketim_neden`, `aciklama`,`erisim`) VALUES (NULL, '".$urun_id."', '".$tarih."', '".$tuketim."', '".$aciklama."','".$_SESSION['kullanici']."')";

		$kontrol -> kaydet($sorgu);
	}

	function kayitSil($deger){

		global $kontrol;
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
		global $myDefines,$kontrol;
		
		$sorgu = "SELECT * FROM imha WHERE urun_id LIKE '%".$deger."%'";
		if($_SESSION['kullanici'] != -1) $sorgu.=" AND erisim = '".$_SESSION['kullanici']."'";

		$sonuc = $kontrol -> listele($sorgu); 

		echo "<table class='table table-striped'>
				<tr>";
					foreach ($myDefines["imhaHeaderNames"] as $headerName) {
						echo "<th>".$headerName."</th>";
					}
		echo	"</tr>";
		while ($satir = mysqli_fetch_assoc($sonuc)) {

			echo "<tr>";
					foreach ($myDefines["imhaColNames"] as $colName) {
						echo "<td>".$satir[$colName]."</td>";
					}
			echo  "<td>";
						echo "<button id='silBtn' onclick=\"ajaxSil(this,'imhaAjax');\" value=".$satir["urun_id"].">İmha Et</button>";
					"</td>
				</tr>
			";
		}
		echo "</table>";
	}
?>