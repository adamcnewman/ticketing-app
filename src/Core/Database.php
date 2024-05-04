<?php
require_once __DIR__ . "/../../config/db.config.php";

class Database {
    private static $db_connection = null;
    private $mysqli;

    private function __construct() {
        $this->mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DBNAME);
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public static function getConnection() {
        if (self::$db_connection === null) {
            self::$db_connection = new Database();
        }
        return self::$db_connection->mysqli;
    }
}
?>