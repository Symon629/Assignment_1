-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 17, 2023 at 12:34 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uts_assignment1`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Frozen-Food'),
(2, 'Fresh Food'),
(3, 'Beverages'),
(4, 'Home Health');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `unit_price` float NOT NULL,
  `unit_quantity` varchar(255) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `unit_price`, `unit_quantity`, `in_stock`, `subcategory_id`, `description`, `image`, `category_id`) VALUES
(1110, 'Frozen Fish ', 110, '400gm', 10, 1, 'The best frozen fish in the market. Japanese sliced Basa.', 'FrozenFish.jpg', 1),
(1111, 'Frozen Meat', 112, '500gm', 5, 2, 'Frozen Meat Chunks', 'FrozenMeat.jpg', 1),
(1112, 'Brocolli', 14, '120gm', 10, 1, 'Broccoli is a nutrient-rich vegetable that may enhance your health in a variety of ways, such as by reducing inflammation, improving blood sugar control, boosting immunity and promoting heart health', 'brocolli.jpg', 2),
(1113, 'cabbage', 14, '12gm', 12, 1, 'Cabbage, especially red cabbage, seems to raise levels of beta-carotene, lutein, and other heart-protective antioxidants. It also helps lower something called “oxidized” LDL, which is linked to hardening of the arteries', 'cabbage.jpg', 2),
(1114, 'Whole Chicken', 10, '100gm', 12, 2, 'Whole chicken......', 'chicken.jpg', 2),
(1115, 'Banana', 12, 'Each 4gm ', 12, 3, 'Fresh bananas from Queensland', 'banana.jpg', 2),
(1116, 'Avocado', 14, '10gm', 12, 3, 'Avocados are high in fat with 60 per cent of this being monounsaturated fats, which research suggests helps to protect against heart disease and lower blood pressure', 'avocado.jpg', 2),
(1117, 'Coca Cola', 14, '1/2 Litre', 12, 0, 'The primary taste of Coca-Cola is thought to come from vanilla and cinnamon, with trace amounts of essential oils, and spices such as nutmeg.\r\n', 'coke.jpg', 3),
(1118, 'Mountain Dew', 10, '1Litre', 10, 0, '...............', 'dew.jpg', 3),
(1119, 'Health Supplement', 12, '12 Tablets', 10, 0, 'Some common examples of supplements include vitamins and minerals (such as vitamin C, iron and calcium), oil supplements (such as fish oil capsules) and herbal ingredients', 'supp_1.jpg', 4),
(1120, 'My Brain', 20, '30 Tablets', 14, 0, 'Our products support communication and balance across key interconnected bodily systems vital to brain health, and strengthen physiological pathways essential to cognitive function.', 'mybrain.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcategory_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcategory_id`, `name`, `category_id`) VALUES
(1, 'Frozen Fish', 1),
(2, 'Frozen Meat', 1),
(3, 'Fruits', 2),
(2, 'Meat & Fish', 2),
(1, 'Vegetables', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
