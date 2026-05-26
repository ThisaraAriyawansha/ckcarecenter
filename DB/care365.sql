-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2026 at 04:34 PM
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
-- Database: `care365`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `title_slug` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `title_slug`, `name`, `date`, `description`, `image_path`, `is_public`, `created_at`, `updated_at`) VALUES
(1, 'Benefits of Assisted Living for Seniors', 'benefits-of-assisted-living-for-seniors', 'Kamal Disanayake', '2026-01-20', 'Discover how assisted living improves seniors’ quality of life by providing daily support, medical care, and social engagement in a safe and friendly environment.', 'blog_20260120064212_uHi1IPpQ.png', 1, '2026-01-20 01:12:12', '2026-01-20 01:12:12'),
(2, 'How Nutrition Impacts Senior Health', 'how-nutrition-impacts-senior-health', 'Nirmala Fernando', '2026-01-20', 'A healthy diet is vital for seniors. Learn about the key nutrients that support mobility, immunity, and overall well-being in elderly care.', 'blog_20260120064318_S8iaENKc.jpg', 1, '2026-01-20 01:13:18', '2026-01-20 01:13:18'),
(3, 'Importance of Mental Wellness in Retirement', 'importance-of-mental-wellness-in-retirement', 'Sunil Perera', '2026-01-20', 'Maintaining emotional and mental well-being is essential for seniors. Explore activities and programs that foster social interaction and happiness.', 'blog_20260120064406_ZOpY6EDr.jpg', 1, '2026-01-20 01:14:06', '2026-01-20 01:14:06'),
(4, 'Tips for a Safe and Comfortable Elderly Home', 'tips-for-a-safe-and-comfortable-elderly-home', 'Lakshmi Silva', '2026-01-20', 'Simple adjustments at home can improve safety and comfort for elderly residents. Here are practical tips for creating a secure and supportive environment.', 'blog_20260120064519_61AhCZWP.jpg', 1, '2026-01-20 01:15:19', '2026-01-20 01:15:19'),
(5, 'he Role of Technology in Modern Elderly Care', 'he-role-of-technology-in-modern-elderly-care', 'W. K. Jayasinghe', '2026-01-20', 'From health monitoring systems to communication tools, discover how technology enhances care, safety, and connection for seniors.', 'blog_20260120064629_fuvi4yLC.jpg', 1, '2026-01-20 01:16:29', '2026-01-20 01:16:29'),
(6, 'Engaging Activities for a Happy Retirement', 'engaging-activities-for-a-happy-retirement', 'Anusha Wijeratne', '2026-01-20', 'Keeping seniors active is key to happiness and health. Learn about recreational and social activities that encourage engagement and joy.', 'blog_20260120084845_cZMzvwCu.jpg', 1, '2026-01-20 03:18:45', '2026-01-20 03:18:45');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('care365-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:0:{}s:11:\"permissions\";a:0:{}s:5:\"roles\";a:0:{}}', 1768990423);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `national_id_number` varchar(255) DEFAULT NULL,
  `passport_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `alternative_phone` varchar(255) DEFAULT NULL,
  `current_address` text NOT NULL,
  `permanent_address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `emergency_contact_name` varchar(255) NOT NULL,
  `emergency_contact_relationship` varchar(255) NOT NULL,
  `emergency_contact_phone` varchar(255) NOT NULL,
  `emergency_contact_alternative_phone` varchar(255) DEFAULT NULL,
  `joining_date` date NOT NULL,
  `contract_start_date` date DEFAULT NULL,
  `contract_end_date` date DEFAULT NULL,
  `employment_type` enum('full_time','part_time','contract','temporary') NOT NULL DEFAULT 'full_time',
  `employment_status` enum('active','on_leave','suspended','terminated','resigned') NOT NULL DEFAULT 'active',
  `job_title` varchar(255) DEFAULT NULL,
  `job_description` text DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supervisor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `salary_type` enum('hourly','daily','weekly','monthly','annual') NOT NULL DEFAULT 'monthly',
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `bank_branch` varchar(255) DEFAULT NULL,
  `highest_qualification` varchar(255) DEFAULT NULL,
  `certifications` text DEFAULT NULL,
  `specialized_training` text DEFAULT NULL,
  `years_of_experience` int(11) DEFAULT NULL,
  `previous_employment` text DEFAULT NULL,
  `dbs_check_date` date DEFAULT NULL,
  `dbs_certificate_number` varchar(255) DEFAULT NULL,
  `dbs_expiry_date` date DEFAULT NULL,
  `medical_check_date` date DEFAULT NULL,
  `medical_expiry_date` date DEFAULT NULL,
  `medical_conditions` text DEFAULT NULL,
  `allergies` text DEFAULT NULL,
  `induction_completed_date` date DEFAULT NULL,
  `fire_safety_training_date` date DEFAULT NULL,
  `first_aid_training_date` date DEFAULT NULL,
  `manual_handling_training_date` date DEFAULT NULL,
  `safeguarding_training_date` date DEFAULT NULL,
  `infection_control_training_date` date DEFAULT NULL,
  `uniform_size` varchar(255) DEFAULT NULL,
  `has_driving_license` tinyint(1) NOT NULL DEFAULT 0,
  `driving_license_number` varchar(255) DEFAULT NULL,
  `driving_license_expiry` date DEFAULT NULL,
  `has_own_vehicle` tinyint(1) NOT NULL DEFAULT 0,
  `notes` text DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `career_attendances`
