<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/AlarmKontrol.php");
?>
<body>
	<section>
		<div class="header">
			<span class="header_text">Alarm</span>
			<div class="header_icon">
				<a id="modal_trigger" href="#modal" class="btn" onclick="butonTemizle('.form');"><span class="glyphicon glyphicon-plus"></span></a>
			</div>
		</div>
		<div class="search_form">
			<form>
				<label>Alarm No:</label>
				<input type="text" id="sInput"/>
				<a id="search_alarm" onclick="ajaxCokluListele('AlarmAjax');" ><span class="glyphicon glyphicon-list"></span></a><br/>
				<label>Sıcaklık Takip Cihazı No:</label>
				<input type="text" name="tuketimNeden" id="sInput2"/>
				<a id="search_sicaklikCihaz" onclick="ajaxCokluListele('AlarmAjax');" ><span class="glyphicon glyphicon-list"></span></a><br/>
			</form>
		</div>
		<div id='denemeTablo' value="">
			<!-- Ajaxtan Dönen Tablo Buraya Gelir -->
		</div>

		<div id="modal" class="popupContainer" style="display:none;">
			<section class="popupBody">
				<header class="popupHeader">
					<span class="header_title">Alarm Detay</span>
					<span class="modal_close"><i class="glyphicon glyphicon-remove"></i></span>
				</header>

				<div class="form">
					<input type="hidden" id="alarmID" />
					<label>Sıcaklık Takip Cihazı No:</label>
					<select id='stcID'>
						<option id="ilkOpt" value="sec">Seçiniz</option>
						<?php
							$sorgu = "SELECT stc.id FROM sicakliktakipcihazi stc,stok_birim sb WHERE stc.stokbirim_id = sb.id";

							if($_SESSION["kullanici"] != -1) $sorgu = $sorgu." and sb.birim_id = '".$_SESSION["kullanici"]."'";
							$kontrol = new AlarmKontrol();
							$sonuc = $kontrol -> listele($sorgu);

							while ($satir = mysqli_fetch_assoc($sonuc)){
								echo "
									<option value=".$satir["id"].">".$satir["id"]."</option>
								";
							}
						?>
					</select><br/>
					<label>Alarm Başlangıç Zamanı:</label>
					<input type="date" id='startTime' /><br/>
					<label>Alarm Bitiş Zamanı:</label>
					<input type="date" id='endTime' /><br/>
					<label>Durum:</label>
					<select id="durum">
							<option value="1">Aktif</option>
							<option value="0">Aktif Değil</option>
					</select>
					<button class="btn btn-success" id='kaydetAlarm' onclick="ajaxAlarmKaydet(this);" value="">Kaydet</button>
					<!-- Inputlar Son -->
				</div>
			</section>
		</div>



	<script type="text/javascript">
		$("#modal_trigger").leanModal({top : 50, overlay : 0.6, closeButton: ".modal_close" });
	</script>

	</section>
</body>
