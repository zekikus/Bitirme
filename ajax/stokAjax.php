<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/StokKontrol.php");
	$myDefines = include("myDefines.php");
	$kontrol = new StokKontrol();

	if(isset($_POST['query'])){

		$query = @$_POST['query'];
		$deger = @$query["deger"];
		$islem = @$query["islem"];

		if($islem == "listele"){
			kayitListele($query);
		}
		else if($islem == "ilceGetir"){
			ilceGetir($query);
		}else if($islem == "birimGetir"){
			birimGetir($query);
		}else if($islem == "sBirimGetir"){
			stokBirimGetir($query);
		}else if($islem == "tuketimListele"){
			tuketimListele($query);
		}else{
			inputDoldur($query);
		}
	}

	function inputDoldur($query){

		global $kontrol;
		$sonuc = $kontrol -> listele("SELECT urun_id,stokbirim_id FROM stok WHERE stok_id = ".$query['deger']." LIMIT 1");
		
		$veri = mysqli_fetch_assoc($sonuc);

		$sbID = $veri['stokbirim_id'];
		$uID = $veri['urun_id'];

		$sonuc = $kontrol -> listele("SELECT sb.ad as 'sbAd',b.ad FROM stok_birim sb,birim b WHERE sb.birim_id = b.id and sb.id = $sbID");

		$veri = mysqli_fetch_assoc($sonuc);
		$sbAd = $veri['sbAd'];
		$bAd = $veri['ad'];
		
		$sonuc = $kontrol -> listele("SELECT u.tag_id,u.ad,u.doz,u.kullanim_suresi,ur.ad as 'firma',ut.ad as 'urTa',ut.tip FROM urun u,uretici ur,uruntanim ut WHERE u.uretici_id = ur.id and u.tanim_id = ut.id and u.id = $uID");

		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<script>
					$('#stokID').val('".$query['deger']."');
					$('#uTip').val('".$satir['tip']."');
					$('#uNo').val('".$satir['tag_id']."');
					$('#uFirma').val('".$satir['firma']."');
					$('#uTanim').val('".$satir['urTa']."');
					$('#uAd,#tAd').val('".$satir['ad']."');
					$('#uBirim,#tBirim').val('".$bAd."');
					$('#usBirim,#tSB').val('".$sbAd."');
					$('#uDoz').val('".$satir['doz']."');
					$('#uSKT').val('".$satir['kullanim_suresi']."');
			</script>";
		}
	}

	function tuketimListele($query){

		global $kontrol,$myDefines;
		$sonuc = $kontrol -> listele("SELECT urun_id,stokbirim_id FROM stok WHERE stok_id = ".$query['deger']." LIMIT 1");
		
		$veri = mysqli_fetch_assoc($sonuc);
		$uID = $veri['urun_id'];
		$sbID = $veri['stokbirim_id'];

		$sonuc = $kontrol -> listele("SELECT aciklama,tarih,tuketim_nedeni,uygulanan_tc  FROM stok_cikis WHERE urun_id = $uID and stokbirim_id = $sbID");

		echo "<table class='table table-striped'>
				<tr>";
					foreach ($myDefines["stokTuketimHeaderNames"] as $headerName) {
						echo "<th>".$headerName."</th>";
					}
		echo	"</tr>";
		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<tr>";
					foreach ($myDefines["stokTuketimColNames"] as $colName) {
						echo "<td>".$satir[$colName]."</td>";
					}
			echo "</tr>";
		}
		echo "</table>";
	}

	function kayitListele($query){
		global $kontrol,$myDefines;		
		$sorgu = "SELECT u.tag_id,u.ad,u.doz,u.kullanim_suresi,s.stok_id,sb.ad as 'stokBirimAd' FROM urun u,stok s,stok_birim sb  WHERE u.id = s.urun_id and sb.id = s.stokbirim_id";

		if($query['deger'] != '')
			$sorgu .= " and u.ad = '".$query['deger2']."'";
		if(@$query['deger1'] != '')
			$sorgu .= " and s.stokbirim_id = ".@$query['deger1']."";

		$sonuc = $kontrol -> listele($sorgu);

		echo "<table class='table table-striped'>
				<tr>";
					foreach ($myDefines["stokHeaderNames"] as $headerName) {
							echo "<th>".$headerName."</th>";
						}	
		echo	"</tr>";
		while ($satir = mysqli_fetch_assoc($sonuc)) {
			echo "<tr>";
					foreach ($myDefines["stokColNames"] as $colName) {
						echo "<td>".$satir[$colName]."</td>";
					}
			echo	"<td>
						<button id='detayBtn' onclick=\"ajaxInputDoldur(this,'stokAjax','doldur');\" value=".$satir["stok_id"].">Detay</button>
					</td>
				</tr>
			";
		}
		echo "</table>";
	}

	function ilceGetir($query){

		$il = $query["deger"];

		$sorgu = "SELECT * FROM ilce WHERE il_id = $il";
		$kontrol = new StokKontrol();
		$sonuc = $kontrol -> listele($sorgu);
		
		echo "<label>Birim İlçe:</label>
			  <select id='stokIlce' value='' onchange=\"ajaxBirimGetir('#bSonuc','#stokIl','#stokIlce','stokAjax')\">";
			  	echo "<option id='ilkIlce'></option>";
				while ($satir = mysqli_fetch_assoc($sonuc)){
						echo "<option value=".$satir["id"].">".$satir["ad"]."</option>";
			  	}
			echo "</select>";
	}

	function birimGetir($query){
		$il = $query['il'];
		$ilce = $query['ilce'];

		$sorgu = "SELECT id,ad FROM birim WHERE il = '".$il."' and ilce = '".$ilce."' ";
		$kontrol = new StokKontrol();
		$sonuc = $kontrol -> listele($sorgu);
		
		echo "<label>Birim:</label>
			  <select id='birimSelect' value='' onchange =\"ajaxIslemYap('#birimSelect','sBirimGetir','#sbSonuc','stokAjax')\">";
			  echo "<option id='ilkBirim'></option>";
				while ($satir = mysqli_fetch_assoc($sonuc)){
						echo "<option value=".$satir["id"].">".$satir["ad"]."</option>";
			  	}
			echo "</select><br/>";
	}

	function stokBirimGetir($query){
		$id = $query['deger'];

		$sorgu = "SELECT id,ad FROM stok_birim WHERE birim_id = $id ";
		$kontrol = new StokKontrol();
		$sonuc = $kontrol -> listele($sorgu);
		
		echo "<label>Stok Birim:</label>
			  <select id='sInput2' value=''>";
				while ($satir = mysqli_fetch_assoc($sonuc)){
						echo "<option value=".$satir["id"].">".$satir["ad"]."</option>";
			  	}
			echo "</select><a onclick=\"ajaxCokluListele('stokAjax');\"><span class='glyphicon glyphicon-list'></span></a><br/>";
	}
?>