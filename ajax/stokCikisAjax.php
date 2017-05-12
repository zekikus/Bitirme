<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/StokKabulKontrol.php");
	
	
	if(isset($_GET['uid'])){
		$uid = trim($_GET['uid']);
		$tagID = trim($_GET['tag']);
		$bid = trim($_GET['bid']);
		kayitEkle($uid,$tagID,$bid);
	}else{
		if(isset($_POST['query'])){
			
			$query = $_POST['query'];
			$islem = $query['islem'];
			$rfbid = $_COOKIE['rfBID'];
			
			if($islem == "kaydet"){
				kayitGuncelle($rfbid,$query);
			}else{
				kayitListele($tagID);
			}
		}
		
	}


	function kayitEkle($uid,$tagID,$bid){

		$kontrol = new StokKabulKontrol();
		$sonuc = $kontrol -> listele("SELECT stok_id,stokbirim_id FROM stok WHERE tag_id = '".$tagID."' and stokbirim_id <> 0");
		$veri = mysqli_fetch_assoc($sonuc);
		$stokBirimID = $veri['stokbirim_id'];

		if($stokBirimID != 0){
			$sorgu = "INSERT INTO `stok_cikis`(`id`, `stokbirim_id`, `urun_id`,`tag_id`,`aciklama`, `tarih`) VALUES (NULL,'".$stokBirimID."','".$uid."','".$tagID."','".$bid."','".date("d.m.Y H:i:s")."')";
			$kontrol -> kaydet($sorgu);
		}
	}

	function kayitListele($deger){
		
		$kontrol = new StokKabulKontrol();
		$sonuc = $kontrol -> listele("SELECT u.id,s.tag_id,ad,u.aciklama as 'uAc',kullanim_suresi FROM urun u,stok_cikis s WHERE u.id = s.urun_id and s.tag_id = '".$deger."' ORDER BY id DESC LIMIT 0,1");

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

	function kayitGuncelle($id,$query){
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