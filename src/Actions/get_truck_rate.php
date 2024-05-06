<?php
/**
 * get_truck_rate.php
 * 
 * Returns the rate of a truck given a truck ID and UOM.
 */
require_once __DIR__ . "/../Controller/TruckController.php";

try {
    $truckController = new TruckController();
    if (isset($_POST["truck_id"]) && isset($_POST["uom"])) {
        $data = $truckController->getTruckRateFromID($_POST["truck_id"], $_POST["uom"]);
        unset($truckController);
        $data = [
            "rate" => $data
        ]; 
        echo json_encode($data);
    } else {
        throw new Exception("Could not get truck rate - missing truck ID or UOM.");
    }   
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}
?>