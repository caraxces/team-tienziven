-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th3 19, 2025 lúc 03:53 PM
-- Phiên bản máy phục vụ: 10.6.21-MariaDB-cll-lve-log
-- Phiên bản PHP: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `maoknyyx_perfex`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblactivity_log`
--

CREATE TABLE `tblactivity_log` (
  `id` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `date` datetime NOT NULL,
  `staffid` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblactivity_log`
--

INSERT INTO `tblactivity_log` (`id`, `description`, `date`, `staffid`) VALUES
(1, 'User Successfully Logged In [User Id: 1, Is Staff Member: Yes, IP: 27.64.54.154]', '2024-12-22 17:03:54', 'TRẦN MINH TIẾN'),
(2, 'User Successfully Logged In [User Id: 1, Is Staff Member: Yes, IP: 27.64.54.154]', '2024-12-22 17:09:05', 'TRẦN MINH TIẾN'),
(3, 'New Staff Member Added [ID: 2, Quý Trần]', '2024-12-22 17:11:46', 'TRẦN MINH TIẾN'),
(4, 'Non Existing User Tried to Login [Email: tranminhtien0408@gmail.com, Is Staff Member: No, IP: 27.64.54.154]', '2024-12-22 17:35:56', 'TRẦN MINH TIẾN'),
(5, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 27.64.59.238]', '2025-01-12 21:29:55', NULL),
(6, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 27.64.59.238]', '2025-01-12 21:30:03', NULL),
(7, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 27.64.59.238]', '2025-01-12 21:30:35', NULL),
(8, 'Failed Login Attempt [Email: phuquytranhuynh@gmail.com, Is Staff Member: Yes, IP: 27.64.59.238]', '2025-01-12 21:30:58', NULL),
(9, 'User Successfully Logged In [User Id: 1, Is Staff Member: Yes, IP: 27.64.59.238]', '2025-01-12 21:31:26', 'TRẦN MINH TIẾN'),
(10, 'User Successfully Logged In [User Id: 2, Is Staff Member: Yes, IP: 27.64.59.238]', '2025-01-12 21:31:44', 'Quý Trần'),
(11, 'User Successfully Logged In [User Id: 2, Is Staff Member: Yes, IP: 27.64.59.238]', '2025-01-12 21:41:59', 'Quý Trần'),
(12, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 27.64.59.238]', '2025-01-12 21:42:06', 'Quý Trần'),
(13, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 27.64.59.238]', '2025-01-12 21:42:29', 'Quý Trần'),
(14, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 27.64.59.238]', '2025-01-12 21:42:37', 'Quý Trần'),
(15, 'Failed Login Attempt [Email: phuquytranhuynh@gmail.com, Is Staff Member: Yes, IP: 27.64.59.238]', '2025-01-12 21:43:09', NULL),
(16, 'User Successfully Logged In [User Id: 2, Is Staff Member: Yes, IP: 27.64.59.238]', '2025-01-12 21:43:13', 'Quý Trần'),
(17, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 27.64.59.238]', '2025-01-12 21:43:17', 'Quý Trần'),
(18, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 27.64.59.238]', '2025-01-12 21:43:23', 'Quý Trần'),
(19, 'User Successfully Logged In [User Id: 2, Is Staff Member: Yes, IP: 27.64.59.238]', '2025-01-12 21:43:52', 'Quý Trần'),
(20, 'Staff Password Changed [2]', '2025-01-12 21:45:40', 'Quý Trần'),
(21, 'New Client Created [ID: 1, From Staff: 2]', '2025-01-12 21:47:24', 'Quý Trần'),
(22, 'New Project Created [ID: 1]', '2025-01-12 21:48:16', 'Quý Trần'),
(23, 'New Task Added [ID:1, Name: Nghiên cứu từ khóa]', '2025-01-12 21:49:13', 'Quý Trần'),
(24, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 27.64.59.238]', '2025-01-21 16:15:00', NULL),
(25, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 27.64.59.238]', '2025-01-21 16:15:20', NULL),
(26, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 115.74.142.124]', '2025-02-13 14:02:09', NULL),
(27, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 115.74.142.124]', '2025-02-13 14:02:18', NULL),
(28, 'Non Existing User Tried to Login [Email: quytran@tienziven.com, Is Staff Member: No, IP: 115.74.142.124]', '2025-02-13 14:02:21', NULL),
(29, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 115.74.142.124]', '2025-02-13 14:11:09', NULL),
(30, 'User Successfully Logged In [User Id: 2, Is Staff Member: Yes, IP: 115.74.142.124]', '2025-02-13 14:11:26', 'Quý Trần'),
(31, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 115.74.142.124]', '2025-02-13 14:59:09', 'Quý Trần'),
(32, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 115.74.142.124]', '2025-02-13 16:16:15', NULL),
(33, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 115.74.142.124]', '2025-02-13 16:16:39', NULL),
(34, 'Non Existing User Tried to Login [Email: tranminhtien0408@gmail.com, Is Staff Member: No, IP: 115.74.142.124]', '2025-02-13 16:17:26', NULL),
(35, 'Non Existing User Tried to Login [Email: tranminhtien0408@gmail.com, Is Staff Member: No, IP: 115.74.142.124]', '2025-02-13 16:17:45', NULL),
(36, 'User Successfully Logged In [User Id: 1, Is Staff Member: Yes, IP: 115.74.142.124]', '2025-02-13 16:20:36', 'TRẦN MINH TIẾN'),
(37, 'Failed Login Attempt [Email: phuquytranhuynh@gmail.com, Is Staff Member: Yes, IP: 115.74.142.124]', '2025-02-13 16:20:54', NULL),
(38, 'User Successfully Logged In [User Id: 1, Is Staff Member: Yes, IP: 115.74.142.124]', '2025-02-13 16:20:55', 'TRẦN MINH TIẾN'),
(39, 'Failed Login Attempt [Email: phuquytranhuynh@gmail.com, Is Staff Member: Yes, IP: 115.74.142.124]', '2025-02-13 16:21:06', NULL),
(40, 'Failed Login Attempt [Email: phuquytranhuynh@gmail.com, Is Staff Member: Yes, IP: 115.74.142.124]', '2025-02-13 16:21:10', NULL),
(41, 'User Successfully Logged In [User Id: 1, Is Staff Member: Yes, IP: 115.74.142.124]', '2025-02-13 16:21:12', 'TRẦN MINH TIẾN'),
(42, 'Staff Member Updated [ID: 2, Quý Trần]', '2025-02-13 16:21:39', 'TRẦN MINH TIẾN'),
(43, 'User Successfully Logged In [User Id: 2, Is Staff Member: Yes, IP: 115.74.142.124]', '2025-02-13 16:21:54', 'Quý Trần'),
(44, 'User Successfully Logged In [User Id: 1, Is Staff Member: Yes, IP: 115.74.142.124]', '2025-02-13 16:22:10', 'TRẦN MINH TIẾN'),
(45, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 115.74.142.124]', '2025-02-13 16:23:10', 'Quý Trần'),
(46, 'User Successfully Logged In [User Id: 1, Is Staff Member: Yes, IP: 115.74.142.124]', '2025-02-13 16:24:04', 'TRẦN MINH TIẾN'),
(47, 'User Successfully Logged In [User Id: 1, Is Staff Member: Yes, IP: 115.74.142.124]', '2025-02-13 16:24:27', 'TRẦN MINH TIẾN'),
(48, 'User Successfully Logged In [User Id: 1, Is Staff Member: Yes, IP: 115.74.142.124]', '2025-02-13 16:24:59', 'TRẦN MINH TIẾN'),
(49, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 115.74.142.124]', '2025-03-07 11:19:36', NULL),
(50, 'Failed Login Attempt [Email: phuquytranhuynh@gmail.com, Is Staff Member: Yes, IP: 115.74.142.124]', '2025-03-07 11:19:48', NULL),
(51, 'User Successfully Logged In [User Id: 2, Is Staff Member: Yes, IP: 115.74.142.124]', '2025-03-07 11:20:52', 'Quý Trần'),
(52, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 115.79.41.216]', '2025-03-07 11:23:14', NULL),
(53, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 115.79.41.216]', '2025-03-07 11:23:47', NULL),
(54, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 115.79.41.216]', '2025-03-07 11:24:04', NULL),
(55, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 115.79.41.216]', '2025-03-07 11:24:38', NULL),
(56, 'User Successfully Logged In [User Id: 2, Is Staff Member: Yes, IP: 115.79.41.216]', '2025-03-07 11:26:36', 'Quý Trần'),
(57, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 116.109.14.237]', '2025-03-07 11:30:12', 'Quý Trần'),
(58, 'Non Existing User Tried to Login [Email: tranminhtien0408@gmail.com, Is Staff Member: No, IP: 115.73.24.98]', '2025-03-19 15:48:54', NULL),
(59, 'Non Existing User Tried to Login [Email: tranminhtien0408@gmail.com, Is Staff Member: No, IP: 115.73.24.98]', '2025-03-19 15:48:56', NULL),
(60, 'Non Existing User Tried to Login [Email: tranminhtien0408@gmail.com, Is Staff Member: No, IP: 115.73.24.98]', '2025-03-19 15:48:57', NULL),
(61, 'Non Existing User Tried to Login [Email: tranminhtien0408@gmail.com, Is Staff Member: No, IP: 115.73.24.98]', '2025-03-19 15:49:10', NULL),
(62, 'Non Existing User Tried to Login [Email: tranminhtien0408@gmail.com, Is Staff Member: No, IP: 115.73.24.98]', '2025-03-19 15:49:29', NULL),
(63, 'Non Existing User Tried to Login [Email: phuquytranhuynh@gmail.com, Is Staff Member: No, IP: 115.73.24.98]', '2025-03-19 15:50:17', NULL),
(64, 'Non Existing User Tried to Login [Email: tranminhtien0408@gmail.com, Is Staff Member: No, IP: 115.73.24.98]', '2025-03-19 15:52:29', NULL),
(65, 'User Successfully Logged In [User Id: 1, Is Staff Member: Yes, IP: 115.73.24.98]', '2025-03-19 15:52:55', 'TRẦN MINH TIẾN');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblannouncements`
--

CREATE TABLE `tblannouncements` (
  `announcementid` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `message` mediumtext DEFAULT NULL,
  `showtousers` int(11) NOT NULL,
  `showtostaff` int(11) NOT NULL,
  `showname` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `userid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblclients`
--

CREATE TABLE `tblclients` (
  `userid` int(11) NOT NULL,
  `company` varchar(191) DEFAULT NULL,
  `vat` varchar(50) DEFAULT NULL,
  `phonenumber` varchar(30) DEFAULT NULL,
  `country` int(11) NOT NULL DEFAULT 0,
  `city` varchar(100) DEFAULT NULL,
  `zip` varchar(15) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `leadid` int(11) DEFAULT NULL,
  `billing_street` varchar(200) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(100) DEFAULT NULL,
  `billing_country` int(11) DEFAULT 0,
  `shipping_street` varchar(200) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_zip` varchar(100) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT 0,
  `longitude` varchar(191) DEFAULT NULL,
  `latitude` varchar(191) DEFAULT NULL,
  `default_language` varchar(40) DEFAULT NULL,
  `default_currency` int(11) NOT NULL DEFAULT 0,
  `show_primary_contact` int(11) NOT NULL DEFAULT 0,
  `stripe_id` varchar(40) DEFAULT NULL,
  `registration_confirmed` int(11) NOT NULL DEFAULT 1,
  `addedfrom` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblclients`
--

INSERT INTO `tblclients` (`userid`, `company`, `vat`, `phonenumber`, `country`, `city`, `zip`, `state`, `address`, `website`, `datecreated`, `active`, `leadid`, `billing_street`, `billing_city`, `billing_state`, `billing_zip`, `billing_country`, `shipping_street`, `shipping_city`, `shipping_state`, `shipping_zip`, `shipping_country`, `longitude`, `latitude`, `default_language`, `default_currency`, `show_primary_contact`, `stripe_id`, `registration_confirmed`, `addedfrom`) VALUES
(1, 'TIEN ZIVEN', '', '', 0, '', '', '', '', '', '2025-01-12 21:47:24', 1, NULL, '', '', '', '', 0, '', '', '', '', 0, NULL, NULL, '', 0, 0, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblconsents`
--

