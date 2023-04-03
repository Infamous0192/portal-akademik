-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table akademik.absensi
CREATE TABLE IF NOT EXISTS `absensi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pertemuan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_kehadiran` int(10) unsigned NOT NULL,
  `id_krs` int(10) unsigned NOT NULL,
  `id_mahasiswa` int(10) unsigned NOT NULL,
  `id_dosen` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `absensi_id_kehadiran_foreign` (`id_kehadiran`),
  KEY `absensi_id_krs_foreign` (`id_krs`),
  KEY `absensi_id_mahasiswa_foreign` (`id_mahasiswa`),
  KEY `absensi_id_dosen_foreign` (`id_dosen`),
  CONSTRAINT `absensi_id_dosen_foreign` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `absensi_id_kehadiran_foreign` FOREIGN KEY (`id_kehadiran`) REFERENCES `kehadiran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `absensi_id_krs_foreign` FOREIGN KEY (`id_krs`) REFERENCES `krs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `absensi_id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.absensi: ~0 rows (approximately)
/*!40000 ALTER TABLE `absensi` DISABLE KEYS */;
/*!40000 ALTER TABLE `absensi` ENABLE KEYS */;

-- Dumping structure for table akademik.dosen
CREATE TABLE IF NOT EXISTS `dosen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_fakultas` int(10) unsigned NOT NULL,
  `id_prodi` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dosen_nip_unique` (`nip`),
  KEY `dosen_id_prodi_foreign` (`id_prodi`),
  KEY `dosen_id_fakultas_foreign` (`id_fakultas`),
  KEY `dosen_id_user_foreign` (`id_user`),
  CONSTRAINT `dosen_id_fakultas_foreign` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dosen_id_prodi_foreign` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dosen_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.dosen: ~3 rows (approximately)
/*!40000 ALTER TABLE `dosen` DISABLE KEYS */;
REPLACE INTO `dosen` (`id`, `nama`, `nip`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `agama`, `no_telepon`, `foto`, `created_at`, `updated_at`, `id_fakultas`, `id_prodi`, `id_user`) VALUES
	(2, 'Dwa Meizadewa', '1234567890', 'Rem officia quia sin', '1984-03-27', 'P', 'Ea anim sed amet ei', 'Islam', 'Commodi non non odio', '/uploads/b3111b98-9f2c-4eaa-8d08-eb7530ce3718.jpg', '2023-03-27 23:32:08', '2023-03-27 23:32:08', 1, 1, 4),
	(5, 'Quod quis ullamco no', '101131312', 'Enim qui laboris dis', '2023-08-13', 'P', 'Iusto nostrum rerum', 'Kristen', 'Dicta ut omnis venia', '/uploads/ae009c93-9044-4b4d-9483-4102a04cdd76.jpg', '2023-04-03 20:15:47', '2023-04-03 20:16:16', 1, 1, 8);
/*!40000 ALTER TABLE `dosen` ENABLE KEYS */;

-- Dumping structure for table akademik.fakultas
CREATE TABLE IF NOT EXISTS `fakultas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.fakultas: ~0 rows (approximately)
/*!40000 ALTER TABLE `fakultas` DISABLE KEYS */;
REPLACE INTO `fakultas` (`id`, `nama`, `kode`, `created_at`, `updated_at`) VALUES
	(1, 'Matematika dan Pengetahuan Alam', '11', '2023-03-27 23:26:54', '2023-03-27 23:26:54');
/*!40000 ALTER TABLE `fakultas` ENABLE KEYS */;

-- Dumping structure for table akademik.gedung
CREATE TABLE IF NOT EXISTS `gedung` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.gedung: ~0 rows (approximately)
/*!40000 ALTER TABLE `gedung` DISABLE KEYS */;
REPLACE INTO `gedung` (`id`, `nama`, `kode`, `created_at`, `updated_at`) VALUES
	(1, 'Gedung Serbaguna', '12', '2023-03-28 03:14:08', '2023-03-28 03:14:08');
/*!40000 ALTER TABLE `gedung` ENABLE KEYS */;

-- Dumping structure for table akademik.jadwal
CREATE TABLE IF NOT EXISTS `jadwal` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.jadwal: ~1 rows (approximately)
/*!40000 ALTER TABLE `jadwal` DISABLE KEYS */;
REPLACE INTO `jadwal` (`id`, `file`, `created_at`, `updated_at`) VALUES
	(1, '/uploads/0ca8484a-be05-4550-86c7-f5416d1c8b2a.pdf', '2023-04-03 16:25:04', '2023-04-03 16:25:04'),
	(2, '/uploads/be6a7c49-89f0-4c6c-9e58-2738e5a119d4.pdf', '2023-04-03 16:40:41', '2023-04-03 16:40:41');
