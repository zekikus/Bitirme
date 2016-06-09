<body>
	<section>
		<div class="header">
			<span class="header_text">Ürün Tanım</span>
			<div class="header_icon">
				<a id="modal_trigger" href="#modal" class="btn" onclick="butonTemizle();"><span class="glyphicon glyphicon-plus"></span></a>
			</div>
		</div>
		<div class="search_form">
			<form>
				<label>Ürün Adı:</label>
				<input type="text" name="dolapTip" id="sInput"/>
				<a id="search_dolapTip" onclick="ajaxListele('urunTanimAjax');" ><span class="glyphicon glyphicon-list"></span></a><br/>			
			</form>
		</div>
		<div id='denemeTablo' value="dolapTipi">
			<!-- Ajaxtan Dönen Tablo Buraya Gelir -->
		</div>

		<div id="modal" class="popupContainer" style="display:none;">
		<section class="popupBody">
			<header class="popupHeader">
				<span class="header_title">	Ürün Tanım İşlem</span>
				<span class="modal_close"><i class="glyphicon glyphicon-remove"></i></span>
			</header>
			
			<div class="form">
				<!-- Inputlar -->
				<label>Ürün Adı:</label>
				<input type="text"  id='ad' value="" /><br/>
				<label>Ürün Tipi:</label>
				<select id="urunTip" value=''>
					<option value="Aşı">Aşı</option>
				</select><br/>
				<label>Ürün Açıklama:</label>
				<textarea id="urunAciklama"></textarea><br/>
				
				<button class="btn btn-success" id='kaydetUT' onclick="ajaxUrunTanimKaydet(this);" value="">Kaydet</button>
				<!-- Inputlar Son -->
			</div>
		</section>
	</div>

	<script type="text/javascript">
		$("#modal_trigger").leanModal({top : 50, overlay : 0.6, closeButton: ".modal_close" });
	</script>

	</section>
</body>