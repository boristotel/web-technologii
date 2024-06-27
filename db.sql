CREATE DATABASE IF NOT EXISTS docker_management;

USE docker_management;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);

CREATE TABLE IF NOT EXISTS containers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    dns_name VARCHAR(255) NOT NULL,
    port INT NOT NULL,
    db_name VARCHAR(255) NOT NULL,
    server_ip VARCHAR(15) NOT NULL,
    container_ip VARCHAR(15) NOT NULL,
    vhost_ip VARCHAR(15),
    vhost_path VARCHAR(255),
    settings TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS websites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    dns_name VARCHAR(255) NOT NULL,
    port INT NOT NULL,
    db_name VARCHAR(255) NOT NULL,
    vhost_ip VARCHAR(15),
    vhost_path VARCHAR(255),
    settings TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS virtual_machines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    ip VARCHAR(15) NOT NULL,
    data TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (username, password, email, role) VALUES
('admin', '$2y$10$Rle1HzMNmLWzc3zLXyvTQuNNZaRtLQ3mSIRKL/6Vv/kTZBKhB4y9W', 'admin@example.com', 'admin'),
('user1', '$2y$10$Rle1HzMNmLWzc3zLXyvTQuNNZaRtLQ3mSIRKL/6Vv/kTZBKhB4y9W', 'user1@example.com', 'user'),
('user2', '$2y$10$Rle1HzMNmLWzc3zLXyvTQuNNZaRtLQ3mSIRKL/6Vv/kTZBKhB4y9W', 'user2@example.com', 'user'),
('john_doe', '$2y$10$Rle1HzMNmLWzc3zLXyvTQuNNZaRtLQ3mSIRKL/6Vv/kTZBKhB4y9W', 'john.doe@example.com', 'user'),
('jane_smith', '$2y$10$Rle1HzMNmLWzc3zLXyvTQuNNZaRtLQ3mSIRKL/6Vv/kTZBKhB4y9W', 'jane.smith@example.com', 'user');