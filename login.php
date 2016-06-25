<!DOCTYPE html>
<?php 
	session_start();
	if(!isset($_SESSION['kullanici'])){
?>
<html>
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/gorunum.css">
  <script src="script/jquery.js"></script>
  <script src="script/scripts.js"></script>
  <script type="text/javascript" src="script/jquery.leanModal.min.js"></script>
</head>
<body class="body">
	<div class="container">
		<input type="hidden" id="test" />
		<p>Web ATS Giris Paneli</p>
		<div class="login-panel">
			<span class="glyphicon glyphicon-user"></span><input type="text" id="lgnKad" placeholder="Kullanıcı Adı" /><br/>
			<span class="glyphicon glyphicon-lock"></span><input type="password"  id="lgnSifre" placeholder="Sifre" /><br/>
			<button class="btn btn-primary" onclick="ajaxGiris('girisYap','#lgnEmail');" style="margin-left:18%;">Giris Yap</button>
			<button id="modal_trigger" onclick="butonTemizle('.ortakForm form');" href="#modal" class="btn btn-primary">Sifremi Unuttum</button>
		</div>
	</div>

	<div id="modal" class="popupContainer" style="display:none; width:40%; margin-top:5%;">
		<section class="popupBody">
			<header class="popupHeader">
				<span class="header_title">Sifremi Unuttum</span>
				<span class="modal_close"><i class="glyphicon glyphicon-remove"></i></span>
			</header>
		
			<div class="ortakForm" id="sifreUnuttum">
					<input type="email" id="lgnEmail" placeholder="Kayıtlı Email Adresinizi Giriniz">
					<button class="btn btn-success" id="lgnGonder" onclick="ajaxGiris('sifirla','#lgnEmail');">Gonder</button>
			</div>
		</section>
	</div>	
</body>

	<script type="text/javascript">
		$("#modal_trigger").leanModal({top : 50, overlay : 0.6, closeButton: ".modal_close" });
	</script>
	<?php } else{ header("Location:index.php");} ?>
</html>
