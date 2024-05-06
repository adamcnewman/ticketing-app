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

    /**
     * Gets the trucks from the database.
     */
    public function getTrucks() {
        try {
            $trucks = [];
            $query = 
            "SELECT 
                truck_id, label 
            FROM 
                truck
            ";
            $stmt = $this->db->prepare($query);
            if ($stmt) {
                $success = $stmt->execute();
                if (!$success) {
                    throw new Exception("Query failed: " . $stmt->error);
                }
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $trucks[] = $row;
                }
                $stmt->close();
            }
            return $trucks;
        } catch (Exception $e) {
            throw new Exception("Error (getTrucks)" . $e);
        }
    }

    /**
     * Gets the truck rate from the truck ID and unit of measure.
     */
    public function getTruckRateFromID($truck_id, $uom) {
        try {
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
                $success = $stmt->execute();
                if (!$success) {
                    throw new Exception("Query failed: " . $stmt->error);
                }
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $truck_rate[] = $row;
                }
                $stmt->close();
            }
            return $truck_rate[0]["rate"];
        } catch (Exception $e) {
            throw new Exception("Error (getTruckRateFromID)" . $e);
        }
    }
}
?>