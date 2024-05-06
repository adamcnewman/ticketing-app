<?php
/**
 * TicketController.php
 * 
 */

require_once __DIR__ . "/../Model/TicketModel.php";

class TicketController {
    private $ticketModel;

    public function __construct() {
        $this->ticketModel = new TicketModel();
    }

    /**
     * Creates a new ticket entry in the database
     */
    public function createTicket($descriptionOfWork, $projectData, $labourLineItems, $truckLineItems, $miscLineItems) {
        try {
            $this->ticketModel->createTicket(
                $descriptionOfWork, 
                $projectData, 
                $labourLineItems, 
                $truckLineItems, 
                $miscLineItems
            );
        } catch (Exception $e) {
            throw ($e);
        }
    }
}
?>