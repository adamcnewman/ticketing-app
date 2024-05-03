<?php
require_once __DIR__ . "/../Controller/TruckController.php";

$truckController = new TruckController();
if (isset($_POST["truck_id"]) && isset($_POST["uom"])) {
    $data = $truckController->getTruckRateFromID($_POST["truck_id"], $_POST["uom"]);
    unset($truckController);
    echo $data;
} else {
    echo "Not found";
}
?>