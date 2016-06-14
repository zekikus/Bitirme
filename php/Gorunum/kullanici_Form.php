<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/KullaniciKontrol.php");
	$kontrol = new KullaniciKontrol();
?>
<body>
	<section>
		<div class="header">
			<span class="header_text">Kullanıcı Tanım</span>
			<div class="header_icon">
				<a id="modal_trigger" href="#modal" class="btn" onclick="panelGoster();"><span class="glyphicon glyphicon-plus"></span></a>
			</div>
		</div>
		<div class="search_form">
			<form>
				<label>T.C. No:</label>
				<input type="text" id='sInput'/>
				<a onclick="ajaxListele('kullaniciAjax');" ><span class="glyphicon glyphicon-list"></span></a><br/>
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
			
			<div class="ortakForm">
				<ul class="nav nav-tabs">
					<li id='kLink'><a href="#kullanici" data-toggle="tab">Kullanıcı</a></li>
					 <li id='kisLink'><a href="#kisiBilgi" data-toggle="tab">Kişi Bilgileri</a></li>
					  <li id='aLink' onclick="ajaxIslemYap('#userID','adresListele','#adresSonucccc','kullaniciAjax');"><a href="#adresBilgi" data-toggle="tab">Adres Bilgileri</a></li>
					   <li id='iLink' onclick="ajaxIslemYap('#userID','iletisimListele','#iletisimSonuc','kullaniciAjax');"><a href="#iletisimBilgi" data-toggle="tab">İletişim Bilgileri</a></li>
					   <input type="hidden" id='userID' />
				</ul>
				<div class="tab-content" id="tabs">
					<div class="tab-pane" id="kullanici" style="margin: 25px 15%;">
						<label style="width:20%">T.C. No:</label>
						<input type="text" id="tcNo" maxlength="11" />
						<button class="btn btn-success" onclick="ajaxIslemYap('#tcNo','kullaniciKontrol','#denemeTablo','kullaniciAjax');" value="">Kaydet</button>
					</div>
					<div class="tab-pane" id="kisiBilgi" style="margin-top:25px;">
						<label>T.C. No:</label>
						<input type='text' id='gTCNO' readonly="" /><br/>
						<label>Ad:</label>
						<input type='text' id='gAd'/><br/>
						<label>Soyad:</label>
						<input type='text' id='gSoyad'/><br/>
						<label>Kullanıcı Adı:</label>
						<input type='text' id='gKadi'/><br/>
						<label>Şifre:</label>
						<input type='password' id='gSifre'/><br/>
						<label>Şifre Tekrar:</label>
						<input type='password' id='gSifreTekrar'/><br/>
						<button class="btn btn-success" id='kaydetKu' onclick="ajaxKullaniciKaydet(this)" value=""></button>
					</div>
					<div  class="tab-pane" id="adresBilgi"">
						<a id="adres_Modal" href="#modalAdres" class="btn" style="float:right;"><span id='sPlus' class="glyphicon glyphicon-plus"></span></a>
						<div id='adresSonucccc'>
							<!-- Ajax Sonuçları Dönecek -->
						</div>
					</div>
					<div class="tab-pane" id="iletisimBilgi">
						<a id="iletisim_Modal" href="#modalIletisim" class="btn" style="float:right;"><span id='sPluss' class="glyphicon glyphicon-plus"></span></a>
						<div id='iletisimSonuc'>
							<!-- Ajax Sonuçları Dönecek -->
						</div>
					</div>
				</div>
			</div>
			
			<div id="modalAdres" class="popupContainer" style="display:none;">
				<section class="popupBody">
					<header class="popupHeader">
						<span class="header_title">	Adres İşlem</span>
						<span class="close_Adres" onclick="gizle('#modalAdres')"><i class="glyphicon glyphicon-remove"></i></span>
					</header>
				</section>
				<div class="ortakForm">
					<input type="hidden" id='uID'/>
					<label>Adres Tipi:</label>
					<select id='adrsTip'>
						<option value="Ev">Ev</option>
					</select><br/>
					<div id='kullaniciIl'>
						<label>İl:</label>
							<select onchange="ajaxIlceGetir('#kullaniciIlce','#kullaniciIl select','kullaniciAjax');">
							<option id="ilkOpt"></option>
							<?php
								$sorgu = "SELECT * FROM il";
								
								$sonuc = $kontrol -> listele($sorgu);

								while ($satir = mysqli_fetch_assoc($sonuc)) {
									echo "
										<option value=".$satir["id"].">".$satir["ad"]."</option>
									";
								}
							?>
							</select><br/>
					</div>
					<div id="kullaniciIlce">
							<!-- Ajax Bilgileri Gelicek -->
					</div>
					<label>Adres:</label>
					<textarea id='kullaniciAdres'></textarea>
					<button id='kaydetAdr' class="btn btn-success" id='kaydetAdres' onclick="ajaxAdresKaydet(this)" value="">Kaydet</button>
				</div>
			</div>

			<div id="modalIletisim" class="popupContainer" style="display: none;">
				<section class="popupBody">
					<header class="popupHeader">
						<span class="header_title">	İletişim İşlem</span>
						<span class="close_Iletisim" onclick="gizle('#modalIletisim')"><i class="glyphicon glyphicon-remove"></i></span>
					</header>
				</section>
				<div class="ortakForm">
					<label>Iletisim Tipi:</label>
					<select id='iletisimTip'>
						<option value="Cep Telefonu">Cep Telefonu</option>
						<option value="E-posta">E-Posta</option>
						<option value="Sabit Telefon">Sabit Telefon</option>
					</select><br/>
					<label>Değer:</label>
					<input type="text" id="iDeger" />
					<div id='iletisimDeger'>
						<!-- Ajaxtan Gelen Değer -->
					</div>
					<button id='kaydetIle' class="btn btn-success" onclick="ajaxIletisimKaydet(this);" value="">Kaydet</button>
				</div>
			</div>
	</div>

	</section>
	
	<script type="text/javascript">
		$("#modal_trigger").leanModal({top : 50, overlay : 0.6, closeButton: ".modal_close" });
		$("#adres_Modal").leanModal({top : 50, overlay : 0.6, closeButton: ".close_Adres" });
		$("#iletisim_Modal").leanModal({top : 50, overlay : 0.6, closeButton: ".close_Iletisim" });
	</script>
</body>