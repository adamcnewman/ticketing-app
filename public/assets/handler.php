<?php

$request_method = ($_SERVER["REQUEST_METHOD"]);


switch ($request_method) {
    case "POST":
        $action = isset($_POST["action"]) ? $_POST["action"] : "";
        break;
    case "GET":
        $action = isset($_GET["action"]) ? $_GET["action"] : "";
        break;
    default:
        echo json_encode(["error" => "Not allowed"]);
}

if (file_exists(__DIR__ . "/../../src/Actions/" . $action . ".php")) {
    require_once __DIR__ . "/../../src/Actions/" . $action . ".php";
} else {
    echo json_encode(["error" => "File not found"]);
    http_response_code(404);
}
?>