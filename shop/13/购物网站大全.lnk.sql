-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 06 月 19 日 10:13
-- 服务器版本: 5.5.16
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `51shop`
--

-- --------------------------------------------------------

--
-- 表的结构 `b2c_ad`
--

CREATE TABLE IF NOT EXISTS `b2c_ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` mediumtext NOT NULL,
  `views` int(10) DEFAULT '0',
  `visible` smallint(5) DEFAULT '1',
  `posttime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `b2c_class`
--

CREATE TABLE IF NOT EXISTS `b2c_class` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `up_id` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `b2c_class`
--

INSERT INTO `b2c_class` (`id`, `name`, `up_id`) VALUES
(1, 'electronics device', 0),
(2, 'food', 0),
(3, 'cosmetics', 0),
(5, 'books', 0);

-- --------------------------------------------------------

--
-- 表的结构 `b2c_goods`
--

CREATE TABLE IF NOT EXISTS `b2c_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `up_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(60) NOT NULL DEFAULT '',
  `descript` text NOT NULL,
  `image` varchar(40) DEFAULT NULL,
  `price_m` mediumint(9) NOT NULL DEFAULT '0',
  `price` mediumint(9) NOT NULL DEFAULT '0',
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `b2c_goods`
--

INSERT INTO `b2c_goods` (`id`, `up_id`, `name`, `descript`, `image`, `price_m`, `price`, `state`, `date`) VALUES
(1, 1, 'Amana 25 -Cubic Foot Side-by-Side Refrigerator, ASD2522WRS,', 'Amana 25 -Cubic Foot Side-by-Side Refrigerator, ASD2522WRS, Stainless Steel', 'goods_img/1340044298', 1200, 1100, 0, '2012-06-14 00:00:00'),
(2, 1, 'Bosch Evolution 500 Series : HGS5053UC 30 Freestanding Gas R', 'Bosch Evolution 500 Series : HGS5053UC 30 Freestanding Gas Range with 5 Sealed Burners - Stainless', 'goods_img/1340044347', 1000, 980, 0, '2012-06-14 00:00:00'),
(3, 1, 'Amana 3.4 cu. ft. Top-Load Washer with Sprekle Porcelain was', 'Amana 3.4 cu. ft. Top-Load Washer with Sprekle Porcelain wash basket, NTW4600YQ, White', 'goods_img/1340044375', 550, 525, 0, '2012-06-18 00:00:00'),
(4, 1, 'EVGA GeForce GTX 550 Ti FPB 1024 MB GDDR5 PCI Express 2.0 2D', 'EVGA GeForce GTX 550 Ti FPB 1024 MB GDDR5 PCI Express 2.0 2DVI/Mini-HDMI SLI Ready Graphics Card, 01G-P3-1556-KR', 'goods_img/1340044407', 130, 110, 0, '2012-06-14 00:00:00'),
(5, 1, 'Sony HT-CT150 3D Sound Bar System 	Sony HT-CT150 3D Sound Ba', 'Sony HT-CT150 3D Sound Bar System', 'goods_img/1340044437', 180, 170, 0, '2012-06-14 00:00:00'),
(6, 1, 'iHome iA9BZC App-Enhanced Dual Alarm Clock Radio for iPhone/', 'iHome iA9BZC App-Enhanced Dual Alarm Clock Radio for iPhone/iPod with AM/FM presets (Black)', 'goods_img/1340044483', 80, 70, 0, '2012-06-18 00:00:00'),
(7, 1, 'Canon PIXMA MG5220 Wireless Inkjet Photo All-in-One (4502B01', 'Canon PIXMA MG5220 Wireless Inkjet Photo All-in-One (4502B017)', 'goods_img/1340044519', 110, 99, 0, '2012-06-18 00:00:00'),
(8, 1, 'Epiphone LP Special II Les Paul Electric Guitar, Vintage Sun', 'Epiphone LP Special II Les Paul Electric Guitar, Vintage Sunburst', 'goods_img/1340044548', 150, 130, 0, '2012-06-18 00:00:00'),
(11, 3, 'Shany Carry All Trunk Professional 48 pc. Makeup Kit, Gift S', 'Shany Carry All Trunk Professional 48 pc. Makeup Kit, Gift Set', 'goods_img/1340045099', 28, 25, 0, '2012-06-14 00:00:00'),
(12, 3, 'Shany 2012 Edition All In One Harmony Makeup Kit, 25 Ounce', 'Shany 2012 Edition All In One Harmony Makeup Kit, 25 Ounce', 'goods_img/1340045131', 40, 35, 0, '2012-06-14 00:00:00'),
(13, 3, 'Shany Cosmetics Carry All Train Case with Makeup and Reusabl', 'Shany Cosmetics Carry All Train Case with Makeup and Reusable Aluminium Case', 'goods_img/1340045182', 20, 15, 0, '2012-06-18 00:00:00'),
(14, 3, 'Kingsley Travel Cosmetic Bag Clear Vinyl Dopp Kit', 'Kingsley Travel Cosmetic Bag Clear Vinyl Dopp Kit', 'goods_img/1340045225', 10, 7, 0, '2012-06-18 00:00:00'),
(15, 3, 'BH Cosmetics 120 Color Eyeshadow Palette 2nd Edition', 'BH Cosmetics 120 Color Eyeshadow Palette 2nd Edition', 'goods_img/1340045268', 20, 18, 0, '2012-06-18 00:00:00'),
(16, 2, 'apple', 'apple', 'goods_img/1340045320', 2, 1, 0, '2012-06-18 00:00:00'),
(17, 2, 'banana', 'banana', 'goods_img/1340045393', 3, 2, 0, '2012-06-14 00:00:00'),
(18, 2, 'Key_lime_pie', 'Key_lime_pie', 'goods_img/1340045436', 5, 3, 0, '2012-06-18 00:00:00'),
(19, 2, 'sandwich', 'sandwich', 'goods_img/1340045504', 5, 4, 0, '2012-04-13 00:00:00'),
(20, 5, 'Shadow of Night: A Novel [Hardcover]', 'Shadow of Night: A Novel [Hardcover]', 'goods_img/1340045746', 17, 15, 0, '2012-06-02 00:00:00'),
(21, 5, 'Wicked Business: A Lizzy and Diesel Novel [Hardcover]', 'Wicked Business: A Lizzy and Diesel Novel [Hardcover]', 'goods_img/1340045802', 16, 14, 0, '2012-06-18 00:00:00'),
(22, 5, 'Introduction-to-Probability-By-Grinstead', 'Introduction-to-Probability-By-Grinstead', 'goods_img/1340045859', 45, 40, 0, '2012-06-18 00:00:00'),
(23, 5, 'Fifty Shades of Grey: Book One of the Fifty Shades Trilogy', 'Fifty Shades of Grey: Book One of the Fifty Shades Trilogy', 'goods_img/1340045921', 9, 8, 0, '2012-05-13 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `b2c_link`
--

CREATE TABLE IF NOT EXISTS `b2c_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  `image` mediumtext NOT NULL,
  `width` int(6) DEFAULT '88',
  `height` int(6) DEFAULT '31',
  `views` int(10) DEFAULT '0',
  `clicks` int(10) DEFAULT '0',
  `visible` smallint(5) DEFAULT '1',
  `posttime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `b2c_news`
--

CREATE TABLE IF NOT EXISTS `b2c_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `key_words` varchar(20) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `read_no` smallint(5) unsigned NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `b2c_requests`
--

