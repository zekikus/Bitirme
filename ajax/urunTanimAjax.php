<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/UrunTanimKontrol.php");
	session_start();
	$myDefines = include("myDefines.php");
	$kontrol = new UrunTanimKontrol();

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
		global $kontrol;
		$sorgu = "SELECT ad,tip,aciklama FROM uruntanim WHERE id = $deger LIMIT 1";
		
		$sonuc = $kontrol -> listele($sorgu);

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<script>
				$(document).ready(function(){
					$('#ad').val('".$satir['ad']."');
					$('#urunAciklama').val('".$satir['aciklama']."');
					$('#kaydetUT').val('Guncelle');
					$('#kaydetUT').html('Guncelle');
				});
			</script>";
		}
		setcookie("urunTanimID",$deger,time() + 30);
	}

	function kayitGuncelle($query){
		global $kontrol;
		$ad = $query["ad"];
		$tip = $query["tip"];
		$aciklama = $query["aciklama"];
		$id = $_COOKIE['urunTanimID'];
		
		$sorgu = "UPDATE uruntanim SET ad = '".$ad."',tip = '".$tip."',aciklama = '".$aciklama."' WHERE id = $id";
		$kontrol -> duzenle($sorgu,"guncelle");

		echo "<script>
			$(document).ready(function(){
				$('#kaydetUT').val('');
				$('#kaydetUT').html('Kaydet');
			});
		</script>";
	}

	function kayitEkle($query){
		global $kontrol;
		$ad = $query["ad"];
		$tip = $query["tip"];
		$aciklama = $query["aciklama"];

		$sorgu = "INSERT INTO `uruntanim` (`id`, `ad`, `tip`, `aciklama`) VALUES (NULL, '".$ad."', '".$tip."', '".$aciklama."')";

		$kontrol -> kaydet($sorgu);

	}

	function kayitSil($deger){
		global $kontrol;
		$sorgu = "DELETE FROM uruntanim WHERE id = $deger";

		$kontrol -> duzenle($sorgu,"sil");
	}

	function kayitListele($deger){

		global $myDefines,$kontrol;
		
		$sonuc = $kontrol -> listele("SELECT * FROM uruntanim WHERE ad LIKE '%".$deger."%'");

		echo "<table class='table table-striped'>
				<tr>";
					foreach ($myDefines["utHeaderNames"] as $headerName) {
						echo "<th>".$headerName."</th>";
					}
		echo	"</tr>";
		while ($satir = mysqli_fetch_assoc($sonuc)) {

			echo "<tr>";
					foreach ($myDefines["utColNames"] as $colName) {
						echo "<td>".$satir[$colName]."</td>";
					}
			echo	"<td>";
					if($_SESSION["kullanici"] == -1){
						echo "<button id='upBtn' onclick=\"ajaxInputDoldur(this,'urunTanimAjax','doldur');\" value=".$satir["id"].">Guncelle</button>
						<button id='silBtn' onclick=\"ajaxSil(this,'urunTanimAjax');\" value=".$satir["id"].">Sil</button>";
					}
					"</td>
				</tr>
			";
		}
		echo "</table>";
	}
?>