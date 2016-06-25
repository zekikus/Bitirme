<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/StokKabulKontrol.php");
	$kontrol = new StokKabulKontrol();
	if(!isset($_COOKIE['rfBID']))
		setcookie("rfBID",$_SESSION['kullanici']);
	else
		echo $_SESSION['kullanici']."-".$_COOKIE['rfBID'];
?>
<body>
	<section>
		<div class="header">
			<span class="header_text">Stok Kabul</span>
			<div class="header_icon">
				<a id="modal_trigger" href="#modal" class="btn"><span class="glyphicon glyphicon-plus"></span></a>
			</div>
		</div>
		<div class="ortakForm">
			<div class='stokContent' value="">
				<div class="solContent">
					<span class="panelHeader">Okunan RFID Etiketler</span>
					<div id="rfidContent">
						<textarea rows="5"></textarea>
					</div>
				</div>
				<div class="sagContent">
					<div id="icContent">
						<span class="panelHeader">RFID Etiket Detay </span>
						<label>RFID Tag:</label>
						<input type="text" id="rfTag" />
						<label>Ürün Adı:</label>
						<input type="text" id="rfUrunAd" />
						<label>Ürün Açıklama:</label>
						<input type="text" id="rfUrunAciklama" />
						<label>Ürün S.K.T:</label>
						<input type="text" id="rfUrunSkt" />
					</div>
				</div>
			</div>
		</div>
		<div class="stokBirimContent">
			<label>Stok Birim Seçiniz:</label>
			<?php
				$sonuc = $kontrol -> listele("SELECT id,ad FROM stok_birim");
				echo "<select id='sBirim'>";
				while ($satir = mysqli_fetch_assoc($sonuc)) {
					echo "<option value='".$satir['id']."'>".$satir['ad']."</option>";
				}
				echo "</select>";
			?>
			<button class="btn btn-success" onclick="denemeTest('kaydet');">Kaydet</button>
			<button class="btn btn-success" onclick="denemeTest('listele');">Listele</button>
		</div>
	</section>
</body>