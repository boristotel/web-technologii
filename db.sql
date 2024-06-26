-- Създаване на базата данни
CREATE DATABASE docker_management;

-- Използване на създадената база данни
USE docker_management;

-- Създаване на таблицата за потребители
    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE
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


