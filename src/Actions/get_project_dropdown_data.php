<?php
/**
 * get_project_dropdown_data.php
 *
 * Returns filtered dropdown data for projects based on customer, job and location IDs.
 */
require_once __DIR__ . "/../Controller/ProjectController.php";

try {
    $projectController = new ProjectController();
    if (isset($_POST["customer_id"], $_POST["job_id"], $_POST["location_id"])) {
        $data = $projectController->getFilteredDropdownData($_POST["customer_id"], $_POST["job_id"], $_POST["location_id"]);
        unset($projectController);
        echo json_encode($data);
    } else {
        throw new Exception("Could not get project dropdown data - missing customer ID, job ID or location ID.");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}
?>