--

CREATE TABLE `career_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `manager_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `career_documents`
--

CREATE TABLE `career_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `career_id` bigint(20) UNSIGNED NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `uploaded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `care_homes`
--

CREATE TABLE `care_homes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `subtitle` varchar(150) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `contact_no` varchar(30) DEFAULT NULL,
  `badge_text` varchar(50) DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `care_homes`
--

INSERT INTO `care_homes` (`id`, `title`, `subtitle`, `location`, `description`, `image_path`, `contact_no`, `badge_text`, `is_public`, `created_at`, `updated_at`) VALUES
(1, 'Care Home | Negombo', 'Pinnacle 365', 'Negombo', 'Our Luxury Care Home featuring Individual Rooms Only.Designed with modern comforts and amenities, this home will redefine the standard of care, combining thoughtfully planned living spaces, engaging common areas, and seamless integration of cutting-edge technology.\n', 'carehome_20260120060144_0CQPkmwH.jpg', '+94776604040', 'Care Home', 1, '2026-01-20 00:31:44', '2026-01-20 00:31:44'),
(2, 'Care Home | Colombo', 'Admission Open', 'Colombo', 'We currently operate from our Thalawathugoda, Hokandara, Colombo location, providing exceptional care in a warm, welcoming environment.Stay tuned as we bring our vision of elevated senior living to life, setting new standards in Sri Lanka.\n', 'carehome_20260120060307_0KQGeU2r.jpg', '+94776604040', 'Admission Open', 1, '2026-01-20 00:33:07', '2026-01-20 00:33:07'),
(3, 'Care Home | Kandy', 'Constructions in Progress', 'Kandy', 'Exciting times are ahead as Care365 prepares to open our brand-new, state-of-the-art facility in Sri Lanka.\nDesigned with modern comforts and amenities, this home will redefine the standard of care, combining thoughtfully planned living spaces, engaging common areas, and seamless integration of cutting-edge technology.\n', 'carehome_20260120060400_PcE8q9tN.jpg', '+94776604040', 'Constructions in Progress', 1, '2026-01-20 00:34:00', '2026-01-20 04:44:38');

-- --------------------------------------------------------

--
-- Table structure for table `chef_checklists`
--

CREATE TABLE `chef_checklists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chef_id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `week_number` varchar(255) DEFAULT NULL,
  `month` varchar(255) NOT NULL,
  `dining_tasks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`dining_tasks`)),
  `kitchen_dinning_tasks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`kitchen_dinning_tasks`)),
  `bathroom_tasks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`bathroom_tasks`)),
  `common_area_tasks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`common_area_tasks`)),
  `chef_signed` tinyint(1) NOT NULL DEFAULT 0,
  `chef_signed_at` timestamp NULL DEFAULT NULL,
  `manager_signed` tinyint(1) NOT NULL DEFAULT 0,
  `manager_signed_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reg_number` varchar(255) NOT NULL,
  `image` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `dob` date NOT NULL,
  `co_morbidities_risk_factors` text DEFAULT NULL,
  `complaints` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`complaints`)),
  `height_cm` decimal(5,2) DEFAULT NULL,
  `weight_kg` decimal(5,2) DEFAULT NULL,
  `bmi` decimal(5,2) DEFAULT NULL,
  `waist_circumference` decimal(5,2) DEFAULT NULL,
  `hip_circumference` decimal(5,2) DEFAULT NULL,
  `officer_in_charge_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_daily_checklists`
--

CREATE TABLE `client_daily_checklists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `category` varchar(255) NOT NULL,
  `task_key` varchar(255) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') DEFAULT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `completed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_doctor`
--

CREATE TABLE `client_doctor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_date` date NOT NULL DEFAULT '2026-01-19',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_documents`
--

CREATE TABLE `client_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `document_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `uploaded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `is_confidential` tinyint(1) NOT NULL DEFAULT 0,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_guardian`
--

CREATE TABLE `client_guardian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_meals`
--

