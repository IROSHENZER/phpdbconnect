-- Create a new database
CREATE DATABASE mydatabase;

-- Use the database
USE mydatabase;

-- Create a new table
CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);