CREATE TABLE IF NOT EXISTS `b2c_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `sex` tinyint(4) NOT NULL DEFAULT '0',
  `email` varchar(60) NOT NULL DEFAULT '',
  `state` varchar(10) NOT NULL DEFAULT '',
  `city` varchar(12) NOT NULL DEFAULT '',
  `tel` varchar(40) NOT NULL DEFAULT '',
  `address` varchar(100) NOT NULL DEFAULT '',
  `post` varchar(6) NOT NULL DEFAULT '',
  `attrib` text,
  `fee` decimal(16,2) NOT NULL DEFAULT '0.00',
  `pay` tinyint(4) NOT NULL DEFAULT '0',
  `send_out` tinyint(4) NOT NULL DEFAULT '0',
  `payment` tinyint(4) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cardnumber` varchar(20) NOT NULL,
  `nameoncard` varchar(20) NOT NULL,
  `expdate` varchar(20) NOT NULL,
  `orderstatus` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `b2c_requests`
--

INSERT INTO `b2c_requests` (`id`, `user_id`, `name`, `sex`, `email`, `state`, `city`, `tel`, `address`, `post`, `attrib`, `fee`, `pay`, `send_out`, `payment`, `date_created`, `cardnumber`, `nameoncard`, `expdate`, `orderstatus`) VALUES
(4, 1, 'Zhi Ma', 1, 'nldfr219@gmail.com', 'CA', 'Los Angeles', '2133002063', '2831 Ellendale Pl.', '90007', NULL, 85.00, 0, 0, 0, '2012-06-18 14:42:26', '5389556737840293', 'Zhi Ma', '04-2014', 1),
(3, 1, 'Zhi Ma', 1, 'nldfr219@gmail.com', 'CA', 'Los Angeles', '2133002063', '2831 Ellendale Pl.', '90007', NULL, 72.00, 0, 0, 0, '2012-06-18 14:41:08', '5389556737840293', 'Zhi Ma', '07-2016', 1),
(7, 3, 'Feng Rao', 1, 'nldfr219@gmail.com', 'CA', 'Los Angeles', '2133124052', '31 W  adam St.', '90007', NULL, 144.00, 0, 0, 0, '2012-06-18 17:17:13', '5389256747840293', 'Feng Rao', '09-2025', 1),
(8, 4, 'Zizuo Liu', 1, 'zhima@usc.edu', 'CA', 'Los Angeles', '2314567889', 'W 23rd budlong', '90007', NULL, 126.00, 0, 0, 0, '2012-06-18 18:01:54', '5383256757840293', 'Zizuo Liu', '06-2017', 1),
(10, 5, 'Sai Luo', 1, 'nldfr219@gmail.com', 'CA', 'Los Angeles', '2314567832', '1210 W Adam St.', '90007', NULL, 98.00, 0, 0, 0, '2012-06-18 21:04:35', '5383256742840293', 'Sai Luo', '05-2024', 0),
(11, 5, 'Sai Luo', 1, 'sailuo@gmail.com', 'CA', 'Los Angeles', '2314567832', '1210 W Adam St.', '90007', NULL, 312.00, 0, 0, 0, '2012-06-18 21:05:33', '5389256747840293', 'Sai Luo', '03-2016', 0),
(12, 5, 'Sai Luo', 1, 'sailuo@gmail.com', 'CA', 'Los Angeles', '2314567832', '1210 W Adam St.', '90007', NULL, 200.00, 0, 0, 0, '2012-06-18 21:06:52', '5389256747840293', 'Sai Luo', '04-2025', 0);

