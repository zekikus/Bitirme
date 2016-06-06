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
</head>
<body>

<div id="wrapper">
		<div id="sidebar-wrapper">
			<!--Sidebar Sabit Kısım Bütün Sayfalarda Aynı-->
			<ul class="sidebar-nav">
				<li>
					<a href="#" ><span class="glyphicon glyphicon-home"></span> Anasayfa</a>
				</li>
				<li>
					<a href="#tanim" data-toggle="collapse"><span class="glyphicon glyphicon-cog"></span> Tanım</a>
					<div id="tanim" class="collapse">
						<ul class="sub-list">
							<li><a href="#"><span class="glyphicon glyphicon-list-alt"></span> Stok Birim Tanımla</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-edit"></span> Tüketim Nedeni</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-user"></span> Üretici Tanımla</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-tint"></span> Ürün Tanımla</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-time"></span> Alarm Tanımla</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-home"></span> Birim Tanımla</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-tasks"></span> Dolap Tipi Tanımla</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-user"></span> Kullanıcı Tanımla</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-edit"></span> Soğuk Oda Tipi Tanımla</a></li>
						</ul>
					</div>
				</li>
				<li>
					<a href="#stok" data-toggle="collapse"><span class="glyphicon glyphicon-th"></span> Stok</a>
					<div id ="stok" class="collapse">
						<ul class="sub-list">
							<li><a href="#"><span class="glyphicon glyphicon-save"></span> Stok Giriş İşlemleri</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-open"></span> Stok Çıkış İşlemleri</a></li>
						</ul>
					</div>				
				</li>
				<li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Çıkış</a></li>
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
							include "php/Gorunum/urun_Form.php";
						?>
						<!-- Arama Kriterleri -->
						<!--<div class="search_form">
							<form>
							  <div class="row">
							  	 <label class="col-sm-4 control-label">Urun ID</label>
						     	 <input name="urunID" type="text" class="col-sm-6" />
							  </div>
							   <div class="row">
							  	 <label class="col-sm-4 control-label">Urun Adi</label>
						     	 <input name="urunAdi" type="text" class="col-sm-6" />
							  </div>
							 
							</form>
						</div>-->
						<!--Tablo -->
						<!--<table class="table table-striped">
						    <thead>
						      <tr>
						        <th>Firstname</th>
						        <th>Lastname</th>
						        <th>Email</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        <td>John</td>
						        <td>Doe</td>
						        <td>john@example.com</td>
						      </tr>
						      <tr>
						        <td>Mary</td>
						        <td>Moe</td>
						        <td>mary@example.com</td>
						      </tr>
						      <tr>
						        <td>July</td>
						        <td>Dooley</td>
						        <td>july@example.com</td>
						      </tr>
						    </tbody>
						  </table>-->
						<!-- Degisken Kısım Son -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="script/scripts.js"></script>
</body>
</html>