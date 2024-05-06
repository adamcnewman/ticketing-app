<?php
/**
 * get_staff_positions.php
 * 
 * This file is used to get the positions of a staff member from their staff ID.
 */
require_once __DIR__ . "/../Controller/LabourController.php";

try {
    $labourController = new LabourController();
    if (isset($_POST["staff_id"])) {
        $data = $labourController->getPositionsFromStaffID($_POST["staff_id"]);
        unset($labourController);
        $data = [
            "positions" => $data
        ];
        echo json_encode($data);
    } else {
        throw new Exception("Could not get staff positions - missing staff ID.");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}

?>