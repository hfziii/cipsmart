-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 17, 2024 at 09:41 AM
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
(5, 'budi', 'Social Connect', '2024-07-15');

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
  `acsess` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `name`, `nohp`, `username`, `password`, `acsess`) VALUES
(1, 'Muhamad Hafizi', '085157181162', 'hafiziadmin', 'masuk372', 'super admin'),
(2, 'admin', '085122890190', 'admin', 'admin', 'super admin');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id_book` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `author_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `publisher_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `year_publish` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `sipnopsis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_page` varchar(10) NOT NULL,
  `corner_education` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id_book`, `photo`, `title_book`, `author_name`, `publisher_name`, `year_publish`, `isbn`, `sipnopsis`, `total_page`, `corner_education`, `status`) VALUES
('BC-006', 'uploads/G7.png', 'Dongeng Negeri 1001 Malam', 'Nunik Utami', 'Penebar-Swadaya', '2010', '978-979-78826-0-0', 'sobat cilik pasti senang, kisah 1001 malam ini akan mengajakmu menikmati cerita dan petualangan seru para tokohnya, selain menarik buku ini dilengkapi nilai kehidupan.', '140', '2', 'Tersedia'),
('BC-008', 'uploads/G9.png', 'Dongeng Lengkap Kancil', 'Kak Thifa', 'Laksana', '2020', '978-602-40778-1-5', 'Seekor hewan berwarna hijau merayap di atas daun hijau. Bentuknya seperti cecak besar dan berkaki empat. “Hewan apa itu, ya?” tanya Kancil yang sedang menuju sungai untuk minum.', '124', '2', 'Tersedia'),
('BC-009', 'uploads/G10.png', 'Petualangan Di Negeri Dongeng', 'Lia Heliana', 'LovRinz-Publishing', '2021', '978-623-28993-7-7', 'Sausan mencari Jully sahabatnya yang menghilang di negeri dongeng. Ia tidak menyangka ternyata di sana akan bertemu dengan tokoh tokoh cerita dengan berbagai masalahnya.', '192', '2', 'Tersedia'),
('BC-010', 'uploads/G11.png', 'Dahsyatnya Dongeng', 'Roro Elis', 'Penerbit-Andi', '2022', '978-623-01187-5-3', 'Dongeng selalu disuka oleh anakanak. Aneka dongeng merupakan kisah fiksi memang mampu membuai siapapun yang membaca, menonton maupun mendengarkan. Keindahan alam imajinasi yang disajikan di dalam sebuah kisah dongeng mampu melambungkan khayal anak, sekaligus membawanya ke dalam sebuah suasana indah penuh impian. Bahkan tak hanya anak-anak, remaja bahkan orang dewasa pun banyak yang menyukai dongeng.', '158', '2', 'Tersedia'),
('BC-011', 'uploads/G12.png', 'Petualangan Rhino Kumbang dan Kumpulan Dongeng Karakter Anak', 'Siti Fatimah, S. Pd., M. Pd', 'Penerbit-Andi', '2023', '978-6234-7104-7-2', 'Rhino Kumbang kegirangan. Sepertinya angin mendengar seruan Rhino Kumbang. Tak lama kemudian angin pun bertiup kencang. Di tengah kegirangannya, Rhino Kumbang mulai ... Rhino. ', '124', '3', 'Tersedia'),
('BC-012', 'uploads/G13.png', 'Sella Cerita Anak', 'Radius S. K. Siburian', 'CV Jejak (Jejak Publisher)', '2021', '978-623-33841-1-7', 'Gadis cilik yang senang belajar. Dulu, tinggal di Jakarta bersama orang tuanya.Covid-19 merebak ke penjuru dunia termasuk Indonesia. Ayahnya sebagai tulang punggung keluarga harus menerima kenyataan pahit. Sella harus turut keinginan orang tuanya: pulang kampung.Masihkah semangat belajar Sella terus menyala seperti kala ia di kota? Bagaimana Sella mampu beradaptasi dengan lingkungan baru? Apakah Sella sanggup hidup di pedesaan dengan kondisi yang justru hampir berbanding terbalik dengan kota?', '82', '3', 'Tersedia'),
('BC-013', 'uploads/G14.png', 'Dongeng Pembangun Karakter Anak', 'Rucita Arkana', 'LintasKata', '2013', '978-602-17658-4-5', 'Buku &amp;amp;quot;Dongeng Pembangun Karakter Anak” ini berbeda dari buku dongeng lain, sebab cerita di dalamnya terdiri atas fabel dan Kisah legenda di Indonesia yang telah dimodifikasi sedemikian rupa. Kisah-kisah di dalamnya diubah menjadi cerita positif yang mendidik dan dapat membangun karakter yang baik pada anak. Anak dapat menanamkan sifat-sifat positif di dalam pemikirannya. Bahwa tidak semua cerita dapat dicontohkan melalui hal yang buruk.', '88', '3', 'Tersedia'),
('BC-014', 'uploads/G15.png', 'Dongeng Kerajaan Nusantara', 'Anik Kurniati', 'Cikal-Aksara', '2017', '978-602-12676-2-2', 'Pada zaman dulu, Indonesia memiliki banyak kerajaan yang tersebar di berbagai daerah. Banyak kisah inspiratif dari setiap kerajaan yang dapat dijadikan teladan dan contoh positif bagi anak. Buku ini berisi 10 kisah dari tokoh legenda kerajaan yang dikemas dengan menarik dan kaya pesan moral. Tokoh tersebut di antaranya Jaka Tingkir, Pangeran Cakrabuana, Pangeran Latif, Sri Sultan Hamengkubowono, Sultan Ageng Tirtayasa, Raden Patah, Ratu Nahrisyah, Sultan Baabullah, Sultan Hasanuddin, dan Raja Kurabesi', '88', '3', 'Tersedia'),
('BC-015', 'uploads/G16.png', 'Dongeng Bantala Satwa Dalam Bingkai Folklor Lingkungan Nusantara', 'Dr. Sri Herminingrum', 'Media-Nusa-Creative (MNC Publishing)', '2022', '978-602-46271-4-0', 'Dongeng-dongeng yang disertakan dalam buku “Dongeng Bantala Satwa Dalam Bingkai Folklor Lingkungan Nusantara” ini meyakinkan pembaca bahwa memahami hasil kegiatan berkebudayaan melalui dongeng sama halnya dengan menanamkan kesadaran tentang keunikan dan kekayaan tradisibudaya Indonesia. Mencintai dongeng sebagai salah satu karya seni budaya tutur, yang sekarang berada dalam situasi dilematis, sekaligus juga merupakan sebuah usaha untuk menjaga kearifan lokal Nusantara. ', '198', '3', 'Tersedia'),
('BC-016', 'uploads/G17.png', 'Heli dan Sepatu Cinderella', 'Chris Oetoyo', 'DAR!-Mizan', '2007', '978-979-75269-0-0', 'Heli membaca buku dongeng tentang Cinderella, yang ditemukan Ibu di tempat pembuangan. Sayangnya, halaman buku itu tidak lengkap. Sehingga, Heli tidak tahu akhir akhir cerita itu.Heli penasaran. Ia mencari halaman yang tercecer itu ke mana-mana, tapi tetap tidak ditemukan.', '128', '4', 'Tersedia'),
('BC-017', 'uploads/G18.png', 'Yes! Aku Lolos SBMPTN IPS/SAINTEK', 'Veronika Neni', 'Bentang Pustaka', '2016', '978-602-12465-5-9', 'tips and trick lulus sbmptn', '408', '4', 'Tersedia'),
('BC-018', 'uploads/G19.png', 'Sukses UN SMP/MTs 2016', 'Tim Study Center', 'BintangWahyu', '2015', '978-602-72716-6-1', 'tips and trick lulus un smp/mts', '1024', '4', 'Tersedia'),
('BC-019', 'uploads/G20.png', 'The Rainbow Troops', 'Andrea Hirata', 'Farrar, Straus and Giroux', '2013', '978-037-47094-0-2', 'Ikal is a student at the poorest village school on the Indonesian island of Belitong, where graduating from sixth grade is considered a remarkable achievement. His school is under constant threat of closure. In fact, Ikal and his friends—a group nicknamed the Rainbow Troops—face threats from every angle: skeptical government officials, greedy corporations hardly distinguishable from the colonialism they&amp;#039;ve replaced, deepening poverty and crumbling infrastructure, and their own low self-confidence.', '304', '4', 'Tersedia'),
('BC-020', 'uploads/G21.png', 'Beauty Is a Wound', 'Eka Kurniawan', 'New Directions', '2015', '978-081-12236-4-5', 'The epic novel Beauty Is a Wound combines history, satire, family tragedy, legend, humor, and romance in a sweeping polyphony. The beautiful Indo prostitute Dewi Ayu and her four daughters are beset by incest, murder, bestiality, rape, insanity, monstrosity, and the often vengeful undead. Kurniawan’s gleefully grotesque hyperbole functions as a scathing critique of his young nation’s troubled past:the rapacious offhand greed of colonialism; the chaotic struggle for independence; the 1965 mass murders of perhaps a million “Communists,” followed by three decades of Suharto’s despotic rule.', '384', '4', 'Tersedia'),
('BC-021', 'uploads/G22.png', 'Man Tiger', 'Eka Kurniawan', 'Verso', '2015', '978-178-16886-0-1', '&amp;amp;quot;&amp;amp;quot;After half a century,&amp;amp;quot; writes renowned Indonesia scholar Benedict Anderson, &amp;amp;quot;Pramaoedya Ananta Toer has found a successor.&amp;amp;quot; Eka Kurniawan has been described as the &amp;amp;quot;brightest meteorite&amp;amp;quot; in Indonesia&amp;amp;#039;s new literary firmament, the author of two remarkable novels whose sheer beauty, elegance, cosmopolitanism, and ambition have brought comparisons not only to Pramaoedya, universally considered Indonesia&amp;amp;#039;s modern literary genius, but also to Salman Rushdie, Gabriel García Marquez, and Mark Twain. A new generation of young literary figures in Indonesia, emerging after decades of repressive dictatorship ended in 1998, is renewing the culture of the world&amp;amp;#039;s largest Muslim nation (and its language, which was only nationally instituted in 1945). Kurniawan&amp;amp;#039;s Beauty Is a Wound and Man Tiger are t...', '172', '5', 'Tersedia'),
('BC-022', 'uploads/G23.png', 'Sunset in Central Park', 'Sarah Morgan ', 'Harlequin', '2016', '978-146-03960-9-4', 'Di tengah hiruk pikuk New York, sulit menemukan cinta sejati, bahkan jika sebenarnya dia tinggal satu atap denganmu… Trauma akibat perceraian orangtuanya, Frankie Cole tak percaya pada hubungan asmara; merayu pria saja ia tak bisa. Di benak Frankie, semua hubungan pasti akan berantakan. Lebih aman bergaul dengan tanaman serta bunga-bunga daripada menghadapi pria dan tetek bengek percintaan. Tekad Frankie berubah saat Matt Walker, arsitek lanskap yang sudah lama menjadi sahabatnya menawari pekerjaan menata kebun atap. Selama ini, Frankie hanya diam-diam mengagumi Matt. Tapi bekerja dalam jarak dekat dengan pria itu? Risikonya pasti besar. Terbukti, senyum Matt mampu membuat Frankie panas dingin. Belakangan, pria itu ternyata bukan hanya teman curhat yang asyik, tapi juga partner kerja ya...', '370', '5', 'Tersedia'),
('BC-023', 'uploads/G24.png', 'A Little Life', 'Hanya Yanagihara', 'Knopf-Doubleday-Publishing-Group', '2015', '978-038-55392-6-5', 'Brace yourself for the most astonishing, challenging, upsetting, and profoundly moving book in many a season. An epic about love and friendship in the twenty-first century that goes into some of the darkest places fiction has ever traveled and yet somehow improbably breaks through into the light. Truly an amazement and a great gift for its publisher.', '720', '5', 'Tersedia'),
('BC-024', 'uploads/G25.png', 'The Subtle Art of Not Giving a F*ck', ' Mark Manson', 'HarperCollins', '2016', '978-006-24577-3-8', 'In this generation-defining self-help guide, a superstar blogger cuts through the crap to show us how to stop trying to be &amp;quot;positive&amp;quot; all the time so that we can truly become better, happier people.', '224', '5', 'Tersedia'),
('BC-025', 'uploads/G26.png', 'Ringkasan dan ulasan novel Indonesia modern', 'Maman S. Mahayana, Oyon Sofyan, Achmad Dian', 'Gramedia-Widiasarana-Indonesia', '2007', '978-979-02500-6-2', 'Indonesia yang mempunyai tanggung jawab untuk membela bangsa dan negaranya . * Pagar agar Kawat Berduri karya Trisnoyuwono merupakan kisah revolusi yang terjadi sekitar tahun 1949. Novel ini secara amat menarik menggambarkan kehidupan', '402', '5', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `book_borrowing`
--

CREATE TABLE `book_borrowing` (
  `id_borrow` int NOT NULL,
  `id_book` varchar(10) NOT NULL,
  `id_user` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_book` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_borrowing`
--

INSERT INTO `book_borrowing` (`id_borrow`, `id_book`, `id_user`, `name`, `title_book`, `borrow_date`, `return_date`, `status`) VALUES
(1, 'BC-017', 0, 'Putri', 'Yes! Aku Lolos SBMPTN IPS/SAINTEK', '2024-07-09', '2024-07-12', 'Pinjam'),
(2, 'BC-006', 0, 'Putri Dwi Yanti', 'Dongeng Negeri 1001 Malam', '2024-07-09', '2024-07-25', 'Pinjam'),
(3, 'BC-021', 0, 'Sarip', 'Man Tiger', '2024-07-13', '2024-07-14', 'Pinjam'),
(4, 'BC-008', 0, 'Salwa', 'Dongeng Lengkap Kancil', '2024-07-13', '2024-07-14', 'Pinjam'),
(5, 'BC-008', 0, 'Salwa', 'Dongeng Lengkap Kancil', '2024-07-13', '2024-07-14', 'Pinjam'),
(6, 'BC-009', 0, 'Angga', 'Petualangan Di Negeri Dongeng', '2024-07-13', '2024-07-31', 'Pinjam'),
(7, 'BC-010', 0, 'Syauqi', 'Dahsyatnya Dongeng', '2024-07-13', '2024-07-20', 'Pinjam'),
(8, 'BC-011', 0, 'Bambang', 'Petualangan Rhino Kumbang dan Kumpulan Dongeng Karakter Anak', '2024-07-13', '2024-07-22', 'Pinjam'),
(9, 'BC-012', 0, 'Fatur', 'Sella Cerita Anak', '2024-07-13', '2024-07-14', 'Pinjam'),
(10, 'BC-013', 0, 'Algra', 'Dongeng Pembangun Karakter Anak', '2024-07-13', '2024-07-14', 'Pinjam'),
(11, 'BC-014', 0, 'Danang', 'Dongeng Kerajaan Nusantara', '2024-07-13', '2024-07-14', 'Pinjam'),
(12, 'BC-015', 0, 'Rasyid', 'Dongeng Bantala Satwa Dalam Bingkai Folklor Lingkungan Nusantara', '2024-07-13', '2024-07-15', 'Pinjam'),
(13, 'BC-002', 0, 'Bambang', 'Bittersweet', '2024-07-14', '2024-07-20', 'Pinjam');

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
('CE-1', 'Literasi Imajinatif', 'RW 6, Kelurahan Cipaku', 100, 50, 50),
('CE-2', 'Social Connect', 'RW 15, Kelurahan Cipaku', 100, 50, 50),
('CE-3', 'Bisnis Berdaya', 'RW 4, Kelurahan Cipaku', 100, 50, 50),
('CE-4', 'Kreatif Kids Corner', 'RW 17, Kelurahan Cipaku', 100, 50, 50),
('CE-5', 'Pena Inspirasi Gemilang', 'RW 3, Kelurahan Cipaku', 100, 50, 50);

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
(1, 'Namaku Kali', 'Sastra', 'Anna Farida dan Felishia', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '24', '2022', '978-602-427-921-9', 'Anak itu datang lagi! Kali selalu suka melihat anak itu. Apa yang akan dia lakukan hari ini?', 'uploads/ebook/ebook-001-namakukali.png', 'uploads/ebook/Namaku_Kali.pdf'),
(2, 'Aku Sudah Besar', 'Sastra', 'Futri Wijayanti', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '16', '2022', '978-602-244-930-0', 'Ayah dan Ibu sibuk dengan Adik. Aku mulai iri. Namun aku sudah besar. Bolehkah aku ikut mengasuh Adik?', 'uploads/ebook/ebook-002-akusudahbesar.png', 'uploads/ebook/Aku_Sudah_Besar.pdf'),
(3, 'Apa Itu?', 'Sastra', 'Laksmi Manohara, Aira Rumi', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '23', '2022', '978-602-244-939-3', 'Tia dan teman-temannya pergi ke Desa Cisupa. Ada pawai sisingaan di sana. Dalam perjalanan, ada sesuatu mengikuti mereka. Apa itu?', 'uploads/ebook/ebook-003-apaitu.png', 'uploads/ebook/Apa_Itu.pdf'),
(4, 'Biji Merah Luna', 'Sastra', 'Ammy Kudo', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '17', '2022', '978-602-244-926-3', 'Biji merah itu bagus. Sayang hanya sedikit. Yuk, lihat Luna. Dia sedang apa?', 'uploads/ebook/ebook-004-bijimerahluna.png', 'uploads/ebook/Biji_Merah_Luna.pdf'),
(5, 'Coba dulu Tora', 'Sastra', 'Sri Sarastuti', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '33', '2022', '978-602-244-942-3', 'Tora baru saja pindah ke pohon baru yang nyaman. Sayangnya, dia jadi malas bergerak. Bahkan dia sering menunda keinginan buang air besar. Akibatnya, Tora malah jadi susah buang air besar.', 'uploads/ebook/ebook-005-cobadulutora.png', 'uploads/ebook/Coba_Dulu_Tora.pdf'),
(6, 'Dimana Kacang Sipet', 'Sastra', 'Aris Hartanti', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '23', '2022', '978-602-244-935-5', 'Sipet mengumpulkan kacang untuk persediaan. Namun, kacang Sipet hilang! Di mana kacang Sipet?', 'uploads/ebook/ebook-006-dimanakacangsipet.png', 'uploads/ebook/Dimana_Kacang_Sipet.pdf'),
(7, 'Gadis Rempah', 'Sastra', 'Musrifah Medkom', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '185', '2023', '978-623-118-030-8', 'Arumi seorang gadis remaja yang sangan bermimpi menjadi seorang desainer produk. Namun, mimpi dan kenyataan sangatlah berbeda dari harapannya. Di mata Ibunya, semua yang dilakukannya', 'uploads/ebook/ebook-007-gadisrempah.png', 'uploads/ebook/Gadis_Rempah.pdf'),
(8, 'Karena Anggrek Ibu', 'Sastra', 'Debby Lukito Goeyardi, Widyasari Hanaya', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '47', '2022', '978-602-244-944-7', 'Janu bingung dan takut. Sekolah memberi surat edaran, tapi Janu lupa menyerahkan surat itu kepada ibu. Ibu sangat disiplin, apalagi kalau menyangkut soal uang. Semua harus direncanakan. Jadi, Janu memutuskan', 'uploads/ebook/ebook-008-karenaanggrekibu.png', 'uploads/ebook/Karena_Anggrek_Ibu.pdf'),
(9, 'Naik-naik Kepuncak Bukit', 'Sastra', 'Sarah Fauzia', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', '25', '2022', '978-602-244-937-9', 'Bulan dan Sabit biasa berjalan kaki setiap pagi. Mereka ingin mencoba pengalaman baru. Kali ini mereka akan mendaki bukit! Masalahnya, keadaan di sana tidak mudah bagi Sabit. Apa yang dialami Sabit?', 'uploads/ebook/ebook-011-naiknaikkepuncakbukit.png', 'uploads/ebook/Naik_Naik_Kepuncak_Bukit.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `product_umkm`
--

CREATE TABLE `product_umkm` (
  `id_product` int NOT NULL,
  `product_photo` varchar(255) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_description` text NOT NULL,
  `id_seller` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `id_seller` int NOT NULL,
  `seller_name` varchar(100) NOT NULL,
  `no_whatsapp` varchar(20) NOT NULL,
  `address_seller` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `username`, `email`, `password`) VALUES
(1, 'Muhamad Hafizi', 'hfz123', 'mh642859@gmail.com', '$2y$10$Wv4QfajJ0C.zayVRxL9.7uEx9MLTSdMw2nCPSLUsVY2NOg2Yu1zkW'),
(2, 'Budi Utama', 'budibudi', 'bud@gmail.com', '$2y$10$JO/QW.GORjggwjcKHyqtWe/xUjy4I5u2M5.nu7qHZL3.OIOZtCQuK'),
(3, 'Salwa Salsabil', 'salwaslsbl201', 'Salwa@gmail.com', '$2y$10$jEx6U97z9iH6mxDs.vreP.N6ObpeZQ1korj5.cTYMCyAqJU.fQERO'),
(4, 'Bambang', 'beng13', 'beng@gmai.com', '$2y$10$8HxzGyRnoGv/V8R7Nq0Tu.d5Zsh4q2c8uT2rZAVwzJ4j.vRb3k6SS'),
(5, 'Syauqi', 'uqi20', 'uqi@gmail.com', '$2y$10$UzfKSptFdJjh1fHXPjj69e7u9a0jnkVKfCiTA1oJv4sEoB1tpEr9a'),
(6, 'Syaifaturahman', 'fatur', 'fatur@gmail.com', '$2y$10$zjQU0HPthrKAzHAxBLApou//f1ABeONZQZHyoIMzIYH.XThxnBMHC'),
(7, 'asep', 'asep123', 'asep@gmail.com', '$2y$10$2Pr/43Ph/JOpuAmHN1ylCOsu016IcnQNfBAq498vDYpH0AfSrquWG'),
(8, 'Hafizi', 'hfziii', 'mh065122214@gmail.com', '$2y$10$utOZxvJs.thaB1zl2sY1ReO3aB7J52l6qJOigU7t5UhzfVUzvZuC2');

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
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_book`);

--
-- Indexes for table `book_borrowing`
--
ALTER TABLE `book_borrowing`
  ADD PRIMARY KEY (`id_borrow`);

--
-- Indexes for table `corner_education`
--
ALTER TABLE `corner_education`
  ADD PRIMARY KEY (`id_corner`);

--
-- Indexes for table `ebook`
--
ALTER TABLE `ebook`
  ADD PRIMARY KEY (`id_ebook`);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book_borrowing`
--
ALTER TABLE `book_borrowing`
  MODIFY `id_borrow` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ebook`
--
ALTER TABLE `ebook`
  MODIFY `id_ebook` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `seller_umkm`
--
ALTER TABLE `seller_umkm`
  MODIFY `id_seller` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
