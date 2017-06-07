-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 May 2017, 13:12:51
-- Sunucu sürümü: 5.7.14
-- PHP Sürümü: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `weboloper`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `email_confirmations`
--

CREATE TABLE `email_confirmations` (
  `id` int(10) UNSIGNED NOT NULL,
  `usersId` int(10) UNSIGNED NOT NULL,
  `code` char(32) NOT NULL,
  `createdAt` int(10) UNSIGNED NOT NULL,
  `modifiedAt` int(10) UNSIGNED DEFAULT NULL,
  `confirmed` char(1) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_logins`
--

CREATE TABLE `failed_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `usersId` int(10) UNSIGNED DEFAULT NULL,
  `ipAddress` char(15) NOT NULL,
  `attempted` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_changes`
--

CREATE TABLE `password_changes` (
  `id` int(10) UNSIGNED NOT NULL,
  `usersId` int(10) UNSIGNED NOT NULL,
  `ipAddress` char(15) NOT NULL,
  `userAgent` text NOT NULL,
  `createdAt` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `profilesId` int(10) UNSIGNED NOT NULL,
  `resource` varchar(16) NOT NULL,
  `action` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `permissions`
--

INSERT INTO `permissions` (`id`, `profilesId`, `resource`, `action`) VALUES
(1, 1, 'profiles', 'index'),
(2, 1, 'profiles', 'edit'),
(3, 1, 'profiles', 'delete'),
(4, 1, 'profiles', 'create'),
(5, 1, 'users', 'index'),
(6, 1, 'users', 'edit'),
(7, 1, 'users', 'delete'),
(8, 1, 'users', 'create'),
(9, 1, 'permissions', 'index'),
(10, 2, 'profiles', 'index'),
(11, 2, 'profiles', 'edit'),
(12, 2, 'users', 'index'),
(13, 2, 'users', 'edit'),
(14, 3, 'profiles', 'index'),
(15, 3, 'users', 'index');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `active` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `active`) VALUES
(1, 'Admin', 'Y'),
(2, 'Moderator', 'Y'),
(3, 'Editor', 'Y'),
(4, 'User', 'Y'),
(5, 'Guest', 'Y');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `remember_tokens`
--

CREATE TABLE `remember_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `usersId` int(10) UNSIGNED NOT NULL,
  `token` char(32) NOT NULL,
  `userAgent` varchar(120) NOT NULL,
  `createdAt` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reset_passwords`
--

CREATE TABLE `reset_passwords` (
  `id` int(10) UNSIGNED NOT NULL,
  `usersId` int(10) UNSIGNED NOT NULL,
  `code` varchar(48) NOT NULL,
  `createdAt` int(10) UNSIGNED NOT NULL,
  `modifiedAt` int(10) UNSIGNED DEFAULT NULL,
  `reset` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `success_logins`
--

CREATE TABLE `success_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `usersId` int(10) UNSIGNED NOT NULL,
  `ipAddress` char(15) NOT NULL,
  `userAgent` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(60) NOT NULL,
  `mustChangePassword` char(1) DEFAULT NULL,
  `profilesId` int(10) UNSIGNED NOT NULL,
  `banned` char(1) NOT NULL,
  `suspended` char(1) NOT NULL,
  `active` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `mustChangePassword`, `profilesId`, `banned`, `suspended`, `active`) VALUES
(1, 'Bob Burnquist', 'bob', 'bob@phalconphp.com', '$2y$08$15KiTtHVU6cCgrxioYa3FuVnSBg/jNFq3oPE88TU312LJZVBT4EA.', 'N', 1, 'N', 'N', 'Y'),
(2, 'Erik', 'erik', 'erik@phalconphp.com', '$2a$08$f4llgFQQnhPKzpGmY1sOuuu23nYfXYM/EVOpnjjvAmbxxDxG3pbX.', 'N', 1, 'Y', 'Y', 'Y'),
(3, 'Veronica', 'veronica', 'veronica@phalconphp.com', '$2a$08$NQjrh9fKdMHSdpzhMj0xcOSwJQwMfpuDMzgtRyA89ADKUbsFZ94C2', 'N', 1, 'N', 'N', 'Y'),
(4, 'Yukimi Nagano', 'yukimi', 'yukimi@phalconphp.com', '$2a$08$cxxpy4Jvt6Q3xGKgMWIILuf75RQDSroenvoB7L..GlXoGkVEMoSr.', 'N', 2, 'N', 'N', 'Y');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `email_confirmations`
--
ALTER TABLE `email_confirmations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `failed_logins`
--
ALTER TABLE `failed_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usersId` (`usersId`);

--
-- Tablo için indeksler `password_changes`
--
ALTER TABLE `password_changes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usersId` (`usersId`);

--
-- Tablo için indeksler `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profilesId` (`profilesId`);

--
-- Tablo için indeksler `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`);

--
-- Tablo için indeksler `remember_tokens`
--
ALTER TABLE `remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `token` (`token`);

--
-- Tablo için indeksler `reset_passwords`
--
ALTER TABLE `reset_passwords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usersId` (`usersId`);

--
-- Tablo için indeksler `success_logins`
--
ALTER TABLE `success_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usersId` (`usersId`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profilesId` (`profilesId`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `email_confirmations`
--
ALTER TABLE `email_confirmations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `failed_logins`
--
ALTER TABLE `failed_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `password_changes`
--
ALTER TABLE `password_changes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Tablo için AUTO_INCREMENT değeri `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `remember_tokens`
--
ALTER TABLE `remember_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `reset_passwords`
--
ALTER TABLE `reset_passwords`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `success_logins`
--
ALTER TABLE `success_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
