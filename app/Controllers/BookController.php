<?php
require_once "../models/Book.php";
error_reporting(0);

class BookController {
    private $book;

    public function __construct() {
        $this->book = new Book(); // Instanciamos el modelo de libros
    }

    // Método para mostrar la lista de libros
    public function index() {
        $books = $this->book->getAllBooks(); // Obtener todos los libros
        require_once "../Views/books/index.php"; // Pasar la lista de libros a la vista
    }

    // Método para crear un libro nuevo
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar que todos los campos requeridos estén presentes
            if (isset($_POST['title'], $_POST['description'], $_POST['year_publication'], $_POST['id_author'], $_POST['id_genre'])) {
                $title = trim($_POST['title']);
                $description = trim($_POST['description']);
                $year_publication = trim($_POST['year_publication']);
                $id_author = trim($_POST['id_author']);
                $id_genre = trim($_POST['id_genre']);
    
                // Validación simple de los campos
                if (empty($title) || empty($description) || empty($year_publication) || empty($id_author) || empty($id_genre)) {
                    // Aquí puedes redirigir a una página con un mensaje de error o mostrar un error
                    echo "Todos los campos son obligatorios.";
                    return;
                }
    
                // Puedes agregar validación adicional para el formato de los datos (por ejemplo, el año de publicación)
                if (!is_numeric($year_publication) || strlen($year_publication) != 4) {
                    echo "El año de publicación debe ser un número de 4 dígitos.";
                    return;
                }
    
                // Crear el libro en la base de datos
                if ($this->book->createBook($title, $description, $year_publication, $id_author, $id_genre)) {
                    // Redirigir a la lista de libros
                    header("Location: ../books/index.php");
                    exit(); // Asegurarse de detener la ejecución del script después de la redirección
                } else {
                    echo "Error creating the book. Please try again.";
                }
            } else {
                echo "Faltan datos necesarios. Por favor, complete todos los campos.";
            }
        } else {
            // Mostrar el formulario de creación
            require_once "../Views/books/create.php";
        }
    }
    

    // Ver un libro individual
    public function view($id) {
    $book = $this->book->getBookById($id); // Obtener el libro por ID
    
    if ($book) {
        require_once "../Views/books/view.php"; // Mostrar la vista de ese libro
    } else {
        echo "El libro con ID $id no existe o no se pudo recuperar.";
    }
}


    // Editar un libro existente
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibir los datos del formulario
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $year_publication = trim($_POST['year_publication']);
            $id_author = trim($_POST['id_author']);
            $id_genre = trim($_POST['id_genre']);
    
            // Validación de los campos
            if (empty($title) || empty($description) || empty($year_publication) || empty($id_author) || empty($id_genre)) {
                echo "Todos los campos son obligatorios.";
                return;
            }
    
            // Validación simple del año de publicación
            if (!is_numeric($year_publication) || strlen($year_publication) != 4) {
                echo "El año de publicación debe ser un número de 4 dígitos.";
                return;
            }
    
            // Actualizar el libro en la base de datos
            if ($this->book->updateBook($id, $title, $description, $year_publication, $id_author, $id_genre)) {
                // Redirigir a la lista de libros después de la actualización
                header("Location: ../books/index.php");
                exit(); // Detener la ejecución
            } else {
                echo "Error updating the book. Please try again.";
            }
        } else {
            // Obtener el libro para editar
            $book = $this->book->getBookById($id);
            require_once "../Views/books/edit.php"; // Mostrar el formulario de edición
        }
    }

    public function delete($id) {
        try {
            if ($this->book->deleteBook($id)) {
                header("Location: ../Views/books/view.php");
                exit();
            } else {
                echo "Error al eliminar el libro.";
            }
        } catch (PDOException $e) {
            // Si el error es por la clave foránea, mostrar un mensaje amigable
            if ($e->getCode() == 23000) {
                // Error por restricción de clave foránea (foreign key constraint)
                echo "<div class='error-message'>No se puede eliminar este libro porque está siendo utilizado en la tabla <strong>Stock</strong>.</div>";
            } else {
                // Otros tipos de error
                echo "<div class='error-message'>Error al eliminar el libro: " . $e->getMessage() . "</div>";
            }
        }
    }
    
}

// Routing logic
$controller = new BookController();
$action = $_GET['action'] ?? 'index'; // La acción por defecto es 'index'
$id = $_GET['id'] ?? null; // Obtener el ID si se pasa

// Llamar al método correspondiente del controlador
if (method_exists($controller, $action)) {
    if ($id) {
        $controller->{$action}($id); // Si hay ID, pasarlo al método
    } else {
        $controller->{$action}(); // Sino, solo ejecutar la acción
    }
} else {
    echo "Invalid action."; // Si la acción no existe, mostrar un error
}

?>
