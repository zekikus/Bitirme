<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/BirimKontrol.php");
?>
<body>
	<section>
		<div class="header">
			<span class="header_text">Birim Tanım</span>
			<div class="header_icon">
			<?php
				if($_SESSION["kullanici"] == -1)
					echo '<a id="modal_trigger" href="#modal" class="btn" onclick="panelTemizle(\'.formBirim\');"><span class="glyphicon glyphicon-plus"></span></a>';
			?>
			</div>
		</div>
		<div class="search_form">
			<form>
				<label>Birim İl:</label>
				<select id="sInput" value="" onchange="ajaxIlceGetir('#ilceler','#sInput','birimAjax');">
					<?php
						$sorgu = "SELECT * FROM il";
						$kontrol = new BirimKontrol();
						$sonuc = $kontrol -> listele($sorgu);

						while ($satir = mysqli_fetch_assoc($sonuc)) {
							echo "
								<option value=".$satir["id"].">".$satir["ad"]."</option>
							";
						}
					?>
				</select><br/>
				
				<div id='ilceler'>
					<!-- Ajaxtan Ilceler Gelicek -->
				</div>		
			</form>
		</div>
		<div id='denemeTablo' value="dolapTipi">
			<!-- Ajaxtan Dönen Tablo Buraya Gelir -->
		</div>

		<div id="modal" class="popupContainer" style="display: none;">
		<section class="popupBody">
			<header class="popupHeader">
				<span class="header_title">	Ürün Tanım İşlem</span>
				<span class="modal_close"><i class="glyphicon glyphicon-remove"></i></span>
			</header>
			
			<div class="formBirim">
				<ul class="nav nav-tabs">
				    <li><a href="#birim" data-toggle="tab">Birim</a></li>
				    <li id="stokLink"><a href="#stokPanel" data-toggle="tab" onclick="formGetir('#stokPanel','stokForm');">Stok Özet</a></li>
				    <li id="kullaniciLink"><a href="#kullaniciPanel" data-toggle="tab" onclick="formGetir('#kullaniciPanel','kullaniciForm');">Kullanıcı</a></li>
				</ul>
				<div class="tab-content" id="tabs">
				    <div class="tab-pane" id="birim">
				    	<input type="hidden" id="birimID" value=""/>
				    	<label>Birim Adı:</label>
						<input type="text"  id='ad' value=""/><br/>
						<div id="birimIl">
							<label>Birim İl:</label>
							<select onchange="ajaxIlceGetir('#birimIlce','#birimIl select','birimAjax');">
							<option id="ilkOpt"></option>
							<?php
								$sorgu = "SELECT * FROM il";
								$kontrol = new BirimKontrol();
								$sonuc = $kontrol -> listele($sorgu);

								while ($satir = mysqli_fetch_assoc($sonuc)) {
									echo "
										<option value=".$satir["id"].">".$satir["ad"]."</option>
									";
								}
							?>
							</select><br/>
						</div>
						<div id="birimIlce">
							<!-- Ajax Bilgileri Gelicek -->
						</div>
						<label>Birim Adres:</label>
						<textarea id="birimAdres"></textarea><br/>
						<div id="kullanici1">
							<label>Alarm Kullanıcı:</label>
							<select>
								<option value="0" id="firstOpt"></option>
								<?php
									$sorgu = "SELECT * FROM kullanici";
									$kontrol = new BirimKontrol();
									$sonuc = $kontrol -> listele($sorgu);

									while ($satir = mysqli_fetch_assoc($sonuc)) {
									echo "
										<option value=".$satir["id"].">".$satir["ad"]." ".$satir["soyad"]."</option>
									";
								}
								?>
							</select>
						</div>
						<div id="kullanici2">
							<label>Alarm Kullanıcı:</label>
							<select>
								<option value="0" id="firstOpt"></option>
								<?php
									$sorgu = "SELECT * FROM kullanici";
									$kontrol = new BirimKontrol();
									$sonuc = $kontrol -> listele($sorgu);

									while ($satir = mysqli_fetch_assoc($sonuc)) {
									echo "
										<option value=".$satir["id"].">".$satir["ad"]." ".$satir["soyad"]."</option>
									";
								}
								?>
							</select>
						</div>
						<button class="btn btn-success" id='kaydetBT' onclick="ajaxBirimKaydet(this);" value="">Kaydet</button>
				    </div>
				    <div class="tab-pane" id="stokPanel"">
				    	<!-- Ajax Bilgileri Gelicek -->
				    </div>
				    <div class="tab-pane" id="kullaniciPanel">
				    	<!-- Ajax Bilgileri Gelicek -->
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