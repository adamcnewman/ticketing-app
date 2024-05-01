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