-- --------------------------------------------------------

--
-- 表的结构 `b2c_shopping`
--

CREATE TABLE IF NOT EXISTS `b2c_shopping` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `requests_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_num` mediumint(9) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
-- 转存表中的数据 `b2c_shopping`
--

INSERT INTO `b2c_shopping` (`id`, `requests_id`, `user_id`, `goods_id`, `goods_num`, `date_created`) VALUES
(1, 1, 1, 23, 2, '2012-06-18 12:04:05'),
(2, 1, 1, 22, 2, '2012-06-18 12:04:05'),
(3, 1, 1, 9, 2, '2012-06-18 12:04:05'),
(4, 1, 1, 6, 1, '2012-06-18 12:04:05'),
(5, 1, 1, 18, 1, '2012-06-18 12:04:05'),
(6, 1, 1, 16, 1, '2012-06-18 12:04:05'),
(7, 1, 1, 23, 2, '2012-06-18 12:06:16'),
(8, 1, 1, 22, 2, '2012-06-18 12:06:16'),
(9, 1, 1, 9, 2, '2012-06-18 12:06:16'),
(10, 1, 1, 6, 1, '2012-06-18 12:06:16'),
(11, 1, 1, 18, 1, '2012-06-18 12:06:16'),
(12, 1, 1, 16, 1, '2012-06-18 12:06:16'),
(13, 1, 1, 22, 1, '2012-06-18 12:07:32'),
(14, 1, 1, 20, 1, '2012-06-18 12:07:32'),
(15, 1, 1, 21, 1, '2012-06-18 12:07:32'),
(16, 1, 1, 20, 1, '2012-06-18 12:10:31'),
(17, 1, 1, 18, 1, '2012-06-18 12:10:31'),
(18, 1, 1, 22, 2, '2012-06-18 12:40:13'),
(19, 1, 1, 20, 1, '2012-06-18 12:40:13'),
(20, 1, 1, 18, 1, '2012-06-18 12:40:13'),
(21, 1, 1, 22, 1, '2012-06-18 12:40:50'),
(22, 1, 1, 23, 1, '2012-06-18 12:40:50'),
(23, 1, 1, 20, 1, '2012-06-18 12:40:50'),
(66, 8, 4, 20, 2, '2012-06-18 18:01:54'),
(65, 8, 4, 22, 2, '2012-06-18 18:01:54'),
(64, 7, 3, 17, 1, '2012-06-18 17:17:13'),
(63, 7, 3, 19, 2, '2012-06-18 17:17:13'),
(62, 7, 3, 18, 2, '2012-06-18 17:17:13'),
(61, 7, 3, 22, 3, '2012-06-18 17:17:13'),
(60, 7, 3, 23, 1, '2012-06-18 17:17:13'),
(52, 4, 1, 13, 1, '2012-06-18 14:42:26'),
(51, 4, 1, 14, 1, '2012-06-18 14:42:26'),
(50, 4, 1, 18, 5, '2012-06-18 14:42:26'),
(49, 4, 1, 23, 1, '2012-06-18 14:42:26'),
(48, 4, 1, 22, 1, '2012-06-18 14:42:26'),
(47, 3, 1, 16, 6, '2012-06-18 14:41:08'),
(46, 3, 1, 18, 4, '2012-06-18 14:41:08'),
(45, 3, 1, 17, 1, '2012-06-18 14:41:08'),
(44, 3, 1, 19, 1, '2012-06-18 14:41:08'),
(43, 3, 1, 22, 1, '2012-06-18 14:41:08'),
(42, 3, 1, 23, 1, '2012-06-18 14:41:08'),
(67, 8, 4, 23, 1, '2012-06-18 18:01:54'),
(68, 8, 4, 19, 2, '2012-06-18 18:01:54'),
(76, 10, 5, 21, 1, '2012-06-18 21:04:35'),
(75, 10, 5, 20, 1, '2012-06-18 21:04:35'),
(74, 10, 5, 22, 1, '2012-06-18 21:04:35'),
(73, 10, 5, 23, 2, '2012-06-18 21:04:35'),
(77, 10, 5, 19, 1, '2012-06-18 21:04:35'),
(78, 10, 5, 18, 3, '2012-06-18 21:04:35'),
(79, 11, 5, 22, 5, '2012-06-18 21:05:33'),
(80, 11, 5, 23, 5, '2012-06-18 21:05:33'),
(81, 11, 5, 20, 2, '2012-06-18 21:05:33'),
(82, 11, 5, 21, 3, '2012-06-18 21:05:33'),
(83, 12, 5, 22, 4, '2012-06-18 21:06:52'),
(84, 12, 5, 23, 5, '2012-06-18 21:06:52');

