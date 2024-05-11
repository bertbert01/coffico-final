-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2024 at 01:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffico`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `username`, `user_id`, `product_id`, `quantity`) VALUES
(63, 'michaelbagacina', 4, 11, 1),
(64, 'michaelbagacina', 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `category` tinyint(1) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `description`, `image`) VALUES
(1, 'Mocha', 99, 1, 'Indulge in the perfect blend of rich espresso and creamy chocolate with our irresistible mocha. Satisfy your cravings and elevate your day with every sip of our decadent, handcrafted creation.', 'images/mocha.jpg'),
(2, 'Ristretto', 99, 1, 'Experience the intense and bold flavor of our ristretto, crafted with precision to deliver a concentrated burst of espresso goodness. Treat yourself to a short but powerful coffee experience that will awaken your senses and leave you craving for more.', 'images/ristretto.jpg'),
(3, 'Cortado', 99, 1, 'Savor the smooth harmony of espresso and velvety milk infused with the sweet indulgence of caramel in our signature caramel latte. Delight your taste buds with every sip of this luxurious blend, perfect for moments of indulgence and relaxation.', 'images/espresso.jpg'),
(4, 'Red Eye', 99, 1, 'Energize your day with our invigorating Red Eye coffee—a bold and robust brew combined with a shot of espresso for an extra kick. Whether you need a morning pick-me-up or a midday boost, our Red Eye will keep you fueled and focused, ready to conquer whate', 'images/red.jpg'),
(5, 'Affogato', 99, 1, 'Treat yourself to the ultimate indulgence with our exquisite affogato—a delightful fusion of rich espresso poured over a scoop of creamy vanilla gelato. Experience the perfect marriage of hot and cold, bitter and sweet, in every spoonful of this decadent ', 'images/affogato.jpg'),
(6, 'Macchiato', 99, 1, 'Experience the best of both worlds with our tantalizing mocha latte—a harmonious blend of bold espresso, velvety milk, and rich chocolate. Indulge in the perfect balance of sweetness and depth, crafted to delight your senses and elevate your coffee experi', 'images/macchiato.jpg'),
(7, 'Vanilla', 110, 2, 'Satisfy your sweet cravings with our creamy vanilla latte—a luxurious blend of smooth espresso, frothy milk, and fragrant vanilla syrup. Treat yourself to a moment of pure indulgence as you savor the comforting warmth and irresistible sweetness of this cl', 'images/vann.jpg'),
(8, 'Caramel', 110, 2, 'Indulge in the decadent sweetness of our caramel latte—a luxurious fusion of rich espresso, creamy milk, and velvety caramel syrup. Elevate your coffee break with the perfect balance of bold flavors and indulgent sweetness, crafted to delight your senses ', 'images/cara.jpg'),
(9, 'Hazelnut', 110, 2, 'Embark on a journey of rich flavors with our hazelnut latte—a delightful blend of robust espresso, creamy milk, and nutty hazelnut syrup. Experience the warm embrace of this comforting beverage, crafted to add a touch of sweetness and sophistication to yo', 'images/haze.jpg'),
(10, 'Chocolate', 110, 2, 'Indulge in the decadent richness of our chocolate latte—a heavenly fusion of bold espresso and velvety milk infused with creamy chocolate syrup. Treat yourself to a moment of pure bliss as you savor the irresistible combination of espressos boldness and c', 'images/chocolate.jpg'),
(11, 'Iced Cappuccino', 110, 2, 'Stay refreshed and invigorated with our delightful iced cappuccino—a frosty blend of bold espresso, creamy milk, and frothy foam, perfectly chilled for a refreshing twist on a classic favorite. Experience the perfect balance of indulgence and refreshment ', 'images/icedca.jpg'),
(12, 'Decaf Cappuccino', 110, 2, 'Experience the cozy indulgence of our decaf cappuccino—a comforting blend of smooth espresso, creamy milk, and frothy foam, crafted to deliver all the rich flavor and warmth without the caffeine. Treat yourself to a moment of relaxation and enjoy the velv', 'images/decaf.jpg'),
(13, 'Caramel Latte', 105, 3, 'Indulge in the irresistible sweetness of our caramel latte—a decadent blend of rich espresso, creamy milk, and velvety caramel syrup, perfectly crafted to satisfy your sweet cravings and elevate your coffee experience. Treat yourself to a moment of pure i', 'images/caramel.jpg'),
(14, 'Pumpkin Spice Latte', 105, 3, 'Savor the cozy flavors of fall with our pumpkin spice latte—a delicious blend of espresso, steamed milk, and aromatic pumpkin spice syrup, topped with a swirl of whipped cream and a sprinkle of cinnamon. Experience the perfect balance of warmth and sweetn', 'images/pumpkin.jpg'),
(15, 'Cinnamon Latte', 105, 3, 'Warm up your day with our comforting cinnamon latte—a delightful blend of bold espresso, creamy milk, and a touch of aromatic cinnamon syrup. Experience the cozy embrace of this sweet and spicy combination, perfect for adding a touch of warmth and indulge', 'images/cinnamon.jpg'),
(16, 'Mocha Latte', 105, 3, 'Indulge in the luxurious harmony of rich espresso, creamy milk, and decadent chocolate with our irresistible mocha latte. Satisfy your sweet cravings and elevate your coffee experience with every velvety sip of this deliciously indulgent beverage.', 'images/moch.jpg'),
(17, 'Hazelnut Latte', 105, 3, 'Savor the delightful fusion of bold espresso, creamy milk, and nutty hazelnut syrup in our irresistible hazelnut latte. Experience the perfect balance of richness and sweetness, crafted to indulge your senses and elevate your coffee ritual to new heights.', 'images/hazelnut.jpg'),
(18, 'Vanilla Latte', 105, 3, 'Experience the creamy indulgence of our vanilla latte—a harmonious blend of bold espresso, silky milk, and fragrant vanilla syrup. Satisfy your sweet cravings and delight your senses with every luxurious sip of this classic favorite.', 'images/vanilla.jpg'),
(19, 'Traditional Americano', 120, 4, 'Enjoy the timeless simplicity of our traditional Americano—a rich and robust espresso, diluted with hot water to create a smooth yet bold coffee experience. Embrace the pure essence of espresso with this classic favorite, perfect for those who appreciate ', 'images/traditional.jpg'),
(20, 'Iced Americano', 120, 4, 'Stay refreshed with our invigorating iced Americano—a crisp and smooth blend of bold espresso and chilled water, served over ice for a refreshing pick-me-up. Experience the pure essence of coffee in every cool and revitalizing sip, perfect for hot summer ', 'images/iceam.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `age` int(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `age`, `password`) VALUES
(1, 'Jobert', 'Niebres', 'bert', 20, 'jobertniebres18'),
(2, 'Ezi', 'dela Cruz', 'ezi', 19, 'ezi01'),
(3, 'mj', 'bagacina', 'emjiii', 20, 'mj'),
(4, 'michael', 'bagacina', 'michaelbagacina', 20, 'michaelbagacina');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
