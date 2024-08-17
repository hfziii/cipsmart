-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 17, 2024 at 11:29 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

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
(7, 'Septian', 'Literasi Imajinatif', '2024-07-24'),
(8, 'Dayat', 'Pena Inspirasi Gemilang', '2024-07-30'),
(9, 'adinda', 'Literasi Imajinatif', '2024-08-01'),
(10, 'Veronika', 'Bisnis Berdaya', '2024-08-01'),
(11, 'Asep', 'Literasi Imajinatif', '2024-08-09'),
(12, 'Cecep', 'Kreatifitas Kids Corner', '2024-08-13'),
(13, 'Samsul', 'Kreatifitas Kids Corner', '2024-08-13'),
(14, 'Muhamad Hafizi', 'Literasi Imajinatif', '2024-08-13'),
(15, 'Septian\r\n', 'Literasi Imajinatif', '2024-08-13'),
(16, 'Bruno', 'Literasi Imajinatif', '2024-08-13'),
(17, 'Mars', 'Social Connect', '2024-08-13'),
(18, 'Bambang', 'Pena Inspirasi Gemilang', '2024-08-13'),
(19, 'Samsul', 'Literasi Imajinatif', '2024-08-13'),
(20, 'Sugeni', 'Social Connect', '2024-08-13'),
(21, 'Budi', 'Bisnis Berdaya', '2024-08-13'),
(22, 'Bang Alif', 'Kreatifitas Kids Corner', '2024-08-13'),
(23, 'Dayat', 'Pena Inspirasi Gemilang', '2024-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `name`, `nohp`, `username`, `password`, `role`) VALUES
(1, 'BLM FEB Unpak', '085157181162', 'blmfeb', 'CBFPakuan24#', 'Super Admin'),
(2, 'Kelurahan Cipaku', '0821', 'cipaku', 'cipaku@24', 'Admin Kelurahan'),
(3, 'Literasi Imajinatif 1', '0', 'literasi1', 'c11ppk24', 'Admin Literasi'),
(4, 'Literasi Imajinatif 2', '0', 'literasi2', 'c12ppk24', 'Admin Literasi'),
(5, 'Social Connect 1', '0', 'social1', 'c21ppk24', 'Admin Social'),
(6, 'Social Connect 2', '0', 'social2', 'c22ppk24', 'Admin Social'),
(7, 'Bisnis Berdaya 1', '0', 'bisnis1', 'c31ppk24', 'Admin Bisnis'),
(8, 'Bisnis Berdaya 2', '0', 'bisnis2', 'c32ppk24', 'Admin Bisnis'),
(9, 'Kreatifitas Kids Corner 1', '0', 'kreatif1', 'c41ppk24', 'Admin Kreatif'),
(10, 'Kreatifitas Kids Corner 2', '0', 'kreatif2', 'c42ppk24', 'Admin Kreatif'),
(11, 'Pena Inspirasi Gemilang 1', '0', 'pena1', 'c51ppk24', 'Admin Pena'),
(12, 'Pena Inspirasi Gemilang 2', '0', 'pena2', 'c52ppk24', 'Admin Pena'),
(13, 'UMKM', '085157181164', 'umkm', 'umkm24ppk', 'Admin UMKM');

-- --------------------------------------------------------

--
-- Table structure for table `book_bisnis_berdaya`
--

CREATE TABLE `book_bisnis_berdaya` (
  `id_book` varchar(20) NOT NULL,
  `photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category` varchar(255) DEFAULT NULL,
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

INSERT INTO `book_bisnis_berdaya` (`id_book`, `photo`, `title_book`, `category`, `author_name`, `publisher_name`, `year_publish`, `isbn`, `sipnopsis`, `total_page`, `status`) VALUES
('CE3-A-001-1', '../uploads/BOOK_CE-3/CE3-1.png', 'Ringkasan Sejarah NABI MUHAMMAD SAW', 'Agama', 'Muhammad Idris Jauhari', 'Mutiarapres', '2009', '-', 'Ringkasan Sejarah Nabi Muhammad SAW merupakan buku yang memberikan gambaran singkat namun menyeluruh tentang kehidupan Nabi Muhammad SAW, mulai dari kelahirannya hingga kematiannya. Buku ini mengulas momen-momen penting dalam hidupnya, mulai dari masa kecilnya, diangkat menjadi rasul, perjuangan menyebarkan ajaran Islam, hingga prestasi besarnya dalam membangun peradaban Islam.', '151', 'Tersedia'),
('CE3-A-002-1', '../uploads/BOOK_CE-3/CE3-2.png', 'JUZ AMMA for Kids metode ILMA Integratif-Lengkap-Mahir-Aktif', 'Agama', 'Nurul Ihsan', 'SmartBooks', '2020', '-', 'Metode ILMA berfokus pada pendekatan pembelajaran yang menyeluruh dan terpadu, di mana anak-anak tidak hanya belajar membaca dan menghafal surat-surat dalam Juz Amma, tetapi juga memahami maknanya, serta menerapkan nilai-nilai yang terkandung di dalamnya dalam kehidupan sehari-hari. Buku ini dilengkapi dengan ilustrasi yang menarik, aktivitas interaktif, dan cerita-cerita inspiratif yang membantu anak-anak memahami konteks dan pesan dari setiap surat.', '43', 'Tersedia'),
('CE3-A-003-1', '../uploads/BOOK_CE-3/CE3-4.png', 'The Amazing Islamic Legacy Menapaki Jejak Kekayaan Islam', 'Agama', 'H. Endang Hendra, Lc.', 'Cordoba', '2012', '-', 'Michael H. Hart dalam bukunya the 100 menilai Muhammad sebagai tokoh paling berpengaruh sejarah manusia. Menurut Hart, Muhammad adalah satu-satunya orang yang berhasil meraih keberhasilan luar biasa baik dalam hal spirtual maupun kemasyarakatan', '72', 'Tersedia'),
('CE3-A-010-1', '../uploads/BOOK_CE-3/CE3-9.png', 'Keajaiban SEDEKAH', 'Agama', 'Yeni S. Firdaus', 'Bintang Indonesia Jakarta', '2024', '602218431-2', 'Inilah buku tentang SEDEKAH, yang berbeda dari yang pernah ada sebelumnya!  Anda akan tercengang dengan pembahasan-pembahasan yang sangat ilmiah, metodologis tentang sedekah, tapi tetap dengan bahasa khas beliau; ringan, renyah, mudah dan menyenangkan untuk dibaca dan dipahami. Keajaiban apa yang sedang Anda butuhkan?', '24', 'Tersedia'),
('CE3-A-011-1', '../uploads/BOOK_CE-3/CE3-13.png', 'Pendidikan Pancasila dan Kewarganegaraan', 'Pendidikan', 'Yusnawan dkk', 'Pusat Kurikulum dan Perbukuan, Balitbang, Kemendikbud', '2015', '978-602-1530-70-2', 'Pendidikan Pancasila dan Kewarganegaraan adalah buku yang membahas tentang dasar-dasar ideologi Pancasila dan bagaimana nilai-nilai tersebut diterapkan dalam kehidupan berbangsa dan bernegara di Indonesia. Buku ini dirancang sebagai panduan untuk memahami peran Pancasila sebagai landasan filosofis negara, serta bagaimana setiap warga negara dapat berkontribusi dalam mewujudkan masyarakat yang adil, makmur, dan beradab.', '164', 'Tersedia'),
('CE3-AA-007-1', '../uploads/BOOK_CE-3/CE3-15.png', 'Bang Kojek, Tukang Ojek', 'Anak - anak', 'Tethy Ezokanzo', 'Map Plus', '2024', '9780-623-8469-02-4', 'Bang Kojek bukanlah tukang ojek biasa. Selain lihai bermanuver di jalanan yang padat, ia juga dikenal sebagai sosok yang ramah, jujur, dan selalu siap membantu siapa saja. Setiap harinya, Bang Kojek bertemu dengan berbagai macam penumpang dengan cerita hidup yang berbeda-beda. Melalui percakapan singkat namun penuh makna dengan penumpang-penumpangnya, Bang Kojek sering kali menjadi pendengar setia, penasihat bijak, atau bahkan seorang teman yang menghibur di tengah kesibukan kota.', '24', 'Tersedia'),
('CE3-AA-008-1', '../uploads/BOOK_CE-3/CE3-7.png', 'Unforgettable Behel', 'Anak - anak', 'Fayanna Alisha Davianny, dkk.', 'PT Mizan Media Utama', '2015', '978-602-367-073-4', 'Saat anak-anak yang lain punya benda kesayangan seperti boneka, mobil-mobilan, atau buku. Benda kesayangan Fayanna malah behel yang sudah dia pakai sejak umur 7 tahun. Gimana ya, kisah Fayanna dan behel kesayangannya?', '104', 'Tersedia'),
('CE3-AA-009-1', '../uploads/BOOK_CE-3/CE3-8.png', 'KANCIL Melawan SINGA', 'Anak - anak', 'Rofiq Arochman', 'Map Plus', '2024', '978-979-1072-56-4', 'Suatu hari, Kancil dan kura - kura hendak memancing di danau. Di tengah jalan mereka bertemu dengan seekor rubah yang sedang lari ketakkutan karena akan di terkam singa.', '24', 'Tersedia'),
('CE3-P-004-1', '../uploads/BOOK_CE-3/CE3-3.png', 'GRAMMAR UNTUK PEMULA', 'Pendidikan', 'Drs. Evert H. Hilman, M.Hum.', 'Awan Indah', '2011', '978-979-24-4929-7', 'Buku ini mengasah potensi kebahasaan guna meningkatkan pengetahuan dan keterampilan anda dalam bahasa inggris', '217', 'Tersedia'),
('CE3-P-006-1', '../uploads/BOOK_CE-3/CE3-6.png', 'Manajemen', 'Pendidikan', 'T. Hani Handoko', 'BPFE - YOGYAKARTA', '2017', '979-503-030-2', 'Manajemen adalah buku yang menguraikan konsep-konsep dasar serta praktik terbaik dalam mengelola organisasi atau perusahaan. Ditujukan bagi para pemimpin, manajer, dan pelajar, buku ini menjelaskan berbagai aspek penting dalam manajemen, seperti perencanaan, pengorganisasian, pengarahan, dan pengendalian.', '408', 'Tersedia'),
('CE3-P-012-1', '../uploads/BOOK_CE-3/CE3-12.png', 'Bahasa Inggris When English comes in Handy', 'Pendidikan', 'Herman Benyamin', 'Grafindo Media Pratama', '2018', '978-602-01-2018-8', 'Ditulis dengan gaya yang mudah dipahami.Buku ini juga dilengkapi dengan latihan-latihan praktis, permainan kata, dan ilustrasi menarik yang membuat belajar bahasa Inggris menjadi lebih menyenangkan dan interaktif. Dengan pendekatan yang praktis dan aplikatif, When English Comes in Handy menjadi teman yang sangat berguna bagi mereka yang ingin mengasah kemampuan berbahasa Inggris dan lebih percaya diri dalam menggunakannya di berbagai situasi.', '232', 'Tersedia'),
('CE3-P-013-1', '../uploads/BOOK_CE-3/CE3-11.png', 'Prakarya', 'Pendidikan', 'Suci Paresti dkk', 'Pusat Kurikulum dan Perbukuan, Balitbang, Kemendikbud', '2014', '978-602-282-340-7', 'Prakarya adalah buku yang mengajarkan keterampilan dan kreativitas melalui berbagai proyek prakarya dan kerajinan tangan. Buku ini dirancang untuk memfasilitasi pembaca—baik pelajar maupun penggemar kerajinan—dalam mengembangkan keterampilan praktis dan estetika melalui berbagai kegiatan yang melibatkan bahan dan teknik sederhana.', '142', 'Tersedia'),
('CE3-P-014-1', '../uploads/BOOK_CE-3/CE3-10.png', 'Bahasa Sunda', 'Pendidikan', 'Suhaya, S.IP.,M.Pd.', 'yudistira', '2007', '978-979-746-882-8', 'Buku ini memulai dengan pengenalan dasar tentang bahasa Sunda, termasuk sejarah, struktur, dan karakteristik uniknya. Selanjutnya, buku ini menguraikan berbagai aspek penting dalam bahasa Sunda, seperti fonologi, morfologi, sintaksis, serta ragam bahasa Sunda dalam berbagai konteks sosial dan budaya.', '125', 'Tersedia'),
('CE3-P-015-1', '../uploads/BOOK_CE-3/CE3-14.png', 'Bahasa Indonesia Kebanggan Bangsaku', 'Pendidikan', 'Sri Suryani, Yayat Nurhayat, Esti Suryani', 'PT Tiga Serangkai Pustaka Mandiri', '2013', '978-602-320-285-0', 'Bahasa Indonesia: Kebanggaan Bangsaku adalah buku yang mengangkat pentingnya Bahasa Indonesia sebagai identitas dan simbol kebanggaan bangsa. Buku ini mengeksplorasi sejarah perkembangan bahasa Indonesia, peranannya dalam membangun persatuan, serta kontribusinya dalam kebudayaan dan pendidikan di Indonesia.', '278', 'Tersedia'),
('CE3-S-005-1', '../uploads/BOOK_CE-3/CE3-5.png', 'Perlawanan &amp; Perubahan di Kalimantan Barat Kerajaan Sintang 1822-1942', 'Sejarah', 'Helius Sjamsuddin', 'OMBAK', '2013', '602-258-099-4', 'Buku ini merupakan kajian sejarah yang mencoba memahami perubahan - perubahan sosial polotik yang terjadi dalam sejarah panjang kerajaan sintang khususnya tanpa mengabaikan kerajaan - kerajaan lain di Kalimantan Barat pada umumnya', '469', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `book_kreatif_kids_corner`
--

CREATE TABLE `book_kreatif_kids_corner` (
  `id_book` varchar(20) NOT NULL,
  `photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category` varchar(255) DEFAULT NULL,
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

INSERT INTO `book_kreatif_kids_corner` (`id_book`, `photo`, `title_book`, `category`, `author_name`, `publisher_name`, `year_publish`, `isbn`, `sipnopsis`, `total_page`, `status`) VALUES
('CE4-A-007-1', '../uploads/BOOK_CE-4/CE4-1.png', 'Pendidikan Al-Quran', 'Agama', 'Irfan Fajaruddin, S.Pd.i., Habibah, S.A.g', 'Yayasan Pesantren Al Azhar', '2009', '-', 'Buku pendidikan Alquran yang ada di hadapan pembaca ini merupakan penyempurnaan dari buku pendidikan alquran yang telah diterbitkan sebelumnya dan disesuaikan dengan kurikulim tingkat satuan pendidika. Tujuannya adalah supaya mereka berminat untuk membacanya sendiri.', '81', 'Tersedia'),
('CE4-AA-002-1', '../uploads/BOOK_CE-4/CE4-15.png', 'The Happy Resto', 'Anak-anak', 'M.Rafid Nadhif Rizqullah', 'Mizan Publishing', '2020', '9.78602E+12', 'Karin dan Kiki sangat bersema-ngat mengikuti pekan magang. Tahun ini adalah pertama kalinya bagi Karin dan Kiki. Pekan magang hanya diikuti siswa kelas 4 dan 5, yang diadakan setiap akhir tahun pelajaran. Saat pembagian kelom-pok, Karima, Putra, Karin, dan Kiki berada dalam satu kelompok bersama Revan dan Dara. Keseruan terjadi ketika magang dimulai. Seru atau tegang, sih?\r\n* Kok, Karin sampai ketakutan begitu? Apalagi saat tercium b&amp;u bunga melati dan mawar yang membuat bulu kuduk berdiri.\r\nBarang-barang mereka hilang secara misterius. Ada apa di\r\nHappy Resto?', '80', 'Tersedia'),
('CE4-AA-003-1', '../uploads/BOOK_CE-4/CE4-14.png', 'Monster Balon', 'Anak-anak', 'Citra Mustiawati', 'Muffin Grafics', '2017', '9.78602E+12', 'Periadi kekacauan di Museum Balok! Monster balok ciptaan Martin dan Bowo menghancurkan seluruh benda yang add di dalam museum. Darko dan yang lainnya sudah berusaha menghentikannya, tapi tidak berhasil. Monster itu kuat sekali Kalau begitu, bagaimana cara menghentikannya?', '96', 'Tersedia'),
('CE4-AA-008-1', '../uploads/BOOK_CE-4/CE4-3.png', 'My Soulmate', 'Anak-anak', 'Citra Mustiawati', 'Muffin Grafics', '2019', '9.78602E+12', 'Toshi dan kucing kesayangannya, Yoru, memang tidak terpisahkan. Ke mana pun Toshi pergi pasti selalu bersama Yoru. Mereka sudah seperti belahan jiwa. Namun anehnya, pagi ini\r\nToshi tidak membawa Yoru ke sekolah. Teman-teman yang lain jadi heran dan bertanya di mana Yoru. Toshi berubah panik, ia baru menyadari kalau Yoru hilang. Sebenarnya, apa yang terjadi?', '80', 'Tersedia'),
('CE4-AA-009-1', '../uploads/BOOK_CE-4/CE4-2.png', 'Hadiah Terakhir Untuk Sofia', 'Anak-anak', 'Sarah Ann &amp; Muthia Fadhila Khairunnisa', 'Muffin Grafics', '2021', '9.78602E+11', 'Rasa sedih tidak bisa Rere hilangkan setiap kali teringat akal sahabathya, Sofia, yang saat inhi sedang ber juang melawar penyakit kankerhya. Rasanya tidak tega melihat sahabatnyo kesakitan. Tapi, Rere sudan ber jan ji untuk selalu ada ketiko Sofia membutuhkannya. Seperti saat in, Rere sedang merencanakan ke jutan lang tahun untuk Sofia. la berhara hadiahnya bisa membuat Sofia ceria dan tetap semangat melawan penyakitnya. Akankah rencana Rere ber jalan sesu dengan harapannya?', '92', 'Tersedia'),
('CE4-AA-010-1', '../uploads/BOOK_CE-4/CE4-6.png', 'Its Time To Sing', 'Anak-anak', 'Amalia Lovyna', 'Dar! Mizan', '2021', '9.78623E+12', 'Keisengan empat sahabat untuk mengikuti lomba menyanyi, membuat mereka menuju jalan yang tak terduga. Kiara, Alexa, Tara, dan Veronica membuat grup musik bersama Jennie, idola sekaligus sahabat mereka. Grup musik tersebut mereka namakan The Singing Flowers. Suatu hari, kelima sahabat itu mendapatkan komentar kebencian dari seseorang di media sosial, yang mengancam akan men jatuhkan The Singing Flowers. Orang itu bernama Kirana, ketua dari\r\nFive Stars yang juga merupakan grup musik terkenal.\r\nKedua grup musik tersebut akhirnya bertanding untuk mendapatkan predikat The Best Group selama tiga tahun berturut-turut. Yang kalah akan membubarkan grup musiknya.', '80', 'Tersedia'),
('CE4-AA-014-1', '../uploads/BOOK_CE-4/CE4-9.png', 'Kang Manda Mang ronda', 'Anak-anak', 'Tethy Ezokanzo', 'Map Plus', '2024', '9.78602E+12', 'Banyak sekali jenis pekerjaan di dunia ini, Misalnya pak satpam penjaga keamanan. ternyata satpam adalah sebuah pekerjaan yang hebat, butuh keberanian dan kewaspadaan', '24', 'Tersedia'),
('CE4-AA-015-1', '../uploads/BOOK_CE-4/CE4-10.png', 'Bi Esa, Bukan dokter biasa', 'Anak-anak', 'Tethy &amp; AAn', 'Map Plus', '2024', '9.78624E+12', 'Banyak orang datang kerumah bi esa, mereka yang lunglai karena capai. juga sakit karena terkilir, salah urat, atas kehendak Allah kesakitanpun sirna.', '24', 'Tersedia'),
('CE4-AA-016-1', '../uploads/BOOK_CE-4/CE4-11.png', 'Aku Tidak Suka Berbohong', 'Anak-anak', 'Leny Aryani', 'Bintang indonesia', '2021', '9.78602E+12', 'Hai teman teman, berbohong adalah perbuatan yang buruk yang dibenci oleh Allah', '24', 'Tersedia'),
('CE4-AA-017-1', '../uploads/BOOK_CE-4/CE4-12.png', 'Juz Amma For Kids', 'Agama', 'Nurul Ihsan', 'Smart Books', '2020', '-', 'Cara cerdas membaca dan menghafal Alquran disertai ilmu tazwid, dilengkapi doa harian anak muslim', '43', 'Tersedia'),
('CE4-AA-018-1', '../uploads/BOOK_CE-4/CE4-8.png', 'Abu Bakar Ash Shiddiq', 'Anak-anak', 'Kinara Putri', 'Pustaka Sandro Jaya', '2021', '9.78603E+12', 'Perbudakan alahan adat yang sudah berakar mendalam, dan fitur mencolok dari Makkah', '24', 'Tersedia'),
('CE4-F-006-1', '../uploads/BOOK_CE-4/CE4-5.png', 'Kumpulan dongeng si kancil', 'Fiksi', 'Asul Wiyanto', 'CV. Ilmu Magelang', '2011', '-', 'Dongeng binatang adalah cerita hayal tentang binatang, tokoh dalam cerita itu sebagian adalah binatang hebatnya , binatang dalam cerita itu dapat berbuat seperti manusia binatang itu dapat berbicara, berpikir, marah,dan sebagainya', '144', 'Tersedia'),
('CE4-P-004-1', '../uploads/BOOK_CE-4/CE4-7.png', 'Fly With English', 'Pendidikan', 'Frances Treloar, Steve Thompson', 'Marshall Cavendish', '2011', '9.78981E+12', 'Young Learners Go! is a six-level course for young learners. It is presented in three stages that correlate with the Starters, Movers and Flyers levels in the Cambridge Young Learners English Tests. It encourages learners to develop ownership of English by providing a solid foundation and positive experiences in learning English. Multiple intelligences are activated through specially crafted activities.\r\n* Spiral progression systematically builds language proficiency.\r\n* Immediate and focused practice through direct correlation of the Workbook to the Pupil&#039;s Book.\r\n* New language items are highlighted.\r\n* Revision units consolidate learning and help prepare for assessments.\r\n* Lesson plans in the Teacher&#039;s Guide integrate the Pupil&#039;s Book and Workbook and offer lead-in, follow-up and closing activities.', '88', 'Tersedia'),
('CE4-P-005-1', '../uploads/BOOK_CE-4/CE4-4.png', 'Mathematics', 'Pendidikan', 'Masykur Ali', 'Yudhistira', '2009', '9.78979E+12', 'Studying Mathematics is very important by studying mathematics you can do many things. therefore , we must study mathematics', '152', 'Tersedia'),
('CE4-P-019-1', '../uploads/BOOK_CE-4/CE4-13.png', 'Peristiwa Dalam Kehidupan', 'Pendidikan', 'Supriyanto', 'CV ARYADUTA', '2014', '9.78979E+12', 'Buku ini merupakan buku tematik terpadu. buku ini terdiri atas subtema, dimana setiap subtema terdiri atas 6 pembelajaran', '120', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `book_literasi_imajinatif`
--

CREATE TABLE `book_literasi_imajinatif` (
  `id_book` varchar(20) NOT NULL,
  `photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category` varchar(255) DEFAULT NULL,
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

INSERT INTO `book_literasi_imajinatif` (`id_book`, `photo`, `title_book`, `category`, `author_name`, `publisher_name`, `year_publish`, `isbn`, `sipnopsis`, `total_page`, `status`) VALUES
('CE1-A-014-1', '../uploads/BOOK_CE-1/CE1-13.png', 'Juz Amma for Kids', 'Agama', 'Nurul Ihsan', 'Smartbook', '2020', '-', 'Kamus visual dalam tiga bahasa Indonesia, Inggris, dan Arab disertai Ilustrasi menarik.', '43', 'Dipinjam'),
('CE1-AA-001-1', '../uploads/BOOK_CE-1/CE1-14.png', 'Jangan Pergi Gabby', 'Anak-anak', 'Assyifa S. Arum, dkk', 'Muffin Graphics', '2017', '978-602-367-425-1', 'Akhir-akhir ini, asrama putri tahun pertama sangat berantakan. Para putri malas merapikan asrama. Miss Gabby sampai kewalahan menegur mereka. Tapi, para putri tetap tidak mengubah perilaku mereka. Lalu, apa jadinya jika Miss Gabby meninggalkan asrama tahun pertama, ya?', '83', 'Tersedia'),
('CE1-AA-002-1', '../uploads/BOOK_CE-1/CE1-11.png', 'Belajar bersama Ayah', 'Anak-anak', 'Citra Mustikawati, dkk', 'Muffin Graphics', '2019', '978-602-367-773-3', 'Besok akan ada ulangan IPS di sekolah. Namun, Pitta sama sekali belum mengerti materinya. Sudah coba berkonsentrasi belajar pun, tetap saja tidak ada materi yang ia kuasai. Beruntung, ayah punya metode belajar yang asyik untuk Pitta. Yuk, kita lihat pengalaman Pitta belajar bersama ayah!', '92', 'Dipinjam'),
('CE1-AA-003-1', '../uploads/BOOK_CE-1/CE1-10.png', 'Fobia Gelap', 'Anak-anak', 'Syakila Nurrizal, Dkk', 'Muffin Graphics', '2019', '978-602-367-723-8', 'Diva paling takut dengan gelap. Ia tidak pernah tenang jika berada di ruangan yang gelap. Diva juga selalu mimpi buruk jika tidur dalam keadaan lampu kamar dimatikan. Sebenarnya, apa yang menyebabkan Diva fobia gelap, ya?', '92', 'Tersedia'),
('CE1-AA-010-1', '../uploads/BOOK_CE-1/CE1-12.png', 'Belajar Adab dan Cara Shalat', 'Anak-anak', 'Nurul Ihsan', 'Smartbook', '2019', '-', 'Shalat adalah ibadan yang diwajibkan umat muslim, ibadah shalat memiliki keistimewaan itu sendiri sehingga Allah SWT memerintahkannya pada hamba-hambanya.', '27', 'Tersedia'),
('CE1-AA-011-1', '../uploads/BOOK_CE-1/CE1-3.png', 'Putri yang Sombong', 'Anak-anak', 'Rudewidjaya', 'Map Plus Bandung', '2015', '978-602-0800-29-5', 'Suatu hari seorang raja membuat sayembara, untuk mencarikan pasangan buat putri raja, ternyata puluhan pemuda tidak mampu menjawab pertanyaan snag putri, sehingga mereka akhirnya dipenjara.', '24', 'Tersedia'),
('CE1-AA-012-1', '../uploads/BOOK_CE-1/Frame 2.png', 'Beruang yang Adil dan Bijaksana', 'Anak-anak', 'Gibran Maulana', 'Cahaya Agensi', '', '-', 'Disebuah hutan hiduplah seekor beruang, ia adalah pemimpin di rimba itu. Dalam memimpin ia sangat bijaksana dan adil sehingga binatang-binatang yang lain hormat kepadanya.', '24', 'Tersedia'),
('CE1-AA-013-1', '../uploads/BOOK_CE-1/CE1-4.png', 'Petualangan Kura-Kura', 'Anak-anak', 'Kris Irmasyah', 'Map Plus Bandung', '2024', '978-623-8469-08-6', 'Kura-kura adalah hewan yang lambatt namun mereka memiliki tempurung yang sangat kuat, tempurung yang sangat kuat, tempurungnya adalah rumah yang melindunginya dari segala macam bahaya.', '24', 'Tersedia'),
('CE1-AA-015-1', '../uploads/BOOK_CE-1/CE1-15.png', 'Gagak dan Kobra', 'Anak-anak', 'Rofiq A', 'Aktif Media', '', '978-602-0782-10-2', 'Sepasang burung gagak sengaja membuat sarang disebuah pohon di tepi hutan. Tapi ternyata dibawah pohon itu terdapat sarang Ular Kobra.', '24', 'Tersedia'),
('CE1-F-004-1', '../uploads/BOOK_CE-1/CE1-5.png', 'Seni Memahami, Hermeneutik dari Schleiermacher sampai Derrida', 'Filsafat', 'F. Budi Hardiman.', 'Kanisius', '2015', '978-979-21-4345-4', 'Buku ini dapat digunakan untuk memahami teori interpretasi pada umumnya dan untuk melengkapi studi filsafat, teologi, sastra, sosiologi, etnografi ilmu komunikasi, ilmu hukum, ilmu politik. Tidak semua tokoh secara eksplisit menyentuh persoalan interpretasi skriptural. Schleiermacher, Bultmann dan Ricoeur memang sibuk dengan kitab suci. Namun Dilthey mengembangkan hermeneutik untuk metode ilmiah, Heidegger untuk ontologi, Gadamer untuk pemahaman manusia dan kebudayaan pada umumnya, Habermas untuk kritik ideologi, dan Derrida untuk dekonstruksi metafisika.', '345', 'Tersedia'),
('CE1-N-005-1', '../uploads/BOOK_CE-1/CE1-1.png', 'Dendam arwah Jumat Kliwon', 'Novel', 'Donatus A. Nugroho', 'Narasi', '2018', '979-168-283-6', 'Aku sudah menunggu saat seperti ini. Saat dimana aku dapat menghukum mereka. Atas perbuatan mereka menodai malam suci Jum&#039;at Kliwon. Hari ketika aku dilahirkan harus bersih dari jiwa yang tersesat', '184', 'Tersedia'),
('CE1-N-006-1', '../uploads/BOOK_CE-1/CE1-9.png', 'Serendipity', 'Novel', 'Erisca Febriani', 'Penerbit Inari', '2018', '978-602-668-218-5', 'Dulunya, Arkan dan Rani adalah sepasang kekasih. Tiba-tiba, di sebuah taman kota, Arkan mengikrarkan bahwa mereka harus berpisah. Dua bulan telah berlalu. Sekarang, meskipun mereka satu kelas, Arkan tidak pernah lagi menyapanya. Kadang, memang selucu itu; mereka yang dulu bisa menghabiskan waktu berjam-jam hanya untuk mengobrol tentang apa pun, kini bahkan tidak tahu bagaimana caranya mengucapkan ?hai? atau ?selamat pagi?.', '424', 'Tersedia'),
('CE1-P-008-1', '../uploads/BOOK_CE-1/CE1-6.png', 'Buku Siswa Aktif dan Kreatif Belajar Geografi', 'Pendidikan', 'Lili Somantri', 'GRAFINDO MEDIA PRATAMA', '2016', '978-602-01-1781-2', 'Geografi merupakan mata pelajaran yang penting bagi siswa SMA/MA karena geografi merupakan ilmu yang mengkaji tentang bumi beserta seisinya.', '262', 'Tersedia'),
('CE1-P-009-1', '../uploads/BOOK_CE-1/CE1-7.png', 'Sejarah Indonesia', 'Pendidikan', 'Dwi Winarno dkk', 'Quadra', '2017', '978-602-3015-19-1', 'Pada akhir fase kelas X ini, peserta didik mampu mengembangkan konsep sejarah yang dapat digunakan untuk mengkaji peristiwa sejarah.', '144', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `book_pena_inspirasi_gemilang`
--

CREATE TABLE `book_pena_inspirasi_gemilang` (
  `id_book` varchar(20) NOT NULL,
  `photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category` varchar(255) DEFAULT NULL,
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

INSERT INTO `book_pena_inspirasi_gemilang` (`id_book`, `photo`, `title_book`, `category`, `author_name`, `publisher_name`, `year_publish`, `isbn`, `sipnopsis`, `total_page`, `status`) VALUES
('CE5-A-021-1', '../uploads/BOOK_CE-5/CE5-15.png', 'Alam Kubur (Alam Barzah)', 'Agama', 'M. Ali Chasan Umar', 'CV.Toha Putra Semarang', '1979', '-', 'Dalam buku ini, pembaca diajak untuk memahami konsep alam barzah berdasarkan dalil-dalil dari Al-Qur&#039;an dan Hadis, serta penjelasan dari para ulama. Buku ini menguraikan berbagai tahapan yang akan dilalui oleh setiap manusia setelah kematian, mulai dari proses pencabutan nyawa, pertanyaan-pertanyaan dari malaikat Munkar dan Nakir, hingga kondisi dan suasana di dalam kubur.', '160', 'Tersedia'),
('CE5-F-002-1', '../uploads/BOOK_CE-5/CE5-2.png', 'Hidung Pinokia Niko', 'Fiksi', 'Alya Namira Nasution, dkk', 'Dari Mizan', '2017', '978-623-254-085-9', 'Niko namanya, Sepintas dia terkesan menyenangkan. Namun bila suda mengenalnya lebih dari seminggu, siapapun akan mengetahui sifat aslinya. niko suka berbohong suatu ketika niko benar benar membuat mira kesal, mira pun tidak sengaja mengutuknya &quot;dasar tukang bohong, aku do&#039;akan hidungmu membesar seperti hidung pinokio kalau dia sedang berbohong&quot;', '88', 'Tersedia'),
('CE5-F-003-1', '../uploads/BOOK_CE-5/CE5-3.png', 'Mom Versus Dad', 'Fiksi', 'Geugeut Malia Dwi Andayu, Indha', 'Muffin Graphics', '2017', '978-602-367-685-9', 'Ayah dan ibu punya keahlihan yang berbeda. karna itu, tidak jarang mereka berbeda pendapat. walau begitu ayah dan ibu tetap kompak. Hmm, seperti apaya peran ibu dan ayah saat dirumah', '95', 'Tersedia'),
('CE5-F-004-1', '../uploads/BOOK_CE-5/CE5-4.png', 'Balirina', 'Fiksi', 'Mutia Fadhila, Nada Laila', 'Dari Mizan', '2017', '978-623-254-070-5', 'Sera Adalah seorang balerina yang rajin berlatih balet. dia sangat bangga dengan tariannya, meskipun terkadang kebanggaannya itu berubah menjadi rasa sombong.', '90', 'Tersedia'),
('CE5-F-008-1', '../uploads/BOOK_CE-5/CE5-8.png', 'Cerita Rakyat Nusantara', 'Fiksi', 'Trifia Astuti', 'Bintang Indonesia Jakarta', '2010', '602-218-856-3', 'Pada Zaman yang super canggih ini orang tua yang akan menasihati anaknya akan berfikir 7x. pesan dan nasihat memang mudah disampaikan, terutama kalau hanya disampaikan secara lisan. tapi efektif tidaknya pesan dan nasihat itu kita tidak tahu.', '96', 'Tersedia'),
('CE5-F-009-1', '../uploads/BOOK_CE-5/CE5-11.png', 'Writer VS Writer', 'Fiksi', 'Rhafi Nadhir Hasan, dkk', 'Dari Mizan', '2022', '978-623-254-235-8', '&quot;Tahun lalu, akhirnya aku terpilih menjadi penulis terfavorit aku senang sekali saat itu&quot; kata iva', '88', 'Tersedia'),
('CE5-F-010-1', '../uploads/BOOK_CE-5/CE5-12.png', 'Si Sekar Panggung', 'Fiksi', 'Tatang Sumarsono', 'Kiblat', '2009', '978-623-7295-33-4', 'Entom gancang ngaderagdeg, rek nyusul si oanggung anu ku kang gilang geus dibalikkeun arahna. kesang si panggung rembes saawak-awak.', '57', 'Tersedia'),
('CE5-F-014-1', '../uploads/BOOK_CE-5/CE5-13.png', 'Cerita Rakyat dari Jawa Tengah', 'Fiksi', 'James Danandjaja', 'Rasindo', '1992', '979-553-038-0', 'Cerita Rakyat adala cerita yang berasal dari masyarakat dan berkembang dalam masyarakat. jenisnya bermacam-macam, ada yang berupa legenda dan ada yang berupa dongeng', '50', 'Tersedia'),
('CE5-F-015-1', '../uploads/BOOK_CE-5/CE5-9.png', 'Celengan Persahabatan', 'Fiksi', 'Maharani Lathifa S, dkk', 'Muffin Graphics', '', '978-602-367-088-8', 'Wah enggak terasa celengan Nira sudah penuh, mira jadi pengen beli sepeda baru dengan hasil celengannya. tapi kasihan Meidina, baru saja mendapat musibah Mira jadi bingung antara ingin membantu Meidina atau tetap membeli sepeda', '78', 'Dipinjam'),
('CE5-P-001-1', '../uploads/BOOK_CE-5/CE5-1.png', 'EFFECTIVE UN SMP 2018/2019', 'Pendidikan', 'Wawan Wiharsono, dkk', 'CV. Pustaka Andromedia', '2018', '978-602-5757-10-5', 'Terdapat Faktor yang membuat seseorang dapat termotivasi untuk belajar, yaitu: Motivasi belajar berasal dari faktor internal motivasi ini terbentuk karena kesadaran diri atas pemahaman betapa pentingnya belajar untuk mengembangkan dirinya dan bekal untuk menjalani kehidupan', '330', 'Tersedia'),
('CE5-P-005-1', '../uploads/BOOK_CE-5/CE5-5.png', 'Pustaka Basa, Pengajaran Basa Sunda', 'Pendidikan', 'Drs. Enang Rusyana M.Pd', 'CV. Bina Pustaka', '2009', '979-979-26-0366-7', 'Pikeun ngaronjatkeun kaparigelan basa hidep, dina iyeu buku aya latihan-latihan. pra pigawe latihan latihanya.', '111', 'Tersedia'),
('CE5-P-006-1', '../uploads/BOOK_CE-5/CE5-6.png', 'Seni Budaya dan Keterampilan Kelas 2 SD', 'Pendidikan', 'Faida Delta, Mery Fonta, Victor Purba', 'Arya Duta', '2010', '978-979-750-684-1', 'Buku ini akan membantu belajar. mengenal macam-macam seni dan keterampilan juga mengenal budaya bangsa kita. sebagai pengetahuan yang berharga.', '140', 'Tersedia'),
('CE5-P-007-1', '../uploads/BOOK_CE-5/CE5-7.png', 'IPA 5 Salingtemas', 'Pendidikan', 'Choiril Azmiyawati, dkk', 'Arya Duta', '2008', '979-462-902-2', 'Pelajaran IPA tidak bisa dipisahkan dengan masalah sains, lingkungan, tekhnologi, dan masyarat', '186', 'Tersedia'),
('CE5-P-016-1', '../uploads/BOOK_CE-5/CE5-10.png', 'Bahasa Indonesia 1', 'Pendidikan', 'Tika Hatikah Mulyanis', 'Grafindo Media Pratama', '2018', '978-602-01-2014-0', 'Inginkah anda menjadi siswa yang memiliki kemampuan menalar yang baik? Pembelajaran Bahasa Indonesia dapat menjadi sarananya.', '232', 'Tersedia'),
('CE5-P-017-1', '../uploads/BOOK_CE-5/CE5-14.png', 'Matematika', 'Pendidikan', 'Abdur Rahman As&#039;ari, dkk', 'Pusat Kurikulum dan Perbukuan, Balitbang, Kemendikbut', '2014', '978-602-282-351-3', 'Pembelajaran Matematika Diarahkan agar peserta didik mampu berfikir rasional dan kreatif, mampu berkomunikasi dan bekerjasama, jujur, konsisten, dan tangguh menghadapi masalah serta mampu mengubah masalah menjadi peluang.', '218', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `book_social_connect`
--

CREATE TABLE `book_social_connect` (
  `id_book` varchar(20) NOT NULL,
  `photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category` varchar(255) DEFAULT NULL,
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

INSERT INTO `book_social_connect` (`id_book`, `photo`, `title_book`, `category`, `author_name`, `publisher_name`, `year_publish`, `isbn`, `sipnopsis`, `total_page`, `status`) VALUES
('CE2-A-006-1', '../uploads/BOOK_CE-2/CE2-3.png', 'Pendidikan Agama Islam Dan Budi Pekerti', 'Agama', 'Drs. Sadi., M.Si dan Drs. H.M Nasikin, M.Pd', 'Pt. Penerbit Erlangga', '2016', '978-602-298-930-1', 'Buku Pendidikan Agama Islam Dan Budi Pekerti Untuk Sma Jilid 1 Ini Disusun Sebagai Buku Teks Pelajaran Agama Islam Kelas X Sekolah Menengah Atas (Sma). Buku Ini Dikembangkan Dengan Konsep Bahwa Belajar Agama Islam Adalah Bagian Tak Terpisahkan Dari Amal Atau Perbuatan Sehari-Hari, Sehingga Siswa Mampu Memahami Persoalan Hidup Dan Mengambil Peran Sebagai Pemberi Solusi Sesuai Ajaran Islam Dengan Kepekaan Mengajak Pada Kebaikan Dan Mencegah Kemungkaran.', '267', 'Tersedia'),
('CE2-AA-002-1', '../uploads/BOOK_CE-2/CE2-9.png', 'Pitta Dan Negeri Ajaib: Piknik Bersama', 'Anak-anak', 'Citra Mustikawati', 'Curhat Anak Bangsa', '2020', '978-602-367-834-1', 'Setiap Hari Ibu Selalu Bekerja Keras Mulai Dari Menyiapkan Kebutuhan Pitta Dan Ayah, Belanja, Memasak, Sampai Membersihkan Rumah Agar Tetap Bersih Dan Rapi.', '92', 'Tersedia'),
('CE2-AA-003-1', '../uploads/BOOK_CE-2/CE2-7.png', 'Komik Next G: Rahasia Mimi', 'Anak-anak', 'Syakira Nuri Muthaiminnah dan Satrio', 'Curhat Anak Bangsa', '2013', '978-602-367-644-6', 'Sudah Tiga Hari Mimi Menolak Ajakan Rina Untuk Pulang Sekolah Bersama .Padahal, Biasanaya Mereka Selalu Pulang Bersama. Rina Jadi Curiga Mimi Menyembunyikan Sesuatu Darinya.', '100', 'Tersedia'),
('CE2-AA-004-1', '../uploads/BOOK_CE-2/CE2-4.png', 'Ghost School Days: Buku Rahasia', 'Anak-anak', 'Citra Mustikawati', 'Curhat Anak Bangsa', '2015', '978-602-367-663-7', 'Pagi Ini Dikelas, Tole Sibuk Mencatat Sesuatu Dibukunya, Dens Jadi Penasaran Apa Yang Sedang Ditulis Tole. Sayangnya, Tole Tidak Mau Memberitahu Dan Malah Menyembunyikan Bukunya Dari Dens.', '102', 'Tersedia'),
('CE2-AA-011-1', '../uploads/BOOK_CE-2/CE2-11.png', 'Si Kancil Dan Babi Hutan Yang Sombong (The Mouse Deer And The Arrogant Wild Boar)', 'Anak-anak', 'Rudewidjaya', 'Map Plus, Bandung', '', '978-602-0800-39-4', 'Disebuah Hutan Tropis, Hiduplah Seekor Babi Hutan Yang Sangat Ditakuti Oleh Binatang Lain. Babi Itu Sangat Sombong. Sengaja Ia Mendorong Pohon Mangga Hingga Tumbang Menggunakan Kedua Taringnya. Semua Binatang Selalu Diam Ketakutan Setiap Babi Itu Menantang Mereka Namun Tidak Dengan Kancil, Tanpa Rasa Takut Kancil Menjawab Perkataan Babi Yang Sombong Itu.', '23', 'Tersedia'),
('CE2-N-005-1', '../uploads/BOOK_CE-2/CE2-6.png', 'Koala Kumal', 'Novel', 'Raditya Dika', 'Gagasmedia', '2014', '979-780-769-X', 'Selain Main Perang-Perangan, Gue, Dodo, Dan Bahri Juga Suka Berjemur Di Atas Mobil Tua Warna Merah Yang Sering Diparkir Di Pinggir Sungai Samping Kompleks. Formasinya Selalu Sama: Bahri Dague Tiduran Di Atap Mobil, Sedangkan Dodo, Seperti Biasa, Agak Terbuang, Di Atas Bagasi.', '250', 'Tersedia'),
('CE2-P-001-1', '../uploads/BOOK_CE-2/CE2-10.png', 'Perencanaan Pembangunan Daerah Dalam Era Otonomi', 'Pendidikan', 'Sjafrizal', 'Pt Raja Grafindo Persada', '2014', '978-979-769-703-7', 'Buku Ini Menguraikan Secara Rinci Dan Praktis Sistem Serta Perencanaan, Penerapan Pembangunan Daerah Di Indonesia', '404', 'Tersedia'),
('CE2-P-007-1', '../uploads/BOOK_CE-2/CE2-5.png', 'Bahasa Jepang', 'Pendidikan', 'Dwi Andi Susanto', 'Cv Dino Mandiri (Anggota Ikapi)', '2019', '978-602-6674-48-7', 'Tulisan Bahasa Jepang Berasal Dari Tulisan Bahasa China Yang Diperkenalkan Pada Abad Keempat Masehi. Sebelum Ini, Orang Jepang Tidak Mempunyai Sistem Penulisan Sendiri.', '287', 'Tersedia'),
('CE2-P-008-1', '../uploads/BOOK_CE-2/CE2-2.png', 'Competencies Entrepreneur (Mencari Atau Menciptakan Peluang)', 'Pendidikan', 'R. Agus Setyo Pranowo, S.E., M.M', 'Manggu Makmur Tanjung Lestari', '2018', '978-602-5717-12-3', 'Siapa Pun Bisa Menjadi Seorang Entreprenuer Sukses. Seperti Pepatah, Asalkan Ada Kemavan Pasti Ada Jalan. Berwirausaha Tidak Harus Dimulai Dengan Modal Uang Yang Besar, Tetapi Modal Yang Harus Anda Miliki Adalah Kemauan! Dengan Kemauan Ditambah Dengan Komitmen Tinggi, Pastinya, Jalan Anda Menuju Kesuksesan Semakin Jelas Terbentang.', '149', 'Tersedia'),
('CE2-P-010-1', '../uploads/BOOK_CE-2/CE2-1.png', 'Bahasa Perancis: Salut, Ca Va? 1', 'Pendidikan', 'Dra. Hj.Delly Anne, M.M', 'Lazuardi Nusantara', '2018', '978-979-18-784-1-8', 'Buku Ini Dirancang Dengan Pola &quot;Active Learning&quot; Seperti Yang Diamanatkan Kurikulum 2013. Di Dalamnya Dituliskan Kompetensi Dasar Dan Materi Pembelajaran Yang Dikutip Dari Silabus Bahasa Prancis. Pembelajaran Dibagi Dalam Beberapa Aktivitas Yang Dirancang Agar Peserta Didiklah Yang Lebih Aktif. Aktivitas Tersebut Mengarah Kepada Pendekatan Saintifik Yang Mendorong Peserta Didik Untuk Mengamati, Menanya, Mengumpulkan Informasi, Mengasosiasi Dan Mengomunikasikan.', '197', 'Tersedia'),
('CE2-S-009-1', '../uploads/BOOK_CE-2/CE2-8.png', 'Ringkasan Sejarah Nabi Muhammad Saw', 'Sejarah', 'Muhammad Idris Jauhari', 'Mutiara Press', '2017', '-', 'Mempelajari Sejarah Hidup Seorang Tokoh Atau Pemimpin Bukan Hanya Untuk Mengetahui Hidup Dan Perikehidupannya Yang Ada Dan Berpengaruh Pada Pribadi Serta Lingkungannya, Tetapi Yang Lebih Penting Adalah Agar Dapat Menghayati Dan Mengamalkan Setiap Nilai Dan Perilaku Yang Berkembang Atau Sengaja Di Kembangkannya.', '162', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing_bisnis_berdaya`
--

CREATE TABLE `borrowing_bisnis_berdaya` (
  `id_borrow` int NOT NULL,
  `id_book` varchar(20) DEFAULT NULL,
  `id_user` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrowing_kreatif_kids_corner`
--

CREATE TABLE `borrowing_kreatif_kids_corner` (
  `id_borrow` int NOT NULL,
  `id_book` varchar(20) DEFAULT NULL,
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
  `id_book` varchar(20) DEFAULT NULL,
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
(1, 'CE1-AA-001-1', 0, 'Salwa', 'Jangan Pergi Gabby', '2024-08-16', '2024-08-23', 'Tersedia'),
(2, 'CE1-AA-002-1', 0, 'Hafizi', 'Belajar bersama Ayah', '2024-08-16', '2024-08-18', 'Dipinjam'),
(3, 'CE1-A-014-1', 0, 'Hafizi', 'Juz Amma for Kids', '2024-02-23', '2004-02-25', 'Dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing_pena_inspirasi_gemilang`
--

CREATE TABLE `borrowing_pena_inspirasi_gemilang` (
  `id_borrow` int NOT NULL,
  `id_book` varchar(20) DEFAULT NULL,
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
(1, 'CE5-F-015-1', 0, 'Hafizi', 'Celengan Persahabatan', '2006-07-06', '2024-08-08', 'Dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing_social_connect`
--

CREATE TABLE `borrowing_social_connect` (
  `id_borrow` int NOT NULL,
  `id_book` varchar(20) DEFAULT NULL,
  `id_user` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
('CE1', 'Literasi Imajinatif', 'RW 6, Kelurahan Cipaku', 0, 0, 0),
('CE2', 'Social Connect', 'RW 15, Kelurahan Cipaku', 0, 0, 0),
('CE3', 'Bisnis Berdaya', 'RW 9, Kelurahan Cipaku', 0, 0, 0),
('CE4', 'Kreatifitas Kids Corner', 'RW 17, Kelurahan Cipaku', 0, 0, 0),
('CE5', 'Pena Inspirasi Gemilang', 'RW 4, Kelurahan Cipaku', 0, 0, 0);

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
(1, 'Namaku Kali', 'Cerpen', 'Anna Farida dan Felishia', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '200', '2022', '978-602-427-921-9', 'Anak itu datang lagi! Kali selalu suka melihat anak itu. Apa yang akan dia lakukan hari ini?', 'uploads/ebook/ebook-001-namakukali.png', 'uploads/ebook/Namaku_Kali.pdf'),
(2, 'Aku Sudah Besar', 'Cerpen', 'Futri Wijayanti', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '16', '2022', '978-602-244-930-0', 'Ayah dan Ibu sibuk dengan Adik. Aku mulai iri. Namun aku sudah besar. Bolehkah aku ikut mengasuh Adik?', 'uploads/ebook/ebook-002-akusudahbesar.png', 'uploads/ebook/Aku_Sudah_Besar.pdf'),
(3, 'Apa Itu?', 'Umum', 'Laksmi Manohara, Aira Rumi', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '23', '2022', '978-602-244-939-3', 'Tia dan teman-temannya pergi ke Desa Cisupa. Ada pawai sisingaan di sana. Dalam perjalanan, ada sesuatu mengikuti mereka. Apa itu?', 'uploads/ebook/ebook-003-apaitu.png', 'uploads/ebook/Apa_Itu.pdf'),
(4, 'Biji Merah Luna', 'Pendidikan', 'Ammy Kudo', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '17', '2022', '978-602-244-926-3', 'Biji merah itu bagus. Sayang hanya sedikit. Yuk, lihat Luna. Dia sedang apa?', 'uploads/ebook/ebook-004-bijimerahluna.png', 'uploads/ebook/Biji_Merah_Luna.pdf'),
(5, 'Coba dulu Tora', 'Cerpen', 'Sri Sarastuti', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '33', '2022', '978-602-244-942-3', 'Tora baru saja pindah ke pohon baru yang nyaman. Sayangnya, dia jadi malas bergerak. Bahkan dia sering menunda keinginan buang air besar. Akibatnya, Tora malah jadi susah buang air besar.', 'uploads/ebook/Cuplikan layar 2024-07-18 161703.png', 'uploads/ebook/Coba_Dulu_Tora.pdf'),
(6, 'Dimana Kacang Sipet', 'Cerpen', 'Aris Hartanti', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '23', '2022', '978-602-244-935-5', 'Sipet mengumpulkan kacang untuk persediaan. Namun, kacang Sipet hilang! Di mana kacang Sipet?', 'uploads/ebook/ebook-006-dimanakacangsipet.png', 'uploads/ebook/Dimana_Kacang_Sipet.pdf'),
(7, 'Gadis Rempah', 'Pendidikan', 'Musrifah Medkom', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '185', '2023', '978-623-118-030-8', 'Arumi seorang gadis remaja yang sangan bermimpi menjadi seorang desainer produk. Namun, mimpi dan kenyataan sangatlah berbeda dari harapannya. Di mata Ibunya, semua yang dilakukannya', 'uploads/ebook/ebook-007-gadisrempah.png', 'uploads/ebook/Gadis_Rempah.pdf'),
(8, 'Karena Anggrek Ibu', 'Pendidikan', 'Debby Lukito Goeyardi, Widyasari Hanaya', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '47', '2022', '978-602-244-944-7', 'Janu bingung dan takut. Sekolah memberi surat edaran, tapi Janu lupa menyerahkan surat itu kepada ibu. Ibu sangat disiplin, apalagi kalau menyangkut soal uang. Semua harus direncanakan. Jadi, Janu memutuskan', 'uploads/ebook/ebook-008-karenaanggrekibu.png', 'uploads/ebook/Karena_Anggrek_Ibu.pdf'),
(9, 'Naik-naik Kepuncak Bukit', 'Pendidikan', 'Sarah Fauzia', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '25', '2022', '978-602-244-937-9', 'Bulan dan Sabit biasa berjalan kaki setiap pagi. Mereka ingin mencoba pengalaman baru. Kali ini mereka akan mendaki bukit! Masalahnya, keadaan di sana tidak mudah bagi Sabit. Apa yang dialami Sabit?', 'uploads/ebook/ebook-011-naiknaikkepuncakbukit.png', 'uploads/ebook/Naik_Naik_Kepuncak_Bukit.pdf'),
(10, 'Si Cemong Coak', 'Pendidikan', 'Iwok Abqary', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '55', '2022', '978-602-244-922-5', 'Cemong selalu iri melihat kucing-kucing yang mengenakan kerincing. Baginya, Kerincing melambangkan rumah dan kasih sayang. Bisakah ia meiliki kerincing yang diimpikan? Ia hanyalah kucing liar tak bertuan.', 'uploads/ebook/si_cemong_coak.png', 'uploads/ebook/Si_Cemong_Coak.pdf'),
(11, 'Misteri Drumben Tengah Malam', 'Novel', 'Dian Kristiani', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '154', '2023', '978-623-118-008-7', 'Bagi Faben, tinggal di Yogya sungguh menyebalkan. Makanan, teman-teman, dan cuacanya sungguh berbeda dengan Bengkulu, kota kelahirannya. Namun, Faben tak punya pilihan. Dia harus', 'uploads/ebook/misteri_drumben_tengah_malam.png', 'uploads/ebook/Misteri_Drumben_Tengah_Malam.pdf'),
(12, 'Sekolah Untuk Timur', 'Novel', 'Muhammad Fauzi, Izzah Annisa', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '176', '2023', '978-623-118-012-4', 'Timur adalah bocah manis dari Wamena, Papua. Dia baru lulus SD dan ingin melanjutkan ke SMP. Namun, jarak rumah dengan SMP sangat jauh. Apalagi, Bapak melarang Timur melanjutkan', 'uploads/ebook/Sekolah_untuk_timur.png', 'uploads/ebook/Sekolah_Untuk_Timur.pdf'),
(13, 'Rumah Wortel', 'Sastra', 'Helga K.', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '24', '2022', '978-602-244-924-9', 'Elis suka sekali makan wortel. Namun, wortel sedang langka. Elis menanam wortel sendiri. Apakah dia akan berhasil?', 'uploads/ebook/Rumah_wortel.png', 'uploads/ebook/Rumah_Wortel.pdf'),
(14, 'Layur Tetaplah Berlayar', 'Sastra', 'Anang YB', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '264', '2023', '978-623-118-058-2', 'Seorang remaja putri bernama Layur mengalami kecelakaan pada kakinya setelah terkena ledakan bom ikan. Dusun tersebut dulunya makmur, tetapi sejak penggunaan bom ikan menjadi kebiasaan, lautan dan terumbu karang sekitar', 'uploads/ebook/Layur_tetaplah_berlayar.png', 'uploads/ebook/Layur_Tetaplah_Berlayar.pdf'),
(15, '5 Pandawa Penglipuran', 'Sastra', 'Sarah Fauzia', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '48', '2023', '978-623-118-022-3', 'Kondisi Bumi tidak baik-baik saja. Koloni di Mars juga membutuhkan oksigen lebih banyak lagi. Empat pemuda dari Mars pergi ke Bumi untuk memulihkan lingkungan', 'uploads/ebook/5_pandawa_penglipuran.png', 'uploads/ebook/Lima_Pandawa_Penglipuran.pdf'),
(16, 'Mengejar Haruto', 'Sastra', 'Dewi Cholidatul', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '186', '2023', '978-623-118-016-2', 'Jalu ingin menyusul Abah ke Jepang. Dia ingin pergi ke desa Shirakawa,setting tempat serial komik dan manga jepang paling terkenal, Haruto, Konon, desa itu mirip sekali dengan kampung Halamannya, Kampung Naga. Namun,', 'uploads/ebook/Mengejar_haruto.png', 'uploads/ebook/Mengejar_Haruto.pdf'),
(17, 'Nanti Saja', 'Sastra', 'Fransisca Emilia', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '33', '2022', '978-602-244-941-6', 'Inur harus menyelesaikan prakarya hari ini karena besok harus dikumpulkan. Tapi, Abah minta tolong Inur mengantar minyak jelantah ke bank sampah. Berhasilkan Inur mengerjakan tugas sekolahnya? Apa yang ia buat?', 'uploads/ebook/Nanti_saja.png', 'uploads/ebook/Nanti_Saja_compressed.pdf'),
(18, 'Pilus Rumput Laut Untuk Rasi', 'Sastra', 'Nabila Adani', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '47', '2022', '978-602-244-943-0', 'Berli risau karena panen rumput laut di daerahnya berkurang. Lalu, Berli mendapat ide. Ia memposting sesuatu di media sosialnya. Postingan itu ternyata membuat Berli terkenal, tetapi …. Oh, sahabatnya, Rasi,', 'uploads/ebook/Pilus_rumput_laut_untuk_rasi.png', 'uploads/ebook/Pilus_Rumput_Laut_Untuk_Rasi.pdf'),
(19, 'Putri di Dalam Hutan', 'Sastra', 'Wiratu Emi', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '57 Halaman', '2022', '978-602-244-940-9', 'Neo dan Nara ikut orang tuanya ke Pulau Samosir. Mamanya seorang peneliti burung yang sedang meneliti burung endemik. Suatu hari saat mereka mengikuti orang tuanya di hutan mereka mencium bau wangi', 'uploads/ebook/Putri_di dalam_hutan.png', 'uploads/ebook/Putri_Didalam_Hutan.pdf'),
(20, 'Tidak Bisa TIdak', 'Teknologi', 'Lenny Puspita Ekawaty', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '33', '2022', '978-602-244-945-4', 'Dito ingin menempati peringkat teratas di gim Kota Baru bersama temantemannya. Dia bahkan sampai membuka tabungannya untuk membeli voucer gim. Saat peringkat mulai meningkat,', 'uploads/ebook/Tidak_bisa_tidak.png', 'uploads/ebook/Tidak_Bisa_Tidak.pdf'),
(21, 'Tiup - Tiup', 'Sastra', 'Ana Falesthin T. A.', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '24', '2022', '978-602-244-928-7', 'dengan uang tabungannya. Setiap hari, dia meniup seruling itu. Namun, Pak Kumis marah-marah. Apa yang terjadi, ya?', 'uploads/ebook/Tiup_tiup.png', 'uploads/ebook/Tiup_Tiup.pdf'),
(22, 'Komik Rampai:  Kembalinya Para Lemak', 'Sastra', 'Sri Sarastuti,  dkk.', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '13', '2023', '978-623-118-024-7', 'Penampilan keren merupakan impian. Remaja pun tidak terlepas dari keinginan untuk dapat terlihat menarik dan penuh gaya. Komik Rampai ini berisi kisah Vanya dan Vino, Tiara,', 'uploads/ebook/Rahasia_kakek_sehat.png', 'uploads/ebook/Vanya_dan_Vino.pdf'),
(23, 'Komik Rampai: Sekilas Yami', 'Sastra', 'Yudha Pangesti, dkk.', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '13', '2023', '978-623-118-026-1', 'Penampilan keren merupakan impian. Remaja pun tidak terlepas dari tantangan untuk dapat terlihat menarik dan penuh gaya. Tentu saja setiap remaja mempunyai deinisi', 'uploads/ebook/Rio & jabrik.png', 'uploads/ebook/Yami_Sinta_Rio_Aji.pdf'),
(24, 'Anak - anak Sungai Sondong', 'Sastra', 'Ramajani Sinaga', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '98', '2023', '978-623-118-767-3', 'Sungai-sungai mengalir memberi kehidupan, tapi tangan manusia menghadangnya, Warnanya menjadi pekat, hitam, dan kumuh Sungai-sungai mengalir ke kehidupan Tangan manusia mengembalikannya Warnanya kembali jernih bagai embun pagi', 'uploads/ebook/anak - anak sungai sondong.png', 'uploads/ebook/Anak_Sungai_Sondong.pdf');

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
(1, 'uploads/umkm/kue bangkit.jpeg', 'uploads/umkm/kue bangkit 2.jpg', 'uploads/umkm/kue bangkit 3.jpg', 'uploads/umkm/kue bangkit 4.jpg', 'Makanan dan Minuman', 'Kue Coklat', '40000', 'salah satu kue tradisional indonesia khas masyarakat Melayu yang berasal dari Pulau Sumatera(Riau)', 'UMKM-5'),
(2, 'uploads/umkm/4-jenis-jamu-tradisional-dan-manfaatnya-untuk-kesehatan.jpg', 'uploads/umkm/1662011925820-cara-membuat-jamu-tradisional-di-rumah-dengan-bahan-yang-simple.jpg', 'uploads/umkm/thumbnail_93.jpg', 'uploads/umkm/X-Jamu-Tradisional-Indonesia-dengan-Segudang-Manfaat.jpg', 'Obat Herbal', 'Jamu', '45000', 'Jamu Sehat Alami adalah minuman herbal tradisional yang diracik dari bahan-bahan alami berkualitas tinggi untuk menjaga kesehatan dan kebugaran tubuh Anda. Diperkaya dengan rempah-rempah pilihan seperti kunyit, jahe, temulawak, dan serai, jamu ini memberikan manfaat kesehatan yang optimal dengan rasa yang khas dan menyegarkan', 'UMKM-2'),
(3, 'uploads/umkm/aneka sambal.jpg', 'uploads/umkm/aneka sambal 2.jpg', 'uploads/umkm/aneka sambal 3.jpeg', 'uploads/umkm/aneka sambal 4.jpg', 'Makanan dan Minuman', 'Sambal', '30000', 'Nikmati sensasi pedas yang autentik dengan Sambal Pak Jarwo! Terbuat dari bahan-bahan pilihan berkualitas tinggi, sambal ini menghadirkan cita rasa pedas yang khas dan lezat. Setiap sendoknya merupakan perpaduan sempurna antara cabai segar, bawang putih, bawang merah, dan rempah-rempah tradisional Indonesia, yang diolah dengan penuh cinta dan keahlian.', 'UMKM-4'),
(6, '../uploads/umkm/Cuplikan layar 2024-08-16 023043.png', '../uploads/umkm/Cuplikan layar 2024-08-16 023143.png', '../uploads/umkm/Cuplikan layar 2024-08-16 023110.png', '../uploads/umkm/Cuplikan layar 2024-08-16 023003.png', 'Kerajinan Tangan', 'Batik Organik', '95000', 'Batikorganik punya batik yang lebih manis dari pada coklat , series cosksu 🤎✨ punya warna yang soft dan masuk untuk wanita dan pria . warna yang modern mengikuti zaman jadi aman banget untuk semua kalangan umur 🤗 satu kain cukup untuk 1 baju ya (kemeja/blouse) ✨ Yakin Cuma di padanga aja ? check out yuk jangan sampai terlewatkan ✨', 'UMKM-1');

-- --------------------------------------------------------

--
-- Table structure for table `profile_kelurahan`
--

CREATE TABLE `profile_kelurahan` (
  `id_profile` int NOT NULL,
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

--
-- Dumping data for table `profile_kelurahan`
--

INSERT INTO `profile_kelurahan` (`id_profile`, `luas_wilayah`, `jumlah_rw`, `jumlah_rt`, `anak_anak`, `remaja`, `dewasa`, `jumlah_penduduk`, `laki_laki`, `perempuan`, `tamat_sd_smp`, `tamat_sma`, `tamat_sarjana`, `deskripsi`) VALUES
(1, '± 174 hektar', 10, 29, 6129, 1539, 738, 12310, 6181, 6129, 6139, 5660, 200, 'Kelurahan Cipaku adalah salah satu kelurahan yang terletak di Kecamatan Bogor Selatan. Mayoritas penduduk di Kelurahan Cipaku bekerja sebagai buruh, pedagang, pengrajin industri rumah tangga, pengusaha kecil dan menengah, pegawai swasta dan lain-lain. Karena berada di wilayah Kota Bogor. Kelurahan Cipaku sebagian besar diperuntukkan untuk Pemakaman/Kuburan Thiong Hoa/China. Masih banyak kekurangan yang dimiliki oleh kelurahan ini, masalah terbesarnya yaitu rendahnya kualitas SDM, minat literasi yang rendah, dan tingginya angka putus sekolah.');

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
('UMKM-5', 'Salwa Salsabil', '085732185809', 'Kp. Cipaku Skip, Kelurahan Cipaku, Kota Bogor');

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

-- --------------------------------------------------------

--
-- Table structure for table `web_traffic`
--

CREATE TABLE `web_traffic` (
  `id` int NOT NULL,
  `visit_date` date NOT NULL,
  `visit_count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `web_traffic`
--

INSERT INTO `web_traffic` (`id`, `visit_date`, `visit_count`) VALUES
(1, '2024-08-05', 5),
(2, '2024-08-06', 26),
(3, '2024-08-07', 26),
(4, '2024-08-08', 15),
(5, '2024-08-09', 22),
(6, '2024-08-10', 27),
(7, '2024-08-12', 78),
(8, '2024-08-13', 24),
(9, '2024-08-15', 5),
(10, '2024-08-16', 51),
(11, '2024-08-17', 2);

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
-- Indexes for table `profile_kelurahan`
--
ALTER TABLE `profile_kelurahan`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indexes for table `seller_umkm`
--
ALTER TABLE `seller_umkm`
  ADD PRIMARY KEY (`id_seller`);

--
-- Indexes for table `web_traffic`
--
ALTER TABLE `web_traffic`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `borrowing_bisnis_berdaya`
--
ALTER TABLE `borrowing_bisnis_berdaya`
  MODIFY `id_borrow` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `borrowing_kreatif_kids_corner`
--
ALTER TABLE `borrowing_kreatif_kids_corner`
  MODIFY `id_borrow` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id_borrow` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_umkm`
--
ALTER TABLE `product_umkm`
  MODIFY `id_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `profile_kelurahan`
--
ALTER TABLE `profile_kelurahan`
  MODIFY `id_profile` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `web_traffic`
--
ALTER TABLE `web_traffic`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
