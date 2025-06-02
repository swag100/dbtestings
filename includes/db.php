<?php

// Make this the ffile containing the class to interface with DB info

class Database {
    private static $db;
    private $connection;

    private function __construct() {
        $this->connection = new MySQLi(
            "localhost",
            "root",
            "root",
            "dbtestings"
        );
    }

    function __destruct() {
        $this->connection->close();
    }

    public static function getConnection() {
        if (self::$db == null) {
            self::$db = new Database();
        }
        return self::$db->connection;
    }
}