CREATE TABLE `tblconsents` (
  `id` int(11) NOT NULL,
  `action` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(40) NOT NULL,
  `contact_id` int(11) NOT NULL DEFAULT 0,
  `lead_id` int(11) NOT NULL DEFAULT 0,
  `description` mediumtext DEFAULT NULL,
  `opt_in_purpose_description` mediumtext DEFAULT NULL,
  `purpose_id` int(11) NOT NULL,
  `staff_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblconsent_purposes`
--

CREATE TABLE `tblconsent_purposes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `last_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcontacts`
--

CREATE TABLE `tblcontacts` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `is_primary` int(11) NOT NULL DEFAULT 1,
  `firstname` varchar(191) NOT NULL,
  `lastname` varchar(191) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `new_pass_key` varchar(32) DEFAULT NULL,
  `new_pass_key_requested` datetime DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `email_verification_key` varchar(32) DEFAULT NULL,
  `email_verification_sent_at` datetime DEFAULT NULL,
  `last_ip` varchar(40) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_password_change` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `profile_image` varchar(191) DEFAULT NULL,
  `direction` varchar(3) DEFAULT NULL,
  `invoice_emails` tinyint(1) NOT NULL DEFAULT 1,
  `estimate_emails` tinyint(1) NOT NULL DEFAULT 1,
  `credit_note_emails` tinyint(1) NOT NULL DEFAULT 1,
  `contract_emails` tinyint(1) NOT NULL DEFAULT 1,
  `task_emails` tinyint(1) NOT NULL DEFAULT 1,
  `project_emails` tinyint(1) NOT NULL DEFAULT 1,
  `ticket_emails` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcontact_permissions`
--

CREATE TABLE `tblcontact_permissions` (
  `id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcontracts`
--

CREATE TABLE `tblcontracts` (
  `id` int(11) NOT NULL,
  `content` longtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `client` int(11) NOT NULL,
  `datestart` date DEFAULT NULL,
  `dateend` date DEFAULT NULL,
  `contract_type` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `isexpirynotified` int(11) NOT NULL DEFAULT 0,
  `contract_value` decimal(15,2) DEFAULT NULL,
  `trash` tinyint(1) DEFAULT 0,
  `not_visible_to_client` tinyint(1) NOT NULL DEFAULT 0,
  `hash` varchar(32) DEFAULT NULL,
  `signed` tinyint(1) NOT NULL DEFAULT 0,
  `signature` varchar(40) DEFAULT NULL,
  `marked_as_signed` tinyint(1) NOT NULL DEFAULT 0,
  `acceptance_firstname` varchar(50) DEFAULT NULL,
  `acceptance_lastname` varchar(50) DEFAULT NULL,
  `acceptance_email` varchar(100) DEFAULT NULL,
  `acceptance_date` datetime DEFAULT NULL,
  `acceptance_ip` varchar(40) DEFAULT NULL,
  `short_link` varchar(100) DEFAULT NULL,
  `last_sent_at` datetime DEFAULT NULL,
  `contacts_sent_to` mediumtext DEFAULT NULL,
  `last_sign_reminder_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcontracts_types`
--

CREATE TABLE `tblcontracts_types` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcontract_comments`
--

CREATE TABLE `tblcontract_comments` (
  `id` int(11) NOT NULL,
  `content` longtext DEFAULT NULL,
  `contract_id` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `dateadded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcontract_renewals`
--

CREATE TABLE `tblcontract_renewals` (
  `id` int(11) NOT NULL,
  `contractid` int(11) NOT NULL,
  `old_start_date` date NOT NULL,
  `new_start_date` date NOT NULL,
  `old_end_date` date DEFAULT NULL,
  `new_end_date` date DEFAULT NULL,
  `old_value` decimal(15,2) DEFAULT NULL,
  `new_value` decimal(15,2) DEFAULT NULL,
  `date_renewed` datetime NOT NULL,
  `renewed_by` varchar(100) NOT NULL,
  `renewed_by_staff_id` int(11) NOT NULL DEFAULT 0,
  `is_on_old_expiry_notified` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcountries`
--

CREATE TABLE `tblcountries` (
  `country_id` int(11) NOT NULL,
  `iso2` char(2) DEFAULT NULL,
  `short_name` varchar(80) NOT NULL DEFAULT '',
  `long_name` varchar(80) NOT NULL DEFAULT '',
  `iso3` char(3) DEFAULT NULL,
  `numcode` varchar(6) DEFAULT NULL,
  `un_member` varchar(12) DEFAULT NULL,
  `calling_code` varchar(8) DEFAULT NULL,
  `cctld` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblcountries`
--

INSERT INTO `tblcountries` (`country_id`, `iso2`, `short_name`, `long_name`, `iso3`, `numcode`, `un_member`, `calling_code`, `cctld`) VALUES
(1, 'AF', 'Afghanistan', 'Islamic Republic of Afghanistan', 'AFG', '004', 'yes', '93', '.af'),
(2, 'AX', 'Aland Islands', '&Aring;land Islands', 'ALA', '248', 'no', '358', '.ax'),
(3, 'AL', 'Albania', 'Republic of Albania', 'ALB', '008', 'yes', '355', '.al'),
(4, 'DZ', 'Algeria', 'People\'s Democratic Republic of Algeria', 'DZA', '012', 'yes', '213', '.dz'),
(5, 'AS', 'American Samoa', 'American Samoa', 'ASM', '016', 'no', '1+684', '.as'),
(6, 'AD', 'Andorra', 'Principality of Andorra', 'AND', '020', 'yes', '376', '.ad'),
(7, 'AO', 'Angola', 'Republic of Angola', 'AGO', '024', 'yes', '244', '.ao'),
(8, 'AI', 'Anguilla', 'Anguilla', 'AIA', '660', 'no', '1+264', '.ai'),
(9, 'AQ', 'Antarctica', 'Antarctica', 'ATA', '010', 'no', '672', '.aq'),
(10, 'AG', 'Antigua and Barbuda', 'Antigua and Barbuda', 'ATG', '028', 'yes', '1+268', '.ag'),
(11, 'AR', 'Argentina', 'Argentine Republic', 'ARG', '032', 'yes', '54', '.ar'),
(12, 'AM', 'Armenia', 'Republic of Armenia', 'ARM', '051', 'yes', '374', '.am'),
(13, 'AW', 'Aruba', 'Aruba', 'ABW', '533', 'no', '297', '.aw'),
(14, 'AU', 'Australia', 'Commonwealth of Australia', 'AUS', '036', 'yes', '61', '.au'),
(15, 'AT', 'Austria', 'Republic of Austria', 'AUT', '040', 'yes', '43', '.at'),
(16, 'AZ', 'Azerbaijan', 'Republic of Azerbaijan', 'AZE', '031', 'yes', '994', '.az'),
(17, 'BS', 'Bahamas', 'Commonwealth of The Bahamas', 'BHS', '044', 'yes', '1+242', '.bs'),
(18, 'BH', 'Bahrain', 'Kingdom of Bahrain', 'BHR', '048', 'yes', '973', '.bh'),
(19, 'BD', 'Bangladesh', 'People\'s Republic of Bangladesh', 'BGD', '050', 'yes', '880', '.bd'),
(20, 'BB', 'Barbados', 'Barbados', 'BRB', '052', 'yes', '1+246', '.bb'),
(21, 'BY', 'Belarus', 'Republic of Belarus', 'BLR', '112', 'yes', '375', '.by'),
(22, 'BE', 'Belgium', 'Kingdom of Belgium', 'BEL', '056', 'yes', '32', '.be'),
(23, 'BZ', 'Belize', 'Belize', 'BLZ', '084', 'yes', '501', '.bz'),
(24, 'BJ', 'Benin', 'Republic of Benin', 'BEN', '204', 'yes', '229', '.bj'),
(25, 'BM', 'Bermuda', 'Bermuda Islands', 'BMU', '060', 'no', '1+441', '.bm'),
(26, 'BT', 'Bhutan', 'Kingdom of Bhutan', 'BTN', '064', 'yes', '975', '.bt'),
(27, 'BO', 'Bolivia', 'Plurinational State of Bolivia', 'BOL', '068', 'yes', '591', '.bo'),
(28, 'BQ', 'Bonaire, Sint Eustatius and Saba', 'Bonaire, Sint Eustatius and Saba', 'BES', '535', 'no', '599', '.bq'),
(29, 'BA', 'Bosnia and Herzegovina', 'Bosnia and Herzegovina', 'BIH', '070', 'yes', '387', '.ba'),
(30, 'BW', 'Botswana', 'Republic of Botswana', 'BWA', '072', 'yes', '267', '.bw'),
(31, 'BV', 'Bouvet Island', 'Bouvet Island', 'BVT', '074', 'no', 'NONE', '.bv'),
(32, 'BR', 'Brazil', 'Federative Republic of Brazil', 'BRA', '076', 'yes', '55', '.br'),
(33, 'IO', 'British Indian Ocean Territory', 'British Indian Ocean Territory', 'IOT', '086', 'no', '246', '.io'),
(34, 'BN', 'Brunei', 'Brunei Darussalam', 'BRN', '096', 'yes', '673', '.bn'),
(35, 'BG', 'Bulgaria', 'Republic of Bulgaria', 'BGR', '100', 'yes', '359', '.bg'),
(36, 'BF', 'Burkina Faso', 'Burkina Faso', 'BFA', '854', 'yes', '226', '.bf'),
(37, 'BI', 'Burundi', 'Republic of Burundi', 'BDI', '108', 'yes', '257', '.bi'),
(38, 'KH', 'Cambodia', 'Kingdom of Cambodia', 'KHM', '116', 'yes', '855', '.kh'),
(39, 'CM', 'Cameroon', 'Republic of Cameroon', 'CMR', '120', 'yes', '237', '.cm'),
(40, 'CA', 'Canada', 'Canada', 'CAN', '124', 'yes', '1', '.ca'),
(41, 'CV', 'Cape Verde', 'Republic of Cape Verde', 'CPV', '132', 'yes', '238', '.cv'),
(42, 'KY', 'Cayman Islands', 'The Cayman Islands', 'CYM', '136', 'no', '1+345', '.ky'),
(43, 'CF', 'Central African Republic', 'Central African Republic', 'CAF', '140', 'yes', '236', '.cf'),
(44, 'TD', 'Chad', 'Republic of Chad', 'TCD', '148', 'yes', '235', '.td'),
(45, 'CL', 'Chile', 'Republic of Chile', 'CHL', '152', 'yes', '56', '.cl'),
(46, 'CN', 'China', 'People\'s Republic of China', 'CHN', '156', 'yes', '86', '.cn'),
(47, 'CX', 'Christmas Island', 'Christmas Island', 'CXR', '162', 'no', '61', '.cx'),
(48, 'CC', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', 'CCK', '166', 'no', '61', '.cc'),
(49, 'CO', 'Colombia', 'Republic of Colombia', 'COL', '170', 'yes', '57', '.co'),
(50, 'KM', 'Comoros', 'Union of the Comoros', 'COM', '174', 'yes', '269', '.km'),
(51, 'CG', 'Congo', 'Republic of the Congo', 'COG', '178', 'yes', '242', '.cg'),
(52, 'CK', 'Cook Islands', 'Cook Islands', 'COK', '184', 'some', '682', '.ck'),
(53, 'CR', 'Costa Rica', 'Republic of Costa Rica', 'CRI', '188', 'yes', '506', '.cr'),
(54, 'CI', 'Cote d\'ivoire (Ivory Coast)', 'Republic of C&ocirc;te D\'Ivoire (Ivory Coast)', 'CIV', '384', 'yes', '225', '.ci'),
(55, 'HR', 'Croatia', 'Republic of Croatia', 'HRV', '191', 'yes', '385', '.hr'),
(56, 'CU', 'Cuba', 'Republic of Cuba', 'CUB', '192', 'yes', '53', '.cu'),
(57, 'CW', 'Curacao', 'Cura&ccedil;ao', 'CUW', '531', 'no', '599', '.cw'),
(58, 'CY', 'Cyprus', 'Republic of Cyprus', 'CYP', '196', 'yes', '357', '.cy'),
(59, 'CZ', 'Czech Republic', 'Czech Republic', 'CZE', '203', 'yes', '420', '.cz'),
(60, 'CD', 'Democratic Republic of the Congo', 'Democratic Republic of the Congo', 'COD', '180', 'yes', '243', '.cd'),
(61, 'DK', 'Denmark', 'Kingdom of Denmark', 'DNK', '208', 'yes', '45', '.dk'),
(62, 'DJ', 'Djibouti', 'Republic of Djibouti', 'DJI', '262', 'yes', '253', '.dj'),
(63, 'DM', 'Dominica', 'Commonwealth of Dominica', 'DMA', '212', 'yes', '1+767', '.dm'),
(64, 'DO', 'Dominican Republic', 'Dominican Republic', 'DOM', '214', 'yes', '1+809, 8', '.do'),
(65, 'EC', 'Ecuador', 'Republic of Ecuador', 'ECU', '218', 'yes', '593', '.ec'),
(66, 'EG', 'Egypt', 'Arab Republic of Egypt', 'EGY', '818', 'yes', '20', '.eg'),
(67, 'SV', 'El Salvador', 'Republic of El Salvador', 'SLV', '222', 'yes', '503', '.sv'),
(68, 'GQ', 'Equatorial Guinea', 'Republic of Equatorial Guinea', 'GNQ', '226', 'yes', '240', '.gq'),
(69, 'ER', 'Eritrea', 'State of Eritrea', 'ERI', '232', 'yes', '291', '.er'),
(70, 'EE', 'Estonia', 'Republic of Estonia', 'EST', '233', 'yes', '372', '.ee'),
(71, 'ET', 'Ethiopia', 'Federal Democratic Republic of Ethiopia', 'ETH', '231', 'yes', '251', '.et'),
(72, 'FK', 'Falkland Islands (Malvinas)', 'The Falkland Islands (Malvinas)', 'FLK', '238', 'no', '500', '.fk'),
(73, 'FO', 'Faroe Islands', 'The Faroe Islands', 'FRO', '234', 'no', '298', '.fo'),
(74, 'FJ', 'Fiji', 'Republic of Fiji', 'FJI', '242', 'yes', '679', '.fj'),
(75, 'FI', 'Finland', 'Republic of Finland', 'FIN', '246', 'yes', '358', '.fi'),
(76, 'FR', 'France', 'French Republic', 'FRA', '250', 'yes', '33', '.fr'),
(77, 'GF', 'French Guiana', 'French Guiana', 'GUF', '254', 'no', '594', '.gf'),
(78, 'PF', 'French Polynesia', 'French Polynesia', 'PYF', '258', 'no', '689', '.pf'),
(79, 'TF', 'French Southern Territories', 'French Southern Territories', 'ATF', '260', 'no', NULL, '.tf'),
(80, 'GA', 'Gabon', 'Gabonese Republic', 'GAB', '266', 'yes', '241', '.ga'),
(81, 'GM', 'Gambia', 'Republic of The Gambia', 'GMB', '270', 'yes', '220', '.gm'),
(82, 'GE', 'Georgia', 'Georgia', 'GEO', '268', 'yes', '995', '.ge'),
(83, 'DE', 'Germany', 'Federal Republic of Germany', 'DEU', '276', 'yes', '49', '.de'),
(84, 'GH', 'Ghana', 'Republic of Ghana', 'GHA', '288', 'yes', '233', '.gh'),
(85, 'GI', 'Gibraltar', 'Gibraltar', 'GIB', '292', 'no', '350', '.gi'),
(86, 'GR', 'Greece', 'Hellenic Republic', 'GRC', '300', 'yes', '30', '.gr'),
(87, 'GL', 'Greenland', 'Greenland', 'GRL', '304', 'no', '299', '.gl'),
(88, 'GD', 'Grenada', 'Grenada', 'GRD', '308', 'yes', '1+473', '.gd'),
(89, 'GP', 'Guadaloupe', 'Guadeloupe', 'GLP', '312', 'no', '590', '.gp'),
(90, 'GU', 'Guam', 'Guam', 'GUM', '316', 'no', '1+671', '.gu'),
(91, 'GT', 'Guatemala', 'Republic of Guatemala', 'GTM', '320', 'yes', '502', '.gt'),
(92, 'GG', 'Guernsey', 'Guernsey', 'GGY', '831', 'no', '44', '.gg'),
(93, 'GN', 'Guinea', 'Republic of Guinea', 'GIN', '324', 'yes', '224', '.gn'),
(94, 'GW', 'Guinea-Bissau', 'Republic of Guinea-Bissau', 'GNB', '624', 'yes', '245', '.gw'),
(95, 'GY', 'Guyana', 'Co-operative Republic of Guyana', 'GUY', '328', 'yes', '592', '.gy'),
(96, 'HT', 'Haiti', 'Republic of Haiti', 'HTI', '332', 'yes', '509', '.ht'),
(97, 'HM', 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands', 'HMD', '334', 'no', 'NONE', '.hm'),
(98, 'HN', 'Honduras', 'Republic of Honduras', 'HND', '340', 'yes', '504', '.hn'),
(99, 'HK', 'Hong Kong', 'Hong Kong', 'HKG', '344', 'no', '852', '.hk'),
(100, 'HU', 'Hungary', 'Hungary', 'HUN', '348', 'yes', '36', '.hu'),
(101, 'IS', 'Iceland', 'Republic of Iceland', 'ISL', '352', 'yes', '354', '.is'),
(102, 'IN', 'India', 'Republic of India', 'IND', '356', 'yes', '91', '.in'),
(103, 'ID', 'Indonesia', 'Republic of Indonesia', 'IDN', '360', 'yes', '62', '.id'),
(104, 'IR', 'Iran', 'Islamic Republic of Iran', 'IRN', '364', 'yes', '98', '.ir'),
(105, 'IQ', 'Iraq', 'Republic of Iraq', 'IRQ', '368', 'yes', '964', '.iq'),
(106, 'IE', 'Ireland', 'Ireland', 'IRL', '372', 'yes', '353', '.ie'),
(107, 'IM', 'Isle of Man', 'Isle of Man', 'IMN', '833', 'no', '44', '.im'),
(108, 'IL', 'Israel', 'State of Israel', 'ISR', '376', 'yes', '972', '.il'),
(109, 'IT', 'Italy', 'Italian Republic', 'ITA', '380', 'yes', '39', '.jm'),
(110, 'JM', 'Jamaica', 'Jamaica', 'JAM', '388', 'yes', '1+876', '.jm'),
(111, 'JP', 'Japan', 'Japan', 'JPN', '392', 'yes', '81', '.jp'),
(112, 'JE', 'Jersey', 'The Bailiwick of Jersey', 'JEY', '832', 'no', '44', '.je'),
(113, 'JO', 'Jordan', 'Hashemite Kingdom of Jordan', 'JOR', '400', 'yes', '962', '.jo'),
(114, 'KZ', 'Kazakhstan', 'Republic of Kazakhstan', 'KAZ', '398', 'yes', '7', '.kz'),
(115, 'KE', 'Kenya', 'Republic of Kenya', 'KEN', '404', 'yes', '254', '.ke'),
(116, 'KI', 'Kiribati', 'Republic of Kiribati', 'KIR', '296', 'yes', '686', '.ki'),
(117, 'XK', 'Kosovo', 'Republic of Kosovo', '---', '---', 'some', '381', ''),
(118, 'KW', 'Kuwait', 'State of Kuwait', 'KWT', '414', 'yes', '965', '.kw'),
(119, 'KG', 'Kyrgyzstan', 'Kyrgyz Republic', 'KGZ', '417', 'yes', '996', '.kg'),
(120, 'LA', 'Laos', 'Lao People\'s Democratic Republic', 'LAO', '418', 'yes', '856', '.la'),
(121, 'LV', 'Latvia', 'Republic of Latvia', 'LVA', '428', 'yes', '371', '.lv'),
(122, 'LB', 'Lebanon', 'Republic of Lebanon', 'LBN', '422', 'yes', '961', '.lb'),
(123, 'LS', 'Lesotho', 'Kingdom of Lesotho', 'LSO', '426', 'yes', '266', '.ls'),
(124, 'LR', 'Liberia', 'Republic of Liberia', 'LBR', '430', 'yes', '231', '.lr'),
(125, 'LY', 'Libya', 'Libya', 'LBY', '434', 'yes', '218', '.ly'),
(126, 'LI', 'Liechtenstein', 'Principality of Liechtenstein', 'LIE', '438', 'yes', '423', '.li'),
(127, 'LT', 'Lithuania', 'Republic of Lithuania', 'LTU', '440', 'yes', '370', '.lt'),
(128, 'LU', 'Luxembourg', 'Grand Duchy of Luxembourg', 'LUX', '442', 'yes', '352', '.lu'),
(129, 'MO', 'Macao', 'The Macao Special Administrative Region', 'MAC', '446', 'no', '853', '.mo'),
(130, 'MK', 'North Macedonia', 'Republic of North Macedonia', 'MKD', '807', 'yes', '389', '.mk'),
(131, 'MG', 'Madagascar', 'Republic of Madagascar', 'MDG', '450', 'yes', '261', '.mg'),
(132, 'MW', 'Malawi', 'Republic of Malawi', 'MWI', '454', 'yes', '265', '.mw'),
(133, 'MY', 'Malaysia', 'Malaysia', 'MYS', '458', 'yes', '60', '.my'),
(134, 'MV', 'Maldives', 'Republic of Maldives', 'MDV', '462', 'yes', '960', '.mv'),
(135, 'ML', 'Mali', 'Republic of Mali', 'MLI', '466', 'yes', '223', '.ml'),
(136, 'MT', 'Malta', 'Republic of Malta', 'MLT', '470', 'yes', '356', '.mt'),
(137, 'MH', 'Marshall Islands', 'Republic of the Marshall Islands', 'MHL', '584', 'yes', '692', '.mh'),
(138, 'MQ', 'Martinique', 'Martinique', 'MTQ', '474', 'no', '596', '.mq'),
(139, 'MR', 'Mauritania', 'Islamic Republic of Mauritania', 'MRT', '478', 'yes', '222', '.mr'),
(140, 'MU', 'Mauritius', 'Republic of Mauritius', 'MUS', '480', 'yes', '230', '.mu'),
(141, 'YT', 'Mayotte', 'Mayotte', 'MYT', '175', 'no', '262', '.yt'),
(142, 'MX', 'Mexico', 'United Mexican States', 'MEX', '484', 'yes', '52', '.mx'),
(143, 'FM', 'Micronesia', 'Federated States of Micronesia', 'FSM', '583', 'yes', '691', '.fm'),
(144, 'MD', 'Moldava', 'Republic of Moldova', 'MDA', '498', 'yes', '373', '.md'),
(145, 'MC', 'Monaco', 'Principality of Monaco', 'MCO', '492', 'yes', '377', '.mc'),
(146, 'MN', 'Mongolia', 'Mongolia', 'MNG', '496', 'yes', '976', '.mn'),
(147, 'ME', 'Montenegro', 'Montenegro', 'MNE', '499', 'yes', '382', '.me'),
(148, 'MS', 'Montserrat', 'Montserrat', 'MSR', '500', 'no', '1+664', '.ms'),
(149, 'MA', 'Morocco', 'Kingdom of Morocco', 'MAR', '504', 'yes', '212', '.ma'),
(150, 'MZ', 'Mozambique', 'Republic of Mozambique', 'MOZ', '508', 'yes', '258', '.mz'),
(151, 'MM', 'Myanmar (Burma)', 'Republic of the Union of Myanmar', 'MMR', '104', 'yes', '95', '.mm'),
(152, 'NA', 'Namibia', 'Republic of Namibia', 'NAM', '516', 'yes', '264', '.na'),
(153, 'NR', 'Nauru', 'Republic of Nauru', 'NRU', '520', 'yes', '674', '.nr'),
(154, 'NP', 'Nepal', 'Federal Democratic Republic of Nepal', 'NPL', '524', 'yes', '977', '.np'),
(155, 'NL', 'Netherlands', 'Kingdom of the Netherlands', 'NLD', '528', 'yes', '31', '.nl'),
(156, 'NC', 'New Caledonia', 'New Caledonia', 'NCL', '540', 'no', '687', '.nc'),
(157, 'NZ', 'New Zealand', 'New Zealand', 'NZL', '554', 'yes', '64', '.nz'),
(158, 'NI', 'Nicaragua', 'Republic of Nicaragua', 'NIC', '558', 'yes', '505', '.ni'),
(159, 'NE', 'Niger', 'Republic of Niger', 'NER', '562', 'yes', '227', '.ne'),
(160, 'NG', 'Nigeria', 'Federal Republic of Nigeria', 'NGA', '566', 'yes', '234', '.ng'),
(161, 'NU', 'Niue', 'Niue', 'NIU', '570', 'some', '683', '.nu'),
(162, 'NF', 'Norfolk Island', 'Norfolk Island', 'NFK', '574', 'no', '672', '.nf'),
(163, 'KP', 'North Korea', 'Democratic People\'s Republic of Korea', 'PRK', '408', 'yes', '850', '.kp'),
(164, 'MP', 'Northern Mariana Islands', 'Northern Mariana Islands', 'MNP', '580', 'no', '1+670', '.mp'),
(165, 'NO', 'Norway', 'Kingdom of Norway', 'NOR', '578', 'yes', '47', '.no'),
(166, 'OM', 'Oman', 'Sultanate of Oman', 'OMN', '512', 'yes', '968', '.om'),
(167, 'PK', 'Pakistan', 'Islamic Republic of Pakistan', 'PAK', '586', 'yes', '92', '.pk'),
(168, 'PW', 'Palau', 'Republic of Palau', 'PLW', '585', 'yes', '680', '.pw'),
(169, 'PS', 'Palestine', 'State of Palestine (or Occupied Palestinian Territory)', 'PSE', '275', 'some', '970', '.ps'),
(170, 'PA', 'Panama', 'Republic of Panama', 'PAN', '591', 'yes', '507', '.pa'),
(171, 'PG', 'Papua New Guinea', 'Independent State of Papua New Guinea', 'PNG', '598', 'yes', '675', '.pg'),
(172, 'PY', 'Paraguay', 'Republic of Paraguay', 'PRY', '600', 'yes', '595', '.py'),
(173, 'PE', 'Peru', 'Republic of Peru', 'PER', '604', 'yes', '51', '.pe'),
(174, 'PH', 'Philippines', 'Republic of the Philippines', 'PHL', '608', 'yes', '63', '.ph'),
(175, 'PN', 'Pitcairn', 'Pitcairn', 'PCN', '612', 'no', 'NONE', '.pn'),
(176, 'PL', 'Poland', 'Republic of Poland', 'POL', '616', 'yes', '48', '.pl'),
(177, 'PT', 'Portugal', 'Portuguese Republic', 'PRT', '620', 'yes', '351', '.pt'),
(178, 'PR', 'Puerto Rico', 'Commonwealth of Puerto Rico', 'PRI', '630', 'no', '1+939', '.pr'),
(179, 'QA', 'Qatar', 'State of Qatar', 'QAT', '634', 'yes', '974', '.qa'),
(180, 'RE', 'Reunion', 'R&eacute;union', 'REU', '638', 'no', '262', '.re'),
(181, 'RO', 'Romania', 'Romania', 'ROU', '642', 'yes', '40', '.ro'),
(182, 'RU', 'Russia', 'Russian Federation', 'RUS', '643', 'yes', '7', '.ru'),
(183, 'RW', 'Rwanda', 'Republic of Rwanda', 'RWA', '646', 'yes', '250', '.rw'),
(184, 'BL', 'Saint Barthelemy', 'Saint Barth&eacute;lemy', 'BLM', '652', 'no', '590', '.bl'),
(185, 'SH', 'Saint Helena', 'Saint Helena, Ascension and Tristan da Cunha', 'SHN', '654', 'no', '290', '.sh'),
(186, 'KN', 'Saint Kitts and Nevis', 'Federation of Saint Christopher and Nevis', 'KNA', '659', 'yes', '1+869', '.kn'),
(187, 'LC', 'Saint Lucia', 'Saint Lucia', 'LCA', '662', 'yes', '1+758', '.lc'),
(188, 'MF', 'Saint Martin', 'Saint Martin', 'MAF', '663', 'no', '590', '.mf'),
(189, 'PM', 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon', 'SPM', '666', 'no', '508', '.pm'),
(190, 'VC', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 'VCT', '670', 'yes', '1+784', '.vc'),
(191, 'WS', 'Samoa', 'Independent State of Samoa', 'WSM', '882', 'yes', '685', '.ws'),
(192, 'SM', 'San Marino', 'Republic of San Marino', 'SMR', '674', 'yes', '378', '.sm'),
(193, 'ST', 'Sao Tome and Principe', 'Democratic Republic of S&atilde;o Tom&eacute; and Pr&iacute;ncipe', 'STP', '678', 'yes', '239', '.st'),
(194, 'SA', 'Saudi Arabia', 'Kingdom of Saudi Arabia', 'SAU', '682', 'yes', '966', '.sa'),
(195, 'SN', 'Senegal', 'Republic of Senegal', 'SEN', '686', 'yes', '221', '.sn'),
(196, 'RS', 'Serbia', 'Republic of Serbia', 'SRB', '688', 'yes', '381', '.rs'),
(197, 'SC', 'Seychelles', 'Republic of Seychelles', 'SYC', '690', 'yes', '248', '.sc'),
(198, 'SL', 'Sierra Leone', 'Republic of Sierra Leone', 'SLE', '694', 'yes', '232', '.sl'),
(199, 'SG', 'Singapore', 'Republic of Singapore', 'SGP', '702', 'yes', '65', '.sg'),
(200, 'SX', 'Sint Maarten', 'Sint Maarten', 'SXM', '534', 'no', '1+721', '.sx'),
(201, 'SK', 'Slovakia', 'Slovak Republic', 'SVK', '703', 'yes', '421', '.sk'),
(202, 'SI', 'Slovenia', 'Republic of Slovenia', 'SVN', '705', 'yes', '386', '.si'),
(203, 'SB', 'Solomon Islands', 'Solomon Islands', 'SLB', '090', 'yes', '677', '.sb'),
(204, 'SO', 'Somalia', 'Somali Republic', 'SOM', '706', 'yes', '252', '.so'),
(205, 'ZA', 'South Africa', 'Republic of South Africa', 'ZAF', '710', 'yes', '27', '.za'),
(206, 'GS', 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', 'SGS', '239', 'no', '500', '.gs'),
(207, 'KR', 'South Korea', 'Republic of Korea', 'KOR', '410', 'yes', '82', '.kr'),
(208, 'SS', 'South Sudan', 'Republic of South Sudan', 'SSD', '728', 'yes', '211', '.ss'),
(209, 'ES', 'Spain', 'Kingdom of Spain', 'ESP', '724', 'yes', '34', '.es'),
(210, 'LK', 'Sri Lanka', 'Democratic Socialist Republic of Sri Lanka', 'LKA', '144', 'yes', '94', '.lk'),
(211, 'SD', 'Sudan', 'Republic of the Sudan', 'SDN', '729', 'yes', '249', '.sd'),
(212, 'SR', 'Suriname', 'Republic of Suriname', 'SUR', '740', 'yes', '597', '.sr'),
(213, 'SJ', 'Svalbard and Jan Mayen', 'Svalbard and Jan Mayen', 'SJM', '744', 'no', '47', '.sj'),
(214, 'SZ', 'Swaziland', 'Kingdom of Swaziland', 'SWZ', '748', 'yes', '268', '.sz'),
(215, 'SE', 'Sweden', 'Kingdom of Sweden', 'SWE', '752', 'yes', '46', '.se'),
(216, 'CH', 'Switzerland', 'Swiss Confederation', 'CHE', '756', 'yes', '41', '.ch'),
(217, 'SY', 'Syria', 'Syrian Arab Republic', 'SYR', '760', 'yes', '963', '.sy'),
(218, 'TW', 'Taiwan', 'Republic of China (Taiwan)', 'TWN', '158', 'former', '886', '.tw'),
(219, 'TJ', 'Tajikistan', 'Republic of Tajikistan', 'TJK', '762', 'yes', '992', '.tj'),
(220, 'TZ', 'Tanzania', 'United Republic of Tanzania', 'TZA', '834', 'yes', '255', '.tz'),
(221, 'TH', 'Thailand', 'Kingdom of Thailand', 'THA', '764', 'yes', '66', '.th'),
(222, 'TL', 'Timor-Leste (East Timor)', 'Democratic Republic of Timor-Leste', 'TLS', '626', 'yes', '670', '.tl'),
(223, 'TG', 'Togo', 'Togolese Republic', 'TGO', '768', 'yes', '228', '.tg'),
(224, 'TK', 'Tokelau', 'Tokelau', 'TKL', '772', 'no', '690', '.tk'),
(225, 'TO', 'Tonga', 'Kingdom of Tonga', 'TON', '776', 'yes', '676', '.to'),
(226, 'TT', 'Trinidad and Tobago', 'Republic of Trinidad and Tobago', 'TTO', '780', 'yes', '1+868', '.tt'),
(227, 'TN', 'Tunisia', 'Republic of Tunisia', 'TUN', '788', 'yes', '216', '.tn'),
(228, 'TR', 'Turkey', 'Republic of Turkey', 'TUR', '792', 'yes', '90', '.tr'),
(229, 'TM', 'Turkmenistan', 'Turkmenistan', 'TKM', '795', 'yes', '993', '.tm'),
(230, 'TC', 'Turks and Caicos Islands', 'Turks and Caicos Islands', 'TCA', '796', 'no', '1+649', '.tc'),
(231, 'TV', 'Tuvalu', 'Tuvalu', 'TUV', '798', 'yes', '688', '.tv'),
(232, 'UG', 'Uganda', 'Republic of Uganda', 'UGA', '800', 'yes', '256', '.ug'),
(233, 'UA', 'Ukraine', 'Ukraine', 'UKR', '804', 'yes', '380', '.ua'),
(234, 'AE', 'United Arab Emirates', 'United Arab Emirates', 'ARE', '784', 'yes', '971', '.ae'),
(235, 'GB', 'United Kingdom', 'United Kingdom of Great Britain and Nothern Ireland', 'GBR', '826', 'yes', '44', '.uk'),
(236, 'US', 'United States', 'United States of America', 'USA', '840', 'yes', '1', '.us'),
(237, 'UM', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'UMI', '581', 'no', 'NONE', 'NONE'),
(238, 'UY', 'Uruguay', 'Eastern Republic of Uruguay', 'URY', '858', 'yes', '598', '.uy'),
(239, 'UZ', 'Uzbekistan', 'Republic of Uzbekistan', 'UZB', '860', 'yes', '998', '.uz'),
(240, 'VU', 'Vanuatu', 'Republic of Vanuatu', 'VUT', '548', 'yes', '678', '.vu'),
(241, 'VA', 'Vatican City', 'State of the Vatican City', 'VAT', '336', 'no', '39', '.va'),
(242, 'VE', 'Venezuela', 'Bolivarian Republic of Venezuela', 'VEN', '862', 'yes', '58', '.ve'),
(243, 'VN', 'Vietnam', 'Socialist Republic of Vietnam', 'VNM', '704', 'yes', '84', '.vn'),
(244, 'VG', 'Virgin Islands, British', 'British Virgin Islands', 'VGB', '092', 'no', '1+284', '.vg'),
(245, 'VI', 'Virgin Islands, US', 'Virgin Islands of the United States', 'VIR', '850', 'no', '1+340', '.vi'),
(246, 'WF', 'Wallis and Futuna', 'Wallis and Futuna', 'WLF', '876', 'no', '681', '.wf'),
(247, 'EH', 'Western Sahara', 'Western Sahara', 'ESH', '732', 'no', '212', '.eh'),
(248, 'YE', 'Yemen', 'Republic of Yemen', 'YEM', '887', 'yes', '967', '.ye'),
(249, 'ZM', 'Zambia', 'Republic of Zambia', 'ZMB', '894', 'yes', '260', '.zm'),
(250, 'ZW', 'Zimbabwe', 'Republic of Zimbabwe', 'ZWE', '716', 'yes', '263', '.zw');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcreditnotes`
--

CREATE TABLE `tblcreditnotes` (
  `id` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `deleted_customer_name` varchar(100) DEFAULT NULL,
  `number` int(11) NOT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `number_format` int(11) NOT NULL DEFAULT 1,
  `formatted_number` varchar(100) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `date` date NOT NULL,
  `adminnote` mediumtext DEFAULT NULL,
  `terms` mediumtext DEFAULT NULL,
  `clientnote` mediumtext DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `total_tax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total` decimal(15,2) NOT NULL,
  `adjustment` decimal(15,2) DEFAULT NULL,
  `addedfrom` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `discount_percent` decimal(15,2) DEFAULT 0.00,
  `discount_total` decimal(15,2) DEFAULT 0.00,
  `discount_type` varchar(30) NOT NULL,
  `billing_street` varchar(200) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(100) DEFAULT NULL,
  `billing_country` int(11) DEFAULT NULL,
  `shipping_street` varchar(200) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_zip` varchar(100) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT NULL,
  `include_shipping` tinyint(1) NOT NULL,
  `show_shipping_on_credit_note` tinyint(1) NOT NULL DEFAULT 1,
  `show_quantity_as` int(11) NOT NULL DEFAULT 1,
  `reference_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcreditnote_refunds`
--

CREATE TABLE `tblcreditnote_refunds` (
  `id` int(11) NOT NULL,
  `credit_note_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `refunded_on` date NOT NULL,
  `payment_mode` varchar(40) NOT NULL,
  `note` mediumtext DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcredits`
--

CREATE TABLE `tblcredits` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `credit_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `date_applied` datetime NOT NULL,
  `amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcurrencies`
--

CREATE TABLE `tblcurrencies` (
  `id` int(11) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `decimal_separator` varchar(5) DEFAULT NULL,
  `thousand_separator` varchar(5) DEFAULT NULL,
  `placement` varchar(10) DEFAULT NULL,
  `isdefault` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblcurrencies`
--

INSERT INTO `tblcurrencies` (`id`, `symbol`, `name`, `decimal_separator`, `thousand_separator`, `placement`, `isdefault`) VALUES
(1, '$', 'USD', '.', ',', 'before', 1),
(2, '€', 'EUR', ',', '.', 'before', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcustomers_groups`
--

CREATE TABLE `tblcustomers_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcustomer_admins`
--

CREATE TABLE `tblcustomer_admins` (
  `staff_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_assigned` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcustomer_groups`
--

CREATE TABLE `tblcustomer_groups` (
  `id` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcustomfields`
--

CREATE TABLE `tblcustomfields` (
  `id` int(11) NOT NULL,
  `fieldto` varchar(30) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `type` varchar(20) NOT NULL,
  `options` longtext DEFAULT NULL,
  `display_inline` tinyint(1) NOT NULL DEFAULT 0,
  `field_order` int(11) DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1,
  `show_on_pdf` int(11) NOT NULL DEFAULT 0,
  `show_on_ticket_form` tinyint(1) NOT NULL DEFAULT 0,
  `only_admin` tinyint(1) NOT NULL DEFAULT 0,
  `show_on_table` tinyint(1) NOT NULL DEFAULT 0,
  `show_on_client_portal` int(11) NOT NULL DEFAULT 0,
  `disalow_client_to_edit` int(11) NOT NULL DEFAULT 0,
  `bs_column` int(11) NOT NULL DEFAULT 12,
  `default_value` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcustomfieldsvalues`
--

CREATE TABLE `tblcustomfieldsvalues` (
  `id` int(11) NOT NULL,
  `relid` int(11) NOT NULL,
  `fieldid` int(11) NOT NULL,
  `fieldto` varchar(15) NOT NULL,
  `value` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbldepartments`
--

CREATE TABLE `tbldepartments` (
  `departmentid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `imap_username` varchar(191) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `email_from_header` tinyint(1) NOT NULL DEFAULT 0,
  `host` varchar(150) DEFAULT NULL,
  `password` longtext DEFAULT NULL,
  `encryption` varchar(3) DEFAULT NULL,
  `folder` varchar(191) NOT NULL DEFAULT 'INBOX',
  `delete_after_import` int(11) NOT NULL DEFAULT 0,
  `calendar_id` longtext DEFAULT NULL,
  `hidefromclient` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbldismissed_announcements`
--

CREATE TABLE `tbldismissed_announcements` (
  `dismissedannouncementid` int(11) NOT NULL,
  `announcementid` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblemailtemplates`
--

CREATE TABLE `tblemailtemplates` (
  `emailtemplateid` int(11) NOT NULL,
  `type` longtext NOT NULL,
  `slug` varchar(100) NOT NULL,
  `language` varchar(40) DEFAULT NULL,
  `name` longtext NOT NULL,
  `subject` longtext NOT NULL,
  `message` longtext NOT NULL,
  `fromname` longtext NOT NULL,
  `fromemail` varchar(100) DEFAULT NULL,
  `plaintext` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblemailtemplates`
--

INSERT INTO `tblemailtemplates` (`emailtemplateid`, `type`, `slug`, `language`, `name`, `subject`, `message`, `fromname`, `fromemail`, `plaintext`, `active`, `order`) VALUES
(1, 'client', 'new-client-created', 'english', 'New Contact Added/Registered (Welcome Email)', 'Welcome aboard', 'Dear {contact_firstname} {contact_lastname}<br /><br />Thank you for registering on the <strong>{companyname}</strong> CRM System.<br /><br />We just wanted to say welcome.<br /><br />Please contact us if you need any help.<br /><br />Click here to view your profile: <a href=\"{crm_url}\">{crm_url}</a><br /><br />Kind Regards, <br />{email_signature}<br /><br />(This is an automated email, so please don\'t reply to this email address)', '{companyname} | CRM', '', 0, 1, 0),
(2, 'invoice', 'invoice-send-to-client', 'english', 'Send Invoice to Customer', 'Invoice with number {invoice_number} created', '<span style=\"font-size: 12pt;\">Dear {contact_firstname} {contact_lastname}</span><br /><br /><span style=\"font-size: 12pt;\">We have prepared the following invoice for you: <strong># {invoice_number}</strong></span><br /><br /><span style=\"font-size: 12pt;\"><strong>Invoice status</strong>: {invoice_status}</span><br /><br /><span style=\"font-size: 12pt;\">You can view the invoice on the following link: <a href=\"{invoice_link}\">{invoice_number}</a></span><br /><br /><span style=\"font-size: 12pt;\">Please contact us for more information.</span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(3, 'ticket', 'new-ticket-opened-admin', 'english', 'New Ticket Opened (Opened by Staff, Sent to Customer)', 'New Support Ticket Opened', '<p><span style=\"font-size: 12pt;\">Hi {contact_firstname} {contact_lastname}</span><br><br><span style=\"font-size: 12pt;\">New support ticket has been opened.</span><br><br><span style=\"font-size: 12pt;\"><strong>Subject:</strong> {ticket_subject}</span><br><span style=\"font-size: 12pt;\"><strong>Department:</strong> {ticket_department}</span><br><span style=\"font-size: 12pt;\"><strong>Priority:</strong> {ticket_priority}<br></span><br><span style=\"font-size: 12pt;\"><strong>Ticket message:</strong></span><br><span style=\"font-size: 12pt;\">{ticket_message}</span><br><br><span style=\"font-size: 12pt;\">You can view the ticket on the following link: <a href=\"{ticket_public_url}\">#{ticket_id}</a><br><br>Kind Regards,</span><br><span style=\"font-size: 12pt;\">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0),
(4, 'ticket', 'ticket-reply', 'english', 'Ticket Reply (Sent to Customer)', 'New Ticket Reply', '<span style=\"font-size: 12pt;\">Hi {contact_firstname} {contact_lastname}</span><br /><br /><span style=\"font-size: 12pt;\">You have a new ticket reply to ticket <a href=\"{ticket_public_url}\">#{ticket_id}</a></span><br /><br /><span style=\"font-size: 12pt;\"><strong>Ticket Subject:</strong> {ticket_subject}<br /></span><br /><span style=\"font-size: 12pt;\"><strong>Ticket message:</strong></span><br /><span style=\"font-size: 12pt;\">{ticket_message}</span><br /><br /><span style=\"font-size: 12pt;\">You can view the ticket on the following link: <a href=\"{ticket_public_url}\">#{ticket_id}</a></span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(5, 'ticket', 'ticket-autoresponse', 'english', 'New Ticket Opened - Autoresponse', 'New Support Ticket Opened', '<span style=\"font-size: 12pt;\">Hi {contact_firstname} {contact_lastname}</span><br /><br /><span style=\"font-size: 12pt;\">Thank you for contacting our support team. A support ticket has now been opened for your request. You will be notified when a response is made by email.</span><br /><br /><span style=\"font-size: 12pt;\"><strong>Subject:</strong> {ticket_subject}</span><br /><span style=\"font-size: 12pt;\"><strong>Department</strong>: {ticket_department}</span><br /><span style=\"font-size: 12pt;\"><strong>Priority:</strong> {ticket_priority}</span><br /><br /><span style=\"font-size: 12pt;\"><strong>Ticket message:</strong></span><br /><span style=\"font-size: 12pt;\">{ticket_message}</span><br /><br /><span style=\"font-size: 12pt;\">You can view the ticket on the following link: <a href=\"{ticket_public_url}\">#{ticket_id}</a></span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(6, 'invoice', 'invoice-payment-recorded', 'english', 'Invoice Payment Recorded (Sent to Customer)', 'Invoice Payment Recorded', '<span style=\"font-size: 12pt;\">Hello {contact_firstname}&nbsp;{contact_lastname}<br /><br /></span>Thank you for the payment. Find the payment details below:<br /><br />-------------------------------------------------<br /><br />Amount:&nbsp;<strong>{payment_total}<br /></strong>Date:&nbsp;<strong>{payment_date}</strong><br />Invoice number:&nbsp;<span style=\"font-size: 12pt;\"><strong># {invoice_number}<br /><br /></strong></span>-------------------------------------------------<br /><br />You can always view the invoice for this payment at the following link:&nbsp;<a href=\"{invoice_link}\"><span style=\"font-size: 12pt;\">{invoice_number}</span></a><br /><br />We are looking forward working with you.<br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(7, 'invoice', 'invoice-overdue-notice', 'english', 'Invoice Overdue Notice', 'Invoice Overdue Notice - {invoice_number}', '<span style=\"font-size: 12pt;\">Hi {contact_firstname} {contact_lastname}</span><br /><br /><span style=\"font-size: 12pt;\">This is an overdue notice for invoice <strong># {invoice_number}</strong></span><br /><br /><span style=\"font-size: 12pt;\">This invoice was due: {invoice_duedate}</span><br /><br /><span style=\"font-size: 12pt;\">You can view the invoice on the following link: <a href=\"{invoice_link}\">{invoice_number}</a></span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(8, 'invoice', 'invoice-already-send', 'english', 'Invoice Already Sent to Customer', 'Invoice # {invoice_number} ', '<span style=\"font-size: 12pt;\">Hi {contact_firstname} {contact_lastname}</span><br /><br /><span style=\"font-size: 12pt;\">At your request, here is the invoice with number <strong># {invoice_number}</strong></span><br /><br /><span style=\"font-size: 12pt;\">You can view the invoice on the following link: <a href=\"{invoice_link}\">{invoice_number}</a></span><br /><br /><span style=\"font-size: 12pt;\">Please contact us for more information.</span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(9, 'ticket', 'new-ticket-created-staff', 'english', 'New Ticket Created (Opened by Customer, Sent to Staff Members)', 'New Ticket Created', '<p><span style=\"font-size: 12pt;\">A new support ticket has been opened.</span><br /><br /><span style=\"font-size: 12pt;\"><strong>Subject</strong>: {ticket_subject}</span><br /><span style=\"font-size: 12pt;\"><strong>Department</strong>: {ticket_department}</span><br /><span style=\"font-size: 12pt;\"><strong>Priority</strong>: {ticket_priority}<br /></span><br /><span style=\"font-size: 12pt;\"><strong>Ticket message:</strong></span><br /><span style=\"font-size: 12pt;\">{ticket_message}</span><br /><br /><span style=\"font-size: 12pt;\">You can view the ticket on the following link: <a href=\"{ticket_url}\">#{ticket_id}</a></span><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0),
(10, 'estimate', 'estimate-send-to-client', 'english', 'Send Estimate to Customer', 'Estimate # {estimate_number} created', '<span style=\"font-size: 12pt;\">Dear {contact_firstname} {contact_lastname}</span><br /><br /><span style=\"font-size: 12pt;\">Please find the attached estimate <strong># {estimate_number}</strong></span><br /><br /><span style=\"font-size: 12pt;\"><strong>Estimate status:</strong> {estimate_status}</span><br /><br /><span style=\"font-size: 12pt;\">You can view the estimate on the following link: <a href=\"{estimate_link}\">{estimate_number}</a></span><br /><br /><span style=\"font-size: 12pt;\">We look forward to your communication.</span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}<br /></span>', '{companyname} | CRM', '', 0, 1, 0),
(11, 'ticket', 'ticket-reply-to-admin', 'english', 'Ticket Reply (Sent to Staff)', 'New Support Ticket Reply', '<span style=\"font-size: 12pt;\">A new support ticket reply from {contact_firstname} {contact_lastname}</span><br /><br /><span style=\"font-size: 12pt;\"><strong>Subject</strong>: {ticket_subject}</span><br /><span style=\"font-size: 12pt;\"><strong>Department</strong>: {ticket_department}</span><br /><span style=\"font-size: 12pt;\"><strong>Priority</strong>: {ticket_priority}</span><br /><br /><span style=\"font-size: 12pt;\"><strong>Ticket message:</strong></span><br /><span style=\"font-size: 12pt;\">{ticket_message}</span><br /><br /><span style=\"font-size: 12pt;\">You can view the ticket on the following link: <a href=\"{ticket_url}\">#{ticket_id}</a></span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(12, 'estimate', 'estimate-already-send', 'english', 'Estimate Already Sent to Customer', 'Estimate # {estimate_number} ', '<span style=\"font-size: 12pt;\">Dear {contact_firstname} {contact_lastname}</span><br /> <br /><span style=\"font-size: 12pt;\">Thank you for your estimate request.</span><br /> <br /><span style=\"font-size: 12pt;\">You can view the estimate on the following link: <a href=\"{estimate_link}\">{estimate_number}</a></span><br /> <br /><span style=\"font-size: 12pt;\">Please contact us for more information.</span><br /> <br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(13, 'contract', 'contract-expiration', 'english', 'Contract Expiration Reminder (Sent to Customer Contacts)', 'Contract Expiration Reminder', '<span style=\"font-size: 12pt;\">Dear {client_company}</span><br /><br /><span style=\"font-size: 12pt;\">This is a reminder that the following contract will expire soon:</span><br /><br /><span style=\"font-size: 12pt;\"><strong>Subject:</strong> {contract_subject}</span><br /><span style=\"font-size: 12pt;\"><strong>Description:</strong> {contract_description}</span><br /><span style=\"font-size: 12pt;\"><strong>Date Start:</strong> {contract_datestart}</span><br /><span style=\"font-size: 12pt;\"><strong>Date End:</strong> {contract_dateend}</span><br /><br /><span style=\"font-size: 12pt;\">Please contact us for more information.</span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(14, 'tasks', 'task-assigned', 'english', 'New Task Assigned (Sent to Staff)', 'New Task Assigned to You - {task_name}', '<span style=\"font-size: 12pt;\">Dear {staff_firstname}</span><br /><br /><span style=\"font-size: 12pt;\">You have been assigned to a new task:</span><br /><br /><span style=\"font-size: 12pt;\"><strong>Name:</strong> {task_name}<br /></span><strong>Start Date:</strong> {task_startdate}<br /><span style=\"font-size: 12pt;\"><strong>Due date:</strong> {task_duedate}</span><br /><span style=\"font-size: 12pt;\"><strong>Priority:</strong> {task_priority}<br /><br /></span><span style=\"font-size: 12pt;\"><span>You can view the task on the following link</span>: <a href=\"{task_link}\">{task_name}</a></span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(15, 'tasks', 'task-added-as-follower', 'english', 'Staff Member Added as Follower on Task (Sent to Staff)', 'You are added as follower on task - {task_name}', '<span style=\"font-size: 12pt;\">Hi {staff_firstname}<br /></span><br /><span style=\"font-size: 12pt;\">You have been added as follower on the following task:</span><br /><br /><span style=\"font-size: 12pt;\"><strong>Name:</strong> {task_name}</span><br /><span style=\"font-size: 12pt;\"><strong>Start date:</strong> {task_startdate}</span><br /><br /><span>You can view the task on the following link</span><span>: </span><a href=\"{task_link}\">{task_name}</a><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(16, 'tasks', 'task-commented', 'english', 'New Comment on Task (Sent to Staff)', 'New Comment on Task - {task_name}', 'Dear {staff_firstname}<br /><br />A comment has been made on the following task:<br /><br /><strong>Name:</strong> {task_name}<br /><strong>Comment:</strong> {task_comment}<br /><br />You can view the task on the following link: <a href=\"{task_link}\">{task_name}</a><br /><br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(17, 'tasks', 'task-added-attachment', 'english', 'New Attachment(s) on Task (Sent to Staff)', 'New Attachment on Task - {task_name}', 'Hi {staff_firstname}<br /><br /><strong>{task_user_take_action}</strong> added an attachment on the following task:<br /><br /><strong>Name:</strong> {task_name}<br /><br />You can view the task on the following link: <a href=\"{task_link}\">{task_name}</a><br /><br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(18, 'estimate', 'estimate-declined-to-staff', 'english', 'Estimate Declined (Sent to Staff)', 'Customer Declined Estimate', '<span style=\"font-size: 12pt;\">Hi</span><br /> <br /><span style=\"font-size: 12pt;\">Customer ({client_company}) declined estimate with number <strong># {estimate_number}</strong></span><br /> <br /><span style=\"font-size: 12pt;\">You can view the estimate on the following link: <a href=\"{estimate_link}\">{estimate_number}</a></span><br /> <br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(19, 'estimate', 'estimate-accepted-to-staff', 'english', 'Estimate Accepted (Sent to Staff)', 'Customer Accepted Estimate', '<span style=\"font-size: 12pt;\">Hi</span><br /> <br /><span style=\"font-size: 12pt;\">Customer ({client_company}) accepted estimate with number <strong># {estimate_number}</strong></span><br /> <br /><span style=\"font-size: 12pt;\">You can view the estimate on the following link: <a href=\"{estimate_link}\">{estimate_number}</a></span><br /> <br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(20, 'proposals', 'proposal-client-accepted', 'english', 'Customer Action - Accepted (Sent to Staff)', 'Customer Accepted Proposal', '<div>Hi<br /> <br />Client <strong>{proposal_proposal_to}</strong> accepted the following proposal:<br /> <br /><strong>Number:</strong> {proposal_number}<br /><strong>Subject</strong>: {proposal_subject}<br /><strong>Total</strong>: {proposal_total}<br /> <br />View the proposal on the following link: <a href=\"{proposal_link}\">{proposal_number}</a><br /> <br />Kind Regards,<br />{email_signature}</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>', '{companyname} | CRM', '', 0, 1, 0),
(21, 'proposals', 'proposal-send-to-customer', 'english', 'Send Proposal to Customer', 'Proposal With Number {proposal_number} Created', 'Dear {proposal_proposal_to}<br /><br />Please find our attached proposal.<br /><br />This proposal is valid until: {proposal_open_till}<br />You can view the proposal on the following link: <a href=\"{proposal_link}\">{proposal_number}</a><br /><br />Please don\'t hesitate to comment online if you have any questions.<br /><br />We look forward to your communication.<br /><br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(22, 'proposals', 'proposal-client-declined', 'english', 'Customer Action - Declined (Sent to Staff)', 'Client Declined Proposal', 'Hi<br /> <br />Customer <strong>{proposal_proposal_to}</strong> declined the proposal <strong>{proposal_subject}</strong><br /> <br />View the proposal on the following link <a href=\"{proposal_link}\">{proposal_number}</a>&nbsp;or from the admin area.<br /> <br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(23, 'proposals', 'proposal-client-thank-you', 'english', 'Thank You Email (Sent to Customer After Accept)', 'Thank for you accepting proposal', 'Dear {proposal_proposal_to}<br /> <br />Thank for for accepting the proposal.<br /> <br />We look forward to doing business with you.<br /> <br />We will contact you as soon as possible<br /> <br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(24, 'proposals', 'proposal-comment-to-client', 'english', 'New Comment  (Sent to Customer/Lead)', 'New Proposal Comment', 'Dear {proposal_proposal_to}<br /> <br />A new comment has been made on the following proposal: <strong>{proposal_number}</strong><br /> <br />You can view and reply to the comment on the following link: <a href=\"{proposal_link}\">{proposal_number}</a><br /> <br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(25, 'proposals', 'proposal-comment-to-admin', 'english', 'New Comment (Sent to Staff) ', 'New Proposal Comment', 'Hi<br /> <br />A new comment has been made to the proposal <strong>{proposal_subject}</strong><br /> <br />You can view and reply to the comment on the following link: <a href=\"{proposal_link}\">{proposal_number}</a>&nbsp;or from the admin area.<br /> <br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(26, 'estimate', 'estimate-thank-you-to-customer', 'english', 'Thank You Email (Sent to Customer After Accept)', 'Thank for you accepting estimate', '<span style=\"font-size: 12pt;\">Dear {contact_firstname} {contact_lastname}</span><br /> <br /><span style=\"font-size: 12pt;\">Thank for for accepting the estimate.</span><br /> <br /><span style=\"font-size: 12pt;\">We look forward to doing business with you.</span><br /> <br /><span style=\"font-size: 12pt;\">We will contact you as soon as possible.</span><br /> <br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(27, 'tasks', 'task-deadline-notification', 'english', 'Task Deadline Reminder - Sent to Assigned Members', 'Task Deadline Reminder', 'Hi {staff_firstname}&nbsp;{staff_lastname}<br /><br />This is an automated email from {companyname}.<br /><br />The task <strong>{task_name}</strong> deadline is on <strong>{task_duedate}</strong>. <br />This task is still not finished.<br /><br />You can view the task on the following link: <a href=\"{task_link}\">{task_name}</a><br /><br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(28, 'contract', 'send-contract', 'english', 'Send Contract to Customer', 'Contract - {contract_subject}', '<p><span style=\"font-size: 12pt;\">Hi&nbsp;{contact_firstname}&nbsp;{contact_lastname}</span><br /><br /><span style=\"font-size: 12pt;\">Please find the <a href=\"{contract_link}\">{contract_subject}</a> attached.<br /><br />Description: {contract_description}<br /><br /></span><span style=\"font-size: 12pt;\">Looking forward to hear from you.</span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0),
(29, 'invoice', 'invoice-payment-recorded-to-staff', 'english', 'Invoice Payment Recorded (Sent to Staff)', 'New Invoice Payment', '<span style=\"font-size: 12pt;\">Hi</span><br /><br /><span style=\"font-size: 12pt;\">Customer recorded payment for invoice <strong># {invoice_number}</strong></span><br /> <br /><span style=\"font-size: 12pt;\">You can view the invoice on the following link: <a href=\"{invoice_link}\">{invoice_number}</a></span><br /> <br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(30, 'ticket', 'auto-close-ticket', 'english', 'Auto Close Ticket', 'Ticket Auto Closed', '<p><span style=\"font-size: 12pt;\">Hi {contact_firstname} {contact_lastname}</span><br /><br /><span style=\"font-size: 12pt;\">Ticket {ticket_subject} has been auto close due to inactivity.</span><br /><br /><span style=\"font-size: 12pt;\"><strong>Ticket #</strong>: <a href=\"{ticket_public_url}\">{ticket_id}</a></span><br /><span style=\"font-size: 12pt;\"><strong>Department</strong>: {ticket_department}</span><br /><span style=\"font-size: 12pt;\"><strong>Priority:</strong> {ticket_priority}</span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0),
(31, 'project', 'new-project-discussion-created-to-staff', 'english', 'New Project Discussion (Sent to Project Members)', 'New Project Discussion Created - {project_name}', '<p>Hi {staff_firstname}<br /><br />New project discussion created from <strong>{discussion_creator}</strong><br /><br /><strong>Subject:</strong> {discussion_subject}<br /><strong>Description:</strong> {discussion_description}<br /><br />You can view the discussion on the following link: <a href=\"{discussion_link}\">{discussion_subject}</a><br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(32, 'project', 'new-project-discussion-created-to-customer', 'english', 'New Project Discussion (Sent to Customer Contacts)', 'New Project Discussion Created - {project_name}', '<p>Hello {contact_firstname} {contact_lastname}<br /><br />New project discussion created from <strong>{discussion_creator}</strong><br /><br /><strong>Subject:</strong> {discussion_subject}<br /><strong>Description:</strong> {discussion_description}<br /><br />You can view the discussion on the following link: <a href=\"{discussion_link}\">{discussion_subject}</a><br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(33, 'project', 'new-project-file-uploaded-to-customer', 'english', 'New Project File(s) Uploaded (Sent to Customer Contacts)', 'New Project File(s) Uploaded - {project_name}', '<p>Hello {contact_firstname} {contact_lastname}<br /><br />New project file is uploaded on <strong>{project_name}</strong> from <strong>{file_creator}</strong><br /><br />You can view the project on the following link: <a href=\"{project_link}\">{project_name}</a><br /><br />To view the file in our CRM you can click on the following link: <a href=\"{discussion_link}\">{discussion_subject}</a><br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(34, 'project', 'new-project-file-uploaded-to-staff', 'english', 'New Project File(s) Uploaded (Sent to Project Members)', 'New Project File(s) Uploaded - {project_name}', '<p>Hello&nbsp;{staff_firstname}</p>\r\n<p>New project&nbsp;file is uploaded on&nbsp;<strong>{project_name}</strong> from&nbsp;<strong>{file_creator}</strong></p>\r\n<p>You can view the project on the following link: <a href=\"{project_link}\">{project_name}<br /></a><br />To view&nbsp;the file you can click on the following link: <a href=\"{discussion_link}\">{discussion_subject}</a></p>\r\n<p>Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(35, 'project', 'new-project-discussion-comment-to-customer', 'english', 'New Discussion Comment  (Sent to Customer Contacts)', 'New Discussion Comment', '<p><span style=\"font-size: 12pt;\">Hello {contact_firstname} {contact_lastname}</span><br /><br /><span style=\"font-size: 12pt;\">New discussion comment has been made on <strong>{discussion_subject}</strong> from <strong>{comment_creator}</strong></span><br /><br /><span style=\"font-size: 12pt;\"><strong>Discussion subject:</strong> {discussion_subject}</span><br /><span style=\"font-size: 12pt;\"><strong>Comment</strong>: {discussion_comment}</span><br /><br /><span style=\"font-size: 12pt;\">You can view the discussion on the following link: <a href=\"{discussion_link}\">{discussion_subject}</a></span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0),
(36, 'project', 'new-project-discussion-comment-to-staff', 'english', 'New Discussion Comment (Sent to Project Members)', 'New Discussion Comment', '<p>Hi {staff_firstname}<br /><br />New discussion comment has been made on <strong>{discussion_subject}</strong> from <strong>{comment_creator}</strong><br /><br /><strong>Discussion subject:</strong> {discussion_subject}<br /><strong>Comment:</strong> {discussion_comment}<br /><br />You can view the discussion on the following link: <a href=\"{discussion_link}\">{discussion_subject}</a><br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(37, 'project', 'staff-added-as-project-member', 'english', 'Staff Added as Project Member', 'New project assigned to you', '<p>Hi {staff_firstname}<br /><br />New project has been assigned to you.<br /><br />You can view the project on the following link <a href=\"{project_link}\">{project_name}</a><br /><br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(38, 'estimate', 'estimate-expiry-reminder', 'english', 'Estimate Expiration Reminder', 'Estimate Expiration Reminder', '<p><span style=\"font-size: 12pt;\">Hello {contact_firstname} {contact_lastname}</span><br /><br /><span style=\"font-size: 12pt;\">The estimate with <strong># {estimate_number}</strong> will expire on <strong>{estimate_expirydate}</strong></span><br /><br /><span style=\"font-size: 12pt;\">You can view the estimate on the following link: <a href=\"{estimate_link}\">{estimate_number}</a></span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0),
(39, 'proposals', 'proposal-expiry-reminder', 'english', 'Proposal Expiration Reminder', 'Proposal Expiration Reminder', '<p>Hello {proposal_proposal_to}<br /><br />The proposal {proposal_number}&nbsp;will expire on <strong>{proposal_open_till}</strong><br /><br />You can view the proposal on the following link: <a href=\"{proposal_link}\">{proposal_number}</a><br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(40, 'staff', 'new-staff-created', 'english', 'New Staff Created (Welcome Email)', 'You are added as staff member', 'Hi {staff_firstname}<br /><br />You are added as member on our CRM.<br /><br />Please use the following logic credentials:<br /><br /><strong>Email:</strong> {staff_email}<br /><strong>Password:</strong> {password}<br /><br />Click <a href=\"{admin_url}\">here </a>to login in the dashboard.<br /><br />Best Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(41, 'client', 'contact-forgot-password', 'english', 'Forgot Password', 'Create New Password', '<h2>Create a new password</h2>\r\nForgot your password?<br /> To create a new password, just follow this link:<br /> <br /><a href=\"{reset_password_url}\">Reset Password</a><br /> <br /> You received this email, because it was requested by a {companyname}&nbsp;user. This is part of the procedure to create a new password on the system. If you DID NOT request a new password then please ignore this email and your password will remain the same. <br /><br /> {email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(42, 'client', 'contact-password-reseted', 'english', 'Password Reset - Confirmation', 'Your password has been changed', '<strong><span style=\"font-size: 14pt;\">You have changed your password.</span><br /></strong><br /> Please, keep it in your records so you don\'t forget it.<br /> <br /> Your email address for login is: {contact_email}<br /><br />If this wasnt you, please contact us.<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(43, 'client', 'contact-set-password', 'english', 'Set New Password', 'Set new password on {companyname} ', '<h2><span style=\"font-size: 14pt;\">Setup your new password on {companyname}</span></h2>\r\nPlease use the following link to set up your new password:<br /><br /><a href=\"{set_password_url}\">Set new password</a><br /><br />Keep it in your records so you don\'t forget it.<br /><br />Please set your new password in <strong>48 hours</strong>. After that, you won\'t be able to set your password because this link will expire.<br /><br />You can login at: <a href=\"{crm_url}\">{crm_url}</a><br />Your email address for login: {contact_email}<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(44, 'staff', 'staff-forgot-password', 'english', 'Forgot Password', 'Create New Password', '<h2><span style=\"font-size: 14pt;\">Create a new password</span></h2>\r\nForgot your password?<br /> To create a new password, just follow this link:<br /> <br /><a href=\"{reset_password_url}\">Reset Password</a><br /> <br /> You received this email, because it was requested by a <strong>{companyname}</strong>&nbsp;user. This is part of the procedure to create a new password on the system. If you DID NOT request a new password then please ignore this email and your password will remain the same. <br /><br /> {email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(45, 'staff', 'staff-password-reseted', 'english', 'Password Reset - Confirmation', 'Your password has been changed', '<span style=\"font-size: 14pt;\"><strong>You have changed your password.<br /></strong></span><br /> Please, keep it in your records so you don\'t forget it.<br /> <br /> Your email address for login is: {staff_email}<br /><br /> If this wasnt you, please contact us.<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(46, 'project', 'assigned-to-project', 'english', 'New Project Created (Sent to Customer Contacts)', 'New Project Created', '<p>Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}</p>\r\n<p>New project is assigned to your company.<br /><br /><strong>Project Name:</strong>&nbsp;{project_name}<br /><strong>Project Start Date:</strong>&nbsp;{project_start_date}</p>\r\n<p>You can view the project on the following link:&nbsp;<a href=\"{project_link}\">{project_name}</a></p>\r\n<p>We are looking forward hearing from you.<br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(47, 'tasks', 'task-added-attachment-to-contacts', 'english', 'New Attachment(s) on Task (Sent to Customer Contacts)', 'New Attachment on Task - {task_name}', '<span>Hi {contact_firstname} {contact_lastname}</span><br /><br /><strong>{task_user_take_action}</strong><span> added an attachment on the following task:</span><br /><br /><strong>Name:</strong><span> {task_name}</span><br /><br /><span>You can view the task on the following link: </span><a href=\"{task_link}\">{task_name}</a><br /><br /><span>Kind Regards,</span><br /><span>{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(48, 'tasks', 'task-commented-to-contacts', 'english', 'New Comment on Task (Sent to Customer Contacts)', 'New Comment on Task - {task_name}', '<span>Dear {contact_firstname} {contact_lastname}</span><br /><br /><span>A comment has been made on the following task:</span><br /><br /><strong>Name:</strong><span> {task_name}</span><br /><strong>Comment:</strong><span> {task_comment}</span><br /><br /><span>You can view the task on the following link: </span><a href=\"{task_link}\">{task_name}</a><br /><br /><span>Kind Regards,</span><br /><span>{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(49, 'leads', 'new-lead-assigned', 'english', 'New Lead Assigned to Staff Member', 'New lead assigned to you', '<p>Hello {lead_assigned}<br /><br />New lead is assigned to you.<br /><br /><strong>Lead Name:</strong>&nbsp;{lead_name}<br /><strong>Lead Email:</strong>&nbsp;{lead_email}<br /><br />You can view the lead on the following link: <a href=\"{lead_link}\">{lead_name}</a><br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(50, 'client', 'client-statement', 'english', 'Statement - Account Summary', 'Account Statement from {statement_from} to {statement_to}', 'Dear {contact_firstname} {contact_lastname}, <br /><br />Its been a great experience working with you.<br /><br />Attached with this email is a list of all transactions for the period between {statement_from} to {statement_to}<br /><br />For your information your account balance due is total:&nbsp;{statement_balance_due}<br /><br />Please contact us if you need more information.<br /> <br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(51, 'ticket', 'ticket-assigned-to-admin', 'english', 'New Ticket Assigned (Sent to Staff)', 'New support ticket has been assigned to you', '<p><span style=\"font-size: 12pt;\">Hi</span></p>\r\n<p><span style=\"font-size: 12pt;\">A new support ticket&nbsp;has been assigned to you.</span><br /><br /><span style=\"font-size: 12pt;\"><strong>Subject</strong>: {ticket_subject}</span><br /><span style=\"font-size: 12pt;\"><strong>Department</strong>: {ticket_department}</span><br /><span style=\"font-size: 12pt;\"><strong>Priority</strong>: {ticket_priority}</span><br /><br /><span style=\"font-size: 12pt;\"><strong>Ticket message:</strong></span><br /><span style=\"font-size: 12pt;\">{ticket_message}</span><br /><br /><span style=\"font-size: 12pt;\">You can view the ticket on the following link: <a href=\"{ticket_url}\">#{ticket_id}</a></span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span></p>', '{companyname} | CRM', '', 0, 1, 0),
(52, 'client', 'new-client-registered-to-admin', 'english', 'New Customer Registration (Sent to admins)', 'New Customer Registration', 'Hello.<br /><br />New customer registration on your customer portal:<br /><br /><strong>Firstname:</strong>&nbsp;{contact_firstname}<br /><strong>Lastname:</strong>&nbsp;{contact_lastname}<br /><strong>Company:</strong>&nbsp;{client_company}<br /><strong>Email:</strong>&nbsp;{contact_email}<br /><br />Best Regards', '{companyname} | CRM', '', 0, 1, 0),
(53, 'leads', 'new-web-to-lead-form-submitted', 'english', 'Web to lead form submitted - Sent to lead', '{lead_name} - We Received Your Request', 'Hello {lead_name}.<br /><br /><strong>Your request has been received.</strong><br /><br />This email is to let you know that we received your request and we will get back to you as soon as possible with more information.<br /><br />Best Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 0, 0),
(54, 'staff', 'two-factor-authentication', 'english', 'Two Factor Authentication', 'Confirm Your Login', '<p>Hi {staff_firstname}</p>\r\n<p style=\"text-align: left;\">You received this email because you have enabled two factor authentication in your account.<br />Use the following code to confirm your login:</p>\r\n<p style=\"text-align: left;\"><span style=\"font-size: 18pt;\"><strong>{two_factor_auth_code}<br /><br /></strong><span style=\"font-size: 12pt;\">{email_signature}</span><strong><br /><br /><br /><br /></strong></span></p>', '{companyname} | CRM', '', 0, 1, 0),
(55, 'project', 'project-finished-to-customer', 'english', 'Project Marked as Finished (Sent to Customer Contacts)', 'Project Marked as Finished', '<p>Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}</p>\r\n<p>You are receiving this email because project&nbsp;<strong>{project_name}</strong> has been marked as finished. This project is assigned under your company and we just wanted to keep you up to date.<br /><br />You can view the project on the following link:&nbsp;<a href=\"{project_link}\">{project_name}</a></p>\r\n<p>If you have any questions don\'t hesitate to contact us.<br /><br />Kind Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(56, 'credit_note', 'credit-note-send-to-client', 'english', 'Send Credit Note To Email', 'Credit Note With Number #{credit_note_number} Created', 'Dear&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br />We have attached the credit note with number <strong>#{credit_note_number} </strong>for your reference.<br /><br /><strong>Date:</strong>&nbsp;{credit_note_date}<br /><strong>Total Amount:</strong>&nbsp;{credit_note_total}<br /><br /><span style=\"font-size: 12pt;\">Please contact us for more information.</span><br /> <br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(57, 'tasks', 'task-status-change-to-staff', 'english', 'Task Status Changed (Sent to Staff)', 'Task Status Changed', '<span style=\"font-size: 12pt;\">Hi {staff_firstname}</span><br /><br /><span style=\"font-size: 12pt;\"><strong>{task_user_take_action}</strong> marked task as <strong>{task_status}</strong></span><br /><br /><span style=\"font-size: 12pt;\"><strong>Name:</strong> {task_name}</span><br /><span style=\"font-size: 12pt;\"><strong>Due date:</strong> {task_duedate}</span><br /><br /><span style=\"font-size: 12pt;\">You can view the task on the following link: <a href=\"{task_link}\">{task_name}</a></span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(58, 'tasks', 'task-status-change-to-contacts', 'english', 'Task Status Changed (Sent to Customer Contacts)', 'Task Status Changed', '<span style=\"font-size: 12pt;\">Hi {contact_firstname} {contact_lastname}</span><br /><br /><span style=\"font-size: 12pt;\"><strong>{task_user_take_action}</strong> marked task as <strong>{task_status}</strong></span><br /><br /><span style=\"font-size: 12pt;\"><strong>Name:</strong> {task_name}</span><br /><span style=\"font-size: 12pt;\"><strong>Due date:</strong> {task_duedate}</span><br /><br /><span style=\"font-size: 12pt;\">You can view the task on the following link: <a href=\"{task_link}\">{task_name}</a></span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(59, 'staff', 'reminder-email-staff', 'english', 'Staff Reminder Email', 'You Have a New Reminder!', '<p>Hello&nbsp;{staff_firstname}<br /><br /><strong>You have a new reminder&nbsp;linked to&nbsp;{staff_reminder_relation_name}!<br /><br />Reminder description:</strong><br />{staff_reminder_description}<br /><br />Click <a href=\"{staff_reminder_relation_link}\">here</a> to view&nbsp;<a href=\"{staff_reminder_relation_link}\">{staff_reminder_relation_name}</a><br /><br />Best Regards<br /><br /></p>', '{companyname} | CRM', '', 0, 1, 0),
(60, 'contract', 'contract-comment-to-client', 'english', 'New Comment  (Sent to Customer Contacts)', 'New Contract Comment', 'Dear {contact_firstname} {contact_lastname}<br /> <br />A new comment has been made on the following contract: <strong>{contract_subject}</strong><br /> <br />You can view and reply to the comment on the following link: <a href=\"{contract_link}\">{contract_subject}</a><br /> <br />Kind Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(61, 'contract', 'contract-comment-to-admin', 'english', 'New Comment (Sent to Staff) ', 'New Contract Comment', 'Hi {staff_firstname}<br /><br />A new comment has been made to the contract&nbsp;<strong>{contract_subject}</strong><br /><br />You can view and reply to the comment on the following link: <a href=\"{contract_link}\">{contract_subject}</a>&nbsp;or from the admin area.<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(62, 'subscriptions', 'send-subscription', 'english', 'Send Subscription to Customer', 'Subscription Created', 'Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br />We have prepared the subscription&nbsp;<strong>{subscription_name}</strong> for your company.<br /><br />Click <a href=\"{subscription_link}\">here</a> to review the subscription and subscribe.<br /><br />Best Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(63, 'subscriptions', 'subscription-payment-failed', 'english', 'Subscription Payment Failed', 'Your most recent invoice payment failed', 'Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br br=\"\" />Unfortunately, your most recent invoice payment for&nbsp;<strong>{subscription_name}</strong> was declined.<br /><br />This could be due to a change in your card number, your card expiring,<br />cancellation of your credit card, or the card issuer not recognizing the<br />payment and therefore taking action to prevent it.<br /><br />Please update your payment information as soon as possible by logging in here:<br /><a href=\"{crm_url}/login\">{crm_url}/login</a><br /><br />Best Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(64, 'subscriptions', 'subscription-canceled', 'english', 'Subscription Canceled (Sent to customer primary contact)', 'Your subscription has been canceled', 'Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br />Your subscription&nbsp;<strong>{subscription_name} </strong>has been canceled, if you have any questions don\'t hesitate to contact us.<br /><br />It was a pleasure doing business with you.<br /><br />Best Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(65, 'subscriptions', 'subscription-payment-succeeded', 'english', 'Subscription Payment Succeeded (Sent to customer primary contact)', 'Subscription  Payment Receipt - {subscription_name}', 'Hello&nbsp;{contact_firstname}&nbsp;{contact_lastname}<br /><br />This email is to let you know that we received your payment for subscription&nbsp;<strong>{subscription_name}&nbsp;</strong>of&nbsp;<strong><span>{payment_total}<br /><br /></span></strong>The invoice associated with it is now with status&nbsp;<strong>{invoice_status}<br /></strong><br />Thank you for your confidence.<br /><br />Best Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(66, 'contract', 'contract-expiration-to-staff', 'english', 'Contract Expiration Reminder (Sent to Staff)', 'Contract Expiration Reminder', 'Hi {staff_firstname}<br /><br /><span style=\"font-size: 12pt;\">This is a reminder that the following contract will expire soon:</span><br /><br /><span style=\"font-size: 12pt;\"><strong>Subject:</strong> {contract_subject}</span><br /><span style=\"font-size: 12pt;\"><strong>Description:</strong> {contract_description}</span><br /><span style=\"font-size: 12pt;\"><strong>Date Start:</strong> {contract_datestart}</span><br /><span style=\"font-size: 12pt;\"><strong>Date End:</strong> {contract_dateend}</span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(67, 'gdpr', 'gdpr-removal-request', 'english', 'Removal Request From Contact (Sent to administrators)', 'Data Removal Request Received', 'Hello&nbsp;{staff_firstname}&nbsp;{staff_lastname}<br /><br />Data removal has been requested by&nbsp;{contact_firstname} {contact_lastname}<br /><br />You can review this request and take proper actions directly from the admin area.', '{companyname} | CRM', '', 0, 1, 0),
(68, 'gdpr', 'gdpr-removal-request-lead', 'english', 'Removal Request From Lead (Sent to administrators)', 'Data Removal Request Received', 'Hello&nbsp;{staff_firstname}&nbsp;{staff_lastname}<br /><br />Data removal has been requested by {lead_name}<br /><br />You can review this request and take proper actions directly from the admin area.<br /><br />To view the lead inside the admin area click here:&nbsp;<a href=\"{lead_link}\">{lead_link}</a>', '{companyname} | CRM', '', 0, 1, 0),
(69, 'client', 'client-registration-confirmed', 'english', 'Customer Registration Confirmed', 'Your registration is confirmed', '<p>Dear {contact_firstname} {contact_lastname}<br /><br />We just wanted to let you know that your registration at&nbsp;{companyname} is successfully confirmed and your account is now active.<br /><br />You can login at&nbsp;<a href=\"{crm_url}\">{crm_url}</a> with the email and password you provided during registration.<br /><br />Please contact us if you need any help.<br /><br />Kind Regards, <br />{email_signature}</p>\r\n<p><br />(This is an automated email, so please don\'t reply to this email address)</p>', '{companyname} | CRM', '', 0, 1, 0),
(70, 'contract', 'contract-signed-to-staff', 'english', 'Contract Signed (Sent to Staff)', 'Customer Signed a Contract', 'Hi {staff_firstname}<br /><br />A contract with subject&nbsp;<strong>{contract_subject} </strong>has been successfully signed by the customer.<br /><br />You can view the contract at the following link: <a href=\"{contract_link}\">{contract_subject}</a>&nbsp;or from the admin area.<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(71, 'subscriptions', 'customer-subscribed-to-staff', 'english', 'Customer Subscribed to a Subscription (Sent to administrators and subscription creator)', 'Customer Subscribed to a Subscription', 'The customer <strong>{client_company}</strong> subscribed to a subscription with name&nbsp;<strong>{subscription_name}</strong><br /><br /><strong>ID</strong>:&nbsp;{subscription_id}<br /><strong>Subscription name</strong>:&nbsp;{subscription_name}<br /><strong>Subscription description</strong>:&nbsp;{subscription_description}<br /><br />You can view the subscription by clicking <a href=\"{subscription_link}\">here</a><br />\r\n<div style=\"text-align: center;\"><span style=\"font-size: 10pt;\">&nbsp;</span></div>\r\nBest Regards,<br />{email_signature}<br /><br /><span style=\"font-size: 10pt;\"><span style=\"color: #999999;\">You are receiving this email because you are either administrator or you are creator of the subscription.</span></span>', '{companyname} | CRM', '', 0, 1, 0),
(72, 'client', 'contact-verification-email', 'english', 'Email Verification (Sent to Contact After Registration)', 'Verify Email Address', '<p>Hello&nbsp;{contact_firstname}<br /><br />Please click the button below to verify your email address.<br /><br /><a href=\"{email_verification_url}\">Verify Email Address</a><br /><br />If you did not create an account, no further action is required</p>\r\n<p><br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0),
(73, 'client', 'new-customer-profile-file-uploaded-to-staff', 'english', 'New Customer Profile File(s) Uploaded (Sent to Staff)', 'Customer Uploaded New File(s) in Profile', 'Hi!<br /><br />New file(s) is uploaded into the customer ({client_company}) profile by&nbsp;{contact_firstname}<br /><br />You can check the uploaded files into the admin area by clicking <a href=\"{customer_profile_files_admin_link}\">here</a> or at the following link:&nbsp;{customer_profile_files_admin_link}<br /><br />{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(74, 'staff', 'event-notification-to-staff', 'english', 'Event Notification (Calendar)', 'Upcoming Event - {event_title}', 'Hi {staff_firstname}! <br /><br />This is a reminder for event <a href=\\\"{event_link}\\\">{event_title}</a> scheduled at {event_start_date}. <br /><br />Regards.', '', '', 0, 1, 0),
(75, 'subscriptions', 'subscription-payment-requires-action', 'english', 'Credit Card Authorization Required - SCA', 'Important: Confirm your subscription {subscription_name} payment', '<p>Hello {contact_firstname}</p>\r\n<p><strong>Your bank sometimes requires an additional step to make sure an online transaction was authorized.</strong><br /><br />Because of European regulation to protect consumers, many online payments now require two-factor authentication. Your bank ultimately decides when authentication is required to confirm a payment, but you may notice this step when you start paying for a service or when the cost changes.<br /><br />In order to pay the subscription <strong>{subscription_name}</strong>, you will need to&nbsp;confirm your payment by clicking on the follow link: <strong><a href=\"{subscription_authorize_payment_link}\">{subscription_authorize_payment_link}</a></strong><br /><br />To view the subscription, please click at the following link: <a href=\"{subscription_link}\"><span>{subscription_link}</span></a><br />or you can login in our dedicated area here: <a href=\"{crm_url}/login\">{crm_url}/login</a> in case you want to update your credit card or view the subscriptions you are subscribed.<br /><br />Best Regards,<br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);
INSERT INTO `tblemailtemplates` (`emailtemplateid`, `type`, `slug`, `language`, `name`, `subject`, `message`, `fromname`, `fromemail`, `plaintext`, `active`, `order`) VALUES
(76, 'invoice', 'invoice-due-notice', 'english', 'Invoice Due Notice', 'Your {invoice_number} will be due soon', '<span style=\"font-size: 12pt;\">Hi {contact_firstname} {contact_lastname}<br /><br /></span>You invoice <span style=\"font-size: 12pt;\"><strong># {invoice_number} </strong>will be due on <strong>{invoice_duedate}</strong></span><br /><br /><span style=\"font-size: 12pt;\">You can view the invoice on the following link: <a href=\"{invoice_link}\">{invoice_number}</a></span><br /><br /><span style=\"font-size: 12pt;\">Kind Regards,</span><br /><span style=\"font-size: 12pt;\">{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(77, 'estimate_request', 'estimate-request-submitted-to-staff', 'english', 'Estimate Request Submitted (Sent to Staff)', 'New Estimate Request Submitted', '<span> Hello,&nbsp;</span><br /><br />{estimate_request_email} submitted an estimate request via the {estimate_request_form_name} form.<br /><br />You can view the request at the following link: <a href=\"{estimate_request_link}\">{estimate_request_link}</a><br /><br />==<br /><br />{estimate_request_submitted_data}<br /><br />Kind Regards,<br /><span>{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(78, 'estimate_request', 'estimate-request-assigned', 'english', 'Estimate Request Assigned (Sent to Staff)', 'New Estimate Request Assigned', '<span> Hello {estimate_request_assigned},&nbsp;</span><br /><br />Estimate request #{estimate_request_id} has been assigned to you.<br /><br />You can view the request at the following link: <a href=\"{estimate_request_link}\">{estimate_request_link}</a><br /><br />Kind Regards,<br /><span>{email_signature}</span>', '{companyname} | CRM', '', 0, 1, 0),
(79, 'estimate_request', 'estimate-request-received-to-user', 'english', 'Estimate Request Received (Sent to User)', 'Estimate Request Received', 'Hello,<br /><br /><strong>Your request has been received.</strong><br /><br />This email is to let you know that we received your request and we will get back to you as soon as possible with more information.<br /><br />Best Regards,<br />{email_signature}', '{companyname} | CRM', '', 0, 0, 0),
(80, 'notifications', 'non-billed-tasks-reminder', 'english', 'Non-billed tasks reminder (sent to selected staff members)', 'Action required: Completed tasks are not billed', 'Hello {staff_firstname}<br><br>The following tasks are marked as complete but not yet billed:<br><br>{unbilled_tasks_list}<br><br>Kind Regards,<br><br>{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(81, 'invoice', 'invoices-batch-payments', 'english', 'Invoices Payments Recorded in Batch (Sent to Customer)', 'We have received your payments', 'Hello {contact_firstname} {contact_lastname}<br><br>Thank you for the payments. Please find the payments details below:<br><br>{batch_payments_list}<br><br>We are looking forward working with you.<br><br>Kind Regards,<br><br>{email_signature}', '{companyname} | CRM', '', 0, 1, 0),
(82, 'contract', 'contract-sign-reminder', 'english', 'Contract Sign Reminder (Sent to Customer)', 'Contract Sign Reminder', '<p>Hello {contact_firstname} {contact_lastname}<br /><br />This is a reminder to review and sign the contract:<a href=\"{contract_link}\">{contract_subject}</a></p><p>You can view and sign by visiting: <a href=\"{contract_link}\">{contract_subject}</a></p><p><br />We are looking forward working with you.<br /><br />Kind Regards,<br /><br />{email_signature}</p>', '{companyname} | CRM', '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblestimates`
--

CREATE TABLE `tblestimates` (
  `id` int(11) NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT 0,
  `datesend` datetime DEFAULT NULL,
  `clientid` int(11) NOT NULL,
  `deleted_customer_name` varchar(100) DEFAULT NULL,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `number` int(11) NOT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `number_format` int(11) NOT NULL DEFAULT 0,
  `formatted_number` varchar(100) DEFAULT NULL,
  `hash` varchar(32) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `date` date NOT NULL,
  `expirydate` date DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `total_tax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total` decimal(15,2) NOT NULL,
  `adjustment` decimal(15,2) DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `clientnote` mediumtext DEFAULT NULL,
  `adminnote` mediumtext DEFAULT NULL,
  `discount_percent` decimal(15,2) DEFAULT 0.00,
  `discount_total` decimal(15,2) DEFAULT 0.00,
  `discount_type` varchar(30) DEFAULT NULL,
  `invoiceid` int(11) DEFAULT NULL,
  `invoiced_date` datetime DEFAULT NULL,
  `terms` mediumtext DEFAULT NULL,
  `reference_no` varchar(100) DEFAULT NULL,
  `sale_agent` int(11) NOT NULL DEFAULT 0,
  `billing_street` varchar(200) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(100) DEFAULT NULL,
  `billing_country` int(11) DEFAULT NULL,
  `shipping_street` varchar(200) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_zip` varchar(100) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT NULL,
  `include_shipping` tinyint(1) NOT NULL,
  `show_shipping_on_estimate` tinyint(1) NOT NULL DEFAULT 1,
  `show_quantity_as` int(11) NOT NULL DEFAULT 1,
  `pipeline_order` int(11) DEFAULT 1,
  `is_expiry_notified` int(11) NOT NULL DEFAULT 0,
  `acceptance_firstname` varchar(50) DEFAULT NULL,
  `acceptance_lastname` varchar(50) DEFAULT NULL,
  `acceptance_email` varchar(100) DEFAULT NULL,
  `acceptance_date` datetime DEFAULT NULL,
  `acceptance_ip` varchar(40) DEFAULT NULL,
  `signature` varchar(40) DEFAULT NULL,
  `short_link` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblestimate_requests`
--

CREATE TABLE `tblestimate_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `submission` longtext NOT NULL,
  `last_status_change` datetime DEFAULT NULL,
  `date_estimated` datetime DEFAULT NULL,
  `from_form_id` int(11) DEFAULT NULL,
  `assigned` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `default_language` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblestimate_request_forms`
--

CREATE TABLE `tblestimate_request_forms` (
  `id` int(10) UNSIGNED NOT NULL,
  `form_key` varchar(32) NOT NULL,
  `type` varchar(100) NOT NULL,
  `name` varchar(191) NOT NULL,
  `form_data` longtext DEFAULT NULL,
  `recaptcha` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `submit_btn_name` varchar(100) DEFAULT NULL,
  `submit_btn_bg_color` varchar(10) DEFAULT '#84c529',
  `submit_btn_text_color` varchar(10) DEFAULT '#ffffff',
  `success_submit_msg` mediumtext DEFAULT NULL,
  `submit_action` int(11) DEFAULT 0,
  `submit_redirect_url` longtext DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `dateadded` datetime DEFAULT NULL,
  `notify_type` varchar(100) DEFAULT NULL,
  `notify_ids` longtext DEFAULT NULL,
  `responsible` int(11) DEFAULT NULL,
  `notify_request_submitted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblestimate_request_status`
--

CREATE TABLE `tblestimate_request_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `statusorder` int(11) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `flag` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblestimate_request_status`
--

INSERT INTO `tblestimate_request_status` (`id`, `name`, `statusorder`, `color`, `flag`) VALUES
(1, 'Cancelled', 1, '#808080', 'cancelled'),
(2, 'Processing', 2, '#007bff', 'processing'),
(3, 'Completed', 3, '#28a745', 'completed');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblevents`
--

CREATE TABLE `tblevents` (
  `eventid` int(11) NOT NULL,
  `title` longtext NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `public` int(11) NOT NULL DEFAULT 0,
  `color` varchar(10) DEFAULT NULL,
  `isstartnotified` tinyint(1) NOT NULL DEFAULT 0,
  `reminder_before` int(11) NOT NULL DEFAULT 0,
  `reminder_before_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblexpenses`
--

CREATE TABLE `tblexpenses` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `currency` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `tax` int(11) DEFAULT NULL,
  `tax2` int(11) NOT NULL DEFAULT 0,
  `reference_no` varchar(100) DEFAULT NULL,
  `note` mediumtext DEFAULT NULL,
  `expense_name` varchar(191) DEFAULT NULL,
  `clientid` int(11) NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `billable` int(11) DEFAULT 0,
  `invoiceid` int(11) DEFAULT NULL,
  `paymentmode` varchar(50) DEFAULT NULL,
  `date` date NOT NULL,
  `recurring_type` varchar(10) DEFAULT NULL,
  `repeat_every` int(11) DEFAULT NULL,
  `recurring` int(11) NOT NULL DEFAULT 0,
  `cycles` int(11) NOT NULL DEFAULT 0,
  `total_cycles` int(11) NOT NULL DEFAULT 0,
  `custom_recurring` int(11) NOT NULL DEFAULT 0,
  `last_recurring_date` date DEFAULT NULL,
  `create_invoice_billable` tinyint(1) DEFAULT NULL,
  `send_invoice_to_customer` tinyint(1) NOT NULL,
  `recurring_from` int(11) DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `addedfrom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblexpenses_categories`
--

CREATE TABLE `tblexpenses_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfiles`
--

CREATE TABLE `tblfiles` (
  `id` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) NOT NULL,
  `file_name` varchar(191) NOT NULL,
  `filetype` varchar(40) DEFAULT NULL,
  `visible_to_customer` int(11) NOT NULL DEFAULT 0,
  `attachment_key` varchar(32) DEFAULT NULL,
  `external` varchar(40) DEFAULT NULL,
  `external_link` mediumtext DEFAULT NULL,
  `thumbnail_link` mediumtext DEFAULT NULL COMMENT 'For external usage',
  `staffid` int(11) NOT NULL,
  `contact_id` int(11) DEFAULT 0,
  `task_comment_id` int(11) NOT NULL DEFAULT 0,
  `dateadded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfilters`
--

CREATE TABLE `tblfilters` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `builder` mediumtext NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `identifier` varchar(191) NOT NULL,
  `is_shared` tinyint(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfilter_defaults`
--

CREATE TABLE `tblfilter_defaults` (
  `filter_id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(11) NOT NULL,
  `identifier` varchar(191) NOT NULL,
  `view` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblform_questions`
--

CREATE TABLE `tblform_questions` (
  `questionid` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) DEFAULT NULL,
  `question` longtext NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `question_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblform_question_box`
--

CREATE TABLE `tblform_question_box` (
  `boxid` int(11) NOT NULL,
  `boxtype` varchar(10) NOT NULL,
  `questionid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblform_question_box_description`
--

CREATE TABLE `tblform_question_box_description` (
  `questionboxdescriptionid` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `boxid` longtext NOT NULL,
  `questionid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblform_results`
--

CREATE TABLE `tblform_results` (
  `resultid` int(11) NOT NULL,
  `boxid` int(11) NOT NULL,
  `boxdescriptionid` int(11) DEFAULT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) DEFAULT NULL,
  `questionid` int(11) NOT NULL,
  `answer` mediumtext DEFAULT NULL,
  `resultsetid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblgdpr_requests`
--

CREATE TABLE `tblgdpr_requests` (
  `id` int(11) NOT NULL,
  `clientid` int(11) NOT NULL DEFAULT 0,
  `contact_id` int(11) NOT NULL DEFAULT 0,
  `lead_id` int(11) NOT NULL DEFAULT 0,
  `request_type` varchar(191) DEFAULT NULL,
  `status` varchar(40) DEFAULT NULL,
  `request_date` datetime NOT NULL,
  `request_from` varchar(150) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblinvoicepaymentrecords`
--

CREATE TABLE `tblinvoicepaymentrecords` (
  `id` int(11) NOT NULL,
  `invoiceid` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `paymentmode` varchar(40) DEFAULT NULL,
  `paymentmethod` varchar(191) DEFAULT NULL,
  `date` date NOT NULL,
  `daterecorded` datetime NOT NULL,
  `note` mediumtext DEFAULT NULL,
  `transactionid` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblinvoices`
--

CREATE TABLE `tblinvoices` (
  `id` int(11) NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT 0,
  `datesend` datetime DEFAULT NULL,
  `clientid` int(11) NOT NULL,
  `deleted_customer_name` varchar(100) DEFAULT NULL,
  `number` int(11) NOT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `number_format` int(11) NOT NULL DEFAULT 0,
  `formatted_number` varchar(100) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `date` date NOT NULL,
  `duedate` date DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `total_tax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total` decimal(15,2) NOT NULL,
  `adjustment` decimal(15,2) DEFAULT NULL,
  `addedfrom` int(11) DEFAULT NULL,
  `hash` varchar(32) NOT NULL,
  `status` int(11) DEFAULT 1,
  `clientnote` mediumtext DEFAULT NULL,
  `adminnote` mediumtext DEFAULT NULL,
  `last_overdue_reminder` date DEFAULT NULL,
  `last_due_reminder` date DEFAULT NULL,
  `cancel_overdue_reminders` int(11) NOT NULL DEFAULT 0,
  `allowed_payment_modes` longtext DEFAULT NULL,
  `token` longtext DEFAULT NULL,
  `discount_percent` decimal(15,2) DEFAULT 0.00,
  `discount_total` decimal(15,2) DEFAULT 0.00,
  `discount_type` varchar(30) NOT NULL,
  `recurring` int(11) NOT NULL DEFAULT 0,
  `recurring_type` varchar(10) DEFAULT NULL,
  `custom_recurring` tinyint(1) NOT NULL DEFAULT 0,
  `cycles` int(11) NOT NULL DEFAULT 0,
  `total_cycles` int(11) NOT NULL DEFAULT 0,
  `is_recurring_from` int(11) DEFAULT NULL,
  `last_recurring_date` date DEFAULT NULL,
  `terms` mediumtext DEFAULT NULL,
  `sale_agent` int(11) NOT NULL DEFAULT 0,
  `billing_street` varchar(200) DEFAULT NULL,
  `billing_city` varchar(100) DEFAULT NULL,
  `billing_state` varchar(100) DEFAULT NULL,
  `billing_zip` varchar(100) DEFAULT NULL,
  `billing_country` int(11) DEFAULT NULL,
  `shipping_street` varchar(200) DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_state` varchar(100) DEFAULT NULL,
  `shipping_zip` varchar(100) DEFAULT NULL,
  `shipping_country` int(11) DEFAULT NULL,
  `include_shipping` tinyint(1) NOT NULL,
  `show_shipping_on_invoice` tinyint(1) NOT NULL DEFAULT 1,
  `show_quantity_as` int(11) NOT NULL DEFAULT 1,
  `project_id` int(11) DEFAULT 0,
  `subscription_id` int(11) NOT NULL DEFAULT 0,
  `short_link` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblitemable`
--

CREATE TABLE `tblitemable` (
  `id` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(15) NOT NULL,
  `description` longtext NOT NULL,
  `long_description` longtext DEFAULT NULL,
  `qty` decimal(15,2) NOT NULL,
  `rate` decimal(15,2) NOT NULL,
  `unit` varchar(40) DEFAULT NULL,
  `item_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblitems`
--

CREATE TABLE `tblitems` (
  `id` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `long_description` mediumtext DEFAULT NULL,
  `rate` decimal(15,2) NOT NULL,
  `tax` int(11) DEFAULT NULL,
  `tax2` int(11) DEFAULT NULL,
  `unit` varchar(40) DEFAULT NULL,
  `group_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblitems_groups`
--

CREATE TABLE `tblitems_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblitem_tax`
--

CREATE TABLE `tblitem_tax` (
  `id` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) NOT NULL,
  `taxrate` decimal(15,2) NOT NULL,
  `taxname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblknowedge_base_article_feedback`
--

CREATE TABLE `tblknowedge_base_article_feedback` (
  `articleanswerid` int(11) NOT NULL,
  `articleid` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblknowledge_base`
--

CREATE TABLE `tblknowledge_base` (
  `articleid` int(11) NOT NULL,
  `articlegroup` int(11) NOT NULL,
  `subject` longtext NOT NULL,
  `description` mediumtext NOT NULL,
  `slug` longtext NOT NULL,
  `active` tinyint(4) NOT NULL,
  `datecreated` datetime NOT NULL,
  `article_order` int(11) NOT NULL DEFAULT 0,
  `staff_article` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblknowledge_base_groups`
--

CREATE TABLE `tblknowledge_base_groups` (
  `groupid` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `group_slug` mediumtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `color` varchar(10) DEFAULT '#28B8DA',
  `group_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblleads`
--

CREATE TABLE `tblleads` (
  `id` int(11) NOT NULL,
  `hash` varchar(65) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `company` varchar(191) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `country` int(11) NOT NULL DEFAULT 0,
  `zip` varchar(15) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `assigned` int(11) NOT NULL DEFAULT 0,
  `dateadded` datetime NOT NULL,
  `from_form_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `lastcontact` datetime DEFAULT NULL,
  `dateassigned` date DEFAULT NULL,
  `last_status_change` datetime DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `leadorder` int(11) DEFAULT 1,
  `phonenumber` varchar(50) DEFAULT NULL,
  `date_converted` datetime DEFAULT NULL,
  `lost` tinyint(1) NOT NULL DEFAULT 0,
  `junk` int(11) NOT NULL DEFAULT 0,
  `last_lead_status` int(11) NOT NULL DEFAULT 0,
  `is_imported_from_email_integration` tinyint(1) NOT NULL DEFAULT 0,
  `email_integration_uid` varchar(30) DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 0,
  `default_language` varchar(40) DEFAULT NULL,
  `client_id` int(11) NOT NULL DEFAULT 0,
  `lead_value` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblleads_email_integration`
--

CREATE TABLE `tblleads_email_integration` (
  `id` int(11) NOT NULL COMMENT 'the ID always must be 1',
  `active` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `imap_server` varchar(100) NOT NULL,
  `password` longtext NOT NULL,
  `check_every` int(11) NOT NULL DEFAULT 5,
  `responsible` int(11) NOT NULL,
  `lead_source` int(11) NOT NULL,
  `lead_status` int(11) NOT NULL,
  `encryption` varchar(3) DEFAULT NULL,
  `folder` varchar(100) NOT NULL,
  `last_run` varchar(50) DEFAULT NULL,
  `notify_lead_imported` tinyint(1) NOT NULL DEFAULT 1,
  `notify_lead_contact_more_times` tinyint(1) NOT NULL DEFAULT 1,
  `notify_type` varchar(20) DEFAULT NULL,
  `notify_ids` longtext DEFAULT NULL,
  `mark_public` int(11) NOT NULL DEFAULT 0,
  `only_loop_on_unseen_emails` tinyint(1) NOT NULL DEFAULT 1,
  `delete_after_import` int(11) NOT NULL DEFAULT 0,
  `create_task_if_customer` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblleads_email_integration`
--

INSERT INTO `tblleads_email_integration` (`id`, `active`, `email`, `imap_server`, `password`, `check_every`, `responsible`, `lead_source`, `lead_status`, `encryption`, `folder`, `last_run`, `notify_lead_imported`, `notify_lead_contact_more_times`, `notify_type`, `notify_ids`, `mark_public`, `only_loop_on_unseen_emails`, `delete_after_import`, `create_task_if_customer`) VALUES
(1, 0, '', '', '', 10, 0, 0, 0, 'tls', 'INBOX', '', 1, 1, 'assigned', '', 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblleads_sources`
--

CREATE TABLE `tblleads_sources` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblleads_sources`
--

INSERT INTO `tblleads_sources` (`id`, `name`) VALUES
(2, 'Facebook'),
(1, 'Google');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblleads_status`
--

CREATE TABLE `tblleads_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `statusorder` int(11) DEFAULT NULL,
  `color` varchar(10) DEFAULT '#28B8DA',
  `isdefault` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblleads_status`
--

INSERT INTO `tblleads_status` (`id`, `name`, `statusorder`, `color`, `isdefault`) VALUES
(1, 'Customer', 1000, '#7cb342', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbllead_activity_log`
--

CREATE TABLE `tbllead_activity_log` (
  `id` int(11) NOT NULL,
  `leadid` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `additional_data` mediumtext DEFAULT NULL,
  `date` datetime NOT NULL,
  `staffid` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `custom_activity` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbllead_integration_emails`
--

CREATE TABLE `tbllead_integration_emails` (
  `id` int(11) NOT NULL,
  `subject` longtext DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `leadid` int(11) NOT NULL,
  `emailid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblmail_queue`
--

CREATE TABLE `tblmail_queue` (
  `id` int(11) NOT NULL,
  `engine` varchar(40) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `cc` mediumtext DEFAULT NULL,
  `bcc` mediumtext DEFAULT NULL,
  `message` longtext NOT NULL,
  `alt_message` longtext DEFAULT NULL,
  `status` enum('pending','sending','sent','failed') DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `headers` mediumtext DEFAULT NULL,
  `attachments` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblmigrations`
--

CREATE TABLE `tblmigrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblmigrations`
--

INSERT INTO `tblmigrations` (`version`) VALUES
(321);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblmilestones`
--

CREATE TABLE `tblmilestones` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `description_visible_to_customer` tinyint(1) DEFAULT 0,
  `start_date` date DEFAULT NULL,
  `due_date` date NOT NULL,
  `project_id` int(11) NOT NULL,
  `color` varchar(10) DEFAULT NULL,
  `milestone_order` int(11) NOT NULL DEFAULT 0,
  `datecreated` date NOT NULL,
  `hide_from_customer` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblmodules`
--

CREATE TABLE `tblmodules` (
  `id` int(11) NOT NULL,
  `module_name` varchar(55) NOT NULL,
  `installed_version` varchar(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblnewsfeed_comment_likes`
--

CREATE TABLE `tblnewsfeed_comment_likes` (
  `id` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dateliked` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblnewsfeed_posts`
--

CREATE TABLE `tblnewsfeed_posts` (
  `postid` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `visibility` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `pinned` int(11) NOT NULL,
  `datepinned` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblnewsfeed_post_comments`
--

CREATE TABLE `tblnewsfeed_post_comments` (
  `id` int(11) NOT NULL,
  `content` mediumtext DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `dateadded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblnewsfeed_post_likes`
--

CREATE TABLE `tblnewsfeed_post_likes` (
  `id` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dateliked` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblnotes`
--

CREATE TABLE `tblnotes` (
  `id` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `date_contacted` datetime DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `dateadded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblnotifications`
--

CREATE TABLE `tblnotifications` (
  `id` int(11) NOT NULL,
  `isread` int(11) NOT NULL DEFAULT 0,
  `isread_inline` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL,
  `description` mediumtext NOT NULL,
  `fromuserid` int(11) NOT NULL,
  `fromclientid` int(11) NOT NULL DEFAULT 0,
  `from_fullname` varchar(100) NOT NULL,
  `touserid` int(11) NOT NULL,
  `fromcompany` int(11) DEFAULT NULL,
  `link` longtext DEFAULT NULL,
  `additional_data` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbloptions`
--

CREATE TABLE `tbloptions` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `value` longtext NOT NULL,
  `autoload` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbloptions`
--

INSERT INTO `tbloptions` (`id`, `name`, `value`, `autoload`) VALUES
(1, 'dateformat', 'Y-m-d|%Y-%m-%d', 1),
(2, 'companyname', '', 1),
(3, 'services', '1', 1),
(4, 'maximum_allowed_ticket_attachments', '4', 1),
(5, 'ticket_attachments_file_extensions', '.jpg,.jpeg,.png,.pdf,.doc,.zip,.rar', 1),
(6, 'staff_access_only_assigned_departments', '1', 1),
(7, 'use_knowledge_base', '1', 1),
(8, 'smtp_email', '', 1),
(9, 'smtp_password', '', 1),
(10, 'company_info_format', '{company_name}<br />\r\n      {address}<br />\r\n      {city} {state}<br />\r\n      {country_code} {zip_code}<br />\r\n      {vat_number_with_label}', 0),
(11, 'smtp_port', '', 1),
(12, 'smtp_host', '', 1),
(13, 'smtp_email_charset', 'utf-8', 1),
(14, 'default_timezone', 'Asia/Ho_Chi_Minh', 1),
(15, 'clients_default_theme', 'perfex', 1),
(16, 'company_logo', '', 1),
(17, 'tables_pagination_limit', '25', 1),
(18, 'main_domain', '', 1),
(19, 'allow_registration', '0', 1),
(20, 'knowledge_base_without_registration', '1', 1),
(21, 'email_signature', '', 1),
(22, 'default_staff_role', '1', 1),
(23, 'newsfeed_maximum_files_upload', '10', 1),
(24, 'contract_expiration_before', '4', 1),
(25, 'invoice_prefix', 'INV-', 1),
(26, 'decimal_separator', '.', 1),
(27, 'thousand_separator', ',', 1),
(28, 'invoice_company_name', '', 1),
(29, 'invoice_company_address', '', 1),
(30, 'invoice_company_city', '', 1),
(31, 'invoice_company_country_code', '', 1),
(32, 'invoice_company_postal_code', '', 1),
(33, 'invoice_company_phonenumber', '', 1),
(34, 'view_invoice_only_logged_in', '0', 1),
(35, 'invoice_number_format', '1', 1),
(36, 'next_invoice_number', '1', 0),
(37, 'active_language', 'english', 1),
(38, 'invoice_number_decrement_on_delete', '1', 1),
(39, 'automatically_send_invoice_overdue_reminder_after', '1', 1),
(40, 'automatically_resend_invoice_overdue_reminder_after', '3', 1),
(41, 'expenses_auto_operations_hour', '9', 1),
(42, 'delete_only_on_last_invoice', '1', 1),
(43, 'delete_only_on_last_estimate', '1', 1),
(44, 'create_invoice_from_recurring_only_on_paid_invoices', '0', 1),
(45, 'allow_payment_amount_to_be_modified', '1', 1),
(46, 'rtl_support_client', '0', 1),
(47, 'limit_top_search_bar_results_to', '10', 1),
(48, 'estimate_prefix', 'EST-', 1),
(49, 'next_estimate_number', '1', 0),
(50, 'estimate_number_decrement_on_delete', '1', 1),
(51, 'estimate_number_format', '1', 1),
(52, 'estimate_auto_convert_to_invoice_on_client_accept', '1', 1),
(53, 'exclude_estimate_from_client_area_with_draft_status', '1', 1),
(54, 'rtl_support_admin', '0', 1),
(55, 'last_cron_run', '', 1),
(56, 'show_sale_agent_on_estimates', '1', 1),
(57, 'show_sale_agent_on_invoices', '1', 1),
(58, 'predefined_terms_invoice', '', 1),
(59, 'predefined_terms_estimate', '', 1),
(60, 'default_task_priority', '2', 1),
(61, 'dropbox_app_key', '', 1),
(62, 'show_expense_reminders_on_calendar', '1', 1),
(63, 'only_show_contact_tickets', '1', 1),
(64, 'predefined_clientnote_invoice', '', 1),
(65, 'predefined_clientnote_estimate', '', 1),
(66, 'custom_pdf_logo_image_url', '', 1),
(67, 'favicon', '', 1),
(68, 'invoice_due_after', '30', 1),
(69, 'google_api_key', '', 1),
(70, 'google_calendar_main_calendar', '', 1),
(71, 'default_tax', 'a:0:{}', 1),
(72, 'show_invoices_on_calendar', '1', 1),
(73, 'show_estimates_on_calendar', '1', 1),
(74, 'show_contracts_on_calendar', '1', 1),
(75, 'show_tasks_on_calendar', '1', 1),
(76, 'show_customer_reminders_on_calendar', '1', 1),
(77, 'output_client_pdfs_from_admin_area_in_client_language', '0', 1),
(78, 'show_lead_reminders_on_calendar', '1', 1),
(79, 'send_estimate_expiry_reminder_before', '4', 1),
(80, 'leads_default_source', '', 1),
(81, 'leads_default_status', '', 1),
(82, 'proposal_expiry_reminder_enabled', '1', 1),
(83, 'send_proposal_expiry_reminder_before', '4', 1),
(84, 'default_contact_permissions', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:1:\"5\";i:5;s:1:\"6\";}', 1),
(85, 'pdf_logo_width', '150', 1),
(86, 'access_tickets_to_none_staff_members', '0', 1),
(87, 'customer_default_country', '', 1),
(88, 'view_estimate_only_logged_in', '0', 1),
(89, 'show_status_on_pdf_ei', '1', 1),
(90, 'email_piping_only_replies', '0', 1),
(91, 'email_piping_only_registered', '0', 1),
(92, 'default_view_calendar', 'dayGridMonth', 1),
(93, 'email_piping_default_priority', '2', 1),
(94, 'total_to_words_lowercase', '0', 1),
(95, 'show_tax_per_item', '1', 1),
(96, 'total_to_words_enabled', '0', 1),
(97, 'receive_notification_on_new_ticket', '1', 0),
(98, 'autoclose_tickets_after', '0', 1),
(99, 'media_max_file_size_upload', '10', 1),
(100, 'client_staff_add_edit_delete_task_comments_first_hour', '0', 1),
(101, 'show_projects_on_calendar', '1', 1),
(102, 'leads_kanban_limit', '50', 1),
(103, 'tasks_reminder_notification_before', '2', 1),
(104, 'pdf_font', 'freesans', 1),
(105, 'pdf_table_heading_color', '#e5e7eb', 1),
(106, 'pdf_table_heading_text_color', '#030712', 1),
(107, 'pdf_font_size', '10', 1),
(108, 'default_leads_kanban_sort', 'leadorder', 1),
(109, 'default_leads_kanban_sort_type', 'asc', 1),
(110, 'allowed_files', '.png,.jpg,.jpeg,.pdf,.doc,.docx,.xls,.xlsx,.zip,.rar,.txt', 1),
(111, 'show_all_tasks_for_project_member', '1', 1),
(112, 'email_protocol', 'smtp', 1),
(113, 'calendar_first_day', '0', 1),
(114, 'recaptcha_secret_key', '', 1),
(115, 'show_help_on_setup_menu', '1', 1),
(116, 'show_proposals_on_calendar', '1', 1),
(117, 'smtp_encryption', '', 1),
(118, 'recaptcha_site_key', '', 1),
(119, 'smtp_username', '', 1),
(120, 'auto_stop_tasks_timers_on_new_timer', '1', 1),
(121, 'notification_when_customer_pay_invoice', '1', 1),
(122, 'calendar_invoice_color', '#FF6F00', 1),
(123, 'calendar_estimate_color', '#FF6F00', 1),
(124, 'calendar_proposal_color', '#84c529', 1),
(125, 'new_task_auto_assign_current_member', '1', 1),
(126, 'calendar_reminder_color', '#03A9F4', 1),
(127, 'calendar_contract_color', '#B72974', 1),
(128, 'calendar_project_color', '#B72974', 1),
(129, 'update_info_message', '', 1),
(130, 'show_estimate_reminders_on_calendar', '1', 1),
(131, 'show_invoice_reminders_on_calendar', '1', 1),
(132, 'show_proposal_reminders_on_calendar', '1', 1),
(133, 'proposal_due_after', '7', 1),
(134, 'allow_customer_to_change_ticket_status', '0', 1),
(135, 'lead_lock_after_convert_to_customer', '0', 1),
(136, 'default_proposals_pipeline_sort', 'pipeline_order', 1),
(137, 'default_proposals_pipeline_sort_type', 'asc', 1),
(138, 'default_estimates_pipeline_sort', 'pipeline_order', 1),
(139, 'default_estimates_pipeline_sort_type', 'asc', 1),
(140, 'use_recaptcha_customers_area', '0', 1),
(141, 'remove_decimals_on_zero', '0', 1),
(142, 'remove_tax_name_from_item_table', '0', 1),
(143, 'pdf_format_invoice', 'A4-PORTRAIT', 1),
(144, 'pdf_format_estimate', 'A4-PORTRAIT', 1),
(145, 'pdf_format_proposal', 'A4-PORTRAIT', 1),
(146, 'pdf_format_payment', 'A4-PORTRAIT', 1),
(147, 'pdf_format_contract', 'A4-PORTRAIT', 1),
(148, 'swap_pdf_info', '0', 1),
(149, 'exclude_invoice_from_client_area_with_draft_status', '1', 1),
(150, 'cron_has_run_from_cli', '0', 1),
(151, 'hide_cron_is_required_message', '0', 0),
(152, 'auto_assign_customer_admin_after_lead_convert', '1', 1),
(153, 'show_transactions_on_invoice_pdf', '1', 1),
(154, 'show_pay_link_to_invoice_pdf', '1', 1),
(155, 'tasks_kanban_limit', '50', 1),
(156, 'purchase_key', '', 1),
(157, 'estimates_pipeline_limit', '50', 1),
(158, 'proposals_pipeline_limit', '50', 1),
(159, 'proposal_number_prefix', 'PRO-', 1),
(160, 'number_padding_prefixes', '6', 1),
(161, 'show_page_number_on_pdf', '0', 1),
(162, 'calendar_events_limit', '4', 1),
(163, 'show_setup_menu_item_only_on_hover', '0', 1),
(164, 'company_requires_vat_number_field', '1', 1),
(165, 'company_is_required', '1', 1),
(166, 'allow_contact_to_delete_files', '0', 1),
(167, 'company_vat', '', 1),
(168, 'di', '1734861798', 1),
(169, 'invoice_auto_operations_hour', '21', 1),
(170, 'use_minified_files', '1', 1),
(171, 'only_own_files_contacts', '0', 1),
(172, 'allow_primary_contact_to_view_edit_billing_and_shipping', '0', 1),
(173, 'estimate_due_after', '7', 1),
(174, 'staff_members_open_tickets_to_all_contacts', '1', 1),
(175, 'time_format', '24', 1),
(176, 'delete_activity_log_older_then', '1', 1),
(177, 'disable_language', '0', 1),
(178, 'company_state', '', 1),
(179, 'email_header', '<!doctype html>\r\n      <html>\r\n      <head>\r\n      <meta name=\"viewport\" content=\"width=device-width\" />\r\n      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\r\n      <style>\r\n      body {\r\n        background-color: #f6f6f6;\r\n        font-family: sans-serif;\r\n        -webkit-font-smoothing: antialiased;\r\n        font-size: 14px;\r\n        line-height: 1.4;\r\n        margin: 0;\r\n        padding: 0;\r\n        -ms-text-size-adjust: 100%;\r\n        -webkit-text-size-adjust: 100%;\r\n      }\r\n      table {\r\n        border-collapse: separate;\r\n        mso-table-lspace: 0pt;\r\n        mso-table-rspace: 0pt;\r\n        width: 100%;\r\n      }\r\n      table td {\r\n        font-family: sans-serif;\r\n        font-size: 14px;\r\n        vertical-align: top;\r\n      }\r\n      /* -------------------------------------\r\n      BODY & CONTAINER\r\n      ------------------------------------- */\r\n      .body {\r\n        background-color: #f6f6f6;\r\n        width: 100%;\r\n      }\r\n      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */\r\n      \r\n      .container {\r\n        display: block;\r\n        margin: 0 auto !important;\r\n        /* makes it centered */\r\n        max-width: 680px;\r\n        padding: 10px;\r\n        width: 680px;\r\n      }\r\n      /* This should also be a block element, so that it will fill 100% of the .container */\r\n      \r\n      .content {\r\n        box-sizing: border-box;\r\n        display: block;\r\n        margin: 0 auto;\r\n        max-width: 680px;\r\n        padding: 10px;\r\n      }\r\n      /* -------------------------------------\r\n      HEADER, FOOTER, MAIN\r\n      ------------------------------------- */\r\n      \r\n      .main {\r\n        background: #fff;\r\n        border-radius: 3px;\r\n        width: 100%;\r\n      }\r\n      .wrapper {\r\n        box-sizing: border-box;\r\n        padding: 20px;\r\n      }\r\n      .footer {\r\n        clear: both;\r\n        padding-top: 10px;\r\n        text-align: center;\r\n        width: 100%;\r\n      }\r\n      .footer td,\r\n      .footer p,\r\n      .footer span,\r\n      .footer a {\r\n        color: #999999;\r\n        font-size: 12px;\r\n        text-align: center;\r\n      }\r\n      hr {\r\n        border: 0;\r\n        border-bottom: 1px solid #f6f6f6;\r\n        margin: 20px 0;\r\n      }\r\n      /* -------------------------------------\r\n      RESPONSIVE AND MOBILE FRIENDLY STYLES\r\n      ------------------------------------- */\r\n      \r\n      @media only screen and (max-width: 620px) {\r\n        table[class=body] .content {\r\n          padding: 0 !important;\r\n        }\r\n        table[class=body] .container {\r\n          padding: 0 !important;\r\n          width: 100% !important;\r\n        }\r\n        table[class=body] .main {\r\n          border-left-width: 0 !important;\r\n          border-radius: 0 !important;\r\n          border-right-width: 0 !important;\r\n        }\r\n      }\r\n      </style>\r\n      </head>\r\n      <body class=\"\">\r\n      <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"body\">\r\n      <tr>\r\n      <td>&nbsp;</td>\r\n      <td class=\"container\">\r\n      <div class=\"content\">\r\n      <!-- START CENTERED WHITE CONTAINER -->\r\n      <table class=\"main\">\r\n      <!-- START MAIN CONTENT AREA -->\r\n      <tr>\r\n      <td class=\"wrapper\">\r\n      <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n      <tr>\r\n      <td>', 1),
(180, 'show_pdf_signature_invoice', '1', 0),
(181, 'show_pdf_signature_estimate', '1', 0),
(182, 'signature_image', '', 0),
(183, 'email_footer', '</td>\r\n      </tr>\r\n      </table>\r\n      </td>\r\n      </tr>\r\n      <!-- END MAIN CONTENT AREA -->\r\n      </table>\r\n      <!-- START FOOTER -->\r\n      <div class=\"footer\">\r\n      <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n      <tr>\r\n      <td class=\"content-block\">\r\n      <span>{companyname}</span>\r\n      </td>\r\n      </tr>\r\n      </table>\r\n      </div>\r\n      <!-- END FOOTER -->\r\n      <!-- END CENTERED WHITE CONTAINER -->\r\n      </div>\r\n      </td>\r\n      <td>&nbsp;</td>\r\n      </tr>\r\n      </table>\r\n      </body>\r\n      </html>', 1),
(184, 'exclude_proposal_from_client_area_with_draft_status', '1', 1),
(185, 'pusher_app_key', '', 1),
(186, 'pusher_app_secret', '', 1),
(187, 'pusher_app_id', '', 1),
(188, 'pusher_realtime_notifications', '0', 1),
(189, 'pdf_format_statement', 'A4-PORTRAIT', 1),
(190, 'pusher_cluster', '', 1),
(191, 'show_table_export_button', 'to_all', 1),
(192, 'allow_staff_view_proposals_assigned', '1', 1),
(193, 'show_cloudflare_notice', '1', 0),
(194, 'task_modal_class', 'modal-lg', 1),
(195, 'lead_modal_class', 'modal-lg', 1),
(196, 'show_timesheets_overview_all_members_notice_admins', '0', 1),
(197, 'desktop_notifications', '0', 1),
(198, 'hide_notified_reminders_from_calendar', '1', 0),
(199, 'customer_info_format', '{company_name}<br />\r\n      {street}<br />\r\n      {city} {state}<br />\r\n      {country_code} {zip_code}<br />\r\n      {vat_number_with_label}', 0),
(200, 'timer_started_change_status_in_progress', '1', 0),
(201, 'default_ticket_reply_status', '3', 1),
(202, 'default_task_status', 'auto', 1),
(203, 'email_queue_skip_with_attachments', '1', 1),
(204, 'email_queue_enabled', '0', 1),
(205, 'last_email_queue_retry', '', 1),
(206, 'auto_dismiss_desktop_notifications_after', '0', 1),
(207, 'proposal_info_format', '{proposal_to}<br />\r\n      {address}<br />\r\n      {city} {state}<br />\r\n      {country_code} {zip_code}<br />\r\n      {phone}<br />\r\n      {email}', 0),
(208, 'ticket_replies_order', 'desc', 1),
(209, 'new_recurring_invoice_action', 'generate_and_send', 0),
(210, 'bcc_emails', '', 0),
(211, 'email_templates_language_checks', '', 0),
(212, 'proposal_accept_identity_confirmation', '1', 0),
(213, 'estimate_accept_identity_confirmation', '1', 0),
(214, 'new_task_auto_follower_current_member', '0', 1),
(215, 'task_biillable_checked_on_creation', '1', 1),
(216, 'predefined_clientnote_credit_note', '', 1),
(217, 'predefined_terms_credit_note', '', 1),
(218, 'next_credit_note_number', '1', 1),
(219, 'credit_note_prefix', 'CN-', 1),
(220, 'credit_note_number_decrement_on_delete', '1', 1),
(221, 'pdf_format_credit_note', 'A4-PORTRAIT', 1),
(222, 'show_pdf_signature_credit_note', '1', 0),
(223, 'show_credit_note_reminders_on_calendar', '1', 1),
(224, 'show_amount_due_on_invoice', '1', 1),
(225, 'show_total_paid_on_invoice', '1', 1),
(226, 'show_credits_applied_on_invoice', '1', 1),
(227, 'staff_members_create_inline_lead_status', '1', 1),
(228, 'staff_members_create_inline_customer_groups', '1', 1),
(229, 'staff_members_create_inline_ticket_services', '1', 1),
(230, 'staff_members_save_tickets_predefined_replies', '1', 1),
(231, 'staff_members_create_inline_contract_types', '1', 1),
(232, 'staff_members_create_inline_expense_categories', '1', 1),
(233, 'show_project_on_credit_note', '1', 1),
(234, 'proposals_auto_operations_hour', '9', 1),
(235, 'estimates_auto_operations_hour', '9', 1),
(236, 'contracts_auto_operations_hour', '9', 1),
(237, 'credit_note_number_format', '1', 1),
(238, 'allow_non_admin_members_to_import_leads', '0', 1),
(239, 'e_sign_legal_text', 'By clicking on \"Sign\", I consent to be legally bound by this electronic representation of my signature.', 1),
(240, 'show_pdf_signature_contract', '1', 1),
(241, 'view_contract_only_logged_in', '0', 1),
(242, 'show_subscriptions_in_customers_area', '1', 1),
(243, 'calendar_only_assigned_tasks', '0', 1),
(244, 'after_subscription_payment_captured', 'send_invoice_and_receipt', 1),
(245, 'mail_engine', 'phpmailer', 1),
(246, 'gdpr_enable_terms_and_conditions', '0', 1),
(247, 'privacy_policy', '', 1),
(248, 'terms_and_conditions', '', 1),
(249, 'gdpr_enable_terms_and_conditions_lead_form', '0', 1),
(250, 'gdpr_enable_terms_and_conditions_ticket_form', '0', 1),
(251, 'gdpr_contact_enable_right_to_be_forgotten', '0', 1),
(252, 'show_gdpr_in_customers_menu', '1', 1),
(253, 'show_gdpr_link_in_footer', '1', 1),
(254, 'enable_gdpr', '0', 1),
(255, 'gdpr_on_forgotten_remove_invoices_credit_notes', '0', 1),
(256, 'gdpr_on_forgotten_remove_estimates', '0', 1),
(257, 'gdpr_enable_consent_for_contacts', '0', 1),
(258, 'gdpr_consent_public_page_top_block', '', 1),
(259, 'gdpr_page_top_information_block', '', 1),
(260, 'gdpr_enable_lead_public_form', '0', 1),
(261, 'gdpr_show_lead_custom_fields_on_public_form', '0', 1),
(262, 'gdpr_lead_attachments_on_public_form', '0', 1),
(263, 'gdpr_enable_consent_for_leads', '0', 1),
(264, 'gdpr_lead_enable_right_to_be_forgotten', '0', 1),
(265, 'allow_staff_view_invoices_assigned', '1', 1),
(266, 'gdpr_data_portability_leads', '0', 1),
(267, 'gdpr_lead_data_portability_allowed', '', 1),
(268, 'gdpr_contact_data_portability_allowed', '', 1),
(269, 'gdpr_data_portability_contacts', '0', 1),
(270, 'allow_staff_view_estimates_assigned', '1', 1),
(271, 'gdpr_after_lead_converted_delete', '0', 1),
(272, 'gdpr_show_terms_and_conditions_in_footer', '0', 1),
(273, 'save_last_order_for_tables', '0', 1),
(274, 'company_logo_dark', '', 1),
(275, 'customers_register_require_confirmation', '0', 1),
(276, 'allow_non_admin_staff_to_delete_ticket_attachments', '0', 1),
(277, 'receive_notification_on_new_ticket_replies', '1', 0),
(278, 'google_client_id', '', 1),
(279, 'enable_google_picker', '1', 1),
(280, 'show_ticket_reminders_on_calendar', '1', 1),
(281, 'ticket_import_reply_only', '0', 1),
(282, 'visible_customer_profile_tabs', 'all', 0),
(283, 'show_project_on_invoice', '1', 1),
(284, 'show_project_on_estimate', '1', 1),
(285, 'staff_members_create_inline_lead_source', '1', 1),
(286, 'lead_unique_validation', '[\"email\"]', 1),
(287, 'last_upgrade_copy_data', '', 1),
(288, 'custom_js_admin_scripts', '', 1),
(289, 'custom_js_customer_scripts', '0', 1),
(290, 'stripe_webhook_id', '', 1),
(291, 'stripe_webhook_signing_secret', '', 1),
(292, 'stripe_ideal_webhook_id', '', 1),
(293, 'stripe_ideal_webhook_signing_secret', '', 1),
(294, 'show_php_version_notice', '1', 0),
(295, 'recaptcha_ignore_ips', '', 1),
(296, 'show_task_reminders_on_calendar', '1', 1),
(297, 'customer_settings', 'true', 1),
(298, 'tasks_reminder_notification_hour', '9', 1),
(299, 'allow_primary_contact_to_manage_other_contacts', '0', 1),
(300, 'items_table_amounts_exclude_currency_symbol', '1', 1),
(301, 'round_off_task_timer_option', '0', 1),
(302, 'round_off_task_timer_time', '5', 1),
(303, 'bitly_access_token', '', 1),
(304, 'enable_support_menu_badges', '0', 1),
(305, 'attach_invoice_to_payment_receipt_email', '0', 1),
(306, 'invoice_due_notice_before', '2', 1),
(307, 'invoice_due_notice_resend_after', '0', 1),
(308, '_leads_settings', 'true', 1),
(309, 'show_estimate_request_in_customers_area', '0', 1),
(310, 'gdpr_enable_terms_and_conditions_estimate_request_form', '0', 1),
(311, 'identification_key', '26238623717348618346767e40a91901', 1),
(312, 'automatically_stop_task_timer_after_hours', '8', 1),
(313, 'automatically_assign_ticket_to_first_staff_responding', '0', 1),
(314, 'reminder_for_completed_but_not_billed_tasks', '0', 1),
(315, 'staff_notify_completed_but_not_billed_tasks', '', 1),
(316, 'reminder_for_completed_but_not_billed_tasks_days', '', 1),
(317, 'tasks_reminder_notification_last_notified_day', '', 1),
(318, 'staff_related_ticket_notification_to_assignee_only', '0', 1),
(319, 'show_pdf_signature_proposal', '1', 1),
(320, 'enable_honeypot_spam_validation', '0', 1),
(321, 'microsoft_mail_client_id', '', 1),
(322, 'microsoft_mail_client_secret', '', 1),
(323, 'microsoft_mail_azure_tenant_id', '', 1),
(324, 'google_mail_client_id', '', 1),
(325, 'google_mail_client_secret', '', 1),
(326, 'google_mail_refresh_token', '', 1),
(327, 'automatically_set_logged_in_staff_sales_agent', '1', 1),
(328, 'contract_sign_reminder_every_days', '0', 1),
(329, 'last_updated_date', '', 1),
(330, 'v310_incompatible_tables', '[]', 1),
(331, 'microsoft_mail_refresh_token', '', 1),
(332, 'required_register_fields', '[]', 0),
(333, 'allow_non_admin_members_to_delete_tickets_and_replies', '1', 1),
(334, 'proposal_auto_convert_to_invoice_on_client_accept', '0', 1),
(335, 'show_project_on_proposal', '1', 1),
(336, 'disable_ticket_public_url', '0', 1),
(337, 'upgraded_from_version', '', 0),
(338, 'sms_clickatell_api_key', '', 1),
(339, 'sms_clickatell_active', '0', 1),
(340, 'sms_clickatell_initialized', '1', 1),
(341, 'sms_msg91_sender_id', '', 1),
(342, 'sms_msg91_api_type', 'api', 1),
(343, 'sms_msg91_auth_key', '', 1),
(344, 'sms_msg91_active', '0', 1),
(345, 'sms_msg91_initialized', '1', 1),
(346, 'sms_twilio_account_sid', '', 1),
(347, 'sms_twilio_auth_token', '', 1),
(348, 'sms_twilio_phone_number', '', 1),
(349, 'sms_twilio_sender_id', '', 1),
(350, 'sms_twilio_active', '0', 1),
(351, 'sms_twilio_initialized', '1', 1),
(352, 'paymentmethod_authorize_acceptjs_active', '0', 1),
(353, 'paymentmethod_authorize_acceptjs_label', 'Authorize.net Accept.js', 1),
(354, 'paymentmethod_authorize_acceptjs_public_key', '', 0),
(355, 'paymentmethod_authorize_acceptjs_api_login_id', '', 0),
(356, 'paymentmethod_authorize_acceptjs_api_transaction_key', '', 0),
(357, 'paymentmethod_authorize_acceptjs_description_dashboard', 'Payment for Invoice {invoice_number}', 0),
(358, 'paymentmethod_authorize_acceptjs_currencies', 'USD', 0),
(359, 'paymentmethod_authorize_acceptjs_test_mode_enabled', '0', 0),
(360, 'paymentmethod_authorize_acceptjs_default_selected', '1', 1),
(361, 'paymentmethod_authorize_acceptjs_initialized', '1', 1),
(362, 'paymentmethod_instamojo_active', '0', 1),
(363, 'paymentmethod_instamojo_label', 'Instamojo', 1),
(364, 'paymentmethod_instamojo_fee_fixed', '0', 0),
(365, 'paymentmethod_instamojo_fee_percent', '0', 0),
(366, 'paymentmethod_instamojo_api_key', '', 0),
(367, 'paymentmethod_instamojo_auth_token', '', 0),
(368, 'paymentmethod_instamojo_description_dashboard', 'Payment for Invoice {invoice_number}', 0),
(369, 'paymentmethod_instamojo_currencies', 'INR', 0),
(370, 'paymentmethod_instamojo_test_mode_enabled', '1', 0),
(371, 'paymentmethod_instamojo_default_selected', '1', 1),
(372, 'paymentmethod_instamojo_initialized', '1', 1),
(373, 'paymentmethod_mollie_active', '0', 1),
(374, 'paymentmethod_mollie_label', 'Mollie', 1),
(375, 'paymentmethod_mollie_api_key', '', 0),
(376, 'paymentmethod_mollie_description_dashboard', 'Payment for Invoice {invoice_number}', 0),
(377, 'paymentmethod_mollie_currencies', 'EUR', 0),
(378, 'paymentmethod_mollie_test_mode_enabled', '1', 0),
(379, 'paymentmethod_mollie_default_selected', '1', 1),
(380, 'paymentmethod_mollie_initialized', '1', 1),
(381, 'paymentmethod_paypal_braintree_active', '0', 1),
(382, 'paymentmethod_paypal_braintree_label', 'Braintree', 1),
(383, 'paymentmethod_paypal_braintree_merchant_id', '', 0),
(384, 'paymentmethod_paypal_braintree_api_public_key', '', 0),
(385, 'paymentmethod_paypal_braintree_api_private_key', '', 0),
(386, 'paymentmethod_paypal_braintree_currencies', 'USD', 0),
(387, 'paymentmethod_paypal_braintree_paypal_enabled', '1', 0),
(388, 'paymentmethod_paypal_braintree_test_mode_enabled', '1', 0),
(389, 'paymentmethod_paypal_braintree_default_selected', '1', 1),
(390, 'paymentmethod_paypal_braintree_initialized', '1', 1),
(391, 'paymentmethod_paypal_checkout_active', '0', 1),
(392, 'paymentmethod_paypal_checkout_label', 'Paypal Smart Checkout', 1),
(393, 'paymentmethod_paypal_checkout_fee_fixed', '0', 0),
(394, 'paymentmethod_paypal_checkout_fee_percent', '0', 0),
(395, 'paymentmethod_paypal_checkout_client_id', '', 0),
(396, 'paymentmethod_paypal_checkout_secret', '', 0),
(397, 'paymentmethod_paypal_checkout_payment_description', 'Payment for Invoice {invoice_number}', 0),
(398, 'paymentmethod_paypal_checkout_currencies', 'USD,CAD,EUR', 0),
(399, 'paymentmethod_paypal_checkout_test_mode_enabled', '1', 0),
(400, 'paymentmethod_paypal_checkout_default_selected', '1', 1),
(401, 'paymentmethod_paypal_checkout_initialized', '1', 1),
(402, 'paymentmethod_paypal_active', '0', 1),
(403, 'paymentmethod_paypal_label', 'Paypal', 1),
(404, 'paymentmethod_paypal_fee_fixed', '0', 0),
(405, 'paymentmethod_paypal_fee_percent', '0', 0),
(406, 'paymentmethod_paypal_username', '', 0),
(407, 'paymentmethod_paypal_password', '', 0),
(408, 'paymentmethod_paypal_signature', '', 0),
(409, 'paymentmethod_paypal_description_dashboard', 'Payment for Invoice {invoice_number}', 0),
(410, 'paymentmethod_paypal_currencies', 'EUR,USD', 0),
(411, 'paymentmethod_paypal_test_mode_enabled', '1', 0),
(412, 'paymentmethod_paypal_default_selected', '1', 1),
(413, 'paymentmethod_paypal_initialized', '1', 1),
(414, 'paymentmethod_payu_money_active', '0', 1),
(415, 'paymentmethod_payu_money_label', 'PayU Money', 1),
(416, 'paymentmethod_payu_money_fee_fixed', '0', 0),
(417, 'paymentmethod_payu_money_fee_percent', '0', 0),
(418, 'paymentmethod_payu_money_key', '', 0),
(419, 'paymentmethod_payu_money_salt', '', 0),
(420, 'paymentmethod_payu_money_description_dashboard', 'Payment for Invoice {invoice_number}', 0),
(421, 'paymentmethod_payu_money_currencies', 'INR', 0),
(422, 'paymentmethod_payu_money_test_mode_enabled', '1', 0),
(423, 'paymentmethod_payu_money_default_selected', '1', 1),
(424, 'paymentmethod_payu_money_initialized', '1', 1),
(425, 'paymentmethod_stripe_active', '0', 1),
(426, 'paymentmethod_stripe_label', 'Stripe Checkout', 1),
(427, 'paymentmethod_stripe_fee_fixed', '0', 0),
(428, 'paymentmethod_stripe_fee_percent', '0', 0),
(429, 'paymentmethod_stripe_api_publishable_key', '', 0),
(430, 'paymentmethod_stripe_api_secret_key', '', 0),
(431, 'paymentmethod_stripe_description_dashboard', 'Payment for Invoice {invoice_number}', 0),
(432, 'paymentmethod_stripe_currencies', 'USD,CAD', 0),
(433, 'paymentmethod_stripe_allow_primary_contact_to_update_credit_card', '1', 0),
(434, 'paymentmethod_stripe_default_selected', '1', 1),
(435, 'paymentmethod_stripe_initialized', '1', 1),
(436, 'paymentmethod_stripe_ideal_active', '0', 1),
(437, 'paymentmethod_stripe_ideal_label', 'Stripe iDEAL', 1),
(438, 'paymentmethod_stripe_ideal_api_secret_key', '', 0),
(439, 'paymentmethod_stripe_ideal_api_publishable_key', '', 0),
(440, 'paymentmethod_stripe_ideal_description_dashboard', 'Payment for Invoice {invoice_number}', 0),
(441, 'paymentmethod_stripe_ideal_statement_descriptor', 'Payment for Invoice {invoice_number}', 0),
(442, 'paymentmethod_stripe_ideal_currencies', 'EUR', 0),
(443, 'paymentmethod_stripe_ideal_default_selected', '1', 1),
(444, 'paymentmethod_stripe_ideal_initialized', '1', 1),
(445, 'paymentmethod_two_checkout_active', '0', 1),
(446, 'paymentmethod_two_checkout_label', '2Checkout', 1),
(447, 'paymentmethod_two_checkout_fee_fixed', '0', 0),
(448, 'paymentmethod_two_checkout_fee_percent', '0', 0),
(449, 'paymentmethod_two_checkout_merchant_code', '', 0),
(450, 'paymentmethod_two_checkout_secret_key', '', 0),
(451, 'paymentmethod_two_checkout_description', 'Payment for Invoice {invoice_number}', 0),
(452, 'paymentmethod_two_checkout_currencies', 'USD, EUR, GBP', 0),
(453, 'paymentmethod_two_checkout_test_mode_enabled', '1', 0),
(454, 'paymentmethod_two_checkout_default_selected', '1', 1),
(455, 'paymentmethod_two_checkout_initialized', '1', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblpayment_attempts`
--

CREATE TABLE `tblpayment_attempts` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference` varchar(100) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `fee` double NOT NULL,
  `payment_gateway` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblpayment_modes`
--

CREATE TABLE `tblpayment_modes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `show_on_pdf` int(11) NOT NULL DEFAULT 0,
  `invoices_only` int(11) NOT NULL DEFAULT 0,
  `expenses_only` int(11) NOT NULL DEFAULT 0,
  `selected_by_default` int(11) NOT NULL DEFAULT 1,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblpayment_modes`
--

INSERT INTO `tblpayment_modes` (`id`, `name`, `description`, `show_on_pdf`, `invoices_only`, `expenses_only`, `selected_by_default`, `active`) VALUES
(1, 'Bank', NULL, 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblpinned_projects`
--

CREATE TABLE `tblpinned_projects` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblprojectdiscussioncomments`
--

CREATE TABLE `tblprojectdiscussioncomments` (
  `id` int(11) NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `discussion_type` varchar(10) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `content` mediumtext NOT NULL,
  `staff_id` int(11) NOT NULL,
  `contact_id` int(11) DEFAULT 0,
  `fullname` varchar(191) DEFAULT NULL,
  `file_name` varchar(191) DEFAULT NULL,
  `file_mime_type` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblprojectdiscussions`
--

CREATE TABLE `tblprojectdiscussions` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `subject` varchar(191) NOT NULL,
  `description` mediumtext NOT NULL,
  `show_to_customer` tinyint(1) NOT NULL DEFAULT 0,
  `datecreated` datetime NOT NULL,
  `last_activity` datetime DEFAULT NULL,
  `staff_id` int(11) NOT NULL DEFAULT 0,
  `contact_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblprojects`
--

CREATE TABLE `tblprojects` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `clientid` int(11) NOT NULL,
  `billing_type` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `deadline` date DEFAULT NULL,
  `project_created` date NOT NULL,
  `date_finished` datetime DEFAULT NULL,
  `progress` int(11) DEFAULT 0,
  `progress_from_tasks` int(11) NOT NULL DEFAULT 1,
  `project_cost` decimal(15,2) DEFAULT NULL,
  `project_rate_per_hour` decimal(15,2) DEFAULT NULL,
  `estimated_hours` decimal(15,2) DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `contact_notification` int(11) DEFAULT 1,
  `notify_contacts` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblprojects`
--

INSERT INTO `tblprojects` (`id`, `name`, `description`, `status`, `clientid`, `billing_type`, `start_date`, `deadline`, `project_created`, `date_finished`, `progress`, `progress_from_tasks`, `project_cost`, `project_rate_per_hour`, `estimated_hours`, `addedfrom`, `contact_notification`, `notify_contacts`) VALUES
(1, 'Template', '', 2, 1, 3, '2025-01-12', NULL, '2025-01-12', NULL, 0, 1, 0.00, 0.00, NULL, 2, 1, 'a:0:{}');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblproject_activity`
--

CREATE TABLE `tblproject_activity` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL DEFAULT 0,
  `contact_id` int(11) NOT NULL DEFAULT 0,
  `fullname` varchar(100) DEFAULT NULL,
  `visible_to_customer` int(11) NOT NULL DEFAULT 0,
  `description_key` varchar(191) NOT NULL COMMENT 'Language file key',
  `additional_data` mediumtext DEFAULT NULL,
  `dateadded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblproject_activity`
--

INSERT INTO `tblproject_activity` (`id`, `project_id`, `staff_id`, `contact_id`, `fullname`, `visible_to_customer`, `description_key`, `additional_data`, `dateadded`) VALUES
(1, 1, 2, 0, 'Quý Trần', 1, 'project_activity_added_team_member', 'Quý Trần', '2025-01-12 21:48:16'),
(2, 1, 2, 0, 'Quý Trần', 1, 'project_activity_created', '', '2025-01-12 21:48:16'),
(3, 1, 2, 0, 'Quý Trần', 1, 'project_activity_new_task_assignee', 'Nghiên cứu từ khóa - Quý Trần', '2025-01-12 21:49:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblproject_files`
--

CREATE TABLE `tblproject_files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(191) NOT NULL,
  `original_file_name` longtext DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `last_activity` datetime DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `visible_to_customer` tinyint(1) DEFAULT 0,
  `staffid` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL DEFAULT 0,
  `external` varchar(40) DEFAULT NULL,
  `external_link` mediumtext DEFAULT NULL,
  `thumbnail_link` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblproject_members`
--

CREATE TABLE `tblproject_members` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblproject_members`
--

INSERT INTO `tblproject_members` (`id`, `project_id`, `staff_id`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblproject_notes`
--

CREATE TABLE `tblproject_notes` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblproject_settings`
--

CREATE TABLE `tblproject_settings` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblproject_settings`
--

INSERT INTO `tblproject_settings` (`id`, `project_id`, `name`, `value`) VALUES
(1, 1, 'available_features', 'a:17:{s:16:\"project_overview\";i:1;s:13:\"project_tasks\";i:1;s:18:\"project_timesheets\";i:1;s:18:\"project_milestones\";i:1;s:13:\"project_files\";i:1;s:19:\"project_discussions\";i:1;s:13:\"project_gantt\";i:1;s:15:\"project_tickets\";i:1;s:17:\"project_contracts\";i:1;s:17:\"project_proposals\";i:1;s:17:\"project_estimates\";i:1;s:16:\"project_invoices\";i:1;s:21:\"project_subscriptions\";i:1;s:16:\"project_expenses\";i:1;s:20:\"project_credit_notes\";i:1;s:13:\"project_notes\";i:1;s:16:\"project_activity\";i:1;}'),
(2, 1, 'view_tasks', '1'),
(3, 1, 'create_tasks', '1'),
(4, 1, 'edit_tasks', '1'),
(5, 1, 'comment_on_tasks', '1'),
(6, 1, 'view_task_comments', '1'),
(7, 1, 'view_task_attachments', '1'),
(8, 1, 'view_task_checklist_items', '1'),
(9, 1, 'upload_on_tasks', '1'),
(10, 1, 'view_task_total_logged_time', '1'),
(11, 1, 'view_finance_overview', '1'),
(12, 1, 'upload_files', '1'),
(13, 1, 'open_discussions', '1'),
(14, 1, 'view_milestones', '1'),
(15, 1, 'view_gantt', '1'),
(16, 1, 'view_timesheets', '1'),
(17, 1, 'view_activity_log', '1'),
(18, 1, 'view_team_members', '1'),
(19, 1, 'hide_tasks_on_main_tasks_table', '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblproposals`
--

CREATE TABLE `tblproposals` (
  `id` int(11) NOT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `total_tax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `adjustment` decimal(15,2) DEFAULT NULL,
  `discount_percent` decimal(15,2) NOT NULL,
  `discount_total` decimal(15,2) NOT NULL,
  `discount_type` varchar(30) DEFAULT NULL,
  `show_quantity_as` int(11) NOT NULL DEFAULT 1,
  `currency` int(11) NOT NULL,
  `open_till` date DEFAULT NULL,
  `date` date NOT NULL,
  `rel_id` int(11) DEFAULT NULL,
  `rel_type` varchar(40) DEFAULT NULL,
  `assigned` int(11) DEFAULT NULL,
  `hash` varchar(32) NOT NULL,
  `proposal_to` varchar(191) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `country` int(11) NOT NULL DEFAULT 0,
  `zip` varchar(50) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `allow_comments` tinyint(1) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL,
  `estimate_id` int(11) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `date_converted` datetime DEFAULT NULL,
  `pipeline_order` int(11) DEFAULT 1,
  `is_expiry_notified` int(11) NOT NULL DEFAULT 0,
  `acceptance_firstname` varchar(50) DEFAULT NULL,
  `acceptance_lastname` varchar(50) DEFAULT NULL,
  `acceptance_email` varchar(100) DEFAULT NULL,
  `acceptance_date` datetime DEFAULT NULL,
  `acceptance_ip` varchar(40) DEFAULT NULL,
  `signature` varchar(40) DEFAULT NULL,
  `short_link` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblproposal_comments`
--

CREATE TABLE `tblproposal_comments` (
  `id` int(11) NOT NULL,
  `content` longtext DEFAULT NULL,
  `proposalid` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `dateadded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblrelated_items`
--

CREATE TABLE `tblrelated_items` (
  `id` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(30) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblreminders`
--

CREATE TABLE `tblreminders` (
  `id` int(11) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `date` datetime NOT NULL,
  `isnotified` int(11) NOT NULL DEFAULT 0,
  `rel_id` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `rel_type` varchar(40) NOT NULL,
  `notify_by_email` int(11) NOT NULL DEFAULT 1,
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblroles`
--

CREATE TABLE `tblroles` (
  `roleid` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `permissions` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblroles`
--

INSERT INTO `tblroles` (`roleid`, `name`, `permissions`) VALUES
(1, 'Employee', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblsales_activity`
--

CREATE TABLE `tblsales_activity` (
  `id` int(11) NOT NULL,
  `rel_type` varchar(20) DEFAULT NULL,
  `rel_id` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `additional_data` mediumtext DEFAULT NULL,
  `staffid` varchar(11) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblscheduled_emails`
--

CREATE TABLE `tblscheduled_emails` (
  `id` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(15) NOT NULL,
  `scheduled_at` datetime NOT NULL,
  `contacts` varchar(197) NOT NULL,
  `cc` mediumtext DEFAULT NULL,
  `attach_pdf` tinyint(1) NOT NULL DEFAULT 1,
  `template` varchar(197) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblservices`
--

CREATE TABLE `tblservices` (
  `serviceid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblsessions`
--

CREATE TABLE `tblsessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblsessions`
--

INSERT INTO `tblsessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('0353adetl7pk05sbubta33i09rj3k0qt', '104.152.52.64', 1738097293, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383039373239333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('0378n0ddp46pti5g14g1lumjfklm9dd0', '172.94.78.34', 1737461761, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373436313736313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('03i1g9mtiktckat71c44g5t70off5apq', '185.209.198.185', 1740219015, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303231393031343b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('09mm4n1i5udr4v7pbn3f1usak2cn83q3', '51.81.46.212', 1741445259, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313434353235393b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('0ang369qf3ura49tq93e3i59jnq5oi19', '51.81.46.212', 1741445261, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313434353236313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('0b45jd5bpbemlecmdf2ged6p34b4fihm', '172.111.197.5', 1734880991, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838303939313b69735f6d6f62696c657c623a313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('0d4fess19ec0hdlb88cf5cl05pk8i58m', '208.100.26.249', 1736963002, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363936333030323b69735f6d6f62696c657c623a313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('0jq2a2qeprs1776nlo53sc5k72gbp48j', '115.79.41.216', 1735102162, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353130323136313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('0k5iu5tao1om7i7d8gif2qd7jassm4dp', '18.201.56.53', 1738618034, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383631383033343b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('0nvfkf92lnroqtv9il1rmo2c1ddn12v1', '208.100.26.247', 1735815206, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353831353230353b69735f6d6f62696c657c623a313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('0o0futafckbhb8f09p8pfs4oq6k46igf', '115.73.24.98', 1742374376, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337343133313b5f707265765f75726c7c733a33323a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e223b73746166665f757365725f69647c733a313a2231223b73746166665f6c6f676765645f696e7c623a313b73657475702d6d656e752d6f70656e7c733a303a22223b),
('0ol8og30h8f85hktm6m827ge3hrouc67', '1.14.14.169', 1741622481, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323438313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('0outjlcqouml73a98aab1f935f2gv6hf', '134.122.45.62', 1738856829, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383835363832393b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('0pr5i020e7h4877vmcm5ucvfpkni8s3b', '135.148.100.196', 1738821968, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383832313936383b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('101c8htlo1hpf4qnrlbhvq7j8buuq010', '115.74.142.124', 1739438165, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393433383135353b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('14l4339iusrin8s2ij7afl9h91a5bcdj', '115.74.142.124', 1739430669, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393433303636393b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('17dv4i7e5kskhldapvehj8fuae49od3u', '172.111.197.5', 1734880989, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838303938393b69735f6d6f62696c657c623a313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('19lo7jclui61q9fm76srvhqg8d6beodv', '195.211.77.142', 1740131160, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303133313136303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('1divdu3a5ftqc9n80cgi68oqu445fh6h', '176.102.65.28', 1734880245, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838303234353b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('1djdh52dm8kuvd3hirog2timd1m225vu', '115.74.142.124', 1741321314, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313332313331343b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('1gned8rop51ubokke3j94vga637ha5ks', '115.79.41.216', 1741321412, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313332313431323b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('1j7918kc2afm416nlljv8blvf2ro5pt6', '157.55.39.193', 1737463571, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373436333537313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('1ju9gm6srj0sn4iq2nn8chvgt5lqfo03', '139.99.170.109', 1734883707, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838333730373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('1lgifvi1j2g81o2kgrhanpvsg6g8lltr', '18.136.211.100', 1740305539, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303330353533393b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('1lmn8on5tajtj7l4duc6n5m3a62ithvt', '104.164.173.192', 1740131132, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303133313133313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('1m19kphgf1uv7dgepe57b9gl33nto40d', '106.75.132.208', 1734862130, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836323133303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('1pv2v4j633a394u3i443labv0l8ommr6', '135.148.100.196', 1736265657, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363236353635373b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('1thm0too0s2lntj87mvvf00s8dg6q1eq', '27.64.22.228', 1735110878, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353131303837383b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('1tmlou9j2uosjo1gt5tgjvv6soun0jm7', '167.94.146.54', 1735458771, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353435383737313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('21ja597af3hq1ntutkfdrr97r3u9lki8', '104.166.80.222', 1735475959, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353437353935383b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('235i6nr9f1cs94r6jko1jaad2qmrgjmb', '35.94.136.254', 1741940714, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313934303731323b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('27g6srgec6ampo5ufh1hcd9q5r7bp9mo', '213.180.203.63', 1736566025, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363536363032353b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('2bp9bt3i56lrn9oeaje8h214p32vf8kk', '208.100.26.233', 1740049301, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303034393330313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('2brcr9o53ds35mlev7mnbhi8u8usk690', '167.94.138.171', 1737941615, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373934313631353b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('2gfq6hai52nthc5l9627g442ofrikoi7', '1.14.14.169', 1741622501, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323530313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('2i9e5hd50avh96s6n28hojm3gfpredd8', '205.169.39.47', 1734862468, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836323436383b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('2is8l8ogvuip0j9ve3ea89js1rqkr34u', '208.100.26.249', 1741280088, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313238303038383b69735f6d6f62696c657c623a313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('2khqq02469dk4akvbf3j3mjdojp2mqb6', '1.14.14.169', 1741622481, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323438313b7265645f75726c7c733a33373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d3130223b),
('2mgu12knam5ltu8ucnvg7m117o3ssjcr', '54.247.57.72', 1734869096, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836393039363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('31nid36u9kqcmbcbpq7kj3euqhlusibn', '157.55.39.8', 1741293449, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313239333434393b5f707265765f75726c7c733a35373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f666f72676f745f70617373776f7264223b),
('34vb8erlea1ec8cr96amm6gvr8cepv5s', '165.227.38.56', 1741262009, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313236323030393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('3bu7348v2coj1l8ipo64sujop7ni413v', '27.64.54.154', 1734862099, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836323039393b7265645f75726c7c733a33323a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e223b),
('3cv490015f5pkvia8591hr6nsn6q86ij', '104.166.80.100', 1734868942, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836383934323b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('3e1a221h64uh9q2cb6n4iejtnmugg4gc', '173.244.43.138', 1734918236, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343931383233323b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('3ko0schmgne1teds61jldhd71l1lir1l', '163.47.21.21', 1734883707, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838333730373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('3ld38ae08rbknauhotvlgnva5gcqtgik', '87.236.176.90', 1734982200, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343938323230303b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('3qo21f7u3v3tim8snme38v762ifu2eep', '146.70.28.43', 1734911231, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343931313233313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('3tdmgkhhi765qoaut1cueagnal37kmjh', '208.100.26.247', 1737634439, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373633343433383b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('3uts220vk0vlpvbjp9dr41a80dl1cls8', '172.111.197.5', 1734880237, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838303233373b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('40hpbo5sqmntgtl82mf8ikm8cafidno0', '104.152.52.65', 1741022206, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313032323230363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('41vdjtjv5th7tja450lh9f3j78lig2se', '40.77.167.230', 1736963419, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363936333431393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('439vh1tjlni0nsttom9pohicevpt7oms', '27.64.22.228', 1735102158, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353130323134333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f6b6e6f776c656467652d62617365223b),
('43ip4l3btiodrv7n0fggc81agqe34gk1', '213.180.203.88', 1739653733, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393635333733333b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('45ip0ev8pdotfhpel7uvbcqcnmmnva7s', '87.250.224.29', 1739653872, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393635333837323b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f6b6e6f776c656467652d62617365223b),
('468n0ad5468gt00lgsmk0a9neo616d5m', '104.152.52.62', 1737492530, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373439323533303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('47f7unu3rgesliaaevh2vnvr6rlvculj', '87.236.176.135', 1734974628, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343937343632383b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('4898mhoiebdsqfahviuqdjcl8fj68mi5', '115.74.142.124', 1739438700, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393433383639383b5f707265765f75726c7c733a33323a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e223b73746166665f757365725f69647c733a313a2231223b73746166665f6c6f676765645f696e7c623a313b73657475702d6d656e752d6f70656e7c733a303a22223b),
('48h0ke1edbr66o0c3d822gmkrll0qtrg', '52.167.144.19', 1735882838, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353838323833383b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e223b),
('4e0m0ti53kbnklkvbb0iv5unddcvciq4', '27.64.54.154', 1734863749, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836333734393b5f707265765f75726c7c733a33383a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e2f7461736b73223b73746166665f757365725f69647c733a313a2231223b73746166665f6c6f676765645f696e7c623a313b73657475702d6d656e752d6f70656e7c733a303a22223b),
('4heljlavs3ptcvre50qt01r1ckfuu27f', '51.81.46.212', 1734866112, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836363131313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('4jebuphrvr2mok46l77ljcma5csfcbkj', '208.100.26.249', 1739443734, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393434333733343b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('4jl1gc1u5f3mj8v52nnqmfi47p4nmoim', '101.199.254.203', 1741972392, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313937323339323b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('4lp4nflt2kqq7hp19lgcoc4jht61glgq', '27.64.22.228', 1735274844, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353237343834343b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('4tuhbnloscdv94uver6gdlsqbpkpt9dt', '40.77.167.34', 1737977107, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373937373130373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('55sr8cimu8sqhl9c1bbt7527p7tu8a7f', '1.14.14.169', 1741622474, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323437333b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('56b29ajqmrpaq1vgvaf6i23prcml0l65', '208.100.26.235', 1738795508, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383739353530383b69735f6d6f62696c657c623a313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('581aq8s0aterpograa67931gc0bmvpgd', '40.77.167.18', 1737010464, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373031303436343b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e223b),
('59bgk4ftv64fcvdtctlame9ui7mbg4pa', '27.64.54.154', 1734862100, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836323130303b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e2f61757468656e7469636174696f6e223b),
('5cvrmv1sfnlbp5c8uagvd1s8eelgnrct', '104.152.52.61', 1739309106, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393330393130363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('5e71q765d46if1sdkihsoje8ikbc2kif', '52.167.144.229', 1737856647, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373835363634373b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e223b),
('5jcl68kq8emjomd01r8tgeqq92obp9dc', '18.201.56.53', 1738618036, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383631383033363b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('5ncohcnt3gk1rjo85vuorobn0hh1h316', '146.70.28.43', 1734911254, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343931313235343b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('5nurk7614lh1df1qtrjqm95bbmhka3vh', '157.55.39.48', 1737700918, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373730303931383b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('5pse54ebsmct2jdn1n7f0khrbevrl9d5', '52.167.144.172', 1737304584, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373330343538343b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e223b),
('5q9tkor1rh42ov6kia6ccrioh9bpkqbs', '3.139.45.225', 1740193341, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303139333334313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('61qlcoidenjitkl79vh3bkadbs6rp3tf', '116.206.228.188', 1734883703, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838333730333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('64bfuni2kc2540lq0cakk0rblt1r4ciq', '103.108.92.89', 1734883704, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838333730343b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('679o47qi4d7araifr5iebljnf8n7gthe', '144.126.229.247', 1735242897, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353234323839373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('6ft9tb7jhlub0kn3lggv2c4s5imu9pr2', '27.64.22.228', 1735274842, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353237343834323b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('6ho6oc6gs697k6vkbtv3rss4gv6fs6v7', '115.74.142.124', 1741321573, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313332313537333b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e2f61757468656e7469636174696f6e223b),
('6n869b821ecol929antosren2eomb3ki', '1.14.14.169', 1741622512, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323531313b7265645f75726c7c733a33373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d3139223b),
('6nets28m6042a2unvms59a841aj8r8ks', '23.158.56.51', 1741803945, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313830333934343b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('6r5fjluuigp0fs08o3vpdncc0rdlmso4', '195.211.77.140', 1740131152, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303133313135313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('6sknabata1v4jsukot4lfd8lm1mdc26e', '1.14.14.169', 1741622505, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323530353b7265645f75726c7c733a33373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d3137223b),
('6vmotigs9i4ivkquegb0tr5uk4l8nlmf', '52.167.144.188', 1736983523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363938333532323b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('770g5t9e7eojmfvc460n9u1bhg2mgj4s', '206.189.62.77', 1740031503, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303033313530333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('7dep16ruffu2vhihtgqvgr68oak60dlr', '176.102.65.28', 1734880237, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838303233373b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('7noc3p1cpqvorjjrlkovircnmjk788da', '157.245.215.253', 1736423164, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363432333136343b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('7q76hlp15do3e8vu2guiordik64p4tft', '206.168.34.212', 1735458761, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353435383736313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('80k934iiv6oi38eofql0l2du7dhidovr', '52.167.144.186', 1736512034, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363531323033333b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('80ulsuapfnmk4d0329o46u4dqg6piegp', '157.245.215.253', 1736423158, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363432333135383b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('81esv1vepsed5db89tta1b1ggqeh2edl', '206.189.62.77', 1740031514, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303033313531343b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('82iuedg0nsjqmolo1vqhlslc9603b0el', '165.227.233.160', 1735073206, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353037333230363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('83vm1g8b7eh00upaglki32jts6q7fql4', '1.14.14.169', 1741622507, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323530373b7265645f75726c7c733a33373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d3138223b),
('886t4d5b6imjhnji6ob1kfoen67adg29', '104.166.80.83', 1735217873, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353231373837323b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('88d34m8mpmilen3o5mdh811rj1ngtio5', '1.14.14.169', 1741622478, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323437383b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('8fnt2pgvd91k4trluj8a8qff9gam5jc1', '207.46.13.87', 1735776746, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353737363734363b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('8i6kjhssrpava132jgh27gd5pfgrti0o', '27.64.59.238', 1736692919, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363639323931393b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e2f61757468656e7469636174696f6e223b6d6573736167652d64616e6765727c733a32353a22496e76616c696420656d61696c206f722070617373776f7264223b5f5f63695f766172737c613a313a7b733a31343a226d6573736167652d64616e676572223b733a333a226f6c64223b7d),
('8jhig7st4g8da7t0934omamv7e9ns93j', '1.14.14.169', 1741622484, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323438343b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('8nemc28hqtso08ojppkv72us7lqjs0t4', '198.235.24.24', 1738404678, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383430343637383b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('8oci6f0gguclqbj6l1bebjpc85mqmdnr', '50.19.167.206', 1741233901, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313233333930313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('8parjdua1cjc0dsc075jt9te0im8u52g', '95.108.213.168', 1742007707, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323030373730373b5f707265765f75726c7c733a35373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f666f72676f745f70617373776f7264223b),
('8pullf0e4acpfm4evfsgkfkcpe52sg7s', '87.236.176.169', 1738380526, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383338303532363b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('8rm3jm302ph837ted5gunrmpq9pg8pat', '205.210.31.169', 1735441110, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353434313131303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('8te0b3j3cqboi3v4vm56hbipvbptogu3', '115.74.142.124', 1739430700, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393433303730303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('92s31stit5trtkeh0nl147l9510ib7bv', '207.46.13.127', 1738655376, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383635353337363b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e223b),
('960u2j81h2lt6c782pu0ob8h0qu0vn2k', '1.14.14.169', 1741622474, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323437343b7265645f75726c7c733a33363a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d35223b),
('97hvhcmosqafb3livv5vdr8t8966d76g', '104.152.52.59', 1739912619, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393931323631393b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('9819num1bdr7pjsujmvkb1rrbauossun', '54.247.57.72', 1734869101, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836393130313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('98dfr306c0j16t62b5bkk6p7tqi1gpg1', '207.241.236.83', 1740309573, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303330393537333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('9b32e8o8i3arll1vbh4runatifov21d4', '87.236.176.177', 1740962572, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303936323537323b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('9e3n20kqcv124sl7p98tbf079f9hh3rg', '27.64.59.238', 1736693226, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363639333232363b5f707265765f75726c7c733a34303a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e2f636c69656e7473223b73746166665f757365725f69647c733a313a2232223b73746166665f6c6f676765645f696e7c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b73657475702d6d656e752d6f70656e7c733a303a22223b),
('9p0mnfnlva2nk23ddppagic5n1g1iqqv', '52.167.144.19', 1736329727, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363332393732373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('9pnn4n9ohphc5jj6atabom2buqj1th8u', '54.79.118.38', 1737462228, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373436323232373b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('9voeprhd66pkki6k76s8d4dk1stu43ui', '208.100.26.235', 1740049300, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303034393330303b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('a00t1gi10rjjfqvd3fsl3hghu8oqtsa0', '116.109.14.237', 1741321813, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313332313738393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b73746166665f757365725f69647c733a313a2232223b73746166665f6c6f676765645f696e7c623a313b73657475702d6d656e752d6f70656e7c733a303a22223b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b6d6573736167652d64616e6765727c733a32383a22496e76616c696420757365726e616d65206f722070617373776f7264223b5f5f63695f766172737c613a313a7b733a31343a226d6573736167652d64616e676572223b733a333a226f6c64223b7d),
('a12ncp3ne374ukop9dm74fn43emahrul', '134.122.45.62', 1738856834, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383835363833343b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('a4gjjur6i0jgo68a7u3cooh1c2bsfs07', '103.108.92.89', 1734883709, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838333730393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('aam57fvn8mtlm0fjj0gopvpsmldudkjh', '1.14.14.169', 1741622482, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323438323b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('ad9q40ku0v2pkcdvfb73qp33ugsmcap0', '1.14.14.169', 1741622481, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323438313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('ah9k499j4do31q08blugu12ve4l9vmb2', '192.175.111.238', 1734868139, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836383133393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('ahjap7kgf8172thpbqbtumepf6qcvmn9', '101.199.254.242', 1741971303, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313937313330333b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('aj9ovo97n15501unlqtoji66trladst6', '135.148.100.196', 1738821966, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383832313936363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('ajc5ur0fimoe1ghlk3kkerlorv68thnv', '44.243.87.221', 1736937968, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363933373936383b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('alvf35ali0lfemg86a9mh4qfsht3du8o', '52.167.144.163', 1739864623, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393836343632333b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('ang9rhchsqr8mcvg3jjfkiv103dcrq3m', '101.199.254.230', 1741973295, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313937333239353b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('aor6b4m4bsnt1jaqvvr88js0jvoksce1', '206.168.34.212', 1735458808, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353435383830373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('at8m356i5oau0oq9egvvdthc29oi2797', '135.148.100.196', 1736265659, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363236353635393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('av36ldksrfo476ofgah3vlm89n3rafb2', '144.126.229.247', 1735242892, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353234323839323b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('b221icpk7gfl820kc3v7d9mmrfq7r6d1', '106.75.132.208', 1734862133, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836323133333b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('b6mkedo60isrnee6oq951qlthadafm0d', '208.100.26.249', 1739443733, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393434333733333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('b9552oi1lrnele0n36jlu3ukahd6t91n', '104.152.52.72', 1740311605, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303331313630353b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('bbllm9fefjhfnhftlg1tcr960dr0go6r', '1.14.14.169', 1741622427, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323432373b7265645f75726c7c733a33363a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d32223b),
('bjqjvlceuqgmdgre4601dp01f9h0mu5q', '104.152.52.61', 1735046968, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353034363936383b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('bmf1hgfnjqji4uk9h011uq808nmjv23m', '27.64.59.238', 1736693497, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363639333232363b5f707265765f75726c7c733a38303a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e2f70726f6a656374732f766965772f313f67726f75703d70726f6a6563745f6f76657276696577267461736b69643d31223b73746166665f757365725f69647c733a313a2232223b73746166665f6c6f676765645f696e7c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b73657475702d6d656e752d6f70656e7c733a303a22223b),
('bnsterk3pvff9voc0bmci8s74eko1kpo', '1.14.14.169', 1741622475, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323437353b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('bod0lequ9jhohgpt2eftl3et9gjaqhv9', '199.45.155.105', 1738393720, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383339333732303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('bulq0i58g9ifi304to1nouinn1f6a22a', '52.167.144.202', 1737813126, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373831333132363b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('c0mqhlbtsecffmfg1ga3plgu4u6ss1bm', '115.74.142.124', 1741321310, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313332313331303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('c1efslgn1vgcfr9h1mg9rai47921tcnf', '208.100.26.246', 1738274141, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383237343134313b69735f6d6f62696c657c623a313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('c4efouq6qqbdfhekn6e5fajm7r707fs2', '104.164.173.15', 1740131132, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303133313133313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('c5eq2khculavq548ece9i74gfeq75rt6', '198.235.24.52', 1738961834, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383936313833343b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('c7mvqhlaiaqh4ole95ogotuss141j9en', '173.244.43.138', 1734918325, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343931383331383b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('ccdqa73uekfnctq2b527g15voat9rep6', '208.100.26.249', 1741280090, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313238303039303b69735f6d6f62696c657c623a313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('ch4e6idjhdcje7a0499702m8f10s7vco', '157.55.39.11', 1741888403, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313838383430303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('cjfc8b3c05kh8b5v3vu47gmhlb0gbg24', '208.100.26.249', 1741280087, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313238303038373b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('cn7g50v262bdc30rfdtm2fuiecg4g28d', '198.235.24.52', 1738961834, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383936313833343b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('csgkc0ndb899q2hjn56veobchi4ah3sr', '64.15.129.105', 1734868142, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836383134323b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('d1d1l5le55ut1bouch0veg0dorbm529d', '208.100.26.247', 1737634437, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373633343433373b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('dj9mku1s0ulmu2er60baqc5dd1r5fqgu', '198.235.24.166', 1736165456, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363136353435363b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('dn0sfjkpet63rtpu0to83p7puj7kuu5l', '34.44.229.221', 1734872712, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343837323731323b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('dtrju8c81uchihde03vovlmbj9u5j0r3', '208.100.26.247', 1735815205, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353831353230353b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('duho9i6c3e4od91dj8ip8oqubi115lde', '164.92.73.179', 1735189380, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353138393338303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('e5gto2v4ga39uj15k9fkepa6q9j5i46n', '52.167.144.183', 1735918659, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353931383635393b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f6b6e6f776c656467652d62617365223b),
('e7rl5pb64m3j3b05jtnvbvjqa6jgrk92', '64.15.129.105', 1734868141, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836383134313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('egab8033firm87t9aqmg9ag2b4gsepl4', '68.183.195.43', 1740422101, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303432323130313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('ejc94j4df2ue5qovrv6a50pfbo5dofoc', '192.175.111.238', 1734868138, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836383133383b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('el9ceffacmo8a463aauamvol264omhf4', '142.93.214.149', 1737138626, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373133383632363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('erpj42vk45jbim3g2qt5ar23bv5ik6ko', '101.199.254.236', 1741972333, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313937323333333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('f0tcb1qomfcq9p8bg1oc3667dcnu2s2k', '40.77.167.230', 1737798814, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373739383831343b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f6b6e6f776c656467652d62617365223b),
('f1rk4acc89ptmr91ivbioahjbtrh57u6', '165.227.38.56', 1741261997, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313236313939373b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('f8njdmlspdok0d37t8qolfjl9loqkf10', '1.14.14.169', 1741622503, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323530333b7265645f75726c7c733a33373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d3136223b),
('fb54t225k6hv8hj7851hsf1oimj64s4g', '106.161.65.206', 1734883707, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838333730373b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('ffq41ut8va4ae1jsah3nk5qt4832qoba', '87.236.176.223', 1738438926, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383433383932363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('fr8bgbv8sqa96diunnf85j67eont0p96', '152.42.131.167', 1734899663, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343839393636333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('fribar4fp6eculp97jvr4crpev7rolfb', '68.183.195.43', 1740422106, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303432323130363b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('frq4dm1kq07s1mocuem3cqptukgq2f5m', '1.14.14.169', 1741622483, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323438333b7265645f75726c7c733a33373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d3132223b),
('fslsr7ghpk2gqvdc0nq5mui54ehjj5us', '103.131.95.72', 1734881942, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838313934313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('g60ui488lu1puk37mpef60s1ndd5fbq7', '52.167.144.233', 1740164895, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303136343839353b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('g7vvuudfebd910bquobvn9efcsutpvs6', '208.100.26.233', 1738795508, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383739353530383b69735f6d6f62696c657c623a313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('g8221u1gm108kf2gfka2dt0qjj6a9l27', '54.165.2.35', 1734881249, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838313234393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('gad3dv3seg726nc915v1jg41huhcuorf', '1.14.14.169', 1741622488, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323438383b7265645f75726c7c733a33373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d3133223b),
('gameu02n26f8kngevoh9m2mphq5bi3l7', '47.82.11.133', 1740207372, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303230373337323b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('gfd9d01hvt6ec5gn70k002h4u5a7beuc', '104.152.52.65', 1738708173, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383730383137323b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('gjae0gljdpos9bugd7j2io2acloajvd2', '208.100.26.249', 1736963001, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363936333030313b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('gp78p75tv1r4hnhe0a9d8csc2bc6h910', '171.244.43.14', 1740184378, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303138343337383b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('gslnmenr91u1hg6ud2sflbj1a1ctt0j6', '1.14.14.169', 1741622426, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323432363b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('gvu6ajk4ngq9ptiu6qrtea21huqqqt1a', '87.236.176.177', 1740962573, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303936323537333b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('h38n0qse2b7mh6lbft8pqdjv754ufgno', '1.14.14.169', 1741622477, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323437373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('h5e91pi2r796oneht60nj05161apdj04', '1.14.14.169', 1741622505, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323530353b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('h9sjjr6lkcs73816014ar2lavuvolgml', '52.167.144.221', 1738448880, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383434383838303b5f707265765f75726c7c733a35373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f666f72676f745f70617373776f7264223b);
INSERT INTO `tblsessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('hbmelvf5hc8rqmrd0bnrgg7n3iekp7rf', '5.255.231.166', 1736566026, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363536363032363b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('hcpvh4pnguma519b5nh43ve5a071v1nl', '208.100.26.233', 1738795507, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383739353530373b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('hiok4t9n56n2sb9b1gpjlsri2dcgent1', '172.111.197.5', 1734880992, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838303939323b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('hj1d067ui7qasjrccs71ta2kvfqmssok', '199.195.253.124', 1734881042, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838313034323b69735f6d6f62696c657c623a313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('hm9a2koeku607brndkctd74ba00mb3p6', '54.247.57.72', 1734869094, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836393039343b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('i0h3tpu3even2n7e4ld717bhkmccjoco', '37.120.203.71', 1734883896, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838333839363b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('i6vtkcn6s7f5v9ois20frpfqb25m13dc', '40.77.167.67', 1735776741, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353737363734313b5f707265765f75726c7c733a35373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f666f72676f745f70617373776f7264223b),
('icioirocbk5liciuhq62pl9uv5isjvbb', '115.79.41.216', 1741321789, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313332313738393b5f707265765f75726c7c733a33323a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e223b73746166665f757365725f69647c733a313a2232223b73746166665f6c6f676765645f696e7c623a313b73657475702d6d656e752d6f70656e7c733a303a22223b),
('icklc90aisfi61b6hc4oan55a0u2j5n1', '192.175.111.233', 1734868151, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836383135313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('ies20mbjkmr2as2ncgjectmi9ma8bkaa', '1.14.14.169', 1741622504, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323530333b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('ig61ahmls10mctsgrdqhsqo4qkjv2bil', '157.55.39.195', 1736521038, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363532313033383b5f707265765f75726c7c733a34383a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f6b6e6f776c656467652d626173652f736561726368223b),
('ih661l1nvdtd9imp27ujspauc0bqnr4a', '27.64.22.228', 1735102146, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353130323134363b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('inc507f3sah72sd11ogrem6opjq7ikih', '104.248.19.145', 1737611837, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373631313833373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('infgrnggc76jkd1hehl5j2rhqk8p6tl1', '192.175.111.245', 1734868149, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836383134393b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('ipoa7871t4veqnv5m6bbvhl576lgucvn', '207.241.225.114', 1740274369, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303237343336393b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('j36cqpl1jkjsiv8p2hb0c5tc7fkn8k9a', '113.23.29.137', 1738428482, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383432383438323b69735f6d6f62696c657c623a313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('j86i5vob9cd9g2pt0n5u054cfdmt65gf', '192.175.111.233', 1734868151, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836383135313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('jhrdhv346kptbritkr0gv37btrh7763c', '208.100.26.246', 1738274140, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383237343134303b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('ji7suhht5qh59k83nmpdhkk9qhot58n7', '1.14.14.169', 1741622425, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323432353b7265645f75726c7c733a33363a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d31223b),
('jno2q0dpoie7d76kgkcetjbcsp2j8kqu', '104.166.80.62', 1736081721, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363038313732303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('jrjd701lghmlp3f6vdgv9a4t9b2kki3j', '163.47.21.21', 1734883703, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838333730333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('k2c0b10lof4qlt4nt9ram2k66ci6r6nt', '101.199.254.231', 1741972410, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313937323431303b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('k2livphjrnvmdj6831m2e0uri3ceul8e', '115.74.142.124', 1739433549, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393433333534393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b73746166665f757365725f69647c733a313a2232223b73746166665f6c6f676765645f696e7c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('k5p06t0cnqo02jpfc8bs94b22ufmkm8j', '115.74.142.124', 1739438670, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393433383538333b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e2f70726f6a656374732f67616e7474223b73746166665f757365725f69647c733a313a2232223b73746166665f6c6f676765645f696e7c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b73657475702d6d656e752d6f70656e7c733a303a22223b),
('k60vgbhihutb3230l1j9fg7qh0ho77pm', '146.190.197.169', 1734880990, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838303939303b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('k7t59jjmbeago97lncd3hr047rbs858c', '208.100.26.249', 1738274151, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383237343135313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('k83uk5sa2nk12e09pbvnpdv5ep2eks69', '104.166.80.51', 1735736262, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353733363236323b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('k91uo5vnao546q36lelq8trcrhs63j21', '87.236.176.223', 1738438927, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383433383932373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('kbvm7in091ngb01bhc3pthrflruclg29', '115.74.142.124', 1739438583, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393433383538333b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b73746166665f757365725f69647c733a313a2232223b73746166665f6c6f676765645f696e7c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b6d6573736167652d64616e6765727c733a32383a22496e76616c696420757365726e616d65206f722070617373776f7264223b5f5f63695f766172737c613a313a7b733a31343a226d6573736167652d64616e676572223b733a333a226f6c64223b7d),
('ki4qmsa5gmatsec8o1hdbichgmlg03vi', '40.77.167.22', 1735859804, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353835393830333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('kpl11k8h2tuhkc4akgsl8puk308br7mk', '106.161.65.206', 1734883703, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838333730333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('kqfisdacg8s31kabd7cbaoeetqs2ejoq', '116.102.142.11', 1742220980, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323232303937393b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('kqtnvbkhsa1jn6g60cdum2tdpfsf9t3n', '115.74.142.124', 1739438168, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393433383136383b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('krbundoquti6ed7dsqar6i7d2o9f4b20', '40.77.167.17', 1736031669, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363033313636383b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e223b),
('krp6aq7lv0etejsne2eedcs79fiko6uf', '54.163.13.201', 1740276917, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303237363931363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('kv1uumqsfg3qt6pe8espbuq8kchehmrm', '101.199.254.238', 1741973302, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313937333330313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('l1smpuuhjbqev70uu948f6v3acvjlu9n', '104.152.52.60', 1735664023, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353636343032333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('l9vshct4gpc03f30lkn3qbgl1u3nasps', '152.42.131.167', 1734899668, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343839393636383b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('lafqiia5gdepvbcad5rfuuf7g3rrsh28', '40.77.167.55', 1738767837, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383736373833373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('lfutuee1kf1es58mdsd2f5i67bq63stq', '34.141.151.163', 1740759476, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303735393437353b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('li50l1e194uh7h4sa72h6oo984puknj9', '27.64.22.228', 1735274844, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353237343834343b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('ln2d5s8aguqgh5h0t2ls1dpnp1l7tuvn', '207.241.236.83', 1736006775, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363030363737353b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('lpmognstc829oqps5896jcn2624udo5i', '208.100.26.249', 1741280088, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313238303038383b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('lu3c8ecrcncfe90hp4k6hb4m2h1ju7i3', '167.94.146.54', 1735458787, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353435383738373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('m5p102j7f78o7an74kup2j5ickr6main', '51.81.46.212', 1734866109, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836363130393b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('m7ir2l7qhr43pead9kupb4ha1onjlb8g', '35.88.50.250', 1739350557, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393335303535363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('mc0a3f271gb10udt192l95te0nn65gag', '106.75.153.133', 1734862138, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836323133383b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('mcirnb6752o4n6kt1embuq077iob7su2', '208.100.26.236', 1735815204, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353831353230343b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('mf6p47e648vi030ajbljg0i4savkl7j0', '1.14.14.169', 1741622473, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323437333b7265645f75726c7c733a33363a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d34223b),
('mg311uilvlejp8bld5j3bahkq93d0vv1', '3.249.231.93', 1738608323, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383630383332333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('mtrq2g90ilfep1vlr96s7d7ovhrmna9f', '52.167.144.175', 1740036222, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303033363232323b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('n304ouc37ke19ipcqsdq2ibdpfk285rc', '34.252.161.192', 1736184660, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363138343636303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('n3rvgies642fnbdjcbt8r2ddanmbkuvu', '37.120.203.71', 1734883921, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838333932313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('n6djq7kbk5bvdoqs6jeq75g6r7avpmsp', '104.152.52.67', 1736273987, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363237333938363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('nckov9i114mdcprffm5t77it7i37qv81', '1.14.14.169', 1741622499, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323439393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('ncme06j7aq0rnntqi0qelcfp5ujpcafk', '146.70.161.179', 1734880044, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838303034343b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('ndqev8eik5fo8ikg3223cv98l1p01ii3', '165.227.233.160', 1735073211, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353037333231313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('nhp1so7fc92j5o7m4f9o0btifc6lcp7g', '157.55.39.7', 1741493436, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313439333433363b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('nj2quas7slvtb1bcen27g6380h8hivgk', '1.14.14.169', 1741622475, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323437353b7265645f75726c7c733a33363a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d36223b),
('njl80tfpbjun505h67mabq1btpob02lf', '1.14.14.169', 1741622478, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323437383b7265645f75726c7c733a33363a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d38223b),
('nk9vps4qteqgpaf2e58b4fs0q3ctktnc', '157.55.39.10', 1737327228, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373332373232383b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('nu2uei5b95n7865ibgb5qtaidde34ugt', '27.64.54.154', 1734862430, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836323433303b5f707265765f75726c7c733a34363a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e2f737562736372697074696f6e73223b73746166665f757365725f69647c733a313a2231223b73746166665f6c6f676765645f696e7c623a313b73657475702d6d656e752d6f70656e7c733a303a22223b),
('o524tfn4i0nddp4n0tf6fdeajm22qju6', '104.166.80.209', 1735043542, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353034333534323b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('o7n95vfskml4i8u5jti9spjhpqfc5er4', '106.75.153.133', 1734862140, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836323134303b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('o92fvdfu77fe2p5347gl6l9sunu9g1ih', '208.100.26.236', 1735815203, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353831353230333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('oa9a8m4osa5hokf0pbgv6plu905tet2u', '185.247.137.174', 1740954576, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303935343537363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('obhfc8htsa4lu7lmd7hdbvmqu9kh4jri', '115.74.142.124', 1739430700, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393433303730303b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('odheovotbpk87vjp2vd9agoslrll0eno', '207.46.13.157', 1738763062, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383736333036323b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e223b),
('ofolls3f0popv5jem5ji0aeei5rd4v4l', '103.195.4.182', 1734881940, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838313934303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('olmootoeituo2cgva545if1rq06999r9', '208.100.26.249', 1739443733, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393434333733333b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('onq33la04uo7dqmh69c7qsv41kpkq2hu', '40.77.167.23', 1738155815, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383135353831353b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e223b),
('p1kgs03o7dtmt4n9bgb8r2i3al2uqsas', '205.169.39.248', 1735030440, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353033303433393b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('p2f6k2s3qbkdib7r3ko72mmqbp4ubffg', '185.247.137.138', 1738319474, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383331393437343b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('p9l72md7ao4ovcrsl5lcquq1nsgu2m0c', '1.14.14.169', 1741622480, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323438303b7265645f75726c7c733a33363a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d39223b),
('pboog2ncgu91a3o6t2ot974lt4hfrfh7', '104.164.173.15', 1740131151, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303133313135313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('pe77eqjc08suhb6cc723fr9ap5poi9r6', '115.74.142.124', 1741321371, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313332313136343b5f707265765f75726c7c733a33323a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e223b73746166665f757365725f69647c733a313a2232223b73746166665f6c6f676765645f696e7c623a313b73657475702d6d656e752d6f70656e7c733a303a22223b),
('pglroqa9ghl3qo17ffcnn5ch38o05v34', '1.14.14.169', 1741622501, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323530313b7265645f75726c7c733a33373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d3135223b),
('ph1m8n3ltvd4vb5h7cftdd2ni71579vq', '52.167.144.166', 1737570311, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373537303331313b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e223b),
('pk0463aninp3851nsh1rvh0sorqar0qq', '101.199.254.205', 1741971297, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313937313239373b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('pm1louqhtpcr1lpbs4f9m8k7nc91o5n6', '142.93.214.149', 1737138628, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373133383632383b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('pt6co5sk38ug2iggn7q2rth7ptpparff', '198.235.24.166', 1736165454, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363136353435343b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('q29cgeeljm4v90armfbrgk767rf1hqot', '115.74.142.124', 1741321314, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313332313331343b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('q2kr252eu3mrlnt5cnjqe3fdo8fko662', '87.236.176.135', 1734974629, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343937343632393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('q52c6sa3j0vhif9lu3m7b6ahuf9227mv', '198.235.24.24', 1738404679, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383430343637393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('q93g6vg9ej13ppv2ufvfg16ganaaqpm8', '104.152.52.55', 1736872196, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363837323139363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('qfvti6j77mju16me4sn1m30q3ni5trov', '1.14.14.169', 1741622477, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323437373b7265645f75726c7c733a33363a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d37223b),
('qi7dnfhgoukrnmcs0i55ct1evpvtu6j8', '207.46.13.36', 1740682946, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303638323934363b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f6b6e6f776c656467652d62617365223b),
('qikk6cg6g5qikuco022qn2cngetmln0i', '27.64.22.228', 1735110878, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353131303837383b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('qkkd846en8j9bmh8j6608npt6p5lan4i', '27.64.59.238', 1736692980, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363639323938303b5f707265765f75726c7c733a33323a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e223b73746166665f757365725f69647c733a313a2232223b73746166665f6c6f676765645f696e7c623a313b73657475702d6d656e752d6f70656e7c733a303a22223b),
('qmra2no7j5gn2sdstc8i64hip9spefn6', '52.167.144.203', 1738759559, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383735393535393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('r1mlsv5ijrvetlplafk1ubm0jsrf0g1c', '212.143.94.254', 1734880156, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838303135363b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('r6v1v1h7s95gsj9mgfsqqnmhdhndv4qh', '87.236.176.90', 1734982199, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343938323139393b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('radv0a8st57cchqq8as7mmfvu1igtlce', '167.94.138.171', 1737941550, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373934313535303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('rammgudlf2gb15760vl7ljji5skgg8nt', '27.64.59.238', 1736693093, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363639333031313b5f707265765f75726c7c733a34303a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e2f636c69656e7473223b73746166665f757365725f69647c733a313a2232223b73746166665f6c6f676765645f696e7c623a313b73657475702d6d656e752d6f70656e7c733a303a22223b),
('rbdtqk8ijtag8splnfa4vhdv4t6tiksr', '1.14.14.169', 1741622514, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323531343b7265645f75726c7c733a33373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d3230223b),
('rhvjd4k3qslj223m1ousp0bt2i33vrrh', '212.143.94.254', 1734880155, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838303135353b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('s03qabcamqdq7o56ul9dn148pessn6o7', '106.161.65.206', 1734883707, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838333730373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('s4bdqui1kps22eaut6pbltgf54dgkmg1', '207.241.225.114', 1740274380, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303237343338303b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('s4d8khe0qj0e23h38r36pphkuj0e9b0g', '208.100.26.233', 1740049300, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303034393330303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('s6hkv62c4r1rca9n6v5cgqgfqqb81bcb', '1.14.14.169', 1741622497, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323439373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('s8ivbuhgkahm43komoabt0dvhg4f31r7', '1.14.14.169', 1741622514, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323531343b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('s9qr98196userq2orl0hlehpehhauo1k', '104.166.80.194', 1734956181, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343935363138303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('se6f0rbdu8h1og49j56lnkoslcrsganp', '115.79.41.216', 1741321412, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313332313431323b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('selsr8qj3lmi6k43j1qqsbg02df8faup', '40.77.167.0', 1738307879, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383330373837393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('sf1hk6jeb69nnvsq5in8vdestdm5aitp', '171.244.43.14', 1734910506, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343931303530363b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('sjk8djglekcmqk6sc6lt071ss236fdra', '1.14.14.169', 1741622438, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323433383b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('sjq46tm2s84n447f2ipau3qu6crsrko9', '208.100.26.247', 1737634437, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373633343433373b69735f6d6f62696c657c623a313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('sqlc50ncqep5v7hf8llg10c5f5p18p54', '27.64.59.238', 1737450929, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373435303838323b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('ssl516igepq2fh08k7eid4l9imbv6p5q', '1.14.14.169', 1741622512, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323531323b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('suqgt1k54fg76v00no8if1n9uda12j12', '1.14.14.169', 1741622509, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323530393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('t1ck9vr14t2q68pi5r6ivicfqetacm8i', '185.247.137.138', 1738319473, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383331393437333b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('t3ptt8tvsr9q8piqddddgprug1cs90js', '208.100.26.235', 1740049301, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303034393330313b69735f6d6f62696c657c623a313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('t5lps94ucnk2bs1fdg97u8736a0563a9', '3.236.145.207', 1735924705, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353932343730353b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('t6h0rn5tu8f48fm841ehlmmttcl3v9li', '52.167.144.150', 1736290055, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363239303035353b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('t8sqp62qr3afog4d63f2skg6gro691d5', '199.45.155.105', 1738393738, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383339333733383b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('taj1ikgdj07l4vr4qmrcputub1k6i6i4', '52.167.144.20', 1740324516, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303332343531363b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('tcha8g0vmgsi35sr50al68dmhm07sfb2', '40.77.167.159', 1738930891, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383933303839313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('tcodmp0du9j7mu6emjhsjlho06rkbhs1', '37.120.203.71', 1734883946, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343838333934363b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('tg6mg1ta8lo0h70tnprmlr0f2lecg1o4', '27.64.54.154', 1734862125, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836323132353b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e2f61757468656e7469636174696f6e223b),
('th3ku4alb0s2q8poh8pr9qp28njkrlie', '207.46.13.87', 1735776745, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353737363734353b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f6b6e6f776c656467652d62617365223b),
('tpn9p0ojao51qj8t8r39hcn7i93v7hco', '205.169.39.248', 1735030450, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353033303435303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('u1uaaba7ncud29pal4tcih3gu9j0e8n3', '157.55.39.52', 1735776550, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353737363535303b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e223b),
('udg7phmljnnrah2npj4diur2gh6n7u1i', '5.255.231.174', 1739653872, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393635333837323b5f707265765f75726c7c733a35373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f666f72676f745f70617373776f7264223b),
('ufee7b0jhh2fv0av5avus4qcda9lv8ph', '208.100.26.247', 1737634437, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373633343433373b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('ugbu2v9n7qqtu787rte75ogtc0mhnji5', '1.14.14.169', 1741622480, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323438303b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('uhve3gg4b4rq5j46r7e65nft21p95piv', '87.236.176.169', 1738380525, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383338303532353b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('ui4m6mui59gljlh8p9vio7qccorcnmdm', '27.64.54.154', 1734863756, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836333734393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b73746166665f757365725f69647c733a313a2231223b73746166665f6c6f676765645f696e7c623a313b73657475702d6d656e752d6f70656e7c733a303a22223b7265645f75726c7c733a33343a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f636c69656e7473223b6d697374616b656e5f6c6f67696e5f617265615f636865636b5f706572666f726d65647c733a313a2231223b5f5f63695f766172737c613a323a7b733a33353a226d697374616b656e5f6c6f67696e5f617265615f636865636b5f706572666f726d6564223b733a333a226f6c64223b733a31343a226d6573736167652d64616e676572223b733a333a226f6c64223b7d6d6573736167652d64616e6765727c733a35373a2254c3aa6e206e67c6b0e1bb9d692064c3b96e6720686fe1bab763206de1baad74206b68e1baa975206b68c3b46e672068e1bba370206ce1bb87223b),
('uidg4tmo5ckm5p9ar8gj0prs56ejovpl', '27.64.54.154', 1734862120, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836323132303b5f707265765f75726c7c733a33323a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e223b73746166665f757365725f69647c733a313a2231223b73746166665f6c6f676765645f696e7c623a313b73657475702d6d656e752d6f70656e7c733a303a22223b),
('ujvr8es2deqparqqgmp70ju707pvevjr', '115.74.142.124', 1741321573, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313332313537333b7265645f75726c7c733a33323a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61646d696e223b),
('uomdg1uppdet3vfil4uhb0e31rv2bfh5', '104.166.80.20', 1737464306, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373436343330363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('up2n533rahlsn97ajgmqipif6mr6ndef', '205.210.31.169', 1735441113, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353434313131333b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('usphpkjakrsht797k848s4fqtedo465d', '40.77.167.68', 1736092219, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363039323231393b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f6b6e6f776c656467652d62617365223b),
('uvsvh0mjl8gt40a2tu6bo8rfcffve5rg', '40.77.167.230', 1736670513, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733363637303531333b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('v0iu9o8tgtftcslc7bmrajvu5frb2e3s', '208.100.26.235', 1738795507, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383739353530373b69735f6d6f62696c657c623a313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('v1ui25bkrcdg325d5psojgvtr97o1jpu', '208.100.26.249', 1739443734, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393434333733343b69735f6d6f62696c657c623a313b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('v22bdncb2j3h91s5m70r5omfrpggvo7m', '208.100.26.249', 1738274150, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383237343135303b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('v5ub5qghj7smu38pirjuvm6t3hftgvjh', '207.46.13.168', 1738934520, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383933343532303b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e223b),
('vdih2446mfnqnf9a4h4ut81fi2u7a7ip', '104.248.19.145', 1737611831, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733373631313833313b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('vfr12962h6si7gn7hafmg7j70qph65go', '40.77.167.45', 1739078757, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733393037383735363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('vllqc60idr4gephjmvmhge0i8dcgjtjc', '185.247.137.174', 1740954577, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734303935343537373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('vmpter1aktq9lg7cq1fhf5epakt2nbn5', '157.55.39.195', 1738995693, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733383939353639333b5f707265765f75726c7c733a34313a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e223b),
('vp0rraslrmt2b5pd8a14eln7tki38bsd', '164.92.73.179', 1735189387, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353138393338373b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('vp30i4j4vkl8mnmkrpeo5it4q5heqfmr', '101.199.254.236', 1741972350, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313937323335303b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('vrjphag0clgfco2di57o7p4c1vmi1qp5', '27.64.22.228', 1735102146, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733353130323134363b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b),
('vrq42sf59e23jo3aa7cqm3qsighat2um', '1.14.14.169', 1741622482, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323438323b7265645f75726c7c733a33373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d3131223b),
('vshiqbakomnfmfu296v9ql2ngbsjccal', '192.175.111.245', 1734868149, 0x5f5f63695f6c6173745f726567656e65726174657c693a313733343836383134393b5f707265765f75726c7c733a34373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f61757468656e7469636174696f6e2f6c6f67696e223b),
('vskgr97q40kojsk1tfi5lt0od1ue80j2', '1.14.14.169', 1741622498, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313632323439383b7265645f75726c7c733a33373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f3f617574686f723d3134223b),
('vtie06q40aqbrf31kcp189gn2bs14qin', '18.202.24.205', 1741256138, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734313235363133383b7265645f75726c7c733a32373a2268747470733a2f2f7465616d2e7469656e7a6976656e2e636f6d2f223b);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblshared_customer_files`
--

CREATE TABLE `tblshared_customer_files` (
  `file_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblspam_filters`
--

CREATE TABLE `tblspam_filters` (
  `id` int(11) NOT NULL,
  `type` varchar(40) NOT NULL,
  `rel_type` varchar(10) NOT NULL,
  `value` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblstaff`
--

CREATE TABLE `tblstaff` (
  `staffid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `facebook` longtext DEFAULT NULL,
  `linkedin` longtext DEFAULT NULL,
  `phonenumber` varchar(30) DEFAULT NULL,
  `skype` varchar(50) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `datecreated` datetime NOT NULL,
  `profile_image` varchar(191) DEFAULT NULL,
  `last_ip` varchar(40) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `last_password_change` datetime DEFAULT NULL,
  `new_pass_key` varchar(32) DEFAULT NULL,
  `new_pass_key_requested` datetime DEFAULT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `role` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `default_language` varchar(40) DEFAULT NULL,
  `direction` varchar(3) DEFAULT NULL,
  `media_path_slug` varchar(191) DEFAULT NULL,
  `is_not_staff` int(11) NOT NULL DEFAULT 0,
  `hourly_rate` decimal(15,2) NOT NULL DEFAULT 0.00,
  `two_factor_auth_enabled` tinyint(1) DEFAULT 0,
  `two_factor_auth_code` varchar(100) DEFAULT NULL,
  `two_factor_auth_code_requested` datetime DEFAULT NULL,
  `email_signature` mediumtext DEFAULT NULL,
  `google_auth_secret` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblstaff`
--

INSERT INTO `tblstaff` (`staffid`, `email`, `firstname`, `lastname`, `facebook`, `linkedin`, `phonenumber`, `skype`, `password`, `datecreated`, `profile_image`, `last_ip`, `last_login`, `last_activity`, `last_password_change`, `new_pass_key`, `new_pass_key_requested`, `admin`, `role`, `active`, `default_language`, `direction`, `media_path_slug`, `is_not_staff`, `hourly_rate`, `two_factor_auth_enabled`, `two_factor_auth_code`, `two_factor_auth_code_requested`, `email_signature`, `google_auth_secret`) VALUES
(1, 'tranminhtien0408@gmail.com', 'TRẦN MINH', 'TIẾN', NULL, NULL, NULL, NULL, '$2a$08$bkQz7ZHKR1G5SGwCozfIjOA8e24PLCzYUQwX0.9cztRZ/ieXdhNCy', '2024-12-22 17:03:18', NULL, '115.73.24.98', '2025-03-19 15:52:55', '2025-03-19 15:52:56', NULL, '4eccf3de442e491e324af05e285bf3b3', '2025-02-13 16:20:21', 1, NULL, 1, NULL, NULL, NULL, 0, 0.00, 0, NULL, NULL, NULL, NULL),
(2, 'phuquytranhuynh@gmail.com', 'Quý', 'Trần', '', '', '', '', '$2a$08$hi/MdSunmdGMQbePA6lsau7ycX3LHdibl837/tfvM60uQHln1/AOS', '2024-12-22 17:11:46', NULL, '115.79.41.216', '2025-03-07 11:26:36', '2025-03-07 11:26:38', '2025-02-13 16:21:39', NULL, NULL, 1, 1, 1, '', '', 'quy-tran', 0, 0.00, 0, NULL, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblstaff_departments`
--

CREATE TABLE `tblstaff_departments` (
  `staffdepartmentid` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `departmentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblstaff_permissions`
--

CREATE TABLE `tblstaff_permissions` (
  `staff_id` int(11) NOT NULL,
  `feature` varchar(40) NOT NULL,
  `capability` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblsubscriptions`
--

CREATE TABLE `tblsubscriptions` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `description_in_item` tinyint(1) NOT NULL DEFAULT 0,
  `clientid` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `terms` mediumtext DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL DEFAULT 0,
  `stripe_tax_id` varchar(50) DEFAULT NULL,
  `tax_id_2` int(11) NOT NULL DEFAULT 0,
  `stripe_tax_id_2` varchar(50) DEFAULT NULL,
  `stripe_plan_id` mediumtext DEFAULT NULL,
  `stripe_subscription_id` mediumtext NOT NULL,
  `next_billing_cycle` bigint(20) DEFAULT NULL,
  `ends_at` bigint(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `hash` varchar(32) NOT NULL,
  `created` datetime NOT NULL,
  `created_from` int(11) NOT NULL,
  `date_subscribed` datetime DEFAULT NULL,
  `in_test_environment` int(11) DEFAULT NULL,
  `last_sent_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltaggables`
--

CREATE TABLE `tbltaggables` (
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(20) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `tag_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltags`
--

CREATE TABLE `tbltags` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltasks`
--

CREATE TABLE `tbltasks` (
  `id` int(11) NOT NULL,
  `name` longtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `dateadded` datetime NOT NULL,
  `startdate` date NOT NULL,
  `duedate` date DEFAULT NULL,
  `datefinished` datetime DEFAULT NULL,
  `addedfrom` int(11) NOT NULL,
  `is_added_from_contact` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `recurring_type` varchar(10) DEFAULT NULL,
  `repeat_every` int(11) DEFAULT NULL,
  `recurring` int(11) NOT NULL DEFAULT 0,
  `is_recurring_from` int(11) DEFAULT NULL,
  `cycles` int(11) NOT NULL DEFAULT 0,
  `total_cycles` int(11) NOT NULL DEFAULT 0,
  `custom_recurring` tinyint(1) NOT NULL DEFAULT 0,
  `last_recurring_date` date DEFAULT NULL,
  `rel_id` int(11) DEFAULT NULL,
  `rel_type` varchar(30) DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 0,
  `billable` tinyint(1) NOT NULL DEFAULT 0,
  `billed` tinyint(1) NOT NULL DEFAULT 0,
  `invoice_id` int(11) NOT NULL DEFAULT 0,
  `hourly_rate` decimal(15,2) NOT NULL DEFAULT 0.00,
  `milestone` int(11) DEFAULT 0,
  `kanban_order` int(11) DEFAULT 1,
  `milestone_order` int(11) NOT NULL DEFAULT 0,
  `visible_to_client` tinyint(1) NOT NULL DEFAULT 0,
  `deadline_notified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbltasks`
--

INSERT INTO `tbltasks` (`id`, `name`, `description`, `priority`, `dateadded`, `startdate`, `duedate`, `datefinished`, `addedfrom`, `is_added_from_contact`, `status`, `recurring_type`, `repeat_every`, `recurring`, `is_recurring_from`, `cycles`, `total_cycles`, `custom_recurring`, `last_recurring_date`, `rel_id`, `rel_type`, `is_public`, `billable`, `billed`, `invoice_id`, `hourly_rate`, `milestone`, `kanban_order`, `milestone_order`, `visible_to_client`, `deadline_notified`) VALUES
(1, 'Nghiên cứu từ khóa', '', 2, '2025-01-12 21:49:13', '2025-01-12', NULL, NULL, 2, 0, 4, NULL, NULL, 0, NULL, 0, 0, 0, NULL, 1, 'project', 0, 1, 0, 0, 10.00, 0, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltaskstimers`
--

CREATE TABLE `tbltaskstimers` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `start_time` varchar(64) NOT NULL,
  `end_time` varchar(64) DEFAULT NULL,
  `staff_id` int(11) NOT NULL,
  `hourly_rate` decimal(15,2) NOT NULL DEFAULT 0.00,
  `note` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltasks_checklist_templates`
--

CREATE TABLE `tbltasks_checklist_templates` (
  `id` int(11) NOT NULL,
  `description` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltask_assigned`
--

CREATE TABLE `tbltask_assigned` (
  `id` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `taskid` int(11) NOT NULL,
  `assigned_from` int(11) NOT NULL DEFAULT 0,
  `is_assigned_from_contact` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbltask_assigned`
--

INSERT INTO `tbltask_assigned` (`id`, `staffid`, `taskid`, `assigned_from`, `is_assigned_from_contact`) VALUES
(1, 2, 1, 2, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltask_checklist_items`
--

CREATE TABLE `tbltask_checklist_items` (
  `id` int(11) NOT NULL,
  `taskid` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `finished` int(11) NOT NULL DEFAULT 0,
  `dateadded` datetime NOT NULL,
  `addedfrom` int(11) NOT NULL,
  `finished_from` int(11) DEFAULT 0,
  `list_order` int(11) NOT NULL DEFAULT 0,
  `assigned` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltask_comments`
--

CREATE TABLE `tbltask_comments` (
  `id` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `taskid` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL DEFAULT 0,
  `file_id` int(11) NOT NULL DEFAULT 0,
  `dateadded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltask_followers`
--

CREATE TABLE `tbltask_followers` (
  `id` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `taskid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltaxes`
--

CREATE TABLE `tbltaxes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `taxrate` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltemplates`
--

CREATE TABLE `tbltemplates` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `addedfrom` int(11) NOT NULL,
  `content` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltickets`
--

CREATE TABLE `tbltickets` (
  `ticketid` int(11) NOT NULL,
  `adminreplying` int(11) NOT NULL DEFAULT 0,
  `userid` int(11) NOT NULL,
  `contactid` int(11) NOT NULL DEFAULT 0,
  `merged_ticket_id` int(11) DEFAULT NULL,
  `email` mediumtext DEFAULT NULL,
  `name` mediumtext DEFAULT NULL,
  `department` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `service` int(11) DEFAULT NULL,
  `ticketkey` varchar(32) NOT NULL,
  `subject` varchar(191) NOT NULL,
  `message` mediumtext DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `lastreply` datetime DEFAULT NULL,
  `clientread` int(11) NOT NULL DEFAULT 0,
  `adminread` int(11) NOT NULL DEFAULT 0,
  `assigned` int(11) NOT NULL DEFAULT 0,
  `staff_id_replying` int(11) DEFAULT NULL,
  `cc` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltickets_pipe_log`
--

CREATE TABLE `tbltickets_pipe_log` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `email_to` varchar(100) NOT NULL,
  `name` varchar(191) NOT NULL,
  `subject` varchar(191) NOT NULL,
  `message` longtext NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltickets_predefined_replies`
--

CREATE TABLE `tbltickets_predefined_replies` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `message` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltickets_priorities`
--

CREATE TABLE `tbltickets_priorities` (
  `priorityid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbltickets_priorities`
--

INSERT INTO `tbltickets_priorities` (`priorityid`, `name`) VALUES
(1, 'Low'),
(2, 'Medium'),
(3, 'High');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltickets_status`
--

CREATE TABLE `tbltickets_status` (
  `ticketstatusid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `isdefault` int(11) NOT NULL DEFAULT 0,
  `statuscolor` varchar(7) DEFAULT NULL,
  `statusorder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbltickets_status`
--

INSERT INTO `tbltickets_status` (`ticketstatusid`, `name`, `isdefault`, `statuscolor`, `statusorder`) VALUES
(1, 'Open', 1, '#ff2d42', 1),
(2, 'In progress', 1, '#22c55e', 2),
(3, 'Answered', 1, '#2563eb', 3),
(4, 'On Hold', 1, '#64748b', 4),
(5, 'Closed', 1, '#03a9f4', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblticket_attachments`
--

CREATE TABLE `tblticket_attachments` (
  `id` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `replyid` int(11) DEFAULT NULL,
  `file_name` varchar(191) NOT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `dateadded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblticket_replies`
--

CREATE TABLE `tblticket_replies` (
  `id` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `contactid` int(11) NOT NULL DEFAULT 0,
  `name` mediumtext DEFAULT NULL,
  `email` mediumtext DEFAULT NULL,
  `date` datetime NOT NULL,
  `message` mediumtext DEFAULT NULL,
  `attachment` int(11) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltodos`
--

CREATE TABLE `tbltodos` (
  `todoid` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `staffid` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `finished` tinyint(1) NOT NULL,
  `datefinished` datetime DEFAULT NULL,
  `item_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltracked_mails`
--

CREATE TABLE `tbltracked_mails` (
  `id` int(11) NOT NULL,
  `uid` varchar(32) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  `email` varchar(100) NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT 0,
  `date_opened` datetime DEFAULT NULL,
  `subject` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltwocheckout_log`
--

CREATE TABLE `tbltwocheckout_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference` varchar(64) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `attempt_reference` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbluser_auto_login`
--

CREATE TABLE `tbluser_auto_login` (
  `key_id` char(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_agent` varchar(150) NOT NULL,
  `last_ip` varchar(40) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `staff` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbluser_auto_login`
--

INSERT INTO `tbluser_auto_login` (`key_id`, `user_id`, `user_agent`, `last_ip`, `last_login`, `staff`) VALUES
('a0730e807536cc01ac781491d15d34bf', 2, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '115.74.142.124', '2025-03-07 04:20:52', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbluser_meta`
--

CREATE TABLE `tbluser_meta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `client_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `contact_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(191) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblvault`
--

CREATE TABLE `tblvault` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `server_address` varchar(191) NOT NULL,
  `port` int(11) DEFAULT NULL,
  `username` varchar(191) NOT NULL,
  `password` mediumtext NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `creator` int(11) NOT NULL,
  `creator_name` varchar(100) DEFAULT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  `share_in_projects` tinyint(1) NOT NULL DEFAULT 0,
  `last_updated` datetime DEFAULT NULL,
  `last_updated_from` varchar(100) DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblviews_tracking`
--

CREATE TABLE `tblviews_tracking` (
  `id` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  `rel_type` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  `view_ip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblweb_to_lead`
--

CREATE TABLE `tblweb_to_lead` (
  `id` int(11) NOT NULL,
  `form_key` varchar(32) NOT NULL,
  `lead_source` int(11) NOT NULL,
  `lead_status` int(11) NOT NULL,
  `notify_lead_imported` int(11) NOT NULL DEFAULT 1,
  `notify_type` varchar(20) DEFAULT NULL,
  `notify_ids` longtext DEFAULT NULL,
  `responsible` int(11) NOT NULL DEFAULT 0,
  `name` varchar(191) NOT NULL,
  `form_data` longtext DEFAULT NULL,
  `recaptcha` int(11) NOT NULL DEFAULT 0,
  `submit_btn_name` varchar(40) DEFAULT NULL,
  `submit_btn_text_color` varchar(10) DEFAULT '#ffffff',
  `submit_btn_bg_color` varchar(10) DEFAULT '#84c529',
  `success_submit_msg` mediumtext DEFAULT NULL,
  `submit_action` int(11) DEFAULT 0,
  `lead_name_prefix` varchar(255) DEFAULT NULL,
  `submit_redirect_url` longtext DEFAULT NULL,
  `language` varchar(40) DEFAULT NULL,
  `allow_duplicate` int(11) NOT NULL DEFAULT 1,
  `mark_public` int(11) NOT NULL DEFAULT 0,
  `track_duplicate_field` varchar(20) DEFAULT NULL,
  `track_duplicate_field_and` varchar(20) DEFAULT NULL,
  `create_task_on_duplicate` int(11) NOT NULL DEFAULT 0,
  `dateadded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tblactivity_log`
--
ALTER TABLE `tblactivity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staffid` (`staffid`);

--
-- Chỉ mục cho bảng `tblannouncements`
--
ALTER TABLE `tblannouncements`
  ADD PRIMARY KEY (`announcementid`);

--
-- Chỉ mục cho bảng `tblclients`
--
ALTER TABLE `tblclients`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `country` (`country`),
  ADD KEY `leadid` (`leadid`),
  ADD KEY `company` (`company`),
  ADD KEY `active` (`active`);

--
-- Chỉ mục cho bảng `tblconsents`
--
ALTER TABLE `tblconsents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purpose_id` (`purpose_id`),
  ADD KEY `contact_id` (`contact_id`),
  ADD KEY `lead_id` (`lead_id`);

--
-- Chỉ mục cho bảng `tblconsent_purposes`
--
ALTER TABLE `tblconsent_purposes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcontacts`
--
ALTER TABLE `tblcontacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `firstname` (`firstname`),
  ADD KEY `lastname` (`lastname`),
  ADD KEY `email` (`email`),
  ADD KEY `is_primary` (`is_primary`);

--
-- Chỉ mục cho bảng `tblcontact_permissions`
--
ALTER TABLE `tblcontact_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcontracts`
--
ALTER TABLE `tblcontracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client` (`client`),
  ADD KEY `contract_type` (`contract_type`);

--
-- Chỉ mục cho bảng `tblcontracts_types`
--
ALTER TABLE `tblcontracts_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcontract_comments`
--
ALTER TABLE `tblcontract_comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcontract_renewals`
--
ALTER TABLE `tblcontract_renewals`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcountries`
--
ALTER TABLE `tblcountries`
  ADD PRIMARY KEY (`country_id`);

--
-- Chỉ mục cho bảng `tblcreditnotes`
--
ALTER TABLE `tblcreditnotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currency` (`currency`),
  ADD KEY `clientid` (`clientid`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `formatted_number` (`formatted_number`);

--
-- Chỉ mục cho bảng `tblcreditnote_refunds`
--
ALTER TABLE `tblcreditnote_refunds`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcredits`
--
ALTER TABLE `tblcredits`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcurrencies`
--
ALTER TABLE `tblcurrencies`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcustomers_groups`
--
ALTER TABLE `tblcustomers_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Chỉ mục cho bảng `tblcustomer_admins`
--
ALTER TABLE `tblcustomer_admins`
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Chỉ mục cho bảng `tblcustomer_groups`
--
ALTER TABLE `tblcustomer_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupid` (`groupid`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `tblcustomfields`
--
ALTER TABLE `tblcustomfields`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcustomfieldsvalues`
--
ALTER TABLE `tblcustomfieldsvalues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relid` (`relid`),
  ADD KEY `fieldto` (`fieldto`),
  ADD KEY `fieldid` (`fieldid`);

--
-- Chỉ mục cho bảng `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`departmentid`),
  ADD KEY `name` (`name`);

--
-- Chỉ mục cho bảng `tbldismissed_announcements`
--
ALTER TABLE `tbldismissed_announcements`
  ADD PRIMARY KEY (`dismissedannouncementid`),
  ADD KEY `announcementid` (`announcementid`),
  ADD KEY `staff` (`staff`),
  ADD KEY `userid` (`userid`);

--
-- Chỉ mục cho bảng `tblemailtemplates`
--
ALTER TABLE `tblemailtemplates`
  ADD PRIMARY KEY (`emailtemplateid`);

--
-- Chỉ mục cho bảng `tblestimates`
--
ALTER TABLE `tblestimates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientid` (`clientid`),
  ADD KEY `currency` (`currency`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `sale_agent` (`sale_agent`),
  ADD KEY `status` (`status`),
  ADD KEY `formatted_number` (`formatted_number`);

--
-- Chỉ mục cho bảng `tblestimate_requests`
--
ALTER TABLE `tblestimate_requests`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblestimate_request_forms`
--
ALTER TABLE `tblestimate_request_forms`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblestimate_request_status`
--
ALTER TABLE `tblestimate_request_status`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblevents`
--
ALTER TABLE `tblevents`
  ADD PRIMARY KEY (`eventid`);

--
-- Chỉ mục cho bảng `tblexpenses`
--
ALTER TABLE `tblexpenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientid` (`clientid`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `category` (`category`),
  ADD KEY `currency` (`currency`);

--
-- Chỉ mục cho bảng `tblexpenses_categories`
--
ALTER TABLE `tblexpenses_categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblfiles`
--
ALTER TABLE `tblfiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rel_id` (`rel_id`),
  ADD KEY `rel_type` (`rel_type`);

--
-- Chỉ mục cho bảng `tblfilters`
--
ALTER TABLE `tblfilters`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblfilter_defaults`
--
ALTER TABLE `tblfilter_defaults`
  ADD KEY `filter_id` (`filter_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Chỉ mục cho bảng `tblform_questions`
--
ALTER TABLE `tblform_questions`
  ADD PRIMARY KEY (`questionid`);

--
-- Chỉ mục cho bảng `tblform_question_box`
--
ALTER TABLE `tblform_question_box`
  ADD PRIMARY KEY (`boxid`);

--
-- Chỉ mục cho bảng `tblform_question_box_description`
--
ALTER TABLE `tblform_question_box_description`
  ADD PRIMARY KEY (`questionboxdescriptionid`);

--
-- Chỉ mục cho bảng `tblform_results`
--
ALTER TABLE `tblform_results`
  ADD PRIMARY KEY (`resultid`);

--
-- Chỉ mục cho bảng `tblgdpr_requests`
--
ALTER TABLE `tblgdpr_requests`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblinvoicepaymentrecords`
--
ALTER TABLE `tblinvoicepaymentrecords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoiceid` (`invoiceid`),
  ADD KEY `paymentmethod` (`paymentmethod`);

--
-- Chỉ mục cho bảng `tblinvoices`
--
ALTER TABLE `tblinvoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currency` (`currency`),
  ADD KEY `clientid` (`clientid`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `sale_agent` (`sale_agent`),
  ADD KEY `total` (`total`),
  ADD KEY `status` (`status`),
  ADD KEY `formatted_number` (`formatted_number`);

--
-- Chỉ mục cho bảng `tblitemable`
--
ALTER TABLE `tblitemable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rel_id` (`rel_id`),
  ADD KEY `rel_type` (`rel_type`),
  ADD KEY `qty` (`qty`),
  ADD KEY `rate` (`rate`);

--
-- Chỉ mục cho bảng `tblitems`
--
ALTER TABLE `tblitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tax` (`tax`),
  ADD KEY `tax2` (`tax2`),
  ADD KEY `group_id` (`group_id`);

--
-- Chỉ mục cho bảng `tblitems_groups`
--
ALTER TABLE `tblitems_groups`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblitem_tax`
--
ALTER TABLE `tblitem_tax`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemid` (`itemid`),
  ADD KEY `rel_id` (`rel_id`);

--
-- Chỉ mục cho bảng `tblknowedge_base_article_feedback`
--
ALTER TABLE `tblknowedge_base_article_feedback`
  ADD PRIMARY KEY (`articleanswerid`);

--
-- Chỉ mục cho bảng `tblknowledge_base`
--
ALTER TABLE `tblknowledge_base`
  ADD PRIMARY KEY (`articleid`);

--
-- Chỉ mục cho bảng `tblknowledge_base_groups`
--
ALTER TABLE `tblknowledge_base_groups`
  ADD PRIMARY KEY (`groupid`);

--
-- Chỉ mục cho bảng `tblleads`
--
ALTER TABLE `tblleads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `company` (`company`),
  ADD KEY `email` (`email`),
  ADD KEY `assigned` (`assigned`),
  ADD KEY `status` (`status`),
  ADD KEY `source` (`source`),
  ADD KEY `lastcontact` (`lastcontact`),
  ADD KEY `dateadded` (`dateadded`),
  ADD KEY `leadorder` (`leadorder`),
  ADD KEY `from_form_id` (`from_form_id`);

--
-- Chỉ mục cho bảng `tblleads_email_integration`
--
ALTER TABLE `tblleads_email_integration`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblleads_sources`
--
ALTER TABLE `tblleads_sources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Chỉ mục cho bảng `tblleads_status`
--
ALTER TABLE `tblleads_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Chỉ mục cho bảng `tbllead_activity_log`
--
ALTER TABLE `tbllead_activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbllead_integration_emails`
--
ALTER TABLE `tbllead_integration_emails`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblmail_queue`
--
ALTER TABLE `tblmail_queue`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblmilestones`
--
ALTER TABLE `tblmilestones`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblmodules`
--
ALTER TABLE `tblmodules`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblnewsfeed_comment_likes`
--
ALTER TABLE `tblnewsfeed_comment_likes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblnewsfeed_posts`
--
ALTER TABLE `tblnewsfeed_posts`
  ADD PRIMARY KEY (`postid`);

--
-- Chỉ mục cho bảng `tblnewsfeed_post_comments`
--
ALTER TABLE `tblnewsfeed_post_comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblnewsfeed_post_likes`
--
ALTER TABLE `tblnewsfeed_post_likes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblnotes`
--
ALTER TABLE `tblnotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rel_id` (`rel_id`),
  ADD KEY `rel_type` (`rel_type`);

--
-- Chỉ mục cho bảng `tblnotifications`
--
ALTER TABLE `tblnotifications`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbloptions`
--
ALTER TABLE `tbloptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Chỉ mục cho bảng `tblpayment_attempts`
--
ALTER TABLE `tblpayment_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblpayment_modes`
--
ALTER TABLE `tblpayment_modes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblpinned_projects`
--
ALTER TABLE `tblpinned_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Chỉ mục cho bảng `tblprojectdiscussioncomments`
--
ALTER TABLE `tblprojectdiscussioncomments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblprojectdiscussions`
--
ALTER TABLE `tblprojectdiscussions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblprojects`
--
ALTER TABLE `tblprojects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientid` (`clientid`),
  ADD KEY `name` (`name`);

--
-- Chỉ mục cho bảng `tblproject_activity`
--
ALTER TABLE `tblproject_activity`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblproject_files`
--
ALTER TABLE `tblproject_files`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblproject_members`
--
ALTER TABLE `tblproject_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Chỉ mục cho bảng `tblproject_notes`
--
ALTER TABLE `tblproject_notes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblproject_settings`
--
ALTER TABLE `tblproject_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Chỉ mục cho bảng `tblproposals`
--
ALTER TABLE `tblproposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Chỉ mục cho bảng `tblproposal_comments`
--
ALTER TABLE `tblproposal_comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblrelated_items`
--
ALTER TABLE `tblrelated_items`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblreminders`
--
ALTER TABLE `tblreminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rel_id` (`rel_id`),
  ADD KEY `rel_type` (`rel_type`),
  ADD KEY `staff` (`staff`);

--
-- Chỉ mục cho bảng `tblroles`
--
ALTER TABLE `tblroles`
  ADD PRIMARY KEY (`roleid`);

--
-- Chỉ mục cho bảng `tblsales_activity`
--
ALTER TABLE `tblsales_activity`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblscheduled_emails`
--
ALTER TABLE `tblscheduled_emails`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblservices`
--
ALTER TABLE `tblservices`
  ADD PRIMARY KEY (`serviceid`);

--
-- Chỉ mục cho bảng `tblsessions`
--
ALTER TABLE `tblsessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Chỉ mục cho bảng `tblspam_filters`
--
ALTER TABLE `tblspam_filters`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblstaff`
--
ALTER TABLE `tblstaff`
  ADD PRIMARY KEY (`staffid`),
  ADD KEY `firstname` (`firstname`),
  ADD KEY `lastname` (`lastname`);

--
-- Chỉ mục cho bảng `tblstaff_departments`
--
ALTER TABLE `tblstaff_departments`
  ADD PRIMARY KEY (`staffdepartmentid`);

--
-- Chỉ mục cho bảng `tblsubscriptions`
--
ALTER TABLE `tblsubscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientid` (`clientid`),
  ADD KEY `currency` (`currency`),
  ADD KEY `tax_id` (`tax_id`);

--
-- Chỉ mục cho bảng `tbltaggables`
--
ALTER TABLE `tbltaggables`
  ADD KEY `rel_id` (`rel_id`),
  ADD KEY `rel_type` (`rel_type`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Chỉ mục cho bảng `tbltags`
--
ALTER TABLE `tbltags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Chỉ mục cho bảng `tbltasks`
--
ALTER TABLE `tbltasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rel_id` (`rel_id`),
  ADD KEY `rel_type` (`rel_type`),
  ADD KEY `milestone` (`milestone`),
  ADD KEY `kanban_order` (`kanban_order`),
  ADD KEY `status` (`status`);

--
-- Chỉ mục cho bảng `tbltaskstimers`
--
ALTER TABLE `tbltaskstimers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Chỉ mục cho bảng `tbltasks_checklist_templates`
--
ALTER TABLE `tbltasks_checklist_templates`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbltask_assigned`
--
ALTER TABLE `tbltask_assigned`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taskid` (`taskid`),
  ADD KEY `staffid` (`staffid`);

--
-- Chỉ mục cho bảng `tbltask_checklist_items`
--
ALTER TABLE `tbltask_checklist_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taskid` (`taskid`);

--
-- Chỉ mục cho bảng `tbltask_comments`
--
ALTER TABLE `tbltask_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `taskid` (`taskid`);

--
-- Chỉ mục cho bảng `tbltask_followers`
--
ALTER TABLE `tbltask_followers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbltaxes`
--
ALTER TABLE `tbltaxes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbltemplates`
--
ALTER TABLE `tbltemplates`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbltickets`
--
ALTER TABLE `tbltickets`
  ADD PRIMARY KEY (`ticketid`),
  ADD KEY `service` (`service`),
  ADD KEY `department` (`department`),
  ADD KEY `status` (`status`),
  ADD KEY `userid` (`userid`),
  ADD KEY `priority` (`priority`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `contactid` (`contactid`);

--
-- Chỉ mục cho bảng `tbltickets_pipe_log`
--
ALTER TABLE `tbltickets_pipe_log`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbltickets_predefined_replies`
--
ALTER TABLE `tbltickets_predefined_replies`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbltickets_priorities`
--
ALTER TABLE `tbltickets_priorities`
  ADD PRIMARY KEY (`priorityid`);

--
-- Chỉ mục cho bảng `tbltickets_status`
--
ALTER TABLE `tbltickets_status`
  ADD PRIMARY KEY (`ticketstatusid`);

--
-- Chỉ mục cho bảng `tblticket_attachments`
--
ALTER TABLE `tblticket_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblticket_replies`
--
ALTER TABLE `tblticket_replies`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbltodos`
--
ALTER TABLE `tbltodos`
  ADD PRIMARY KEY (`todoid`);

--
-- Chỉ mục cho bảng `tbltracked_mails`
--
ALTER TABLE `tbltracked_mails`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbltwocheckout_log`
--
ALTER TABLE `tbltwocheckout_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Chỉ mục cho bảng `tbluser_meta`
--
ALTER TABLE `tbluser_meta`
  ADD PRIMARY KEY (`umeta_id`);

--
-- Chỉ mục cho bảng `tblvault`
--
ALTER TABLE `tblvault`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblviews_tracking`
--
ALTER TABLE `tblviews_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblweb_to_lead`
--
ALTER TABLE `tblweb_to_lead`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tblactivity_log`
--
ALTER TABLE `tblactivity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `tblannouncements`
--
ALTER TABLE `tblannouncements`
  MODIFY `announcementid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblclients`
--
ALTER TABLE `tblclients`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tblconsents`
--
ALTER TABLE `tblconsents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblconsent_purposes`
--
ALTER TABLE `tblconsent_purposes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblcontacts`
--
ALTER TABLE `tblcontacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblcontact_permissions`
--
ALTER TABLE `tblcontact_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblcontracts`
--
ALTER TABLE `tblcontracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblcontracts_types`
--
ALTER TABLE `tblcontracts_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblcontract_comments`
--
ALTER TABLE `tblcontract_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblcontract_renewals`
--
ALTER TABLE `tblcontract_renewals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblcountries`
--
ALTER TABLE `tblcountries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT cho bảng `tblcreditnotes`
--
ALTER TABLE `tblcreditnotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblcreditnote_refunds`
--
ALTER TABLE `tblcreditnote_refunds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblcredits`
--
ALTER TABLE `tblcredits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblcurrencies`
--
ALTER TABLE `tblcurrencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tblcustomers_groups`
--
ALTER TABLE `tblcustomers_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblcustomer_groups`
--
ALTER TABLE `tblcustomer_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblcustomfields`
--
ALTER TABLE `tblcustomfields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblcustomfieldsvalues`
--
ALTER TABLE `tblcustomfieldsvalues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `departmentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbldismissed_announcements`
--
ALTER TABLE `tbldismissed_announcements`
  MODIFY `dismissedannouncementid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblemailtemplates`
--
ALTER TABLE `tblemailtemplates`
  MODIFY `emailtemplateid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT cho bảng `tblestimates`
--
ALTER TABLE `tblestimates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblestimate_requests`
--
ALTER TABLE `tblestimate_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblestimate_request_forms`
--
ALTER TABLE `tblestimate_request_forms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblestimate_request_status`
--
ALTER TABLE `tblestimate_request_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tblevents`
--
ALTER TABLE `tblevents`
  MODIFY `eventid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblexpenses`
--
ALTER TABLE `tblexpenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblexpenses_categories`
--
ALTER TABLE `tblexpenses_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblfiles`
--
ALTER TABLE `tblfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblfilters`
--
ALTER TABLE `tblfilters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblform_questions`
--
ALTER TABLE `tblform_questions`
  MODIFY `questionid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblform_question_box`
--
ALTER TABLE `tblform_question_box`
  MODIFY `boxid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblform_question_box_description`
--
ALTER TABLE `tblform_question_box_description`
  MODIFY `questionboxdescriptionid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblform_results`
--
ALTER TABLE `tblform_results`
  MODIFY `resultid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblgdpr_requests`
--
ALTER TABLE `tblgdpr_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblinvoicepaymentrecords`
--
ALTER TABLE `tblinvoicepaymentrecords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblinvoices`
--
ALTER TABLE `tblinvoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblitemable`
--
ALTER TABLE `tblitemable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblitems`
--
ALTER TABLE `tblitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblitems_groups`
--
ALTER TABLE `tblitems_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblitem_tax`
--
ALTER TABLE `tblitem_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblknowedge_base_article_feedback`
--
ALTER TABLE `tblknowedge_base_article_feedback`
  MODIFY `articleanswerid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblknowledge_base`
--
ALTER TABLE `tblknowledge_base`
  MODIFY `articleid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblknowledge_base_groups`
--
ALTER TABLE `tblknowledge_base_groups`
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblleads`
--
ALTER TABLE `tblleads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblleads_email_integration`
--
ALTER TABLE `tblleads_email_integration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'the ID always must be 1', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tblleads_sources`
--
ALTER TABLE `tblleads_sources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tblleads_status`
--
ALTER TABLE `tblleads_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbllead_activity_log`
--
ALTER TABLE `tbllead_activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbllead_integration_emails`
--
ALTER TABLE `tbllead_integration_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblmail_queue`
--
ALTER TABLE `tblmail_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblmilestones`
--
ALTER TABLE `tblmilestones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblmodules`
--
ALTER TABLE `tblmodules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblnewsfeed_comment_likes`
--
ALTER TABLE `tblnewsfeed_comment_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblnewsfeed_posts`
--
ALTER TABLE `tblnewsfeed_posts`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblnewsfeed_post_comments`
--
ALTER TABLE `tblnewsfeed_post_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblnewsfeed_post_likes`
--
ALTER TABLE `tblnewsfeed_post_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblnotes`
--
ALTER TABLE `tblnotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblnotifications`
--
ALTER TABLE `tblnotifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbloptions`
--
ALTER TABLE `tbloptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=456;

--
-- AUTO_INCREMENT cho bảng `tblpayment_attempts`
--
ALTER TABLE `tblpayment_attempts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblpayment_modes`
--
ALTER TABLE `tblpayment_modes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tblpinned_projects`
--
ALTER TABLE `tblpinned_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblprojectdiscussioncomments`
--
ALTER TABLE `tblprojectdiscussioncomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblprojectdiscussions`
--
ALTER TABLE `tblprojectdiscussions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblprojects`
--
ALTER TABLE `tblprojects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tblproject_activity`
--
ALTER TABLE `tblproject_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tblproject_files`
--
ALTER TABLE `tblproject_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblproject_members`
--
ALTER TABLE `tblproject_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tblproject_notes`
--
ALTER TABLE `tblproject_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblproject_settings`
--
ALTER TABLE `tblproject_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `tblproposals`
--
ALTER TABLE `tblproposals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblproposal_comments`
--
ALTER TABLE `tblproposal_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblrelated_items`
--
ALTER TABLE `tblrelated_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblreminders`
--
ALTER TABLE `tblreminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblroles`
--
ALTER TABLE `tblroles`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tblsales_activity`
--
ALTER TABLE `tblsales_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblscheduled_emails`
--
ALTER TABLE `tblscheduled_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `serviceid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblspam_filters`
--
ALTER TABLE `tblspam_filters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblstaff`
--
ALTER TABLE `tblstaff`
  MODIFY `staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tblstaff_departments`
--
ALTER TABLE `tblstaff_departments`
  MODIFY `staffdepartmentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblsubscriptions`
--
ALTER TABLE `tblsubscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbltags`
--
ALTER TABLE `tbltags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbltasks`
--
ALTER TABLE `tbltasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbltaskstimers`
--
ALTER TABLE `tbltaskstimers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbltasks_checklist_templates`
--
ALTER TABLE `tbltasks_checklist_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbltask_assigned`
--
ALTER TABLE `tbltask_assigned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbltask_checklist_items`
--
ALTER TABLE `tbltask_checklist_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbltask_comments`
--
ALTER TABLE `tbltask_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbltask_followers`
--
ALTER TABLE `tbltask_followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbltaxes`
--
ALTER TABLE `tbltaxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbltemplates`
--
ALTER TABLE `tbltemplates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbltickets`
--
ALTER TABLE `tbltickets`
  MODIFY `ticketid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbltickets_pipe_log`
--
ALTER TABLE `tbltickets_pipe_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbltickets_predefined_replies`
--
ALTER TABLE `tbltickets_predefined_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbltickets_priorities`
--
ALTER TABLE `tbltickets_priorities`
  MODIFY `priorityid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbltickets_status`
--
ALTER TABLE `tbltickets_status`
  MODIFY `ticketstatusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tblticket_attachments`
--
ALTER TABLE `tblticket_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblticket_replies`
--
ALTER TABLE `tblticket_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbltodos`
--
ALTER TABLE `tbltodos`
  MODIFY `todoid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbltracked_mails`
--
ALTER TABLE `tbltracked_mails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbltwocheckout_log`
--
ALTER TABLE `tbltwocheckout_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbluser_meta`
--
ALTER TABLE `tbluser_meta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblvault`
--
ALTER TABLE `tblvault`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblviews_tracking`
--
ALTER TABLE `tblviews_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblweb_to_lead`
--
ALTER TABLE `tblweb_to_lead`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tblfilter_defaults`
--
ALTER TABLE `tblfilter_defaults`
  ADD CONSTRAINT `tblfilter_defaults_ibfk_1` FOREIGN KEY (`filter_id`) REFERENCES `tblfilters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tblfilter_defaults_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `tblstaff` (`staffid`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `tbltwocheckout_log`
--
ALTER TABLE `tbltwocheckout_log`
  ADD CONSTRAINT `tbltwocheckout_log_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `tblinvoices` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
