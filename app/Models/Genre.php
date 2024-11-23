<?php

require_once 'core/Database.php';

class Genre {
    private $conn;
    private $table = 'genre';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllGenres() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createGenre($name) {
        $query = "INSERT INTO {$this->table} (NAME) VALUES (:name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }
}
