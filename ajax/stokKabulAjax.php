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
			$sb = $query['sb'];
			$islem = $query['islem'];
			$rfbid = $_COOKIE['rfBID'];
			
			if($islem == "kaydet"){
				kayitGuncelle($rfbid,$sb);
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
		$sonuc = $kontrol -> listele("SELECT s.tag_id,ad,u.aciklama as 'uAc',kullanim_suresi FROM urun u,stok s WHERE u.id = s.urun_id and s.aciklama = '".$deger."' ORDER BY stok_id DESC LIMIT 0,1");

		$satir = mysqli_fetch_assoc($sonuc);
		echo "<script>
			var veri = $('textarea').val();
			if(veri.indexOf('".$satir['tag_id']."') == -1){
				$('textarea').val(veri + '".$satir['tag_id']."');
				$('#rfTag').val('".$satir['tag_id']."');
				$('#rfUrunAd').val('".$satir['ad']."');
				$('#rfUrunAciklama').val('".$satir['uAc']."');
				$('#rfUrunSkt').val('".$satir['kullanim_suresi']."');
			}else{
				alert('Daha Onceden Eklenmis!');
			}
		</script>";
	}

	function kayitGuncelle($deger,$sb){
		$tarih = date("d.m.Y H:i:s");
		$kontrol = new StokKabulKontrol();
		$kontrol -> duzenle("UPDATE stok SET stokbirim_id = ".$sb.",aciklama = '',tarih = '".$tarih."' WHERE aciklama = '".$deger."'","guncelle");

		echo "<script>butonTemizle('.ortakForm');</script>";
	}

?>