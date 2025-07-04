-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2025 at 07:01 PM
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
-- Database: `db_tugas`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `headline` text DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `pengirim` varchar(100) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `kategori`, `headline`, `isi`, `gambar`, `video`, `pengirim`, `tanggal`) VALUES
(17, 'pssi', 'Olahraga', 'pssi bisa apa', 'PSSI (Persatuan Sepak Bola Seluruh Indonesia) adalah organisasi yang bertanggung jawab mengatur dan mengelola sepak bola di Indonesia. Tugas utamanya meliputi: mengatur kompetisi dan turnamen, membina tim nasional, serta mengembangkan sepak bola nasional. PSSI juga memiliki kewenangan untuk memberikan sanksi terkait pelanggaran aturan sepak bola. \r\nTugas dan wewenang PSSI meliputi:\r\nPengaturan Kompetisi:\r\nPSSI bertanggung jawab menyelenggarakan berbagai kompetisi sepak bola di Indonesia, mulai dari Liga 1, Liga 2, Liga 3, hingga kompetisi usia muda. \r\nPembinaan Tim Nasional:\r\nPSSI memiliki kewenangan untuk membentuk dan membina tim nasional sepak bola Indonesia, baik senior maupun junior, untuk berbagai ajang kompetisi. \r\nPengembangan Sepak Bola:\r\nPSSI berperan dalam mengembangkan sepak bola di Indonesia melalui program pembinaan usia dini, pelatihan wasit, dan pengembangan infrastruktur. \r\nPenegakan Aturan:\r\nPSSI memiliki wewenang untuk memberikan sanksi kepada individu, klub, atau pihak lain yang melanggar aturan dan kode etik sepak bola. \r\nMewakili Sepak Bola Indonesia:\r\nPSSI menjadi wakil sepak bola Indonesia di mata dunia, termasuk dalam organisasi sepak bola internasional seperti FIFA dan AFC. \r\nPSSI juga memiliki hubungan dengan pemerintah, khususnya Kementerian Pemuda dan Olahraga, serta badan sepak bola dunia seperti FIFA. Namun, PSSI tetap merupakan organisasi yang independen dalam menjalankan tugas dan wewenangnya. ', '', '686698acc6e98.mp4', 'akuaas', '2025-07-03 14:50:20'),
(20, 'asda', 'Ekonomi', 'asd', ' dadsa', '', '', 'sta', '2025-07-04 15:08:06'),
(21, 'aja', 'Politik', 'ada', ' adsa', '', '6868037ba1590.mp4', 'sasda', '2025-07-04 16:38:19'),
(22, 'sasa', 'Teknologi', 'dass', ' asds', '', '6868039cf18db.mp4', 'sasd', '2025-07-04 16:38:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_judul` (`judul`),
  ADD KEY `idx_isi` (`isi`(768));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