-- --------------------------------------------------------

--
-- 表的结构 `b2c_user`
--

CREATE TABLE IF NOT EXISTS `b2c_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `u_name` varchar(16) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `u_pass` varchar(16) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  `sex` tinyint(4) NOT NULL DEFAULT '0',
  `email` varchar(60) NOT NULL DEFAULT '',
  `state` varchar(10) NOT NULL DEFAULT '',
  `city` varchar(12) NOT NULL DEFAULT '',
  `tel` varchar(40) NOT NULL DEFAULT '',
  `address` varchar(100) NOT NULL DEFAULT '',
  `post` varchar(6) NOT NULL DEFAULT '',
  `attrib` text,
  `paper_name` varchar(6) NOT NULL DEFAULT '',
  `paper_num` varchar(25) NOT NULL DEFAULT '',
  `zzbh` varchar(100) DEFAULT NULL,
  `khhh` varchar(100) DEFAULT NULL,
  `khzh` varchar(100) DEFAULT NULL,
  `reg_date` date NOT NULL DEFAULT '0000-00-00',
  `last_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `times` int(10) unsigned NOT NULL DEFAULT '0',
  `action` enum('y','n') NOT NULL DEFAULT 'y',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `b2c_user`
--

INSERT INTO `b2c_user` (`id`, `u_name`, `u_pass`, `name`, `sex`, `email`, `state`, `city`, `tel`, `address`, `post`, `attrib`, `paper_name`, `paper_num`, `zzbh`, `khhh`, `khzh`, `reg_date`, `last_date`, `times`, `action`) VALUES
(1, 'nldfr219', '123456', 'Zhi Ma', 1, 'nldfr219@gmail.com', 'CA', 'Los Angeles', '2133002063', '2831 Ellendale Pl.', '90007', NULL, '', '', NULL, NULL, NULL, '2012-06-18', '2012-06-19 01:06:40', 15, 'y'),
(4, 'zizuoliu', '123456', 'Zizuo Liu', 1, 'zhima@usc.edu', 'CA', 'Los Angeles', '2314567889', '31 W  adam St.', '90007', NULL, '', '', NULL, NULL, NULL, '2012-06-18', '2012-06-18 17:59:02', 3, 'y'),
(3, 'fengrao', '123456', 'Feng Rao', 1, 'nldfr219@gmail.com', 'CA', 'Los Angeles', '2133124052', '31 W  adam St.', '90007', NULL, '', '', NULL, NULL, NULL, '2012-06-18', '2012-06-18 17:16:42', 3, 'y'),
(5, 'sailuo', '123456', 'Sai Luo', 1, 'abc@gmail.com', 'CA', 'Los Angeles', '2314567832', '1210 W Adam St.', '90007', NULL, '', '', NULL, NULL, NULL, '2012-06-18', '2012-06-19 01:05:48', 6, 'y');

