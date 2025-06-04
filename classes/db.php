<?php

// Make this the ffile containing the class to interface with DB info

class Database {
    private static $db;
    private $connection;

    private function __construct($dbName = "") {
        $this->connection = new MySQLi(
            "localhost",
            "root",
            "root",
            $dbName
        );
    }

    function __destruct() {
        $this->connection->close();
    }

    public static function getConnection($dbName = "") {
        if (self::$db == null) {
            self::$db = new Database($dbName);
        }
        return self::$db->connection;
    }
}