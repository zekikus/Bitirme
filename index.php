<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/stil.css">
  <link rel="stylesheet" type="text/css" href="css/gorunum.css">
  <script src="script/jquery.js"></script>
  <script src="script/bootstrap.min.js"></script>
   <script type="text/javascript" src="script/jquery.leanModal.min.js"></script>
</head>
<?php
	session_start();
	if(isset($_SESSION['kullanici'])){
    $userInfo = $_SESSION['loginUserInfo'];
    require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/AnasayfaKontrol.php");

    $birimAdi = "Admin";
    $birimID = $userInfo["birimID"];
    if ($birimID != -1) {
      $sorgu = "SELECT ad FROM birim WHERE id = $birimID";
      $kontrol = new AnasayfaKontrol();
      $sonuc = $kontrol -> listele($sorgu);
      $birimAdi = mysqli_fetch_assoc($sonuc)['ad'];
    }
?>
<body>

<div id="wrapper">
		<div id="sidebar-wrapper">
			<!--Sidebar Sabit Kısım Bütün Sayfalarda Aynı-->
      <div class="panel-user-wrapper style1">
				<div class="panel-user">
					<img src="img/user.jpg" width="50px" height="50px" alt="user-image">
				</div>
				<div class="panel-user-name">
					Hoşgeldin <br/><?php echo $userInfo["ad"]." ".$userInfo["soyad"]; echo "<br/>".$birimAdi ?>
				</div> <br>
			</div>
			<ul class="sidebar-nav">
				<li>
					<a href="index.php?s=anasayfa" id='anasayfa'><span class="glyphicon glyphicon-home"></span> Anasayfa</a>
				</li>
				<li>
					<a href="#tanim" data-toggle="collapse"><span class="glyphicon glyphicon-cog"></span> Tanım</a>
					<div id="tanim" class="collapse">
						<ul class="sub-list">
							<li><a href="index.php?s=stokBirim"><span class="glyphicon glyphicon-list-alt"></span> Stok Birim Tanımla</a></li>
							<li><a href="index.php?s=tuketimNedeni"><span class="glyphicon glyphicon-edit"></span> Tüketim Nedeni</a></li>
							<li><a href="index.php?s=uretici""><span class="glyphicon glyphicon-user"></span> Üretici Tanımla</a></li>
							<li><a href="index.php?s=urun"><span class="glyphicon glyphicon-tint"></span> Ürün Tanımla</a></li>
							<li><a href="index.php?s=Alarm"><span class="glyphicon glyphicon-time"></span> Alarm Tanımla</a></li>
							<li><a href="index.php?s=birimTanim"><span class="glyphicon glyphicon-home"></span> Birim Tanımla</a></li>
							<li><a href="index.php?s=dolapTipi"><span class="glyphicon glyphicon-tasks"></span> Dolap Tipi Tanımla</a></li>
							<li><a href="index.php?s=kullanici"><span class="glyphicon glyphicon-user"></span> Kullanıcı Tanımla</a></li>
							<li><a href="index.php?s=STC"><span class="glyphicon glyphicon-edit"></span> STC Tanımla</a></li>
							<li><a href="index.php?s=urunTanim"><span class="glyphicon glyphicon-tint"></span> Urun Tipi Tanımla</a></li>
							<li><a href="index.php?s=imha"><span class="glyphicon glyphicon-tint"></span> İmha Et</a></li>
						</ul>
					</div>
				</li>
				<li>
					<a href="#stok" data-toggle="collapse"><span class="glyphicon glyphicon-th"></span> Stok</a>
					<div id ="stok" class="collapse">
						<ul class="sub-list">
							<li><a href="index.php?s=stok"><span class="glyphicon glyphicon-save"></span> Stok Takip</a></li>
							<li><a href="index.php?s=stokKabul"><span class="glyphicon glyphicon-save"></span> Stok Giriş İşlemleri</a></li>
							<li><a href="index.php?s=stokCikis"><span class="glyphicon glyphicon-open"></span> Stok Çıkış İşlemleri</a></li>
						</ul>
					</div>
				</li>
				<li><a  onclick="ajaxGiris('cikisYap','#anasayfa');"><span class="glyphicon glyphicon-log-out"></span> Çıkış</a></li>
			</ul>
		</div>
		<!--Sidebar-Son -->

		<!-- De-->
		<div id="page-content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12">
						<!-- Degisken Kısım -->
						<?php
							if(isset($_GET["s"])){
								include "php/Gorunum/".$_GET['s']."_Form.php";
							}else{
                include "php/Gorunum/anasayfa_Form.php";
              }

						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="script/scripts.js"></script>
</body><?php
	}else{header("Location:login.php");}
 ?>
</html>
