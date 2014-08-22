-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2014 at 05:21 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dev302_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `unitNum` tinyint(4) DEFAULT NULL,
  `streetNum` smallint(6) NOT NULL,
  `streetName` varchar(50) NOT NULL,
  `streetType` varchar(10) NOT NULL,
  `suburb` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postcode` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `shipBill` enum('ship','bill','both') NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catName` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `catName`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Animation'),
(4, 'Biography'),
(5, 'Comedy'),
(6, 'Crime'),
(7, 'Documentary'),
(8, 'Drama'),
(9, 'Family'),
(10, 'Fantasy'),
(11, 'Film-Noir'),
(12, 'History'),
(13, 'Horror'),
(14, 'Music'),
(15, 'Musical'),
(16, 'Mystery'),
(17, 'Romance'),
(18, 'Sci-Fi'),
(19, 'Sport'),
(20, 'Thriller'),
(21, 'War'),
(22, 'Western');

-- --------------------------------------------------------

--
-- Table structure for table `classification`
--

CREATE TABLE IF NOT EXISTS `classification` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `rating` varchar(6) NOT NULL COMMENT 'eg. MA15+',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `classification`
--

INSERT INTO `classification` (`id`, `rating`) VALUES
(1, 'CTC'),
(2, 'E'),
(3, 'G'),
(4, 'PG'),
(5, 'M'),
(6, 'MA15+'),
(7, 'R18+'),
(8, 'X18+');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL COMMENT 'url to img',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stripe_id` int(11) NOT NULL,
  `shipCo` varchar(100) DEFAULT NULL,
  `shipDate` date DEFAULT NULL,
  `status` enum('open','complete','abandoned') NOT NULL,
  `lastUpdate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE IF NOT EXISTS `price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `qty` smallint(6) NOT NULL,
  `description` text NOT NULL,
  `content_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `qty`, `description`, `content_id`) VALUES
