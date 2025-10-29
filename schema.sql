-- Database Schema for Ndawonga Website
-- This file creates all necessary tables and inserts initial data

-- Admin Users Table
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `full_name` varchar(100) NOT NULL,
  `role` enum('super_admin','admin','editor') NOT NULL DEFAULT 'admin',
  `login_attempts` int(11) DEFAULT 0,
  `is_locked` tinyint(1) DEFAULT 0,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Services Table
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `icon_class` varchar(50) DEFAULT 'fa-cog',
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Projects Table
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text,
  `location` varchar(100),
  `budget` varchar(50),
  `status` enum('planning','in_progress','completed','on_hold') DEFAULT 'planning',
  `featured_image` varchar(255),
  `start_date` date,
  `end_date` date,
  `client_name` varchar(100),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Team Members Table
CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `bio` text,
  `photo` varchar(255),
  `email` varchar(100),
  `phone` varchar(20),
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Clients Table
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `logo` varchar(255),
  `website` varchar(255),
  `is_featured` tinyint(1) DEFAULT 0,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contact Messages Table
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20),
  `subject` varchar(200),
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Admin User
INSERT INTO `admin_users` (`username`, `password_hash`, `email`, `full_name`, `role`, `login_attempts`, `is_locked`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@ndawonga.co.za', 'System Administrator', 'super_admin', 0, 0),
('superadmin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'superadmin@ndawonga.co.za', 'Super Administrator', 'super_admin', 0, 0);

-- Insert Services
INSERT INTO `services` (`title`, `description`, `icon_class`, `display_order`, `is_active`) VALUES
('Civil Engineering', 'Road construction, earthworks, and infrastructure development', 'fa-road', 1, 1),
('Waste Management', 'Comprehensive waste management solutions', 'fa-trash-alt', 2, 1),
('Construction', 'Building and construction projects', 'fa-building', 3, 1),
('Maintenance', 'Ongoing maintenance and support', 'fa-tools', 4, 1),
('Project Management', 'End-to-end project management services', 'fa-project-diagram', 5, 1),
('Consulting', 'Expert consulting and advisory services', 'fa-lightbulb', 6, 1);

-- Insert Sample Projects
INSERT INTO `projects` (`title`, `description`, `location`, `budget`, `status`, `start_date`, `end_date`, `client_name`) VALUES
('RBA Protea Glen Sectional Development', 'Residential sectional development project comprising multiple housing units with complete infrastructure.', 'Protea Glen, Johannesburg', 'R 489,000', 'completed', '2023-01-15', '2023-06-30', 'RBA Development'),
('Rea Vaya BRT Phase 1 NMT', 'Implementation of Non-Motorized Transport infrastructure for Rea Vaya Bus Rapid Transit system.', 'Johannesburg CBD', 'R 1,200,000', 'completed', '2022-08-01', '2023-03-15', 'City of Johannesburg'),
('Winnie Mandela Clinic Refurbishment', 'Comprehensive refurbishment and upgrade of healthcare facility with modern infrastructure.', 'Johannesburg', 'R 1,300,000', 'completed', '2023-02-01', '2023-09-30', 'Gauteng Department of Health');

-- Insert Team Members
INSERT INTO `team` (`full_name`, `position`, `bio`, `display_order`, `is_active`) VALUES
('David Ndawonga', 'Managing Director', 'Experienced civil engineer with over 15 years in the construction industry.', 1, 1),
('Sarah Mthembu', 'Project Manager', 'Specialist in project coordination and client relations.', 2, 1),
('John Sibeko', 'Site Engineer', 'Expert in construction supervision and quality control.', 3, 1),
('Mary Khumalo', 'Financial Manager', 'Responsible for financial planning and budget management.', 4, 1);

-- Insert Clients
INSERT INTO `clients` (`name`, `logo`, `is_featured`, `display_order`) VALUES
('City of Johannesburg', 'assets/images/City of Johannesburg.png', 1, 1),
('Gauteng Province', 'assets/images/Gauteng Province.jpeg', 1, 2),
('Department of Public Works', 'assets/images/Department of Public Works.jpeg', 1, 3),
('Ekurhuleni Metro', 'assets/images/Ekurhuleni Metro.png', 1, 4),
('Transnet', 'assets/images/Transnet.jpeg', 1, 5),
('Eskom', 'assets/images/Eskom.jpg', 1, 6),
('SANRAL (South African National Roads Agency)', 'assets/images/SANRAL (South African National Roads Agency).jpg', 1, 7),
('Water Affairs', 'assets/images/Water Affairs.png', 1, 8);