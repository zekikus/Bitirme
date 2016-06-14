-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Haz 2016, 19:15:59
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
(4, 23, 'Ankara', 'Kızılay', 'Kızılay');

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
(2, 'Mamak Sağlık Ocağı', 'Ankara', 'Mamak', 'Mamak Caddesi Merkez Camii'),
(9, 'Test', 'Ankara', 'Kızılay', 'asda'),
(10, 'Deneme', 'Ankara', 'Kızılay', 'asda'),
(11, 'qweqwe', 'İstanbul', 'Beylikdüzü', 'asd'),
(12, 'aqwe', 'Ankara', 'Kızılay', 'asda'),
(13, 'xzc', 'Ankara', 'Kızılay', 'asdsa'),
(14, 'xzxz', 'İstanbul', 'Beylikdüzü', 'asas'),
(15, 'zxc', 'Ankara', 'Mamak', 'zxczxc'),
(16, 'zxczx', 'Ankara', 'Mamak', 'qwe'),
(17, 'Test', 'İstanbul', 'Beylikdüzü', 'as'),
(18, 'Yeni Birim', 'İstanbul', 'Avcılar', 'adasd'),
(19, 'adafvcx', 'Ankara', 'Kızılay', 'hj'),
(20, '', '', '', '');

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
(15, 'Buzdolabı', 1);

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
(4, 1, 'Cep Telefonu', '538899490'),
(5, 4, 'İş', 'asdasd');

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
(7, 123, '12-06-2016 15:16:01', 'Bozuldu', 'asd');

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
(1, 542, 'Zeki', 'Kuş', 'test', 'zkus', 'kuslar', 18),
(4, 456, 'Akif', 'Taş', 'test', 'akif', 'tas', 17),
(16, 123123, 'asd', 'asd', 'test', 'ads', 'asd', 0),
(17, 1231233, 'ads', 'asd', 'test', 'asd', 'ads', 0),
(18, 5555, 'asd', 'ad', 'test', 'ads', 'ads', 0),
(19, 1111, 'asd', 'asd', 'test', 'ads', 'asd', 0),
(20, 21343, 'asd', 'sad', 'test', 'asd', 'asd', 0),
(21, 1231234, 'asd', 'asd', 'test', 'as', 'a', 0),
(22, 123111, 'asd', 'ad', 'test', 'asd', 'asd', 0),
(23, 3333, 'a', 'a', 'test', 'a', 'a', 18);

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
(3, 2, '76', '', '');

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
(1, 1, '1', 1),
(2, 1, '1', 1),
(3, 1, '1', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stok`
--

CREATE TABLE `stok` (
  `stok_id` int(11) NOT NULL,
  `stokbirim_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `aciklama` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `tanim` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `stok_birim`
--

INSERT INTO `stok_birim` (`id`, `ad`, `sensor_id`, `birim_id`, `aciklama`, `hacim`, `marka`, `model`, `uretim_tarihi`, `tanim`) VALUES
(1, 'Stok Birim 1', 1, 1, 'asD', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `transfer`
--

CREATE TABLE `transfer` (
  `transfer_id` int(11) NOT NULL,
  `stokbirim_id` int(11) NOT NULL,
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
(1, 14, 1, 'asd', '123', 'asd', '1250', '1', 'ad', 'asd');

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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `alarm`
--
ALTER TABLE `alarm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `birim`
--
ALTER TABLE `birim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Tablo için AUTO_INCREMENT değeri `dolap_tip`
--
ALTER TABLE `dolap_tip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Tablo için AUTO_INCREMENT değeri `ilce`
--
ALTER TABLE `ilce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `iletisim`
--
ALTER TABLE `iletisim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `imha`
--
ALTER TABLE `imha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Tablo için AUTO_INCREMENT değeri `sicaklik`
--
ALTER TABLE `sicaklik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `sicakliktakipcihazi`
--
ALTER TABLE `sicakliktakipcihazi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `stok`
--
ALTER TABLE `stok`
  MODIFY `stok_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `stok_birim`
--
ALTER TABLE `stok_birim`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `uruntanim`
--
ALTER TABLE `uruntanim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
