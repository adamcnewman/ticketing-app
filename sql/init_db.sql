-- DROP/CREATE/USE DB
-- DROP DATABASE IF EXISTS `ticketing_app`;
-- CREATE DATABASE `ticketing_app`;
-- USE `ticketing_app`;


-- DROP TABLES
DROP TABLE IF EXISTS `labour_item`;
DROP TABLE IF EXISTS `position_rate`;
DROP TABLE IF EXISTS `position`;
DROP TABLE IF EXISTS `staff`;
DROP TABLE IF EXISTS `truck_rate`;
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
    `name` VARCHAR(64) NOT NULL,
    PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `job` (
    `job_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `customer_id` BIGINT UNSIGNED NOT NULL,
    `name` VARCHAR(64) NOT NULL,
    PRIMARY KEY (`job_id`),
    FOREIGN KEY (`customer_id`) REFERENCES `customer`(`customer_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `location` (
    `location_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(64) NOT NULL,
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
    `status` ENUM("Pending", "Active", "Closed") NOT NULL,
    `ordered_by` VARCHAR(64),
    `area` VARCHAR(64),
    `date` DATE DEFAULT CURRENT_DATE,
    PRIMARY KEY (`project_id`),
    FOREIGN KEY (`ticket_id`) REFERENCES `ticket`(`ticket_id`),
    FOREIGN KEY (`customer_id`) REFERENCES `customer`(`customer_id`),
    FOREIGN KEY (`job_id`) REFERENCES `job`(`job_id`),
    FOREIGN KEY (`location_id`) REFERENCES `location`(`location_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `truck` (
    `truck_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `label` VARCHAR(64) NOT NULL,
    PRIMARY KEY (`truck_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `truck_rate` (
    `truck_rate_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `truck_id` BIGINT UNSIGNED NOT NULL,
    `uom` ENUM("Hourly", "Fixed") NOT NULL,
    `rate` DECIMAL(10,2) UNSIGNED NOT NULL,
    PRIMARY KEY (`truck_rate_id`),
    FOREIGN KEY (`truck_id`) REFERENCES `truck`(`truck_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `truck_item` (
    `truck_item_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `truck_id` BIGINT UNSIGNED NOT NULL,
    `ticket_id` BIGINT UNSIGNED NOT NULL,
    `quantity` BIGINT UNSIGNED NOT NULL,
    `uom` ENUM("Hourly", "Fixed") NOT NULL,
    `rate` DECIMAL(10,2) UNSIGNED NOT NULL,
    `total` DECIMAL(10,2) UNSIGNED NOT NULL,
    PRIMARY KEY (`truck_item_id`),
    FOREIGN KEY (`truck_id`) REFERENCES `truck`(`truck_id`),
    FOREIGN KEY (`ticket_id`) REFERENCES `ticket`(`ticket_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `misc_item` (
    `misc_item_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `ticket_id` BIGINT UNSIGNED NOT NULL,
    `description` TEXT,
    `cost` DECIMAL(10,2) UNSIGNED,
    `price` DECIMAL(10,2) UNSIGNED NOT NULL,
    `quantity` DECIMAL(10,2) UNSIGNED NOT NULL,
    `total` DECIMAL(10,2) UNSIGNED NOT NULL,
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
    PRIMARY KEY (`position_id`),
    FOREIGN KEY (`staff_id`) REFERENCES `staff`(`staff_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `position_rate` (
    `position_rate_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `position_id` BIGINT UNSIGNED NOT NULL,
    `uom` ENUM("Hourly", "Fixed") NOT NULL,
    `regular_rate` DECIMAL(10,2) UNSIGNED,
    `overtime_rate` DECIMAL(10,2) UNSIGNED,
    PRIMARY KEY (`position_rate_id`),
    FOREIGN KEY (`position_id`) REFERENCES `position`(`position_id`)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `labour_item` (
    `labour_item_id` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    `ticket_id` BIGINT UNSIGNED NOT NULL,
    `position_id` BIGINT UNSIGNED NOT NULL,
    `uom` ENUM("Hourly", "Fixed") NOT NULL,
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
VALUES  ("Acme Corp"),
        ("Beta LLC"),
        ("Gamma Industries"),
        ("Delta Services"),
        ("Epsilon Limited");


-- job
INSERT INTO `job` (`customer_id`, `name`)
VALUES  (1, "Office Build"),
        (1, "Warehouse Setup"),
        (2, "Mall Renovation"),
        (2, "New Outlet Construction"),
        (2, "Office Redesign"),
        (3, "Factory Maintenance"),
        (3, "New Plant Construction"),
        (4, "Residential Development"),
        (4, "Commercial Complex"),
        (5, "School Expansion"),
        (5, "Hospital Upgrade");


-- location
INSERT INTO `location` (`name`)
VALUES  ("North Zone"),
        ("East Zone"),
        ("West Zone"),
        ("South Zone"),
        ("Central District");


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
INSERT INTO `truck` (`label`)
VALUES  ("200 - Tesla Truck"),
        ("201 - GMC Sierra"),
        ("202 - Toyota Tacoma");

-- truck_rate
INSERT INTO `truck_rate` (`truck_id`, `uom`, `rate`)
VALUES  (1, "Hourly", 90.50),
        (1, "Fixed", 200.00),
        (2, "Hourly", 100.25),
        (2, "Fixed", 360.00),
        (3, "Hourly", 125.25),
        (3, "Fixed", 500.00);

-- truck_item


-- misc_item


-- staff
INSERT INTO `staff` (`name`)
VALUES  ("Fresh Focus Media"),
        ("Rook Connect");


-- position
INSERT INTO `position` (`staff_id`, `title`)
VALUES  (1, "Engineer-Junior"),
        (1, "Engineer-Intermediate"),
        (1, "Engineer-Senior"),
        (1, "Designer"),
        (2, "Web Developer-Junior"),
        (2, "Web Developer-Intermediate"),
        (2, "Web Developer-Senior"),
        (2, "Web Designer");

-- position_rate
INSERT INTO `position_rate` (`position_id`, `uom`, `regular_rate`, `overtime_rate`)
VALUES  (1, "Hourly", 30.00, 45.00),
        (1, "Fixed", 1500.00, NULL),
        (2, "Hourly", 40.00, 60.00),
        (2, "Fixed", 2000.00, NULL),
        (3, "Hourly", 60.00, 90.00),
        (3, "Fixed", 2500.00, NULL),
        (4, "Hourly", 35.00, 47.00),
        (4, "Fixed", 1800.00, NULL),
        (5, "Hourly", 32.00, 48.00),
        (5, "Fixed", 1900.00, NULL),
        (6, "Hourly", 37.00, 55.00),
        (6, "Fixed", 2300.00, NULL),
        (7, "Hourly", 54.00, 85.00),
        (7, "Fixed", 2800.00, NULL),
        (8, "Hourly", 28.00, 43.00),
        (8, "Fixed", 1400.00, NULL);

-- labour_item
