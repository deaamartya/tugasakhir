-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2020 at 05:54 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silab_ipa`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `ID_ALAT` varchar(16) NOT NULL,
  `ID_KATALOG_ALAT` varchar(15) NOT NULL,
  `ID_LEMARI` int(11) NOT NULL,
  `ID_MERK_TIPE` int(11) NOT NULL,
  `UKURAN` varchar(20) NOT NULL,
  `JUMLAH_BAGUS` int(11) NOT NULL,
  `JUMLAH_RUSAK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `alat_bahan_praktikum`
--

CREATE TABLE `alat_bahan_praktikum` (
  `ID_TIPE` int(11) NOT NULL,
  `ID_PRAKTIKUM` char(10) NOT NULL,
  `ID_ALAT_BAHAN` varchar(20) NOT NULL,
  `JUMLAH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `ID_BAHAN` varchar(20) NOT NULL,
  `ID_LEMARI` int(11) NOT NULL,
  `NAMA_BAHAN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bahan_kimia`
--

CREATE TABLE `bahan_kimia` (
  `ID_BAHAN_KIMIA` varchar(10) NOT NULL,
  `ID_KATALOG_BAHAN` varchar(20) NOT NULL,
  `ID_LEMARI` int(11) NOT NULL,
  `NAMA_BAHAN_KIMIA` varchar(30) NOT NULL,
  `RUMUS` varchar(40) NOT NULL,
  `WUJUD` varchar(30) NOT NULL,
  `JUMLAH_BAHAN_KIMIA` float NOT NULL,
  `SPESIFIKASI_BAHAN` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `histori_stok`
--

CREATE TABLE `histori_stok` (
  `ID_HISTORI` varchar(15) NOT NULL,
  `ID_TIPE` int(11) NOT NULL,
  `ID_ALAT_BAHAN` varchar(20) DEFAULT NULL,
  `TIMESTAMP` datetime NOT NULL,
  `JUMLAH_MASUK` int(11) NOT NULL,
  `JUMLAH_KELUAR` int(11) NOT NULL,
  `KONDISI` tinyint(1) DEFAULT NULL,
  `STOK` int(11) NOT NULL,
  `KETERANGAN` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kelas`
--

CREATE TABLE `jenis_kelas` (
  `ID_JENIS_KELAS` int(11) NOT NULL,
  `NAMA_JENIS_KELAS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `katalog_alat`
--

CREATE TABLE `katalog_alat` (
  `ID_KATALOG_ALAT` varchar(15) NOT NULL,
  `ID_KATEGORI_ALAT` int(11) NOT NULL,
  `NAMA_ALAT` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `katalog_bahan`
--

CREATE TABLE `katalog_bahan` (
  `ID_KATALOG_BAHAN` varchar(20) NOT NULL,
  `ID_LABORATORIUM` int(11) NOT NULL,
  `NAMA_KATALOG_BAHAN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_alat`
--

CREATE TABLE `kategori_alat` (
  `ID_KATEGORI_ALAT` int(11) NOT NULL,
  `ID_LABORATORIUM` int(11) NOT NULL,
  `NAMA_KATEGORI` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `ID_KELAS` char(5) NOT NULL,
  `ID_TAHUN_AKADEMIK` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_JENIS_KELAS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `laboratorium`
--

CREATE TABLE `laboratorium` (
  `ID_LABORATORIUM` int(11) NOT NULL,
  `NAMA_LABORATORIUM` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lemari`
--

CREATE TABLE `lemari` (
  `ID_LEMARI` int(11) NOT NULL,
  `ID_LABORATORIUM` int(11) NOT NULL,
  `NAMA_LEMARI` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `ID_MAPEL` char(5) NOT NULL,
  `NAMA_MAPEL` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `merk_tipe_alat`
--

CREATE TABLE `merk_tipe_alat` (
  `ID_MERK_TIPE` int(11) NOT NULL,
  `NAMA_MERK_TIPE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_alat_bahan`
--

CREATE TABLE `peminjaman_alat_bahan` (
  `ID_PEMINJAMAN` int(11) NOT NULL,
  `ID_RUANG_LABORATORIUM` int(11) NOT NULL,
  `ID_PRAKTIKUM` char(10) NOT NULL,
  `TANGGAL_PEMINJAMAN` date NOT NULL,
  `STATUS_PEMINJAMAN` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `perubahan_jadwal_peminjaman`
--

CREATE TABLE `perubahan_jadwal_peminjaman` (
  `ID_PERUBAHAN_JADWAL` int(11) NOT NULL,
  `ID_PEMINJAMAN` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `TANGGAL_LAMA` date NOT NULL,
  `TANGGAL_BARU` date NOT NULL,
  `PESAN` text NOT NULL,
  `STATUS_PERUBAHAN` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `praktikum`
--

CREATE TABLE `praktikum` (
  `ID_PRAKTIKUM` char(10) NOT NULL,
  `ID_LABORATORIUM` int(11) NOT NULL,
  `ID_MAPEL` char(5) NOT NULL,
  `ID_KELAS` char(5) NOT NULL,
  `NAMA_PRAKTIKUM` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ruang_laboratorium`
--

CREATE TABLE `ruang_laboratorium` (
  `ID_RUANG_LABORATORIUM` int(11) NOT NULL,
  `ID_LABORATORIUM` int(11) NOT NULL,
  `NAMA_RUANG_LABORATORIUM` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_akademik`
--

CREATE TABLE `tahun_akademik` (
  `ID_TAHUN_AKADEMIK` int(11) NOT NULL,
  `TAHUN_AJARAN` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tipe`
--

CREATE TABLE `tipe` (
  `ID_TIPE` int(11) NOT NULL,
  `NAMA_TIPE` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tipe_user`
--

CREATE TABLE `tipe_user` (
  `ID_TIPE_USER` int(11) NOT NULL,
  `NAMA_TIPE_USER` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID_USER` int(11) NOT NULL,
  `ID_TIPE_USER` int(11) NOT NULL,
  `USERNAME` varchar(16) NOT NULL,
  `PASSWORD` varchar(32) NOT NULL,
  `PATH_FOTO` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`ID_ALAT`),
  ADD KEY `FK_BAGIAN_DARI_6` (`ID_KATALOG_ALAT`),
  ADD KEY `FK_DISIMPAN_DALAM` (`ID_LEMARI`),
  ADD KEY `FK_MEMILIKI_7` (`ID_MERK_TIPE`);

--
-- Indexes for table `alat_bahan_praktikum`
--
ALTER TABLE `alat_bahan_praktikum`
  ADD PRIMARY KEY (`ID_PRAKTIKUM`,`ID_ALAT_BAHAN`),
  ADD KEY `FK_MERUPAKAN_3` (`ID_TIPE`);

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`ID_BAHAN`),
  ADD KEY `FK_DISIMPAN2` (`ID_LEMARI`);

--
-- Indexes for table `bahan_kimia`
--
ALTER TABLE `bahan_kimia`
  ADD PRIMARY KEY (`ID_BAHAN_KIMIA`),
  ADD KEY `FK_BAGIAN_DARI_7` (`ID_KATALOG_BAHAN`),
  ADD KEY `FK_DISIMPAN3` (`ID_LEMARI`);

--
-- Indexes for table `histori_stok`
--
ALTER TABLE `histori_stok`
  ADD PRIMARY KEY (`ID_HISTORI`),
  ADD KEY `FK_MERUPAKAN_4` (`ID_TIPE`);

--
-- Indexes for table `jenis_kelas`
--
ALTER TABLE `jenis_kelas`
  ADD PRIMARY KEY (`ID_JENIS_KELAS`);

--
-- Indexes for table `katalog_alat`
--
ALTER TABLE `katalog_alat`
  ADD PRIMARY KEY (`ID_KATALOG_ALAT`),
  ADD KEY `FK_BAGIAN_DARI_4` (`ID_KATEGORI_ALAT`);

--
-- Indexes for table `katalog_bahan`
--
ALTER TABLE `katalog_bahan`
  ADD PRIMARY KEY (`ID_KATALOG_BAHAN`),
  ADD KEY `FK_MILIK_2` (`ID_LABORATORIUM`);

--
-- Indexes for table `kategori_alat`
--
ALTER TABLE `kategori_alat`
  ADD PRIMARY KEY (`ID_KATEGORI_ALAT`),
  ADD KEY `FK_MILIK` (`ID_LABORATORIUM`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`ID_KELAS`),
  ADD KEY `FK_DILAKSANAKAN_PADA` (`ID_TAHUN_AKADEMIK`),
  ADD KEY `FK_MENGAJAR` (`ID_USER`),
  ADD KEY `FK_MERUPAKAN_2` (`ID_JENIS_KELAS`);

--
-- Indexes for table `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD PRIMARY KEY (`ID_LABORATORIUM`);

--
-- Indexes for table `lemari`
--
ALTER TABLE `lemari`
  ADD PRIMARY KEY (`ID_LEMARI`),
  ADD KEY `FK_MILIK3` (`ID_LABORATORIUM`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`ID_MAPEL`);

--
-- Indexes for table `merk_tipe_alat`
--
ALTER TABLE `merk_tipe_alat`
  ADD PRIMARY KEY (`ID_MERK_TIPE`);

--
-- Indexes for table `peminjaman_alat_bahan`
--
ALTER TABLE `peminjaman_alat_bahan`
  ADD PRIMARY KEY (`ID_PEMINJAMAN`),
  ADD KEY `FK_MEMILIKI` (`ID_PRAKTIKUM`),
  ADD KEY `FK_MENGGUNAKAN` (`ID_RUANG_LABORATORIUM`);

--
-- Indexes for table `perubahan_jadwal_peminjaman`
--
ALTER TABLE `perubahan_jadwal_peminjaman`
  ADD PRIMARY KEY (`ID_PERUBAHAN_JADWAL`),
  ADD KEY `FK_DIPROSES` (`ID_USER`),
  ADD KEY `FK_PERUBAHAN_JADWAL` (`ID_PEMINJAMAN`);

--
-- Indexes for table `praktikum`
--
ALTER TABLE `praktikum`
  ADD PRIMARY KEY (`ID_PRAKTIKUM`),
  ADD KEY `FK_BAGIAN_DARI` (`ID_LABORATORIUM`),
  ADD KEY `FK_BAGIAN_DARI_2` (`ID_MAPEL`),
  ADD KEY `FK_DILAKUKAN` (`ID_KELAS`);

--
-- Indexes for table `ruang_laboratorium`
--
ALTER TABLE `ruang_laboratorium`
  ADD PRIMARY KEY (`ID_RUANG_LABORATORIUM`),
  ADD KEY `FK_BAGIAN_DARI_3` (`ID_LABORATORIUM`);

--
-- Indexes for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  ADD PRIMARY KEY (`ID_TAHUN_AKADEMIK`);

--
-- Indexes for table `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`ID_TIPE`);

--
-- Indexes for table `tipe_user`
--
ALTER TABLE `tipe_user`
  ADD PRIMARY KEY (`ID_TIPE_USER`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_USER`),
  ADD KEY `FK_MERUPAKAN` (`ID_TIPE_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_kelas`
--
ALTER TABLE `jenis_kelas`
  MODIFY `ID_JENIS_KELAS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_alat`
--
ALTER TABLE `kategori_alat`
  MODIFY `ID_KATEGORI_ALAT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laboratorium`
--
ALTER TABLE `laboratorium`
  MODIFY `ID_LABORATORIUM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lemari`
--
ALTER TABLE `lemari`
  MODIFY `ID_LEMARI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merk_tipe_alat`
--
ALTER TABLE `merk_tipe_alat`
  MODIFY `ID_MERK_TIPE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peminjaman_alat_bahan`
--
ALTER TABLE `peminjaman_alat_bahan`
  MODIFY `ID_PEMINJAMAN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perubahan_jadwal_peminjaman`
--
ALTER TABLE `perubahan_jadwal_peminjaman`
  MODIFY `ID_PERUBAHAN_JADWAL` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruang_laboratorium`
--
ALTER TABLE `ruang_laboratorium`
  MODIFY `ID_RUANG_LABORATORIUM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  MODIFY `ID_TAHUN_AKADEMIK` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipe`
--
ALTER TABLE `tipe`
  MODIFY `ID_TIPE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipe_user`
--
ALTER TABLE `tipe_user`
  MODIFY `ID_TIPE_USER` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alat`
--
ALTER TABLE `alat`
  ADD CONSTRAINT `FK_BAGIAN_DARI_6` FOREIGN KEY (`ID_KATALOG_ALAT`) REFERENCES `katalog_alat` (`ID_KATALOG_ALAT`),
  ADD CONSTRAINT `FK_DISIMPAN_DALAM` FOREIGN KEY (`ID_LEMARI`) REFERENCES `lemari` (`ID_LEMARI`),
  ADD CONSTRAINT `FK_MEMILIKI_7` FOREIGN KEY (`ID_MERK_TIPE`) REFERENCES `merk_tipe_alat` (`ID_MERK_TIPE`);

--
-- Constraints for table `alat_bahan_praktikum`
--
ALTER TABLE `alat_bahan_praktikum`
  ADD CONSTRAINT `FK_MEMBUTUHKAN` FOREIGN KEY (`ID_PRAKTIKUM`) REFERENCES `praktikum` (`ID_PRAKTIKUM`),
  ADD CONSTRAINT `FK_MERUPAKAN_3` FOREIGN KEY (`ID_TIPE`) REFERENCES `tipe` (`ID_TIPE`);

--
-- Constraints for table `bahan`
--
ALTER TABLE `bahan`
  ADD CONSTRAINT `FK_DISIMPAN2` FOREIGN KEY (`ID_LEMARI`) REFERENCES `lemari` (`ID_LEMARI`);

--
-- Constraints for table `bahan_kimia`
--
ALTER TABLE `bahan_kimia`
  ADD CONSTRAINT `FK_BAGIAN_DARI_7` FOREIGN KEY (`ID_KATALOG_BAHAN`) REFERENCES `katalog_bahan` (`ID_KATALOG_BAHAN`),
  ADD CONSTRAINT `FK_DISIMPAN3` FOREIGN KEY (`ID_LEMARI`) REFERENCES `lemari` (`ID_LEMARI`);

--
-- Constraints for table `histori_stok`
--
ALTER TABLE `histori_stok`
  ADD CONSTRAINT `FK_MERUPAKAN_4` FOREIGN KEY (`ID_TIPE`) REFERENCES `tipe` (`ID_TIPE`);

--
-- Constraints for table `katalog_alat`
--
ALTER TABLE `katalog_alat`
  ADD CONSTRAINT `FK_BAGIAN_DARI_4` FOREIGN KEY (`ID_KATEGORI_ALAT`) REFERENCES `kategori_alat` (`ID_KATEGORI_ALAT`);

--
-- Constraints for table `katalog_bahan`
--
ALTER TABLE `katalog_bahan`
  ADD CONSTRAINT `FK_MILIK_2` FOREIGN KEY (`ID_LABORATORIUM`) REFERENCES `laboratorium` (`ID_LABORATORIUM`);

--
-- Constraints for table `kategori_alat`
--
ALTER TABLE `kategori_alat`
  ADD CONSTRAINT `FK_MILIK` FOREIGN KEY (`ID_LABORATORIUM`) REFERENCES `laboratorium` (`ID_LABORATORIUM`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `FK_DILAKSANAKAN_PADA` FOREIGN KEY (`ID_TAHUN_AKADEMIK`) REFERENCES `tahun_akademik` (`ID_TAHUN_AKADEMIK`),
  ADD CONSTRAINT `FK_MENGAJAR` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID_USER`),
  ADD CONSTRAINT `FK_MERUPAKAN_2` FOREIGN KEY (`ID_JENIS_KELAS`) REFERENCES `jenis_kelas` (`ID_JENIS_KELAS`);

--
-- Constraints for table `lemari`
--
ALTER TABLE `lemari`
  ADD CONSTRAINT `FK_MILIK3` FOREIGN KEY (`ID_LABORATORIUM`) REFERENCES `laboratorium` (`ID_LABORATORIUM`);

--
-- Constraints for table `peminjaman_alat_bahan`
--
ALTER TABLE `peminjaman_alat_bahan`
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`ID_PRAKTIKUM`) REFERENCES `praktikum` (`ID_PRAKTIKUM`),
  ADD CONSTRAINT `FK_MENGGUNAKAN` FOREIGN KEY (`ID_RUANG_LABORATORIUM`) REFERENCES `ruang_laboratorium` (`ID_RUANG_LABORATORIUM`);

--
-- Constraints for table `perubahan_jadwal_peminjaman`
--
ALTER TABLE `perubahan_jadwal_peminjaman`
  ADD CONSTRAINT `FK_DIPROSES` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID_USER`),
  ADD CONSTRAINT `FK_PERUBAHAN_JADWAL` FOREIGN KEY (`ID_PEMINJAMAN`) REFERENCES `peminjaman_alat_bahan` (`ID_PEMINJAMAN`);

--
-- Constraints for table `praktikum`
--
ALTER TABLE `praktikum`
  ADD CONSTRAINT `FK_BAGIAN_DARI` FOREIGN KEY (`ID_LABORATORIUM`) REFERENCES `laboratorium` (`ID_LABORATORIUM`),
  ADD CONSTRAINT `FK_BAGIAN_DARI_2` FOREIGN KEY (`ID_MAPEL`) REFERENCES `mata_pelajaran` (`ID_MAPEL`),
  ADD CONSTRAINT `FK_DILAKUKAN` FOREIGN KEY (`ID_KELAS`) REFERENCES `kelas` (`ID_KELAS`);

--
-- Constraints for table `ruang_laboratorium`
--
ALTER TABLE `ruang_laboratorium`
  ADD CONSTRAINT `FK_BAGIAN_DARI_3` FOREIGN KEY (`ID_LABORATORIUM`) REFERENCES `laboratorium` (`ID_LABORATORIUM`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_MERUPAKAN` FOREIGN KEY (`ID_TIPE_USER`) REFERENCES `tipe_user` (`ID_TIPE_USER`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
