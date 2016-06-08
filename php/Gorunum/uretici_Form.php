<body>
	<section>
		<div class="header">
			<span class="header_text">Uretici</span>
			<div class="header_icon">
				<a id="modal_trigger" href="#modal" class="btn"><span class="glyphicon glyphicon-plus"></span></a>
			</div>
		</div>
		<div class="search_form">
			<form>
				<label>Üretici Adı:</label>
				<input type="text" name="ureticiAd" id="sInput"/>
				<a id="search_glyph" onclick="ajaxListele('ajaxUretici');"><span class="glyphicon glyphicon-list"></span></a><br/>
				
			</form>
		</div>
		<div id='denemeTablo'>
			<!-- Ajaxtan Dönen Tablo Buraya Gelir -->
		</div>

		<div id="modal" class="popupContainer" style="display:none;">
		<section class="popupBody">
			<header class="popupHeader">
				<span class="header_title">	Üretici İşlem</span>
				<span class="modal_close"><i class="glyphicon glyphicon-remove"></i></span>
			</header>
			
			<div class="form">
				<!-- Inputlar -->
				<label>Adı:</label>
				<input type="text" name="ad" id='ad' value="" /><br/>
				<label>Ülke:</label>
				<input type="text" name="ulke" id='ulke' value="" /><br/>
				
				<button class="btn btn-success" id='ureticiKaydet' value="" onclick="ajaxUreticiKaydet(this);">Kaydet</button>
				<!-- Inputlar Son -->
			</div>
		</section>
	</div>

	<script type="text/javascript">
		$("#modal_trigger").leanModal({top : 50, overlay : 0.6, closeButton: ".modal_close" });
	</script>

	</section>
</body>