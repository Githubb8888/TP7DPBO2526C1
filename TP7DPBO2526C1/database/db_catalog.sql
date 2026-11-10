CREATE DATABASE IF NOT EXISTS db_catalog;
USE db_catalog;

DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS suppliers;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255)
) ENGINE=InnoDB;

CREATE TABLE suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100)
) ENGINE=InnoDB;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    category_id INT NOT NULL,
    supplier_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
) ENGINE=InnoDB;

INSERT INTO categories (name, description) VALUES
('Electronics', 'Phones, laptops and accessories'),
('Books', 'Printed and digital books'),
('Clothing', 'Everyday clothes and shoes');

INSERT INTO suppliers (name, phone, email) VALUES
('TechSource', '081234567890', 'sales@techsource.example'),
('BookWorld', '082233445566', 'contact@bookworld.example'),
('FashionHub', '083344556677', 'hello@fashionhub.example');

INSERT INTO products (name, price, stock, category_id, supplier_id) VALUES
('Wireless Mouse', 150000.00, 25, 1, 1),
('Mechanical Keyboard', 650000.00, 10, 1, 1),
('Clean Code', 320000.00, 8, 2, 2),
('Cotton T-Shirt', 90000.00, 40, 3, 3);