/*!40000 ALTER TABLE `jadwal` ENABLE KEYS */;

-- Dumping structure for table akademik.kehadiran
CREATE TABLE IF NOT EXISTS `kehadiran` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.kehadiran: ~0 rows (approximately)
/*!40000 ALTER TABLE `kehadiran` DISABLE KEYS */;
/*!40000 ALTER TABLE `kehadiran` ENABLE KEYS */;

-- Dumping structure for table akademik.krs
CREATE TABLE IF NOT EXISTS `krs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('pending','process','rejected','accepted') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_mahasiswa` int(10) unsigned NOT NULL,
  `id_tahun_akademik` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `krs_id_mahasiswa_foreign` (`id_mahasiswa`),
  KEY `krs_id_tahun_akademik_foreign` (`id_tahun_akademik`),
  CONSTRAINT `krs_id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `krs_id_tahun_akademik_foreign` FOREIGN KEY (`id_tahun_akademik`) REFERENCES `tahun_akademik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.krs: ~3 rows (approximately)
/*!40000 ALTER TABLE `krs` DISABLE KEYS */;
REPLACE INTO `krs` (`id`, `status`, `created_at`, `updated_at`, `id_mahasiswa`, `id_tahun_akademik`) VALUES
	(2, 'accepted', '2023-04-02 01:52:28', '2023-04-02 23:14:37', 1, 1),
	(3, 'accepted', '2023-04-03 01:25:42', '2023-04-03 01:26:06', 1, 3),
	(4, 'accepted', '2023-04-03 01:31:34', '2023-04-03 01:36:38', 1, 4),
	(5, 'accepted', '2023-04-03 20:19:11', '2023-04-03 20:20:06', 1, 5);
/*!40000 ALTER TABLE `krs` ENABLE KEYS */;

-- Dumping structure for table akademik.mahasiswa
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_prodi` int(10) unsigned NOT NULL,
  `id_fakultas` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mahasiswa_nim_unique` (`nim`),
  KEY `mahasiswa_id_prodi_foreign` (`id_prodi`),
  KEY `mahasiswa_id_fakultas_foreign` (`id_fakultas`),
  KEY `mahasiswa_id_user_foreign` (`id_user`),
  CONSTRAINT `mahasiswa_id_fakultas_foreign` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mahasiswa_id_prodi_foreign` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mahasiswa_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.mahasiswa: ~0 rows (approximately)
/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;
REPLACE INTO `mahasiswa` (`id`, `nama`, `nim`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `agama`, `no_telepon`, `foto`, `created_at`, `updated_at`, `id_prodi`, `id_fakultas`, `id_user`) VALUES
	(1, 'Ujang Kolot', '181101261248', 'Neque non voluptatum', '1995-11-15', 'L', 'Nulla sint eveniet', 'Islam', 'Proident veritatis', '/uploads/b4704698-46a3-4f1a-b7d4-36c6299d2a6a.jpg', '2023-03-28 00:21:39', '2023-03-28 00:21:39', 1, 1, 5);
/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;

-- Dumping structure for table akademik.matakuliah
CREATE TABLE IF NOT EXISTS `matakuliah` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `kategori` enum('W','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_prodi` int(10) unsigned NOT NULL,
  `id_ruangan` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `matakuliah_id_prodi_foreign` (`id_prodi`),
  KEY `matakuliah_id_ruangan_foreign` (`id_ruangan`),
  CONSTRAINT `matakuliah_id_prodi_foreign` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `matakuliah_id_ruangan_foreign` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.matakuliah: ~2 rows (approximately)
/*!40000 ALTER TABLE `matakuliah` DISABLE KEYS */;
REPLACE INTO `matakuliah` (`id`, `nama`, `kode`, `sks`, `semester`, `hari`, `waktu_mulai`, `waktu_selesai`, `kategori`, `created_at`, `updated_at`, `id_prodi`, `id_ruangan`) VALUES
	(1, 'Pemrograman Dasar', 'PM-123', 4, 1, 'Senin', '08:30:00', '10:00:00', 'W', '2023-04-01 03:15:00', '2023-04-01 03:15:00', 1, 1),
	(2, 'Pemrograman Lanjut', 'PM-124', 4, 3, 'Selasa', '09:30:00', '10:30:00', 'W', '2023-04-01 03:15:35', '2023-04-01 03:15:35', 1, 1),
	(3, 'Aljabar Linear', 'A-111', 3, 2, 'Senin', '08:30:00', '10:30:00', 'W', '2023-04-01 03:19:54', '2023-04-01 03:19:54', 1, 1);
