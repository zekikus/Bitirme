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
	
</body>
</html>