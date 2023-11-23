CREATE DATABASE yeticave
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE users (
    PRIMARY KEY (id),
    id INT AUTO_INCREMENT UNIQUE,
    user_email CHAR(255),
    user_name CHAR(64),
    user_password CHAR(255)
);

CREATE TABLE categories (
    PRIMARY KEY (id),
    id INT AUTO_INCREMENT,
    category CHAR(64) UNIQUE
);

CREATE TABLE goods (
    PRIMARY KEY (id),
    id INT AUTO_INCREMENT UNIQUE,
    lot_name CHAR(255),
    category CHAR(64),
    lot_rate INT,
    lot_image CHAR(255),
    lot_message TEXT
);

CREATE TABLE bets (
    PRIMARY KEY (id),
    id INT AUTO_INCREMENT,
    b_username CHAR(64) UNIQUE,
    b_price INT,
    b_date DATETIME
);