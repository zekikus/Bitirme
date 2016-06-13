<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/TuketimNedeniKontrol.php");


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

		$sorgu = "SELECT tanim,aktifMi FROM tuketim_nedeni WHERE id = $deger LIMIT 1";
		
		$kontrol = new TuketimNedeniKontrol();
		$sonuc = $kontrol -> listele($sorgu);

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			$aktif = ($satir['aktifMi'] == 1) ? 'true' : 'false';
			$vDeger = ($aktif == 'true') ? 1 : 0;
			echo "<script>
				$(document).ready(function(){
					$('#tuketimTanim').val('".$satir['tanim']."');
					$('#aktifMi').prop('checked', $aktif);
					$('#aktifMi').val($vDeger);
					$('#kaydetTN').val('Guncelle');
					$('#kaydetTN').html('Guncelle');
				});
			</script>";
		}
		setcookie("tuketimNedeniID",$deger,time() + 30);
	}

	function kayitGuncelle($query){
		$tanim = $query["tanim"];
		$aktifMi = $query["aktifMi"];
		$id = $_COOKIE['tuketimNedeniID'];
		
		$sorgu = "UPDATE tuketim_nedeni SET tanim = '".$tanim."',aktifMi = '".$aktifMi."' WHERE id = $id";
		$kontrol = new TuketimNedeniKontrol();
		$kontrol -> duzenle($sorgu,"guncelle");

		echo "<script>
			$(document).ready(function(){
				$('#kaydetTN').val('');
				$('#kaydetTN').html('Kaydet');
			});
		</script>";
	}

	function kayitEkle($query){

		$tanim = $query["tanim"];
		@$aktifMi = @$query["aktifMi"];

		echo $tanim;

		$sorgu = "INSERT INTO `tuketim_nedeni` (`id`, `tanim`, `aktifMi`) VALUES (NULL, '".$tanim."', '".$aktifMi."')";

		$kontrol = new TuketimNedeniKontrol();
		$kontrol -> kaydet($sorgu);

	}

	function kayitSil($deger){

		$sorgu = "DELETE FROM tuketim_nedeni WHERE id = $deger";

		$kontrol = new TuketimNedeniKontrol();
		$kontrol -> duzenle($sorgu,"sil");
	}

	function kayitListele($deger){

		$kontrol = new TuketimNedeniKontrol();
		$sonuc = $kontrol -> listele("SELECT * FROM tuketim_nedeni WHERE tanim LIKE '%".$deger."%'");

		echo "<table class='table table-striped'>
		<tr>
					<th>Tanım</th>
					<th>Aktif Mi</th>
					<th>Islemler</th>
				</tr>

		";
		while ($satir = mysqli_fetch_assoc($sonuc)) {

			$aktif = ($satir["aktifMi"] == 1) ? "Aktif" : 'Aktif Değil';
			echo "
				<tr>
					<td>".$satir["tanim"]."</td>
					<td>".$aktif."</td>
					<td>
						<button id='upBtn' onclick=\"ajaxInputDoldur(this,'tuketimNedeniAjax','doldur');\" value=".$satir["id"].">Guncelle</button>
						<button id='silBtn' onclick=\"ajaxSil(this,'tuketimNedeniAjax');\" value=".$satir["id"].">Sil</button>
					</td>
				</tr>
			";
		}
		echo "</table>";
	}

	//onclick="test('this','dolapTipiAjax');"
?>