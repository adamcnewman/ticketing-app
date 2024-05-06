## Ticketing App

### Table of Contents
- [Overview](#overview)
- [Dependencies & Environment](#dependencies-and-environment)
- [Directory Structure](#directory-structure)
- [Running the Program](#running-the-program)
- [Design](#design)
    - [Data Description](#data-description)
    - [Entity Relationship Diagram](#entity-relationship-diagram)
    - [Database Schema](#database-schema) 
- [App Architecture](#app-architecture)

---

### Overview
This Ticketing App is a single-page application designed to manage the creation of tickets for various tasks associated with different projects, staff positions, and logistical needs pertaining to a customer.

---

### Dependencies and Environment
- **Apache** 2.4.59
- **MySQL** 5.7.44
- **PHP** 5.6.4 (PHP MyAdmin 4.9.11)
- **WampServer** 3.3.5 64 Bit

---

### Directory Structure

TicketingApp\
├── **config**\
│   └── db.config.php `Config file for database. See` [Running the Program](#running-the-program)\
├── **public**\
│   ├── **assets**\
│   │   ├── **css**\
│   │   │   └── style.css `Style file for app.`\
│   │   ├── **js**\
│   │   │   └── script.js `JQuery script for app.`\
│   └── **router**\
│   │   └── handler.php `Handles routing AJAX requests to server.`\
│   └── index.php `Front controller / entry point for app.`\
├── **readmeAssets** `For pictures in this README.`\
│   ├── ERD.png\
│   └── Schema.png\
├── **sql**\
│   ├── create_db.sql `Script to create database.`\
│   └── init_db.sql `Script to init database with data.`\
├── **src** `App code.`\
│   ├── **Actions** `Server scripts that call Controllers.`\
│   │   ├── get_position_rates.php `Gets rates for a position.`\
│   │   ├── get_project_dropdown_data.php `Gets data for project section dropdowns.`\
│   │   ├── get_staff_positions.php `Gets positions related to a staff.`\
│   │   ├── get_truck_rate.php `Gets the rate for a truck & uom.`\
│   │   ├── init_page.php `Initializes the page with data.`\
│   │   └── submit_ticket.php `Handles submitting the ticket.`\
│   ├── **Controller** `Receive user requests via Actions and redirect to appropriate Model for data retrieval.`\
│   │   ├── LabourController.php `Handles user requests for Labour line items.`\
│   │   ├── ProjectController.php `Handles user requests for Project section.`\
│   │   ├── TicketController.php `Handles user request to submit form.`\
│   │   └── TruckController.php `Handles user requests for Truck line items.`\
│   ├── **Core** \
│   │   └── Database.php `Singleton database instance used in Models.`\
│   ├── **Model** `Receives Controller requests and executes database queries.`\
│   │   ├── LabourModel.php `Interacts with database for Labour line items.`\
│   │   ├── ProjectModel.php `Interacts with database for Project data.`\
│   │   ├── TicketModel.php `Responsible for handling all Ticket-related database entries when form is submitted.`\
│   │   └── TruckModel.php `Interacts with database for Truck line items.`\
│   └── **View** `Defines html for the form.`\
│   │   ├── DescriptionOfWorkView.php `Descriptio of work section.`\
│   │   ├── LabourLineItemView.php `Labour line item instances.`\
│   │   ├── LabourView.php `Labour section.`\
│   │   ├── MiscLineItemView.php `Miscellaneous line item instances.`\
│   │   ├── MiscView.php `Misc section.`\
│   │   ├── ProjectView.php `Project section.`\
│   │   ├── TruckLineItemView.php `Truck line item instances.`\
│   │   └── TruckView.php `Truck section.`\
├── .gitignore\
├── .htaccess\
└── README.md

---

### Running the Program
1. If using WampServer, install WampServer and [dependencies](#dependencies-and-environment) and place this project in the `C:/wamp64/www/` folder.
2. In the root directory, create a file in the `config` folder called `db.config.php`. Create the file as follows, where: 
    - `<HOST_ADDRESS>` is the ip or location that the server is hosted 
    - `<USERNAME>` and `<PASSWORD>` are the database credentials
```php
<?php 
    define("DB_SERVER", "<HOST_ADDRESS>");
    define("DB_USERNAME", "<USERNAME>");
    define("DB_PASSWORD", "<PASSWORD>");
    define("DB_DBNAME", "ticketing_app");
?>
```

3. Run the `create_db.sql` script from the `sql/` folder in PHP MyAdmin to create the database called `ticketing_app`.

4. Run the `init_db.sql` script from the `sql/` folder in PHP MyAdmin to initialize the `ticketing_app` database with data. 

5. Start the server and navigate to the hosted location to use the app, eg: `localhost/TicketingApp`.

---

### Known Issues

1. Project Section: *Customer, Job, Location & Dropdown Filtering*
    - Current functionality: User can select a customer, job, or location first, and the options in the other 2 dropdowns will be filtered to only show relevant data (ie. selecting a customer will only show their jobs and locations of those jobs). Similar for selecting job or location first. Selecting the second dropdown will filter the third dropdown options. This does work as intended if selecting one dropdown, selecting the second, then the third. Or, selecting a dropdown, then unselecting it.
        - Issue: If a dropdown is selected, and then the same dropdown is changed to another non-empty option, while either one or both of the other dropdowns have non-empty values (have options selected) then the other dropdowns will not have their values updated to reflect the changed dropdown.
        - To replicate:
            - Select a customer (eg. Gamma Industries)
            - Only Gamma jobs show up Job dropdown (expected). Select a job (eg. #105 Factory Maintenance)
            - Select a different customer (eg. Delta Services)
            - Job dropdown options will not update to show Delta Services jobs.


---

### Design

##### Data Description
A user can create a **Ticket** for a **Project**, which is done for a **Customer**.

A **Customer** can have many **Jobs**, and a single **Job** could have many **Locations**.

A **Ticket** has multiple types of line items that describe the work that was done for the *8Project** pertaining to this **Ticket**. This includes:
- **Labour** line items: Describes the amount of work done by a particular **Position** from a **Staff**. A **Staff** can have many **Positions**, and each **Position** has units of measure (UOM) of "Hourly" and "Fixed", in addition to regular and overtime rates. 
- **Truck** line items: Describes quantity and rate if a **Truck** was used. Each **Truck** has UOM's of "Hourly" and "Fixed", in addition to a rate for that **Truck**.
- Miscellaneous (**Misc**) line items: A flexible category which describes other uncategorizable work done, which includes a description, cost, price, and quantity.

A **Ticket** could have any number of **Labour**, **Truck**, or **Misc** items. A **Ticket** also has a description of work which is an overview of the work done for the **Project** pertaining to a single **Ticket**.

A User uses **Project** (**Customer**, **Job**, and **Location**), **Labour**, and **Truck** data in the process of creating a **Ticket**, in addition to manually entering data such as number of hours, quantity, etc, as it pertains to each section.

##### Entity Relationship Diagram

![Entity Relationship Diagram](/readmeAssets/ERD.png)
- **Ticket**: Since a Ticket describes a collection of work done for a single Project, it has a 1-1 with Project. Ticket is given its own table since it could contain data not related to the Project, such as audit data, user creation data, etc. 
Ticket has 1-N relationships with each of TruckItem, LabourItem, and MiscItem, since a Ticket might not have any of a certain type of line item, or it could have many.
- **Staff**: Staff could have many Positions, and each Position has a UOM of Hourly and Fixed, with associated regular and overtime rates. The PositionRates table contains data for each Position's Hourly and Fixed regular and overtime rates.
- **Truck**: Similar to Position, a TruckRate table holds data for the Hourly and Fixed rates for each Truck.
- **Customer**: A Customer can have many Jobs.
- **Job**: A Job needs a Location, but a Location exists without a job. A Job could have many Locations, and the same Location could correspond to many Jobs. The JobLocation table resolves the M-N relationship between Jobs and Locations.
- **Project**: Contains data about the Customer, Job, Location, and other necessary data.


##### Database Schema

![Database Schema](/readmeAssets/Schema.png)
