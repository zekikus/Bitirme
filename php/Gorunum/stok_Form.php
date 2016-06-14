<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/StokKontrol.php");
	$kontrol = new StokKontrol();
?>
<body>
	<section>
		<div class="header">
			<span class="header_text">Stok</span>
		
		</div>
		<div class="search_form">
			<form>
				<label>Ürün:</label>
				<select id="sInput">
					<option id='ilkUrun'></option>
					<?php
						$sonuc = $kontrol -> listele("SELECT id,ad,tag_id FROM urun");

						while($satir = mysqli_fetch_assoc($sonuc)){
							echo "<option value=".$satir['id'].">".$satir['ad']."</option>";
						}
					?>
				</select>
				<a onclick="ajaxCokluListele('stokAjax');" ><span class="glyphicon glyphicon-list"></span></a><br/>
				<label>İl:</label>
				<select id='stokIl' value="" onchange="ajaxIlceGetir('#stokIlce',this,'stokAjax');">
					<option id='ilkOpt'></option>
					<?php
						
						$sonuc = $kontrol -> listele("SELECT * FROM il");

						while($satir = mysqli_fetch_assoc($sonuc)){
							echo "<option value=".$satir['id'].">".$satir['ad']."</option>";
						}
					?>
				</select>
				<div id='stokIlce'>
					<!-- Ajax Bilgileri Gelicek -->
				</div>	
				<div id='bSonuc'>
					<!-- Ajax Bilgileri Gelicek -->
				</div>
				<div id='sbSonuc'>
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
					<span class="header_title">Stok Detay</span>
					<span class="modal_close"><i class="glyphicon glyphicon-remove"></i></span>
				</header>
				
				<div class="ortakForm">
					<ul class="nav nav-tabs">
					    <li><a href="#urunPanel" data-toggle="tab">Ürün Detayı</a></li>
					    <li id=""><a href="#tuketimPanel" data-toggle="tab" onclick="ajaxIslemYap('#stokID','tuketimListele','#tuketimTable','stokAjax');">Tüketim Detayı</a></li>
					</ul>
					<div class="tab-content" id="tabs">
					    <div class="tab-pane" id="urunPanel" style="margin:15px 20%">
					    	<input type="hidden" id="stokID"  />
					    	<label>Ürün Tipi:</label>
					    	<input type="text" id="uTip" readonly="true" /><br/>
					    	<label>Ürün No:</label>
					    	<input type="text" id="uNo" readonly="true"/><br/>
					    	<label>Üretici Firma:</label>
					    	<input type="text" id="uFirma" readonly="true" /><br/>
					    	<label>Ürün Tanım:</label>
					    	<input type="text" id="uTanim" readonly="true"/><br/>
					    	<label>Ürün Adı:</label>
					    	<input type="text" id="uAd" readonly="true"/><br/>
					    	<label>Birim:</label>
					    	<input type="text" id="uBirim" readonly="true"/><br/>
					    	<label>Stok Birim:</label>
					    	<input type="text" id="usBirim" readonly="true"/><br/>
					    	<label>Doz:</label>
					    	<input type="text" id="uDoz" readonly="true"/><br/>
					    	<label>Son Kullanım Tarihi:</label>
					    	<input type="text" id="uSKT" readonly="true"/><br/>
					    </div>
					    <div class="tab-pane" id="tuketimPanel">
					    	<label>Birim:</label>
					    	<input type="text" id="tBirim" readonly="true" /><br/>
					    	<label>Stok Birim:</label>
					    	<input type="text" id="tSB" readonly="true"/><br/>
					    	<label>Ürün Ad:</label>
					    	<input type="text" id="tAd" readonly="true" /><br/>
					    	<div id='tuketimTable'>
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