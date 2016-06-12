<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/BirimKontrol.php");
?>
<body>
	<section>
		<div class="header">
			<span class="header_text">Kullanıcı Tanım</span>
			<div class="header_icon">
				<a id="modal_trigger" href="#modal" class="btn" onclick="panelTemizle('.formBirim');"><span class="glyphicon glyphicon-plus"></span></a>
			</div>
		</div>
		<div class="search_form">
			<form>
				<label>T.C. No:</label>
				<input type="text" id='TCNo'/>
				<a id="sInput" onclick="ajaxListele('kullaniciAjax');" ><span class="glyphicon glyphicon-list"></span></a><br/>
			</form>
		</div>
		<div id='denemeTablo'>
			<!-- Ajaxtan Dönen Tablo Buraya Gelir -->
		</div>

		<div id="modal" class="popupContainer" style="display: none;">
		<section class="popupBody">
			<header class="popupHeader">
				<span class="header_title">	Kullanıcı İşlem</span>
				<span class="modal_close"><i class="glyphicon glyphicon-remove"></i></span>
			</header>
			
			<div class="form">
				<ul class="nav nav-tabs">
				    <li><a href="#kullanici" data-toggle="tab">Kullanıcı</a></li>
				     <li><a href="#kisiBilgi" data-toggle="tab">Kişi Bilgileri</a></li>
				</ul>
				<div class="tab-content" id="tabs">
				    <div class="tab-pane" id="kullanici">
				    	<label>T.C. No:</label>
						<input type="text" id="tcNo" maxlength="11" />
						<button class="btn btn-success" onclick="ajaxKullaniciKontrol();" value="">Kaydet</button>
				    </div>
				    <div class="tab-pane" id="kisiBilgi"">
				  		<label>T.C. No:</label>
				  		<input type='text' id='gTCNO' readonly="" /><br/>
				  		<label>Ad:</label>
				  		<input type='text' id='gAd'/>
				  		<label>Soyad:</label>
				  		<input type='text' id='gSoyad'/>
				  		<label>Kullanıcı Adı:</label>
				  		<input type='text' id='gKadi'/>
				  		<label>Şifre:</label>
				  		<input type='password' id='gSifre'/>
				  		<label>Şifre Tekrar:</label>
				  		<input type='password' id='gSifreTekrar'/>
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