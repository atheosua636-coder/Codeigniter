SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `created_at`) VALUES
(1, 'Juan Dela Cruz', 'juan@example.com', '0917-123-4567', '2026-09-15 01:12:10'),
(2, 'Maria Santos', 'maria@example.com', '0918-234-5678', '2026-09-15 01:12:10'),
(3, 'Carlo Reyes', 'carlo@example.com', '0919-345-6789', '2026-09-15 01:12:10'),
(4, 'Angela Garcia', 'angela@example.com', '0920-456-7890', '2026-09-15 01:12:10'),
(5, 'Paolo Mendoza', 'paolo@example.com', '0921-567-8901', '2026-09-15 01:12:10')
ON DUPLICATE KEY UPDATE
  `full_name` = VALUES(`full_name`),
  `email` = VALUES(`email`),
  `phone` = VALUES(`phone`),
  `created_at` = VALUES(`created_at`);

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `username`, `full_name`, `role`, `created_at`) VALUES
(1, 'admin01', 'Atheo Sua', 'Administrator', '2026-09-15 01:12:10'),
(2, 'cashier01', 'Jamie Cruz', 'Cashier', '2026-09-15 01:12:10'),
(3, 'cashier02', 'Nicole Reyes', 'Cashier', '2026-09-15 01:12:10'),
(4, 'manager01', 'Mark Santos', 'Manager', '2026-09-15 01:12:10'),
(5, 'staff01', 'Anne Garcia', 'Staff', '2026-09-15 01:12:10')
ON DUPLICATE KEY UPDATE
  `username` = VALUES(`username`),
  `full_name` = VALUES(`full_name`),
  `role` = VALUES(`role`),
  `created_at` = VALUES(`created_at`);

COMMIT;
