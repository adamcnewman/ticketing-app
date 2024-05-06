<?php
/**
 * init_page.php
 * 
 * Initializes the page with data for projects, labour, and trucks.
 * Project data is used to populate the project dropdown.
 * Labour data is used to populate the labour staff dropdown.
 * Truck data is used to populate the truck dropdown.
 */

try {
    // Project section
    require_once __DIR__ . "/../Controller/ProjectController.php";
    $projectController = new ProjectController();
    $projectData = $projectController->initProjectData();
    unset($projectController);

    // Labour section
    require_once __DIR__ . "/../Controller/LabourController.php";
    $labourController = new LabourController();
    $staffData = $labourController->initLabourData();

    // Truck section
    require_once __DIR__ . "/../Controller/TruckController.php";
    $truckController = new TruckController();
    $truckData = $truckController->initTruckData();

    if (empty($projectData) || empty($staffData) || empty($truckData)) {
        throw new Exception("Could not initialize page - missing project, staff, or truck data.");
    }

    $data = [
        "projectData" => $projectData,
        "staffData" => $staffData,
        "truckData" => $truckData,
    ];

    echo json_encode($data);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}
?>