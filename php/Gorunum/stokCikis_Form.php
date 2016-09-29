<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/StokKabulKontrol.php");
	$kontrol = new StokKabulKontrol();
	if(!isset($_COOKIE['rfBID']))
		setcookie("rfBID",$_SESSION['kullanici']);
?>
<body>
	<section>
		<div class="header">
			<span class="header_text">Stok Çıkış</span>
			<div class="header_icon">
			</div>
		</div>
		<div class="ortakForm">
			<div class='stokContent' value="">
				<div class="solContent">
					<span class="panelHeader">Uygulanacak Hasta T.C. No:</span>
						<label>Hasta T.C. No:</label>
						<input type="text" id="rfTC" />
						<label>Tüketim Nedeni:</label>
						<select id="rfTN">
							<?php
								$sonuc = $kontrol -> listele("SELECT tanim FROM tuketim_nedeni");

								while ($satir = mysqli_fetch_assoc($sonuc)) {
									echo "<option value='".$satir['tanim']."'>".$satir['tanim']."</option>";
								}
							?>
						</select>
						<button class="btn btn-success" onclick="ajaxStokCikis('listele');" style="margin:5% 35%;">Detay Getir</button>
				</div>
				<div class="sagContent">
					<div id="icContent">
						<span class="panelHeader">RFID Etiket Detay </span>
						<input type="hidden" id="rfuID" />
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
			<button class="btn btn-success" onclick="ajaxStokCikis('kaydet');">Kaydet</button>
			
		</div>
	</section>
</body>