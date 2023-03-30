-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 30 Mar 2023 pada 01.55
-- Versi server: 5.7.24
-- Versi PHP: 8.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_janjijiwa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasils`
--

CREATE TABLE `hasils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `testing_detil_id` bigint(20) UNSIGNED NOT NULL,
  `kalimat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('Positif','Negatif','Netral') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hasils`
--

INSERT INTO `hasils` (`id`, `testing_detil_id`, `kalimat`, `kategori`) VALUES
(1, 178, 'rt investorid induk kopi janji jiwa luncur burger geber https co pxitxbrcep', 'Positif'),
(2, 179, 'rt strategi bisnis tempur kopi kenang vs janji jiwa blog strategi manajemen https co cmq0h4b5p4', 'Positif'),
(3, 180, 'kopi janji jiwa is so artificial', 'Positif'),
(4, 181, 'gromcery kopi janji jiwa', 'Positif'),
(5, 182, 'rt strategi bisnis tempur kopi kenang vs janji jiwa blog strategi manajemen https co cmq0h4b5p4', 'Positif'),
(6, 183, 'induk kopi janji jiwa luncur burger geber https co pxitxbrcep', 'Positif'),
(7, 184, 'dyar janji jiwa mgt tutup permanen mana ku bs temu es kopi arabica blend yawlaaaaa', 'Positif'),
(8, 185, 'wildestdrink rivaimuhamad constantine6669 txtdrkuliner memelord 666666 ga semua orang doyan masalahny wkwk jd inget tempo hari gw pernah ke kopi janji jiwa request kopi americano tanpa gula dan si mbak baristanya cengo wkwk', 'Positif'),
(9, 186, 'kopi janji jiwa kopine diombe janjine diblenjani jiwane rok', 'Positif'),
(10, 187, 'bankmandiri weeh ada promo cashback dong kalo bayar pake qris mandiri otw kopi janji jiwa sih ini', 'Positif'),
(11, 158, 'kurakura pangan wedus rangurus httpstcoqzah98iabl', 'Positif'),
(12, 159, 'irvanbobb aduh ini yg di nama wedus', 'Positif'),
(13, 160, 'isamabinladenn nek konco mung tak amin wing aku mangan tengkleng kambing bulan ik aku isoh tuku wedus omong adalah doa', 'Negatif'),
(14, 161, 'satrioca schatzdeer tp gae seru2 an cobak taun gakpopo gak se gae crito anak mben lek soto tau pangan wedus liwat', 'Negatif'),
(15, 162, 'wedus', 'Positif'),
(16, 163, 'rt budiwicaksono07 wong urip kui kudu iso angon ora mung angon wedus utowo sapi sing paling penting angon anggota tubuh awake dewe', 'Negatif'),
(17, 164, 'schatzdeer mben lek wes rabi ambek satrio ojok gelem orep ndek kene dir timbangane soto pangan wedus liwat', 'Negatif'),
(18, 165, 'caul tanjung wedus goblok harus yang tuduh yang bukti apakah ijazah jokowi yang kau kata palsu itu memang benar palsu', 'Negatif'),
(19, 166, 'joglofess cili wedus cili sapi cili kucing dan cilikan2 lain', 'Positif'),
(20, 167, 'rt fardishidayat kamu lek cuek nanti tak gawe pakan wedus lo', 'Positif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kata_dihilangkan`
--

CREATE TABLE `kata_dihilangkan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kata` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kata_dihilangkan`
--

INSERT INTO `kata_dihilangkan` (`id`, `kata`) VALUES
(1, 'begitu'),
(2, 'mahal'),
(3, 'sangat'),
(4, 'kurang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testings`
--

CREATE TABLE `testings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_testing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_testing` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `testings`
--

INSERT INTO `testings` (`id`, `nama_testing`, `tgl_testing`) VALUES
(2, 'Testing Coba', '2023-01-19 07:53:10'),
(3, 'Testing 2', '2023-01-19 14:25:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testing_detils`
--

CREATE TABLE `testing_detils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `testing_id` bigint(20) UNSIGNED NOT NULL,
  `post` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_twitter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `testing_detils`
--

INSERT INTO `testing_detils` (`id`, `testing_id`, `post`, `username_twitter`) VALUES
(158, 2, 'Kura-kura dipangan wedus\nRangurus https://t.co/qzaH98IAbl', '@dendirmd10'),
(159, 2, '@IrvanBobb Aduh ini yg di namanya wedus', '@imbigboy99'),
(160, 2, '@isamabinladenn Nek konco mung tak amini, wingi aku mangan tengkleng kambing bulan ik aku isoh tuku wedus 3, omongan adalah doa', '@gilangsaom'),
(161, 2, '@satrioca @schatzdeer Tp gae seru2 an cobak setaun gakpopo gak se? Gae crito anakmu mben lek sotomu tau dipangan wedus liwat', '@kipulheran'),
(162, 2, 'Wedus', '@J_Coffee88'),
(163, 2, 'RT @budiwicaksono07: Wong urip kui kudu iso angon, ora mung angon wedus utowo sapi, sing paling penting angon anggota tubuh e awake dewe', '@Sumur_Jiwa'),
(164, 2, '@schatzdeer Mben lek wes rabi ambek satrio ojok gelem orep ndek kene dir! Timbangane sotomu dipangan wedus liwat', '@kipulheran'),
(165, 2, '@caul_tanjung Wedus goblok seharusnya yang menuduh yang membuktikan apakah ijazah Jokowi  yang kau katakan palsu itu memang benar Palsu', '@Anshorianca'),
(166, 2, '@joglofess Cilikan wedus, cilikan sapi, cilikan kucing, dan cilikan2 lainnya', '@achid_bcd'),
(167, 2, 'RT @FardisHidayat: Kamu lek cuek\\\" nanti tak gawe pakan wedus lo!', '@FardisHidayat'),
(178, 3, 'RT @InvestorID: Induk Kopi Janji Jiwa Luncurkan Burger Geber https://t.co/pxITXBRcEP', '@eknug'),
(179, 3, 'RT @Strategi_Bisnis: Pertempuran Kopi Kenangan vs Janji Jiwa | Blog Strategi + Manajemen https://t.co/cmq0h4b5P4', '@Deny_Riau'),
(180, 3, 'kopi janji jiwa is so artificial 😂🥴😵‍💫', '@lazuardityaaa'),
(181, 3, '@gromcery kopi janji jiwa', '@metqllicx'),
(182, 3, 'RT @Strategi_Bisnis: Pertempuran Kopi Kenangan vs Janji Jiwa | Blog Strategi + Manajemen https://t.co/cmq0h4b5P4', '@vwamru'),
(183, 3, 'Induk Kopi Janji Jiwa Luncurkan Burger Geber https://t.co/pxITXBRcEP', '@InvestorID'),
(184, 3, 'Dyar...Janji Jiwa Mgt tutup permanen. Dimana ku bs menemukan es kopi arabica blend yawlaaaaa', '@ylndhn'),
(185, 3, '@wildestdrink @rivaimuhamad @Constantine6669 @txtdrkuliner @memelord_666666 ga semua orang doyan masalahny wkwk.. jd inget tempo hari gw pernah ke kopi janji jiwa request kopi americano tanpa Gula dan si mbak baristanya cengo wkwk', '@Linkzcrosser'),
(186, 3, 'Kopi Janji Jiwa.\nKopine diombe.\nJanjine diblenjani.\nJiwane remok.', '@RIFFdisini'),
(187, 3, '@bankmandiri Weeh ada promo cashback dong kalo bayar pake QRIS mandiri... Otw kopi janji jiwa sih ini', '@_ansyr');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trainings`
--

CREATE TABLE `trainings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kalimat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('Positif','Negatif','Netral') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `trainings`
--

INSERT INTO `trainings` (`id`, `kalimat`, `kategori`) VALUES
(1, 'Kopi Janji Jiwa sangat memuaskan Nomor 1', 'Positif'),
(2, 'Janji Jiwa harganya mahal. masak kopi bisa 30K', 'Negatif'),
(3, 'Janji Jiwa Kopinya Terasa ', 'Netral'),
(4, 'Kopi Janji Jiwa Begitu Mudah dijangkau lokasinya. sehingga memudahkan kamu milenial untuk membeli kopi', 'Positif'),
(5, 'Pelayanan kurang memuaskan', 'Negatif'),
(6, '@janjijiwakudus Cukup Baik', 'Netral'),
(7, 'Enak dan Murah', 'Positif'),
(8, 'Sedikit Kemanisan But Oke', 'Netral'),
(9, 'Kurang banget', 'Negatif'),
(10, 'Bagus banget', 'Positif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$HbEUf6RadllWjuUEn4rkmOgBu4Rd4ukZ4zTcAre9E.sh9kL65Qqp2', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hasils`
--
ALTER TABLE `hasils`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasils_testing_detil_id_foreign` (`testing_detil_id`);

--
-- Indeks untuk tabel `kata_dihilangkan`
--
ALTER TABLE `kata_dihilangkan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testings`
--
ALTER TABLE `testings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testing_detils`
--
ALTER TABLE `testing_detils`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testing_detils_testing_id_foreign` (`testing_id`);

--
-- Indeks untuk tabel `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hasils`
--
ALTER TABLE `hasils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `kata_dihilangkan`
--
ALTER TABLE `kata_dihilangkan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `testings`
--
ALTER TABLE `testings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `testing_detils`
--
ALTER TABLE `testing_detils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT untuk tabel `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasils`
--
ALTER TABLE `hasils`
  ADD CONSTRAINT `hasils_testing_detil_id_foreign` FOREIGN KEY (`testing_detil_id`) REFERENCES `testing_detils` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `testing_detils`
--
ALTER TABLE `testing_detils`
  ADD CONSTRAINT `testing_detils_testing_id_foreign` FOREIGN KEY (`testing_id`) REFERENCES `testings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
