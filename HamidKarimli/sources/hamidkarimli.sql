-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Tem 2023, 22:28:29
-- Sunucu sürümü: 10.4.24-MariaDB
-- PHP Sürümü: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `hamidkarimli`
--

DELIMITER $$
--
-- Yordamlar
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteProduct` (IN `productId` INT)   BEGIN
    DELETE FROM products WHERE id = productId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteSale` (IN `saleId` INT)   BEGIN
    DELETE FROM sales WHERE id = saleId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteUser` (IN `userId` INT)   BEGIN
    DELETE FROM users WHERE id = userId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAdminByUsername` (IN `adminUsername` VARCHAR(255))   BEGIN
    SELECT * FROM admins WHERE username = adminUsername;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllProducts` ()   BEGIN
    SELECT * FROM products ORDER by id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllProductsInStock` ()   BEGIN
    SELECT * FROM products WHERE quantity > 0 ORDER BY id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllSales` ()   BEGIN
    SELECT * FROM sales ORDER BY id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllUsers` ()   BEGIN
		SELECT * FROM users ORDER BY id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrdersOfUser` (IN `userId` INT)   BEGIN
    SELECT product_id, price, quantity, created_date FROM sales WHERE user_id = userId ORDER BY id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductById` (IN `productId` VARCHAR(255))   BEGIN
    SELECT * FROM products WHERE id = productId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserByEmail` (IN `userEmail` VARCHAR(255))   BEGIN
    SELECT * FROM users WHERE email = userEmail;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserById` (IN `userId` VARCHAR(255))   BEGIN
    SELECT * FROM users WHERE id = userId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserWithoutPasswordByID` (IN `userId` INT)   BEGIN
    SELECT id, name, surname, phone, email, created_date FROM users WHERE id = userId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertProduct` (IN `productName` VARCHAR(255), IN `productPrice` INT, IN `productQuantity` INT, IN `productPhoto` TEXT)   BEGIN
    INSERT INTO products (name, price, quantity, photo) VALUES (productName, productPrice, productQuantity, productPhoto);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertSale` (IN `userId` INT, IN `productId` INT, IN `salePrice` INT, IN `saleQuantity` INT, IN `paymentMethod` VARCHAR(75), IN `userCity` VARCHAR(75), IN `userDistrict` VARCHAR(75), IN `userAddress` TEXT)   BEGIN
    INSERT INTO sales (user_id, product_id, price, quantity, payment_method, city, district, address)
    VALUES (userId, productId, salePrice, saleQuantity, paymentMethod, userCity, userDistrict, userAddress);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertUser` (IN `userName` VARCHAR(255), IN `userSurname` VARCHAR(255), IN `userPhone` VARCHAR(255), IN `userEmail` VARCHAR(255), IN `userPassword` VARCHAR(255))   BEGIN
    INSERT INTO users (name, surname, phone, email, password) VALUES (userName, userSurname, userPhone, userEmail, userPassword);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePassword` (IN `userId` INT, IN `newPassword` VARCHAR(255))   BEGIN
    UPDATE users SET password = newPassword WHERE id = userId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateProduct` (IN `productId` INT, IN `productName` VARCHAR(255), IN `productPrice` INT, IN `productQuantity` INT, IN `productPhoto` TEXT)   BEGIN
    UPDATE products SET name = productName, price = productPrice, quantity = productQuantity, photo = productPhoto WHERE id = productId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateProfile` (IN `userId` INT, IN `newName` VARCHAR(255), IN `newSurname` VARCHAR(255), IN `newPhone` VARCHAR(255), IN `newEmail` VARCHAR(255))   BEGIN
    UPDATE users SET name = newName, surname = newSurname, phone = newPhone, email = newEmail WHERE id = userId;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `photo` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `quantity`, `photo`, `created_date`) VALUES
(3, 'Nike Air Max 1', 250, 25, 'product1.jpeg', '2023-07-06 19:53:31'),
(4, 'Nike Air Max 2', 120, 29, 'product3.jpeg', '2023-07-06 19:53:47'),
(5, 'Nike Air Max 3', 100, 0, 'product4.jpeg', '2023-07-06 19:53:58'),
(6, 'Nike Air Max 4', 50, 2, 'product2.jpeg', '2023-07-06 19:54:15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_method` varchar(75) NOT NULL,
  `city` varchar(150) NOT NULL,
  `district` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `product_id`, `price`, `quantity`, `payment_method`, `city`, `district`, `address`, `created_date`) VALUES
(8, 2, 4, 120, 1, 'Kredi Kartı', 'BİLECİK', 'MERKEZ', 'asdasdsad', '2023-07-06 20:09:53'),
(17, 2, 5, 100, 1, 'Nakit', 'AĞRI', 'DOĞUBAYAZIT', 'Full açık adres, uzun adres, türkçe harfler, açık uzun adres', '2023-07-06 20:25:50');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `surname` varchar(150) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `phone`, `email`, `password`, `created_date`) VALUES
(2, 'Hamid', 'Karimli', '555-555-55-55', 'hamid@mail.com', '123123', '2023-07-06 12:15:32');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
