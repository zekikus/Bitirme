<?php

	/*
		Kısaltmalar:
			sb = StokBirim,
			tn = Tüketim Nedeni,
			dt = DolapTipi,
			ut = Ürün Tanım,
			stc = Stok Takip Cihazı

	*/

	//Kullanılan Sabitler Burdan Alınacak
	return array(
	    'birimHeader' => array("Birim Adı","Birim İl","Birim İlçe","Birim Adres","Islemler"),
	    'birimColonNames' => array("ad","il","ilce","adres"),
	    'birimKullaniciHeader' => array("Ad","Soyad","Kullanıcı Tipi"),
	    'birimKullaniciColNames' => array("ad","soyad","tip"),
	    'birimStokHeader' => array("Stok No","Stok Adı","Stok Doz"),
	    'birimStokColNames' => array("tag_id","ad","doz"),
	    'sbHeaderNames' => array("Stok Birim Adı","Stok Birim Tipi","Açıklama","Hacim","Islemler"),
	    'sbColNames' => array("ad","tanim","aciklama","hacim"),
	    'sbStokHeaderNames' => array("Ürün No","Ürün Adı","Doz","Son Kullanma Tarihi"),
	    'sbStokColNames' => array("tag_id","ad","doz","kullanim_suresi"),
	    'sbSicaklikHeaderNames' => array("Sensör ID","Sıcaklık Değer","Kayıt Zamanı","Ölçüm Zamanı"),
	    'sbSicaklikColonNames' => array("sensor_id","sicaklik_deger","kayit_zamani","olcum_zamani"),
	    'tnHeaderNames' => array("Tanım","Aktif Mi","Islemler"),
	    'ureticiHeaderNames' => array("Ad","Ülke","Islemler"),
	    'ureticiColNames' => array("ad","ulke"),
	    'urunHeaderNames' => array("Ürün Adı","Ürün Tanım","Ürün No","Islemler"),
	    'urunColNames' => array("ad","TanimAd","tag_id"),
	    'alarmHeaderNames' => array("Alarm No","İl","İlçe","Depo","Stok BirimNo","STC No","Alarm Tipi","Detay"),
	    'alarmColNames' => array("aID","bIl","bIlce","bAd","sbID","sbStcID","aTip"),
	    'alarmDetayHeaderNames' => array("Alarm No","Alarm Tipi","Alarm Başlangıç Zamanı","Alarm Bitiş Zamanı","STC No","Alarm Durum"),
	    'alarmDetayColNames' => array("id","tip","baslangic_zaman","bitis_zaman","sensor_id","durum"),
	    'dtHeaderNames' => array("Ad","Aktif Mi","Islemler"),
	    'userAddrHeaderNames' => array("İl","İlçe","Açık Adres","Islemler"),
	    'userAddrColNames' => array("il","ilce","acikAdres"),
	    'userContactHeaderNames' => array("İletişim Tipi","Değer","Islemler"),
	    'userContactColNames' => array("tip","deger"),
	    "userHeaderNames" => array("Ad","Soyad","Birim Ad","Birim İl","Birim İlçe","Islemler"),
	    "userColNames" => array("kAd","soyad","ad","il","ilce"),
	    "utHeaderNames" => array("Ürün Adı","Ürün Tipi","Ürün Açıklama","Islemler"),
	    "utColNames" => array("ad","tip","aciklama"),
	    'imhaHeaderNames' => array("Ürün No","İşlem Tarihi","Tüketim Nedeni","Açıklama","İşlem"),
	    'imhaColNames' => array("urun_id","tarih","tuketim_neden","aciklama"),
	    'stcHeaderNames' => array("Cihaz ID","Stok Birim","Alarm Üret","Cihaz Durum","Islemler"),
	    'stcColNames' => array("id","ad"),
	    'stcSicaklikHeaderNames' => array("Cihaz ID","Sıcaklık Değer","Kayıt Zamanı","Ölçüm Zamanı"),
	    'stcSicaklikColNames' => array("sensor_id","sicaklik_deger","kayit_zamani","olcum_zamani"),
	    'stokTuketimHeaderNames' => array("Tüketim Nedeni","Tüketim Tarihi","Açıklama","Uygulanan T.C. No"),
	    'stokTuketimColNames' => array("tuketim_nedeni","tarih","aciklama","uygulanan_tc"),
	    'stokHeaderNames' => array("Ürün No","Ürün Adı","Kalan Doz","Stok Birim","Son Kullanma Tarihi","Islemler"),
	    'stokColNames' => array("tag_id","ad","doz","stokBirimAd","kullanim_suresi"),
			'homeAlarmHeaderNames' => array("STC No","Başlangıç Zamanı","Bitiş Zamanı","Alarm Tipi","Alarm Durumu"),
			'homeAlarmColNames' => array("sensor_id","baslangic_zaman","bitis_zaman","tip"),
			'homeStokHeaderNames' => array("Stok Birim Adı","Ürün Adı","Stok Sayısı"),
			'homeStokColNames' => array("stokbirim_ad","ad","Stok_Sayisi"),
			'homeSKTHeaderNames' => array("Stok Birim Adı","Ürün Adı","Ürün Tag","Kalan Gün"),
			'homeSKTColNames' => array("stokbirim_ad","ad","TagID")
	);


?>
