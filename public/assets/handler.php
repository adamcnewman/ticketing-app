<?php
/**
 * handler.php
 *
 * This file handles incoming HTTP requests and routes them to the appropriate action based on the request method and action parameter.
 * It is responsible for processing POST requests and including the corresponding action script.
 */

try {
    $request_method = ($_SERVER["REQUEST_METHOD"]);
    switch ($request_method) {
        case "POST":
            $action = isset($_POST["action"]) ? $_POST["action"] : "";
            break;
        default:
            throw new Exception("Invalid request method");
            break;
    }
    
    if (file_exists(__DIR__ . "/../../src/Actions/" . $action . ".php")) {
        require_once __DIR__ . "/../../src/Actions/" . $action . ".php";
    } else {
        throw new Exception("Action not found");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}
?>