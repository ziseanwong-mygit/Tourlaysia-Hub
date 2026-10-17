-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 05:53 PM
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
-- Database: `tourlaysiadb`
--
CREATE DATABASE IF NOT EXISTS `tourlaysiadb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tourlaysiadb`;

-- --------------------------------------------------------

--
-- Table structure for table `atd_mbr_rec_t`
--

CREATE TABLE `atd_mbr_rec_t` (
  `atd_rec_ID` varchar(15) NOT NULL,
  `atd_ID` varchar(14) NOT NULL,
  `mbr_ls_ID` varchar(15) NOT NULL,
  `mbr_doc_ID` varchar(20) NOT NULL,
  `mbr_name` varchar(50) NOT NULL,
  `atd_status` varchar(7) DEFAULT NULL,
  `atd_remark` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `atd_mbr_rec_t`
--

INSERT INTO `atd_mbr_rec_t` (`atd_rec_ID`, `atd_ID`, `mbr_ls_ID`, `mbr_doc_ID`, `mbr_name`, `atd_status`, `atd_remark`) VALUES
('ATRC_nrtf62i9a6', 'ATD_BlitniVeeH', 'BMBR_BC34oP5q6R', 'A567890123', 'Dr. Ethan Mack', 'Present', NULL),
('ATRC_qv8u9D4opB', 'ATD_BlitniVeeH', 'BMBR_BC90kL1m2N', '820420-15-7890', 'Dr. Sarah Mack', 'Absent', 'Medical Leave / Sick'),
('ATRC_rpoRb87bh3', 'ATD_KYjzEEb02j', 'BMBR_BC34oP5q6R', 'A567890123', 'Dr. Ethan Mack', 'Absent', 'Tour Cancellation'),
('ATRC_rucLDb4La5', 'ATD_KYjzEEb02j', 'BMBR_BC56gH7i8J', '810319-41-3658', 'Dr. Corey Mack MD', 'Present', NULL),
('ATRC_XlMFkU5Qa0', 'ATD_KYjzEEb02j', 'BMBR_BC90kL1m2N', '820420-15-7890', 'Dr. Sarah Mack', 'Absent', 'Personal Reasons'),
('ATRC_ZacAjEvLT4', 'ATD_BlitniVeeH', 'BMBR_BC56gH7i8J', '810319-41-3658', 'Dr. Corey Mack MD', 'Present', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `atd_rec_t`
--

CREATE TABLE `atd_rec_t` (
  `atd_ID` varchar(14) NOT NULL,
  `atd_date` date NOT NULL,
  `bkn_ID` varchar(14) NOT NULL,
  `atd_title` varchar(50) NOT NULL,
  `atd_desc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `atd_rec_t`
--

INSERT INTO `atd_rec_t` (`atd_ID`, `atd_date`, `bkn_ID`, `atd_title`, `atd_desc`) VALUES
('ATD_BlitniVeeH', '2025-07-15', 'BKN_a2Bb3Cc4Dd', 'Attendance 15/7/2025', 'This is during the counting at Batu Caves.'),
('ATD_KYjzEEb02j', '2025-07-15', 'BKN_a2Bb3Cc4Dd', 'Attendance Test2', 'Desc');

-- --------------------------------------------------------

--
-- Table structure for table `bill_item_list_t`
--

CREATE TABLE `bill_item_list_t` (
  `bil_item_ID` varchar(15) NOT NULL,
  `bil_ID` varchar(14) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_desc` varchar(500) DEFAULT NULL,
  `item_qty` int(3) NOT NULL,
  `item_pri` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_item_list_t`
--

INSERT INTO `bill_item_list_t` (`bil_item_ID`, `bil_ID`, `item_name`, `item_desc`, `item_qty`, `item_pri`) VALUES
('BITM_0000000001', 'BIL_0000000001', 'Kinabalu Package', 'Your kinabalu package', 1, 95.00),
('BITM_0000000002', 'BIL_0000000001', 'Tickets', 'Tickets to the show.', 1, 5.00),
('BITM_beD4YNGsYz', 'BIL_5L17UuhCF3', 'KL Package', 'This price is fixed.', 1, 100.00),
('BITM_DW2eoBglmg', 'BIL_5L17UuhCF3', 'Tickets to KLCC', 'These are tickets that are pre-booked.', 3, 15.00),
('BITM_RfvUKCqCwF', 'BIL_5L17UuhCF3', 'Extra charge on hotel', 'This is extra charge for hotel', 1, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `bill_rec_t`
--

CREATE TABLE `bill_rec_t` (
  `bil_ID` varchar(14) NOT NULL,
  `usr_ID` varchar(14) NOT NULL,
  `usr_name` varchar(50) NOT NULL,
  `usr_email` varchar(50) NOT NULL,
  `sbt_amount` decimal(10,2) NOT NULL,
  `svc_charge` decimal(10,2) NOT NULL,
  `add_charge` decimal(10,2) DEFAULT NULL,
  `tot_amount` decimal(10,2) NOT NULL,
  `stf_ID` varchar(14) NOT NULL,
  `stf_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_rec_t`
--

INSERT INTO `bill_rec_t` (`bil_ID`, `usr_ID`, `usr_name`, `usr_email`, `sbt_amount`, `svc_charge`, `add_charge`, `tot_amount`, `stf_ID`, `stf_name`) VALUES
('BIL_0000000001', 'TOR_JGgZstigpL', 'Monique Dixon', 'moniquedixon@gmail.com', 100.00, 1.00, 2.00, 103.00, 'STF_AbCdEfGhIj', 'Mohd Ali bin Abu'),
('BIL_5L17UuhCF3', 'TOR_8304218839', 'Seath Tan Ziren', 'seath123@gmail.com', 270.00, 5.00, 2.48, 277.48, 'STF_K1L2M3N4O5', 'Tan Wei Chen'),
('BIL_ovrTB0nGW9', 'TOR_JGgZstigpL', 'Monique Dixon', 'moniquedixon@gmail.com', 120.00, 2.00, 2.00, 124.00, 'STF_AbCdEfGhIj', 'Mohd Ali bin Abu');

-- --------------------------------------------------------

--
-- Table structure for table `blog_t`
--

CREATE TABLE `blog_t` (
  `blg_ID` varchar(14) NOT NULL,
  `blg_date_create` date NOT NULL,
  `blg_date_edit` date NOT NULL,
  `blg_title` varchar(50) NOT NULL,
  `blg_desc` varchar(100) DEFAULT NULL,
  `blg_cont` longtext NOT NULL,
  `blg_author` varchar(100) NOT NULL,
  `blg_img` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_t`
--

INSERT INTO `blog_t` (`blg_ID`, `blg_date_create`, `blg_date_edit`, `blg_title`, `blg_desc`, `blg_cont`, `blg_author`, `blg_img`) VALUES
('BLG_aX3p9K7m2N', '2025-07-14', '2025-07-14', 'Top 20 Must-Visit Places in Malaysia', 'Your ultimate Malaysia bucket list', '1. Petronas Twin Towers, KL - Iconic skyscrapers with stunning skybridge views\r\n2. Langkawi - Beautiful archipelago with cable car adventures\r\n3. George Town, Penang - UNESCO site with amazing street art and food\r\n4. Malacca - Historic city with Dutch and Portuguese influences\r\n5. Borneo Rainforest - One of the oldest rainforests on Earth\r\n6. Cameron Highlands - Tea plantations and cool climate\r\n7. Perhentian Islands - Pristine beaches and great snorkeling\r\n8. Taman Negara - Ancient rainforest with canopy walks\r\n9. Batu Caves - Spectacular Hindu temple in limestone caves\r\n10. Kinabalu Park - Home to Southeast Asia\'s highest peak\r\n11. Redang Island - Crystal clear waters and marine life\r\n12. Kuching - Charming city with cat statues and museums\r\n13. Tioman Island - Duty-free island paradise\r\n14. Putrajaya - Modern administrative city with impressive architecture\r\n15. Genting Highlands - Cool mountain resort with casinos\r\n16. Johor Bahru - Legoland and Hello Kitty Town for families\r\n17. Ipoh - Colonial charm and famous white coffee\r\n18. Kota Kinabalu - Gateway to Sabah\'s natural wonders\r\n19. Pulau Pangkor - Relaxed island getaway\r\n20. Fraser\'s Hill - Charming British-style hill station', 'TravelMaster', 'https://images.unsplash.com/photo-1527631746610-bca00abb040a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_bY4q8L3n1O', '2025-07-14', '2025-07-14', '10 Malaysian Foods You Must Try Before You Die', 'Delicious culinary adventures await!', '1. Nasi Lemak - The national dish with coconut rice and sambal\r\n2. Char Kway Teow - Stir-fried flat rice noodles with prawns\r\n3. Satay - Grilled meat skewers with peanut sauce\r\n4. Laksa - Spicy noodle soup with coconut milk\r\n5. Roti Canai - Flaky flatbread with curry dipping sauce\r\n6. Hainanese Chicken Rice - Tender poached chicken with fragrant rice\r\n7. Bak Kut Teh - Herbal pork rib soup\r\n8. Cendol - Iced sweet dessert with coconut milk\r\n9. Durian - The infamous \"King of Fruits\"\r\n10. Teh Tarik - \"Pulled\" milk tea with frothy top', 'FoodieExplorer', 'https://images.unsplash.com/photo-1559847844-5315695dadae?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_cZ5r9M4o2P', '2025-07-14', '2025-07-14', '7 Hidden Gems in Kuala Lumpur Most Tourists Miss', 'Go beyond the usual tourist spots', '1. KL Forest Eco Park - Rainforest in the city center\r\n2. Royal Selangor Visitor Centre - Pewter factory with fun workshops\r\n3. The LINC KL - Creative mall in a repurposed office building\r\n4. Zhongshan Building - Hipster arts and culture space\r\n5. KL Butterfly Park - Thousands of colorful butterflies\r\n6. Bank Negara Museum - Surprisingly interesting money museum\r\n7. Kampung Baru - Traditional Malay village with modern skyline views', 'UrbanExplorer', 'https://images.unsplash.com/photo-1527631746610-bca00abb040a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_dA6s0N5p3Q', '2025-07-14', '2025-07-14', 'Malaysia on a Budget: How to Travel for Under $30/', 'Smart tips for affordable travel', '1. Stay in hostels or guesthouses ($5-10/night)\r\n2. Eat at local hawker stalls ($1-3 per meal)\r\n3. Use public transport (RM1-5 per ride)\r\n4. Visit free attractions (markets, temples, parks)\r\n5. Travel by bus between cities (cheaper than flights)\r\n6. Drink local kopi instead of imported coffee\r\n7. Visit during shoulder season for better deals\r\n8. Bargain at night markets\r\n9. Join free walking tours\r\n10. Use student discounts if applicable', 'BudgetTraveler', 'https://images.unsplash.com/photo-1527631746610-bca00abb040a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_eB7t1O6q4R', '2025-07-14', '2025-07-14', 'The Ultimate Penang Street Food Guide', 'Where and what to eat in George Town', '1. Lorong Baru (New Lane) Hawker Center - Try char kway teow and oyster omelet\r\n2. Gurney Drive - Famous for asam laksa and rojak\r\n3. Kimberley Street - Best place for duck meat koay teow th’ng\r\n4. Chulia Street Night Hawkers - Famous for nasi kandar\r\n5. Air Itam Market - Home of the original Penang laksa\r\n6. Kek Lok Si Temple - Try the vegetarian food\r\n7. Pulau Tikus Market - Great for breakfast options\r\n8. Padang Kota Lama - Famous for pasembur and cendol\r\n9. Lebuh Presgrave - Try the Hokkien mee\r\n10. Transfer Road - Famous for roti canai and apom', 'PenangFoodie', 'https://images.unsplash.com/photo-1559847844-5315695dadae?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_fC8u2P7r5S', '2025-07-14', '2025-07-14', '5 Best Islands in Malaysia for Diving', 'Discover amazing underwater worlds', '1. Sipadan Island - World-class diving with turtles and sharks\r\n2. Layang Layang - Famous for hammerhead sharks\r\n3. Perhentian Islands - Great for beginners and advanced divers\r\n4. Tioman Island - Beautiful coral reefs and marine life\r\n5. Redang Island - Crystal clear waters and diverse marine ecosystem', 'DiveMaster', 'https://images.unsplash.com/photo-1505228395891-9a51e7e86bf6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_gD9v3Q8s6T', '2025-07-14', '2025-07-14', 'Malaysia\'s Best Festivals You Should Experience', 'Colorful cultural celebrations', '1. Thaipusam - Dramatic Hindu festival at Batu Caves\r\n2. Chinese New Year - Vibrant celebrations in Chinatowns\r\n3. Hari Raya Aidilfitri - Muslim festival marking end of Ramadan\r\n4. Deepavali - Festival of Lights in Little India\r\n5. Gawai Dayak - Sarawak\'s harvest festival\r\n6. Rainforest World Music Festival - Unique musical event in Sarawak\r\n7. George Town Festival - Month-long arts celebration\r\n8. Malaysia International Gourmet Festival - Food lovers\' paradise', 'CultureLover', 'https://images.unsplash.com/photo-1527631746610-bca00abb040a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_hE0w4R9t7U', '2025-07-14', '2025-07-14', '10 Essential Malay Phrases for Travelers', 'Connect better with locals', '1. Hello - Selamat sejahtera\r\n2. Thank you - Terima kasih\r\n3. How much? - Berapa harga?\r\n4. Delicious - Sedap\r\n5. I want this - Saya nak ini\r\n6. Where is...? - Di mana...?\r\n7. Toilet - Tandas\r\n8. Beautiful - Cantik\r\n9. Sorry - Maaf\r\n10. Goodbye - Selamat tinggal (if you\'re leaving), Selamat jalan (if someone else is leaving)', 'LanguageGuide', 'https://images.unsplash.com/photo-1527631746610-bca00abb040a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_iF1x5S0u8V', '2025-07-14', '2025-07-14', 'Weekend Getaways From Kuala Lumpur', 'Escape the city without going far', '1. Fraser\'s Hill - Colonial hill station (2 hours)\r\n2. Kuala Selangor - Fireflies and seafood (1.5 hours)\r\n3. Sekinchan - Paddy fields and fishing village (1.5 hours)\r\n4. Genting Highlands - Cool weather and casinos (1 hour)\r\n5. Melaka - Historic city (2 hours)\r\n6. Ipoh - Cave temples and food (2.5 hours)\r\n7. Cameron Highlands - Tea plantations (3 hours)\r\n8. Pulau Ketam - Fishing island (1.5 hours + ferry)\r\n9. Kuala Kubu Bharu - Waterfalls and nature (1.5 hours)\r\n10. Tanjung Sepat - Small town with famous pau (1.5 hours)', 'WeekendWarrior', 'https://images.unsplash.com/photo-1505228395891-9a51e7e86bf6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_jG2y6T1v9W', '2025-07-14', '2025-07-14', 'What to Pack for Malaysia: The Ultimate Checklist', 'Be prepared for any adventure', '1. Light, breathable clothing (it\'s hot and humid!)\r\n2. Rain jacket or umbrella (sudden tropical showers)\r\n3. Comfortable walking shoes\r\n4. Swimwear (for beaches and hotel pools)\r\n5. Sunscreen and sunglasses\r\n6. Mosquito repellent\r\n7. Universal power adapter\r\n8. Copies of important documents\r\n9. Basic first aid kit\r\n10. Waterproof phone case\r\n11. Light scarf/sarong (for temple visits)\r\n12. Small backpack for day trips\r\n13. Reusable water bottle\r\n14. Hand sanitizer\r\n15. Portable charger', 'TravelGuru', 'https://images.unsplash.com/photo-1505228395891-9a51e7e86bf6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_kH3z7U2w0X', '2025-07-14', '2025-07-14', 'Malaysia With Kids: Best Family-Friendly Activitie', 'Fun for all ages', '1. Legoland Malaysia (Johor)\r\n2. Sunway Lagoon Theme Park (KL)\r\n3. KL Bird Park\r\n4. Penang Butterfly Farm\r\n5. KL Tower Mini Zoo\r\n6. KidZania Kuala Lumpur\r\n7. The Escape Adventureplay (Penang)\r\n8. Melaka Wonderland\r\n9. Farm in the City (KL)\r\n10. Sabah State Museum (Kota Kinabalu)', 'FamilyTravel', 'https://images.unsplash.com/photo-1505228395891-9a51e7e86bf6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_lI4a8V3x1Y', '2025-07-14', '2025-07-14', 'Malaysia\'s Most Instagrammable Spots', 'Picture-perfect locations', '1. Thean Hou Temple, KL\r\n2. Penang Street Art\r\n3. Batu Caves Rainbow Steps\r\n4. Putra Mosque, Putrajaya\r\n5. Cameron Highlands Tea Plantations\r\n6. Kapas Island Beaches\r\n7. Kek Lok Si Temple at Night\r\n8. KL Tower Sky Deck\r\n9. Sky Mirror, Kuala Selangor\r\n10. Floating Mosque, Kota Kinabalu', 'InstaTravel', 'https://images.unsplash.com/photo-1505228395891-9a51e7e86bf6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_mJ5b9W4y2Z', '2025-07-14', '2025-07-14', 'Malaysia\'s National Parks: A Nature Lover\'s Guide', 'Explore breathtaking biodiversity', '1. Taman Negara - Ancient rainforest\r\n2. Bako National Park - Proboscis monkeys\r\n3. Kinabalu Park - Mount Kinabalu\r\n4. Endau-Rompin National Park - Waterfalls and wildlife\r\n5. Gunung Mulu National Park - Amazing caves\r\n6. Tun Sakaran Marine Park - Coral reefs\r\n7. Penang National Park - Beaches and trails\r\n8. Royal Belum State Park - Rare wildlife\r\n9. Kubah National Park - Frog biodiversity\r\n10. Tanjung Datu National Park - Pristine beaches', 'NatureExplorer', 'https://images.unsplash.com/photo-1505228395891-9a51e7e86bf6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_nK6c0X5z3A', '2025-07-14', '2025-07-14', 'Shopping in Malaysia: Best Places for Great Deals', 'From markets to mega malls', '1. Petaling Street, KL (bargain hunting)\r\n2. Central Market, KL (local crafts)\r\n3. Suria KLCC (luxury brands)\r\n4. Pavilion Kuala Lumpur (high-end shopping)\r\n5. Jonker Walk Night Market, Melaka\r\n6. Gurney Plaza, Penang\r\n7. Imago Shopping Mall, Kota Kinabalu\r\n8. Mid Valley Megamall, KL\r\n9. One Utama Shopping Centre, KL\r\n10. Langkawi (duty-free shopping)', 'Shopaholic', 'https://images.unsplash.com/photo-1527631746610-bca00abb040a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_oL7d1Y6a4B', '2025-07-14', '2025-07-14', 'Malaysia\'s Best Street Art Locations', 'Where to find amazing murals', '1. George Town, Penang (Ernest Zacharevic murals)\r\n2. Ipoh Old Town (newer murals)\r\n3. Kuala Lumpur (scattered around city center)\r\n4. Kuching, Sarawak (local artists)\r\n5. Melaka (along the river)\r\n6. Taiping, Perak (emerging scene)\r\n7. Johor Bahru (new murals appearing)\r\n8. Kota Kinabalu (Sabah-themed art)\r\n9. Seremban (Negeri Sembilan murals)\r\n10. Alor Setar (Kedah street art)', 'ArtExplorer', 'https://images.unsplash.com/photo-1505228395891-9a51e7e86bf6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_pM8e2Z7b5C', '2025-07-14', '2025-07-14', 'Malaysia\'s Coffee Culture: Best Cafes to Try', 'From traditional kopitiams to third wave', '1. VCR, Kuala Lumpur (specialty coffee)\r\n2. ChinaHouse, Penang (longest cafe in Malaysia)\r\n3. Feeka Coffee Roasters, KL\r\n4. The Daily Fix, Melaka\r\n5. Niko Neko Matcha, KL (for matcha lovers)\r\n6. Merchant\'s Lane, KL (instagrammable)\r\n7. Lim Kopi, Penang (modern kopitiam)\r\n8. Pickers & Grinders, Ipoh\r\n9. Yellow Brick Road, KL\r\n10. Bean Reserve, Kota Kinabalu', 'CoffeeLover', 'https://images.unsplash.com/photo-1559847844-5315695dadae?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_qN9f3A8c6D', '2025-07-14', '2025-07-14', 'Malaysia\'s Best Hiking Trails', 'For outdoor enthusiasts', '1. Mount Kinabalu, Sabah (challenging)\r\n2. Broga Hill, Selangor (sunrise views)\r\n3. Penang Hill (via heritage trail)\r\n4. Bukit Tabur, KL (rocky ridge)\r\n5. Gunung Datuk, Negeri Sembilan\r\n6. Bukit Gasing, KL (urban jungle)\r\n7. Gunung Angsi, Negeri Sembilan\r\n8. Chiling Waterfall, Selangor\r\n9. Bukit Kutu, Selangor (abandoned bungalow)\r\n10. Maxwell Hill, Perak', 'HikingExpert', 'https://images.unsplash.com/photo-1505228395891-9a51e7e86bf6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_rO0g4B9d7E', '2025-07-14', '2025-07-14', 'Malaysia\'s Most Beautiful Mosques', 'Architectural wonders', '1. Putra Mosque, Putrajaya (pink mosque)\r\n2. National Mosque, KL (modern design)\r\n3. Crystal Mosque, Terengganu\r\n4. Ubudiah Mosque, Kuala Kangsar\r\n5. Kapitan Keling Mosque, Penang\r\n6. Sultan Salahuddin Abdul Aziz Shah Mosque, Selangor (blue mosque)\r\n7. Floating Mosque, Kota Kinabalu\r\n8. Zahir Mosque, Kedah\r\n9. Tengku Tengah Zaharah Mosque, Terengganu (floating mosque)\r\n10. Wilayah Persekutuan Mosque, KL', 'CultureExplorer', 'https://images.unsplash.com/photo-1505228395891-9a51e7e86bf6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_sP1h5C0e8F', '2025-07-14', '2025-07-14', 'Malaysia\'s Best Beaches for Relaxation', 'White sands and turquoise waters', '1. Pantai Cenang, Langkawi\r\n2. Long Beach, Perhentian Kecil\r\n3. Tanjung Rhu, Langkawi\r\n4. Pasir Panjang, Redang\r\n5. Emerald Bay, Pangkor Laut\r\n6. Teluk Nipah, Pangkor\r\n7. Turtle Bay, Perhentian Besar\r\n8. Datai Bay, Langkawi\r\n9. Juara Beach, Tioman\r\n10. Pantai Kok, Langkawi', 'BeachLover', 'https://images.unsplash.com/photo-1505228395891-9a51e7e86bf6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_tQ2i6D1f9G', '2025-07-14', '2025-07-14', 'Malaysia\'s Unique Wildlife Encounters', 'Where to see amazing animals', '1. Sepilok Orangutan Rehabilitation Centre, Sabah\r\n2. Bornean Sun Bear Conservation Centre\r\n3. Kuala Gandah Elephant Sanctuary\r\n4. Langkawi Wildlife Park\r\n5. Turtle Sanctuary, Melaka\r\n6. Deerland, Langkawi\r\n7. KL Bird Park\r\n8. Proboscis monkeys in Bako National Park\r\n9. Firefly watching in Kuala Selangor\r\n10. Rafflesia flower spotting in Sabah', 'WildlifeWatcher', 'https://images.unsplash.com/photo-1505228395891-9a51e7e86bf6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80'),
('BLG_uR3j7E2g0H', '2025-07-14', '2025-07-14', 'Malaysia\'s Best Night Markets', 'For food, shopping and atmosphere', '1. Jalan Alor, KL (food paradise)\r\n2. Jonker Walk Night Market, Melaka\r\n3. Gurney Drive Hawker Center, Penang\r\n4. Pasar Malam Taman Connaught, KL (longest night market)\r\n5. Batu Ferringhi Night Market, Penang\r\n6. Chow Kit Market, KL (late night)\r\n7. Pasar Karat, Ipoh (flea market)\r\n8. Kota Bharu Night Market, Kelantan\r\n9. Kuching Waterfront Night Market\r\n10. Tanjung Aru Night Market, Kota Kinabalu', 'NightOwl', 'https://images.unsplash.com/photo-1559847844-5315695dadae?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80');

-- --------------------------------------------------------

--
-- Table structure for table `book_mbr_list_t`
--

CREATE TABLE `book_mbr_list_t` (
  `mbr_ls_ID` varchar(15) NOT NULL,
  `bkn_ID` varchar(14) NOT NULL,
  `mbr_doc_ID` varchar(20) NOT NULL,
  `mbr_name` varchar(50) NOT NULL,
  `mbr_seqNo` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_mbr_list_t`
--

INSERT INTO `book_mbr_list_t` (`mbr_ls_ID`, `bkn_ID`, `mbr_doc_ID`, `mbr_name`, `mbr_seqNo`) VALUES
('BMBR_BC12uV3w4X', 'BKN_a8Bb9Cc1Dd', 'A901907111', 'George Savage', 1),
('BMBR_BC34oP5q6R', 'BKN_a2Bb3Cc4Dd', 'A567890123', 'Dr. Ethan Mack', 2),
('BMBR_BC56gH7i8J', 'BKN_a2Bb3Cc4Dd', '810319-41-3658', 'Dr. Corey Mack MD', 3),
('BMBR_BC56yZ7a8B', 'BKN_a8Bb9Cc1Dd', 'A234567890', 'Emma Savage', 2),
('BMBR_BC90kL1m2N', 'BKN_a2Bb3Cc4Dd', '820420-15-7890', 'Dr. Sarah Mack', 1),
('BMBR_BN56oP7q8R', 'BKN_s8Tt9Uu1Vv', '040511-28-2537', 'Richard Campbell', 1),
('BMBR_BN90sT1u2V', 'BKN_s8Tt9Uu1Vv', 'A123456789', 'Grace Campbell', 2),
('BMBR_CH12qR3s4T', 'BKN_m2Mm3Nn4Oo', 'A345678901', 'Noah Tate', 4),
('BMBR_CH34iJ5k6L', 'BKN_m2Mm3Nn4Oo', 'A123456789', 'John Tate', 2),
('BMBR_CH78mN9o0P', 'BKN_m2Mm3Nn4Oo', 'A234567890', 'Olivia Tate', 3),
('BMBR_CH90eF1g2H', 'BKN_m2Mm3Nn4Oo', '891017-80-9135', 'Emily Tate DVM', 1),
('BMBR_GH12kL3m4N', 'BKN_p5Pp6Qq7Rr', 'A456789012', 'Mason Williams', 5),
('BMBR_GH34cD5e6F', 'BKN_p5Pp6Qq7Rr', 'A234567890', 'Liam Williams', 3),
('BMBR_GH56uV7w8X', 'BKN_p5Pp6Qq7Rr', '990413-37-2001', 'Jonathan Williams', 1),
('BMBR_GH78gH9i0J', 'BKN_p5Pp6Qq7Rr', 'A345678901', 'Ava Williams', 4),
('BMBR_GH90yZ1a2B', 'BKN_p5Pp6Qq7Rr', 'A123456789', 'Sophia Williams', 2),
('BMBR_GlPGsMJbMz', 'BKN_cJhAzxy0VD', '010102140101', 'Wong Ting Song', 2),
('BMBR_GM56aB7c8D', 'BKN_i8Jj9Kk1Ll', '821231-31-9752', 'Tina Glass', 1),
('BMBR_GT12sT3u4V', 'BKN_u2Vv3Ww4Xx', '930831-99-8472', 'Brian Chen', 1),
('BMBR_GT56wX7y8Z', 'BKN_u2Vv3Ww4Xx', 'A123456789', 'Amy Chen', 2),
('BMBR_IcWOBbfAiR', 'BKN_cJhAzxy0VD', '010101140101', 'Tei Yu Hong', 1),
('BMBR_IP34aB5c6D', 'BKN_c3Dd4E5fG6', '831210-40-2229', 'Kenneth Lopez', 1),
('BMBR_IP56kL7m8N', 'BKN_g2Hh3Ii4Jj', '690827-14-3096', 'Laura Williams', 1),
('BMBR_IP78eF9g0H', 'BKN_c3Dd4E5fG6', '850505-14-6789', 'Maria Lopez', 2),
('BMBR_JB12gH3i4J', 'BKN_c8Dd9Ee1Ff', 'A456789012', 'Diego Lopez', 5),
('BMBR_JB12oP3q4R', 'BKN_vW0xY1zA2B', 'A567890123', 'Robert Becker', 2),
('BMBR_JB34yZ5a6B', 'BKN_c8Dd9Ee1Ff', 'A234567890', 'Carlos Lopez', 3),
('BMBR_JB56qR7s8T', 'BKN_c8Dd9Ee1Ff', '831210-40-2229', 'Kenneth Lopez', 1),
('BMBR_JB56sT7u8V', 'BKN_vW0xY1zA2B', 'A678901234', 'Sophie Becker', 3),
('BMBR_JB78cD9e0F', 'BKN_c8Dd9Ee1Ff', 'A345678901', 'Isabella Lopez', 4),
('BMBR_JB78kL9m0N', 'BKN_vW0xY1zA2B', 'A874238332', 'Jennifer Becker', 1),
('BMBR_JB90uV1w2X', 'BKN_c8Dd9Ee1Ff', 'A123456789', 'Maria Lopez', 2),
('BMBR_JB90wX1y2Z', 'BKN_vW0xY1zA2B', 'A789012345', 'Thomas Becker', 4),
('BMBR_KC12uV3w4X', 'BKN_oP7qR8sT9U', '930831-99-8472', 'Brian Chen', 1),
('BMBR_KC34gH5i6J', 'BKN_oP7qR8sT9U', 'A987654321', 'Lisa Chen', 4),
('BMBR_KC56yZ7a8B', 'BKN_oP7qR8sT9U', '940912-08-7654', 'Jennifer Chen', 2),
('BMBR_KC90cD1e2F', 'BKN_oP7qR8sT9U', 'A123456789', 'David Chen', 3),
('BMBR_KK12iJ3k4L', 'BKN_h7Ii8J9kL0', '690827-14-3096', 'Laura Williams', 1),
('BMBR_KK12yZ3a4B', 'BKN_m5Nn6Oo7Pp', 'A891092157', 'Christian Cantrell', 1),
('BMBR_KK34sT5u6V', 'BKN_k5Ll6Mm7Nn', 'A123456789', 'James Dixon', 2),
('BMBR_KK56cD7e8F', 'BKN_m5Nn6Oo7Pp', 'A123456789', 'Lily Cantrell', 2),
('BMBR_KK90oP1q2R', 'BKN_k5Ll6Mm7Nn', 'A027251607', 'Monique Dixon', 1),
('BMBR_KL12aB3c4D', 'BKN_aB1cD2eF3G', 'A666964400', 'Christian Baker', 1),
('BMBR_KL34kL5m6N', 'BKN_q8Rr9Ss1Tt', 'A234567890', 'Sarah Baker', 2),
('BMBR_KL56eF7g8H', 'BKN_aB1cD2eF3G', 'A987654321', 'Sarah Baker', 2),
('BMBR_KL78oP9q0R', 'BKN_q8Rr9Ss1Tt', 'A345678901', 'Daniel Baker', 3),
('BMBR_KL90gH1i2J', 'BKN_q8Rr9Ss1Tt', 'A666964400', 'Christian Baker', 1),
('BMBR_KS12eF3g4H', 'BKN_a5Bb6Cc7Dd', 'A123456789', 'Mia Lopez', 2),
('BMBR_KS78aB9c0D', 'BKN_a5Bb6Cc7Dd', '060906-51-8498', 'Jason Lopez', 1),
('BMBR_KU78uV9w0X', 'BKN_i2Jj3Kk4Ll', '920818-54-3515', 'Alexis Smith MD', 1),
('BMBR_LK12wX3y4Z', 'BKN_e5Ff6Gg7Hh', 'A234567890', 'Emma Savage', 2),
('BMBR_LK78sT9u0V', 'BKN_e5Ff6Gg7Hh', 'A901907111', 'George Savage', 1),
('BMBR_lZwkoWH4p1', 'BKN_cJhAzxy0VD', '010103140567', 'Vun Jin Quan', 3),
('BMBR_ML34wX5y6Z', 'BKN_w2Xx3Yy4Zz', '010302-50-6669', 'Elizabeth Wood', 1),
('BMBR_PG34mN5o6P', 'BKN_hI4jK5lM6N', 'A234567890', 'Michael Oconnell', 2),
('BMBR_PG78qR9s0T', 'BKN_hI4jK5lM6N', 'A345678901', 'Emily Oconnell', 3),
('BMBR_PG90iJ1k2L', 'BKN_hI4jK5lM6N', 'A120324723', 'Laura Oconnell', 1),
('BMBR_PH12cD3e4F', 'BKN_w9Xx0Yy1Zz', 'A456789012', 'Carlos Rubio', 2),
('BMBR_PH78qR9s0T', 'BKN_w5Xx6Yy7Zz', '810319-41-3658', 'Dr. Corey Mack MD', 1),
('BMBR_PH78yZ9a0B', 'BKN_w9Xx0Yy1Zz', 'A900999212', 'Mikayla Rubio', 1),
('BMBR_RD12aB3c4D', 'BKN_o8Pp9Qq1Rr', 'A234567890', 'Dr. Emily Walters', 2),
('BMBR_RD56eF7g8H', 'BKN_o8Pp9Qq1Rr', 'A345678901', 'Dr. Noah Walters', 3),
('BMBR_RD56mN7o8P', 'BKN_m1Nn2O3pQ4', 'A027251607', 'Monique Dixon', 1),
('BMBR_RD78wX9y0Z', 'BKN_o8Pp9Qq1Rr', 'A498459232', 'Mr. William Walters MD', 1),
('BMBR_RD90qR1s2T', 'BKN_m1Nn2O3pQ4', 'A123456789', 'James Dixon', 2),
('BMBR_SW12mN3o4P', 'BKN_y5Zz6Aa7Bb', 'A456789012', 'Thomas Becker', 4),
('BMBR_SW34eF5g6H', 'BKN_y5Zz6Aa7Bb', 'A234567890', 'Robert Becker', 2),
('BMBR_SW78iJ9k0L', 'BKN_y5Zz6Aa7Bb', 'A345678901', 'Sophie Becker', 3),
('BMBR_SW90aB1c2D', 'BKN_y5Zz6Aa7Bb', 'A874238332', 'Jennifer Becker', 1),
('BMBR_TI34mN5o6P', 'BKN_s2Tt3Uu4Vv', 'A123456789', 'Carlos Rubio', 2),
('BMBR_TI90iJ1k2L', 'BKN_s2Tt3Uu4Vv', 'A900999212', 'Mikayla Rubio', 1),
('BMBR_TM34uV5w6X', 'BKN_r5Ss6T7uV8', 'A498459232', 'Mr. William Walters MD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_tour_t`
--

CREATE TABLE `book_tour_t` (
  `usr_ID` varchar(14) NOT NULL,
  `bkn_ID` varchar(14) NOT NULL,
  `bkr_role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_tour_t`
--

INSERT INTO `book_tour_t` (`usr_ID`, `bkn_ID`, `bkr_role`) VALUES
('TOR_aXkucTjcJl', 'BKN_aB1cD2eF3G', 'Primary traveller'),
('TOR_BQSmIEhHuj', 'BKN_hI4jK5lM6N', 'Primary traveller'),
('TOR_ehUWoREjmo', 'BKN_oP7qR8sT9U', 'Primary traveller'),
('TOR_esxqIPVJZT', 'BKN_vW0xY1zA2B', 'Primary traveller'),
('TOR_HqvSLDzSMy', 'BKN_c3Dd4E5fG6', 'Primary traveller'),
('TOR_iegYMEMMpC', 'BKN_h7Ii8J9kL0', 'Primary traveller'),
('TOR_JGgZstigpL', 'BKN_m1Nn2O3pQ4', 'Primary traveller'),
('TOR_kqCVcrHUCm', 'BKN_r5Ss6T7uV8', 'Primary traveller'),
('TOR_mIjoznqflO', 'BKN_w9Xx0Yy1Zz', 'Primary traveller'),
('TOR_obFLvzoxke', 'BKN_a2Bb3Cc4Dd', 'Primary traveller'),
('TOR_qeFRnAUpGa', 'BKN_e5Ff6Gg7Hh', 'Primary traveller'),
('TOR_qkYgNKMKuZ', 'BKN_i8Jj9Kk1Ll', 'Primary traveller'),
('TOR_QZiBBcApYt', 'BKN_m2Mm3Nn4Oo', 'Primary traveller'),
('TOR_tDTSQUxvVK', 'BKN_p5Pp6Qq7Rr', 'Primary traveller'),
('TOR_uGxtwdHyFT', 'BKN_s8Tt9Uu1Vv', 'Primary traveller'),
('TOR_WwtDbPCWDb', 'BKN_w2Xx3Yy4Zz', 'Primary traveller'),
('TOR_wYbtrxLIAq', 'BKN_a5Bb6Cc7Dd', 'Primary traveller'),
('TOR_ytjqxLZeIn', 'BKN_i2Jj3Kk4Ll', 'Primary traveller'),
('TOR_zOwhRfBdVS', 'BKN_m5Nn6Oo7Pp', 'Primary traveller'),
('TOR_aXkucTjcJl', 'BKN_q8Rr9Ss1Tt', 'Primary traveller'),
('TOR_ehUWoREjmo', 'BKN_u2Vv3Ww4Xx', 'Primary traveller'),
('TOR_esxqIPVJZT', 'BKN_y5Zz6Aa7Bb', 'Primary traveller'),
('TOR_HqvSLDzSMy', 'BKN_c8Dd9Ee1Ff', 'Primary traveller'),
('TOR_iegYMEMMpC', 'BKN_g2Hh3Ii4Jj', 'Primary traveller'),
('TOR_JGgZstigpL', 'BKN_k5Ll6Mm7Nn', 'Primary traveller'),
('TOR_kqCVcrHUCm', 'BKN_o8Pp9Qq1Rr', 'Primary traveller'),
('TOR_mIjoznqflO', 'BKN_s2Tt3Uu4Vv', 'Primary traveller'),
('TOR_obFLvzoxke', 'BKN_w5Xx6Yy7Zz', 'Primary traveller'),
('TOR_qeFRnAUpGa', 'BKN_a8Bb9Cc1Dd', 'Primary traveller');

-- --------------------------------------------------------

--
-- Table structure for table `info_site_t`
--

CREATE TABLE `info_site_t` (
  `ist_ID` varchar(14) NOT NULL,
  `ist_date_create` date NOT NULL,
  `ist_date_edit` date NOT NULL,
  `ist_title` varchar(50) NOT NULL,
  `ist_desc` varchar(100) DEFAULT NULL,
  `ist_cont` longtext NOT NULL,
  `ist_type` varchar(100) NOT NULL,
  `ist_author` varchar(50) NOT NULL,
  `ist_img` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info_site_t`
--

INSERT INTO `info_site_t` (`ist_ID`, `ist_date_create`, `ist_date_edit`, `ist_title`, `ist_desc`, `ist_cont`, `ist_type`, `ist_author`, `ist_img`) VALUES
('IST_JB9012hIjK', '2025-07-14', '2025-07-14', 'Johor\'s Sultan Abu Bakar Mosque', 'Victorian-Moorish architectural masterpiece', 'The Sultan Abu Bakar Mosque in Johor Bahru blends Victorian and Moorish architectural styles. Completed in 1900 under Sultan Ibrahim, it features British brickwork, Italian marble floors, and stained glass from Belgium. The mosque can accommodate 2,000 worshippers and offers panoramic views of the Straits of Johor. Its four minarets resemble British clock towers, while the main dome showcases intricate Islamic calligraphy. The mosque remains an active place of worship and symbol of Johor\'s historical ties to Britain. Visitors must dress modestly and non-Muslims may only enter outside prayer times.', 'Place', 'Aisyah binti Rahman', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Sultan_Abu_Bakar_Mosque_Johor.jpg/1200px-Sultan_Abu_Bakar_Mosque_Johor.jpg'),
('IST_KD7890fGhI', '2025-07-14', '2025-07-14', 'Bujang Valley Archaeological Site', 'Ancient Hindu-Buddhist civilization in Kedah', 'The Bujang Valley in Kedah contains Malaysia\'s most extensive archaeological site, with ruins dating from the 3rd to 14th centuries. Over 50 candi (temple bases) dot the area, evidence of a sophisticated Hindu-Buddhist kingdom that controlled regional trade. The site museum displays artifacts including ceramics, sculptures, and iron smelting equipment. The most significant ruin, Candi Bukit Batu Pahat, features a reconstructed brick temple. Ongoing excavations continue to reveal insights into early Southeast Asian maritime networks and cultural exchanges between India and the Malay Archipelago.', 'History', 'Nurul Huda binti Kamal', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Candi_Bujang_Valley.jpg/1200px-Candi_Bujang_Valley.jpg'),
('IST_KK9012iJkL', '2025-07-14', '2025-07-14', 'Petronas Twin Towers Architecture', 'Engineering marvel of Malaysia\'s iconic skyscrapers', 'The Petronas Twin Towers in Kuala Lumpur were the world\'s tallest buildings from 1998 to 2004. Designed by César Pelli, the 88-floor towers feature Islamic-inspired geometric patterns and a skybridge connecting them at the 41st and 42nd floors. The steel-and-glass facade reflects Malaysia\'s modernity while incorporating traditional motifs. The towers sit on the former site of Kuala Lumpur\'s race track, with the basement housing Suria KLCC mall. The complex includes a symphony lake where nightly light shows occur. Visitors can tour the skybridge and observation deck for panoramic city views.', 'Place', 'Robert Smith', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Petronas_Panorama_II.jpg/1200px-Petronas_Panorama_II.jpg'),
('IST_KL1234aBcD', '2025-07-14', '2025-07-14', 'Nasi Lemak: Malaysia\'s National Dish', 'The complete guide to Malaysia\'s iconic breakfast', 'Nasi Lemak, meaning \"fatty rice\" in Malay, is considered Malaysia\'s national dish. This fragrant rice cooked in coconut milk is traditionally served with sambal (spicy chili paste), crispy anchovies, roasted peanuts, sliced cucumber, and hard-boiled egg. Modern variations include additions like fried chicken, rendang, or squid. The dish reflects Malaysia\'s multicultural heritage, with Malay, Chinese, and Indian influences. Originally a farmer\'s breakfast, it\'s now enjoyed at all hours across the country, from street stalls to high-end restaurants. Each state offers unique variations - Kelantanese nasi lemak features sweeter sambal, while Penang versions often include curry.', 'Cuisine', 'Lim Mei Ling', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/Nasi_lemak_on_banana_leaf.jpg/1200px-Nasi_lemak_on_banana_leaf.jpg'),
('IST_KL2345uVwX', '2025-07-14', '2025-07-14', 'Silat: Traditional Malay Martial Art', 'The cultural significance of Malaysia\'s combat heritage', 'Silat is a traditional Malay martial art combining self-defense techniques, spiritual training, and artistic performance. Over 150 styles exist in Malaysia, with Silat Melayu being the most widespread. Practitioners train in jurus (movement patterns), buah (combat techniques), and seni (artistic forms). Traditional weapons include the keris (wavy dagger), parang (machete), and tongkat (walking stick). Silat performances often accompany cultural events with rhythmic movements set to gendang (drums) music. Recognized by UNESCO as intangible cultural heritage, silat remains popular with national competitions held annually.', 'Tradition', 'Ahmad bin Ismail', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8c/Silat_demonstration.jpg/1200px-Silat_demonstration.jpg'),
('IST_KT5678fGhI', '2025-07-14', '2025-07-14', 'Wayang Kulit: Malay Shadow Puppetry', 'Ancient storytelling tradition of Kelantan', 'Wayang Kulit (shadow puppetry) is a traditional Malay performing art most vibrant in Kelantan. Using intricately carved leather puppets backlit by oil lamps, dalang (puppet masters) perform episodes from the Ramayana accompanied by a gamelan orchestra. The performances blend Hindu mythology with local folklore and Islamic values. Puppets feature distinctive designs - the noble characters have slender profiles while demons appear grotesque. Though declining due to religious restrictions, efforts continue to preserve this UNESCO-recognized heritage through festivals and workshops in Kota Bharu.', 'Tradition', 'David Wong', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Wayang_Kulit_Malaysia.jpg/1200px-Wayang_Kulit_Malaysia.jpg'),
('IST_LG7890qRsT', '2025-07-14', '2025-07-14', 'Langkawi Sky Bridge', 'Engineering marvel in the rainforest canopy', 'The Langkawi Sky Bridge is a 125-meter curved pedestrian bridge suspended 700 meters above sea level on Machinchang Mountain. Accessible via cable car, the bridge offers breathtaking views of Langkawi\'s islands and the Andaman Sea. Its unique single-pylon design allows the bridge to curve through the rainforest canopy. Glass floor panels provide thrilling perspectives of the jungle below. The bridge closed for renovations in 2019 and reopened with enhanced safety features. Visitors should check weather conditions as the bridge may close during high winds or storms.', 'Place', 'Tan Wei Chen', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Langkawi_Sky_Bridge_2019.jpg/1200px-Langkawi_Sky_Bridge_2019.jpg'),
('IST_ML3456mNoP', '2025-07-14', '2025-07-14', 'Malacca\'s Stadthuys: Dutch Colonial Legacy', 'Historical landmark from Malaysia\'s colonial period', 'The Stadthuys in Malacca is a striking red building complex dating to 1650, constructed during Dutch colonial rule. This administrative center features Dutch architectural elements like thick walls, louvered windows, and heavy wooden doors. Now housing the History and Ethnography Museum, it displays artifacts from Malacca\'s sultanate, Portuguese, Dutch, and British periods. The adjacent Christ Church, built with Dutch bricks, remains an active Anglican church. The complex forms the heart of Malacca\'s UNESCO World Heritage zone and exemplifies the best-preserved Dutch colonial architecture in Southeast Asia.', 'History', 'Nurul Huda binti Kamal', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8a/Stadthuys_and_Christ_Church_Melaka_2017.jpg/1200px-Stadthuys_and_Christ_Church_Melaka_2017.jpg'),
('IST_ML5678jKlM', '2025-07-14', '2025-07-14', 'Malacca River Cruise', 'Historic waterway through the UNESCO city', 'The Malacca River cruise offers a unique perspective of the historic city\'s landmarks. The 45-minute journey passes colonial buildings, traditional villages, and modern murals. Evening cruises showcase illuminated bridges and buildings with laser projections telling Malacca\'s history. Key sights include the Maritime Museum replica ship, Kampung Morten traditional houses, and the iconic Red Clock Tower. The riverfront features revitalized warehouses now housing cafes and galleries. The cruise demonstrates how Malacca has preserved its heritage while adapting its historic waterway for modern tourism.', 'Place', 'Robert Smith', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Melaka_River_at_night.jpg/1200px-Melaka_River_at_night.jpg'),
('IST_NS5678uVwX', '2025-07-14', '2025-07-14', 'Minangkabau Architecture in Negeri Sembilan', 'Distinctive buffalo-horn roof designs', 'Negeri Sembilan showcases unique Minangkabau architecture from West Sumatra, characterized by dramatic curved roofs resembling buffalo horns (gonjong). The Seri Menanti Old Palace, built without nails in 1905, exemplifies this style with its four-tiered roof. Traditional houses feature matrilineal elements like the rumah gadang (women\'s communal space) and intricate woodcarvings depicting nature motifs. This architectural style reflects Adat Perpatih customs emphasizing maternal lineage. Visitors can see well-preserved examples at the Negeri Sembilan State Museum and traditional villages throughout the state.', 'Culture', 'Rajesh Kumar', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3e/Seri_Menanti_Old_Palace.jpg/1200px-Seri_Menanti_Old_Palace.jpg'),
('IST_PG5678eFgH', '2025-07-14', '2025-07-14', 'Batik: Malaysia\'s Traditional Fabric Art', 'The history and techniques of Malaysian batik', 'Malaysian batik is a textile art form using wax-resist dyeing techniques to create intricate patterns. Unlike Javanese batik, Malaysian styles feature more organic motifs like leaves and flowers. The process involves applying hot wax with a tjanting tool, dyeing the fabric, then boiling off the wax. East Coast states like Kelantan and Terengganu are renowned for their hand-drawn batik, while Johor specializes in stamped batik. Contemporary designers now incorporate batik into modern fashion. UNESCO recognized Malaysian batik as an Intangible Cultural Heritage in 2009. Visitors can observe the process at batik workshops in Kuala Terengganu or Penang.', 'Culture', 'Mohd Ali bin Abu', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Malaysian_Batik_%28Sarong%29.jpg/1200px-Malaysian_Batik_%28Sarong%29.jpg'),
('IST_PG9012mNoP', '2025-07-14', '2025-07-14', 'Penang Hill Funicular Railway', 'Colonial-era transport to cool heights', 'Penang Hill\'s funicular railway, operating since 1923, is one of Asia\'s oldest. The 2,007-meter track climbs 735 meters through rainforest at gradients up to 52 degrees. The Swiss-designed system was upgraded in 2010 with new trains completing the journey in 5 minutes. At the summit (821m above sea level), visitors enjoy cooler temperatures and panoramic views of George Town. Colonial bungalows, a Hindu temple, and nature trails dot the hilltop. The railway represents British colonial efforts to escape lowland heat while showcasing engineering achievements of the period.', 'Place', 'Lim Mei Ling', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Penang_Hill_Funicular_Railway.jpg/1200px-Penang_Hill_Funicular_Railway.jpg'),
('IST_PH9012yZaB', '2025-07-14', '2025-07-14', 'Taman Negara: Ancient Rainforest', 'Exploring Malaysia\'s premier national park', 'Taman Negara, established in 1938, protects one of the world\'s oldest rainforests dating back 130 million years. The park spans 4,343 sq km across Pahang, Kelantan, and Terengganu. Visitors can experience the 530-meter canopy walkway, river cruises to spot wildlife, and challenging hikes to Bukit Teresek. The forest harbors endangered species like Malayan tigers, Asian elephants, and rafflesia flowers. Indigenous Orang Asli guides offer jungle survival demonstrations. Accommodation ranges from rustic hides to comfortable resorts. The park represents Malaysia\'s commitment to conserving its natural heritage amidst development pressures.', 'Place', 'Muthu a/l Palani', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Taman_Negara_Canopy_Walkway.jpg/1200px-Taman_Negara_Canopy_Walkway.jpg'),
('IST_PK3456cDeF', '2025-07-14', '2025-07-14', 'Ipoh\'s Concubine Lane', 'Historic alley with colorful past', 'Concubine Lane (Lorong Panglima) in Ipoh\'s Old Town was originally home to the mistresses of wealthy tin miners during Ipoh\'s boom years. The narrow alley features restored pre-war shophouses painted in pastel colors, now housing cafes, souvenir shops, and art galleries. The lane comes alive during festivals with lantern displays and cultural performances. Nearby parallel lanes - Market Lane and Harmony Lane - complete the historic district. Concubine Lane offers glimpses into Perak\'s tin mining heyday and the social hierarchies of colonial-era Malaya.', 'History', 'Ahmad Fauzi bin Ismail', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8f/Concubine_Lane_Ipoh.jpg/1200px-Concubine_Lane_Ipoh.jpg'),
('IST_PK7890mNoP', '2025-07-14', '2025-07-14', 'Kellie\'s Castle: Malaysia\'s Romantic Ruin', 'The mysterious Scottish manor of Perak', 'Kellie\'s Castle near Batu Gajah is an unfinished Moorish-style mansion built by Scottish planter William Kellie Smith in 1915. The structure features a unique blend of Scottish and Indian architectural elements, including a rooftop courtyard and Malaysia\'s first elevator shaft. Local legends speak of hidden tunnels and ghostly apparitions. Construction halted when Kellie died in 1926, leaving the building incomplete. The ruins now attract visitors intrigued by its romantic decay and panoramic views of Perak\'s countryside. The site has been featured in several Malaysian films and television shows.', 'History', 'Siti Nurhaliza binti Omar', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Kellie%27s_Castle_2019.jpg/1200px-Kellie%27s_Castle_2019.jpg'),
('IST_PN6789yZaB', '2025-07-14', '2025-07-14', 'Penang Peranakan Mansion', 'Legacy of the Straits Chinese in George Town', 'The Pinang Peranakan Mansion in George Town showcases the opulent lifestyle of 19th-century Baba-Nyonya (Straits Chinese) merchants. This meticulously restored green-hued townhouse features elaborate woodcarvings, antique furniture, and collections of porcelain and jewelry. The architecture blends Chinese, Malay, and European influences with a central courtyard and intricate tile work. Costumed guides explain Peranakan customs, including the elaborate 12-day wedding ceremony. The mansion serves as both museum and cultural center, offering insights into this unique hybrid culture that developed in Malacca, Penang, and Singapore.', 'Culture', 'Sarah Johnson', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Pinang_Peranakan_Mansion.jpg/1200px-Pinang_Peranakan_Mansion.jpg'),
('IST_SB1234cDeF', '2025-07-14', '2025-07-14', 'Sarawak Cultural Village', 'Living museum of Borneo\'s indigenous cultures', 'Dubbed \"the living museum,\" Sarawak Cultural Village near Kuching showcases the traditional dwellings and lifestyles of Sarawak\'s major ethnic groups. The 17-acre site features authentic longhouses of the Iban, Bidayuh, and Orang Ulu, a Penan jungle settlement, and Chinese farmhouse. Daily cultural performances highlight traditional dances like the Ngajat of the Iban and the Bamboo Dance of the Bidayuh. Visitors can try blowpipe shooting, beadwork, and sago processing. The village hosts the annual Rainforest World Music Festival, attracting international artists and audiences.', 'Culture', 'Wong Zi Sean', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3d/Sarawak_Cultural_Village.jpg/1200px-Sarawak_Cultural_Village.jpg'),
('IST_SB1234hIjK', '2025-07-14', '2025-07-14', 'Mari-Mari Cultural Village', 'Experiencing Sabah\'s indigenous cultures', 'Mari-Mari Cultural Village near Kota Kinabalu offers immersive experiences with Sabah\'s ethnic groups - the Kadazan-Dusun, Rungus, Lundayeh, Bajau, and Murut. Visitors enter traditional houses through \"welcoming rituals,\" witness fire-starting demonstrations, and try bamboo cooking. The Murut house features a lansaran (springy floor) used in warrior training. Cultural performances showcase dances like the sumazau and magunatip (bamboo dance). The village provides insights into indigenous lifestyles before modernization, with guides explaining traditional beliefs, hunting techniques, and handicrafts like beadwork and blowpipe making.', 'Culture', 'Tan Wei Chen', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7a/Mari-Mari_Cultural_Village.jpg/1200px-Mari-Mari_Cultural_Village.jpg'),
('IST_SL1234qRsT', '2025-07-14', '2025-07-14', 'Firefly Watching in Kuala Selangor', 'Natural light show along the Selangor River', 'The Selangor River near Kuala Selangor hosts one of the world\'s largest colonies of synchronous fireflies (Pteroptyx tener). These insects flash in unison, creating magical displays in the riverside mangrove trees. The best viewing occurs on moonless nights via silent electric boats that minimize disturbance. The fireflies’ synchronized bioluminescence serves as mating communication. Conservation efforts protect this fragile ecosystem from light pollution and habitat destruction. Nearby Kampung Kuantan and Kampung Bukit Belimbing offer responsible tourism experiences that support local communities while preserving this natural wonder.', 'Place', 'Abdullah bin Sulaiman', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/Fireflies_in_Kuala_Selangor.jpg/1200px-Fireflies_in_Kuala_Selangor.jpg'),
('IST_TR3456jKlM', '2025-07-14', '2025-07-14', 'Terengganu\'s Crystal Mosque', 'Modern Islamic architecture on the river', 'The Crystal Mosque (Masjid Kristal) in Kuala Terengganu appears to float on the Terengganu River. Completed in 2008, its steel, glass, and crystal construction reflects sunlight dramatically. The mosque incorporates modern technology with LED lighting that changes colors at night. It can accommodate 1,500 worshippers and features marble floors, crystal chandeliers, and intricate metalwork. Part of the Islamic Heritage Park on Wan Man Island, the mosque represents Terengganu\'s embrace of contemporary Islamic architecture while maintaining traditional values. Visitors must dress appropriately to enter outside prayer times.', 'Place', 'Chen Li Wei', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Crystal_Mosque_at_night.jpg/1200px-Crystal_Mosque_at_night.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `itinerary_rec_list_t`
--

CREATE TABLE `itinerary_rec_list_t` (
  `itr_rec_ID` varchar(15) NOT NULL,
  `itr_ID` varchar(14) NOT NULL,
  `itr_date` date NOT NULL,
  `itr_day` varchar(9) NOT NULL,
  `itr_time` varchar(5) NOT NULL,
  `itr_act` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itinerary_rec_list_t`
--

INSERT INTO `itinerary_rec_list_t` (`itr_rec_ID`, `itr_ID`, `itr_date`, `itr_day`, `itr_time`, `itr_act`) VALUES
('IREC_2jLvu7tXKN', 'ITR_afH50ULmJg', '2025-07-15', 'Day 3', '12:10', 'Activity3'),
('IREC_3II7DbGnvz', 'ITR_8ujzZYNRCe', '2025-07-16', 'Day 1', '15:08', 'Visit KLCC'),
('IREC_ceHFNl76zR', 'ITR_afH50ULmJg', '2025-07-13', 'Day 1', '12:00', 'Activity1'),
('IREC_iQkos8SJKm', 'ITR_8ujzZYNRCe', '2025-07-18', 'Day 3', '15:10', 'Visit and shopping at Bukit Bintang'),
('IREC_LYEnKrIJZ1', 'ITR_8ujzZYNRCe', '2025-07-17', 'Day 2', '15:09', 'Visit KL Tower'),
('IREC_n5m6JKM7kG', 'ITR_mbNaeQPU8a', '2025-07-15', 'Day 2', '18:06', 'Test2'),
('IREC_np8imNTpmN', 'ITR_afH50ULmJg', '2025-07-14', 'Day 2', '12:05', 'Activity2'),
('IREC_RwQn1EkT6k', 'ITR_mbNaeQPU8a', '2025-07-14', 'Day 1', '18:05', 'Test1'),
('IREC_s4Eq3yEoPA', 'ITR_mbNaeQPU8a', '2025-07-16', 'Day 3', '18:07', 'Test3');

-- --------------------------------------------------------

--
-- Table structure for table `itinerary_t`
--

CREATE TABLE `itinerary_t` (
  `itr_ID` varchar(14) NOT NULL,
  `bkn_ID` varchar(14) NOT NULL,
  `usr_ID` varchar(14) NOT NULL,
  `usr_name` varchar(50) NOT NULL,
  `itr_title` varchar(100) NOT NULL,
  `itr_desc` varchar(1000) DEFAULT NULL,
  `itr_start_date` date NOT NULL,
  `itr_end_date` date NOT NULL,
  `itr_dest` varchar(100) NOT NULL,
  `itr_remark` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itinerary_t`
--

INSERT INTO `itinerary_t` (`itr_ID`, `bkn_ID`, `usr_ID`, `usr_name`, `itr_title`, `itr_desc`, `itr_start_date`, `itr_end_date`, `itr_dest`, `itr_remark`) VALUES
('ITR_8ujzZYNRCe', 'BKN_cJhAzxy0VD', 'TOR_8304218839', 'Seath Tan Ziren', 'My KL Itinerary', 'This is my KL itinerary', '2025-07-16', '2025-07-18', 'Kuala Lumpur, Federal Territory', 'itinerary please take a look'),
('ITR_afH50ULmJg', 'BKN_PXlABPe8FR', 'TOR_JGgZstigpL', 'Monique Dixon', 'My Kinabalu Itinerary', 'This is fun.', '2025-07-13', '2025-07-15', 'Kota Kinabalu, Sabah', 'Test'),
('ITR_mbNaeQPU8a', 'BKN_a2Bb3Cc4Dd', 'TOR_JGgZstigpL', 'Dr. Corey Mack MD', 'Batu Caves Itinerary', 'Batu Caves itinerary desc', '2025-07-14', '2025-07-15', 'Batu Caves, Selangor', 'Remark here');

-- --------------------------------------------------------

--
-- Table structure for table `manage_pkg_t`
--

CREATE TABLE `manage_pkg_t` (
  `usr_ID` varchar(14) NOT NULL,
  `pkg_ID` varchar(14) NOT NULL,
  `upd_date` date NOT NULL,
  `mng_note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_rec_t`
--

CREATE TABLE `payment_rec_t` (
  `pyt_ID` varchar(14) NOT NULL,
  `bil_ID` varchar(14) NOT NULL,
  `usr_ID` varchar(14) NOT NULL,
  `usr_name` varchar(50) NOT NULL,
  `tot_amount` decimal(10,2) NOT NULL,
  `pd_amount` decimal(10,2) NOT NULL,
  `pyt_option` varchar(20) NOT NULL,
  `plt_name` varchar(50) NOT NULL,
  `POP_img_name` varchar(100) NOT NULL,
  `pyt_date` date NOT NULL,
  `pyt_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_rec_t`
--

INSERT INTO `payment_rec_t` (`pyt_ID`, `bil_ID`, `usr_ID`, `usr_name`, `tot_amount`, `pd_amount`, `pyt_option`, `plt_name`, `POP_img_name`, `pyt_date`, `pyt_status`) VALUES
('PYT_58s2JflHtb', 'BIL_0000000001', 'TOR_JGgZstigpL', 'Monique Dixon', 104.00, 104.00, 'E-wallet', 'Touch n Go', 'receipt_PYT_58s2JflHtb.png', '2025-07-13', 'Complete'),
('PYT_5erjuJBbJU', 'BIL_ovrTB0nGW9', 'TOR_JGgZstigpL', 'Monique Dixon', 124.00, 124.00, 'Online banking', 'AmBank', 'proof.png', '2025-07-15', 'Complete'),
('PYT_e0qTcMWX8m', 'BIL_5L17UuhCF3', 'TOR_8304218839', 'Seath Tan Ziren', 277.48, 277.48, 'Online Banking', 'Public Bank Internet Banking', 'receipt_PYT_e0qTcMWX8m.png', '2025-07-15', 'Complete'),
('PYT_k0maeNlTT9', 'BIL_0000000001', 'TOR_JGgZstigpL', 'Monique Dixon', 103.00, 103.00, 'Debit Card', 'Maybank Debit', '', '2025-07-15', 'Pending'),
('PYT_VcJspemoYF', 'BIL_ovrTB0nGW9', 'TOR_JGgZstigpL', 'Monique Dixon', 124.00, 124.00, 'E-wallet', 'Touch n\' Go', 'proof.png', '2025-07-15', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `pkg_item_list_t`
--

CREATE TABLE `pkg_item_list_t` (
  `pkg_item_ID` varchar(15) NOT NULL,
  `pkg_ID` varchar(14) NOT NULL,
  `pkg_day` varchar(10) NOT NULL,
  `pkg_date` date NOT NULL,
  `pkg_act` varchar(255) NOT NULL,
  `pkg_act_seqNo` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pkg_item_list_t`
--

INSERT INTO `pkg_item_list_t` (`pkg_item_ID`, `pkg_ID`, `pkg_day`, `pkg_date`, `pkg_act`, `pkg_act_seqNo`) VALUES
('PKGP_BCc0Dd1E2', 'PKG_BCa2025stU', 'Day 1', '2025-08-16', 'Lunch at local Indian restaurant', 4),
('PKGP_BCf3Gg4H5', 'PKG_BCa2025stU', 'Day 1', '2025-08-16', 'Visit Rama Cave and return to KL', 5),
('PKGP_BCu1Vv2W3', 'PKG_BCa2025stU', 'Day 1', '2025-08-16', 'Morning pickup from KL hotels', 1),
('PKGP_BCx4Yy5Z6', 'PKG_BCa2025stU', 'Day 1', '2025-08-16', 'Climb 272 steps to temple caves', 2),
('PKGP_BCz7Aa8B9', 'PKG_BCa2025stU', 'Day 1', '2025-08-16', 'Explore cathedral and art caves', 3),
('PKGP_BNc7Dd8E9', 'PKG_BNo2025sdE', 'Day 4', '2026-09-24', 'Teluk Paku trail and beach', 1),
('PKGP_BNf0Gg1H2', 'PKG_BNo2025sdE', 'Day 4', '2026-09-24', 'Night jungle walk', 2),
('PKGP_BNi3Jj4K5', 'PKG_BNo2025sdE', 'Day 5', '2026-09-25', 'Final morning wildlife spotting', 1),
('PKGP_BNi6Jj7K8', 'PKG_BNo2025sdE', 'Day 1', '2026-09-21', 'Boat transfer from Kuching to Bako', 1),
('PKGP_BNl6Mm7N8', 'PKG_BNo2025sdE', 'Day 5', '2026-09-25', 'Boat transfer back to Kuching', 2),
('PKGP_BNl9Mm0N1', 'PKG_BNo2025sdE', 'Day 1', '2026-09-21', 'Check-in at park chalet', 2),
('PKGP_BNo2Pp3Q4', 'PKG_BNo2025sdE', 'Day 1', '2026-09-21', 'Evening wildlife spotting', 3),
('PKGP_BNr5Ss6T7', 'PKG_BNo2025sdE', 'Day 2', '2026-09-22', 'Tanjung Sapi trail hike', 1),
('PKGP_BNu8Vv9W0', 'PKG_BNo2025sdE', 'Day 2', '2026-09-22', 'Beach relaxation at Teluk Pandan', 2),
('PKGP_BNx1Yy2Z3', 'PKG_BNo2025sdE', 'Day 3', '2026-09-23', 'Lintang trail jungle trek', 1),
('PKGP_BNz4Aa5B6', 'PKG_BNo2025sdE', 'Day 3', '2026-09-23', 'Proboscis monkey observation', 2),
('PKGP_CHc0Dd1E2', 'PKG_CHt2025tzA', 'Day 1', '2026-07-07', 'Drive from KL to Cameron Highlands', 1),
('PKGP_CHc7Dd8E9', 'PKG_CHt2025tzA', 'Day 4', '2026-07-10', 'Return drive to KL', 2),
('PKGP_CHf3Gg4H5', 'PKG_CHt2025tzA', 'Day 1', '2026-07-07', 'Check-in at tea plantation hotel', 2),
('PKGP_CHi6Jj7K8', 'PKG_CHt2025tzA', 'Day 1', '2026-07-07', 'Sunset at Boh Tea Plantation', 3),
('PKGP_CHl9Mm0N1', 'PKG_CHt2025tzA', 'Day 2', '2026-07-08', 'Mossy Forest boardwalk tour', 1),
('PKGP_CHo2Pp3Q4', 'PKG_CHt2025tzA', 'Day 2', '2026-07-08', 'Visit Butterfly Garden', 2),
('PKGP_CHr5Ss6T7', 'PKG_CHt2025tzA', 'Day 2', '2026-07-08', 'Strawberry farm visit', 3),
('PKGP_CHu8Vv9W0', 'PKG_CHt2025tzA', 'Day 3', '2026-07-09', 'Rose Valley tour', 1),
('PKGP_CHx1Yy2Z3', 'PKG_CHt2025tzA', 'Day 3', '2026-07-09', 'Time Tunnel Museum visit', 2),
('PKGP_CHz4Aa5B6', 'PKG_CHt2025tzA', 'Day 4', '2026-07-10', 'Morning tea factory tour', 1),
('PKGP_GHf3Gg4H5', 'PKG_GHy2025tbC', 'Day 1', '2026-08-14', 'Cable car ride up to Genting', 1),
('PKGP_GHi6Jj7K8', 'PKG_GHy2025tbC', 'Day 1', '2026-08-14', 'Check-in at First World Hotel', 2),
('PKGP_GHl9Mm0N1', 'PKG_GHy2025tbC', 'Day 1', '2026-08-14', 'Evening at indoor theme park', 3),
('PKGP_GHo2Pp3Q4', 'PKG_GHy2025tbC', 'Day 2', '2026-08-15', 'Full day at outdoor park', 1),
('PKGP_GHr5Ss6T7', 'PKG_GHy2025tbC', 'Day 2', '2026-08-15', 'Casino entertainment', 2),
('PKGP_GHu8Vv9W0', 'PKG_GHy2025tbC', 'Day 3', '2026-08-16', 'Shopping at premium outlets', 1),
('PKGP_GHx1Yy2Z3', 'PKG_GHy2025tbC', 'Day 3', '2026-08-16', 'Cable car descent and departure', 2),
('PKGP_GMc0Dd1E2', 'PKG_GMc2025qxY', 'Day 1', '2026-06-16', 'Check-in at Mulu Marriott Resort', 2),
('PKGP_GMc7Dd8E9', 'PKG_GMc2025qxY', 'Day 6', '2026-06-21', 'Cultural show at longhouse', 2),
('PKGP_GMf0Gg1H2', 'PKG_GMc2025qxY', 'Day 7', '2026-06-22', 'Final cave exploration', 1),
('PKGP_GMf3Gg4H5', 'PKG_GMc2025qxY', 'Day 1', '2026-06-16', 'Evening bat exodus observation', 3),
('PKGP_GMi3Jj4K5', 'PKG_GMc2025qxY', 'Day 7', '2026-06-22', 'Transfer to airport for departure', 2),
('PKGP_GMi6Jj7K8', 'PKG_GMc2025qxY', 'Day 2', '2026-06-17', 'Deer Cave and Lang Cave exploration', 1),
('PKGP_GMl9Mm0N1', 'PKG_GMc2025qxY', 'Day 2', '2026-06-17', 'Visit Clearwater Cave', 2),
('PKGP_GMo2Pp3Q4', 'PKG_GMc2025qxY', 'Day 3', '2026-06-18', 'Boat trip to Wind Cave', 1),
('PKGP_GMr5Ss6T7', 'PKG_GMc2025qxY', 'Day 3', '2026-06-18', 'Canopy skywalk experience', 2),
('PKGP_GMu8Vv9W0', 'PKG_GMc2025qxY', 'Day 4', '2026-06-19', 'Begin Pinnacles trek to Camp 5', 1),
('PKGP_GMx1Yy2Z3', 'PKG_GMc2025qxY', 'Day 5', '2026-06-20', 'Pinnacles summit climb', 1),
('PKGP_GMz4Aa5B6', 'PKG_GMc2025qxY', 'Day 6', '2026-06-21', 'Return trek to park HQ', 1),
('PKGP_GMz7Aa8B9', 'PKG_GMc2025qxY', 'Day 1', '2026-06-16', 'Flight to Mulu Airport', 1),
('PKGP_GT4t5U6v7', 'PKG_GTd2025tcD', 'Day 1', '2025-09-22', 'Arrival at Penang International Airport', 1),
('PKGP_GT8wX9yZ0', 'PKG_GTd2025tcD', 'Day 1', '2025-09-22', 'Check-in at heritage hotel', 2),
('PKGP_GTa1Bc2D3', 'PKG_GTd2025tcD', 'Day 1', '2025-09-22', 'Evening street food tour', 3),
('PKGP_GTb2Cc3D4', 'PKG_GTd2025tcD', 'Day 4', '2025-09-25', 'Transfer to airport for departure', 2),
('PKGP_GTe4Fg5H6', 'PKG_GTd2025tcD', 'Day 2', '2025-09-23', 'Heritage walk through UNESCO zone', 1),
('PKGP_GTi7Jk8L9', 'PKG_GTd2025tcD', 'Day 2', '2025-09-23', 'Visit Khoo Kongsi clan house', 2),
('PKGP_GTm0No1P2', 'PKG_GTd2025tcD', 'Day 2', '2025-09-23', 'Street art photography session', 3),
('PKGP_GTq3Rs4T5', 'PKG_GTd2025tcD', 'Day 3', '2025-09-24', 'Excursion to Penang Hill', 1),
('PKGP_GTu6Vw7X8', 'PKG_GTd2025tcD', 'Day 3', '2025-09-24', 'Visit Kek Lok Si Temple', 2),
('PKGP_GTy9Zz0A1', 'PKG_GTd2025tcD', 'Day 4', '2025-09-25', 'Visit Tropical Spice Garden', 1),
('PKGP_IPc3Dd4E5', 'PKG_IPd2025ujK', 'Day 3', '2025-12-14', 'Visit Lost World of Tambun', 1),
('PKGP_IPf6Gg7H8', 'PKG_IPd2025ujK', 'Day 3', '2025-12-14', 'Sampling Ipoh white coffee', 2),
('PKGP_IPi9Jj0K1', 'PKG_IPd2025ujK', 'Day 4', '2025-12-15', 'Visit Gua Tempurung', 1),
('PKGP_IPj8Kl9M0', 'PKG_IPd2025ujK', 'Day 1', '2025-12-12', 'Arrival at Ipoh Railway Station', 1),
('PKGP_IPl2Mm3N4', 'PKG_IPd2025ujK', 'Day 4', '2025-12-15', 'Transfer to station for departure', 2),
('PKGP_IPn1Op2Q3', 'PKG_IPd2025ujK', 'Day 1', '2025-12-12', 'Check-in at boutique hotel', 2),
('PKGP_IPr4St5U6', 'PKG_IPd2025ujK', 'Day 1', '2025-12-12', 'Evening food tour at Concubine Lane', 3),
('PKGP_IPv7Wx8Y9', 'PKG_IPd2025ujK', 'Day 2', '2025-12-13', 'Visit Kellie\'s Castle', 1),
('PKGP_IPz0Aa1B2', 'PKG_IPd2025ujK', 'Day 2', '2025-12-13', 'Explore Perak Tong Cave Temple', 2),
('PKGP_JBc3Dd4E5', 'PKG_JBq2025sgH', 'Day 3', '2025-11-07', 'Transfer to airport for departure', 2),
('PKGP_JBf5Gh6I7', 'PKG_JBq2025sgH', 'Day 1', '2025-11-05', 'Arrival at Senai International Airport', 1),
('PKGP_JBj8Kl9M0', 'PKG_JBq2025sgH', 'Day 1', '2025-11-05', 'Check-in at Legoland Hotel', 2),
('PKGP_JBn1Op2Q3', 'PKG_JBq2025sgH', 'Day 1', '2025-11-05', 'Evening at Legoland', 3),
('PKGP_JBr4St5U6', 'PKG_JBq2025sgH', 'Day 2', '2025-11-06', 'Full day at Legoland Malaysia', 1),
('PKGP_JBv7Wx8Y9', 'PKG_JBq2025sgH', 'Day 2', '2025-11-06', 'Visit Hello Kitty Town', 2),
('PKGP_JBz0Aa1B2', 'PKG_JBq2025sgH', 'Day 3', '2025-11-07', 'Shopping at Johor Premium Outlets', 1),
('PKGP_KCb2Cc3D4', 'PKG_KCb2025geF', 'Day 4', '2025-10-13', 'Visit Semenggoh Orangutan Centre', 1),
('PKGP_KCe4Fg5H6', 'PKG_KCb2025geF', 'Day 1', '2025-10-10', 'Arrival at Kuching International Airport', 1),
('PKGP_KCf5Gh6I7', 'PKG_KCb2025geF', 'Day 4', '2025-10-13', 'Traditional Iban longhouse visit', 2),
('PKGP_KCi7Jk8L9', 'PKG_KCb2025geF', 'Day 1', '2025-10-10', 'Check-in at riverside hotel', 2),
('PKGP_KCj8Kl9M0', 'PKG_KCb2025geF', 'Day 5', '2025-10-14', 'City tour including Cat Museum', 1),
('PKGP_KCm0No1P2', 'PKG_KCb2025geF', 'Day 1', '2025-10-10', 'Evening walk along Kuching Waterfront', 3),
('PKGP_KCn1Op2Q3', 'PKG_KCb2025geF', 'Day 5', '2025-10-14', 'Sarawak laksa cooking class', 2),
('PKGP_KCq3Rs4T5', 'PKG_KCb2025geF', 'Day 2', '2025-10-11', 'Full day at Sarawak Cultural Village', 1),
('PKGP_KCr4St5U6', 'PKG_KCb2025geF', 'Day 6', '2025-10-15', 'Visit Sunday Market (if applicable)', 1),
('PKGP_KCu6Vw7X8', 'PKG_KCb2025geF', 'Day 3', '2025-10-12', 'Boat trip to Bako National Park', 1),
('PKGP_KCv7Wx8Y9', 'PKG_KCb2025geF', 'Day 6', '2025-10-15', 'Transfer to airport for departure', 2),
('PKGP_KCy9Zz0A1', 'PKG_KCb2025geF', 'Day 3', '2025-10-12', 'Jungle trekking and wildlife spotting', 2),
('PKGP_KKc0Dd1E2', 'PKG_KKh2025tlM', 'Day 7', '2026-01-09', 'Visit Mari-Mari Cultural Village', 1),
('PKGP_KKc3Dd4E5', 'PKG_KKh2025tlM', 'Day 2', '2026-01-04', 'Overnight at mountain hut', 2),
('PKGP_KKc7Dd8E9', 'PKG_KKd2025snO', 'Day 1', '2027-02-16', 'Sunset at Tanjung Aru Beach', 3),
('PKGP_KKf0Gg1H2', 'PKG_KKd2025snO', 'Day 2', '2027-02-17', 'Mari Mari Cultural Village tour', 1),
('PKGP_KKf3Gg4H5', 'PKG_KKh2025tlM', 'Day 7', '2026-01-09', 'Transfer to airport for departure', 2),
('PKGP_KKf6Gg7H8', 'PKG_KKh2025tlM', 'Day 3', '2026-01-05', 'Summit climb to Low\'s Peak', 1),
('PKGP_KKi3Jj4K5', 'PKG_KKd2025snO', 'Day 2', '2027-02-17', 'City tour including Signal Hill', 2),
('PKGP_KKi9Jj0K1', 'PKG_KKh2025tlM', 'Day 3', '2026-01-05', 'Descend to Park HQ', 2),
('PKGP_KKl2Mm3N4', 'PKG_KKh2025tlM', 'Day 4', '2026-01-06', 'Recovery day at Poring Hot Springs', 1),
('PKGP_KKl6Mm7N8', 'PKG_KKd2025snO', 'Day 3', '2027-02-18', 'Island hopping to Tunku Abdul Rahman Park', 1),
('PKGP_KKn1Op2Q3', 'PKG_KKh2025tlM', 'Day 1', '2026-01-03', 'Arrival at Kota Kinabalu International Airport', 1),
('PKGP_KKo5Pp6Q7', 'PKG_KKh2025tlM', 'Day 4', '2026-01-06', 'Canopy walk experience', 2),
('PKGP_KKo9Pp0Q1', 'PKG_KKd2025snO', 'Day 3', '2027-02-18', 'Snorkeling at Manukan Island', 2),
('PKGP_KKr2Ss3T4', 'PKG_KKd2025snO', 'Day 4', '2027-02-19', 'Visit Lok Kawi Wildlife Park', 1),
('PKGP_KKr4St5U6', 'PKG_KKh2025tlM', 'Day 1', '2026-01-03', 'Transfer to Kinabalu Park headquarters', 2),
('PKGP_KKr8Ss9T0', 'PKG_KKh2025tlM', 'Day 5', '2026-01-07', 'Transfer to city for island hopping', 1),
('PKGP_KKu1Vv2W3', 'PKG_KKh2025tlM', 'Day 5', '2026-01-07', 'Visit Tunku Abdul Rahman Marine Park', 2),
('PKGP_KKu5Vv6W7', 'PKG_KKd2025snO', 'Day 4', '2027-02-19', 'Handicraft market shopping', 2),
('PKGP_KKv7Wx8Y9', 'PKG_KKh2025tlM', 'Day 1', '2026-01-03', 'Evening nature briefing', 3),
('PKGP_KKx1Yy2Z3', 'PKG_KKd2025snO', 'Day 1', '2027-02-16', 'Arrival at Kota Kinabalu Airport', 1),
('PKGP_KKx4Yy5Z6', 'PKG_KKh2025tlM', 'Day 6', '2026-01-08', 'City tour including Signal Hill', 1),
('PKGP_KKx8Yy9Z0', 'PKG_KKd2025snO', 'Day 5', '2027-02-20', 'Free time for last-minute shopping', 1),
('PKGP_KKz0Aa1B2', 'PKG_KKh2025tlM', 'Day 2', '2026-01-04', 'Begin ascent to Laban Rata', 1),
('PKGP_KKz1Aa2B3', 'PKG_KKd2025snO', 'Day 5', '2027-02-20', 'Transfer to airport for departure', 2),
('PKGP_KKz4Aa5B6', 'PKG_KKd2025snO', 'Day 1', '2027-02-16', 'Check-in at waterfront hotel', 2),
('PKGP_KKz7Aa8B9', 'PKG_KKh2025tlM', 'Day 6', '2026-01-08', 'Sunset at Tanjung Aru Beach', 2),
('PKGP_KL1aB2c3D', 'PKG_KLr2025daB', 'Day 1', '2025-08-15', 'Arrival at KLIA Airport', 1),
('PKGP_KL3rS4t5U', 'PKG_KLr2025daB', 'Day 2', '2025-08-16', 'Visit Central Market for souvenirs', 2),
('PKGP_KL4eF5g6H', 'PKG_KLr2025daB', 'Day 1', '2025-08-15', 'Transfer to hotel in Bukit Bintang', 2),
('PKGP_KL6vW7x8Y', 'PKG_KLr2025daB', 'Day 3', '2025-08-17', 'Excursion to Batu Caves', 1),
('PKGP_KL7iJ8k9L', 'PKG_KLr2025daB', 'Day 1', '2025-08-15', 'Evening visit to Petronas Twin Towers', 3),
('PKGP_KL9zA0b1C', 'PKG_KLr2025daB', 'Day 3', '2025-08-17', 'Shopping at Pavilion Mall', 2),
('PKGP_KLd2Ef3G4', 'PKG_KLr2025daB', 'Day 4', '2025-08-18', 'Visit National Museum', 1),
('PKGP_KLh5Ij6K7', 'PKG_KLr2025daB', 'Day 4', '2025-08-18', 'Jalan Alor food street experience', 2),
('PKGP_KLl8Mn9O0', 'PKG_KLr2025daB', 'Day 5', '2025-08-19', 'Free time for last-minute shopping', 1),
('PKGP_KLmN1oP2Q', 'PKG_KLr2025daB', 'Day 2', '2025-08-16', 'Full day city tour including KL Tower', 1),
('PKGP_KLp1Qr2S3', 'PKG_KLr2025daB', 'Day 5', '2025-08-19', 'Transfer to airport for departure', 2),
('PKGP_KSc7Dd8E9', 'PKG_KSe2025fhI', 'Day 2', '2026-11-13', 'Return to KL', 2),
('PKGP_KSo2Pp3Q4', 'PKG_KSe2025fhI', 'Day 1', '2026-11-12', 'Drive from KL to Kuala Selangor', 1),
('PKGP_KSr5Ss6T7', 'PKG_KSe2025fhI', 'Day 1', '2026-11-12', 'Check-in at riverside chalet', 2),
('PKGP_KSu8Vv9W0', 'PKG_KSe2025fhI', 'Day 1', '2026-11-12', 'Bukit Melawati historical tour', 3),
('PKGP_KSx1Yy2Z3', 'PKG_KSe2025fhI', 'Day 1', '2026-11-12', 'Evening firefly boat tour', 4),
('PKGP_KSz4Aa5B6', 'PKG_KSe2025fhI', 'Day 2', '2026-11-13', 'Morning seafood market visit', 1),
('PKGP_KUc7Dd8E9', 'PKG_KUy2025fmL', 'Day 2', '2027-01-10', 'Cherating Beach relaxation', 1),
('PKGP_KUf0Gg1H2', 'PKG_KUy2025fmL', 'Day 2', '2027-01-10', 'Visit Turtle Sanctuary', 2),
('PKGP_KUi3Jj4K5', 'PKG_KUy2025fmL', 'Day 3', '2027-01-11', 'Excursion to Sungai Lembing', 1),
('PKGP_KUl6Mm7N8', 'PKG_KUy2025fmL', 'Day 3', '2027-01-11', 'Rainbow Waterfall hike', 2),
('PKGP_KUo9Pp0Q1', 'PKG_KUy2025fmL', 'Day 4', '2027-01-12', 'Morning beach walk', 1),
('PKGP_KUr2Ss3T4', 'PKG_KUy2025fmL', 'Day 4', '2027-01-12', 'Return drive to KL', 2),
('PKGP_KUu8Vv9W0', 'PKG_KUy2025fmL', 'Day 1', '2027-01-09', 'Drive from KL to Kuantan', 1),
('PKGP_KUx1Yy2Z3', 'PKG_KUy2025fmL', 'Day 1', '2027-01-09', 'Check-in at beach resort', 2),
('PKGP_KUz4Aa5B6', 'PKG_KUy2025fmL', 'Day 1', '2027-01-09', 'Sunset at Teluk Cempedak', 3),
('PKGP_LKc0Dd1E2', 'PKG_LKk2025dvW', 'Day 1', '2026-05-09', 'Sunset cruise', 3),
('PKGP_LKf3Gg4H5', 'PKG_LKk2025dvW', 'Day 2', '2026-05-10', 'Island hopping to Dayang Bunting', 1),
('PKGP_LKi6Jj7K8', 'PKG_LKk2025dvW', 'Day 2', '2026-05-10', 'Eagle feeding at Singa Besar', 2),
('PKGP_LKl9Mm0N1', 'PKG_LKk2025dvW', 'Day 3', '2026-05-11', 'Cable car ride to Sky Bridge', 1),
('PKGP_LKo2Pp3Q4', 'PKG_LKk2025dvW', 'Day 3', '2026-05-11', 'Visit Seven Wells Waterfall', 2),
('PKGP_LKr5Ss6T7', 'PKG_LKk2025dvW', 'Day 4', '2026-05-12', 'Mangrove kayaking tour', 1),
('PKGP_LKu8Vv9W0', 'PKG_LKk2025dvW', 'Day 4', '2026-05-12', 'Duty-free shopping in Kuah', 2),
('PKGP_LKx1Yy2Z3', 'PKG_LKk2025dvW', 'Day 5', '2026-05-13', 'Beach relaxation', 1),
('PKGP_LKx4Yy5Z6', 'PKG_LKk2025dvW', 'Day 1', '2026-05-09', 'Arrival at Langkawi Airport', 1),
('PKGP_LKz4Aa5B6', 'PKG_LKk2025dvW', 'Day 5', '2026-05-13', 'Transfer to airport for departure', 2),
('PKGP_LKz7Aa8B9', 'PKG_LKk2025dvW', 'Day 1', '2026-05-09', 'Check-in at Pantai Cenang resort', 2),
('PKGP_MCc7Dd8E9', 'PKG_MCu2025ffG', 'Day 3', '2026-10-07', 'Baba Nyonya Heritage Museum', 1),
('PKGP_MCf0Gg1H2', 'PKG_MCu2025ffG', 'Day 3', '2026-10-07', 'Departure from Malacca', 2),
('PKGP_MCl9Mm0N1', 'PKG_MCu2025ffG', 'Day 1', '2026-10-05', 'Arrival at Malacca Sentral', 1),
('PKGP_MCo2Pp3Q4', 'PKG_MCu2025ffG', 'Day 1', '2026-10-05', 'Check-in at heritage hotel', 2),
('PKGP_MCr5Ss6T7', 'PKG_MCu2025ffG', 'Day 1', '2026-10-05', 'Evening Jonker Walk night market', 3),
('PKGP_MCu8Vv9W0', 'PKG_MCu2025ffG', 'Day 2', '2026-10-06', 'A Famosa and Stadthuys tour', 1),
('PKGP_MCx1Yy2Z3', 'PKG_MCu2025ffG', 'Day 2', '2026-10-06', 'Cheng Hoon Teng Temple visit', 2),
('PKGP_MCz4Aa5B6', 'PKG_MCu2025ffG', 'Day 2', '2026-10-06', 'Melaka River cruise', 3),
('PKGP_PHc0Dd1E2', 'PKG_PHv2025drS', 'Day 2', '2026-04-05', 'Morning bird watching', 1),
('PKGP_PHf3Gg4H5', 'PKG_PHv2025drS', 'Day 2', '2026-04-05', 'Descent and departure', 2),
('PKGP_PHr8Ss9T0', 'PKG_PHv2025drS', 'Day 1', '2026-04-04', 'Arrival at Penang Hill Railway Station', 1),
('PKGP_PHu1Vv2W3', 'PKG_PHv2025drS', 'Day 1', '2026-04-04', 'Check-in at Bellevue Hotel', 2),
('PKGP_PHx4Yy5Z6', 'PKG_PHv2025drS', 'Day 1', '2026-04-04', 'Nature walk at The Habitat', 3),
('PKGP_PHz7Aa8B9', 'PKG_PHv2025drS', 'Day 1', '2026-04-04', 'Sunset viewing at Cliff Cafe', 4),
('PKGP_PIc7Dd8E9', 'PKG_PIt2025gjK', 'Day 2', '2026-12-20', 'Afternoon dive at Sugar Wreck', 2),
('PKGP_PIf0Gg1H2', 'PKG_PIt2025gjK', 'Day 3', '2026-12-21', 'Dive at T3 and Shark Point', 1),
('PKGP_PIi3Jj4K5', 'PKG_PIt2025gjK', 'Day 3', '2026-12-21', 'Beach relaxation at Long Beach', 2),
('PKGP_PIl6Mm7N8', 'PKG_PIt2025gjK', 'Day 4', '2026-12-22', 'Island hopping to Lang Tengah', 1),
('PKGP_PIo9Pp0Q1', 'PKG_PIt2025gjK', 'Day 4', '2026-12-22', 'Night dive experience', 2),
('PKGP_PIr2Ss3T4', 'PKG_PIt2025gjK', 'Day 5', '2026-12-23', 'Dive at Terumbu Tiga', 1),
('PKGP_PIr5Ss6T7', 'PKG_PIt2025gjK', 'Day 1', '2026-12-19', 'Flight to Kota Bharu', 1),
('PKGP_PIu5Vv6W7', 'PKG_PIt2025gjK', 'Day 5', '2026-12-23', 'Turtle spotting session', 2),
('PKGP_PIu8Vv9W0', 'PKG_PIt2025gjK', 'Day 1', '2026-12-19', 'Boat transfer to Perhentian Besar', 2),
('PKGP_PIx1Yy2Z3', 'PKG_PIt2025gjK', 'Day 1', '2026-12-19', 'Resort check-in and dive briefing', 3),
('PKGP_PIx8Yy9Z0', 'PKG_PIt2025gjK', 'Day 6', '2026-12-24', 'Final morning snorkeling', 1),
('PKGP_PIz1Aa2B3', 'PKG_PIt2025gjK', 'Day 6', '2026-12-24', 'Boat transfer and departure', 2),
('PKGP_PIz4Aa5B6', 'PKG_PIt2025gjK', 'Day 2', '2026-12-20', 'Morning dive at Tokong Laut', 1),
('PKGP_RDc0Dd1E2', 'PKG_RDa2025jnO', 'Day 4', '2026-02-17', 'Free day for water sports', 1),
('PKGP_RDf3Gg4H5', 'PKG_RDa2025jnO', 'Day 4', '2026-02-17', 'Sunset beach walk', 2),
('PKGP_RDi6Jj7K8', 'PKG_RDa2025jnO', 'Day 5', '2026-02-18', 'Final morning swim', 1),
('PKGP_RDi9Jj0K1', 'PKG_RDa2025jnO', 'Day 1', '2026-02-14', 'Flight to Kuala Terengganu', 1),
('PKGP_RDl2Mm3N4', 'PKG_RDa2025jnO', 'Day 1', '2026-02-14', 'Boat transfer to Redang Island', 2),
('PKGP_RDl9Mm0N1', 'PKG_RDa2025jnO', 'Day 5', '2026-02-18', 'Boat transfer and departure', 2),
('PKGP_RDo5Pp6Q7', 'PKG_RDa2025jnO', 'Day 1', '2026-02-14', 'Resort check-in and orientation', 3),
('PKGP_RDr8Ss9T0', 'PKG_RDa2025jnO', 'Day 2', '2026-02-15', 'Morning snorkeling at Marine Park', 1),
('PKGP_RDu1Vv2W3', 'PKG_RDa2025jnO', 'Day 2', '2026-02-15', 'Afternoon beach relaxation', 2),
('PKGP_RDx4Yy5Z6', 'PKG_RDa2025jnO', 'Day 3', '2026-02-16', 'Island hopping tour', 1),
('PKGP_RDz7Aa8B9', 'PKG_RDa2025jnO', 'Day 3', '2026-02-16', 'Turtle spotting activity', 2),
('PKGP_TMc0Dd1E2', 'PKG_TMf2025qpQ', 'Day 3', '2026-03-23', 'Visit Juara Turtle Project', 1),
('PKGP_TMf3Gg4H5', 'PKG_TMf2025qpQ', 'Day 3', '2026-03-23', 'Waterfall trek to Mukut', 2),
('PKGP_TMi6Jj7K8', 'PKG_TMf2025qpQ', 'Day 4', '2026-03-24', 'Final beach relaxation', 1),
('PKGP_TMl9Mm0N1', 'PKG_TMf2025qpQ', 'Day 4', '2026-03-24', 'Boat transfer to Mersing', 2),
('PKGP_TMo5Pp6Q7', 'PKG_TMf2025qpQ', 'Day 1', '2026-03-21', 'Flight to Tioman Airport', 1),
('PKGP_TMr8Ss9T0', 'PKG_TMf2025qpQ', 'Day 1', '2026-03-21', 'Resort check-in at Tekek village', 2),
('PKGP_TMu1Vv2W3', 'PKG_TMf2025qpQ', 'Day 1', '2026-03-21', 'Introductory dive session', 3),
('PKGP_TMx4Yy5Z6', 'PKG_TMf2025qpQ', 'Day 2', '2026-03-22', 'Full day diving at Renggis Island', 1),
('PKGP_TMz7Aa8B9', 'PKG_TMf2025qpQ', 'Day 2', '2026-03-22', 'Evening jungle walk', 2);

-- --------------------------------------------------------

--
-- Table structure for table `receipt_rec_t`
--

CREATE TABLE `receipt_rec_t` (
  `rcp_ID` varchar(14) NOT NULL,
  `bil_ID` varchar(14) NOT NULL,
  `pyt_ID` varchar(14) NOT NULL,
  `rcp_date` date NOT NULL,
  `usr_ID` varchar(14) NOT NULL,
  `usr_name` varchar(50) NOT NULL,
  `usr_email` varchar(50) NOT NULL,
  `sbt_amount` decimal(10,2) NOT NULL,
  `svc_charge` decimal(10,2) NOT NULL,
  `add_charge` decimal(10,2) DEFAULT NULL,
  `tot_amount` decimal(10,2) NOT NULL,
  `pd_amount` decimal(10,2) NOT NULL,
  `pyt_option` varchar(20) NOT NULL,
  `plt_name` varchar(50) NOT NULL,
  `pyt_date` date NOT NULL,
  `rcp_remark` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipt_rec_t`
--

INSERT INTO `receipt_rec_t` (`rcp_ID`, `bil_ID`, `pyt_ID`, `rcp_date`, `usr_ID`, `usr_name`, `usr_email`, `sbt_amount`, `svc_charge`, `add_charge`, `tot_amount`, `pd_amount`, `pyt_option`, `plt_name`, `pyt_date`, `rcp_remark`) VALUES
('RCP_0295cd6d5a', 'BIL_0000000001', 'PYT_58s2JflHtb', '2025-07-14', 'TOR_JGgZstigpL', 'Monique Dixon', 'moniquedixon@gmail.com', 100.00, 2.00, 2.00, 104.00, 104.00, 'E-wallet', 'Touch n Go', '2025-07-13', 'Test remark'),
('RCP_4d86687370', 'BIL_5L17UuhCF3', 'PYT_e0qTcMWX8m', '2025-07-15', 'TOR_8304218839', 'Seath Tan Ziren', 'seath123@gmail.com', 270.00, 5.00, 2.48, 277.48, 277.48, 'Online Banking', 'Public Bank Internet Banking', '2025-07-15', 'This is generated on 15/7/2025.'),
('RCP_Hegjdv7Nsy', 'BIL_0000000001', 'PYT_58s2JflHtb', '2025-07-14', 'TOR_JGgZstigpL', 'Monique Dixon', 'moniquedixon@gmail.com', 104.00, 0.00, 0.00, 104.00, 104.00, 'E-wallet', 'Touch n Go', '2025-07-13', 'test again here2'),
('RCP_iEeP1vU3aZ', 'BIL_0000000001', 'PYT_58s2JflHtb', '2025-07-14', 'TOR_JGgZstigpL', 'Monique Dixon', 'moniquedixon@gmail.com', 104.00, 0.00, 0.00, 104.00, 104.00, 'E-wallet', 'Touch n Go', '2025-07-13', 'Test remark');

-- --------------------------------------------------------

--
-- Table structure for table `scd_timeslot_list_t`
--

CREATE TABLE `scd_timeslot_list_t` (
  `tsl_list_ID` varchar(14) NOT NULL,
  `scd_ID` varchar(14) NOT NULL,
  `tsl_date` date NOT NULL,
  `tsl_time` time NOT NULL,
  `tsl_day` varchar(9) NOT NULL,
  `tsl_transp` varchar(50) NOT NULL,
  `tsl_task` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_booking_t`
--

CREATE TABLE `tour_booking_t` (
  `bkn_ID` varchar(14) NOT NULL,
  `pkg_ID` varchar(14) NOT NULL,
  `pkg_dest` varchar(100) NOT NULL,
  `usr_ID` varchar(14) NOT NULL,
  `usr_doc_ID` varchar(20) NOT NULL,
  `usr_name` varchar(50) NOT NULL,
  `usr_email` varchar(50) NOT NULL,
  `usr_no_tel` varchar(20) NOT NULL,
  `bkn_title` varchar(100) NOT NULL,
  `bkn_desc` varchar(1000) DEFAULT NULL,
  `bkn_date` date NOT NULL,
  `num_pax` int(3) NOT NULL,
  `bkn_remark` varchar(100) DEFAULT NULL,
  `bkn_status` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_booking_t`
--

INSERT INTO `tour_booking_t` (`bkn_ID`, `pkg_ID`, `pkg_dest`, `usr_ID`, `usr_doc_ID`, `usr_name`, `usr_email`, `usr_no_tel`, `bkn_title`, `bkn_desc`, `bkn_date`, `num_pax`, `bkn_remark`, `bkn_status`) VALUES
('BKN_a2Bb3Cc4Dd', 'PKG_BCa2025stU', 'Batu Caves, Selangor', 'TOR_obFLvzoxke', '810319-41-3658', 'Dr. Corey Mack MD', 'dr.coreymackmd@gmail.com', '0182883858', 'Batu Caves Day Tripy', 'Try and see.', '2025-07-10', 3, 'Try and see.', 'Pending'),
('BKN_a5Bb6Cc7Dd', 'PKG_KSe2025fhI', 'Kuala Selangor, Selangor', 'TOR_wYbtrxLIAq', '060906-51-8498', 'Jason Lopez', 'jasonlopez@gmail.com', '0125360696', 'Fireflies Night Tour', 'Romantic evening for couple', '2025-07-11', 2, 'Anniversary surprise', 'Pending'),
('BKN_a8Bb9Cc1Dd', 'PKG_BCa2025stU', 'Batu Caves, Selangor', 'TOR_qeFRnAUpGa', 'A901907111', 'George Savage', 'georgesavage@gmail.com', '0140848087', 'Batu Caves Photography', 'Capturing Thaipusam festival', '2025-07-12', 2, 'Photography equipment', 'Pending'),
('BKN_aB1cD2eF3G', 'PKG_KLr2025daB', 'Kuala Lumpur, Federal Territory', 'TOR_aXkucTjcJl', 'A666964400', 'Christian Baker', 'christianbaker@gmail.com', '0167524981', 'KL City Exploration', 'Looking forward to exploring KL landmarks and trying local food', '2025-07-08', 2, 'Vegetarian meals required', 'Pending'),
('BKN_c3Dd4E5fG6', 'PKG_IPd2025ujK', 'Ipoh, Perak', 'TOR_HqvSLDzSMy', '831210-40-2229', 'Kenneth Lopez', 'kennethlopez@gmail.com', '0194591108', 'Ipoh Cave & Food Tour', 'Interested in Ipoh white coffee and cave temples', '2025-07-09', 2, 'Allergic to seafood', 'Pending'),
('BKN_c8Dd9Ee1Ff', 'PKG_JBq2025sgH', 'Johor Bahru, Johor', 'TOR_HqvSLDzSMy', '831210-40-2229', 'Kenneth Lopez', 'kennethlopez@gmail.com', '0194591108', 'Legoland Birthday Trip', 'Celebrating sons 8th birthday', '2025-07-12', 5, 'Birthday cake request', 'Pending'),
('BKN_cJhAzxy0VD', 'PKG_KLr2025daB', 'Kuala Lumpur, Federal Territory', 'TOR_8304218839', '051010140666', 'Seath Tan Ziren', 'seath123@gmail.com', '0123456788', 'My KL Booking', 'This is my KL booking', '2025-07-15', 3, '1 extra room for hotel.', 'Confirmed'),
('BKN_e5Ff6Gg7Hh', 'PKG_LKk2025dvW', 'Langkawi, Kedah', 'TOR_qeFRnAUpGa', 'A901907111', 'George Savage', 'georgesavage@gmail.com', '0140848087', 'Langkawi Island Hopping', 'Anniversary trip with my wife', '2025-07-14', 2, 'Romantic dinner arrangement', 'Pending'),
('BKN_g2Hh3Ii4Jj', 'PKG_IPd2025ujK', 'Ipoh, Perak', 'TOR_iegYMEMMpC', '690827-14-3096', 'Laura Williams', 'laurawilliams@gmail.com', '0177733472', 'Ipoh Cave Exploration', 'Photographing limestone caves', '2025-07-12', 1, 'Professional photographer', 'Pending'),
('BKN_h7Ii8J9kL0', 'PKG_KKh2025tlM', 'Kota Kinabalu, Sabah', 'TOR_iegYMEMMpC', '690827-14-3096', 'Laura Williams', 'laurawilliams@gmail.com', '0177733472', 'Mount Kinabalu Climb', 'Preparing for the mountain challenge!', '2025-07-09', 1, 'Need hiking gear rental', 'Pending'),
('BKN_hI4jK5lM6N', 'PKG_GTd2025tcD', 'George Town, Penang', 'TOR_BQSmIEhHuj', 'A120324723', 'Laura Oconnell', 'lauraoconnell@gmail.com', '0195323553', 'Penang Heritage Trip', 'Excited to experience Penang street art and heritage sites', '2025-07-08', 3, 'Need baby cot', 'Pending'),
('BKN_i2Jj3Kk4Ll', 'PKG_KUy2025fmL', 'Kuantan, Pahang', 'TOR_ytjqxLZeIn', '920818-54-3515', 'Alexis Smith MD', 'alexissmithmd@gmail.com', '0153462887', 'East Coast Beach Break', 'Relaxing after medical conference', '2025-07-11', 1, 'Late checkout needed', 'Pending'),
('BKN_i8Jj9Kk1Ll', 'PKG_GMc2025qxY', 'Gunung Mulu National Park, Sarawak', 'TOR_qkYgNKMKuZ', '821231-31-9752', 'Tina Glass', 'tinaglass@gmail.com', '0123393808', 'Mulu Caves Expedition', 'Nature photography enthusiast', '2025-07-10', 1, 'Solo traveler', 'Pending'),
('BKN_k5Ll6Mm7Nn', 'PKG_KKh2025tlM', 'Kota Kinabalu, Sabah', 'TOR_JGgZstigpL', 'A027251607', 'Monique Dixon', 'moniquedixon@gmail.com', '0155517301', 'Kinabalu Summit Challenge', 'Training for mountain climb', '2025-07-12', 2, 'Need altitude sickness meds', 'Pending'),
('BKN_m1Nn2O3pQ4', 'PKG_RDa2025jnO', 'Pulau Redang, Terengganu', 'TOR_JGgZstigpL', 'A027251607', 'Monique Dixon', 'moniquedixon@gmail.com', '0155517301', 'Redang Island Getaway', 'Looking for relaxing beach vacation', '2025-07-09', 2, 'Honeymoon trip', 'Pending'),
('BKN_m2Mm3Nn4Oo', 'PKG_CHt2025tzA', 'Cameron Highlands, Pahang', 'TOR_QZiBBcApYt', '891017-80-9135', 'Emily Tate DVM', 'emilytatedvm@gmail.com', '0102138519', 'Camerons Tea Tour', 'Cool weather break from city heat', '2025-07-10', 4, 'Family with 2 children', 'Pending'),
('BKN_m5Nn6Oo7Pp', 'PKG_KKd2025snO', 'Kota Kinabalu, Sabah', 'TOR_zOwhRfBdVS', 'A891092157', 'Christian Cantrell', 'christiancantrell@gmail.com', '0176696174', 'KK Combo Adventure', 'Combining nature and culture in Sabah', '2025-07-11', 2, 'Vegetarian meals required', 'Pending'),
('BKN_o8Pp9Qq1Rr', 'PKG_RDa2025jnO', 'Pulau Redang, Terengganu', 'TOR_kqCVcrHUCm', 'A498459232', 'Mr. William Walters MD', 'mr.williamwaltersmd@gmail.com', '0177292347', 'Redang Marine Life', 'Snorkeling and marine biology interest', '2025-07-12', 3, 'Marine biologist in group', 'Pending'),
('BKN_oP7qR8sT9U', 'PKG_KCb2025geF', 'Kuching, Sarawak', 'TOR_ehUWoREjmo', '930831-99-8472', 'Brian Chen', 'brianchen@gmail.com', '0173678735', 'Borneo Cultural Adventure', 'Cannot wait to see orangutans and experience Sarawak culture', '2025-07-08', 4, NULL, 'Pending'),
('BKN_p5Pp6Qq7Rr', 'PKG_GHy2025tbC', 'Genting Highlands, Pahang', 'TOR_tDTSQUxvVK', '990413-37-2001', 'Jonathan Williams', 'jonathanwilliams@gmail.com', '0179804098', 'Genting Weekend Getaway', 'Fun weekend with friends', '2025-07-10', 5, 'Group booking', 'Pending'),
('BKN_PXlABPe8FR', 'PKG_KKh2025tlM', 'Kota Kinabalu, Sabah', 'TOR_JGgZstigpL', 'A027251607', 'Monique Dixon', 'moniquedixon@gmail.com', '0155517301', 'My Kinabalu Booking', 'This is fun.', '2025-07-13', 3, 'Remarks', 'Pending'),
('BKN_q8Rr9Ss1Tt', 'PKG_KLr2025daB', 'Kuala Lumpur, Federal Territory', 'TOR_aXkucTjcJl', 'A666964400', 'Christian Baker', 'christianbaker@gmail.com', '0167524981', 'KL Extended Stay', 'Second visit to explore more of KL', '2025-07-11', 3, 'Connecting flight to Bali', 'Pending'),
('BKN_r5Ss6T7uV8', 'PKG_TMf2025qpQ', 'Pulau Tioman, Pahang', 'TOR_kqCVcrHUCm', 'A498459232', 'Mr. William Walters MD', 'mr.williamwaltersmd@gmail.com', '0177292347', 'Tioman Diving Package', 'Advanced diver looking for good dive spots', '2025-07-09', 1, 'Bringing own equipment', 'Pending'),
('BKN_s2Tt3Uu4Vv', 'PKG_TMf2025qpQ', 'Pulau Tioman, Pahang', 'TOR_mIjoznqflO', 'A900999212', 'Mikayla Rubio', 'mikaylarubio@gmail.com', '0153485042', 'Tioman Advanced Diving', 'Looking for challenging dive sites', '2025-07-12', 2, 'Night dive requested', 'Pending'),
('BKN_s8Tt9Uu1Vv', 'PKG_BNo2025sdE', 'Bako National Park, Sarawak', 'TOR_uGxtwdHyFT', '040511-28-2537', 'Richard Campbell', 'richardcampbell@gmail.com', '0178491701', 'Bako Wildlife Adventure', 'Wildlife photography expedition', '2025-07-10', 2, 'Early morning hikes preferred', 'Pending'),
('BKN_u2Vv3Ww4Xx', 'PKG_GTd2025tcD', 'George Town, Penang', 'TOR_ehUWoREjmo', '930831-99-8472', 'Brian Chen', 'brianchen@gmail.com', '0173678735', 'Penang Food Trail', 'Focus on famous Penang street food', '2025-07-12', 2, 'Food allergies: nuts', 'Pending'),
('BKN_vW0xY1zA2B', 'PKG_JBq2025sgH', 'Johor Bahru, Johor', 'TOR_esxqIPVJZT', 'A874238332', 'Jennifer Becker', 'jenniferbecker@gmail.com', '0153509229', 'Family Fun at Legoland', 'Booking for family vacation with kids aged 5 and 7', '2025-07-08', 4, 'Early check-in requested', 'Pending'),
('BKN_w2Xx3Yy4Zz', 'PKG_MCu2025ffG', 'Malacca City, Melaka', 'TOR_WwtDbPCWDb', '010302-50-6669', 'Elizabeth Wood', 'elizabethwood@gmail.com', '0127929396', 'Historical Malacca Tour', 'History buff exploring heritage sites', '2025-07-11', 1, 'Solo female traveler', 'Pending'),
('BKN_w5Xx6Yy7Zz', 'PKG_PHv2025drS', 'Penang Hill, Penang', 'TOR_obFLvzoxke', '810319-41-3658', 'Dr. Corey Mack MD', 'dr.coreymackmd@gmail.com', '0182883858', 'Penang Hill Nature', 'Birdwatching holiday', '2025-07-12', 1, 'Bringing telescope', 'Pending'),
('BKN_w9Xx0Yy1Zz', 'PKG_PHv2025drS', 'Penang Hill, Penang', 'TOR_mIjoznqflO', 'A900999212', 'Mikayla Rubio', 'mikaylarubio@gmail.com', '0153485042', 'Penang Hill Retreat', 'Short escape from city life', '2025-07-09', 2, NULL, 'Pending'),
('BKN_y5Zz6Aa7Bb', 'PKG_KCb2025geF', 'Kuching, Sarawak', 'TOR_esxqIPVJZT', 'A874238332', 'Jennifer Becker', 'jenniferbecker@gmail.com', '0153509229', 'Sarawak Longhouse Experience', 'Cultural immersion with local tribes', '2025-07-12', 4, 'Family with teenagers', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tour_package_t`
--

CREATE TABLE `tour_package_t` (
  `pkg_ID` varchar(14) NOT NULL,
  `pkg_title` varchar(100) NOT NULL,
  `pkg_desc` longtext NOT NULL,
  `pkg_dest` varchar(100) NOT NULL,
  `trv_dura` varchar(50) NOT NULL,
  `trv_period` varchar(50) NOT NULL,
  `pkg_price` decimal(10,2) NOT NULL,
  `pkg_room` varchar(100) NOT NULL,
  `pkg_transp` varchar(100) NOT NULL,
  `pkg_act` varchar(500) NOT NULL,
  `pkg_perks` varchar(500) NOT NULL,
  `pkg_img` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_package_t`
--

INSERT INTO `tour_package_t` (`pkg_ID`, `pkg_title`, `pkg_desc`, `pkg_dest`, `trv_dura`, `trv_period`, `pkg_price`, `pkg_room`, `pkg_transp`, `pkg_act`, `pkg_perks`, `pkg_img`) VALUES
('PKG_BCa2025stU', '1D Batu Caves Day Trip', 'Half-day excursion to Malaysia\'s most famous Hindu temple complex.', 'Batu Caves, Selangor', '1 day', 'Every Saturday', 199.00, 'N/A', 'bus', 'Batu Caves temple visit, cultural experience', 'lunch included, guide service', 'batu_caves.jpg,batu_caves2.jpg,batu_caves3.jpg,batu_caves4.jpg,batu_caves5.jpg,batu_caves6.jpg'),
('PKG_BNo2025sdE', '5D4N Bako National Park Wildlife', 'Unique opportunity to see proboscis monkeys and diverse ecosystems.', 'Bako National Park, Sarawak', '5 days 4 nights', '21/09/2026 - 25/09/2026', 1999.00, 'park chalet', 'boat, bus', 'Jungle trekking, wildlife spotting, beach walks', 'full board meals, park entrance fees', 'bako_park.jpg,bako_park2.jpg,bako_park3.jpg,bako_park4.jpg,bako_park5.jpg,bako_park6.jpg'),
('PKG_CHt2025tzA', '4D3N Cameron Highlands Tea Tour', 'Cool highland retreat featuring tea plantations and strawberry farms.', 'Cameron Highlands, Pahang', '4 days 3 nights', '07/07/2026 - 10/07/2026', 1699.00, 'standard room, tea garden view', 'bus', 'BOH Tea Plantation, strawberry farm, mossy forest, butterfly garden', 'breakfast included, tea tasting session', 'cameron_highlands.jpg,cameron_highlands2.jpg,cameron_highlands3.jpg,cameron_highlands4.jpg,cameron_highlands5.jpg,cameron_highlands6.jpg'),
('PKG_GHy2025tbC', '3D2N Genting Highlands Resort', 'Entertainment and cool weather at Malaysia\'s premier hill resort.', 'Genting Highlands, Pahang', '3 days 2 nights', '14/08/2026 - 16/08/2026', 1499.00, 'standard room, theme park hotel', 'bus, cable car', 'Casino, indoor theme park, shopping, shows', 'breakfast included, one-day theme park pass', 'genting_highland.jpg,genting_highland2.jpg,genting_highland3.jpg,genting_highland4.jpg,genting_highland5.jpg,genting_highland6.jpg'),
('PKG_GMc2025qxY', '7D6N Gunung Mulu Adventure', 'For nature lovers to explore the spectacular caves and pinnacles of Mulu.', 'Gunung Mulu National Park, Sarawak', '7 days 6 nights', '16/06/2026 - 22/06/2026', 3499.00, 'jungle lodge, standard room', 'airplane, boat', 'Deer Cave, Clearwater Cave, Pinnacles trek, canopy walk', 'full board meals, park fees, local guide', 'gunung_mulu.jpg,gunung_mulu2.jpg,gunung_mulu3.jpg,gunung_mulu4.jpg,gunung_mulu5.jpg,gunung_mulu6.jpg'),
('PKG_GTd2025tcD', '4D3N George Town Heritage Tour', 'Immerse yourself in Penang\'s rich cultural heritage and famous street food scene.', 'George Town, Penang', '4 days 3 nights', '22/09/2025 - 25/09/2025', 1599.00, 'standard room, family room', 'bus, ferry', 'Street art tour, heritage walk, Kek Lok Si Temple, Penang Hill', 'breakfast included, free trishaw ride', 'george_town.png,george_town2.jpeg,george_town3.jpeg,george_town4.jpeg,george_town5.jpeg,george_town6.jpeg'),
('PKG_IPd2025ujK', '4D3N Ipoh Food & Cave Exploration', 'Gourmet journey through Ipoh\'s famous cuisine and stunning cave temples.', 'Ipoh, Perak', '4 days 3 nights', '12/12/2025 - 15/12/2025', 1399.00, 'standard room, boutique hotel', 'bus, train', 'Visit Kellie\'s Castle, Concubine Lane, Lost World of Tambun, cave temples', 'breakfast included, food tasting tour', 'ipoh.jpg,ipoh2.png,ipoh3.jpg,ipoh4.jpg,ipoh5.jpg,ipoh6.jpg'),
('PKG_JBq2025sgH', '3D2N Johor Bahru Family Fun', 'Family-friendly package featuring Legoland Malaysia and Hello Kitty Town.', 'Johor Bahru, Johor', '3 days 2 nights', '05/11/2025 - 07/11/2025', 1299.00, 'family room, theme park room', 'bus', 'Legoland Malaysia, Hello Kitty Town, Johor Premium Outlets', 'breakfast included, one-day park ticket', 'johor_bahru.jpg,johor_bahru2.jpg,johor_bahru3.jpg,legoland.jpg,johor_premium_outlets.png,johor_bahru6.jpg'),
('PKG_KCb2025geF', '6D5N Kuching Cultural Adventure', 'Discover Sarawak\'s indigenous culture and wildlife in this immersive Borneo experience.', 'Kuching, Sarawak', '6 days 5 nights', '10/10/2025 - 15/10/2025', 2499.00, 'standard room, jungle lodge', 'bus, boat', 'Visit Sarawak Cultural Village, Bako National Park, Semenggoh Orangutan Centre', 'breakfast and lunch included, cultural performance', 'kuching.jpeg,kuching2.jpeg,kuching3.jpg,kuching4.jpg,kuching5.jpg,kuching6.jpg'),
('PKG_KKd2025snO', '5D4N Kota Kinabalu Combo Tour', 'Combination of mountain and marine adventures in Sabah.', 'Kota Kinabalu, Sabah', '5 days 4 nights', '16/02/2027 - 20/02/2027', 2399.00, 'standard room, waterfront hotel', 'bus, boat, airplane', 'Mari Mari Cultural Village, Kota Kinabalu City Tour, island hopping', 'breakfast included, cultural show', 'kota_kinabalu.jpg,kota_kinabalu2.jpg,kota_kinabalu3.jpg,kota_kinabalu4.jpg,kota_kinabalu5.jpg,kota_kinabalu6.jpg'),
('PKG_KKh2025tlM', '7D6N Kota Kinabalu Nature Package', 'Explore Mount Kinabalu and marine parks in Sabah\'s adventure capital.', 'Kota Kinabalu, Sabah', '7 days 6 nights', '03/01/2026 - 09/01/2026', 2899.00, 'standard room, mountain lodge', 'bus, airplane, boat', 'Kinabalu Park, Tunku Abdul Rahman Marine Park, Poring Hot Springs', 'breakfast included, park entrance fees', 'kota_kinabalu7.jpg,kota_kinabalu8.jpg,kota_kinabalu9.jpg,kota_kinabalu10.jpg,kota_kinabalu11.jpg,kota_kinabalu12.jpg'),
('PKG_KLr2025daB', '5D4N Kuala Lumpur City Tour', 'Explore the vibrant capital of Malaysia with visits to iconic landmarks and delicious food tours.', 'Kuala Lumpur, Federal Territory', '5 days 4 nights', '15/08/2025 - 19/08/2025', 1899.00, 'standard room, deluxe room', 'bus, train', 'Visit KL Tower, Petronas Twin Towers, Batu Caves, shopping at Bukit Bintang', 'breakfast included, free city map, welcome drink', 'kuala_lumpur.jpeg,kuala_lumpur2.jpeg,bukit_bintang.jpg,batu_caves.jpg,zoo_negara.jpeg,dataran_merdeka.jpg'),
('PKG_KSe2025fhI', '2D1N Kuala Selangor Fireflies', 'Romantic getaway to see the magical fireflies along Selangor River.', 'Kuala Selangor, Selangor', '2 days 1 night', '12/11/2026 - 13/11/2026', 799.00, 'standard room, riverside chalet', 'bus, boat', 'Firefly watching, seafood dinner, Bukit Melawati', 'breakfast included, firefly boat ride', 'kuala_selangor.jpg,kuala_selangor2.jpg,kuala_selangor3.jpg,kuala_selangor4.jpg,kuala_selangor5.jpg,kuala_selangor6.jpg'),
('PKG_KUy2025fmL', '4D3N Kuantan Beach Relaxation', 'East coast beach holiday with cultural visits to nearby attractions.', 'Kuantan, Pahang', '4 days 3 nights', '09/01/2027 - 12/01/2027', 1799.00, 'beach resort room', 'bus', 'Cherating Beach, Turtle Sanctuary, Sungai Lembing', 'breakfast included, cultural performance', 'kuantan.jpg,kuantan2.jpg,kuantan3.jpg,kuantan4.jpg,kuantan5.jpg,kuantan6.jpg'),
('PKG_LKk2025dvW', '5D4N Langkawi Island Hopping', 'Explore Langkawi\'s stunning archipelago with cable car and island tours.', 'Langkawi, Kedah', '5 days 4 nights', '09/05/2026 - 13/05/2026', 2299.00, 'standard room, sea view room', 'boat, airplane', 'Island hopping, Langkawi Sky Bridge, mangrove tour, duty-free shopping', 'breakfast included, cable car ticket', 'langkawi.jpg,langkawi2.jpg,langkawi3.jpg,langkawi4.jpg,langkawi5.jpg,langkawi6.jpg'),
('PKG_MCu2025ffG', '3D2N Malacca Historical Journey', 'Step back in time in this UNESCO World Heritage city.', 'Malacca City, Melaka', '3 days 2 nights', '05/10/2026 - 07/10/2026', 1199.00, 'standard room, heritage hotel', 'bus', 'A Famosa, Stadthuys, Jonker Street, river cruise', 'breakfast included, museum tickets', 'malacca_city.jpg,malacca_city2.jpg,malacca_city3.jpg,malacca_city4.jpg,malacca_city5.jpg,malacca_city6.jpg'),
('PKG_PHv2025drS', '2D1N Penang Hill Nature Retreat', 'Short escape to cooler climates with breathtaking views of Penang.', 'Penang Hill, Penang', '2 days 1 night', '04/04/2026 - 05/04/2026', 899.00, 'hill resort room', 'train, bus', 'Penang Hill railway, nature walks, The Habitat', 'breakfast included, hill railway ticket', 'penang_hill.jpeg,penang_hill2.jpeg,penang_hill3.jpeg,penang_hill4.jpg,penang_hill5.jpg,penang_hill6.jpg'),
('PKG_PIt2025gjK', '6D5N Perhentian Islands Diving', 'Pristine islands with excellent diving and snorkeling opportunities.', 'Perhentian Islands, Terengganu', '6 days 5 nights', '19/12/2026 - 24/12/2026', 2599.00, 'beach hut, dive resort', 'boat, airplane', 'Scuba diving, snorkeling, turtle spotting, beach relaxation', 'full board meals, two dive sessions', 'perhentian_islands.jpg,perhentian_islands2.jpg,perhentian_islands3.jpg,perhentian_islands4.jpg,perhentian_islands5.jpg,perhentian_islands6.jpg'),
('PKG_RDa2025jnO', '5D4N Pulau Redang Beach Paradise', 'Relaxing beach getaway to one of Malaysia\'s most beautiful islands.', 'Pulau Redang, Terengganu', '5 days 4 nights', '14/02/2026 - 18/02/2026', 2199.00, 'beach chalet, water villa', 'boat, airplane', 'Snorkeling, beach relaxation, marine park visit', 'full board meals, snorkeling gear rental', 'pulau_redang.jpg,pulau_redang2.jpg,pulau_redang3.jpg,pulau_redang3.jpg,pulau_redang4.jpg,pulau_redang5.jpg,pulau_redang6.jpeg'),
('PKG_TMf2025qpQ', '4D3N Pulau Tioman Island Escape', 'Tropical island retreat with diving and jungle trekking opportunities.', 'Pulau Tioman, Pahang', '4 days 3 nights', '21/03/2026 - 24/03/2026', 1999.00, 'beachfront room, garden villa', 'boat, airplane', 'Diving, jungle trekking, waterfall visit, turtle sanctuary', 'breakfast and dinner included, one dive session', 'pulau_tioman.png,pulau_tioman2.jpeg,pulau_tioman3.jpg,pulau_tioman4.jpg,pulau_tioman5.jpg,pulau_tioman6.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `trip_schedule_t`
--

CREATE TABLE `trip_schedule_t` (
  `scd_ID` varchar(14) NOT NULL,
  `gud_ID` varchar(14) NOT NULL,
  `drv_ID` varchar(14) DEFAULT NULL,
  `itr_ID` varchar(14) DEFAULT NULL,
  `scd_title` varchar(100) NOT NULL,
  `scd_desc` varchar(1000) DEFAULT NULL,
  `scd_dura` varchar(50) NOT NULL,
  `scd_start_date` date NOT NULL,
  `scd_end_date` date NOT NULL,
  `scd_remark` varchar(100) DEFAULT NULL,
  `stf_ID` varchar(14) NOT NULL,
  `stf_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip_schedule_t`
--

INSERT INTO `trip_schedule_t` (`scd_ID`, `gud_ID`, `drv_ID`, `itr_ID`, `scd_title`, `scd_desc`, `scd_dura`, `scd_start_date`, `scd_end_date`, `scd_remark`, `stf_ID`, `stf_name`) VALUES
('SCD_bKNUrTwrwk', 'GUD_JkLmNoPqRs', 'DRV_HiJkLmNoPq', 'ITR_8ujzZYNRCe', '3 Days KL Trip Schedule', 'This is KL for 3 days', '3 days 2 nights', '2025-07-15', '2025-07-17', 'This is for tour guide and bus driver', 'GUD_JkLmNoPqRs', 'Chen Li Wei');

-- --------------------------------------------------------

--
-- Table structure for table `user_account_t`
--

CREATE TABLE `user_account_t` (
  `usr_ID` varchar(14) NOT NULL,
  `usr_role` varchar(12) NOT NULL,
  `usr_doc_ID` varchar(20) NOT NULL,
  `usr_name` varchar(50) NOT NULL,
  `usr_email` varchar(50) NOT NULL,
  `usr_no_tel` varchar(20) NOT NULL,
  `usr_gender` varchar(6) NOT NULL,
  `usr_country` varchar(50) NOT NULL,
  `usr_prof_pic` varchar(100) DEFAULT NULL,
  `usr_job_pos` varchar(50) DEFAULT NULL,
  `usr_dep` varchar(18) DEFAULT NULL,
  `usr_pswd` varchar(20) NOT NULL,
  `usr_status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_account_t`
--

INSERT INTO `user_account_t` (`usr_ID`, `usr_role`, `usr_doc_ID`, `usr_name`, `usr_email`, `usr_no_tel`, `usr_gender`, `usr_country`, `usr_prof_pic`, `usr_job_pos`, `usr_dep`, `usr_pswd`, `usr_status`) VALUES
('ADM_6vZZsoUvCo', 'Admin', '890123-14-6734', 'Ahmad bin Ismail', 'ahmad.ismail@example.com', '0123456789', 'Male', 'Malaysia', 'ahmad_ismail.png', 'Admin', 'Web support', 'Admin@1234!', 'Approved'),
('ADM_A0B1C2D3E4', 'Admin', '800809-14-8274', 'Wong Zi Sean', 'sean123@email.com', '0129837648', 'Male', 'Malaysia', NULL, 'Web Admin', 'Web Support', 'SEan123@!', 'Approved'),
('ADM_kLmN9oPqRs', 'Admin', 'A5678901234', 'Sarah Johnson', 'sarah.j@example.com', '0112345678', 'Female', 'United States', 'sarah_johnson.png', 'Database Admin', 'Web Support', 'S@rahDB2023!', 'Approved'),
('DRV_456AbCdEfG', 'Bus driver', 'A3456789012', 'Abdullah bin Sulaiman', 'abdullah.s@example.com', '0144567890', 'Male', 'Malaysia', 'abdullah_sulaiman.png', 'Tour Bus Driver', 'Tourism Management', 'Abdull@h123', 'Approved'),
('DRV_HiJkLmNoPq', 'Bus driver', '950910-14-9012', 'Muthu a/l Palani', 'muthu.p@example.com', '0155678901', 'Male', 'Malaysia', 'muthu_palani.png', 'Bus Driver', 'Tourism Management', 'MuthuP@lani1', 'Approved'),
('DRV_RsTuVwXyZ1', 'Bus driver', 'A2345678901', 'Ahmad Fauzi bin Ismail', 'ahmad.fauzi@example.com', '0166789012', 'Male', 'Malaysia', 'ahmad_fauzi.png', 'Driver', 'Tourism Management', 'F@uziDr1v3r', 'Approved'),
('DRV_xkCOSuAU1q', 'Bus driver', '860809-12-7890', 'Rajesh Kumar', 'rajesh.k@example.com', '0133456789', 'Male', 'Malaysia', 'rajesh_kumar.png', 'Senior Driver', 'Tourism Management', 'R@jeshKum4r', 'Approved'),
('GUD_JkLmNoPqRs', 'Tour guide', 'A4567890123', 'Chen Li Wei', 'chen.liwei@example.com', '0111234567', 'Male', 'Singapore', 'chen_li_wei.png', 'Tour Guide', 'Tourism Management', 'Ch3nL1w3i!', 'Approved'),
('GUD_TuVwXyZ123', 'Tour guide', '940708-10-3456', 'Siti Nurhaliza binti Omar', 'siti.nurhaliza@example.com', '0122345678', 'Female', 'Malaysia', 'siti_nurhaliza.png', 'Cultural Guide', 'Tourism Management', 'S1t1Nurh@liza', 'Approved'),
('GUD_X7SxnKA1Nk', 'Tour guide', 'A9876543210', 'David Wong', 'david.wong@example.com', '0189012345', 'Male', 'Malaysia', 'david_wong.png', 'Senior Tour Guide', 'Tourism Management', 'D@vidW0ng!', 'Approved'),
('GUD_ZaBcDeFgHi', 'Tour guide', '930506-08-1276', 'Aisyah binti Rahman', 'aisyah.r@example.com', '0190123456', 'Female', 'Malaysia', 'aisyah_rahman.png', 'Tour Guide', 'Tourism Management', 'A1syahR@hman', 'Approved'),
('STF_AbCdEfGhIj', 'Office staff', '850607-10-7823', 'Mohd Ali bin Abu', 'ali.mohd@example.com', '0145678901', 'Male', 'Malaysia', 'mohd_ali_abu.png', 'Finance Officer', 'Finance', 'Al1B4nKu!', 'Approved'),
('STF_K1L2M3N4O5', 'Office staff', 'A1234567890', 'Tan Wei Chen', 'weichen.tan@example.com', '0156789012', 'Male', 'Malaysia', 'tan_wei_chan.png', 'Customer Service', 'Customer Service', 'T@nW3iCh3n', 'Approved'),
('STF_P6Q7R8S9T0', 'Office staff', '920415-06-8912', 'Nurul Huda binti Kamal', 'nurul.huda@example.com', '0167890123', 'Female', 'Malaysia', 'nurul_huda_kamal.png', 'Tour Coordinator', 'Tourism Management', 'NurulHuda#1', 'Approved'),
('STF_U1V2W3X4Y5', 'Office staff', '880912-14-5634', 'Robert Smith', 'robert.smith@example.com', '0178901234', 'Male', 'United Kingdom', 'robert_smith.png', 'Marketing Executive', 'Tourism Management', 'R0b3rt$m1th', 'Approved'),
('STF_Uw35prhZNh', 'Office staff', '910304-08-4521', 'Lim Mei Ling', 'meiling.lim@example.com', '0134567890', 'Female', 'Malaysia', 'lim_mei_ling.png', 'Accountant', 'Finance', 'L1mM3i!ing', 'Approved'),
('STF_zLhMALDu4Y', 'Office staff', '010101140101', 'Joseph Gonzales', 'joseph123@gmail.com', '012345678', 'Male', 'Malaysia', 'joeseph_gonzalez.png', 'Office staff', 'Customer service', 'JosephGonz1234!', 'Approved'),
('TOR_8304218839', 'Tourist', '051010140666', 'Seath Tan Ziren', 'seath123@gmail.com', '0123456788', 'Male', 'Argentina', 'abdullah_sulaiman.png', NULL, NULL, 'Seath123!', 'Approved'),
('TOR_aXkucTjcJl', 'Tourist', 'A666964400', 'Christian Baker', 'christianbaker@gmail.com', '0167524981', 'Male', 'Russian Federation', 'christian_baker.png', NULL, NULL, 'Dnc$Lr<n63I&6^', 'Approved'),
('TOR_BQSmIEhHuj', 'Tourist', 'A120324723', 'Laura Oconnell', 'lauraoconnell@gmail.com', '0195323553', 'Female', 'Andorra', 'laura_oconnell.jpg', NULL, NULL, 'VPZr=%@4nJNY_R>G$56y', 'Approved'),
('TOR_ehUWoREjmo', 'Tourist', '930831-99-8472', 'Brian Chen', 'brianchen@gmail.com', '0173678735', 'Male', 'United States of America', 'brian_chen.png', NULL, NULL, 'I8B?nMh9bWyjbhY', 'Approved'),
('TOR_esxqIPVJZT', 'Tourist', 'A874238332', 'Jennifer Becker', 'jenniferbecker@gmail.com', '0153509229', 'Female', 'Gabon', 'jennifer_becker.png', NULL, NULL, 'EjLXYizZT2rDwz8!O', 'Approved'),
('TOR_HqvSLDzSMy', 'Tourist', '831210-40-2229', 'Kenneth Lopez', 'kennethlopez@gmail.com', '0194591108', 'Female', 'Palestinian Territory', 'kenneth_lopez.png', NULL, NULL, 'A9uiNTLoE9fK^', 'Approved'),
('TOR_iegYMEMMpC', 'Tourist', '690827-14-3096', 'Laura Williams', 'laurawilliams@gmail.com', '0177733472', 'Female', 'Bhutan', 'laura_williams.png', NULL, NULL, 'qNAqY=1NuH>Mzo_#', 'Approved'),
('TOR_JGgZstigpL', 'Tourist', 'A027251607', 'Monique Dixon', 'moniquedixon@gmail.com', '0155517301', 'Male', 'Heard Island and Mcdonald Islands', 'monique_dixon.png', NULL, NULL, ')6(t2a$Y=C', 'Approved'),
('TOR_kqCVcrHUCm', 'Tourist', 'A498459232', 'Mr. William Walters MD', 'mr.williamwaltersmd@gmail.com', '0177292347', 'Male', 'Benin', 'william_walters.png', NULL, NULL, 'tkanB_vt7jy', 'Approved'),
('TOR_mIjoznqflO', 'Tourist', 'A900999212', 'Mikayla Rubio', 'mikaylarubio@gmail.com', '0153485042', 'Male', 'Colombia', 'mikayla_rubio.png', NULL, NULL, '8lU9!p=Z$QE', 'Approved'),
('TOR_obFLvzoxke', 'Tourist', '810319-41-3658', 'Dr. Corey Mack MD', 'dr.coreymackmd@gmail.com', '0182883858', 'Male', 'United Kingdom', 'corey_mack.png', NULL, NULL, 'x9OtyH^JA5(O_&Mww6!1', 'Approved'),
('TOR_qeFRnAUpGa', 'Tourist', 'A901907111', 'George Savage', 'georgesavage@gmail.com', '0140848087', 'Male', 'Lithuania', 'george_savage.png', NULL, NULL, '1aJ0e_(+0p1)z^e4k', 'Approved'),
('TOR_qkYgNKMKuZ', 'Tourist', '821231-31-9752', 'Tina Glass', 'tinaglass@gmail.com', '0123393808', 'Female', 'Mongolia', 'tina_glass.png', NULL, NULL, '!4HLl!!ea%<_^Kp5', 'Approved'),
('TOR_QZiBBcApYt', 'Tourist', '891017-80-9135', 'Emily Tate DVM', 'emilytatedvm@gmail.com', '0102138519', 'Female', 'Brazil', 'emily_tate.png', NULL, NULL, 'RYC)X1$(8%j', 'Approved'),
('TOR_tDTSQUxvVK', 'Tourist', '990413-37-2001', 'Jonathan Williams', 'jonathanwilliams@gmail.com', '0179804098', 'Male', 'Suriname', 'jonathan_williams.png', NULL, NULL, 'f*9TBs_7Z(V+Qh^7>6', 'Approved'),
('TOR_uGxtwdHyFT', 'Tourist', '040511-28-2537', 'Richard Campbell', 'richardcampbell@gmail.com', '0178491701', 'Male', 'Ireland', 'richard_campbell.png', NULL, NULL, 'UBbaNi4>)', 'Approved'),
('TOR_WwtDbPCWDb', 'Tourist', '010302-50-6669', 'Elizabeth Wood', 'elizabethwood@gmail.com', '0127929396', 'Female', 'Haiti', 'elizabeth_wood.png', NULL, NULL, 'Hs<#UGomWnr5Um', 'Approved'),
('TOR_wYbtrxLIAq', 'Tourist', '060906-51-8498', 'Jason Lopez', 'jasonlopez@gmail.com', '0125360696', 'Male', 'Wallis and Futuna', 'jason_lopez.png', NULL, NULL, 'Z=Y+_g8P^Y%DVn', 'Approved'),
('TOR_ytjqxLZeIn', 'Tourist', '920818-54-3515', 'Alexis Smith MD', 'alexissmithmd@gmail.com', '0153462887', 'Female', 'Slovenia', 'alexis_smith.png', NULL, NULL, '3)%43((7+w@uT', 'Approved'),
('TOR_zOwhRfBdVS', 'Tourist', 'A891092157', 'Christian Cantrell', 'christiancantrell@gmail.com', '0176696174', 'Female', 'Eritrea', 'christian_cantrell.png', NULL, NULL, 'tD-Prsnw0-FTsNRi@J', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback_t`
--

CREATE TABLE `user_feedback_t` (
  `fbk_ID` varchar(14) NOT NULL,
  `fbk_date` date NOT NULL,
  `usr_ID` varchar(14) NOT NULL,
  `usr_name` varchar(50) NOT NULL,
  `usr_email` varchar(50) NOT NULL,
  `fbk_sel` varchar(50) NOT NULL,
  `fbk_content` longtext NOT NULL,
  `stf_comt` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_feedback_t`
--

INSERT INTO `user_feedback_t` (`fbk_ID`, `fbk_date`, `usr_ID`, `usr_name`, `usr_email`, `fbk_sel`, `fbk_content`, `stf_comt`) VALUES
('FBK_aB1cD2eF3G', '2025-07-15', 'TOR_JGgZstigpL', 'Monique Dixon', 'moniquedixon@gmail.com', 'Billing and Payment', 'The payment process was confusing and took too long to complete. The system didn\'t provide clear instructions on how to proceed after payment.', 'We apologize for the inconvenience. We have simplified the payment process in our latest update.'),
('FBK_bC2dE3fG4H', '2025-07-15', 'TOR_esxqIPVJZT', 'Jennifer Becker', 'jenniferbecker@gmail.com', 'System Functionalities and Design', 'The itinerary customization feature is excellent! It helped me plan my trip perfectly. However, the mobile version could be more responsive.', NULL),
('FBK_cD3eF4gH5I', '2025-07-15', 'TOR_HqvSLDzSMy', 'Kenneth Lopez', 'kennethlopez@gmail.com', 'System Issues and Bugs', 'I encountered an error when trying to view my booking details. The page kept refreshing without displaying any information.', 'This bug has been identified and will be fixed in the next update. Thank you for reporting.'),
('FBK_dE4fG5hI6J', '2025-07-15', 'TOR_qeFRnAUpGa', 'George Savage', 'georgesavage@gmail.com', 'Others', 'The tour guides provided were very knowledgeable and made our trip memorable. Thank you for the excellent service!', 'We\'re glad you enjoyed your tour! We\'ll pass your compliments to the guides.'),
('FBK_eF5gH6iJ7K', '2025-07-15', 'TOR_iegYMEMMpC', 'Laura Williams', 'laurawilliams@gmail.com', 'Billing and Payment', 'I was charged twice for the same booking. Please refund the duplicate payment as soon as possible.', 'We\'ve processed your refund request. The amount should reflect in your account within 3-5 business days.'),
('FBK_fG6hI7jK8L', '2025-07-15', 'TOR_kqCVcrHUCm', 'Mr. William Walters MD', 'mr.williamwaltersmd@gmail.com', 'System Functionalities and Design', 'The search function for tour packages could be improved with more filter options like price range and duration.', 'We appreciate your suggestion. Enhanced filters are coming in our next release.'),
('FBK_G7XUjs7NGI', '2025-07-15', 'ADM_A0B1C2D3E4', 'Wong Zi Sean', 'sean123@email.com', 'Billing and Payment', 'Test feedback bill', 'Thank you for contacting us.'),
('FBK_gH7iJ8kL9M', '2025-07-15', 'TOR_mIjoznqflO', 'Mikayla Rubio', 'mikaylarubio@gmail.com', 'System Issues and Bugs', 'The mobile app crashes whenever I try to upload photos to my itinerary. This needs to be fixed urgently.', 'Our development team is working on this issue. An update will be released soon.'),
('FBK_hI8jK9lM0N', '2025-07-15', 'TOR_obFLvzoxke', 'Dr. Corey Mack MD', 'dr.coreymackmd@gmail.com', 'Others', 'The customer service response time was too slow. I had to wait over 24 hours for a simple query response.', 'We apologize for the delay. We\'re hiring more support staff to improve response times.'),
('FBK_iJ9kL0mN1O', '2025-07-15', 'TOR_tDTSQUxvVK', 'Jonathan Williams', 'jonathanwilliams@gmail.com', 'Billing and Payment', 'The receipt I received didn\'t match the amount I was charged. There seems to be a discrepancy in the calculations.', 'We\'ve reviewed your case and issued a corrected receipt. The difference will be refunded.'),
('FBK_jK0lM1nO2P', '2025-07-15', 'TOR_uGxtwdHyFT', 'Richard Campbell', 'richardcampbell@gmail.com', 'System Functionalities and Design', 'The booking confirmation email layout is confusing. Important details like dates and times should be more prominent.', 'We\'ve redesigned our confirmation emails based on your feedback. Thank you!'),
('FBK_kL1mN2oP3Q', '2025-07-15', 'TOR_WwtDbPCWDb', 'Elizabeth Wood', 'elizabethwood@gmail.com', 'System Issues and Bugs', 'The website doesn\'t remember my login details even when I check \"Remember Me\". I have to log in every time.', 'This issue has been fixed in our latest update. Please clear your browser cache.'),
('FBK_lM2nO3pQ4R', '2025-07-15', 'TOR_wYbtrxLIAq', 'Jason Lopez', 'jasonlopez@gmail.com', 'Others', 'The tour package descriptions were very accurate and helped me choose the perfect vacation. Great job!', NULL),
('FBK_nO4pQ5rS6T', '2025-07-15', 'TOR_ytjqxLZeIn', 'Alexis Smith MD', 'alexissmithmd@gmail.com', 'System Functionalities and Design', 'The map feature showing tour locations is very helpful. Could you add a distance calculator between points?', 'Great idea! We\'ll consider adding this feature in future updates.'),
('FBK_oP5qR6sT7U', '2025-07-15', 'TOR_zOwhRfBdVS', 'Christian Cantrell', 'christiancantrell@gmail.com', 'System Issues and Bugs', 'The calendar widget for selecting dates is not working properly on Safari browser.', 'We\'ve identified this browser compatibility issue and are working on a fix.'),
('FBK_pQ6rS7tU8V', '2025-07-15', 'TOR_aXkucTjcJl', 'Christian Baker', 'christianbaker@gmail.com', 'Others', 'The cancellation policy wasn\'t clear when I made my booking. This should be more prominently displayed.', 'We\'ve updated our interface to make policies more visible during booking.'),
('FBK_qR7sT8uV9W', '2025-07-15', 'TOR_BQSmIEhHuj', 'Laura Oconnell', 'lauraoconnell@gmail.com', 'Billing and Payment', 'The service charge seems excessive compared to other travel platforms. Please reconsider your fee structure.', 'We\'ve reviewed our fees and will be adjusting them in the next quarter.'),
('FBK_rS8tU9vW0X', '2025-07-15', 'TOR_ehUWoREjmo', 'Brian Chen', 'brianchen@gmail.com', 'System Functionalities and Design', 'The dark mode option is great! It makes using the app at night much more comfortable.', NULL),
('FBK_sT9uV0wX1Y', '2025-07-15', 'TOR_QZiBBcApYt', 'Emily Tate DVM', 'emilytatedvm@gmail.com', 'System Issues and Bugs', 'The website performance is very slow during peak hours. Pages take too long to load.', 'We\'re upgrading our servers to handle increased traffic more efficiently.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atd_mbr_rec_t`
--
ALTER TABLE `atd_mbr_rec_t`
  ADD PRIMARY KEY (`atd_rec_ID`),
  ADD KEY `atd_mbr_rec_t_ibfk_1` (`atd_ID`),
  ADD KEY `atd_mbr_rec_t_ibfk_2` (`mbr_ls_ID`);

--
-- Indexes for table `atd_rec_t`
--
ALTER TABLE `atd_rec_t`
  ADD PRIMARY KEY (`atd_ID`),
  ADD KEY `atd_rec_t_ibfk_1` (`bkn_ID`);

--
-- Indexes for table `bill_item_list_t`
--
ALTER TABLE `bill_item_list_t`
  ADD PRIMARY KEY (`bil_item_ID`),
  ADD KEY `bill_item_list_t_ibfk_1` (`bil_ID`);

--
-- Indexes for table `bill_rec_t`
--
ALTER TABLE `bill_rec_t`
  ADD PRIMARY KEY (`bil_ID`),
  ADD KEY `bill_rec_t_ibfk_1` (`usr_ID`),
  ADD KEY `bill_rec_t_ibfk_2` (`stf_ID`);

--
-- Indexes for table `blog_t`
--
ALTER TABLE `blog_t`
  ADD PRIMARY KEY (`blg_ID`);

--
-- Indexes for table `book_mbr_list_t`
--
ALTER TABLE `book_mbr_list_t`
  ADD PRIMARY KEY (`mbr_ls_ID`),
  ADD KEY `book_mbr_list_t_ibfk_1` (`bkn_ID`);

--
-- Indexes for table `book_tour_t`
--
ALTER TABLE `book_tour_t`
  ADD KEY `book_tour_t_ibfk_1` (`usr_ID`),
  ADD KEY `book_tour_t_ibfk_2` (`bkn_ID`);

--
-- Indexes for table `info_site_t`
--
ALTER TABLE `info_site_t`
  ADD PRIMARY KEY (`ist_ID`);

--
-- Indexes for table `itinerary_rec_list_t`
--
ALTER TABLE `itinerary_rec_list_t`
  ADD PRIMARY KEY (`itr_rec_ID`),
  ADD KEY `itinerary_rec_list_t_ibfk_1` (`itr_ID`);

--
-- Indexes for table `itinerary_t`
--
ALTER TABLE `itinerary_t`
  ADD PRIMARY KEY (`itr_ID`),
  ADD KEY `itinerary_t_ibfk_1` (`bkn_ID`),
  ADD KEY `itinerary_t_ibfk_2` (`usr_ID`);

--
-- Indexes for table `manage_pkg_t`
--
ALTER TABLE `manage_pkg_t`
  ADD KEY `manage_pkg_t_ibfk_1` (`usr_ID`),
  ADD KEY `manage_pkg_t_ibfk_2` (`pkg_ID`);

--
-- Indexes for table `payment_rec_t`
--
ALTER TABLE `payment_rec_t`
  ADD PRIMARY KEY (`pyt_ID`),
  ADD KEY `payment_rec_t_ibfk_1` (`bil_ID`),
  ADD KEY `payment_rec_t_ibfk_2` (`usr_ID`);

--
-- Indexes for table `pkg_item_list_t`
--
ALTER TABLE `pkg_item_list_t`
  ADD PRIMARY KEY (`pkg_item_ID`),
  ADD KEY `pkg_item_list_t_ibfk_1` (`pkg_ID`);

--
-- Indexes for table `receipt_rec_t`
--
ALTER TABLE `receipt_rec_t`
  ADD PRIMARY KEY (`rcp_ID`),
  ADD KEY `receipt_rec_t_ibfk_1` (`bil_ID`),
  ADD KEY `receipt_rec_t_ibfk_2` (`pyt_ID`),
  ADD KEY `receipt_rec_t_ibfk_3` (`usr_ID`);

--
-- Indexes for table `scd_timeslot_list_t`
--
ALTER TABLE `scd_timeslot_list_t`
  ADD PRIMARY KEY (`tsl_list_ID`),
  ADD KEY `scd_timeslot_list_t_ibfk_1` (`scd_ID`);

--
-- Indexes for table `tour_booking_t`
--
ALTER TABLE `tour_booking_t`
  ADD PRIMARY KEY (`bkn_ID`),
  ADD KEY `tour_booking_t_ibfk_1` (`usr_ID`),
  ADD KEY `tour_booking_t_ibfk_2` (`pkg_ID`);

--
-- Indexes for table `tour_package_t`
--
ALTER TABLE `tour_package_t`
  ADD PRIMARY KEY (`pkg_ID`);

--
-- Indexes for table `trip_schedule_t`
--
ALTER TABLE `trip_schedule_t`
  ADD PRIMARY KEY (`scd_ID`),
  ADD KEY `trip_schedule_t_ibfk_1` (`gud_ID`),
  ADD KEY `trip_schedule_t_ibfk_2` (`itr_ID`),
  ADD KEY `trip_schedule_t_ibfk_3` (`drv_ID`),
  ADD KEY `trip_schedule_t_ibfk_4` (`stf_ID`);

--
-- Indexes for table `user_account_t`
--
ALTER TABLE `user_account_t`
  ADD PRIMARY KEY (`usr_ID`);

--
-- Indexes for table `user_feedback_t`
--
ALTER TABLE `user_feedback_t`
  ADD PRIMARY KEY (`fbk_ID`),
  ADD KEY `user_feedback_t_ibfk_1` (`usr_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atd_mbr_rec_t`
--
ALTER TABLE `atd_mbr_rec_t`
  ADD CONSTRAINT `atd_mbr_rec_t_ibfk_1` FOREIGN KEY (`atd_ID`) REFERENCES `atd_rec_t` (`atd_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `atd_mbr_rec_t_ibfk_2` FOREIGN KEY (`mbr_ls_ID`) REFERENCES `book_mbr_list_t` (`mbr_ls_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `atd_rec_t`
--
ALTER TABLE `atd_rec_t`
  ADD CONSTRAINT `atd_rec_t_ibfk_1` FOREIGN KEY (`bkn_ID`) REFERENCES `tour_booking_t` (`bkn_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_item_list_t`
--
ALTER TABLE `bill_item_list_t`
  ADD CONSTRAINT `bill_item_list_t_ibfk_1` FOREIGN KEY (`bil_ID`) REFERENCES `bill_rec_t` (`bil_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_rec_t`
--
ALTER TABLE `bill_rec_t`
  ADD CONSTRAINT `bill_rec_t_ibfk_1` FOREIGN KEY (`usr_ID`) REFERENCES `user_account_t` (`usr_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_rec_t_ibfk_2` FOREIGN KEY (`stf_ID`) REFERENCES `user_account_t` (`usr_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_mbr_list_t`
--
ALTER TABLE `book_mbr_list_t`
  ADD CONSTRAINT `book_mbr_list_t_ibfk_1` FOREIGN KEY (`bkn_ID`) REFERENCES `tour_booking_t` (`bkn_ID`) ON DELETE CASCADE;

--
-- Constraints for table `book_tour_t`
--
ALTER TABLE `book_tour_t`
  ADD CONSTRAINT `book_tour_t_ibfk_1` FOREIGN KEY (`usr_ID`) REFERENCES `user_account_t` (`usr_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_tour_t_ibfk_2` FOREIGN KEY (`bkn_ID`) REFERENCES `tour_booking_t` (`bkn_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `itinerary_rec_list_t`
--
ALTER TABLE `itinerary_rec_list_t`
  ADD CONSTRAINT `itinerary_rec_list_t_ibfk_1` FOREIGN KEY (`itr_ID`) REFERENCES `itinerary_t` (`itr_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `itinerary_t`
--
ALTER TABLE `itinerary_t`
  ADD CONSTRAINT `itinerary_t_ibfk_1` FOREIGN KEY (`bkn_ID`) REFERENCES `tour_booking_t` (`bkn_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itinerary_t_ibfk_2` FOREIGN KEY (`usr_ID`) REFERENCES `user_account_t` (`usr_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manage_pkg_t`
--
ALTER TABLE `manage_pkg_t`
  ADD CONSTRAINT `manage_pkg_t_ibfk_1` FOREIGN KEY (`usr_ID`) REFERENCES `user_account_t` (`usr_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manage_pkg_t_ibfk_2` FOREIGN KEY (`pkg_ID`) REFERENCES `tour_package_t` (`pkg_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_rec_t`
--
ALTER TABLE `payment_rec_t`
  ADD CONSTRAINT `payment_rec_t_ibfk_1` FOREIGN KEY (`bil_ID`) REFERENCES `bill_rec_t` (`bil_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_rec_t_ibfk_2` FOREIGN KEY (`usr_ID`) REFERENCES `user_account_t` (`usr_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pkg_item_list_t`
--
ALTER TABLE `pkg_item_list_t`
  ADD CONSTRAINT `pkg_item_list_t_ibfk_1` FOREIGN KEY (`pkg_ID`) REFERENCES `tour_package_t` (`pkg_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receipt_rec_t`
--
ALTER TABLE `receipt_rec_t`
  ADD CONSTRAINT `receipt_rec_t_ibfk_1` FOREIGN KEY (`bil_ID`) REFERENCES `bill_rec_t` (`bil_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receipt_rec_t_ibfk_2` FOREIGN KEY (`pyt_ID`) REFERENCES `payment_rec_t` (`pyt_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receipt_rec_t_ibfk_3` FOREIGN KEY (`usr_ID`) REFERENCES `user_account_t` (`usr_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scd_timeslot_list_t`
--
ALTER TABLE `scd_timeslot_list_t`
  ADD CONSTRAINT `scd_timeslot_list_t_ibfk_1` FOREIGN KEY (`scd_ID`) REFERENCES `trip_schedule_t` (`scd_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tour_booking_t`
--
ALTER TABLE `tour_booking_t`
  ADD CONSTRAINT `tour_booking_t_ibfk_1` FOREIGN KEY (`usr_ID`) REFERENCES `user_account_t` (`usr_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tour_booking_t_ibfk_2` FOREIGN KEY (`pkg_ID`) REFERENCES `tour_package_t` (`pkg_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip_schedule_t`
--
ALTER TABLE `trip_schedule_t`
  ADD CONSTRAINT `trip_schedule_t_ibfk_1` FOREIGN KEY (`gud_ID`) REFERENCES `user_account_t` (`usr_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_schedule_t_ibfk_2` FOREIGN KEY (`itr_ID`) REFERENCES `itinerary_t` (`itr_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_schedule_t_ibfk_3` FOREIGN KEY (`drv_ID`) REFERENCES `user_account_t` (`usr_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_schedule_t_ibfk_4` FOREIGN KEY (`stf_ID`) REFERENCES `user_account_t` (`usr_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_feedback_t`
--
ALTER TABLE `user_feedback_t`
  ADD CONSTRAINT `user_feedback_t_ibfk_1` FOREIGN KEY (`usr_ID`) REFERENCES `user_account_t` (`usr_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
