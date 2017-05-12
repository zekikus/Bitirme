<body>
	<section>
		<div class="header">
			<span class="header_text">Tüketim Nedeni</span>
			<div class="header_icon">
				<?php
					if($_SESSION["kullanici"] == -1) 
						echo '<a id="modal_trigger" href="#modal" class="btn" onclick="butonTemizle(\'.form\');"><span class="glyphicon glyphicon-plus"></span></a>';
				?>
			</div>
		</div>
		<div class="search_form">
			<form>
				<label>Tüketim Nedeni:</label>
				<input type="text" name="tuketimNeden" id="sInput"/>
				<a id="search_tuketimNeden" onclick="ajaxListele('tuketimNedeniAjax');" ><span class="glyphicon glyphicon-list"></span></a><br/>			
			</form>
		</div>
		<div id='denemeTablo' value="tuketimNedeni">
			<!-- Ajaxtan Dönen Tablo Buraya Gelir -->
		</div>

		<div id="modal" class="popupContainer" style="display:none;">
		<section class="popupBody">
			<header class="popupHeader">
				<span class="header_title">Tüketim Nedeni İşlem</span>
				<span class="modal_close"><i class="glyphicon glyphicon-remove"></i></span>
			</header>
			
			<div class="form">
				<!-- Inputlar -->
				<label>Tanım:</label>
				<input type="text"  id='tuketimTanim'/><br/>
				<label>Aktif Mi:</label>
				<input type="checkbox" id='aktifMi' onclick="checkBoxGuncelle(this);" /><br/>
				<div id='erisilebilirlik'>
					<label>Erişilebilirlik:</label>
					<select>
						<option value="-1">Sadece Yöneticiler</option>
						<option value="0">Bütün Kullanıcılar</option>
					</select>
				</div><br/>
				
				<button class="btn btn-success" id='kaydetTN' onclick="ajaxTuketimNedeniKaydet(this);" value="">Kaydet</button>
				<!-- Inputlar Son -->
			</div>
		</section>
	</div>

	<script type="text/javascript">
		$("#modal_trigger").leanModal({top : 50, overlay : 0.6, closeButton: ".modal_close" });
	</script>

	</section>
</body>