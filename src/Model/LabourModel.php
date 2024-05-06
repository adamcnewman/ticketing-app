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

    public function getStaffData() {
        $staffData = [];
        $query = 
            "SELECT 
                staff_id, name 
            FROM 
                staff
            ";
        $stmt = $this->db->prepare($query);
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $staffData[] = $row;
            }
            $stmt->close();
        }
        return $staffData;
    }

    public function getPositionsFromStaffID($staff_id) {
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
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $positions[] = $row;
            }
            $stmt->close();
        }
        return $positions;
    }

    public function getPositionRates($position_id, $uom) {
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
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $rates[] = $row;
            }
            $stmt->close();
        }
        return $rates;
    }
}