-- DROP/CREATE/USE DB
DROP DATABASE IF EXISTS `ticketing_app`;
CREATE DATABASE `ticketing_app`;
USE `ticketing_app`;


-- DROP TABLES
DROP TABLE IF EXISTS `labour_item`;
DROP TABLE IF EXISTS `position`;
DROP TABLE IF EXISTS `staff`;
DROP TABLE IF EXISTS `truck_item`;
DROP TABLE IF EXISTS `truck`;
DROP TABLE IF EXISTS `misc_item`;
DROP TABLE IF EXISTS `project`;
DROP TABLE IF EXISTS `ticket`;
DROP TABLE IF EXISTS `job_location`;
DROP TABLE IF EXISTS `job`;
DROP TABLE IF EXISTS `location`;
DROP TABLE IF EXISTS `customer`;


-- CREATE TABLES
CREATE TABLE IF NOT EXISTS `ticket` (
    `ticket_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `description_of_work` TEXT,
    PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `customer` (
    `customer_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(64),
    PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `job` (
    `job_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `customer_id` BIGINT UNSIGNED NOT NULL,
    `name` VARCHAR(64),
    PRIMARY KEY (`job_id`),
    FOREIGN KEY (`customer_id`) REFERENCES `customer`(`customer_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `location` (
    `location_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(64),
    PRIMARY KEY (`location_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `job_location` (
    `job_location_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `job_id` BIGINT UNSIGNED NOT NULL,
    `location_id` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (`job_location_id`),
    FOREIGN KEY (`job_id`) REFERENCES `job`(`job_id`),
    FOREIGN KEY (`location_id`) REFERENCES `location`(`location_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `project` (
    `project_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `ticket_id` BIGINT UNSIGNED NOT NULL,
    `customer_id` BIGINT UNSIGNED NOT NULL,
    `job_id` BIGINT UNSIGNED NOT NULL,
    `location_id` BIGINT UNSIGNED NOT NULL,
    `status` ENUM('Pending', 'Active', 'Closed') NOT NULL,
    `ordered_by` VARCHAR(64),
    `area` VARCHAR(64),
    `date` DATE,
    PRIMARY KEY (`project_id`),
    FOREIGN KEY (`ticket_id`) REFERENCES `ticket`(`ticket_id`),
    FOREIGN KEY (`customer_id`) REFERENCES `customer`(`customer_id`),
    FOREIGN KEY (`job_id`) REFERENCES `job`(`job_id`),
    FOREIGN KEY (`location_id`) REFERENCES `location`(`location_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `truck` (
    `truck_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `label` VARCHAR(64),
    `uom` ENUM('Hourly', 'Fixed') NOT NULL,
    `rate` DECIMAL(10,2) UNSIGNED,
    PRIMARY KEY (`truck_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `truck_item` (
    `truck_item_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `truck_id` BIGINT UNSIGNED NOT NULL,
    `ticket_id` BIGINT UNSIGNED NOT NULL,
    `quantity` BIGINT UNSIGNED,
    `uom` ENUM('Hourly', 'Fixed') NOT NULL,
    `rate` DECIMAL(10,2) UNSIGNED,
    `total` DECIMAL(10,2) UNSIGNED,
    PRIMARY KEY (`truck_item_id`),
    FOREIGN KEY (`truck_id`) REFERENCES `truck`(`truck_id`),
    FOREIGN KEY (`ticket_id`) REFERENCES `ticket`(`ticket_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `misc_item` (
    `misc_item_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `ticket_id` BIGINT UNSIGNED NOT NULL,
    `description` TEXT,
    `cost` DECIMAL(10,2) UNSIGNED,
    `price` DECIMAL(10,2) UNSIGNED,
    `quantity` DECIMAL(10,2) UNSIGNED,
    `total` DECIMAL(10,2) UNSIGNED,
    PRIMARY KEY (`misc_item_id`),
    FOREIGN KEY (`ticket_id`) REFERENCES `ticket`(`ticket_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `staff` (
    `staff_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(64),
    PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `position` (
    `position_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `staff_id` BIGINT UNSIGNED NOT NULL,
    `title` VARCHAR(64),
    `uom` ENUM('Hourly', 'Fixed') NOT NULL,
    `regular_rate` DECIMAL(10,2) UNSIGNED,
    `overtime_rate` DECIMAL(10,2) UNSIGNED,
    PRIMARY KEY (`position_id`),
    FOREIGN KEY (`staff_id`) REFERENCES `staff`(`staff_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `labour_item` (
    `labour_item_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `ticket_id` BIGINT UNSIGNED NOT NULL,
    `position_id` BIGINT UNSIGNED NOT NULL,
    `uom` ENUM('Hourly', 'Fixed') NOT NULL,
    `regular_rate` DECIMAL(10,2) UNSIGNED,
    `regular_hours` DECIMAL(10,2) UNSIGNED,
    `overtime_rate` DECIMAL(10,2) UNSIGNED,
    `overtime_hours` DECIMAL(10,2) UNSIGNED,
    `total` DECIMAL(10,2) UNSIGNED,
    PRIMARY KEY (`labour_item_id`),
    FOREIGN KEY (`ticket_id`) REFERENCES `ticket`(`ticket_id`),
    FOREIGN KEY (`position_id`) REFERENCES `position`(`position_id`)
) ENGINE=InnoDB CHARACTER SET utf8;


-- INSERT DATA
-- ticket


-- customer
INSERT INTO `customer` (`name`)
VALUES  ('Acme Corp'),
        ('Beta LLC'),
        ('Gamma Industries'),
        ('Delta Services'),
        ('Epsilon Limited');


-- job
INSERT INTO `job` (`customer_id`, `name`)
VALUES  (1, 'Office Build'),
        (1, 'Warehouse Setup'),
        (2, 'Mall Renovation'),
        (2, 'New Outlet Construction'),
        (2, 'Office Redesign'),
        (3, 'Factory Maintenance'),
        (3, 'New Plant Construction'),
        (4, 'Residential Development'),
        (4, 'Commercial Complex'),
        (5, 'School Expansion'),
        (5, 'Hospital Upgrade');


-- location
INSERT INTO `location` (`name`)
VALUES  ('North Zone'),
        ('East Zone'),
        ('West Zone'),
        ('South Zone'),
        ('Central District');


-- job_location
INSERT INTO `job_location` (`job_id`, `location_id`)
VALUES  (1, 1),
        (1, 2),
        (2, 3),
        (2, 4),
        (3, 1),
        (3, 5),
        (4, 2),
        (4, 3),
        (5, 4),
        (6, 1),
        (6, 5),
        (7, 2),
        (8, 3),
        (9, 4),
        (10, 5),
        (11, 1),
        (11, 2);


-- project


-- truck
INSERT INTO `truck` (`label`, `uom`, `rate`)
VALUES  ('200 - Tesla Truck', 'Hourly', 20.50),
        ('201 - GMC Sierra', 'Fixed', 100.00),
        ('202 - Toyota Tacoma', 'Hourly', 18.75),
        ('203 - Ford Ranger', 'Fixed', 95.00),
        ('204 - Nissan Frontier', 'Hourly', 17.00);

-- truck_item


-- misc_item


-- staff
INSERT INTO `staff` (`name`)
VALUES  ('Fresh Focus Media'),
        ('Rook Connect');


-- position
INSERT INTO `position` (`staff_id`, `title`, `uom`, `regular_rate`, `overtime_rate`)
VALUES  (1, 'Engineer-Junior', 'Hourly', 30.00, 63.00),
        (1, 'Engineer-Intermediate', 'Hourly', 120.00, 300.00),
        (1, 'Engineer-Senior', 'Hourly', 50.00, 122.50),
        (1, 'Designer', 'Fixed', 29.25, 45.00),
        (2, 'Engineer-Junior', 'Fixed', 31.00, 67.00),
        (2, 'Engineer-Intermediate', 'Hourly', 121.00, 308.00),
        (2, 'Engineer-Senior', 'Hourly', 51.00, 127.50),
        (2, 'Designer', 'Fixed', 30.25, 46.00);


-- labour_item