/*!40000 ALTER TABLE `matakuliah` ENABLE KEYS */;

-- Dumping structure for table akademik.matakuliah_dosen
CREATE TABLE IF NOT EXISTS `matakuliah_dosen` (
  `id_matakuliah` int(10) unsigned NOT NULL,
  `id_dosen` int(10) unsigned NOT NULL,
  KEY `matakuliah_dosen_id_matakuliah_foreign` (`id_matakuliah`),
  KEY `matakuliah_dosen_id_dosen_foreign` (`id_dosen`),
  CONSTRAINT `matakuliah_dosen_id_dosen_foreign` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `matakuliah_dosen_id_matakuliah_foreign` FOREIGN KEY (`id_matakuliah`) REFERENCES `matakuliah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.matakuliah_dosen: ~2 rows (approximately)
/*!40000 ALTER TABLE `matakuliah_dosen` DISABLE KEYS */;
REPLACE INTO `matakuliah_dosen` (`id_matakuliah`, `id_dosen`) VALUES
	(2, 2),
	(1, 2),
	(1, 5);
/*!40000 ALTER TABLE `matakuliah_dosen` ENABLE KEYS */;

-- Dumping structure for table akademik.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.migrations: ~16 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(2, '2023_03_22_092136_create_user_table', 1),
	(3, '2023_03_22_092456_create_fakultas_table', 1),
	(4, '2023_03_22_092558_create_prodi_table', 1),
	(5, '2023_03_22_093558_create_mahasiswa_table', 1),
	(6, '2023_03_22_093625_create_dosen_table', 1),
	(7, '2023_03_22_094956_create_gedung_table', 1),
	(8, '2023_03_22_095009_create_ruangan_table', 1),
	(9, '2023_03_22_095325_create_matakuliah_table', 1),
	(10, '2023_03_22_164604_create_tahun_akademik_table', 1),
	(11, '2023_03_22_165623_create_matakuliah_dosen_table', 1),
	(12, '2023_03_22_165733_create_krs_table', 1),
	(14, '2023_03_22_170455_create_kehadiran_table', 1),
	(15, '2023_03_22_171111_create_absensi_table', 1),
	(16, '2023_03_22_165942_create_nilai_table', 2),
	(17, '2023_04_03_161119_create_jadwal_table', 3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table akademik.nilai
CREATE TABLE IF NOT EXISTS `nilai` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nilai_absen` int(11) NOT NULL,
  `nilai_tugas` int(11) NOT NULL,
  `nilai_uts` int(11) NOT NULL,
  `nilai_uas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_mahasiswa` int(10) unsigned NOT NULL,
  `id_matakuliah` int(10) unsigned NOT NULL,
  `id_krs` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nilai_id_mahasiswa_foreign` (`id_mahasiswa`),
  KEY `nilai_id_matakuliah_foreign` (`id_matakuliah`),
  KEY `nilai_id_krs_foreign` (`id_krs`),
  CONSTRAINT `nilai_id_krs_foreign` FOREIGN KEY (`id_krs`) REFERENCES `krs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nilai_id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nilai_id_matakuliah_foreign` FOREIGN KEY (`id_matakuliah`) REFERENCES `matakuliah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.nilai: ~4 rows (approximately)
/*!40000 ALTER TABLE `nilai` DISABLE KEYS */;
REPLACE INTO `nilai` (`id`, `nilai_absen`, `nilai_tugas`, `nilai_uts`, `nilai_uas`, `created_at`, `updated_at`, `id_mahasiswa`, `id_matakuliah`, `id_krs`) VALUES
	(4, 80, 60, 75, 57, '2023-04-02 15:26:13', '2023-04-02 15:26:13', 1, 1, 2),
	(6, 0, 0, 0, 0, '2023-04-03 01:25:42', '2023-04-03 01:25:42', 1, 3, 3),
	(7, 50, 60, 70, 70, '2023-04-03 01:31:34', '2023-04-03 17:18:46', 1, 1, 4),
	(8, 0, 0, 0, 0, '2023-04-03 01:31:38', '2023-04-03 01:31:38', 1, 2, 4),
	(9, 80, 80, 80, 80, '2023-04-03 20:19:11', '2023-04-03 20:20:37', 1, 3, 5);
/*!40000 ALTER TABLE `nilai` ENABLE KEYS */;

-- Dumping structure for table akademik.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table akademik.prodi
CREATE TABLE IF NOT EXISTS `prodi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang` enum('D3','S1','S2','S3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_fakultas` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prodi_id_fakultas_foreign` (`id_fakultas`),
  CONSTRAINT `prodi_id_fakultas_foreign` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.prodi: ~2 rows (approximately)
/*!40000 ALTER TABLE `prodi` DISABLE KEYS */;
REPLACE INTO `prodi` (`id`, `nama`, `kode`, `jenjang`, `created_at`, `updated_at`, `id_fakultas`) VALUES
	(1, 'S1 Ilmu Komputer', '016', 'D3', '2023-03-27 23:26:54', '2023-03-27 23:26:54', 1),
	(2, 'S1 Matematika', '017', 'D3', '2023-03-27 23:26:54', '2023-03-27 23:26:54', 1);
/*!40000 ALTER TABLE `prodi` ENABLE KEYS */;

-- Dumping structure for table akademik.ruangan
CREATE TABLE IF NOT EXISTS `ruangan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_gedung` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ruangan_id_gedung_foreign` (`id_gedung`),
  CONSTRAINT `ruangan_id_gedung_foreign` FOREIGN KEY (`id_gedung`) REFERENCES `gedung` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.ruangan: ~0 rows (approximately)
/*!40000 ALTER TABLE `ruangan` DISABLE KEYS */;
REPLACE INTO `ruangan` (`id`, `nama`, `kode`, `created_at`, `updated_at`, `id_gedung`) VALUES
	(1, 'Ruangan Apoteker 1.3', '31', '2023-03-28 03:14:20', '2023-03-28 03:14:20', 1);
/*!40000 ALTER TABLE `ruangan` ENABLE KEYS */;

-- Dumping structure for table akademik.tahun_akademik
CREATE TABLE IF NOT EXISTS `tahun_akademik` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` enum('genap','ganjil') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.tahun_akademik: ~3 rows (approximately)
/*!40000 ALTER TABLE `tahun_akademik` DISABLE KEYS */;
REPLACE INTO `tahun_akademik` (`id`, `nama`, `semester`, `status`, `created_at`, `updated_at`) VALUES
	(1, '2022/2023', 'ganjil', 1, '2023-03-31 13:21:07', '2023-03-31 13:21:07'),
	(3, '2022/2023', 'genap', 1, '2023-04-03 01:23:52', '2023-04-03 01:23:52'),
	(4, '2023/2024', 'ganjil', 1, '2023-04-03 01:27:15', '2023-04-03 01:27:15'),
	(5, '2023/2024', 'genap', 1, '2023-04-03 20:18:20', '2023-04-03 20:21:01');
/*!40000 ALTER TABLE `tahun_akademik` ENABLE KEYS */;

-- Dumping structure for table akademik.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('dosen','mahasiswa','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table akademik.user: ~5 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `nama`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin', '$2y$10$t3a7dIjgoA82ePGrHmpZVuyagD267crHQW5JXNhV.W6fi1gA9Ki1S', 'admin', '2023-03-27 23:26:54', '2023-03-27 23:26:54'),
	(4, 'Est vel quia ducimus', '1234567890', '$2y$10$AfqJMJrmDWtgakgHRHypGOIbA7GZ37W1.N9w20nU5yw5KGtHDZqO6', 'dosen', '2023-03-27 23:32:08', '2023-03-27 23:32:08'),
	(5, 'Ujang Kolot', '181101261248', '$2y$10$ED78AfL4etB4VjNbbJym9.Yjc3ds9BkXbITFgV6cIJdhFjE5RBAgG', 'mahasiswa', '2023-03-28 00:21:39', '2023-03-28 00:21:39'),
	(6, 'Et distinctio Facil', 'Dolor fugit aut sun', '$2y$10$cIzh9lMQYSFSNCSD3Z0qNeEsO2jk635OFeRjSoUAL1HZRqQMXLs2q', 'dosen', '2023-03-30 01:12:23', '2023-03-30 01:12:23'),
	(7, 'Repellendus Repelle', 'Sed laboriosam veli', '$2y$10$GMK8326iP1JpfhC54O6RiuTFrGjlTpAr1a4mntaDCkD6l4GNJMu16', 'dosen', '2023-03-30 01:16:57', '2023-03-30 01:16:57'),
	(8, 'Quod quis ullamco no', '101131312', '$2y$10$PPwg1uzYdVh4A9R03p795OTvOQc4qBaSHW3mz18AUOsVolVU2YfZe', 'dosen', '2023-04-03 20:15:47', '2023-04-03 20:15:47');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
