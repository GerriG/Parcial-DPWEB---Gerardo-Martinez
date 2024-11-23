<?php

require_once '../core/Database.php';

class Author {
    private $conn;
    private $table = 'author';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtener todos los autores
    public function getAllAuthors() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un autor
    public function createAuthor($name, $birthDate, $deathDate) {
        $query = "INSERT INTO {$this->table} (FULL_NAME, DATE_OF_BIRTH, DATE_OF_DEATH) 
                  VALUES (:name, :birth_date, :death_date)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':birth_date', $birthDate);
        $stmt->bindParam(':death_date', $deathDate);
        return $stmt->execute();
    }

    // Obtener un autor por ID
public function getAuthorById($id) {
    if (empty($id) || !is_numeric($id)) {
        echo "ID inválido.";
        return null;
    }
    
    $query = "SELECT * FROM {$this->table} WHERE ID_AUTHOR = :id";
    try {
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un solo registro como array asociativo

        if ($result) {
            return $result;
        } else {
            echo "El autor con ID $id no existe.";
            return null;
        }
    } catch (PDOException $e) {
        echo "Error al obtener el autor: " . $e->getMessage();
        return null;
    }
}


    // Actualizar un autor
    public function updateAuthor($id, $name, $birthDate, $deathDate) {
        $query = "UPDATE {$this->table}
                  SET FULL_NAME = :name,
                      DATE_OF_BIRTH = :birth_date,
                      DATE_OF_DEATH = :death_date
                  WHERE ID_AUTHOR = :id";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':birth_date', $birthDate);
            $stmt->bindParam(':death_date', $deathDate);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar el autor: " . $e->getMessage();
            return false;
        }
    }

    // Eliminar un autor
    public function deleteAuthor($id) {
        $query = "DELETE FROM {$this->table} WHERE ID_AUTHOR = :id";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar el autor: " . $e->getMessage();
            return false;
        }
    }
}
?>