CREATE TABLE `client_meals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `meal_date` date NOT NULL,
  `meal_time` time NOT NULL,
  `meal_type` enum('breakfast','lunch','dinner','snack') NOT NULL DEFAULT 'lunch',
  `meal_items` text NOT NULL,
  `notes` text DEFAULT NULL,
  `recorded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_outings`
--

CREATE TABLE `client_outings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time_out` time NOT NULL,
  `time_in` time DEFAULT NULL,
  `reason` text NOT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `accompanied_by` bigint(20) UNSIGNED DEFAULT NULL,
  `transport_mode` varchar(255) DEFAULT NULL,
  `status` enum('out','returned','cancelled') NOT NULL DEFAULT 'out',
  `notes` text DEFAULT NULL,
  `authorized_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(20) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `number`, `subject`, `message`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 'Thisara', 'thisara@gmail.com', '0765544567', 'Paralysis Care', 'ABC CDE', 0, NULL, '2026-01-19 21:33:22', '2026-01-19 21:39:32');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `license_number` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_notes`
--

CREATE TABLE `doctor_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `note_date` date NOT NULL,
  `notes` text NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `alternative_phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `joining_potential` enum('level_1','level_2','level_3','level_4') NOT NULL COMMENT 'Level 1: High Priority, Level 2: Medium Priority, Level 3: Low Priority, Level 4: Very Low Priority',
  `requirements` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('new','contacted','scheduled','converted','not_interested','follow_up') NOT NULL DEFAULT 'new',
  `follow_up_date` date DEFAULT NULL,
  `handled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `expense_date` date NOT NULL,
  `category` varchar(255) NOT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  `receipt_number` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `visibility` enum('public','private') NOT NULL DEFAULT 'public',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `visibility`, `created_at`, `updated_at`) VALUES
