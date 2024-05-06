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

    public function initTruckData() {
        $trucks = $this->truckModel->getTrucks();
        return $trucks;
    }

    public function getTruckRateFromID($truck_id, $uom) { 
        $truck_rate = $this->truckModel->getTruckRateFromId($truck_id, $uom);
        return $truck_rate;
    }
}
?>