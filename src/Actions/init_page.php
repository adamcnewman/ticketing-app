<?php
// Project section
require_once __DIR__ . "/../Controller/ProjectController.php";
$projectController = new ProjectController();
$projectData = $projectController->initProjectData();
unset($projectController);

// Labour section
require_once __DIR__ . "/../Controller/LabourController.php";
$labourController = new LabourController();
$staffData = $labourController->initLabourData();
ob_start();
require_once __DIR__ . "/../View/LabourLineItemView.php";
$labourLineItemHTML = ob_get_clean();
unset($labourController);

// Truck section
require_once __DIR__ . "/../Controller/TruckController.php";
$truckController = new TruckController();
$truckData = $truckController->initTruckData();
ob_start();
require_once __DIR__ . "/../View/TruckLineItemView.php";
$truckLineItemHTML = ob_get_clean();
unset($truckController);

$data = [
    "projectData" => $projectData,
    "staffData" => $staffData,
    "labourLineItemHTML" => $labourLineItemHTML,
    "truckData" => $truckData,
    "truckLineItemHTML" => $truckLineItemHTML
];

echo json_encode($data);
?>