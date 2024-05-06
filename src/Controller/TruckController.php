<?php
/**
 * TruckController.php
 * 
 */

require_once __DIR__ . "/../Model/TruckModel.php";

class TruckController {
    private $truckModel;

    public function __construct() {
        $this->truckModel = new TruckModel();
    }

    /**
     * Initializes the truck data for the page.
     */
    public function initTruckData() {
        try {
            $trucks = $this->truckModel->getTrucks();
            return $trucks;
        } catch (Exception $e) {
            throw ($e);
        }
    }

    /**
     * Gets the truck rate from the truck ID and unit of measure.
     */
    public function getTruckRateFromID($truck_id, $uom) { 
        try {
            $truck_rate = $this->truckModel->getTruckRateFromId($truck_id, $uom);
            return $truck_rate;
        } catch (Exception $e) {
            throw ($e);
        }
    }
}
?>