<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/UreticiKontrol.php");


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
		}else{
			inputDoldur($deger);
		}
	}

	function inputDoldur($deger){

		$sorgu = "SELECT ad,ulke FROM uretici WHERE id = $deger LIMIT 1";
		
		$kontrol = new UreticiKontrol();
		$sonuc = $kontrol -> listele($sorgu);

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<script>
				$(document).ready(function(){
					$('#ad').val('".$satir['ad']."');
					$('#ulke').val('".$satir['ulke']."');
					$('#ureticiKaydet').val('Guncelle');
					$('#ureticiKaydet').html('Guncelle');
				});
			</script>";
		}
		setcookie("ureticiId",$deger,time() + 30);
	}

	function kayitGuncelle($query){
		$ad = $query["ad"];
		$ulke = $query["ulke"];
		$id = $_COOKIE['ureticiId'];
		
		$sorgu = "UPDATE uretici SET ad = '".$ad."',ulke = '".$ulke."' WHERE id = $id";
		$kontrol = new UreticiKontrol();
		$kontrol -> duzenle($sorgu,"guncelle");

		echo "<script>
			$(document).ready(function(){
				$('#ureticiKaydet').val('');
				$('#ureticiKaydet').html('Kaydet');
			});
		</script>";
	}

	function kayitEkle($query){

		$ad = $query["ad"];
		$ulke = $query["ulke"];

		$sorgu = "INSERT INTO `uretici` (`id`, `ad`, `ulke`) VALUES (NULL, '".$ad."', '".$ulke."')";

		$kontrol = new UreticiKontrol();
		$kontrol -> kaydet($sorgu);

	}

	function kayitSil($deger){

		$sorgu = "DELETE FROM uretici WHERE id = $deger";

		$kontrol = new UreticiKontrol();
		$kontrol -> duzenle($sorgu,"sil");
	}

	function kayitListele($deger){

		$kontrol = new UreticiKontrol();
		$sonuc = $kontrol -> listele("SELECT * FROM uretici WHERE ad LIKE '%".$deger."%'");

		echo "<table class='table table-striped'>
		<tr>
					<th>Ad</th>
					<th>Ulke</th>
					<th>Islemler</th>
				</tr>

		";
		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "
				<tr>
					<td>".$satir["ad"]."</td>
					<td>".$satir["ulke"]."</td>
					<td>
						<button id='upBtn' onclick=\"ajaxInputDoldur(this,'ureticiAjax');\" value=".$satir["id"].">Guncelle</button>
						<button id='silBtn' onclick=\"ajaxSil(this,'ureticiAjax');\" value=".$satir["id"].">Sil</button>
					</td>
				</tr>
			";
		}
		echo "</table>";
	}

	
?>