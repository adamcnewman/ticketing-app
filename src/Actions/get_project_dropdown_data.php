<?php
require_once __DIR__ . "/../Controller/ProjectController.php";

$projectController = new ProjectController();
if (isset($_POST["customer_id"], $_POST["job_id"], $_POST["location_id"])) {
    $data = $projectController->getFilteredDropdownData($_POST["customer_id"], $_POST["job_id"], $_POST["location_id"]);
    unset($projectController);
    echo json_encode($data);
} else {
    echo "Not found";
}
?>