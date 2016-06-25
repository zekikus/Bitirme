<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/GirisKontrol.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Model/class.phpmailer.php");


	if(isset($_POST['query'])){

		$query = @$_POST['query'];
		$islem = @$query["islem"];

		if($islem == "girisYap")
			girisKontrol($query);
		else if($islem == "cikisYap"){
			session_start();
			session_destroy();
			echo "<script>window.location.href = 'login.php'</script>";
		}
		else
			mailGonder($query);
	}

	function girisKontrol($query){
		
		$kontrol = new GirisKontrol();
		$sonuc = $kontrol -> listele("SELECT kullaniciAdi,birimID FROM kullanici WHERE kullaniciAdi = '".$query['kad']."' and kullaniciSifre = '".md5($query['sifre'])."' LIMIT 1");
		$veri = mysqli_fetch_assoc($sonuc);
		
		if($veri['kullaniciAdi'] != ""){
			session_start();
			$_SESSION["kullanici"] = $veri['birimID'];
			echo "<script>window.location.href = 'index.php'</script>";
		}else{
			echo "<script>alert('Kullanıcı Adı veya Şifre Yanlış!')</script>";
		}
	}

	function mailGonder($query){

		$kontrol = new GirisKontrol();
		$sonuc = $kontrol -> listele("SELECT id,ad,soyad,kullaniciAdi FROM kullanici WHERE id = (SELECT kullanici_id FROM iletisim WHERE deger = '".$query['email']."' LIMIT 1)");
		$veri = mysqli_fetch_assoc($sonuc);

		if($veri['ad'] != ""){	
			$ySifre = $veri['kullaniciAdi'].substr(mktime(), 0,4);
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->Username = 'webasitakipsistemi@gmail.com';
			$mail->Password = '123_ASqwezxc';
			$mail->SetFrom($mail->Username, 'Aşı Takip Sistemi');
			$mail->AddAddress(''.$query["email"].'', ''.$veri['ad'].' '.$veri['soyad'].'');
			$mail->CharSet = 'UTF-8';
			$mail->Subject = 'Şifre Sıfırlama';
			$content = '<div style="background: #eee; padding: 10px; font-size: 14px">Sayın '.$veri['ad'].' '.$veri['soyad'].' <br/><br/>
					  <b>Kullanıcı Adınız :</b> '.$veri['kullaniciAdi'].'<br/>
					  <b>Şifreniz :</b> '.$ySifre.'</div>';
			echo "<script>alert('Email Başarıyla Gönderildi.');</script>";
			echo "<script>$('#lgnGonder').removeAttr('disabled');</script>";
			$mail->MsgHTML($content);
			$mail->Send();
			sifreGuncelle($veri['id'],$ySifre);
		}else{
			echo "<script>alert('Email Sistemde Kayıtlı Değil.Yöneticiye Başvurunuz.');</script>";
		}
	}

	function sifreGuncelle($id,$ySifre){
		$kontrol = new GirisKontrol();
		$kontrol -> sorguCalistir("UPDATE kullanici SET kullaniciSifre = '".md5($ySifre)."' WHERE id = $id");
	}

	
?>