CREATE TABLE IF NOT EXISTS `academic_sessions` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `session_name` VARCHAR(255) NOT NULL,
  `semester` INT NOT NULL,
  `is_active` TINYINT(1) DEFAULT 1,
);

CREATE TABLE IF NOT EXISTS `lecturers` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `staff_id` VARCHAR(255) NOT NULL UNIQUE,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `day` VARCHAR(255) NOT NULL,
  `course` VARCHAR(255) NOT NULL,
  FOREIGN KEY (`staff_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS `courses` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `course_code` VARCHAR(255) NOT NULL UNIQUE,
  `course_name` VARCHAR(255) NOT NULL,
  `credit_hours` INT NOT NULL,
  `lecturer_id` BIGINT UNSIGNED NULL,
  FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers`(`id`) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `room_code` VARCHAR(255) NOT NULL UNIQUE,
  `room_name` VARCHAR(255) NOT NULL,
  `capacity` INT NOT NULL,
  `type` VARCHAR(255) NOT NULL,
);

CREATE TABLE IF NOT EXISTS `repeat_students` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `student_matric` VARCHAR(255) NOT NULL UNIQUE,
  `student_name` VARCHAR(255) NOT NULL,
  `course_id` BIGINT UNSIGNED NOT NULL,
  `academic_session_id` BIGINT UNSIGNED NOT NULL,
  `reason` VARCHAR(255) NOT NULL,
  FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`academic_session_id`) REFERENCES `academic_sessions`(`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'student',
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
);