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