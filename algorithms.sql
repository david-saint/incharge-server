-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2021 at 07:50 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `incharge`
--

-- --------------------------------------------------------

--
-- Table structure for table `algorithms`
--

CREATE TABLE `algorithms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionType` enum('bool','input','date') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `positive` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `negative` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `onPositive` int(10) UNSIGNED DEFAULT NULL,
  `onNegative` int(10) UNSIGNED DEFAULT NULL,
  `nextMove` int(10) UNSIGNED DEFAULT NULL,
  `tempPlan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conditionalFactor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conditionalOperator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conditionalValue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delay` int(11) NOT NULL,
  `series` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `stateValue` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `progestogenPossible` enum('true','false') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `progestogenPossibleDir` enum('positive','negative') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempPlanDirN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempPlanDirP` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('true','false') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `algorithms`
--

INSERT INTO `algorithms` (`id`, `text`, `actionType`, `positive`, `negative`, `onPositive`, `onNegative`, `nextMove`, `tempPlan`, `conditionalFactor`, `conditionalOperator`, `conditionalValue`, `delay`, `series`, `created_at`, `updated_at`, `deleted_at`, `stateValue`, `label`, `progestogenPossible`, `progestogenPossibleDir`, `tempPlanDirN`, `tempPlanDirP`, `active`) VALUES
(1, 'Empty', NULL, NULL, NULL, 3, 2, NULL, NULL, 'religion_sect', '=', 'CATHOLIC', 0, NULL, '2021-03-21 12:38:55', '2021-04-05 14:39:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(2, 'Would you like to consider other family planning methods apart from the Natural types?\',', 'bool', 'Yes', 'No', 8, 4, NULL, NULL, NULL, NULL, NULL, 500, NULL, '2021-03-21 15:07:00', '2021-03-22 19:33:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(3, 'We noticed you\\\'re Catholic, Would you like to consider other family planning methods apart from the Natural types?', 'bool', 'Yes', 'No', 8, 4, NULL, NULL, NULL, NULL, NULL, 500, NULL, '2021-03-21 15:09:39', '2021-03-22 19:33:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(4, 'Empty', NULL, NULL, NULL, 5, 6, NULL, NULL, 'gender', '=', 'MALE', 0, NULL, '2021-03-21 15:22:21', '2021-03-22 19:33:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(5, 'The Natural Family Planning Methods include: Withdrawal method, and Fertile Period Monitor. As a man the withdrawal method is the best contraceptive plan for you. You should withdraw your penis from your partner\'s vagina and ejaculate outside the vagina.', NULL, NULL, NULL, NULL, NULL, 7, 'WITHDRAWAL_METHOD', '', NULL, NULL, 1000, NULL, '2021-03-21 15:30:15', '2021-03-22 19:33:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(6, 'The Natural Family Planning Methods include: Withdrawal method, and Fertile Period Monitor. As a woman the Fertile Period Monitor is perfect for you.\\n We will proceed to setting up your calendar.', NULL, NULL, NULL, NULL, NULL, 7, 'FERTILE_PERIOD_MONITOR', '', NULL, NULL, 1000, NULL, '2021-03-21 15:31:06', '2021-03-22 19:33:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(7, 'Empty', NULL, NULL, NULL, 9, 10, NULL, NULL, 'gender', '=', 'MALE', 0, NULL, '2021-03-21 15:39:25', '2021-03-22 19:33:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(8, 'Great, Let\\\'s find out what contraceptive plan is right for you.', NULL, NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, 1000, NULL, '2021-03-21 15:40:47', '2021-03-22 19:33:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(9, 'All Set! The Best Contraceptive Plan for you is set. Hold on while we set up your space.', NULL, NULL, NULL, NULL, NULL, 15, NULL, NULL, NULL, NULL, 1000, NULL, '2021-03-21 18:04:24', '2021-03-22 19:33:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(10, 'What\\\'s the average number of days that make up your menstrual cycle?', 'input', NULL, NULL, NULL, NULL, 21, NULL, NULL, NULL, NULL, 500, NULL, '2021-03-21 19:16:09', '2021-03-22 19:33:20', NULL, 'cycleLength', 'Cycle Length', NULL, NULL, NULL, NULL, 'true'),
(11, 'Empty', NULL, NULL, NULL, 12, 13, NULL, NULL, 'gender', '=', 'MALE', 0, NULL, '2021-03-22 05:08:57', '2021-03-22 19:33:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(12, 'Are you looking for a temporary solution or a permanent one?', 'bool', 'Temporary', 'Permanent', 16, 17, NULL, NULL, NULL, NULL, NULL, 500, NULL, '2021-03-22 05:13:10', '2021-03-22 19:33:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(13, 'Do you have any history of yellowness of the eyes or Liver/gall bladder problems?', 'bool', 'Yes', 'No', 19, 18, NULL, NULL, NULL, NULL, NULL, 250, NULL, '2021-03-22 05:15:00', '2021-03-22 19:33:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(15, 'End', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-03-22 05:20:05', '2021-03-22 19:33:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(16, 'The temporary contraceptive method for men is condoms. The pregnancy rate of condoms is 2% per year. The best contraceptive plan for you is the use of condoms.', NULL, NULL, NULL, NULL, NULL, 9, 'MALE_BARRIER', NULL, NULL, NULL, 1000, NULL, '2021-03-22 05:24:09', '2021-03-22 19:33:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(17, 'The permanent contraceptive method for men is a Vasectomy. Vasectomy is a surgical procedure for male sterilization or permanent birth control. The best contraceptive plan for you is to get a Vasectomy. This is a surgical procedure, therefore adequate counselling from a healthcare professional is required', NULL, NULL, NULL, NULL, NULL, 9, 'MALE_VASECTOMY', NULL, NULL, NULL, 1500, NULL, '2021-03-22 05:28:33', '2021-03-22 19:33:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(18, 'Are you currently taking any medications for seizures?', 'bool', 'Yes', 'No', 19, 20, NULL, NULL, NULL, NULL, NULL, 250, NULL, '2021-03-22 05:35:26', '2021-03-22 19:33:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(19, 'The combined oral contraceptive pill, often referred to as the birth control pill or \"the pill\", is a type of birth control that is designed to be taken orally by women. This is the best contraceptive plan for you.', NULL, NULL, NULL, NULL, NULL, 10, 'COMBINED_ORAL', NULL, NULL, NULL, 500, NULL, '2021-03-22 05:38:09', '2021-03-22 19:33:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(20, 'Is there any history of breast cancer with you or in your family?', 'bool', 'Yes', 'No', 19, 23, NULL, NULL, NULL, NULL, NULL, 250, NULL, '2021-03-22 05:41:17', '2021-03-22 19:33:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(21, 'How many days does each Menstrual Period last?', 'input', NULL, NULL, NULL, NULL, 22, NULL, NULL, NULL, NULL, 500, NULL, '2021-03-22 06:10:20', '2021-03-22 19:33:31', NULL, 'periodLength', 'Average Period Days', NULL, NULL, NULL, NULL, 'true'),
(22, 'When did your last Menstrual Period begin?', 'date', NULL, NULL, NULL, NULL, 9, NULL, NULL, NULL, NULL, 500, NULL, '2021-03-22 06:22:50', '2021-03-22 19:33:32', NULL, 'lastPeriodAt', NULL, NULL, NULL, NULL, NULL, 'true'),
(23, 'Empty', NULL, NULL, NULL, 24, 25, NULL, NULL, 'pregnancy_status', '=', '1', 0, NULL, '2021-03-22 06:51:09', '2021-03-22 19:33:32', NULL, NULL, NULL, 'true', 'negative', NULL, NULL, 'true'),
(24, 'Is your baby less than 6 weeks old?', 'bool', 'Yes', 'No', 19, 25, NULL, NULL, NULL, NULL, NULL, 250, NULL, '2021-03-22 06:52:05', '2021-03-22 19:33:34', NULL, NULL, NULL, 'true', 'negative', NULL, NULL, 'true'),
(25, 'Combined Oral Contraceptive Pills stop eggs being made, so no egg is released from the ovary. It is normally 92% effective, and side effects include: irregular menstruation and acne. Progestogen-only pills work mainly by thickening the mucus in the cervix so sperm can’t travel through it. It is typically 92% effective, and the side effect is irregular menstruation.', NULL, NULL, NULL, NULL, NULL, 26, NULL, NULL, NULL, NULL, 2500, NULL, '2021-03-22 07:40:09', '2021-03-22 19:33:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(26, 'What type of contraception would you prefer', 'bool', 'Combined Oral', 'Progestogen-Only', 27, 10, NULL, '', NULL, NULL, NULL, 350, NULL, '2021-03-22 14:48:19', '2021-03-22 19:33:37', NULL, NULL, NULL, NULL, NULL, 'PROGESTOGEN_ONLY', NULL, 'true'),
(27, 'Are you hypertensive or diabetic?', 'bool', 'Yes', 'No', 19, 28, NULL, NULL, NULL, NULL, NULL, 250, NULL, '2021-03-22 15:34:29', '2021-03-22 19:33:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(28, 'Do you have migraines often?', 'bool', 'Yes', 'No', 19, 29, NULL, NULL, NULL, NULL, NULL, 250, NULL, '2021-03-22 15:35:53', '2021-03-22 19:33:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(29, 'Have you ever had a stroke or heart disease?', 'bool', 'Yes', 'No', 19, 30, NULL, NULL, NULL, NULL, NULL, 250, NULL, '2021-03-22 15:37:04', '2021-03-22 19:33:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(30, 'Are you taking rifampicin/rifabutin for tuberculosis?', 'bool', 'Yes', 'No', 19, 31, NULL, NULL, NULL, NULL, NULL, 250, NULL, '2021-03-22 15:37:55', '2021-03-22 19:33:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'true'),
(31, 'The best contraceptive plans for you are the Combined Hormonal Contraceptives. Would you prefer to take the pills or wear patches/vaginal-rings. The Patches/Vaginal-Rings are not readily available in Nigeria', 'bool', 'Pills', 'Patches/Vaginal-Rings', 10, 10, NULL, NULL, NULL, NULL, NULL, 350, NULL, '2021-03-22 15:41:04', '2021-03-22 19:33:39', NULL, NULL, NULL, NULL, NULL, 'COMBINED_PATCHES', 'COMBINED_ORAL', 'true');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `algorithms`
--
ALTER TABLE `algorithms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `algorithms`
--
ALTER TABLE `algorithms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
