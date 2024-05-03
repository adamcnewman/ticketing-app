<?php
require_once __DIR__ . "/../Controller/LabourController.php";

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
    echo "Not found";
}
?>