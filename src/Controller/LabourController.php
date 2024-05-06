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

    /**
     * Initializes the labour data for the page.
     */
    public function initLabourData() {
        try {
            $staffData = $this->labourModel->getStaffData();
            return $staffData;
        } catch (Exception $e) {
            throw ($e);
        }
    }

    /**
     * Gets the positions from a staff ID.
     */
    public function getPositionsFromStaffID($staff_id) {
        try {

            $positions = $this->labourModel->getPositionsFromStaffID($staff_id);
            return $positions;
        } catch (Exception $e) {
            throw ($e);
        }
    }

    /**
     * Gets the position rates given a position ID and unit of measure.
     */
    public function getPositionRates($position_id, $uom) {
        try {

            $rates = $this->labourModel->getPositionRates($position_id, $uom);
            return $rates;
        } catch (Exception $e) {
            throw ($e);
        }
    }
}
?>