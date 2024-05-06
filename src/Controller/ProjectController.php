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

    /**
     * Initializes the project data for the page.
     */
    public function initProjectData() {
        try {

            $customers = $this->getCustomers();
            $jobs = $this->getJobs();
            $locations = $this->getLocations();
            $projectData = [
                "customers" => $customers,
                "jobs" => $jobs,
                "locations" => $locations
            ];
            return $projectData;
        } catch (Exception $e) {
            throw ($e);
        }
    }

    /**
     * Gets the customers from the database.
     */
    public function getCustomers() {
        try {
            $customers = $this->projectModel->getCustomers();
            return $customers;
        } catch (Exception $e) {
            throw ($e);
        }
    }

    /**
     * Gets the jobs from the database.
     */
    public function getJobs() {
        try {
            $jobs = $this->projectModel->getJobs();
            return $jobs;  
        } catch (Exception $e) {
            throw ($e);
        }
    }

    /**
     * Gets the locations from the database.
     */
    public function getLocations() {
        try {
            $locations = $this->projectModel->getLocations();
            return $locations;
        } catch (Exception $e) {
            throw ($e);
        }
    }

    /**
     * Gets the filtered dropdown data from the database.
     * Used to filter job, location, and customer dropdown options.
     */
    public function getFilteredDropdownData($customer_id, $job_id, $location_id) {
        try {
            $dropdownData = $this->projectModel->getFilteredDropdownData($customer_id, $job_id, $location_id);
            return $dropdownData;
        } catch (Exception $e) {
            throw ($e);
        }
    }
}
?>