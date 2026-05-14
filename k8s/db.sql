CREATE DATABASE travel;

USE travel;

CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reg_id VARCHAR(20),
    name VARCHAR(100),
    mobile VARCHAR(20),
    destination VARCHAR(100),
    members INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
