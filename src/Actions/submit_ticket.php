<?php
/**
 * submit_ticket.php
 * 
 *  This file is used to submit a new ticket to the database.
 */
require_once __DIR__ . "/../Controller/TicketController.php";

try {
    $ticketController = new TicketController();
    
    if (isset(  
        $_POST["descriptionOfWork"],
        $_POST["projectData"],
        $_POST["labourLineItems"], 
        $_POST["truckLineItems"], 
        $_POST["miscLineItems"]
        )) 
    {
        try {
        $ticketController->createTicket(
            $_POST["descriptionOfWork"], 
            $_POST["projectData"], 
            $_POST["labourLineItems"], 
            $_POST["truckLineItems"], 
            $_POST["miscLineItems"]
        );
        unset($ticketController);
        echo "Success";
        } catch (Exception $e) {
            throw $e;
        }
    } else {
        throw new Exception("Could not submit ticket - missing required fields.");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}
?>