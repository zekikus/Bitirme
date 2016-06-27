-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 27 Haz 2016, 13:41:23
-- Sunucu sürümü: 10.1.13-MariaDB
-- PHP Sürümü: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ats`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `adres`
--

CREATE TABLE `adres` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `il` varchar(45) NOT NULL,
  `ilce` varchar(45) NOT NULL,
  `acikAdres` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `adres`
--

INSERT INTO `adres` (`id`, `kullanici_id`, `il`, `ilce`, `acikAdres`) VALUES
(2, 1, 'İstanbul', 'Beylikdüzü', 'asdasdas'),
(3, 4, 'Ankara', 'Mamak', 'adasd'),
(4, 23, 'Ankara', 'Kızılay', 'Kızılay'),
(5, 25, 'Ankara', 'Mamak', 'adsd'),
(6, 27, 'Ankara', 'Mamak', 'as'),
(7, 5, 'Ankara', 'Mamak', 'zx');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `alarm`
--

CREATE TABLE `alarm` (
  `id` int(11) NOT NULL,
  `sensor_id` int(11) NOT NULL,
  `tip` varchar(45) NOT NULL,
  `baslangic_zaman` varchar(45) NOT NULL,
  `bitis_zaman` varchar(45) NOT NULL,
  `durum` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `alarm`
--

INSERT INTO `alarm` (`id`, `sensor_id`, `tip`, `baslangic_zaman`, `bitis_zaman`, `durum`) VALUES
(1, 1, 'test', '', '', 'aktif');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `birim`
--

CREATE TABLE `birim` (
  `id` int(11) NOT NULL,
  `ad` varchar(45) NOT NULL,
  `il` varchar(45) NOT NULL,
  `ilce` varchar(45) NOT NULL,
  `adres` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `birim`
--

INSERT INTO `birim` (`id`, `ad`, `il`, `ilce`, `adres`) VALUES
(1, 'Avcılar Sağlık Ocağı', 'İstanbul', 'Avcılar', 'deeeeeew'),
(2, 'Mamak Sağlık Ocağı', 'Ankara', 'Mamak', 'Mamak Caddesi Merkez Camii');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `vt_tip` varchar(45) NOT NULL,
  `vt_server` varchar(45) NOT NULL,
  `vt_kadi` varchar(45) NOT NULL,
  `vt_sifre` varchar(45) NOT NULL,
  `vt_adi` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `config`
--

INSERT INTO `config` (`id`, `vt_tip`, `vt_server`, `vt_kadi`, `vt_sifre`, `vt_adi`) VALUES
(1, 'MYSQL', 'localhost', 'root', '', 'ats');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dolap_tip`
--

