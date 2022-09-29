CREATE DATABASE `f4r-address.noebuerki-services.ch`;

USE `f4r-address.noebuerki-services.ch`;

CREATE TABLE `user` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `admin` BOOLEAN DEFAULT false
);

CREATE TABLE `userDetails` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userId` INT NOT NULL,
    `clientId` VARCHAR(40) NOT NULL,
    `clientSecret` VARCHAR(40) NOT NULL,
    `frankingLicense` VARCHAR(8) NOT NULL,
    `companyName` VARCHAR(50) NOT NULL,
    `streetAndNumber` VARCHAR(50) NOT NULL,
    `zip` VARCHAR(10) NOT NULL,
    `city` VARCHAR(50) NOT NULL,
    FOREIGN KEY (userId) REFERENCES `user` (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE `customer` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userId` INT NOT NULL,
    `title` VARCHAR(50) NOT NULL,
    `firstName` VARCHAR(50) NOT NULL,
    `lastName` VARCHAR(50) NOT NULL,
    `middleName` VARCHAR(50) NOT NULL,
    `street` VARCHAR(50) NOT NULL,
    `houseNumber` VARCHAR(10) NOT NULL,
    `zip` VARCHAR(10) NOT NULL,
    `city` VARCHAR(50) NOT NULL,
    FOREIGN KEY (userId) REFERENCES `user` (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE `supplier` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userId` INT NOT NULL,
    `company` VARCHAR(50) NOT NULL,
    `firstName` VARCHAR(50) NOT NULL,
    `lastName` VARCHAR(50) NOT NULL,
    `street` VARCHAR(50) NOT NULL,
    `houseNumber` VARCHAR(10) NOT NULL,
    `zip` VARCHAR(10) NOT NULL,
    `city` VARCHAR(50) NOT NULL,
    FOREIGN KEY (userId) REFERENCES `user` (id) ON UPDATE CASCADE ON DELETE CASCADE
);