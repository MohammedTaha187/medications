-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2025 at 02:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `response` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `rating` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `image`, `details`, `created_at`) VALUES
(1, 'Omega-3 Capsules', 250, 'Supplements', 'Supplements/1.jpeg', 'مكمل غذائي لدعم صحة القلب', '2025-02-23 12:44:59'),
(2, 'Whey Protein', 500, 'Supplements', 'Supplements/2.jpeg', 'بروتين لبناء العضلات', '2025-02-23 12:44:59'),
(3, 'Vitamin D3', 150, 'Supplements', 'Supplements/3.jpeg', 'مكمل لتعزيز صحة العظام', '2025-02-23 12:44:59'),
(4, 'BCAA Powder', 400, 'Supplements', 'Supplements/4.jpeg', 'مكمل لتحسين الاستشفاء العضلي', '2025-02-23 12:44:59'),
(5, 'Collagen Peptides', 300, 'Supplements', 'Supplements/5.jpeg', 'مكمل لتحسين صحة الجلد والمفاصل', '2025-02-23 12:44:59'),
(6, 'Iron Tablets', 100, 'Supplements', 'Supplements/6.jpeg', 'مكمل لعلاج نقص الحديد', '2025-02-23 12:44:59'),
(7, 'Sunscreen SPF 50', 200, 'Skincare', 'Skincare/1.jpeg', 'واقي شمس لحماية البشرة من الأشعة الضارة', '2025-02-23 12:44:59'),
(8, 'Hyaluronic Acid Serum', 180, 'Skincare', 'Skincare/2.jpeg', 'سيروم لترطيب البشرة العميق', '2025-02-23 12:44:59'),
(9, 'Vitamin C Cream', 220, 'Skincare', 'Skincare/3.jpeg', 'كريم لتفتيح البشرة وتقليل التصبغات', '2025-02-23 12:44:59'),
(10, 'Retinol Night Cream', 250, 'Skincare', 'Skincare/4.jpeg', 'كريم ليلي لمحاربة التجاعيد', '2025-02-23 12:44:59'),
(11, 'Aloe Vera Gel', 120, 'Skincare', 'Skincare/5.jpeg', 'جل الألوفيرا لتهدئة البشرة', '2025-02-23 12:44:59'),
(12, 'Facial Cleanser', 160, 'Skincare', 'Skincare/6.jpeg', 'غسول للوجه ينظف البشرة بعمق', '2025-02-23 12:44:59'),
(13, 'Blood Pressure Monitor', 700, 'Medical Equipment', 'Medical Equipment/1.jpeg', 'جهاز قياس ضغط الدم عالي الدقة', '2025-02-23 12:44:59'),
(14, 'Digital Thermometer', 150, 'Medical Equipment', 'Medical Equipment/2.jpeg', 'ترمومتر رقمي لقياس الحرارة', '2025-02-23 12:44:59'),
(15, 'Nebulizer Machine', 850, 'Medical Equipment', 'Medical Equipment/3.jpeg', 'جهاز استنشاق لعلاج مشاكل التنفس', '2025-02-23 12:44:59'),
(16, 'Pulse Oximeter', 300, 'Medical Equipment', 'Medical Equipment/4.jpeg', 'جهاز قياس نسبة الأكسجين في الدم', '2025-02-23 12:44:59'),
(17, 'Glucometer', 400, 'Medical Equipment', 'Medical Equipment/5.jpeg', 'جهاز قياس السكر في الدم', '2025-02-23 12:44:59'),
(18, 'Electric Massager', 500, 'Medical Equipment', 'Medical Equipment/6.jpeg', 'مساج كهربائي لتخفيف آلام العضلات', '2025-02-23 12:44:59'),
(19, 'Vitamin B12', 180, 'Vitamins', 'Vitamins/1.jpeg', 'مكمل لتحسين صحة الأعصاب', '2025-02-23 12:44:59'),
(20, 'Multivitamin Capsules', 250, 'Vitamins', 'Vitamins/2.jpeg', 'فيتامينات متعددة لدعم الصحة العامة', '2025-02-23 12:44:59'),
(21, 'Calcium + Magnesium', 200, 'Vitamins', 'Vitamins/3.jpeg', 'مكمل لتحسين صحة العظام والأسنان', '2025-02-23 12:44:59'),
(22, 'Zinc Tablets', 120, 'Vitamins', 'Vitamins/4.jpeg', 'مكمل لتعزيز المناعة وصحة البشرة', '2025-02-23 12:44:59'),
(23, 'Fish Oil', 300, 'Vitamins', 'Vitamins/5.jpeg', 'مكمل لدعم صحة القلب والمخ', '2025-02-23 12:44:59'),
(24, 'Vitamin E Softgels', 150, 'Vitamins', 'Vitamins/6.jpeg', 'مكمل لحماية خلايا الجسم من الأكسدة', '2025-02-23 12:44:59'),
(25, 'Shampoo for Hair Fall', 180, 'Personal Care', 'Personal Care/1.jpeg', 'شامبو لعلاج تساقط الشعر', '2025-02-23 12:44:59'),
(26, 'Herbal Toothpaste', 90, 'Personal Care', 'Personal Care/2.jpeg', 'معجون أسنان بالأعشاب للحماية من التسوس', '2025-02-23 12:44:59'),
(27, 'Moisturizing Body Lotion', 200, 'Personal Care', 'Personal Care/3.jpeg', 'لوشن مرطب للجسم بتركيبة مغذية', '2025-02-23 12:44:59'),
(28, 'Deodorant Roll-On', 150, 'Personal Care', 'Personal Care/4.jpeg', 'مزيل عرق برائحة منعشة تدوم طويلاً', '2025-02-23 12:44:59'),
(29, 'Hand Sanitizer', 80, 'Personal Care', 'Personal Care/5.jpeg', 'معقم يدين سريع الجفاف', '2025-02-23 12:44:59'),
(30, 'Beard Oil', 170, 'Personal Care', 'Personal Care/6.jpeg', 'زيت للعناية باللحية وترطيبها', '2025-02-23 12:44:59'),
(31, 'Pain Relief Balm', 140, 'Health Medicine', 'Health Medicine/1.jpeg', 'مرهم مسكن للألم والشد العضلي', '2025-02-23 12:44:59'),
(32, 'Antacid Tablets', 90, 'Health Medicine', 'Health Medicine/2.jpeg', 'أقراص لعلاج الحموضة والارتجاع', '2025-02-23 12:44:59'),
(33, 'Cough Syrup', 120, 'Health Medicine', 'Health Medicine/3.jpeg', 'شراب للسعال وتهدئة الحلق', '2025-02-23 12:44:59'),
(34, 'Allergy Relief Tablets', 160, 'Health Medicine', 'Health Medicine/4.jpeg', 'أقراص لتخفيف الحساسية الموسمية', '2025-02-23 12:44:59'),
(35, 'Cold & Flu Capsules', 180, 'Health Medicine', 'Health Medicine/5.jpeg', 'كبسولات لعلاج نزلات البرد والإنفلونزا', '2025-02-23 12:44:59'),
(36, 'Digestive Enzymes', 200, 'Health Medicine', 'Health Medicine/6.jpeg', 'مكمل لتحسين عملية الهضم', '2025-02-23 12:44:59'),
(37, 'Baby Shampoo', 120, 'Baby Care', 'Baby Care/1.jpeg', 'شامبو لطيف للأطفال بدون دموع', '2025-02-23 12:44:59'),
(38, 'Baby Lotion', 150, 'Baby Care', 'Baby Care/2.jpeg', 'لوشن مرطب لبشرة الأطفال الحساسة', '2025-02-23 12:44:59'),
(39, 'Diaper Rash Cream', 180, 'Baby Care', 'Baby Care/3.jpeg', 'كريم لعلاج تسلخات الحفاضات', '2025-02-23 12:44:59'),
(40, 'Baby Wipes', 90, 'Baby Care', 'Baby Care/4.jpeg', 'مناديل مبللة للأطفال خالية من العطور', '2025-02-23 12:44:59'),
(41, 'Infant Formula Milk', 300, 'Baby Care', 'Baby Care/5.jpeg', 'حليب صناعي للأطفال حديثي الولادة', '2025-02-23 12:44:59'),
(42, 'Teething Gel', 130, 'Baby Care', 'Baby Care/6.jpeg', 'جل لتخفيف آلام التسنين عند الأطفال', '2025-02-23 12:44:59'),
(43, 'Paracetamol Tablets', 90, 'Medications', 'Medications/1.jpeg', 'أقراص مسكنة للآلام وخافضة للحرارة', '2025-02-23 12:44:59'),
(44, 'Ibuprofen 400mg', 120, 'Medications', 'Medications/2.jpeg', 'مسكن للآلام ومضاد للالتهابات', '2025-02-23 12:44:59'),
(45, 'Antibiotic Syrup', 180, 'Medications', 'Medications/3.jpeg', 'شراب مضاد حيوي لعلاج العدوى البكتيرية', '2025-02-23 12:44:59'),
(46, 'Blood Pressure Pills', 250, 'Medications', 'Medications/4.jpeg', 'أدوية للتحكم في ضغط الدم المرتفع', '2025-02-23 12:44:59'),
(47, 'Diabetes Control Tablets', 220, 'Medications', 'Medications/5.jpeg', 'أقراص لتنظيم مستوى السكر في الدم', '2025-02-23 12:44:59'),
(48, 'Sleeping Aid Capsules', 200, 'Medications', 'Medications/6.jpeg', 'كبسولات للمساعدة في تحسين النوم', '2025-02-23 12:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` enum('user','admin') NOT NULL DEFAULT 'user',
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
