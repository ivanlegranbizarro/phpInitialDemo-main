-- Active: 1715015392731@@127.0.0.1@3306
CREATE DATABASE todo_db DEFAULT CHARACTER
SET
  = 'utf8mb4';

use todo_db;
CREATE TABLE
  tasks (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    create_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_time TIMESTAMP DEFAULT NULL,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL
  );
