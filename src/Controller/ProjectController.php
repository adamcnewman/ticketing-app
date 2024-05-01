<?php
require_once __DIR__ . "/../Model/ProjectModel.php";

class ProjectController {
    private $projectModel;

    public function __construct() {
        $this->projectModel = new ProjectModel();
    }

    public function getCustomers() {
        $customers = $this->projectModel->getCustomers();
        return $customers;
    }

    public function getJobs() {
        $jobs = $this->projectModel->getJobs();
        return $jobs;
    }

    public function getLocations() {
        $locations = $this->projectModel->getLocations();
        return $locations;
    }
}
?>