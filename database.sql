CREATE DATABASE IF NOT EXISTS sales_dashboard;
USE sales_dashboard;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    organization VARCHAR(100),
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Stores table
CREATE TABLE IF NOT EXISTS stores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(100),
    description TEXT
);

-- Insert demo stores
INSERT INTO stores (name, location, description) VALUES
('Reliance Supermart', 'Mumbai', 'Main store with full data and forecasts'),
('D-Mart', 'Pune', 'Currently no data available'),
('Big Bazaar', 'Delhi', 'Archived store');



