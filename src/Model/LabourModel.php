<?php
/**
 * LabourModel.php
 *
 */

require_once __DIR__ . "/../Core/Database.php";

class LabourModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Gets the staff data from the database.
     */
    public function getStaffData() {
        try {
            $staffData = [];
            $query = 
            "SELECT 
                staff_id, name 
            FROM 
                staff
            ";
            $stmt = $this->db->prepare($query);
            if ($stmt) {
                $success = $stmt->execute();
                if (!$success) {
                    throw new Exception("Query failed: " . $stmt->error);
                }
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $staffData[] = $row;
                }
                $stmt->close();
            }
            return $staffData;
        } catch (Exception $e) {
            throw "Error (getStaffData)" . $e;
        }
    }

    /**
     * Gets the positions from a staff ID.
     */
    public function getPositionsFromStaffID($staff_id) {
        try {
            $positions = [];
            $query = 
            "SELECT 
                position_id, title 
            FROM 
                position
            WHERE 
                staff_id = ?
            ";
            $stmt = $this->db->prepare($query);
            $staff_id = intval($staff_id);
            if ($stmt) {
                $stmt->bind_param("i", $staff_id);
                if (!$success) {
                    throw new Exception("Query failed: " . $stmt->error);
                }
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $positions[] = $row;
                }
                $stmt->close();
            }
            return $positions;
        } catch (Exception $e) {
            throw "Error (getPositionsFromStaffID)" . $e;
        }
    }

    /**
     * Gets the position rates given a position ID and unit of measure.
     */
    public function getPositionRates($position_id, $uom) {
        try {
            $rates = [];
            $query = 
            "SELECT 
                regular_rate, overtime_rate 
            FROM 
                position_rate 
            WHERE 
                position_id = ? AND uom = ?
            ";
            $stmt = $this->db->prepare($query);
            $position_id = intval($position_id);
            if ($stmt) {
                $stmt->bind_param("is", $position_id, $uom);
                if (!$success) {
                    throw new Exception("Query failed: " . $stmt->error);
                }
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $rates[] = $row;
                }
                $stmt->close();
            }
            return $rates;
        } catch (Exception $e) {
            throw "Error (getPositionRates)" . $e;
        }
    }
}