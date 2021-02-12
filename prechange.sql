-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2021 at 07:32 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prechange`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'demo@admin.com', '$2y$10$X1G8vsRarPtGWsYI/Ra6S.OohAUvbQKw7QIly5il9MzKcjQdxFT/.', '2020-09-21 13:04:14', '2020-09-21 13:04:14');

-- --------------------------------------------------------

--
-- Table structure for table `adminwallet`
--

CREATE TABLE `adminwallet` (
  `id` int(10) UNSIGNED NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `commission` double NOT NULL DEFAULT 0,
  `withdraw` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_bank_details`
--

CREATE TABLE `admin_bank_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `coin` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buytrades`
--

CREATE TABLE `buytrades` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `pair` int(11) DEFAULT NULL,
  `order_type` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `volume` double DEFAULT NULL,
  `value` double DEFAULT NULL,
  `remaining` double DEFAULT NULL,
  `stop_limit` double DEFAULT NULL,
  `fees` double DEFAULT NULL,
  `feepersentage` double DEFAULT NULL,
  `commission` double DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'buy',
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` int(11) NOT NULL,
  `privacy_policy` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aboutus` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `privacy_policy`, `tc`, `aboutus`, `logo`, `favicon`, `created_at`, `updated_at`) VALUES
(1, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.\r\nLorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.\r\nLorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.', '<p>Last Updated: September, 2020<br />\r\n<br />\r\n<br />\r\n<br />\r\nThese Terms of Use and any terms incorporated herein (hereinafter, the &ldquo;Terms&rdquo;) apply to your (&ldquo;user&rdquo;, &ldquo;you&ldquo;) use of the Services, including https://changelly.com/ (&ldquo;Website&ldquo;), the technology and the platform integrated therein and any related applications (including without limitation the mobile one) associated therewith, which are operated and maintained by Fintechvision Ltd. and its affiliates (&ldquo;Changelly&rdquo;, &ldquo;We&rdquo;, or &ldquo;Us&rdquo;).<br />\r\n<br />\r\n<br />\r\n<br />\r\nWe provide you with the possibility to use our Services as defined above on the following terms and conditions.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>1.&nbsp;Enforcement &amp; Amendments</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol><br />\r\n	<li>&nbsp;\r\n	<p>These Terms of Use constitutes a binding agreement between Changelly and the user as soon as the user visits the Website and uses Services. By doing so, the user confirms that he has read and accepted these Terms of Use in their entirety before finishing the registration procedure.</p>\r\n	</li>\r\n	<br />\r\n	<li>&nbsp;\r\n	<p>The user accepts that Terms of Use may be updated by Changelly from time to time. If the user does not read and accept the Terms of Use in its entirety he should not use or continue using the Services.</p>\r\n	</li>\r\n	<br />\r\n	<li>&nbsp;\r\n	<p>We reserve the right to alter, amend or modify these Terms from time to time, in our sole discretion. We will provide you with notice of such changes by sending an e-mail, providing notice on the homepage of the Website and/or by posting the amended Terms via our Website and updating the Last Updated date at the top of these Terms. The amended Terms will be deemed effective immediately upon posting on Website.</p>\r\n	</li>\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>2.&nbsp;Provided Services</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol><br />\r\n	<li>&nbsp;\r\n	<p>Our Services provide you with a possibility to Exchange one type of crypto asset to another one and access to Marketplace.</p>\r\n	</li>\r\n	<br />\r\n	<li>&nbsp;\r\n	<p>For the purposes hereof&nbsp;<strong>&quot;Exchange&quot;</strong>&nbsp;shall mean an exchange of the crypto asset of one type to the crypto asset of another type at the terms and conditions set forth by exchanging parties, which is executed via the Third-party service in respective block-chain network. When you exchange crypto assets you acknowledge and agree that the Exchange will be processed through the third-party exchange service with additional fees applicable to such Exchange. You acknowledge and agree that the exchange rates information made available via the Services are an estimation only and may differ from prevailing rates available via other sources outside of our Services</p>\r\n	</li>\r\n	<br />\r\n	<li>&nbsp;\r\n	<p><strong>&quot;Crypto Assets&quot;</strong>&nbsp;herein shall be deemed as type of assets which can only and exclusively be transmitted by means of block-chain technology, including but not limited to digital coins and digital tokens and any other type of digital mediums of exchange, such as Bitcoin, Ethereum, Ripple, etc, to the full and absolute exempt of the securities of any kind.</p>\r\n	</li>\r\n	<br />\r\n	<li>&nbsp;\r\n	<p>To be able to use all possibilities and functionality of our Services you shall go through the registration process and create a Changelly Account.&nbsp;<strong>&quot;Changelly Account&quot;</strong>&nbsp;is a user account accessible after the registration process and via the Services where the user may request to make a crypto assets exchange. User should manage and maintain only one Changelly Account. Users are prohibited from creating multiple accounts. When you create a Changelly Account you oblige to.</p>\r\n	</li>\r\n	<br />\r\n	<li>&nbsp;\r\n	<p>The&nbsp;<strong>&quot;Floating exchange rate&quot;</strong>&nbsp;option herein shall mean an exchange rate mode in which our platform does not guarantee the rate - so it fluctuates in accordance with the market. You acknowledge and agree that the exchange rate information made available via Services for the Floating exchange rate option is an estimation only and may differ from the actual rates available via other sources outside of our Services. In order to avoid any substantial losses, when a significant disparity between an estimated exchange rate available on the Website and the rate received from a third party exchange arises, a Floating exchange rate transaction may be failed automatically.</p>\r\n	</li>\r\n	<br />\r\n	<li>&nbsp;\r\n	<p>When using the&nbsp;<strong>&quot;Fixed exchange rate&quot;</strong>&nbsp;option, your rate gets &quot;locked&quot; for fifteen or twenty minutes, meaning it remains the same irrespective of the changes on the market. You acknowledge and agree that for the Fixed exchange rate option the exchange rate information available on the Website may be different from the exchange rates for the Floating exchange rate option. Changelly cannot guarantee the execution of a Fixed exchange rate transaction in some cases, including, but not limited to the following ones:</p>\r\n	</li>\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>3.&nbsp;AML and KYC procedure</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol><br />\r\n	<li>&nbsp;\r\n	<p>In furtherance of the clause 2.4.4 Changelly reserves the right to apply the AML/KYC procedure to particular users, addresses and particular transactions of crypto assets.</p>\r\n	</li>\r\n	<br />\r\n	<li>&nbsp;\r\n	<p>The up-to-date information on the AML/KYC procedures can always be found at&nbsp;<a href=\"https://changelly.com/aml-kyc\" target=\"_blank\">AML/KYC.</a></p>\r\n	</li>\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>4.&nbsp;Eligibility</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol><br />\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n	<li>&nbsp;\r\n	<p>Prior to your use of the Services and on an ongoing basis you represent, warrant, covenant and agree that:</p>\r\n	&nbsp;\r\n\r\n	<ol><br />\r\n		<br />\r\n		<br />\r\n		&nbsp;\r\n		<li>&nbsp;\r\n		<p>you use our Services at your sole option, discretion and risk;</p>\r\n		</li>\r\n		<br />\r\n		<li>&nbsp;\r\n		<p>you are solely responsible for any applicable taxes which may be payable while using our Services;</p>\r\n		</li>\r\n		<br />\r\n		<li>&nbsp;\r\n		<p>you are NOT in, under the control of, or a national or resident of Cuba, Iran, North Korea, Crimea, Sudan, Syria, Bangladesh and Bolivia, as well as any other country subject to United Nations Security Council Sanctions List and its equivalent or United States of America (including all USA territories like Puerto Rico, American Samoa, Guam, Northern Mariana Island, and the US Virgin Islands (St. Croix, St. John and St. Thomas), Japan or a jurisdiction where crypto assets transactions are explicitly prohibited (&ldquo;Restricted Locations&rdquo;). Changelly does not operate in Restricted Locations. Changelly maintains the right to select the markets and jurisdictions to operate in and may restrict or deny its services to certain countries at any time</p>\r\n		</li>\r\n		<br />\r\n		<br />\r\n		&nbsp;\r\n	</ol>\r\n	</li>\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '<p>Changelly is a non-custodial instant cryptocurrency exchange, which means that no users&rsquo; funds are placing in the service. Changelly acts as an intermediary between crypto exchanges and users, offering access to 150+ cryptocurrencies. The company mission is making the exchange process effortless for everyone who wants to invest in cryptocurrency. Operating since 2015, the platform and its mobile app attract over a million visitors monthly who enjoy high limits, fast transactions, and 24/7 live support.</p>\r\n\r\n<p>Changelly offers an intuitive interface, secure transactions, and favorable exchange rates. The service doesn&rsquo;t charge any hidden or unreasonable fees. There is only a fixed charge of 0.25% fee for crypto-to-crypto swaps, and that&rsquo;s it.</p>\r\n\r\n<p>Changelly offers its API and a customizable payment widget to any crypto service that wishes to broaden its audience and implement new exchange options. Dozens of crypto businesses already use Changelly API which empowers their functionality with the instant swap feature. Changelly partners with MyEtherWallet, Exodus, Binance, BRD, Edge, Coinomi, Trezor, Ledger, Enjin, Huobi Wallet and other well-known players in the crypto industry.</p>', NULL, NULL, '2020-10-03 17:43:38', '2020-12-04 11:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `source` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `coinname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticker` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `koboex_status` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `buy_trade` double NOT NULL,
  `sell_trade` double NOT NULL,
  `withdraw` double NOT NULL,
  `type` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `point_value` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '8',
  `net_fee` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `transaction` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addressurl` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`id`, `source`, `coinname`, `address`, `ticker`, `trade`, `status`, `koboex_status`, `buy_trade`, `sell_trade`, `withdraw`, `type`, `point_value`, `net_fee`, `transaction`, `addressurl`, `image`, `created_at`, `updated_at`) VALUES
(1, 'BTC', 'Bitcoin', '38gMwDcvYsiwbRofBkqqx7pYn7E3PGnkTi', 'btc', '1', '1', '1', 0, 0, 0, 'coin', '8', '0', 'https://www.blockchain.com/btc/tx/%1$s', 'https://www.blockchain.com/btc/address/%1$s', 'https://web-api.changelly.com/api/coins/btc.png', '2020-09-30 06:29:34', '2020-10-03 06:32:57'),
(2, 'ETH', 'Ethereum', '0xacf2b352706aBC1d853d9A1809207e8F90db0ae1', 'eth', '1', '1', '1', 0, 0, 0, 'coin', '8', '0', 'https://changelly.enjinx.io/eth/transaction/%1$s', 'https://changelly.enjinx.io/eth/address/%1$s/transactions', 'https://web-api.changelly.com/api/coins/eth.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(3, 'etc', 'Ethereum Classic', NULL, 'etc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'http://blockscout.com/etc/mainnet/tx/%1$s', 'http://blockscout.com/etc/mainnet/address/%1$s', 'https://web-api.changelly.com/api/coins/etc.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(4, 'exp', 'Expanse', NULL, 'exp', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://gander.tech/tx/%1$s', 'https://gander.tech/address/%1$s', 'https://web-api.changelly.com/api/coins/exp.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(5, 'xem', 'NEM', NULL, 'xem', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'http://explorer.nemtool.com/#/s_tx?hash=%1$s', 'http://explorer.nemtool.com/#/s_account?account=%1$s', 'https://web-api.changelly.com/api/coins/xem.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(6, 'lsk', 'Lisk', NULL, 'lsk', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.lisk.io/tx/%1$s', 'https://explorer.lisk.io/address/%1$s', 'https://web-api.changelly.com/api/coins/lsk.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(7, 'xmr', 'Monero', NULL, 'xmr', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://xmrchain.net/tx/%1$s', NULL, 'https://web-api.changelly.com/api/coins/xmr.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(8, 'game', 'GameCredits', NULL, 'game', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://prohashing.com/explorer/GameCredit/%1$s', 'https://prohashing.com/explorer/GameCredit/%1$s', 'https://web-api.changelly.com/api/coins/game.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(9, 'steem', 'Steem', NULL, 'steem', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://steemd.com/tx/%1$s', 'https://steemd.com/@%1$s', 'https://web-api.changelly.com/api/coins/steem.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(10, 'golos', 'Golos', NULL, 'golos', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'http://golosd.com/tx/%1$s', 'http://golosd.com/@%1$s', 'https://web-api.changelly.com/api/coins/golos.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(11, 'sbd', 'Steem Dollar', NULL, 'sbd', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://steemd.com/tx/%1$s', 'https://steemd.com/@%1$s', 'https://web-api.changelly.com/api/coins/sbd.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(12, 'zec', 'Zcash', NULL, 'zec', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.zcha.in/transactions/%1$s', 'https://explorer.zcha.in/accounts/%1$s', 'https://web-api.changelly.com/api/coins/zec.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(13, 'nlg', 'Gulden', NULL, 'nlg', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://blockchain.gulden.com/tx/%1$s', 'https://blockchain.gulden.com/address/%1$s', 'https://web-api.changelly.com/api/coins/nlg.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(14, 'strat', 'Stratis', NULL, 'strat', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://chainz.cryptoid.info/strat/tx.dws?%1$s', 'https://chainz.cryptoid.info/strat/address.dws?%1$s', 'https://web-api.changelly.com/api/coins/strat.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(15, 'ardr', 'Ardor', NULL, 'ardr', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://ardor.tools/transaction/ARDR/%1$s', 'https://ardor.tools/account/%1$s', 'https://web-api.changelly.com/api/coins/ardr.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(16, 'rep', 'Augur (REPv2)', NULL, 'rep', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x221657776846890989a759ba2973e427dff5c9bb?a=%1$s', 'https://web-api.changelly.com/api/coins/rep.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(17, 'lbc', 'LBRY Credits', NULL, 'lbc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.lbry.io/#!/transaction?id=%1$s', 'https://explorer.lbry.io/#!/address?id=%1$s', 'https://web-api.changelly.com/api/coins/lbc.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(18, 'maid', 'MaidSafeCoin', NULL, 'maid', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://omniexplorer.info/lookuptx.aspx?txid=%1$s', 'https://omniexplorer.info/lookupadd.aspx?address=%1$s', 'https://web-api.changelly.com/api/coins/maid.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(19, 'fct', 'Factom', NULL, 'fct', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.factom.org/tx/%1$s', 'https://explorer.factom.org/address/%1$s', 'https://web-api.changelly.com/api/coins/fct.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(20, 'ltc', 'Litecoin', 'MEnYgVXTMQ2Z4bNTbQp9yhdFvxwmQYasiu', 'ltc', '0', '1', '1', 0, 0, 0, 'coin', '8', '0', 'http://blockchair.com/litecoin/transaction/%1$s', 'http://blockchair.com/litecoin/address/%1$s', 'https://web-api.changelly.com/api/coins/ltc.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(21, 'bcn', 'Bytecoin', NULL, 'bcn', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://minergate.com/blockchain/bcn/transaction/%1$s', NULL, 'https://web-api.changelly.com/api/coins/bcn.png', '2020-09-30 06:29:35', '2020-09-30 06:29:35'),
(22, 'xrp', 'XRP', 'rnMwPUGo4D3UWUv1NPbrsTXVokfJF6s51m', 'xrp', '0', '1', '1', 0, 0, 0, 'coin', '8', '0', 'https://bithomp.com/explorer/%1$s', 'https://bithomp.com/explorer/%1$s', 'https://web-api.changelly.com/api/coins/xrp.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(23, 'doge', 'Dogecoin', 'DFGjw43nUwyJC3sXFcmi2TERQNV2j3Z37T', 'doge', '0', '0', '1', 0, 0, 0, 'coin', '8', '0', 'https://dogechain.info/tx/%1$s', 'https://dogechain.info/address/%1$s', 'https://web-api.changelly.com/api/coins/doge.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(24, 'amp', 'Synereo', NULL, 'amp', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://omniexplorer.info/lookuptx.aspx?txid=%1$s', 'https://omniexplorer.info/lookupadd.aspx?address=%1$s', 'https://web-api.changelly.com/api/coins/amp.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(25, 'nxt', 'Nxt', NULL, 'nxt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://nxtportal.org/transactions/%1$s', 'https://nxtportal.org/accounts/%1$s', 'https://web-api.changelly.com/api/coins/nxt.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(26, 'dash', 'Dash', NULL, 'dash', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://chainz.cryptoid.info/dash/tx.dws?%1$s.htm', 'https://chainz.cryptoid.info/dash/address.dws?%1$s.htm.htm', 'https://web-api.changelly.com/api/coins/dash.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(27, 'dsh', 'Dashcoin', NULL, 'dsh', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'http://chainradar.com/dsh/transaction/%1$s', NULL, 'https://web-api.changelly.com/api/coins/dsh.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(28, 'rads', 'Radium', NULL, 'rads', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://chainz.cryptoid.info/rads/tx.dws?%1$s', 'https://chainz.cryptoid.info/rads/address.dws?%1$s', 'https://web-api.changelly.com/api/coins/rads.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(29, 'xdn', 'DigitalNote', NULL, 'xdn', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'http://chainradar.com/xdn/transaction/%1$s', NULL, 'https://web-api.changelly.com/api/coins/xdn.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(30, 'aeon', 'AeonCoin', NULL, 'aeon', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'http://chainradar.com/aeon/transaction/%1$s', NULL, 'https://web-api.changelly.com/api/coins/aeon.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(31, 'usnbt', 'NuBits', NULL, 'usnbt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://nuexplorer.ddns.net/transactions/%1$s', 'https://nuexplorer.ddns.net/address/%1$s/1/newest', 'https://web-api.changelly.com/api/coins/usnbt.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(32, 'fcn', 'FantomCoin', NULL, 'fcn', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'http://chainradar.com/fcn/transaction/%1$s', NULL, 'https://web-api.changelly.com/api/coins/fcn.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(33, 'qcn', 'QuazarCoin', NULL, 'qcn', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'http://chainradar.com/qcn/transaction/%1$s', NULL, 'https://web-api.changelly.com/api/coins/qcn.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(34, 'nav', 'NAV Coin', NULL, 'nav', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://chainz.cryptoid.info/nav/tx.dws?%1$s', 'https://chainz.cryptoid.info/nav/address.dws?%1$s', 'https://web-api.changelly.com/api/coins/nav.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(35, 'pot', 'PotCoin', NULL, 'pot', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://chainz.cryptoid.info/pot/tx.dws?%1$s', 'https://chainz.cryptoid.info/pot/address.dws?%1$s', 'https://web-api.changelly.com/api/coins/pot.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(36, 'gnt', 'Golem', NULL, 'gnt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xa74476443119A942dE498590Fe1f2454d7D4aC0d?a=%1$s', 'https://web-api.changelly.com/api/coins/gnt.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(37, 'waves', 'Waves', '3PEjHv3JGjcWNpYEEkif2w8NXV4kbhnoGgu', 'waves', '0', '0', '1', 0, 0, 0, 'coin', '8', '0', 'http://wavesexplorer.com/tx/%1$s', 'http://wavesexplorer.com/address/%1$s', 'https://web-api.changelly.com/api/coins/waves.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(38, 'USDT', 'Tether USD', '0xecdf3210227ce060340bd98f637ad86a99c913c2', 'usdt', '0', '0', '1', 0, 0, 0, 'coin', '8', '0', 'https://omniexplorer.info/lookuptx.aspx?txid=%1$s', 'https://omniexplorer.info/lookupadd.aspx?address=%1$s', 'https://web-api.changelly.com/api/coins/usdt.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(39, 'swt', 'Swarm City', NULL, 'swt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xb9e7f8568e08d5659f5d29c4997173d84cdf2607?a=%1$s', 'https://web-api.changelly.com/api/coins/swt.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(40, 'mln', 'Melon', NULL, 'mln', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xec67005c4e498ec7f55e092bd1d35cbc47c91892?a=%1$s', 'https://web-api.changelly.com/api/coins/mln.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(41, 'dgd', 'DigixDAO', NULL, 'dgd', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xe0b7927c4af23765cb51314a0e0521a9645f0e2a?a=%1$s', 'https://web-api.changelly.com/api/coins/dgd.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(42, 'time', 'Chronobank', NULL, 'time', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x6531f133e6deebe7f2dce5a0441aa7ef330b4e53?a=%1$s', 'https://web-api.changelly.com/api/coins/time.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(43, 'sngls', 'SingularDTV', NULL, 'sngls', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xaec2e87e0a235266d9c5adc9deb4b2e29b54d009?a=%1$s', 'https://web-api.changelly.com/api/coins/sngls.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(44, 'xaur', 'Xaurum', NULL, 'xaur', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x4DF812F6064def1e5e029f1ca858777CC98D2D81?a=%1$s', 'https://web-api.changelly.com/api/coins/xaur.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(45, 'pivx', 'PIVX', NULL, 'pivx', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://chainz.cryptoid.info/pivx/tx.dws?%1$s', 'https://chainz.cryptoid.info/pivx/address.dws?%1$s', 'https://web-api.changelly.com/api/coins/pivx.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(46, 'gbg', 'Golos Gold', NULL, 'gbg', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'http://golosd.com/tx/%1$s', 'https://golosd.com/@%1$s', 'https://web-api.changelly.com/api/coins/gbg.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(47, 'trst', 'Trustcoin', NULL, 'trst', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xcb94be6f13a1182e4a4b6140cb7bf2025d28e41b?a=%1$s', 'https://web-api.changelly.com/api/coins/trst.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(48, 'edg', 'Edgeless', NULL, 'edg', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x08711d3b02c8758f2fb3ab4e80228418a7f8e39c?a=%1$s', 'https://web-api.changelly.com/api/coins/edg.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(49, 'gbyte', 'Byteball', NULL, 'gbyte', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.byteball.org/#%1$s', 'https://explorer.byteball.org/#%1$s', 'https://web-api.changelly.com/api/coins/gbyte.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(50, 'dar', 'Darcrus', NULL, 'dar', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://www.mynxt.info/transaction/%1$s', 'https://nxtportal.org/accounts/%1$s', 'https://web-api.changelly.com/api/coins/dar.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(51, 'wings', 'Wings DAO', NULL, 'wings', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x667088b212ce3d06a1b553a7221E1fD19000d9aF?a=%1$s', 'https://web-api.changelly.com/api/coins/wings.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(52, 'rlc', 'iEx.ec', NULL, 'rlc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x607F4C5BB672230e8672085532f7e901544a7375?a=%1$s', 'https://web-api.changelly.com/api/coins/rlc.png', '2020-09-30 06:29:36', '2020-09-30 06:29:36'),
(53, 'gno', 'Gnosis', NULL, 'gno', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x6810e776880c02933d47db1b9fc05908e5386b96?a=%1$s', 'https://web-api.changelly.com/api/coins/gno.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(54, 'dcr', 'Decred', NULL, 'dcr', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.dcrdata.org/tx/%1$s', 'https://explorer.dcrdata.org/address/%1$s', 'https://web-api.changelly.com/api/coins/dcr.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(55, 'gup', 'Guppy', NULL, 'gup', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xf7b098298f7c69fc14610bf71d5e02c60792894c?a=%1$s', 'https://web-api.changelly.com/api/coins/gup.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(56, 'sys', 'Syscoin', NULL, 'sys', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://chainz.cryptoid.info/sys/tx.dws?%1$s', 'https://chainz.cryptoid.info/sys/address.dws?%1$s', 'https://web-api.changelly.com/api/coins/sys.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(57, 'lun', 'Lunyr', NULL, 'lun', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xfa05A73FfE78ef8f1a739473e462c54bae6567D9?a=%1$s', 'https://web-api.changelly.com/api/coins/lun.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(58, 'xlm', 'Stellar', NULL, 'xlm', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://stellarchain.io/tx/%1$s', 'https://stellarchain.io/address/%1$s', 'https://web-api.changelly.com/api/coins/xlm.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(59, 'bat', 'Basic Attention Token', NULL, 'bat', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x0d8775f648430679a709e98d2b0cb6250d2887ef?a=%1$s', 'https://web-api.changelly.com/api/coins/bat.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(60, 'ant', 'Aragon', NULL, 'ant', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x960b236A07cf122663c4303350609A66A7B288C0?a=%1$s', 'https://web-api.changelly.com/api/coins/ant.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(61, 'bnt', 'Bancor Network Token', NULL, 'bnt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x1f573d6fb3f13d689ff844b4ce37794d79a7ff1c?a=%1$s', 'https://web-api.changelly.com/api/coins/bnt.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(62, 'snt', 'Status Network Token', NULL, 'snt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x744d70fdbe2ba4cf95131626614a1763df805b9e?a=%1$s', 'https://web-api.changelly.com/api/coins/snt.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(63, 'cvc', 'Civic', NULL, 'cvc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x41e5560054824ea6b0732e656e3ad64e20e94e45?a=%1$s', 'https://web-api.changelly.com/api/coins/cvc.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(64, 'eos', 'EOS', NULL, 'eos', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://bloks.io/transaction/%1$s', 'https://bloks.io/account/%1$s', 'https://web-api.changelly.com/api/coins/eos.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(65, 'pay', 'TenXPay', NULL, 'pay', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xB97048628DB6B661D4C2aA833e95Dbe1A905B280?a=%1$s', 'https://web-api.changelly.com/api/coins/pay.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(66, 'qtum (erc20)', 'Qtum', NULL, 'qtum-old', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x9a642d6b3368ddc662CA244bAdf32cDA716005BC?a=%1$s', 'https://web-api.changelly.com/api/coins/qtum-old.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(67, 'bch-old', 'Bitcoin Cash', NULL, 'bch-old', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://blockdozer.com/tx/%1$s', 'https://blockdozer.com/address/%1$s', 'https://web-api.changelly.com/api/coins/bch-old.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(68, 'neo', 'Neo', NULL, 'neo', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://neotracker.io/tx/%1$s', 'https://neotracker.io/address/%1$s', 'https://web-api.changelly.com/api/coins/neo.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(69, 'omg', 'OmiseGo', NULL, 'omg', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xd26114cd6EE289AccF82350c8d8487fedB8A0C07?a=%1$s', 'https://web-api.changelly.com/api/coins/omg.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(70, 'mco', 'Monaco', NULL, 'mco', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xb63b606ac810a52cca15e44bb630fd42d8d1d83d?a=%1$s', 'https://web-api.changelly.com/api/coins/mco.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(71, 'mtl', 'Metal', NULL, 'mtl', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xF433089366899D83a9f26A773D59ec7eCF30355e?a=%1$s', 'https://web-api.changelly.com/api/coins/mtl.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(72, '1st', 'FirstBlood', NULL, '1st', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xaf30d2a7e90d7dc361c8c4585e9bb7d2f6f15bc7?a=%1$s', 'https://web-api.changelly.com/api/coins/1st.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(73, 'adx', 'AdEx', NULL, 'adx', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x4470bb87d77b963a013db939be332f927f2b992e?a=%1$s', 'https://web-api.changelly.com/api/coins/adx.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(74, 'zrx', '0x', NULL, 'zrx', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xe41d2489571d322189246dafa5ebde1f4699f498?a=%1$s', 'https://web-api.changelly.com/api/coins/zrx.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(75, 'qtum', 'Qtum Ignition', NULL, 'qtum', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.qtum.org/tx/%1$s', 'https://explorer.qtum.org/address/%1$s', 'https://web-api.changelly.com/api/coins/qtum.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(76, 'dct', 'Decent', NULL, 'dct', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.decent.ch/', 'https://explorer.decent.ch/account/%1$s', 'https://web-api.changelly.com/api/coins/dct.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(77, 'ptoy', 'Patientory', NULL, 'ptoy', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x8ae4bf2c33a8e667de34b54938b0ccd03eb8cc06?a=%1$s', 'https://web-api.changelly.com/api/coins/ptoy.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(78, 'tkn', 'TokenCard', NULL, 'tkn', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xaaaf91d9b90df800df4f55c205fd6989c977e73a?a=%1$s', 'https://web-api.changelly.com/api/coins/tkn.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(79, 'storj', 'Storj', NULL, 'storj', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xb64ef51c888972c908cfacf59b47c1afbc0ab8ac?a=%1$s', 'https://web-api.changelly.com/api/coins/storj.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(80, 'cfi', 'Cofound.it', NULL, 'cfi', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x12fef5e57bf45873cd9b62e9dbd7bfb99e32d73e?a=%1$s', 'https://web-api.changelly.com/api/coins/cfi.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(81, 'fun', 'FunFair', NULL, 'fun', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x419d0d8bdd9af5e606ae2232ed285aff190e711b?a=%1$s', 'https://web-api.changelly.com/api/coins/fun.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(82, 'myst', 'Mysterium', NULL, 'myst', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xa645264C5603E96c3b0B078cdab68733794B0A71?a=%1$s', 'https://web-api.changelly.com/api/coins/myst.png', '2020-09-30 06:29:37', '2020-09-30 06:29:37'),
(83, 'hmq', 'Humaniq', NULL, 'hmq', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xcbcc0f036ed4788f63fc0fee32873d6a7487b908?a=%1$s', 'https://web-api.changelly.com/api/coins/hmq.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(84, 'nmr', 'Numeraire', NULL, 'nmr', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x1776e1f26f98b1a5df9cd347953a26dd3cb46671?a=%1$s', 'https://web-api.changelly.com/api/coins/nmr.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(85, 'salt', 'Salt', NULL, 'salt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x4156D3342D5c385a87D264F90653733592000581?a=%1$s', 'https://web-api.changelly.com/api/coins/salt.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(86, 'xvg', 'Verge', NULL, 'xvg', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://verge-blockchain.info/tx/%1$s', 'https://verge-blockchain.info/address/%1$s', 'https://web-api.changelly.com/api/coins/xvg.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(87, 'btg', 'Bitcoin Gold', NULL, 'btg', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.bitcoingold.org/insight/tx/%1$s', 'https://explorer.bitcoingold.org/insight/address/%1$s', 'https://web-api.changelly.com/api/coins/btg.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(88, 'dgb', 'DigiByte', NULL, 'dgb', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://chainz.cryptoid.info/dgb/tx.dws?%1$s.htm', 'https://chainz.cryptoid.info/dgb/address.dws?%1$s.htm', 'https://web-api.changelly.com/api/coins/dgb.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(89, 'dnt', 'district0x', NULL, 'dnt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x0abdace70d3790235af448c88547603b945604ea?a=%1$s', 'https://web-api.changelly.com/api/coins/dnt.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(90, 'vib', 'Viberate', NULL, 'vib', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x2C974B2d0BA1716E644c1FC59982a89DDD2fF724?a=%1$s', 'https://web-api.changelly.com/api/coins/vib.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(91, 'rcn', 'Ripio Credit Network', NULL, 'rcn', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xf970b8e36e23f7fc3fd752eea86f8be8d83375a6?a=%1$s', 'https://web-api.changelly.com/api/coins/rcn.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(92, 'powr', 'Power Ledger', NULL, 'powr', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x595832f8fc6bf59c85c527fec3740a1b7a361269?a=%1$s', 'https://web-api.changelly.com/api/coins/powr.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(93, 'cl', 'Coinlancer', NULL, 'cl', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xe81d72d14b1516e68ac3190a46c93302cc8ed60f?a=%1$s', 'https://web-api.changelly.com/api/coins/cl.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(94, 'atl', 'ATLANT', NULL, 'atl', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x78b7fada55a64dd895d8c8c35779dd8b67fa8a05?a=%1$s', 'https://web-api.changelly.com/api/coins/atl.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(95, 'trx', 'Tron', NULL, 'trx', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://tronscan.org/#/transaction/%1$s', 'https://tronscan.org/#/address/%1$s', 'https://web-api.changelly.com/api/coins/trx.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(96, 'ven', 'VeChain', NULL, 'ven', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xd850942ef8811f2a866692a623011bde52a462c1?a=%1$s', 'https://web-api.changelly.com/api/coins/ven.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(97, 'ppt', 'Populous', NULL, 'ppt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xd4fa1460f537bb9085d22c7bccb5dd450ef28e3a?a=%1$s', 'https://web-api.changelly.com/api/coins/ppt.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(98, 'zcl', 'Zclassic', NULL, 'zcl', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.zcl.zeltrez.io/tx/%1$s', 'https://explorer.zcl.zeltrez.io/address/%1$s', 'https://web-api.changelly.com/api/coins/zcl.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(99, 'stx', 'Stox', NULL, 'stx', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x006bea43baa3f7a6f765f14f10a1a1b08334ef45?a=%1$s', 'https://web-api.changelly.com/api/coins/stx.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(100, 'ctr', 'Centra', NULL, 'ctr', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x96A65609a7B84E8842732DEB08f56C3E21aC6f8a?a=%1$s', 'https://web-api.changelly.com/api/coins/ctr.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(101, 'kmd', 'Komodo', NULL, 'kmd', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://kmdexplorer.io/tx/%1$s', 'https://kmdexplorer.io/address/%1$s', 'https://web-api.changelly.com/api/coins/kmd.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(102, 'wax', 'WAX token', NULL, 'wax', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x39bb259f66e1c59d5abef88375979b4d20d98022?a=%1$s', 'https://web-api.changelly.com/api/coins/wax.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(103, 'brd', 'Bread', NULL, 'brd', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x558ec3152e2eb2174905cd19aea4e34a23de9ad6?a=%1$s', 'https://web-api.changelly.com/api/coins/brd.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(104, 'dcn', 'Dentacoin', NULL, 'dcn', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x08d32b0da63e2C3bcF8019c9c5d849d7a9d791e6?a=%1$s', 'https://web-api.changelly.com/api/coins/dcn.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(105, 'snm', 'SONM', NULL, 'snm', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x983f6d60db79ea8ca4eb9968c6aff8cfa04b3c63?a=%1$s', 'https://web-api.changelly.com/api/coins/snm.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(106, 'ngc', 'NAGA Coin', NULL, 'ngc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x72dd4b6bd852a3aa172be4d6c5a6dbec588cf131?a=%1$s', 'https://web-api.changelly.com/api/coins/ngc.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(107, 'xmo', 'Monero Original', NULL, 'xmo', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', '%1$s', NULL, 'https://web-api.changelly.com/api/coins/xmo.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(108, 'noah', 'Noah', NULL, 'noah', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x58a4884182d9E835597f405e5F258290E46ae7C2?a=%1$s', 'https://web-api.changelly.com/api/coins/noah.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(109, 'bnb-old', 'Binance ERC-20', NULL, 'bnb-old', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xB8c77482e45F1F44dE1745F52C74426C631bDD52?a=%1$s', 'https://web-api.changelly.com/api/coins/bnb-old.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(110, 'zen', 'Horizen', NULL, 'zen', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.zensystem.io/tx/%1$s', 'https://explorer.zensystem.io/address/%1$s', 'https://web-api.changelly.com/api/coins/zen.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(111, 'ae', 'Aeternity', NULL, 'ae', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.aepps.com/transactions/%1$s', 'https://explorer.aepps.com/account/transactions/%1$s', 'https://web-api.changelly.com/api/coins/ae.png', '2020-09-30 06:29:38', '2020-09-30 06:29:38'),
(112, 'aion', 'Aion', NULL, 'aion-old', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x4CEdA7906a5Ed2179785Cd3A40A69ee8bc99C466?a=%1$s', 'https://web-api.changelly.com/api/coins/aion-old.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(113, 'elf', 'Aelf', NULL, 'elf', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xbf2179859fc6d5bee9bf9158632dc51678a4100e?a=%1$s', 'https://web-api.changelly.com/api/coins/elf.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(114, 'iost', 'IOStoken', NULL, 'iost', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xfa1a856cfa3409cfa145fa4e20eb270df3eb21ab?a=%1$s', 'https://web-api.changelly.com/api/coins/iost.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(115, 'wtc', 'Waltonchain', NULL, 'wtc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://waltonchain.pro/pc/src/searchTran.html?%1$s&', 'https://waltonchain.pro/pc/src/searchMiner.html?%1$s&', 'https://web-api.changelly.com/api/coins/wtc.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(116, 'zil', 'Zilliqa', NULL, 'zil', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x05f4a42e251f2d52b8ed15e9fedaacfcef1fad27?a=%1$s', 'https://web-api.changelly.com/api/coins/zil.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(117, 'btcp', 'Bitcoin Private', NULL, 'btcp', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.btcprivate.org/tx/%1$s', 'https://explorer.btcprivate.org/address/%1$s', 'https://web-api.changelly.com/api/coins/btcp.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(118, 'ark', 'Ark', NULL, 'ark', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.ark.io/transaction/%1$s', 'https://explorer.ark.io/wallets/%1$s', 'https://web-api.changelly.com/api/coins/ark.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(119, 'arn', 'Aeron', NULL, 'arn', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.binance.org/tx/%1$s', 'https://explorer.binance.org/address/%1$s', 'https://web-api.changelly.com/api/coins/arn.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(120, 'part', 'Particl', NULL, 'part', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://chainz.cryptoid.info/part/tx.dws?%1$s', 'https://chainz.cryptoid.info/part/address.dws?%1$s', 'https://web-api.changelly.com/api/coins/part.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(121, 'zap', 'Zap', NULL, 'zap', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x6781a0f84c7e9e846dcb84a9a5bd49333067b104?a=%1$s', 'https://web-api.changelly.com/api/coins/zap.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(122, 'abyss', 'The Abyss', NULL, 'abyss', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x0e8d6b471e332f140e7d9dbb99e5e3822f728da6?a=%1$s', 'https://web-api.changelly.com/api/coins/abyss.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(123, 'lrc', 'Loopring', NULL, 'lrc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xBBbbCA6A901c926F240b89EacB641d8Aec7AEafD?a=%1$s', 'https://web-api.changelly.com/api/coins/lrc.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(124, 'poly', 'Polymath', NULL, 'poly', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x9992ec3cf6a55b00978cddf2b27bc6882d88d1ec?a=%1$s', 'https://web-api.changelly.com/api/coins/poly.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(125, 'cmt', 'CyberMiles', NULL, 'cmt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xf85feea2fdd81d51177f6b8f35f0e6734ce45f5f?a=%1$s', 'https://web-api.changelly.com/api/coins/cmt.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(126, 'icx', 'Icon', NULL, 'icx', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://iconwat.ch/tx/%1$s', 'https://iconwat.ch/address/%1$s', 'https://web-api.changelly.com/api/coins/icx.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(127, 'xzc', 'Zcoin', NULL, 'xzc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.zcoin.io/tx/%1$s', 'https://explorer.zcoin.io/address/%1$s', 'https://web-api.changelly.com/api/coins/xzc.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(128, 'hsr', 'Hshare', NULL, 'hsr', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'http://explorer.h.cash/tx/%1$s', 'http://explorer.h.cash/address/%1$s', 'https://web-api.changelly.com/api/coins/hsr.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(129, 'smart', 'SmartCash', NULL, 'smart', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.smartcash.cc/tx/%1$s', 'https://explorer.smartcash.cc/address/%1$s', 'https://web-api.changelly.com/api/coins/smart.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(130, 'ethos', 'ETHOS', NULL, 'ethos', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x5af2be193a6abca9c8817001f45744777db30756?a=%1$s', 'https://web-api.changelly.com/api/coins/ethos.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(131, 'nexo', 'NEXO', NULL, 'nexo', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xb62132e35a6c13ee1ee0f84dc5d40bad8d815206?a=%1$s', 'https://web-api.changelly.com/api/coins/nexo.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(132, 'ont', 'Ontology', NULL, 'ont', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.ont.io/transaction/%1$s', 'https://explorer.ont.io/address/%1$s/10/1', 'https://web-api.changelly.com/api/coins/ont.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(133, 'betr', 'BetterBetting', NULL, 'betr', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x763186eb8d4856d536ed4478302971214febc6a9?a=%1$s', 'https://web-api.changelly.com/api/coins/betr.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(134, 'enj', 'Enjin', NULL, 'enj', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xf629cbd94d3791c9250152bd8dfbdf380e2a3b9c?a=%1$s', 'https://web-api.changelly.com/api/coins/enj.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(135, 'skin', 'SkinCoin', NULL, 'skin', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x2bdc0d42996017fce214b21607a515da41a9e0c5?a=%1$s', 'https://web-api.changelly.com/api/coins/skin.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(136, 'bcd', 'Bitcoin Diamond', NULL, 'bcd', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'http://explorer.btcd.io/#/TX?loading=true&TX=%1$s', 'http://explorer.btcd.io/#/address?loading=true&address=%1$s', 'https://web-api.changelly.com/api/coins/bcd.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(137, 'knc', 'Kyber Network', NULL, 'knc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xdd974d5c2e2928dea5f71b9825b8b646686bd200?a=%1$s', 'https://web-api.changelly.com/api/coins/knc.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(138, 'tusd', 'TrueUSD', NULL, 'tusd', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x0000000000085d4780b73119b644ae5ecd22b376?a=%1$s', 'https://web-api.changelly.com/api/coins/tusd.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(139, 'dent', 'Dent', NULL, 'dent', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x3597bfd533a99c9aa083587b074434e61eb0a258?a=%1$s', 'https://web-api.changelly.com/api/coins/dent.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(140, 'bkx', 'Bankex', NULL, 'bkx', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x45245bc59219eeaaf6cd3f382e078a461ff9de7b?a=%1$s', 'https://web-api.changelly.com/api/coins/bkx.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(141, 'pat', 'Patron', NULL, 'pat', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xF3b3Cad094B89392fcE5faFD40bC03b80F2Bc624?a=%1$s', 'https://web-api.changelly.com/api/coins/pat.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(142, 'mith', 'Mithril', NULL, 'mith', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.binance.org/tx/%1$s', 'https://explorer.binance.org/address/%1$s', 'https://web-api.changelly.com/api/coins/mith.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(143, 'tel', 'Telcoin', NULL, 'tel', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x467bccd9d29f223bce8043b84e8c8b282827790f?a=%1$s', 'https://web-api.changelly.com/api/coins/tel.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(144, 'dai', 'Dai', NULL, 'dai', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x6b175474e89094c44da98b954eedeac495271d0f?a=%1$s', 'https://web-api.changelly.com/api/coins/dai.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(145, 'link', 'Link', NULL, 'link', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x514910771af9ca656af840dff83e8264ecf986ca?a=%1$s', 'https://web-api.changelly.com/api/coins/link.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(146, 'kin', 'Kin', NULL, 'kin-old', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x818fc6c2ec5986bc6e2cbf00939d90556ab12ce5?a=%1$s', 'https://web-api.changelly.com/api/coins/kin-old.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(147, 'mkr', 'Maker', NULL, 'mkr', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x9f8f72aa9304c8b593d555f12ef6589cc3a579a2?a=%1$s', 'https://web-api.changelly.com/api/coins/mkr.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(148, 'r', 'Revain', NULL, 'r', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x48f775efbe4f5ece6e0df2f7b5932df56823b990?a=%1$s', 'https://web-api.changelly.com/api/coins/r.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(149, 'ignis', 'Ignis', NULL, 'ignis', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://ardor.tools/transaction/IGNIS/%1$s', 'https://ardor.tools/account/%1$s', 'https://web-api.changelly.com/api/coins/ignis.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(150, 'ada', 'Cardano', NULL, 'ada', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://blockchair.com/cardano/transaction/%1$s', 'https://blockchair.com/cardano/address/%1$s', 'https://web-api.changelly.com/api/coins/ada.png', '2020-09-30 06:29:39', '2020-09-30 06:29:39'),
(151, 'proc', 'ProCurrency', NULL, 'proc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://procsight.com/tx/%1$s', 'https://procsight.com/address/%1$s', 'https://web-api.changelly.com/api/coins/proc.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(152, 'gusd', 'Gemini Dollar', NULL, 'gusd', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x056fd409e1d7a124bd7017459dfea2f387b6d5cd?a=%1$s', 'https://web-api.changelly.com/api/coins/gusd.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(153, 'usdc', 'USD coin', NULL, 'usdc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xa0b86991c6218b36c1d19d4a2e9eb0ce3606eb48?a=%1$s', 'https://web-api.changelly.com/api/coins/usdc.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(154, 'ht', 'Huobi token', NULL, 'ht', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x6f259637dcd74c767781e37bc6133cd6a68aa161?a=%1$s', 'https://web-api.changelly.com/api/coins/ht.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(155, 'grs', 'Groestlcoin', NULL, 'grs', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'http://groestlsight.groestlcoin.org/tx/%1$s', 'http://groestlsight.groestlcoin.org/address/%1$s', 'https://web-api.changelly.com/api/coins/grs.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(156, 'eurs', 'STASIS EURS', NULL, 'eurs', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xdB25f211AB05b1c97D595516F45794528a807ad8?a=%1$s', 'https://web-api.changelly.com/api/coins/eurs.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(157, 'bch', 'Bitcoin Cash ABC', NULL, 'bch', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.bitcoin.com/bch/tx/%1$s', 'https://explorer.bitcoin.com/bch/address/%1$s', 'https://web-api.changelly.com/api/coins/bch.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(158, 'bsv', 'Bitcoin SV', NULL, 'bsv', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://blockchair.com/bitcoin-sv/transaction/%1$s', 'https://blockchair.com/bitcoin-sv/address/%1$s', 'https://web-api.changelly.com/api/coins/bsv.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(159, 'dgtx', 'Digitex Futures', NULL, 'dgtx', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x1C83501478f1320977047008496DACBD60Bb15ef?a=%1$s', 'https://web-api.changelly.com/api/coins/dgtx.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(160, 'pax', 'Paxos Standard Token', NULL, 'pax', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x8E870D67F660D95d5be530380D0eC0bd388289E1?a=%1$s', 'https://web-api.changelly.com/api/coins/pax.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(161, 'poe', 'Po.et', NULL, 'poe', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x0e0989b1f9B8A38983c2BA8053269Ca62Ec9B195?a=%1$s', 'https://web-api.changelly.com/api/coins/poe.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(162, 'storm', 'Storm', NULL, 'storm', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xD0a4b8946Cb52f0661273bfbC6fD0E0C75Fc6433?a=%1$s', 'https://web-api.changelly.com/api/coins/storm.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(163, 'cnd', 'Cindicator', NULL, 'cnd', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xd4c435F5B09F855C3317c8524Cb1F586E42795fa?a=%1$s', 'https://web-api.changelly.com/api/coins/cnd.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(164, 'mana', 'Decentraland', NULL, 'mana', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x0F5D2fB29fb7d3CFeE444a200298f468908cC942?a=%1$s', 'https://web-api.changelly.com/api/coins/mana.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(165, 'ong', 'ONG', NULL, 'ong', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.ont.io/transaction/%1$s', 'https://explorer.ont.io/address/%1$s/10/1', 'https://web-api.changelly.com/api/coins/ong.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(166, 'nim', 'Nimiq', NULL, 'nim', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://nimiq.watch/#%1$s', 'https://nimiq.watch/#%1$s', 'https://web-api.changelly.com/api/coins/nim.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(167, 'sub', 'Substratum', NULL, 'sub', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x12480E24eb5bec1a9D4369CaB6a80caD3c0A377A?a=%1$s', 'https://web-api.changelly.com/api/coins/sub.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(168, 'rdn', 'Raiden Network Token', NULL, 'rdn', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x255Aa6DF07540Cb5d3d297f0D0D4D84cb52bc8e6?a=%1$s', 'https://web-api.changelly.com/api/coins/rdn.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(169, 'req', 'Request Network', NULL, 'req', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x8f8221aFbB33998d8584A2B05749bA73c37a938a?a=%1$s', 'https://web-api.changelly.com/api/coins/req.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(170, 'qsp', 'Quantstamp', NULL, 'qsp', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x99ea4dB9EE77ACD40B119BD1dC4E33e1C070b80d?a=%1$s', 'https://web-api.changelly.com/api/coins/qsp.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(171, 'gvt', 'Genesis Vision', NULL, 'gvt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x103c3a209da59d3e7c4a89307e66521e081cfdf0?a=%1$s', 'https://web-api.changelly.com/api/coins/gvt.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(172, 'ast', 'AirSwap', NULL, 'ast', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x27054b13b1B798B345b591a4d22e6562d47eA75a?a=%1$s', 'https://web-api.changelly.com/api/coins/ast.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(173, 'appc', 'AppCoins', NULL, 'appc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x27054b13b1B798B345b591a4d22e6562d47eA75a?a=%1$s', 'https://web-api.changelly.com/api/coins/appc.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(174, 'pma', 'PumaPay', NULL, 'pma', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x846c66cf71c43f80403b51fe3906b3599d63336f?a=%1$s', 'https://web-api.changelly.com/api/coins/pma.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(175, 'rfr', 'Refereum', NULL, 'rfr', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xd0929d411954c47438dc1d871dd6081f5c5e149c?a=%1$s', 'https://web-api.changelly.com/api/coins/rfr.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(176, 'xtz', 'Tezos', NULL, 'xtz', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://mvp.tezblock.io/transaction/%1$s', 'https://mvp.tezblock.io/account/%1$s', 'https://web-api.changelly.com/api/coins/xtz.png', '2020-09-30 06:29:40', '2020-09-30 06:29:40'),
(177, 'btt', 'BitTorrent', NULL, 'btt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://tronscan.org/#/transaction/%1$s', 'https://tronscan.org/#/address/%1$s/token-balances', 'https://web-api.changelly.com/api/coins/btt.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(178, 'gas', 'Gas', NULL, 'gas', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://neotracker.io/tx/%1$s', 'https://neotracker.io/address/%1$s', 'https://web-api.changelly.com/api/coins/gas.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(179, 'fet', 'Fetch', NULL, 'fet', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x1d287cc25dad7ccaf76a26bc660c5f7c8e2a05bd?a=%1$s', 'https://web-api.changelly.com/api/coins/fet.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41');
INSERT INTO `commissions` (`id`, `source`, `coinname`, `address`, `ticker`, `trade`, `status`, `koboex_status`, `buy_trade`, `sell_trade`, `withdraw`, `type`, `point_value`, `net_fee`, `transaction`, `addressurl`, `image`, `created_at`, `updated_at`) VALUES
(180, 'bdg', 'BitDegree', NULL, 'bdg', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x1961b3331969ed52770751fc718ef530838b6dee?a=%1$s', 'https://web-api.changelly.com/api/coins/bdg.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(181, 'bnb', 'BNB', NULL, 'bnb', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.binance.org/tx/%1$s', 'https://explorer.binance.org/address/%1$s', 'https://web-api.changelly.com/api/coins/bnb.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(182, 'eosdt', 'EOSDT', NULL, 'eosdt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://bloks.io/transaction/%1$s', 'https://bloks.io/account/%1$s', 'https://web-api.changelly.com/api/coins/eosdt.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(183, 'plr', 'Pillar', NULL, 'plr', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xe3818504c1b32bf1557b16c238b2e01fd3149c17?a=%1$s', 'https://web-api.changelly.com/api/coins/plr.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(184, 'vet', 'VeChain', NULL, 'vet', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explore.vechain.org/transactions/%1$s', 'https://explore.vechain.org/accounts/%1$s', 'https://web-api.changelly.com/api/coins/vet.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(185, 'phb', 'Red Pulse Phoenix Binance', NULL, 'phb', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.binance.org/tx/%1$s', 'https://explorer.binance.org/address/%1$s', 'https://web-api.changelly.com/api/coins/phb.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(186, 'usdt20', 'Tether ERC20', NULL, 'usdt20', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xdac17f958d2ee523a2206206994597c13d831ec7?a=%1$s', 'https://web-api.changelly.com/api/coins/usdt20.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(187, 'atom', 'Cosmos', NULL, 'atom', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://www.mintscan.io/txs/%1$s', 'https://www.mintscan.io/account/%1$s', 'https://web-api.changelly.com/api/coins/atom.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(188, 'adt', 'AdToken', NULL, 'adt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/https://etherscan.io/token/0xd0d6d6c5fe4a677d343cc433536bb717bae167dd?a=%1$s', 'https://web-api.changelly.com/api/coins/adt.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(189, 'xrc', 'Bitcoin Rhodium', NULL, 'xrc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.bitcoinrh.org/xrc/tx/%1$s', 'https://explorer.bitcoinrh.org/xrc/Address/%1$s', 'https://web-api.changelly.com/api/coins/xrc.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(190, 'ppc', 'Peercoin', NULL, 'ppc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://chainz.cryptoid.info/ppc/tx.dws?%1$s', 'https://chainz.cryptoid.info/ppc/address.dws?%1$s', 'https://web-api.changelly.com/api/coins/ppc.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(191, 'waxp', 'WAX', NULL, 'waxp', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://wax.bloks.io/transaction/%1$s', 'https://wax.bloks.io/account/%1$s', 'https://web-api.changelly.com/api/coins/waxp.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(192, 'phx', 'Red Pulse Phoenix', NULL, 'phx', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://neotracker.io/tx/%1$s', 'https://neotracker.io/address/%1$s', 'https://web-api.changelly.com/api/coins/phx.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(193, 'nano', 'Nano', NULL, 'nano', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://www.nanode.co/block/%1$s', 'https://www.nanode.co/account/%1$s', 'https://web-api.changelly.com/api/coins/nano.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(194, 'iotx', 'IoTeX', NULL, 'iotx', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://iotexscan.io/action/%1$s', 'https://iotexscan.io/address/%1$s', 'https://web-api.changelly.com/api/coins/iotx.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(195, 'nebl', 'Neblio', NULL, 'nebl', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.nebl.io/tx/%1$s', 'https://explorer.nebl.io/address/%1$s', 'https://web-api.changelly.com/api/coins/nebl.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(196, 'busd', 'Binance USD', NULL, 'busd', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x4fabb145d64652a948d72533023f6e7a623c7c53?a=%1$s', 'https://web-api.changelly.com/api/coins/busd.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(197, 'rvn', 'Ravencoin', NULL, 'rvn', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://ravencoin.network/tx/%1$s', 'https://ravencoin.network/address/%1$s', 'https://web-api.changelly.com/api/coins/rvn.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(198, 'tomo', 'TomoChain', NULL, 'tomo', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://scan.tomochain.com/txs/%1$s', 'https://scan.tomochain.com/address/%1$s', 'https://web-api.changelly.com/api/coins/tomo.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(199, 'bet', 'DAOBet', NULL, 'bet', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://mainnet.daovalidator.com/transaction/%1$s', 'https://mainnet.daovalidator.com/account/%1$s', 'https://web-api.changelly.com/api/coins/bet.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(200, 'hedg', 'HedgeTrade', NULL, 'hedg', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xf1290473e210b2108a85237fbcd7b6eb42cc654f?a=%1$s', 'https://web-api.changelly.com/api/coins/hedg.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(201, 'exm', 'EXMO Coin', NULL, 'exm', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x83869de76b9ad8125e22b857f519f001588c0f62?a=%1$s', 'https://web-api.changelly.com/api/coins/exm.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(202, 'wabi', 'WABI', NULL, 'wabi', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x286BDA1413a2Df81731D4930ce2F862a35A609fE?a=%1$s', 'https://web-api.changelly.com/api/coins/wabi.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(203, 'hbar', 'Hedera Hashgraph', NULL, 'hbar', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.kabuto.sh/mainnet/transaction/%1$s', 'https://explorer.kabuto.sh/mainnet/id/%1$s', 'https://web-api.changelly.com/api/coins/hbar.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(204, 'idrt', 'Rupiah Token', NULL, 'idrt', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x998FFE1E43fAcffb941dc337dD0468d52bA5b48A?a=%1$s', 'https://web-api.changelly.com/api/coins/idrt.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(205, 'dov', 'DOVU Token', NULL, 'dov', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xac3211a5025414af2866ff09c23fc18bc97e79b1?a=%1$s', 'https://web-api.changelly.com/api/coins/dov.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(206, 'solve', 'SolveCare', NULL, 'solve', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x446c9033e7516d820cc9a2ce2d0b7328b579406f?a=%1$s', 'https://web-api.changelly.com/api/coins/solve.png', '2020-09-30 06:29:41', '2020-09-30 06:29:41'),
(207, 'okb', 'OKEX Token', NULL, 'okb', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x75231f58b43240c9718dd58b4967c5114342a86c?a=%1$s', 'https://web-api.changelly.com/api/coins/okb.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(208, 'utk', 'UTRUST Token', NULL, 'utk', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x70a72833d6bf7f508c8224ce59ea1ef3d0ea3a38?a=%1$s', 'https://web-api.changelly.com/api/coins/utk.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(209, 'trigx', 'TRIGx token', NULL, 'trigx', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x5edf8610c2fbaaeff4d32897542974eab672250f?a=%1$s', 'https://web-api.changelly.com/api/coins/trigx.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(210, 'cur', 'CUR Token', NULL, 'cur', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x13339fd07934cd674269726edf3b5ccee9dd93de?a=%1$s', 'https://web-api.changelly.com/api/coins/cur.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(211, 'iota', 'IOTA', NULL, 'iota', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://thetangle.org/transaction/%1$s', 'https://thetangle.org/address/%1$s', 'https://web-api.changelly.com/api/coins/iota.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(212, 'algo', 'Algorand', NULL, 'algo', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://algoexplorer.io/tx/%1$s', 'https://algoexplorer.io/address/%1$s', 'https://web-api.changelly.com/api/coins/algo.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(213, 'solo', 'Sologenic', NULL, 'solo', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://bithomp.com/explorer/%1$s', 'https://bithomp.com/explorer/%1$s', 'https://web-api.changelly.com/api/coins/solo.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(214, 'adk', 'Aidos Kuneen', NULL, 'adk', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.aidoskuneen.com/search/?kind=bundle&hash=%1$s', 'https://explorer.aidoskuneen.com/search/?kind=address&hash=%1$s', 'https://web-api.changelly.com/api/coins/adk.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(215, 'esh', 'Switch', NULL, 'esh', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xd6a55c63865affd67e2fb9f284f87b7a9e5ff3bd?a=%1$s', 'https://web-api.changelly.com/api/coins/esh.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(216, 'ghost', 'GHOST', NULL, 'ghost', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://ghostscan.io/tx/%1$s', 'https://ghostscan.io/address/%1$s', 'https://web-api.changelly.com/api/coins/ghost.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(217, 'hex', 'HEX', NULL, 'hex', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x2b591e99afe9f32eaa6214f7b7629768c40eeb39?a=%1$s', 'https://web-api.changelly.com/api/coins/hex.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(218, 'ava', 'Travala', NULL, 'ava', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.binance.org/tx/%1$s', 'https://explorer.binance.org/address/%1$s', 'https://web-api.changelly.com/api/coins/ava.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(219, 'aya', 'Aryacoin', NULL, 'aya', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.aryacoin.io/tx/%1$s', 'https://explorer.aryacoin.io/address/%1$s', 'https://web-api.changelly.com/api/coins/aya.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(220, 'erk', 'Eureka Coin', NULL, 'erk', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://eurekanetwork.io/tx/%1$s', 'https://eurekanetwork.io/address/%1$s', 'https://web-api.changelly.com/api/coins/erk.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(221, 'levl', 'Levolution', NULL, 'levl', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x09970aec766b6f3223aca9111555e99dc50ff13a?a=%1$s', 'https://web-api.changelly.com/api/coins/levl.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(222, 'one', 'Harmony', NULL, 'one', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.harmony.one/#/tx/%1$s', 'https://explorer.harmony.one/#/address/%1$s', 'https://web-api.changelly.com/api/coins/one.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(223, 'vgx', 'Voyager Token', NULL, 'vgx', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x5af2be193a6abca9c8817001f45744777db30756?a=%1$s', 'https://web-api.changelly.com/api/coins/vgx.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(224, 'vlx', 'Velas', NULL, 'vlx', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.velas.com/tx/%1$s', 'https://explorer.velas.com/address/%1$s', 'https://web-api.changelly.com/api/coins/vlx.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(225, 'comp', 'Compound', NULL, 'comp', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xc00e94cb662c3520282e6f5717214004a7f26888?a=%1$s', 'https://web-api.changelly.com/api/coins/comp.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(226, 'cro', 'Crypto.com Coin', NULL, 'cro', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xa0b73e1ff0b80914ab6fe0444e65848c4c34450b?a=%1$s', 'https://web-api.changelly.com/api/coins/cro.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(227, 'repv2', 'Augur', NULL, 'repv2', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x1985365e9f78359a9B6AD760e32412f4a445E862?a=%1$s', 'https://web-api.changelly.com/api/coins/repv2.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(228, 'etn', 'Electroneum', NULL, 'etn', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://blockexplorer.electroneum.com/tx/%1$s', 'https://blockexplorer.electroneum.com/', 'https://web-api.changelly.com/api/coins/etn.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(229, 'nut', 'Native Utility Token', NULL, 'nut', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://bloks.io/transaction/%1$s', 'https://bloks.io/account/%1$s', 'https://web-api.changelly.com/api/coins/nut.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(230, 'roobee', 'ROOBEE', NULL, 'roobee', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xa31b1767e09f842ecfd4bc471fe44f830e3891aa?a=%1$s', 'https://web-api.changelly.com/api/coins/roobee.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(231, 'sybc', 'SYB Real Estate', NULL, 'sybc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x69428BB4272e3181dE9E3caB461e19b0131855c8?a=%1$s', 'https://web-api.changelly.com/api/coins/sybc.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(232, 'nrg', 'Energi', NULL, 'nrg', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://explorer.energi.network/tx/%1$s', 'https://explorer.energi.network/address/%1$s', 'https://web-api.changelly.com/api/coins/nrg.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(233, 'kick', 'KICK Token', NULL, 'kick', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xc12d1c73ee7dc3615ba4e37e4abfdbddfa38907e?a=%1$s', 'https://web-api.changelly.com/api/coins/kick.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(234, 'pltc', 'PlatonCoin', NULL, 'pltc', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x429D83Bb0DCB8cdd5311e34680ADC8B12070a07f?a=%1$s', 'https://web-api.changelly.com/api/coins/pltc.png', '2020-09-30 06:29:42', '2020-09-30 06:29:42'),
(235, 'uni', 'Uniswap', NULL, 'uni', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x1f9840a85d5af5bf1d1762f925bdaddc4201f984?a=%1$s', 'https://web-api.changelly.com/api/coins/uni.png', '2020-09-30 06:29:43', '2020-09-30 06:29:43'),
(236, 'paxg', 'PAX Gold', NULL, 'paxg', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0x45804880de22913dafe09f4980848ece6ecbaf78?a=%1$s', 'https://web-api.changelly.com/api/coins/paxg.png', '2020-09-30 06:29:43', '2020-09-30 06:29:43'),
(237, 'dot', 'Polkadot', NULL, 'dot', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://polkascan.io/polkadot/transaction/%1$s', 'https://polkascan.io/polkadot/account/%1$s', 'https://web-api.changelly.com/api/coins/dot.png', '2020-09-30 06:29:43', '2020-09-30 06:29:43'),
(238, 'coti', 'COTI Token', NULL, 'coti', '0', '0', '0', 0, 0, 0, 'coin', '8', '0', 'https://etherscan.io/tx/%1$s', 'https://etherscan.io/token/0xddb3422497e61e13543bea06989c0789117555c5?a=%1$s', 'https://web-api.changelly.com/api/coins/coti.png', '2020-09-30 06:29:43', '2020-09-30 06:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `completedtrades`
--

CREATE TABLE `completedtrades` (
  `id` int(10) UNSIGNED NOT NULL,
  `pair` int(11) NOT NULL DEFAULT 0,
  `buytrade_id` int(11) NOT NULL DEFAULT 0,
  `selltrade_id` int(11) NOT NULL DEFAULT 0,
  `type` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `volume` double DEFAULT NULL,
  `value` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'US', 'United States', NULL, NULL),
(2, 'CA', 'Canada', NULL, NULL),
(3, 'AF', 'Afghanistan', NULL, NULL),
(4, 'AL', 'Albania', NULL, NULL),
(5, 'DZ', 'Algeria', NULL, NULL),
(6, 'DS', 'American Samoa', NULL, NULL),
(7, 'AD', 'Andorra', NULL, NULL),
(8, 'AO', 'Angola', NULL, NULL),
(9, 'AI', 'Anguilla', NULL, NULL),
(10, 'AQ', 'Antarctica', NULL, NULL),
(11, 'AG', 'Antigua and/or Barbuda', NULL, NULL),
(12, 'AR', 'Argentina', NULL, NULL),
(13, 'AM', 'Armenia', NULL, NULL),
(14, 'AW', 'Aruba', NULL, NULL),
(15, 'AU', 'Australia', NULL, NULL),
(16, 'AT', 'Austria', NULL, NULL),
(17, 'AZ', 'Azerbaijan', NULL, NULL),
(18, 'BS', 'Bahamas', NULL, NULL),
(19, 'BH', 'Bahrain', NULL, NULL),
(20, 'BD', 'Bangladesh', NULL, NULL),
(21, 'BB', 'Barbados', NULL, NULL),
(22, 'BY', 'Belarus', NULL, NULL),
(23, 'BE', 'Belgium', NULL, NULL),
(24, 'BZ', 'Belize', NULL, NULL),
(25, 'BJ', 'Benin', NULL, NULL),
(26, 'BM', 'Bermuda', NULL, NULL),
(27, 'BT', 'Bhutan', NULL, NULL),
(28, 'BO', 'Bolivia', NULL, NULL),
(29, 'BA', 'Bosnia and Herzegovina', NULL, NULL),
(30, 'BW', 'Botswana', NULL, NULL),
(31, 'BV', 'Bouvet Island', NULL, NULL),
(32, 'BR', 'Brazil', NULL, NULL),
(33, 'IO', 'British lndian Ocean Territory', NULL, NULL),
(34, 'BN', 'Brunei Darussalam', NULL, NULL),
(35, 'BG', 'Bulgaria', NULL, NULL),
(36, 'BF', 'Burkina Faso', NULL, NULL),
(37, 'BI', 'Burundi', NULL, NULL),
(38, 'KH', 'Cambodia', NULL, NULL),
(39, 'CM', 'Cameroon', NULL, NULL),
(40, 'CV', 'Cape Verde', NULL, NULL),
(41, 'KY', 'Cayman Islands', NULL, NULL),
(42, 'CF', 'Central African Republic', NULL, NULL),
(43, 'TD', 'Chad', NULL, NULL),
(44, 'CL', 'Chile', NULL, NULL),
(45, 'CN', 'China', NULL, NULL),
(46, 'CX', 'Christmas Island', NULL, NULL),
(47, 'CC', 'Cocos (Keeling) Islands', NULL, NULL),
(48, 'CO', 'Colombia', NULL, NULL),
(49, 'KM', 'Comoros', NULL, NULL),
(50, 'CG', 'Congo', NULL, NULL),
(51, 'CK', 'Cook Islands', NULL, NULL),
(52, 'CR', 'Costa Rica', NULL, NULL),
(53, 'HR', 'Croatia (Hrvatska)', NULL, NULL),
(54, 'CU', 'Cuba', NULL, NULL),
(55, 'CY', 'Cyprus', NULL, NULL),
(56, 'CZ', 'Czech Republic', NULL, NULL),
(57, 'DK', 'Denmark', NULL, NULL),
(58, 'DJ', 'Djibouti', NULL, NULL),
(59, 'DM', 'Dominica', NULL, NULL),
(60, 'DO', 'Dominican Republic', NULL, NULL),
(61, 'TP', 'East Timor', NULL, NULL),
(62, 'EC', 'Ecudaor', NULL, NULL),
(63, 'EG', 'Egypt', NULL, NULL),
(64, 'SV', 'El Salvador', NULL, NULL),
(65, 'GQ', 'Equatorial Guinea', NULL, NULL),
(66, 'ER', 'Eritrea', NULL, NULL),
(67, 'EE', 'Estonia', NULL, NULL),
(68, 'ET', 'Ethiopia', NULL, NULL),
(69, 'FK', 'Falkland Islands (Malvinas)', NULL, NULL),
(70, 'FO', 'Faroe Islands', NULL, NULL),
(71, 'FJ', 'Fiji', NULL, NULL),
(72, 'FI', 'Finland', NULL, NULL),
(73, 'FR', 'France', NULL, NULL),
(74, 'FX', 'France, Metropolitan', NULL, NULL),
(75, 'GF', 'French Guiana', NULL, NULL),
(76, 'PF', 'French Polynesia', NULL, NULL),
(77, 'TF', 'French Southern Territories', NULL, NULL),
(78, 'GA', 'Gabon', NULL, NULL),
(79, 'GM', 'Gambia', NULL, NULL),
(80, 'GE', 'Georgia', NULL, NULL),
(81, 'DE', 'Germany', NULL, NULL),
(82, 'GH', 'Ghana', NULL, NULL),
(83, 'GI', 'Gibraltar', NULL, NULL),
(84, 'GR', 'Greece', NULL, NULL),
(85, 'GL', 'Greenland', NULL, NULL),
(86, 'GD', 'Grenada', NULL, NULL),
(87, 'GP', 'Guadeloupe', NULL, NULL),
(88, 'GU', 'Guam', NULL, NULL),
(89, 'GT', 'Guatemala', NULL, NULL),
(90, 'GN', 'Guinea', NULL, NULL),
(91, 'GW', 'Guinea-Bissau', NULL, NULL),
(92, 'GY', 'Guyana', NULL, NULL),
(93, 'HT', 'Haiti', NULL, NULL),
(94, 'HM', 'Heard and Mc Donald Islands', NULL, NULL),
(95, 'HN', 'Honduras', NULL, NULL),
(96, 'HK', 'Hong Kong', NULL, NULL),
(97, 'HU', 'Hungary', NULL, NULL),
(98, 'IS', 'Iceland', NULL, NULL),
(99, 'IN', 'India', NULL, NULL),
(100, 'ID', 'Indonesia', NULL, NULL),
(101, 'IR', 'Iran (Islamic Republic of)', NULL, NULL),
(102, 'IQ', 'Iraq', NULL, NULL),
(103, 'IE', 'Ireland', NULL, NULL),
(104, 'IL', 'Israel', NULL, NULL),
(105, 'IT', 'Italy', NULL, NULL),
(106, 'CI', 'Ivory Coast', NULL, NULL),
(107, 'JM', 'Jamaica', NULL, NULL),
(108, 'JP', 'Japan', NULL, NULL),
(109, 'JO', 'Jordan', NULL, NULL),
(110, 'KZ', 'Kazakhstan', NULL, NULL),
(111, 'KE', 'Kenya', NULL, NULL),
(112, 'KI', 'Kiribati', NULL, NULL),
(113, 'KP', 'Korea, Democratic People\'s Republic of', NULL, NULL),
(114, 'KR', 'Korea, Republic of', NULL, NULL),
(115, 'KW', 'Kuwait', NULL, NULL),
(116, 'KG', 'Kyrgyzstan', NULL, NULL),
(117, 'LA', 'Lao People\'s Democratic Republic', NULL, NULL),
(118, 'LV', 'Latvia', NULL, NULL),
(119, 'LB', 'Lebanon', NULL, NULL),
(120, 'LS', 'Lesotho', NULL, NULL),
(121, 'LR', 'Liberia', NULL, NULL),
(122, 'LY', 'Libyan Arab Jamahiriya', NULL, NULL),
(123, 'LI', 'Liechtenstein', NULL, NULL),
(124, 'LT', 'Lithuania', NULL, NULL),
(125, 'LU', 'Luxembourg', NULL, NULL),
(126, 'MO', 'Macau', NULL, NULL),
(127, 'MK', 'Macedonia', NULL, NULL),
(128, 'MG', 'Madagascar', NULL, NULL),
(129, 'MW', 'Malawi', NULL, NULL),
(130, 'MY', 'Malaysia', NULL, NULL),
(131, 'MV', 'Maldives', NULL, NULL),
(132, 'ML', 'Mali', NULL, NULL),
(133, 'MT', 'Malta', NULL, NULL),
(134, 'MH', 'Marshall Islands', NULL, NULL),
(135, 'MQ', 'Martinique', NULL, NULL),
(136, 'MR', 'Mauritania', NULL, NULL),
(137, 'MU', 'Mauritius', NULL, NULL),
(138, 'TY', 'Mayotte', NULL, NULL),
(139, 'MX', 'Mexico', NULL, NULL),
(140, 'FM', 'Micronesia, Federated States of', NULL, NULL),
(141, 'MD', 'Moldova, Republic of', NULL, NULL),
(142, 'MC', 'Monaco', NULL, NULL),
(143, 'MN', 'Mongolia', NULL, NULL),
(144, 'MS', 'Montserrat', NULL, NULL),
(145, 'MA', 'Morocco', NULL, NULL),
(146, 'MZ', 'Mozambique', NULL, NULL),
(147, 'MM', 'Myanmar', NULL, NULL),
(148, 'NA', 'Namibia', NULL, NULL),
(149, 'NR', 'Nauru', NULL, NULL),
(150, 'NP', 'Nepal', NULL, NULL),
(151, 'NL', 'Netherlands', NULL, NULL),
(152, 'AN', 'Netherlands Antilles', NULL, NULL),
(153, 'NC', 'New Caledonia', NULL, NULL),
(154, 'NZ', 'New Zealand', NULL, NULL),
(155, 'NI', 'Nicaragua', NULL, NULL),
(156, 'NE', 'Niger', NULL, NULL),
(157, 'NG', 'Nigeria', NULL, NULL),
(158, 'NU', 'Niue', NULL, NULL),
(159, 'NF', 'Norfork Island', NULL, NULL),
(160, 'MP', 'Northern Mariana Islands', NULL, NULL),
(161, 'NO', 'Norway', NULL, NULL),
(162, 'OM', 'Oman', NULL, NULL),
(163, 'PK', 'Pakistan', NULL, NULL),
(164, 'PW', 'Palau', NULL, NULL),
(165, 'PA', 'Panama', NULL, NULL),
(166, 'PG', 'Papua New Guinea', NULL, NULL),
(167, 'PY', 'Paraguay', NULL, NULL),
(168, 'PE', 'Peru', NULL, NULL),
(169, 'PH', 'Philippines', NULL, NULL),
(170, 'PN', 'Pitcairn', NULL, NULL),
(171, 'PL', 'Poland', NULL, NULL),
(172, 'PT', 'Portugal', NULL, NULL),
(173, 'PR', 'Puerto Rico', NULL, NULL),
(174, 'QA', 'Qatar', NULL, NULL),
(175, 'RE', 'Reunion', NULL, NULL),
(176, 'RO', 'Romania', NULL, NULL),
(177, 'RU', 'Russian Federation', NULL, NULL),
(178, 'RW', 'Rwanda', NULL, NULL),
(179, 'KN', 'Saint Kitts and Nevis', NULL, NULL),
(180, 'LC', 'Saint Lucia', NULL, NULL),
(181, 'VC', 'Saint Vincent and the Grenadines', NULL, NULL),
(182, 'WS', 'Samoa', NULL, NULL),
(183, 'SM', 'San Marino', NULL, NULL),
(184, 'ST', 'Sao Tome and Principe', NULL, NULL),
(185, 'SA', 'Saudi Arabia', NULL, NULL),
(186, 'SN', 'Senegal', NULL, NULL),
(187, 'SC', 'Seychelles', NULL, NULL),
(188, 'SL', 'Sierra Leone', NULL, NULL),
(189, 'SG', 'Singapore', NULL, NULL),
(190, 'SK', 'Slovakia', NULL, NULL),
(191, 'SI', 'Slovenia', NULL, NULL),
(192, 'SB', 'Solomon Islands', NULL, NULL),
(193, 'SO', 'Somalia', NULL, NULL),
(194, 'ZA', 'South Africa', NULL, NULL),
(195, 'GS', 'South Georgia South Sandwich Islands', NULL, NULL),
(196, 'ES', 'Spain', NULL, NULL),
(197, 'LK', 'Sri Lanka', NULL, NULL),
(198, 'SH', 'St. Helena', NULL, NULL),
(199, 'PM', 'St. Pierre and Miquelon', NULL, NULL),
(200, 'SD', 'Sudan', NULL, NULL),
(201, 'SR', 'Suriname', NULL, NULL),
(202, 'SJ', 'Svalbarn and Jan Mayen Islands', NULL, NULL),
(203, 'SZ', 'Swaziland', NULL, NULL),
(204, 'SE', 'Sweden', NULL, NULL),
(205, 'CH', 'Switzerland', NULL, NULL),
(206, 'SY', 'Syrian Arab Republic', NULL, NULL),
(207, 'TW', 'Taiwan', NULL, NULL),
(208, 'TJ', 'Tajikistan', NULL, NULL),
(209, 'TZ', 'Tanzania, United Republic of', NULL, NULL),
(210, 'TH', 'Thailand', NULL, NULL),
(211, 'TG', 'Togo', NULL, NULL),
(212, 'TK', 'Tokelau', NULL, NULL),
(213, 'TO', 'Tonga', NULL, NULL),
(214, 'TT', 'Trinidad and Tobago', NULL, NULL),
(215, 'TN', 'Tunisia', NULL, NULL),
(216, 'TR', 'Turkey', NULL, NULL),
(217, 'TM', 'Turkmenistan', NULL, NULL),
(218, 'TC', 'Turks and Caicos Islands', NULL, NULL),
(219, 'TV', 'Tuvalu', NULL, NULL),
(220, 'UG', 'Uganda', NULL, NULL),
(221, 'UA', 'Ukraine', NULL, NULL),
(222, 'AE', 'United Arab Emirates', NULL, NULL),
(223, 'GB', 'United Kingdom', NULL, NULL),
(224, 'UM', 'United States minor outlying islands', NULL, NULL),
(225, 'UY', 'Uruguay', NULL, NULL),
(226, 'UZ', 'Uzbekistan', NULL, NULL),
(227, 'VU', 'Vanuatu', NULL, NULL),
(228, 'VA', 'Vatican City State', NULL, NULL),
(229, 'VE', 'Venezuela', NULL, NULL),
(230, 'VN', 'Vietnam', NULL, NULL),
(231, 'VG', 'Virigan Islands (British)', NULL, NULL),
(232, 'VI', 'Virgin Islands (U.S.)', NULL, NULL),
(233, 'WF', 'Wallis and Futuna Islands', NULL, NULL),
(234, 'EH', 'Western Sahara', NULL, NULL),
(235, 'YE', 'Yemen', NULL, NULL),
(236, 'YU', 'Yugoslavia', NULL, NULL),
(237, 'ZR', 'Zaire', NULL, NULL),
(238, 'ZM', 'Zambia', NULL, NULL),
(239, 'ZW', 'Zimbabwe', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `amount` double DEFAULT NULL,
  `credit_amount` double DEFAULT NULL,
  `proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'en',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `lang`, `title`, `description`, `order`, `active`, `created_at`, `updated_at`) VALUES
