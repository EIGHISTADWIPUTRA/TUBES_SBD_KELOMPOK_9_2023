-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 04:03 PM
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
-- Database: `db_kharisma`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddPenyewa` (IN `p_nama` VARCHAR(100), IN `p_no_telepon` VARCHAR(15), IN `p_status` ENUM('Member','Non Member'))   BEGIN
    INSERT INTO penyewa (nama_penyewa, no_telepon_penyewa, status_member) 
    VALUES (p_nama, p_no_telepon, p_status);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `tanggal_booking` date DEFAULT NULL,
  `jam_booking` time DEFAULT NULL,
  `id_penyewa` int(11) DEFAULT NULL,
  `id_lapangan` int(11) DEFAULT NULL,
  `id_voucher` int(11) DEFAULT NULL,
  `id_fasilitas` int(10) DEFAULT NULL,
  `tanggal_main` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `lama` int(11) DEFAULT NULL,
  `status_pembayaran` varchar(255) DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `tanggal_booking`, `jam_booking`, `id_penyewa`, `id_lapangan`, `id_voucher`, `id_fasilitas`, `tanggal_main`, `jam_mulai`, `lama`, `status_pembayaran`) VALUES
(1, '2004-01-01', '09:00:00', 1, 1, 1, NULL, '2024-02-21', '10:00:00', 120, 'Sudah'),
(2, '2024-06-07', '08:03:14', 1, 1, 1, NULL, '2024-06-07', '09:03:14', 4, 'Sudah');

-- --------------------------------------------------------

--
-- Table structure for table `extra_fasilitas`
--

CREATE TABLE `extra_fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `nama_fasilitas` varchar(255) NOT NULL,
  `deskripsi_fasilitas` varchar(255) NOT NULL,
  `harga_per_jam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `extra_fasilitas`
--

INSERT INTO `extra_fasilitas` (`id_fasilitas`, `nama_fasilitas`, `deskripsi_fasilitas`, `harga_per_jam`) VALUES
(1, 'Shuttlecock', 'Shuttlecock berkualitas tinggi', 10000),
(2, 'Raket', 'Raket bulu tangkis untuk pemula dan pro', 15000),
(3, 'Sepatu Olahraga', 'Sepatu khusus bulu tangkis berbagai ukuran', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_bayar`
--

CREATE TABLE `konfirmasi_bayar` (
  `id_konfirmasi` int(11) NOT NULL,
  `id_booking` int(11) DEFAULT NULL,
  `atas_nama` varchar(100) DEFAULT NULL,
  `bukti` text DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konfirmasi_bayar`
--

INSERT INTO `konfirmasi_bayar` (`id_konfirmasi`, `id_booking`, `atas_nama`, `bukti`, `total`) VALUES
(1, 1, 'farhan', 'adadada', 50000.00),
(12, 2, 'farhan', '1243.jpg', 50000.00),
(13, 1, 'Nama User', 'bukti_pembayaran.jpg', 100000.00);

--
-- Triggers `konfirmasi_bayar`
--
DELIMITER $$
CREATE TRIGGER `GunakanVoucher` AFTER INSERT ON `konfirmasi_bayar` FOR EACH ROW BEGIN
    DECLARE diskon DECIMAL(10,2);
    DECLARE total_pembayaran DECIMAL(10,2);
    DECLARE id_voucher INT;
    DECLARE tanggal_main DATE;

    -- Get the id_voucher and tanggal_main from the booking
    SELECT id_voucher, tanggal_main INTO id_voucher, tanggal_main
    FROM booking WHERE id_booking = NEW.id_booking;

    -- Get the discount amount from the voucher
    SELECT besar_diskon INTO diskon
    FROM voucher WHERE id_voucher = id_voucher;

    -- Get the total payment from the confirmation
    SELECT total INTO total_pembayaran
    FROM konfirmasi_bayar WHERE id_konfirmasi = NEW.id_konfirmasi;

    -- Calculate the new total payment after applying the voucher discount
    SET total_pembayaran = total_pembayaran - diskon;

    -- Update the total payment in the confirmation
    UPDATE konfirmasi_bayar
    SET total = total_pembayaran
    WHERE id_konfirmasi = NEW.id_konfirmasi;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `id_lapangan` int(11) NOT NULL,
  `nama_lapangan` varchar(255) NOT NULL,
  `harga_lapangan` int(11) DEFAULT NULL,
  `deskripsi_lapangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id_lapangan`, `nama_lapangan`, `harga_lapangan`, `deskripsi_lapangan`) VALUES
(1, 'Lapangan A', 50000, 'Dekat Pintu Masuk'),
(2, 'Lapangan B', 50000, 'deket pintu belakang');

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `id_penyewa` int(10) NOT NULL,
  `nama_penyewa` varchar(255) NOT NULL,
  `no_telepon_penyewa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`id_penyewa`, `nama_penyewa`, `no_telepon_penyewa`) VALUES
(1, 'EGIS', '085163698805');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id_voucher` int(11) NOT NULL,
  `nama_voucher` varchar(255) NOT NULL,
  `deskripsi_voucher` varchar(255) NOT NULL,
  `tanggal_berlaku` date NOT NULL,
  `besar_diskon` decimal(10,2) NOT NULL,
  `code_voucher` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id_voucher`, `nama_voucher`, `deskripsi_voucher`, `tanggal_berlaku`, `besar_diskon`, `code_voucher`) VALUES
(0, 'ramadhan', 'Ramadhan telat tiba. Dapatkan voucher sebesar 25%', '2024-06-14', 0.25, 'HARIRAYA2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_penyewa` (`id_penyewa`),
  ADD KEY `id_lapangan` (`id_lapangan`),
  ADD KEY `id_voucer` (`id_voucher`),
  ADD KEY `id_voucer_2` (`id_voucher`),
  ADD KEY `id_voucher` (`id_voucher`),
  ADD KEY `id_fasilitas` (`id_fasilitas`);

--
-- Indexes for table `konfirmasi_bayar`
--
ALTER TABLE `konfirmasi_bayar`
  ADD PRIMARY KEY (`id_konfirmasi`),
  ADD KEY `id_booking` (`id_booking`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id_lapangan`);

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`id_penyewa`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `konfirmasi_bayar`
--
ALTER TABLE `konfirmasi_bayar`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id_lapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penyewa`
--
ALTER TABLE `penyewa`
  MODIFY `id_penyewa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_penyewa`) REFERENCES `penyewa` (`id_penyewa`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_lapangan`) REFERENCES `lapangan` (`id_lapangan`);

--
-- Constraints for table `konfirmasi_bayar`
--
ALTER TABLE `konfirmasi_bayar`
  ADD CONSTRAINT `konfirmasi_bayar_ibfk_1` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_booking`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
