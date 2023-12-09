-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 04 Oca 2023, 11:14:29
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kitap`
--
-- --------------------------------------------------------
--
-- Tablo için tablo yapısı `kitaplar`
--

CREATE TABLE `kitaplar` (
  `id` int(11) NOT NULL,
  `ekleyenID` int(11) NOT NULL,
  `kitap_adi` varchar(255) NOT NULL,
  `yayinevi` varchar(255) NOT NULL,
  `yazar` varchar(255) NOT NULL,
  `yer` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `durum` varchar(255) NOT NULL,
  `ozet` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kitaplar`
--
INSERT INTO `kitaplar` (`id`, `ekleyenID`, `kitap_adi`, `yayinevi`, `yazar`, `yer`, `kategori`, `durum`, `ozet`) VALUES
(1, 1, 'Kitap', 'Yayınevi', 'Yazar', 'Yerler', '242', '2', 'Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet Özet'),
(2, 1, 'Çevirisiz Kitap', 'Yayınevi', 'Ayberk Baltacı', 'Yerler2', '240', '3', 'Özet 2'),
(3, 2, 'Çevirisiz Kitap', 'Yayınevi', 'Yazar', 'Yerler', '242', '1', 'asdasdasdasd'),
(4, 1, 'Çevirisiz Kitap', 'Yayınevi', 'Yazar', 'Yerler', '242', '1', 'asdasdasdasd');

-- --------------------------------------------------------
--
-- Tablo için tablo yapısı `mesajlar`
--
CREATE TABLE `mesajlar` (
  `id` int(11) NOT NULL,
  `alici_id` int(11) NOT NULL,
  `gonderen_id` int(11) NOT NULL,
  `kitap_id` int(11) NOT NULL,
  `mesaj` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`) VALUES
(1, 'kullanici', 'kullanici@kullanici.com', '123456'),
(2, 'kullanici2', 'kullanici2@kullanici.com', '123456');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kitaplar`
--
ALTER TABLE `kitaplar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kitaplar`
--
ALTER TABLE `kitaplar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `mesajlar`
--
ALTER TABLE `mesajlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
