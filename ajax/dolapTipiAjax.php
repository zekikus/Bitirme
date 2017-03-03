<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/DolapTipiKontrol.php");
	$myDefines = include("myDefines.php");


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

		$sorgu = "SELECT ad,aktifMi FROM dolap_tip WHERE id = $deger LIMIT 1";
		
		$kontrol = new DolapTipiKontrol();
		$sonuc = $kontrol -> listele($sorgu);

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			$aktif = ($satir['aktifMi'] == 1) ? 'true' : 'false';
			$vDeger = ($aktif == 'true') ? 1 : 0;
			echo "<script>
				$(document).ready(function(){
					$('#ad').val('".$satir['ad']."');
					$('#aktifMi').prop('checked', $aktif);
					$('#aktifMi').val($vDeger);
					$('#kaydetDT').val('Guncelle');
					$('#kaydetDT').html('Guncelle');
				});
			</script>";
		}
		setcookie("dolapTipiID",$deger,time() + 30);
	}

	function kayitGuncelle($query){
		$ad = $query["ad"];
		$aktifMi = $query["aktifMi"];
		$id = $_COOKIE['dolapTipiID'];
		
		$sorgu = "UPDATE dolap_tip SET ad = '".$ad."',aktifMi = '".$aktifMi."' WHERE id = $id";
		$kontrol = new DolapTipiKontrol();
		$kontrol -> duzenle($sorgu,"guncelle");

		echo "<script>
			$(document).ready(function(){
				$('#kaydetDT').val('');
				$('#kaydetDT').html('Kaydet');
			});
		</script>";
	}

	function kayitEkle($query){

		$ad = $query["ad"];
		@$aktifMi = @$query["aktifMi"];

		$sorgu = "INSERT INTO `dolap_tip` (`id`, `ad`, `aktifMi`) VALUES (NULL, '".$ad."', '".$aktifMi."')";

		$kontrol = new DolapTipiKontrol();
		$kontrol -> kaydet($sorgu);

	}

	function kayitSil($deger){

		$sorgu = "DELETE FROM dolap_tip WHERE id = $deger";

		$kontrol = new DolapTipiKontrol();
		$kontrol -> duzenle($sorgu,"sil");
	}

	function kayitListele($deger){
		global $myDefines;
		$kontrol = new DolapTipiKontrol();
		$sonuc = $kontrol -> listele("SELECT * FROM dolap_tip WHERE ad LIKE '%".$deger."%'");

		echo "<table class='table table-striped'>
				<tr>";
					foreach ($myDefines["dtHeaderNames"] as $headerName) {
						echo "<th>".$headerName."</th>";
					}
		echo	"</tr>";
		while ($satir = mysqli_fetch_assoc($sonuc)) {

			$aktif = ($satir["aktifMi"] == 1) ? "Aktif" : 'Aktif Değil';
			echo "
				<tr>
					<td>".$satir["ad"]."</td>
					<td>".$aktif."</td>
					<td>
						<button id='upBtn' onclick=\"ajaxInputDoldur(this,'dolapTipiAjax','doldur');\" value=".$satir["id"].">Guncelle</button>
						<button id='silBtn' onclick=\"ajaxSil(this,'dolapTipiAjax');\" value=".$satir["id"].">Sil</button>
					</td>
				</tr>
			";
		}
		echo "</table>";
	}
?>