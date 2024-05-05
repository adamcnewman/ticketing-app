<?php
require_once __DIR__ . "/../Controller/TicketController.php";

$ticketController = new TicketController();

if (isset(  $_POST["descriptionOfWork"],
            $_POST["projectData"],
            $_POST["labourLineItems"], 
            $_POST["truckLineItems"], 
            $_POST["miscLineItems"]
            )
    ) {
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
        echo "Error: " . $e->getMessage();
    }
} else {
    echo( "Could not create ticket - missing ticket data.");
}

?>