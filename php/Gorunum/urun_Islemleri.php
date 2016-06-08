<!DOCTYPE html>
<html>
<head>
	  <meta charset="UTF-8"/>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="css/stil.css">
	  <script type="text/javascript" src="script/jquery.js"></script>
	  <script type="text/javascript" src="script/jquery.leanModal.min.js"></script>
</head>
<body>
	<?php

		if(isset($_REQUEST["islem"])){

			$islem = $_REQUEST["islem"];

			switch ($islem) {
				case 'kaydet':
					# code...
					break;
				
				default:
					# code...
					break;
			}
			include "php/Model/UrunIslemleri.php";

			$urunIslem = new UrunIslemleri();
			$urunIslem -> ekle();
		}

	?>
	<div id="modal" class="popupContainer" style="display:none;">
		<section class="popupBody">
			<header class="popupHeader">
				<span class="header_title">	Ürün Ekle</span>
				<span class="modal_close"><i class="glyphicon glyphicon-remove"></i></span>
			</header>
			<form action="index.php" method="POST">
				<label>Adı:</label>
				<input type="text" name="ad" /><br/>
				<label>Ürün Tanımı:</label>
				<select name="urunTanim">
					<option value="1">Aşı</option>
					<option value="2">Serum</option>
				</select><br/>
				<label>Ürün No:</label>
				<input type="text" name="urunNo" /><br/>
				<label>Üretici:</label>
				<select name="uretici">
					<option value="1">Abdi İbrahim</option>
					<option value="2">Bayer</option>
				</select><br/>
				<label>Açıklama:</label>
				<input type="text" name="aciklama" /><br/>
				<label>Ürün Dozu:</label>
				<input type="text" name="urunDoz" /><br/>
				<label>Seans Tipi:</label>
				<select name="seansTip">
					<option value="1">Günde 1</option>
					<option value="2">Günde 2</option>
				</select><br/>
				<label>Seans Sayısı:</label>
				<input type="text" name="seansSayi" /><br/>
				<label>Kullanım Süresi:</label>
				<input type="text" name="kullanimSuresi" /><br/>
				<input type="submit" value="Kaydet" class="btn btn-success"/>
				<input type="hidden" name="islem" value="kaydet" />
			</form>
		</section>
	</div>

	<script type="text/javascript">
		$("#modal_trigger").leanModal({top : 50, overlay : 0.6, closeButton: ".modal_close" });
	</script>
</body>
</html>