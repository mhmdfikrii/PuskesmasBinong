-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Sep 2023 pada 04.27
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puskesmas_binong`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account_verif`
--

CREATE TABLE `account_verif` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token_verif` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `account_verif`
--

INSERT INTO `account_verif` (`id`, `user_id`, `token_verif`, `status`, `created_at`, `updated_at`) VALUES
(4, 23, '23-1691504840', 0, '2023-08-08 07:27:20', '2023-08-08 07:27:20'),
(5, 24, '24-1691505284', 0, '2023-08-08 07:34:44', '2023-08-08 07:34:44'),
(6, 25, '25-1691505481', 0, '2023-08-08 07:38:01', '2023-08-08 07:38:01'),
(9, 28, '28-1691505838', 0, '2023-08-08 07:43:58', '2023-08-08 07:43:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `kode_antrian` varchar(255) NOT NULL,
  `antrian` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `NIK` varchar(255) NOT NULL,
  `tgllahir` varchar(255) NOT NULL,
  `kode_poli` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`kode_antrian`, `antrian`, `name`, `NIK`, `tgllahir`, `kode_poli`, `status`, `created_at`, `updated_at`) VALUES
('G001-0001-1691162672', 'G001-0001', 'Idris Mardefi', '101212120120120220', '2000-03-09', 'G001', 1, '2023-08-04 08:24:32', '2023-08-04 08:25:28'),
('G001-0001-1693953034', 'G001-0001', 'Muhammad Fikri Ramadhan', '423123112312312312', '2000-12-23', 'G001', 1, '2023-09-05 15:30:34', '2023-09-05 15:32:50'),
('G001-0001-1693973419', 'G001-0001', 'Muhammad Fikri Ramadhan', '423123112312312312', '2000-12-23', 'G001', 1, '2023-09-05 21:10:19', '2023-09-05 21:10:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Kesehatan Masyarakat', 'kesehatan-masyarakat', 'category-images/GCfSzy2O8wLfgSRXOcrcvAltU6iT62hKTdMBEOeA.jpg', '2023-07-03 18:48:55', '2023-07-03 18:48:55'),
(3, 'Poli jiwa', 'poli-jiwa', 'category-images/SsRCKfYy991S1HTctEJcoGrOo14vfJJviuUmRwHx.jpg', '2023-07-08 06:42:00', '2023-07-08 06:42:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_pelayanan`
--

