<?php
/**
 * get_position_rates.php
 *
 * Returns the regular and overtime rates for a given staff position and UOM (unit of measure).
 */
require_once __DIR__ . "/../Controller/LabourController.php";

 try {
    $labourController = new LabourController();
    if (isset($_POST["position_id"], $_POST["uom"])) {
        $data = $labourController->getPositionRates($_POST["position_id"], $_POST["uom"]);
        unset($labourController);
        $data = [
            "regular_rate" => $data[0]["regular_rate"],
            "overtime_rate" => $data[0]["overtime_rate"]
        ];
        echo json_encode($data);
    } else {
        throw new Exception("Could not get position rates - missing position ID or UOM.");
    }
 } catch (Exception $e) {
     http_response_code(500);
     echo json_encode(["error" => $e->getMessage()]);
     exit;
 }
?>