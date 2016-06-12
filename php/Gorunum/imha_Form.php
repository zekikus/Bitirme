<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/ImhaKontrol.php");
?>
<body>
	<section>
		<div class="header">
			<span class="header_text">İmha</span>
			<div class="header_icon">
				<a id="modal_trigger" href="#modal" class="btn"><span class="glyphicon glyphicon-plus"></span></a>
			</div>
		</div>
		<div class="search_form">
			<form>
				<label>Ürün No : </label>
				<input type="text" name="tuketimNeden" id="sInput"/>
				<a id="search_tuketimNeden" onclick="ajaxListele('imhaAjax');" ><span class="glyphicon glyphicon-list"></span></a><br/>			
			</form>
		</div>
		<div id='denemeTablo' value="">
			<!-- Ajaxtan Dönen Tablo Buraya Gelir -->
		</div>

		<div id="modal" class="popupContainer" style="display:none;">
		<section class="popupBody">
			<header class="popupHeader">
				<span class="header_title">İmha Emri</span>
				<span class="modal_close"><i class="glyphicon glyphicon-remove"></i></span>
			</header>
			
			<div class="form">
				<!-- Inputlar -->
				<label>Ürün No:</label>
				<!--<input type="text"  id='urunID'/><br/>-->
				<select id='urunID'>
					<option value="sec">Seçiniz</option>
					<?php
						$sorgu = "SELECT * FROM urun";
		
						$kontrol = new ImhaKontrol();
						$sonuc = $kontrol -> listele($sorgu);

						while ($satir = mysqli_fetch_assoc($sonuc)){
							echo "
								<option value=".$satir["tag_id"].">".$satir["tag_id"]."</option>
							";
						}
					?>
				</select><br/>
				<label>İşlem Tarihi:</label>
				<input type="text" id='islemTarih' value="<?php echo date("d-m-Y H:i:s") ?>" disabled/><br/>
				<label>Tüketim Nedeni:</label>
				<select id='tuketimNeden'>
					<option value="sec">Seçiniz</option>
					<?php
						$sorgu = "SELECT * FROM tuketim_nedeni";
		
						$kontrol = new ImhaKontrol();
						$sonuc = $kontrol -> listele($sorgu);

						while ($satir = mysqli_fetch_assoc($sonuc)){
							echo "
								<option value=".$satir["id"].">".$satir["tanim"]."</option>
							";
						}
					?>
				</select><br/>
				<label>Açıklama</label>
				<input type="text"  id='aciklama'/><br/>
				<button class="btn btn-success" id='kaydetImha' onclick="ajaxImhaKaydet(this);" value="">Kaydet</button>
				
				<!-- Inputlar Son -->
			</div>
		</section>
	</div>

	<script type="text/javascript">
		$("#modal_trigger").leanModal({top : 50, overlay : 0.6, closeButton: ".modal_close" });
	</script>

	</section>
</body>