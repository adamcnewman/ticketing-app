<?php
require_once(realpath(__DIR__ . "/../../config/db.config.php"));

class Database {
    private $connection;

    public function __construct() {
        $this->connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DBNAME);
        if ($this->connection->connect_error) {
            die("Connection Failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>