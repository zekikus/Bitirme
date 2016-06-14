<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/STCKontrol.php");
?>
<body>
	<section>
		<div class="header">
			<span class="header_text">Sıcaklık Takip Cihazı</span>
			<div class="header_icon">
				<a id="modal_trigger" href="#modal" class="btn"><span class="glyphicon glyphicon-plus"></span></a>
			</div>
		</div>
		<div class="search_form">
			<form>
				<label>Sıcaklık Takip Cihazı No:</label>
				<input type="text" name="tuketimNeden" id="sInput"/>
				<a id="search_sicaklikCihaz" onclick="ajaxListele('STCAjax');" ><span class="glyphicon glyphicon-list"></span></a><br/>			
			</form>
		</div>
		<div id='denemeTablo' value="">
			<!-- Ajaxtan Dönen Tablo Buraya Gelir -->
		</div>

		<div id="modal" class="popupContainer" style="display:none;">
		<section class="popupBody">
			<header class="popupHeader">
				<span class="header_title">Sıcaklık Takip Cihazı İşlem</span>
				<span class="modal_close"><i class="glyphicon glyphicon-remove"></i></span>
			</header>
			
			<div class="form">
				<!-- Inputlar -->
				<label>Stok Birim No:</label>
				<select id='stokbirimID'>
					<option value="sec">Seçiniz</option>
					<?php
						$sorgu = "SELECT * FROM stok_birim";
		
						$kontrol = new STCKontrol();
						$sonuc = $kontrol -> listele($sorgu);

						while ($satir = mysqli_fetch_assoc($sonuc)){
							echo "
								<option value=".$satir["id"].">".$satir["id"]."</option>
							";
						}
					?>
				</select><br/>
				<label>Cihaz Aktifliği:</label>
				<input type="checkbox" id='cihazAktif' onclick="checkBoxGuncelle(this);" /><br/>
				<label>Alarm Aktifliği:</label>
				<input type="checkbox" id='alarmAktif' onclick="checkBoxGuncelle(this);" /><br/>
				
				<button class="btn btn-success" id='kaydetSTC' onclick="ajaxSTCKaydet(this);" value="">Kaydet</button>
				<!-- Inputlar Son -->
			</div>
		</section>
	</div>


	<div id="sicaklikDetay" class="popupContainer" style="display:none;">
		<section class="popupBody">
			<header class="popupHeader">
				<span class="header_title">Sıcaklık Detay</span>
				<span onclick="gizle('#sicaklikDetay');" class="modal_close"><i class="glyphicon glyphicon-remove"></i></span>
			</header>
			
			<div class="formBirim" id="detaySicaklik">

			</div>
		</section>
	</div>



	<script type="text/javascript">
		$("#modal_trigger").leanModal({top : 50, overlay : 0.6, closeButton: ".modal_close" });
	</script>

	</section>
</body>