(1, 'Fullmetal Alchemist: Brotherhood Collection', 17, 'Edward and Alphonse Elric''s reckless disregard for alchemy''s fundamental laws ripped half of Ed''s limbs from his body and left Al''s soul clinging to a cold suit of armour. To restore what was lost, the brothers scour a war-torn land for the Philosopher''s Stone, a fabled relic which grants the ability to perform alchemy in impossible ways.\r\n\r\nThe Elrics are not alone in their search; the corrupt State Military is also eager to harness the artifact''s power. So too are the strange Homunculi and their shadowy creator. The mythical gem lures exotic alchemists from distant kingdoms, scarring some deeply enough to inspire murder. As the Elrics find their course altered by these enemies and allies, their purpose remains unchanged - and their bond unbreakable.', 5),
(2, 'Game of Thrones: Season 1', 27, 'Summers span decades. Winters can last a lifetime. And the struggle for the Iron Throne has begun. It will stretch from the South where heat breeds plots, lusts and intrigues; to the vast and savage Eastern lands; all the way to the frozen North where an 800-foot wall of ice protects the Kingdom from the dark forces that lie beyond. Kings and queens, knights and renegades, liars, lords and honest men...all will play ''The Game of Thrones''. The kingdom is in turmoil. Rival families spin webs of political & sexual intrigue to gain control. Murder, conspiracy, betrayal - anything goes in the battle to gain control of the Iron Throne. And in this game, you win or you die!\r\n\r\nA new original series based on George R. R. Martin''s best-selling ''A Song of Ice and Fire'' series.', 7),
(3, 'Game of Thrones: Season 2', 12, 'Seven noble families fight for control of the mythical land of Westeros. Political and sexual intrigue is pervasive. Robert Baratheon, King of Westeros, asks his old friend Eddard, Lord Stark, to serve as Hand of the King, or highest official. Secretly warned that the previous Hand was assassinated, Eddard accepts in order to investigate further. Meanwhile the Queen''s family, the Lannisters, may be hatching a plot to take power. In Season 2, Game of Thrones mostly covers the events of A Clash of Kings, the second book of the A Song of Ice and Fire novels by George R. R. Martin, of which the series is an adaptation.', 7),
(4, 'Game of Thrones: Season 3', 4, 'Seven noble families fight for control of the mythical land of Westeros. Political and sexual intrigue is pervasive. Robert Baratheon, King of Westeros, asks his old friend Eddard, Lord Stark, to serve as Hand of the King, or highest official. Secretly warned that the previous Hand was assassinated, Eddard accepts in order to investigate further. Meanwhile the Queen''s family, the Lannisters, may be hatching a plot to take power. Across the sea, the last members of the previous and deposed ruling family, the Targaryens, are also scheming to regain the throne. The friction between the houses Stark, Lannister and Baratheon, and with the remaining great houses Greyjoy, Tully, Arryn, and Tyrell, leads to full-scale war. All while a very ancient evil awakens in the farthest north. Amidst the war and political confusion, a neglected military order of misfits, the Night''s Watch, is all that stands between the realms of men and icy horrors beyond.', 6),
(5, 'Star Wars: The Complete Saga', 28, 'All six movies of the Star Wars saga (Episodes I-VI) are together for the first time in one collectible set. Each film presented on one Blu-ray disc to ensure maximum picture and sound quality. Three bonus discs of extras, with more than 30 hours of in-depth bonus features including never-before-seen deleted and alternate scenes, an exploration of the exclusive Star Wars archives, and much more.\r\n\r\nStar Wars Episode I: The Phantom Menace: Stranded on the desert planet Tatooine after rescuing young Queen Amidala from the impending invasion of Naboo, Jedi apprentice Obi-Wan Kenobi and his Jedi Master discover nine-year-old Anakin Skywalker, a young slave unusually strong in the Force. Anakin wins a thrilling Podrace and with it his freedom as he leaves his home to be trained as a Jedi. The heroes return to Naboo where Anakin and the Queen face massive invasion forces while the two Jedi contend with a deadly foe named Darth Maul. Only then do they realize the invasion is merely the first step in a sinister scheme by the re-emergent forces of darkness known as the Sith.\r\n\r\nStar Wars Episode II: Attack of the Clones: Ten years after the events of the Battle of Naboo, not only has the galaxy undergone significant change, but so have Obi-Wan Kenobi, Padmé Amidala, and Anakin Skywalker as they are thrown together again for the first time since the Trade Federation invasion of Naboo. Anakin has grown into the accomplished Jedi apprentice of Obi-Wan, who himself has transitioned from student to teacher. The two Jedi are assigned to protect Padmé whose life is threatened by a faction of political separatists. As relationships form and powerful forces collide, these heroes face choices that will impact not only their own fates, but the destiny of the Republic.\r\n\r\nStar Wars Episode III: Revenge of the Sith: Three years after the onset of the Clone Wars, the noble Jedi Knights have been leading a massive clone army into a galaxy-wide battle against the Separatists. When the sinister Sith unveil a thousand-year-old plot to rule the galaxy, the Republic crumbles and from its ashes rises the evil Galactic Empire. Jedi hero Anakin Skywalker is seduced by the dark side of the Force to become the Emperor''s new apprentice - Darth Vader. The Jedi are decimated, as Obi-Wan Kenobi and Jedi Master Yoda are forced into hiding. The only hope for the galaxy are Anakin''s own offspring - the twin children born in secrecy who will grow up to become Luke Skywalker and Princess Leia Organa.\r\n\r\nStar Wars Episode IV: A New Hope: Nineteen years after the formation of the Empire, Luke Skywalker is thrust into the struggle of the Rebel Alliance when he meets Obi-Wan Kenobi, who has lived for years in seclusion on the desert planet of Tatooine. Obi-Wan begins Luke''s Jedi training as Luke joins him on a daring mission to rescue the beautiful Rebel leader Princess Leia from the clutches of the evil Empire. Although Obi-Wan sacrifices himself in a lightsaber duel with Darth Vader, his former apprentice, Luke proves that the Force is with him by destroying the Empire''s dreaded Death Star.\r\n\r\nStar Wars Episode V: The Empire Strikes Back: Luke Skywalker and his friends have set up a new base on the ice planet of Hoth, but it is not long before their secret location is discovered by the evil Empire. After narrowly escaping, Luke splits off from his friends to seek out a Jedi Master called Yoda. Meanwhile, Han Solo, Chewbacca, Princess Leia, and C-3PO seek sanctuary at a city in the Clouds run by Lando Calrissian, an old friend of Han’s. But little do they realize that Darth Vader already awaits them.\r\n\r\nStar Wars Episode VI: Return of the Jedi: In the epic conclusion of the saga, the Empire prepares to crush the Rebellion with a more powerful Death Star while the Rebel fleet mounts a massive attack on the space station. Luke Skywalker confronts his father Darth Vader in a final climactic duel before the evil Emperor. In the last second, Vader makes a momentous choice: he destroys the Emperor and saves his son. The Empire is finally defeated, the Sith are destroyed, and Anakin Skywalker is thus redeemed. At long last, freedom is restored to the galaxy.', 5),
(6, 'Aristocats', 9, 'Share all the heart, humour and irresistible music with your family in this jazzy Special Edition! In the heart of Paris, a kind and eccentric millionairess wills her entire estate to Duchess, her high-society cat, and her three kittens. When her greedy, bumbling butler attempts the ultimate catnap caper, the rough-and-tumble alley cat Thomas O''Malley and his band of swingin'' jazz cats must save the day. It''s the purr-fect blend of comedy and adventure. This timeless treasure boasts remarkable picture and sound quality, fun-filled special features and memorable songs the whole family will enjoy.', 3),
(7, 'Wreck-It Ralph', 27, 'Prepare for adventure when “the most original film in years” (Bryan Erdy, CBS-TV) that thrilled audiences of all ages drops on DVD! From Walt Disney Animation Studios comes a hilarious, arcade-game-hopping journey in Disney’s Wreck-It Ralph.\r\n \r\nFor decades, Ralph has played the bad guy in his popular video game. In a bold move, he embarks on an action-packed adventure and sets out to prove to everyone that he is a true hero with a big heart. As he explores exciting new worlds, he teams up with some unlikely new friends including feisty misfit Vanellope von Schweetz. Then, when an evil enemy threatens their world, Ralph realises he holds the fate of the entire arcade in his massive hands.\r\n \r\nFeaturing an all-star voice cast and a groundbreaking animated short film, Disney’s Wreck-It Ralph has something for every player. Bring home the ultimate reward on Disney DVD!', 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(7, 9),
(1, 3),
(5, 18),
(6, 9),
(6, 3),
(7, 3),
(2, 10),
(3, 10),
(4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE IF NOT EXISTS `product_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `qty` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stars` tinyint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` enum('Mr','Ms','Miss','Mrs','Dr') NOT NULL,
  `uname` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'max email length is 245 characters',
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `pword` varchar(128) NOT NULL COMMENT 'sha512 encrypts to 128 characters',
  `dob` date NOT NULL,
  `phone` varchar(30) NOT NULL COMMENT 'to include international dialing codes',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `access` varchar(10) NOT NULL,
  `lastVisit` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` enum('true','false') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `title`, `uname`, `email`, `fname`, `lname`, `pword`, `dob`, `phone`, `date`, `access`, `lastVisit`, `active`) VALUES
(1, 'Mr', 'aaron', 'aaron@aaron.com', 'Aaron', 'H', '88274620de3dcddd9710bf230a28ffe929c320c6752b99f5b74a17caf75781eac416c25848a84c02aa46fb74c099e84752dc7923310d7e8edb880272c11be22c', '1986-07-23', '0421432668', '2014-08-14 06:07:13', 'admin', '2014-08-21 19:18:30', 'true'),
(2, 'Ms', 'admin', 'admin@admin.com', 'admin', 'user', '8dea7121136fa805e7ac93a9971525c4f35c9bfea7db5db1bf74f8dc17d00aa8636757d4081424ea645ceb93851f37470f320f26f220ae049e1ad7384798d211', '1970-01-01', '0404123456', '2014-08-14 06:20:12', 'mod', '0000-00-00 00:00:00', 'true'),
(3, 'Mrs', 'user', 'user@user.com', 'user', 'name', '8dea7121136fa805e7ac93a9971525c4f35c9bfea7db5db1bf74f8dc17d00aa8636757d4081424ea645ceb93851f37470f320f26f220ae049e1ad7384798d211', '1963-02-01', '1234567890', '2014-08-14 06:31:51', 'user', '0000-00-00 00:00:00', 'true'),
(4, 'Mr', 'New', 'newuser@users.com', 'user', 'name', '8dea7121136fa805e7ac93a9971525c4f35c9bfea7db5db1bf74f8dc17d00aa8636757d4081424ea645ceb93851f37470f320f26f220ae049e1ad7384798d211', '1552-05-05', '0404321654', '2014-08-14 06:34:21', 'user', '0000-00-00 00:00:00', 'true'),
(5, 'Mr', 'another', 'another@user.com', 'Another', 'user', '8dea7121136fa805e7ac93a9971525c4f35c9bfea7db5db1bf74f8dc17d00aa8636757d4081424ea645ceb93851f37470f320f26f220ae049e1ad7384798d211', '1999-04-06', '55543267980', '2014-08-14 06:36:05', 'user', '0000-00-00 00:00:00', 'true'),
(6, 'Mr', 'Test', 'test@users.com', 'new', 'user', '8dea7121136fa805e7ac93a9971525c4f35c9bfea7db5db1bf74f8dc17d00aa8636757d4081424ea645ceb93851f37470f320f26f220ae049e1ad7384798d211', '1985-01-01', '04561230147', '2014-08-14 06:49:32', 'user', '0000-00-00 00:00:00', 'true'),
(7, 'Mr', 'ADMIN', 'admin@users.com', 'Admin', 'Admin', '8dea7121136fa805e7ac93a9971525c4f35c9bfea7db5db1bf74f8dc17d00aa8636757d4081424ea645ceb93851f37470f320f26f220ae049e1ad7384798d211', '1991-01-01', 'Admin', '2014-08-14 06:50:39', 'user', '0000-00-00 00:00:00', 'true'),
(8, 'Mr', 'Work', 'blah@over.shit', 'u', 'n', '8dea7121136fa805e7ac93a9971525c4f35c9bfea7db5db1bf74f8dc17d00aa8636757d4081424ea645ceb93851f37470f320f26f220ae049e1ad7384798d211', '1991-01-01', 'number', '2014-08-14 06:52:06', 'user', '0000-00-00 00:00:00', 'true'),
(9, 'Miss', 'AGAIN', 'another@test.com', 'again', 'agin', '09789a2a733fe88af2780e993fe8a2bb77f566db026dd9a14a5a38435aa2a1fe4167f2631277ad0ac04d3f3b5ac13d52e5b8bcedbb60ad8b6ce89a9d8b1caac6', '1912-12-12', 'again', '2014-08-14 07:04:59', 'user', '0000-00-00 00:00:00', 'true'),
(10, 'Mr', 'please', 'blah@blahblah.com', 'sdf', 'kjnsdf', '8270bd83a6ebfd12bf36f92f3a79f42d5633ca1f09b215b217b20e33bc4171d02a4021cb8095803bc5d510dbbdeca1f5431723ef85e528643eb414fb98a925ae', '4567-03-12', 'kjdsnfgjksadbnf', '2014-08-14 07:11:36', 'user', '2014-08-13 23:30:59', 'true'),
(11, 'Mrs', 'asd', 'aaron1@aaron.com', 'Aaron', 'asd', '556f93f2fe59bcf8d3b2f63a0963ae29e3dc49f74ecae5800097124ba7c62339ae864ebb7f4221eb019a2a86ab4002b4251dd49792e08026d94e6ae97209786b', '2002-01-01', 'asdasd', '2014-08-19 01:02:49', 'user', '0000-00-00 00:00:00', 'true'),
(12, 'Ms', 'fafa', 'aaron23@aaron.com', 'Aaron', 'asd', '1bc01c3395d772731f8cf7e821b515354378707e4c4825d88d57e2ca4904533b1beecf0cf9516a3d688dbd6ad95809f4a635f45bc58e4d2fad5f1800d7ab35c2', '2002-01-01', 'asdasd', '2014-08-19 02:20:11', 'user', '2014-08-18 19:56:18', 'true'),
(13, 'Mr', 'asdfasdfgadfg', 'aaron123@aaron.com', 'Aaron', 'asd', '072c96cba8182c7e2ede0b5a1468c15452b65ed83fac3162639598425190c8037d063b135062876d4021214c461ef4e819f788a1a37637769a83adc37b3b1445', '2002-01-01', 'asdasd', '2014-08-19 02:37:38', 'user', '0000-00-00 00:00:00', 'true'),
(14, '', 'aaron1', 'aaron_h23@hotmail.com', 'a', 'asdsadf', '072c96cba8182c7e2ede0b5a1468c15452b65ed83fac3162639598425190c8037d063b135062876d4021214c461ef4e819f788a1a37637769a83adc37b3b1445', '2002-01-01', 'aaas', '2014-08-22 00:44:55', 'user', '0000-00-00 00:00:00', 'true'),
(15, '', 'aaron234234', 'aaro123n@aaron.com', 'Aaron', 'asdsadf', '072c96cba8182c7e2ede0b5a1468c15452b65ed83fac3162639598425190c8037d063b135062876d4021214c461ef4e819f788a1a37637769a83adc37b3b1445', '2002-01-01', 'aaas', '2014-08-22 00:58:47', 'user', '0000-00-00 00:00:00', 'true'),
(16, 'Dr', 'asdasdasdasfsadfsdv', 'aaronq_h23@hotmail.com', 'Aaron', 'Humphreys', '072c96cba8182c7e2ede0b5a1468c15452b65ed83fac3162639598425190c8037d063b135062876d4021214c461ef4e819f788a1a37637769a83adc37b3b1445', '2002-01-01', 'asdafsfd', '2014-08-22 01:07:44', 'user', '0000-00-00 00:00:00', 'true'),
(17, '', 'dev302', 'admin@admin.data', 'Ad', 'Min', 'c7addf871288e09a6467dbcb44d6dcf1c9d604877f05b32fe92cdf3b6225a202928243a7e6f765468ceba999ec59ee0334e08c90d8832ade3059020b11f3dbd4', '2002-01-01', '555010203', '2014-08-22 03:18:07', 'admin', '2014-08-21 19:18:52', 'true');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
