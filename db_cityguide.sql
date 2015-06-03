-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2015 at 07:26 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_cityguide`
--
CREATE DATABASE IF NOT EXISTS `db_cityguide` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_cityguide`;

-- --------------------------------------------------------

--
-- Table structure for table `attraction`
--

CREATE TABLE IF NOT EXISTS `attraction` (
  `attr_id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_title` tinytext NOT NULL,
  `attr_description` text NOT NULL,
  `price_adult` double NOT NULL,
  `price_child` double NOT NULL,
  `address` tinytext NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `opening_hrs` text NOT NULL,
  `category_id` varchar(5) NOT NULL,
  `attr_image` longtext,
  `attr_link` text,
  `attr_POI` text,
  `location_id` varchar(5) NOT NULL,
  PRIMARY KEY (`attr_id`),
  KEY `category_id` (`category_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `attraction`
--

INSERT INTO `attraction` (`attr_id`, `attr_title`, `attr_description`, `price_adult`, `price_child`, `address`, `latitude`, `longitude`, `opening_hrs`, `category_id`, `attr_image`, `attr_link`, `attr_POI`, `location_id`) VALUES
(1, 'Jurong Bird Park', 'Jurong Bird Park is a tourist attraction in Singapore managed by Wildlife Reserves Singapore. It is a landscaped park, built on the western slope of Jurong Hill. It is located within the Boon Lay Planning Area of the Jurong district and has an area of 202,000 square metres (50 acres).', 28, 18, '2 Jurong Hill Singapore 628925', 1.318100, 103.707199, 'Daily, 8.30am to 6.00pm', 'ZOO', NULL, 'http://www.birdpark.com.sg/', NULL, 'NE'),
(2, 'Night Safari', 'The Night Safari is the world''s first nocturnal zoo and is one of the most popular tourist attractions in Singapore.The Night Safari currently houses over 2,500 animals representing over 130 species, of which 38% are threatened species. The Night Safari is managed by Wildlife Reserves Singapore, and about 1.1 million visitors visit the safari per year. The Night Safari received its 11 millionth visitor on 29 May 2007.The concept of a nocturnal park in Singapore was suggested in the 1980s by the former executive chairman of the Singapore Zoo, Dr Ong Swee Law. Constructed at a cost of S$63 million, the Night Safari was officially opened on 26 May 1994 and occupies 35 hectares (86 acres) of secondary rainforest adjacent to the Singapore Zoo and Upper Seletar Reservoir.', 42, 28, '80 Mandai Lake Road Singapore 729826', 1.402300, 103.787903, 'Daily, 7.30pm to 12.00mn', 'ZOO', NULL, 'http://www.nightsafari.com.sg/', NULL, 'NE'),
(3, 'River Safari', 'The River Safari is a river-themed zoo and aquarium located in Singapore. It is built over 12 hectares (30 acres) and nestled between its two counterparts, the Singapore Zoo and the Night Safari. It is the first of its kind in Asia and features freshwater attractions and river boat rides as its main highlights. The safari was built at a cost of S$160m, with an expected visitor rate of 820,000 people yearly.The Giant Panda Forest was opened to the public on 29 November 2012, with a soft opening on 3 April 2013, attracting close to 1,500 visitors. This attraction is the fourth zoo in Singapore, along with the Singapore Zoo, Jurong Bird Park, and Night Safari, all of which are managed by Wildlife Reserves Singapore. The park was officially opened on 28 February 2014, and it was announced that more than 1.1 million have visited the River Safari since its soft opening in April 2013. ', 28, 18, '80 Mandai Lake Road Singapore 729826', 1.403800, 103.794098, 'Daily, 9.00am to 6.00pm', 'ZOO', NULL, 'http://riversafari.com.sg/', NULL, 'NE'),
(4, 'Singapore Zoo', 'The Singapore Zoo, formerly known as the Singapore Zoological Gardens and commonly known locally as the Mandai Zoo, occupies 28 hectares (69 acres) on the margins of Upper Seletar Reservoir within Singapore''s heavily forested central catchment area. The zoo was built at a cost of S$9m granted by the government of Singapore and opened on 27 June 1973. It is operated by Wildlife Reserves Singapore, who also manage the neighbouring Night Safari and the Jurong BirdPark. There are about 315 species of animal in the zoo, of which some 16 percent are considered threatened species. The zoo attracts about 1.6 million visitors each year.', 32, 21, '80 Mandai Lake Road Singapore 729826', 1.403800, 103.794098, 'Daily, 8.30am to 6.00pm', 'ZOO', NULL, 'http://www.zoo.com.sg/', NULL, 'NE'),
(5, '313@somerset', 'One-stop haven for shopaholics\r\n\r\nFast becoming one of the most popular shopping destinations in the Orchard Road belt, 313@somerset is situated right above the Somerset MRT station and boasts well-known fashion brands as well as great dining options.\r\n\r\nSpread over a sprawling eight storeys, ladies will enjoy the trendy and varied designs available at Forever 21’s flagship store, meeting the guys later at Cotton On to shop for basics, or Zara for designs from contemporary European designers. Upstairs, you’ll be spoilt for choice at Uniqlo, with its fashionable clean-cut lines and friendly service.\r\n\r\nWhen you need a break, stop for a meal upstairs at Food Republic and select from a range of local favourites, or head downstairs to Swiss eatery Marché to enjoy a superb selection of salads, homemade pastas, rostis, rotisserie chicken, traditional Swiss breads, tarts and more. With so many stores, dining spots and cafes available here, you’ll need at least a full day to explore 313@somerset.', 0, 0, '313 Orchard Road Singapore 238895', 1.299600, 103.854401, 'Sunday - Thursday: 10am - 10pm\r\nFriday & Saturday: 10am - 11pm', 'SHOP', NULL, 'www.313somerset.com.sg/', NULL, 'CEN'),
(6, 'Bugis Junction', 'Variety is the spice of life\r\n\r\nBugis Junction has a mixture of shopping options to enthral even the most seasoned of shoppers. Part traditional mall, part open-air shopping district, Bugis Junction is one of the few malls in Singapore that has sidewalk cafes and shophouses sitting alongside gleaming new retail palaces. \r\n\r\nOne signature feature of this mall is its glass-covered shopping street, a first for Singapore in its time. Some of the shops you’ll find at Bugis include department store BHG, Topshop, Converse, Kinokuniya, Cotton On, and there’s also a Shaw cinema on the fourth floor. Popular with teenagers and young adults, Bugis Junction has four levels and a basement, and is handily located right above Bugis MRT station.\r\n\r\nHere, you’ll find several cheap eateries as well as more pricey restaurants, offering a range of dining experiences to suit your budget. The five-star InterContinental Hotel is also part of the mall complex, so if you’re planning to book a room at this hotel, you might want to check out the mall’s offerings.', 0, 0, '200 Victoria St Singapore 188021', 1.299369, 103.854919, 'Daily, 10am - 10pm\r\n', 'SHOP', NULL, 'http://www.bugisjunction-mall.com.sg/', NULL, 'S'),
(7, 'Funan Digitalife Mall', 'Gadget gateway\r\n\r\nFunan Digitalife Mall is one of the best places in Singapore to go to, for all things computer and tech-related. Found in the City Hall area between Victoria Street and North Bridge Road, it positions itself as Asia’s leading IT shopping mall – with people coming from afar to have a browse through all of its specialty digital shops. \r\n\r\nA haven for techology geeks, Funan offers the newest and widest range of gadgets, from laptops and desktop computers to printers and digital cameras. One of the best things about the mall is the various deals that you’ll find here, with outlets selling value-for-money products at competitive prices. \r\n\r\nFunan also has free wireless internet, so you can test your latest purchase immediately by going online. The mall also has several restaurants and entertainment options once you’ve had your fill gadget-hunting. ', 0, 0, '109 North Bridge Rd Singapore 179097', 1.291330, 103.850075, 'Daily 10am - 10pm', 'SHOP', NULL, 'http://www.funan.com.sg/', NULL, 'CEN'),
(8, 'ION Orchard', 'Where it all comes together\r\n\r\nION Orchard brings together the world’s best-loved brands in flagship, concept and lifestyle stores. Spread over eight levels of shopping space, you can indulge in over 330 retail, F&B and lifestyle stores, which include the six duplex flagships—Cartier, Louis Vuitton, Prada, Dior, Giorgio Armani and Dolce & Gabbana. In addition to a coveted stable of brands, an extensive food hall offers visitors myriad food choices ranging from local favourites to international cuisines.\r\n\r\nTake dining to the skies\r\nLocated at an impressive height of 218 metres above ground level, ION Sky is the new focal point of the city.\r\n\r\nHome to Salt grill & Sky bar, the elegant 6,000 square feet contemporary restaurant is helmed by none other than Australian celebrity chef-restaurateur, Luke Mangan.\r\n\r\nOffering Australian cuisine with a touch of Asian flare, Salt Grill on the 55th floor is the casual version of his award-winning Salt Grill in Sydney. Besides mouthwatering cuisine, food connoisseurs will get to enjoy an unrivalled 360-degree view from the observatory, the highest point on Orchard Road.\r\n\r\nFor an extra touch of romance and glamour, head to the Sky Bar on the 56th floor for pre- or post-dinner drinks.\r\n\r\nTourist Privileges\r\nFlash your passport at the Singapore Visitors Centre at ION Orchard on L1 to redeem a Tourist Wallet featuring attractive privileges from selected brands. Enjoy an exclusive Limousine Airport Transfer when you spend $5,000 in a single receipt.', 0, 0, 'ION Orchard, 2 Orchard Turn Singapore 238801', 1.303895, 103.831940, 'Daily, 10am - 10pm', 'SHOP', NULL, 'www.ionorchard.com', NULL, 'CEN'),
(9, 'Duty Free At Singapore Changi Airport', 'Experience it all at one of the world’s finest airports\r\n\r\nIf you are a visitor coming to Singapore through Changi Airport, or transiting through the city to another destination, be sure not to miss out on all the shopping, dining and entertainment options available before you leave the airport. Having recently won the World’s Best Airport category at the 2013 World Airport Awards, Changi Airport is an all-encompassing venue with over 350 retail and service outlets located across three terminals. Shopping is made even easier, as these terminals are easily accessible via the sky train. \r\n\r\nBe it local food products, electronic gadgets, watches, beauty products, luxury brands, or mid-priced fashion, there is truly something for everyone. And whether you’re a fan of luxury fashion brands such as Hermes and Bottega Veneta, or local footwear specialist Charles & Keith, there’s bound to be a boutique to meet your needs with the best bargains to be found. Passengers departing from Singapore can also enjoy tax-free shopping at the airport without having to queue for their Goods & Services Tax (GST) refund. Customers who are not satisfied with their purchases at Changi Airport can return the product within 30 days for a full refund or exchange. Additionally, tourists can enjoy tax and duty-free shopping without having to rush and worry about missing their flight with Changi Airport’s online shopping portal (www.iShopChangi.com). Offering a good range of popular duty-free products from Changi Airport’s retail stores, tourists can purchase items from multiple retailers across different terminals online, and enjoy the convenience of collecting them at a single stop – the iShopChangi Collection Centre, which can be found in the Departure Transit Mall of each terminal.', 0, 0, '60 Airport Boulevard Singapore 819643', 1.355322, 103.988335, 'Terminal 1: 6am -12am \r\nTerminal 2 & Terminal 3: 6am - 1am\r\n(Some shops are open 24 hours)', 'SHOP', NULL, 'www.changiairport.com/shopping-and-dining/shopping', NULL, 'E'),
(10, 'Science Centre Singapore', 'The Science Centre Singapore , previously known as Singapore Science Centre is a scientific institution in Jurong East, Singapore, specialising in the promotion of scientific and technological education for the general public. With over 850 exhibits spread over eight exhibition galleries, it sees over a million visitors a year today, and over 17 million visitors up to the year 2003 when it celebrated its silver jubilee.', 12, 8, '15 Science Centre Rd Singapore 609081', 1.333194, 103.736130, '', 'EDU', NULL, 'http://www.science.edu.sg/', 'Omni-Theatre\r\nKidsSTOP\r\nSnow City', 'W');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` varchar(5) NOT NULL,
  `category_title` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_title`) VALUES
('EDU', 'Educational'),
('ENT', 'Entertainment'),
('HIL', 'Hill'),
('MUS', 'Museum'),
('SHOP', 'Shopping Center'),
('ZOO', 'Zoo');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_id` int(11) NOT NULL,
  `comment_text` longtext NOT NULL,
  `rating` tinyint(4) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `location_id` varchar(5) NOT NULL,
  `location_title` varchar(30) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_title`) VALUES
('CEN', 'Central'),
('E', 'East'),
('N', 'North'),
('NE', 'North East'),
('NW', 'North West'),
('S', 'South'),
('SE', 'South East'),
('SW', 'South West'),
('W', 'West');

-- --------------------------------------------------------

--
-- Table structure for table `tripplanner`
--

CREATE TABLE IF NOT EXISTS `tripplanner` (
  `planner_id` int(11) NOT NULL AUTO_INCREMENT,
  `num_of_adult` int(11) NOT NULL,
  `num_of_child` int(11) NOT NULL,
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `attr_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`planner_id`),
  KEY `user_id` (`user_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `emailAddress` tinytext NOT NULL,
  `password` varchar(20) NOT NULL,
  `date` varchar(10) NOT NULL,
  `image` longtext,
  `gender` varchar(6) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attraction`
--
ALTER TABLE `attraction`
  ADD CONSTRAINT `attraction_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attraction_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userinfo` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tripplanner`
--
ALTER TABLE `tripplanner`
  ADD CONSTRAINT `tripplanner_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userinfo` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tripplanner_ibfk_2` FOREIGN KEY (`attr_id`) REFERENCES `attraction` (`attr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
