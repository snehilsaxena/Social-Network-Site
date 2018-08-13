-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2017 at 10:39 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `date_added`) VALUES
(8, 5, 4, 'dknfzkcsdx fksdxmlkdglskfm lkdsmflk sdlkf dslkfm dslfsd flksdkf sldknfsdn dfcsdknfzkcsdx fksdxmlkdglskfm lkdsmflk sdlkf dslkfm dslfsd flksdkf sldknfsdn dfcsdknfzkcsdx fksdxmlkdglskfm lkdsmflk sdlkf dslkfm dslfsd flksdkf sldknfsdn dfcsdknfzkcsdx fksdxmlkdglskfm lkdsmflk sdlkf dslkfm dslfsd flksdkf sldknfsdn dfcsdknfzkcsdx fksdxmlkdglskfm lkdsmfl', '2017-04-19 16:06:15'),
(13, 15, 1, 'test comment', '2017-04-19 17:32:26'),
(14, 20, 1, 'cnjkdsn', '2017-04-19 21:06:54'),
(15, 23, 4, 'abc', '2017-04-20 02:42:16'),
(16, 23, 4, 'test comment', '2017-04-20 02:42:26'),
(17, 23, 4, 'nksajn', '2017-04-20 11:59:26'),
(23, 20, 4, 'test', '2017-04-22 02:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People''s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People''s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user1`, `user2`, `date_added`) VALUES
(1, 4, 1, '2017-04-15 16:04:04'),
(3, 4, 2, '2017-04-15 16:14:49'),
(5, 4, 3, '2017-04-22 02:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `inbox_user`
--

CREATE TABLE `inbox_user` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbox_user`
--

INSERT INTO `inbox_user` (`id`, `user1`, `user2`, `date_added`) VALUES
(1, 4, 1, '2017-04-20 15:53:48'),
(2, 4, 2, '2017-04-20 17:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(220) NOT NULL,
  `password` varchar(220) NOT NULL,
  `token` varchar(40) NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `password`, `token`, `activated`, `date_added`) VALUES
(1, 'Test', 'test@gmail.com', 'test', '', '1', '2017-04-08 13:42:35'),
(2, 'Abc', 'abc@gmail.com', 'abc', '', '1', '2017-04-08 13:42:48'),
(3, 'Alex', 'alex@gmail.com', 'alex', '', '1', '2017-04-08 14:23:16'),
(4, 'faisal', 'faisal123@gmail.com', 'test', 'f4668288fdbf9773dd9779d412942905', '1', '2017-04-08 14:29:35'),
(8, 'xyz', 'xyz@gmail.com', 'xyz', 'd16fb36f0911f878998c136191af705e', '1', '2017-04-21 16:15:01');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sendingfrom` int(11) NOT NULL,
  `sendingto` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sendingfrom`, `sendingto`, `message`, `date_added`) VALUES
(1, 4, 1, 'abc', '2017-04-20 15:53:48'),
(2, 4, 1, 'test', '2017-04-20 17:18:23'),
(3, 4, 1, 'Hey How u doin', '2017-04-20 17:18:31'),
(4, 4, 1, 'Whats hapenning?', '2017-04-20 17:23:22'),
(13, 4, 2, 'test', '2017-04-20 17:55:26'),
(14, 4, 1, 'Everything good', '2017-04-21 14:53:27'),
(15, 4, 1, 'dfjsjklfjds\r\n', '2017-04-21 14:53:33'),
(16, 4, 1, 'Whats going on', '2017-04-21 14:53:36'),
(17, 4, 2, 'test 2', '2017-04-21 15:24:25'),
(18, 4, 2, 'test 3', '2017-04-21 15:30:24'),
(19, 4, 1, 'test message', '2017-04-21 15:33:00'),
(20, 4, 1, 'Hows everybody', '2017-04-21 15:33:11'),
(21, 4, 1, 'Want to play cricket', '2017-04-21 15:33:48'),
(22, 4, 1, 'Awesome weather', '2017-04-21 15:33:56'),
(23, 4, 1, 'Dry friuts', '2017-04-21 15:35:02'),
(24, 1, 4, 'Hello faisal', '2017-04-21 15:35:39'),
(25, 4, 2, 'hey', '2017-04-21 18:39:48'),
(26, 4, 1, 'hello', '2017-04-22 02:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `noti_from` int(11) NOT NULL,
  `noti_to` int(11) NOT NULL,
  `is_read` enum('0','1') NOT NULL,
  `date_added` datetime NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `noti_from`, `noti_to`, `is_read`, `date_added`, `message`) VALUES
(6, 1, 4, '0', '2017-04-15 15:09:00', 'Test sent you friend request. \n					<input type=''button'' value=''Accept'' class=''actionBtn accept'' data-type=''1'' data-user=''1'' /> \n\n					<input type=''button'' value=''Reject'' class=''actionBtn reject'' data-type=''2'' data-user=''1'' />\n					'),
(7, 2, 4, '0', '2017-04-15 00:00:00', 'Abc sent you friend request. \n					<input type=''button'' value=''Accept'' class=''actionBtn accept'' data-type=''1'' data-user=''2'' /> \n\n					<input type=''button'' value=''Reject'' class=''actionBtn reject'' data-type=''2'' data-user=''2'' />\n					'),
(8, 4, 1, '0', '2017-04-21 18:54:02', 'faisal sent you friend request. \r\n					<input type=''button'' value=''Accept'' class=''actionBtn accept'' data-type=''1'' data-user=''4'' /> \r\n\r\n					<input type=''button'' value=''Reject'' class=''actionBtn reject'' data-type=''2'' data-user=''4'' />\r\n					'),
(10, 3, 4, '0', '2017-04-22 02:03:30', 'Alex sent you friend request. \r\n					<input type=''button'' value=''Accept'' class=''actionBtn accept'' data-type=''1'' data-user=''3'' /> \r\n\r\n					<input type=''button'' value=''Reject'' class=''actionBtn reject'' data-type=''2'' data-user=''3'' />\r\n					');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_to` int(11) NOT NULL,
  `status` text NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_to`, `status`, `date_added`) VALUES
(1, 4, 0, 'test post', '2017-04-17 01:47:46'),
(2, 4, 0, 'abc', '2017-04-17 01:48:34'),
(5, 4, 0, 'dglskfm lkdsmflk sdlkf dslkfm dslfsd flksdkf sldknfsdn dfcsdknfzkcsdx fksdxmlkdglskfm lkdsmflk sdlkf dslkfm dslfsd flksdkf sldknfsdn dfcsdknfzkcsdx fksdxmlkdglskfm lkdsmflk sdlkf dslkfm dslfsd flksdkf sldknfsdn dfcsdknfzkcsdx fksdxmlkdglskfm lkdsmflk sdlkf dslkfm dslfsd flksdkf sldknfsdn dfcsdknfzkcsdx fksdxmlkdglskfm lkdsmflk sdlkf dslkfm dslfsd flksdkf sldknfsdn dfcsdknfzkcsdx fksdxmlkdglskfm lkdsmflk sdlkf dslkfm dslfsd flksdkf sldknfsdn dfcsdknfzkcsdx fksdxmlkdglskfm lkdsmflk sdlkf dslkfm dslfsd flksdkf sldknfsdn dfcsdknfzkcsdx fksdxmlkdglskfm lkdsmflk sdlkf dslkfm dslfsd flksdkf sldknfsdn dfcsdknfzkcsdx fksdxmlkdglskfm lkdsmflk sdlkf dslkfm dslfsd flksdkf sldknfsdn dfcsdknfzkcsdx fksdxmlkdglskfm lkdsmflk sdlkf dslkfm dslfsd flksdkf sldknfsdn dfcsdknfzkcsdx fksdxmlkdglskfm lkdsmflk sdl', '2017-04-17 02:36:44'),
(8, 4, 0, 'a', '2017-04-19 02:48:47'),
(20, 1, 0, 'ckdsnkcx', '2017-04-19 21:05:31'),
(24, 4, 4, 'c kdsckjsdnlk', '2017-04-20 13:29:12'),
(25, 4, 4, 'cdskn', '2017-04-21 18:06:25'),
(26, 4, 4, 'my own wall', '2017-04-21 18:52:30'),
(27, 4, 0, 'hello everybody', '2017-04-21 18:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `ppicture` varchar(300) NOT NULL,
  `about` text NOT NULL,
  `gender` varchar(200) NOT NULL,
  `dob` varchar(200) NOT NULL,
  `edu1` varchar(1000) NOT NULL,
  `edu2` varchar(1000) NOT NULL,
  `edu3` varchar(1000) NOT NULL,
  `country` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `ppicture`, `about`, `gender`, `dob`, `edu1`, `edu2`, `edu3`, `country`, `date_added`, `user_id`) VALUES
(3, '999920170412112105banner_image.jpg', 'nasjknd', 'm', '2017-04-14', ' sakbdn', 'cskajb', 'cnskaj', 167, '2017-04-12 12:48:21', 4);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `sendingto` int(11) NOT NULL,
  `sendingfrom` int(11) NOT NULL,
  `accepted` enum('0','1','2') NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `sendingto`, `sendingfrom`, `accepted`, `date_added`) VALUES
(3, 4, 1, '1', '2017-04-15 02:09:59'),
(4, 4, 2, '1', '2017-04-15 15:09:00'),
(5, 1, 4, '0', '2017-04-21 18:54:02'),
(6, 4, 2, '0', '2017-04-22 02:00:34'),
(7, 4, 3, '1', '2017-04-22 02:03:30');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `postwall` enum('1','2') NOT NULL,
  `seeposts` enum('1','2') NOT NULL,
  `seeprofile` enum('1','2') NOT NULL,
  `sendmessage` enum('1','2') NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `user_id`, `postwall`, `seeposts`, `seeprofile`, `sendmessage`, `date_added`) VALUES
(1, 4, '2', '2', '2', '1', '2017-04-21 16:45:02'),
(2, 1, '1', '2', '2', '1', '2017-04-21 16:45:02'),
(6, 8, '1', '2', '2', '2', '2017-04-21 16:19:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inbox_user`
--
ALTER TABLE `inbox_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `inbox_user`
--
ALTER TABLE `inbox_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
