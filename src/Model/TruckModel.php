<?php
/**
 * TruckModel.php
 * 
 */

require_once __DIR__ . "/../Core/Database.php";

class TruckModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getTrucks() {
        $trucks = [];
        $query = 
            "SELECT 
                truck_id, label 
            FROM 
                truck
            ";
        $stmt = $this->db->prepare($query);
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $trucks[] = $row;
            }
            $stmt->close();
        }
        return $trucks;
    }

    public function getTruckRateFromID($truck_id, $uom) {
        $truck_rate = [];
        $query = 
            "SELECT 
                rate 
            FROM 
                truck_rate
            WHERE 
                truck_id = ? 
                AND 
                uom = ?";
        $stmt = $this->db->prepare($query);
        $truck_id = intval($truck_id);
        if ($stmt) {
            $stmt->bind_param("is", $truck_id, $uom);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $truck_rate[] = $row;
            }
            $stmt->close();
        }
        if (isset($truck_rate[0]["rate"])) {
            return $truck_rate[0]["rate"];
        } else {
            // Handle the case where "rate" is not set
            // This could be returning a default value, throwing an error, etc.
            return "?";
        }
        
    }
}
?>