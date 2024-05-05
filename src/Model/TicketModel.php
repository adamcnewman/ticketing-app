<?php
require_once __DIR__ . "/../Core/Database.php";

class TicketModel {
    private $db;
    private $ticketID;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Creates a new ticket entry in the database
     */
    private function insertTicketEntry($descriptionOfWork) {
        try {
            if (empty($descriptionOfWork)) {
                throw new Exception("Description of work is required");
            }
            $descriptionOfWork = trim($descriptionOfWork);

            $query = 
                "INSERT INTO 
                    ticket (description_of_work) 
                VALUES 
                    (?)";

            $stmt = $this->db->prepare($query);
            if ($stmt) {
                $stmt->bind_param("s", $descriptionOfWork);
                $success = $stmt->execute();
                $ticketID = $stmt->insert_id;
                $stmt->close();
            }
            $this->ticketID = $ticketID;
        } catch (Exception $e) {
            throw "Error (insertTicketEntry): " . $e->getMessage();
        }
    }

    /**
     * Creates a new project entry in the database
     */
    private function insertProjectEntry($projectData) {
        try {
            if (empty($projectData)) {
                throw new Exception("Project data is required");
            }

            $query = 
                "INSERT INTO 
                    project (ticket_id, customer_id, job_id, location_id, project_status, ordered_by, area, project_date) 
                VALUES 
                    (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->db->prepare($query);
            if ($stmt) {
                $stmt->bind_param("iiiissss", 
                    $this->ticketID,
                    $projectData["customerID"], 
                    $projectData["jobID"], 
                    $projectData["locationID"], 
                    $projectData["status"],
                    $projectData["orderedBy"],
                    $projectData["area"],
                    $projectData["date"]
                );
                $success = $stmt->execute();
                $stmt->close();
            }
        } catch (Exception $e) {
            throw "Error (insertProjectEntry): " . $e->getMessage();
        }
    }

    /**
     * Batch inserts labour line items into the database
     */
    private function insertLabourLineItems($labourLineItems) {
        if (is_array($labourLineItems) && !(isset($labourLineItems["empty"]) && $labourLineItems["empty"] === true)) {
            foreach ($labourLineItems as $labourLineItem) {
                $query = 
                    "INSERT INTO 
                        labour_item (ticket_id, position_id, uom, regular_rate, regular_hours, overtime_rate, overtime_hours) 
                    VALUES 
                        (?, ?, ?, ?, ?, ?, ?)";

                $stmt = $this->db->prepare($query);
                if ($stmt) {
                    $stmt->bind_param("iisdddd", 
                        $this->ticketID,
                        $labourLineItem["positionID"], 
                        $labourLineItem["uom"], 
                        $labourLineItem["regularRate"], 
                        $labourLineItem["regularHours"], 
                        $labourLineItem["overtimeRate"], 
                        $labourLineItem["overtimeHours"]
                    );
                    $success = $stmt->execute();
                    
                    $stmt->close();
                }
            }
        }
    }

    /**
     * Batch inserts truck line items into the database
     */
    private function insertTruckLineItems($truckLineItems) {
        if (is_array($truckLineItems) && !(isset($truckLineItems["empty"]) && $truckLineItems["empty"] === true)) {
            foreach ($truckLineItems as $truckLineItem) {
                $query = 
                    "INSERT INTO 
                        truck_item (ticket_id, truck_id, quantity, uom, rate, total) 
                    VALUES 
                        (?, ?, ?, ?, ?, ?)";

                $stmt = $this->db->prepare($query);
                if ($stmt) {
                    $stmt->bind_param("iiisdd", 
                        $this->ticketID,
                        $truckLineItem["truckID"], 
                        $truckLineItem["quantity"], 
                        $truckLineItem["uom"], 
                        $truckLineItem["rate"], 
                        $truckLineItem["total"]
                    );
                    $success = $stmt->execute();
                    $stmt->close();
                }
            }
        }
    }

    /**
     * Batch inserts miscellaneous line items into the database
     */
    private function insertMiscLineItems($miscLineItems) {
        if (is_array($miscLineItems) && !(isset($miscLineItems["empty"]) && $miscLineItems["empty"] === true)) {
            foreach ($miscLineItems as $miscLineItem) {
                $query = 
                    "INSERT INTO 
                        misc_item (ticket_id, misc_description, cost, price, quantity, total) 
                    VALUES 
                        (?, ?, ?, ?, ?, ?)";

                $stmt = $this->db->prepare($query);
                if ($stmt) {
                    $stmt->bind_param("isdddd", 
                        $this->ticketID,
                        $miscLineItem["description"], 
                        $miscLineItem["cost"], 
                        $miscLineItem["price"], 
                        $miscLineItem["quantity"], 
                        $miscLineItem["total"]
                    );
                    $success = $stmt->execute();
                    $stmt->close();
                }
            }
        }
    }

    /**
     * Creates a new ticket entry in the database
     */
    public function createTicket($descriptionOfWork, $projectData, $labourLineItems, $truckLineItems, $miscLineItems) {
        try {
            $this->db->begin_transaction();
        
            // Perform operations
            // $this->insertTicketEntry($descriptionOfWork);
            // $this->insertProjectEntry($projectData);
            // $this->insertLabourLineItems($labourLineItems);
            // $this->insertTruckLineItems($truckLineItems);
            // $this->insertMiscLineItems($miscLineItems);

            error_log("Attempting to insert ticket with description: $descriptionOfWork");
            $this->insertTicketEntry($descriptionOfWork);
            error_log("Ticket inserted with ID: " . $this->ticketID);

            error_log("Attempting to insert project with data: " . print_r($projectData, true));
            $this->insertProjectEntry($projectData);
            error_log("Project insertion attempted.");
        
            error_log("Attempting to insert labour with data: " . print_r($labourLineItems, true));
            $this->insertLabourLineItems($labourLineItems);
            error_log("Labour insertion attempted.");

            error_log("Attempting to insert truck with data: " . print_r($truckLineItems, true));
            $this->insertTruckLineItems($truckLineItems);
            error_log("truck insertion attempted.");

            error_log("Attempting to insert misc with data: " . print_r($miscLineItems, true));
            $this->insertMiscLineItems($miscLineItems);
            error_log("misc insertion attempted.");

            // If all operations are successful
            $this->db->commit();
        } catch (Exception $e) {
            // If any operation fails
            $this->db->rollback();
            throw $e;
        }
    }
}
?>