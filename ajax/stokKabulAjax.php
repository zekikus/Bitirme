<?php
	session_start();
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/StokKabulKontrol.php");



	if(isset($_GET['uid'])){
		$uid = trim($_GET['uid']);
		$tagID = trim($_GET['tag']);
		$bid = trim($_GET['bid']);
		kayitEkle($uid,$tagID,$bid);
		cikisKayitEkle($uid,$tagID,$bid);
	}else{
		if(isset($_POST['query'])){

			$query = $_POST['query'];
			$sb = isset($query['sb']) ? $query['sb'] : "";
			$sb_ad = isset($query['sb_ad']) ? $query['sb_ad'] : "";
			$islem = $query['islem'];
			$rfbid = $_SESSION['kullanici'];

			if($islem == "kaydet"){
				kayitGuncelle($rfbid,$sb,$sb_ad);
			}else if($islem == "listeleCikis"){
				cikisKayitListele($rfbid);
			}else if($islem == "kaydetCikis"){
				cikisKayitGuncelle($rfbid,$query);
			}else{
				kayitListele($rfbid);
			}
		}

	}


	function kayitEkle($uid,$tagID,$bid){

		$kontrol = new StokKabulKontrol();
		$kayitSayisi = $kontrol -> etkilenenKayitSayisi("SELECT stok_id FROM stok WHERE tag_id = '".$tagID."'");

		if($kayitSayisi == 0){
			$sorgu = "INSERT INTO `stok`(`stok_id`, `stokbirim_id`, `urun_id`, `tag_id`, `aciklama`, `tarih`) VALUES (NULL,0,".$uid.",'".$tagID."','".$bid."','Test')";
			$kontrol -> kaydet($sorgu);
		}
	}

	function kayitListele($deger){
		$kontrol = new StokKabulKontrol();
		$sonuc = $kontrol -> listele("SELECT s.tag_id,ad,u.aciklama as 'uAc',kullanim_suresi FROM urun u,stok s WHERE u.id = s.urun_id and s.aciklama = '".$deger."' ORDER BY stok_id DESC LIMIT 1");

		$satir = mysqli_fetch_assoc($sonuc);
		echo "<script>
			var veri = $('textarea').val();
			if(veri.indexOf('".$satir['tag_id']."') == -1){
				$('textarea').val(veri + '".'\n'.$satir['tag_id']."');
				$('#rfTag').val('".$satir['tag_id']."');
				$('#rfUrunAd').val('".$satir['ad']."');
				$('#rfUrunAciklama').val('".$satir['uAc']."');
				$('#rfUrunSkt').val('".$satir['kullanim_suresi']."');
			}else{
				alert('Daha Onceden Eklenmis!');
			}
		</script>";
	}

	function kayitGuncelle($deger,$sb,$sb_ad){
		date_default_timezone_set('Europe/Istanbul');
		$tarih = date("Y-m-d");
		$kontrol = new StokKabulKontrol();
		$kontrol -> duzenle("UPDATE stok SET stokbirim_id = ".$sb.", stokbirim_ad = '".$sb_ad."',aciklama = '',tarih = '".$tarih."' WHERE aciklama = '".$deger."'","guncelle");
		$sonuc = $kontrol -> listele("SELECT sensor_id FROM stok_birim WHERE id = $sb LIMIT 1");
		$veri = mysqli_fetch_assoc($sonuc);
		$kayitSayisi = $kontrol -> etkilenenKayitSayisi("SELECT id FROM alarm WHERE sensor_id = ".$veri['sensor_id']." LIMIT 1");
		
		if ($kayitSayisi == 0){
			$sorgu = "INSERT INTO `alarm`(`sensor_id`, `tip`, `baslangic_zaman`, `bitis_zaman`, `durum`) VALUES ('".$veri['sensor_id']."','Sıcaklık','".$tarih."','2018-01-01','Aktif')";
			$sonuc = $kontrol -> sorguCalistir($sorgu);
		}
		echo "<script>butonTemizle('.ortakForm');</script>";
	}

	function cikisKayitEkle($uid,$tagID,$bid){

		$kontrol = new StokKabulKontrol();
		$sonuc = $kontrol -> listele("SELECT stok_id,stokbirim_id FROM stok WHERE tag_id = '".$tagID."' and stokbirim_id <> 0");
		$veri = mysqli_fetch_assoc($sonuc);
		$stokBirimID = $veri['stokbirim_id'];

		if($stokBirimID != 0){
			$sorgu = "INSERT INTO `stok_cikis`(`id`, `stokbirim_id`, `urun_id`,`tag_id`,`aciklama`, `tarih`) VALUES (NULL,'".$stokBirimID."','".$uid."','".$tagID."','".$bid."','".date("d.m.Y H:i:s")."')";
			$kontrol -> kaydet($sorgu);
		}
	}

	function cikisKayitListele($deger){

		$kontrol = new StokKabulKontrol();
		$sonuc = $kontrol -> listele("SELECT u.id,s.tag_id,ad,u.aciklama as 'uAc',kullanim_suresi FROM urun u,stok_cikis s WHERE u.id = s.urun_id and s.aciklama = '".$deger."' ORDER BY id DESC LIMIT 1");

		$satir = mysqli_fetch_assoc($sonuc);
		echo "<script>
			var veri = $('#rfTag').val();
			if(veri.indexOf('".$satir['tag_id']."') == -1){
				$('#rfuID').val('".$satir['id']."');
				$('#rfTag').val('".$satir['tag_id']."');
				$('#rfUrunAd').val('".$satir['ad']."');
				$('#rfUrunAciklama').val('".$satir['uAc']."');
				$('#rfUrunSkt').val('".$satir['kullanim_suresi']."');
			}else{
				alert('Sisteme Giriş Yapılmamış veya Önceden Okutulmuş!');
			}
		</script>";
	}

	function cikisKayitGuncelle($id,$query){
		$kontrol = new StokKabulKontrol();
		$kontrol -> duzenle("UPDATE stok_cikis SET aciklama = '',tuketim_nedeni = '".$query['rfTN']."',uygulanan_tc = '".$query['tc']."' WHERE aciklama = '".$id."'","guncelle");
		kayitSil($query);
		echo "<script>butonTemizle('.ortakForm');</script>";
	}

	function kayitSil($query){

		$kontrol = new StokKabulKontrol();
		$kontrol -> sorguCalistir("DELETE FROM stok WHERE urun_id = '".$query['uID']."' and tag_id = '".$query['tag_id']."'",'sil');

	}

?>
