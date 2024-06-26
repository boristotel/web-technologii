-- Създаване на базата данни
CREATE DATABASE docker_management;

-- Използване на създадената база данни
USE docker_management;

-- Създаване на таблицата за потребители
    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
    );

-- Създаване на таблицата за Docker контейнери
CREATE TABLE containers (
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

-- Създаване на таблицата за уебсайтове
CREATE TABLE websites (
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

-- Създаване на таблицата за виртуални машини
CREATE TABLE virtual_machines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    ip VARCHAR(15) NOT NULL,
    data TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (username, password, email, role) VALUES
('admin', '$2y$10$7QOa/p3b7FQm9.pOUZReXeVO/nZp3RAkTPi7rQ9mKQO7D/8RXBQ9m', 'admin@example.com', 'admin'), --admin: adminpassword
('user1', '$2y$10$8zmd9F6zSh49OMH7r4uU1.9hOo9vH24/3fgfd3O8FXR/ie.0iD7.y', 'user1@example.com', 'user'), -- user1: user1password
('user2', '$2y$10$ttRpi7TfsXQGgV45k/QXLe29vH24gHgFYi3VO7F/ieKqXY7xWQ9WO', 'user2@example.com', 'user'); -- user2: user2password