(2, 'What services are provided at your elderly retirement home?', 'Our retirement home provides 24/7 medical supervision, nutritious meals, housekeeping, recreational activities, physiotherapy, and personalized care plans to ensure a safe and comfortable living environment for our residents.', 'public', '2026-01-19 22:04:08', '2026-01-19 22:04:08'),
(3, 'Is medical assistance available at all times?', 'Yes, qualified nurses and caregivers are available 24 hours a day, and doctors visit regularly. Emergency medical support is also arranged whenever required.\nVisibility: public', 'public', '2026-01-19 22:04:23', '2026-01-19 22:04:23'),
(4, 'What types of accommodation are available?', 'We offer private rooms, shared rooms, and assisted living units designed for comfort, safety, and accessibility for elderly residents.', 'public', '2026-01-19 22:04:36', '2026-01-19 22:04:36'),
(5, 'Are meals customized for special dietary needs?', 'Yes, all meals are prepared under the guidance of nutritionists, and special dietary requirements such as diabetic, low-sodium, or vegetarian meals are fully accommodated.', 'public', '2026-01-19 22:04:49', '2026-01-19 22:04:49'),
(6, 'Can family members visit residents?', 'Family members are welcome to visit during designated visiting hours. We also encourage family involvement in special events and care planning.', 'public', '2026-01-19 22:05:03', '2026-01-19 22:05:03'),
(7, 'How do you ensure the safety of residents?', 'Our facility is equipped with CCTV surveillance, emergency call systems, trained staff, and secure premises to ensure the safety and well-being of all residents.', 'public', '2026-01-19 22:05:19', '2026-01-19 22:05:19'),
(8, 'What recreational activities are offered?', 'We organize social gatherings, exercise programs, indoor games, gardening, religious activities, and entertainment sessions to keep residents active and engaged.', 'public', '2026-01-19 22:05:33', '2026-01-19 22:05:33'),
(9, 'Who can apply to stay at the retirement home?', 'Our retirement home welcomes senior citizens who are able to live independently as well as those who require assisted or full-time care, depending on their health condition.', 'public', '2026-01-19 22:06:12', '2026-01-19 22:06:12'),
(10, 'Do you provide long-term and short-term stays?', 'Yes, we offer both long-term residency and short-term stays for recovery, respite care, or temporary accommodation needs.', 'public', '2026-01-19 22:06:24', '2026-01-19 22:06:24'),
(11, 'Are residents allowed to bring personal belongings?', 'Yes, residents are encouraged to bring personal items such as photos, small furniture, and decorations to make their living space feel like home.', 'public', '2026-01-19 22:06:42', '2026-01-19 22:06:42'),
(12, 'How are caregivers selected and trained?', 'All caregivers are professionally trained, experienced, and carefully selected. Regular training programs are conducted to maintain high standards of elderly care and compassion.', 'public', '2026-01-19 22:06:54', '2026-01-19 22:06:54'),
(13, 'Is transportation provided for hospital visits and outings?', 'Yes, transportation services are available for medical appointments, hospital visits, and scheduled outings with proper assistance and supervision.', 'public', '2026-01-19 22:07:06', '2026-01-19 22:07:06'),
(14, 'What happens in case of a medical emergency?', 'In the event of an emergency, immediate medical attention is provided, family members are informed promptly, and the resident is transferred to the nearest hospital if required.', 'public', '2026-01-19 22:07:18', '2026-01-19 22:07:18'),
(15, 'Are religious and cultural practices respected?', 'Absolutely. We respect all religious and cultural beliefs and provide opportunities for residents to practice their traditions comfortably.', 'public', '2026-01-19 22:07:28', '2026-01-19 22:07:28'),
(16, 'How do you support mental and emotional well-being?', 'We focus on emotional health through social interaction, counseling support, engaging activities, and a warm, family-like environment to reduce loneliness and stress.', 'public', '2026-01-19 22:07:39', '2026-01-19 22:07:39');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `category_name`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'Facility & Environment', 'gallery_20260120042226_WxIzl6iu.jpg', '2026-01-19 22:52:26', '2026-01-19 22:52:26'),
(2, 'Resident Rooms', 'gallery_20260120044519_Mwrs68Iq.jpg', '2026-01-19 23:15:19', '2026-01-19 23:15:19'),
(3, 'Medical & Care Services', 'gallery_20260120044628_eFD1ouwE.jpg', '2026-01-19 23:16:28', '2026-01-19 23:16:28'),
(4, 'Daily Activities', 'gallery_20260120045035_UGfPEZwn.jpg', '2026-01-19 23:20:35', '2026-01-19 23:20:35'),
(5, 'Dining & Nutrition', 'gallery_20260120045111_r8nlq33J.jpg', '2026-01-19 23:21:11', '2026-01-19 23:21:11'),
(6, 'Recreation & Entertainment', 'gallery_20260120045231_2nLOkMY5.jpg', '2026-01-19 23:22:31', '2026-01-19 23:22:31'),
(7, 'Safety & Security', 'gallery_20260120045334_pFo6mq5y.jpg', '2026-01-19 23:23:34', '2026-01-19 23:23:34'),
(8, 'Staff & Caregivers', 'gallery_20260120045420_gScgX33C.jpg', '2026-01-19 23:24:20', '2026-01-19 23:24:20'),
(9, 'Outdoor & Garden Areas', 'gallery_20260120045525_d6xy23hR.jpg', '2026-01-19 23:25:25', '2026-01-19 23:25:25'),
(10, 'Special Events', 'gallery_20260120045612_9MpqFAYG.jpg', '2026-01-19 23:26:12', '2026-01-19 23:26:12');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `drug_name` varchar(255) NOT NULL,
  `dosage` varchar(255) DEFAULT NULL,
  `frequency` enum('morning','afternoon','evening','morning_afternoon','morning_evening','afternoon_evening','all_three') NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medication_records`
--

CREATE TABLE `medication_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medication_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time_of_day` enum('morning','afternoon','evening') NOT NULL,
  `given` tinyint(1) NOT NULL DEFAULT 0,
  `given_by` bigint(20) UNSIGNED DEFAULT NULL,
  `given_at` time DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_22_222216_create_permission_tables', 1),
(5, '2025_12_22_232700_create_clients_table', 1),
(6, '2025_12_22_233436_add_image_and_complaints_to_clients_table', 1),
(7, '2025_12_22_234101_create_branches_table', 1),
(8, '2025_12_22_234119_add_branch_id_to_users_and_clients_tables', 1),
(9, '2025_12_22_234805_create_doctors_table', 1),
(10, '2025_12_22_235120_make_license_number_nullable_in_doctors_table', 1),
(11, '2025_12_23_000128_create_medications_table', 1),
(12, '2025_12_23_000129_create_medication_records_table', 1),
(13, '2025_12_24_185233_update_clients_table_image_to_integer', 1),
(14, '2025_12_25_232622_create_client_outings_table', 1),
(15, '2025_12_26_001137_create_client_documents_table', 1),
(16, '2025_12_26_134937_create_client_daily_checklists_table', 1),
(17, '2025_12_26_164633_create_career_attendances_table', 1),
(18, '2025_12_26_171821_create_visitor_logs_table', 1),
(19, '2025_12_26_180845_create_doctor_notes_table', 1),
(20, '2025_12_26_212250_create_payments_table', 1),
(21, '2025_12_29_035447_create_chef_checklists_table', 1),
(22, '2025_12_29_224657_create_enquiries_table', 1),
(23, '2025_12_29_231751_create_careers_table', 1),
(24, '2025_12_29_231842_create_career_documents_table', 1),
(25, '2025_12_30_001425_add_bank_branch_to_careers_table', 1),
(26, '2025_12_30_004137_create_payslips_table', 1),
(27, '2025_12_30_163041_create_client_meals_table', 1),
(28, '2025_12_31_232250_add_client_id_to_visitor_logs_table', 1),
(29, '2026_01_02_183555_create_expenses_table', 1),
(30, '2026_01_20_025957_create_contact_messages_table', 2),
(31, '2026_01_20_031545_create_faqs_table', 3),
(32, '2026_01_20_034626_create_testimonials_table', 4),
(33, '2026_01_20_034933_add_message_to_testimonials_table', 5),
(34, '2026_01_20_041811_create_galleries_table', 6),
(35, '2026_01_20_050853_create_services_table', 7),
(36, '2026_01_20_053307_create_whoweares_table', 8),
(37, '2026_01_20_055622_create_care_homes_table', 9),
(38, '2026_01_20_063801_create_blogs_table', 10),
(39, '2026_01_20_084451_add_title_slug_to_blogs_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `email_sent` tinyint(1) NOT NULL DEFAULT 0,
  `email_sent_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payslips`
--

CREATE TABLE `payslips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `career_id` bigint(20) UNSIGNED NOT NULL,
  `payslip_number` varchar(255) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `basic_salary` decimal(10,2) NOT NULL,
  `allowances` decimal(10,2) NOT NULL DEFAULT 0.00,
  `overtime` decimal(10,2) NOT NULL DEFAULT 0.00,
  `bonus` decimal(10,2) NOT NULL DEFAULT 0.00,
  `gross_salary` decimal(10,2) NOT NULL,
  `epf_employee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `other_deductions` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_deductions` decimal(10,2) NOT NULL,
  `net_salary` decimal(10,2) NOT NULL,
  `status` enum('draft','sent','paid') NOT NULL DEFAULT 'draft',
  `sent_at` timestamp NULL DEFAULT NULL,
  `generated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2026-01-19 07:31:25', '2026-01-19 07:31:25');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `title_slug` varchar(150) NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `image_path`, `title_slug`, `is_public`, `created_at`, `updated_at`) VALUES
(1, '24/7 Medical Care', 'Our retirement home provides continuous medical supervision with qualified nurses available day and night. Regular health checkups, medication management, emergency response, and doctor consultations ensure that every resident receives timely and professional medical attention in a safe and caring environment.', 'service_20260120051519_xnM9j2ln.jpg', '247-medical-care', 1, '2026-01-19 23:45:19', '2026-01-19 23:45:19'),
(2, 'Assisted Living Support', 'We offer personalized assisted living services for residents who need help with daily activities such as bathing, dressing, mobility, and medication reminders. Our caregivers are trained to provide compassionate support while respecting independence, privacy, and dignity at all times.', 'service_20260120051612_ZampH2qu.jpg', 'assisted-living-support', 1, '2026-01-19 23:46:12', '2026-01-19 23:46:12'),
(3, 'Nutritious Meal Services', 'Healthy, well-balanced meals are prepared fresh every day under the guidance of nutrition experts. Special dietary plans including diabetic-friendly, low-salt, vegetarian, and soft-food options are carefully designed to meet individual health needs and preferences.', 'service_20260120051745_y9xfunMd.jpg', 'nutritious-meal-services', 1, '2026-01-19 23:47:45', '2026-01-19 23:47:45'),
(4, 'Comfortable Accommodation', 'Our living spaces are designed with elderly comfort and safety in mind. Residents can choose between private and shared rooms that are clean, spacious, and equipped with safety features such as handrails, emergency call buttons, and easy-access bathrooms.', 'service_20260120051856_G2ycnU5N.jpg', 'comfortable-accommodation', 1, '2026-01-19 23:48:56', '2026-01-19 23:48:56'),
(5, 'Physiotherapy & Wellness Programs', 'We provide professionally guided physiotherapy and wellness programs tailored to each resident’s physical condition. These programs help improve mobility, reduce pain, enhance balance, and promote overall physical independence and confidence.', 'service_20260120051952_Yo70G5Si.jpg', 'physiotherapy-wellness-programs', 1, '2026-01-19 23:49:52', '2026-01-19 23:49:52'),
(6, 'Recreational & Social Activities', 'A variety of recreational and social activities are organized to keep residents mentally active and emotionally fulfilled. These include group games, music sessions, gardening, religious activities, and cultural events that encourage social interaction and joy.', 'service_20260120052049_DWWifMUP.jpg', 'recreational-social-activities', 1, '2026-01-19 23:50:49', '2026-01-19 23:50:49'),
(7, 'Safety & Security Monitoring', 'The safety of our residents is a top priority. Our facility is equipped with 24/7 CCTV surveillance, secure access control, emergency alert systems, and trained staff to ensure a protected and worry-free living environment.', 'service_20260120052146_GM2FveOw.jpg', 'safety-security-monitoring', 1, '2026-01-19 23:51:46', '2026-01-19 23:51:46'),
(8, 'Housekeeping & Laundry Services', 'We provide regular housekeeping and laundry services to maintain high standards of cleanliness and hygiene. Our staff ensures that living spaces remain fresh, organized, and comfortable, allowing residents to enjoy a stress-free lifestyle.', 'service_20260120052230_6CaCVuwb.jpg', 'housekeeping-laundry-services', 1, '2026-01-19 23:52:30', '2026-01-19 23:52:30'),
(9, 'Transportation & Hospital Visits', 'Safe and reliable transportation services are available for hospital visits, medical appointments, and essential outings. Our trained staff assists residents during travel, ensuring comfort, safety, and timely access to healthcare facilities..', 'service_20260120052320_SoTKu6KR.jpg', 'transportation-hospital-visits', 1, '2026-01-19 23:53:20', '2026-01-19 23:53:34'),
(10, 'Emotional & Mental Well-Being Care', 'We understand the importance of emotional and mental health in later life. Our care approach focuses on companionship, emotional support, counseling sessions, and creating a warm, family-like environment that helps residents feel valued and connected.', 'service_20260120052436_kPXwujNM.jpg', 'emotional-mental-well-being-care', 1, '2026-01-19 23:54:36', '2026-01-19 23:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dfyGrAMsfEGJS1NZHITfrY2ZuxOatIZClyjR2iJr', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiNklDSU1yTUVxc2tWeHJNTWFoeGhCTnJzZlpzWWZaekUzcWlrcFZJNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRFTnZuTjYxS0tMTUM4QWhVNEhzdHV1Y3MxQjlMNEYuNm5pazdVQjJSYVppaVIzRFZXNmVFNiI7czo4OiJmaWxhbWVudCI7YTowOnt9fQ==', 1768915739);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL DEFAULT 5,
  `message` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `position`, `rating`, `message`, `image_path`, `is_public`, `created_at`, `updated_at`) VALUES
(1, 'Sunil Perera', 'Bank Officer', 5, 'As a Bank Officer, I value trust and responsibility. Choosing this retirement home for my mother was the right decision. The care, safety, and professionalism shown by the staff give our family complete peace of mind.', 'testimonial_20260120035905_g1IXyq97.jpg', 1, '2026-01-19 22:29:05', '2026-01-19 22:33:46'),
(2, 'Nirmala Fernando', 'School Teacher', 4, 'The compassion and patience shown by the caregivers truly stand out. My father is happy, comfortable, and well cared for. This place genuinely feels like a second home.', 'testimonial_20260120040503_7JRs7sot.jpg', 1, '2026-01-19 22:34:22', '2026-01-19 22:35:03'),
(3, 'R. M. Gunawardena', 'Retired Government Officer', 5, 'I appreciate the respectful and disciplined environment here. The staff is attentive, and the daily routines help residents maintain a balanced and peaceful lifestyle.', 'testimonial_20260120040617_XvyeHhaM.jpg', 1, '2026-01-19 22:36:17', '2026-01-19 22:36:17'),
(4, 'Lakshmi Silva', 'Human Resources Manager', 5, 'From a professional perspective, the management and caregivers are extremely well organized. Communication is clear, and the quality of care provided is exceptional.', 'testimonial_20260120040806_BxwHF5L2.jpg', 1, '2026-01-19 22:38:06', '2026-01-19 22:38:06'),
(5, 'W. K. Jayasinghe', 'Chartered Accountant', 3, 'Transparency and reliability matter to me. This retirement home maintains high standards in care, safety, and overall service. I would confidently recommend it to others.', 'testimonial_20260120040852_OhWRu7dD.jpg', 1, '2026-01-19 22:38:52', '2026-01-19 22:38:52'),
(6, 'Anusha Wijeratne', 'Software Engineer', 4, 'The facility is well maintained, and the staff uses modern systems to manage care efficiently. Most importantly, the environment is warm and respectful toward residents.', 'testimonial_20260120041026_OpJgyh76.jpg', 1, '2026-01-19 22:40:26', '2026-01-19 22:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `branch_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Thisara', 'admin@gmail.com', NULL, '$2y$12$ENvnN61KKLMC8AhU4Hstuucs1B9L4F.6nik7UB2RaZiiR3DVW6eE6', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `visit_date` date NOT NULL,
  `visitor_name` varchar(255) NOT NULL,
  `visitor_contact` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `whoweares`
