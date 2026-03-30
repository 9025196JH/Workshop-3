CREATE DATABASE IF NOT EXISTS techzone CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE techzone;
CREATE TABLE products (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(120) NOT NULL, description TEXT NOT NULL, price DECIMAL(10,2) NOT NULL, category VARCHAR(50) NOT NULL, image VARCHAR(255) DEFAULT NULL);
CREATE TABLE customers (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(120) NOT NULL, email VARCHAR(120) NOT NULL, message TEXT NULL);
CREATE TABLE suppliers (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(120) NOT NULL, country VARCHAR(120) NOT NULL);
CREATE TABLE orders_table (id INT AUTO_INCREMENT PRIMARY KEY, customer_name VARCHAR(120) NOT NULL, total DECIMAL(10,2) NOT NULL, status VARCHAR(50) NOT NULL DEFAULT 'new');
CREATE TABLE reviews (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(120) NOT NULL, product VARCHAR(120) NOT NULL, score TINYINT NOT NULL, review TEXT NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
INSERT INTO products (name,description,price,category) VALUES ('Smartphone X','Snelle 5G smartphone',699,'smartphones'),('Laptop Pro','Krachtige laptop voor studie en werk',1199,'laptops'),('Tablet Air','Lichte tablet voor dagelijks gebruik',499,'tablets');