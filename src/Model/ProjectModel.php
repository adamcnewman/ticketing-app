<?php
/**
 * ProjectModel.php
 * 
 */

require_once __DIR__ . "/../Core/Database.php";

class ProjectModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Gets the customers from the database.
     */
    public function getCustomers() {
        try {
            $customers = [];
            $query = 
                "SELECT 
                    customer_id, name 
                FROM 
                    customer 
                ORDER BY 
                    name
                ";
            $stmt = $this->db->prepare($query);
            if ($stmt) {
                $success = $stmt->execute();
                if (!$success) {
                    throw new Exception("Query failed: " . $stmt->error);
                }
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $customers[] = $row;
                }
                $stmt->close();
            }
            return $customers;
        } catch (Exception $e) {
            throw new Exception("Error (getStaffData)" . $e);
        }
    }

    /**
     * Gets the jobs from the database.
     */
    public function getJobs() {
        try {
            $jobs = [];
            $query = 
                "SELECT 
                    job_id, customer_id, name 
                FROM 
                    job 
                ORDER BY 
                    customer_id
                ";
            $stmt = $this->db->prepare($query);
            if ($stmt) {
                $success = $stmt->execute();
                if (!$success) {
                    throw new Exception("Query failed: " . $stmt->error);
                }
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $jobs[] = $row;
                }
                $stmt->close();
            }
            return $jobs;
        } catch (Exception $e) {
            throw new Exception("Error (getJobs)" . $e);
        }
    }
    /**
     * Gets the locations from the database.
     */
    public function getLocations() {
        try {
            $locations = [];
            $query = 
                "SELECT 
                    location_id, name 
                FROM 
                    location 
                ";
            $stmt = $this->db->prepare($query);
            if ($stmt) {
                $success = $stmt->execute();
                if (!$success) {
                    throw new Exception("Query failed: " . $stmt->error);
                }
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $locations[] = $row;
                }
                $stmt->close();
            }
            return $locations;
        } catch (Exception $e) {
            throw new Exception("Error (getLocations)" . $e);
        }
    }

    /**
     * Gets the raw dropdown data from the database.
     * This could contain duplicate customers, jobs, or locations in a column.
     */
    private function getRawDropdownData($customer_id, $job_id, $location_id) {
        try {
            $data = [];
            $query = 
            "SELECT DISTINCT 
                c.customer_id, 
                c.name AS customer_name,
                j.job_id, 
                j.name AS job_name,
                l.location_id,
                l.name AS location_name
            FROM 
                customer c
            JOIN 
                job j ON c.customer_id = j.customer_id
            JOIN 
                job_location jl ON j.job_id = jl.job_id
            JOIN 
                location l ON jl.location_id = l.location_id
            WHERE
                (c.customer_id = ? OR ? IS NULL)
                AND (j.job_id = ? OR ? IS NULL)
                AND (l.location_id = ? OR ? IS NULL)
            ";
            $stmt = $this->db->prepare($query);
            $customer_id = $customer_id === "" ? null : intval($customer_id);
            $job_id = $job_id === "" ? null : intval($job_id);
            $location_id = $location_id === "" ? null : intval($location_id);

            if ($stmt) {
                $stmt->bind_param("iiiiii", $customer_id, $customer_id, $job_id, $job_id, $location_id, $location_id);
                $success = $stmt->execute();
                if (!$success) {
                    throw new Exception("Query failed: " . $stmt->error);
                }
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                $stmt->close();
            }
            return $data;
        } catch (Exception $e) {
            throw new Exception("Error (getRawDropdownData)" . $e);
        }
    }

    /**
     * Calls the getRawDropdownData method and processes the data to squash duplicate
     * data in columns into a unique set of customer, job, and location values.
     * Used to filter job, location, and customer dropdown options.
     */
    public function getFilteredDropdownData($customer_id, $job_id, $location_id) {
        try {
            $data = $this->getRawDropdownData($customer_id, $job_id, $location_id);
            $projectData = [
                "customers" => [],
                "jobs" => [],
                "locations" => []
            ];
            // Gets the customer, job, and location data from the raw table rows,
            // and adds them to the projectData array if they are not already present
            foreach ($data as $row) {
                $customer = [
                    "customer_id" => $row["customer_id"],
                    "customer_name" => $row["customer_name"]
                ];
                if (!in_array($customer, $projectData["customers"])) {
                    $projectData["customers"][] = $customer;
                }

                $job = [
                    "job_id" => $row["job_id"],
                    "job_name" => $row["job_name"]
                ];
                if (!in_array($job, $projectData["jobs"])) {
                    $projectData["jobs"][] = $job;
                }

                $location = [
                    "location_id" => $row["location_id"],
                    "location_name" => $row["location_name"]
                ];
                if (!in_array($location, $projectData["locations"])) {
                    $projectData["locations"][] = $location;
                }
            }
            return $projectData;
        } catch (Exception $e) {
            throw new Exception("Error (getFilteredDropdownData)" . $e);
        }
    }
}
?>