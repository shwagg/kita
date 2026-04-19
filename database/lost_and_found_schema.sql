CREATE DATABASE IF NOT EXISTS kita;
USE kita;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(120) NOT NULL,
    role VARCHAR(30) NOT NULL DEFAULT 'staff',
    password_hash VARCHAR(255) NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS lost_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(150) NOT NULL,
    description TEXT NULL,
    category VARCHAR(80) NULL,
    found_location VARCHAR(150) NOT NULL,
    found_date DATE NOT NULL,
    status ENUM('unclaimed', 'claimed') NOT NULL DEFAULT 'unclaimed',
    reported_by INT UNSIGNED NOT NULL,
    claimed_by INT UNSIGNED NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    INDEX idx_status (status),
    INDEX idx_found_date (found_date),
    CONSTRAINT fk_lost_items_reported_by FOREIGN KEY (reported_by) REFERENCES users(id) ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT fk_lost_items_claimed_by FOREIGN KEY (claimed_by) REFERENCES users(id) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB;

-- Default admin credentials for initial login:
-- username: admin
-- password: admin123
INSERT INTO users (username, full_name, role, password_hash, created_at, updated_at)
VALUES (
    'admin',
    'System Administrator',
    'admin',
    '$2y$10$A8F4pjP.0aNTvzm.uQzPlOynAVly36k596zjgnVAT53D0Uva73Uhy',
    NOW(),
    NOW()
)
ON DUPLICATE KEY UPDATE username = username;
