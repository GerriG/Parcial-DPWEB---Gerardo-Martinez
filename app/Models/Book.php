<?php
require_once "../core/Database.php";

class Book {
    private $conn;
    private $table = 'book';

    public function __construct() {
        // Inicializa la conexión a la base de datos
        $database = new Database();
        $this->conn = $database->getConnection();
        
        // Verificar la conexión
        if (!$this->conn) {
            throw new Exception('Error al conectar con la base de datos');
        }
    }

    // Obtener todos los libros
    public function getAllBooks() {
        // Escribir la consulta SQL para obtener los libros junto con su autor y género
        $query = "SELECT 
                      b.ID_BOOK, 
                      b.TITLE, 
                      b.DESCRIPTION, 
                      b.YEAR_PUBLICATION, 
                      a.FULL_NAME AS AUTHOR, 
                      g.NAME AS GENRE
                  FROM book b
                  INNER JOIN author a ON b.ID_AUTHOR = a.ID_AUTHOR
                  INNER JOIN genre g ON b.ID_GENRE = g.ID_GENRE;";
        
        try {
            // Preparar la consulta
            $stmt = $this->conn->prepare($query);
            
            // Ejecutar la consulta
            $stmt->execute();
            
            // Devolver los resultados como un array asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejo de errores en la consulta
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Crear un libro
    public function createBook($title, $description, $year_publication, $id_author, $id_genre) {
        $query = "INSERT INTO {$this->table} (TITLE, DESCRIPTION, YEAR_PUBLICATION, ID_AUTHOR, ID_GENRE)
                  VALUES (:title, :description, :year_publication, :id_author, :id_genre)";
        
        try {
            $stmt = $this->conn->prepare($query);

            // Vinculación de parámetros
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':year_publication', $year_publication);
            $stmt->bindParam(':id_author', $id_author);
            $stmt->bindParam(':id_genre', $id_genre);

            return $stmt->execute(); // Devuelve true si se ejecuta correctamente
        } catch (PDOException $e) {
            echo "Error al crear el libro: " . $e->getMessage();
            return false;
        }
    }

    // Obtener un libro por su ID
    public function getBookById($id) {
        // La consulta ahora selecciona los ID de autor y género
        $query = "SELECT b.ID_BOOK, b.TITLE, b.DESCRIPTION, b.YEAR_PUBLICATION, b.ID_AUTHOR, b.ID_GENRE
                  FROM book b
                  WHERE b.ID_BOOK = :id"; // Seleccionamos directamente los ID de autor y género
        
        try {
            $stmt = $this->conn->prepare($query); // Preparamos la consulta
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Vinculamos el parámetro :id
            $stmt->execute(); // Ejecutamos la consulta
            return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un solo registro como array asociativo
        } catch (PDOException $e) {
            // Manejamos el error y devolvemos null en caso de fallo
            echo "Error al obtener el libro: " . $e->getMessage();
            return null;
        }
    }
    


    // Actualizar un libro
public function updateBook($id, $title, $description, $year_publication, $id_author, $id_genre) {
    $query = "UPDATE {$this->table}
              SET 
                  TITLE = :title,
                  DESCRIPTION = :description,
                  YEAR_PUBLICATION = :year_publication,
                  ID_AUTHOR = :id_author,
                  ID_GENRE = :id_genre
              WHERE ID_BOOK = :id";
    
    try {
        $stmt = $this->conn->prepare($query);

        // Vinculación de parámetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':year_publication', $year_publication);
        $stmt->bindParam(':id_author', $id_author);
        $stmt->bindParam(':id_genre', $id_genre);

        return $stmt->execute(); // Devuelve true si se ejecuta correctamente
    } catch (PDOException $e) {
        echo "Error al actualizar el libro: " . $e->getMessage();
        return false;
    }
}


    // Eliminar un libro
    public function deleteBook($id) {
        $query = "DELETE FROM {$this->table} WHERE ID_BOOK = :id";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute(); // Devuelve true si se ejecuta correctamente
        } catch (PDOException $e) {
            echo "Error al eliminar el libro: " . $e->getMessage();
            return false;
        }
    }
}
?>