-- --------------------------------------------------------

--
-- 表的结构 `b2c_vote`
--

CREATE TABLE IF NOT EXISTS `b2c_vote` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `caption` varchar(100) NOT NULL DEFAULT '',
  `thing` varchar(200) NOT NULL DEFAULT '',
  `data` varchar(100) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `co_archives`
--

CREATE TABLE IF NOT EXISTS `co_archives` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `annee` int(11) NOT NULL DEFAULT '0',
  `mois` int(11) NOT NULL DEFAULT '0',
  `vpm` int(11) NOT NULL DEFAULT '0',
  `topVis` blob NOT NULL,
  `topNavOS` blob NOT NULL,
  `topOS` blob NOT NULL,
  `topNav` blob NOT NULL,
  `vph` blob NOT NULL,
  `topRef` blob NOT NULL,
  `topDom` blob NOT NULL,
  `vpj` blob NOT NULL,
  PRIMARY KEY (`code`),
  KEY `annee` (`annee`),
  KEY `mois` (`mois`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `co_counter`
--

CREATE TABLE IF NOT EXISTS `co_counter` (
  `num` int(11) NOT NULL DEFAULT '0',
  `today` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `co_domaines`
--

CREATE TABLE IF NOT EXISTS `co_domaines` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `domaine` char(20) NOT NULL DEFAULT '',
  `description` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `co_useronline`
--

CREATE TABLE IF NOT EXISTS `co_useronline` (
  `zeit` int(15) NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`zeit`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `co_visiteurs`
--

CREATE TABLE IF NOT EXISTS `co_visiteurs` (
  `AGENT` char(100) DEFAULT NULL,
  `REFERER` char(200) DEFAULT NULL,
  `ADDR` char(50) NOT NULL DEFAULT '',
  `DATE` char(20) DEFAULT NULL,
  `HOST` char(100) DEFAULT NULL,
  `CODE` int(11) NOT NULL AUTO_INCREMENT,
  `REF_HOST` char(100) DEFAULT NULL,
  PRIMARY KEY (`CODE`),
  KEY `ADDR` (`ADDR`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
