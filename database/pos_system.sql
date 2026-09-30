-- Fresh-install schema for the POS customer and user account pages.
-- For an existing TFA2 database, keep its existing records and run:
--   php spark migrate

CREATE DATABASE IF NOT EXISTS pos_system
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE pos_system;

CREATE TABLE IF NOT EXISTS customers (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(254) NOT NULL,
    phone VARCHAR(40) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(80) NOT NULL,
    full_name VARCHAR(150) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'Staff',
    avatar VARCHAR(255) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY users_username_unique (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
