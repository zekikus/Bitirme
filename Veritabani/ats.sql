-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Haz 2016, 11:15:26
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
  `il` varchar(45) NOT NULL,
  `ilce` varchar(45) NOT NULL,
  `acikAdres` varchar(45) NOT NULL,
  `tip` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim`
--

CREATE TABLE `iletisim` (
  `id` int(11) NOT NULL,
  `tip` varchar(45) NOT NULL,
  `deger` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `tcNo` varchar(11) NOT NULL,
  `ad` varchar(45) NOT NULL,
  `soyad` varchar(45) NOT NULL,
  `tip` varchar(45) NOT NULL,
  `kullaniciAdi` varchar(45) NOT NULL,
  `kullaniciSifre` varchar(45) NOT NULL,
  `iletisimID` int(11) NOT NULL,
  `adresID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `sensor_id` int(11) NOT NULL,
  `birim_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `aciklama` varchar(45) NOT NULL,
  `hacim` varchar(45) NOT NULL,
  `marka` varchar(45) NOT NULL,
  `model` varchar(45) NOT NULL,
  `uretim_tarihi` varchar(45) NOT NULL,
  `tanim` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Tablo için tablo yapısı `uretici`
--

CREATE TABLE `uretici` (
  `id` int(11) NOT NULL,
  `ad` varchar(45) NOT NULL,
  `ulke` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uruntanim`
--

CREATE TABLE `uruntanim` (
  `id` int(11) NOT NULL,
  `tip` varchar(45) NOT NULL,
  `tanim` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Tablo için indeksler `iletisim`
--
ALTER TABLE `iletisim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`tcNo`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