--

CREATE TABLE `whoweares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 999,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `whoweares`
--

INSERT INTO `whoweares` (`id`, `title`, `description`, `image_path`, `display_order`, `is_public`, `created_at`, `updated_at`) VALUES
(1, 'Who We Are', 'Care 365 provides compassionate and reliable elderly care in a safe, respectful, and comfortable environment throughout the year.', 'whoweare_20260120053915_ZcVtytP9.jpg', 1, 1, '2026-01-20 00:09:15', '2026-01-20 00:09:15'),
(2, 'Our Vision', 'To be a trusted leader in elderly care by enhancing quality of life with compassion and excellence.', 'whoweare_20260120054022_1QRkVsQX.jpg', 2, 1, '2026-01-20 00:10:22', '2026-01-20 00:10:22'),
(3, 'Our Mission', 'To deliver personalized elderly care with professionalism, dignity, and continuous support.', 'whoweare_20260120054105_JAkq4s4u.jpg', 3, 1, '2026-01-20 00:11:05', '2026-01-20 00:11:05'),
(4, 'Our Values', 'We value respect, empathy, integrity, and excellence in every aspect of elderly care.', 'whoweare_20260120054219_KbHFMQfl.jpg', 4, 1, '2026-01-20 00:12:19', '2026-01-20 00:12:19'),
(5, 'Our Technology', 'We use modern technology to ensure efficient care, safety, and transparent communication.\n', 'whoweare_20260120054317_kwVoQ1gO.jpg', 5, 1, '2026-01-20 00:13:17', '2026-01-20 00:13:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_title_slug_unique` (`title_slug`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_code_unique` (`code`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `careers_employee_id_unique` (`employee_id`),
  ADD KEY `careers_user_id_foreign` (`user_id`),
  ADD KEY `careers_branch_id_foreign` (`branch_id`),
  ADD KEY `careers_supervisor_id_foreign` (`supervisor_id`);

--
-- Indexes for table `career_attendances`
--
ALTER TABLE `career_attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_career_date` (`user_id`,`date`),
  ADD KEY `career_attendances_branch_id_foreign` (`branch_id`),
  ADD KEY `career_attendances_approved_by_foreign` (`approved_by`),
  ADD KEY `career_attendances_date_index` (`date`),
  ADD KEY `career_attendances_status_index` (`status`);

--
-- Indexes for table `career_documents`
--
ALTER TABLE `career_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `career_documents_career_id_foreign` (`career_id`),
  ADD KEY `career_documents_uploaded_by_foreign` (`uploaded_by`);

--
-- Indexes for table `care_homes`
--
ALTER TABLE `care_homes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chef_checklists`
--
ALTER TABLE `chef_checklists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chef_checklists_chef_id_date_unique` (`chef_id`,`date`),
  ADD KEY `chef_checklists_manager_id_foreign` (`manager_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_reg_number_unique` (`reg_number`),
  ADD KEY `clients_officer_in_charge_id_foreign` (`officer_in_charge_id`),
  ADD KEY `clients_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `client_daily_checklists`
--
ALTER TABLE `client_daily_checklists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_client_task_date` (`client_id`,`date`,`task_key`),
  ADD KEY `client_daily_checklists_completed_by_foreign` (`completed_by`);

--
-- Indexes for table `client_doctor`
--
ALTER TABLE `client_doctor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_doctor_client_id_foreign` (`client_id`),
  ADD KEY `client_doctor_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `client_documents`
--
ALTER TABLE `client_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_documents_client_id_foreign` (`client_id`),
  ADD KEY `client_documents_uploaded_by_foreign` (`uploaded_by`);

--
-- Indexes for table `client_guardian`
--
ALTER TABLE `client_guardian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_guardian_client_id_foreign` (`client_id`),
  ADD KEY `client_guardian_user_id_foreign` (`user_id`);

--
-- Indexes for table `client_meals`
--
ALTER TABLE `client_meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_meals_client_id_meal_date_index` (`client_id`,`meal_date`),
  ADD KEY `client_meals_recorded_by_foreign` (`recorded_by`);

--
-- Indexes for table `client_outings`
--
ALTER TABLE `client_outings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_outings_client_id_foreign` (`client_id`),
  ADD KEY `client_outings_accompanied_by_foreign` (`accompanied_by`),
  ADD KEY `client_outings_authorized_by_foreign` (`authorized_by`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctors_license_number_unique` (`license_number`);

--
-- Indexes for table `doctor_notes`
--
ALTER TABLE `doctor_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_notes_created_by_foreign` (`created_by`),
  ADD KEY `doctor_notes_client_id_index` (`client_id`),
  ADD KEY `doctor_notes_doctor_id_index` (`doctor_id`),
  ADD KEY `doctor_notes_note_date_index` (`note_date`),
  ADD KEY `doctor_notes_branch_id_index` (`branch_id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enquiries_handled_by_foreign` (`handled_by`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_created_by_foreign` (`created_by`),
  ADD KEY `expenses_expense_date_index` (`expense_date`),
  ADD KEY `expenses_category_index` (`category`),
  ADD KEY `expenses_branch_id_index` (`branch_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medications_client_id_foreign` (`client_id`);

--
-- Indexes for table `medication_records`
--
ALTER TABLE `medication_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `medication_records_medication_id_date_time_of_day_unique` (`medication_id`,`date`,`time_of_day`),
  ADD KEY `medication_records_client_id_foreign` (`client_id`),
  ADD KEY `medication_records_given_by_foreign` (`given_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_created_by_foreign` (`created_by`),
  ADD KEY `payments_client_id_index` (`client_id`),
  ADD KEY `payments_branch_id_index` (`branch_id`),
  ADD KEY `payments_payment_date_index` (`payment_date`),
  ADD KEY `payments_email_sent_index` (`email_sent`);

--
-- Indexes for table `payslips`
--
ALTER TABLE `payslips`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payslips_career_id_month_year_unique` (`career_id`,`month`,`year`),
  ADD UNIQUE KEY `payslips_payslip_number_unique` (`payslip_number`),
  ADD KEY `payslips_generated_by_foreign` (`generated_by`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_title_slug_unique` (`title_slug`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_logs_created_by_foreign` (`created_by`),
  ADD KEY `visitor_logs_visit_date_index` (`visit_date`),
  ADD KEY `visitor_logs_branch_id_index` (`branch_id`),
  ADD KEY `visitor_logs_client_id_foreign` (`client_id`);

--
-- Indexes for table `whoweares`
--
ALTER TABLE `whoweares`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `career_attendances`
--
ALTER TABLE `career_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `career_documents`
--
ALTER TABLE `career_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `care_homes`
--
ALTER TABLE `care_homes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chef_checklists`
--
ALTER TABLE `chef_checklists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_daily_checklists`
--
ALTER TABLE `client_daily_checklists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_doctor`
--
ALTER TABLE `client_doctor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_documents`
--
ALTER TABLE `client_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_guardian`
--
ALTER TABLE `client_guardian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_meals`
--
ALTER TABLE `client_meals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_outings`
--
ALTER TABLE `client_outings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_notes`
--
ALTER TABLE `doctor_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medications`
--
ALTER TABLE `medications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medication_records`
--
ALTER TABLE `medication_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payslips`
--
ALTER TABLE `payslips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `whoweares`
--
ALTER TABLE `whoweares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `careers`
--
ALTER TABLE `careers`
  ADD CONSTRAINT `careers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `careers_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `careers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `career_attendances`
--
ALTER TABLE `career_attendances`
  ADD CONSTRAINT `career_attendances_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `career_attendances_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `career_attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `career_documents`
--
ALTER TABLE `career_documents`
  ADD CONSTRAINT `career_documents_career_id_foreign` FOREIGN KEY (`career_id`) REFERENCES `careers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `career_documents_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `chef_checklists`
--
ALTER TABLE `chef_checklists`
  ADD CONSTRAINT `chef_checklists_chef_id_foreign` FOREIGN KEY (`chef_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chef_checklists_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `clients_officer_in_charge_id_foreign` FOREIGN KEY (`officer_in_charge_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `client_daily_checklists`
--
ALTER TABLE `client_daily_checklists`
  ADD CONSTRAINT `client_daily_checklists_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_daily_checklists_completed_by_foreign` FOREIGN KEY (`completed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `client_doctor`
--
ALTER TABLE `client_doctor`
  ADD CONSTRAINT `client_doctor_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_doctor_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_documents`
--
ALTER TABLE `client_documents`
  ADD CONSTRAINT `client_documents_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_documents_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `client_guardian`
--
ALTER TABLE `client_guardian`
  ADD CONSTRAINT `client_guardian_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_guardian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_meals`
--
ALTER TABLE `client_meals`
  ADD CONSTRAINT `client_meals_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_meals_recorded_by_foreign` FOREIGN KEY (`recorded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `client_outings`
--
ALTER TABLE `client_outings`
  ADD CONSTRAINT `client_outings_accompanied_by_foreign` FOREIGN KEY (`accompanied_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `client_outings_authorized_by_foreign` FOREIGN KEY (`authorized_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `client_outings_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_notes`
--
ALTER TABLE `doctor_notes`
  ADD CONSTRAINT `doctor_notes_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctor_notes_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctor_notes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctor_notes_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD CONSTRAINT `enquiries_handled_by_foreign` FOREIGN KEY (`handled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `medications`
--
ALTER TABLE `medications`
  ADD CONSTRAINT `medications_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medication_records`
--
ALTER TABLE `medication_records`
  ADD CONSTRAINT `medication_records_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medication_records_given_by_foreign` FOREIGN KEY (`given_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `medication_records_medication_id_foreign` FOREIGN KEY (`medication_id`) REFERENCES `medications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payslips`
--
ALTER TABLE `payslips`
  ADD CONSTRAINT `payslips_career_id_foreign` FOREIGN KEY (`career_id`) REFERENCES `careers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payslips_generated_by_foreign` FOREIGN KEY (`generated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD CONSTRAINT `visitor_logs_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visitor_logs_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `visitor_logs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
