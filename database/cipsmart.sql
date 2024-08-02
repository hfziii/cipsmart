-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2024 at 08:09 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cipsmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id_absen` int NOT NULL,
  `name_member` varchar(100) NOT NULL,
  `name_corner` varchar(40) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id_absen`, `name_member`, `name_corner`, `date`) VALUES
(1, 'Salwa', 'Literasi Imajinatif', '2024-07-13'),
(2, 'Muhamad Hafizi', 'Social Connect', '2024-07-14'),
(3, 'Bambang', 'Pena Inspirasi Gemilang', '2024-07-13'),
(4, 'danang', 'Literasi Imajinatif', '2024-07-15'),
(5, 'budi', 'Social Connect', '2024-07-15'),
(6, 'Hafizi', 'Literasi Imajinatif', '2024-07-19'),
(7, 'Agus', 'Literasi Imajinatif', '2024-07-24'),
(8, 'Dayat', 'Pena Inspirasi Gemilang', '2024-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `privileges` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `name`, `nohp`, `username`, `password`, `privileges`) VALUES
(1, 'Muhamad Hafizi', '085157181162', 'hafiziadmin', 'masuk372', 'super admin'),
(2, 'admin', '085122890190', 'admin', 'admin', 'super admin');

-- --------------------------------------------------------

--
-- Table structure for table `book_bisnis_berdaya`
--

CREATE TABLE `book_bisnis_berdaya` (
  `id_book` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `author_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `publisher_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `year_publish` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `sipnopsis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_page` varchar(10) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_bisnis_berdaya`
--

INSERT INTO `book_bisnis_berdaya` (`id_book`, `photo`, `title_book`, `author_name`, `publisher_name`, `year_publish`, `isbn`, `sipnopsis`, `total_page`, `status`) VALUES
('BC3-001', 'uploads/BOOK_CE-3/G1.png', 'Tales of Two Planets', 'Valerie', 'Penguin Publishing Group', '2022', '978-052-55057-1-6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ultricies, ante sed suscipit tincidunt, nisl urna tempor neque, et facilisis metus ipsum mollis orci. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec luctus tortor. Mauris rhoncus leo suscipit aliquam venenatis. Vivamus nec convallis mi. Proin felis nisl, ornare eget pretium ac, pellentesque nec risus. Nunc porta augue id rutrum tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam scelerisque at ligula sed sodales. Fusce dui leo, auctor non congue nec, fringilla id dolor. Nunc id cursus enim. Pellentesque tincidunt cursus mi eu hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed eleifend vitae mi vitae pulvinar. Etiam et tortor sed lacus tincidunt varius.', '320', 'Tersedia'),
('BC3-002', 'uploads/BOOK_CE-3/G8.png', 'Dongeng Banten', 'Maman', 'Gramedia', '2020', '978-052-55057-1-6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '320', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `book_kreatif_kids_corner`
--

CREATE TABLE `book_kreatif_kids_corner` (
  `id_book` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `author_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `publisher_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `year_publish` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `sipnopsis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_page` varchar(10) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_kreatif_kids_corner`
--

INSERT INTO `book_kreatif_kids_corner` (`id_book`, `photo`, `title_book`, `author_name`, `publisher_name`, `year_publish`, `isbn`, `sipnopsis`, `total_page`, `status`) VALUES
('BC4-001', 'uploads/BOOK_CE-4/G9.png', 'Dongeng Kancil', 'Maman', 'Gramedia', '2020', '978-052-55057-1-6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '320', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `book_literasi_imajinatif`
--

CREATE TABLE `book_literasi_imajinatif` (
  `id_book` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `author_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `publisher_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `year_publish` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `sipnopsis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_page` varchar(10) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_literasi_imajinatif`
--

INSERT INTO `book_literasi_imajinatif` (`id_book`, `photo`, `title_book`, `author_name`, `publisher_name`, `year_publish`, `isbn`, `sipnopsis`, `total_page`, `status`) VALUES
('BC1-001', '../uploads/BOOK_CE-1/G1.png', 'Tales of Two Planets', 'Valerie', 'Gramedia', '2020', '978-052-55057-1-6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '320', 'Dipinjam'),
('BC1-002', 'uploads/BOOK_CE-1/G2.png', 'Bitterswet', 'Valerie', 'Penguin Publishing Group', '2020', '978-052-55057-1-1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '120', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `book_pena_inspirasi_gemilang`
--

CREATE TABLE `book_pena_inspirasi_gemilang` (
  `id_book` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `author_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `publisher_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `year_publish` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `sipnopsis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_page` varchar(10) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_pena_inspirasi_gemilang`
--

INSERT INTO `book_pena_inspirasi_gemilang` (`id_book`, `photo`, `title_book`, `author_name`, `publisher_name`, `year_publish`, `isbn`, `sipnopsis`, `total_page`, `status`) VALUES
('BC5-001', '../uploads/BOOK_CE-5/G17.png', 'Novel Anak', 'Unknown', 'Gramedia-Widiasarana-Indonesia', '2020', '978-979-02500-6-2', 'Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak.', '320', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `book_social_connect`
--

CREATE TABLE `book_social_connect` (
  `id_book` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `author_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `publisher_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `year_publish` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `sipnopsis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_page` varchar(10) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_social_connect`
--

INSERT INTO `book_social_connect` (`id_book`, `photo`, `title_book`, `author_name`, `publisher_name`, `year_publish`, `isbn`, `sipnopsis`, `total_page`, `status`) VALUES
('BC2-001', 'uploads/BOOK_CE-2/G6.png', 'Buku Dongen Paling Populer', 'Maman', 'Penguin Publishing Group', '2020', '978-052-55057-1-6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '120', 'Tersedia'),
('BC2-002', 'uploads/BOOK_CE-2/G7.png', 'Dongen 1001 Malam', 'Maman', 'Gramedia', '2020', '978-052-55057-1-6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '320', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing_bisnis_berdaya`
--

CREATE TABLE `borrowing_bisnis_berdaya` (
  `id_borrow` int NOT NULL,
  `id_book` varchar(10) NOT NULL,
  `id_user` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `borrowing_bisnis_berdaya`
--

INSERT INTO `borrowing_bisnis_berdaya` (`id_borrow`, `id_book`, `id_user`, `name`, `title_book`, `borrow_date`, `return_date`, `status`) VALUES
(1, 'BC3-002', 0, 'Maman', 'Dongeng Banten', '2024-07-30', '2024-09-30', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing_kreatif_kids_corner`
--

CREATE TABLE `borrowing_kreatif_kids_corner` (
  `id_borrow` int NOT NULL,
  `id_book` varchar(10) NOT NULL,
  `id_user` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrowing_literasi_imajinatif`
--

CREATE TABLE `borrowing_literasi_imajinatif` (
  `id_borrow` int NOT NULL,
  `id_book` varchar(10) NOT NULL,
  `id_user` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `borrowing_literasi_imajinatif`
--

INSERT INTO `borrowing_literasi_imajinatif` (`id_borrow`, `id_book`, `id_user`, `name`, `title_book`, `borrow_date`, `return_date`, `status`) VALUES
(1, 'BC1-001', 0, 'Opay', 'Tales of Two Planets', '2024-07-30', '2024-07-31', 'Tersedia'),
(2, 'BC1-002', 0, 'Bambang', 'Bitterswet', '2024-07-30', '2024-08-05', 'Tersedia'),
(3, 'BC1-001', 0, 'Angga', 'Tales of Two Planets', '2024-07-30', '2024-08-10', 'Dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing_pena_inspirasi_gemilang`
--

CREATE TABLE `borrowing_pena_inspirasi_gemilang` (
  `id_borrow` int NOT NULL,
  `id_book` varchar(10) NOT NULL,
  `id_user` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `borrowing_pena_inspirasi_gemilang`
--

INSERT INTO `borrowing_pena_inspirasi_gemilang` (`id_borrow`, `id_book`, `id_user`, `name`, `title_book`, `borrow_date`, `return_date`, `status`) VALUES
(1, 'BC5-001', 0, 'Salwa', 'Novel Anak', '2024-07-30', '2024-07-31', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing_social_connect`
--

CREATE TABLE `borrowing_social_connect` (
  `id_borrow` int NOT NULL,
  `id_book` varchar(10) NOT NULL,
  `id_user` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `borrowing_social_connect`
--

INSERT INTO `borrowing_social_connect` (`id_borrow`, `id_book`, `id_user`, `name`, `title_book`, `borrow_date`, `return_date`, `status`) VALUES
(1, 'BC2-001', 0, 'Opay', 'Buku Dongen Paling Populer', '2024-07-30', '2024-08-01', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `corner_education`
--

CREATE TABLE `corner_education` (
  `id_corner` varchar(10) NOT NULL,
  `name_corner` varchar(40) NOT NULL,
  `location_corner` varchar(50) NOT NULL,
  `total_book` int NOT NULL,
  `total_book_ready` int NOT NULL,
  `total_book_borrow` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `corner_education`
--

INSERT INTO `corner_education` (`id_corner`, `name_corner`, `location_corner`, `total_book`, `total_book_ready`, `total_book_borrow`) VALUES
('CE-1', 'Literasi Imajinatif', 'RW 6, Kelurahan Cipaku', 0, 0, 0),
('CE-2', 'Social Connect', 'RW 15, Kelurahan Cipaku', 0, 0, 0),
('CE-3', 'Bisnis Berdaya', 'RW 9, Kelurahan Cipaku', 0, 0, 0),
('CE-4', 'Kreatif Kids Corner', 'RW 17, Kelurahan Cipaku', 0, 0, 0),
('CE-5', 'Pena Inspirasi Gemilang', 'RW 4, Kelurahan Cipaku', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ebook`
--

CREATE TABLE `ebook` (
  `id_ebook` int NOT NULL,
  `judul_ebook` varchar(100) NOT NULL,
  `kategori_ebook` varchar(50) NOT NULL,
  `penulis_ebook` varchar(100) NOT NULL,
  `penerbit_ebook` varchar(100) NOT NULL,
  `jumlah_halaman_ebook` varchar(10) NOT NULL,
  `tahun_ebook` varchar(4) NOT NULL,
  `isbn_ebook` varchar(50) NOT NULL,
  `sipnopsis_ebook` text NOT NULL,
  `sampul_ebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `file_ebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ebook`
--

INSERT INTO `ebook` (`id_ebook`, `judul_ebook`, `kategori_ebook`, `penulis_ebook`, `penerbit_ebook`, `jumlah_halaman_ebook`, `tahun_ebook`, `isbn_ebook`, `sipnopsis_ebook`, `sampul_ebook`, `file_ebook`) VALUES
(1, 'Namaku Kali', 'Sastra', 'Anna Farida dan Felishia', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '100', '2022', '978-602-427-921-9', 'Anak itu datang lagi! Kali selalu suka melihat anak itu. Apa yang akan dia lakukan hari ini?', 'uploads/ebook/ebook-001-namakukali.png', 'uploads/ebook/Namaku_Kali.pdf'),
(2, 'Aku Sudah Besar', 'Sastra', 'Futri Wijayanti', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '16', '2022', '978-602-244-930-0', 'Ayah dan Ibu sibuk dengan Adik. Aku mulai iri. Namun aku sudah besar. Bolehkah aku ikut mengasuh Adik?', 'uploads/ebook/ebook-002-akusudahbesar.png', 'uploads/ebook/Aku_Sudah_Besar.pdf'),
(3, 'Apa Itu?', 'Sastra', 'Laksmi Manohara, Aira Rumi', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '23', '2022', '978-602-244-939-3', 'Tia dan teman-temannya pergi ke Desa Cisupa. Ada pawai sisingaan di sana. Dalam perjalanan, ada sesuatu mengikuti mereka. Apa itu?', 'uploads/ebook/ebook-003-apaitu.png', 'uploads/ebook/Apa_Itu.pdf'),
(4, 'Biji Merah Luna', 'Sastra', 'Ammy Kudo', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '17', '2022', '978-602-244-926-3', 'Biji merah itu bagus. Sayang hanya sedikit. Yuk, lihat Luna. Dia sedang apa?', 'uploads/ebook/ebook-004-bijimerahluna.png', 'uploads/ebook/Biji_Merah_Luna.pdf'),
(5, 'Coba dulu Tora', 'Sastra', 'Sri Sarastuti', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '33', '2022', '978-602-244-942-3', 'Tora baru saja pindah ke pohon baru yang nyaman. Sayangnya, dia jadi malas bergerak. Bahkan dia sering menunda keinginan buang air besar. Akibatnya, Tora malah jadi susah buang air besar.', 'uploads/ebook/Cuplikan layar 2024-07-18 161703.png', 'uploads/ebook/Coba_Dulu_Tora.pdf'),
(6, 'Dimana Kacang Sipet', 'Sastra', 'Aris Hartanti', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '23', '2022', '978-602-244-935-5', 'Sipet mengumpulkan kacang untuk persediaan. Namun, kacang Sipet hilang! Di mana kacang Sipet?', 'uploads/ebook/ebook-006-dimanakacangsipet.png', 'uploads/ebook/Dimana_Kacang_Sipet.pdf'),
(7, 'Gadis Rempah', 'Sastra', 'Musrifah Medkom', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '185', '2023', '978-623-118-030-8', 'Arumi seorang gadis remaja yang sangan bermimpi menjadi seorang desainer produk. Namun, mimpi dan kenyataan sangatlah berbeda dari harapannya. Di mata Ibunya, semua yang dilakukannya', 'uploads/ebook/ebook-007-gadisrempah.png', 'uploads/ebook/Gadis_Rempah.pdf'),
(8, 'Karena Anggrek Ibu', 'Sastra', 'Debby Lukito Goeyardi, Widyasari Hanaya', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '47', '2022', '978-602-244-944-7', 'Janu bingung dan takut. Sekolah memberi surat edaran, tapi Janu lupa menyerahkan surat itu kepada ibu. Ibu sangat disiplin, apalagi kalau menyangkut soal uang. Semua harus direncanakan. Jadi, Janu memutuskan', 'uploads/ebook/ebook-008-karenaanggrekibu.png', 'uploads/ebook/Karena_Anggrek_Ibu.pdf'),
(9, 'Naik-naik Kepuncak Bukit', 'Sastra', 'Sarah Fauzia', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '25', '2022', '978-602-244-937-9', 'Bulan dan Sabit biasa berjalan kaki setiap pagi. Mereka ingin mencoba pengalaman baru. Kali ini mereka akan mendaki bukit! Masalahnya, keadaan di sana tidak mudah bagi Sabit. Apa yang dialami Sabit?', 'uploads/ebook/ebook-011-naiknaikkepuncakbukit.png', 'uploads/ebook/Naik_Naik_Kepuncak_Bukit.pdf'),
(10, 'Si Cemong Coak', 'Sastra', 'Iwok Abqary', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '55', '2022', '978-602-244-922-5', 'Cemong selalu iri melihat kucing-kucing yang mengenakan kerincing. Baginya, Kerincing melambangkan rumah dan kasih sayang. Bisakah ia meiliki kerincing yang diimpikan? Ia hanyalah kucing liar tak bertuan.', 'uploads/ebook/si_cemong_coak.png', 'uploads/ebook/Si_Cemong_Coak.pdf'),
(11, 'Misteri Drumben Tengah Malam', 'Sastra', 'Dian Kristiani', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '154', '2023', '978-623-118-008-7', 'Bagi Faben, tinggal di Yogya sungguh menyebalkan. Makanan, teman-teman, dan cuacanya sungguh berbeda dengan Bengkulu, kota kelahirannya. Namun, Faben tak punya pilihan. Dia harus', 'uploads/ebook/misteri_drumben_tengah_malam.png', 'uploads/ebook/Misteri_Drumben_Tengah_Malam.pdf'),
(12, 'Sekolah Untuk Timur', 'Sastra', 'Muhammad Fauzi, Izzah Annisa', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '176', '2023', '978-623-118-012-4', 'Timur adalah bocah manis dari Wamena, Papua. Dia baru lulus SD dan ingin melanjutkan ke SMP. Namun, jarak rumah dengan SMP sangat jauh. Apalagi, Bapak melarang Timur melanjutkan', 'uploads/ebook/Sekolah_untuk_timur.png', 'uploads/ebook/Sekolah_Untuk_Timur.pdf'),
(13, 'Rumah Wortel', 'Sastra', 'Helga K.', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '24', '2022', '978-602-244-924-9', 'Elis suka sekali makan wortel. Namun, wortel sedang langka. Elis menanam wortel sendiri. Apakah dia akan berhasil?', 'uploads/ebook/Rumah_wortel.png', 'uploads/ebook/Rumah_Wortel.pdf'),
(14, 'Layur Tetaplah Berlayar', 'Sastra', 'Anang YB', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '264', '2023', '978-623-118-058-2', 'Seorang remaja putri bernama Layur mengalami kecelakaan pada kakinya setelah terkena ledakan bom ikan. Dusun tersebut dulunya makmur, tetapi sejak penggunaan bom ikan menjadi kebiasaan, lautan dan terumbu karang sekitar', 'uploads/ebook/Layur_tetaplah_berlayar.png', 'uploads/ebook/Layur_Tetaplah_Berlayar.pdf'),
(15, '5 Pandawa Penglipuran', 'Sastra', 'Sarah Fauzia', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '48', '2023', '978-623-118-022-3', 'Kondisi Bumi tidak baik-baik saja. Koloni di Mars juga membutuhkan oksigen lebih banyak lagi. Empat pemuda dari Mars pergi ke Bumi untuk memulihkan lingkungan', 'uploads/ebook/5_pandawa_penglipuran.png', 'uploads/ebook/Lima_Pandawa_Penglipuran.pdf'),
(16, 'Mengejar Haruto', 'Sastra', 'Dewi Cholidatul', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '186', '2023', '978-623-118-016-2', 'Jalu ingin menyusul Abah ke Jepang. Dia ingin pergi ke desa Shirakawa,setting tempat serial komik dan manga jepang paling terkenal, Haruto, Konon, desa itu mirip sekali dengan kampung Halamannya, Kampung Naga. Namun,', 'uploads/ebook/Mengejar_haruto.png', 'uploads/ebook/Mengejar_Haruto.pdf'),
(17, 'Nanti Saja', 'Sastra', 'Fransisca Emilia', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '33', '2022', '978-602-244-941-6', 'Inur harus menyelesaikan prakarya hari ini karena besok harus dikumpulkan. Tapi, Abah minta tolong Inur mengantar minyak jelantah ke bank sampah. Berhasilkan Inur mengerjakan tugas sekolahnya? Apa yang ia buat?', 'uploads/ebook/Nanti_saja.png', 'uploads/ebook/Nanti_Saja_compressed.pdf'),
(18, 'Pilus Rumput Laut Untuk Rasi', 'Sastra', 'Nabila Adani', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '47', '2022', '978-602-244-943-0', 'Berli risau karena panen rumput laut di daerahnya berkurang. Lalu, Berli mendapat ide. Ia memposting sesuatu di media sosialnya. Postingan itu ternyata membuat Berli terkenal, tetapi …. Oh, sahabatnya, Rasi,', 'uploads/ebook/Pilus_rumput_laut_untuk_rasi.png', 'uploads/ebook/Pilus_Rumput_Laut_Untuk_Rasi.pdf'),
(19, 'Putri di Dalam Hutan', 'Sastra', 'Wiratu Emi', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '57 Halaman', '2022', '978-602-244-940-9', 'Neo dan Nara ikut orang tuanya ke Pulau Samosir. Mamanya seorang peneliti burung yang sedang meneliti burung endemik. Suatu hari saat mereka mengikuti orang tuanya di hutan mereka mencium bau wangi', 'uploads/ebook/Putri_di dalam_hutan.png', 'uploads/ebook/Putri_Didalam_Hutan.pdf'),
(20, 'Tidak Bisa TIdak', 'Sastra', 'Lenny Puspita Ekawaty', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '33', '2022', '978-602-244-945-4', 'Dito ingin menempati peringkat teratas di gim Kota Baru bersama temantemannya. Dia bahkan sampai membuka tabungannya untuk membeli voucer gim. Saat peringkat mulai meningkat,', 'uploads/ebook/Tidak_bisa_tidak.png', 'uploads/ebook/Tidak_Bisa_Tidak.pdf'),
(21, 'Tiup - Tiup', 'Sastra', 'Ana Falesthin T. A.', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '24', '2022', '978-602-244-928-7', 'dengan uang tabungannya. Setiap hari, dia meniup seruling itu. Namun, Pak Kumis marah-marah. Apa yang terjadi, ya?', 'uploads/ebook/Tiup_tiup.png', 'uploads/ebook/Tiup_Tiup.pdf'),
(22, 'Komik Rampai: Vanya dan Vino, Tiara x Jerawat, Rahasia Sehat Kakek, Kembalinya Para Lemak', 'Sastra', 'Sri Sarastuti,  dkk.', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '13', '2023', '978-623-118-024-7', 'Penampilan keren merupakan impian. Remaja pun tidak terlepas dari keinginan untuk dapat terlihat menarik dan penuh gaya. Komik Rampai ini berisi kisah Vanya dan Vino, Tiara,', 'uploads/ebook/Rahasia_kakek_sehat.png', 'uploads/ebook/Vanya_dan_Vino.pdf'),
(23, 'Komik Rampai: Sekilas Yami, Tantangan Sinta, Rio dan Jabrik, Aji Mumpung', 'Sastra', 'Yudha Pangesti, dkk.', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '13', '2023', '978-623-118-026-1', 'Penampilan keren merupakan impian. Remaja pun tidak terlepas dari tantangan untuk dapat terlihat menarik dan penuh gaya. Tentu saja setiap remaja mempunyai deinisi', 'uploads/ebook/Rio & jabrik.png', 'uploads/ebook/Yami_Sinta_Rio_Aji.pdf'),
(24, 'Anak - anak Sungai Sondong', 'Sastra', 'Ramajani Sinaga', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '98', '2023', '978-623-118-767-3', 'Sungai-sungai mengalir memberi kehidupan, tapi tangan manusia menghadangnya, Warnanya menjadi pekat, hitam, dan kumuh Sungai-sungai mengalir ke kehidupan Tangan manusia mengembalikannya Warnanya kembali jernih bagai embun pagi', 'uploads/ebook/anak - anak sungai sondong.png', 'uploads/ebook/Anak_Sungai_Sondong.pdf'),
(25, 'Pulang', 'Sastra', 'Sketsa Ultra Pelangi', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '28', '2023', '978-623-118-713-0', 'Setelah petualangan yang melelahkan, perut terasa lapar. Makan bersama ayah dan ibu menjadi sangat menyenangkan.', 'uploads/ebook/pulang.png', 'uploads/ebook/Pulang.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `product_umkm`
--

CREATE TABLE `product_umkm` (
  `id_product` int NOT NULL,
  `product_photo_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_photo_2` varchar(255) NOT NULL,
  `product_photo_3` varchar(255) NOT NULL,
  `product_photo_4` varchar(255) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(10,0) NOT NULL,
  `product_description` text NOT NULL,
  `id_seller` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_umkm`
--

INSERT INTO `product_umkm` (`id_product`, `product_photo_1`, `product_photo_2`, `product_photo_3`, `product_photo_4`, `product_category`, `product_name`, `product_price`, `product_description`, `id_seller`) VALUES
(1, 'uploads/umkm/kue bangkit.jpeg', 'uploads/umkm/kue bangkit 2.jpg', 'uploads/umkm/kue bangkit 3.jpg', 'uploads/umkm/kue bangkit 4.jpg', 'Makanan', 'Kue Coklat', '40000', 'salah satu kue tradisional indonesia khas masyarakat Melayu yang berasal dari Pulau Sumatera(Riau)', 'UMKM-5'),
(2, 'uploads/umkm/4-jenis-jamu-tradisional-dan-manfaatnya-untuk-kesehatan.jpg', 'uploads/umkm/1662011925820-cara-membuat-jamu-tradisional-di-rumah-dengan-bahan-yang-simple.jpg', 'uploads/umkm/thumbnail_93.jpg', 'uploads/umkm/X-Jamu-Tradisional-Indonesia-dengan-Segudang-Manfaat.jpg', 'Obat Herbal', 'Jamu', '45000', 'Jamu Sehat Alami adalah minuman herbal tradisional yang diracik dari bahan-bahan alami berkualitas tinggi untuk menjaga kesehatan dan kebugaran tubuh Anda. Diperkaya dengan rempah-rempah pilihan seperti kunyit, jahe, temulawak, dan serai, jamu ini memberikan manfaat kesehatan yang optimal dengan rasa yang khas dan menyegarkan', 'UMKM-2'),
(3, 'uploads/umkm/aneka sambal.jpg', 'uploads/umkm/aneka sambal 2.jpg', 'uploads/umkm/aneka sambal 3.jpeg', 'uploads/umkm/aneka sambal 4.jpg', 'Makanan', 'Sambal Pak Bambang', '30000', 'Nikmati sensasi pedas yang autentik dengan Sambal Pak Jarwo! Terbuat dari bahan-bahan pilihan berkualitas tinggi, sambal ini menghadirkan cita rasa pedas yang khas dan lezat. Setiap sendoknya merupakan perpaduan sempurna antara cabai segar, bawang putih, bawang merah, dan rempah-rempah tradisional Indonesia, yang diolah dengan penuh cinta dan keahlian.', 'UMKM-4'),
(4, '../uploads/umkm/Cuplikan layar 2024-07-29 190510.png', '../uploads/umkm/Cuplikan layar 2024-07-29 190459.png', '../uploads/umkm/Cuplikan layar 2024-07-29 190448.png', '../uploads/umkm/Cuplikan layar 2024-07-29 190437.png', 'Camilan', 'Somay', '10000', 'Somay enak Somay enakSomay enakSomay enakSomay enakSomay enakSomay enakSomay enakSomay enakSomay enakSomay enakSomay enakSomay enak', 'UMKM-6'),
(5, '../uploads/umkm/Cuplikan layar 2024-07-29 190510.png', '../uploads/umkm/Cuplikan layar 2024-07-29 190459.png', '../uploads/umkm/Cuplikan layar 2024-07-29 190448.png', '../uploads/umkm/Cuplikan layar 2024-07-29 190437.png', 'Camilan', 'Somay', '10000', 'Somay enak sekali', 'UMKM-6');

-- --------------------------------------------------------

--
-- Table structure for table `profile_kelurahan`
--

CREATE TABLE `profile_kelurahan` (
  `luas_wilayah` varchar(50) NOT NULL,
  `jumlah_rw` int NOT NULL,
  `jumlah_rt` int NOT NULL,
  `anak_anak` int NOT NULL,
  `remaja` int NOT NULL,
  `dewasa` int NOT NULL,
  `jumlah_penduduk` int NOT NULL,
  `laki_laki` int NOT NULL,
  `perempuan` int NOT NULL,
  `tamat_sd_smp` int NOT NULL,
  `tamat_sma` int NOT NULL,
  `tamat_sarjana` int NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_umkm`
--

CREATE TABLE `seller_umkm` (
  `id_seller` varchar(100) NOT NULL,
  `seller_name` varchar(100) NOT NULL,
  `no_whatsapp` varchar(20) NOT NULL,
  `address_seller` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `seller_umkm`
--

INSERT INTO `seller_umkm` (`id_seller`, `seller_name`, `no_whatsapp`, `address_seller`) VALUES
('UMKM-1', 'Gabriel', '085157181162', 'Kp. Sukaasih, Kelurahan Cipaku, Kota Bogor'),
('UMKM-2', 'Syauqi', '051228280909', 'Kp. Cipaku Skip, Kelurahan Cipaku, Kota Bogor'),
('UMKM-3', 'Fatur', '0861700709898', 'Kp. Cipaku Skip, Kelurahan Cipaku, Kota Bogor'),
('UMKM-4', 'Bambang', '086720201010', 'Kp. Sukaasih, Kelurahan Cipaku, Kota Bogor'),
('UMKM-5', 'Salwa Salsabil', '085732185809', 'Kp. Cipaku Skip, Kelurahan Cipaku, Kota Bogor'),
('UMKM-6', 'Hafizi', '085157181163', 'Kp. Cipaku Skip, Kelurahan Cipaku, Kota Bogor'),
('UMKM-7', 'Haifan', '081920202024', 'Kp. Sukaasih, Kelurahan Cipaku, Kota Bogor');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `book_bisnis_berdaya`
--
ALTER TABLE `book_bisnis_berdaya`
  ADD PRIMARY KEY (`id_book`);

--
-- Indexes for table `book_kreatif_kids_corner`
--
ALTER TABLE `book_kreatif_kids_corner`
  ADD PRIMARY KEY (`id_book`);

--
-- Indexes for table `book_literasi_imajinatif`
--
ALTER TABLE `book_literasi_imajinatif`
  ADD PRIMARY KEY (`id_book`);

--
-- Indexes for table `book_pena_inspirasi_gemilang`
--
ALTER TABLE `book_pena_inspirasi_gemilang`
  ADD PRIMARY KEY (`id_book`);

--
-- Indexes for table `book_social_connect`
--
ALTER TABLE `book_social_connect`
  ADD PRIMARY KEY (`id_book`);

--
-- Indexes for table `borrowing_bisnis_berdaya`
--
ALTER TABLE `borrowing_bisnis_berdaya`
  ADD PRIMARY KEY (`id_borrow`);

--
-- Indexes for table `borrowing_kreatif_kids_corner`
--
ALTER TABLE `borrowing_kreatif_kids_corner`
  ADD PRIMARY KEY (`id_borrow`);

--
-- Indexes for table `borrowing_literasi_imajinatif`
--
ALTER TABLE `borrowing_literasi_imajinatif`
  ADD PRIMARY KEY (`id_borrow`);

--
-- Indexes for table `borrowing_pena_inspirasi_gemilang`
--
ALTER TABLE `borrowing_pena_inspirasi_gemilang`
  ADD PRIMARY KEY (`id_borrow`);

--
-- Indexes for table `borrowing_social_connect`
--
ALTER TABLE `borrowing_social_connect`
  ADD PRIMARY KEY (`id_borrow`);

--
-- Indexes for table `corner_education`
--
ALTER TABLE `corner_education`
  ADD PRIMARY KEY (`id_corner`);

--
-- Indexes for table `product_umkm`
--
ALTER TABLE `product_umkm`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `seller_umkm`
--
ALTER TABLE `seller_umkm`
  ADD PRIMARY KEY (`id_seller`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `borrowing_bisnis_berdaya`
--
ALTER TABLE `borrowing_bisnis_berdaya`
  MODIFY `id_borrow` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `borrowing_kreatif_kids_corner`
--
ALTER TABLE `borrowing_kreatif_kids_corner`
  MODIFY `id_borrow` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `borrowing_literasi_imajinatif`
--
ALTER TABLE `borrowing_literasi_imajinatif`
  MODIFY `id_borrow` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `borrowing_pena_inspirasi_gemilang`
--
ALTER TABLE `borrowing_pena_inspirasi_gemilang`
  MODIFY `id_borrow` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `borrowing_social_connect`
--
ALTER TABLE `borrowing_social_connect`
  MODIFY `id_borrow` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_umkm`
--
ALTER TABLE `product_umkm`
  MODIFY `id_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