(1, 'en', 'title one', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.', '1', 1, '2020-10-02 19:21:39', '2020-10-03 06:52:29'),
(2, 'en', 'lorem two', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.', '2', 1, '2020-10-02 19:23:03', '2020-10-02 19:23:03'),
(3, 'en', 'demo', 'bcgdvchsdbfj', NULL, 1, '2020-10-03 06:55:14', '2020-10-03 06:55:14'),
(4, 'en', 'lest4', 'Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used before final copy is available, but it may also be used to temporarily replace copy in a process called greeking, which allows designers to consider form without the meaning of the text influencing the design.\r\n\r\nLorem ipsum is typically a corrupted version of De finibus bonorum et malorum, a first-century BC text by the Roman statesman and philosopher Cicero, with words altered, added, and removed to make it nonsensical, improper Latin.', NULL, 1, '2020-10-22 06:54:28', '2020-10-22 06:54:28');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `txid` varchar(200) NOT NULL,
  `api_extra_fee` varchar(100) DEFAULT NULL,
  `changelly_fee` varchar(150) DEFAULT NULL,
  `payin_Address` varchar(150) DEFAULT NULL,
  `payin_extraid` varchar(100) DEFAULT NULL,
  `payout_address` varchar(100) DEFAULT NULL,
  `payout_extraid` varchar(100) DEFAULT NULL,
  `amount_expected_from` varchar(30) DEFAULT NULL,
  `amount_expected_to` varchar(30) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `currency_to` varchar(50) DEFAULT NULL,
  `currency_from` varchar(40) DEFAULT NULL,
  `amount_to` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `user_id`, `txid`, `api_extra_fee`, `changelly_fee`, `payin_Address`, `payin_extraid`, `payout_address`, `payout_extraid`, `amount_expected_from`, `amount_expected_to`, `status`, `currency_to`, `currency_from`, `amount_to`, `created_at`, `updated_at`) VALUES
(1, '1', 'cig0wzjtyjp95rt5', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.20031800', 'new', 'eth', 'btc', '0', '2020-12-03 01:40:33', '2020-12-03 01:40:33'),
(2, '1', '1ar6nqjnfwh62zr9', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.005', '0.16009550', 'new', 'eth', 'btc', '0', '2020-12-03 01:56:14', '2020-12-03 01:56:14'),
(3, '1', '4nbqimx1lethjbi3', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.003', '0.09611700', 'new', 'eth', 'btc', '0', '2020-12-03 01:58:40', '2020-12-03 01:58:40'),
(4, '1', '1jp6exdcwx11tycc', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '1', '31.72624065', 'new', 'eth', 'btc', '0', '2020-12-03 04:09:00', '2020-12-03 04:09:00'),
(5, '1', '38so0itjjiv5jtjl', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14728450', 'new', 'eth', 'btc', '0', '2020-12-03 06:25:08', '2020-12-03 06:25:08'),
(6, '1', 'ysa0h7ketd02eovs', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.15017000', 'new', 'eth', 'btc', '0', '2020-12-03 07:51:10', '2020-12-03 07:51:10'),
(7, '1', '7b01472giy09o1tl', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14648850', 'new', 'eth', 'btc', '0', '2020-12-03 07:52:29', '2020-12-03 07:52:29'),
(8, '1', 'md4k4os3ih50g2m4', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14559300', 'new', 'eth', 'btc', '0', '2020-12-03 07:52:43', '2020-12-03 07:52:43'),
(9, '1', 'mzuvkw5559mxzd96', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14559300', 'new', 'eth', 'btc', '0', '2020-12-03 07:52:48', '2020-12-03 07:52:48'),
(10, '1', 'ia91778py57yf9ot', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14559300', 'new', 'eth', 'btc', '0', '2020-12-03 07:52:48', '2020-12-03 07:52:48'),
(11, '1', 'g4ralfaubhrb82gf', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14529450', 'new', 'eth', 'btc', '0', '2020-12-03 07:52:48', '2020-12-03 07:52:48'),
(12, '1', 'yqcy78a8tr749qab', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14728450', 'new', 'eth', 'btc', '0', '2020-12-03 07:54:23', '2020-12-03 07:54:23'),
(13, '1', 'd9ezrzgsyjczq05j', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14678700', 'new', 'eth', 'btc', '0', '2020-12-03 07:54:55', '2020-12-03 07:54:55'),
(14, '1', 'jwo7j4w0ovsqz6ns', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14668750', 'new', 'eth', 'btc', '0', '2020-12-03 07:55:02', '2020-12-03 07:55:02'),
(15, '1', 'xnonybpaeisf1rgk', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14668750', 'new', 'eth', 'btc', '0', '2020-12-03 07:55:02', '2020-12-03 07:55:02'),
(16, '1', 'iyfuueofflojc075', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14668750', 'new', 'eth', 'btc', '0', '2020-12-03 07:55:03', '2020-12-03 07:55:03'),
(17, '1', '5mwq18u8eo1ylux7', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14668750', 'new', 'eth', 'btc', '0', '2020-12-03 07:55:03', '2020-12-03 07:55:03'),
(18, '1', 'q6d05socapxjopbu', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14668750', 'new', 'eth', 'btc', '0', '2020-12-03 07:55:03', '2020-12-03 07:55:03'),
(19, '1', 'mxwyjygwzux1xr80', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14628950', 'new', 'eth', 'btc', '0', '2020-12-03 07:55:07', '2020-12-03 07:55:07'),
(20, '1', 'kjyth0ytujuz71sk', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14628950', 'new', 'eth', 'btc', '0', '2020-12-03 07:55:08', '2020-12-03 07:55:08'),
(21, '1', '12j2akdeg4y1mhe2', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14628950', 'new', 'eth', 'btc', '0', '2020-12-03 07:55:08', '2020-12-03 07:55:08'),
(22, '1', 'jrnkz18cah2hmkal', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.14628950', 'new', 'eth', 'btc', '0', '2020-12-03 07:55:08', '2020-12-03 07:55:08'),
(23, '1', 'irl20j70ah72jhp6', '0', '0.4', '3LEmCUtTBpo6dPyTX9g6eYCPKWXg8rLJ9u', NULL, '0xecdf3210227ce060340bd98f637ad86a99c913c2', '', '0.1', '3.16748300', 'new', 'eth', 'btc', '0', '2020-12-04 04:15:27', '2020-12-04 04:15:27');

-- --------------------------------------------------------

--
-- Table structure for table `how_it_works`
--

CREATE TABLE `how_it_works` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kyc`
--

CREATE TABLE `kyc` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_exp` date DEFAULT NULL,
  `front_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `back_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_09_24_063558_create_abouts_table', 1),
(2, '2020_09_24_063558_create_admin_bank_details_table', 1),
(3, '2020_09_24_063558_create_adminwallet_table', 1),
(4, '2020_09_24_063558_create_buytrades_table', 1),
(5, '2020_09_24_063558_create_cms_table', 1),
(6, '2020_09_24_063558_create_commissions_table', 1),
(7, '2020_09_24_063558_create_completedtrades_table', 1),
(8, '2020_09_24_063558_create_countries_table', 1),
(9, '2020_09_24_063558_create_deposits_table', 1),
(10, '2020_09_24_063558_create_faqs_table', 1),
(11, '2020_09_24_063558_create_features_table', 1),
(12, '2020_09_24_063558_create_how_it_works_table', 1),
(13, '2020_09_24_063558_create_kyc_table', 1),
(14, '2020_09_24_063558_create_news_table', 1),
(15, '2020_09_24_063558_create_password_resets_table', 1),
(16, '2020_09_24_063558_create_selltrades_table', 1),
(17, '2020_09_24_063558_create_social_media_table', 1),
(18, '2020_09_24_063558_create_ticket_chats_table', 1),
(19, '2020_09_24_063558_create_tickets_table', 1),
(20, '2020_09_24_063558_create_trade_charts_table', 1),
(21, '2020_09_24_063558_create_tradepairs_table', 1),
(22, '2020_09_24_063558_create_transactions_table', 1),
(23, '2020_09_24_063558_create_twofa_option_table', 1),
(24, '2020_09_24_063558_create_user_bank_table', 1),
(25, '2020_09_24_063558_create_user_login_table', 1),
(26, '2020_09_24_063558_create_user_wallets_table', 1),
(27, '2020_09_24_063558_create_userpanel_settings_table', 1),
(28, '2020_09_24_063558_create_users_table', 1),
(29, '2020_09_24_063558_create_withdraw_request_table', 1),
(30, '2020_09_24_063601_add_foreign_keys_to_buytrades_table', 1),
(31, '2020_09_24_063601_add_foreign_keys_to_deposits_table', 1),
(32, '2020_09_24_063601_add_foreign_keys_to_kyc_table', 1),
(33, '2020_09_24_063601_add_foreign_keys_to_selltrades_table', 1),
(34, '2020_09_24_063601_add_foreign_keys_to_ticket_chats_table', 1),
(35, '2020_09_24_063601_add_foreign_keys_to_tickets_table', 1),
(36, '2020_09_24_063601_add_foreign_keys_to_user_wallets_table', 1),
(37, '2020_09_29_085001_create_abouts_table', 0),
(38, '2020_09_29_085001_create_admin_bank_details_table', 0),
(39, '2020_09_29_085001_create_adminwallet_table', 0),
(40, '2020_09_29_085001_create_buytrades_table', 0),
(41, '2020_09_29_085001_create_cms_table', 0),
(42, '2020_09_29_085001_create_commissions_table', 0),
(43, '2020_09_29_085001_create_completedtrades_table', 0),
(44, '2020_09_29_085001_create_countries_table', 0),
(45, '2020_09_29_085001_create_deposits_table', 0),
(46, '2020_09_29_085001_create_faqs_table', 0),
(47, '2020_09_29_085001_create_features_table', 0),
(48, '2020_09_29_085001_create_how_it_works_table', 0),
(49, '2020_09_29_085001_create_kyc_table', 0),
(50, '2020_09_29_085001_create_news_table', 0),
(51, '2020_09_29_085001_create_password_resets_table', 0),
(52, '2020_09_29_085001_create_selltrades_table', 0),
(53, '2020_09_29_085001_create_social_media_table', 0),
(54, '2020_09_29_085001_create_ticket_chats_table', 0),
(55, '2020_09_29_085001_create_tickets_table', 0),
(56, '2020_09_29_085001_create_trade_charts_table', 0),
(57, '2020_09_29_085001_create_tradepairs_table', 0),
(58, '2020_09_29_085001_create_transactions_table', 0),
(59, '2020_09_29_085001_create_twofa_option_table', 0),
(60, '2020_09_29_085001_create_user_bank_table', 0),
(61, '2020_09_29_085001_create_user_login_table', 0),
(62, '2020_09_29_085001_create_user_wallets_table', 0),
(63, '2020_09_29_085001_create_userpanel_settings_table', 0),
(64, '2020_09_29_085001_create_users_table', 0),
(65, '2020_09_29_085001_create_withdraw_request_table', 0),
(66, '2020_09_29_085005_add_foreign_keys_to_buytrades_table', 0),
(67, '2020_09_29_085005_add_foreign_keys_to_deposits_table', 0),
(68, '2020_09_29_085005_add_foreign_keys_to_kyc_table', 0),
(69, '2020_09_29_085005_add_foreign_keys_to_selltrades_table', 0),
(70, '2020_09_29_085005_add_foreign_keys_to_ticket_chats_table', 0),
(71, '2020_09_29_085005_add_foreign_keys_to_tickets_table', 0),
(72, '2020_09_29_085005_add_foreign_keys_to_user_wallets_table', 0),
(73, '2020_09_29_085051_create_abouts_table', 0),
(74, '2020_09_29_085051_create_admin_bank_details_table', 0),
(75, '2020_09_29_085051_create_adminwallet_table', 0),
(76, '2020_09_29_085051_create_buytrades_table', 0),
(77, '2020_09_29_085051_create_cms_table', 0),
(78, '2020_09_29_085051_create_commissions_table', 0),
(79, '2020_09_29_085051_create_completedtrades_table', 0),
(80, '2020_09_29_085051_create_countries_table', 0),
(81, '2020_09_29_085051_create_deposits_table', 0),
(82, '2020_09_29_085051_create_faqs_table', 0),
(83, '2020_09_29_085051_create_features_table', 0),
(84, '2020_09_29_085051_create_how_it_works_table', 0),
(85, '2020_09_29_085051_create_kyc_table', 0),
(86, '2020_09_29_085051_create_news_table', 0),
(87, '2020_09_29_085051_create_password_resets_table', 0),
(88, '2020_09_29_085051_create_selltrades_table', 0),
(89, '2020_09_29_085051_create_social_media_table', 0),
(90, '2020_09_29_085051_create_ticket_chats_table', 0),
(91, '2020_09_29_085051_create_tickets_table', 0),
(92, '2020_09_29_085051_create_trade_charts_table', 0),
(93, '2020_09_29_085051_create_tradepairs_table', 0),
(94, '2020_09_29_085051_create_transactions_table', 0),
(95, '2020_09_29_085051_create_twofa_option_table', 0),
(96, '2020_09_29_085051_create_user_bank_table', 0),
(97, '2020_09_29_085051_create_user_login_table', 0),
(98, '2020_09_29_085051_create_user_wallets_table', 0),
(99, '2020_09_29_085051_create_userpanel_settings_table', 0),
(100, '2020_09_29_085051_create_users_table', 0),
(101, '2020_09_29_085051_create_withdraw_request_table', 0),
(102, '2020_09_29_085054_add_foreign_keys_to_buytrades_table', 0),
(103, '2020_09_29_085054_add_foreign_keys_to_deposits_table', 0),
(104, '2020_09_29_085054_add_foreign_keys_to_kyc_table', 0),
(105, '2020_09_29_085054_add_foreign_keys_to_selltrades_table', 0),
(106, '2020_09_29_085054_add_foreign_keys_to_ticket_chats_table', 0),
(107, '2020_09_29_085054_add_foreign_keys_to_tickets_table', 0),
(108, '2020_09_29_085054_add_foreign_keys_to_user_wallets_table', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ourpartner`
--

CREATE TABLE `ourpartner` (
  `id` int(11) NOT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ourpartner`
--

INSERT INTO `ourpartner` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'https://image.freepik.com/free-vector/luxury-letter-e-logo-design_1017-8903.jpg', '2020-11-04 13:37:26', '2020-11-04 13:37:26'),
(2, 'https://image.freepik.com/free-vector/3d-box-logo_1103-876.jpg', '2020-11-04 13:37:45', '2020-11-04 13:37:45'),
(3, 'https://image.freepik.com/free-vector/blue-tech-logo_1103-822.jpg', '2020-11-04 13:38:04', '2020-11-04 13:38:04'),
(4, 'https://image.freepik.com/free-vector/colors-curl-logo-template_23-2147536125.jpg', '2020-11-04 13:38:27', '2020-11-04 13:38:27'),
(6, 'https://image.freepik.com/free-vector/abstract-cross-logo_23-2147536124.jpg', '2020-11-05 05:13:09', '2020-11-05 05:13:09'),
(7, 'https://image.freepik.com/free-vector/football-logo-background_1195-244.jpg', '2020-11-05 05:13:30', '2020-11-05 05:13:30'),
(8, 'https://image.freepik.com/free-vector/background-of-spots-halftone_1035-3847.jpg', '2020-11-05 05:13:51', '2020-11-05 05:13:51'),
(9, 'https://image.freepik.com/free-vector/retro-label-on-rustic-background_82147503374.jpg', '2020-11-05 05:14:11', '2020-11-05 05:14:11'),
(11, 'http://localhost/koboex-admin/storage\\app\\public\\OurPartner//download.jpg', '2020-11-05 02:08:46', '2020-11-05 02:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'demo', 'Demo testing', '', '2020-11-01 12:25:45', '2020-11-26 01:15:08'),
(2, ' NordVPN Customer ', 'I am surprised how, with such a high level of service quality, negative reviews continue\r\n                      to appear about changelly. It has everything you can think of here, from low fees\r\n                      to excellent customer support. This is my 100% choice', '', '2020-11-03 12:37:52', '2020-11-03 12:37:52'),
(3, 'title one ttt', 'I am surprised how, with such a high level of service quality, negative reviews continue\r\n                      to appear about changelly. It has everything you can think of here, from low fees\r\n                      to excellent customer support. This is my 100% choice', NULL, '2020-11-03 07:45:54', '2020-11-03 07:45:54'),
(4, 'title one', 'I am surprised how, with such a high level of service quality, negative reviews continue to appear about changelly. It has everything you can think of here, from low fees to excellent customer support. This is my 100% choice', NULL, '2020-11-03 07:48:37', '2020-11-03 07:48:37');

-- --------------------------------------------------------

--
-- Table structure for table `selltrades`
--

CREATE TABLE `selltrades` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `pair` int(11) DEFAULT NULL,
  `order_type` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `volume` double DEFAULT NULL,
  `value` double DEFAULT NULL,
  `remaining` double DEFAULT NULL,
  `stop_limit` double DEFAULT NULL,
  `fees` double DEFAULT NULL,
  `feepersentage` double DEFAULT NULL,
  `commission` double DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sell',
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `pinterest` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_plus` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `pinterest`, `fb`, `twitter`, `instagram`, `telegram`, `google_plus`, `whatsapp`, `created_at`, `updated_at`) VALUES
(1, 'https://in.pinterest.com/', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.instagram.com/', 'https://telegram.org/', NULL, NULL, '2020-12-04 11:44:52', '2020-12-04 06:19:26');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_chats`
--

CREATE TABLE `ticket_chats` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` int(11) NOT NULL DEFAULT 0,
  `admin_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tradepairs`
--

CREATE TABLE `tradepairs` (
  `id` int(10) UNSIGNED NOT NULL,
  `coinone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cointwo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commissionone` double DEFAULT NULL,
  `commissiontwo` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trade_charts`
--

CREATE TABLE `trade_charts` (
  `id` int(11) NOT NULL,
  `pair` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `open` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `high` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `low` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `close` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `tradeid` int(11) NOT NULL DEFAULT 0,
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `twofa_option`
--

CREATE TABLE `twofa_option` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 = deactive , 1= active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userpanel_settings`
--

CREATE TABLE `userpanel_settings` (
  `id` int(11) NOT NULL,
  `email_verification` int(11) NOT NULL DEFAULT 0,
  `mobile_verification` int(11) NOT NULL DEFAULT 0,
  `twofa` int(11) NOT NULL DEFAULT 0,
  `kyc` int(11) DEFAULT 0,
  `withdraw_limit` int(11) NOT NULL DEFAULT 0,
  `deposit_limit` int(11) NOT NULL DEFAULT 0,
  `site_balance` int(11) NOT NULL DEFAULT 0,
  `notification` int(11) NOT NULL DEFAULT 0,
  `notification_medium` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verifyToken` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refrere_id` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google2fa_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google2fa_status` int(11) NOT NULL DEFAULT 0,
  `twofa_enable` int(3) NOT NULL DEFAULT 0,
  `email_verify` int(11) NOT NULL DEFAULT 0,
  `kyc_id` int(11) DEFAULT NULL,
  `kyc_verify` int(11) NOT NULL DEFAULT 0,
  `email_otp_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_otp_status` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `event_update_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `login_device` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `login_status` int(11) NOT NULL DEFAULT 0,
  `reg_ip_addr` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `country`, `address`, `password`, `verifyToken`, `client_id`, `refrere_id`, `google2fa_secret`, `google2fa_status`, `twofa_enable`, `email_verify`, `kyc_id`, `kyc_verify`, `email_otp_code`, `email_otp_status`, `status`, `event_update_status`, `login_device`, `login_status`, `reg_ip_addr`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'jaguar@mailinator.com', NULL, NULL, NULL, '$2y$10$muZkCr2a0hDbENmZJJCSiuuHxVVzcaN2pERldJFEprhaCEuhGg4lC', NULL, 'gqqh38', '', 'E4W26NNPQWE4KRLI', 0, 0, 1, NULL, 0, NULL, 0, 1, '0', 'web', 1, '::1', NULL, '2020-12-02 04:56:32', '2020-12-02 06:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_bank`
--

CREATE TABLE `user_bank` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_branch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `swift_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_ip` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `process` varchar(230) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `user_id`, `login_ip`, `process`, `created_at`, `updated_at`) VALUES
(1, 1, '::1', 'Logout', '2020-12-02 11:47:23', '2020-12-02 11:47:23'),
(2, 1, '::1', 'Logout', '2020-12-03 08:32:38', '2020-12-03 08:32:38'),
(3, 1, '::1', 'Logout', '2020-12-03 12:17:54', '2020-12-03 12:17:54'),
(4, 1, '::1', 'Logout', '2020-12-03 13:12:21', '2020-12-03 13:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_wallets`
--

CREATE TABLE `user_wallets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `escrow_balance` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_request`
--

CREATE TABLE `withdraw_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_fee` double NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminwallet`
--
ALTER TABLE `adminwallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_bank_details`
--
ALTER TABLE `admin_bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buytrades`
--
ALTER TABLE `buytrades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buytrades_uid_foreign` (`uid`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `completedtrades`
--
ALTER TABLE `completedtrades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deposits_uid_foreign` (`uid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `how_it_works`
--
ALTER TABLE `how_it_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc`
--
ALTER TABLE `kyc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kyc_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ourpartner`
--
ALTER TABLE `ourpartner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selltrades`
--
ALTER TABLE `selltrades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `selltrades_uid_foreign` (`uid`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`);

--
-- Indexes for table `ticket_chats`
--
ALTER TABLE `ticket_chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_chats_ticket_id_foreign` (`ticket_id`),
  ADD KEY `ticket_chats_user_id_foreign` (`user_id`);

--
-- Indexes for table `tradepairs`
--
ALTER TABLE `tradepairs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trade_charts`
--
ALTER TABLE `trade_charts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `twofa_option`
--
ALTER TABLE `twofa_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userpanel_settings`
--
ALTER TABLE `userpanel_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_bank`
--
ALTER TABLE `user_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallets`
--
ALTER TABLE `user_wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_wallets_user_id_foreign` (`user_id`);

--
-- Indexes for table `withdraw_request`
--
ALTER TABLE `withdraw_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `adminwallet`
--
ALTER TABLE `adminwallet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_bank_details`
--
ALTER TABLE `admin_bank_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buytrades`
--
ALTER TABLE `buytrades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `completedtrades`
--
ALTER TABLE `completedtrades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `how_it_works`
--
ALTER TABLE `how_it_works`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kyc`
--
ALTER TABLE `kyc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ourpartner`
--
ALTER TABLE `ourpartner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `selltrades`
--
ALTER TABLE `selltrades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_chats`
--
ALTER TABLE `ticket_chats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tradepairs`
--
ALTER TABLE `tradepairs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trade_charts`
--
ALTER TABLE `trade_charts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `twofa_option`
--
ALTER TABLE `twofa_option`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userpanel_settings`
--
ALTER TABLE `userpanel_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_bank`
--
ALTER TABLE `user_bank`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_wallets`
--
ALTER TABLE `user_wallets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_request`
--
ALTER TABLE `withdraw_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buytrades`
--
ALTER TABLE `buytrades`
  ADD CONSTRAINT `buytrades_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `kyc`
--
ALTER TABLE `kyc`
  ADD CONSTRAINT `kyc_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `selltrades`
--
ALTER TABLE `selltrades`
  ADD CONSTRAINT `selltrades_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ticket_chats`
--
ALTER TABLE `ticket_chats`
  ADD CONSTRAINT `ticket_chats_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `ticket_chats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_wallets`
--
ALTER TABLE `user_wallets`
  ADD CONSTRAINT `user_wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
