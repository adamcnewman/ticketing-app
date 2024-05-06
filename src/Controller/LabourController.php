<?php
/**
 * LabourController.php
 * 
 */
require_once __DIR__ . "/../Model/LabourModel.php";

class LabourController {
    private $labourModel;

    public function __construct() {
        $this->labourModel = new LabourModel();
    }

    public function initLabourData() {
        $staffData = $this->labourModel->getStaffData();
        return $staffData;
    }

    public function getPositionsFromStaffID($staff_id) {
        $positions = $this->labourModel->getPositionsFromStaffID($staff_id);
        return $positions;
    }

    public function getPositionRates($position_id, $uom) {
        $rates = $this->labourModel->getPositionRates($position_id, $uom);
        return $rates;
    }
}
?>