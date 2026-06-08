-- MySQL schema for Sales Management System
DROP DATABASE IF EXISTS sales_management;
CREATE DATABASE sales_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sales_management;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'seller') NOT NULL DEFAULT 'seller',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    phone VARCHAR(50),
    email VARCHAR(100),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    phone VARCHAR(50),
    email VARCHAR(100),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    cost_price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    sale_price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE purchases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_id INT NULL,
    product_id INT NULL,
    quantity INT NOT NULL DEFAULT 0,
    cost_price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    total DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    purchase_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id) ON DELETE SET NULL,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE sales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    sale_price DECIMAL(10,2) NOT NULL,
    total DECIMAL(12,2) NOT NULL,
    profit DECIMAL(12,2) NOT NULL,
    sale_date DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO users (username, password, role) VALUES
('admin', '$2b$12$5AOUIpppZOVTKQeQoOiZley/BKaM4RwIa0yxlG9MDv84BYKVE9/8W', 'admin'),
('seller', '$2b$12$zE/lam7xB3RMe0UHELwQkec9LAxTUktBAgoJ9cSNIcZ3hYB1hR.q.', 'seller');

INSERT INTO products (name, description, cost_price, sale_price, stock) VALUES
('Simu ya Android', 'Simu nzuri yenye RAM 4GB', 600000, 750000, 15),
('Laptop ya Biashara', 'Laptop yenye nguvu kwa ofisi', 1500000, 1900000, 8),
('Chaja ya Haraka', 'Chaja ya USB-C 30W', 25000, 40000, 25);

INSERT INTO suppliers (name, phone, email, address) VALUES
('Supplier A', '0712345678', 'supplierA@example.com', 'Mtaa wa Biashara, Dar es Salaam');

INSERT INTO customers (name, phone, email, address) VALUES
('Mteja A', '0755555555', 'mtejaA@example.com', 'Mtaa wa Mwananchi, Arusha');

INSERT INTO purchases (supplier_id, product_id, quantity, cost_price, total) VALUES
(1, 1, 10, 600000, 6000000);
