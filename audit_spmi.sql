-- -------------------------------------------------------------
-- TablePlus 6.1.2(568)
--
-- https://tableplus.com/
--
-- Database: audit
-- Generation Time: 2024-08-09 14:45:57.5800
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `admin` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `auditor` (
  `id` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `dokumen` (
  `id` char(36) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tautan` varchar(255) NOT NULL,
  `status_pengisian` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `id_lembaga` char(36) NOT NULL,
  `status_docs` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `score` int DEFAULT NULL,
  `tgl_pengumpulan` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tautan` (`tautan`),
  KEY `id_lembaga` (`id_lembaga`),
  CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`id_lembaga`) REFERENCES `lembaga` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `evaluasi` (
  `id` char(36) NOT NULL,
  `id_lembaga` char(36) NOT NULL,
  `id_docs` char(36) NOT NULL,
  `temuan` varchar(255) NOT NULL,
  `rtk` varchar(255) NOT NULL,
  `tautan_rtk` varchar(255) NOT NULL,
  `tautan_temuan` varchar(255) NOT NULL,
  `score` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_pengisian` varchar(255) DEFAULT NULL,
  `status_docs` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `tgl_pengumpulan` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tautan_rtk` (`tautan_rtk`),
  UNIQUE KEY `tautan_temuan` (`tautan_temuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `jobs` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `queue` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `laporan_audit` (
  `id` char(36) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tautan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `lembaga` (
  `id` char(36) NOT NULL,
  `nama_lembaga` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` char(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `tokenable_type` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `RTM` (
  `id` char(36) NOT NULL,
  `id_lembaga` char(36) NOT NULL,
  `tgl_rapat` varchar(255) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_lembaga` (`id_lembaga`),
  CONSTRAINT `rtm_ibfk_1` FOREIGN KEY (`id_lembaga`) REFERENCES `lembaga` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `superadmin` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `id_lembaga` char(36) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `id_lembaga` (`id_lembaga`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_lembaga`) REFERENCES `lembaga` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `admin` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('aa1646cd-b94f-423d-b97f-eb55c6614285', 'Yogi Hadi Afrizal, S.E., M.Ak', 'yogihadyafrizal@kallabbbs.sc.id', NULL, '$2y$10$asWBhba7qNuZkMgh525YEOidX4j4IPdU/tFwuVfVmkWfuMYZ/3ubW', NULL, '2024-08-08 23:02:25', '2024-08-08 23:02:25');

INSERT INTO `auditor` (`id`, `nama`, `foto`, `created_at`, `updated_at`) VALUES
('59ae5c42-9978-4457-92ab-aaa1fc09a43b', 'Syarief Dienan Yahya, S.E., M.E', '1723157600.png', '2024-08-08 22:53:20', '2024-08-08 22:53:20'),
('804b46ab-323e-46a1-9def-6abbf402a701', 'Furqan Zakiyabarsi, S.T., M.T', '1723157478.png', '2024-08-08 22:51:18', '2024-08-08 22:51:18'),
('9d195341-61ac-4f86-bb65-e92feea3d377', 'Yogi Hady Afrizal, S.Ak., M.Sc.', '1723157518.png', '2024-08-08 22:51:58', '2024-08-08 22:51:58');

INSERT INTO `dokumen` (`id`, `judul`, `tautan`, `status_pengisian`, `deadline`, `id_lembaga`, `status_docs`, `created_at`, `updated_at`, `score`, `tgl_pengumpulan`) VALUES
('2ff2e506-617e-4cdf-bb3c-3c7bfa7bd4a7', 'INSTRUMEN AUDIT MUTU INTERNAL “CHECK LIST DESK EVALUATION“ BAAK', 'https://docs.google.com/document/d/1m1j9vlrcxYU_hU5LFmi_OJsUSGY6i_ml/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', '2', '2024-08-12', '66485a52-4945-47f0-83c9-b9b764baa1e5', '0', '2024-08-09 03:48:55', '2024-08-09 03:49:26', 97, '2024-08-09'),
('70087c63-8f0d-48c4-8459-edc39c95ea8b', 'INSTRUMEN AUDIT MUTU INTERNAL “CHECK LIST DESK EVALUATION“ ICT', 'https://docs.google.com/document/d/1gHrLjY0ThAy-n_qiorr0G8SbhhX7dbPJ/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', '2', '2024-08-16', '02d61a35-93ac-405b-a5d6-5df59ec4b068', '0', '2024-08-09 02:27:36', '2024-08-09 02:32:13', 185, '2024-08-09'),
('a72bbb00-ad2f-4292-9fbb-7eb1b3ba295f', 'INSTRUMEN AUDIT MUTU INTERNAL “CHECK LIST DESK EVALUATION“ SI', 'https://docs.google.com/document/d/19rPKc7eBVcJt1_lXIErJ-SnJHruUrZg7/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', '2', '2024-08-17', '105be123-6c2d-4ca4-95fb-56d7374bfc22', '0', '2024-08-09 02:29:10', '2024-08-09 03:33:26', 179, '2024-08-09'),
('c5faca4d-2a1b-432a-bfa0-305d09cdde7f', 'INSTRUMEN AUDIT MUTU INTERNAL “CHECK LIST DESK EVALUATION“', 'https://docs.google.com/document/d/1mcs8Oc6INukyy13-DFZfgoVxwB4Fqf9e/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', '2', '2024-08-24', 'dec72fb0-e43b-4332-90b0-524dadd37389', '0', '2024-08-09 05:39:51', '2024-08-09 05:42:12', 110, '2024-08-09'),
('e9244ff8-3fbe-4642-bb49-d505e55ff1b7', 'INSTRUMEN AUDIT MUTU INTERNAL “CHECK LIST DESK EVALUATION“ LPPM', 'https://docs.google.com/document/d/1uSiK_SwRPk99ZR58gCsBpimCmNbkT5Tn/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', '2', '2024-08-16', '41c05ba1-1745-424d-a2c2-b1048c6f381a', '0', '2024-08-09 02:29:38', '2024-08-09 03:25:58', 125, '2024-08-09');

INSERT INTO `evaluasi` (`id`, `id_lembaga`, `id_docs`, `temuan`, `rtk`, `tautan_rtk`, `tautan_temuan`, `score`, `created_at`, `updated_at`, `status_pengisian`, `status_docs`, `deadline`, `tgl_pengumpulan`) VALUES
('2392e56a-ad5c-4048-b402-fc015c9760f9', '41c05ba1-1745-424d-a2c2-b1048c6f381a', 'e9244ff8-3fbe-4642-bb49-d505e55ff1b7', 'Laporan Evaluasi Diri LPPM', 'PTK LPPM', 'https://docs.google.com/document/d/13vmiWLfC87FAkW0W9OFf10it8T60znaw/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', 'https://docs.google.com/document/d/1gHrLjY0ThAy-n_qiorr0G8SbhhX7dbPJ/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', 87, '2024-08-09 03:29:57', '2024-08-09 03:32:47', '1', '1', '2024-08-08', '2024-08-09'),
('41bebd84-7322-49d4-b29c-8c92ac22163e', '105be123-6c2d-4ca4-95fb-56d7374bfc22', 'a72bbb00-ad2f-4292-9fbb-7eb1b3ba295f', 'Laporan Evaluasi Diri SI', 'PTK Sistem Informasi', 'https://docs.google.com/document/d/1b5HWgHNGoVLJOHUMtUc0VNyH6KpzG9RC/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', 'https://docs.google.com/document/d/1mcs8Oc6INukyy13-DFZfgoVxwB4Fqf9e/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', 273, '2024-08-09 03:35:45', '2024-08-09 03:38:22', '2', '4', '2024-08-10', '2024-08-09'),
('60ccb9ba-250f-481c-9ce1-d59eada42b67', '66485a52-4945-47f0-83c9-b9b764baa1e5', '2ff2e506-617e-4cdf-bb3c-3c7bfa7bd4a7', 'Laporan Evaluasi Diri BAAK', 'PTK BAAK', 'https://docs.google.com/document/d/18MG4BO0YSFohzSvtbySsLWfEEoCNc3kE/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', 'https://docs.google.com/presentation/d/1swjzZ5P5cyWq5V9Lnvbs1Q8bKfkzSg47/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', 110, '2024-08-09 03:50:32', '2024-08-09 05:23:27', '2', '2', '2024-08-11', '2024-08-09'),
('ce6d797b-d192-4eab-96d3-bd88f1e56ee4', 'dec72fb0-e43b-4332-90b0-524dadd37389', 'c5faca4d-2a1b-432a-bfa0-305d09cdde7f', 'Laporan Evaluasi Diri', 'PTK KPMA', 'https://docs.google.com/document/d/1b6wKIY15CK61To-FPRDQOAeWHI3JqYDp/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', 'https://drive.google.com/drive/folders/1UX6jmKodhGiLFF8KgDlKdHPRxqRk_syo', 185, '2024-08-09 05:43:54', '2024-08-09 06:02:29', '2', '3', '2024-08-30', '2024-08-09'),
('d3ea6d43-341f-4774-a19b-d6b285c217e5', '02d61a35-93ac-405b-a5d6-5df59ec4b068', '70087c63-8f0d-48c4-8459-edc39c95ea8b', 'Evaluasi Lapangan ICT', 'Laporan PTK ICT', 'https://docs.google.com/document/d/152N16MnICts0IIzlNTGJjamWqPhTUPNc/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', 'https://docs.google.com/spreadsheets/d/1wErWqxQ_IIvqpsTefGzCPYJK_7z3LRWe/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', 280, '2024-08-09 02:44:03', '2024-08-09 03:07:12', '2', '3', '2024-08-24', '2024-08-09');

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"79234996-6f23-45cf-9d04-98f3075828d7\",\"displayName\":\"App\\\\Jobs\\\\SendDokumenEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendDokumenEmail\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\SendDokumenEmail\\\":3:{s:8:\\\"\\u0000*\\u0000email\\\";s:27:\\\"furqanzakiyabarsi@gmail.com\\\";s:8:\\\"\\u0000*\\u0000judul\\\";s:66:\\\"INSTRUMEN AUDIT MUTU INTERNAL “CHECK LIST DESK EVALUATION“ ICT\\\";s:11:\\\"\\u0000*\\u0000deadline\\\";s:10:\\\"2024-08-16\\\";}\"}}', 0, NULL, 1723170456, 1723170456),
(2, 'default', '{\"uuid\":\"90c674a4-0422-44bb-a046-91d9018e10b7\",\"displayName\":\"App\\\\Jobs\\\\SendDokumenEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendDokumenEmail\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\SendDokumenEmail\\\":3:{s:8:\\\"\\u0000*\\u0000email\\\";s:35:\\\"andijamiatiparamita@kallabbbs.ac.id\\\";s:8:\\\"\\u0000*\\u0000judul\\\";s:65:\\\"INSTRUMEN AUDIT MUTU INTERNAL “CHECK LIST DESK EVALUATION“ SI\\\";s:11:\\\"\\u0000*\\u0000deadline\\\";s:10:\\\"2024-08-17\\\";}\"}}', 0, NULL, 1723170550, 1723170550),
(3, 'default', '{\"uuid\":\"8c0d2167-5bb8-43c9-b18e-fea67d9028a9\",\"displayName\":\"App\\\\Jobs\\\\SendDokumenEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendDokumenEmail\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\SendDokumenEmail\\\":3:{s:8:\\\"\\u0000*\\u0000email\\\";s:28:\\\"anditenripada@kallabbs.ac.id\\\";s:8:\\\"\\u0000*\\u0000judul\\\";s:67:\\\"INSTRUMEN AUDIT MUTU INTERNAL “CHECK LIST DESK EVALUATION“ LPPM\\\";s:11:\\\"\\u0000*\\u0000deadline\\\";s:10:\\\"2024-08-16\\\";}\"}}', 0, NULL, 1723170578, 1723170578),
(4, 'default', '{\"uuid\":\"20d12824-d93a-479a-afc7-bcc8634c7eab\",\"displayName\":\"App\\\\Jobs\\\\SendTemuanEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendTemuanEmail\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\SendTemuanEmail\\\":4:{s:8:\\\"\\u0000*\\u0000email\\\";s:27:\\\"furqanzakiyabarsi@gmail.com\\\";s:9:\\\"\\u0000*\\u0000temuan\\\";s:21:\\\"Evaluasi Lapangan ICT\\\";s:6:\\\"\\u0000*\\u0000rtk\\\";s:15:\\\"Laporan PTK ICT\\\";s:11:\\\"\\u0000*\\u0000deadline\\\";s:10:\\\"2024-08-24\\\";}\"}}', 0, NULL, 1723171443, 1723171443),
(5, 'default', '{\"uuid\":\"ba781046-e691-4c3c-bd6a-9a45ae716b26\",\"displayName\":\"App\\\\Jobs\\\\SendTemuanEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendTemuanEmail\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\SendTemuanEmail\\\":4:{s:8:\\\"\\u0000*\\u0000email\\\";s:28:\\\"anditenripada@kallabbs.ac.id\\\";s:9:\\\"\\u0000*\\u0000temuan\\\";s:26:\\\"Laporan Evaluasi Diri LPPM\\\";s:6:\\\"\\u0000*\\u0000rtk\\\";s:8:\\\"PTK LPPM\\\";s:11:\\\"\\u0000*\\u0000deadline\\\";s:10:\\\"2024-08-08\\\";}\"}}', 0, NULL, 1723174197, 1723174197),
(6, 'default', '{\"uuid\":\"46f82233-e447-412f-8206-a076ac9b3fca\",\"displayName\":\"App\\\\Jobs\\\\SendTemuanEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendTemuanEmail\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\SendTemuanEmail\\\":4:{s:8:\\\"\\u0000*\\u0000email\\\";s:35:\\\"andijamiatiparamita@kallabbbs.ac.id\\\";s:9:\\\"\\u0000*\\u0000temuan\\\";s:24:\\\"Laporan Evaluasi Diri SI\\\";s:6:\\\"\\u0000*\\u0000rtk\\\";s:20:\\\"PTK Sistem Informasi\\\";s:11:\\\"\\u0000*\\u0000deadline\\\";s:10:\\\"2024-08-10\\\";}\"}}', 0, NULL, 1723174545, 1723174545),
(7, 'default', '{\"uuid\":\"d60e556f-3ead-42f5-a948-ca31c8802516\",\"displayName\":\"App\\\\Jobs\\\\SendDokumenEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendDokumenEmail\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\SendDokumenEmail\\\":3:{s:8:\\\"\\u0000*\\u0000email\\\";s:27:\\\"amrizainuddin@kallabs.ac.id\\\";s:8:\\\"\\u0000*\\u0000judul\\\";s:67:\\\"INSTRUMEN AUDIT MUTU INTERNAL “CHECK LIST DESK EVALUATION“ BAAK\\\";s:11:\\\"\\u0000*\\u0000deadline\\\";s:10:\\\"2024-08-12\\\";}\"}}', 0, NULL, 1723175335, 1723175335),
(8, 'default', '{\"uuid\":\"ef45698d-1214-4e66-b3ae-4d0577959f03\",\"displayName\":\"App\\\\Jobs\\\\SendTemuanEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendTemuanEmail\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\SendTemuanEmail\\\":4:{s:8:\\\"\\u0000*\\u0000email\\\";s:27:\\\"amrizainuddin@kallabs.ac.id\\\";s:9:\\\"\\u0000*\\u0000temuan\\\";s:26:\\\"Laporan Evaluasi Diri BAAK\\\";s:6:\\\"\\u0000*\\u0000rtk\\\";s:8:\\\"PTK BAAK\\\";s:11:\\\"\\u0000*\\u0000deadline\\\";s:10:\\\"2024-08-11\\\";}\"}}', 0, NULL, 1723175432, 1723175432),
(9, 'default', '{\"uuid\":\"a3b77e52-26ae-4218-a1ce-fa668cfd7506\",\"displayName\":\"App\\\\Jobs\\\\SendDokumenEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendDokumenEmail\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\SendDokumenEmail\\\":3:{s:8:\\\"\\u0000*\\u0000email\\\";s:20:\\\"abdulhakim@gamil.com\\\";s:8:\\\"\\u0000*\\u0000judul\\\";s:62:\\\"INSTRUMEN AUDIT MUTU INTERNAL “CHECK LIST DESK EVALUATION“\\\";s:11:\\\"\\u0000*\\u0000deadline\\\";s:10:\\\"2024-08-24\\\";}\"}}', 0, NULL, 1723181991, 1723181991),
(10, 'default', '{\"uuid\":\"a8086b0f-66d4-4d21-af64-da4a798b5e51\",\"displayName\":\"App\\\\Jobs\\\\SendTemuanEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendTemuanEmail\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\SendTemuanEmail\\\":4:{s:8:\\\"\\u0000*\\u0000email\\\";s:20:\\\"abdulhakim@gamil.com\\\";s:9:\\\"\\u0000*\\u0000temuan\\\";s:21:\\\"Laporan Evaluasi Diri\\\";s:6:\\\"\\u0000*\\u0000rtk\\\";s:8:\\\"PTK KPMA\\\";s:11:\\\"\\u0000*\\u0000deadline\\\";s:10:\\\"2024-08-30\\\";}\"}}', 0, NULL, 1723182234, 1723182234);

INSERT INTO `laporan_audit` (`id`, `judul`, `tautan`, `created_at`, `updated_at`) VALUES
('0a7c1697-6483-4177-949f-ce716936ff5c', 'Laporan Audit Mutu Internal Tahun Ajaran 2020/2021', 'https://drive.google.com/drive/folders/1BfATTG4wptjM-25wNnn-hV7DO56unUiz', '2024-08-09 05:24:34', '2024-08-09 05:24:34'),
('21591898-171b-49ff-a1b7-e12e270e4e03', 'Laporan Audit Mutu Internal Tahun Ajaran 2023/2024', 'https://docs.google.com/document/d/1b5HWgHNGoVLJOHUMtUc0VNyH6KpzG9RC/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', '2024-08-09 05:25:41', '2024-08-09 05:25:41'),
('7a475754-c6fd-435a-b0f6-1cee3baa1561', 'Laporan Audit Mutu Internal Tahun Ajaran 2022/2023', 'https://docs.google.com/spreadsheets/d/1wErWqxQ_IIvqpsTefGzCPYJK_7z3LRWe/edit?usp=drive_link&ouid=101451580554409963963&rtpof=true&sd=true', '2024-08-09 05:25:06', '2024-08-09 05:25:06');

INSERT INTO `lembaga` (`id`, `nama_lembaga`, `created_at`, `updated_at`) VALUES
('02d61a35-93ac-405b-a5d6-5df59ec4b068', 'Information Comunication and Technology (ICT)', '2024-08-08 22:33:05', '2024-08-08 22:33:05'),
('105be123-6c2d-4ca4-95fb-56d7374bfc22', 'Prodi Sistem Informasi', '2024-08-08 22:26:49', '2024-08-08 22:26:49'),
('2769516b-94d1-4d0e-a586-928ff92d8b80', 'Prodi Manajemen Retail', '2024-08-08 22:27:21', '2024-08-08 22:27:21'),
('3a881e59-6871-48b6-8bac-54b346fc871b', 'Biro Administrasi Umum dan Keuangan', '2024-08-08 22:36:30', '2024-08-08 22:36:30'),
('41c05ba1-1745-424d-a2c2-b1048c6f381a', 'Lembaga Penelitian dan Pengabdian kepada Masyarakat', '2024-08-08 22:33:43', '2024-08-08 22:33:43'),
('66485a52-4945-47f0-83c9-b9b764baa1e5', 'Biro Administrasi Akademik dan Kemahasiswaan', '2024-08-08 22:36:09', '2024-08-08 22:36:09'),
('6959a959-68e9-4213-9547-5361922ad435', 'Marketing Communication', '2024-08-08 22:34:00', '2024-08-08 22:34:00'),
('6bb41488-4ba9-4233-97b2-22bb2389aba2', 'Perpustakaan', '2024-08-08 22:36:57', '2024-08-08 22:36:57'),
('7b1c33d3-12db-420d-b1a3-6e5518c317ef', 'Prodi Kewirausahaan', '2024-08-08 22:27:37', '2024-08-08 22:27:37'),
('8d4c184d-f4f9-48dd-90c6-c8ed7eb8b22d', 'Prodi Bisnis Digital', '2024-08-08 22:27:03', '2024-08-08 22:27:03'),
('dec72fb0-e43b-4332-90b0-524dadd37389', 'Biro Kerja Sama, Pengembangan Mahasiswa dan Alumni', '2024-08-08 22:37:41', '2024-08-08 22:37:41');

INSERT INTO `superadmin` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin ICT', 'ict@gmail.com', NULL, '$2y$10$RdznKhn0wsT9YChMW0dHcO8tImcobUqDcyYD1mNd6Oku9WzzVboUe', NULL, NULL, NULL);

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `id_lembaga`, `remember_token`, `created_at`, `updated_at`) VALUES
('34eb0d59-f349-4834-8253-aeba39a49a03', 'Furqan Zakiyabarsi, S.T., M.T', 'furqanzakiyabarsi@gmail.com', NULL, '$2y$10$G63F0IHywTumMB2QLDP6jOMCCnCAYCRf7OfgC/C/Ug3d/JnillNh2', '02d61a35-93ac-405b-a5d6-5df59ec4b068', NULL, '2024-08-08 22:38:19', '2024-08-08 22:38:19'),
('578edde6-fdd6-4c9d-94ae-5949391efd9e', 'Amri Zainuddin, S.E., M.Ak.', 'amrizainuddin@kallabs.ac.id', NULL, '$2y$10$IxwvtmRO03bK7mJzAykVGevojI7RW3I9PAMZWMliQ632kjGtNWpQu', '66485a52-4945-47f0-83c9-b9b764baa1e5', NULL, '2024-08-08 22:39:42', '2024-08-08 22:39:42'),
('5f33fc37-70d8-41fc-9d6a-292b7ede0a3a', 'Abdul Hakim, S.Pd., M.A.', 'abdulhakim@gamil.com', NULL, '$2y$10$EEsqxvxxQN/sahVR9QZkb.KLt7PSVYkwkO1ULQ3fmWqvl2z/nRdRi', 'dec72fb0-e43b-4332-90b0-524dadd37389', NULL, '2024-08-09 05:38:16', '2024-08-09 05:38:16'),
('d826d3d6-45ac-4145-bce2-8efbb4e54251', 'Andi Jamiati Paramita, S.T., M.T', 'andijamiatiparamita@kallabbbs.ac.id', NULL, '$2y$10$kvOxSNNU0yPqKzN6oAXtC.c7Viu.ekWvx.Y6vAu2KTImjHl9LA1zu', '105be123-6c2d-4ca4-95fb-56d7374bfc22', NULL, '2024-08-08 22:38:43', '2024-08-08 22:38:43'),
('eff38f9f-8aac-49c2-b532-cde3e5dca400', 'Andi Tenri Pada, S.E., M.Sc.', 'anditenripada@kallabbs.ac.id', NULL, '$2y$10$jIDa6hSYw.vYkQUG3SqCKuxqWV1SE2M/evGLDOoMoGY.rJ9J0m3Xm', '41c05ba1-1745-424d-a2c2-b1048c6f381a', NULL, '2024-08-08 22:39:10', '2024-08-08 22:39:10');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;