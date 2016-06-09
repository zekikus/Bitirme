<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/UrunKontrol.php");
?>
<body>
	<section>
		<div class="header">
			<span class="header_text">Urun</span>
			<div class="header_icon">
				<a id="modal_trigger" href="#modal" class="btn" onclick="butonTemizle(this);"><span class="glyphicon glyphicon-plus"></span></a>
			</div>
		</div>
		<div class="search_form">
			<form>
				<label>Ürün No:</label>
				<input type="text" id="sInput" />
				
				<label>Ürün Adı:</label>
				<input type="text" id="sInput2" />
				<a onclick="ajaxCokluListele('urunAjax');"><span class="glyphicon glyphicon-list"></span></a>
			</form>
		</div>
		<div id='denemeTablo' value="dolapTipi">
			<!-- Ajaxtan Dönen Tablo Buraya Gelir -->
		</div>

		<div id="modal" class="popupContainer" style="display:none;">
		<section class="popupBody">
			<header class="popupHeader">
				<span class="header_title">	Ürün Ekle</span>
				<span class="modal_close"><i class="glyphicon glyphicon-remove"></i></span>
			</header>
			<div class="form">
				<label>Adı:</label>
				<input type="text" id="ad" /><br/>
				<label>Ürün Tanımı:</label>
				<select id="urunTanim" value=''>
					<?php
						$kontrol = new UrunKontrol();
						$sonuc = $kontrol -> listele("SELECT id,ad FROM uruntanim");

						while ($satir = mysqli_fetch_assoc($sonuc)) {
							echo "<option value=".$satir["id"].">".$satir["ad"]."</option>";
						}
					?>
				</select><br/>
				<label>Ürün No:</label>
				<input type="text" id="urunNo" maxlength="11"/><br/>
				<label>Üretici:</label>
				<select id="uretici" value=''>
					<?php
						$kontrol = new UrunKontrol();
						$sonuc = $kontrol -> listele("SELECT id,ad FROM uretici");

						while ($satir = mysqli_fetch_assoc($sonuc)) {
							echo "<option value=".$satir["id"].">".$satir["ad"]."</option>";
						}
					?>
				</select><br/>
				<label>Açıklama:</label>
				<input type="text" id="aciklama" /><br/>
				<label>Ürün Dozu:</label>
				<input type="text" id="urunDoz" /><br/>
				<label>Seans Tipi:</label>
				<select id="seansTip">
					<option value="1">Günlük</option>
					<option value="2">Aylık</option>
				</select><br/>
				<label>Seans Sayısı:</label>
				<input type="text" id="seansSayi" /><br/>
				<label>Kullanım Süresi:</label>
				<input type="text" id="kullanimSuresi" /><br/>
				<button class="btn btn-success" id="kaydetUrun" onclick="ajaxUrunKaydet(this);">Kaydet</button>
			</div>
		</section>
	</div>

	<script type="text/javascript">
		$("#modal_trigger").leanModal({top : 50, overlay : 0.6, closeButton: ".modal_close" });
	</script>
	</section>
</body>