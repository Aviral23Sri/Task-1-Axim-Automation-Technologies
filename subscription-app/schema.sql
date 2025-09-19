CREATE DATABASE IF NOT EXISTS subscription_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE subscription_db;

CREATE TABLE IF NOT EXISTS subscriptions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  plan ENUM('Basic','Pro','Enterprise') NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uniq_email_plan (email, plan)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
