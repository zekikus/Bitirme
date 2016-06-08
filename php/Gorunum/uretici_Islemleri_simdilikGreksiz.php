<!DOCTYPE html>
<html>
<head>
	  <meta charset="UTF-8"/>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="css/stil.css">
	  <script type="text/javascript" src="script/jquery.leanModal.min.js"></script>
</head>
<body>
	
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
				
				<button class="btn btn-success" id='ureticiKaydet'>Kaydet</button>
				<!-- Inputlar Son -->
			</div>
		</section>
	</div>

	<script type="text/javascript">
		$("#modal_trigger,#modal_trigger2").leanModal({top : 50, overlay : 0.6, closeButton: ".modal_close" });
	</script>
</body>
</html>