-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 Haz 2017, 21:28:20
-- Sunucu sürümü: 5.7.14
-- PHP Sürümü: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `aciksozluk`
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
-- Tablo için tablo yapısı `entries`
--

CREATE TABLE `entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `postId` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `parentId` int(10) UNSIGNED NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `createdAt` int(10) NOT NULL,
  `modifiedAt` int(10) NOT NULL,
  `deletedAt` int(10) NOT NULL,
  `ipAddress` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `entries`
--

INSERT INTO `entries` (`id`, `content`, `postId`, `userId`, `parentId`, `type`, `status`, `createdAt`, `modifiedAt`, `deletedAt`, `ipAddress`) VALUES
(1, 'asfafs', 7, 1, 0, 'entry', 'published', 1496985499, 1497046162, 0, '::1'),
(2, 'fff', 7, 1, 0, 'entry', 'published', 1496985501, 1496985501, 0, '::1'),
(3, 'adasafas', 7, 1, 0, 'entry', 'published', 1496985515, 1497094242, 0, '::1'),
(4, 'aaa', 5, 1, 0, 'entry', 'published', 1496985629, 1496985629, 0, '::1'),
(5, 'gir', 8, 1, 0, 'entry', 'published', 1496986176, 1496986176, 0, '::1'),
(6, 'iki gir', 8, 1, 0, 'entry', 'published', 1496986444, 1496986444, 0, '::1'),
(7, 'dsafafa', 7, 1, 0, 'entry', 'published', 1496987188, 1496987188, 0, '::1'),
(8, 'assss', 8, 1, 0, 'entry', 'published', 1496987232, 1496987232, 0, '::1'),
(9, 'ssss', 7, 1, 0, 'entry', 'published', 1496987254, 1496987254, 0, '::1'),
(10, 'ssssaa', 7, 1, 0, 'entry', 'published', 1496987287, 1496987287, 0, '::1'),
(11, 'ssssaa', 7, 1, 0, 'entry', 'published', 1496987300, 1496987300, 0, '::1'),
(12, 'ssssaa', 7, 1, 0, 'entry', 'published', 1496987400, 1496987400, 0, '::1'),
(13, 'ssssaa', 7, 1, 0, 'entry', 'published', 1496987419, 1496987419, 0, '::1'),
(14, 'ssssaa', 7, 1, 0, 'entry', 'published', 1496987424, 1496987424, 0, '::1'),
(15, 'cc', 7, 1, 0, 'entry', 'published', 1496987433, 1496987433, 0, '::1'),
(16, 'ddd', 6, 1, 0, 'entry', 'published', 1496987441, 1496987441, 0, '::1'),
(17, 'asfafa', 5, 1, 0, 'entry', 'published', 1496987447, 1496987447, 0, '::1'),
(18, 'ddddddddd', 7, 1, 0, 'entry', 'published', 1496987470, 1496987470, 0, '::1'),
(19, 'asfaf', 8, 1, 0, 'entry', 'published', 1496987484, 1496987484, 0, '::1'),
(20, 'ssss', 8, 1, 0, 'entry', 'published', 1496987518, 1496987518, 0, '::1'),
(21, 'asaf', 8, 1, 0, 'entry', 'published', 1496987618, 1496987618, 0, '::1'),
(22, 'dee', 8, 1, 0, 'entry', 'published', 1496987682, 1496987682, 0, '::1'),
(23, 'asaaf', 4, 1, 0, 'entry', 'published', 1496987722, 1496987722, 0, '::1'),
(24, 'asfaf', 6, 1, 0, 'entry', 'published', 1496987757, 1496987757, 0, '::1'),
(25, 'asfaf', 9, 1, 0, 'entry', 'published', 1496987834, 1496987834, 0, '::1'),
(26, 'asfaf', 9, 1, 0, 'entry', 'published', 1496987841, 1496987841, 0, '::1'),
(27, 'asfaf', 9, 1, 0, 'entry', 'published', 1496987882, 1496987882, 0, '::1'),
(28, 'asfaf', 9, 1, 0, 'entry', 'published', 1496987884, 1496987884, 0, '::1'),
(29, 'ekle', 10, 1, 0, 'entry', 'published', 1496988226, 1496988226, 0, '::1'),
(30, 'sdgsg', 7, 1, 0, 'entry', 'published', 1497046366, 1497046366, 0, '::1'),
(31, 'ekleeee', 10, 1, 0, 'entry', 'published', 1497093899, 1497093899, 0, '::1');

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
-- Tablo için tablo yapısı `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(256) NOT NULL,
  `slug` varchar(256) NOT NULL,
  `userId` int(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `createdAt` int(10) NOT NULL,
  `modifiedAt` int(10) NOT NULL,
  `deletedAt` int(10) NOT NULL,
  `ipAddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `userId`, `type`, `status`, `createdAt`, `modifiedAt`, `deletedAt`, `ipAddress`) VALUES
(4, 'bb', 'bb', 1, 'post', 'published', 1496985306, 1496985306, 0, '::1'),
(5, 'vvv', 'vvv', 1, 'post', 'published', 1496985344, 1496985344, 0, '::1'),
(6, 'ha', 'ha', 1, 'post', 'published', 1496985372, 1496985372, 0, '::1'),
(7, 'ggg', 'ggg', 1, 'post', 'published', 1496985420, 1496985420, 0, '::1'),
(8, 'bbb', 'bbb', 1, 'post', 'published', 1496986176, 1496986176, 0, '::1'),
(9, 'sdfa', 'sdfa', 1, 'post', 'published', 1496987834, 1496987834, 0, '::1'),
(10, 'aÄŸam biizmle eÄŸlenÅŸir', 'agam-biizmle-eglensir', 1, 'post', 'published', 1496988226, 1496988226, 0, '::1');

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

--
-- Tablo döküm verisi `success_logins`
--

INSERT INTO `success_logins` (`id`, `usersId`, `ipAddress`, `userAgent`) VALUES
(24, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(25, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(26, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36'),
(27, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36'),
(28, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36'),
(29, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36'),
(30, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36'),
(31, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36');

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
-- Tablo için indeksler `entries`
--
ALTER TABLE `entries`
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
-- Tablo için indeksler `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

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
-- Tablo için AUTO_INCREMENT değeri `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Tablo için AUTO_INCREMENT değeri `failed_logins`
--
ALTER TABLE `failed_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `password_changes`
--
ALTER TABLE `password_changes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Tablo için AUTO_INCREMENT değeri `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
