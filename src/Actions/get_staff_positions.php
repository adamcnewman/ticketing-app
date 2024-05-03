<?php
require_once __DIR__ . "/../Controller/LabourController.php";

$labourController = new LabourController();
if (isset($_POST["staff_id"])) {
    $data = $labourController->getPositionsFromStaffID($_POST["staff_id"]);
    unset($labourController);
    $data = [
        "positions" => $data
    ];
    echo json_encode($data);
} else {
    echo "Not found";
}
?>