<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/STCKontrol.php");
?>
<body>
	<section>
		<div class="header">
			<span class="header_text">Alarm</span>
			<!--<div class="header_icon">
				<a id="modal_trigger" href="#modal" class="btn"><span class="glyphicon glyphicon-plus"></span></a>
			</div>-->
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
			
				<div class="ortakForm" id="alarmDetay">

				</div>
			</section>
		</div>



	<script type="text/javascript">
		$("#modal_trigger").leanModal({top : 50, overlay : 0.6, closeButton: ".modal_close" });
	</script>

	</section>
</body>