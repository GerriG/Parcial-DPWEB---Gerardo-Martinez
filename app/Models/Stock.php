<?php

require_once 'core/Database.php';

class Stock {
    private $conn;
    private $table = 'stock';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllStocks() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createStock($bookId, $totalStock, $notes) {
        $query = "INSERT INTO {$this->table} (ID_BOOK, TOTAL_STOCK, NOTES) 
                  VALUES (:book_id, :total_stock, :notes)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':book_id', $bookId);
        $stmt->bindParam(':total_stock', $totalStock);
        $stmt->bindParam(':notes', $notes);
        return $stmt->execute();
    }
}
