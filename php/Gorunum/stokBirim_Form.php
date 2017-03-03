<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/StokBirimKontrol.php");
	$kontrol = new StokBirimKontrol();
?>
<body>
	<section>
		<div class="header">
			<span class="header_text">Stok Birim</span>
			<div class="header_icon">
				<a id="modal_trigger" href="#modal" class="btn" onclick="temizle('.ortakForm','#stokBirimPanel');"><span class="glyphicon glyphicon-plus"></span></a>
			</div>
		</div>
		<div class="search_form">
			<form>
				<label>Stok Birim İl:</label>
				<select id='stokIl' onchange="ajaxIlceGetir('#stokBirimIlce',this,'stokBirimAjax');">
					<option id='ilkOpt'></option>
					<?php
						
						$sonuc = $kontrol -> listele("SELECT * FROM il");

						while($satir = mysqli_fetch_assoc($sonuc)){
							echo "<option value=".$satir['id'].">".$satir['ad']."</option>";
						}
					?>
				</select>
				<div id='stokBirimIlce'>
					<!-- Ajax Bilgileri Gelicek -->
				</div>
				<div id='biSonuc'>
					<!-- Ajax Bilgileri Gelicek -->
				</div>		
			</form>
		</div>
		<div id='denemeTablo' value="">
			<!-- Ajaxtan Dönen Tablo Buraya Gelir -->
		</div>

		<div id="modal" class="popupContainer" style="display:none;">
		<section class="popupBody">
			<header class="popupHeader">
				<span class="header_title">Stok Birim İşlem</span>
				<span class="modal_close"><i class="glyphicon glyphicon-remove"></i></span>
			</header>
			
			<div class="ortakForm">
				<ul class="nav nav-tabs">
					    <li><a href="#stokBirimPanel" data-toggle="tab">Stok Birim Detayı</a></li>
					    <li id="stLink"><a href="#stokPanel" data-toggle="tab" onclick="ajaxIslemYap('#sbID','stokListele','#stokPanelTable','stokBirimAjax');">Stok Listesi</a></li>
					    <li id='siLink'><a href="#sicaklikPanel" data-toggle="tab" onclick="ajaxIslemYap('#sbID','sicaklikListele','#sicaklikPanelTable','stokBirimAjax');">Sıcaklık Ölçümleri</a></li>
				</ul>
				<div class="tab-content" id="tabs">
					<div class="tab-pane" id="stokBirimPanel">
						<div class="solPanel">
							<span class='panelHeader'>Genel Bilgi</span>
							<label>Birim:</label>
							<select id='birimDeger'>
								<?php
									$sorgu = "SELECT id,ad FROM birim";

									if($_SESSION["kullanici"] != -1) $sorgu = $sorgu." WHERE id = ".$_SESSION["kullanici"]."";

									$sonuc = $kontrol -> listele($sorgu);
									while($satir = mysqli_fetch_assoc($sonuc)){
										echo "<option value=".$satir['id'].">".$satir['ad']."</option>";
									}
								?>
							</select>
							<input type="hidden" id="sbID">
							<label>Stok Birim ID:</label>
							<input type="text" id="stokBirimID" disabled="true" /><br/>
							<label>Sıcaklık Üst Limiti:</label>
							<input type="text" id="sAlt" /><br/>
							<label>Sıcaklık Alt Limiti:</label>
							<input type="text" id="sUst" /><br/>
							<label>Uyarı Kullanıcı 1:</label>
							<input type="text" id="uyariUser1" disabled="true" /><br/>
							<label>Uyarı Kullanıcı 2:</label>
							<input type="text" id="uyariUser2" disabled="true" /><br/>
						</div>
						<div class="sagPanel">
							<span class='panelHeader'>Detay Bilgi</span>
							<label>Stok Birim Tipi:</label>
							<select id='sbTip' value="">
							<?php
								$sonuc = $kontrol -> listele("SELECT id,ad FROM dolap_tip");

								while($satir = mysqli_fetch_assoc($sonuc)){
										echo "<option value=".$satir['ad'].">".$satir['ad']."</option>";
								}
							?>
							</select>
							<!--<input type="text" id="sbTip" /><br/>-->
							<label>Açıklama:</label>
							<input type="text" id="sbAciklama" /><br/>
							<label>Hacim:</label>
							<input type="text" id="sbHacim" /><br/>
							<label>Marka:</label>
							<input type="text" id="sbMarka" /><br/>
							<label>Model:</label>
							<input type="text" id="sbModel" /><br/>
							<label>Üretim Tarihi:</label>
							<input type="text" id="sbUT" /><br/>
						</div>
						<button class="btn btn-success" id='kaydetSB' onclick="ajaxSBKaydet(this);" value="">Kaydet</button>
					</div>

					<div class="tab-pane" id="stokPanel">
						<label>Birim :</label>
						<input type="text" id='panelBirim' disabled="true" /><br/>
						<label>Stok Birim :</label>
						<input type="text" id='panelSBirim' disabled="true" />
						<div id='stokPanelTable'>
							<!-- Ajax Bilgileri Gelicek -->
						</div>
					</div>
					<div class="tab-pane" id="sicaklikPanel">
						
						<div id='sicaklikPanelTable'>
							<!-- Ajax Bilgileri Gelicek -->
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>



	<script type="text/javascript">
		$("#modal_trigger").leanModal({top : 50, overlay : 0.6, closeButton: ".modal_close" });
	</script>

	</section>
</body>