<?php
require_once __DIR__ . "/../Core/Database.php";

class ProjectModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getCustomers() {
        $customers = [];
        $query = 
            "SELECT customer_id, name 
            FROM customer 
            ORDER BY name
            ";
        $stmt = $this->db->prepare($query);
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $customers[] = $row;
            }
            $stmt->close();
        }
        return $customers;
    }

    public function getJobs() {
        $jobs = [];
        $query = 
            "SELECT job_id, customer_id, name 
            FROM job 
            ORDER BY customer_id
            ";
        $stmt = $this->db->prepare($query);
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
            $stmt->close();
        }
        return $jobs;
    }

    public function getLocations() {
        $locations = [];
        $query = 
            "SELECT location_id, name 
            FROM location 
            ";
        $stmt = $this->db->prepare($query);
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $locations[] = $row;
            }
            $stmt->close();
        }
        return $locations;
    }
}
?>