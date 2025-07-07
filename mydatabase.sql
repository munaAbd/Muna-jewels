-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: mysql
-- Tid vid skapande: 07 jul 2025 kl 11:22
-- Serverversion: 8.0.42
-- PHP-version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `mydatabase`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `postal_code` varchar(10) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumpning av Data i tabell `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `phone`, `address`, `postal_code`, `city`, `email`) VALUES
(1, 'muna', 'Abdi', '1237781234', 'von Rosens väg 27', '213 66', 'Malmö', 'xurmo45@gmail.com');

-- --------------------------------------------------------

--
-- Tabellstruktur `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Ordered','Packed','Shipped','Paid') DEFAULT 'Ordered',
  `total_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`) VALUES
(1, 'Guldhalsband', 'Elegant halsband i 18K guld med ädelstenar.', 1499.00, 'https://media.istockphoto.com/id/1283536896/photo/necklace-on-pink-silk.webp?a=1&b=1&s=612x61\r\n2&w=0&k=20&c=Vo1DLRWdsLlKjnZBbzTW5ot61K6PCkyESetionZkdaY='),
(2, 'Silverarmband', 'Enkelt och stilrent armband i silver.', 799.00, 'https://media.istockphoto.com/id/1066167570/sv/foto/silver-armband-dekoration-med-glas-p%C3%A4\r\nrlor-och-diamanter-som-isolerad-p%C3%A5-vit-bakgrund.jpg?s=1024x1024&w=is&k=20&c=RpT-WD\r\nYFuBpqdTeYOWsT3AwMm6z8CUqpghIvFlZMfuw='),
(3, 'Pärlörhängen', 'Vackra örhängen med vita sötvattenspärlor.', 399.00, 'https://media.istockphoto.com/id/1293472971/photo/earrings-in-a-box.webp?a=1&b=1&s=612x612&\r\nw=0&k=20&c=YG-9qCGmqiY-RcHsRPXa_2fzIFgmsFlSOl-_qh3TxCA='),
(4, 'Diamantring', 'Lyxig ring med briljantslipad diamant.', 4999.00, 'https://images.unsplash.com/photo-1673385890456-c50405156d19?w=800&auto=format&fit=crop&q\r\n=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8ZGlhbWFudHJpbmd8ZW58MHx8MHx\r\n8fDA%3D'),
(5, 'Rubinhänge', 'Smycke med rubin i droppform.', 1299.00, 'https://media.istockphoto.com/id/1269846041/photo/precious-stone-jewellery.webp?a=1&b=1&s=612\r\nx612&w=0&k=20&c=jzXmmgAar6fdTOy6kdIHwnbXh_HqZMsE5xcSpgBqTIY=');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Index för tabell `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Restriktioner för tabell `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