CREATE TABLE `dolap_tip` (
  `id` int(11) NOT NULL,
  `ad` varchar(45) NOT NULL,
  `aktifMi` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `dolap_tip`
--

INSERT INTO `dolap_tip` (`id`, `ad`, `aktifMi`) VALUES
(1, 'Buzdolabı', 1),
(3, 'No-Frost', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `il`
--

CREATE TABLE `il` (
  `id` int(11) NOT NULL,
  `ad` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `il`
--

INSERT INTO `il` (`id`, `ad`) VALUES
(6, 'Ankara'),
(34, 'İstanbul');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ilce`
--

CREATE TABLE `ilce` (
  `id` int(11) NOT NULL,
  `ad` varchar(45) NOT NULL,
  `il_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ilce`
--

INSERT INTO `ilce` (`id`, `ad`, `il_id`) VALUES
(1, 'Avcılar', 34),
(2, 'Beylikdüzü', 34),
(3, 'Mamak', 6),
(4, 'Kızılay', 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim`
--

CREATE TABLE `iletisim` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `tip` varchar(45) NOT NULL,
  `deger` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `iletisim`
--

INSERT INTO `iletisim` (`id`, `kullanici_id`, `tip`, `deger`) VALUES
(4, 1, 'E-posta', 'zekiiikus@gmail.com'),
(5, 4, 'İş', 'asdasd'),
(6, 1, 'Cep Telefonu', '53889949078'),
(7, 5, 'E-posta', 'abc@hot.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `imha`
--

CREATE TABLE `imha` (
  `id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `tarih` varchar(45) NOT NULL,
  `tuketim_neden` varchar(45) NOT NULL,
  `aciklama` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `imha`
--

INSERT INTO `imha` (`id`, `urun_id`, `tarih`, `tuketim_neden`, `aciklama`) VALUES
(1, 1, '14-06-2016 14:45:20', 'Bozuldu', '?mha Edildi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `id` int(11) NOT NULL,
  `tcNo` int(11) NOT NULL,
  `ad` varchar(45) NOT NULL,
  `soyad` varchar(45) NOT NULL,
  `tip` varchar(45) NOT NULL,
  `kullaniciAdi` varchar(45) NOT NULL,
  `kullaniciSifre` varchar(45) NOT NULL,
  `birimID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`id`, `tcNo`, `ad`, `soyad`, `tip`, `kullaniciAdi`, `kullaniciSifre`, `birimID`) VALUES
(1, 542, 'Zeki', 'Kuş', 'test', 'zkus', '2785cd74acf4735dc993305ae43e3106', 1),
(4, 456, 'Akif', 'Taş', 'test', 'akif', 'tas', 1),
(5, 77879, 'A', 'A', 'test', 'A', 'A', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sicaklik`
--

CREATE TABLE `sicaklik` (
  `id` int(11) NOT NULL,
  `sensor_id` int(11) NOT NULL,
  `sicaklik_deger` varchar(45) NOT NULL,
  `kayit_zamani` varchar(45) NOT NULL,
  `olcum_zamani` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sicaklik`
--

INSERT INTO `sicaklik` (`id`, `sensor_id`, `sicaklik_deger`, `kayit_zamani`, `olcum_zamani`) VALUES
(1, 1, '45', '', ''),
(2, 2, '55', '', ''),
(3, 2, '76', '', ''),
(4, 4, '15', '', ''),
(5, 4, '8', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sicakliktakipcihazi`
--

CREATE TABLE `sicakliktakipcihazi` (
  `id` int(11) NOT NULL,
  `stokbirim_id` int(11) NOT NULL,
  `cihaz_durum` varchar(45) NOT NULL,
  `alarm_uret` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sicakliktakipcihazi`
--

INSERT INTO `sicakliktakipcihazi` (`id`, `stokbirim_id`, `cihaz_durum`, `alarm_uret`) VALUES
(1, 1, 'Aktif', 1),
(4, 5, '1', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stok`
--

CREATE TABLE `stok` (
  `stok_id` int(11) NOT NULL,
  `stokbirim_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `tag_id` varchar(45) NOT NULL,
  `aciklama` varchar(45) NOT NULL,
  `tarih` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `stok`
--

INSERT INTO `stok` (`stok_id`, `stokbirim_id`, `urun_id`, `tag_id`, `aciklama`, `tarih`) VALUES
(2, 1, 2, '0', 'Deneme', ''),
(3, 1, 1, '0', 'asd', ''),
(114, 5, 2, '42cc496', '', '24.06.2016 20:16:55'),
(115, 5, 1, '148fc496', '', '24.06.2016 20:16:55');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stok_birim`
--

CREATE TABLE `stok_birim` (
  `id` int(11) NOT NULL,
  `ad` varchar(45) NOT NULL,
  `sensor_id` int(11) NOT NULL,
  `birim_id` int(11) NOT NULL,
  `aciklama` varchar(45) NOT NULL,
  `hacim` varchar(45) NOT NULL,
  `marka` varchar(45) NOT NULL,
  `model` varchar(45) NOT NULL,
  `uretim_tarihi` varchar(45) NOT NULL,
  `tanim` varchar(45) NOT NULL,
  `sicaklik_alt_limit` int(3) NOT NULL,
  `sicaklik_ust_limit` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `stok_birim`
--

INSERT INTO `stok_birim` (`id`, `ad`, `sensor_id`, `birim_id`, `aciklama`, `hacim`, `marka`, `model`, `uretim_tarihi`, `tanim`, `sicaklik_alt_limit`, `sicaklik_ust_limit`) VALUES
(1, 'Stok Birim 1', 2, 1, 'asD', '150', 'Arçelik', 'A-520', '17.07.2016', 'Buzdolabı', 10, -8),
(2, 'Stok Birim 2', 1, 18, '', '', '', '', '', '', 0, 0),
(3, 'D-52218218', 4, 18, 'asd', '250', 'Beko', 'B-101', '15.06.2010', '', 5, -15),
(5, 'D-17101101', 4, 1, 'Yeni Stok Birim', '250', 'Altus', 'A-850', '15.06.2017', 'No-Frost', 5, -8);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stok_cikis`
--

CREATE TABLE `stok_cikis` (
  `id` int(11) NOT NULL,
  `stokbirim_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `aciklama` varchar(45) NOT NULL,
  `tarih` varchar(45) NOT NULL,
  `tuketim_nedeni` varchar(45) NOT NULL,
  `uygulanan_tc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `stok_cikis`
--

INSERT INTO `stok_cikis` (`id`, `stokbirim_id`, `urun_id`, `aciklama`, `tarih`, `tuketim_nedeni`, `uygulanan_tc`) VALUES
(1, 1, 2, '', '06.14.2016', 'Hastaya Uygulandı', 123);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `transfer`
--

CREATE TABLE `transfer` (
  `transfer_id` int(11) NOT NULL,
  `kaynak_sb_id` int(11) NOT NULL,
  `hedef_sb_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `aciklama` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tuketim_nedeni`
--

CREATE TABLE `tuketim_nedeni` (
  `id` int(11) NOT NULL,
  `tanim` varchar(45) NOT NULL,
  `aktifMi` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tuketim_nedeni`
--

INSERT INTO `tuketim_nedeni` (`id`, `tanim`, `aktifMi`) VALUES
(1, 'Bozuldu', 1),
(2, 'Eski Urun', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uretici`
--

CREATE TABLE `uretici` (
  `id` int(11) NOT NULL,
  `ad` varchar(45) NOT NULL,
  `ulke` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uretici`
--

INSERT INTO `uretici` (`id`, `ad`, `ulke`) VALUES
(14, 'Abdi ibrahim', 'TÃ¼rkiyee'),
(21, 'Bayer', 'Almanya');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun`
--

CREATE TABLE `urun` (
  `id` int(11) NOT NULL,
  `uretici_id` int(11) NOT NULL,
  `tanim_id` int(11) NOT NULL,
  `ad` varchar(45) NOT NULL,
  `tag_id` varchar(45) NOT NULL,
  `aciklama` varchar(45) NOT NULL,
  `doz` varchar(45) NOT NULL,
  `seans_tipi` varchar(45) NOT NULL,
  `seans_sayisi` varchar(45) NOT NULL,
  `kullanim_suresi` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urun`
--

INSERT INTO `urun` (`id`, `uretici_id`, `tanim_id`, `ad`, `tag_id`, `aciklama`, `doz`, `seans_tipi`, `seans_sayisi`, `kullanim_suresi`) VALUES
(1, 14, 1, 'Abdi İbrahim Hepatit C', '123', 'asd', '1250', '1', 'ad', '2016-06-16'),
(2, 21, 1, 'Bayer Hepatit B', '1234', 'asd', '150', '1', '25', '2016-06-25');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uruntanim`
--

CREATE TABLE `uruntanim` (
  `id` int(11) NOT NULL,
  `ad` varchar(45) NOT NULL,
  `tip` varchar(45) NOT NULL,
  `aciklama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uruntanim`
--

INSERT INTO `uruntanim` (`id`, `ad`, `tip`, `aciklama`) VALUES
(1, 'Hepatit B', 'Aşı', 'Hepatit B Aşısı'),
(4, 'Novalgin', '', 'Mide Bulantısı Kesici');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `adres`
--
ALTER TABLE `adres`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `alarm`
--
ALTER TABLE `alarm`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `birim`
--
ALTER TABLE `birim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `dolap_tip`
--
ALTER TABLE `dolap_tip`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ad` (`ad`);

--
-- Tablo için indeksler `il`
--
ALTER TABLE `il`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ilce`
--
ALTER TABLE `ilce`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `iletisim`
--
ALTER TABLE `iletisim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `imha`
--
ALTER TABLE `imha`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tcNo` (`tcNo`);

--
-- Tablo için indeksler `sicaklik`
--
ALTER TABLE `sicaklik`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sicakliktakipcihazi`
--
ALTER TABLE `sicakliktakipcihazi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`stok_id`);

--
-- Tablo için indeksler `stok_birim`
--
ALTER TABLE `stok_birim`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ad` (`ad`);

--
-- Tablo için indeksler `stok_cikis`
--
ALTER TABLE `stok_cikis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uygulanan_tc` (`uygulanan_tc`);

--
-- Tablo için indeksler `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Tablo için indeksler `tuketim_nedeni`
--
ALTER TABLE `tuketim_nedeni`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uretici`
--
ALTER TABLE `uretici`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urun`
--
ALTER TABLE `urun`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uruntanim`
--
ALTER TABLE `uruntanim`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `adres`
--
ALTER TABLE `adres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Tablo için AUTO_INCREMENT değeri `alarm`
--
ALTER TABLE `alarm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `birim`
--
ALTER TABLE `birim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `dolap_tip`
--
ALTER TABLE `dolap_tip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `ilce`
--
ALTER TABLE `ilce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `iletisim`
--
ALTER TABLE `iletisim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Tablo için AUTO_INCREMENT değeri `imha`
--
ALTER TABLE `imha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `sicaklik`
--
ALTER TABLE `sicaklik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `sicakliktakipcihazi`
--
ALTER TABLE `sicakliktakipcihazi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `stok`
--
ALTER TABLE `stok`
  MODIFY `stok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
--
-- Tablo için AUTO_INCREMENT değeri `stok_birim`
--
ALTER TABLE `stok_birim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `stok_cikis`
--
ALTER TABLE `stok_cikis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `transfer`
--
ALTER TABLE `transfer`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `tuketim_nedeni`
--
ALTER TABLE `tuketim_nedeni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `uretici`
--
ALTER TABLE `uretici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Tablo için AUTO_INCREMENT değeri `urun`
--
ALTER TABLE `urun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `uruntanim`
--
ALTER TABLE `uruntanim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