CREATE TABLE `category_pelayanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `category_pelayanan`
--

INSERT INTO `category_pelayanan` (`id`, `nama_category`, `created_at`, `updated_at`) VALUES
(1, 'pelayanan kesehatan', '2023-06-09 13:36:55', '2023-06-09 13:36:58'),
(2, 'pelayanan penunjang', '2023-06-09 13:37:00', '2023-06-09 13:37:03'),
(3, 'tarif tambahan poli gigi', '2023-06-09 13:37:03', '2023-06-09 13:37:36'),
(4, 'tarif tambahan poli bidan', '2023-06-09 13:37:03', '2023-06-09 13:37:36'),
(5, 'tarif tambahan UGD', '2023-06-09 13:37:03', '2023-06-09 13:37:36'),
(6, 'tarif tambahan laboratorium', '2023-06-09 13:37:03', '2023-06-09 13:37:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `name`, `userid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gilandra', 10, 0, '2023-05-13 23:27:49', '2023-06-21 07:41:09'),
(2, 'Faishal Rahmat', 11, 1, '2023-05-13 23:30:12', '2023-06-21 07:41:09'),
(3, 'Fikri', 15, 1, '2023-05-13 23:30:12', '2023-07-05 09:13:09'),
(4, 'Muhammad Fadillah Abdul Aziz', 16, 0, '2023-07-01 22:59:58', '2023-07-01 22:59:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_02_041715_create_posts_table', 1),
(6, '2023_03_02_131049_create_categories_table', 1),
(7, '2023_03_10_083149_add_is_admin_to_users_table', 1),
(8, '2023_03_18_024412_create_obats_table', 1),
(9, '2023_04_27_064009_create_obat_categories_table', 1),
(10, '2023_05_12_121510_create_polis_table', 2),
(11, '2023_05_12_123129_poli', 3),
(12, '2023_05_13_145759_create_ruangans_table', 4),
(13, '2023_05_14_061119_create_dokters_table', 5),
(14, '2023_05_14_192712_antrian', 6),
(15, '2023_05_31_142121_rekam_medis', 7),
(16, '2023_06_07_083203_surat_rujukan', 8),
(17, '2023_06_08_222944_resep_obat', 9),
(18, '2023_06_09_133118_category_pelayanan', 10),
(19, '2023_06_09_133126_pelayanan', 11),
(20, '2023_06_13_120610_p_pelayanan', 12),
(21, '2023_06_13_121144_p_pelayanan', 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota_pembayaran`
--

CREATE TABLE `nota_pembayaran` (
  `kode_notapembayaran` varchar(255) NOT NULL,
  `kode_resepobat` varchar(255) DEFAULT NULL,
  `kode_rujukan` varchar(255) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nota_pembayaran`
--

INSERT INTO `nota_pembayaran` (`kode_notapembayaran`, `kode_resepobat`, `kode_rujukan`, `total`, `created_at`, `updated_at`) VALUES
('pembayaran-1693953343', NULL, '55522323114213', 14000, '2023-09-05 15:35:43', '2023-09-05 15:35:43'),
('pembayaran-1693953349', NULL, 'wdasdwjdagsawda2231231', 0, '2023-09-05 15:35:49', '2023-09-05 15:35:49'),
('pembayaran-1693973553', 'resep-1693973467', NULL, 195000, '2023-09-05 21:12:33', '2023-09-05 21:12:33'),
('pembayaran-1693973623', 'resep-1693973467', NULL, 195000, '2023-09-05 21:13:43', '2023-09-05 21:13:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obats`
--

CREATE TABLE `obats` (
  `kode_obat` varchar(255) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `kategori_obat` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obats`
--

INSERT INTO `obats` (`kode_obat`, `nama_obat`, `kategori_obat`, `stok`, `harga`, `created_at`, `updated_at`) VALUES
('Kapsul-IN001', 'Intunal Xtra', '2', 80, 6000, '2023-05-19 08:57:18', '2023-07-02 04:32:45'),
('Vaksin-SB001', 'Vaksin SB', '1', 45, 120000, '2023-05-19 08:57:18', '2023-07-06 20:38:10'),
('Vaksin-SH001', 'Vaksin SH', '1', 75, 100000, '2023-05-19 08:57:18', '2023-07-05 09:03:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat_categories`
--

CREATE TABLE `obat_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat_categories`
--

INSERT INTO `obat_categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Vaksin', 'vaksin', 'obat_category/Lcv8nJ3lgZdEn1pmoTzV8YDs4hY5utbHnUVkFvBk.png', '2023-05-19 08:56:51', '2023-05-19 08:56:51'),
(2, 'Kapsul', 'kapsul', 'obat_category/Lcv8nJ3lgZdEn1pmoTzV8YDs4hY5utbHnUVkFvBk.png', '2023-05-19 08:56:51', '2023-05-19 08:56:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelayanan`
--

CREATE TABLE `pelayanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` bigint(20) NOT NULL,
  `layanan` varchar(255) NOT NULL,
  `biaya` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelayanan`
--

INSERT INTO `pelayanan` (`id`, `category`, `layanan`, `biaya`, `created_at`, `updated_at`) VALUES
(1, 1, 'pelayanan rawat jalan', 14000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(2, 1, 'pelayanan UGD dan Observasi', 75000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(3, 1, 'pelayanan observasi pasien poned', 75000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(4, 1, 'pemeriksaan Haji tahap 1', 150000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(5, 1, 'keuring untuk anak sekolah atau kuliah', 15000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(6, 1, 'keuring umum', 25000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(7, 1, 'pemberkasan casn/p3k', 50000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(8, 1, 'keuring calon pengantin', 50000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(9, 1, 'keuring polisi asuransi', 100000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(10, 2, 'pelayanan ambulan angkut jenazah 5km', 150000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(11, 2, 'pelayanan angkut jenazah 50km', 150000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(12, 3, 'tumpatan tetap dengan GIC', 70000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(13, 3, 'pencabutan gigi dengan CE', 30000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(14, 3, 'pencabutan gigi dengan anestesi lokal (tanpa penyulit)', 50000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(15, 3, 'pencabutan gigi dengan anestesi lokal (dengan penyulit)', 100000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(16, 4, 'oksigen 30 menit pertama', 50000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(17, 4, 'oksigen 30 menit berikutnya', 15000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(18, 5, 'pemasangan botol infus pertama', 150000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(19, 5, 'pemasangan infus tiap botol berikutnya', 50000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(20, 5, 'tindakan jahit luka 1 sampai dengan 3 jahitan ', 75000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(21, 5, 'tindakan jahit luka setiap jahitan berikutnya', 10000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(22, 5, 'tindakan angkat jahitan', 50000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(23, 5, 'tindakan ekstrasi kuku', 50000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(24, 5, 'tindakan simkursisi', 350000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(25, 5, 'tindakan perawatan luka dengan penyulit', 50000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(26, 6, 'carik celup urine sendimen', 43000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(27, 6, 'hemogoblin', 14000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(28, 6, 'golongan darah ABO', 14000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(29, 6, 'golongan darah ABO + Rhesus', 14000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(30, 6, 'mikroskopis ZN(BTA)1x', 85000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(31, 6, 'mikroskopis ZN(BTA)3x', 100000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(32, 6, 'widal/aglutinassi', 42000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(33, 6, 'asam urat', 42000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43'),
(34, 6, 'glukosa', 42000.00, '2023-06-09 13:53:43', '2023-06-09 13:53:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `kode_poli` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dokter` int(11) NOT NULL,
  `ruangan` varchar(255) NOT NULL,
  `jadwal` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`kode_poli`, `name`, `description`, `dokter`, `ruangan`, `jadwal`, `isActive`, `created_at`, `updated_at`) VALUES
('A002', 'Poli Anak', '<div>Poli Untuk anak</div>', 2, '01-001', '08:00 s/d 13:00', 1, '2023-05-14 12:20:37', '2023-05-14 12:20:37'),
('G001', 'Poli Gizi', '<div>poli untuk gizi</div>', 3, '01-002', '08:00 s/d 13:00', 1, '2023-07-05 09:13:09', '2023-07-06 02:43:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `excerpt` text NOT NULL,
  `body` text NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `user_id`, `title`, `slug`, `image`, `excerpt`, `body`, `published_at`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 'Pentingnya Kesehatan Masyarakat', 'pentingnya-kesehatan-masyarakat', 'post-images/zCikUvrheHMK7z3fsDpP9Db2CLWX8DYqjZ6BI19N.jpg', 'JAKARTA - Perhimpunan Pakar Gizi dan Pangan (Pergizi Pangan) Indonesia terus mendukung industri pangan untuk terus mengembangkan inovasi produk dan program untuk perbaikan mutu pangan dan gizi masyara...', '<div>JAKARTA - Perhimpunan Pakar Gizi dan Pangan (Pergizi Pangan) Indonesia terus mendukung industri pangan untuk terus mengembangkan inovasi produk dan program untuk perbaikan mutu pangan dan gizi masyarakat. Bersama Gabungan Pengusaha Makanan dan Minuman Indonesia (GAPMMI), Pergizi Pangan secara kontinu memberikan Penghargaan Inovasi Produk, Program, dan Leadership Pangan dan Gizi (Peduli Gizi) sejak 2012. Tahun ini pun menjadi tahun keempat penyelenggaraan penghargaan tersebut. Pemerintah dan stakeholder terkait berkomitmen mencapai Sustainable Development Goals (SDGs) bidang pangan dan kesehatan, yang di antaranya bertujuan untuk mengentaskan kemiskinan dan kelaparan serta kekurangan gizi.<br><br>Selain itu, juga peningkatan kesehatan dan kesejahteraan masyarakat, termasuk pencegahan obesitas dan penyakit kronik tidak menular melalui peningkatan mutu gizi konsumsi pangan, aktivitas fisik dan perilaku sehat. \"Dalam mewujudkan tujuan ini, tidak dapat dimungkiri bahwa peran swasta khususnya industri pangan semakin besar dalam mengembangkan produk pangan yang mempertimbangkan aspek gizi dan kesehatan, termasuk bagi mereka yang memerlukan pembatasan asupan gula, di samping aspek citarasa,\" jelas Ketua Umum Pergizi Pangan, Prof. Dr. Hardinsyah, MS, dalam keterangan persnya, baru-baru ini. Sebagai respons terhadap upaya pembatasan asupan gula tersebut, Pergizi Pangan memberikan penghargaan Peduli Gizi 2023 dalam berbagai kategori seperti produk inovatif, program inovatif dan juga leader inovatif.<br><br></div>', NULL, '2023-07-03 18:50:41', '2023-07-03 18:50:41'),
(4, 2, 1, 'Senam Bersama, GMC Kalteng Ajak Masyarakat Budayakan Hidup Sehat', 'senam-bersama,-gmc-kalteng-ajak-masyarakat-budayakan-hidup-sehat', 'post-images/Djj5iozRaf4Y1NECCeKyU3wel2A9BLCKLkkhHgqL.jpg', 'KAPUAS - Relawan Ganjar Milenial Center (GMC) menggelar senam sehat di jalan Trans Kalimantan Km 9, Desa Anjir Serapat, Kabupaten Kapuas. Ratusan masyarakat dan pemuda milenial ikut terlibat pada sena...', '<div>KAPUAS - Relawan Ganjar Milenial Center (GMC) menggelar senam sehat di jalan Trans Kalimantan Km 9, Desa Anjir Serapat, Kabupaten Kapuas. Ratusan masyarakat dan pemuda milenial ikut terlibat pada senam sehat itu. Ketua GMC Kalteng M Rosyid Ridho mengatakan, pihaknya mengajak masyarakat Kapuas untuk aktif bergerak dan menjaga pola hidup sehat. Dia berharap kegiatan tersebut dapat mengurangi risiko penyakit akibat kurangnya olahraga. \"Kami mengadakan senam sehat untuk mencegah dan mengurangi resiko penyakit. Agar masyarakat lebih berkeringat, lebih sehat, dan lebih baik,\" kata Roysid Ridho dalam siaran persnya, Selasa (30/5/2023). Tidak hanya melakukan senam, kegiatan olahraga itu dikemas semenarik mungkin. Relawan Ganjar Pranowo itu menyediakan berbagai hadiah dalam senam sehat tersebut. “Kami sediakan hadiah menarik agar peserta makin semangat. Jadi, mereka selain dapat sehat juga dapat hadiah bagi yang beruntung,” ujarnya.<br><br></div>', NULL, '2023-07-03 18:52:28', '2023-07-03 18:52:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_pelayanan`
--

CREATE TABLE `p_pelayanan` (
  `pelayanan_id` bigint(20) NOT NULL,
  `kode_rekammedis` varchar(255) NOT NULL,
  `biaya` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `p_pelayanan`
--

INSERT INTO `p_pelayanan` (`pelayanan_id`, `kode_rekammedis`, `biaya`, `created_at`, `updated_at`) VALUES
(1, 'G001-0001-1691162672-1691162711', 14000, NULL, NULL),
(1, 'G001-0001-1693953034-1693953155', 14000, NULL, NULL),
(2, 'G001-0001-1693973419-1693973451', 75000, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_resep_obat`
--

CREATE TABLE `p_resep_obat` (
  `kode_resep_obat` varchar(255) NOT NULL,
  `kode_obat` varchar(255) NOT NULL,
  `dosis` varchar(255) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `p_resep_obat`
--

INSERT INTO `p_resep_obat` (`kode_resep_obat`, `kode_obat`, `dosis`, `qty`, `status`, `created_at`, `updated_at`) VALUES
('resep-1693973467', 'Vaksin-SB001', 'adwadsdaw', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `kode_rekammedis` varchar(255) NOT NULL,
  `antrian` varchar(255) NOT NULL,
  `bpjs` varchar(255) DEFAULT NULL,
  `anamnesa` text NOT NULL,
  `pemeriksaan_fisik` text NOT NULL,
  `diagnosa` varchar(255) NOT NULL,
  `tindakan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dokter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekam_medis`
--

INSERT INTO `rekam_medis` (`kode_rekammedis`, `antrian`, `bpjs`, `anamnesa`, `pemeriksaan_fisik`, `diagnosa`, `tindakan`, `created_at`, `updated_at`, `dokter`) VALUES
('G001-0001-1691162672-1691162711', 'G001-0001-1691162672', '10119312122131', 'awdasdasd', 'dasdawdas', 'dwadsd', 'surat-rujukan', '2023-08-04 08:25:11', '2023-08-04 08:25:11', 3),
('G001-0001-1693953034-1693953155', 'G001-0001-1693953034', NULL, 'keluhan sakit pada daerah kaki', 'tekanan darah 120', 'Kolestrol', 'surat-rujukan', '2023-09-05 15:32:35', '2023-09-05 15:32:35', 3),
('G001-0001-1693973419-1693973451', 'G001-0001-1693973419', NULL, 'afahsdasjdwagds', 'wadhsdagwdas', 'wakdakdwkads', 'obat-resep', '2023-09-05 21:10:51', '2023-09-05 21:10:51', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep_obat`
--

CREATE TABLE `resep_obat` (
  `kode_resep_obat` varchar(255) NOT NULL,
  `kode_rekamedis` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `resep_obat`
--

INSERT INTO `resep_obat` (`kode_resep_obat`, `kode_rekamedis`, `status`, `created_at`, `updated_at`) VALUES
('resep-1693973467', 'G001-0001-1693973419-1693973451', 0, '2023-09-05 21:11:07', '2023-09-05 21:11:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `kode` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`kode`, `name`, `status`, `created_at`, `updated_at`) VALUES
('01-001', 'Ruangan Lt 1 - 001', 1, '2023-05-14 07:47:16', '2023-06-21 07:40:10'),
('01-002', 'Ruangan Lt 1 - 002', 1, '2023-05-14 00:49:40', '2023-07-05 09:13:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_rujukan`
--

CREATE TABLE `surat_rujukan` (
  `kode_rujukan` varchar(255) NOT NULL,
  `kode_rekammedis` varchar(255) NOT NULL,
  `fasilitas` varchar(255) DEFAULT NULL,
  `rencana_tindak_lanjut` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_rujukan`
--

INSERT INTO `surat_rujukan` (`kode_rujukan`, `kode_rekammedis`, `fasilitas`, `rencana_tindak_lanjut`, `created_at`, `updated_at`) VALUES
('55522323114213', 'G001-0001-1693953034-1693953155', 'Perlu Pemeriksaan Penunjang', 'Perlu Pemeriksaan Penunjang', '2023-09-05 15:32:50', '2023-09-05 15:32:50'),
('wdasdwjdagsawda2231231', 'G001-0001-1691162672-1691162711', 'Perlu Pemeriksaan Penunjang', 'Melihat efek Therapy sebelumnya', '2023-08-04 08:25:28', '2023-08-04 08:25:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `invoice` varchar(255) NOT NULL,
  `kode_notapembayaran` varchar(255) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`invoice`, `kode_notapembayaran`, `total`, `status`, `created_at`, `updated_at`) VALUES
('invoice-1693953343', 'pembayaran-1693953343', 14000, 'Settled', '2023-09-05 15:35:43', '2023-09-05 15:35:45'),
('invoice-1693953349', 'pembayaran-1693953349', 0, 'Settled', '2023-09-05 15:35:49', '2023-09-05 15:35:49'),
('invoice-1693973553', 'pembayaran-1693973553', 195000, 'Pending', '2023-09-05 21:12:33', '2023-09-05 21:12:33'),
('invoice-1693973623', 'pembayaran-1693973623', 195000, 'Settled', '2023-09-05 21:13:43', '2023-09-05 21:14:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `NIK` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kepalakeluarga` varchar(255) NOT NULL,
  `opsibpjs` varchar(255) NOT NULL,
  `bpjs` varchar(255) DEFAULT NULL,
  `tgllahir` date NOT NULL,
  `age` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `cek` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `NIK`, `alamat`, `kepalakeluarga`, `opsibpjs`, `bpjs`, `tgllahir`, `age`, `username`, `email`, `email_verified_at`, `password`, `cek`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'admin', '10121212012012010', 'Jl kav korobokan. kel Citeureup. Kec Cimahi utara', 'admin', 'TIDAK', NULL, '2000-03-09', 23, 'admin', 'admin@email.com', NULL, '$2y$10$KtncpJF44p.h7UPAXTirluV96KrckTaEE7LpfxlHT8KY1ITvgXv7y', 1, NULL, '2023-05-12 01:29:31', '2023-05-12 01:30:21', 1),
(2, 'farmasi', '10121212012012011', 'Jl kav korobokan. kel Citeureup. Kec Cimahi utara', 'farmasi', 'TIDAK', NULL, '2000-03-09', 23, 'farmasi', 'farmasi@email.com', NULL, '$2y$10$U7F8Yd8f0uW2iYIDVmzlPud/rVJ8vN8jQH6hu5XenT2lJIqnzbs8G', 1, NULL, '2023-05-12 01:31:19', '2023-05-12 01:31:19', 4),
(4, 'administrasi', '10121212012012014', 'Jl kav korobokan. kel Citeureup. Kec Cimahi utara', 'administrasi', 'TIDAK', NULL, '2000-03-09', 23, 'administrasi', 'administrasi@email.com', NULL, '$2y$10$AXmHDElmWDdjjmCrGmgu2O.a9gUK/5UXLN2tQp4P30E2TR6gDbXOy', 1, NULL, '2023-05-12 01:33:21', '2023-05-12 01:33:21', 3),
(5, 'Muhammad Fadillah Abdul Aziz', '101212120120120212', 'Jl kav korobokan. kel Citeureup. Kec Cimahi utara', 'Fadil', 'YA', '1011931212121', '2000-03-09', 23, 'Fadillah', 'gozzafadillah@gmail.com', NULL, '$2y$10$vqvTkHXRoAdmkoT8PIPyXOMJtFH1e3pLU2G6q/rCJOcS/caIJYzXu', 1, NULL, '2023-05-12 01:34:09', '2023-05-12 01:34:09', 0),
(9, 'Dea Belinda', '101212120120120192', 'JL Sarijadi No 1 A', 'Dea', 'TIDAK', NULL, '2000-03-09', 23, 'Dea', 'dea@gmail.com', NULL, '$2y$10$LhOLOGwWq0uxkSZucSzBVuCkF9hK7COA1yTLwZzG4x.J9oHMwZFya', 1, NULL, '2023-05-13 23:26:20', '2023-05-13 23:26:20', 0),
(10, 'Gilandra', '10121212012012022', 'JL Sarinah No 1 A', 'Gilan', 'TIDAK', NULL, '2000-03-09', 23, 'Gilandra', 'Gilandra@dokter.com', NULL, '$2y$10$lFXYwGm0.RVSljUWk4B1auLRaWbZ5hr3cMj9yOCQbMOS9KuXR5Y6.', 1, NULL, '2023-05-13 23:27:49', '2023-05-13 23:27:49', 2),
(11, 'Faishal Rahmat', '10121212012012009', 'JL Sarijadi No 1 A', 'Dr Faishal', 'TIDAK', NULL, '2000-03-09', 23, 'Faishal', 'faishal@dokter.com', NULL, '$2y$10$6AgKjiUfTBIjOl2JQWKfzOYbMkb/zSa4copAjV/RTH58c1NfxTKwy', 1, NULL, '2023-05-13 23:30:12', '2023-05-13 23:30:12', 2),
(12, 'Idris Mardefi', '101212120120120220', 'JL Sarijadi No 1 B', 'Idris', 'YA', '10119312122131', '2000-03-09', 23, 'Idris', 'idris@gmail.com', NULL, '$2y$10$SN4MBj.KBOB8rwoyxbOGAONcX5Ww4ZecRDki4U8js5XDKddzYBa0.', 1, NULL, '2023-05-19 08:45:12', '2023-06-10 06:05:23', 0),
(13, 'Aldy Pratama', '101212131212121212131414', 'JL Sarijadi No 1 A', 'Aldy', 'YA', '1230192381241031312', '2000-03-09', 23, 'Aldy', 'aldy@gmail.com', NULL, '$2y$10$SN4MBj.KBOB8rwoyxbOGAONcX5Ww4ZecRDki4U8js5XDKddzYBa0.', 0, NULL, '2023-06-11 04:46:43', '2023-06-20 09:48:50', 0),
(14, 'Kiana Sekar', '123123120841048123', 'JL Sarijadi No 1 A', 'Sumanto', 'YA', '12212113213131', '1945-02-01', 78, 'Kiana', 'kiana@gmail.com', NULL, '$2y$10$JNLggFSRvvpToQuXmHPHY.C9gUVo95FexAhzzNLuTOQvvc2Ml86uG', 0, NULL, '2023-06-20 10:07:37', '2023-06-20 10:09:32', 0),
(15, 'Fikri', '10121212012012041', 'JL Sarijadi No 1 A', 'Dr Fikri', 'TIDAK', NULL, '2000-03-09', 23, 'Fikri', 'fikri@dokter.com', NULL, '$2y$10$6AgKjiUfTBIjOl2JQWKfzOYbMkb/zSa4copAjV/RTH58c1NfxTKwy', 1, NULL, '2023-05-13 23:30:12', '2023-05-13 23:30:12', 2),
(16, 'Muhammad Fadillah Abdul Aziz', '1209813012830213', 'JL Sarijadi No 1 A', 'Fadillah', 'TIDAK', NULL, '2000-03-09', 23, 'Dokter Fadil', 'fadillah@dokter.com', NULL, '$2y$10$PGCyYyMfqRsW.HGQNrNCb.zj4tTCO4PHLt.phdwy.QXaof8LpJ/0.', 1, NULL, '2023-07-01 22:59:58', '2023-07-01 22:59:58', 2),
(17, 'Muhammad Fikri Ramadhan', '423123112312312312', 'Jl Laks L RE Martadinata 48, Jawa Barat', 'Andi', 'TIDAK', NULL, '2000-12-23', 22, 'Fikri23', 'pasien@email.com', NULL, '$2y$10$jyQ04tKz5lm6TCx.L3otluqmgIRDeRTbx3Jzzv2sI2qCkWA.meuOG', 1, NULL, '2023-07-02 04:22:12', '2023-07-02 04:22:12', 0),
(18, 'samsudin', '2381273123291732322', 'Jl Laks L RE Martadinata 48, Jawa Barat', 'Rara', 'YA', '21312312312312299122', '2009-02-09', 14, 'udins', 'coba123@gmail.com', NULL, '$2y$10$qjsW/coKR8M9Y/23xp0XYOjyRRcwfeZjXsLxcLeECen5qvGQ/I7d2', 0, NULL, '2023-07-03 20:05:23', '2023-09-05 16:03:01', 0),
(19, 'Muhammad Fikri Ramadhan', '8568758758232761', 'Jl Laks L RE Martadinata 48, Jawa Barat', 'Rara', 'TIDAK', NULL, '2000-12-23', 22, 'FikriAZA', 'muh.fikriramadhan23@gmail.com', NULL, '$2y$10$CfPkLBo2rl896oSo1LEKQeg9Iwc0IERrpn4JyprBtRTFhptkPGYei', 3, NULL, '2023-09-05 15:26:52', '2023-09-05 15:26:52', 0),
(22, 'Budi Rahmadi', '9606471539973295', 'Jl Laks L RE Martadinata 48, Jawa Barat', 'Rara', 'YA', '960649999973295', '2001-02-08', 22, 'Bujay', 'kangkwetiau@gmail.com', NULL, '$2y$10$WgX9ZtJs.284t/wqgRHzjOwdQogWE.z5RdETS.AZdgrpqpazE/YGu', 2, NULL, '2023-09-05 18:53:51', '2023-09-05 18:54:43', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `account_verif`
--
ALTER TABLE `account_verif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `category_pelayanan`
--
ALTER TABLE `category_pelayanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nota_pembayaran`
--
ALTER TABLE `nota_pembayaran`
  ADD PRIMARY KEY (`kode_notapembayaran`);

--
-- Indeks untuk tabel `obats`
--
ALTER TABLE `obats`
  ADD PRIMARY KEY (`kode_obat`);

--
-- Indeks untuk tabel `obat_categories`
--
ALTER TABLE `obat_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indeks untuk tabel `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD PRIMARY KEY (`kode_resep_obat`);

--
-- Indeks untuk tabel `surat_rujukan`
--
ALTER TABLE `surat_rujukan`
  ADD PRIMARY KEY (`kode_rujukan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`invoice`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nik_unique` (`NIK`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `account_verif`
--
ALTER TABLE `account_verif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `category_pelayanan`
--
ALTER TABLE `category_pelayanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `obat_categories`
--
ALTER TABLE `obat_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
