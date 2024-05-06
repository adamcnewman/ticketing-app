<?php
/**
 * ProjectController.php
 * 
 */

require_once __DIR__ . "/../Model/ProjectModel.php";

class ProjectController {
    private $projectModel;

    public function __construct() {
        $this->projectModel = new ProjectModel();
    }

    public function initProjectData() {
        $customers = $this->getCustomers();
        $jobs = $this->getJobs();
        $locations = $this->getLocations();
        $projectData = [
            "customers" => $customers,
            "jobs" => $jobs,
            "locations" => $locations
        ];
        return $projectData;
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

    public function getFilteredDropdownData($customer_id, $job_id, $location_id) {
        $dropdownData = $this->projectModel->getFilteredDropdownData($customer_id, $job_id, $location_id);
        return $dropdownData;
    }
}
?>